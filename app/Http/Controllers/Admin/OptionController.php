<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Models\Question;
class OptionController extends Controller
{
   
  
      public function index()
    {
        $options = Option::with('question')->latest()->get();
        return view('admin.options.index', compact('options'));
    }

   public function create()
{
    $questions = Question::with('survey')->get();
    return view('admin.options.create', compact('questions'));
}

   public function store(Request $request)
{
    $request->validate([
        'question_id' => 'required|exists:questions,id',
        'options' => 'required|array|min:1',
        'options.*' => 'required|string|max:255'
    ]);

    foreach ($request->options as $optionText) {
        Option::create([
            'question_id' => $request->question_id,
            'option_text' => $optionText
        ]);
    }

    return redirect()->route('admin.options.index')->with('success', 'Options added successfully.');
}

    public function edit($id)
{
    $option = Option::findOrFail($id);
    $questions = Question::with('survey')->get();
    return view('admin.options.edit', compact('option', 'questions'));
}

   public function update(Request $request, $id)
{
    $request->validate([
        'question_id' => 'required|exists:questions,id',
        'option_text' => 'required|string|max:255',
    ]);

    $option = Option::findOrFail($id);
    $option->update($request->only('question_id', 'option_text'));

    return redirect()->route('admin.options.index')->with('success', 'Option updated successfully.');
}


    public function destroy($id)
    {
        $option = Option::findOrFail($id);
        $option->delete();
        return redirect()->route('admin.options.index')->with('success', 'Option deleted successfully.');
    }


    public function reorderOptions(Request $request, $questionId)
{
    $request->validate([
        'order' => 'required|array',
    ]);

    foreach ($request->order as $index => $optionId) {
        Option::where('id', $optionId)->update(['order' => $index + 1]);
    }

    return response()->json(['message' => 'Options reordered successfully.']);
}
}
