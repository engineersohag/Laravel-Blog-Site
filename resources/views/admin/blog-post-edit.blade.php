@extends('layouts.admin')

@section('content')
<style>
    .ck-editor__editable[role="textbox"]{
        min-height: 230px;
    }
</style>

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Blog Post Infomation</h3>
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
                    <a href="{{route('admin.blog.page')}}">
                        <div class="text-tiny">Blogs</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Edit Blog</div>
                </li>
            </ul>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{route('admin.blog.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$blog->id}}">
                <fieldset class="name">
                    <div class="body-title">Blog Title <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" name="name" tabindex="0" value="{{$blog->title}}" aria-required="true">
                </fieldset>
                @error('name')
                    <span class="alert alert-danger text-center">{{$message}}</span>
                @enderror
                <fieldset class="category">
                    <div class="body-title">Category <span class="tf-color-1">*</span></div>
                    <select name="category" id="">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{$blog->category_id == $category->id ? "selected" : ""}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                </fieldset>
                @error('category')
                    <span class="alert alert-danger text-center">{{$message}}</span>
                @enderror
                <fieldset>
                    <div class="body-title">Upload images <span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        <div class="item" id="imgpreview" style=" min-height: 150px;">
                            <img src="{{asset('uploads/posts')}}/{{$blog->image}}" class="effect8" alt="">
                        </div>
                        <div id="upload-file" class="item up-load">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Drop your images here or select <span
                                        class="tf-color">click to browse</span></span>
                                <input type="file" id="myFile" name="image" accept="image/*">
                            </label>
                        </div>
                    </div>
                </fieldset>
                @error('image')
                    <span class="alert alert-danger text-center">{{$message}}</span>
                @enderror
                <fieldset class="description">
                    <div class="body-title">Blog Description <span class="tf-color-1">*</span></div>
                    
                    <div class="flex-grow">
                        <textarea id="description" name="description" rows="8" placeholder="Write your description...">{{$blog->description}}</textarea>
                    </div>
                </fieldset>
                @error('description')
                    <span class="alert alert-danger text-center">{{$message}}</span>
                @enderror
                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        $(function(){
            $("#myFile").on("change", function(e){
                const photoInp = $("#myFile");
                const [file] = this.files;
                if(file){
                    $("#imgpreview img").attr('src', URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });

        });

        document.addEventListener("DOMContentLoaded", function () {
            ClassicEditor
                .create(document.querySelector('#description'))
                .catch(error => {
                    console.error('CKEditor Error:', error);
                });
        });
    </script>
@endpush