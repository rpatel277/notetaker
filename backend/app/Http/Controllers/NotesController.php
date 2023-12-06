<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteStoreRequest;
use App\Models\Notes;
use App\Services\NotesService;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;

class NotesController extends Controller
{

    private NotesService $notesService;
    public function __construct(NotesService $notesService)
    {
        $this->notesService = $notesService;
    }

    /**
     * Retrieve all notes.
     */
    public function index()
    {
        $allNotes = $this->notesService->getAll();
        return response()->json($allNotes, 200);
    }

    /**
     * Retrieve a single note by its ID.
     *
     * @param int $id The ID of the note to retrieve.
     */
    public function show($id)
    {
        $note = $this->notesService->getNoteByID($id);
        if (empty($note)) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        return response()->json($note, 200);
    }

    /**
     * Create a new note based on the request data.
     *
     * @param NoteStoreRequest $request The validated request object.
     */
    public function store(NoteStoreRequest $request)
    {
        $input = $request->validated();
        $success = $this->notesService->createNote($input);

        if (!$success) {
            return response()->json(['message' => 'Something is broken'], 500);
        }
        return response()->json(['message' => 'Note Added!'], 201);
    }

    /**
     * Update an existing note based on the request data and note ID.
     *
     * @param NoteStoreRequest $request The validated request object.
     * @param int $id The ID of the note to update.
     */
    public function update(NoteStoreRequest $request, $id)
    {
        if (!$this->notesService->noteExists($id)) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $input = $request->validated();
        $success = $this->notesService->updateNote($id, $input);
        if (!$success) {
            return response()->json(['message' => 'Something is broken'], 500);
        }

        return response()->json(['message' => 'Note Updated!'], 201);
    }

    /**
     * Delete a note by its ID.
     *
     * @param int $id The ID of the note to delete.
     */
    public function delete($id)
    {
        if (!$this->notesService->noteExists($id)) {
            return response()->json(['message' => 'Note not found'], 404);
        }

        $success = $this->notesService->deleteNote($id);
        if (!$success) {
            return response()->json(['message' => 'Something is broken'], 500);
        }

        return response()->json(['message' => 'Note Deleted!'], 202);
    }
}
