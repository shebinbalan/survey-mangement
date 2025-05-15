@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h3>Users</h3>   

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
