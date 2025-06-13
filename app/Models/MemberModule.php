<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class MemberModule extends Model
{
    use Notifiable, HasRoles;
    public $table = 'members_module';
    protected $primaryKey = 'id';
    protected $fillable = [
        'module_id',
        'member_id',
        'membership_id',
        'date',
        'time',
        'module_status',
        'remarks',
        'description',
    ];

    public function Plans()
    {
        return $this->belongsTo(Plan::class, 'membership_id', 'id');
    }

    public function Membership()
    {
        return $this->belongsTo(Membership::class, 'product_id', 'membership_id');
    }
}
