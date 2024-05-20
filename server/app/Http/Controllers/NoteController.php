<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Note;
use App\Models\Register;
use App\Models\Tag;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    public function index($register_id): JsonResponse
    {
        // Alle Notizen des angegebenen Registers abrufen
        $notes = Note::with(['register', 'images', 'user', 'tag'])
            ->where('register_id', $register_id)
            ->get();

        if ($notes->isEmpty()) {
            return response()->json(['message' => 'No notes found for this register'], 404);
        }

        return response()->json($notes);
    }
    public function show($register_id, $note_id): JsonResponse
    {
        // Einzelne Notiz des angegebenen Registers abrufen
        $note = Note::with(['register', 'images', 'user', 'tag'])
            ->where('register_id', $register_id)
            ->where('id', $note_id)
            ->first();

        if (!$note) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        return response()->json($note);
    }


    public function save(Request $request, $id):JsonResponse
    {
        $request = $this->parseRequest($request);
        /*Starten einer DB Transaktion*/
        DB::beginTransaction();

        try {
            $register = Register::findOrFail($id);

            // Note erstellen und zum Register hinzufügen
            $note = $register->notes()->create($request->all());
            if(isset($request['images']) && is_array($request['images'])){
                foreach ($request['images'] as $img){
                    $image = Image::firstOrNew(['url'=>$img['url'], 'title'=>$img['title']]);
                    $note->images()->save($image);
                }
            }
            $note->user_id = auth()->id(); // Annahme: Der eingeloggte Benutzer erstellt das Register

            // Tag der Notiz zuordnen
            if (isset($request->tag)) {
                $tag = Tag::firstOrCreate(['name' => $request->tag]);
                $note->tag_id = $tag->id;
                $note->save();
            }

            DB::commit();
            return response()->json($note, 201);
        } catch (\Exception $e){
            DB::rollBack();
            return response()->json("saving note failed" . $e->getMessage(), 420);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        DB::beginTransaction();

        try {
            // Notiz finden und aktualisieren

            $note = Note::with('images', 'user', 'tag')->
                where('id', $id)->first();
            if($note != null) {
                $request = $this->parseRequest($request);
                $note->update($request->all());

                //delete all old images
                $note->images()->delete();

                // Neue Bilder hinzufügen
                if (isset($request['images']) && is_array($request['images'])) {
                    foreach ($request['images'] as $img) {
                        $image = Image::firstOrNew(['url' => $img['url'], 'title' => $img['title']]);
                        $note->images()->save($image);
                    }
                }

                $note->tag()->delete();

                // Tag der Notiz zuordnen
                if (isset($request->tag)) {
                    $tag = Tag::firstOrCreate(['name' => $request->tag]);
                    $note->tag_id = $tag->id;
                }
                // Benutzer ID aktualisieren
                $note->user_id = auth()->id();

                $note->save();
            }


            DB::commit();

            // Aktualisierte Notiz mit allen Beziehungen laden und zurückgeben
            $updateNote = Note::with('images', 'user', 'tag')->
                where('id', $id)->first();
            return response()->json($updateNote, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Saving note failed: " . $e->getMessage(), 500);
        }

    }



    public function delete($note_id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $note = Note::where('id', $note_id)->firstOrFail();

            // Note löschen
            $note->delete();

            DB::commit();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Deleting note failed: " . $e->getMessage(), 500);
        }
    }


    private function parseRequest(Request $request):Request
    {
        // Datum formatieren
        $date = new DateTime($request->published);
        $request['published'] = $date->format('Y-m-d H:i:s');

        return $request;
    }
}
