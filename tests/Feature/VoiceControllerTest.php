<?php

namespace Tests\Feature;

use App\Models\Voice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;


class VoiceControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_index_method_returns_view_with_questions()
    {
        // Arrange
        $questions = Question::factory(3)->create();

        // Act
        $response = $this->get('/questions');

        // Assert
        $response->assertViewIs('question');
        $response->assertViewHas('questions', $questions);
        $response->assertStatus(200);
    }


    // public function test_vote_method_can_submit_vote()
    // {
    //     // Arrange
    //     $user = User::factory()->create();
    //     $question = Question::factory()->create();
    //     Auth::login($user);

    //     // Act
    //     $response = $this->post("/question/vote/{$question->id}");

    //     // Assert
    //     $response->assertStatus(404);
    //     $response->assertRedirect("/question/vote/{$question->id}");
    //     $this->assertDatabaseHas('voices', [
    //         'user_id' => $user->id,
    //         'question_id' => $question->id,
    //         'value' => 1, // Customize this based on your voting system
    //     ]);
    // }

    // public function test_vote_method_cannot_vote_for_own_question()
    // {
    //     // Arrange
    //     $user = User::factory()->create();
    //     Auth::login($user);
    //     $question = Question::factory()->create(['user_id' => $user->id]);

    //     // Act
    //     $response = $this->post("/question/vote/{$question->id}");

    //     // Assert
    //     $response->assertStatus(400);
    //     $response->assertRedirect("/question/vote/{$question->id}");
    //     $this->assertDatabaseMissing('voices', [
    //         'user_id' => $user->id,
    //         'question_id' => $question->id,
    //     ]);
    // }

    // public function test_vote_method_cannot_vote_multiple_times()
    // {
    //     // Arrange
    //     $user = User::factory()->create();
    //     Auth::login($user);
    //     $question = Question::factory()->create();
    //     Voice::factory()->create(['user_id' => $user->id, 'question_id' => $question->id]);

    //     // Act
    //     $response = $this->post("/question/vote/{$question->id}");

    //     // Assert
    //     $response->assertStatus(400);
    //     $response->assertRedirect("/question/vote/{$question->id}");
    //     $this->assertCount(1, Voice::where('user_id', $user->id)->where('question_id', $question->id)->get());
    // }
}
