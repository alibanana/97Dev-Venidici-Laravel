@extends('layouts/admin-main')

@section('title', 'Venidici Create Bootcamp')

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
            <h2 class="mb-0 mb-3 text-gray-800">New Bootcamp</h2>
        </div>

        <div class="d-sm-flex align-items-center mb-2">
            <h5 class="mb-0 mb-3 course-link course-link-active" style="cursor:pointer">Basic Informations</h5>
        </div>
        
        <!-- Content Row -->

        <!-- start of form -->
        <form action="{{ route('admin.bootcamp.store') }}" method="POST" enctype="multipart/form-data">
        @csrf           
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control form-control-user"
                            id="title" aria-describedby="" value="{{ old('title') }}"
                            placeholder="Enter couse title" required> 
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Thumbnail</label>
                        <br>
                        <input type="file" name="thumbnail" aria-describedby="" accept=".jpeg,.jpg,.png" required> 
                        @error('thumbnail')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Subtitle</label>
                        <textarea name="subtitle" id="" rows="3" class="form-control" required>{{ old('subtitle') }}</textarea> 
                        @error('subtitle')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Category</label> <br>
                        <select name="course_category_id" id="" class="form-control form-control-user" required>
                            <option disabled selected>Choose Category</option>
                            @foreach ($course_categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                        @error('course_category_id')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                    <p> <span> <a href="{{ route('admin.course-categories.index') }}" target="_blank">Click here</a> </span> to add new category</p>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Embed youtube link for preview  (src only)</label>
                        <input type="text" name="preview_video_link" class="form-control form-control-user" value="{{ old('preview_video_link') }}"
                                id="exampleInputPassword" placeholder="e.g. https://www.youtube.com/embed/DSJlhjZNVpg" required> 
                        @error('preview_video_link')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Zoom link</label>
                        <input type="text" name="link" class="form-control form-control-user" value="{{ old('link') }}"
                                placeholder="e.g. https://meet.google.com/pdq-umxk-fuv" required> 
                        @error('link')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" rows="4"  class="form-control form-control-user" required>{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <!--
                <div class="col-12">
                    <p>Visibility Level</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                        <label class="form-check-label" for="flexRadioDefault1">
                            <span style="font-weight:bold">Public</span> <br>
                            Course is share to every registered teachers in platform.   
                        </label>
                    </div>
                    <div class="form-check" style="margin-top:1.5vw">
                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                        <label class="form-check-label" for="flexRadioDefault2">
                            <span style="font-weight:bold">Private</span> <br>
                            Course is unshared with others teacher. If you want current teacher able to manage this course, course access must be granted explicitly to each teacher by inviting them.
                        </label>
                    </div>
                </div>
                -->
                <div class="col-6" style="margin-top:3vw">
                    <label for="">Persyaratan <span style="color: orange">(At least one element must be present!)</span></label>
                    @error('requirements')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div id="requirement_duplicator_wrapper">
                        {{-- Element to be duplicated --}}
                        <div class="row" id="requirement_duplicator" style="display:none">
                            <div class="col-md-12">
                                <div class="form-group" style="display:flex">
                                    <input type="text" class="form-control form-control-user" placeholder="e,g. Muka lucu dan unik">
                                    <button type="button" onClick="removeDiv(this, 'requirement_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="requirement_duplicator1">
                            <div class="col-md-12">
                                <div class="form-group" style="display:flex">
                                    <input type="text" name="requirements[]" class="form-control form-control-user" placeholder="e,g. Muka lucu dan unik" required>
                                    <button type="button" onClick="removeDiv(this, 'requirement_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add_requirement" onlick="duplicateRequirement()" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 
                </div>

                <div class="col-6" style="margin-top:3vw">
                <label for="">Hashtag <span style="color: orange">(At least one element must be present!)</span></label>
                <p> <span> <a href="/admin/hashtags" target="_blank">Click here</a> </span> to add new hashtag</p>
                @error('hashtags')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div id="hashtag_duplicator_wrapper">
                    {{-- Element to be duplicated --}}
                    <div class="row" id="hashtag_duplicator" style="display:none">
                        <div class="col-md-12">
                            <div class="form-group d-flex">
                                <select class="form-control form-control-user" id="">
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->hashtag }}</option>
                                    @endforeach
                                </select>
                                <button type="button" onClick="removeDiv(this, 'hashtag_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="hashtag_duplicator1">
                        <div class="col-md-12">
                            <div class="form-group d-flex">
                                <select name="hashtags[]" class="form-control form-control-user" id="" required>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->hashtag }}</option>
                                    @endforeach
                                </select>
                                <button type="button" onClick="removeDiv(this, 'hashtag_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" id="add_hashtag" onlick="duplicateHashtag()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 
            </div>

                <!-- <div class="col-6" style="margin-top:3vw">
                    <label for="">Apa yang akan dipelajari? <span style="color: orange">(At least one element must be present!)</span></label>
                    @error('features')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div id="learn_duplicator_wrapper">
                        {{-- Element to be duplicated --}}
                        <div class="row" id="learn_duplicator" style="display:none">
                            <div class="col-md-12">
                                <div class="form-group" style="display:flex">
                                    <input type="text" class="form-control form-control-user" placeholder="e.g. Bisa melawak dengan benar dan tidak garing">
                                    <button type="button" onClick="removeDiv(this, 'learn_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="learn_duplicator1">
                            <div class="col-md-12">
                                <div class="form-group" style="display:flex">
                                    <input type="text" name="features[]" class="form-control form-control-user" placeholder="e.g. Bisa melawak dengan benar dan tidak garing" required>
                                    <button type="button" onClick="removeDiv(this, 'learn_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add_learn" onlick="duplicateLearn()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 
                </div> -->
            </div>
            <!-- <div class="col-6" style="margin-top:3vw">
                <label for="">Hashtag <span style="color: orange">(At least one element must be present!)</span></label>
                <p> <span> <a href="/admin/hashtags" target="_blank">Click here</a> </span> to add new hashtag</p>
                @error('hashtags')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div id="hashtag_duplicator_wrapper">
                    {{-- Element to be duplicated --}}
                    <div class="row" id="hashtag_duplicator" style="display:none">
                        <div class="col-md-12">
                            <div class="form-group d-flex">
                                <select class="form-control form-control-user" id="">
                                    <option value="1">hashtag</option>
                                </select>
                                <button type="button" onClick="removeDiv(this, 'hashtag_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="hashtag_duplicator1">
                        <div class="col-md-12">
                            <div class="form-group d-flex">
                                <select name="hashtags[]" class="form-control form-control-user" id="" required>
                                    <option value="1">hashtag</option>
                                </select>
                                <button type="button" onClick="removeDiv(this, 'hashtag_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" id="add_hashtag" onlick="duplicateHashtag()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 
            </div> -->
            <div class="col-12" style="padding:2vw 1vw">
                <div style="display:flex;justify-content:flex-end">
                    <button type="submit" class="btn btn-primary btn-user p-3">Create New Bootamp</button>
                </div>
            </div>
        </form>
        <!-- end of form -->

    </div>
    <!-- /.container-fluid -->
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<script>
document.getElementById('add_requirement').onclick = duplicateRequirement;
var i = 1;
var original = document.getElementById('requirement_duplicator');
function duplicateRequirement() {
    var clone = original.cloneNode(true); // "deep" clone
    $(clone).find("input").attr("name", "requirements[]");
    $(clone).find("input").attr("required", "");
    clone.style.display = "block";
    clone.id = "requirement_duplicator" + ++i; // there can only be one element with an ID
    original.parentNode.appendChild(clone);
}
</script>
<script>
document.getElementById('add_learn').onclick = duplicateLearn;
var i = 1; var original2 = document.getElementById('learn_duplicator');
function duplicateLearn() {
    var clone = original2.cloneNode(true); // "deep" clone
    $(clone).find("input").attr("name", "features[]");
    $(clone).find("input").attr("required", "");
    clone.style.display = "block";
    clone.id = "learn_duplicator" + ++i; // there can only be one element with an ID
    original2.parentNode.appendChild(clone);
}
</script>
<script>
document.getElementById('add_hashtag').onclick = duplicateHashtag;
var i = 1; var original3 = document.getElementById('hashtag_duplicator');
function duplicateHashtag() {
    var clone = original3.cloneNode(true); // "deep" clone
    $(clone).find("select").attr("name", "hashtags[]");
    $(clone).find("select").attr("required", "");
    clone.style.display = "block";
    clone.id = "hashtag_duplicator" + ++i; // there can only be one element with an ID
    original3.parentNode.appendChild(clone);
}
</script>
<script>
function removeDiv(elem, wrapper_id){
    var parent = $(elem).parent('div').parent('div').parent('div');
    if (document.getElementById(wrapper_id).childElementCount > 2) {
        parent.remove();
    } else {
        alert("At least one element must be present!");
    }
}
</script>
@endsection
