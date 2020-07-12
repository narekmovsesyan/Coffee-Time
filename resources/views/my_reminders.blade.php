@extends('layouts.app')
@section('styles')
    @include('layouts.links')
@endsection
@section('content')
    <div class="container">
        <div class="wrapper fadeInDown">
            <div id="ReminderData">
                <div class="fadeIn first">
                    <img src="/images/coffee-time-logo.jpg" id="icon" alt="User Icon"/>
                    <h1>Coffee Time</h1>
                </div>

                <div class="row">
                    <div class="col-md-9 col-md-offset-1-5">
                        @if(session()->exists('messages'))
                            <div class="text-success">
                                {{session('messages')}}
                            </div>
                        @endif

                        @if(isset($my_reminders))
                            @foreach($my_reminders as $reminder)
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col" class="text-center">Date</th>
                                            <th scope="col">Reminded</th>
                                            <th scope="col" class="text-center">Send time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{$reminder->date_time}}</td>
                                            <td class="text-left">{{$reminder->status ? 'Reminded' : 'Not Reminded'}}</td>
                                            <td>{{$reminder->updated_at}}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                            @endforeach
                        @else
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">Date</th>
                                        <th scope="col">Reminded</th>
                                        <th scope="col" class="text-center">Created</th>
                                    </tr>
                                    </thead>
                                </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
