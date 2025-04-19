@extends('layouts.user')
@section('content')

<style>
    h1{
        font-size: 30px;
        margin-bottom: 20px;
    }
    form .mb-2{
       display: flex;
    }
    form label{
        width: 20%;
        padding-left: 20px;
    }
    form input{
        /* width: 80% !important; */
        border-radius: 5px !important;
    }
    .ck-editor__editable[role="textbox"]{
        min-height: 230px;
    }
    form input[type="file"]{
        padding: .375rem .75rem;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .ck-rounded-corners{
        width: 100% !important;
    }
</style>
    <div class="container my-4">
        <div class="row">
            <div class="col-12 col-lg-10">
                <h1>Create a new Blog</h1>
                <form action="{{route('user.blog.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="mb-2">
                        <label for="blogTitle" class="form-label">Blog Title<span class="text-danger">*</span></label>
                        <input type="text" id="blogTitle" class="form-control" name="name" placeholder="Blog Title" required value="{{old('name')}}">
                    </div>
                    @error('name')
                        <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <div class="mb-2">
                        <label for="category" class="form-label">Category<span class="text-danger">*</span></label>
                        <select name="category" id="category" class="form-select">
                            <option value="" selected>Select a category</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category')
                        <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <div class="mb-3 ps-3 row align-items-center">
                        <label for="image" class="col-sm-2 col-form-label">Blog Photo<span class="text-danger">*</span></label>
                        
                        <div class="col-sm-8">
                            <input type="file" id="image" name="image" class="form-control" onchange="previewImage(event)">
                        </div>
                    
                        <div class="col-sm-2 ms-3 d-flex align-items-center justify-content-center border rounded"
                             style="width: 150px; height: 120px; border: 1px dashed #355CCD;">
                            <img id="profilePreview" src="{{ asset('uploads/posts/') }}"
                                 alt="Select a Photo"
                                 class="img-fluid rounded"
                                 style="max-width: 100%; max-height: 100%; object-fit: contain;">
                        </div>
                    </div>
                    @error('image')
                        <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror
                    <div class="mb-2">
                        <label for="description" class="form-label">Description<span class="text-danger">*</label>
                        <textarea id="description" name="description" rows="8" class="form-control" placeholder="Write your description...">{{old('description')}}</textarea>
                    </div>
                    @error('description')
                        <span class="alert alert-danger text-center">{{$message}}</span>
                    @enderror

                    <input type="submit" value="Upload Blog" class="btn btn-primary px-5 mt-3">
                </form>
            </div>
        </div>
    </div>
@endsection

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('profilePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }

        document.addEventListener("DOMContentLoaded", function () {
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error('CKEditor Error:', error);
                });
        });
    </script>