@extends('layouts.app')
@push('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')


    <!-- Title Area -->
    <div class="TitleBlock">
        <div class="headingArea p-3">
            <h2 class="m-0">{{ $sale->id }} - {{ $sale->client_name }}</h2>
        </div>
    </div>
    <!-- Filter Data Pagination -->
    <div class="filterPagination d-flex justify-content-between align-items-center">
        <div class="paginationLeft">
            <ul>
                <li><a href="{{ route('sales.show', ['id' => $sale->id]) }}">Sales</a></li>
                <li>{{ Breadcrumbs::render() }} </li>
            </ul>

        </div>
        <div class="filterBtn d-flex align-items-center justify-content-end">
            <a href="javascript:void(0)" class="me-3 print-icon"><img src="{{ url('/images/Vector.svg') }}"
                    alt="print Icon"></a>
            <a href="{{ route('sales.edit', $sale->id) }}"><button class="btn saveBtn">
                    <span>Edit</span>
                </button></a>
            {{-- <a href="{{ route('sales.destroy', $sale->id) }}"><button class="btn saveBtn cancelBtn"> --}}
            <a href="javascript:void(0);" data-id={{ $sale->id }}
                class="btn del_confirm btn saveBtn cancelBtn delete">Delete</a>

            </button></a>
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

    <div class="dataAreaMain viewpage sales-view">

        <div class="card formContentData border-0 p-4">
            <h3>Basic Information</h3>

            <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">

            <fieldset id="account" class=" w-100 d-flex justify-content-start flex-wrap form-fields mb-0">

                <div class="formAreahalf">
                    <label for="c" class="form-label">Client's Name</label>
                    </br>{{ $sale->client_name }}
                </div>

                <div class="formAreahalf ">
                    <label for="cby" class="form-label">Created By</label>
                    </br>{{ $sale->created_by }}
                </div>

                <div class="formAreahalf mb-1 ">
                    <label for="cby" class="form-label">Client Status</label>
                    <div class="active-btn {{ $sale->client_sts }}">{{ $sale->client_sts }}</div>
                </div>
            </fieldset>

        </div>





        <div class="card formContentData application border-0 p-4">
            <h3>Application Information</h3>

            <div class="sales"><button class="btn saveBtn">Sales Application</button></div>


            <div class="accordion-item edit_application">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                        <i class="fa fa-arrows-v" aria-hidden="true"></i>
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                    aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">

                        <fieldset id="account" class=" w-100 d-flex justify-content-start flex-wrap form-fields">

                            <div class="formAreahalf ">
                                <label for="" class="form-label">Business Type</label>
                                <br>{{ $sale->bus_type }}
                            </div>

                            <div class="formAreahalf ">
                                <label for="" class="form-label">Client Type</label>
                                <br>{{ $sale->client_type }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="" class="form-label">Client's Full Name</label>
                                <br>{{ $sale->client_name }}
                            </div>

                            <div class="formAreahalf ">
                                <label for="" class="form-label">Country of Client</label>
                                <br>{{ $sale->client_country }}
                            </div>

                            <div class="formAreahalf ">
                                <label for="" class="form-label">City of Client</label>
                                <br>{{ $sale->client_city }}
                            </div>

                            <div class="formAreahalf ">
                                <label for="" class="form-label">Phone no. of POC</label>
                                <br>{{ $sale->poc_ph }}
                            </div>

                            <div class="formAreahalf ">
                                <label for="" class="form-label">Name of POC</label>
                                <br>{{ $sale->poc_name }}
                            </div>

                            <div class="formAreahalf ">
                                <label for="" class="form-label">Email of POC</label>
                                <br>{{ $sale->poc_email }}
                            </div>

                            <div class="formAreahalf ">
                                <label for="" class="form-label"> Wechat id of POC</label>
                                <br>{{ $sale->poc_wechat }}
                            </div>
                            @if ($sale->bus_type == 'B2B')
                                <div class="formAreahalf ">
                                    <label for="clienttype" class="form-label">Sign of B2B Agreement?</label>
                                    <br>
                                    {{ $sale->b2b_sign }}
                                </div>

                                @if ($sale->bus_type == 'B2B')
                                    <div class="formAreahalf ">
                                        <label for="" class="form-label">B2B Agreement Sign Date</label>
                                        @if ($sale->b2b_agr_sign_date)
                                            <br>
                                            {{ convertDate($sale->b2b_agr_sign_date,"d/m/Y") }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                @endif
                                @if ($sale->bus_type == 'B2B')
                                    <div class="formAreahalf ">
                                        <label for="" class="form-label">B2B Agreement Expiry Date</label>
                                        @if ($sale->b2b_agr_exp_date)
                                            <br>
                                            {{ convertDate($sale->b2b_agr_exp_date,"d/m/Y") }}
                                        @else
                                            -
                                        @endif

                                    </div>
                                @endif
                                @if ($sale->bus_type == 'B2B')
                                    <div class="formAreahalf ">
                                        <label for="clienttype" class="form-label"> Agreement Renewal Reminder</label>
                                        @if ($sale->agr_ren_rem)
                                            <br>{{ $sale->agr_ren_rem }}
                                        @else
                                            -
                                        @endif
                                    </div>
                                @endif
                                @if ($sale->bus_type == 'B2B')
                                    <div class="formAreahalf ">
                                        <label for="clienttype" class="form-label"> Agreement Renewal Frequency</label>
                                        <div class="select_box">

                                            @if (isset($sale->agr_ren_fre))
                                                {{-- <span class="every">Every</span><span class="select"> --}}
                                                <br>Every {{ $sale->agr_ren_fre }}
                                                {{-- </span> --}}
                                            @else
                                                -
                                            @endif

                                        </div>
                                    </div>
                                @endif
                            @endif
                        </fieldset>


                        <?php $tpb = unserialize($sale->type_pot_bus);

                        $tbg = unserialize($sale->type_bus_gen);

                        ?>




                        <div class="accordion-body potensial_business">


                            @if (isset($tpb))
                                <?php $i = 0; ?>
                                @foreach ($tpb as $s)
                                    <?php $i++; ?>


                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapseThree{{ $i }}"
                                                aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">
                                                <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                            </button>
                                        </h2>
                                        <label for="clienttype" class="form-label mb-0">
                                            Type of Potential
                                            Business {{ $i }}
                                        </label>
                                        @if (isset($s['drp']))
                                        @else
                                            <div class="formAreahalf space_business">

                                            </div>
                                        @endif
                                        <div id="panelsStayOpen-collapseThree{{ $i }}"
                                            class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingThree">

                                            <div class="accordion-body">
                                                <fieldset id="dynamicAddRemove"
                                                    class="w-100 d-flex justify-content-start flex-wrap form-fields type-of-potential-bussiness">

                                                    @if (isset($s['drp']))
                                                        @if (
                                                            $s['drp'] != 'Wealth Management' &&
                                                                $s['drp'] != 'Immigration Programme' &&
                                                                $s['drp'] != 'Family Office' &&
                                                                $s['drp'] != 'Passport' &&
                                                                $s['drp'] != 'Real Property' &&
                                                                $s['drp'] != 'Pure Identity Management' &&
                                                                $s['drp'] != 'Account Services' &&
                                                                $s['drp'] != 'Education' &&
                                                                $s['drp'] != 'Bank Account Opening')
                                                            <div class="formAreahalf ">
                                                                <label class="form-label other_space"
                                                                    for=""></label>
                                                                <br> Others

                                                            </div>
                                                            {{-- <div class="formAreahalf ">

                                                            </div> --}}
                                                            <div class="formAreahalf ">
                                                                <label class="form-label" for="">Please
                                                                    Specifiy</label>
                                                                <br>{{ $s['drp'] }}
                                                            </div>
                                                        @else
                                                            <div class="formAreahalf ">
                                                                <br>{{ $s['drp'] }}

                                                            </div>
                                                            <div class="formAreahalf ">

                                                            </div>
                                                        @endif
                                                    @endif

                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="dcname">Name of direct
                                                            client</label>
                                                        <br>{{ $s['dcname'] }}


                                                    </div>
                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="passcountry">Passport
                                                            Country</label>
                                                        <br>{{ $s['passcountry'] }}

                                                    </div>

                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="wechatidc">Wechat Id of
                                                            client</label>
                                                        <br>{{ $s['wechatidc'] }}
                                                    </div>

                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="cmobileno">Mobile no. of
                                                            Client</label>
                                                        <br>{{ $s['cmobileno'] }}
                                                    </div>

                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="cemail">Email address of
                                                            client</label>
                                                        <br>{{ $s['cemail'] }}
                                                    </div>

                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="busdes">Business
                                                            Description</label>
                                                        <br>{{ $s['busdes'] }}

                                                    </div>

                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="buscurr">Currency of Potential
                                                            Business
                                                        </label>
                                                        <br>
                                                        @if (isset($s['buscurr']))
                                                            {{ $s['buscurr'] }}
                                                        @endif
                                                    </div>

                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="busamt">Amount of Potential
                                                            Business
                                                        </label>
                                                        <br>
                                                        <div class="inputdoller"><span
                                                                class="doller">$</span><span>{{ $s['busamt'] }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="remarks">Remarks</label>
                                                        <br>{{ $s['remarks'] }}

                                                    </div>


                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif


                            @isset($tbg)
                                <?php $a = 0; ?>

                                @foreach ($tbg as $r)
                                    <?php $a++; ?>


                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapseTwo{{ $a }}"
                                                aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                                                <i class="fa fa-arrows-v" aria-hidden="true"></i>
                                            </button>
                                        </h2>
                                        <label for="clienttype" class="form-label mb-0">Type of Generated Business
                                            {{ $a }}</label>
                                        @if (isset($r['g_drp']))
                                        @else
                                            <div class="formAreahalf space_business">

                                            </div>
                                        @endif
                                        <div id="panelsStayOpen-collapseTwo{{ $a }}"
                                            class="accordion-collapse collapse show"
                                            aria-labelledby="panelsStayOpen-headingTwo">

                                            <div class="accordion-body">
                                                <fieldset id="dynamicAddRemove2"
                                                    class="  w-100 d-flex justify-content-start flex-wrap form-fields type-of-buss-gen">
                                                    @if (isset($r['g_drp']))
                                                        @if (
                                                            $r['g_drp'] != 'Wealth Management' &&
                                                                $r['g_drp'] != 'Immigration Programme' &&
                                                                $r['g_drp'] != 'Family Office' &&
                                                                $r['g_drp'] != 'Passport' &&
                                                                $r['g_drp'] != 'Real Property' &&
                                                                $r['g_drp'] != 'Pure Identity Management' &&
                                                                $r['g_drp'] != 'Account Services' &&
                                                                $r['g_drp'] != 'Education' &&
                                                                $r['g_drp'] != 'Bank Account Opening')
                                                            <div class="formAreahalf ">
                                                                <label class="form-label other_space" for=""></label>
                                                                <br> Others

                                                            </div>
                                                            {{-- <div class="formAreahalf ">

                                                            </div> --}}
                                                            <div class="formAreahalf ">
                                                                <label class="form-label" for="">Please
                                                                    Specifiy</label>
                                                                <br> {{ $r['g_drp'] }}
                                                            </div>
                                                        @else
                                                            <div class="formAreahalf ">
                                                                <br> {{ $r['g_drp'] }}

                                                            </div>
                                                            <div class="formAreahalf ">

                                                            </div>
                                                        @endif
                                                    @endif

                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="">Name of direct client</label>
                                                        <br>{{ $r['g_dcname'] }}


                                                    </div>
                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="passcountry">Passport Country</label>
                                                        <br>{{ $r['g_passcountry'] }}

                                                    </div>

                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="wechatidc">Wechat Id of client</label>
                                                        <br>{{ $r['g_wechatid'] }}

                                                    </div>

                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="cmobileno">Mobile no. of client</label>
                                                        <br>{{ $r['g_cmobno'] }}
                                                    </div>


                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="cemail">Email address of
                                                            client</label>
                                                        <br>{{ $r['g_cemail'] }}
                                                    </div>

                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="busdes">Business Description</label>
                                                        <br>{{ $r['g_busdes'] }}
                                                    </div>

                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="buscurr">Currency of Business
                                                            Generated</label>

                                                        @if (isset($r['g_buscurr']))
                                                            <br>{{ $r['g_buscurr'] }}
                                                        @endif
                                                    </div>

                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="busamt">Amount of Business
                                                            Generated</label>
                                                        <br>${{ $r['g_busamt'] }}
                                                    </div>

                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="remarks">Remarks</label>
                                                        <br>{{ $r['g_remarks'] }}

                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    </fieldset>
                                @endforeach
                            @endisset
                        </div>
                    </div>

                </div>




            </div>





        </div>
        <div class="lower-bottom ">

            <div class="notes-common formContentData">

                <form action="javascript:void(0)" method="POST" name="notes" id="notes" class="note_send">
                    @csrf
                    <input type="hidden" name="created_by_name" value="{{ Auth::user()->name }}">
                    {{-- <input type="hidden" name="crreated_by" value="{{ Auth::user()->id }}"> --}}
                    <input type="hidden" name="application_id" value="{{ $sale->id }}">
                    <input type="hidden" value="Sale Application" name="tbl_name">

                    <div class="textarea">
                        <label class="form-label mt-5" for="notes">Notes</label>
                        <textarea id="text_notes" name="notes" placeholder="Type your notes here..." rows="8" cols="200"></textarea>
                        <input type="submit" class="btn saveBtn btn_notes" value="Save">
                        <input type="button" id="notes_cancel" class="btn saveBtn cancelBtn delete" value="Cancel"
                            style="display: none">
                    </div>



                </form>


                @foreach ($notes as $note)
                    <div class="notes_show" id="note{{$note->id }}">
                        <div class="cross"><span class="note_remove" data-Id="{{ $note->id }}">x</span></div>
                        <p class="desc_notes">{{ $note->notes_description }}</p>
                        <p class="created">
                            {{ $note->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}
                        </p>
                        <p class="createdby"><b>{{ $note->created_by }}</b></p>
                    </div>
                @endforeach
                <div class="dataTables_wrapper dt-bootstrap4 no-footer">
                    <div class="row">
                        <div class="col-sm-12 col-md-5"></div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers">
                                <ul id="pagin" class="pagination"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card file upload">
                <h3>File Uploads</h3>
                <div class="dataAreaMain">
                    <div class="table_cstm  dasboard-entry">
                        <table class="table table_yellow file_upload_table" >
                            <thead>
                                <tr>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Uploaded By</th>
                                    <th scope="col">Date & Time</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                                                
                                @foreach ($file as $files)
                                    <tr>
                                        <td>{{ $files->file_orignal_name }}</td>
                                        <td>{{ $files->uploaded_by }}</td>
                                        <td>{{ $files->created_at->setTimezone('Asia/Singapore')->format('j F Y  g:i a') }}</td>
                                        <td>
                                            <a href="{{ url('file/' . $files->file) }}" download class="link-normal">
                                                <img src="{{ url('images/download_icon.svg') }}" alt="delete-icon">
                                            </a>
                                            <a href="javascript:void(0);" class="del_confirm_view ink-normal"
                                                data-id="{{ $files->id }}"><i class="fa-solid fa-trash ms-2"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card file action">
                <h3>Action Log</h3>
                <div class="dataAreaMain">
                    <div class="table_cstm  dasboard-entry">
                        <table class="table table_yellow user_action_log" >
                            <thead>
                                <tr>
                                    <th scope="col">Actions</th>
                                    <th scope="col">Made By</th>
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
            </div>

        </div>





        <div id="print_screen" style="display:none;">
            <div class="print-holder">
                <div class="page page_1" style="padding:30px;">
                    <table border='0' cellspacing='0' cellpadding='0' border-spacing='0' width='800'>
                        <tr class="first-row-cstm">
                            <td>
                                <table class="header-table">
                                    <tr>
                                        <td style="width:20%;">
                                            <img src="{{ url('/images/logo.png') }}" alt="logo"
                                                style="width:100px;">
                                        </td>
                                        <td>
                                            <span style="width:80%;display: flex;justify-content: center; flex-direction: column; align-item: center;">
                                                <span style="text-align: center; display: block; font-size: 26px; color: rgb(1, 1, 1); font-weight: bold; user-select: text;">{{ $sale->id }} -{{ $sale->client_name }}</span><br/>
                                                <span style="text-align: center; display: block;font-size: 26px; color: rgb(1, 1, 1);font-weight: bold; user-select: text;">Sales</span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="second-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:25%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:40%">
                                            <div class="text-center line-cstm"
                                                style="font-size:22px; color:#010101; font-weight:500; padding:40px 0;">
                                                Basic Information</div>
                                        </td>
                                        <td style="width:25%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="third-row-cstm">
                            <td>
                                <table border="0">
                                    <tr>
                                        <td style="width:50%; font-weight:700; font-size:15px; color:#010101;">Client
                                        </td>
                                        <td style="width:50%; font-weight:700; font-size:15px; color:#010101;">Created
                                            By</td>
                                    </tr>

                                    <tr>
                                        <td
                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:8px;">
                                            {{ $sale->client_name }}</td>
                                        <td
                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:8px;">
                                            {{ $sale->created_by }}</td>
                                    </tr>

                                    <tr>
                                        <td
                                            style="width:50%; font-weight:700; font-size:15px; color:#010101; padding-top:30px;">
                                            Client Status</td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:8px;">
                                            {{ $sale->client_sts }}</td>
                                    </tr>

                                </table>
                            </td>
                        </tr>

                        <tr class="fourth-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto; ">
                                    <tr>
                                        <td style="width:20%; text-align:right; color:#000; padding:40px 0;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:55% padding:56px 0 40px;">
                                            <div class="text-center line-cstm"
                                                style="font-size:22px; color:#010101; font-weight:500;">Application
                                                Information</div>
                                        </td>
                                        <td style="width:20%; text-align:left; color:#000; padding:40px 0;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="five-row-cstm">
                            <td>
                                <table border="0">
                                    <tr>
                                        <td style="width:50%; font-weight:700; font-size:15px; color:#010101;">Business
                                            Type</td>
                                        <td style="width:50%; font-weight:700; font-size:14px; color:#010101;">Client
                                            Type</td>
                                    </tr>

                                    <tr>
                                        <td
                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:20px;">
                                            {{ $sale->bus_type }}</td>
                                        <td
                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:20px;">
                                            {{ $sale->client_type }}</td>
                                    </tr>


                                    <tr>
                                        <td
                                            style="width:50%; font-weight:700; font-size:15px; color:#010101; padding-top:30px;">
                                            Client's full Name </td>
                                        <td
                                            style="width:50%; padding-top:30px; font-weight:700; font-size:15px; color:#010101;">
                                            Country of client</td>
                                    </tr>

                                    <tr>
                                        <td
                                            style="width:50%; font-weight:400; font-size:15px; color:#010101; padding-top:20px;">
                                            {{ $sale->client_name }}</td>
                                        <td
                                            style="width:50%; font-weight:400; font-size:15px; color:#010101; padding-top:20px;">
                                            {{ $sale->client_country }}</td>
                                    </tr>


                                    <tr>
                                        <td
                                            style="width:50%; font-weight:700; font-size:15px; color:#010101; padding-top:30px;">
                                            City of Client</td>
                                        <td
                                            style="width:50%; padding-top:30px; font-weight:700; font-size:15px; color:#010101;">
                                            Phone no. of POC</td>
                                    </tr>

                                    <tr>
                                        <td
                                            style="width:50%; font-weight:400; font-size:15px; color:#010101; padding-top:20px;">
                                            {{ $sale->client_city }}</td>
                                        <td
                                            style="width:50%; font-weight:400; font-size:15px; color:#010101; padding-top:20px;">
                                            {{ $sale->poc_ph }}</td>
                                    </tr>


                                    <tr>
                                        <td
                                            style="width:50%; font-weight:700; font-size:15px; color:#010101; padding-top:30px;">
                                            Name of POC </td>
                                        <td
                                            style="width:50%; padding-top:30px; font-weight:700; font-size:15px; color:#010101;">
                                            Email of POC</td>
                                    </tr>

                                    <tr>
                                        <td
                                            style="width:50%; font-weight:400; font-size:15px; color:#010101; padding-top:20px;">
                                            {{ $sale->poc_name }}</td>
                                        <td
                                            style="width:50%; font-weight:400; font-size:15px; color:#010101; padding-top:20px;">
                                            {{ $sale->poc_email }}</td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="width:50%; font-weight:700; font-size:15px; color:#010101; padding-top:30px;">
                                            Wechat id of POC </td>
                                        <td
                                            style="width:50%; padding-top:30px; font-weight:700; font-size:15px; color:#010101;">
                                            Sign of B2B Agreement?</td>
                                    </tr>

                                    <tr>
                                        <td
                                            style="width:50%; font-weight:400; font-size:15px; color:#010101; padding-top:20px;">
                                            {{ $sale->poc_wechat }}</td>
                                        <td
                                            style="width:50%; font-weight:400; font-size:15px; color:#010101; padding-top:20px;">
                                            {{ $sale->b2b_sign }}</td>
                                    </tr>
                                    @if ($sale->b2b_sign == 'Yes')
                                        <tr>
                                            <td
                                                style="width:50%; font-weight:700; font-size:15px; color:#010101; padding-top:30px;">
                                                B2B Agreement Sign Date </td>
                                            <td
                                                style="width:50%; padding-top:30px; font-weight:700; font-size:15px; color:#010101;">
                                                B2B Agreement Expiry Date</td>
                                        </tr>

                                        <tr>
                                            <td
                                                style="width:50%; font-weight:400; font-size:15px; color:#010101; padding-top:20px;">
                                                {{ convertDate($sale->b2b_agr_sign_date,"d/m/Y") }}
                                            </td>
                                            <td
                                                style="width:50%; font-weight:400; font-size:15px; color:#010101; padding-top:20px;">
                                                {{ convertDate($sale->b2b_agr_exp_date,"d/m/Y") }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td
                                                style="width:50%; font-weight:700; font-size:15px; color:#010101; padding-top:30px;">
                                                Agreement Renewal Reminder</td>
                                            <td
                                                style="width:50%; padding-top:30px; font-weight:700; font-size:15px; color:#010101;">
                                                Agreement Renewal Frequency</td>
                                        </tr>

                                        <tr>
                                            <td
                                                style="width:50%; font-weight:400; font-size:15px; color:#010101; padding-top:20px;">
                                                {{ $sale->agr_ren_rem }}</td>
                                            <td
                                                style="width:50%; font-weight:400; font-size:15px; color:#010101; padding-top:20px;">
                                                Every {{ $sale->agr_ren_fre }}</td>
                                        </tr>
                                    @endif

                                </table>
                            </td>
                        </tr>

                    </table>
                </div>

                <div class="page page_2" style="page-break-before: always; padding:30px;">
                    <table border='0' cellspacing='0' cellpadding='0' border-spacing='0' width='800'>
                        <tr class="first-row-cstm-page_2">
                            <td>
                            <table class="header-table">
                                    <tr>
                                        <td style="width:20%;">
                                            <img src="{{ url('/images/logo.png') }}" alt="logo"
                                                style="width:100px;">
                                        </td>
                                        <td>
                                            <span style="width:80%;display: flex;justify-content: center; flex-direction: column; align-item: center;">
                                                <span style="text-align: center; display: block; font-size: 26px; color: rgb(1, 1, 1); font-weight: bold; user-select: text;">{{ $sale->id }} -{{ $sale->client_name }}</span><br/>
                                                <span style="text-align: center; display: block;font-size: 26px; color: rgb(1, 1, 1);font-weight: bold; user-select: text;">Sales</span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="second-row-cstm-page_2">
                            <td>
                                <table style="width:80%; margin:0 auto;">
                                    <tr>
                                        <td style="width:21%; text-align:right; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:53%">
                                            <div class="text-center line-cstm"
                                                style="font-size:22px; color:#010101; font-weight:500; padding:40px 0;">
                                                Application Information</div>
                                        </td>
                                        <td style="width:21%; text-align:left; color:#000;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr class="third-row-cstm-page_2">
                            <td>
                                <table style="width:100%; margin:0 auto; border:1px solid #000000;">
                                    @if (isset($tpb))
                                        <?php $i = 0; ?>
                                        @foreach ($tpb as $s)
                                            <?php $i++; ?>

                                            <tr>
                                                <td style="padding:15px">
                                                    <table border='1'>
                                                        <tr>
                                                            @if (isset($s['drp']))
                                                                @if (
                                                                    $s['drp'] != 'Wealth Management' &&
                                                                        $s['drp'] != 'Immigration Programme' &&
                                                                        $s['drp'] != 'Family Office' &&
                                                                        $s['drp'] != 'Passport' &&
                                                                        $s['drp'] != 'Real Property' &&
                                                                        $s['drp'] != 'Pure Identity Management' &&
                                                                        $s['drp'] != 'Account Services' &&
                                                                        $s['drp'] != 'Education' &&
                                                                        $s['drp'] != 'Bank Account Opening')
                                                                    <td
                                                                        style="width:50%; font-weight:700; font-size:16px; color:#010101; padding:20px 0 0 20px;">
                                                                        Type of Potential Business {{ $i }}</td>
                                                                    <td
                                                                        style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                                        Please Specify</td>
                                                                    <td>
                                                        </tr>

                                                        <tr>
                                                            <td
                                                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px ; padding-left:20px;">
                                                                Others</td>
                                                            <td
                                                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                                                {{ $s['drp'] }}</td>
                                                        @else
                                                            <td
                                                                style="width:50%; font-weight:700; font-size:16px; color:#010101; padding:20px 0 0 20px;">
                                                                Type of Potential Business {{ $i }}</td>
                                                            <td
                                                                style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            </td>
                                                            <td>
                                                        </tr>

                                                        <tr>

                                                            <td
                                                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                                                {{ $s['drp'] }}</td>

                                                            <td
                                                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            </td>
                                        @endif
                                    @else
                                        <td
                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding:20px 0 0 20px;">
                                            Type of Potential Business {{ $i }}</td>
                                        <td
                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                        </td>
                                        <td>
                        </tr>

                        <tr>

                            <td
                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                            </td>

                            <td
                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                            </td>
                            @endif



                        </tr>




                        <tr>
                            <td
                                style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                Name of direct
                                client</td>
                            <td
                                style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                Passport
                                Country</td>

                        </tr>

                        <tr>
                            <td
                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                {{ $s['dcname'] }}</td>
                            <td
                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                {{ $s['passcountry'] }}</td>

                        </tr>



                        <tr>
                            <td
                                style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                Wechat Id of
                                client</td>
                            <td
                                style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                Mobile no. of
                                Client</td>
                        </tr>

                        <tr>
                            <td
                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                {{ $s['wechatidc'] }}</td>
                            <td
                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                {{ $s['cmobileno'] }}</td>
                        </tr>

                        <tr>
                            <td
                                style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                Email address of
                                client</td>
                            <td
                                style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                Business
                                Description</td>
                        </tr>

                        <tr>
                            <td
                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                {{ $s['cemail'] }}</td>
                            <td
                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                {{ $s['remarks'] }}</td>
                        </tr>

                        <tr>
                            <td
                                style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                Currency of Potential
                                Business</td>
                            <td
                                style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                Amount of Potential
                                Business</td>
                        </tr>

                        <tr>
                            <td
                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                @if (isset($s['buscurr']))
                                    {{ $s['buscurr'] }}
                                @endif
                            </td>
                            <td
                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                @if (isset($s['busamt']))
                                    ${{ $s['busamt'] }}
                                @endif</td>
                        </tr>

                        <tr>
                            <td
                                style="width:50%; font-weight:700; font-size:14px; color:#010101; padding:22px 0 30px 20px;">
                                Remarks</td>
                        </tr>
                        <tr>
                            <td
                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                {{ $s['remarks'] }}</td>
                        </tr>



                    </table>
                    </td>
                    </tr>
                    @endforeach
                    @endif

                    </table>
                    </td>
                    </tr>

                    </table>

                </div>

                <div class="page page_3" style="page-break-before: always; padding:30px;">
                    <table border='0' cellspacing='0' cellpadding='0' border-spacing='0' width='800'>
                        <tr class="first-row-cstm-page_3">
                            <td>
                            <table class="header-table">
                                    <tr>
                                        <td style="width:20%;">
                                            <img src="{{ url('/images/logo.png') }}" alt="logo"
                                                style="width:100px;">
                                        </td>
                                        <td>
                                            <span style="width:80%;display: flex;justify-content: center; flex-direction: column; align-item: center;">
                                                <span style="text-align: center; display: block; font-size: 26px; color: rgb(1, 1, 1); font-weight: bold; user-select: text;">{{ $sale->id }} -{{ $sale->client_name }}</span><br/>
                                                <span style="text-align: center; display: block;font-size: 26px; color: rgb(1, 1, 1);font-weight: bold; user-select: text;">Sales</span>
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="fourth-row-cstm">
                            <td>
                                <table style="width:80%; margin:0 auto; ">
                                    <tr>
                                        <td style="width:20%; text-align:right; color:#000; padding:40px 0;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                        <td style="text-align:center; width:55% padding:56px 0 40px;">
                                            <div class="text-center line-cstm"
                                                style="font-size:22px; color:#010101; font-weight:500;">Application
                                                Information</div>
                                        </td>
                                        <td style="width:20%; text-align:left; color:#000; padding:40px 0;">
                                            <hr / style="background-color:#000; ">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        {{-- <tr class="second-row-cstm-page_3">
                                <td>
                                    <table style="width:80%; margin:0 auto;">
                                        <tr>
                                            <td style="width:21%; text-align:right; color:#000;">
                                                <hr / style="background-color:#000; ">
                                            </td>
                                            <td style="text-align:center; width:53%">
                                                <div class="text-center line-cstm"
                                                    style="font-size:22px; color:#010101; font-weight:500; padding:40px 0;">
                                                    Application Information</div>
                                            </td>
                                            <td style="width:21%; text-align:left; color:#000;">
                                                <hr / style="background-color:#000; ">
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr> --}}

                        <tr class="third-row-cstm-page_3">
                            <td>
                                <table style="width:100%; margin:0 auto; border:1px solid #000000;">
                                    {{-- <tr>
                                            <td style="padding:15px">
                                                <table border='1'>
                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding:20px 0 0 20px;">
                                                            Email address of client</td>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding:20px 0 0 20px;">
                                                            Business description</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px ; padding-left:20px;">
                                                            test@gmail.com</td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                        <td
                                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding:22px 0 20px 20px;">
                                                            Remarks</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr> --}}

                                    @isset($tbg)
                                        <?php $a = 0; ?>

                                        @foreach ($tbg as $r)
                                            <?php $a++; ?>

                                            <tr>
                                                <td style="padding:15px">
                                                    <table border='1'>
                                                        <tr>
                                                            @if (isset($r['g_drp']))
                                                                @if (
                                                                    $r['g_drp'] != 'Wealth Management' &&
                                                                        $r['g_drp'] != 'Immigration Programme' &&
                                                                        $r['g_drp'] != 'Family Office' &&
                                                                        $r['g_drp'] != 'Passport' &&
                                                                        $r['g_drp'] != 'Real Property' &&
                                                                        $r['g_drp'] != 'Pure Identity Management' &&
                                                                        $r['g_drp'] != 'Account Services' &&
                                                                        $r['g_drp'] != 'Education' &&
                                                                        $r['g_drp'] != 'Bank Account Opening')
                                                                    <td
                                                                        style="width:50%; font-weight:700; font-size:16px; color:#010101; padding:20px 0 0 20px;">
                                                                        Type of Generated Business {{ $a }}</td>
                                                                    <td
                                                                        style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                                        Please Specify</td>
                                                                    <td>
                                                        </tr>

                                                        <tr>
                                                            <td
                                                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px ; padding-left:20px;">
                                                                Others</td>
                                                            <td
                                                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                                                {{ $r['g_drp'] }}</td>
                                                        @else
                                                            <td
                                                                style="width:50%; font-weight:700; font-size:16px; color:#010101; padding:20px 0 0 20px;">
                                                                Type of Generated Business {{ $a }}</td>
                                                            <td
                                                                style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            </td>
                                                            <td>
                                                        </tr>

                                                        <tr>

                                                            <td
                                                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                                                {{ $r['g_drp'] }}</td>

                                                            <td
                                                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            </td>
                                        @endif
                                    @else
                                        <td
                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding:20px 0 0 20px;">
                                            Type of Generated Business {{ $a }}</td>
                                        <td
                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                        </td>
                                        <td>
                            </tr>

                            <tr>

                                <td
                                    style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                </td>

                                <td
                                    style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                </td>
                                @endif

                            </tr>




                            <tr>
                                <td
                                    style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                    Name of direct
                                    client</td>
                                <td
                                    style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                    Passport
                                    Country</td>

                            </tr>

                            <tr>
                                <td
                                    style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                    {{ $r['g_dcname'] }}</td>
                                <td
                                    style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                    {{ $r['g_passcountry'] }}</td>

                            </tr>



                            <tr>
                                <td
                                    style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                    Wechat Id of
                                    client</td>
                                <td
                                    style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                    Mobile no. of
                                    Client</td>
                            </tr>

                            <tr>
                                <td
                                    style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                    {{ $r['g_wechatid'] }}</td>
                                <td
                                    style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                    {{ $r['g_cmobno'] }}</td>
                            </tr>

                            <tr>
                                <td
                                    style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                    Email address of
                                    client</td>
                                <td
                                    style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                    Business
                                    Description</td>
                            </tr>

                            <tr>
                                <td
                                    style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                    {{ $r['g_cemail'] }}</td>
                                <td
                                    style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                    {{ $r['g_busdes'] }}</td>
                            </tr>

                            <tr>
                                <td
                                    style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                    Currency of Business
                                    Generated</td>
                                <td
                                    style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                    Amount of Business
                                    Generated</td>
                            </tr>

                            <tr>
                                <td
                                    style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                    @if (isset($r['g_buscurr']))
                                        {{ $r['g_buscurr'] }}
                                    @endif
                                </td>
                                <td
                                    style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                    @if (isset($r['g_busamt']))
                                        ${{ $r['g_busamt'] }}
                                    @endif</td>
                            </tr>

                            <tr>
                                <td
                                    style="width:50%; font-weight:700; font-size:14px; color:#010101; padding:22px 0 30px 20px;">
                                    Remarks</td>
                            </tr>
                            <td
                                style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                {{ $r['g_remarks'] }}</td>

                        </table>
                        </td>
                        </tr>
                        @endforeach
                        @endif


                        {{-- <tr>
                                            <td style="padding:10px 15px 15px;">
                                                <table border='1'>
                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding:20px 0 0 20px;">
                                                            Type of Generated Business</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px ; padding-left:20px;">
                                                            Wealth Management</td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                        <td
                                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding:22px 0 15px 20px;">
                                                            Type of Potential Business 1</td>
                                                        <td
                                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding:22px 0 15px 20px; ">
                                                            Type of Potential Business 1</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding:22px 0 15px 20px;">
                                                            Type of Potential Business 1</td>
                                                        <td
                                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding:22px 0 15px 20px; ">
                                                            Type of Potential Business 1</td>
                                                    </tr>
                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                        <td
                                                            style="width:50%; font-weight:700; font-size:16px; color:#010101; padding-top:22px; padding-left:20px;">
                                                            Type of Potential Business 1</td>
                                                    </tr>

                                                    <tr>
                                                        <td
                                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding:22px 0 15px 20px;">
                                                            Type of Potential Business 1</td>
                                                        <td
                                                            style="width:50%; font-weight:400; font-size:14px; color:#010101; padding:22px 0 15px 20px; ">
                                                            Type of Potential Business 1</td>
                                                    </tr>

                                                    <td
                                                        style="width:50%; font-weight:700; font-size:16px; color:#010101; padding:22px 0 20px 20px;">
                                                        Remarks</td>
                                                </table>

                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr> --}}

                        </table>

                    </div>


                </div>
            </div>

        @endsection
        @push('js')
            <script src="{{ asset('js/notes.js') }}?v={{ time() }}" type="text/javascript"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"
                integrity="sha512-t3XNbzH2GEXeT9juLjifw/5ejswnjWWMMDxsdCg4+MmvrM+MwqGhxlWeFJ53xN/SBHPDnW0gXYvBx/afZZfGMQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                // $("#multistep_form").validate({

                //     rules: {
                //         notes: {
                //             required: true
                //         },
                //     },
                //     messages: {
                //         notes: "Notes can't be empty",

                //     }
                // })
                // $('#btnnote').on('click', function() {

                //     $("#multistep_form").valid();

                // });

                // if ($("#multistep_form").length > 0) {
                //     $("#multistep_form").validate({
                //         rules: {
                //         notes: {
                //             required: true
                //         },
                //     },
                //         submitHandler: function(form) {
                //             $.ajaxSetup({
                //                 headers: {
                //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //                 }
                //             });
                //             $.ajax({
                //                 url: "{{ route('sales.note') }}",
                //                 type: "POST",
                //                 data: $('#multistep_form').serialize(),
                //                 success: function(response) {
                //                     console.log(response);
                //                     const el = document.createElement('div')

                //                     swal({
                //                         title: `Note Created`,
                //                         content: el,
                //                         icon: "success",
                //                         buttons: true,
                //                         buttons: {
                //                             cancel: false,
                //                             confirm: {
                //                                 text: 'Close',
                //                                 className: 'btn btn-danger'
                //                             },
                //                         },
                //                     }).then((result) => {
                //                         $('#multistep_form')[0].reset();
                //                     })
                //                 }
                //             });
                //         }
                //     })
                // }




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
                                    setTimeout(function() {
                                        window.location = "{{ route('sales') }}";
                                    }, 1000);
                                    // window.location="{{ route('sales') }}";
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
                $('body').on('click', '.del_confirm_view', function() {
                    var id = $(this).attr('data-id');
                    swal({
                        title: "Are you sure you want to delete this file ?",
                        text: "You will not be able to retrieve this file again.",
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
                            var url = "{{ route('files.deleted', ':id') }}",
                                url = url.replace(':id', id);
                            $.ajax({
                                type: "DELETE",
                                url: url,
                                data: {
                                    id: id,
                                },
                                cache: false,
                                success: function(response) {
                                    // alert(response);
                                    swal(
                                        "Success!",
                                        "File deleted successfully",
                                        "success",
                                    );
                                    setTimeout(function() {
                                        window.location =
                                            "{{ route('sales.show', $sale->id) }}";
                                    }, 1000);
                                    // window.location="{{ route('sales') }}";
                                },
                                failure: function(response) {
                                    swal(
                                        "Internal Error",
                                        "Oops, your file was not deleted.", // had a missing comma
                                        "error"
                                    )
                                }
                            });
                        }
                    })

                });
                $('.print-icon').on('click', function() {
                    $('#print_screen').show();
                    $("#print_screen").print({
                        addGlobalStyles: false,
                        stylesheet: "{{ url('/css/print.css?v=' . time()) }}",
                        rejectWindow: true,
                        noPrintSelector: ".no-print",
                        iframe: true,
                        append: null,
                        prepend: null
                    });
                    $('#print_screen').hide();
                });

                $("#text_notes").keyup(function() {

                    $("#notes_cancel").show();
                });

                $("#notes_cancel").click(function() {
                    // alert('eht');
                    $("#text_notes").val('');
                    $("#notes_cancel").hide();
                });
            </script>
        @endpush
