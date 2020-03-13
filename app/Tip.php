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

    public function owner(Model $model)
    {
        return $this->user_id === $model->id;
    }


}
