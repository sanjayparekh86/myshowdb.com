@extends('admin.layouts.app')
@section('content')
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Setting</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="container-fluid">
            <form action="{{ route('setting.createorUpdate', isset($setting) ? $setting->id : null) }}" id="settingForm"
                method="post" enctype="multipart/form-data">
                @if (isset($setting))
                    @method('put')
                @endif
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Site Name</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Site Name" value="{{ isset($setting) ? $setting->name : '' }}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email">Site Email</label>
                                    <input type="text" name="email" id="email" class="form-control"
                                        placeholder="Site Email" value="{{ isset($setting) ? $setting->email : '' }}">
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </form>
        </div>
        <!-- /.card -->
    </section>
@endsection
@section('customJs')
    <script>
        $("#settingForm").submit(function(e) {
            e.preventDefault();

            var form = $(this);
            var action = form.attr("action");
            var method = form.attr("method");
            var formData = new FormData(form[0]);

            var formData = new FormData(form[0]);
            if (method.toLowerCase() !== "post") {
                formData.append("_method", method.toUpperCase());
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
                        window.location.href = "{{ route('setting.index') }}";
                        $("#name").removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback').html("");
                        $("#email").removeClass('is-invalid')
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
                        if (errors['email']) {
                            $("#email").addClass('is-invalid')
                                .siblings('p')
                                .addClass('invalid-feedback').html(errors['email']);
                        } else {
                            $("#email").removeClass('is-invalid')
                                .siblings('p')
                                .removeClass('invalid-feedback').html("");
                        }
                    }
                }
            });
        });

        $("#settingForm input, #settingForm select, #settingForm textarea").on("input", function() {
            $(this).removeClass("is-invalid");
            $(this).siblings("p.invalid-feedback").html("");
        });
    </script>
@endsection
