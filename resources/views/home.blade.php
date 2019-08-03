@extends('layouts.app')

@section('stylesheetlist')
<script src="{{ asset('js/jquery_v3.4.1/dist/jquery.min.js') }}"></script>
<script src="{{ asset('js/home.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <!-- LIST OF ONLINE USERS -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header"> Online Users </div>

                <div class="card-body">
                    <div class="list-group">
                        @foreach($users as $row)
                        <a href="javascript:;" onclick="openChatBox({{$row}},{{Auth::user()->id}});" class="list-group-item list-group-action-item"> 
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

        <div class="col-md-8" id="default_card">
            <div class="card">
                <div class="card-header"> Choose a conversation</div>
                <div class="card-body">
                    <h1 class="text-primary"> Please choose a user to message.</h1>
                </div>
            </div>
        </div>

        <!-- CHAT BOX OF THE SELECTED USER -->
        <div class="col-md-8" id="active_card" style="display:none;">
            <div class="card">
                <div class="card-header" id="chatWithName">(Name of Selected User)</div>

                <div class="card-body messageThread" id="messageThread">
                    <h1 id="loadingMessages">Loading . . .</h1>
                    <!-- <div class="p-2 d-flex">     
                        <div class="float-left p-2 mb-2 senderBox">
                            <p> Sender message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever</p>
                        </div>
                    </div>

                    <div class="p-2 d-flex">
                        <div class="p-2 recieverBox ml-auto">
                            <p> This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever message!This is the reciever </p>
                        </div>
                    </div> -->

                </div>

                <div class="card-body p-0 m-0" style="border:0px solid black">
                    
                    <form method="POST" onsubmit="submitMessage();">
                        @csrf
                        <div style="display:block;">
                        <input type="hidden" id="convo_id" name="convo_id" required>
                        <input class="form-control m-0" name="message" id="messsageInput" rows="3" required>
                        <button type="submit" class="btn btn-primary" id="sendMsgBtn">Send</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>


    </div>
</div>
@endsection
