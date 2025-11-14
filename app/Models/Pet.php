<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'nama_pet',
        'berat',
        'jumlah',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class, 'account_id');
    }
}
