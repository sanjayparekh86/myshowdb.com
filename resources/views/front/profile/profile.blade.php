@extends('front.layouts.app')
<style>

</style>
@section('content')
    <div class="hero user-hero">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="hero-ct">
                        <h1>Edward kennedy’s profile</h1>
                        <ul class="breadcumb">
                            <li class="active"><a href="{{route('movies.home')}}">Home</a></li>
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
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="user-information">
                            <div class="user-img">
                                <a href="#"><img src="images/uploads/user-img.png" alt=""><br></a>
                                <a href="#" class="redbtn">Change avatar</a>
                            </div>
                            <div class="user-fav">
                                <p>Account Details</p>
                                <ul>
                                    <li class="active"><a href="userprofile.html">Profile</a></li>
                                    <li><a href="{{route('auth.logout')}}">Log out</a></li>
                                    {{-- <li><a href="userfavoritelist.html">Favorite movies</a></li>
                                    <li><a href="userrate.html">Rated movies</a></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <div class="form-style-1 user-pro" action="#">
                            <form action="#" class="user" id="profileForm">
                                @csrf
                                <h4>01. Profile details</h4>
                                <div class="row">
                                    <div class="col-md-6 form-it">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" placeholder="First Name" value="{{$user->first_name}}">
                                        <p class="error"></p>
                                    </div>
                                    <div class="col-md-6 form-it">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" placeholder="Last Name" value="{{$user->last_name}}">
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-it">
                                        <label>Nick Name</label>
                                        <input type="text" name="nick_name" placeholder="Nick Name" value="{{$user->nick_name}}">
                                        <p class="error"></p>
                                    </div>
                                    <div class="col-md-6 form-it">
                                        <label>Email</label>
                                        <input type="text" name="email" placeholder="Email" value="{{$user->email}}" {{ $isGoogleUser ? 'readonly' : '' }}>
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input class="submit" type="submit" value="save">
                                    </div>
                                </div>
                            </form>
                            <form action="#" class="password" id="changePassword">
                                @csrf
                                <h4>02. Change password</h4>
                                <div class="row">
                                    <div class="col-md-6 form-it">
                                        <label>Old Password</label>
                                        <input type="password" placeholder="Old Password" name="old_password" id="old_password">
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-it">
                                        <label>New Password</label>
                                        <input type="password" placeholder="New Password" name="new_password" id="new_password">
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-it">
                                        <label>Confirm New Password</label>
                                        <input type="password" placeholder="Confirm Password" name="confirm_password" id="confirm_password">
                                        <p class="error"></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <input class="submit" type="submit" value="change">
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
        $("#profileForm").submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "{{ route('user.updateProfile') }}",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    if (response.status == true) {
                        window.location.href = "{{ route('user.profile') }}";
                        $(".error").removeClass('invalid-feedback').html('');
                        $("input[type='text'], select, input[type='number'], input[type='email']")
                            .removeClass('is-invalid');
                    } else {
                        var error = response['errors'];
                        $(".error").removeClass('invalid-feedback').html('');
                        $("input[type='text'], select, input[type='number'], input[type='email']")
                            .removeClass('is-invalid');
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

        $("#profileForm input, #profileForm select, #profileForm textarea").on("input", function() {
            $(this).removeClass("is-invalid");
            $(this).siblings("p.invalid-feedback").html("");
        });

        $("#changePassword").submit(function(e) {
            e.preventDefault();

            $.ajax({
                type: "post",
                url: "{{ route('auth.changePassword') }}",
                data: $(this).serializeArray(),
                dataType: "json",
                success: function(response) {
                    if (response['status'] == true) {
                        window.location.href = "{{ route('user.profile') }}"
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
        $("#changePassword input, #changePassword select, #changePassword textarea").on("input", function() {
            $(this).removeClass("is-invalid");
            $(this).siblings("p.invalid-feedback").html("");
        });
    </script>
@endsection
