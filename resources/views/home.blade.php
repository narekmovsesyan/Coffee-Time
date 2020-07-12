@extends('layouts.app')
@section('styles')
    @include('layouts.links')
@endsection
@section('content')
    <div class="container">
        <div class="wrapper fadeInDown">
            <div id="formContent">
                <div class="fadeIn first">
                    <img src="/images/coffee-time-logo.jpg" id="icon" alt="User Icon"/>
                    <h1>{{ ucfirst(Auth::user()->name).'`s' }} Coffee Time</h1>
                </div>

                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        @if(session()->exists('messages'))
                                <div class="text-success">
                                    {{session('messages')}}
                                </div>
                        @endif
                        <form method="POST" action="{{ route('save-reminder') }}">
                            @csrf
                            <div class="form-control text-left">
                                {{Auth::user()->email}}
                            </div>
                            <input type="text" name="time" class="mt-2 form-control datetimepicker {{ $errors->has('time') ? 'has_errors' : ''  }}" required
                                   placeholder="time">

                            @if ($errors->any())
                                <div class="alert alert-danger mt-2">
                                    @foreach ($errors->all() as $error)
                                        <div class="li-style">{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif

                            <div class="text-center mt-2">
                                <input type="submit" class="save-button" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
