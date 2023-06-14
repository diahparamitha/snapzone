<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;


class ProductController extends Controller
{
	public function productList(){
		$products = Product::all();
		$categories = Category::all();
		$slug = Category::all();
		$uniqueUsers = User::uniqueData()->get();
		$title = 'List Product';

		return view('admin.tabel_produk.product-list', compact('products', 'title', 'categories', 'slug', 'uniqueUsers'));
	}

	public function create(){
		$title = 'New Product';
		$categories = Category::all();
		$products = Product::all();
		$uniqueProducts = Product::uniqueData()->get();
		$slug = Category::all();
		$uniqueUsers = User::uniqueData()->get();

		return view('admin.tabel_produk.create', compact('title', 'categories', 'products', 'uniqueProducts', 'slug', 'uniqueUsers'));
	}

	public function createProduct(Request $request){
	    $request->validate([
	        'category_id' => 'required',
	        'name' => 'required|min:3',
	        'description' => 'required|min:5|max:100',
	        'price' => 'required',
	        'stok' => 'required',
	        'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
	    ]);

	    $product = new Product;
	    $product->category_id = $request->category_id;
	    $product->user_id = auth()->id();
	    $product->name = $request->name;
	    $product->description = $request->description;
	    $product->price = $request->price;
	    $product->stok = $request->stok;

	    if ($request->hasFile('image')) {
	        $file = $request->file('image');
	        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

	        // Simpan file ke storage/app/public/image_product
	        Storage::putFileAs('public/image_product', $file, $fileName);

	        // Simpan nama file di database
	        $product->image = $fileName;
	    }

	    $product->save();
	    return redirect('/admin/product-list')->with('success', 'Kamu berhasil menambahkan product baru!');
	}

	public function detail($id){
		$title = Product::find($id)->pluck('name')->first();
		$product = Product::with('user')->find($id);
		$slug = Category::all();
		$uniqueUsers = User::uniqueData()->get();

		return view('admin.tabel_produk.detail', compact('title', 'product', 'slug', 'uniqueUsers'));
	}

	public function update($id){
		$title = Product::find($id)->pluck('name')->first();
		$product = Product::find($id);
		$slug = Category::all();
		$categories = Category::all();
		$uniqueProducts = Product::uniqueData()->get();
		$uniqueUsers = User::uniqueData()->get();

		return view('admin.tabel_produk.update', compact('title', 'product', 'slug', 'uniqueProducts', 'uniqueUsers', 'categories'));
	}

	public function updateProduct(Request $request, $id){
	    $product = Product::find($id);

	    $validated = $request->validate([
	        'category_id' => 'required',
	        'name' => 'required|min:3',
	        'description' => 'required|min:5|max:100',
	        'price' => 'required',
	        'stok' => 'required',
	        'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
	    ]);

	    $product->category_id = $request->category_id;
	    $product->user_id = auth()->id();
	    $product->name = $request->name;
	    $product->description = $request->description;
	    $product->price = $request->price;
	    $product->stok = $request->stok;

	    if ($request->hasFile('image')) {
	        // Delete the old image
	        Storage::delete('public/image_product/' . $product->image);

	        $file = $request->file('image');
	        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

	        // Simpan file ke storage/app/public/image_product
	        $file->storeAs('public/image_product', $fileName);

	        // Simpan nama file di database
	        $product->image = $fileName;
	    }

	    $product->save();
	    return redirect('/admin/product-list')->with('update', 'Kamu berhasil memperbaharui product!');
	}
	
	public function delete($id){
		$product = Product::find($id);
		$product->delete();

		return redirect('admin/product-list')->with('delete', 'Kamu berhasil menghapus produknya!');
	}

	public function productListByCategory($slug)
	{
	    $category = Category::findBySlug($slug);

	    if (!$category) {
	        abort(404); // Jika kategori tidak ditemukan, tampilkan halaman 404
	    }

	    $products = Product::where('category_id', $category->id)->get();
	    $title = 'List Produk - Kategori: ' . $category->name;
	    $slug = Category::all();
	    $uniqueUsers = User::uniqueData()->get();

	    return view('admin.tabel_produk.product-list', compact('products', 'title', 'slug', 'uniqueUsers'));
	}

	public function updateStatus($id, $status)
	{
	    $product = Product::find($id);
	    $product->status = $status;
	    $product->save();

	    return redirect()->back()->with('status', 'Status product berhasil diperbaharui!');
	}


    
}
