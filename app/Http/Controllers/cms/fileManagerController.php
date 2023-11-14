<?php

namespace App\Http\Controllers\cms;

use App\Models\fileManager;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class fileManagerController extends Controller
{
    public function index()
    {
        $recent = fileManager::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->take('10')->get();
        $size = fileManager::where('user_id',Auth::user()->id)->sum('size');
        $total = fileManager::where('user_id',Auth::user()->id)->count();

        return view('cms.pages.fileManager.index', [
            'recent' => $recent,
            'size' => $size,
            'total' => $total,
        ]);
    }

    public function create()
    {
        return view('cms.pages.fileManager.upload');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except(['_method','_token']);
            // validasi 
            $validate = Validator::make($request->all(), [
                'file' => 'mimes:png,jpg,jpeg|max:40000|required',
            ]);
            if($validate->fails()) {
                return response()->json(['message' => $validate->errors()], 500);
                // return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            } 
            
            if ($file = $request->file('file')) {
                $location = public_path('assets/images/fileGallery');
                // if location not found create folder 
                if(!file_exists($location)) {
                    mkdir($location);
                };
                $optimizeImage = Image::make($file);
                $image = time() . str_replace(' ','-',$file->getClientOriginalName());
                $optimizeImage->save($location.'/' . $image, 72);
                $data['file'] = $image;
            }
            $data['user_id'] = Auth::user()->id ?? '-';
            $data['type'] = $file->getClientOriginalExtension() ?? '-';
            $data['size'] = floor($file->getSize() / 1000);
            $data['resolution'] = $optimizeImage->width().' * '.$optimizeImage->height();
            $data['status'] = 1;

            // validate when position double 
            fileManager::create($data);
            return response()->json(['message' => 'berhasil'], 200);
            // return redirect()->route('websiteManagement.partner.index')->with('success','Data Saved Successfully');
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()], 500);
            // return redirect()->back()->with('failed', $th->getMessage())->withInput($request->except('_method','_token'));
        }
    }

    public function show($id)
    {
        $getAll = fileManager::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('cms.pages.fileManager.gallery', [
            'getAll' => $getAll
        ]);
    }

    public function destroy($id)
    {
        try {
            $find = fileManager::whereId($id); // cari data lama 
            // lokasi image 
            $path = public_path('assets/images/fileGallery/');
            if ($find->first()->file != null) {
                if (file_exists($path.$find->first()->file)) 
                    unlink($path.$find->first()->file);
            }
            // delete 
            $find->delete();
            // route json
            return response()->json(['message' => 'berhasil simpan'], 200);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
