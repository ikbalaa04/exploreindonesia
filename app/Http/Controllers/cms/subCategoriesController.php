<?php

namespace App\Http\Controllers\cms;

use App\Models\categories;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\subCategories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class subCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = subCategories::with('category')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action = '<a href="'.route('masterData.sub-category.edit', $data->id).'?type=edit" class="btn-sm btn btn-warning"><i class="material-icons">mode_edit</i>Edit</a><br>';
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
                $url = asset('assets/images/subCategory/'.$data->file);
                if ($data->file == null) {
                    $image = '<img src="../../assets/cms/images/noImage.jpg" alt="" style="width:100px !important">';
                } else {
                    $image = '<img src="'.$url.'" alt="" style="width:100px !important">';
                }
                return $image;
            })
            ->addColumn('category', function($data) {
                return ($data->category->name != null) ? $data->category->name : '-';
            })
            ->addColumn('description', function($data) {
                return substr($data->description,0,25).'...';
            })
            ->addColumn('detail', function($data) {
                return substr($data->detail,0,25).'...';
            })
            ->addColumn('created_at', function($data) {
                return ($data->created_at != null) ? date('d-M-Y, H:i', strtotime($data->created_at)) : '-';
            })
            ->rawColumns(['action','category','status','created_at','file','description','detail'])
            ->make(true);
        }
        return view('cms.pages.subCategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = categories::get();
        return view('cms.pages.subCategory.form',[
            'category' => $category
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
            // validasi 
            $validate = Validator::make($request->all(), [
                'file' => 'mimes:png,jpg,jpeg|max:40000',
                'brosur' => 'mimes:pdf|max:2048',
                'name' => 'required',
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            } 
            if ($file = $request->file('file')) {
                $location = public_path('assets/images/subCategory');
                // if location not found create folder 
                if(!file_exists($location)) {
                    mkdir($location);
                };
                $optimizeImage = Image::make($file);
                $image = time() . str_replace(' ','-',$file->getClientOriginalName());
                $optimizeImage->save($location.'/' . $image, 72);
                $data['file'] = $image;
            }
            if ($pdffile = $request->file('brosur')) {
                $location = public_path('assets/images/subCategory/file');
                // if location not found create folder 
                if(!file_exists($location)) {
                    mkdir($location);
                };
                $fileName = time().'.'.$request->brosur->extension();  
                $request->brosur->move($location, $fileName);
                $data['brosur'] = $fileName;
            }
            $data['slug'] = Str::slug($data['name']);
            $data['created_by'] = Auth::user()->name ?? '-';
            $data['updated_by'] = Auth::user()->name ?? '-';
            subCategories::create($data);
            return redirect()->route('masterData.sub-category.index')->with('success','Data Saved Successfully');
        } catch (\Exception $th) {
            return redirect()->back()->with('failed', $th->getMessage())->withInput($request->except('_method','_token'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = subCategories::whereId($id)->first();
        $category = categories::get();
        return view('cms.pages.subCategory.form',['data' => $data,'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->except(['_method','_token','files']);
            // validasi 
            $validate = Validator::make($request->all(), [
                'file' => 'mimes:png,jpg,jpeg',
                'brosur' => 'mimes:pdf|max:2048',
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            } 
            $subCategory = subCategories::findOrFail($id);
            if ($file = $request->file('file')) {
                $lokasi = public_path('assets/images/subCategory/');
                if ($subCategory->file != null) {
                    if (file_exists($lokasi.$subCategory->file)) {
                        // delete image 
                        unlink($lokasi.$subCategory->file);
                        // save image when fileure found
                        $image = Image::make($file);
                        $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                        $image->save($lokasi.$nameImage);
                        $data['file'] = $nameImage;
                    } else {
                        // save image when fileure not found 
                       $lokasi = public_path('assets/images/subCategory/');
                       $image = Image::make($file);
                       $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                       $image->save($lokasi.$nameImage);
                       $data['file'] = $nameImage;
                    }
                } else {
                    // save image when fileure null in database 
                    $lokasi = public_path('assets/images/subCategory/');
                    $image = Image::make($file);
                    $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                    $image->save($lokasi.$nameImage);
                    $data['file'] = $nameImage;
                }
            }
            if ($pdffile = $request->file('brosur')) {
                $location = public_path('assets/images/subCategory/file');
                if ($subCategory->brosur != null) {
                    if (file_exists($location.'/'.$subCategory->brosur)) {
                        // delete brosur 
                        unlink($location.'/'.$subCategory->brosur);
                        // save brosur when brosur found
                        $fileName = time().'.'.$request->brosur->extension();  
                        $request->brosur->move($location, $fileName);
                        $data['brosur'] = $fileName;
                    } else {
                        // save brosur when brosur not found 
                        $location = public_path('assets/images/subCategory/file');
                        $fileName = time().'.'.$request->brosur->extension();  
                        $request->brosur->move($location, $fileName);
                        $data['brosur'] = $fileName;
                    }
                } else {
                    // save brosur when brosur not found 
                    $location = public_path('assets/images/subCategory/file');
                    $fileName = time().'.'.$request->brosur->extension();  
                    $request->brosur->move($location, $fileName);
                    $data['brosur'] = $fileName;
                }
            }
            $data['slug'] = Str::slug($data['name']);
            $data['updated_by'] = Auth::user()->name;
            subCategories::whereId($id)->update($data);
            return redirect()->back()->with('success','data updated successfully')->withInput($request->except(['_method','_token']));
        } catch (\Exception $th) {
            return redirect()->back()->with('failed',$th->getMessage())->withInput($request->except(['_method','_token']));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subCategory  $subCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // get data 
        $subCategory = subCategories::whereId($id);
        // delete image 
        $lokasi = public_path('assets/images/subCategory/');
        if ($subCategory->pluck('file')->first() != null) {
            if (file_exists($lokasi.$subCategory->pluck('file')->first())) {
                unlink($lokasi.$subCategory->pluck('file')->first());
            }
        }
        if ($subCategory->pluck('brosur')->first() != null) {
            if (file_exists($lokasi.'/file/'.$subCategory->pluck('brosur')->first())) {
                unlink($lokasi.'/file/'.$subCategory->pluck('brosur')->first());
            }
        }
        $subCategory->delete();
        return redirect()->back()->with('success','data berhasil dihapus');
    }
}
