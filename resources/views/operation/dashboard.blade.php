@extends('layouts.app')
@push('css')
@endpush

@section('content')
    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">Dashboard</h2>
        </div> 
    </div>
    <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('wealth.dashboard') }}">Operation</a></li>
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

    <div class="dataAreaMain dashboard main operation_dashboard">

        <div class="card formContentData border-0 p-4">
            <h3>Operation Overview - At a Glance</h3>
            <?php 
            // foreach($ep_sts as $epk=>$val_ep)
            // {
                // echo'<pre>'; print_r($ep_sts); echo'</pre>'; 
            // }
            ?>
            <div class="card formContentData report-card row border-0 p-4">


                <div class="formAreahalf ">
                    <div class="report_period">
                        <label for="passapptype" class="form-label">Report Period: </label>
                        <div class="select-arrow">
                            <select name="report_period">
                                {{-- <option value="" selected disabled>Please select
                                     </option> --}}
                                     <option value="Yearly">Yearly</option>
                                     <option value="Last month">Last month</option>
                                     <option value="Last 3 months">Last 3 months</option>
                                     <option value="Last 6 months">Last 6 months</option>
     

                            </select>
                        </div>

                    </div>
                </div>

                <div class="formAreahalf ">
                    <div class="report_period"> <label for="" class="form-label"> Select Year: </label>
                        <div class="select-arrow"> <select name="report_year">
                                {{-- <option value="" selected disabled>Please select</option> --}}
                                {{-- <option value="2022">2013</option>
                        <option value="2022">2014</option>
                        <option value="2022">2015</option>
                        <option value="2022">2016</option>
                        <option value="2022">2017</option>
                        <option value="2022">2018</option>
                        <option value="2022">2019</option>
                        <option value="2022">2020</option>
                        <option value="2022">2021</option>
                        <option value="2022">2022</option> --}}
                                <option value="2022">2023</option>

                            </select>

                        </div>
                    </div>
                </div>





            </div>
            <div class="card formContentData operation_table_follow report-card row border-0 p-4">
                <h3>Follow-Up Tasks</h3>
                <div class="dataAreaMain">
                    <div class="table_cstm  dasboard-entry">
                        <table class="table data-table table_yellow" id="operation_tables">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Action</th>
                                    <th>Assigned To</th>
                                    <th>Deadline</th>
                                    <th>Type of Item</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="row border-0 p-4">
                <div class="col-md-6">
                    <div class="row">
                        <div class="card formContentData border-0 p-4 business_amount ">

                            <div class="formAreahalf total_application">
                                <label for="passapptype" class="form-label">
                                    <h3>Total Applications</h3>
                                </label>
                                <h2>{{ $count_app }}</h2>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="card formContentData border-0 p-4 business_amount">
                            <h3>Passholder's Nationalities</h3>
                            <div id="piechart_bussiness" style="width: 500px; height: 300px;"></div>
                            <div id="demo"></div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="card formContentData border-0 p-4 business_amount">
                            <h3>Pass Application Status</h3>
                            <div id="piechart_client" style="width: 500px; height: 300px;"></div>
                            <div id="demo"></div>

                        </div>

                    </div>

                </div>
                {{-- <div class="col-md-1"></div> --}}
                <div class="col-md-6">
                    {{-- <div class="row" style="min-height: 82vh;"> --}}
                    {{-- <div class="card formContentData border-0 p-4 business_amount"> --}}
                    <div class="card formContentData row border-0 p-4 justify-content-center">
                        <h3>Business Type(Pass)</h3>
                        <div id="piechart_sign" style="width: 900px; height: 500px;"></div>
                        <div id="demo"></div>

                    </div>
                </div>

                {{-- </div> --}}
            </div>
            <div class="row">
                <div class="graph-chart col-md-12">
                    <div class="card formContentData row border-0 p-4 justify-content-center">
                        <h3 class="agrement">Pass Application Types</h3>
                        <div id="business_chart" style="width: 100%; height: 600px;"></div>
                    </div>
    
                </div>
            </div>
        </div>

    </div>




@endsection
@push('js')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Bussiness Type', 'Bussiness Type Count'],

                @php
                    
                    echo "['China (" . $b . ")'," . $b . '],';
                    echo "['Combodia (" . $b . ")'," . $b . '],';
                    
                @endphp
            ]);
            var options = {
                title: '',
                colors: ['#990000', '#E8B157'],
                legend: {
                    position: 'left',
                    alignment: 'end'
                },
                is3D: false,

            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_bussiness'));

            chart.draw(data, options);
        }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Client Type', 'Client Type Count'],

                @php
                    
                    echo "['Rejected (" . $rejected . ")'," . $rejected . '],';
                    echo "['Approved (" . $approved . ")'," . $approved . '],';
                    echo "['Pending (" . $pending . ")'," . $pending . '],';
                    
                @endphp
            ]);

            var options = {
                title: '',
                colors: ['#990000', '#00A860'],
                legend: {
                    position: 'left',
                    alignment: 'end'
                },
                is3D: false,
            };


            var chart = new google.visualization.PieChart(document.getElementById('piechart_client'));

            chart.draw(data, options);
        }
    </script>


    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Sign of B2B Aggreement', 'Sign of B2B Aggreement Count'],

                @php
                    
                    echo "['FO (" . $fo . ")'," . $fo . '],';
                    echo "['PIC (" . $pic . ")'," . $pic . '],';
                    echo "['PR renewal (" . $pr_ren . ")'," . $pr_ren . '],';
                    echo "['Citizen (" . $citizen . ")'," . $citizen . '],';
                    echo "['Others (" . $others . ")'," . $others . '],';
                    echo "['Self-Employement (" . $self_emp . ")'," . $self_emp . '],';
                    echo "['Employer Guarantee (" . $emp_g . ")'," . $emp_g . '],';
                    echo "['PR application (" . $pr_app . ")'," . $pr_app . '],';
               
                    
                    // if ( /*___directives_script_0___*/ ) {
                    // echo "['Not Signed ('0')','0'],";
                    // } /*___directives_script_1___*/
                    
                @endphp
            ]);

            var options = {
                title: '',
                colors: ['#1E8D0C', '#2AD38B'],
                legend: {
                    position: 'left',
                    alignment: 'end'
                },
                is3D: false,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_sign'));

            chart.draw(data, options);
        }
    </script>


    <script type="text/javascript">
        $(document).ready(function() {

            var table = $('#operation_tables').DataTable({
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
                ajax: "{{ route('operation.dashboard') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: function() {
                            return '<span class="me-3"><i class="fa-solid fa-bell fa-xl"></i></span>EP for Timmy Yao needs to be renewed';
                        },
                        name: 'action',
                        width: '550'
                    },
                    {
                        data: function() {
                            return 'BeecaLam';
                        },
                        name: 'assigned_to',
                        width: '250'
                    },
                    {
                        data: function() {
                            return '30/10/23';
                        },
                        name: 'deadline',
                        width: '250'
                    },
                    {
                        data: function() {
                            return 'Pass Related';
                        },
                        name: 'type_of_item'
                    }
                ]
            });
        });
    </script>

<script>
    google.charts.load('current', {
        packages: ['corechart', 'bar']
    });
    google.charts.setOnLoadCallback(drawBasic);

    function drawBasic() {



        var data = google.visualization.arrayToDataTable([
            ['','Pending', 'Approved', 'Rejected'],
            ['EP',   4 , 1, 0],
            ['SP', 3 , 3, 3],
            ['DP', 2 , 1, 0],
            ['LTVP', 0 , 0,3],
            ['Foreign Passport', 4 , 0, 0],
            ['PR',0 , 0,0],
            ['Citizen', 0 , 0, 0],
            ['Others',0 , 0,0],
        ]);


        var data = google.visualization.arrayToDataTable([

            // ['','Pending', 'Approved', 'Rejected'],
            // ['EP',   4 , 1, 0],
            // ['SP', 3 , 3, 3],
            // ['DP', 2 , 1, 0],
            // ['LTVP', 0 , 0,3],
            // ['Foreign Passport', 4 , 0, 0],
            // ['PR',0 , 0,0],
            // ['Citizen', 0 , 0, 0],
            // ['Others',0 , 0,0],

            @php
                    echo"['','Pending(".$total_count['pending'].")', 'Approved(".$total_count['approved'].")', 'Rejected(".$total_count['rejected'].")'],";
                    echo "['EP', " . $ep_sts['pending'] . "," . $ep_sts['approved'] .",". $ep_sts['rejected'] ."],";
                    echo "['SP', " . $sp_sts['pending'] . "," . $sp_sts['approved'] .",". $sp_sts['rejected'] ."],";
                    echo "['DP', " . $dp_sts['pending'] . "," . $dp_sts['approved'] .",". $dp_sts['rejected'] ."],";
                    echo "['LTVP', " . $lvtp_sts['pending'] . "," . $lvtp_sts['approved'] .",". $lvtp_sts['rejected'] ."],";
                    echo "['WP', " . $wp_sts['pending'] . "," . $wp_sts['approved'] .",". $wp_sts['rejected'] ."],";
                    echo "['PR', " . $pr_sts['pending'] . "," . $pr_sts['approved'] .",". $pr_sts['rejected'] ."],";
                    echo "['Citizen', " . $citizen_sts['pending'] . "," . $citizen_sts['approved'] .",". $citizen_sts['rejected'] ."],";
                    echo "['Others', " . $oth_sts['pending'] . "," . $oth_sts['approved'] .",". $oth_sts['rejected'] ."],";
                    // echo "['SP', (" . $pic . ")'," . $pic . '],';
                    // echo "['DP', (" . $pr_ren . ")'," . $pr_ren . '],';
                    // echo "['LTVP', (" . $citizen . ")'," . $citizen . '],';
                    // echo "['WP', (" . $others . ")'," . $others . '],';
                    // echo "['PR', (" . $self_emp . ")'," . $self_emp . '],';
                    // echo "['Citizen', (" . $emp_g . ")'," . $emp_g . '],';
                    // echo "['Others', (" . $pr_app . ")'," . $pr_app . '],';
               
                    
                    // if ( /*___directives_script_0___*/ ) {
                    // echo "['Not Signed ('0')','0'],";
                    // } /*___directives_script_1___*/
                    
                @endphp
        ]);


        var options = {
            title: '',
            hAxis: {
                title: 'Pass Application Type',
            },
            vAxis: {
                title: 'Amount'
            },
           // legend: {position: 'none'},
            legend: {
                position: 'bottom',
               // maxLines: 3
            },
            colors: ['#E8B157', '#1E8D0C', '#990000'],
            bar: { groupWidth: "40%" }
           // isStacked: true,
        };

        var chart = new google.visualization.ColumnChart(
            document.getElementById('business_chart'));

        chart.draw(data, options);
    }
</script>
@endpush
