	<div class="card mb-1">
    <div class="card-header bg-secondary" id="GuardianDetailsHeading">
      <h5 class="mb-0">
        <button class="btn btn-link btn-block text-left text-decoration-none text-uppercase text-white collapsed" data-toggle="collapse" data-target="#GuardianDetails" aria-expanded="false" aria-controls="GuardianDetails">
          <i class="fa fa-users"></i> Guardian Details
		  
          <i class="fa fa-caret-down float-right mt-1"></i>
        </button>
      </h5>
    </div>
    <div id="GuardianDetails" class="collapse" aria-labelledby="GuardianDetailsHeading" data-parent="#accordion">
	<form id="frmGuardianDetails" name="frmGuardianDetails" action="" method="post">
      <div class="card-body pl-2 pr-2">
        <section class="mb-4">
            
            <p class="text-center font-weight-bold card-header mb-3 mt-0">Father Details <i class="fa fa-arrow-circle-o-down"></i></p>
        
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Father Name <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtfathername" name="txtfathername" maxlength="100" class="form-control" placeholder="">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Father Qualification <span class="text-danger">*</span></span>
                        </div>
                        <select id="chofatherQalif" name="chofatherQalif" class="custom-select">
                            <option value="" selected>Select</option>
                            <option value="None">None</option>
                            <option value="X and below">X and below</option>
                            <option value="XII">XII</option>
                            <option value="Graduate">Graduate</option>
                            <option value="PG and above">PG and above</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Father Occupation <span class="text-danger">*</span></span>
                        </div>
                        <select id="chofatherOccup" name="chofatherOccup" class="custom-select">
                            <option value="" selected>Select</option>
                            <option value="None">None</option>
                            <option value="Service">Service</option>
                            <option value="Business">Business</option>
                            <option value="Farmer">Farmer</option>
                            <option value="Labourer">Labourer</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Retired">Retired</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Father Mobile No. <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtfatherMobNo" name="txtfatherMobNo" maxlength="10" class="form-control" placeholder="" onKeyPress="inputNumber(event,this.value,false);">
                    </div>
                </div>
            </div>
            
            <p class="text-center font-weight-bold card-header mb-3 mt-0">Mother Details <i class="fa fa-arrow-circle-o-down"></i></p>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Mother Name <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtmotherName" name="txtmotherName" maxlength="100" class="form-control" placeholder="">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Mother Qualification <span class="text-danger">*</span></span>
                        </div>
                        <select id="chomotherQalif" name="chomotherQalif" class="custom-select">
                            <option value="" selected>Select</option>
                            <option value="None">None</option>
                            <option value="X and below">X and below</option>
                            <option value="XII">XII</option>
                            <option value="Graduate">Graduate</option>
                            <option value="PG and above">PG and above</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Mother Occupation <span class="text-danger">*</span></span>
                        </div>
                        <select id="chomotherOccup" name="chomotherOccup" class="custom-select">
                            <option value="" selected>Select</option>
                            <option value="None">None</option>
                            <option value="Housewife">Housewife</option>
                            <option value="Service">Service</option>
                            <option value="Business">Business</option>
                            <option value="Farmer">Farmer</option>
                            <option value="Labourer">Labourer</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Retired">Retired</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Mother Mobile No. <span class="text-danger">*</span></span>
                        </div>
						<input type="text" id="txtmotherMobNo" name="txtmotherMobNo" maxlength="10" class="form-control" placeholder="" onKeyPress="inputNumber(event,this.value,false);">
                        
                    </div>
                </div>
            </div>
            
            <p class="text-center font-weight-bold card-header mb-3 mt-0">Guardian Details <i class="fa fa-arrow-circle-o-down"></i></p>
            
            <div class="mb-3 form-group text-center">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" onclick="fillGuardianDetailasparent()">
                    <label class="form-check-label" for="inlineRadio1"><span class="text-primary">Same as Father</span></label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" onclick="fillGuardianDetailasparent()">
                    <label class="form-check-label" for="inlineRadio2"><span class="text-primary">Same as Mother</span></label>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Guardian Name <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtguardianName" name="txtguardianName" class="form-control" placeholder="">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Guardian Relationship <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtrelation" name="txtrelation" class="form-control" placeholder="">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Guardian Occupation <span class="text-danger">*</span></span>
                        </div>
                        <select id="choguardianOccup" name="choguardianOccup" class="custom-select">
                            <option value="" selected>Select</option>
                            <option value="None">None</option>
                            <option value="Housewife">Housewife</option>
                            <option value="Service">Service</option>
                            <option value="Business">Business</option>
                            <option value="Farmer">Farmer</option>
                            <option value="Labourer">Labourer</option>
                            <option value="Unemployed">Unemployed</option>
                            <option value="Retired">Retired</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Guardian Mobile No. <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtguardianMobNo" name="txtguardianMobNo" maxlength="10" class="form-control" placeholder="" onKeyPress="inputNumber(event,this.value,false);">
                    </div>
                </div>
            </div>
            
            <p class="text-center font-weight-bold card-header mb-3 mt-0">Other Details <i class="fa fa-arrow-circle-o-down"></i></p>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nearest Railway Station <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtapplcntRlyStation" name="txtapplcntRlyStation" maxlength="100" class="form-control" placeholder="">
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">No. of Family Member <span class="text-danger">*</span></span>
                        </div>
                        <select id="chofamilyMemCnt" name="chofamilyMemCnt" class="custom-select">
                            <option value="" selected>Select</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                </div>
            </div>

 
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 text-center">
				 
				   <a class="btn btn-primary" href="javascript:void(0)" onclick="saveGuardianDetail()"><i class="fa fa-database mr-2"></i>Update Guardian details</a>
				   <a class="btn btn-danger" href="javascript:void(0)" onclick="javascript: window.location.reload();"><i class="fa fa-times-circle"></i> Cancel</a>
			 
               </div>
            </div>
 		
        </section>
      </div>
</form>	  
    </div>
</div>