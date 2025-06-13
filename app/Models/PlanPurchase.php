<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class PlanPurchase extends Model
{
    use Notifiable, HasRoles;
    public $table = 'plan_orders';
    protected $primaryKey = 'id';

    protected $fillable = ['plan_id', 'addon_id', 'user_id', 'payment_receipt'];

    public function Plans()
    {
        return $this->belongsTo(Plan::class, 'plan_id', 'id');
    }
}
