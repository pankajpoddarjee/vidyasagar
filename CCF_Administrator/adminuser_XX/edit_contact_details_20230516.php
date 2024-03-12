<div class="card mb-1">
    <div class="card-header bg-secondary" id="ContactDetailsHeading">
      <h5 class="mb-0">
        <button class="btn btn-link btn-block text-left text-decoration-none text-uppercase text-white collapsed" data-toggle="collapse" data-target="#ContactDetails" aria-expanded="false" aria-controls="ContactDetails">
          <i class="fa fa-building"></i> Contact details
		 
          <i class="fa fa-caret-down float-right mt-1"></i>
        </button>
      </h5>
    </div>
    <div id="ContactDetails" class="collapse" aria-labelledby="ContactDetailsHeading" data-parent="#accordion">
	<form id="frmContactDetail" name="frmContactDetail" action="" method="post">
      <div class="card-body pl-2 pr-2">
        <section class="mb-2">
            
            <p class="text-center font-weight-bold card-header mb-3 mt-0">Permanent Address <i class="fa fa-arrow-circle-o-down"></i></p>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Address <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtpermntAddr" name="txtpermntAddr" maxlength="90" class="form-control" placeholder="" >
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">P.O. <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtpermntPO" name="txtpermntPO" maxlength="45" class="form-control" placeholder="" >
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">P.S. <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" class="form-control" id="txtpermntPS" maxlength="45" name="txtpermntPS" placeholder="" >
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Locality <span class="text-danger">*</span></span>
                        </div>
                        <select id="chopermntLocality" name="chopermntLocality" class="custom-select">
                            <option value="">Select</option>
							<option value="URBAN">Urban</option>
                            <option value="SEMI-URBAN">Semi-Urban</option>
                            <option value="RURAL">Rural</option>
                        </select>
						 
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">City / Village <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtpermntCity" name="txtpermntCity" maxlength="45" class="form-control" placeholder="" />
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">District <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" class="form-control" id="txtpermntDistrict" maxlength="45" 	name="txtpermntDistrict" placeholder="" />
                    </div>
                </div>
            </div>
            
            <div class="row">    
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">State <span class="text-danger">*</span></span>
                        </div>
                        <select id="chopermntState" name="chopermntState" class="custom-select">
                            <option value="">Select</option>
                            <option value="ANDAMAN AND NICOBAR ISLANDS">ANDAMAN AND NICOBAR ISLANDS</option>
                            <option value="ANDHRA PRADESH">ANDHRA PRADESH</option>
                            <option value="ARUNACHAL PRADESH">ARUNACHAL PRADESH</option>
                            <option value="ASSAM">ASSAM</option>
                            <option value="BIHAR">BIHAR</option>
                            <option value="CHANDIGARH">CHANDIGARH</option>
                            <option value="CHHATTISGARH">CHHATTISGARH</option>
                            <option value="DADRA AND NAGAR HAVELI">DADRA AND NAGAR HAVELI</option>
                            <option value="DAMAN AND DIU">DAMAN AND DIU</option>
                            <option value="DELHI">DELHI</option>
                            <option value="GOA">GOA</option>
                            <option value="GUJARAT">GUJARAT</option>
                            <option value="HARYANA">HARYANA</option>
                            <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
                            <option value="JAMMU AND KASHMIR">JAMMU AND KASHMIR</option>
                            <option value="JHARKHAND">JHARKHAND</option>
                            <option value="KARNATAKA">KARNATAKA</option>
                            <option value="KERALA">KERALA</option>
                            <option value="LAKSHADWEEP">LAKSHADWEEP</option>
                            <option value="MADHYA PRADESH">MADHYA PRADESH</option>
                            <option value="MAHARASHTRA">MAHARASHTRA</option>
                            <option value="MANIPUR">MANIPUR</option>
                            <option value="MEGHALAYA">MEGHALAYA</option>
                            <option value="MIZORAM">MIZORAM</option>
                            <option value="NAGALAND">NAGALAND</option>
                            <option value="ODISHA">ODISHA</option>
                            <option value="PUDUCHERRY">PUDUCHERRY</option>
                            <option value="PUNJAB">PUNJAB</option>
                            <option value="RAJASTHAN">RAJASTHAN</option>
                            <option value="SIKKIM">SIKKIM</option>
                            <option value="TAMIL NADU">TAMIL NADU</option>
                            <option value="TELANGANA">TELANGANA</option>
                            <option value="TRIPURA">TRIPURA</option>
                            <option value="UTTAR PRADESH">UTTAR PRADESH</option>
                            <option value="UTTARKHAND">UTTARKHAND</option>
                            <option value="WEST BENGAL">WEST BENGAL</option>
                            <option value="OTHER">OTHER</option>
                        </select>						 
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Country <span class="text-danger">*</span></span>
                        </div>
                        <select id="chopermntCountry" name="chopermntCountry" class="custom-select">
                            <option value="">Select</option>
                           <option value="INDIA">India</option>
                            <option value="BANGLADESH">Bangladesh</option>
                            <option value="NEPAL">Nepal</option>
                            <option value="OTHER">Other</option>
                        </select>						  
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Pin <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtpermntPin" name="txtpermntPin" maxlength="6" class="form-control" placeholder="" onKeyPress="inputNumber(event,this.value,true);" />
                    </div>
                </div>
            </div>
            
            <p class="text-center font-weight-bold card-header mb-3 mt-0">Communication Address <i class="fa fa-arrow-circle-o-down"></i></p>
            
            <div class="mb-3 form-group text-center">
                <input type="checkbox" id="chksameasPermanent" class="align-middle" onclick="fillsameasPermanent()">
                <label class="form-check-label" for="chksameasPermanent"><span class="text-primary">Same as Permanent Address</span></label>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Address <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtlocalAddr" name="txtlocalAddr" maxlength="90" class="form-control" placeholder=""/>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">P.O. <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtlocalPO" name="txtlocalPO" maxlength="45" class="form-control" placeholder="" />
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">P.S. <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtlocalPS" name="txtlocalPS" maxlength="45" class="form-control" placeholder="" />
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Locality <span class="text-danger">*</span></span>
                        </div>
                        <select id="cholocalLocality" name="cholocalLocality" class="custom-select">
                            <option value="">Select</option>
                            <option value="URBAN">Urban</option>
                            <option value="SEMI-URBAN">Semi-Urban</option>
                            <option value="RURAL">Rural</option>
                        </select>						 
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">City / Village <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtlocalCity" name="txtlocalCity" maxlength="45" class="form-control" placeholder=""  />
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">District <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtlocalDistrict" name="txtlocalDistrict" maxlength="45" class="form-control" placeholder=""  />
                    </div>
                </div>
            </div>
            
            <div class="row">    
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">State <span class="text-danger">*</span></span>
                        </div>
                        <select id="cholocalState" name="cholocalState" class="custom-select">
                            <option value="">Select</option>
                            <option value="ANDAMAN AND NICOBAR ISLANDS">ANDAMAN AND NICOBAR ISLANDS</option>
                            <option value="ANDHRA PRADESH">ANDHRA PRADESH</option>
                            <option value="ARUNACHAL PRADESH">ARUNACHAL PRADESH</option>
                            <option value="ASSAM">ASSAM</option>
                            <option value="BIHAR">BIHAR</option>
                            <option value="CHANDIGARH">CHANDIGARH</option>
                            <option value="CHHATTISGARH">CHHATTISGARH</option>
                            <option value="DADRA AND NAGAR HAVELI">DADRA AND NAGAR HAVELI</option>
                            <option value="DAMAN AND DIU">DAMAN AND DIU</option>
                            <option value="DELHI">DELHI</option>
                            <option value="GOA">GOA</option>
                            <option value="GUJARAT">GUJARAT</option>
                            <option value="HARYANA">HARYANA</option>
                            <option value="HIMACHAL PRADESH">HIMACHAL PRADESH</option>
                            <option value="JAMMU AND KASHMIR">JAMMU AND KASHMIR</option>
                            <option value="JHARKHAND">JHARKHAND</option>
                            <option value="KARNATAKA">KARNATAKA</option>
                            <option value="KERALA">KERALA</option>
                            <option value="LAKSHADWEEP">LAKSHADWEEP</option>
                            <option value="MADHYA PRADESH">MADHYA PRADESH</option>
                            <option value="MAHARASHTRA">MAHARASHTRA</option>
                            <option value="MANIPUR">MANIPUR</option>
                            <option value="MEGHALAYA">MEGHALAYA</option>
                            <option value="MIZORAM">MIZORAM</option>
                            <option value="NAGALAND">NAGALAND</option>
                            <option value="ODISHA">ODISHA</option>
                            <option value="PUDUCHERRY">PUDUCHERRY</option>
                            <option value="PUNJAB">PUNJAB</option>
                            <option value="RAJASTHAN">RAJASTHAN</option>
                            <option value="SIKKIM">SIKKIM</option>
                            <option value="TAMIL NADU">TAMIL NADU</option>
                            <option value="TELANGANA">TELANGANA</option>
                            <option value="TRIPURA">TRIPURA</option>
                            <option value="UTTAR PRADESH">UTTAR PRADESH</option>
                            <option value="UTTARKHAND">UTTARKHAND</option>
                            <option value="WEST BENGAL">WEST BENGAL</option>
                            <option value="OTHER">OTHER</option>
                        </select>						 
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Country <span class="text-danger">*</span></span>
                        </div>
                        <select id="cholocalCountry" name="cholocalCountry" class="custom-select">
                            <option value="">Select</option>
                            <option value="INDIA">India</option>
                            <option value="BANGLADESH">Bangladesh</option>
                            <option value="NEPAL">Nepal</option>
                            <option value="OTHER">Other</option>
                        </select>						 
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Pin <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtlocalPin" name="txtlocalPin" maxlength="6" class="form-control" placeholder="" onKeyPress="inputNumber(event,this.value,false);"  />
                    </div>
                </div>
            </div>
            
            <p class="text-center font-weight-bold card-header mb-3 mt-0">Contact info <i class="fa fa-arrow-circle-o-down"></i></p>
            
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Mobile No. <span class="text-danger">&dagger;</span></span>
                        </div>
                        <span class="text-primary form-control"><?php echo $studrecord["applcntMobNo"];?></span>
                        <small class="mt-1">This number must remain valid during the entire tenure of the course, as this number will be used for any communication.</small>
                    </div>
                </div>
              
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Alternate Mobile No. <span class="text-danger">&dagger;</span></span>
                        </div>
                        <span class="text-primary form-control"><?php echo $studrecord["alternateMobileNo"];?></span>
                    </div>
                </div>
			
				<?php if($studrecord["hasWhatsAppno"]=='Yes') { ?>
				<div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">WhatsApp No. <span class="text-danger">&dagger;</span></span>
                        </div>
                        <span class="text-primary form-control"><?php echo $studrecord["WhatsAppno"];?></span>
                        <small class="mt-1">This number must remain valid during the entire tenure of the course, as this number will be used for any communication.</small>
                    </div>
                </div>
               <?php }?>
               
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">E-mail Id <span class="text-danger">&dagger;</span></span>
                        </div>
                        <span class="text-primary form-control"><?php echo $studrecord["applcntEmail"];?></span>
                        <small class="mt-1">This e-mail id must remain valid during the entire tenure of the course, as this e-mail id will be used for any communication.</small>
                    </div>
                </div>
            </div>            
            
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 text-center">
				   <a class="btn btn-primary" href="javascript:void(0)" onclick="saveContactDetail()"><i class="fa fa-database mr-2"></i>Update Contact details</a>
				   <a class="btn btn-danger" href="javascript:void(0)" onclick="javascript: window.location.reload();"><i class="fa fa-times-circle"></i> Cancel</a>
				 
               </div>
            </div>
 	 
        </section>
      </div>
	 </form>
    </div>
</div>