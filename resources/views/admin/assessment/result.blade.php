@extends('layouts/admin-main')

@section('title', 'Venidici Online Course Detail')

@section('container')

<!-- Main Content -->
<div id="content">

    <x-adminTopbar />   
    <!-- Begin Page Content -->
    <div class="container-fluid">



        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-0 mb-3 text-gray-800">Fernandha Dzaky's Answer on Assessment 'Test Assessment'</h4>
        </div>
        
        <!-- Content Row -->


        <!-- start of table -->
        
        <div class="row">
            <div class="col-md-12">
                <!-- Begin Page Content -->
                <div class="container-fluid p-0 mt-3">
                    <!-- Page Heading -->


                    <!-- Main Table -->
                    <div class="card shadow mb-4 mt-2">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th class="text-nowrap">User Answer</th>
                                                <th>Right Answer</th>
                                                <th>Option</th>
                                                <th class="text-nowrap">Is User's Answer Right</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td style="text-align:center">
                                                    <i class="fas fa-times-circle" style="color:red"></i> <br>
                                                    <i class="fas fa-check-circle" style="color:green"></i> <br>
                                                    <i class="fas fa-times-circle" style="color:red"></i> <br>
                                                    <i class="fas fa-times-circle" style="color:red"></i> <br>
                                                </td>
                                                <td style="text-align:center">
                                                    <i class="fas fa-check-circle" style="color:green"></i> <br>
                                                    <i class="fas fa-times-circle" style="color:red"></i> <br>
                                                    <i class="fas fa-times-circle" style="color:red"></i> <br>
                                                    <i class="fas fa-times-circle" style="color:red"></i> <br>
                                                </td>
                                                <td class="text-nowrap">
                                                        Debate and agree as a team on definition of the core problem <br>
                                                        Debate and agree as a team on definition of the core problem <br>
                                                        Debate and agree as a team on definition of the core problem <br>
                                                        Debate and agree as a team on definition of the core problem <br>
                                                </td>
                                                <td style="color:red">NO</td>
                                            </tr>

                                            <tr>
                                                <td>2</td>
                                                <td style="text-align:center">
                                                    <i class="fas fa-check-circle" style="color:green"></i> <br>
                                                    <i class="fas fa-times-circle" style="color:red"></i> <br>
                                                    <i class="fas fa-times-circle" style="color:red"></i> <br>
                                                    <i class="fas fa-times-circle" style="color:red"></i> <br>
                                                </td>
                                                <td style="text-align:center">
                                                    <i class="fas fa-check-circle" style="color:green"></i> <br>
                                                    <i class="fas fa-times-circle" style="color:red"></i> <br>
                                                    <i class="fas fa-times-circle" style="color:red"></i> <br>
                                                    <i class="fas fa-times-circle" style="color:red"></i> <br>
                                                </td>
                                                <td class="text-nowrap">
                                                        Debate and agree as a team on definition of the core problem <br>
                                                        Debate and agree as a team on definition of the core problem <br>
                                                        Debate and agree as a team on definition of the core problem <br>
                                                        Debate and agree as a team on definition of the core problem <br>
                                                </td>
                                                <td style="color:green">NO</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
        
                    <!-- /.container-fluid -->

                </div>
            </div>
        </div>
        <!-- end of table -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection
