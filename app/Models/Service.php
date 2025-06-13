<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use Notifiable, HasRoles;
    public $table = 'service_modules';
    protected $primaryKey = 'id';

    public function MemberModuls()
    {
        return $this->belongsTo(MemberModule::class, 'module_id', 'id');
    }
}
