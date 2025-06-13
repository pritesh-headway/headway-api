<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    use Notifiable, HasRoles;
    public $table = 'cms';
    protected $primaryKey = 'id';
    protected $fillable = ['plan_id'];
}
