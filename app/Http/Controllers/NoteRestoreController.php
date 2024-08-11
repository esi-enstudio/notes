<?php

namespace App\Http\Controllers;


use App\Models\Note;

class NoteRestoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Note $note)
    {
        if (! $note->update(['complete_at' => null]))
        {
            return redirect()->back()->with('error','Note not restored.');
        }

        return redirect()->back()->with('success','Note restored.');
    }
}
