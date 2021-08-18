@extends('layouts.app')

@section('title', 'Profile')
@section('content')


<div class="container-fluid">


    <div class="card m-auto mb-4" style="width: 30rem;">
        <img src="{{ $profile_pic }}" class="card-img-top" alt="...">
        <form action="{{('/profile/upload')}}" method="POST" enctype="multipart/form-data">
           @csrf
            <label for="profile_img">Upload Profile Pic:</label>
            <input type="file" id="profile_img" name="profile_img" accept="image/*">
            <button class='btn' type="submit">Upload</button>
           
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


      <div class="card m-auto" style="width: 50rem;">
        <div class="card-body feed-post">
          <h5 class="card-title">What are you thinking about?</h5>
          <form method="POST" action="">
            @csrf
          <textarea placeholder='Type....'></textarea>
          
          <button type='submit' class="btn btn-success">Post</button>
          </form>
        </div>
      </div>

    


</div>




@endsection