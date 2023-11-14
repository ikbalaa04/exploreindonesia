<?php

namespace App\Http\Controllers\web;

use App\Models\news;
use App\Models\packet;
use App\Models\aboutUs;
use App\Models\banners;
use App\Models\partners;
use App\Models\wishlist;
use App\Models\categories;
use App\Models\achievement;
use App\Models\officeHours;
use App\Models\testimonies;
use Illuminate\Http\Request;
use App\Models\companyMembers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class homeController extends Controller
{
    public function home()
    {
        
        $banner = banners::with('bannerFile')->where('white_label','homepage')->where('status',1)->first();
        $blogs = news::orderBy('position','desc')->paginate('3');
        $partner = partners::orderBy('position','asc')->paginate('4');
        $reviews = testimonies::orderBy('position','asc')->paginate(4);
        $categories = categories::orderBy('created_at','asc')->where('status',1)->get();
        $packets = packet::where('status',1)->with(['packetImage'])->get();
        $populars = packet::where('status',1)->with(['packetRating','packetImage','packetPrice'])->orderBy('created_at','desc')->paginate('4');
        $userId = Auth::user() == null ? 0 : Auth::user()->id;
        // dd($packets);
        return view('web.pages.borneo.index', [
            'banner' => $banner,
            'blogs' => $blogs,
            'partner' => $partner,
            'reviews' => $reviews,
            'categories' => $categories,
            'packets' => $packets,
            'populars' => $populars,
            'userId' => $userId,
        ]);
        // return view('web.pages.index');
    }

    public function tripFinder()
    {
        $banner = banners::with('bannerFile')->where('white_label','trip_finder')->where('status',1)->first();
        $tourOrganizer = partners::orderBy('position','asc')->select('file')->paginate('4');
        // dd($banner,$tourOrganizer);
        return view('web.pages.tripFinder', [
            'banner' => $banner,
            'tourOrganizer' => $tourOrganizer
        ]);
    }

    public function about()
    {
        $banner = banners::with('bannerFile')->where('white_label','about')->where('status',1)->first();
        $achievement = achievement::get();
        $companyMembers = companyMembers::orderBy('id','asc')->paginate(3);
        
        return view('web.pages.about', [
            'banner' => $banner,
            'achievement' => $achievement,
            'companyMembers' => $companyMembers,
            
        ]);
    }

    public function tourPlanning()
    {
        $officeHours = officeHours::orderBy('created_at','asc')->get();

        return view('web.pages.tourPlanning',[
            'officeHours' => $officeHours
        ]);
    }

    public function filterTrip(Request $request)
    {
        $find = \Request::query('find');
        $searchCategories = \Request::query('categories');
        $destination = \Request::query('destination');
        $minMax = \Request::query('minMax');
        
        $filter = packet::where('status',1)->when($find, function($query, $find){
            return $query->where(function ($innerQuery) use ($find) {
                $innerQuery->where('title_idn', 'like', '%' . $find . '%')
                    ->orWhere('title_en', 'like', '%' . $find . '%');
            });
        })
        ->when($destination, function($query, $destination){
            $provinceIds = \Indonesia::search($destination)->allProvinces()->pluck('id')->toArray();
            return $query->whereIn('province_id', $provinceIds);
        })
        ->when($searchCategories, function($q, $searchCategories){
           $idCategories = Controller::getCategoryByName($searchCategories);
           return $q->where('categories_id','like','%'.$idCategories.'%');
        })
        ->when($minMax, function ($query, $minMax) {
            list($min, $max) = explode('|', $minMax);
            $query->whereHas('packetPrice', function ($q) use ($min, $max) {
                $q->whereBetween('price_in_dollars', [$min, $max]);
            });
        })->get();
        $categories = categories::orderBy('created_at','asc')->where('status',1)->get();
        $userId = Auth::user() == null ? 0 : Auth::user()->id;
        return view('web.pages.filterTrip', [
            'filter' => $filter,
            'userId' => $userId,
            'categories' => $categories,
        ]);
    }

    public function destination()
    {
        $packets = packet::where('status',1)->with(['packetImage'])->get();
        $populars = packet::where('status',1)->with(['packetRating','packetImage','packetPrice'])->orderBy('created_at','desc')->paginate('4');
        $userId = Auth::user() == null ? 0 : Auth::user()->id;
        return view('web.pages.borneo.destination', [
            'populars' => $populars,
            'userId' => $userId,
            'packets' => $packets,
        ]);
    }
    
    public function excursion($slug)
    {
        $packet = packet::where('status',1)->with(['packetRating','packetTourDetail','allPacketImage','packetPrice','packetScheduleTour.packetScheduleTourDetail','partner'])->where('slug',$slug)->first();
        $bookmark = wishlist::where('packet_id',$packet->id)->where('user_id',Auth::user()->id ?? null)->exists();
        $anotherPacket = packet::where('status',1)->with(['packetRating','packetImage','packetPrice'])->where('id','!=',$packet->id)->where('partner_id',$packet->partner_id)->orderBy('created_by','desc')->paginate(4);
        $userId = Auth::user() == null ? 0 : Auth::user()->id;
        
        return view('web.pages.borneo.detailExcursion',[
            'packet' => $packet,
            'bookmark' => $bookmark,
            'anotherPacket' => $anotherPacket,
            'userId' => $userId,
        ]);
    }

    public function kalimantan()
    {
        return view('web.pages.borneo.index');
    }

    // detail blog 
    public function detailBlog($slug)
    {
        $data = news::with('user')->where('slug',$slug)->first();
        $relateds = news::where('type',$data->type)->where('slug','!=',$slug)->paginate(3);
        return view('web.pages.detailBlog',[
            'data' => $data,
            'relateds' => $relateds,
        ]);
    }
    
    // partners 
    public function profilePartner()
    {
        return view('web.pages.profilePartner');
    }

}
