@extends('layouts.app')

@section('content')
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">Edit Role</h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
    {{-- {!! Form::model($role, [
        'method' => 'PATCH',
        // 'url' => 'javascript:void(0);',
        // 'route' => ['roles.update', $role->id],
        'id' => 'edit_role',
    ]) !!} --}}
    <form action="javascript:void(0);" id="edit_role" method="PATCH">
        <div class="filterPagination d-flex justify-content-between align-items-center">
            <div class="paginationLeft">
                <ul>
                    <li><a href="{{ route('roles.index') }}">User</a></li>
                    <li>{{ Breadcrumbs::render() }} </li>
                </ul>
            </div>
            <div class="filterBtn d-flex align-items-center justify-content-end">
                <button class="btn saveBtn role_upload">
                    Save
                </button>

                <a href="{{ route('roles.show', $role->id) }}" class="btn saveBtn cancelBtn">

                    Cancel
                </a>
            </div>

        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                {{-- <strong>Whoops!</strong>Something went wrong.<br><br> --}}
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="dataAreaMain user_account user_roles">
            <div class="card formContentData border-0 p-4 user_account_edit user_roless_edit">
                <h3>Role Information</h3>


                <input type="hidden" name="create_by" value="{{ Auth::user()->name }}">
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="role_id" id="role_id" value="{{ $role->id }}">
                <div class="d-flex flex-wrap">
                    <div class="account_parent role_parent">
                        <div class="formAreahalf">
                            <label for="" class="form-label">User Role Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Name"
                                value="{{ $role->name }}">
                        </div>

                        <div class="formAreahalf role_status">
                            <label class="form-label switch">User Role Status
                                <div class="role_check"> <input type="checkbox" id="boxid" name="status"
                                        {{ $role->status == 1 ? 'checked' : '' }}>
                                    <label id="text">{{ $role->status == 1 ? 'Active' : 'Inactive' }}</label>
                                    <span class="slider round"></span>
                                </div>
                            </label>

                        </div>
                    </div>
                    <div class="role_permission">
                        <div class="formAreahalf user_permissions">
                            <label for="" class="form-label">User Role</label>
                            <br />
                            @foreach ($permission as $value)
                                <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                    {{ $value->name }}</label>
                                <br />
                            @endforeach
                            <span id="check-error" class="formAreahalf"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- {!! Form::close() !!} --}}
    </form>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#boxid').click(function() {
                if ($(this).is(':checked')) {
                    $(this).siblings('label').html('Active');
                } else {
                    $(this).siblings('label').html('Inactive');
                }
            });
            $('.role_upload').click(function() {
                if ($("#edit_role").length > 0) {
                    $("#edit_role").validate({
                        rules: {
                            name: {
                                required: true,
                            },
                            'permission[]': {
                                required: true,
                            },
                        },
                        errorPlacement: function(error, element) {
                            if (element.is(":checkbox")) {
                                error.appendTo('#check-error');
                            } else {
                                error.insertAfter(element);
                            }
                        },
                    })
                    if ($('#edit_role').valid()) {
                        var id = $('#role_id').val();
                        var url = "{{ route('roles.update', ':id') }}";
                        url = url.replace(':id', id);
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content')
                            }
                        });
                        $.ajax({
                            url: url,
                            type: "PATCH",
                            data: $('#edit_role').serialize(),
                            success: function(response) {
                                swal({
                                    title: `User Role Update`,
                                    text: 'User Role Update Succesfully',
                                    icon: "success",
                                    buttons: true,
                                    buttons: {
                                        cancel: false,
                                        confirm: {
                                            text: 'OK',
                                            className: 'btn btn-danger'
                                        },
                                    },
                                }).then((result) => {
                                    window.location =
                                        "{{ route('roles.index') }}";
                                })
                            }
                        });
                    }
                }
            })
        })
    </script>
@endpush
