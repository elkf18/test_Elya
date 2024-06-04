<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Keranjang;

use Illuminate\Http\Request;

class KeranjangController extends Controller
{
    public function TambahKeranjang(Request $request)
{
    // Validasi data request di sini jika diperlukan

    // Temukan menu berdasarkan ID yang diterima dari request
    $cart = new Keranjang();
    // Atau sesuaikan dengan logika Anda untuk menemukan atau membuat cart

    // Loop through menu items to add to cart
    foreach ($request->items as $item) {
        // Temukan menu berdasarkan ID yang diterima dari request
        $menu = Menu::find($item['menu_id']);

        // Tambahkan item ke keranjang
        $cart->items()->create([
            'menu_id' => $menu->id,
            'jumlah' => $item['jumlah'],
        ]);
    }

    // Simpan tanggal pengiriman ke dalam session atau dalam model Cart


    // Kembalikan respons yang sesuai, misalnya:
    return response()->json(['message' => 'Item berhasil ditambahkan '], 201);
}
}
