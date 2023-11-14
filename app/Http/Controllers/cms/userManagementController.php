<?php

namespace App\Http\Controllers\cms;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class userManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('user_type','admin')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action = '<a href="'.route('userManagement.edit', $data->id).'?type=edit" class="btn-sm btn btn-warning"><i class="material-icons">mode_edit</i>Edit</a><br>';
                if ($data->status == 1) {
                    $action .= '<button type="button" name="delete" id="'.$data->id.'"class="delete btn-sm btn btn-danger mt-1"><i class="material-icons">delete_outline</i>Disabled</button>';
                } else {
                    $action .= '<button type="button" name="aktif" id="'.$data->id.'" class="aktif btn-sm btn btn-success mt-1"><i class="material-icons">check</i>Active</button>';
                }
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
            ->addColumn('gender', function($data) {
                return ($data->gender == 1 ) ? 'Laki-Laki' : 'perempuan';
            })
            ->addColumn('birth_date', function($data) {
                return ($data->birth_date != null) ? date('d M Y', strtotime($data->birth_date)) : '-';
            })
            ->addColumn('file', function($data) {
                $url = asset('assets/images/user/'.$data->file);
                if ($data->file == null) {
                    $image = '<img src="../../assets/cms/images/noImage.jpg" alt="" style="width:100px !important">';
                } else {
                    $image = '<img src="'.$url.'" alt="" style="width:50px!important;height: 50px !important;border-radius:50% !important">';
                }
                return $image;
            })
            ->rawColumns(['action','status','gender','birth_date','file'])
            ->make(true);
        }
        return view('cms.pages.userManagement.admin.index');
    }
    public function customer(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('user_type','customer')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action = '<a href="'.route('dashboard.profile', $data->id).'?type=edit" class="btn-sm btn btn-warning"><i class="material-icons">mode_edit</i>Edit</a><br>';
                if ($data->status == 1) {
                    $action .= '<button type="button" name="delete" id="'.$data->id.'"class="delete btn-sm btn btn-danger mt-1"><i class="material-icons">delete_outline</i>Disabled</button>';
                } else {
                    $action .= '<button type="button" name="aktif" id="'.$data->id.'" class="aktif btn-sm btn btn-success mt-1"><i class="material-icons">check</i>Active</button>';
                }
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
            ->addColumn('gender', function($data) {
                return ($data->gender == 1 ) ? 'Laki-Laki' : 'perempuan';
            })
            ->addColumn('birth_date', function($data) {
                return ($data->birth_date != null) ? date('d M Y', strtotime($data->birth_date)) : '-';
            })
            ->addColumn('file', function($data) {
                $url = asset('assets/images/user/'.$data->file);
                if ($data->file == null) {
                    $image = '<span class="iconify" data-icon="akar-icons:image" data-width="30" data-height="30"></span>';
                } else {
                    $image = '<img src="'.$url.'" alt="" style="width:100px !important">';
                }
                return $image;
            })
            ->rawColumns(['action','status','birth_date','file'])
            ->make(true);
        }
        return view('cms.pages.userManagement.customer.index');
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.pages.userManagement.admin.form');
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
            $validate = Validator::make($request->all(), [
                'file' => 'mimes:png,jpg,jpeg|max:40000',
                'email' => 'unique:users|email|required',
                'name' => 'required',
                'password' => 'required'
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            } 
            if ($file = $request->file('file')) {
                $location = public_path('assets/images/user');
                if(!file_exists($location)) {
                    mkdir($location);
                };
                $optimizeImage = Image::make($file);
                $image = time() . str_replace(' ','-',$file->getClientOriginalName());
                $optimizeImage->save($location.'/' . $image, 72);
                $data['file'] = $image;
            }
            $data['password'] = bcrypt($request->password);
            
            User::create($data);
            return redirect()->back()->with('success', 'User berhasil dibuat');
        } catch (\Exception $th) {
            return redirect()->back()->with('failed', $th->getMessage())->withInput($request->except('_method','_token'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::whereId($id)->first();
        return view('cms.pages.userManagement.admin.form')->with([
            'data' => $data,
            'message' => 'Edit User'
        ]);
    }
    public function profile(Request $request,$id)
    {
        $data = User::whereId($id)->first();
        return view('cms.pages.userManagement.admin.form')->with([
            'data' => $data,
            'message' => 'User Profile'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->except(['_method','_token']);
            $validate = Validator::make($request->all(), [
                'image' => 'mimes:png,jpg,jpeg',
                'file' => 'max:40000',
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            } 
            $user = User::findOrFail($id);
            if ($file = $request->file('file')) {
                $lokasi = public_path('assets/images/user/');
                if ($user->file != null) {
                    if (file_exists($lokasi.$user->file)) {
                        // delete image 
                        unlink($lokasi.$user->file);
                        // save image 
                        $image = Image::make($file);
                        $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                        $image->save($lokasi.$nameImage);
                        $data['file'] = $nameImage;
                    } else {
                       $lokasi = public_path('assets/images/user/');
                       $image = Image::make($file);
                       $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                       $image->save($lokasi.$nameImage);
                       $data['file'] = $nameImage;
                    }
                } else {
                    $lokasi = public_path('assets/images/user/');
                    $image = Image::make($file);
                    $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                    $image->save($lokasi.$nameImage);
                    $data['file'] = $nameImage;
                }
            }
            if ($request->filled('password')) {
                $data['password'] = bcrypt($request->password);
            } else {
                $data['password'] = $user->password;
            }
            User::whereId($id)->update($data);
            return redirect()->back()->with('success','user berhasil diupdate')->withInput($request->except(['_method','_token']));
        } catch (\Exception $th) {
            return redirect()->back()->with('failed',$th->getMessage())->withInput($request->except(['_method','_token']));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $softDeletes = User::whereId($id)->update([
            'status' => 0,
            'updated_at' => Carbon::now()
        ]);
    }
    public function active($id)
    {
        $softDeletes = User::whereId($id)->update([
            'status' => 1,
            'updated_at' => Carbon::now()
        ]);
    }

    // response json count customer      
    public function userCount()
    {
        try {
            // count 
            $count = User::where('user_type','customer')->count();
            return response()->json(['data' => $count], 200);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
