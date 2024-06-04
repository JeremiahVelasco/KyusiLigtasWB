<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'citizen_id' => 'required',
            'department' => 'required',
            'category' => 'required',
            'location' => 'required',
            'message' => 'nullable',
            'video' => 'nullable',
            'recording' => 'nullable',
            'status' => 'nullable',
            'date' => 'nullable',
            'time' => 'nullable',
            'lat' => 'nullable',
            'lng' => 'nullable',
        ]);

        // $report = Report::create([]);
        dd($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
