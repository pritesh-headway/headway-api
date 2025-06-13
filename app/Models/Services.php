<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use Notifiable, HasRoles;
    public $table = 'our_services';
    protected $primaryKey = 'id';

    public function getServicesList()
    {
        return DB::table($this->table)
            ->select('cs.id', 'cs.name', 'cs.sort_desc', 'our_services.service_desc', 'our_services.image', 'our_services.name as parent_name')
            ->rightJoin('our_services as cs', 'cs.parent_id', '=', 'our_services.id')
            ->where('our_services.status', 1)
            ->orderBy('cs.id', 'desc')
            ->get();
    }
}
