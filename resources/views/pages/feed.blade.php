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

                    <h2>{{$name}}</h2>  <h2>{{$email}}</h2>
                    <!--here will be the posts from everyone on the site-->

                    {{-- {{ __('Welcome to Tom Net') }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
