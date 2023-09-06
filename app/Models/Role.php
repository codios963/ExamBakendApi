<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory ;
    use SoftDeletes;

    // ,HasUuids
    protected $fillable=['role_name','uuid'];


    public function users()
    {
        return $this->belongsToMany(User::class,'role_users');
    }

}
