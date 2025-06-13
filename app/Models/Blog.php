<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use Notifiable, HasRoles;
    public $table = 'blogs';
    protected $primaryKey = 'id';

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
}