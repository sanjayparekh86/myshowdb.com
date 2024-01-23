@extends('admin.layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Banner</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('banner.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            @include('admin.message')
            <form action="{{ route('banner.createOrUpdate', $banner->id ?? null) }}" method="post" class="bannerForm"
                id="bannerForm" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" class="form-control"
                                        placeholder="title" value="{{ $banner ? $banner->title : '' }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subtitle">Sub-Title</label>
                                    <input type="text" name="subtitle" id="subtitle" class="form-control"
                                        placeholder="subtitle" value="{{ $banner ? $banner->subtitle : '' }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="link">Link</label>
                                    <input type="url" name="link" id="link" class="form-control"
                                        placeholder="link" value="{{ $banner ? $banner->link : '' }}">
                                    <p></p>
                                </div>
                            </div>
                            @if ($banner)
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control"
                                            placeholder="image" accept=".jpg, .jpeg, .png">
                                        <p></p>
                                    </div>
                                    <div class="image-container">
                                        <img src="{{ asset('storage/banner-upload/' . $banner->image) }}" alt="Image Preview" class="img-fluid">
                                    </div>
                                </div>
                            @else
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control"
                                            placeholder="image" accept=".jpg, .jpeg, .png">
                                        <p></p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Create</button>
                    <a href="{{ route('banner.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
@section('customJs')
    <script>
        $("#bannerForm").submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var action = form.data("action");
            var method = form.attr("method");
            var formData = new FormData(form[0]);

            var formData = new FormData(form[0]);
            if (method.toLowerCase() === "put") {
                formData.append("_method", "PUT");
            }

            $.ajax({
                type: method,
                url: action,
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == true) {
                        window.location.href = "{{ route('banner.index') }}";
                        $("#title").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        $("#subtitle").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        $("#link").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        $("#image").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                    } else {
                        var errors = response['errors'];
                        if (errors['title']) {
                            $("#title").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['title']);
                        } else {
                            $("#title").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }

                        if (errors['subtitle']) {
                            $("#subtitle").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['subtitle']);
                        } else {
                            $("#subtitle").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                        if (errors['link']) {
                            $("#link").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['link']);
                        } else {
                            $("#link").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                        if (errors['image']) {
                            $("#image").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['image']);
                        } else {
                            $("#image").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                    }
                }
            });
        });
    </script>
@endsection
