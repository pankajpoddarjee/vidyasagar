<div class="card mb-1">
    <div class="card-header bg-secondary" id="RegistrationDetailsHeading">
      <h5 class="mb-0">
        <button class="btn btn-link btn-block text-left text-decoration-none text-uppercase text-white" data-toggle="collapse" data-target="#RegistrationDetails" aria-expanded="true" aria-controls="RegistrationDetails">
		  <i class="fa fa-users"></i> Registration details 
          <i class="fa fa-caret-down float-right mt-1"></i>
        </button>
      </h5>
    </div>

    <div id="RegistrationDetails" class="collapse" aria-labelledby="RegistrationDetailsHeading" data-parent="#accordion">
	<form id="frmRegistDetail" name="frmRegistDetail" action="" method="post">
	<!--<input type="hidden" id="choCategory" name="choCategory" value="<?php echo $studrecord["caste"];?>" />-->
	<!--<input type="hidden" id="choDomicile" name="choDomicile" value="<?php echo $studrecord["stateofdomicile"];?>" /> -->
      <div class="card-body pl-2 pr-2">
        <section class="mb-4">
            <h5 class="text-danger border-bottom mb-4">
                <i class="fa fa-user"></i> Personal Details
            </h5>
            
            <div class="row">                                        
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Name in Full <span class="text-danger">&dagger;</span></span>
                        </div>
						<input type="text" id="txtName" name="txtName" class="form-control" maxlength="100"  >
                        
                    </div>
                </div>
                 
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Date of Birth <span class="text-danger">&dagger;</span></span>
                        </div>
                        <select id="choDOBdd" name="choDOBdd" class="custom-select">
                            <option value="" selected>DD</option>
                            <?php for($i=1; $i<=31; $i++) {?>
                            <option value="<?php echo $i?>" ><?php echo str_pad($i, 2, 0, STR_PAD_LEFT); ?></option>
                            <?php }?>
                        </select>
                        <select id="choDOBmm" name="choDOBmm"  class="custom-select">
                            <option value="" selected>MM</option>
                            <option value="1">Jan</option>
                            <option value="2">Feb</option>
                            <option value="3">Mar</option>
                            <option value="4">Apr</option>
                            <option value="5">May</option>
                            <option value="6">Jun</option>
                            <option value="7">Jul</option>
                            <option value="8">Aug</option>
                            <option value="9">Sep</option>
                            <option value="10">Oct</option>
                            <option value="11">Nov</option>
                            <option value="12">Dec</option>
                        </select>
                        <select  id="choDOByy" name="choDOByy"  class="custom-select">
                            <option value="" selected>YYYY</option>
                            <?php for($d=DOBYEARFROM; $d<=DOBYEARTO; $d++) {?>
                            <option value="<?php echo $d;?>" ><?php echo $d;?></option>
                            <?php }?>
                        </select>										 
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Gender <span class="text-danger">&dagger;</span></span>
                        </div>
                        <select id="choGender" name="choGender" class="custom-select">
                            <option value="" selected>Select</option>
                            <option value="Male">Male</option> 
                            <option value="Female">Female</option>
                            <option value="Transgender">Transgender</option>
                        </select>					   
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Blood Group <span class="text-danger">&dagger;</span></span>
                        </div>
                        <select id="choBloodgrp" name="choBloodgrp" class="custom-select">
							<option value="" selected>Select</option>
							<option value="A+" >A+</option>
							<option value="A-">A-</option>
							<option value="B+">B+</option>
							<option value="B-">B-</option>
							<option value="O+">O+</option>
							<option value="O-">O-</option>
							<option value="AB+">AB+</option>
							<option value="AB-">AB-</option>
							<option value="Hh">Hh</option>
							<option value="Not Known">Not Known</option>
						</select>						 
                    </div>
                </div>
            </div>
        </section>
        
        <section class="mb-4">
            <h5 class="text-danger border-bottom mb-4">
                <i class="fa fa-book"></i> Social Details
            </h5>
        
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Aadhaar No. <span class="text-danger">&dagger;</span></span>
                        </div>
                        <input type="text" id="txtAadharNo" name="txtAadharNo" class="form-control" maxlength="12"  onKeyPress="inputNumber(event,this.value,false);" />
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Category <span class="text-danger">&dagger;</span></span>
                        </div>
						 <select id="choCategory" name="choCategory" class="custom-select" data-toggle="popover" data-trigger="focus" data-placement="top" title="Please Note:" data-content="<?php echo RESERVED_CATEGORY_TEXT;?>" onchange="displayforEWS('Div_EWS','choWhetherEWS')" >
                            <option value="" selected>Select</option>
                            <option value="GENERAL">General</option>
                            <option value="SC">SC</option>
                            <option value="ST">ST</option>
                            <option value="OBC-A">OBC-A</option>
                            <option value="OBC-B">OBC-B</option>
                        </select>					 
                    </div>
                 </div>             
               
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Domicile <span class="text-danger">&dagger;</span></span>
                        </div>
                        <select id="choDomicile" name="choDomicile" class="custom-select" onchange="displayforOther(this.value,'OTHER STATE','otherDomicile','txtotherDomicile');displayforEWS('Div_EWS','choWhetherEWS')" data-toggle="popover" data-trigger="focus" data-placement="top" title="Please Note:" data-content="<?php echo DOMICILE_STATE_TEXT;?>"    >
							<option value="" selected>Select</option>
							<option value="WEST BENGAL">West Bengal</option>
							<option value="OTHER STATE">Other State</option>
						</select>
                    </div>
                </div>
                
				<div class="col-md-4" id="otherDomicile" style="display:none">
					<div class="input-group mb-3">
						<div class="input-group-prepend">
							<span class="input-group-text">Other <span class="text-danger">*</span></span>
						</div>
						<input type="text" id="txtotherDomicile" name="txtotherDomicile"  maxlength="50" class="form-control" placeholder="Enter Domicile">
					</div>
				</div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Marital Status <span class="text-danger">&dagger;</span></span>
                        </div>
                       <select id="choMarriedStatus" name="choMarriedStatus" class="custom-select">
							<option value="" selected>Select</option>
							<option value="Married">Married</option>
							<option value="Unmarried">Unmarried</option>
							<option value="Others">Others</option>
						</select>						 
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Nationality <span class="text-danger">&dagger;</span></span>
                        </div>
                         <span  class="text-primary form-control" id="spannationality"></span>                                     
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Religion <span class="text-danger">*</span></span>
                        </div>
                        <select id="choReligion" name="choReligion" class="custom-select" onchange="displayforOther(this.value,'OTHER','otherReligion','txtotherReligion')">
                            <option value="" selected>Select</option>
                            <option value="BRAHMOISM">Brahmoism</option>
                            <option value="BUDDHISM">Buddhism</option>
                            <option value="CHRISTIANITY">Christianity</option>
                            <option value="HINDUISM">Hinduism</option>
                            <option value="ISLAM">Islam</option>
                            <option value="JAINISM">Jainism</option>
                            <option value="SIKHISM">Sikhism</option>
                            <option value="ZOROASTRIANISM">Zoroastrianism</option>
                            <option value="NON BELIEVER">Non Believer</option>
                            <option value="NOT TO BE DISCLOSED">Not to be disclosed</option>
                            <option value="OTHER">Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4" id="otherReligion" style="display:none">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Other <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtotherReligion" name="txtotherReligion" maxlength="50" class="form-control" placeholder="Enter Religion">
                    </div>
                </div>
                 
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        	<span class="input-group-text">Whether BPL ? <span class="text-danger">&dagger;</span></span>
                        </div>
                        <select id="choWhetherBPL" name="choWhetherBPL" class="custom-select" onchange="displayforOther(this.value,'YES','BPLNo','txtBPLNo')">
                            <option value="" selected>Select</option>
                            <option value="YES">Yes</option>
                            <option value="NO">No</option>
                        </select>					  
                    </div>
                </div>
                 
                <div class="col-md-4" id="BPLNo" style="display:none">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">BPL No. <span class="text-danger">*</span></span>
                        </div>
                        <input type="text" id="txtBPLNo" name="txtBPLNo" maxlength="30" class="form-control" data-toggle="popover" data-trigger="focus" data-placement="top" title="Please Note:" data-content="Applicant must produce BPL Certificate at the time of Admission." placeholder="">
                        <div class="input-group-append">
                            <span class="input-group-text"><span style="cursor:help" data-toggle="tooltip" data-placement="top" title="Applicant must produce BPL Certificate at the time of Admission.">&nbsp;<i class="fa fa-info-circle text-danger"></i></span></span>
                        </div>
                    </div>
                </div>
                
				<div class="col-md-4" id="Div_EWS" style="display:none">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Whether EWS? <span class="text-danger">*</span></span>
                        </div>
                        <select id="choWhetherEWS" name="choWhetherEWS" class="custom-select" data-toggle="popover" data-trigger="focus" data-placement="top" title="Please Note:" data-content="Applicant must produce Income and Asset Certificate at the time of Admission.">
                            <option value="" selected>Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <div class="input-group-append">
                            <span class="input-group-text"><span style="cursor:help" data-toggle="tooltip" data-placement="top" title="Applicant must produce Income and Asset Certificate at the time of Admission.">&nbsp;<i class="fa fa-info-circle text-danger"></i></span></span>
                        </div>
                    </div>
                </div>
				 
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Annual Family Income <span class="text-danger">&dagger;</span></span>
                        </div>
                        <input type="text" id="txtannualFamilyIncome" name="txtannualFamilyIncome" maxlength="15" class="form-control" placeholder="" onKeyPress="inputNumber(event,this.value,true);">
                    </div>
                </div>
            </div>
        </section>
        
        <section class="mb-4">
            <h5 class="text-danger border-bottom mb-4">
                <i class="fa fa-wheelchair"></i> Disability Details
            </h5>
        
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Person with Disability <span class="text-danger">*</span></span>
                        </div>
                        <select id="choDisability" name="choDisability" class="custom-select" onchange="displayforPH(this.value,'Yes')" data-toggle="popover" data-trigger="focus" data-placement="top" title="Please Note:" data-content="<?php echo PH_TEXT;?>">
                            <option value="" selected>Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                        <div class="input-group-append">
                            <span class="input-group-text"><span style="cursor:help" data-toggle="tooltip" data-placement="top" title="<?php echo PH_TEXT;?>">&nbsp;<i class="fa fa-info-circle text-danger"></i></span></span>
                        </div>
                    </div>
                </div>
                           
                    <div class="col-md-4 disabilitydetail" style="display:none">
                        <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Disability type <span class="text-danger">*</span></span>
                                        </div>
                                        <select id="chodisabilitytype" name="chodisabilitytype" class="custom-select">
                                            <option value="" selected>Select</option>
                                            <option value="Visually Handicapped">Visually Handicapped</option>
                                            <option value="Hearing Impairment">Hearing Impairment</option>                                            
                                            <option value="Orthopaedically Handicapped">Orthopaedically Handicapped</option>
                                        </select>
                                    </div>
                    </div>
                    
                    <div class="col-md-4 disabilitydetail" style="display:none">
                       <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Disability % <span class="text-danger">*</span></span>
                                        </div>
                                        <input type="text" id="txtdisabilitypercent" name="txtdisabilitypercent" class="form-control" maxlength="3">
                                    </div>
                    </div>
				
            </div>
          				
        </section>
		
		<section class="mb-4">
            <h5 class="text-danger border-bottom mb-4">
                <i class="fa fa-book"></i> CU detail
            </h5>
        
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">CU Registration No.</span>   
                        </div>
                        <input type="text" id="txtCURegNo" name="txtCURegNo" maxlength="15" class="form-control" placeholder="" >
                        
                    </div>
                </div>
				
                  <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">CU Roll No.</span> 
                        </div>
                        <input type="text" id="txtCURollNo" name="txtCURollNo" maxlength="15" class="form-control" placeholder="" >
                    </div>
                </div>          
                 
            </div>
         
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 text-center">
				   <a class="btn btn-primary" href="javascript:void(0)" onclick="saveRegistrationDetail()"><i class="fa fa-database mr-2"></i>Update details</a>
				   <a class="btn btn-danger" href="javascript:void(0)" onclick="javascript: window.location.reload();"><i class="fa fa-times-circle"></i> Cancel</a>
				 
               </div>
            </div>
 
							
        </section>
		</form>
      </div>

    </div>
  </div>