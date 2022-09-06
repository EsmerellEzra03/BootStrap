@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{ route('home')}}" class="card-header">Dashboard</a>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                  <form action="" method="">
                      <div class="input-group mt-2 p-2">
                          <input type="text" class="form-control" name="keyword" value="" placeholder="Search by Name">
                          <div class="input-group-append">
                              <button class="btn btn-primary" type="submit">Search</button>
                          </div>
                      </div>
                  </form>
                   <h3>To-Do List</h3>
                   <p>You have {{ count($todos) }} pending to-do list</p>
                   <a href="{{ route('todos:create')}}" type="button" class="btn btn-dark">Add To-Do</a>
                    <table class="table table-hover" style="margin-top: 10px">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Decsription</th>
                            <th scope="col">To-Do Date</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach($todos as $key=>$todo)
                          <tr>
                            <th>{{ $key +1 }}</th>
                            <td>{{ $todo->name }}</td>
                            <td>{{ $todo->description }}</td>
                            <td>{{ $todo->date }}</td>
                            <td>
                              @if( !$todo->attachment )
                              No Attachment Chosen
                              @else
                              <img src="{{ asset('storage/'.$todo->attachment) }}" class="img-thumbnail">
                              @endif
                            </td>
                            <td>
                              <a href="{{ route('todos:show',$todo) }}" type="button" class="btn btn-outline-dark" style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Edit</a>

                              <a onclick="return confirm('Are you sure to delete this?')" href="{{ route('todos:destroy',$todo) }}" type="button" class="btn btn-outline-danger" style="--bs-btn-padding-y: .20rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: .75rem;">Delete</a>
                            </td>
                          </tr>
                        </tbody>
                        @endforeach
                      </table>
                      {{ $todos->links() }}
                      <!--<?php echo $todos->links() ;?>-->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection