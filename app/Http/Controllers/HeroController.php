<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Hero;


class HeroController extends Controller
{
    public function heroList(){
        $slug = Category::all();
        $uniqueUsers = User::uniqueData()->get();
        $title = 'List Hero';
        $heroes = Hero::all();
        $categories = Category::all();

        return view('admin.tabel_hero.hero-list', compact('title', 'slug', 'uniqueUsers', 'categories', 'heroes'));
    }

    public function create(){
        $slug = Category::all();
        $uniqueUsers = User::uniqueData()->get();
        $title = 'New Hero';
        $categories = Category::all();

        return view('admin.tabel_hero.create', compact('title', 'slug', 'uniqueUsers', 'categories'));
    }

    public function createHero(Request $request){
        $request->validate([
            'judul' => 'required|min:3',
            'deskripsi' => 'required|min:10',
            'gambar' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $hero = new Hero;
        $hero->judul = $request->judul;
        $hero->deskripsi = $request->deskripsi;
        $hero->created_by = auth()->id();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Simpan file ke storage/app/public/image_hero
            $file->storeAs('public/image_hero', $fileName);

            // Simpan nama file di database
            $hero->gambar = $fileName;
        }

        $hero->save();
        return redirect('/admin/hero-list')->with('success', 'Kamu berhasil menambahkan hero baru!');
    }

    public function updateStatus(Request $request, $heroId)
    {
        $hero = Hero::findOrFail($heroId);
        $status = $request->input('status');

        $hero->status = $status;
        $hero->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui.');
    }

    public function updateDisetujui(Request $request, $heroId)
    {
        $hero = Hero::findOrFail($heroId);
        $accept = $request->input('accept');

        $hero->disetujui = $accept;
        $hero->save();

        return redirect()->back()->with('success', 'Add berhasil diperbarui.');
    }

    public function update($id){
        $title = Hero::find($id)->pluck('judul')->first();
        $hero = Hero::find($id);
        $slug = Category::all();
        $uniqueProducts = Product::uniqueData()->get();
        $uniqueUsers = User::uniqueData()->get();

        return view('admin.tabel_hero.update', compact('title', 'hero', 'slug', 'uniqueProducts', 'uniqueUsers'));
    }

    public function updateHero(Request $request, $id){
        $hero = Hero::find($id);

        $validated = $request->validate([
            'judul' => 'required|min:3',
            'deskripsi' => 'required|min:10',
            'gambar' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        $hero->judul = $request->judul;
        $hero->deskripsi = $request->deskripsi;
        $hero->created_by = auth()->id();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            // Hapus gambar lama jika ada
            if ($hero->gambar) {
                Storage::disk('public')->delete('image_hero/' . $hero->gambar);
            }

            // Simpan file baru ke storage/app/public/image_hero
            $file->storeAs('public/image_hero', $fileName);

            // Simpan nama file di database
            $hero->gambar = $fileName;
        }

        $hero->save();
        return redirect('/admin/hero-list')->with('update', 'Kamu berhasil meng-update hero!');
    }

    public function delete($id){
        $hero = Hero::find($id);
        $hero->delete();

        return redirect('admin/hero-list')->with('delete', 'Kamu berhasil menghapus heronya!');
    }

}
