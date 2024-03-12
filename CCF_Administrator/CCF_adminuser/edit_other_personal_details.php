<div class="card mb-1">
    <div class="card-header bg-secondary" id="OtherPersonalDetailsHeading">
      <h5 class="mb-0">
        <button class="btn btn-link btn-block text-left text-decoration-none text-uppercase text-white collapsed" data-toggle="collapse" data-target="#OtherPersonalDetails" aria-expanded="false" aria-controls="OtherPersonalDetails">
          <i class="fa fa-user-secret"></i> Other Personal details
		    
          <i class="fa fa-caret-down float-right mt-1"></i>
        </button>
      </h5>
    </div>
	 
    <div id="OtherPersonalDetails" class="collapse"  aria-labelledby="OtherPersonalDetailsHeading" data-parent="#accordion">
	<form id="frmOtherPersonalDetail" name="frmOtherPersonalDetail" action="" method="post">
       <div class="card-body pl-2 pr-2">
        <section class="mb-2">
            <!--<h5 class="text-danger border-bottom mb-4">
                <i class="fa fa-file-o"></i> Other Personal details
            </h5>-->
        
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Minority Group <span class="text-danger">*</span></span>
                        </div>
                        <select id="chominoritygrp" name="chominoritygrp" class="custom-select">
                            <option value="" selected>Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Mother Tongue <span class="text-danger">*</span></span>
                        </div>
                        <select id="chomotherTongue" name="chomotherTongue" class="custom-select">
                            <option value="" selected>Select</option>
                            <option value="Assamese">Assamese</option>
                            <option value="Bengali">Bengali</option>
                            <option value="Bodo">Bodo</option>
                            <option value="Dogri">Dogri</option>
                            <option value="English">English</option>
                            <option value="Gujarati">Gujarati</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Kannada">Kannada</option>
                            <option value="Kashmiri">Kashmiri</option>
                            <option value="Konkani">Konkani</option>
                            <option value="Maithili">Maithili</option>
                            <option value="Malayalam">Malayalam</option>
                            <option value="Marathi">Marathi</option>
                            <option value="Meitei">Meitei</option>
                            <option value="Nepali">Nepali</option>
                            <option value="Odia">Odia</option>
                            <option value="Punjabi">Punjabi</option>
                            <option value="Sanskrit">Sanskrit</option>
                            <option value="Santali">Santali</option>
                            <option value="Sindhi">Sindhi</option>
                            <option value="Tamil">Tamil</option>
                            <option value="Telugu">Telugu</option>
                            <option value="Urdu">Urdu</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">1st Generation Learner ? <span class="text-danger">*</span></span>
                        </div>
                        <select id="chofirstGenrLearner" name="chofirstGenrLearner" class="custom-select">
                            <option value="" selected>Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                
                <!--<div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Hostel Required ? <span class="text-danger">*</span></span>
                        </div>
                        <select id="choHostelReq" name="choHostelReq" class="custom-select">
                            <option value="" selected>Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div> -->
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Already registered under&nbsp;<abbr title="Calcutta University">CU</abbr>&nbsp;? <span class="text-danger">*</span></span>
                        </div>
						
                        <select id="chohasCuRegNo" name="chohasCuRegNo" class="custom-select" onchange="displayforOther(this.value,'Y','div_CuRegNo','')" data-toggle="popover" data-trigger="focus" data-placement="top" title="Please Note:" data-content="Candidate who appeared in CU examination before 2019 are not eligible to apply in <?php echo CURRENT_YEAR;?>">
						   <option value="" selected>Select</option>
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
						 
                        </select>
                    </div>                    
                </div>
                
                <div class="col-md-4" id="div_CuRegNo" style="display:none">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Enter CU Registration No <span class="text-danger">&dagger;</span></span></span>
                        </div>
                        <input id="dispCuRegNo" name="dispCuRegNo" type="text" disabled class="form-control" placeholder="" maxlength="25" data-toggle="popover" data-trigger="focus" data-placement="top" title="Please Note:" data-content="Candidate need to upload CU registration certificate at later point of time.">
                    </div>
                </div>
				<input type="hidden" id="hdngender" name="hdngender" value="<?php echo $studrecord["sex"]; ?>" />
                <?php if($studrecord["sex"]=='Female') {?>
				
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Belong to Kanyashree? <span class="text-danger">*</span></span>
                        </div>
                        <select id="chohasKanyashree" name="chohasKanyashree" class="custom-select" onchange="displayforOther(this.value,'Yes','div_KanyashreeID','txtKanyashreeID')">
                            <option value="" selected>Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>                    
                </div>
                
                <div class="col-md-4" id="div_KanyashreeID" style="display:none">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Enter Kanyashree ID <span class="text-danger">*</span></span>
                        </div>
                        <input id="txtKanyashreeID" name="txtKanyashreeID" type="text" class="form-control" placeholder="" maxlength="25">
                    </div>
                </div> 
				<?php }?>				
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Sports Representation <span class="text-danger">*</span></span><!--Apply in Sports Quota?-->
                        </div>
                        <select id="choSportsQuota" name="choSportsQuota" class="custom-select" onchange="displayforOther(this.value,'Yes','div_sportlevel','chosportlevel');">
                            <option value="" selected>Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-4" id="div_sportlevel" style="display:none">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Representation Level <span class="text-danger">*</span></span>
                        </div>
                        <select id="chosportlevel" name="chosportlevel" class="custom-select">
                            <option value="" selected>Select</option>
                            <option value="International">International</option>
                            <option value="National">National</option>
                            <option value="State">State</option>
                            <option value="District">District</option>
                            <option value="Club Level 1st Division">Club Level 1st Division</option>
                            <option value="Club Level 2nd Division">Club Level 2nd Division</option>
                            <option value="Club Level 3rd Division">Club Level 3rd Division</option>
                        </select>
                    </div>
                </div>
                
                <!-- <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Apply in add-on courses ? <span class="text-danger">*</span></span>
                        </div>
                        <select id="choapplyAddonCourse" name="choapplyAddonCourse" class="custom-select"  onchange="displayforAddon(this.value,'Yes','div_AddonCourses','choAddonCourses');">
                            <option value="" selected>Select</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-5" id="div_AddonCourses" style="display:none">
                    <div class="input-group mb-3">                                            	
                        <div class="input-group-prepend">
                            <span class="input-group-text">Add-ons <span class="text-danger">*</span></span>
                        </div>
                        <ul class="m-0 p-0 ml-2" style="list-style-type:none">
                            <li>
                            	<i class="fa fa-hand-o-right mr-2"></i><input class="AddonCourses" type="checkbox" id="Diploma Course in Computer" name="choAddonCourses" value="Diploma Course in Computer">
                                <label class="form-check-label" for="Diploma Course in Computer">Diploma Course in Computer</label>
                            </li>
                            <li>
                            	<i class="fa fa-hand-o-right mr-2"></i><input class="AddonCourses" type="checkbox" id="Beautician Course" name="choAddonCourses" value="Beautician Course">
                                <label class="form-check-label" for="Beautician Course">Beautician Course</label>
                            </li>
                            <li>
                                <i class="fa fa-hand-o-right mr-2"></i><input class="AddonCourses" type="checkbox" id="Foreign Language Course - French" name="choAddonCourses" value="Foreign Language Course - French">
                                <label class="form-check-label" for="Foreign Language Course - French">Foreign Language Course - French</label>
                            </li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-md-5">
                    <div class="input-group mb-3">                                            	
                        <div class="input-group-prepend">
                            <span class="input-group-text">Area of Interest <span class="text-danger">*</span></span>
                        </div>
                        <ul class="m-0 p-0 ml-2" style="list-style-type:none">
                            <li>
                                <i class="fa fa-hand-o-right mr-2"></i><input class="AddonCourses" type="checkbox" id="Music" name="choAddonCourses" value="Music">
                                <label class="form-check-label" for="Music">Music</label>
                            </li>
                            <li>
                            	<i class="fa fa-hand-o-right mr-2"></i><input class="AddonCourses" type="checkbox" id="Drama" name="choAddonCourses" value="Drama">
                                <label class="form-check-label" for="Drama">Drama</label>
                            </li>
                            <li>
                            	<i class="fa fa-hand-o-right mr-2"></i><input class="AddonCourses" type="checkbox" id="Sports & Games" name="choAddonCourses" value="Sports & Games">
                                <label class="form-check-label" for="Sports & Games">Sports & Games</label>
                            </li>
                            <li>
                                <i class="fa fa-hand-o-right mr-2"></i><input class="AddonCourses" type="checkbox" id="Debate & Extempore" name="choAddonCourses" value="Debate & Extempore">
                                <label class="form-check-label" for="Debate & Extempore">Debate & Extempore</label>
                            </li>
                            <li>
                                <i class="fa fa-hand-o-right mr-2"></i><input class="AddonCourses" type="checkbox" id="Photography & Painting" name="choAddonCourses" value="Photography & Painting">
                                <label class="form-check-label" for="Photography & Painting">Photography & Painting</label>
                            </li>
                            <li>
                                <i class="fa fa-hand-o-right mr-2"></i><input class="AddonCourses" type="checkbox" id="Other" name="choAddonCourses" value="Other">
                                <label class="form-check-label" for="Other">Other</label>
                            </li>
                        </ul>
                    </div>
                </div>-->
                
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Area of Interest</span>
                        </div>
                        <ul class="m-0 p-0 ml-2" style="list-style-type:none">
                            <li>
                            	<i class="fa fa-hand-o-right mr-2"></i><input class="willtojoin" type="checkbox" id="Music" name="chowilltojoin" value="Music">
                                <label class="form-check-label" for="Music">Music</label>
                            </li>
                            <li>
                            	<i class="fa fa-hand-o-right mr-2"></i><input class="willtojoin" type="checkbox" id="Drama" name="chowilltojoin" value="Drama">
                                <label class="form-check-label" for="Drama">Drama</label>
                            </li>
                            <li>
                            	<i class="fa fa-hand-o-right mr-2"></i><input class="willtojoin" type="checkbox" id="Sports" name="chowilltojoin" value="Sports and Games">
                                <label class="form-check-label" for="Sports">Sports & Games</label>
                            </li>
							 <li>
                            	<i class="fa fa-hand-o-right mr-2"></i><input class="willtojoin" type="checkbox" id="Debate" name="chowilltojoin" value="Debate and Extempore">
                                <label class="form-check-label" for="Debate">Debate & Extempore</label>
                            </li>
							 <li>
                            	<i class="fa fa-hand-o-right mr-2"></i><input class="willtojoin" type="checkbox" id="Photography" name="chowilltojoin" value="Photography and Painting">
                                <label class="form-check-label" for="Photography">Photography & Painting</label>
                            </li>
							<li>
                            	<i class="fa fa-hand-o-right mr-2"></i><input class="willtojoin" type="checkbox" id="Other" name="chowilltojoin" value="Other">
                                <label class="form-check-label" for="Other">Other</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
 
            <div class="row justify-content-center mt-4">
                <div class="col-md-12 text-center">
				   <a class="btn btn-primary" href="javascript:void(0)" onclick="saveOtherPersonalDetail()"><i class="fa fa-database mr-2"></i>Update Other Personal details</a>
				   <a class="btn btn-danger" href="javascript:void(0)" onclick="javascript: window.location.reload();"><i class="fa fa-times-circle"></i> Cancel</a>
               </div>
            </div>
 

        </section>
      </div>
	  </form>
    </div>
</div>