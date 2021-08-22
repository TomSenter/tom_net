<div>
    @foreach ($chat_names as $c)
    <h1>{{$c}}</h1>
    @endforeach
    <input  type='hidden' id='chat_id' value='{{$chat_id}}'/>

    <div id='message_lists'>
    @foreach ($messages as $m)
    @if ($m['active']=='true')
        <input type="hidden" class="message_id" value="{{$m['message_id']}}">
            @if ($m['user_id'] == $m['sender'] )
            <div style="background: violet;" class="sender_message card">
                <div class="card-body">
                    {{$m['content']}} {{$m['sender_name']}}
                </div>
            </div>
            @else
                <div style="background: lightblue" class="receiver_message card">
                    <div class="card-body">
                        {{$m['content']}} {{$m['sender_name']}}
                    </div>
                </div>

            @endif
    @else 
    <input type="hidden" class="message_id" value="no_message">
    <div style="background: lightgreen;" class="card">
        <div class="card-body">
            No messages in chat yet, send one to get started
        </div>
    </div>



      @endif
    @endforeach
    </div>
    <div class="message_poster">
        <textarea name="post_message" id="post_message" placeholder="Send a message" ></textarea>
        <button type='button' id='send_message'  class='btn btn-info'>Send Message</button>
</div>

</div>
<script>

   


// function getNewMessages(){
//             let chat_id = $('#chat_id').val();

//             let message_id_array =$('.message_id').map((_,el) => el.value).get()
//             console.log(message_id_array);



            
//             $.ajax({
//                 type: "POST",  
//                 url: "{{url('/chat/new_messages')}}",
//                 data:JSON.stringify({chat_id:chat_id,message_id_array:message_id_array}),
//                 success: function(data){  
//                     console.log(data);

                    
//                     if(data.messages){

//                        data.messages.each(function(m){

//                         let html = '<input type="hidden" class="message_id" value="'+m.message_id+'">';
//                      html += '<div style="background: lightgreen;" class="receiver_message card">';
//                     html+= '<div class="card-body">';
//                        html+= m.content+' '+m.sender_name;
//                     html+='</div>';
//                 html+='</div>';

//                 $('#message_lists').append(html);

//                        });

                      

                    
                    
//                     }else{
//                         return;
//                     }


                   




//                 },
//                 error: function(err) { 
//                     console.log('new message error')
//                     console.log(err);
//                 }   


//                 });


//         }

//          // set interval 

       

//         setInterval(getNewMessages, 3000);

    $(document).ready(function(){

       // getNewMessages();

       Echo.channel('private-chat')
                    .listen('.message-sent', (e) => {

                        console.log(e);
                        let html = '<input type="hidden" class="message_id" value="'+e.message.message_id+'">';
                     html += '<div style="background: violet;" class="sender_message card">';
                    html+= '<div class="card-body">';
                       html+= e.message.message_content+' '+e.user.sender;
                    html+='</div>';
                html+='</div>';

                $('#message_lists').append(html);
                    });



        $('#send_message').click(function(){

                let chat_id = $('#chat_id').val();
                let message_content = $('#post_message').val();
                //console.log(chat_id);


                $.ajax({
                    headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
                type: "POST",  
                url: "{{url('/chat/send_message')}}",
                data:JSON.stringify({chat_id:chat_id,message_content:message_content}),
                success: function(data){  
                     console.log(data);

                    //  let message = [];

                    //                     Echo.channel('private-chat')
                    // .listen('.message-sent', (e) => {

                    //     console.log(e);
                    //     message.push({
                    //     message: e.message.message,
                    //     user: e.user
                    //     });
                    // });

                    // console.log(message);

                //     let html = '<input type="hidden" class="message_id" value="'+data.message_id+'">';
                //      html += '<div style="background: violet;" class="sender_message card">';
                //     html+= '<div class="card-body">';
                //        html+= data.content+' '+data.sender_name;
                //     html+='</div>';
                // html+='</div>';

                // $('#message_lists').append(html);




                },
                error: function(err) { 
                    console.log('send message error')
                    console.log(err);
                }   


                });
       
      
        })



        // setinterval to get any new messages
       



         // end of doc
    })

</script>