<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    const ROLES = [
        'basic'=>'Básico',
        'product'=>'Productos',
        'web'=>'Gestión Web',
        'admin'=>'Administrador',
        'seo'=>'SEO',
        'marketing'=>'Marketing'
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'extra',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'extra'=>'array',
        'email_verified_at'=>'datetime',
    ];

    function getExtensionAttribute() {
        $d = $this->extra;
        return $d['extension'] ?? '';
    }
    function setExtensionAttribute($value) {
        $d = $this->extra;
        $d['extension'] = $value;
        $this->extra = $d;
    }    

}
