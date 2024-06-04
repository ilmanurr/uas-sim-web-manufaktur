<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_bahanbaku';
    protected $fillable = ['nm_bahanbaku', 'jml_persediaan', 'satuan', 'wkt_produksi', 'kpsts_produksi'];

    public function ketersediaans()
    {
        return $this->hasMany(Ketersediaan::class, 'id_bahanbaku');
    }

    // Method to calculate total production time in days
    public function calculateTotalProductionTime($quantity)
    {
        $dailyProductionCapacity = $this->kpsts_produksi;
        $productionTimePerUnit = $this->wkt_produksi;

        // Calculate the number of days required
        $totalProductionDays = ceil($quantity / $dailyProductionCapacity) * $productionTimePerUnit;

        return $totalProductionDays;
    }
}