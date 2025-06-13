<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use Notifiable, HasRoles;
    public $table = 'plans';
    protected $primaryKey = 'id';

    public function PlanPurchase()
    {
        return $this->belongsTo(PlanPurchase::class, 'id', 'plan_id');
    }
}
