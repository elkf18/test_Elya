<?php

namespace App\Http\Controllers\Api;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        //get all posts
        // $url = url('/') . '/public/image/';
        $query = Menu::query();

    // Cek apakah ada query pencarian
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where('nama', 'like', '%' . $searchTerm . '%')
                ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
        }

    // Ambil data menu
        $alldata = $query->latest()->paginate(10);
        // foreach ($alldata as $menu) {
        //     $menu->foto = $url . $menu->foto;
        // }
        // $alldata = Menu::latest()->paginate(10);

        //return collection of posts as a resource
        return response()->json(['message' => 'List semua data', 'data' => $alldata], 201);
    }
    public function show($id)
    {
        //find post by ID
        $detail = Menu::find($id);

        //return single post as a resource
        return response()->json(['message' => 'Berhasilkan menampilkan data', 'data' => $detail], 201);
    }
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'foto'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'harga' => 'required|string',
        ]);
        $foto = $request->file('foto');
        $foto->storeAs('public/posts', $foto->hashName());

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $add = Menu::create([
            'nama'      => $request->nama,
            'deskripsi'     => $request->deskripsi,
            'foto'     => $foto->hashName(),
            'harga'     => $request->harga,
        ]);
        return response()->json(['message' => 'Menu berhasil ditambahkan', 'data' => $add], 201);

        //return response
        // return new PostResource(true, 'Data Post Berhasil Ditambahkan!', $add);
    }
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //find post by ID
        $edit = Menu::find($id);
        if ($request->hasFile('foto')) {

            //upload image
            $foto = $request->file('foto');
            $foto->storeAs('public/image', $foto->hashName());

            //delete old image
            Storage::delete('public/image/'.basename($edit->foto));

            //update post with new image
            $edit->update([
                'nama'      => $request->nama,
                'deskripsi'     => $request->deskripsi,
                'foto'     => $foto->hashName(),
                'harga'     => $request->harga,
            ]);

        } else {

            //update post without image
            $edit->update([
                'nama'      => $request->nama,
                'deskripsi'     => $request->deskripsi,
                'harga'     => $request->harga,
            ]);
        }
        // $edit->update([
        //         'nama'      => $request->nama,
        //         'alamat'     => $request->alamat,
        //         'kontak'     => $request->kontak,
        //         'deskripsi'     => $request->deskripsi,
        // ]);
        return response()->json(['message' => 'Menu berhasil diupdate', 'data' => $edit], 201);

    }
    public function destroy($id)
    {

        //find post by ID
        $hapus = Menu::find($id);

        //delete image
        Storage::delete('public/image/'.basename($hapus->foto));

        //delete post
        $hapus->delete();

        //return response
        return response()->json(['message' => 'Menu berhasil dihapus', 'data' => $hapus], 201);
    }

    public function TambahKeranjang(Request $request, $id)
    {
       
        $menu = Menu::find($id);

        // Buat objek keranjang baru atau temukan keranjang yang ada untuk pengguna yang sesuai

        // Tambahkan menu ke keranjang

        // Kembalikan respons yang sesuai
    }

    
}
