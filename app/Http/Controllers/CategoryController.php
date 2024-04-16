<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'time' => 'required|date',
        ]);

        // Create a new category record
        $category = Category::create($request->only('name', 'time'));

        return response()->json($category, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $category)
    {
        return response()->json($category);
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
    public function update(Request $request, Category $category)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'time' => 'sometimes|required|date',
        ]);

        // Update the category record
        $category->update($request->only('name', 'time'));

        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
       // Delete the category record
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully'], 204);
    }

    /**
     * Push category data from Project 1 to Project 2.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function pushToProject2(Category $category)
    {
        // Project 2 API endpoint URL
        $project2Url = 'http://project2.test/api/categories';

        // Send a POST request to Project 2 to push the category data
        $response = Http::post($project2Url, [
            'name' => $category->name,
            'time' => $category->time->toDateTimeString(),
        ]);


        return response()->json([
            'success' => $response->successful(),
            'data' => $response->json(),
        ]);
    }
}
