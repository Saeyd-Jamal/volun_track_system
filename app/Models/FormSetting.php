<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FormSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_status',
        'form_open_at',
        'form_close_at',
    ];
}
