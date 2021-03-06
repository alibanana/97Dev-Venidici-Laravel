@extends('layouts/admin-main')

@section('title', 'Venidici Create Blog')

@section('container')

<!-- Main Content -->
<div id="content">

    <x-AdminTopbar />   
    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if (session()->has('message'))
        <div class="alert alert-info alert-dismissible fade show" role="alert" style="font-size: 18px">
            {{ session()->get('message') }}            
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size: 26px">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h2 class="mb-0 mb-3 text-gray-800">Update Blog</h2>

        </div>
        
        <!-- Content Row -->
       

        <!-- start of form -->
        
        <form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data" >

        @csrf   
        @method('PUT')        
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" class="form-control form-control-user"
                        id="title" aria-describedby="" value="{{ $blog->title}}" 
                        placeholder="Here insert blog title" > 
                    @error('title')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Author</label>
                    <input type="text" name="author" class="form-control form-control-user"
                        id="author" aria-describedby="" value="{{$blog->author }}" 
                        placeholder="Here insert blog author" > 
                    @error('author')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Duration in minutes</label>
                    <input type="text" name="duration" class="form-control form-control-user"
                        id="duration" aria-describedby="" value="{{ $blog->duration }}" 
                        placeholder="Here insert blog read duration (e.g. 5)" > 
                    @error('duration')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Hashtag</label>
                    <select name="hashtag" class="form-control form-control-user" id="" >
                        <option value="" selected disabled>Pilih Hashtag</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}" @if($blog->hashtag_id == $tag->id) selected @endif >{{ $tag->hashtag }}</option>
                        @endforeach
                    </select>
                    @error('hashtag')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Current Banner</label> <br>   
                    <img src="{{ asset($blog->banner) }}" style="width:8vw;height:8vw" class="img-fluid" alt=""> <br>   
                    <br>
                    <input type="file" name="banner" aria-describedby="" accept=".jpeg,.jpg,.png" > 
                    @error('banner')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Current Image</label> <br>   
                    <img src="{{ asset($blog->image) }}" style="width:8vw;height:8vw" class="img-fluid" alt=""> <br>   
                    <br>
                    <input type="file" name="image" aria-describedby="" accept=".jpeg,.jpg,.png" > 
                    @error('image')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Short Description</label>
                    <textarea name="short_description" id="" rows="10" class="form-control" placeholder="here insert article Short Description">{{$blog->short_description}}</textarea>
                    @error('short_description')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Body</label>
                    <textarea name="body" id="" rows="10" class="form-control  tinymce-textarea" placeholder="here insert article body">{{$blog->body}}</textarea>
                    @error('body')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-12">
                <div style="display:flex;justify-content:flex-end">
                    <button type="submit"  class="btn btn-primary btn-user p-3">Update Blog</button>
                </div>

            </div>

        </div>
        </form>

        <!-- end of form -->
    


    </div>
    <!-- /.container-fluid -->
</div>

<!-- tinymce JavaScript -->
<script src="https://cdn.tiny.cloud/1/b4mxmojo2bn35i1gse1t6ug1zb4arvlzz7riz4giu0w4p8oh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
        mode : "specific_textareas",
        editor_selector : "tinymce-textarea",
    });
</script>
@endsection
