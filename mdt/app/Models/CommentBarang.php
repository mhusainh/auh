<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CommentBarang extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string|MyEnum>
     */
    protected $fillable = [
        'barang_id',
        'user_id',
        'komentar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barangHilang()
    {
        return $this->belongsTo(BarangHilang::class);
    }
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
