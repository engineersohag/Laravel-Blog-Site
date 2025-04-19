@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>All Blogs</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('home')}}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">All Blogs</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    
                </div>
                <a class="tf-button style-1 w208" href="{{route('admin.blog.add')}}"><i
                        class="icon-plus"></i>Add new</a>
            </div>
            <div class="table-responsive">
                @if (Session::has('status'))
                    <p class="alert alert-success">{{Session::get('status')}}</p>
                @endif
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Post by</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cout = 1;
                        @endphp
                        @foreach ($blogs as $blog)
                        <tr>
                            <td>{{$cout++}}</td>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{asset('uploads/posts')}}/{{$blog->image}}" alt="{{$blog->title}}" class="image">
                                </div>
                            </td>
                            <td>{{$blog->title}}</td>
                            <td>{{$blog->category->name}}</td>
                            <td>{{ucfirst($blog->user->name)}}</td>
                            <td>{{ ucfirst($blog->post_status) }}</td>
                            <td>
                                <div class="list-icon-function">
                                    {{-- <a href="#" target="_blank">
                                        <div class="item eye">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a> --}}
                                    <a href="{{route('admin.blog.edit', ['id'=>$blog->id])}}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>
                                    <form action="{{route('admin.blog.delete', ['id'=>$blog->id])}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="item text-danger delete-btn">
                                            <i class="icon-trash-2"></i>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>

            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{$blogs->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        $(function(){
            $('.delete-btn').on('click', function(e){
                e.preventDefault();
                var form = $(this).closest('form');
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this record?",
                    type: "warning",
                    buttons:["No","Yes"],
                    confirmButtonColor: "#dc3545"
                }).then(function(result){
                    if(result){
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush