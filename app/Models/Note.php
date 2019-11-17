<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /**
     * Get the person that owns the comment.
     */
    public function person()
    {
        return $this->belongsTo('Person');
    }
}