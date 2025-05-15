<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Response;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class UserSurveyController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        $totalSurveys = Survey::where('status', 1)->count();

        $responses = Response::with('survey')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $responseCount = Response::where('user_id', $user->id)->count();

        return view('user.dashboard', compact('totalSurveys', 'responses', 'responseCount'));
    }

    public function index()
    {
        $surveys = Survey::where('status', true)->latest()->get();
        return view('user.surveys.index', compact('surveys'));
    }

    public function showQuestion($id, $index)
{
    $lang = request('lang', 'en'); // default to English

    $survey = Survey::with(['questions.options', 'translations'])->findOrFail($id);
    $totalQuestions = $survey->questions->count();

    if (!isset($survey->questions[$index])) {
        abort(404, 'Question not found.');
    }

    // Use translation if available
    $translation = $survey->translations->where('language_code', $lang)->first();
    $survey->title = $translation->title ?? $survey->title;
    $survey->description = $translation->description ?? $survey->description;

    $progress = round((($index + 1) / $totalQuestions) * 100);
    $currentQuestion = $survey->questions[$index];

    return view('user.surveys.show_question', compact('survey', 'currentQuestion', 'progress', 'index', 'totalQuestions', 'lang'));
}

// public function showQuestion($id, $index)
// {
//     $survey = Survey::with('questions.options')->findOrFail($id);
//     $totalQuestions = $survey->questions->count();

//     if (!isset($survey->questions[$index])) {
//         abort(404, 'Question not found.');
//     }

//     $progress = round((($index + 1) / $totalQuestions) * 100);
//     $currentQuestion = $survey->questions[$index];

//     return view('user.surveys.show_question', compact('survey', 'currentQuestion', 'progress', 'index', 'totalQuestions'));
// }
public function show($id)
{
    $survey = Survey::with('questions.options')->findOrFail($id);
    $progress = 100; // all questions on one page
    return view('user.surveys.show', compact('survey', 'progress'));
}
// public function submitAnswer(Request $request, $survey_id, $question_id)
// {
//     $survey = Survey::findOrFail($survey_id);
//     $question = Question::findOrFail($question_id);

//     // Get or create a response for this user and survey
//     $response = Response::firstOrCreate(
//         [
//             'survey_id' => $survey->id,
//             'user_id' => auth()->id(),
//         ],
//         [
//             'submitted_at' => now(),
//         ]
//     );

//     // Save the answer
//     $answer = new Answer();
//     $answer->survey_id = $survey->id;
//     $answer->question_id = $question->id;
//     $answer->user_id = auth()->id();
//     $answer->response_id = $response->id; // ✅ Fix: assign response_id
//     $answer->answer_text = is_array($request->answer) ? json_encode($request->answer) : $request->answer;
//     $answer->save();

//     // Redirect to next question
//     $questions = $survey->questions;
//     $currentIndex = $questions->search(fn($q) => $q->id == $question->id);
//     $nextIndex = $currentIndex + 1;

//     if ($nextIndex < $questions->count()) {
//         return redirect()->route('user.surveys.question', ['id' => $survey->id, 'index' => $nextIndex]);
//     }

//     return redirect()->route('user.surveys.thankyou');
// }

 public function submitAnswer(Request $request, $survey_id, $question_id)
{
    $survey = Survey::findOrFail($survey_id);
    $question = Question::findOrFail($question_id);

    $response = Response::firstOrCreate(
        [
            'survey_id' => $survey->id,
            'user_id' => auth()->id(),
        ],
        [
            'submitted_at' => now(),
        ]
    );

    $answer = new Answer();
    $answer->survey_id = $survey->id;
    $answer->question_id = $question->id;
    $answer->user_id = auth()->id();
    $answer->response_id = $response->id;
    $answer->answer_text = is_array($request->answer) ? json_encode($request->answer) : $request->answer;
    $answer->save();

    // Redirect to next question
    $questions = $survey->questions;
    $currentIndex = $questions->search(fn($q) => $q->id == $question->id);
    $nextIndex = $currentIndex + 1;

    if ($nextIndex < $questions->count()) {
        return redirect()->route('user.surveys.question', [
            'id' => $survey->id,
            'index' => $nextIndex,
            'lang' => $request->lang ?? 'en'
        ]);
    }

    return redirect()->route('user.surveys.thankyou');
}
   
}
