<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class AddOnPurchase extends Model
{
    use Notifiable, HasRoles;
    public $table = 'add_on_purchase_order';
    protected $primaryKey = 'id';

    protected $fillable = ['user_id', 'plan_id', 'addon_id', 'payment_receipt', 'purchase_status'];

    public function AddOnService()
    {
        return $this->belongsTo(Addon::class, 'addon_id', 'id');
    }
}
