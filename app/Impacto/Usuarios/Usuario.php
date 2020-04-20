<?php

namespace Impacto\Usuarios;

use App\Notifications\Admin\Auth\ResetPassword;
use App\Notifications\Admin\Auth\VerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Impacto\Empresas\Empresa;

class Usuario extends Authenticatable
{
    use Notifiable, SoftDeletes;

    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_raw',
        'nome',
        'email',
        'password',
        'ativo',
        'perfil_id'
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

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function getIdAttribute(){
        return encrypt($this->attributes['id']);
    }

    public function perfil(){

        return $this->belongsTo(Perfil::class, 'perfil_id','id_raw');

    }

}
