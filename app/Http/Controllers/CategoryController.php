<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'status' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('categories.create')->withErrors($validator)->withInput($request->all());
        }else{

            $category = new Category;
            $category->name = $request->name;
            $category->status = $request->status;
            $category->save();

            Session::flash('message', 'Category successfully saved');

            return redirect()->route('categories.index');

        }
    }

    public function index()
    {
        $categories = Category::orderBy('updated_at', 'DESC')->get();

        return view('admin.categories.index', compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'status' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('categories.edit', $id)->withErrors($validator)->withInput($request->all());
        }else{
            $category = Category::find($id);
            $category->name = $request->name;
            $category->status = $request->status;
            $category->save();

            Session::flash('message', 'Category successfully updated');

            return redirect()->route('categories.index');
        }
    }

    public function destroy($id)
    {
        $category = Category::find($id);

        if (empty($category)) {
            die('Category not found');
        }

        $category->delete();

        Session::flash('message', 'Category successfully deleted');
        return redirect()->route('categories.index');
    }

}
