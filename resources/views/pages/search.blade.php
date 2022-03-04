@extends('layouts.app')

@section('title', 'Search Users')
@section('content')


<div class="container-fluid">
    
        <form action="/search" method="GET">

            <div class="row">
                <div class="col-sm-4"><input class="form-control"  id="query" name="query" type="search" value={{ request()->get('query')}} /></div>
                <div class='col-sm-2'><button class="btn btn-primary">Go!</button></div>
            </div>


        </form>

        @if($results)

                @if($results->count())
              <h2>Here's what we could find:</h2>
           
              @foreach ($results as $r)
              <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{$image_path.$r->profile_picture}}" alt="No profile picture">
                <div class="card-body">
                  <h5 class="card-title">{{$r->name}}</h5>
                  <p class="card-text">
                      Username: {{$r->username}}
                      Email: {{$r->email}}
                      {{$r->user_id}}
                </p>
                  <a  href="{{url('/profile/'.$r->user_id)}}" class="btn btn-primary">View Profile</a>
                </div>
              @endforeach
              @else 
                <h2>No results found sorry!</h2>
              @endif
        @endif
    
</div>



@endsection