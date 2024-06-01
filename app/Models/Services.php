<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Services extends Model
{
    protected $table = 'services';
    protected $keyType = 'int';
    protected $primaryKey = 'code_service';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function logs(): HasMany
    {
        return $this->hasMany(Logs::class, 'services_code_service', 'code_service');
    }
}
