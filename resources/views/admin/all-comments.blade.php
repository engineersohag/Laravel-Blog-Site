@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>All Comments</h3>
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
                    <div class="text-tiny">All Comments</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    
                </div>
            </div>
            <div class="table-responsive">
                @if (Session::has('status'))
                    <p class="alert alert-success">{{Session::get('status')}}</p>
                @endif
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Name</th>
                            <th>Blog Titile</th>
                            <th>User Type</th>
                            <th>Comments</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cout = 1;
                        @endphp
                        @foreach ($comments as $comment)
                        <tr>
                            <td>{{$cout++}}</td>
                            <td>{{$comment->user->name}}</td>
                            <td>{{$comment->post->title}}</td>
                            <td>{{ucfirst($comment->user->usertype)}}</td>
                            <td>{{$comment->comment}}</td>
                            <td>
                                <form action="{{route('admin.delete.comment', ['id'=>$comment->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="item delete-btn">
                                        <a href="javascript:void(0)" class="btn btn-danger">Delete</a>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
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