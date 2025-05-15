<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Auth;

    class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::where('created_by', Auth::id())->latest()->get();
        return view('admin.surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('admin.surveys.create');
    }

    // public function store(Request $request)
    // {
    //     $request->validate(['title' => 'required']);
    //     Survey::create([
    //         'title' => $request->title,
    //         'description' => $request->description,
    //         'created_by' => Auth::id(),
    //         'time_limit' => $request->input('time_limit'),
    //     ]);
    //     return redirect()->route('admin.surveys.index')->with('success', 'Survey created');
    // }

    
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'translations' => 'required|array',
        'translations.*.title' => 'required|string',
    ]);

    $survey = Survey::create([
        'title' => $request->title,
        'description' => $request->description,
        'created_by' => Auth::id(),
        'time_limit' => $request->input('time_limit'),
    ]);

    foreach ($request->translations as $lang => $transData) {
        $survey->translations()->create([
            'language_code' => $lang,
            'title' => $transData['title'],
            'description' => $transData['description'] ?? '',
        ]);
    }

    return redirect()->route('admin.surveys.index')->with('success', 'Survey created');
}
    
    public function preview($id) {
    $survey = Survey::with('questions.options')->findOrFail($id);
    return view('admin.surveys.preview', compact('survey'));
}

    public function edit(Survey $survey)
    {
        return view('admin.surveys.edit', compact('survey'));
    }

    public function update(Request $request, Survey $survey)
    {
        $request->validate([
        'title' => 'required',
        'translations' => 'required|array',
        'translations.*.title' => 'required|string',
    ]);

    $survey->update($request->only('title', 'description','time_limit'));

    foreach ($request->translations as $lang => $transData) {
        $survey->translations()->updateOrCreate(
            ['language_code' => $lang],
            ['title' => $transData['title'], 'description' => $transData['description'] ?? '']
        );
    }

    return redirect()->route('admin.surveys.index')->with('success', 'Survey updated');
    }

    public function destroy(Survey $survey)
    {
        $survey->delete();
        return back()->with('success', 'Survey deleted');
    }



public function reorderQuestions(Request $request, $surveyId)
{
    $request->validate([
        'order' => 'required|array',
    ]);

    foreach ($request->order as $index => $questionId) {
        Question::where('id', $questionId)->update(['order' => $index + 1]);
    }

    return response()->json(['message' => 'Questions reordered successfully.']);
}
public function showResponses($id)
{
    $survey = Survey::with(['questions.options', 'responses.answers'])->findOrFail($id);

    // Get response summary
    $summary = [];
    foreach ($survey->questions as $question) {
        if ($question->type === 'text') {
            $answers = $question->answers->pluck('answer');
        } else {
            $answers = $question->answers->groupBy('answer')->map->count();
        }

        $summary[] = [
            'question' => $question->text,
            'type' => $question->type,
            'answers' => $answers
        ];
    }

    return view('admin.surveys.responses', compact('survey', 'summary'));
}


}
