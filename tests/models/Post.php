<?php

namespace nicxonsolutions\Rateable\Tests\models;

use Illuminate\Database\Eloquent\Model;
use nicxonsolutions\Rateable\Rateable;

class Post extends Model
{
    use Rateable;

    public $fillable = ['title', 'body'];

    public function ratings()
    {
        return $this->morphMany(Rating::class, 'rateable');
    }
}
