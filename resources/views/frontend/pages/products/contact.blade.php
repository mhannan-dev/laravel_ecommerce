@extends('frontend.layouts.front_app')
@section('title')
    Welcome for placing order
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
            <h4>Email Us</h4>
            <form class="form-horizontal">
                <fieldset>
                    <div class="control-group">
                        <input type="text" placeholder="name" class="input-xlarge">
                    </div>
                    <div class="control-group">
                        <input type="text" placeholder="email" class="input-xlarge">
                    </div>
                    <div class="control-group">
                        <input type="text" placeholder="subject" class="input-xlarge">
                    </div>
                    <div class="control-group">
                        <textarea rows="3" id="textarea" class="input-xlarge"></textarea>
                    </div>
                    <button class="btn btn-large" type="submit">Send Messages</button>
                </fieldset>
            </form>
        </div>
@endsection
