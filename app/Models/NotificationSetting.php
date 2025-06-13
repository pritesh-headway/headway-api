<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class NotificationSetting extends Model
{
    use Notifiable, HasRoles;
    public $table = 'notification_setting';
    protected $fillable = [
        'user_id',
        'email_notification_email',
        'seminar_notification_email',
        'promotional_notification_email',
        'subscription_notification_email',
        'news_updates_notification_email',
        'email_notification_push',
        'seminar_notification_push',
        'promotional_notification_push',
        'subscription_notification_push',
        'news_updates_notification_push',
    ];
    protected $primaryKey = 'id';
}
