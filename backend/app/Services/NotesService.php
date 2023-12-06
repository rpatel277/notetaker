<?php

namespace App\Services;

use App\Models\Notes;
use Exception;

class NotesService
{
  /**
   * Get all notes.
   *
   * @return \Illuminate\Database\Eloquent\Collection All notes.
   */
  public function getAll()
  {
    return Notes::all();
  }

  /**
   * Get a note by ID.
   *
   * @param int $id The ID of the note.
   *
   * @return \App\Models\Note|null The note if found, otherwise null.
   */
  public function getNoteByID($id)
  {
    return Notes::find($id);
  }

  /**
   * Create a new note.
   *
   * @param array $data The data to create the note.
   *
   * @return bool True if successful, false if an exception occurs.
   */
  public function createNote($data)
  {
    try {
      Notes::create($data);
    } catch (Exception $e) {
      return false;
    }

    return true;
  }

  /**
   * Check if a note exists by ID.
   *
   * @param int $id The ID of the note.
   *
   * @return bool True if the note exists, false otherwise.
   */
  public function noteExists($id)
  {
    return Notes::where('note_id', '=', $id)->exists();
  }

  /**
   * Update a note by ID.
   *
   * @param int $id The ID of the note to update.
   * @param array $data The data to update the note.
   *
   * @return bool True if successful, false if an exception occurs.
   */
  public function updateNote($id, $data)
  {
    try {
      Notes::where('id', '=', $id)->updated($data);
    } catch (Exception $e) {
      return false;
    }

    return true;
  }

  /**
   * Delete a note by ID.
   *
   * @param int $id The ID of the note to delete.
   *
   * @return bool True if successful, false if an exception occurs.
   */
  public function deleteNote($id)
  {
    try {
      Notes::where('id', '=', $id)->delete();
    } catch (Exception $e) {
      return false;
    }

    return true;
  }
}
