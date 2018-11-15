<?php

namespace App;

use App\Models\Campaign;
use App\Models\UserSettings;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
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

    public function campaigns_contributed() {
        return Campaign::byContributor($this->id);
    }

    public function getIsAdminAttribute() {
        return $this->role_id === 1;
    }

    public function getContributedCampaignsAttribute() {
        return $this->campaigns_contributed()->get();
    }

    public function getNotificationsOnAttribute() {
        return optional($this->settings)->receive_notifications;
    }

    /*
     * Methods
     */

    public function ownsCampaign($id) {
        return $this->campaigns()->where('id', $id)->count() > 0;
    }
}
