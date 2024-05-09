<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use Illuminate\Support\Facades\Validator;

class CategoryAPIController extends ApiController
{
    public function index()
    {
        $categories = Category::get();
        return $this->sendSuccess(
            CategoryResource::collection($categories),
            'Category list'
        );
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:categories|min:3|max:50'
        ]);
        if ($validator->fails()) {
            return $this->sendError(
                'Failed validation',
                422,
                $data
            );
        }

        $category = Category::create($data);
        return $this->sendSuccess(
            [new CategoryResource($category)],
            'Category is stored'
        );
    }

    public function update(Category $category, Request $request)
    {
        $category->title = $request->get('title');
        $category->save();
        return $this->sendSuccess(
            [new CategoryResource($category)],
            'Category is updated'
        );
    }

    public function destroy(Category $category, Request $request)
    {
        $category->delete();
        return $this->sendSuccess(
            [],
            'Category is deleted'
        );
    }
}
