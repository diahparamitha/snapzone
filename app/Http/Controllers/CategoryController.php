<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
	public function create(){
		$title = 'New Category';
		$uniqueUsers = User::uniqueData()->get();
		$slug = Category::all();

		return view('admin.tabel_category.create', compact('title', 'uniqueUsers', 'slug'));
	}

	public function createCategory(Request $request){
	    $request->validate([
	        'name' => 'required|min:3|regex:/^[A-Z][A-Za-z\s]+$/',
	        'description' => 'required|min:5',
	        'slug' => 'required|min:2',
	        'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
	    ]);

	    $category = new Category;
	    $category->user_id = auth()->id();
	    $category->name = $request->name;
	    $category->description = $request->description;
	    $category->slug = $request->slug;

	    if ($request->hasFile('image')) {
	        $file = $request->file('image');
	        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

	        // Simpan file ke storage/app/public/image_category
	        $file->storeAs('public/image_category', $fileName);

	        // Simpan nama file di database
	        $category->image = $fileName;
	    }

	    $category->save();
	    return redirect('/admin/category-list')->with('success', 'Kamu berhasil menambahkan kategori baru!');
	}

	public function categoryList(){
		$categories = Category::all();
		$slug = Category::all();
		$title = 'List Category';
		$uniqueUsers = User::uniqueData()->get();
		return view('admin.tabel_category.category-list', compact('categories', 'title', 'slug', 'uniqueUsers'));
	}

	public function update($id){
		$category = Category::find($id);
		$title = $category->name;
		$slug = Category::all();
		$uniqueUsers = User::uniqueData()->get();

		return view('admin.tabel_category.update', compact('category', 'title', 'slug', 'uniqueUsers'));
	}

	public function updateCategory(Request $request, $id){
	    $category = Category::find($id);

	    $validated = $request->validate([
	        'name' => 'required|min:3|unique:categories,name,'.$id,
	        'description' => 'required|min:5',
	        'slug' => 'required|min:2',
	        'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
	    ]);

	    $category->user_id = auth()->id();
	    $category->name = $request->name;
	    $category->description = $request->description;
	    $category->slug = $request->slug;

	    if ($request->hasFile('image')) {
	        $file = $request->file('image');
	        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

	        // Hapus gambar lama jika ada
	        if ($category->image) {
	            Storage::disk('public')->delete('image_category/'.$category->image);
	        }

	        // Simpan file ke storage/app/public/image_category
	        $file->storeAs('public/image_category', $fileName);

	        // Simpan nama file di database
	        $category->image = $fileName;
	    }

	    $category->save();
	    return redirect('/admin/category-list')->with('update', 'Kamu berhasil meng-update kategori!');
	}

	public function delete($id){
		$category = Category::find($id);
		$category->delete();

		return redirect('/admin/category-list')->with('delete', 'Kamu berhasil menghapus kategorinya!');
	}

	public function detail($id){
		$category = Category::find($id);
		$title = $category->name;
		$slug = Category::all();
		$uniqueUsers = User::uniqueData()->get();

		return view('admin.tabel_category.detail', compact('category', 'title', 'slug', 'uniqueUsers'));
	}

}
