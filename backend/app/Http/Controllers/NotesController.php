<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteStoreRequest;
use App\Services\NotesService;

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
        $note_id = $this->notesService->createNoteAndGetID($input);

        if (!$note_id) {
            return response()->json(['message' => 'Something is broken'], 500);
        }
        return response()->json(['message' => 'Note Added!', 'note_id' => $note_id], 201)
            ->header('Location', '/notes/' . $note_id);;
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
