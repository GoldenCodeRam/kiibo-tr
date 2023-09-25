<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Collection
    {
        return Log::where('user_id', Auth::user()->id)
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {
        $validated = $request->validate([
            "log" => "required"
        ]);

        Log::create([
            'content' => $request->get('log'),
            'user_id' => $request->user()->id,
        ]);

        return response(null, 201);
    }

    public function find(Request $request): Response
    {
        $validated = $request->validate([
            "id" => "required",
        ]);

        return response(Log::find($validated["id"]), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): void
    {
        $validated = $request->validate([
            "log.id" => "required",
            "log.content" => "required",
        ]);

        $log = Log::find($validated["log"]["id"]);
        $log->content = $validated["log"]["content"];
        $log->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request): Response
    {
        $validated = $request->validate([
            "id" => "required"
        ]);

        Log::destroy($validated["id"]);
        return response(null, 200);
    }
}
