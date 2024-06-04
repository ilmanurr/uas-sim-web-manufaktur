<?php

// app/Models/Pemesan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pemesan';

    protected $fillable = [
        'id_ketersediaan', 'jml_pesanan', 'tgl_pemesanan', 'tgl_penyelesaian',
    ];

    public function ketersediaan()
    {
        return $this->belongsTo(Ketersediaan::class, 'id_ketersediaan');
    }
}