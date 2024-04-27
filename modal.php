<div class="modal fade" id="ImportantDatesApplication" tabindex="-1" role="dialog" aria-labelledby="ImportantDatesApplicationTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="totalImportantDatesApplication">Important Dates <?php echo CURRENT_YEAR;?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <!--<p class="text-left text-danger font-weight-bold"><i class="fa fa-calendar"></i> Phase 1 Important Dates <i class="fa fa-hand-o-down"></i></p>-->
        <!--<table class="table">
          <thead>
            <tr>
              <th width="476" scope="col">Particulars</th>
              <th width="151" scope="col">Dates</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Online Submission of Application Forms</th>
              <td>10.08.2020</td>
            </tr>
            <tr>
              <th scope="row">Online Application Ends</th>
              <td>TBA</td>
            </tr>
            <tr>
              <th scope="row">Online Payment Starts from</th>
              <td>10.08.2020</td>
            </tr>
            <tr>
              <th scope="row">Last date of Online Payment</th>
              <td>TBA</td>
            </tr>
            <tr>
              <th scope="row">Publication of Merit List</th>
              <td>TBA</td>
            </tr>
          </tbody>
        </table>-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="helpline" tabindex="-1" role="dialog" aria-labelledby="helplineTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="helplineModalLongTitle">Helpline</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <p>
            <h5><i class="fa fa-headphones"></i> Technical Helpline</h5>
            <strong>Technical Query :</strong> +91 98301 68755 (11 AM. to 4 PM.)<!--<br>
            <i class="fa fa-envelope-o"></i> <a href="mailto:collegeadmissionwb@gmail.com" target="_blank">collegeadmissionwb@gmail.com</a>--><br><br>
            <strong>Payment related issue :</strong><br>
            Call us at : 033 4006 8755 (11 AM. to 4 PM.)<br>
            <i class="fa fa-envelope-o"></i> <a href="mailto:payments.collegeadmission@gmail.com" target="_blank">payments.collegeadmission@gmail.com</a><br><br>
            <strong>Remote Support :</strong><br>
            Before calling us, please download the AnyDesk software by clicking on the Download link provided below.<br>
            <a class="btn btn-danger btn-sm mt-2" href="https://www.collegeadmission.in/AnyDesk.exe" target="_blank"><i class="fa fa-cloud-download"></i> Download</a>
        </p>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    

    <div class="modal fade" id="ValidationAlert" tabindex="-1" role="dialog" aria-labelledby="ValidationAlertTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-danger" id="ShowValidationAlert"><?php echo MODAL_VALIDATION_TEXT;?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-left" id="msgcontent">
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
<style>
.lds-roller {
  display: inline-block;
  position: relative;
  width: 80px;
  height: 80px;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 40px 40px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 7px;
  height: 7px;
  border-radius: 50%;
  margin: -4px 0 0 -4px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s; background:#F00;
}
.lds-roller div:nth-child(1):after {
  top: 63px;
  left: 63px; background: #007bff;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 68px;
  left: 56px; background: #6c757d;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 71px;
  left: 48px; background: #F36;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 72px;
  left: 40px; background: #28a745;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 71px;
  left: 32px; background: #dc3545;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 68px;
  left: 24px; background: #ffc107;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 63px;
  left: 17px; background: #17a2b8;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 56px;
  left: 12px; background: #B68F49;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
    <!-- LOADER START-->    
    <div id="dvLoading" style="display:none; position:fixed; top:0; left:0; background:rgba(0,0,0,0.8); width:100%; height:100%; padding:0; margin:0 auto; z-index:9999999999">
        <div class="lds-roller" style="padding:5px; border-radius:5px;height:100px;width:100px; position:absolute; top:50%; left:50%;margin-left:-50px;    margin-top:-50px; display:block;">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="text-white" style="padding:5px; border-radius:5px;height:100px;width:100px; position:absolute; top:50%; left:50%;margin-left:-50px; margin-top:30px; display:block;">Please wait...</div>
    </div>
    <!-- LOADER ENDS-->
    
    <div class="modal fade" id="subjectHelpline" tabindex="-1" role="dialog" aria-labelledby="subjectHelplineTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="subjectHelplineModalLongTitle">Request for Subject Addition</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <p>
                If you do not find your Subject in the list, please send us the detail in the following email id along with the College Name and your contact details or call us at Technical Helpline number provided below.
            </p>
            <hr>
            <p>
                <h5><i class="fa fa-headphones"></i> Technical Helpline</h5>
                <i class="fa fa-phone"></i> Call us at : <a class="text-dark" href="tel:+913340068755">(033) 4006 8755</a><br>
                <i class="fa fa-envelope-o"></i> <a href="mailto:subjects.collegeadmission@gmail.com" target="_blank">subjects.collegeadmission@gmail.com</a>
            </p>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>    
    
    <div class="modal fade" id="subjectsAppliedApplication" tabindex="-1" role="dialog" aria-labelledby="subjectsAppliedApplicationTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="totalsubjectsAppliedApplication">No. of Subjects Applied - <span class="text-success">05</span></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Form No.</th>
                  <th scope="col">Subject</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>VCW20054412</td>
                  <td>BNGA</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>VCW20054413</td>
                  <td>PHSA</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>VCW20054414</td>
                  <td>CEMA</td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>VCW20054415</td>
                  <td>BSCGENPURE</td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>VCW20054416</td>
                  <td>BAGEN</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="combinationApplication" tabindex="-1" role="dialog" aria-labelledby="combinationApplicationTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="totalcombinationApplication">Combination chosen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Combination</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>BNGA</td>
                  <td>BNGA-PHIG-SOCG</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>PHSA</td>
                  <td>PHSA-MTMG-CEMG</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>CEMA</td>
                  <td>CEMA-MTMG-PHSG</td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>BSCGENPURE</td>
                  <td>PHSG-MTMG-CEMG</td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>BAGEN</td>
                  <td>BENG-PHIG-HISG</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="IntakeApplication" tabindex="-1" role="dialog" aria-labelledby="IntakeApplicationTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="totalIntakeApplication">Intake Capacity <?php echo CURRENT_YEAR; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Intake</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>BNGA</td>
                  <td>Gen-30, SC-8, ST-3, OBC-A-6, OBC-B-6, PH-1</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>PHSA</td>
                  <td>Gen-30, SC-8, ST-3, OBC-A-6, OBC-B-6, PH-1</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>CEMA</td>
                  <td>Gen-30, SC-8, ST-3, OBC-A-6, OBC-B-6, PH-1</td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>BSCGENPURE</td>
                  <td>Gen-30, SC-8, ST-3, OBC-A-6, OBC-B-6, PH-1</td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>BAGEN</td>
                  <td>Gen-300, SC-100, ST-30, OBC-A-60, OBC-B-60, PH-2</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="Fees" tabindex="-1" role="dialog" aria-labelledby="FeesTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="totalFees">Fees Structure <?php echo CURRENT_YEAR; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Fees</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>BNGA</td>
                  <td>2100</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>PHSA</td>
                  <td>3470</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>CEMA</td>
                  <td>3795</td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>BSCGENPURE</td>
                  <td>3350</td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>BAGEN</td>
                  <td>1750</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    <div class="modal fade" id="PaymentStatusApplication" tabindex="-1" role="dialog" aria-labelledby="PaymentStatusApplicationTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="totalPaymentStatusApplication">Application Payment Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body text-center">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Subject</th>
                  <th scope="col">Fee</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>BNGA</td>
                  <td>300</td>
                  <td class="text-success"><i class="fa fa-check-circle"></i></td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>PHSA</td>
                  <td>300</td>
                  <td class="text-success"><i class="fa fa-check-circle"></i></td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>CEMA</td>
                  <td>300</td>
                  <td class="text-danger"><i class="fa fa-times-circle"></i></td>
                </tr>
                <tr>
                  <th scope="row">4</th>
                  <td>BSCGENPURE</td>
                  <td>300</td>
                  <td class="text-danger"><i class="fa fa-times-circle"></i></td>
                </tr>
                <tr>
                  <th scope="row">5</th>
                  <td>BAGEN</td>
                  <td>300</td>
                  <td class="text-danger"><i class="fa fa-times-circle"></i></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    
    
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Launch demo modal
</button>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>-->