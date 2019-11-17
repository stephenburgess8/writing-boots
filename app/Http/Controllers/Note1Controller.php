<?php

namespace App\Http\Controllers;

use Model\User;
use Model\Note;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class Note1Controller extends Controller
{
    /**
     * The notes repository implementation.
     *
     * @var NotesRepository
     */
    protected $notes;

    /**
     * Create a new controller instance.
     *
     * @param  NotesRepository  $notes
     * @return void
     */
    public function __construct(NotesRepository $notes)
    {
        $this->notes = $notes;
    }

    /**
     * Create Note
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $text = $request->input('boots-content');
        $title = $request->input('wb-title');



        $data['frequencies'] = $this->textService->getFrequencies();
        $data['text'] = $text;
        $data['title'] = $title;
        return view('note', $note);
    }

    /**
     * Get Note
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function get($id)
    {
        $note = $this->notes->find($id);
        // $text = $request->input('boots-content');
        // $title = $request->input('wb-title');


        // $data['frequencies'] = $this->textService->getFrequencies();
        // $data['text'] = $text;
        // $data['title'] = $title;
        return view('note', $note);
    }
}
