<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;

class CategoryAPIController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        $res = [
            'message' => 'Category list',
            'data' => CategoryResource::collection($categories),
            'statusCode' => 200
        ];
        return response()->json($res);
    }

    public function store(Request $request)
    {
        $category = Category::create($request->all());
        $res = [
            'message' => 'Category is stored',
            'data' => [
                new CategoryResource($category)
            ],
            'statusCode' => 200
        ];
        return response()->json($res);
    }

    public function update(Category $category, Request $request)
    {
        $category->title = $request->get('title');
        $category->save();
        return response()->json($category);
    }

    public function destroy(Category $category, Request $request)
    {
        $category->delete();
        return response()->json([
            'message' => 'Category was deleted'
        ]);
    }
}
