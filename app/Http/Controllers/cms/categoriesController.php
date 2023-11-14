<?php

namespace App\Http\Controllers\cms;

use App\Models\categories;
use Illuminate\Http\Request;
use App\Models\subCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = categories::with('subCategory')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action = '<a href="'.route('masterData.category.edit', $data->id).'?type=edit" class="btn-sm btn btn-warning"><i class="material-icons">mode_edit</i>Edit</a><br>';
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
                $url = asset('assets/images/category/'.$data->file);
                if ($data->file == null) {
                    $image = '<img src="../../assets/cms/images/noImage.jpg" alt="" style="width:100px !important">';
                } else {
                    $image = '<img src="'.$url.'" alt="" style="width:100px !important">';
                }
                return $image;
            })
            ->addColumn('subCategory', function($data) {
                if ($data->subCategory != null) {

                    $ul = '<ul>';
                        foreach ($data->subCategory as $key => $value) {
                            $ul .= '<li style="list-style:disclosure-closed">'.$value->name ?? '-'.'</li>';
                        };
                    $ul .= '</ul>';
                } else {
                    $ul = '';
                }
                // dd($ul);
                return $ul;
            })
            ->addColumn('created_at', function($data) {
                return ($data->created_at != null) ? date('d-M-Y, H:i', strtotime($data->created_at)) : '-';
            })
            ->rawColumns(['action','subCategory','status','created_at','file'])
            ->make(true);
        }
        return view('cms.pages.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.pages.category.form');
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
                'file' => 'mimes:png,jpg,jpeg|max:40000',
                'name' => 'required',
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            } 
            if ($file = $request->file('file')) {
                $location = public_path('assets/images/category');
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
            categories::create($data);
            return redirect()->route('masterData.category.index')->with('success','Data Saved Successfully');
        } catch (\Exception $th) {
            return redirect()->back()->with('failed', $th->getMessage())->withInput($request->except('_method','_token'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = categories::whereId($id)->first();
        return view('cms.pages.category.form',['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
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
            $category = categories::findOrFail($id);
            if ($file = $request->file('file')) {
                $lokasi = public_path('assets/images/category/');
                if ($category->file != null) {
                    if (file_exists($lokasi.$category->file)) {
                        // delete image 
                        unlink($lokasi.$category->file);
                        // save image when fileure found
                        $image = Image::make($file);
                        $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                        $image->save($lokasi.$nameImage);
                        $data['file'] = $nameImage;
                    } else {
                        // save image when fileure not found 
                       $lokasi = public_path('assets/images/category/');
                       $image = Image::make($file);
                       $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                       $image->save($lokasi.$nameImage);
                       $data['file'] = $nameImage;
                    }
                } else {
                    // save image when fileure null in database 
                    $lokasi = public_path('assets/images/category/');
                    $image = Image::make($file);
                    $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                    $image->save($lokasi.$nameImage);
                    $data['file'] = $nameImage;
                }
            }
            $data['updated_by'] = Auth::user()->name;
            categories::whereId($id)->update($data);
            return redirect()->back()->with('success','data updated successfully')->withInput($request->except(['_method','_token']));
        } catch (\Exception $th) {
            return redirect()->back()->with('failed',$th->getMessage())->withInput($request->except(['_method','_token']));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get data 
        $category = categories::with('subCategory')->whereId($id);
        // delete image subCategory 
        $lokasiSubCategory = public_path('assets/images/subCategory/');
        $categoryFirst = $category->first();
        if ($categoryFirst->subCategory != null) {
            foreach ($categoryFirst->subCategory as $key => $kategori) {
                if ($kategori->file != null) {
                    if (file_exists($lokasiSubCategory.$kategori->file)) {
                        unlink($lokasiSubCategory.$kategori->file);
                    }
                }
            }
        }
        // delete image 
        $lokasi = public_path('assets/images/category/');
        if ($category->pluck('file')->first() != null) {
            if (file_exists($lokasi.$category->pluck('file')->first())) {
                unlink($lokasi.$category->pluck('file')->first());
            }
        }
        // delete 
        subCategories::where('categories_id',$id)->delete();
        $category->delete();
        return redirect()->back()->with('success','data berhasil dihapus');
    }
}

