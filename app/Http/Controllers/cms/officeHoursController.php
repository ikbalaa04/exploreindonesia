<?php

namespace App\Http\Controllers\cms;

use App\Models\officeHours;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class officeHoursController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->all();
            // save or update 
            officeHours::updateOrCreate(
                ['day'=>'senin'],
                [
                    'about_us_id' => 1,
                    'time' => $request->seninHours,
                    'note' => $request->seninNote,
                    'status' => isset($request->senin) ? 1 : 0
                ]
            );
            officeHours::updateOrCreate(
                ['day'=>'selasa'],
                [
                    'about_us_id' => 1,
                    'time' => $request->selasaHours,
                    'note' => $request->selasaNote,
                    'status' => isset($request->selasa) ? 1 : 0
                ]
            );
            officeHours::updateOrCreate(
                ['day'=>'rabu'],
                [
                    'about_us_id' => 1,
                    'time' => $request->rabuHours,
                    'note' => $request->rabuNote,
                    'status' => isset($request->rabu) ? 1 : 0
                ]
            );
            officeHours::updateOrCreate(
                ['day'=>'kamis'],
                [
                    'about_us_id' => 1,
                    'time' => $request->kamisHours,
                    'note' => $request->kamisNote,
                    'status' => isset($request->kamis) ? 1 : 0
                ]
            );
            officeHours::updateOrCreate(
                ['day'=>'jumat'],
                [
                    'about_us_id' => 1,
                    'time' => $request->jumatHours,
                    'note' => $request->jumatNote,
                    'status' => isset($request->jumat) ? 1 : 0
                ]
            );
            officeHours::updateOrCreate(
                ['day'=>'sabtu'],
                [
                    'about_us_id' => 1,
                    'time' => $request->sabtuHours,
                    'note' => $request->sabtuNote,
                    'status' => isset($request->sabtu) ? 1 : 0
                ]
            );
            officeHours::updateOrCreate(
                ['day'=>'minggu'],
                [
                    'about_us_id' => 1,
                    'time' => $request->mingguHours,
                    'note' => $request->mingguNote,
                    'status' => isset($request->minggu) ? 1 : 0
                ]
            );
            return redirect()->back()->with(['success' => 'berhasil']);
        } catch (\Exception $th) {
            return redirect()->back()->with(['failed' => $th->getMessage()])->withInput($request->all());
        }
    }
    public function update($id,Request $request)
    {

    }
}
