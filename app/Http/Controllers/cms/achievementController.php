<?php

namespace App\Http\Controllers\cms;

use App\Models\achievement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class achievementController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = achievement::orderBy('created_at','desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($data){
                $action = '<button type="button" name="editAchievement" id="'.$data->id.'" class="editAchievement btn-sm btn btn-warning mt-1"><i class="material-icons">mode_edit</i>Edit</button>';
                $action .= '<button type="button" name="deleteAchievement" id="'.$data->id.'" class="deleteAchievement btn-sm btn btn-danger ms-1 mt-1"><i class="material-icons">delete_outline</i>Remove</button>';
                return $action;
            })
            
            ->rawColumns(['action'])
            ->make(true);
        }
    }
    public function show($id)
    {
        $data = achievement::whereId($id)->first();
        ($data != null) ?
            $response = response()->json(['message' => 'berhasil didapatkan data','data' => $data], 200)
            :
            $response = response()->json(['message' => 'data tidak ditemukan',], 404);
        return $response;
    }
    public function store(Request $request)
    {
        try {
            $data = $request->data;
            $arrData = []; // tampung data
            // memecah data  
            foreach ($data as $key => $value) {
                // give error when column not filled 
                if($value['value'] == null) return response()->json(['message' => $value['name'].' pencapaian tidak boleh kosong'], 404);
                $arrData[$value['name']] = $value['value'];
            }
            // save 
            achievement::create($arrData);
            return response()->json(['message' => 'berhasil simpan'], 200);
        } catch (\Exception $th) {
           return response()->json(['message' => $th->getMessage()], 500);
        } 
    }
    public function update(Request $request, $id)
    {
        try {
            $data = $request->data;
            $arrData = []; // tampung data
            // memecah data  
            foreach ($data as $key => $value) {
                // give error when column not filled 
                if($value['value'] == null) return response()->json(['message' => $value['name'].' pencapaian tidak boleh kosong'], 404);
                if ($value['name'] != 'typeAchievement') 
                    $arrData[$value['name']] = $value['value'];
            }
            // update 
            achievement::whereId($id)->update($arrData);
            return response()->json(['message' => 'berhasil simpan'], 200);
        } catch (\Exception $th) {
           return response()->json(['message' => $th->getMessage()], 500);
        } 
    }
    public function destroy($id)
    {
        try {
            achievement::whereId($id)->delete();
            return response()->json(['message' => 'berhasil'], 200);
        } catch (\Exception $th) {
           return response()->json(['message' => $th->getMessage()], 500);
        } 
    }
}
