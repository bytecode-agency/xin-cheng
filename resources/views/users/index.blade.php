@extends('layouts.app')
@push('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">User List</h2>
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
            <a href="{{ route('users.create') }}"><button class="btn btnUser">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span>Add New User</span>
                </button></a>
            <button class="btn btnFilter">
                <img src="{{ asset('/images/filterIcon.png') }}" alt="">
            </button>
        </div>
    </div>

    <!-- Form card data -->
    <div id="message" class="alert alert-success" style="display:none">
    </div>

    <div class="dataAreaMain">
        <div class="table_cstm">
            <table class="table table-bordered data-table" id="users_table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Username</th>
                        <th>Roles</th>
                        <th>Created by</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {

            var table = $('#users_table').DataTable({

                oLanguage: {
                    "sInfo": "Showing _START_ - _END_ of _TOTAL_", // text you want show for info section
                    "sLengthMenu": "Show _MENU_ Entries",
                    "oPaginate": {
                        "sNext": "<i class='fa fa-angle-double-right'></i>",
                        "sPrevious": "<i class='fa fa-angle-double-left'></i>"
                    },
                },
                // bLengthChange: true,
                // "sDom": 'Llfrtlip',
                //dom: 'rtli',
                processing: true,
                // serverSide: true,
                searching: false,
                paging: true,
                // lengthChange: true,
                order: [
                    [0, "desc"]
                ],
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'roles',
                        name: 'roles.name'
                    },
                    {
                        data: 'create_by',
                        name: 'create_by'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            // table.on('order.dt search.dt', function() {
            //     var rows = table.rows().count();
            //     table.column(0, {
            //         search: 'applied',
            //         order: 'applied'
            //     }).nodes().each(function(cell, i) {
            //         cell.innerHTML = rows--;
            //     });
            // }).draw();

            $('body').on('click', '.del_confirm', function() {
                var id = $(this).attr('data-id');
                swal({
                    title: "Are you sure you want to delete user ?",
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
                                console.log(response);
                                swal(
                                    "Success!",
                                    "User deleted successfully",
                                    "success",
                                );

                                $('#users_table').DataTable().ajax.reload();
                                $("#message").show().html(response.success);
                                setTimeout(function() {
                                    $("#message").hide();
                                }, 5000);
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
