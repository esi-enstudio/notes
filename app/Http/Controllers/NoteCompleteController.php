<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteCompleteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Factory|View|Application
    {
        return view('complete.index',[
            'notes' => Note::with('user')
                ->search($request->search)
                ->where('user_id', Auth::id())
                ->whereNotNull('complete_at')
                ->latest('complete_at')
                ->paginate(10),
        ]);
    }

    public function complete(Note $note): RedirectResponse
    {
        if (! $note->update(['complete_at' => now()]))
        {
            return redirect()->back()->with('error','Note not completed.');
        }

        return redirect()->back()->with('success','Note completed.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $complete): RedirectResponse
    {
        $complete->delete();

        return to_route('complete.index')->with('success','Note deleted successfully');
    }
}
