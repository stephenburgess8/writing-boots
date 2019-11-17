<?php

namespace Models\App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    /**
     * The people repository instance.
     */
    protected $people;

    /**
     * Get the comments for the blog post.
     */
    public function notes()
    {
        return $this->hasMany('Notes');
    }
}