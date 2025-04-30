<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function authors()
{
    return $this->belongsToMany(Book::class);
}

}
