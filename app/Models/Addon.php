<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    use Notifiable, HasRoles;
    public $table = 'add_on_services';
    protected $primaryKey = 'id';

    public function AddOnPurchased()
    {
        return $this->belongsTo(AddOnPurchase::class, 'id', 'addon_id');
    }
}
