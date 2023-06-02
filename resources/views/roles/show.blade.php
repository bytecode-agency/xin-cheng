@extends('layouts.app')


@section('content')

    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">{{ str_pad($role->id, 3, '000', STR_PAD_LEFT) }} - {{ $role->name }}</h2>
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
        <div class="filterBtn d-flex align-items-center justify-content-end">
            <a href="{{ route('roles.edit', $role->id) }}"><button class="btn saveBtn">
                    <span>Edit</span>
                </button></a>
            <button class="btn saveBtn cancelBtn role_del" data-id="{{ $role->id }}">
                <span>Delete</span>
            </button>
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
    <div class="dataAreaMain user_account user_roles">
        <div class="card formContentData border-0 p-4">
            <h3>Basic Information</h3>
            <div class="formAreahalf ">
                <label for="" class="form-label">Created By</label>
                <h6>{{ $role->create_by }}</h6>

            </div>
        </div>
        <div class="card formContentData border-0 p-4">
            <h3>Role Information</h3>
            <div class="formAreahalf ">
                <label for="" class="form-label">User Role Name</label>
                <h6>{{ $role->name }}</h6>
            </div>
            <div class="formAreahalf ">
                <label for="" class="form-label">User Role</label>
                <h6>{{ $role->name }}</h6>
            </div>
            <div class="formAreahalf ">
                <label for="" class="form-label">User Role Status</label>
                <h6>
                    @if ($role->status == 1)
                        Active
                    @else
                        Inactive
                    @endif
                </h6>
            </div>
        </div>
        <div class="card formContentData border-0 p-4">
            <h3>Action Log</h3>
            <table class="table user_action_log">
                <thead>
                    <tr>
                        <th scope="col">Actions</th>
                        <th scope="col">Made by</th>
                        <th scope="col">Date & Time</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($action_log as $activity)
                        <tr>
                            <td>{{ $activity->message }}</td>
                            <td>{{ $activity->name }}</td>
                            <td>
                                <span class="account_date">{{ $activity->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}</span>
                                <span class="account_time">{{ $activity->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}</span>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.role_del', function() {
                var id = $(this).attr('data-id');
                swal({
                    title: "Are you sure you want to delete this role ?",
                    text: "You will not be able to retrieve this role again.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        var url = "{{ route('roles.destroy', ':id') }}";
                        url = url.replace(':id', id);
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            data: {
                                role: id,
                            },
                            cache: false,
                            success: function(response) {
                                swal({
                                    title: "Success!",
                                    text: "Role deleted successfully",
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
                            },
                            failure: function(response) {
                                swal(
                                    "Internal Error",
                                    "Oops, your user was not deleted.", // had a missing comma
                                    "error"
                                )
                            }
                        });
                    }
                })

            });
        });
    </script>
@endpush
