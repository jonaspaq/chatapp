@extends('layouts.app')

@section('stylesheetlist')
<script src="{{ asset('js/jquery_v3.4.1/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/home.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Online Users</div>

                <div class="card-body">
                    <div class="list-group">
                        @foreach($users as $row)
                        <a href="javascript:;" class="list-group-item list-group-action-item"> 
                            <div class="d-flex" style="border:0px solid red">
                                <span id="{{ $row->username }}"> {{ $row->name }} </span>
                                <span class="ml-auto text-muted @if($row->status == 0) redDot @else greenDot @endif"> @if($row->status == 0) Offline @else Online @endif
                                </span>
                            </div>
                        </a>
                        @endforeach
                        
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">(Name of Selected User)</div>

                <div class="card-body messageThread" id="messageThread">

                    <div class="p-2 d-flex" style="border:0px solid red;">     
                        <div class="float-left p-2 mb-2 senderBox">
                            <p> Sender message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever</p>
                        </div>
                    </div>

                    <div class="p-2 d-flex" style="border:0px solid blue;">
                        <div class="p-2 recieverBox ml-auto">
                            <p> This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever </p>
                        </div>
                    </div>

                    <div class="p-2 d-flex" style="border:0px solid red;">     
                        <div class="float-left p-2 mb-2 senderBox">
                            <p> Sender message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever</p>
                        </div>
                    </div>

                    <div class="p-2 d-flex" style="border:0px solid blue;">
                        <div class="p-2 recieverBox ml-auto">
                            <p> This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever </p>
                        </div>
                    </div>

                </div>

                <div class="card-body p-0 m-0" style="border:0px solid black">
                    
                    <form action="{{ route('sendMessage')}}" method="POST">
                        @csrf
                        <input type="hidden" name="reciever_id" value="2">
                        <textarea class="form-control m-0" name="message" id="messsageInput" rows="3" ></textarea>
                        <button type="submit" class="btn btn-primary position-absolute">Send</button>
                    </form>
                </div>

            </div>
        </div>


    </div>
</div>
@endsection
