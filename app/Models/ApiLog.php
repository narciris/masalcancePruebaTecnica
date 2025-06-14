<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    use HasFactory;
    protected $table = 'api_logs';

    protected $fillable = [
        'id',
        'method',
        'data',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'data' => 'array',
    ];

}
