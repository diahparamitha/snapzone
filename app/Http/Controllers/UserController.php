<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Hero;


class UserController extends Controller
{
    public function index() {
        return view('admin.index', [
            'title' => 'Dashboard',
            'categories' => Category::count(),
            'products' => Product::count(),
            'users' => User::count(),
            'heros' => Hero::count(),
            'uniqueUsers' => User::uniqueData()->get(),
            'slug' => Category::all(),
        ]);
    }

    public function tabel_user() {
        $title = 'User List';
        $row = User::all();
        $categories = Category::count();
        $slug = Category::all();
        $users = User::count();
        $products = Product::count();
        $heros = Hero::count();
        $uniqueUsers = User::uniqueData()->get();

        // dd($row);
        return view('admin.tabel_user.user-list', compact('title', 'row', 'categories', 'slug', 'products', 'heros', 'users', 'uniqueUsers'));
    }

    public function userByRole($roleparam){
        $role = User::findByRole($roleparam);

        if (!$role) {
            abort(404);
        }

        $row = User::where('role', $role->id)->get();
        $title = 'List User - Role: ' . $role->name;
        $allRoles  = User::all();
        $uniqueUsers = User::uniqueData()->get();
        $slug = Category::all();

        return view('admin.tabel_user.user-list', compact('row', 'title', 'allRoles', 'uniqueUsers', 'slug'));
    }

    public function create(){
        $title = 'New User';
        $uniqueUsers = User::uniqueData()->get();
        $slug = Category::all();
    
        return view('admin.tabel_user.create', compact('title', 'uniqueUsers', 'slug'));
    }

    public function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|regex:/^[A-Z][A-Za-z\s]+$/',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|min:12|max:12',
            'address' => 'required|min:10|max:100',
            'password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])/',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->password = bcrypt($request->password);

        // Simpan gambar ke storage dengan nama acak
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke storage/app/public/avatars
            Storage::putFileAs('public/avatars', $file, $fileName);

            // Simpan nama file di database
            $user->avatar = $fileName;
        }

        $user->save();
        return redirect('/admin/users/index')->with('success', 'Kamu berhasil menambahkan User baru!');
    }

    public function update($id){
        $title = User::find($id)->pluck('name')->first();
        $user = User::find($id);
        $uniqueUsers = User::uniqueData()->get();
        $slug = Category::all();

        return view('admin.tabel_user.update', compact('title', 'user', 'uniqueUsers', 'slug'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        $validated = $request->validate([
            'name' => 'required|min:3|regex:/^[A-Z][A-Za-z\s]+$/',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|min:12|max:12',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'address' => 'required|min:10|max:100',
            'role' => '',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->tgl_lahir = $request->tgl_lahir;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->address = $request->address;
        $user->role = $request->input('role') ?? 'pengguna';

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
        return redirect('/admin/users/index')->with('update', 'Kamu berhasil memperbaharui profil!');
    }

     public function detail($id){
        $title = User::find($id)->pluck('name')->first();
        $user = User::find($id);
        $uniqueUsers = User::uniqueData()->get();
        $slug = Category::all();

        return view('admin.tabel_user.detail', compact('title', 'user', 'uniqueUsers', 'slug'));
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();

        return redirect('/admin/users/index')->with('delete', 'Kamu berhasil menghapus user!');
    }

}