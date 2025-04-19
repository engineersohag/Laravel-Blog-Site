@extends('layouts.user')

@section('content')
    <div class="container my-5">
        <div class="title">
            <h3>Blog <span class="text-warning">Details</span> :</h3>
        </div>
        <div class="row mt-3">
            <div class="col-12 col-md-10">
                <div class="row">
                    <div class="col-12">
                        <h2 style="font-size: 30px; margin-bottom: 20px;">{{$blog->title}}</h2>
                        <img src="{{asset('uploads/posts')}}/{{$blog->image}}" alt="" style="height: 400px; width: 100%;">
                        <p class="text-secondary mt-2">Category by <span class="text-dark">{{$blog->category->name}}</span> on {{ $blog->created_at->format('F d, Y') }}</p>
                        <div style="text-align: justify; margin-top: 20px;">
                            {!! $blog->description !!}
                        </div>
                    </div>
                </div>
                @include('home.comments')
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-12">
                <p class="text-warning mt-5">Recent Blog Loading..</p>
            </div>
        </div>
    </div>
@endsection
