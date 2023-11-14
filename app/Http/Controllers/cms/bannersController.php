<?php

namespace App\Http\Controllers\cms;

use App\Models\banners;
use Spatie\Image\Image;
use App\Models\bannerFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class bannersController extends Controller
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
        return view('cms.pages.banners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.pages.banners.form');
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
            // validasi 
            $validate = Validator::make($request->all(), [
                'file_banner' => 'mimes:png,jpg,jpeg|max:40000|required',
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            } 
           
            if ($file = $request->file('file_banner')) {
                $location = public_path('assets/images/banner');
                // if location not found create folder 
                if(!file_exists($location)) {
                    mkdir($location);
                };
                $image = time() . str_replace(' ','-',$file->getClientOriginalName()); //change name
                Image::load($file)->width(1440)->height(857)->save($location.'/'.$image); // save image with resize
            }
            $data['type'] = 'image';
            $data['status'] = 1;
            $data['created_by'] = Auth::user()->name ?? '-';
            $data['updated_by'] = Auth::user()->name ?? '-';
            // validate when position double 
            $banner = banners::create([
                'white_label' => $data['white_label'],
                'status' => $data['status'],
                'created_by' => $data['created_by'],
                'updated_by' => $data['updated_by'],
            ]);
            bannerFile::create([
                'banner_id' => $banner->id,
                'file_name' => $image,
                'type' => $data['type'],
                'cta_name' => $data['cta_name'],
                'cta_url' => $data['cta_url'],
                'title' => $data['title'],
                'subtitle' => $data['subtitle'],
                'description' => $data['description'],
            ]);

            return redirect()->route('websiteManagement.banner.index')->with('success','Data Saved Successfully');
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
        return view('cms.pages.banners.form',['data' => $data]);
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
