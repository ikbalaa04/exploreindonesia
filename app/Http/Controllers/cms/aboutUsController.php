<?php

namespace App\Http\Controllers\cms;

use App\Models\aboutUs;
use App\Models\country;
use App\Models\achievement;
use App\Models\officeHours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class aboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = banners::with('bannerFile')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action = '<a href="'.route('websiteManagement.banner.edit', $data->id).'?type=edit" class="btn-sm btn btn-warning"><i class="material-icons">mode_edit</i>Edit</a><br>';
                $action .= '<button type="button" name="deletePermanent" id="'.$data->id.'" class="deletePermanent btn-sm btn btn-danger mt-1"><i class="material-icons">delete_outline</i>Remove</button>';
                return $action;
            })
            ->addColumn('title', function($data) {
                return $data->bannerFile->title ?? '-';
            })
            ->addColumn('subtitle', function($data) {
                return $data->bannerFile->subtitle ?? '-';
            })
            ->addColumn('description', function($data) {
                return $data->bannerFile->description ?? '-';
            })
            ->addColumn('cta_name', function($data) {
                return $data->bannerFile->cta_name ?? '-';
            })
            ->addColumn('cta_url', function($data) {
                return $data->bannerFile->cta_url ?? '-';
            })
            ->addColumn('type', function($data) {
                return $data->bannerFile->type ?? '-';
            })
            ->addColumn('banner_file', function($data) {
                $url = asset('assets/images/banner/'.$data->bannerFile->file_name);
                if ($data->bannerFile->file_name == null) {
                    $image = '<img src="../../assets/cms/images/noImage.jpg" alt="" style="width:100px !important">';
                } else {
                    $image = '<img src="'.$url.'" alt="" style="width:100px !important">';
                }
                return $image;
            })
            ->rawColumns(['action','banner_file','title','subtitle','description','cta_name','cta_url','type'])
            ->make(true);
        }
        return view('cms.pages.aboutUs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $countries = country::get();
        $officeHours = officeHours::get();
        $aboutUs = aboutUs::first();
        return view('cms.pages.aboutUs.form', [
            'countries' => $countries,
            'officeHours' => $officeHours,
            'aboutUs' => $aboutUs
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
            $data = $request->except(['_method','_token','pict']);
            $validate = Validator::make($request->all(), [
                'pict' => 'mimes:png,jpg,jpeg|max:40000',
                'logo' => 'mimes:png,jpg,jpeg|max:40000',
                'favicon' => 'mimes:png,jpg,jpeg|max:40000',
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            }
            // check about us is exists
            $check = aboutUs::first();
            if ($check == null) {
                // move pict to local folder
                if ($file = $request->file('pict')) {
                    $location = public_path('assets/images/aboutUs');
                    if(!file_exists($location)) {
                        mkdir($location);
                    };
                    $optimizeImage = Image::make($file);
                    $image = time() . str_replace(' ','-',$file->getClientOriginalName());
                    $optimizeImage->save($location.'/' . $image, 72);
                    $data['logo'] = $image;
                }
                if ($fileLogo = $request->file('logo')) {
                    $location = public_path('assets/images/aboutUs');
                    if(!file_exists($location)) {
                        mkdir($location);
                    };
                    $optimizeImage = Image::make($fileLogo);
                    $image = time() . str_replace(' ','-',$fileLogo->getClientOriginalName());
                    $optimizeImage->save($location.'/' . $image, 72);
                    $data['logo_white'] = $image;
                }
                if ($fileFavicon = $request->file('favicon')) {
                    $location = public_path('assets/images/aboutUs');
                    if(!file_exists($location)) {
                        mkdir($location);
                    };
                    $optimizeImage = Image::make($fileFavicon);
                    $image = time() . str_replace(' ','-',$fileFavicon->getClientOriginalName());
                    $optimizeImage->save($location.'/' . $image, 72);
                    $data['favicon'] = $image;
                }

                $data['created_by'] = Auth::user()->name ?? '-';
                aboutUs::create($data);
            } else {
                $aboutUs = aboutUs::findOrFail($check->id);
                // picture logo header
                if ($file = $request->file('pict')) {
                    $lokasi = public_path('assets/images/aboutUs/');
                    if ($aboutUs->logo != null) {
                        if (file_exists($lokasi.$aboutUs->logo)) {
                            // delete image
                            unlink($lokasi.$aboutUs->logo);
                            // save image
                            $image = Image::make($file);
                            $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                            $image->save($lokasi.$nameImage);
                            $data['logo'] = $nameImage;
                        } else {
                        $lokasi = public_path('assets/images/aboutUs/');
                        $image = Image::make($file);
                        $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                        $image->save($lokasi.$nameImage);
                        $data['logo'] = $nameImage;
                        }
                    } else {
                        $lokasi = public_path('assets/images/aboutUs/');
                        $image = Image::make($file);
                        $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                        $image->save($lokasi.$nameImage);
                        $data['logo'] = $nameImage;
                    }
                }
                // logo footer
                if ($fileLogo = $request->file('logo')) {
                    $lokasi = public_path('assets/images/aboutUs/');
                    if ($aboutUs->logo_white != null) {
                        if (file_exists($lokasi.$aboutUs->logo_white)) {
                            // delete image
                            unlink($lokasi.$aboutUs->logo_white);
                            // save image
                            $image = Image::make($fileLogo);
                            $nameImage = time().str_replace(' ','-',$fileLogo->getClientOriginalName());
                            $image->save($lokasi.$nameImage);
                            $data['logo_white'] = $nameImage;
                        } else {
                        $lokasi = public_path('assets/images/aboutUs/');
                        $image = Image::make($fileLogo);
                        $nameImage = time().str_replace(' ','-',$fileLogo->getClientOriginalName());
                        $image->save($lokasi.$nameImage);
                        $data['logo_white'] = $nameImage;
                        }
                    } else {
                        $lokasi = public_path('assets/images/aboutUs/');
                        $image = Image::make($fileLogo);
                        $nameImage = time().str_replace(' ','-',$fileLogo->getClientOriginalName());
                        $image->save($lokasi.$nameImage);
                        $data['logo_white'] = $nameImage;
                    }
                }
                // favicon company
                if ($fileFavicon = $request->file('favicon')) {
                    $lokasi = public_path('assets/images/aboutUs/');
                    if ($aboutUs->favicon != null) {
                        if (file_exists($lokasi.$aboutUs->favicon)) {
                            // delete image
                            unlink($lokasi.$aboutUs->favicon);
                            // save image
                            $image = Image::make($fileFavicon);
                            $nameImage = time().str_replace(' ','-',$fileFavicon->getClientOriginalName());
                            $image->save($lokasi.$nameImage);
                            $data['favicon'] = $nameImage;
                        } else {
                        $lokasi = public_path('assets/images/aboutUs/');
                        $image = Image::make($fileFavicon);
                        $nameImage = time().str_replace(' ','-',$fileFavicon->getClientOriginalName());
                        $image->save($lokasi.$nameImage);
                        $data['favicon'] = $nameImage;
                        }
                    } else {
                        $lokasi = public_path('assets/images/aboutUs/');
                        $image = Image::make($fileFavicon);
                        $nameImage = time().str_replace(' ','-',$fileFavicon->getClientOriginalName());
                        $image->save($lokasi.$nameImage);
                        $data['favicon'] = $nameImage;
                    }
                }

                $data['updated_by'] = Auth::user()->name;
                aboutUs::whereId($check->id)->update($data);
            }
            return redirect()->back()->with('success','Data Saved Successfully');
        } catch (\Exception $th) {
            return redirect()->back()->with('failed', $th->getMessage())->withInput($request->except('_method','_token'));
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
        $data = banners::whereId($id)->first();
        return view('cms.pages.aboutUs.form',['data' => $data]);
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
            $data = $request->except(['_method','_token','files']);

            // validasi
            $validate = Validator::make($request->all(), [
                'file_banner' => 'mimes:png,jpg,jpeg',
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            }
            // data
            $banner = banners::with('bannerFile')->findOrFail($id);

            if ($file = $request->file('file_banner')) {
                $lokasi = public_path('assets/images/banner/');
                if ($banner->bannerFile->file_name != null) {
                    if (file_exists($lokasi.$banner->bannerFile->file_name)) {
                        // delete image
                        unlink($lokasi.$banner->bannerFile->file_name);
                        // save image when picture found
                        $image = time() . str_replace(' ','-',$file->getClientOriginalName()); //change name
                        Image::load($file)->width(1440)->height(857)->save($lokasi.'/'.$image); // save image with resize

                        $data['file'] = $image;
                    } else {
                        // save image when picture not found
                       $lokasi = public_path('assets/images/banner/');
                       $image = time() . str_replace(' ','-',$file->getClientOriginalName()); //change name
                       Image::load($file)->width(1440)->height(857)->save($lokasi.'/'.$image); // save image with resize
                       $data['file_banner'] = $image;
                    }
                } else {
                    // save image when picture null in database
                    $lokasi = public_path('assets/images/banner/');
                    $image = time() . str_replace(' ','-',$file->getClientOriginalName()); //change name
                    Image::load($file)->width(1440)->height(857)->save($lokasi.'/'.$image); // save image with resize
                    $data['file_banner'] = $image;
                }
            }
            $data['updated_by'] = Auth::user()->name;

            banners::whereId($id)->update([
                'white_label' => $data['white_label'],
                'updated_by' => $data['updated_by'],
            ]);
            bannerFile::where('banner_id',$banner->id)->update([
                'file_name' => $data['file_banner'] ?? $banner->bannerFile->file_name,
                'cta_name' => $data['cta_name'],
                'cta_url' => $data['cta_url'],
                'title' => $data['title'],
                'subtitle' => $data['subtitle'],
                'description' => $data['description'],
            ]);
            return redirect()->back()->with('success','data updated successfully')->withInput($request->except(['_method','_token']));
        } catch (\Exception $th) {
            return redirect()->back()->with('failed',$th->getMessage())->withInput($request->except(['_method','_token']));
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
        $banner = banners::with('bannerFile')->whereId($id);
        // delete image
        $lokasi = public_path('assets/images/banner/');
        if ($banner->first()->bannerFile->file_name != null) {
            if (file_exists($lokasi.$banner->first()->bannerFile->file_name)) {
                unlink($lokasi.$banner->first()->bannerFile->file_name);
            }
        }
        // delete
        $banner->delete();
        bannerFile::where('banner_id',$id)->delete();
        return redirect()->back()->with('success','data berhasil dihapus');
    }
}
