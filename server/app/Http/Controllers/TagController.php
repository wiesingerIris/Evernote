<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
class TagController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        // Überprüfen, ob der Tag bereits existiert
        $existingTag = Tag::where('name', $request->name)->first();

        if ($existingTag) {
            return response()->json(['message' => 'Tag already exists'], 400);
        }

        // Neuen Tag erstellen
        $tag = Tag::create(['name' => $request->name]);

        return response()->json($tag, 201);
    }
}
