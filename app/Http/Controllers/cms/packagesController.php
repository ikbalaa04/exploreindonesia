<?php

namespace App\Http\Controllers\cms;

use App\Models\User;
use App\Models\packet;
use Spatie\Image\Image;
use App\Models\wishlist;
use App\Models\categories;
use App\Models\fileManager;
use App\Models\packetImage;
use App\Models\packetPrice;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
// use Intervention\Image\Facades\Image;
use App\Models\packetTourDetail;
use App\Models\packetRatingReview;
use App\Models\packetScheduleTour;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\packetRatingReviewFile;
use App\Models\packetScheduleTourDetail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class packagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = packet::with(['packetPrice','partner'])->where('partner_id',Auth::user()->partner_id)->get();

            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action = '';
                $action = '<a href="'.route('masterData.packages.edit', $data->id).'?type=edit" class="btn-sm btn btn-warning"><i class="material-icons">mode_edit</i>Edit</a><br>';
                $action .= '<button type="button" name="deletePermanent" id="'.$data->id.'" class="deletePermanent btn-sm btn btn-danger mt-1"><i class="material-icons">delete_outline</i>Remove</button>';
                return $action;
            })
            ->addColumn('categories', function($data) {
                if ($data->categories_id != null) {
                    $explode = explode(',',$data->categories_id);
                    $categories = '';
                    foreach ($explode as $key => $value) {
                        $categories .= '<div class="badge badge-info m-1 p-2">#'.categories::whereId($value)->pluck('name')->first().'</div>';
                    }
                } else {
                    $categories = '-';
                }
                return $categories;
            })
            ->addColumn('partner', function($data) {
                return $data->partner != null ? $data->partner->name : '-';
            })
            ->addColumn('province', function($data) {
                return $data->province_id != null ? \Indonesia::findProvince($data->province_id, null)->name : '-';
            })
            ->addColumn('price', function($data) {
                return $data->packetPrice != null ? 'Rp.'.number_format($data->packetPrice->price_in_rupiah) .' | $'.number_format($data->packetPrice->price_in_dollars) : '-';
            })
            ->addColumn('created_by', function($data) {
                return $data->created_by != null ? User::whereId($data->created_by)->pluck('name')->first() : '-';
            })
            ->addColumn('updated_by', function($data) {
                return $data->updated_by != null ? User::whereId($data->updated_by)->pluck('name')->first() : '-';
            })
            ->addColumn('status', function($data) {
                return $data->status == 2 ? '<div class="badge badge-warning m-1 p-2">Draft</div>' : ($data->status == 1 ? '<div class="badge badge-success m-1 p-2">active</div>' : 'disabled');
            })
            ->addColumn('description_idn', function($data) {
                return  strip_tags( \Illuminate\Support\Str::words($data->description_idn, 8,' ...'));
            })
            ->addColumn('description_en', function($data) {
                return  strip_tags( \Illuminate\Support\Str::words($data->description_en, 8,' ...'));
            })
            ->rawColumns(['action','categories','status','price','partner','description_idn','description_en','province','created_by','updated_by'])
            ->make(true);
        }
        return view('cms.pages.packages.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $provinces = \Indonesia::allProvinces();
        $categories = categories::where('status',1)->get();
        $file = fileManager::where('user_id',Auth::user()->id)->get();
        return view('cms.pages.packages.form',[
            'provinces' => $provinces,
            'categories' => $categories,
            'file' => $file,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $data = $request->except(['_method','_token']);
            // step1
            if ($data['data'][1]['from'] == 'information-tour') {

                $validate = Validator::make($data, [
                    'data' => 'required|array', // Ensure 'data' is an array
                    'data.3.title_idn' => 'required|string|max:255',
                    'data.7.length_of_vacation' => 'required',
                    'data.8.province_id' => 'required',
                    'data.12.price_in_rupiah' => 'required',
                    'data.13.price_in_dollar' => 'required',
                    'data.21.short_description_idn' => 'required',
                    'data.26.description_idn' => 'required',
                ]);
                // validate
                if ($validate->fails()) {
                    $error = $validate->errors();
                    $errs = [];
                    foreach ($error->all() as $key => $err) {
                        $pure = substr($err,11);
                        $errs[] = ++$key.'. '.$pure;
                    }
                    return response()->json(['code' => 400,'message'=>$errs], 400);
                }
                // insert
                $priceId = packetPrice::create([
                    'price_in_dollars' => (int)str_replace(',','',substr($data['data'][13]['price_in_dollar'],2)),
                    'price_in_rupiah' => (int)str_replace(',','',substr($data['data'][12]['price_in_rupiah'],2)),
                    'price_tourist_in_dollars' => (int)str_replace(',','',substr($data['data'][15]['price_in_dollar_tourist'],2)) ?? null,
                    'price_tourist_in_rupiah' => (int)str_replace(',','',substr($data['data'][14]['price_in_rupiah_tourist'],2)) ?? null,
                ]);

                $packetId = packet::create([
                    'partner_id' => Auth::user()->partner_id ?? null,
                    'categories_id' => $data['data'][9]['categories_id'] != null ? implode(',',$data['data'][9]['categories_id']) : '',
                    'province_id' => $data['data'][8]['province_id'],
                    'price_id' => $priceId->id,
                    'different_prices_for_tourists' => $data['data'][14]['price_in_rupiah_tourist'] == null ? 0 : 1,
                    'title_idn' => $data['data'][3]['title_idn'],
                    'title_en' => $data['data'][5]['title_en'],
                    'short_description_idn' => $data['data'][21]['short_description_idn'],
                    'short_description_en' => $data['data'][23]['short_description_en'],
                    'description_idn' => $data['data'][26]['description_idn'],
                    'description_en' => $data['data'][28]['description_en'],
                    'min_ticket' => $data['data'][16]['min_ticket'],
                    'max_ticket' => $data['data'][17]['max_ticket'],
                    'length_of_vacation' => $data['data'][7]['length_of_vacation'],
                    'status' => 2,
                    'slug' => Str::slug($data['data'][3]['title_idn']),
                    'tag' => $data['data'][18]['tag'],
                    'created_by' => Auth::user()->id,
                ]);
                return response()->json(['packetId' => $packetId->id ?? null,'code' => 200,'message'=>'success create'], 200);
            }

            // step2
            if ($data['data'][1]['from'] == 'upload-image') {
                if ($data['data'][0]['packetId'] != null) {
                    if (isset($data['data'][2])) {
                        if ($data['data'][2]['from_file'] != null) {
                            foreach ($data['data'][2]['from_file'] as $dataImageKey => $dataImage) {
                                $packetImage = packetImage::where('packet_id',$data['data'][0]['packetId'])->orderBy('position','asc')->get();

                                if (count($packetImage) == 5) {
                                    foreach ($packetImage as $key => $value) {

                                        // delete first position
                                        if ($key == 0) {
                                            if ($value->file == 'from upload') {
                                                $path = public_path('assets/images/packagesGallery/');
                                                if ($value->name != null) {
                                                    if (file_exists($path.$value->name))
                                                    unlink($path.$value->name);
                                                }
                                            }
                                            packetImage::whereId($value->id)->delete();
                                        } else {
                                            // edit position
                                            packetImage::whereId($value->id)->update(['position' => $value->position - 1]);
                                        }
                                    }
                                    // create packet
                                    packetImage::create([
                                        'packet_id' => $data['data'][0]['packetId'],
                                        'name' => $dataImage,
                                        'file' => 'from file manager',
                                        'type' => 'png' ?? '-',
                                        'position' => 5
                                    ]);
                                } else {
                                    if(count($packetImage) < 1){
                                        $position = 1;
                                    } else {
                                        // check position in database
                                        $findPosition = packetImage::where('packet_id',$data['data'][0]['packetId'])->orderBy('position','desc')->pluck('position')->first();
                                        $position = ++$findPosition;
                                    }
                                    // create packet
                                    packetImage::create([
                                        'packet_id' => $data['data'][0]['packetId'],
                                        'name' => $dataImage,
                                        'file' => 'from file manager',
                                        'type' => 'png' ?? '-',
                                        'position' => $position
                                    ]);
                                }
                            }
                        }
                    }
                }
            }

            // step 3
            if ($data['data'][1]['from'] == 'detail-tour') {
                // validate
                if ($data['data'][3][1] == null) {
                    return response()->json(['code' => 400,'message'=>'title wajib diisi'], 400);
                }

                foreach ($data['data'][3] as $key => $value) {
                    packetTourDetail::create([
                        'packet_id' => $data['data'][0]['packetId'],
                        'position' => $key,
                        'status' => '1',
                        'title' => $value,
                        'description' => $data['data'][4][$key]
                    ]);
                }
            }

            // step4
            if ($data['data'][1]['from'] == 'itenary') {
                foreach ($data['data'][2] as $key => $value) {
                    $explodeData = explode('_',$value);
                    $pakcetSchedule = packetScheduleTour::updateOrCreate([
                        'packet_id' => $data['data'][0]['packetId'],
                        'text' => $explodeData[1],
                    ]);
                    packetScheduleTourDetail::create([
                        'packet_schedule_tour_id' => $pakcetSchedule->id ?? null,
                        'name' => $explodeData[0] ?? null,
                        'range_time' => $data['data'][3][$key] ?? null,
                        'detail' => $data['data'][4][$key] ?? null,
                        'guide' => $data['data'][5][$key] ?? null,
                    ]);
                    // change packet draft to active
                    packet::whereId($data['data'][0]['packetId'])->update(['status' => 1]);
                }
            }

            return response()->json(['packetId' => '79070084-d806-4f56-bb98-e16298b92cee' ?? null,'code' => 200,'message'=>'success create'], 200);
        } catch (\Exception $th) {
            return response()->json(['code' => 500,'message'=>$th->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = packet::with(['packetRating','packetTourDetail','allPacketImage','packetPrice','packetScheduleTour.packetScheduleTourDetail','partner'])->whereId($id)->first();
        $provinces = \Indonesia::allProvinces();
        $categories = categories::where('status',1)->get();
        $file = fileManager::where('user_id',Auth::user()->id)->get();
        // dd($data);
        return view('cms.pages.packages.form',[
            'data' => $data,
            'provinces' => $provinces,
            'categories' => $categories,
            'file' => $file,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->except(['_method','_token']);
            // step1
            if ($data['data'][1]['from'] == 'information-tour') {
                $validate = Validator::make($data, [
                    'data' => 'required|array', // Ensure 'data' is an array
                    'data.3.title_idn' => 'required|string|max:255',
                    'data.7.length_of_vacation' => 'required',
                    'data.8.province_id' => 'required',
                    'data.12.price_in_rupiah' => 'required',
                    'data.13.price_in_dollar' => 'required',
                    'data.21.short_description_idn' => 'required',
                    'data.26.description_idn' => 'required',
                ]);
                // validate
                if ($validate->fails()) {
                    $error = $validate->errors();
                    $errs = [];
                    foreach ($error->all() as $key => $err) {
                        $pure = substr($err,11);
                        $errs[] = ++$key.'. '.$pure;
                    }
                    return response()->json(['code' => 400,'message'=>$errs], 400);
                }
                $findData = packet::whereId($data['data'][0]['packetId']);
                // insert
                $priceId = packetPrice::whereId($findData->pluck('price_id')->first())->update([
                    'price_in_dollars' => (int)str_replace(',','',substr($data['data'][13]['price_in_dollar'],2)),
                    'price_in_rupiah' => (int)str_replace(',','',substr($data['data'][12]['price_in_rupiah'],2)),
                    'price_tourist_in_dollars' => (int)str_replace(',','',substr($data['data'][15]['price_in_dollar_tourist'],2)) ?? null,
                    'price_tourist_in_rupiah' => (int)str_replace(',','',substr($data['data'][14]['price_in_rupiah_tourist'],2)) ?? null,
                ]);

                $packetId = packet::whereId($id)->update([
                    'partner_id' => Auth::user()->partner_id ?? null,
                    'categories_id' => $data['data'][9]['categories_id'] != null ? implode(',',$data['data'][9]['categories_id']) : '',
                    'province_id' => $data['data'][8]['province_id'],
                    'price_id' => $findData->pluck('price_id')->first(),
                    'different_prices_for_tourists' => $data['data'][14]['price_in_rupiah_tourist'] == null ? 0 : 1,
                    'title_idn' => $data['data'][3]['title_idn'],
                    'title_en' => $data['data'][5]['title_en'],
                    'short_description_idn' => $data['data'][21]['short_description_idn'],
                    'short_description_en' => $data['data'][23]['short_description_en'],
                    'description_idn' => $data['data'][26]['description_idn'],
                    'description_en' => $data['data'][28]['description_en'],
                    'min_ticket' => $data['data'][16]['min_ticket'],
                    'max_ticket' => $data['data'][17]['max_ticket'],
                    'length_of_vacation' => $data['data'][7]['length_of_vacation'],
                    'status' => 2,
                    'slug' => Str::slug($data['data'][3]['title_idn']),
                    'tag' => $data['data'][18]['tag'],
                    'updated_by' => Auth::user()->id,
                ]);
                return response()->json(['packetId' => $packetId->id ?? null,'code' => 200,'message'=>'success create'], 200);
            }

            // step2
            if ($data['data'][1]['from'] == 'upload-image') {
                if (isset($data['data'][2]) == true) {
                    if ($data['data'][2]['from_file'] != null) {
                        foreach ($data['data'][2]['from_file'] as $dataImageKey => $dataImage) {
                            $packetImage = packetImage::where('packet_id',$id)->orderBy('position','asc')->get();

                            if (count($packetImage) == 5) {
                                foreach ($packetImage as $key => $value) {
                                    // delete first position
                                    if ($key == 0) {
                                        if ($value->file == 'from upload') {
                                            $path = public_path('assets/images/packagesGallery/');
                                            if ($value->name != null) {
                                                if (file_exists($path.$value->name))
                                                unlink($path.$value->name);
                                            }
                                        }
                                        packetImage::whereId($value->id)->delete();
                                    } else {
                                        // edit position
                                        packetImage::whereId($value->id)->update(['position' => $value->position - 1]);
                                    }
                                }
                                // create packet
                                packetImage::create([
                                    'packet_id' => $id,
                                    'name' => $dataImage,
                                    'file' => 'from file manager',
                                    'type' => 'png' ?? '-',
                                    'position' => 5
                                ]);
                            } else {
                                if(count($packetImage) < 1){
                                    $position = 1;
                                } else {
                                    // check position in database
                                    $findPosition = packetImage::where('packet_id',$id)->orderBy('position','desc')->pluck('position')->first();
                                    $position = ++$findPosition;
                                }
                                // create packet
                                packetImage::create([
                                    'packet_id' => $id,
                                    'name' => $dataImage,
                                    'file' => 'from file manager',
                                    'type' => 'png' ?? '-',
                                    'position' => $position
                                ]);
                            }
                        }
                    }
                }
                return response()->json(['packetId' => $id ?? null,'code' => 200,'message'=>'success create'], 200);
            }

            // step 3
            if ($data['data'][1]['from'] == 'detail-tour') {
                // validate
                if ($data['data'][3][1] == null) {
                    return response()->json(['code' => 400,'message'=>'title wajib diisi'], 400);
                }
                foreach ($data['data'][3] as $key => $value) {
                    if (isset($data['data'][5][$key])) {
                        packetTourDetail::whereId($data['data'][5][$key])->update([
                            'title' => $value,
                            'description' => $data['data'][4][$key]
                        ]);
                    } else {
                        packetTourDetail::create([
                            'packet_id' => $data['data'][0]['packetId'],
                            'position' => $key,
                            'status' => '1',
                            'title' => $value,
                            'description' => $data['data'][4][$key]
                        ]);
                    }
                }
            }

            // step4
            if ($data['data'][1]['from'] == 'itenary') {
                // delete old
                $packetId = packetScheduleTour::where('packet_id',$id)->get();
                foreach ($packetId as $key => $value) {
                    packetScheduleTourDetail::where('packet_schedule_tour_id',$value->id)->delete();
                }
                packetScheduleTour::where('packet_id',$id)->delete();
                if (isset($data['data'][2])) {
                    foreach ($data['data'][2] as $key => $value) {
                        $explodeData = explode('_',$value);
                        $pakcetSchedule = packetScheduleTour::updateOrCreate([
                            'packet_id' => $id,
                            'text' => $explodeData[1],
                        ]);
                        packetScheduleTourDetail::create([
                            'packet_schedule_tour_id' => $pakcetSchedule->id ?? null,
                            'name' => $explodeData[0] ?? null,
                            'range_time' => $data['data'][3][$key] ?? null,
                            'detail' => $data['data'][4][$key] ?? null,
                            'guide' => $data['data'][5][$key] ?? null,
                        ]);
                    }
                }
                // change packet draft to active
                packet::whereId($id)->update(['status' => 1]);
            }
            return response()->json(['packetId' => $id ?? null,'code' => 200,'message'=>'success create'], 200);
        } catch (\Exception $th) {
            return response()->json(['code' => 500,'message'=>$th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // packet
        $packet = packet::whereId($id)->first();
        // packetimage
        $packetImage = packetImage::where('packet_id',$id)->get();
        // delete image in server
        foreach ($packetImage as $key => $value) {
            if ($value->file == 'from upload') {
                $path = public_path('assets/images/packagesGallery/');
                if ($value->name != null) {
                    if (file_exists($path.$value->name))
                    unlink($path.$value->name);
                }
            }
        }
        // delete packetiamge
        packetImage::where('packet_id',$id)->delete();
        // delete packet_prices
        packetPrice::whereId($packet->price_id)->delete();
        // delete packet_rating_reviews and file
        $packetRatingReview = packetRatingReview::where('packet_id',$id)->get();
        foreach ($packetRatingReview as $key => $value) {
            packetRatingReviewFile::where('packet_rating_review_id',$value->id)->delete();
        }
        packetRatingReview::where('packet_id',$id)->delete();
        // delete packet_schedule_tours and packet_schedule_tour_details
        $packetScheduleTour = packetScheduleTour::where('packet_id',$id)->get();
        foreach ($packetScheduleTour as $key => $value) {
            packetScheduleTourDetail::where('packet_schedule_tour_id',$value->id)->delete();
        }
        packetScheduleTour::where('packet_id',$id)->delete();
        // delete packet tour detail
        $packetTourDetail = packetTourDetail::where('packet_id',$id)->get();
        foreach ($packetTourDetail as $key => $value) {
            $path = public_path('assets/images/iconTourPackages/');
            if ($value->file != null) {
                if (file_exists($path.$value->file))
                unlink($path.$value->file);
            }
        }
        // delete wishlist
        wishlist::where('packet_id',$id)->delete();
        // delete packet
        packet::whereId($id)->delete();
    }

    // upload image
    public function uploadImage(Request $request)
    {
        try {
            // validasi
            $validate = Validator::make($request->all(), [
                'file' => 'mimes:png,jpg,jpeg|max:40000',
            ]);
            if($validate->fails()) {
                // return new JsonResponse(['reason' => json_encode($validate->errors())], 400);
                return response()->json([json_encode($validate->errors())], 400);
            }
            // validate when packet id not found in form
            if ($request->packetId == null) return response()->json(['packet id tidak ditemukan, ulangin dari awal'], 400);
            // validate when images >= 5, if => 5 remove first and insert
            if (packetImage::where('packet_id',$request->packetId)->count() == 5) {
                $packetImageId = packetImage::select('id','name')->where('packet_id',$request->packetId)->orderBy('position','asc')->first();
                // lokasi image
                $path = public_path('assets/images/packagesGallery/');
                if ($packetImageId->name != null) {
                    if (file_exists($path.$packetImageId->name))
                        unlink($path.$packetImageId->name);
                }
                // delete
                packetImage::whereId($packetImageId->id)->delete();
                // update position
                $dataPacketImage = packetImage::where('packet_id',$request->packetId)->get();
                foreach ($dataPacketImage as $key => $value) {
                    packetImage::whereId($value->id)->update([
                        'position' => $value->position - 1
                    ]);
                }
            }

            if ($file = $request->file('file')) {
                $location = public_path('assets/images/packagesGallery');
                // if location not found create folder
                if(!file_exists($location)) {
                    mkdir($location);
                };
                $image = time() . str_replace(' ','-',$file->getClientOriginalName()); //change name
                Image::load($file)->save($location.'/'.$image);

                $fileImage = $image;
            }
            // create if first position
            if(packetImage::where('packet_id',$request->packetId)->count() < 1){
                $position = 1;
            } else {
                // check position in database
                $findPosition = packetImage::where('packet_id',$request->packetId)->orderBy('position','desc')->pluck('position')->first();
                $position = ++$findPosition;
            }
            packetImage::create([
                'packet_id' => $request->packetId,
                'name' => $fileImage,
                'file' => 'from upload',
                'type' => $file->getClientOriginalExtension() ?? '-',
                'position' => $position
            ]);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
    public function uploadIcon(Request $request)
    {
        try {
            if ($request->icon != null) {
                foreach ($request->icon as $key => $value) {
                    if ($value != 'null') {
                        // validasi
                        $validate = Validator::make($request->all(), [
                            'icon.'.$key => 'mimes:png,jpg,jpeg|max:40000|sometimes|nullable',
                        ]);

                        if($validate->fails()) {
                            return response()->json(['code' => 400,'message'=>'extension only jpg,png,jpeg and max file 40000'], 400);
                        }
                        $location = public_path('assets/images/iconTourPackages');
                        // if location not found create folder
                        if(!file_exists($location)) mkdir($location);
                        // check idpacetdetrail is null or not
                        if (isset($request->idPacketTourDetail[$key])) {
                            // find data
                            $imageDataOld = packetTourDetail::whereId($request->idPacketTourDetail[$key])->pluck('file')->first();
                            if (file_exists($location.'/'.$imageDataOld)) {
                                // delete image
                                unlink($location.'/'.$imageDataOld);
                                // save image when fileure found
                                $image = time() . str_replace(' ','-',$value->getClientOriginalName()); //change name
                                Image::load($value)->width(30)->height(30)->save($location.'/'.$image); // save image with resize
                            } else {
                                // save image when fileure not found
                                $image = time() . str_replace(' ','-',$value->getClientOriginalName()); //change name
                                Image::load($value)->width(30)->height(30)->save($location.'/'.$image); // save image with resize
                            }
                            packetTourDetail::whereId($request->idPacketTourDetail[$key])->update(['file' => $image]);
                        } else {
                            $image = time() . str_replace(' ','-',$value->getClientOriginalName()); //change name
                            Image::load($value)->width(30)->height(30)->save($location.'/'.$image); // save image with resize
                            // create
                            packetTourDetail::where('packet_id',$request->packetId ?? '1d08d534-172c-428b-b0e4-eaea216d8f77')->where('position',++$key)
                            ->update([
                                'file' => $image
                            ]);
                        }
                    }
                }
            }
            return response()->json(['packetId' => 'd3d322ea-e0f8-483d-926e-06b3bcbe6c57','code' => 200,'message'=>'success icon create'], 200);
        } catch (\Exception $th) {
            return response()->json(['code' => 500,'message'=> $th->getMessage()], 500);
        }
    }
}
