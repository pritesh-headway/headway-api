<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use Notifiable, HasRoles;
    public $table = 'contacts';
    protected $fillable = ['name', 'email', 'country_code', 'phone', 'message', 'city'];
    protected $primaryKey = 'id';
}
