<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    // カテゴリページの表示
    public function index()
    {
        $categories = Category::all();
        return view('category', compact('categories'));
    }
    // カテゴリ追加機能
    public function store(CategoryRequest $request)
    {
        $category = $request->only(['name']);
        Category::create($category);
        return redirect('/categories')->with('message', 'カテゴリを作成しました');
    }
    // カテゴリ更新機能
    public function update(CategoryRequest $request)
    {
        $category = $request->only(['name']);
        Category::find($request->id)->update($category);
        return redirect('/categories')->with('message', 'カテゴリを更新しました');
    }
    // カテゴリ削除機能
    public function destroy(Request $request)
    {
        Category::find($request->id)->delete();
        return redirect('/categories')->with('message', 'カテゴリを削除しました');
    }
}
