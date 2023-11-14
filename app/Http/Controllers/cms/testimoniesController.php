<?php

namespace App\Http\Controllers\cms;

use App\Models\testimonies;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class testimoniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = testimonies::orderBy('position','asc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action = '<a href="'.route('websiteManagement.testimony.edit', $data->id).'?type=edit" class="btn-sm btn btn-warning"><i class="material-icons">mode_edit</i>Edit</a><br>';
                $action .= '<button type="button" name="deletePermanent" id="'.$data->id.'" class="deletePermanent btn-sm btn btn-danger mt-1"><i class="material-icons">delete_outline</i>Remove</button>';
                return $action;
            })
            ->addColumn('status', function($data) {
                if ($data->status == '1') {
                    $badge = '<span class="text-success">Active</span>';
                } else {
                    $badge = '<span class="text-danger">Not Active</span>';
                }
                return $badge;
            })
            ->addColumn('file', function($data) {
                $url = asset('assets/images/testimony/'.$data->file);
                if ($data->file == null) {
                    $image = '<img src="../../assets/cms/images/noImage.jpg" alt="" style="width:100px !important">';
                } else {
                    $image = '<img src="'.$url.'" alt="" style="width:100px !important">';
                }
                return $image;
            })
            ->addColumn('description', function($data) {
                return '<div>'.substr($data->description,0,15).'...</div>';
            })
            ->rawColumns(['action','status','file','description'])
            ->make(true);
        }
        return view('cms.pages.testimonies.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.pages.testimonies.form');
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
                'file' => 'mimes:png,jpg,jpeg|max:40000|required',
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            } 
            // create if first position 
            if(testimonies::count() < 1){
                $data['position'] = 1;
            } else {
                // check position in database 
                $findPosition = testimonies::orderBy('position','desc')->pluck('position')->first();
                $data['position'] = ++$findPosition;
            }
            if ($file = $request->file('file')) {
                $location = public_path('assets/images/testimony');
                // if location not found create folder 
                if(!file_exists($location)) {
                    mkdir($location);
                };
                $optimizeImage = Image::make($file);
                $image = time() . str_replace(' ','-',$file->getClientOriginalName());
                $optimizeImage->save($location.'/' . $image, 72);
                $data['file'] = $image;
            }
            $data['status'] = 1;
            $data['created_by'] = Auth::user()->name ?? '-';
            $data['updated_by'] = Auth::user()->name ?? '-';
            // validate when position double 
            testimonies::create($data);
            return redirect()->route('websiteManagement.testimony.index')->with('success','Data Saved Successfully');
        } catch (\Exception $th) {
            return redirect()->back()->with('failed', $th->getMessage())->withInput($request->except('_method','_token'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = testimonies::whereId($id)->first();
        return view('cms.pages.testimonies.form',['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->except(['_method','_token','files']);
            // validasi 
            $validate = Validator::make($request->all(), [
                'file' => 'mimes:png,jpg,jpeg',
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            }
            // data 
            $testimony = testimonies::findOrFail($id);
           
            if ($file = $request->file('file')) {
                $lokasi = public_path('assets/images/testimony/');
                if ($testimony->file != null) {
                    if (file_exists($lokasi.$testimony->file)) {
                        // delete image 
                        unlink($lokasi.$testimony->file);
                        // save image when fileure found
                        $image = Image::make($file);
                        $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                        $image->save($lokasi.$nameImage);
                        $data['file'] = $nameImage;
                    } else {
                        // save image when fileure not found 
                       $lokasi = public_path('assets/images/testimony/');
                       $image = Image::make($file);
                       $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                       $image->save($lokasi.$nameImage);
                       $data['file'] = $nameImage;
                    }
                } else {
                    // save image when fileure null in database 
                    $lokasi = public_path('assets/images/testimony/');
                    $image = Image::make($file);
                    $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                    $image->save($lokasi.$nameImage);
                    $data['file'] = $nameImage;
                }
            }
            $data['updated_by'] = Auth::user()->name;
            testimonies::whereId($id)->update($data);
            return redirect()->back()->with('success','data updated successfully')->withInput($request->except(['_method','_token']));
        } catch (\Exception $th) {
            return redirect()->back()->with('failed',$th->getMessage())->withInput($request->except(['_method','_token']));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\testimony  $testimony
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimony = testimonies::whereId($id);
        // delete image 
        $lokasi = public_path('assets/images/testimony/');
        if ($testimony->pluck('file')->first() != null) {
            if (file_exists($lokasi.$testimony->pluck('file')->first())) {
                unlink($lokasi.$testimony->pluck('file')->first());
            }
        }
        // delete 
        $testimony->delete();
        return redirect()->back()->with('success','data berhasil dihapus');
    }
}
