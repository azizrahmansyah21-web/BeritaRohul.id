<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name' , 'permissions'] ;

     /****************************************************************** */
        /*============= Relationships ================= */
    /****************************************************************** */
    public function admins()
    {
        return $this->hasMany(Admin::class , 'role_id') ;  
    }
    
    /****************************************************************** */
        /*============= Attribute Accessors ================= */
    /****************************************************************** */
    public function getpermissionsAttribute($permission)
    {
        return json_decode($permission) ;  // get the value of permissions and convert it to array
        Admin::where('role_id' , $this->id)->get() ;
    }
    
}
