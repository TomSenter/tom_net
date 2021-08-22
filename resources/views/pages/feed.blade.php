@extends('layouts.app')

@section('title', 'Feed')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              <!--  <div class="card-header">{{ __('Dashboard') }}</div>-->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>Welcome to your feed {{$name}}</h2>
                    <!--here will be the posts from everyone on the site-->

                    {{-- {{ __('Welcome to Tom Net') }} --}}
                </div>


                <div class="card m-auto" style="width: 50rem;">
                    <div class="card-body feed-post">
                      <h5 class="card-title">Post</h5>
                      <form method="POST" action="/feed/post">
                        @csrf
                      <textarea name='post_content' placeholder='What are you thinking about?'></textarea>
                      
                      <button type='submit' class="btn btn-success">Post</button>
                      </form>
                    </div>
                  </div>

                <div class="row profile_posts">

                    @foreach ($posts as $post)
                    <div class="card col-12">
                      <p class='card-body'>{{ $post['post']->post_content }}</p>
                      <p>Post by {{$post['poster']}}</p>
                      @if ($id == $post['post']->user_id)
                      <a href="{{url('/feed/post_delete?post_id='.$post['post']->post_id)}}" class='btn btn-danger'>Delete</a>
                      @endif
            
                    </div>
            
                    @endforeach
            
            
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
