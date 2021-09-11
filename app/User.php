<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use DB;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getpermissionGroups(){
        $permission_grups = DB::table('permissions')
                            ->select('group_name as name')
                            ->groupBy('group_name')
                            ->get();
        return $permission_grups;
    }

    public static function getpermissionsByGroupName($name){
        $permission_grups = DB::table('permissions')
                            ->where('group_name',$name)
                            ->get();
        return $permission_grups;
    }

    public static function roleHasPermissions($role, $permissions){
        $hasPermission = true;
        foreach($permissions as $permission){
            if(!$role->hasPermissionTo($permission->name)){
                return $hasPermission = false;
            }
        }
        return $hasPermission;
    }
}
