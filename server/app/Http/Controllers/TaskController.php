<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Tag;
use DateTime;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    // Korrigierte index Methode
    public function index(): JsonResponse
    {
        // Alle Tasks abrufen
        $tasks = Task::with(['images', 'user', 'tag'])->get(); // 'register' entfernt, wenn Task keine Beziehung zu Register hat

        if ($tasks->isEmpty()) {
            return response()->json(['message' => 'No tasks found'], 404);
        }

        return response()->json($tasks);
    }

    // Korrigierte show Methode
    public function show($task_id): JsonResponse
    {
        $task = Task::with(['images', 'user', 'tag'])->find($task_id); // 'register' entfernt, wenn Task keine Beziehung zu Register hat
        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }
        return response()->json($task);
    }

    public function save(Request $request): JsonResponse
    {
        $request = $this->parseRequest($request);
        DB::beginTransaction();

        try {
            $task = Task::create($request->all());

            if (isset($request['images']) && is_array($request['images'])) {
                foreach ($request['images'] as $img) {
                    $image = Image::firstOrNew(['url' => $img['url'], 'title' => $img['title']]);
                    $task->images()->save($image);
                }
            }

            $task->user_id = auth()->id();
            if (isset($request->tag)) {
                $tag = Tag::firstOrCreate(['priority' => $request->tag]);
                $task->tag_id = $tag->id;
                $task->save();
            }
            DB::commit();
            return response()->json($task, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Saving task failed: " . $e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        DB::beginTransaction();

        try {
            $task = Task::with(['images', 'user', 'tag'])->where('id', $id)->first();
            if ($task != null) {
                $request = $this->parseRequest($request);
                $task->update($request->all());

                $task->images()->delete();
                $task->tag()->delete();

                if (isset($request['images']) && is_array($request['images'])) {
                    foreach ($request['images'] as $img) {
                        $image = Image::firstOrNew(['url' => $img['url'], 'title' => $img['title']]);
                        $task->images()->save($image);
                    }
                }

                $task->user_id = auth()->id();

                if (isset($request->tag)) {
                    $tag = Tag::firstOrCreate(['priority' => $request->tag]);
                    $task->tag_id = $tag->id;
                }
                $task->save();
            }
            DB::commit();
            return response()->json($task, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Saving task failed: " . $e->getMessage(), 500);
        }
    }

    public function delete($id): JsonResponse
    {
        DB::beginTransaction();
        try {
            $task = Task::findOrFail($id);
            $task->delete();
            DB::commit();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json("Deleting task failed: " . $e->getMessage(), 500);
        }
    }

    private function parseRequest(Request $request): Request
    {
        $date = new DateTime($request->published);
        $request['published'] = $date->format('Y-m-d H:i:s');
        return $request;
    }
}
