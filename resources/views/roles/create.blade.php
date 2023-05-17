@extends('layouts.app')

@section('content')
    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">Add New User Role</h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('roles.index') }}">User</a></li>
                <li>{{ Breadcrumbs::render() }} </li>
            </ul>
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

    <!-- Form card data -->
    <div class="dataAreaMain">
        <div class="card formContentData border-0 p-4 roless">
            <h3>Role Details</h3>
            {!! Form::open([
                'url' => 'javascript:void(0);',
                // 'route' => 'roles.store',
                'id' => 'add_role',
                'method' => 'POST',
                'class' => 'userForm d-flex justify-content-start flex-wrap',
            ]) !!}
            <input type="hidden" name="create_by" value="{{ Auth::user()->name }}">
            <input type="hidden" name="id" value="{{ Auth::user()->id }}">

            <div class="formAreahalf ">
                <label for="" class="form-label">User Role Name</label>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}

            </div>

            <div class="formAreahalf user_permissions">
                <label for="" class="form-label">User Role</label><br>
                @foreach ($permission as $value)
                    <label>{{ Form::checkbox('permission[]', $value->id, false, ['class' => 'name']) }}
                        {{ $value->name }}</label><br>
                @endforeach
                <span id="check-error" class="formAreahalf"></span>
            </div>
            <div class="formAreahalf ">
                <label class="form-label switch">User Role Status
                    <div class="role_check"> <input type="checkbox" id="boxid" name="status" value="1">
                        <label id="text">Inactive</label>
                        <span class="slider round"></span>
                    </div>
                </label>

            </div>
        </div>
        <div class="text-center pt-4 ">
            <button type="submit" class="btn saveBtn">Add</button>
        </div>
        {!! Form::close() !!}
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function() {
            if ($("#add_role").length > 0) {
                $("#add_role").validate({
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
                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('roles.store') }}",
                            type: "POST",
                            data: $('#add_role').serialize(),
                            success: function(response) {
                                const el = document.createElement('div')
                                el.innerHTML =
                                    "You can view User Role List <a href='{{ route('roles.index') }}'>here</a>"
                                swal({
                                    title: `User Role Created`,
                                    content: el,
                                    icon: "success",
                                    buttons: true,
                                    buttons: {
                                        cancel: false,
                                        confirm: {
                                            text: 'Close',
                                            className: 'btn btn-danger'
                                        },
                                    },
                                }).then((result) => {
                                    $('#add_role')[0].reset();
                                })
                            }
                        });
                    }
                })
            }
            $('#boxid').click(function() {
                if ($(this).is(':checked')) {
                    $(this).siblings('label').html('Active');
                } else {
                    $(this).siblings('label').html('Inactive');
                }
            });
        })
    </script>
@endpush
