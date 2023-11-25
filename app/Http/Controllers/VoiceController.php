<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Voice;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class VoiceController extends Controller
{
    public function index()
    {
        $voices = Voice::all();
        if ($voices) {
            return response()->json([
                'status' => 200,
                'data' => $voices
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'not found voices ..'
            ]);
        }
    }
    public function voted()
    {
        $vote = Voice::all();
        if ($vote) {
            return response()->json([
                'status' => 200,
                'data' => $vote
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'not found question ..'
            ]);
        }
        return $vote;
    }

    // untuk vote question dari user lain
    public function voice(Question $question)
    {
        // perlu lakukan perbaikan untuk mengecek apakah question ada atau tidak
        $question = Question::where('id', $question->id)->first();
        if (!$question) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not found question.'
            ], 400);
        }
        // untuk menangani duplikasi vote
        $existingVote = Voice::where(
            'user_id',
            Auth::id()
        )->where('question_id', $question->id)->first();

        if ($existingVote) {
            return response()->json([
                'status' => 'error',
                'message' => 'You have already voted for this question.'
            ], 400);
        } elseif (!$existingVote) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not found question.'
            ], 400);
        }

        // Check if the logged-in user is the owner of the question
        if ($question->user_id == auth()->id()) {
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
    }

    // public function voices(Request $request)
    // {
    //     $request->validate([
    //         'question_id' => 'required|int|exists:questions,id',
    //         'value' => 'required|boolean',
    //     ]);

    //     $question = Question::find($request->post('question_id'));
    //     if (!$question)
    //         return response()->json([
    //             'status' => 404,
    //             'message' => 'not found question ..'
    //         ]);
    //     if ($question->user_id == auth()->id())
    //         return response()->json([
    //             'status' => 500,
    //             'message' => 'The user is not allowed to vote to your question'
    //         ]);

    //     //check if user voted 
    //     $voice = Voice::where([
    //         ['user_id', '=', auth()->id()],
    //         ['question_id', '=', $request->post('question_id')]
    //     ])->first();
    //     if (!is_null($voice) && $voice->value === $request->post('value')) {
    //         return response()->json([
    //             'status' => 500,
    //             'message' => 'The user is not allowed to vote more than once'
    //         ]);
    //     } else if (!is_null($voice) && $voice->value !== $request->post('value')) {
    //         $voice->update([
    //             'value' => $request->post('value')
    //         ]);
    //         return response()->json([
    //             'status' => 201,
    //             'message' => 'update your voice'
    //         ]);
    //     }

    //     $question->voice()->create([
    //         'user_id' => auth()->id(),
    //         'value' => $request->post('value')
    //     ]);

    //     return response()->json([
    //         'status' => 200,
    //         'message' => 'Voting completed successfully'
    //     ]);
    // }
}
