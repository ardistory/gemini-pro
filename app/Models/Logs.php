<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logs extends Model
{
    protected $table = 'logs';
    protected $keyType = 'int';
    protected $primaryKey = 'id';
    public $incrementing = true;
    public $timestamps = true;
    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_username', 'username');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Services::class, 'services_code_service', 'code_service');
    }
}
