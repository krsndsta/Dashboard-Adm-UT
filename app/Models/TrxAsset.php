<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrxAsset extends Model
{
    use HasFactory;
    protected $table = 'trx_asset';
    protected $primaryKey = 'id';
    protected $fillable = [
        'dateTime',
        'jenis_pemantauan',
        'jumlah_baik',
        'jumlah_kurang_baik',
    ];
    public function m_asset(){
        return $this->belongsToMany(MAsset::class,'trx_asset_detail','id_pemantauan','id_asset');
    }
}
