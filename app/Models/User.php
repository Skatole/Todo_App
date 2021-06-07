<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    use HasRoles;

    protected $guard_name = 'api';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function reference()
    {
        return $this->belongsToMany(
            User::class,
            'post_user',
            'user_id',
            'reference_id'
        );
    }

    public function post()
    {
        return $this->belongsToMany(
            Post::class,
            'post_user',
            'user_id',
            'post_id'
        );

    }

    public function referencePost() {

        return $this->belongsToMany(
            Post::class,
            'post_user',
            'reference_id',
            'post_id'
        );
    }


    public function addReference(User $user)
    {
        $this->reference()->attach($user->id);
    }

    public function getAllPermissionsAttribute()
    {
        $permissions = [];
        foreach (Permission::all() as $permission) {
            if (Auth::user()->can($permission->name)) {
                $permissions[] = $permission->name;
            }
        }
        return $permissions;
    }

    public function getUserRole()
    {
        $user = Auth::user();
        return $user->roles;
    }

    public function getAllUsersRole($user)
    {
        foreach ($user->roles as $role) {
            return $role->get();
        }
    }



    //    public function managersReference() {
    //        return $this->belongsToMany(
    //            'User',
    //            'managers_reference_pivot',
    //            'user_id',
    //            'developer_id');
    //    }

    public function removeReference(User $user)
    {
        $this->reference()->detach($user->id);
    }
}
