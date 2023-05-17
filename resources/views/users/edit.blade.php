@extends('layouts.app')


@section('content')
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">Edit User</h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
    <form action="javascript:void(0);" method='PATCH' id='edit_user'>
        <div class="filterPagination d-flex justify-content-between align-items-center">
            <div class="paginationLeft">
                <ul>
                    <li><a href="{{ route('users.index') }}">User</a></li>
                    <li>{{ Breadcrumbs::render() }} </li>
                </ul>
            </div>
            <div class="filterBtn d-flex align-items-center justify-content-end">
                <button class="btn saveBtn upload">
                    Save
                </button>
                <a href="{{ route('users.show', $user->id) }}" class="btn saveBtn cancelBtn">Cancel</a>
            </div>

        </div>

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fa-regular fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        <div class="dataAreaMain user_account">
            <div class="card formContentData border-0 p-4 user_account_edit">
                <h3>Account Information</h3>

                <input type="hidden" name="create_by" value="{{ Auth::user()->name }}">
                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                <div class="d-flex flex-wrap">
                    <div class="account_parent">
                        <div class="formAreahalf ">
                            <label for="name" class="form-label">Name</label>
                            {{-- {!! Form::text('name', null, ['placeholder' => 'Name', 'id' => 'name', 'class' => 'form-control']) !!} --}}
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name"
                                value="{{ $user->name }}">
                        </div>

                        <div class="formAreahalf">
                            <div class="form-group">
                                <label for="" class="form-label">User Role</label>

                                <select class="form-control" name="roles">
                                    <option value="-1" selected disabled>Please select the role</option>

                                    @foreach ($roles as $role)
                                        <option value="{{ $role }}" {{ $role == $userRole ? 'selected' : 'sadsd' }}>
                                            {{ $role }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- {!! Form::select('roles', $roles, $userRole, ['class' => 'form-control']) !!} --}}
                            </div>
                        </div>
                    </div>
                    <div class="account_pass">
                        <div class="formAreahalf">
                            <label for="password" class="form-label">Password</label>
                            {!! Form::password('password', ['placeholder' => 'Password', 'id' => 'password', 'class' => 'form-control']) !!}
                            {{-- <input type="password" placeholder="Password" class="form-control" name="password" value="{{$user->password}}"> --}}
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </form>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.upload').click(function() {

                $("#edit_user").validate({
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
                    }
                });
                if ($('#edit_user').valid()) {
                    // submitHandler: function(form) {
                    var id = $('#user_id').val();
                    var url = "{{ route('users.update', ':id') }}";
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
                        data: $('#edit_user').serialize(),
                        success: function(response) {
                            swal({
                                title: `Account Updated`,
                                text: `Account Updated Succesfully`,
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
                                    "{{ route('users.index') }}";


                            })
                        }
                    });
                }

            })
        })

        // })
        // });
    </script>
@endpush
