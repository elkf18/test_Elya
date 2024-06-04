<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'menu_id', 'jumlah', 'tanggal'];

    // Definisikan relasi dengan model Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
