var lastMessageId = 0;
// auto scroll down chatbox when sending a message
function scrollPaubos(){
    var a = document.getElementById('messageThread');
    a.scrollTop = a.scrollHeight;
}

// when choosing a user to message
function openChatBox(user, authUser){
    $('#messageThread').html('<h1 class="text-center"> Loading. . .');

    $('#default_card').hide();
    $('#active_card').show();
    var who = document.getElementById('chatWithName');
    var inputWhoId = document.getElementById('convo_id');
    who.innerHTML = user.name;

    //Check if the conversation exist in database. Create if not
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'GET',
        url: '/checkConvo/'+user.id,
        success: function(response){
            inputWhoId.value = response;
            loadMessagesOfThisConvo();
        },
        error: function(response){
            console.log(error);
        }
    });

    function loadMessagesOfThisConvo(){
        i=0;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            url: '/loadMessage/'+user.id+'/'+authUser,
            success: function(response){
                $('#messageThread').html('');
                //console.log();
                while(response[0][i]!=null){
                    if(response[1][0] == response[0][i].message_users_id ){
                        $('#messageThread').append('<div class="p-2 d-flex"><div class="p-2 recieverBox ml-auto"><p>'+response[0][i].message +'</p></div></div>');
                    }else{
                        $('#messageThread').append('<div class="p-2 d-flex"><div class="p-2 float-left senderBox"><p>'+response[0][i].message +'</p></div></div>');
                    }
                    lastMessageId = response[0][i].id + 1;
                    i++;
                }
                scrollPaubos();
                retrieveMessages();
            }
        });
    }

    function retrieveMessages(){
        i=0;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            url: '/retrieveMessages/'+user.id+'/'+authUser+'/'+lastMessageId,
            success: function(response){
                //console.log(response);
                //console.log(lastMessageId);
                while(response[i]!=null){
                    $('#messageThread').append('<div class="p-2 d-flex"><div class="p-2 float-left senderBox"><p>'+response[i].message +'</p></div></div>');
                    lastMessageId = response[i].id + 1;
                    i++;
                }
                scrollPaubos();
            },
            complete: function(){
                retrieveMessages();
            }
        });
    }
}


function submitMessage(){
    event.preventDefault();
    $('#messageThread').append('<div class="p-2 d-flex"><div class="p-2 recieverBox ml-auto"><p>'+$('#messsageInput').val()+'</p></div></div>');
    // SEND MESSAGE TO THE CHOSEN USER
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: '/sendMessage',
        data:{
            'convo_id': $('#convo_id').val(),
            'message': $('#messsageInput').val()
        },
        success: function(response){
            //console.log(response);
        },
        error: function(response){
            console.log(error);
        }
    });
    $('#messsageInput').val('');
    scrollPaubos();
}

