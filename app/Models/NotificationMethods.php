<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationMethods extends Model
{
    use HasFactory;

    protected $fillable = [
        'notification_method_name',
    ];

    protected $timestamp = false;

    protected $table = 'notification_methods';
}
