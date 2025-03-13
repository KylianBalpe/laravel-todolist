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
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('todo.add') }}" class="btn btn-primary">Add Todo</a>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">&times;</button>
                                    <div class="row align-items-center">
                                        <i class="fas fa-check mr-2"></i> {{ session('success') }}
                                    </div>
                                </div>
                            @endif
                            <div class="table-responsive m-0">
                                <table class="table table-sm table-bordered table-striped table-hover m-0">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 40px">No</th>
                                            <th>Title</th>
                                            <th>Status</th>
                                            <th class="text-center" style="width: 260px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($todos as $item)
                                            <tr>
                                                <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                                <td class="align-middle">{{ $item->title }}</td>
                                                <td class="align-middle">
                                                    {{ $item->status === 'pending' ? 'Pending' : ($item->status === 'on_progress' ? 'On Progress' : 'Completed') }}
                                                </td>
                                                <td class="text-center align-middle">
                                                    <a href="{{ route('todo.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning">
                                                        <span><i class="fas fa-pencil-alt mr-2"></i>Edit</span>
                                                    </a>
                                                    <form action="{{ route('todo.delete', $item->id) }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            <span><i class="fas fa-trash mr-2"></i>Delete</span>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center p-5">Todo data is empty</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
