@extends('layouts.app')

@section('title', 'Chats')
@section('content')

<div class="container">
    <div class="row">
       <div class="col-sm-12"><h1>Your @yield('title')</h1></div>
    </div>
    <div class="row">
        <div class="col-sm-2">
            <h2>Friends List</h2>
        
            {{-- here we can put a list of availabel friends --}}
            @foreach ($users as $u)
            <button data-id="{{$u->user_id}}" class='btn getChat'>{{$u->name}}</button>
            @endforeach
            
        </div>
        <div class="col-sm-10">
            <h1 class='text-center'>Chat Box</h1>
            {{-- need a box with messages hiddne here --}}
            <div id='message_box'>
                <div id="chat_box_container">
                    

                </div>
            </div>
            
        </div>
        
    </div>
   





</div>
<script>

  $(document).ready(function(){

    

    



      // function to add chat, and show box, or get one that already exists

// return personal chat details too
      $('.getChat').click(function(){

          // each button has their id

          let person_one = {{$your_id}};
          let person_two = $(this).data('id');

          

          

        //   console.log(person_two);
        //   console.log(person_one);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",  
            url: "{{url('/make_chat')}}",
            data: JSON.stringify({person_one:person_one,person_two:person_two}),
            success: function(data){  
                //console.log(data);

                $('#chat_box_container').append(data);

                
            },
            error: function(err) { 
                console.log('add chat error')
                console.log(err);
            }       
        });
          
      })
     


      
      //end of doc ready
      


      })
     




  

</script>





@endsection