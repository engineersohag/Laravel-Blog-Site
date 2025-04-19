@extends('layouts.user')
@section('content')
<div class="home-page">
    <div class="home-layer">
        <div class="container">

            <div class="home-content">
                <h1>Are you ready?</h1>
                <div class="mt-4">
                    <a href="https://youtu.be/LhJjn-EZW30?si=eCBFFfvGHpuKuYLD" target="_blank" class="btn btn-warning me-5">Watch Video</a>
                    <a href="#explore" class="btn btn-outline-light">Explore More</a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- -- blog content --  --}}
<div class="blog-container my-5" id="explore">
    <div class="row">
        <div class="col-12">
        {{-- blog item  --}}
        @if (isset($blogs))
            
            @foreach ($blogs as $blog)
            <div class="blog-item mb-3">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <a href="{{route('blog.details', ['id'=>$blog->id])}}">
                            <img src="{{asset('uploads/posts')}}/{{$blog->image}}" alt="" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-12 col-md-8 p-3">
                        <a href="{{route('blog.details', ['id'=>$blog->id])}}" class="text-dark mb-2" style="font-size: 27px;">
                            <h1 class="fw-bold mb-2">{{$blog->title}}</h1>
                        </a>
                        <div class="blog-content" style="text-align: justify;">
                            {{Str::limit(strip_tags($blog->description), 550) }}
                        </div>
                        <p class="text-secondary mt-2">Category by <span class="text-dark">{{$blog->category->name}}</span> on {{ $blog->created_at->format('F d, Y') }}
                        </p>
                    </div>
                </div>
            </div>   
            @endforeach
            
            @else
                <p>No blogs found.</p>
            @endif
        
            
        </div>
    </div>
    <br>
    @if (isset($blogs))
    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
        {{$blogs->links('pagination::bootstrap-5')}}
    </div>
    @endif
</div>
@endsection