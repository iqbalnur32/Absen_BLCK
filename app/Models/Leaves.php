<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Leaves extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = "id";
    protected $table = "leaves";
    protected $fillable = ['user_id', 'check_in', 'check_out'];
    // protected $hidden = ['password'];

    public function Absen()
    {
    	return $this->hashMany(Users::class);
    }

    public function Attedances()
    {
    	return $this->belongsTo(Attedances::class, 'id', 'id');
    }
}