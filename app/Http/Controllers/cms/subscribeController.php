<?php

namespace App\Http\Controllers\cms;

use App\Models\subscribes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class subscribeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = subscribes::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                if ($data->status == '1') {
                    $action = '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-sm btn-outline-danger "><i class="fa fa-times"> Unsucribe</i></button>';
                } else {
                    $action = '<button type="button" name="active" id="'.$data->id.'" class="active btn btn-sm btn-outline-success text-white"><i class="fa fa-check"> Subscribe</i></button>';
                }
                return $action;
            })
            ->addColumn('status', function($data) {
                if ($data->status == '1') {
                    $badge = '<span class="iconify text-success" data-icon="akar-icons:circle-check" data-width="30" data-height="30"></span> Subscribe';
                } else {
                    $badge = '<span class="iconify text-danger" data-icon="clarity:times-circle-line" data-width="30" data-height="30"></span>Unsucribe';
                }
                return $badge;
            })
            ->addColumn('email', function($data) {
                $mail = $data->email ?? '' ;
                return '<a class="text-info" href="mailto:'.$mail.'">'.$mail.'</a>';
            })
            
            ->rawColumns(['action','status','email'])
            ->make(true);
        }
        $templateEmail = templateEmail::where('status',1)->get();
        return view('cms.pages.subscribe.index',[
            'templateEmail' => $templateEmail
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except(['_method','_token']);
            // validasi 
            if (subscribes::where('email',$data['email'])->exists()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Duplicate Email'
                ], 500);
            } else {
                $userId = User::where('email',$data['email'])->pluck('id')->first();
                $data['user_id'] = $userId ?? null;
                subscribes::create($data);
                return response()->json([
                    'status' => true,
                    'message' => 'Data Saved Successfully'
                ], 200);
            }
        } catch (\Exception $th) {
            return redirect()->back()->with('failed', $th->getMessage())->withInput($request->except('_method','_token'));
        }
    }

    public function sendEmail(Request $request)
    {
        try {
            $data = $request->except(['_method','_token']);
        
            $descrption = templateEmail::whereId($data['templateId'])->pluck('description')->first();
            $subscribe = subscribes::where('status',1)->select('email','count_send_email')->get();
            foreach ($subscribe as $key => $item) {
                Mail::to($item['email'])->send(New sendToSubscribeMail($descrption));
                // update subsrcribe 
                subscribes::where('email',$item['email'])->update([
                    'count_send_email' => (int)$item['count_send_email'] + 1 ?? 1,
                    'last_send_email' => Carbon::now()
                ]);
            }
            return redirect()->back()->with('success','All Email Has Send');
        } catch (\Exception $th) {
            dd($th->getMessage());
        }
    }

    public function unscribe($id)
    {
        try {
            subscribes::whereId($id)->update([
                'status' => 0
            ]);
        } catch (\Exception $th) {
            dd($th->getMessage());
        }
    }
    public function subscribe($id)
    {
        try {
            subscribes::whereId($id)->update([
                'status' => 1
            ]);
        } catch (\Exception $th) {
            dd($th->getMessage());
        }
    }
    public function subscribeEmail(Request $request)
    {
        try {
            $userId = ($request->useId == "0") ? null : $request->useId;
            $validate = Validator::make($request->all(), [
                'email' => 'email',
            ]);
            if($validate->fails()) {
                return response()->json(['message' => 'The email must be a valid email address.'], 500);
            }
            
            subscribes::updateOrCreate(
                ['email' => $request->email],
                ['user_id' => $userId,'status' => 1,]
            );
            return response()->json(['message' => 'Subscribe succefully'], 200);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
