<?php

namespace App\Http\Controllers\cms;

use App\Models\User;
use App\Models\partners;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class partnersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = partners::with('members')->orderBy('position','asc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action = '<a href="'.route('websiteManagement.partner.edit', $data->id).'?type=edit" class="btn-sm btn btn-warning"><i class="material-icons">mode_edit</i>Edit</a><br>';
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
            ->addColumn('member', function($data) {
                $mem = [];
                foreach ($data->members as $key => $value) {
                    $mem[] = $value->name;
                }
                return implode(',',$mem);
            })
            ->addColumn('file', function($data) {
                $url = asset('assets/images/partner/'.$data->file);
                if ($data->file == null) {
                    $image = '<img src="../../assets/cms/images/noImage.jpg" alt="" style="width:100px !important">';
                } else {
                    $image = '<img src="'.$url.'" alt="" style="width:100px !important">';
                }
                return $image;
            })

            ->rawColumns(['action','status','member','file'])
            ->make(true);
        }
        return view('cms.pages.partners.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = User::whereNull('partner_id')->where('status',1)->get();
        return view('cms.pages.partners.form', [
            'members' => $members
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
            $data = $request->except(['_method','_token','member']);
            // validasi
            $validate = Validator::make($request->all(), [
                'file' => 'mimes:png,jpg,jpeg|max:40000|required',
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            }
            // create if first position
            if(partners::count() < 1){
                $data['position'] = 1;
            } else {
                // check position in database
                $findPosition = partners::orderBy('position','desc')->pluck('position')->first();
                $data['position'] = ++$findPosition;
            }
            if ($file = $request->file('file')) {
                $location = public_path('assets/images/partner');
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
            $partner = partners::create($data);
            // assign partner id to member/user
            if ($request->member != null) {
                foreach ($request->member as $key => $value) {
                    $userCheck = User::where('email',$value);
                    if ($userCheck->pluck('user_type')->first() == 'admin') {
                        $userCheck->update(['partner_id' => $partner->id]);
                    } else {
                        $userCheck->update(['partner_id' => $partner->id,'user_type' => 'partner']);
                    }
                    // User::where('email',$value)->where('user_type','!=','admin')->update(['partner_id' => $partner->id]);
                }
            }
            return redirect()->route('websiteManagement.partner.index')->with('success','Data Saved Successfully');
        } catch (\Exception $th) {
            return redirect()->back()->with('failed', $th->getMessage())->withInput($request->except('_method','_token'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = partners::whereId($id)->first();
        $members = User::where('status',1)->get();
        $memberInLine = User::where('partner_id',$id)->get();
        return view('cms.pages.partners.form',[
            'data' => $data,
            'memberInLine' => $memberInLine,
            'members' => $members
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->except(['_method','_token','files','member']);
            // validasi
            $validate = Validator::make($request->all(), [
                'file' => 'mimes:png,jpg,jpeg',
            ]);
            if($validate->fails()) {
                return redirect()->back()->with('failed', $validate->errors())->withInput($request->all());
            }
            // data
            $partner = partners::findOrFail($id);
            // remove relations user become user standar
            $user = User::where('partner_id',$id)->get();
            foreach ($user as $item) {
                ($item->user_type == 'admin') ? User::where('partner_id',$id)->update(['partner_id' => null]) : User::where('partner_id',$id)->update(['partner_id' => null, 'user_type' => 'customer']);
            }
            if ($file = $request->file('file')) {
                $lokasi = public_path('assets/images/partner/');
                if ($partner->file != null) {
                    if (file_exists($lokasi.$partner->file)) {
                        // delete image
                        unlink($lokasi.$partner->file);
                        // save image when fileure found
                        $image = Image::make($file);
                        $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                        $image->save($lokasi.$nameImage);
                        $data['file'] = $nameImage;
                    } else {
                        // save image when fileure not found
                       $lokasi = public_path('assets/images/partner/');
                       $image = Image::make($file);
                       $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                       $image->save($lokasi.$nameImage);
                       $data['file'] = $nameImage;
                    }
                } else {
                    // save image when fileure null in database
                    $lokasi = public_path('assets/images/partner/');
                    $image = Image::make($file);
                    $nameImage = time().str_replace(' ','-',$file->getClientOriginalName());
                    $image->save($lokasi.$nameImage);
                    $data['file'] = $nameImage;
                }
            }
            // assign partner id to member/user
            if ($request->member != null) {
                foreach ($request->member as $key => $value) {
                    $userCheck = User::where('email',$value);
                    if ($userCheck->pluck('user_type')->first() == 'admin') {
                        $userCheck->update(['partner_id' => $id]);
                    } else {
                        $userCheck->update(['partner_id' => $id,'user_type' => 'partner']);
                    }
                    // User::where('email',$value)->update(['partner_id' => $id]);
                }
            }
            $data['updated_by'] = Auth::user()->name;
            partners::whereId($id)->update($data);
            return redirect()->back()->with('success','data updated successfully')->withInput($request->except(['_method','_token']));
        } catch (\Exception $th) {
            return redirect()->back()->with('failed',$th->getMessage())->withInput($request->except(['_method','_token']));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\partner  $partner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = partners::whereId($id);
        User::where('partner_id',$id)->update(['partner_id' => null]);
        // delete image
        $lokasi = public_path('assets/images/partner/');
        if ($partner->pluck('file')->first() != null) {
            if (file_exists($lokasi.$partner->pluck('file')->first())) {
                unlink($lokasi.$partner->pluck('file')->first());
            }
        }
        // delete
        $partner->delete();
        return redirect()->back()->with('success','data berhasil dihapus');
    }
}
