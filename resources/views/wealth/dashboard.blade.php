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
                <li><a href="{{ route('wealth.dashboard') }}">Wealth</a></li>
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

    <div class="dataAreaMain wealth_dashboard_set dashboard main">

        <div class="card formContentData border-0 p-4">
            <h3>Wealth Overview - At a Glance</h3>
            <div class="card formContentData report-card row border-0 p-4">


                <div class="formAreahalf ">
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

                <div class="formAreahalf "  id="selectYear">
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
            <div class="card formContentData report-card row border-0 p-4">
                <h3>Follow-Up Tasks</h3>
                <div class="dataAreaMain">
                    <div class="table_cstm  dasboard-entry">
                        <table class="table data-table table_yellow" id="wealths_tables">
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
                <div class="card formContentData border-0 p-4 business_amount col-md-5">

                    <div class="formAreahalf col-md-3 total_application">
                        <label for="passapptype" class="form-label">Total Received <br>Commission </label>
                        <h2>$300.00</h2>

                    </div>
                    <div class="formAreahalf col-md-2 business ">
                        <label for="" class="form-label">Total Pending <br>Commission </label>
                        <h2>$100.00</h2>

                    </div>
                </div>
                <div class="col-md-1">
                </div>


                <div class="card formContentData border-0 p-4 business_amount col-md-6">

                    <div class="formAreahalf col-md-5 total_application">
                        <label for="" class="form-label" style="max-width: 192px">Number of Clients Redeemed
                            Earnings</label>
                        <h2>0</h2>
                    </div>
                    <div class="formAreahalf col-md-2 business">
                        <label for="" class="form-label">Total <br> Redemption </label>
                        <h2>$0</h2>
                    </div>
                </div>
            </div>

            <div class="row border-0 p-4">
                <div class="card formContentData border-0 p-4 business_amount col-md-5">


                    <div class="formAreahalf col-md-3 total_application">
                        <label for="" class="form-label">Number of <br>Investment</label>
                        <h2>2</h2>

                    </div>
                    <div class="formAreahalf col-md-2 business">
                        <label for="" class="form-label">Total Net <br>Account Value</label>
                        <h2>$1600.00</h2>

                    </div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="card formContentData border-0 p-4 business_amount col-md-6">
                    <div class="formAreahalf total_application col-md-3">
                        <label for="" class="form-label">Number of <br> Insurance</label>
                        <h2>1</h2>

                    </div>
                    <div class="formAreahalf business col-md-2">
                        <label for="" class="form-label">Total <br> Premium</label>
                        <h2>$1600.00</h2>

                    </div>


                </div>
            </div>
            <div class="row border-0 p-4">
                <div class="card formContentData border-0 p-4 business_amount col-md-5 ">
                    <h3>Business Type</h3>
                    <div id="piechart_bussiness" style="width: 500px; height: 300px;"></div>
                    <div id="demo"></div>

                </div>
                <div class="col-md-1">
                </div>

                <div class="card formContentData border-0 p-4 business_amount col-md-6">
                    <h3>Client's Nationalities</h3>

                    <div id="piechart_client" style="width: 500px; height: 300px;"></div>
                    <div id="demo"></div>
                </div>
            </div>
            <div class="row border-0 p-4">
                <div class="card formContentData border-0 p-4 business_amount col-md-5 ">
                    <h3>FO Types</h3>
                    <div id="piechart_sign" style="width: 900px; height: 500px;"></div>
                    <div id="demo"></div>
                </div>
                <div class="col-md-1">
                </div>


                <div class="card formContentData border-0 p-4 business_amount col-md-6">
                    <h3>Proportion Percentage - Insurance and Investment</h3>
                    <div id="piechart_sign2" style="width: 900px; height: 500px;"></div>
                    <div id="demo"></div>
                </div>
            </div>

            <div class="card formContentData dash_table_wealth border-0 p-4">
                <h3>Top 3 Investment Products</h3>
                <table class="table wealth_dash_tab">
                    <thead>
                        <tr>
                            <th scope="col">Ranking</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Financial Institution Name</th>
                            <th scope="col">Amount of Premiums Bought</th>
                            <th scope="col">Total Net Account Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>DBS</td>
                            <td>DBS Bank Ltd</td>
                            <td>6</td>
                            <td>$600.00</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>MDS</td>
                            <td>STR Bank Ltd</td>
                            <td>8</td>
                            <td>$550.00</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>URT</td>
                            <td>DBS Bank Ltd</td>
                            <td>4</td>
                            <td>$400.00</td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="card formContentData dash_table_wealth border-0 p-4">
                <h3>Top 3 Insurance Products</h3>
                <table class="table wealth_dash_tab">
                    <thead>
                        <tr>
                            <th scope="col">Ranking</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Financial Institution Name</th>
                            <th scope="col">Amount of Premiums Bought</th>
                            <th scope="col">Total Premiums</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>DBS</td>
                            <td>DBS Bank Ltd</td>
                            <td>6</td>
                            <td>$600.00</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>MDS</td>
                            <td>STR Bank Ltd</td>
                            <td>8</td>
                            <td>$550.00</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>URT</td>
                            <td>DBS Bank Ltd</td>
                            <td>4</td>
                            <td>$400.00</td>
                        </tr>

                    </tbody>
                </table>
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
                    
                    echo "['Non-FO (" . $b . ")'," . $b . '],';
                    echo "['FO (" . $b . ")'," . $b . '],';
                    
                @endphp
            ]);

            var options = {
                // title: 'Bussiness Type',
                colors: ['#FF3636', '#E8B157'],
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
                    
                    echo "['China (" . $b . ")'," . $b . '],';
                    echo "['Cambodia (" . $b . ")'," . $b . '],';
                    
                @endphp
            ]);

            var options = {
                // title: 'Client Type',
                colors: ['#990000', '#E8B157'],
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
                    
                    echo "['13O (" . $b . ")'," . $b . '],';
                    echo "['13D (" . $b . ")'," . $b . '],';
                    echo "['13U (" . $b . ")'," . $b . '],';
                    echo "['Others (" . $b . ")'," . $b . '],';
                    
                    // if ( /*___directives_script_0___*/ ) {
                    // echo "['Not Signed ('0')','0'],";
                    // } /*___directives_script_1___*/
                    
                @endphp
            ]);

            var options = {
                // title: 'Sign of B2B Aggreement',
                colors: ['#5E3FBE', '#CBB6F8', '#E5DAFB', '#F4F0FD'],
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
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Sign of B2B Aggreement', 'Sign of B2B Aggreement Count'],

                @php
                    
                    echo "['Investment (" . $b . ")'," . $b . '],';
                    echo "['Insurance (" . $b . ")'," . $b . '],';
                    echo "['Others (" . $b . ")'," . $b . '],';
                    
                    // if ( /*___directives_script_2___*/ ) {
                    // echo "['Not Signed ('0')','0'],";
                    // } /*___directives_script_3___*/
                    
                @endphp
            ]);

            var options = {
                // title: 'Sign of B2B Aggreement',
                colors: ['#1E8D0C', '#2AD38B', '#7BDEB4'],
                legend: {
                    position: 'left',
                    alignment: 'end'
                },
                is3D: false,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_sign2'));

            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#report_period', function() {
           
           var period=$(this).val();
           if(period != "Yearly"){
               $('#selectYear').hide();
           }else{
               $('#selectYear').show();
           }
        });

            var i = 1;

            var table = $('#wealths_tables').DataTable({

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
                ajax: "{{ route('wealth.dashboard') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'assigned_to',
                        name: 'assigned_to'
                    },
                    {
                        data: 'deadline',
                        name: 'deadline'
                    },
                    {
                        data: 'type_of_item',
                        name: 'type_of_item'
                    }
                ]
            });
        });
    </script>
@endpush
