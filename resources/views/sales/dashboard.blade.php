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
                <li><a href="{{ route('sales.dashboard') }}">Sales</a></li>
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
   
    <div class="dataAreaMain dashboard main">

        <div class="card formContentData  border-0 p-4">
            <h3>Sales Overview - At a Glance</h3>
            <div class="card formContentData report-card row border-0 p-4">

                <div class="formAreahalf">
                    <div class="report_period">
                        <label for="passapptype" class="form-label">Report Period: </label>
                        <div class="select-arrow">
                            <select name="report_period" id="report_period">
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

                <div class="formAreahalf " id="selectYear">
                    <div class="report_period">
                        <label for="" class="form-label"> Select Year: </label>
                        <div class="select-arrow">
                            <select name="report_year" id="report_year">
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

            <div class="card formContentData report-card row border-0">
                <h3>Follow-Up Tasks</h3>
                <div class="dataAreaMain">
                    <div class="table_cstm  dasboard-entry">
                        <table class="table  data-table table_yellow" id="sale_tables">
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

            <div class="total_application row">
                <div class="graph-chart col-md-6">
                    <div class="card formContentData row border-0 p-4  business_amount">

                        <div class="formAreahalf col-md-6 total_application ">

                            <label for="passapptype" class="form-label">Total <br>Applications </label>
                            <h2>{{ $applications }}</h2>

                        </div>

                        <div class="formAreahalf  col-md-6 business ">
                            <label for="" class="form-label">Total Amount of<br> Business Generated</label>
                            <h2>${{ $amt }}</h2>

                        </div>

                    </div>
                    <div class="card formContentData border-0 p-4 justify-content-center">
                        <h3>Business Type - With Generated Business</h3>
                        <div id="piechart_bussiness" style="width: 500px; height: 300px;"></div>
                        <div id="demo"></div>

                    </div>

                    {{-- <div class="card formContentData border-0 p-4 justify-content-center ">
                        <h3>Client Type</h3>

                        <div id="piechart_client" style="width: 500px; height: 300px;"></div>

                    </div> --}}

                </div>
                <div class="graph-chart col-md-6 d-flex align-items-center flex-wrap">
                    <div class="card formContentData row border-0 p-4 justify-content-center">
                        <h3 class="agrement">Sign of B2B Agreement</h3>
                        <div id="piechart_sign" style="width: 1200px; height: 449px;"></div>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="graph-chart col-md-12">
                    <div class="card formContentData row border-0 p-4 justify-content-center">
                        <h3 class="agrement">Business Generated Type</h3>
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
                ['Business Type', 'Business Type Count'],

                @php
                    
                    // document.getElementById("demo").innerHTML = ""['B2B (" . $bus_type['B2B'] . ")'," . $bus_type['B2B'] . '],'";
                    
                    echo "['B2B (" . $bus_type['B2B'] . ")'," . $bus_type['B2B'] . '],';
                    echo "['B2C (" . $bus_type['B2C'] . ")'," . $bus_type['B2C'] . '],';
                    
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
        // google.charts.load('current', {
        //     'packages': ['corechart']
        // });
        // google.charts.setOnLoadCallback(drawChart);

        // function drawChart() {

        //     var data = google.visualization.arrayToDataTable([
        //         ['Client Type', 'Client Type Count'],

        //         @php
                    
        //             echo "['Personal (" . $client_type['personal'] . ")'," . $client_type['personal'] . '],';
        //             echo "['Corporate (" . $client_type['corporate'] . ")'," . $client_type['corporate'] . '],';
                    
        //         @endphp
        //     ]);

        //     var options = {
        //         title: '',
        //         colors: ['#990000', '#00A860'],
        //         legend: {
        //             position: 'left',
        //             alignment: 'end'
        //         },
        //         is3D: false,
        //     };

        //     var chart = new google.visualization.PieChart(document.getElementById('piechart_client'));

        //     chart.draw(data, options);
        // }
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Sign of B2B Agreement', 'Sign of B2B Agreement Count'],

                @php
                    
                    echo "['Signed (" . $sign['sign_yes'] . ")'," . $sign['sign_yes'] . '],';
                    echo "['Not Signed (" . $sign['sign_no'] . ")'," . $sign['sign_no'] . '],';
                    
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
            var i = 1;

            var table = $('#sale_tables').DataTable({

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
                ajax: "{{ route('sales.dashboard') }}",
                columns: [{
                        data: function() {
                            return '008';
                        },
                        name: 'id'
                    },
                    {
                        data: function() {
                            return '<span class="me-3"><i class="fa-solid fa-bell fa-xl"></i></span>B2B Agreement For Benny Co. Pte LTE needs to be re';
                        },
                        name: 'client_name',
                        width: '550'

                    },
                    {
                        data: function() {
                            return 'TreVor Neo';
                        },
                        name: 'bus_type',
                        width: '250'
                    },
                    {
                        data: function() {
                            return '12/10/23';
                        },
                        name: 'b2b_sign',
                        width: '250'
                    },
                    {
                        data: function() {
                            return 'Sales Application';
                        },
                        name: 'b2b_agr_sign_date'
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



        });
    </script>

    <script>
        google.charts.load('current', {
            packages: ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {



            var data = google.visualization.arrayToDataTable([
                ['', '', {
                    role: 'style'
                }],
                ['Wealth management',   @php echo $wm; @endphp, '#C14FE9'],
                ['Immigration Programme', @php echo $ip; @endphp, '#C14FE9'],
                ['GolFamily Office', @php echo $fo; @endphp, '#5E3FBE'],
                ['Passport', @php echo $pass; @endphp, '#76A7FA'],
                ['Real Property',  @php echo $rp; @endphp, ''],
                ['Pure Identity Management', @php echo $pim; @endphp, ''],
                ['Account Services', @php echo $ac; @endphp, ''],
                ['Education', @php echo $ed; @endphp, ''],
                ['Bank Account Opening', @php echo $bao; @endphp, ''],
                ['Others', @php echo $oth; @endphp, ''],
            ]);

            var options = {
                title: '',
                hAxis: {
                    title: 'Business Types',
                },
                vAxis: {
                    title: 'No. of Generated Business'
                },
                legend: {position: 'none'},
                // legend: {
                //     position: 'bottom',
                //    // maxLines: 3
                // },
                bar: { groupWidth: "20%" }
               // isStacked: true,
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('business_chart'));

            chart.draw(data, options);
        }


        $(document).on('change', '#report_period', function() {
           
            var period=$(this).val();
            if(period != "Yearly"){
                $('#selectYear').hide();
            }else{
                $('#selectYear').show();
            }
              $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var url = "{{ route('sales.dashboard.rep') }}";
                // url = url.replace(':id', id);
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        period: period,
                    },
                    cache: false,
                    success: function(response) {
                        // alert(response);
                        
                    
                    },
                })
            });
    </script>
@endpush
