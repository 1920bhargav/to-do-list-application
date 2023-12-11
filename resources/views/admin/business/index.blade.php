@extends('layouts.admin')


@section('content')
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
                            <span class="card-title" style="font-size: 25px;">Business List</span>
                            <a href="{{route('business.create')}}" id="create-new-category" class="btn btn-sm btn-primary waves-effect waves-light float-right">
                                <i class="mdi mdi-plus-circle"></i> Add Business
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="dataTables_wrapper dt-bootstrap4">
                                <table class="table table-striped dataTable" id="businessTable">
                                    <thead>
                                        <th> Business Name </th>
                                        <th> Email  </th>
                                        <th> Phone No </th>
                                        <th> Instagram ID </th>
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
        var SITEURL = '{{URL::to('')}}';
        $(function () {

            $('.dataTables_length').addClass('mb-3');

            var table = $('#businessTable').DataTable({
                dom: "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'l><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'f>>>" +"<'table-responsive'tr>" +"<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
                language: {
                    searchPlaceholder: "Search records"
                },
                processing: true,
                serverSide: true,
                ajax: "{{ route('business.index') }}",
                columns: [
                    {data: 'business_name', name: "business_name"},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'instagram_id', name: 'instagram_id'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            var user_id;
            $(document).on('click', '.delete', function() {
                var $this = $(this);
                var user_id = $(this).attr('data-business_id');
                var token = '{{csrf_token()}}';
                console.log(user_id);
                $this.attr('disabled', true).html('<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true"></span>Processing...');
                $.confirm({
                    title: 'Alert!',
                    content: 'Are you sure you want to delete this user?',
                    type: 'red',
                    buttons: {
                        text: 'Yes, Delete',
                        btnClass: 'btn-red',
                        delete: {
                            text: 'Yes, Delete',
                            btnClass: 'btn-red',
                            action: function() {
                                $.ajax({
                                    type: "POST",
                                    url: '{{route('admin.business.delete')}}',
                                    data: { user_id: user_id, _token: token },
                                    dataType: "json",
                                    success: function (response) {
                                        if (response.status == 1) {
                                            $.confirm({
                                                title: 'Success!',
                                                content: response.message,
                                                type: 'green',
                                                buttons: {
                                                    ok: function () {
                                                        var oTable = $('#categoryTable').dataTable();
                                                        oTable.fnDraw(false);
                                                    }
                                                }
                                            });
                                        } else {
                                            $.confirm({
                                                title: 'Failed!',
                                                content: response.message,
                                                type: 'red',
                                                buttons: {
                                                    ok: function () {
                                                        // dtUsers.ajax.reload(null, false);
                                                    }
                                                }
                                            });
                                        }
                                    },
						        });
                            }
                        },
                        cancel: function () {
                            $this.attr('disabled', false).html('Delete');
                        }
                    }
                });
            });

        });
    </script>
@endsection
