@extends('admin.layout')

@section('title', 'Danh sách Tài khoản')

@section('content')
    <div>
        @if(session('message'))
            <div class="alert text-success">
                {{ session('message') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>#ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('users.toggleRole', $user->id) }}" class="btn btn-sm btn-warning">
                                {{ $user->role === 'admin' ? 'Demote to User' : 'Promote to Admin' }}
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
