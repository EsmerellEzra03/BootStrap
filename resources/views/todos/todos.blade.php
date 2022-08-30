@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add To-Do</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  <h3>Add To-Do List</h3>
                  <form method="POST" action="{{route('todos:store')}}">
                    @csrf

                    <div class="form-group">
                      <label for="text">To-Do Title</label>
                      <input type="text" class="form-control" name="name" aria-describedby="name" placeholder="Enter to-do title">
                      <small id="name" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group" style="margin-top: 10px">
                      <label for="text">Description</label>
                      <input type="text" class="form-control" name="description" placeholder="Description">
                    </div>
                    <div class="form-group" style="margin-top: 10px">
                      <label for="date">Date</label>
                      <input type="date" class="form-control" name="date" placeholder="Choose the date">
                    </div>
                    <div style="margin-top: 15px">
                    <button type="submit" class="btn btn-success">Add To-Do</button>
                    </div>
                  </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection