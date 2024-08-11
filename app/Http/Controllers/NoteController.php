<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): Factory|View|Application
    {
        return view('notes.index',[
            'notes' => Note::with('user')
                ->search($request->search)
                ->where('user_id', Auth::id())
                ->whereNull('complete_at')
                ->latest()
                ->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Factory|View|Application
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request): RedirectResponse
    {
        Auth::user()->note()->create($request->validated());

        return to_route('notes.index')->with('success','New note created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note): Factory|View|Application
    {
        return view('notes.show', compact('note'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note): Factory|View|Application
    {
        return view('notes.edit', compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note): RedirectResponse
    {
        $note->update($request->validated());

        return to_route('notes.show', $note->id)->with('success','Note updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note): RedirectResponse
    {
        $note->delete();

        return to_route('notes.index')->with('success','Note deleted successfully');
    }

    public function deleteAll(Request $request): RedirectResponse
    {
        if ($request->checkbox != null)
        {
            Note::destroy($request->checkbox);
            return to_route('complete.index')->with('success','Selected notes deleted successfully');
        }

        return to_route('complete.index')->with('error','Please select one or more records.');
    }
}
