<?php

namespace Tests\Controller;

use App\Models\Notes;
use Illuminate\Http\Response;
use Tests\TestCase;

class NotesControllerTest extends TestCase
{

  public function setUp(): void
  {
    parent::setUp();
  }

  /** @test */
  public function testIndexReturnsDataInValidFormat()
  {

    for ($i = 1; $i <= 5; $i++) {
      Notes::create(
        [
          'title' => $this->faker->sentence,
          'content' => $this->faker->paragraph,
          'autosave' => false
        ]
      );
    }
    $this->json('get', 'api/notes')
      ->assertStatus(Response::HTTP_OK)
      ->assertJsonStructure(
        [
          '*' => [
            'note_id',
            'title',
            'content',
            'autosave',
            'created_at',
            'updated_at',
          ]
        ]

      );
  }

  /** @test */
  public function testNoteIsCreatedSuccessfully()
  {

    $payload = [
      'title' => $this->faker->sentence,
      'content' => $this->faker->paragraph,
      'autosave' => false
    ];

    $this->json('post', 'api/notes', $payload)
      ->assertStatus(Response::HTTP_CREATED)
      ->assertJsonStructure(
        [
          'note_id',
        ]
      );
  }

  /** @test */
  public function testNoteIsNotCreatedIfInvalidData()
  {

    $payload = [
      'title' => null,
      'content' => null,
      'autosave' => false
    ];

    $this->json('post', 'api/notes', $payload)
      ->assertStatus(Response::HTTP_BAD_REQUEST);
  }

  /** @test */
  public function testNoteIsShownCorrectly()
  {
    $note = Notes::create(
      [
        'title' => $this->faker->sentence,
        'content' => $this->faker->paragraph,
        'autosave' => false
      ]
    );

    $this->json('get', "api/notes/$note->note_id")
      ->assertStatus(Response::HTTP_OK)
      ->assertJsonStructure(
        [
          'note_id',
          'title',
          'content',
          'autosave',
          'created_at',
          'updated_at',
        ]
      );
  }

  /** @test */
  public function testNoteIsDeleted()
  {
    $noteData = [
      'title' => $this->faker->sentence,
      'content' => $this->faker->paragraph,
      'autosave' => false
    ];
    $note = Notes::create(
      $noteData
    );

    $this->json('delete', "api/notes/$note->note_id")
      ->assertNoContent();
    $this->assertDatabaseMissing('notes', $noteData);
  }

  /** @test */
  public function testUpdateNoteReturnsCorrectResponse()
  {
    $note = Notes::create(
      [
        'title' => $this->faker->sentence,
        'content' => $this->faker->paragraph,
        'autosave' => false
      ]
    );

    $payload = [
      'title' => $this->faker->sentence,
      'content' => $this->faker->paragraph,
      'autosave' => false
    ];


    $this->json('put', "api/notes/$note->note_id", $payload)
      ->assertStatus(Response::HTTP_OK);
  }
}
