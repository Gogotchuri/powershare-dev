<?php

namespace App;

use App\Models\Campaign;
use App\Models\UserSettings;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function campaigns() {
        return $this->hasMany(Campaign::class, 'author_id');
    }

    public function settings() {
        return $this->hasOne(UserSettings::class)->withDefault();
    }

    public function getIsAdminAttribute() {
        return $this->role_id === 1;
    }

    public function getNotificationsOnAttribute() {
        return optional($this->settings)->receive_notifications;
    }
}
