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
                            <h4 class="card-title">Edit Business</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.business.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Business Name</label>
                                            <input type="text" name="business_name" id="business_name" value="{{ $business_data->business_name }}" class="form-control">
                                            <input type="text" name="business_id" value="{{ $business_data->id }}" hidden>
                                            <span class="text-danger">{{ $errors->first('business_name') }}</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="phone" name="phone" id="phone" value="{{ $business_data->phone }}" class="form-control">
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" name="email" id="email" value="{{ $business_data->email }}" class="form-control">
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Instagram Id</label>
                                            <input type="text" name="instagram_id" id="instagram_id" value="{{ $business_data->instagram_id }}" class="form-control">
                                            <span class="text-danger">{{ $errors->first('instagram_id') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Open Time</label>
                                            <input id="timeFlatpickr" name="open_time" id="open_time" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Time" value="{{ $business_data->open_time }}" readonly="readonly">
                                            <span class="text-danger">{{ $errors->first('open_time') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" id="address" value="{{ $business_data->address }}" class="form-control">{{ $business_data->address }}</textarea>
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Business Description</label>
                                            <textarea name="description" id="description" value="{{ $business_data->description }}" class="form-control">{{ $business_data->description }}</textarea>
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label>Business Logo</label>
                                        <div class="custom-file">
                                            <input type="text" name="old_business_logo" value="{{ $business_data->business_logo }}" hidden>
                                            <input type="file" class="custom-file-input" name="business_logo" id="business_logo" accept="image/*">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Business Image</label>
                                        <div class="custom-file">
                                            <input type="text" name="old_business_image" value="{{ $business_data->business_image }}" hidden>
                                            <input type="file" class="custom-file-input" name="business_image" id="business_image" accept="image/*">
                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-3  {{((!empty($business_data->business_logo)) ? '' : 'd-none')}}">
                                        <img src="{{url('images/'.$business_data->business_logo)}}" class="border rounded " style="max-width: 100%;" height="150" alt="User avatar" id="business_logo_edit">
                                    </div>
                                    <div class="col-md-6 mt-3 {{((!empty($business_data->business_image)) ? '' : 'd-none')}} ">
                                        <img src="{{url('images/'.$business_data->business_image)}}" class="border rounded" height="150" style="max-width: 100%;" alt="User avatar" id="business_image_edit">
                                    </div>
                                </div>
                                <div class="card-footer mt-3">
                                    <button type="submit" class="btn btn-fill btn-outline-primary">Submit</button>
                                    <a href="{{ route('business.index')}}" class="btn btn-outline-danger">Cancle</a>
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
    $(function () {

        $('#business_logo').on('change',function() {
            $('#business_logo_edit').parent().removeClass('d-none');
            readURL(this,'#business_logo_edit');
        });

        $('#business_image').on('change',function() {
            $('#business_image_edit').parent().removeClass('d-none');
            readURL(this,'#business_image_edit');
        })
        
        var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });

    });
</script>
@endsection