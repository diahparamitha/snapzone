<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\Hero;
use App\Models\User;

class LandingController extends Controller
{
   public function index()
    {
        $products = Product::where('status', 'approved')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('landing.index', [
            'title' => 'Welcome Snapzone',
            'products' => $products,
            'categories' => Category::all(),
            'hero' => Hero::all(),
        ]);
    }

    public function product(){
        return view('landing.product.productList', [
            'title' => 'Product List',
            'products' => Product::all(),
            'categories' => Category::all(),
            'hero' => Hero::all(),
            'tag' => 'All Products',
            'desc' => 'Jelajahi dunia melalui poto',
        ]);
    }

    public function productDetail($id){
        $title = Product::find($id)->name;
        $product = Product::find($id);
        $categories = Category::all();
        $hero = Hero::all();

        return view('landing.product.detail', compact('title', 'product', 'categories', 'hero'));
    }

    public function productByCategory($slug)
    {
        $category = Category::findBySlug($slug);

        if (!$category) {
            abort(404); // Jika kategori tidak ditemukan, tampilkan halaman 404
        }

        $products = Product::where('category_id', $category->id)->get();
        $title = 'List Produk - ' . $category->name;
        $tag = $category->name;
        $desc = $category->description;
        $categories = Category::all();
        $hero = Hero::all();

        return view('landing.product.productList', compact('products', 'title', 'categories', 'hero', 'tag', 'desc'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category');
        $minPrice = $request->input('min_price');
        $maxPrice = $request->input('max_price');

        $products = Product::query();

        if ($query) {
            $products->where('name', 'like', "%{$query}%");
        }

        if ($categoryId) {
            $products->where('category_id', $categoryId);
        }

        if ($minPrice) {
            $products->where('price', '>=', $minPrice);
        }

        if ($maxPrice) {
            $products->where('price', '<=', $maxPrice);
        }

        $products = $products->get();

        $categories = Category::all();
        $tag = 'All Products';
        $title = 'Hasil Pencarian';
        $desc = 'Jelajahi dunia melalui poto';
        $hero = Hero::all();

        return view('landing.product.productList', compact('products', 'categories', 'tag', 'title', 'hero', 'desc'));
    }

    public function detailUser($id){
        $user = User::find($id);
        $title = 'profile';
        $categories = Category::all();
        $hero = Hero::all();

        return view('landing.user.detail', compact('user', 'title', 'categories', 'hero'));
    }

    public function updateUser($id){
        $user = User::find($id);
        $title = 'profile';
        $categories = Category::all();
        $hero = Hero::all();

        return view('landing.user.update', compact('user', 'title', 'categories', 'hero'));
    }
    
    public function updateUser1(Request $request, $id){
        $user = User::find($id);

        $validated = $request->validate([
            'name' => 'required|min:3|regex:/^[A-Z][A-Za-z\s]+$/',
            'email' => 'required|email|unique:users,email,'.$id,
            'phone' => 'required|min:12|max:12',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'address' => 'required|min:10|max:100',
            'avatar' => 'image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->tgl_lahir = $request->tgl_lahir;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->address = $request->address;

          if ($request->hasFile('avatar')) {
            // Hapus gambar profil lama
            if ($user->avatar) {
                Storage::disk('public')->delete('avatars/'.$user->avatar);
            }

            // Simpan gambar profil yang baru
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $avatarPath = $request->file('avatar')->storeAs('avatars', $fileName, 'public');
            $user->avatar = $avatarPath;
        }

        $user->save();
        return redirect('/user/detail/'.$id)->with('update', 'Kamu berhasil memperbaharui profil!');
    }
}
