<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
class DashboardController extends Controller
{
   public function index()
{
    $survey = Survey::with(['responses', 'questions.options'])->first();

    $totalResponses = $survey->responses->count();
    $totalAnswers = $survey->responses->pluck('answers')->flatten()->count();

    $pendingResponses = 10;
    $cancelledResponses = 5;

    $chartData = [];

    foreach ($survey->questions as $question) {
        if ($question->type == 'multiple-choice') {
            $answersCount = [];

            foreach ($question->options as $option) {
                $count = 0;
                foreach ($survey->responses as $response) {
                    foreach ($response->answers as $answer) {
                        if ($answer['question_id'] == $question->id && $answer['option_id'] == $option->id) {
                            $count++;
                        }
                    }
                }
                $answersCount[$option->text] = $count;
            }

            $chartData[$question->text] = $answersCount;
        }
    }

    return view('admin.dashboard', compact(
        'survey',
        'totalResponses',
        'totalAnswers',
        'pendingResponses',
        'cancelledResponses',
        'chartData'
    ));
}
}
