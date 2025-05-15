@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h2>Edit Survey</h2>

    <form action="{{ route('admin.surveys.update', $survey->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Survey Title (Default)</label>
            <input type="text" name="title" value="{{ $survey->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Time Limit (in seconds)</label>
            <input type="number" name="time_limit" class="form-control" value="{{ old('time_limit', $survey->time_limit ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Survey Description</label>
            <textarea name="description" class="form-control" rows="4">{{ old('description', $survey->description) }}</textarea>
        </div>

        <!-- English Translation -->
        <div class="mb-3">
            <label for="translations[en][title]" class="form-label">Title (English)</label>
            <input type="text" name="translations[en][title]" value="{{ old('translations.en.title', $survey->translations->where('language_code', 'en')->first()->title ?? '') }}" class="form-control" required>
        </div>

        <!-- Malayalam Translation -->
        <div class="mb-3">
            <label for="translations[ml][title]" class="form-label">Title (Malayalam)</label>
            <input type="text" name="translations[ml][title]" value="{{ old('translations.ml.title', $survey->translations->where('language_code', 'ml')->first()->title ?? '') }}" class="form-control" required>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.surveys.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
