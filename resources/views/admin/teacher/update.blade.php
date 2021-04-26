@extends('layouts/admin-main')

@section('title', 'Venidici Update Teacher')

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
            <h2 class="mb-0 mb-3 text-gray-800">Update Teacher</h2>

        </div>
        
        <!-- Content Row -->
       

        <!-- start of form -->
        
        <form action="/admin/trusted-companies" method="POST" enctype="multipart/form-data">
        @csrf           
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Full Name</label>
                        <input type="text" name="name" class="form-control form-control-user"
                            id="phone" aria-describedby=""
                            placeholder="Here insert teacher name (e.g. Elon Musk)" value="Elon Musk"> 
                        @error('name')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Current Display Picture</label> <br>
                        <img src="/assets/images/client/testimony-image-dummy.png" class="img-fluid" style="width:5vw" alt="">
                        <br>
                        <br>    
                        <p style="margin-bottom:0px">Click button below to change image</p>
                        <input type="file" name="image"> 
                        @error('image')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" rows="4" class="form-control">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Iusto odio quam esse fuga veniam incidunt eveniet. Illo iure nostrum quasi modi, nisi adipisci velit laudantium reiciendis nemo neque minima quod!</textarea>
                        @error('description')
                        <span class="invalid-feedback" role="alert" style="display: block !important;">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror               
                    </div>
                </div>
                <div class="col-12">
                    <div style="display:flex;justify-content:flex-end">
                        <button type="submit"  class="btn btn-primary btn-user p-3">Update Teacher</button>
                    </div>

                </div>

            </div>
        </form>

        <!-- end of form -->
    


    </div>
    <!-- /.container-fluid -->
</div>
@endsection
