<header class="bg-white shadow-sm p-3">
    <div class="d-flex justify-content-between align-items-center">
        <h3>Admin Dashboard</h3>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Logout</button>
        </form>
    </div>
</header>

