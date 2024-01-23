@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Inquires</h1>
                </div>
                {{-- <div class="col-sm-6 text-right">
                <a href="create-category.html" class="btn btn-primary">New Category</a>
            </div> --}}
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <form action="" method="get">
                    <div class="card-header">
                        <div class="card-title">
                            <button class="btn btn-default btn-sm" type="button"
                                onclick="window.location.href='{{ route('inquiries.index') }}'">Reset</button>
                        </div>
                        <div class="card-tools">
                            <div class="input-group input-group" style="width: 250px;">
                                <input type="text" value="{{ Request::get('keyword') }}" name="keyword"
                                    class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                </form>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (!empty($inquiry))
                                @foreach ($inquiry as $inquiries)
                                    <tr>
                                        <td>{{ $inquiries->id }}</td>
                                        <td>{{ $inquiries->name }}</td>
                                        <td>{{ $inquiries->email }}</td>
                                        <td>{{ $inquiries->phone }}</td>
                                        <td>
                                            <a href="{{ route('inquiries.show', $inquiries->id) }}">
                                                <svg class="filament-link-icon w-4 h-4 mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 4C6 4 2 12 2 12s4 8 10 8s10-8 10-8s-4-8-10-8zM12 18c-1.11 0-2-0.89-2-2s0.89-2 2-2s2 0.89 2 2S13.11 18 12 18zm0-3c-2.21 0-4-1.79-4-4s1.79-4 4-4s4 1.79 4 4S14.21 15 12 15z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
