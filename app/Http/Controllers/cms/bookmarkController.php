<?php

namespace App\Http\Controllers\cms;

use App\Models\wishlist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class bookmarkController extends Controller
{
    public function store(Request $request)
    {
        try {
            wishlist::updateOrCreate(
                [
                    'user_id' => $request->userId,
                    'packet_id' => $request->id
                ],
                ['packet_id' => $request->id]
            );
            return response()->json(['message' => 'success save'], 200);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
    public function destroy(Request $request)
    {
        try {
            wishlist::where('user_id', $request->userId)->where('packet_id',$request->id)->delete();
            return response()->json(['message' => 'success delete'], 200);
        } catch (\Exception $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
