<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Note;

class NoteRepository extends Repository
{
    // Constructor to bind model to repo
    public function __construct(Note $note)
    {
        $this->model = $note;
    }
}