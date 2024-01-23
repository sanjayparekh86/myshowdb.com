@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Page</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('page.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('page.createorUpdate', $page->id ?? null) }}" method="post" id="pageForm" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Name" value="{{$page ? $page->name : ''}}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" name="slug" id="slug" class="form-control"
                                        placeholder="Slug" readonly value="{{$page ? $page->slug : ''}}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="content">Content</label>
                                    <textarea name="content" id="content" class="summernote" cols="30" rows="10">{{$page ? $page->content : ''}}</textarea>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button class="btn btn-primary">Create</button>
                    <a href="{{ route('page.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection
@section('customJs')
    <script>
        $("#name").change(function() {
            element = $(this);
            $.ajax({
                url: '{{ route('getSlug') }}',
                type: 'get',
                data: {
                    title: element.val()
                },
                dataType: 'json',
                success: function(response) {
                    if (response['status'] == true) {
                        $("#slug").val(response["slug"]);
                    }
                }
            });
        });

        $("#pageForm").submit(function(e) {
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
                        window.location.href="{{route('page.index')}}";
                        $("#name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        $("#slug").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        $("#content").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");

                    } else {
                        var errors = response['errors'];
                        if (errors['name']) {
                            $("#name").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['name']);
                        } else {
                            $("#name").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                        if (errors['slug']) {
                            $("#slug").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['slug']);
                        } else {
                            $("#slug").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                        if (errors['content']) {
                            $("#content").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['content']);
                        } else {
                            $("#content").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                    }
                }
            });
        });

        $("#pageForm input, #pageForm select, #pageForm textarea").on("input", function() {
            $(this).removeClass("is-invalid");
            $(this).siblings("p.invalid-feedback").html("");
        });
    </script>
@endsection
