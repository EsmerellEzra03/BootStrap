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
                  <form method="POST" action="{{route('todos:store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                      <label for="text">To-Do Title</label>
                      <input type="text" class="form-control" name="name" aria-describedby="name" value="{{ old('name') }}" placeholder="Enter to-do title">
                      <small id="name" class="form-text text-muted"></small>
                    </div>
                    @if($errors->any())
                      {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                    @endif
                    <div class="form-group" style="margin-top: 10px">
                      <label for="text">Description</label>
                      <input type="text" class="form-control" name="description" value="{{ old('description') }}" placeholder="Description">
                    </div>
                    <div class="form-group" style="margin-top: 10px">
                      <label for="date">Date</label>
                      <input type="date" class="form-control" name="date" value="{{ old('date') }}" placeholder="Choose the date">
                    </div>
                    <div class="form-group" style="margin-top: 10px">
                      <label for="file" class="form-label">Image</label>
                      <input class="form-control" type="file" id="file" name="attachment" value="{{ old('attachment') }}">
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
