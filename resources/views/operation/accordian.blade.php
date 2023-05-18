<div class="accordion" id="accordionPanelsStayOpenExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="panelsStayOpen-headingOne">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
          Accordion Item #1
        </button>
      </h2>
      <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
        <div class="accordion-body">
          <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
        
          <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true" aria-controls="panelsStayOpen-collapseTwo">
                Accordion Item #2
              </button>
            </h2>
            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
              <div class="accordion-body">
                <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
              </div>
            </div>
          </div>

          <div class="accordion-item">
            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="true" aria-controls="panelsStayOpen-collapseThree">
                Accordion Item #3
              </button>
            </h2>
            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingThree">
              <div class="accordion-body">
                <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
              </div>
            </div>
          </div>

        </div>
      </div>

   


    </div>
</div>

















<div class="card formContentData border-0 p-4">


  <input type="hidden" name="create_by" value="{{ Auth::user()->name }}">
  <input type="hidden" name="id" value="{{ Auth::user()->id }}">



  <div id="start_field" class="w-100 justify-content-start flex-wrap form-fields">


      <div class="Personal_Details company_space">
          <div class="First-heading_">
              <h4> Add New Application</h4>
          </div>
          <div class="number_main">
              <ul class="list-group list-group-horizontal" id="nav_list">
                  <li class="list-group-item active">
                      <a href="#">1</a>
                      <p> Pass Related </p>
                  </li>
                  <li class="list-group-item">
                      <a href="#">2</a>
                      <p> Company Related </p>
                  </li>
                  <li class="list-group-item">
                      <a href="#">3</a>
                      <p> Pr Related </p>
                  </li>
                  <li class="list-group-item">
                      <a href="#">4</a>
                      <p> Complete </p>
                  </li>
              </ul>
          </div>
      </div>




      <div id="passholder_section" class="passholder_section">
          <div id="pass_design" class="w-100 d-flex justify-content-start flex-wrap form-fields pass_design">
              <!-- <div class="col-sm-10" id="dynamicAddRemove2"> -->
              <fieldset id="dynamicAddRemove"
                  class="w-100 d-flex justify-content-start flex-wrap form-fields ">
                  <div class="formAreahalf ">
                      <label for="bustype" class="form-label"> Business Type </label>


                      <div class="accordion-item">
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

                                  <input type="text" class="form-control" name="pass[0][bus_type]">

                              </div>

                              <div class="formAreahalf ">
                                  <label for="passapptype" class="form-label"> Pass Application Type </label>
                                  <select name="pass[0][pass_app_type]">
                                      <option value="" selected disabled>Please select pass application
                                          type
                                      </option>
                                      <option value="EP">EP</option>

                                  </select>

                              </div>

                              <div class="formAreahalf ">
                                  <label for="" class="form-label"> Does passholder set up company?
                                  </label>
                                  <select name="pass[0][passhol_setup]">
                                      <option value="" selected disabled>
                                      </option>
                                      <option value="Yes">Yes</option>

                                  </select>

                              </div>

                              <div class="formAreahalf ">
                                  <label for="" class="form-label"> Is passholder also the
                                      shareholder? </label>
                                  <select name="pass[0][passhol_sharehol]">
                                      <option value="" selected disabled>
                                      </option>
                                      <option value="Yes">Yes</option>

                                  </select>

                              </div>

                              <div class="formAreahalf ">
                                  <label class="form-label" for="">Pass Holder Name 1 (Eng)</label>

                                  <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="pass[0][passhol_name]">

                              </div>

                              <div class="formAreahalf ">
                                  <label class="form-label" for="">Passport Full Name
                                      (Chinese)</label>

                                  <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="pass[0][passport_name]">

                              </div>

                              <div class="formAreahalf ">
                                  <label for="" class="form-label"> DOB (DD/MM/YYYY)</label>
                                  <input type="date" class="form-control" name="pass[0][pass_dob]">
                              </div>

                              <div class="formAreahalf ">
                                  <label for="gender" class="form-label">Gender (M/F)</label>
                                  <select class="" name="pass[0][pass_gender]" id="sign">
                                      <option value=""></option>
                                      <option value="Male">M</option>
                                      <option value="Male">F</option>
                                  </select>
                              </div>

                              <div class="formAreahalf ">
                                  <label for="" class="form-label"> Passport Expirey Date
                                      (DD/MM/YYYY)</label>
                                  <input type="date" class="form-control" name="pass[0][pass_exp_dob]">
                              </div>


                              <div class="formAreahalf ">
                                  <label class="form-label" for="">Passport Number</label>

                                  <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="pass[0][passport_number]">

                              </div>


                              <div class="formAreahalf ">
                                  <label class="form-label" for="">Passport Country</label>

                                  <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="pass[0][passport_country]">

                              </div>


                              <div class="formAreahalf ">
                                  <label for="clienttype" class="form-label"> Passport Renewal
                                      Reminder</label>
                                  <select name="pass[0][passport_ren_rem]" id="renewlrem">
                                      <option value="">Please select passport renewal reminder</option>
                                      <option value="90 days">90 days</option>
                                  </select>
                              </div>

                              <div class="formAreahalf ">
                                  <label class="form-label" for="">TIN Number Before Pass
                                      Application</label>

                                  <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="pass[0][passport_tin_number]">

                              </div>

                              <div class="formAreahalf ">
                                  <label for="clienttype" class="form-label">Passport Remminder Trigger
                                      Frequency</label>
                                  <select name="pass[0][passport_rem_fre]" id="renewlfre">
                                      <option value="">Please select passport remminder trigger
                                          frequency</option>
                                      <option value="Every Week">Every Week</option>
                                  </select>
                              </div>

                              <div class="formAreahalf ">
                                  <label class="form-label" for="">E-mail</label>
                                  <input type="email" class="form-control" id="gendcname[0][subject]"
                                      name="pass[0][email]">
                              </div>

                              <div class="formAreahalf ">
                                  <label class="form-label" for="">TIN Country Before Pass
                                      Application</label>

                                  <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="pass[0][passport_tin_country]">

                              </div>

                              <div class="formAreahalf ">
                                  <label class="form-label" for="">Phone Number</label>

                                  <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="pass[0][phno]">

                              </div>


                              <div class="formAreahalf ">
                                  <label for="passapptype" class="form-label"> Type of TIN Before Pass
                                      Application</label>
                                  <select name="pass[0][pass_tin_type]">
                                      <option value="" selected disabled>Please select type of TIN
                                          before pass application
                                      </option>
                                      <option value="EP">EP</option>

                                  </select>

                              </div>

                              <div class="formAreahalf ">
                                  <label class="form-label" for="">FIN Number</label>

                                  <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="pass[0][finno]">

                              </div>


                              <div class="formAreahalf ">
                                  <label class="form-label" for="">Residental Address</label>
                                  <input type="text" class="form-control" id="gendcname[0][subject]"
                                      name="pass[0][res_add]">
                              </div>


                              <div class="formAreahalf ">
                                  <label for="passapptype" class="form-label"> Pass Application Status
                                  </label>
                                  <select name="pass[0][pass_app_sts]">
                                      <option value="" selected disabled>Please select application
                                          status
                                      </option>
                                      <option value="EP">Approved</option>
                                  </select>
                              </div>

                              <div class="formAreahalf ">
                                  <label for="passapptype" class="form-label"> Pass Issurance </label>
                                  <select name="pass[0][pass_iss]">
                                      <option value="" selected disabled>Please select pass issurance
                                      </option>
                                      <option value="EP">Done</option>
                                  </select>
                              </div>


                              <div class="formAreahalf ">
                                  <label for="" class="form-label"> Pass Issurance Date </label>
                                  <input type="date" class="form-control" name="pass[0][pass_iss_date]">
                              </div>

                              <div class="formAreahalf ">
                                  <label for="" class="form-label"> Pass Expirey Date </label>
                                  <input type="date" class="form-control" name="pass[0][pass_exp_date]">
                              </div>

                              <div class="formAreahalf ">
                                  <label for="" class="form-label"> Duration </label>
                                  <input type="text" class="form-control" name="pass[0][duration]">
                              </div>

                              <div class="formAreahalf ">
                                  <label for="clienttype" class="form-label"> Pass Renewal Frequency</label>
                                  <select name="pass[0][pass_ren_fre]" id="renewlrem">
                                      <option value="">Please select pass renewal reminder</option>
                                      <option value="90 days">90 days</option>
                                  </select>
                              </div>

                              <div class="formAreahalf ">
                                  <label for="clienttype" class="form-label"> Pass Renewal Remminder</label>
                                  <select name="pass[0][pass_ren_rem]" id="renewlrem">
                                      <option value="">Please select pass renewal reminder</option>
                                      <option value="90 days before expiry">90 days before expiry</option>
                                  </select>
                              </div>

                              <div class="formAreahalf ">
                                  <label for="clienttype" class="form-label">Pass Renewal Trigger
                                      Frequency</label>
                                  <select name="pass[0][pass_ren_ter_fre]" id="renewlfre">
                                      <option value="">Please select pass renewal trigger frequency
                                      </option>
                                      <option value="Every Week">Every Week</option>
                                  </select>
                              </div>


                              <div class="formAreahalf ">
                                  <label for="" class="form-label"> Pass Job Title </label>
                                  <input type="text" class="form-control"
                                      name="pass[0][pass_job_title]">
                              </div>

                              <div class="formAreahalf ">
                                  <label for="clienttype" class="form-label">Singpass Setup</label>
                                  <select name="pass[0][singpass_setup]" id="renewlfre">
                                      <option value="">Please select singpass setup</option>

                                  </select>
                              </div>

                              <div class="formAreahalf ">
                                  <label for="clienttype" class="form-label"> 1st PR Application Reminder
                                  </label>
                                  <select name="pass[0][pr_app_rem]" id="renewlrem">
                                      <option value="">Please select PR application reminder</option>
                                      <option value="270 days after pass issurance date">270 days after pass
                                          issurance date</option>
                                  </select>
                              </div>

                              <div class="formAreahalf ">
                                  <label for="clienttype" class="form-label"> Relationship With Pass Holder
                                      1</label>
                                  <select name="pass[0][rel_pass_hol]" id="renewlrem">
                                      <option value="">Please select relationship with pass holder
                                      </option>
                                      <option value="Self">Self</option>
                                  </select>
                              </div>

                              <div class="formAreahalf ">
                                  <label for="" class="form-label"> Employer's Name </label>
                                  <input type="text" class="form-control" name="pass[0][emp_name]">
                              </div>

                              <div class="formAreahalf ">
                                  <label for="" class="form-label"> Monthly Salary (SGD)</label>
                                  <input type="text" class="form-control" name="pass[0][month_sal]">
                              </div>

                              <div class="formAreahalf">
                                  <label class="form-label" for="remarks">Remarks</label>
                                  <textarea id="addbg[0][genremarks]" name="pass[0][p_remarks]" rows="4" cols="50"></textarea>
                              </div>

              </fieldset>



              <div id="appended_passholder_div">
              </div>
              <div class="text-center pt-4 " id="add-pass-holder_btn_div">
                  <button type="button" id="add-pass-holder"
                      class="btn saveBtn btn_design add-pass-holder" name="add-pass-holder">Add
                      Pass Holder</button>
              </div>

              <div class="text-center pt-4" id="append_div_btn">
                  <button type="button" id="next1" class="btn saveBtn next-step next1">Next</button>
                  <button type="button" style="display:none;" id="previous1"
                      class="btn btn-danger previous-step">Back</button>
              </div>
          </div>
      </div>
  </div>
</div>








<fieldset id="FO_company" class="w-100  justify-content-start flex-wrap form-fields" style="display:none">
  <div class="card formContentData border-0 p-4">

      <div class="Personal_Details company_space">
          <div class="First-heading_">
              <h4> Add New Application</h4>
          </div>
          <div class="number_main">
              <ul class="list-group list-group-horizontal" id="nav_list">
                  <li class="list-group-item active" id="1">
                      <a href="#">1</a>
                      <p> Pass Related </p>
                  </li>
                  <li class="list-group-item active" id="2">
                      <a href="#">2</a>
                      <p> Company Related</p>
                  </li>
                  <li class="list-group-item" id="3">
                      <a href="#">3</a>
                      <p> Pr Related </p>
                  </li>
                  <li class="list-group-item" id="4">
                      <a href="#">4</a>
                      <p> Complete</p>
                  </li>
              </ul>
          </div>


      </div>

      <div id="fo_company">
          <div class="w-100 d-flex justify-content-start flex-wrap form-fields company_design">
              <div class="formAreahalf company-full_width_Cstm">
                  <label for="fo_compnay" class="form-label">Company Name 1</label>
                  <input type="text" name="cmp[0][fo_company]" id="fo_compnay" class="form-control"
                      value="">
              </div>
              <div class="formAreahalf">
                  <label for="fo_uen" class="form-label">UEN</label>
                  <input type="text" class="form-control" name="cmp[0][fo_uen]" id="fo_uen">
              </div>
              <div class="formAreahalf">
                  <label for="fo_company_add" class="form-label">Company Address</label>
                  <input type="text" class="form-control" name="cmp[0][fo_company_add]"
                      id="fo_company_add">
              </div>
              <div class="formAreahalf">
                  <label for="fo_incorporation_date" class="form-label">Incorporation Date</label>
                  <input type="text" class="form-control" name="cmp[0][fo_incorporation_date]"
                      id="fo_incorporation_date">
              </div>
              <div class="formAreahalf">
                  <label for="fo_company_email" class="form-label">Company Email</label>
                  <input type="text" class="form-control" name="cmp[0][fo_company_email]"
                      id="fo_company_email">
              </div>
              <div class="formAreahalf">
                  <label for="fo_company_pass" class="form-label">Company Password</label>
                  <input type="text" class="form-control" name="cmp[0][fo_company_pass]"
                      id="fo_company_pass">
              </div>

          </div>

      </div>
      <div id="appended_company_div">
      </div>
      <div class="text-center pt-4 " id="add_company_btn_div">
          <button type="button" id="add_company" class="btn saveBtn btn_design add_company"
              name="add-company">Add
              Company</button>
      </div>

  </div>

  <div class="text-center pt-4 " id="append_div_btn">
      <button type="button" id="next2" class="btn saveBtn next-step">Next</button>
      <button type="button" style="display:none;" id="previous2"
          class="btn btn-danger previous-step">Back</button>
  </div>
</fieldset>


<input type="hidden" name="create_by" value="{{ Auth::user()->name }}">
<input type="hidden" name="id" value="{{ Auth::user()->id }}">









