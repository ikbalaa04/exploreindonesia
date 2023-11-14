<?php

namespace App\Http\Controllers\web;

use App\Models\requestTrip;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class tourPlanningController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = requestTrip::get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('created_at', function($data) {
                return ($data->created_at != null) ? date('d-M-Y, H:i', strtotime($data->created_at)) : '-';
            })
            ->rawColumns(['created_at'])
            ->make(true);
        }
        return view('cms.pages.tourPlanning.index');
    }
    public function create(Request $request)
    {
        try {
            $data = $request->except(['_method','_token']);
            requestTrip::create($data);
            return redirect()->back()->with('success','success submit your request');
        } catch (\Exception $th) {
            return redirect()->back()->with('failed','berhasil');

        }
    }
}
