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
                            <h4 class="card-title">Add Business</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('business.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Business Name</label>
                                            <input type="text" name="business_name" id="business_name" class="form-control">
                                            <span class="text-danger">{{ $errors->first('business_name') }}</span>
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
                                            <input type="text" name="email" id="email" class="form-control">
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Open Time</label>
                                            <input id="timeFlatpickr" name="open_time" id="open_time" class="form-control flatpickr flatpickr-input active" type="text" placeholder="Select Time" readonly="readonly">
                                            <span class="text-danger">{{ $errors->first('open_time') }}</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Instagram Id</label>
                                            <input type="text" name="instagram_id" id="instagram_id"class="form-control">
                                            <span class="text-danger">{{ $errors->first('instagram_id') }}</span>
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
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Business Description</label>
                                            <textarea name="description" id="description" class="form-control"></textarea>
                                            <span class="text-danger">{{ $errors->first('description') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="custom-file-container" data-upload-id="BusinessLogo">
                                            <label>Business Logo <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input" name="business_logo" id="business_logo" accept="image/*">
                                                <span class="custom-file-container__custom-file__custom-file-control" ></span>
                                            </label>
                                            <div class="custom-file-container__image-preview d-none" id="business_logo_preview"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="custom-file-container" data-upload-id="BusinessImage">
                                            <label>Business Image <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                            <label class="custom-file-container__custom-file" >
                                                <input type="file" class="custom-file-container__custom-file__custom-file-input" name="business_image" id="business_image" accept="image/*">
                                                <span class="custom-file-container__custom-file__custom-file-control"></span>
                                            </label>
                                            <div class="custom-file-container__image-preview d-none" id="business_image_preview"></div>
                                        </div>
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
            console.log('Business');
            $('#business_logo_preview').removeClass('d-none');
        });
        $('#business_image').on('change',function() {
            $('#business_image_preview').removeClass('d-none');
        })
        var firstUpload = new FileUploadWithPreview('BusinessLogo');
        var firstUpload = new FileUploadWithPreview('BusinessImage');
        var f4 = flatpickr(document.getElementById('timeFlatpickr'), {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
        });
    });
</script>
@endsection