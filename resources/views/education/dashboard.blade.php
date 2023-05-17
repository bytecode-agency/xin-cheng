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
                <li><a href="{{ route('wealth.dashboard') }}">Education</a></li>
                <li>{{ Breadcrumbs::render() }} </li>
            </ul>
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

    <div class="dataAreaMain education_dashboard dashboard main">

        <div class="card formContentData border-0 p-4">
            <h3>Education Overview - At a Glance</h3>
            <div class="card formContentData report-card row border-0 p-4">


                <div class="formAreahalf ">
                    <div class="report_period">
                        <label for="passapptype" class="form-label">Report Period: </label>
                        <div class="select-arrow">
                            <select name="report_period">
                                {{-- <option value="" selected disabled>Please select
                        </option> --}}
                                <option value="yearly">Yearly</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="formAreahalf ">
                    <div class="report_period">
                        <label for="" class="form-label"> Select Year: </label>
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
                        <table class="table data-table table_yellow" id="education_followup_tables">
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
                <div class="card formContentData border-0 p-4 col-md-5">
                    <h3>Types of Education Levels</h3>
                    <div id="piechart_bussiness" style="width: 500px; height: 300px;"></div>
                </div>
                <div class="col-md-1">
                </div>
                <div class="card formContentData border-0 p-4 col-md-6 education_table_card">
                    <h3>Top 3 Schools Chosen</h3>
                    <table class="table education_dash_tab">
                        <thead>
                            <tr>
                                <th scope="col">Ranking</th>
                                <th scope="col">School Name</th>
                                <th scope="col">Number of Applications</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Overseas International School</td>
                                <td>6</td>

                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Hwa Chong International School</td>
                                <td>8</td>

                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Dulwitch College Singapore</td>
                                <td>4</td>

                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row border-0 p-4">
                <div class="card formContentData border-0 p-4 col-md-5">
                    <h3>Student Pass</h3>
                    <div id="piechart_client" style="width: 500px; height: 300px;"></div>
                </div>
                <div class="col-md-1"></div>
                <div class="card formContentData border-0 p-4 col-md-6">
                    <h3>Parent's LTVP</h3>
                    <div id="piechart_sign" style="width: 900px; height: 500px;"></div>
                </div>
            </div>
            {{-- <div class="card formContentData border-0 p-4">
                <h3>Client's Current Passes </h3>

            </div> --}}



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
                ['Types of Education Levels', 'Types of Education Levels Count'],

                @php
                    
                    echo "['Secondary School (" . $b . ")'," . $b . '],';
                    echo "['Primary School (" . $b . ")'," . $b . '],';
                    
                @endphp
            ]);

            var options = {
                // title: 'Types of Education Levels',
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
                ['Student Pass', 'Student Pass Count'],

                @php
                    
                    echo "['Accepted (" . $b . ")'," . $b . '],';
                    echo "['Rejected (" . $b . ")'," . $b . '],';
                    
                @endphp
            ]);

            var options = {
                // title: 'Student Pass',
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
                ['Parents LTVP', 'Parents LTVP Count'],

                @php
                    
                    echo "['Accepted (" . $b . ")'," . $b . '],';
                    echo "['Rejected (" . $b . ")'," . $b . '],';
                    echo "['Pending (" . $b . ")'," . $b . '],';
                    
                    // if ( /*___directives_script_0___*/ ) {
                    // echo "['Not Signed ('0')','0'],";
                    // } /*___directives_script_1___*/
                    
                @endphp
            ]);

            var options = {
                // title: 'Parents LTVP',
                is3D: false,
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart_sign'));

            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var i = 1;

            var table = $('#education_followup_tables').DataTable({

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
                ajax: "{{ route('education.dashboard') }}",
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
