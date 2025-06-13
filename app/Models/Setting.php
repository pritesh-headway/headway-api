<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';

    protected $fillable = [
        'name',
        'value',
        'status',
        'group',
        'type',
        'desc',
    ];

    // If you want to use constants for status:
    public const STATUS_ACTIVE = '1';
    public const STATUS_INACTIVE = '0';
}
