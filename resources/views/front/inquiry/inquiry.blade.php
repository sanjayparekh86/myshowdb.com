@extends('front.layouts.app')
@section('content')
    <div class="hero user-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>Inquiry Section</h1>
                        <ul class="breadcumb">
                            @if (auth()->check())
                                <li class="active"><a href="{{ route('movies.home') }}">Home</a></li>
                            @else
                                <li class="active"><a href="{{ route('front.index') }}">Home</a></li>
                            @endif
                            <li> <span class="ion-ios-arrow-right"></span>Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="buster-light">
        <div class="page-single">
            <div class="container">
                <div class="row ipad-width" style="display: flex; justify-content: center">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <div class="form-style-1 user-pro" action="#">
                            <form action="#" class="user" id="inquiryForm">
                                @csrf
                                <h1 style="display: flex; justify-content: center;">Inquiry Form</h1>
                                <div class="row">
                                    <div class="col-md-12 form-it">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" placeholder="Name"
                                            @if (Auth::check()) value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" readonly @endif>
                                        <p class="error" style="color: red"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-it">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" placeholder="Email"
                                            @if (Auth::check()) value="{{ Auth::user()->email }}" readonly @endif>
                                        <p class="error" style="color: red"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-it">
                                        <label for="phone">Phone</label>
                                        <input type="number" name="phone" id="phone" placeholder="Phone">
                                        <p class="error" style="color: red"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-it">
                                        <label for="message">Message</label>
                                        <textarea class="form-control" rows="3" id="message" name="message" placeholder="Enter Your Message"></textarea>
                                        <p class="error" style="color: red"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input class="submit" type="submit" value="save">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customJs')
    <script>
        $("#inquiryForm").submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "{{ route('inquiry.inquirySubmit') }}",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    if (response['status'] == true) {
                        window.location.href = "{{ route('inquiry.index') }}";
                        $(".error").removeClass('invalid-feedback').html('');
                        $("input[type='text'], select, input[type='number']").removeClass('is-invalid');
                    } else {
                        var error = response['errors'];
                        $(".error").removeClass('invalid-feedback').html('');
                        $("input[type='text'], select, input[type='number']").removeClass('is-invalid');
                        $.each(error, function(key, value) {
                            $(`#${key}`).addClass('is-invalid').siblings('p').addClass(
                                'invalid-feedback').html(value);
                        });
                    }
                },
                error: function(jQXHR, execption) {
                    console.log("Something went wrong");
                }

            });
        });
    </script>
@endsection
