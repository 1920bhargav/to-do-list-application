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
                            <a href="{{route('task.create')}}" id="create-new-category" class="btn btn-sm btn-primary btn-theme waves-effect waves-light float-right">
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
@endsection

@section('page_scripts')
    <script type="text/javascript">
        var ajax_url = "{{ route('task.index') }}";
        var delete_url = "{{route('admin.task.destroy')}}";
        var csrf_token = "{{csrf_token()}}";
        var change_status_url = "{{route('admin.task.change_status')}}"
    </script>
    <script src="{{asset('assets/js/pages/task.js')}}"></script>
@endsection
