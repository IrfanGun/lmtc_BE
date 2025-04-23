<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;


class SubCategoryController extends Controller
{

    public function index()
    {
        $subCategories = SubCategory::all();
        return response()->json($subCategories);
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subCategory = SubCategory::create($validatedData);
        return response()->json($subCategory, 201);
    }

    public function show($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        return response()->json($subCategory);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
        ]);

        $subCategory = SubCategory::findOrFail($id);
        $subCategory->update($validatedData);
        return response()->json($subCategory);
    }

    public function destroy($id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->delete();
        return response()->json(['message' => 'SubCategory deleted successfully']);
    }

}
