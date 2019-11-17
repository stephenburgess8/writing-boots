<?php

namespace App\Http\Controllers;

use App\Note;
use Illuminate\Http\Request;
use App\Repositories\NoteRepository;

class NoteController extends Controller
{
    /**
     * The notes repository implementation.
     *
     * @var NotesRepository
     */
    protected $notes;

    /**
     * @param  NotesRepository  $notes
     * @return void
     */
    public function __construct(NoteRepository $notes)
    {
        $this->notes = $notes;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->notes->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // $this->validate($request, [
       //     'body' => 'required|max:500'
       // ]);

        $input = $request->all();
        // $name = $request->name;
        return $this->notes->create(
            $request->only(
                $this->notes->getModel()->fillable
            )
        );

        return redirect('edit')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
   public function show($id)
   {
       return view('note', $this->notes->show($id));
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        return view('edit', $note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Models\Note  $note
     * @return \Illuminate\Http\Response
     */
   public function update(Request $request, $id)
   {
       // update model and only pass in the fillable fields
       $this->notes->update(
            $request->only(
                $this->notes->getModel()->fillable
            ),
            $id
        );

       return $this->notes->find($id);
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Models\Note  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->notes->delete($id);
    }
}
