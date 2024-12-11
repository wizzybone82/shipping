@extends('includes.layout')

@section('content')
<div class="container mt-3">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Manage Users</h2>
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3">Create User</a>
            </div>

            <table class="table table-striped">
                <thead class="table-dark">
                    <tr>
                        <th class="text-nowrap">#</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Email</th>
                        <th class="text-nowrap">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="actionDropdown{{ $user->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                                    Actions
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="actionDropdown{{ $user->id }}">
                                    <!-- Uncomment this line if you want the "View" button -->
                                    <!-- <li><a href="{{ route('users.show', $user) }}" class="dropdown-item">View</a></li> -->
                                    <li><a href="{{ route('users.edit', $user) }}" class="dropdown-item">Edit</a></li>
                                    <li>
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection