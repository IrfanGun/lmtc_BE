<?php

namespace App\Http\Controllers;

use App\Models\States;
use Illuminate\Http\Request;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = States::all();
        return response()->json(['data' => $states], 200);

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
        //
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        // Check if the state already exists
        $existingState = States::where('name', $request->name)->first();
        if ($existingState) {
            return response()->json(['message' => 'State already exists'], 409);
        }
        try {
            $state = null;
            DB::transaction(function () use ($request, &$state) {
                $state = States::create([
                    'name' => $request->name,
                    'is_featured' => $request->is_featured ?? false,
                ]);
            });

            return response()->json(['data' => $state], 201);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error creating state', 'error' => $th], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(States $states)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(States $states)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, States $states)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(States $states)
    {
        //
    }
}
