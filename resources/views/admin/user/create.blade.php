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
                            <h4 class="card-title">Add User</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('user.store') }}" method="post" id="createUser" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="full_name" id="full_name" class="form-control">
                                            <span class="text-danger">{{ $errors->first('full_name') }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="phone" name="phone" id="phone" class="form-control">
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" id="email1" class="form-control">
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" id="password" class="form-control">
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" id="address" class="form-control"></textarea>
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Profile Picture</label>
                                        <span id="profile_picture_error" class="text-danger"></span>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="profile_picture" id="profile_picture" accept="image/*">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
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