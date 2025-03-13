@extends('partials.main')

@section('main-content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex align-items-center">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ $title }}</h1>
                </div>
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /.content-header -->

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('todo.index') }}" class="btn btn-primary">Back to previous page</a>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('todo.update', $todo->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Title" name="title" id="title"
                                        value="{{ old('title', $todo->title) }}">
                                    @error('title')
                                        <div class="invalid-feedback mb-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="status">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option disabled>Select Status</option>
                                        <option value="{{ $todo->status }}" selected>
                                            {{ $todo->status === 'pending' ? 'Pending' : ($todo->status === 'on_progress' ? 'On Progress' : 'Completed') }}
                                        </option>
                                        <option value="pending">Pending</option>
                                        <option value="on_progress">On Progress</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block">Update Todo</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
