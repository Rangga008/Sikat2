<!-- resources/views/manager/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Users</h1>

    <h2>Create User</h2>
    <form action="{{ route('manager.createUser') }}" method="POST">
        @csrf
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label for="role">Role:</label>
            <select name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
                <option value="owner">Owner</option>
            </select>
        </div>
        <button type="submit">Create</button>
    </form>

    <h2>All Users</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Actions</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->username }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->role }}</td>
            <td>
                <!-- Update Role -->
                <form action="{{ route('manager.updateRole', $user->id) }}" method="POST">
                    @csrf
                    <select name="role" required>
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>Owner</option>
                    </select>
                    <button type="submit">Update Role</button>
                </form>

                <!-- Delete User -->
                <form action="{{ route('manager.deleteUser', $user->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection