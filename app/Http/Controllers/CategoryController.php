<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::with('subCategory')->get();
        return response()->json( CategoryResource::collection($categories));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Check if the category already exists
        $existingCategory = Category::where('name', $request->name)->first();
        if ($existingCategory) 
        {
            return response()->json(['message' => 'Category already exists'], 409);
        }

        try {
            $category = null;
            DB::transaction(function () use ($request, &$category) { 
                $category = Category::create([
                    'name' => $request->name,
                    'is_featured' => $request->is_featured ?? false,
                ]);
            });
            
            return response()->json( [$category], 201);
           
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error creating category', 'error' => $th], 500);
        }
     
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        
        $category = Category::find($category->id);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json(['data' => $category], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // 
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            DB::transaction(function () use ($id, $validated) {
            // Find the category
            $category = Category::findOrFail($id);

            // Update the category name
            $category->name = $validated['name'];
            $category->save();
            });

            return response()->json([
            'message' => 'Category updated successfully',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
            'message' => 'Error updating category',
            'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
       
        try {
      
            
            $category = Category::findOrFail($id);
            if (!$category) {
                return response()->json(['message' => 'Category not found'], 404);
            }
    
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully'], 200);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error deleting category', 'error' => $th], 500);
        }
    }
}
