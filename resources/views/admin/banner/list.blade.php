@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Banners</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <label for="">
                        Latest Trailer
                        <input type="checkbox" name="banner">
                    </label>
                    <a href="{{ route('banner.create') }}" class="btn btn-primary">New Banner</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: 250px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th width="60">ID</th>
                                <th width="80"></th>
                                <th>Titile</th>
                                <th>Subtitle</th>
                                <th>link</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($banner->isNotEmpty())
                                @foreach ($banner as $banners)
                                    <tr>
                                        <td>{{$banners->id}}</td>
                                        <td><img src="{{ asset('storage/banner-upload/' . $banners->image) }}" class="img-thumbnail" width="50"></td>
                                        <td><a href="#">{{$banners->title}}</a></td>
                                        <td>{{$banners->subtitle}}</td>
                                        <td>{{$banners->link}}</td>
                                        <td>
                                            <a href="{{route('banner.create', $banners->id)}}">
                                                <svg class="filament-link-icon w-4 h-4 mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path
                                                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                    </path>
                                                </svg>
                                            </a>
                                            <a href="#" onclick="deleteBanner({{$banners->id}})" class="text-danger w-4 h-4 mr-1">
                                                <svg wire:loading.remove.delay="" wire:target=""
                                                    class="filament-link-icon w-4 h-4 mr-1"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" aria-hidden="true">
                                                    <path ath fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd"></path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <td>No Record Found</td>
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination m-0 float-right">
                        {{$banner->links()}}
                        {{-- <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
@endsection
@section('customJs')
    <script>
        function deleteBanner(id) {
            var url = '{{ route('banner.delete', 'ID') }}';
            var newUrl = url.replace("ID", id);
            // return false;
            if (confirm("Are You Sure to want to Delete")) {
                $.ajax({
                    url: newUrl,
                    type: 'delete',
                    data: {},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        if (response["status"] == true) {
                            window.location.href = "{{ route('banner.index') }}";
                        }
                    }
                });
            }
        }
    </script>
@endsection
