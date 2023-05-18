@extends('layouts.app')
@push('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush
@section('content')
    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">Operation</h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('operation.index') }}">Operation</a></li>
                <li>{{ Breadcrumbs::render() }} </li>
            </ul>
        </div>
        <div class="filterBtn d-flex align-items-center justify-content-end">
            <a href="{{ route('operation.create') }}"><button class="btn btnUser">
                    <i class="fa-solid fa-circle-plus"></i>
                    <span>Add New Application</span>
                </button></a>
            <button class="btn btnFilter">
                <img src="{{ asset('/images/filterIcon.png') }}" alt="">
            </button>
        </div>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- Form card data -->
    <div class="dataAreaMain">
        <div class="table_cstm">
            <table class="table table-bordered data-table" id="wealth_table">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Passholder Name (s)</th>
                        <th>Company (s)</th>
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
            var table = $('#wealth_table').DataTable({
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
                ajax: "{{ route('operation.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'passhol_name',
                        name: 'passhol_name'
                    },
                    {
                        data: 'company_name',
                        name: 'company_name'
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
            $('body').on('click', '.del_confirm_opr', function() {
                var id = $(this).attr('data-id');
                swal({
                    title: "Are you sure you want to delete this application?",
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
                        var url = "{{ route('operation.destroy', ':id') }}";
                        url = url.replace(':id', id);
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            data: {
                                operation: id,
                            },
                            cache: false,
                            success: function(response) {
                                swal(
                                    "Success!",
                                    "Application deleted successfully",
                                    "success",
                                );
                                table.ajax.reload();
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
