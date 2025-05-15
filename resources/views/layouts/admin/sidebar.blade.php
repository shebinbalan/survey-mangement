<div class="sidebar col-md-2 p-4">
    <h4 class="text-white mb-3">Admin Panel</h4>
    <ul class="list-unstyled">
  <li>
    <a href="{{ route('admin.dashboard') }}">
        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
    </a>
</li>
<li>
    <a href="{{ route('admin.surveys.index') }}">
        <i class="fas fa-poll me-2"></i> Surveys
    </a>
</li>
<li>
    <a href="{{ route('admin.questions.index') }}">
        <i class="fas fa-question-circle me-2"></i> Questions
    </a>
</li>
<li>
    <a href="{{ route('admin.options.index') }}">
        <i class="fas fa-list-ul me-2"></i> Options
    </a>
</li>

<li>
    <a href="{{ route('admin.responses.index') }}">
        <i class="fas fa-list-ul me-2"></i> Responses
    </a>
</li>

    <li><a href="{{ route('admin.users.index') }}"><i class="fas fa-users me-2"></i> Users</a></li>
    <!-- Add more links as needed -->
</ul>

</div>
