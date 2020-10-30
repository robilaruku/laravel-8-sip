<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::pluck('name', 'id');

        $category = $request->input('category');
        $search = $request->input('search');

        $paginate = 1;

        $products = new Product;

        // Filter by category
        if (!empty($category)) {
            $products = $products->where('category_id', $category);
        }

        // Filter by name
        if (!empty($search)) {
            $products = $products->orWhere('name', 'LIKE', "%{$search}%");
        }

        $products = $products->paginate($paginate);


        return view('admin.products.index', compact(
            'categories',
            'category',
            'search',
            'products'
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'sku' => 'required',
            'price' => 'required',
            'image' => 'required',
            'status' => 'required',
            'description' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'category_id.required' => 'Category tidak boleh kosong',
            'sku.required' => 'SKU tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong',
            'image.required' => 'Gambar tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('products.create')->withErrors($validator)->withInput($request->all());
        }else{
            $image = $request->file('image')->store('products', 'public');

            $product = new Product;
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->price = $request->price;
            $product->image = $image;
            $product->status = $request->status;
            $product->description = $request->description;
            $product->save();

            Session::flash('message', 'Product successfully saved');

            return redirect()->route('products.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::pluck('name', 'id');

        return view('admin.products.show', compact('product', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);

        $categories = Category::pluck('name', 'id');

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $rules = [
            'category_id' => 'required',
            'name' => 'required',
            'sku' => 'required',
            'price' => 'required',
            'image' => 'required',
            'status' => 'required',
            'description' => 'required',
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'category_id.required' => 'Category tidak boleh kosong',
            'sku.required' => 'SKU tidak boleh kosong',
            'price.required' => 'Harga tidak boleh kosong',
            'image.required' => 'Gambar tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('products.edit', $id)->withErrors($validator)->withInput($request->all());
        }else{
            $image = $request->file('image')->store('products', 'public');

            $product = Product::find($id);
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->sku = $request->sku;
            $product->price = $request->price;
            $product->image = $image;
            $product->status = $request->status;
            $product->description = $request->description;
            $product->save();

            Session::flash('message', 'Product successfully updated');

            return redirect()->route('products.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (empty($product)) {
            die('Data not found');
        }

        $product->delete();

        Session::flash('message', 'Product successfully deleted');

        return redirect()->route('products.index');
    }
}
