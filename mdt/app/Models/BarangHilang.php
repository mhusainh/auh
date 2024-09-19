<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class BarangHilang extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string|MyEnum>
     */
    protected $fillable = [
        'nama_barang',
        'alamat_barang',
        'deskripsi_barang',
        'gambar_barang1',
        'gambar_barang2',
        'gambar_barang3',
        'gambar_barang4',
        'gambar_barang5',
        'status',
        'user_id',
        'tanggal_hilang',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
           
        ];
    }
}
