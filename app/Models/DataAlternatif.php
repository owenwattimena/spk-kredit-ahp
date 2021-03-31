<?php

namespace App\Models;

use App\Models\Alternatif;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataAlternatif extends Model
{
    use HasFactory;
    protected $table = "data_alternatif";

    /**
     * Get the subkriteria that owns the DataAlternatif
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'id_alternatif', 'id');
    }
    public function subkriteria()
    {
        return $this->belongsTo(Subkriteria::class, 'id_subkriteria', 'id');
    }
}