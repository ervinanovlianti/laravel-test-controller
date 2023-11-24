<?php

namespace App\Http\Controllers;

use App\Models\Question;

use App\Models\Voice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    //
    public function question()
    {
        $questions = Question::all();
        return response()->json($questions, 200);

        return view('question', compact('questions'));
    }

    public function vote(Question $question)
    {
        $existingVote = Voice::where('user_id', Auth::id())->where('question_id', $question->id)->first();

        if ($existingVote) {
            return redirect()->route('questions', $question->id)->with('error', 'You have already voted for this question.');
            return response()->json([
                'status' => 'error',
                'message' => 'You have already voted for this question.'
            ], 400);
        }

        // Check if the logged-in user is the owner of the question
        if ($question->user_id == auth()->id()) {
            return redirect()->route('questions', $question->id)->with('error', 'You cannot vote for your own question.');
            return response()->json([
                'status' => 'error',
                'message' => 'You cannot vote for your own question.'
            ], 400);
        }

        // Create a new vote
        Voice::create([
            'user_id' => Auth::id(),
            'question_id' => $question->id,
            'value' => 1
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Vote submitted successfully.'
        ], 200);
        


        return redirect()->route('questions', $question->id)->with('success', 'Vote submitted successfully.');
    }
}
