@extends('layouts.app')

@section('content')
      <div class="container">
          <h3 class="text-capitalize my-4">Edit {{ $user->name }} account</h3>

          <div class="row justify-content-center my-4">
              <div class="col-md-8 text-center">
                  <h2 class="text-uppercase"><b>{{ $user->name }}</b></h2>

                  <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                      @csrf
                      {{ method_field('PUT')}}

                      <div class="form-group">
                        <input type="text" name="name" value="{{ $user->name}}" class="form-control @error('name') is-invalid @enderror">
                      </div>

                      <div class="form-group">
                        <input type="email" name="email" value="{{ $user->email }}" class="form-control @error('email') is-invalid @enderror">
                      </div>

                      <div class="form-group row">
                          @foreach ($roles as $role)
                              <div class="col-sm-5 text-center">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Assign role</label>
                              </div>
                              <div class="col-sm-7">
                                    <input type="radio" class="form-check-input" name="roles[]" value="{{ $role->id }}"
                                    {{-- fetch and display users role --}}
                                    @if ($user->roles->pluck('id')->contains($role->id))
                                        checked
                                    @endif >
                                    <label for="role" class="text-capitalize">{{ $role->name }}</label>
                              </div>
                          @endforeach
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary px-5">Update user</button>
                      </div>
                  </form>
              </div>
          </div>
          <a href="javascript:history.back()">Back</a>
      </div>
@endsection
