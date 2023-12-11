@extends('layouts.admin')


@section('content')
<style>
    .growl.growl-default {
        background: #2bae35 !important;
        margin-top: 30% !important;
    }
</style>
<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-light-success border-0 mb-4" role="alert"> 
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close" data-dismiss="alert">
                                        <line x1="18" y1="6" x2="6" y2="18"></line>
                                        <line x1="6" y1="6" x2="18" y2="18"></line>
                                    </svg>
                                </button> 
                                <strong>{{ $message }}</strong></div>
                            @endif
                            <span class="card-title" style="font-size: 25px;">Task List</span>
                            {{-- <a href="{{route('task.create')}}" id="create-new-category" class="btn btn-sm btn-primary btn-theme waves-effect waves-light float-right" data-target="#addTaskModal">
                                <i class="mdi mdi-plus-circle"></i> Add Task
                            </a> --}}

                            <a href="#" id="create-new-category" class="btn btn-sm btn-primary btn-theme waves-effect waves-light float-right" data-toggle="modal" data-target="#addTaskModal">
                                <i class="mdi mdi-plus-circle"></i> Add Task
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="dataTables_wrapper dt-bootstrap4">
                                <table class="table table-striped dataTable" id="taskTable">
                                    <thead>
                                        <th> Title </th>
                                        <th> Description </th>
                                        <th> Status </th>
                                        <th> Action </th>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    
            <div class="container">
                    <div class="layout-px-spacing">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h4 class="card-title">Add Task</h4>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('task.store') }}" method="post" id="createTask" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <input type="text" name="title" id="title" class="form-control">
                                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Status</label>
                                                        <select name="status"
                                                            id="status" class="form-control ">
                                                            <option value="Pending">Pending</option>
                                                            <option value="In-progress">In-progress</option>
                                                            <option value="Completed">Completed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea name="description" id="description" class="form-control"></textarea>
                                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mt-3 d-none">
                                                    <img src="" class="border rounded " style="max-width: 100%;" height="150" alt="User avatar" id="profile_picture_preview">
                                                </div>
                                            </div>
                                            <div class="card-footer mt-3">
                                                <button type="submit" class="btn btn-fill btn-outline-primary">Submit</button>
                                                <a href="#" id="cancelBtn" class="btn btn-outline-danger">Cancel</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>        
                        </div>
                    </div>
            </div>
        
</div>

@endsection

@section('page_scripts')
<script>
    $(document).ready(function(){
        $('#cancelBtn').on('click', function() {
            $('#addTaskModal').removeClass('show');
            // Assuming 'taskTable' is the ID of your data table
            var oTable = $('#taskTable').DataTable(); // Use DataTable() instead of dataTable()

            // Reload the DataTable without refreshing the entire page
            oTable.ajax.reload(null, false); // 'false' to prevent page refresh
        });
    });
</script>
<script>
    $(document).ready(function(){
    $('#createTask').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // AJAX request to submit form data
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#addTaskModal').removeClass('show');
                $('#addTaskModal').css('display', 'none'); // Hide the modal upon successful submission
                // Assuming 'taskTable' is the ID of your data table
                var oTable = $('#taskTable').DataTable(); // Use DataTable() instead of dataTable()

                // Reload the DataTable without refreshing the entire page
                oTable.ajax.reload(null, false); // 'false' to prevent page refresh

                // Additional actions based on the response
            },
            error: function(error) {
                // Handle error
                console.error('Error:', error);
            }
        });
    });
});

</script>

    <script type="text/javascript">
        var ajax_url = "{{ route('task.index') }}";
        var delete_url = "{{route('admin.task.destroy')}}";
        var csrf_token = "{{csrf_token()}}";
        var change_status_url = "{{route('admin.task.change_status')}}"
    </script>
    <script src="{{asset('assets/js/pages/task.js')}}"></script>
@endsection
