@extends('layouts/admin-main')

@section('title', 'Venidici Create Online Course')

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
            <h2 class="mb-0 mb-3 text-gray-800">New Online Course</h2>

        </div>
        <div class="d-sm-flex align-items-center mb-2">
            <h5 class="mb-0 mb-3 course-link course-link-active" style="cursor:pointer">Basic Informations</h5>

        </div>
        
        <!-- Content Row -->
       

        <!-- start of form -->
        
        <form action="/admin/online-courses" method="POST" enctype="multipart/form-data">
        @csrf           
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="name" class="form-control form-control-user"
                        id="phone" aria-describedby=""
                        placeholder="Enter couse title" > 
                    @error('name')
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
                    <input type="file" name="thumbnail"
                        aria-describedby=""> 
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
                    <textarea name="subtitle" id="" rows="3" class="form-control"></textarea> 
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
                    <select name="category" id="" class="form-control form-control-user">
                        <option disabled selected>Choose Category</option>
                        <option value="1">Tech</option>
                        <option value="2">Math</option>
                    </select>
                    @error('category')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
                <p> <span> <a href="/admin/online-courses/course-categories" target="_blank">Click here</a> </span> to add new category</p>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Embed youtube link for preview  (src only)</label>
                    <input type="text" name="video" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="e.g. https://www.youtube.com/embed/DSJlhjZNVpg"> 
                    @error('name')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Assesment</label> <br>
                    <select name="assesment" id="" class="form-control form-control-user">
                        <option selected>No Assesment</option>
                        <option value="1">Quiz of Business Case Room</option>
                        <option value="2">Quiz of Business Plan Room</option>
                    </select>
                    @error('assesment')
                    <span class="invalid-feedback" role="alert" style="display: block !important;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror               
                </div>
                <p> <span> <a href="/admin/online-courses/assesments" target="_blank">Click here</a> </span> to add new assesment</p>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="" rows="4"  class="form-control form-control-user"></textarea>
                    @error('descriptoin')
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
                <label for="">Persyaratan</label>
                <div>
                    <div class="row" id="requirement_duplicator">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="requirement[]" class="form-control form-control-user" id="" placeholder="e,g. Muka lucu dan unik">
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" id="add_requirement" onlick="duplicateRequirement()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 

            </div>
            <div class="col-6" style="margin-top:3vw">
                <label for="">Kamu akan dapat?</label>
                <div>
                    <div class="row" id="advantage_duplicator" >

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="advantage[]" class="form-control form-control-user" id="" placeholder="e.g. 109 Menit Video Ekslusif">
                            </div>
                        </div>
                    
                    </div>
                </div>
                <button type="button" id="add_advantage" onlick="duplicateAdvantage()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 

            </div>
            <div class="col-6" style="margin-top:3vw">
                <label for="">Apa yang akan dipelajari?</label>
                <div>
                    <div class="row" id="learn_duplicator" >

                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" name="learn[]" class="form-control form-control-user" id="" placeholder="e.g. Bisa melawak dengan benar dan tidak garing">
                            </div>
                        </div>
                    
                    </div>
                </div>
                <button type="button" id="add_learn" onlick="duplicateLearn()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 

            </div>
            <div class="col-6" style="margin-top:3vw">
                <label for="">Hashtag</label>
                <p> <span> <a href="/admin/hashtags" target="_blank">Click here</a> </span> to add new hashtag</p>
                <div>
                    <div class="row" id="hashtag_duplicator" >

                        <div class="col-md-12">
                            <div class="form-group">
                                <select name="hashtag[]" class="form-control form-control-user"  id="">
                                    <option value="1">Tech</option>
                                    <option value="2">Math</option>
                                </select>
                            </div>
                        </div>
                    
                    </div>
                </div>
                <button type="button" id="add_hashtag" onlick="duplicateHashtag()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 

            </div>
            <div class="col-12" style="padding:2vw 1vw">
                <div style="display:flex;justify-content:flex-end">
                    <button type="submit"  class="btn btn-primary btn-user p-3">Create New Course</button>
                </div>

            </div>

        </div>
        </form>

        <!-- end of form -->
    


    </div>
    <!-- /.container-fluid -->
</div>

<script>
document.getElementById('add_requirement').onclick = duplicateRequirement;
var i = 0;
var original = document.getElementById('requirement_duplicator');
console.log(original);
function duplicateRequirement() {
    console.log('requirement clicked')
    if(confirm("Are you sure, you want to add more item?")){
        var clone = original.cloneNode(true); // "deep" clone
        $(clone).find("input[type=text], textarea").removeAttr("checked").val('');
        clone.id = "requirement_duplicator" + ++i; // there can only be one element with an ID
        original.parentNode.appendChild(clone);
    } else {

    }
}
</script>
<script>
document.getElementById('add_advantage').onclick = duplicateAdvantage;

var i = 0;
var original2 = document.getElementById('advantage_duplicator');

function duplicateAdvantage() {
    if(confirm("Are you sure, you want to add more item?")){
        var clone = original2.cloneNode(true); // "deep" clone
        $(clone).find("input[type=text], textarea").removeAttr("checked").val('');
        clone.id = "advantage_duplicator" + ++i; // there can only be one element with an ID
        original2.parentNode.appendChild(clone);
    } else {

    }
}
</script>
<script>
document.getElementById('add_learn').onclick = duplicateLearn;

var i = 0;
var original2 = document.getElementById('learn_duplicator');

function duplicateLearn() {
    if(confirm("Are you sure, you want to add more item?")){
        var clone = original2.cloneNode(true); // "deep" clone
        $(clone).find("input[type=text], textarea").removeAttr("checked").val('');
        clone.id = "learn_duplicator" + ++i; // there can only be one element with an ID
        original2.parentNode.appendChild(clone);
    } else {

    }
}
</script>
<script>
document.getElementById('add_hashtag').onclick = duplicateHashtag;

var i = 0;
var original2 = document.getElementById('hashtag_duplicator');

function duplicateHashtag() {
    if(confirm("Are you sure, you want to add more item?")){
        var clone = original2.cloneNode(true); // "deep" clone
        clone.id = "hashtag_duplicator" + ++i; // there can only be one element with an ID
        original2.parentNode.appendChild(clone);
    } else {

    }
}
</script>
@endsection
