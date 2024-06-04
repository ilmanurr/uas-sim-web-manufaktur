<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ketersediaan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_ketersediaan';

    protected $fillable = [
        'id_bahanbaku', 'jml_pesanan', 'jml_persediaan', 'jml_ygdibutuhkan', 'jml_tersisa', 'nm_pemesan',
    ];

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class, 'id_bahanbaku');
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesan::class, 'id_ketersediaan');
    }
}