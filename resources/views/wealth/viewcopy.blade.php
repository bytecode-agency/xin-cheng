@extends('layouts.app')
@push('css')
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
            <a href="{{ route('sales.edit', $sale->id) }}" type="button" class="btn btn-danger saveBtn">Edit</a>
            <a href="{{ route('sales.destroy', $sale->id) }}" type="button" class="btn btn-danger">Delete</a>
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
    <div class="card formContentData border-0 p-4">
        <h3>Basic Information</h3>
        <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">
        <fieldset id="account" class=" w-100 d-flex justify-content-start flex-wrap form-fields">
            <div class="formAreahalf">
                <label for="c" class="form-label">Client's</label>
               
            </div>
            <div class="formAreahalf ">
                <label for="cby" class="form-label">Created By</label>
               
            </div>
            <div class="formAreahalf ">
                <label for="cby" class="form-label">Client Status</label>
               
            </div>
        </fieldset>
    </div>
   
    <div class="dataAreaMain">
        <div class="card formContentData border-0 p-4">
            <h3>Application Information</h3>
            <button class="btn saveBtn">Sales Application</button>
          
                    <div class="accordion-body">
                        <fieldset id="account" class=" w-100 d-flex justify-content-start flex-wrap form-fields">
                            <div class="formAreahalf ">
                                <label for="" class="form-label">Bussiness Type</label>
                                </br>{{ $sale->bus_type }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="" class="form-label">Client Type</label>
                                </br>{{ $sale->client_type }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="" class="form-label">Client's Full Name</label>
                                </br>{{ $sale->client_name }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="" class="form-label">Country of Client</label>
                                </br>{{ $sale->client_country }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="" class="form-label">City of Client</label>
                                </br>{{ $sale->client_city }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="" class="form-label">Phone no of POC</label>
                                </br>{{ $sale->poc_ph }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="" class="form-label">Name of POC</label>
                                </br>{{ $sale->poc_name }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="" class="form-label">Email of POC</label>
                                </br>{{ $sale->poc_email }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="" class="form-label"> Wechat id of POC</label>
                                </br>{{ $sale->poc_wechat }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="clienttype" class="form-label">Sign of B2B Aggrement?</label>
                                </br>{{ $sale->b2b_sign }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="" class="form-label">B2B Aggrement Sign Date</label>
                                </br>{{ $sale->b2b_agr_exp_date }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="" class="form-label">B2B Aggrement Expirey Date</label>
                                </br>{{ $sale->b2b_agr_sign_date }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="clienttype" class="form-label"> Aggrement Renewal Reminder</label>
                                </br>{{ $sale->agr_ren_rem }}
                            </div>
                            <div class="formAreahalf ">
                                <label for="clienttype" class="form-label"> Aggrement Renewal Frequency</label>
                                </br>{{ $sale->agr_ren_fre }}
                            </div>
                        </fieldset>
                      
                        <?php $tpb = unserialize($sale->type_pot_bus);
                        // echo '<pre>';
                        // print_r($tpb);
                        // echo '</pre>';
                        
                        $tbg = unserialize($sale->type_bus_gen);
                        // echo'<pre>';
                        // print_r($tbg);
                        // echo'</pre>';
                        ?>
                        {{-- <div class="accordion-item">
                            <h2 class="accordion-header" id="hThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#cThree" aria-expanded="false" aria-controls="cThree">+</button>
                            </h2>
                            <div id="cThree" class="accordion-collapse collapse" aria-labelledby="hThree"> --}}
                                <div class="accordion-body">
                                    @if (isset($tpb))
                                        @foreach ($tpb as $s)
                                            <div class="card formContentData border-0 p-4">
                                                <fieldset id="dynamicAddRemove"
                                                    class="w-100 d-flex justify-content-start flex-wrap form-fields type-of-potential-bussiness">
                                                    <div class="formAreahalf ">
                                                        <label for="clienttype" class="form-label"> Types of Potential
                                                            Business</label>
                                                        </br> </br>
                                                        @if (isset($s['drp']))
                                                            {{ $s['drp'] }}
                                                        @endif
                                                    </div>
                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="dcname">Name of direct
                                                            client</label>
                                                        </br> </br>{{ $s['dcname'] }}
                                                    </div>
                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="passcountry">Passport
                                                            Country</label>
                                                        </br> </br>{{ $s['passcountry'] }}
                                                    </div>
                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="wechatidc">Wechat Id of
                                                            client</label>
                                                        </br> </br>{{ $s['wechatidc'] }}
                                                    </div>
                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="cmobileno">Mobile no. of
                                                            Client</label>
                                                        </br> </br>{{ $s['cmobileno'] }}
                                                    </div>
                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="cemail">Email address of
                                                            client</label>
                                                        </br></br>{{ $s['cemail'] }}
                                                    </div>
                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="busdes">Bussiness
                                                            Description</label>
                                                        </br></br>{{ $s['busdes'] }}
                                                    </div>
                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="buscurr">Currency of Bussiness
                                                            Generated</label>
                                                        </br> </br>{{ $s['buscurr'] }}
                                                    </div>
                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="busamt">Ammount of bussiness
                                                            generated</label>
                                                        </br> </br>{{ $s['busamt'] }}
                                                    </div>
                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="remarks">Remarks</label>
                                                        </br> </br>{{ $s['remarks'] }}
                                                    </div>
                                                </fieldset>
                                            </diV>
                                        @endforeach
                                    @endif
                                </div>
                            {{-- </div>
                        </div> --}}
                        {{-- <div class="accordion-item">
                            <h2 class="accordion-header" id="hFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#cFour" aria-expanded="false" aria-controls="cFour">+</button>
                            </h2>
                            <div id="cFour" class="accordion-collapse collapse" aria-labelledby="hFour"> --}}
                                <div class="accordion-body">
                                    @isset($tbg)
                                        
                                        @foreach ($tbg as $r)
                                            <div class="card formContentData border-0 p-4">
                                                <fieldset id="dynamicAddRemove2"
                                                    class="  w-100 d-flex justify-content-start flex-wrap form-fields type-of-buss-gen">
                                                    <!-- <div class="col-sm-10" id="dynamicAddRemove2"> -->
                                                    <div class="formAreahalf ">
                                                        <label for="clienttype" class="form-label"> Types of Business
                                                            Generated </label>
                                                        </br> </br>
                                                        @if (isset($s['drp']))
                                                            {{ $r['g_drp'] }}
                                                        @endif
                                                    </div>
                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="">Name of direct client</label>
                                                        </br> </br>{{ $r['g_dcname'] }}
                                                    </div>
                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="passcountry">Passport Country</label>
                                                        </br> </br>{{ $r['g_passcountry'] }}
                                                    </div>
                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="wechatidc">Wechat Id of client</label>
                                                        </br></br>{{ $r['g_wechatid'] }}
                                                    </div>
                                                    <div class="formAreahalf ">
                                                        <label class="form-label" for="cmobileno">Mobile no. of client</label>
                                                        </br></br>{{ $r['g_cmobno'] }}
                                                    </div>
                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="cemail">Email address of
                                                            client</label>
                                                        </br> </br>{{ $r['g_cemail'] }}
                                                    </div>
                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="busdes">Bussiness Description</label>
                                                        </br> </br>{{ $r['g_busdes'] }}
                                                    </div>
                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="buscurr">Currency of Bussiness
                                                            Generated</label>
                                                        </br> </br>{{ $r['g_buscurr'] }}
                                                    </div>
                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="busamt">Ammount of bussiness
                                                            generated</label>
                                                        </br></br>{{ $r['g_busamt'] }}
                                                    </div>
                                                    <div class="formAreahalf">
                                                        <label class="form-label" for="remarks">Remarks</label>
                                                        </br> </br>{{ $r['g_remarks'] }}
                                                    </div>
                                                </fieldset>
                                            </div>
                                        @endforeach
                                    @endisset
                                </div>
                            {{-- </div>
                        </div> --}}
                       
                        <div class="formAreahalf">
                            <label class="form-label" for="notes">Notes</label>
                            <textarea id="notes" name="notes" rows="8" cols="150"></textarea>
                        </div>
                        <button type="button" name="btnnote" id="btnnote" class="btnnote btn saveBtn">Save</button>
                    {{-- </div>
                </div>
            </div> --}}
            <!-- </div> -->
        </div>
    </div>
@endsection
@push('js')
    <script>
        // var collapseElementList = [].slice.call(document.querySelectorAll('.collapse'))
        // var collapseList = collapseElementList.map(function(collapseEl) {
        //     collapseEl.addEventListener('hidden.bs.collapse', function() {
        //         let children = this.querySelectorAll('.collapse.show');
        //         children.forEach((c) => {
        //             var collapse = bootstrap.Collapse.getInstance(c)
        //             collapse.hide()
        //         })
        //     })
        // })
    </script>
@endpush