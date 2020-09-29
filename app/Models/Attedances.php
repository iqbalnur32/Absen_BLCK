<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
class Attedances extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = "id";
    protected $table = "attendances";
    protected $fillable = ['absend_from', 'absend_to', 'cuttof', 'attachment'];
    // protected $hidden = ['password'];

    public function Keterangan()
    {
    	return $this->hashMany(Users::class);
    }

    public function Absen()
    {
    	return $this->hashMany(Leaves::class);
    }
}