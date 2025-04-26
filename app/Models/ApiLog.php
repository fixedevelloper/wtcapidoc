<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    protected $fillable = [
        'method', 'url', 'ip', 'headers', 'request_body',
        'response_status', 'response_body', 'duration_ms', 'customer_id'
    ];

    protected $casts = [
        'headers' => 'array',
        'request_body' => 'array',
        'response_body' => 'array',
    ];

}
