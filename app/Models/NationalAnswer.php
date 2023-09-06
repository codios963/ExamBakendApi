<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NationalAnswer extends Model
{
    use HasFactory ;
    use SoftDeletes;

    // ,HasUuids
    protected $fillable=['answer','national_question_id','status','uuid'];

    public function NationalQuestion()
    {
        return $this->belongsTo(NationalQuestion::class);
    }
}
