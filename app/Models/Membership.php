<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use Notifiable, HasRoles;
    public $table = 'membership';
    protected $fillable = [
        'full_name',
        'gender',
        'date_of_birth',
        'qualification',
        'occupation',
        'designation',
        'mobile_no',
        'email',
        'date_of_anniversary',
        'nationality',
        'address',
        'city',
        'state',
        'pincode',
        'landline_no',
        'contact_person_name',
        'contact_person_mobile',
        'organization_name',
        'registered_office_address',
        'gst_no',
        'pan_no',
        'date_of_incorporation',
        'organization_type',
        'bank_name',
        'account_no',
        'branch_name',
        'ifsc_code',
        'product_type',
        'duration',
        'deliverables',
        'meeting_duration',
        'material_provided',
        'payment_account_name',
        'payment_bank_name',
        'payment_account_no',
        'payment_ifsc_code',
        'payment_receipt',
        'account_operation_since',
        'branch_address',
        'bussiness_city',
        'bussiness_state',
        'bussiness_pincode',
        'bussiness_landline_no',
        'bussiness_email',
        'membership_status',
        'product_id',
        'reference_by',
        'business_ContactPerson_mobile',
        'business_ContactPerson_name',
        'business_fax_no',
        'personal_ContactPerson_email',
        'expectation_from_this_program',
        'user_id'
    ];
    protected $primaryKey = 'id';

    public function AddOnModule()
    {
        return $this->belongsTo(AddOnPurchase::class, 'plan_id', 'id');
    }
}
