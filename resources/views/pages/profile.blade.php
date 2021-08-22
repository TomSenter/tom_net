@extends('layouts.app')

@section('title', 'Profile')
@section('content')


<div class="container-fluid">


    <div class="card m-auto mb-4 profile_card" style="width: 30rem;">
        <img src="{{ $profile_pic }}" class="card-img-top" alt="...">
        <form action="{{('/profile/upload')}}" method="POST" enctype="multipart/form-data">
           @csrf
           <div class="form-control">
          <!-- <label for="profile_img">Upload Profile Pic:</label>-->
            <input type="file" id="profile_img" name="profile_img" accept="image/*">
            <button class='btn btn-info' type="submit">Upload</button>
           </div>
           
          </form>
        <div class="card-body">
          <h5 class="card-title">{{$name}}</h5>
          <ul class='list-group list-group-flush'>
              <li class="list-group-item">Username: {{$username}}</li>
              <li class="list-group-item">Email: {{$email}}</li>
          </ul>
          <a href="{{url('/feed')}}" class="btn btn-primary">Visit the feed</a>
        </div>
      </div>


      <div class="album_upload">
      <form action="{{('/profile/album_photos')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-control">
       <!-- <label for="profile_img">Upload Profile Pic:</label>-->
         <input type="file" id="album_img" name="album_img" accept="image/*">
         <button class='btn btn-success' type="submit">Add to album</button>
        </div>
        
       </form>
      </div>

      <h3 class="text-center">Photo album</h3>
      <div class="photo_grid">
        @foreach ($album_photos as $p)
          <div><img  src="{{$p['photo']}}"  ><a href="{{url('/profile/photo_delete?photo_id='.$p['id'])}}" class='btn btn-danger'>Delete</a>
          </div>
        @endforeach

      </div>


      <div class="card m-auto" style="width: 50rem;">
        <div class="card-body feed-post">
          <h5 class="card-title">Post</h5>
          <form method="POST" action="/profile/post">
            @csrf
          <textarea name='post_content' placeholder='What are you thinking about?'></textarea>
          
          <button type='submit' class="btn btn-success">Post</button>
          </form>
        </div>
      </div>

      <div class="row profile_posts">

        @foreach ($posts as $post)
        <div class="card col-12">
          <p class='card-body'>{{ $post->post_content }}</p>
          <a href="{{url('/profile/post_delete?post_id='.$post->post_id)}}" class='btn btn-danger'>Delete</a>
        </div>

        @endforeach


      </div>

    


</div>




@endsection