<?php

namespace App\Http\Controllers\cms;

use App\Models\aboutUs;
use Spatie\Image\Image;
use Illuminate\Http\Request;
use App\Models\companyMembers;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class companyMembersController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = companyMembers::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action = '<button type="button" name="editCompanyMember" id="'.$data->id.'" class="editCompanyMember btn-sm btn btn-warning mt-1"><i class="material-icons">mode_edit</i>Edit</button>';
                $action .= '<button type="button" name="deleteCompanyMember" id="'.$data->id.'" class="deleteCompanyMember btn-sm btn btn-danger ms-1 mt-1"><i class="material-icons">delete_outline</i>Remove</button>';
                return $action;
            })
            ->addColumn('name', function($data) {
                return $data->first_name.' '.$data->last_name;
            })
            ->addColumn('photo', function($data) {
                $url = asset('assets/images/companyMembers/'.$data->file);
                if ($data->file == null) {
                    $image = '<img data-fslightbox="gallery" src="../../assets/cms/images/noImage.jpg" alt="" style="width:100px !important">';
                } else {
                    $image = '<a data-fslightbox="gallery" href="'.$url.'"><img src="'.$url.'" alt="" style="width:100px !important"></a>';
                }
                return $image;
            })
            ->rawColumns(['action','name','photo'])
            ->make(true);
        }
    }
    public function show($id)
    {
        $data = companyMembers::whereId($id)->first();
        ($data != null) ?
            $response = response()->json(['message' => 'berhasil didapatkan data','data' => $data], 200)
            :
            $response = response()->json(['message' => 'data tidak ditemukan',], 404);
        return $response;
    }
    public function store(Request $request)
    {
        try {
            $data = $request->except(['_method','_token','photo','typeMember']);
            // validasi 
            $validate = Validator::make($request->all(), [
                'photo' => 'mimes:png,jpg,jpeg|max:40000|required',
                'email' => 'required',
                'mobile_phone' => 'required',
            ]);
            if($validate->fails()) {
                return response()->json(['message' => json_encode($validate->errors())], 404);
            } 
            if ($file = $request->file('photo')) {
                $location = public_path('assets/images/companyMembers');
                // if location not found create folder 
                if(!file_exists($location)) {
                    mkdir($location);
                };
                $image = time() . str_replace(' ','-',$file->getClientOriginalName()); //change name
                Image::load($file)->width(200)->height(200)->save($location.'/'.$image); // save image with resize
                $data['file'] = $image;
            }
            // get about us id  
            $data['about_us_id'] = aboutUs::pluck('id')->first() ?? '1';
            // save 
            companyMembers::create($data);
            return response()->json(['message' => 'berhasil simpan'], 200);
        } catch (\Exception $th) {
           return response()->json(['message' => $th->getMessage()], 500);
        } 
    }
    public function update(Request $request, $id)
    {
        try {
            $data = $request->except(['_method','_token','photo','typeMember']);
            // validasi 
            $validate = Validator::make($request->all(), [
                'photo' => 'mimes:png,jpg,jpeg|max:40000',
                'email' => 'required',
                'mobile_phone' => 'required',
            ]);
            if($validate->fails()) {
                return response()->json(['message' => json_encode($validate->errors())], 404);
            } 
            // data old in database
            $imageMember = companyMembers::findOrFail($id);
            if ($file = $request->file('photo')) {
                $lokasi = public_path('assets/images/companyMembers/');
                if ($imageMember->file != null) {
                    if (file_exists($lokasi.$imageMember->file)) {
                        // delete image 
                        unlink($lokasi.$imageMember->file);
                        // save image when picture found
                        $image = time() . str_replace(' ','-',$file->getClientOriginalName()); //change name
                        Image::load($file)->width(200)->height(200)->save($lokasi.'/'.$image); // save image with resize
                        $data['file'] = $image;
                    } else {
                        // save image when picture not found 
                       $lokasi = public_path('assets/images/companyMembers/');
                       $image = time() . str_replace(' ','-',$file->getClientOriginalName()); //change name
                       Image::load($file)->width(200)->height(200)->save($lokasi.'/'.$image); // save image with resize
                       $data['file'] = $image;
                    }
                } else {
                    // save image when picture null in database 
                    $lokasi = public_path('assets/images/companyMembers/');
                    $image = time() . str_replace(' ','-',$file->getClientOriginalName()); //change name
                    Image::load($file)->width(200)->height(200)->save($lokasi.'/'.$image); // save image with resize
                    $data['file'] = $image;
                }
            }
            // update 
            companyMembers::whereId($id)->update($data);
            return response()->json(['message' => 'berhasil simpan'], 200);
        } catch (\Exception $th) {
           return response()->json(['message' => $th->getMessage()], 500);
        } 
    }
    public function destroy($id)
    {
        try {
            // data old in database
            $imageMember = companyMembers::whereId($id);
            // delete image 
            $lokasi = public_path('assets/images/companyMembers/');
            if ($imageMember->first()->file != null) {
                if (file_exists($lokasi.$imageMember->first()->file)) {
                    unlink($lokasi.$imageMember->first()->file);
                }
            }
            // delete 
            $imageMember->delete();
            companyMembers::whereId($id)->delete();
            return response()->json(['message' => 'berhasil'], 200);
        } catch (\Exception $th) {
           return response()->json(['message' => $th->getMessage()], 500);
        } 
    }

}
