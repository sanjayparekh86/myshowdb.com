@extends('front.layouts.app')
@section('content')
    <div class="hero user-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>Forgot Password</h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="#">Home</a></li>
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
                <div class="row ipad-width">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <div class="form-style-1 user-pro" action="#">
                            <form action="#" class="user" id="passwordForm">
                                @csrf
                                <h4>Fogort Password</h4>
                                <div class="row">
                                    <div class="col-md-6 form-it">
                                        <label>Email</label>
                                        <input type="email" name="email" placeholder="Enter Your Email">
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
    $("#passwordForm").submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: "{{ route('auth.processForgotPassword') }}",
            data: $(this).serializeArray(),
            success: function(response) {
                if (response.status == true) {
                    window.location.href = "{{ route('front.index') }}";
                } else {
                    console.log(response.message);
                    console.log(response.errors);
                }
            }
        });
    });
</script>
@endsection
