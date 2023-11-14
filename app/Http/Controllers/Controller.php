<?php

namespace App\Http\Controllers;

use App\Models\aboutUs;
use App\Models\wishlist;
use App\Models\categories;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function formatPhone($nohp = '0896')
    {
        // kadang ada penulisan no hp 0811 239 345
        $nohp = str_replace(" ","",$nohp);
        // kadang ada penulisan no hp 0811 239 345,
        $nohp = str_replace(",","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace("(","",$nohp);
        // kadang ada penulisan no hp (0274) 778787
        $nohp = str_replace(")","",$nohp);
        // kadang ada penulisan no hp 0811.239.345
        $nohp = str_replace(".","",$nohp);
        // cek apakah no hp mengandung karakter dan 0-9
        if(!preg_match('/[^+0-9]/',trim($nohp))){
            // cek apakah no hp karakter 1-3 adalah 62
            if(substr(trim($nohp), 0, 3)=='62'){
                $hp = trim($nohp);
            }
            // cek apakah no hp karakter 1 adalah 0
            elseif(substr(trim($nohp), 0, 1)=='0'){
                $hp = '+62 '.substr(trim($nohp), 1);
            } else {
                $hp = '';
            }
        }

        return $hp;
    }
    public static function logoHeader()
    {
        $logo = aboutUs::pluck('logo')->first();
        return $logo != null ? asset('assets/images/aboutUs/'.$logo) : asset('assets/cms/images/noImage.jpg');
    }
    public static function logoFooter()
    {
        $logo = aboutUs::pluck('logo_white')->first();
        return $logo != null ? asset('assets/images/aboutUs/'.$logo) : asset('assets/cms/images/noImage.jpg');
    }
    public static function favicon()
    {
        $favicon = aboutUs::pluck('favicon')->first();
        return $favicon != null ? asset('assets/images/aboutUs/'.$favicon) : asset('assets/cms/images/noImage.jpg');
    }
    public static function aboutUs()
    {
        $aboutUs = aboutUs::orderBy('created_at','asc')->first();
        return $aboutUs ?? '';
    }

    public static function getCategory($id)
    {
        return categories::whereId($id)->pluck('name')->first();
    }
    public static function getCategoryByName($name)
    {
        return categories::where('name',$name)->pluck('id')->first();
    }

    public static function checkBookmark($packetId,$userId)
    {
        $response = wishlist::where('packet_id',$packetId)->where('user_id',$userId)->exists();
        return $response;
    }
}
