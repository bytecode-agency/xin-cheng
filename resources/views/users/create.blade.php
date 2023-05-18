@extends('layouts.app')


@section('content')
    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">Add New User</h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('users.index') }}">User</a></li>
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
        <div class="card formContentData border-0 p-4">
            <h3>Account Details</h3>
            {!! Form::open([
                // 'route' => 'users.store',
                'url' => 'javascript:void(0);',
                'id' => 'add_user',
                'method' => 'POST',
                'class' => 'userForm d-flex justify-content-start flex-wrap',
            ]) !!}
            @csrf
            <input type="hidden" name="create_by" value="{{ Auth::user()->name }}">
            <input type="hidden" name="id" value="{{ Auth::user()->id }}">

            <div class="formAreahalf ">
                <label for="" class="form-label">Username</label>
                {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}

            </div>

            <div class="formAreahalf ">
                <label for="" class="form-label">Password</label>
                {!! Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) !!}

            </div>

            <div class="formAreahalf">
                <div class="form-group">
                    <label for="" class="form-label">User Role</label>
                    {{-- {!! Form::select('roles[]', $roles, null, ['class' => 'form-control']) !!} --}}
                    <select class="form-control" name="roles">
                        <option value="-1" selected disabled>Please select the role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="text-center pt-4 ">
            <button type="submit" class="btn saveBtn">Add</button>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            if ($("#add_user").length > 0) {
                $("#add_user").validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        password: {
                            required: true,
                        },
                        roles: {
                            required: true,
                        },
                    },
                    submitHandler: function(form) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "{{ route('users.store') }}",
                            type: "POST",
                            data: $('#add_user').serialize(),
                            success: function(response) {
                                console.log(response);
                                const el = document.createElement('div')
                                el.innerHTML =
                                    "You can view Account List <a href='{{ route('users.index') }}'>here</a>"
                                swal({
                                    title: `Account Created`,
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
                                    $('#add_user')[0].reset();
                                })
                            }
                        });
                    }
                })
            }
        });
    </script>
@endpush
