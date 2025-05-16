<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatbotSession extends Model
{
    protected $fillable = ['user_number', 'step', 'sender', 'beneficiary', 'amount', 'service','country_code','is_delete'];
}
