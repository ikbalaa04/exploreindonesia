<?php

namespace App\Http\Controllers\web;

use App\Models\message;
use App\Models\partners;
use App\Models\wishlist;
use App\Models\listMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class dashboardUserController extends Controller
{
    public function wishlist()
    {
        $wishlist = wishlist::with(['packet.packetImage','packet.packetPrice','packet.partner','packet.packetRating'])->where('user_id',Auth::user()->id ?? null)->get();
        
        return view('web.pages.dashboard.wishlist', [
            'wishlist' => $wishlist
        ]);
    }
    public function chat()
    {
        $id = \Request::query('to') ?? null;
        // if ($id != null) {
        //     $partner = partners::whereId($id)->first();
        //     // $messages = message::with(['recipient'])->where('from_id',Auth::user()->id)->orderBy('created_at','asc')->get();
        //     $messages = null;
        // } else {
        //    $partner = null;
        //    $messages = null;
        // }
        $partner = partners::whereId($id)->first();
        $messages = listMessage::with(['partner','message'])->where('user_id',Auth::user()->id ?? null)->where('partner_id',$id)->first();
        $listMessage = listMessage::with(['partner','lastMessage'])->where('user_id',Auth::user()->id ?? null)->get();
        // dd($messages);
        return view('web.pages.dashboard.chat',[
            'partner' => $partner,
            'messages' => $messages,
            'listMessage' => $listMessage,
        ]);
    }
    public function profile()
    {
        return view('web.pages.dashboard.profile');
    }
}
