@extends('layouts/admin-main')

@section('title', 'Venidici Create Assesment')

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
            <h2 class="mb-0 mb-3 text-gray-800">New Assessment</h2>
        </div>
        <div class="d-sm-flex align-items-center mb-2">
            <h5 class="mb-0 mb-3 course-link course-link-active" style="cursor:pointer">Basic Informations</h5>
        </div>
        
        <!-- Content Row -->

        <!-- start of form -->
        <form action="{{ route('admin.assessments.store') }}" method="POST">
        @csrf           
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" name="title" class="form-control form-control-user"
                            id="phone" aria-describedby="" value="{{ old('title') }}"
                            placeholder="Enter assesment title" required> 
                        @error('title')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Duration (minutes)</label>
                        <input type="number" name="duration" class="form-control form-control-user"
                            id="duration" aria-describedby="" value="{{ old('duration') }}"
                            placeholder="e.g. 10" required> 
                        @error('duration')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Description</label> <br>
                        <textarea name="description" id="" class="form-control" rows="5" required>{{ old('description') }}</textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert" style="display: block !important;">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-6">
                    <label for="">Assessment's Requirements <span style="color: orange">(At least one element must be present!)</span></label>
                    @error('requirements')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div id="requirement_duplicator_wrapper">
                        {{-- Element to be duplicated --}}
                        <div class="row" id="requirement_duplicator" style="display:none">
                            <div class="col-md-12">
                                <div class="form-group d-flex"> 
                                    <input type="text" class="form-control form-control-user" placeholder="Enter Student Requirement">
                                    <button type="button" onClick="removeDiv(this, 'requirement_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="requirement_duplicator1">
                            <div class="col-md-12">
                                <div class="form-group d-flex"> 
                                    <input type="text" name="requirements[]" class="form-control form-control-user" placeholder="Enter Student Requirement" required>
                                    <button type="button" onClick="removeDiv(this, 'requirement_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="button" id="add_requirement" onlick="duplicateRequirement()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Add more requirement</button> 
                </div>

                <div class="col-12" style="padding:2vw 1vw">
                    <div style="display:flex;justify-content:flex-end">
                        <button type="submit"  class="btn btn-primary btn-user p-3">Create New Assessment</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- end of form -->

    </div>
    <!-- /.container-fluid -->
</div>

<script>
document.getElementById('add_requirement').onclick = duplicateHashtag;
var i = 1; var original3 = document.getElementById('requirement_duplicator');
function duplicateHashtag() {
    var clone = original3.cloneNode(true); // "deep" clone
    $(clone).find("input").attr("name", "requirements[]");
    $(clone).find("input").attr("required", "");
    clone.style.display = "block";
    clone.id = "requirement_duplicator" + ++i; // there can only be one element with an ID
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
