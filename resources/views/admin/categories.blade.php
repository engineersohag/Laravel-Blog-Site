@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Categories</h3>
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
                    <div class="text-tiny">Categories</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    
                </div>
                <a class="tf-button style-1 w208" href="{{route('admin.categoies.add')}}"><i
                        class="icon-plus"></i>Add new</a>
            </div>
            <div class="wg-table table-all-user">
                <div class="table-responsive">
                    @if (Session::has('status'))
                        <p class="alert alert-success">{{Session::get('status')}}</p>
                    @endif
                    <table class="table text-center table-striped table-bordered">
                        <thead>
                            <tr>
                                <center>
                                    <th width="10%">#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </center>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cout = 1;
                            @endphp
                            @foreach ($categories as $category)
                            <tr>
                                <td>
                                    @php
                                        echo $cout++;
                                    @endphp
                                </td>
                                <td class="pname">
                                    <div class="name">
                                        <a href="#" class="body-title-2">{{$category->name}}</a>
                                    </div>
                                </td>
                                {{-- <td><a href="#" target="_blank">0</a></td> --}}
                                <td>
                                    <div class="list-icon-function">
                                        <a href="{{route('admin.category.edit', ['id'=>$category->id])}}">
                                            <div class="item edit">
                                                <i class="icon-edit-3"></i>
                                            </div>
                                        </a>
                                        <form action="{{route('admin.category.delete', ['id'=>$category->id])}}" method="POST">
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
                    {{$categories->links('pagination::bootstrap-5')}}
                </div>
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