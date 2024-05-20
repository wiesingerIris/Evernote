<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class UserController extends Controller
{
    public function save(Request $request):JsonResponse
    {
        $request = $this->parseRequest($request);
        /*Starten einer DB Transaktion*/
        DB::beginTransaction();
        try {
            $user = User::create($request->all());
            DB::commit();
            return response()->json($user, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Saving user failed: " . $e->getMessage(), 420);
        }
    }

    public function delete($id): JsonResponse
    {
        $user = User::find($id);
        if ($user != null) {
            $user->delete();
            return response()->json('User (' . $id . ') successfully deleted', 200);
        } else {
            return response()->json('User could not be deleted - it does not exist', 422);
        }
    }
    private function parseRequest(Request $request):Request {
        //get date and covert it - it is in ISO a 8601, "2024-03-22T16:29:00.000Z"
        $date = new DateTime($request->published);
        $request['published'] = $date->format('Y-m-d H:i:s');
        return $request;
    }
}
