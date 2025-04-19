@extends('layouts.user')
@section('content')
<div class="blog-container my-5">
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
                        <div class="mt-3 d-flex gap-3">
                            <a href="{{route('user.blog.edit', ['id'=>$blog->id])}}" class="btn btn-primary btn-sm">Update</a>
                            <form action="{{ route('user.blog.delete', ['id' => $blog->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="delete-btn btn btn-danger btn-sm text-light">
                                    Delete
                                </button>
                            </form>
                            
                        </div>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(function(){
        $('.delete-btn').on('click', function(e){
            e.preventDefault();
            var form = $(this).closest('form');

            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete this record?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection

