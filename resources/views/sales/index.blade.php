@extends('layouts.app')
@push('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">Sales</h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
     <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('sales') }}">Sales</a></li>
                <li>{{ Breadcrumbs::render() }} </li>
            </ul>
        </div>
        <div class="filterBtn d-flex align-items-center justify-content-end">
            <a href="{{ route('sales.create') }}"><button class="btn btnUser">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span>Add New Application</span>
                </button></a>
            <button class="btn btnFilter">
                <img src="{{ asset('/images/filterIcon.png') }}" alt="">
            </button>
        </div>
    </div>
    <!-- Form card data -->
    <div class="dataAreaMain">
        <div class="table_cstm">
            <table class="table table-bordered data-table" id="sale_table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Client's Full Name</th>
                        <th>Business Type</th>  
                        <th>Sign of B2B Document</th>
                        <th>B2B agreement sign date</th>
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
            // var i = 1;

            var table = $('#sale_table').DataTable({
                
                oLanguage: {
                    "sInfo": "Showing _START_ - _END_ of _TOTAL_", // text you want show for info section
                    "sLengthMenu": "Show _MENU_ Entries",
                    "oPaginate": {
                        "sNext": "<i class='fa fa-angle-double-right'></i>",
                        "sPrevious": "<i class='fa fa-angle-double-left'></i>"
                    },
                },
                processing: true,
                serverSide: true,
                searching: false,
                paging: true,
               

                order: [
                    [0, "desc"]
                ],

                ajax: "{{ route('sales') }}",
                columns: [{
                        data:'id',
                        name: 'id'
                    },
                    {
                        data: 'client_name',
                        name: 'client_name'
                    },
                    {
                        data: 'bus_type',
                        name: 'bus_type'
                    },
                    {
                        data: 'b2b_sign',
                        name: 'b2b_sign'
                    },
                    {
                        data: 'b2b_agr_sign_date',
                        name: 'b2b_agr_sign_date'
                    },
                    {
                        data: 'created_by',
                        name: 'created_by'
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
                    title: "Are you sure you want to delete application ?",
                    text: "You will not be able to retrieve this application again.",
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
                        var url = "{{ route('sales.destroy', ':id') }}";
                        url = url.replace(':id', id);
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            data: {
                                user: id,
                            },
                            cache: false,
                            success: function(response) {
                                swal(
                                    "Success!",
                                    "Application deleted successfully",
                                    "success",
                                );
                                $('#sale_table').DataTable().ajax.reload();
                            },
                            failure: function(response) {
                                swal(
                                    "Internal Error",
                                    "Oops, your application was not deleted.", // had a missing comma
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
