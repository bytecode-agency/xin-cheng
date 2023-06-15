@extends('layouts.app')
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
                {{-- <li><a href="">Dashboard</a></li> --}}
                <li>Dashboard</li>
            </ul>
        </div>
    </div>

    <!-- Form card data -->
    <div class="dataAreaMain">
        <div class="Dashboard-body">

            <div class="wealth-_period">
                <div class="Wealth-Glance padding-contant">
                    <div class="At-Glance">
                        <h4> Overview - At a Glance</h4>
                    </div>
                    <div class="Report_Period  box-sadwo">
                        <span>Report Period:</span>
                        <select name="cars" id="cars">
                            <option value="volvo">Yearly</option>
                            <option value="saab">1999</option>
                            <option value="mercedes">2000</option>
                            <option value="audi">2001</option>
                        </select>
                        <span>Select Year:</span>
                        <select name="cars" id="cars">
                            <option value="1940">2022</option>
                            <option value="1941">1941</option>
                            <option value="1942">1942</option>
                            <option value="1943">1943</option>
                            <option value="1944">1944</option>
                            <option value="1945">1945</option>
                            <option value="1946">1946</option>
                            <option value="1947">1947</option>
                            <option value="1948">1948</option>
                            <option value="1949">1949</option>
                            <option value="1950">1950</option>
                        </select>
                    </div>
                </div>
                <div class="Follow-Up_Tasks">
                    <h5>Follow-Up Tasks</h5>
                    <table>
                        <tr>
                            <th><span>S/N </span><img src="{{ asset('/images/dun-up-arrow.png') }}" alt=">Notification">
                            </th>
                            <th><span>Action</span> <img src="{{ asset('/images/dun-up-arrow.png') }}" alt=">Notification">
                            </th>
                            <th><span>Assigned To</span> <img src="{{ asset('/images/dun-up-arrow.png') }}"
                                    alt=">Notification">
                            </th>
                            <th><span>Deadline </span><img src="{{ asset('/images/dun-up-arrow.png') }}"
                                    alt=">Notification">
                            </th>
                            <th><span>Type of Item</span> <img src="{{ asset('/images/dun-up-arrow.png') }}"
                                    alt=">Notification">
                            </th>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td><img src="{{ asset('/images/alert-no.png') }}" alt=">Notification"> <span>Passport for Kai
                                    Jie
                                    Oh
                                    is
                                    expiring soon</span></td>
                            <td>BeccaLam</td>
                            <td>30/03/2023</td>
                            <td>Pass Related</td>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td> <img src="{{ asset('/images/alert-no.png') }}" alt=">Notification"><span> Collect Annual
                                    Payment
                                    of
                                    $10000.00 from Kai Jie</span></td>
                            <td>BeccaLam</td>
                            <td>30/03/2023</td>
                            <td>Shareholder</td>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td><img src="{{ asset('/images/warning.png') }}" alt=">Notification"><span>Collect Annual
                                    Payment
                                    of
                                    $10000.00
                                    from Kai Jie</span></td>
                            <td>BeccaLam</td>
                            <td>30/03/2023</td>
                            <td>MAS Related</td>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td> <img src="{{ asset('/images/alert-no.png') }}" alt=">Notification"><span>MAS Application
                                    needs
                                    to
                                    be
                                    declared for AY 2023</span></td>
                            <td>BeccaLam</td>
                            <td>03/11/2022</td>
                            <td>Application</td>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td>2nd Attempt of PR Application for Timmy Yao is still Progress</td>
                            <td>BeccaLam</td>
                            <td>03/11/2022</td>
                            <td>Application</td>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td> <img src="{{ asset('/images/alert-no.png') }}" alt=">Notification"> <span>REP Renewal for
                                    Timmy
                                    Yao is
                                    still Progress</span></td>
                            <td>BeccaLam</td>
                            <td>03/11/2022</td>
                            <td>Application</td>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td>Student Pass Renewal for Kai Jie is still Progress</td>
                            <td>BeccaLam</td>
                            <td>03/11/2022</td>
                            <td>Application</td>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td> <img src="{{ asset('/images/warning.png') }}" alt=">Notification"><span> Passport for Xin
                                    Hui
                                    needs to be
                                    renewed</span></td>
                            <td>AdeleLim</td>
                            <td>03/11/2022</td>
                            <td>Application</td>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td>Student Pass for Xin Hui needs to be renewed</td>
                            <td>AdeleLim</td>
                            <td>03/11/2022</td>
                            <td>Application</td>
                        </tr>
                        <tr>
                            <td>009</td>
                            <td> <img src="{{ asset('/images/alert-no.png') }}" alt=">Notification"> Pass for Kai Jie Oh is
                                expiring soon
                            </td>
                            <td>AdeleLim</td>
                            <td>03/11/2022</td>
                            <td>Application</td>
                        </tr>
                    </table>

                </div>
                <div class="pagination">
                    <div class="pagination-item">
                        <span>Showing </span>
                        <a href="#">1</a>
                        <a href="#">-</a>
                        <a href="#">4</a>
                        <a href="#">of</a>
                        <a href="#">4</a>
                        <div class="arrow-pagination">
                            <a href="#"><i class="fa-solid fa-chevron-left"></i></a>
                            <a href="#">1</a>
                            <a href="#">2</a>
                            <a href="#"><i class="fa-solid fa-chevron-right"></i></a>
                        </div>
                    </div>
                    <div class="pagination-item">
                        <span>Show</span>
                        <select>
                            <option>10</option>
                            <option>10</option>
                            <option>10</option>
                            <option>10</option>
                            <option>10</option>
                            <option>10</option>
                        </select>
                        <span>Entries</span>
                    </div>
                </div>
                <div class="Sales-Applications">
                    <div class="Sales-details">
                        <span class="right"><img src="{{ asset('/images/Sales.png') }}" alt="Sales"></span>
                        <h5>
                            <lable>Sales </lable><span><i class="fa-solid fa-chevron-right"></i></span>
                        </h5>
                    </div>
                    <div class="Applications-wrap">
                        <div class="Applications-wrap-box ">
                            <div class="Total_Applications box-sadwo">
                                <div class="Applications">
                                    <h6>Total<br> Applications</h6>
                                    <h3>2</h3>
                                </div>
                                <div class="Applications">
                                    <h6>Total Amount<br> of Business Generated</h6>
                                    <h3>$1600.00</h3>
                                </div>
                            </div>
                            <div class="Business-Type box-sadwo">
                                <h6>Business Type</h6>
                                <div class="Business-marketing">
                                </div>
                                <div class="Business-grap-up">
                                    <span></span>
                                    <label>B2B (2)</label>
                                </div>
                                <div class="Business-garp-dun">
                                    <span></span>
                                    <label>B2C (1)</label>
                                </div>
                            </div>
                        </div>
                        <div class="B2B-Agreement box-sadwo">
                            <h6>Sign of B2B Agreement</h6>
                            <div class="Agreement-grap"></div>
                            <div class="Agreement-grap-up">
                                <span></span>
                                <label>Signed (1)</label>
                            </div>
                            <div class="Agreement-garp-dun">
                                <span></span>
                                <label>Not Signed (0)</label>
                            </div>
                        </div>
                    </div>
                    <div class="Wealth_Commission">
                        <div class="Sales-details">
                            <span class="right"><img src="{{ asset('/images/Wealth.png') }}" alt="Wealth"></span>
                            <h5>
                                <lable>Wealth </lable><span><i class="fa-solid fa-chevron-right"></i></span>
                            </h5>
                        </div>
                        <div class="Total_Applications box-sadwo Applications-wrap-box">
                            <div class="Applications">
                                <h6>Total Received <br>Commission</h6>
                                <h3>$300.00</h3>
                            </div>
                            <div class="Applications">
                                <h6>Total Pending Commission</h6>
                                <h3>$100.00</h3>
                            </div>
                        </div>
                        <div class="Total_Applications box-sadwo Applications-wrap-box">
                            <div class="Applications">
                                <h6>Number of Clients<br> Redeemed Earnings</h6>
                                <h3>0</h3>
                            </div>
                            <div class="Applications">
                                <h6>Total <br>Redemption</h6>
                                <h3>$0</h3>
                            </div>
                        </div>
                    </div>
                    <div class="Business-marketing-fo d-flex">
                        <div class="Business-Type box-sadwo">
                            <h6>Business Type</h6>
                            <div class="Business-marketing">
                            </div>
                            <div class="Business-grap-up">
                                <span></span>
                                <label>B2B (2)</label>
                            </div>
                            <div class="Business-garp-dun">
                                <span></span>
                                <label>B2C (1)</label>
                            </div>
                        </div>
                        <div class="Business-Type box-sadwo">
                            <h6>FO Types</h6>
                            <div class="Business-marketing">
                            </div>
                            <div class="Business-grap-up">
                                <span></span>
                                <label>13O (1)</label>
                            </div>
                            <div class="Business-garp-dun">
                                <span></span>
                                <label>13D (1)</label>
                            </div>
                            <div class="Business-garp-dun">
                                <span></span>
                                <label>13U (1)</label>
                            </div>
                            <div class="Business-garp-dun">
                                <span></span>
                                <label>Others (1)</label>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="Sales-details Operation-details ">
                    <span class="right"><img src="{{ asset('/images/Operation.png') }}" alt="Operation"></span>
                    <h5>
                        <lable>Operation </lable><span><i class="fa-solid fa-chevron-right"></i></span>
                    </h5>
                </div>
                <div class="Total_Applications  Operation-wrap-box">
                    <div class="Operation-applications">
                        <div class="Applications box-sadwo">
                            <h6>Total Applications</h6>
                            <h3>4</h3>
                        </div>
                        <div class="Business-marketing-fo d-flex Operation-wrap">
                            <div class="Business-Type box-sadwo">
                                <h6>Pass Application Status</h6>
                                <div class="Business-marketing">
                                </div>
                                <div class="Business-grap-up">
                                    <span></span>
                                    <label>Rejected (1)</label>
                                </div>
                                <div class="Business-garp-dun">
                                    <span></span>
                                    <label>Approved (2)</label>
                                </div>
                                <div class="Business-garp-dun">
                                    <span></span>
                                    <label>Pending (1)</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="Business-Type box-sadwo">
                        <h6>Business Type (Pass)</h6>
                        <div class="Business-marketing">
                        </div>
                        <div class="Business-grap-up">
                            <span></span>
                            <label>FO (2)</label>
                        </div>
                        <div class="Business-garp-dun">
                            <span></span>
                            <label>PIC (1)</label>
                        </div>
                        <div class="Business-garp-dun">
                            <span></span>
                            <label>Self-Employment (1)</label>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
