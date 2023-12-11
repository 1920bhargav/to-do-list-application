@extends('layouts.admin')

@section('content')
<style>
    input #file-upload-button{opacity: 0;}
</style>
<div class="container">
    <div class="container">
        <div class="layout-px-spacing">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-3">
                        <div class="card-header">
                            <h4 class="card-title">Edit Task</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.task.update') }}" id="editeUser" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="title" value="{{ $user_data->title }}" id="title" class="form-control">
                                            <input type="text" name="user_id" value="{{ $user_data->id }}" hidden>
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
                                            <textarea name="description" id="description" value="{{ $user_data->description }}" class="form-control">{{ $user_data->address }}</textarea>
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer mt-3">
                                    <button type="submit" class="btn btn-fill btn-outline-primary">Submit</button>
                                    <a href="{{ route('user.index')}}" class="btn btn-outline-danger">Cancel</a>
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
    var ajax_url = null;
</script>
<script src="{{asset('assets/js/pages/users.js')}}"></script>
@endsection