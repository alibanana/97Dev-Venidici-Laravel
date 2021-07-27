@extends('layouts/admin-main')

@section('title', 'Venidici Update Bootcamp Schedules')

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
            <h3 class="mb-0 mb-3 text-gray-800"><span style="font-style:italic">Update Bootcamp Schedule</h3>
        </div>

        <!-- Content Row -->

        <!-- start of form -->
        <form action="{{route('admin.bootcampschedule.update',$schedule->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
            <div class="row mt-2 mb-3">
                <div class="col-6">
                    <label for="">Date Start</label>
                    <input type="date" name="date_start" class="form-control" value="{{$schedule->date_start}}">
                </div>
                <div class="col-6">
                    <label for="">Date End</label>
                    <input type="date" name="date_end" class="form-control" value="{{$schedule->date_end}}">
                </div>
                <!-- <div class="col-4"><input type="time" class="form-control"></div> -->
                <div class="col-6 pt-3">
                    <label for="">Schedule Title</label>

                   <input type="text" name="title" value="{{$schedule->title}}" placeholder="Insert Title" class="form-control">
                </div>
                <div class="col-6 pt-3">
                    <label for="">Schedule Sub-Title</label>

                   <input type="text" name="subtitle" value="{{$schedule->subtitle}}" placeholder="Insert Sub Title" class="form-control">
                </div>

                <div class="col-6 pt-3">
                    <label for="">Detail <span style="color: orange">(At least one element must be present!)</span></label>
                    @error('schedule_details')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div id="weekly_schedule_detail_duplicator_wrapper">
                        {{-- Element to be duplicated --}}
                        <div class="row" id="weekly_schedule_duplicator" style="display:none">
                            <div class="col-md-12">
                                <div class="form-group" style="display:flex">
                                    <input type="text" class="form-control form-control-user" placeholder="e.g. Pirate funneling">
                                    <button type="button" onClick="removeDiv(this, 'weekly_schedule_detail_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                        @foreach ($schedule->bootcampScheduleDetails as $detail)

                        <div class="row" id="weekly_schedule_duplicator{{$loop->iteration}}">
                            <div class="col-md-12">
                                <div class="form-group" style="display:flex">
                                    <input type="text" name="schedule_details[]" class="form-control form-control-user" placeholder="e.g. Pirate funneling" required value="{{$detail->description}}">
                                    <button type="button" onClick="removeDiv(this, 'weekly_schedule_detail_duplicator_wrapper')" style="background:none;border:none;color:red" class="bigger-text close-requirement" ><i class="fas fa-trash-alt"></i></button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" id="add_schedule_detail" onlick="duplicateSchedule()" class="" style="background-color:#3F92D8; border-radius:10px;border:none;color:white;padding: 6px 12px;width:100%">Tambah</button> 
                </div>


                <div class="col-12 pt-3">
                   <div style="display:flex;justify-content:flex-end">
                    <button type="submit" class="d-sm-inline-block btn btn-primary shadow-sm text-nowrap" type="submit" >Update Schedule</button>

                   </div>
                </div>
            </div>   
        </form>
        <!-- end of form -->
    

    </div>
    <!-- /.container-fluid -->
</div>

<script>
document.getElementById('add_schedule_detail').onclick = duplicateSchedule;
var i = 1; var original2 = document.getElementById('weekly_schedule_duplicator');
function duplicateSchedule() {
    var clone = original2.cloneNode(true); // "deep" clone
    $(clone).find("input").attr("name","schedule_details[]");
    $(clone).find("input").attr("required", "");
    clone.style.display = "block";
    clone.id = "weekly_schedule_duplicator" + ++i; // there can only be one element with an ID
    original2.parentNode.appendChild(clone);
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
