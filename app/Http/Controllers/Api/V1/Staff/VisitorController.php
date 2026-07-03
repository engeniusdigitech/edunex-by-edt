<?php

namespace App\Http\Controllers\Api\V1\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VisitorController extends Controller
{
    public function index(Request $request)
    {
        $visitors = collect();
        if (class_exists(\App\Models\Visitor::class)) {
            $visitors = \App\Models\Visitor::latest()->get()->map(fn($v) => [
                'id' => $v->id,
                'name' => $v->name,
                'phone' => $v->phone ?? null,
                'purpose' => $v->purpose ?? null,
                'host' => $v->host ?? null,
                'check_in' => optional($v->check_in)->format('Y-m-d H:i'),
                'check_out' => optional($v->check_out)->format('Y-m-d H:i'),
                'status' => $v->check_out ? 'checked_out' : 'inside',
            ])->values();
        }
        return response()->json(['visitors' => $visitors]);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required', 'purpose' => 'required']);
        if (class_exists(\App\Models\Visitor::class)) {
            \App\Models\Visitor::create(array_merge($request->validated(), [
                'check_in' => now(),
                'logged_by' => $request->user()->id,
            ]));
        }
        return response()->json(['message' => 'Visitor logged successfully'], 201);
    }
}
