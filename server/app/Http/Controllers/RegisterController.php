<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use App\Models\Register;

use DateTime;
use http\Env\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function index(): JsonResponse
    {
        $registers = Register::with('images', 'user')->get();
        return response()->json($registers);
    }

    public function show($id): JsonResponse
    {
        $register = Register::with('images', 'user')->find($id);
        if (!$register) {
            return response()->json(['message' => 'Register not found'], 404);
        }
        return response()->json($register);
    }

    public function save(Request $request): JsonResponse
    {
        $request = $this->parseRequest($request);
        DB::beginTransaction();

        try {
            $register = Register::create($request->all());
            if (isset($request['images']) && is_array($request['images'])) {
                foreach ($request['images'] as $img) {
                    $image = new Image([
                        'url' => $img['url'],
                        'title' => $img['title']
                    ]);
                    $register->images()->save($image);
                }
            }
            $register->user_id = auth()->id();
            $register->save();

            DB::commit();
            return response()->json($register, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("saving register failed: " . $e->getMessage(), 420);
        }
    }

       public function update(Request $request, $id):JsonResponse
    {
        /*Starten einer DB Transaktion*/
        DB::beginTransaction();

        try {
            $register = Register::with('images', 'user')->
                where('id', $id)->first();

            if($register != null){
                $request = $this->parseRequest($request);
                $register->update($request->all());
                //delete all old images
                $register->images()->delete();

                if(isset($request['images']) && is_array($request['images'])){
                    foreach ($request['images'] as $img){
                        $image = Image::firstOrNew(['url'=>$img['url'], 'title'=>$img['title']]);
                        $register->images()->save($image);
                    }
                }
                $register->user_id = auth()->id(); // Annahme: Der eingeloggte Benutzer erstellt das Register
                $register->save();

            }

            DB::commit();
            $register = Register::with('images', 'user')->
                where('id', $id)->first();
            return response()->json($register, 201);
        } catch (\Exception $e){
            DB::rollBack();
            return response()->json("updating register failed" . $e->getMessage(), 420);
        }
    }



/*
    public function delete($id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $register = Register::findOrFail($id);

            // Register löschen
            $register->delete();

            DB::commit();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Deleting register failed: " . $e->getMessage(), 500);
        }
    }
*/
    public function delete($id) : JsonResponse {
        $register = Register::where('id', $id)->first();
        if ($register != null) {
            if(!Gate::allows('own-register', $register)){
                return response()->json([
                    'message' => 'You are not allowed to delete this
book'
                ], 403);
            }
            $register->delete();
            return response()->json('register (' . $id . ') successfully
            deleted', 200);
        }
        else
            return response()->json('register could not be deleted - it
            does not exist', 422);
    }


    private function parseRequest(Request $request):Request
    {
        // Datum formatieren
        $date = new DateTime($request->published);
        $request['published'] = $date->format('Y-m-d H:i:s');

        return $request;
    }
}
