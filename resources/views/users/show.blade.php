@extends('layouts.app')


@section('content')
    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">{{str_pad($user->id, 3, '000', STR_PAD_LEFT)}} - {{$user->name}}</h2>
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
        <div class="filterBtn d-flex align-items-center justify-content-end">
            <a href="{{ route('users.edit', $user->id) }}"><button class="btn saveBtn">
                    <span>Edit</span>
                </button></a>
            <button class="btn saveBtn cancelBtn user_del" data-id="{{ $user->id }}">
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
    <div class="dataAreaMain">
        <div class="card formContentData border-0 p-4">
            <h3>Basic Information</h3>
            <div class="formAreahalf ">
                <label for="" class="form-label">Created By</label>
                <h6>{{ $user->create_by }}</h6>

            </div>
        </div>
        <div class="card formContentData border-0 p-4">
            <h3>User Information</h3>
            <div class="formAreahalf ">
                <label for="" class="form-label">User Name</label>
                <h6>{{ $user->name }}</h6>
            </div>
            <div class="formAreahalf ">
                <label for="" class="form-label">User Role</label>
                <h6>
                    @foreach ($user->roles as $role)
                        {{ $role->name }}
                    @endforeach
                </h6>
            </div>
            <div class="formAreahalf ">
                <label for="" class="form-label">User Role Status</label>
                <h6>
                    @foreach ($user->roles as $role)
                        @if ($role->status == 1)
                            Active
                        @else
                            Inactive
                        @endif
                    @endforeach

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
                            <td>{{ $activity->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}</td>
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
            $('body').on('click', '.user_del', function() {
                var id = $(this).attr('data-id');
                swal({
                    title: "Are you sure you want to delete this user ?",
                    text: "You will not be able to retrieve this user again.",
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
                        var url = "{{ route('users.destroy', ':id') }}";
                        url = url.replace(':id', id);
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            data: {
                                user: id,
                            },
                            cache: false,
                            success: function(response) {
                                swal({
                                    title: "Success!",
                                    text: "Account deleted successfully",
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
