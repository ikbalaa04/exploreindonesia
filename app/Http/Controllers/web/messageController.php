<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use App\Models\message;
use App\Models\partners;
use App\Models\listMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class messageController extends Controller
{
    public function index()
    {
        // list message from user 
        $id = \Request::query('to') ?? null;
        $user = User::whereId($id)->first();
        $messages = listMessage::with(['user','message'])->where('user_id',$id)->where('partner_id', Auth::user()->partner_id ?? null)->first();
        $listMessage = listMessage::with(['user','lastMessage'])->where('partner_id', Auth::user()->partner_id ?? null)->get();
        return view('cms.pages.message.index',[
            'user' => $user,
            'messages' => $messages,
            'listMessage' => $listMessage,
        ]);
    }
    public function send(Request $request)
    {
        try {
            $data = $request->except(['_method','_token']);
            // save from customer else partner
            if ($data['from'] == 'customer') {
                // find first chat or nor 
                $firstChat = message::where('from_id',$data['from_id'])->where('recipient_id',$data['recipient_id'])->where('first_chat',1);
                if ($firstChat->exists() == false) {
                    // save list message 
                    $listMessageId = listMessage::firstOrCreate(['user_id' => $data['from_id'], 'partner_id' => $data['recipient_id']]);
                    $data['list_message_id'] = $listMessageId->id;
                    $data['first_chat'] = 1;
                    // save 
                    message::create($data);
                    return response()->json(['message' => 'first'], 200);
                } else {
                    $data['list_message_id'] = $firstChat->pluck('list_message_id')->first();
                    $data['first_chat'] = 0;
                    // save 
                    message::create($data);
                }
            } else {
                // save from partner 
                $firstChat = message::where('from_id',$data['recipient_id'])->where('recipient_id',$data['from_id'])->where('first_chat',1)->pluck('list_message_id')->first();
                $data['list_message_id'] = $firstChat;
                $data['reply_by'] = Auth::user()->name;
                // save 
                message::create($data);
            }
            
            return response()->json(['message' => 'success'], 200);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
    public function refresh(Request $request)
    {
        $datetime = Carbon::now()->subSeconds(4);
        // find data  
        $data = message::select('message','file','created_at')->where('from_id',$request->recipient_id ?? null)->where('recipient_id',$request->from_id)->where('created_at','>=',$datetime)->get();
        if ($data != null) {
            $html = null; 
            foreach ($data as $key => $value) {
                $html .= '<div class="media media-chat"><div class="media-body"><p style="font-size:12px">' . $value->message . '</p><p class="meta" style="font-size: 8px; color:#6d6d6d"><time>' . $value->created_at . '</time></p></div></div>';
            }
        } else {
            $html = null;
        }
        return response()->json([
            'message' => $html
        ], 200);
    }
}
