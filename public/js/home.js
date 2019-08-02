$(document).ready(function(){
    scrollPaubos();
    function scrollPaubos(){
    var a = document.getElementById('messageThread');
    a.scrollTop = a.scrollHeight;
    }
});

function openChatBox(user, authUser){
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
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            url: '/loadMessage/'+user.id+'/'+authUser,
            success: function(response){
                $('#messageThread').html(response);
                //console.log(response);
            }
        });
    }
}


function submitMessage(){
    event.preventDefault();

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
            console.log(response);
        },
        error: function(response){
            console.log(error);
        }
    });
}

