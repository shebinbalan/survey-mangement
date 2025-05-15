<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Survey;
class QuestionController extends Controller
{
     public function index()
    {
        $questions = Question::with('survey')->latest()->get();
        return view('admin.questions.index', compact('questions'));
    }

    public function create()
    {
        $surveys = Survey::all();
        return view('admin.questions.create', compact('surveys'));
    }

    public function store(Request $request)
    {
       $request->validate([
            'survey_id' => 'required|exists:surveys,id',
            'question_text' => 'required|string|max:255',
            'type' => 'required|in:text,radio,checkbox',
            'time_limit' => 'required',
        ]);

        Question::create($request->only('survey_id', 'question_text','type','time_limit'));

        return redirect()->route('admin.questions.index')->with('success', 'Question created successfully.');
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $surveys = Survey::all();
        return view('admin.questions.edit', compact('question', 'surveys'));
    }

    public function update(Request $request, $id)
    {
            $request->validate([
            'survey_id' => 'required|exists:surveys,id',
            'question_text' => 'required|string|max:255',
            'type' => 'required|in:text,radio,checkbox',
            'time_limit' => 'required',
        ]);

        $question = Question::findOrFail($id);
        $question->update($request->only('survey_id', 'question_text','type','time_limit'));

        return redirect()->route('admin.questions.index')->with('success', 'Question updated successfully.');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('admin.questions.index')->with('success', 'Question deleted.');
    }
}
