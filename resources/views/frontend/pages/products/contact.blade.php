@extends('frontend.layouts.front_app')
@section('title')
    Welcome for placing order
@endsection
@section('styles')
    <style>
        strong.error-text {
            color: rgb(250, 8, 8);
        }
    </style>
@endsection
@section('content')
    <div class="span4">
        <h4>{{ $title }}</h4>
        <p> Gulshan,<br> Dhaka, Bangladesh
            <br><br>
            &#xFEFF;Tel 00000-00000<br>
            web: https://github.com/mhannan-dev
        </p>
    </div>
    <div class="span4">
        @include('frontend.partials.flash_msg')
        <h4>Email Us</h4>
        <form class="form-horizontal" action="{{ url('contact') }}" method="post"> @csrf
            <fieldset>
                <div class=" control-group">
                    <input type="text" placeholder="name" class="input-xlarge" name="name">
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            <strong class="error-text">{{ $errors->first('name') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="control-group">
                    <input type="text" placeholder="email" class="input-xlarge" name="email">
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            <strong class="error-text">{{ $errors->first('email') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="control-group">
                    <input type="text" placeholder="subject" class="input-xlarge" name="subject">
                    @if ($errors->has('subject'))
                        <div class="invalid-feedback">
                            <strong class="error-text">{{ $errors->first('subject') }}</strong>
                        </div>
                    @endif
                </div>
                <div class="control-group">
                    <textarea rows="3" id="textarea" class="input-xlarge" name="user_message" placeholder="Message here"></textarea>
                    @if ($errors->has('user_message'))
                        <div class="invalid-feedback">
                            <strong class="error-text">{{ $errors->first('user_message') }}</strong>
                        </div>
                    @endif
                </div>
                <button class="btn btn-large" type="submit">Send Messages</button>
            </fieldset>
        </form>
    </div>
@endsection
