<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    //
    protected $fillable = ['title','body','user_id','photo'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
