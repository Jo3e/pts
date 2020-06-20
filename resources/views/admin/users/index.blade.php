@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-4">
          <div class="col">
            <h2>User's Management</h2>
          </div>
          <div class="col text-sm-right">
            {{-- <a href="{{ route('admin.users.create') }}" class="btn btn-cvc" role="button">+ New User</a> --}}
          </div>
        </div>

        <div class="table-responsive-sm my-4">
          <table class="table table-bordered table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($users as $user)
              <tr>
                <td scope="row">{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-secondary btn-sm text-capitalize" type="button">
                      {{ implode(' ,' ,$user->roles()->get()->pluck('name')->toArray()) }}
                    </button>
                    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>

                    <div class="dropdown-menu">
                      <a class="dropdown-item btn btn-secondary" href="{{ route('admin.users.edit', $user) }}" role="button">Edit</a>
                      <div class="dropdown-divider"></div>

                      <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button class="dropdown-item btn btn-secondary" type="submit">Delete</button>
                      </form>
                    </div>

                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        {{ $users->links() }}
        <a href="javascript:history.back()">Back</a>
    </div>
@endsection
