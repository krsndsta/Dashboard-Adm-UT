<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxAssetDetail extends Model
{
    use HasFactory;
    protected $table = 'trx_asset_detail';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pemantauan',
        'id_asset',
        'status',
    ];
}
