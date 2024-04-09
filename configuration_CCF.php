<?php
//set_error_handler("customError",E_USER_WARNING);
//error_reporting(0);

/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

define("BASE_TIME_ZONE","Asia/Calcutta");

define("VIEWPORT","width=device-width, initial-scale=1.0, user-scalable=0");//width=device-width, initial-scale=1, shrink-to-fit=no (bootstrap 4)
//define("BASE_URL","http://110.227.107.223/VMC_SDMS");// WITH IPv4
define("BASE_URL","http://localhost/VMC_SDMS");
define("BASE_URL_HOME","http://localhost/VMC_SDMS");
define("BASE_URL_STUDENT","http://localhost/VMC_SDMS/CCF_StudentPanel"); // CCF
define("BASE_ROOT_FOLDER","/VMC_SDMS"); 
define("SOFTWARE_NAMECODE","Student Management System");
define("GOOGLE_FONT_1","https://fonts.googleapis.com/css?family=Poppins|Roboto|Rubik|Viga|Oswald|AR+One+Sans|Inter:wght@400;600&display=swap");
define("FONT_AWESOME_CSS","https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css");
define("SESSIONYR","2023-24");

define("ACADEMIC_SESSION","2023-24"); // Only candidates matching this session will be allowed to pay admission fee.


//define("CURRENTSESSION","2021");
//define("APPNOPADDING",6);
//define("APPSRLNOPADDING",2);
//define("SECTIONS","Morning,Day"); //Day,Morning,Evening
//define("APP_YEAR","2021");
define("CURRENT_YEAR","2024");


define("DOBYEARFROM",1975);
define("DOBYEARTO",2005);

define("COLLEGE_CODE","VMC");
define("COLLEGE_NAME","Vidyasagar Metropolitan College");
define("COLLEGE_ACCREDIATION", "NAAC Accredited");
define("COLLEGE_TAG",""); //NAAC Grade 'A' Institution
define("COLLEGE_LOGO","images/Logo.png");
define("FAVICON","images/ico.jpg");

define("COLLEGE_ADDRESS","39, Sankar Ghosh Lane, Kolkata-700006");
define("COLLEGE_PHNO"," +91 033 2241 9508");
define("COLLEGE_EMAIL","vidyasagarevening@yahoo.in");


$BAGENarrlistSem3 =array('Bengali', 'English', 'Hindi', 'Political Science', 'Geography', 'Mathematics', 'Physiology');
$BSCGENarrlistSem3 =array('Bengali', 'English', 'Hindi', 'Political Science', 'Geography', 'Mathematics', 'Physiology');

//define("REGNO_NAME","Student Id");
//define("APPNO_NAME","Form No");
define("PROGRAMME_NAME","Undergraduate");
define("PROGRAMME_CODE","UG");
define("MODAL_VALIDATION_TEXT","<i class='fa fa-exclamation-triangle mr-1 faa-flash animated'></i>Alert!");

define("PH_TEXT","Applicant will be entitled to relaxation regarding admission and reservation against PH quota if he or she suffers from not less than 40% of the relevant disability [ (a) Blindness or Low Vision, (b) Heraing Impairment, (c) Locomotor Diability or Cerebral palsy]. He or she will have to submit, at the time of admission, a disability certificate issued by a competent authority (Medical Board duly constituted by the Central or State Government).");

define("RESERVED_CATEGORY_TEXT","SC / ST of West Bengal State only are entitled to relaxation regarding admission and reservation of seats. Applicant must produce caste certificate in his/her own name issued by competent authorities of West Bengal government at the time of admission.");

define("DOMICILE_STATE_TEXT","The state in which the Applicant has his / her permanent residence.");

//define("SMS_DECLARATION","I hereby allow the college / its assignee to contact me for Application / Admission related information through SMS / E-mail / Whatsapp at the mobile no., email and whatsapp no. provided by me in this form.");

//define("DECLARATION_REGISTRATION","I hereby declare that I have read and understood the condition of eligibility for the course and subject for which I seek admission. I fullfill the minimum eligibility criteria and I have provided necessary information in this regard. All the particulars given by me in this form are true to the best of my knowledge and belief. In the event of any information being found incorrect or misleading at the time of admission or at any stage in future my candidature shall be liable to cancellation by the College and University (whichever is applicable in my case) at any time and I shall not be entitled to refund of any application / admission fee paid by me to the College and University (whichever is applicable in my case). I have read and understood the procedures. I shall abide by terms and conditions thereon.");

//define("DECLARATION_APPLICATION","I hereby declare that I undertake to abide by all the rules and regulations of the College and University (whichever is applicable in my case) now in force or to be in force during the course of my study in this College. (ii) If I fail to submit my Migration/ Registration Certificate within the stipulated period, I would not request the authority to condone any decision as may be decided by him/her with regards to continuation of my studies in this College (iii) Failure to attend 60% of classes in any given Semester would debar me from being sent up for respective University degree examination (iv) Agree to change any subject if advised by the College in case present selection of subjects is found to be not in accordance with the University rules (v) My studentship is liable to be cancelled if any discrepancy arises in the statements/ documents submitted by me at any stage of this admission process. Admission will be cancelled if any mistake repugnant to rules is detected irrespective of its origin.");

//define("APP_FEE_REFUND_POLICY_DECLARATION","<span class='font-weight-bold'>Refund Policy</span> : I hereby understand and agree that the College will refund application fees to the applicant only for following reason(s): If application fees is received by the College more than once (through Payment Gateway) against same ".REGNO_NAME.". However, be it clearly noted that if any applicant pay his/her  for a particular ".REGNO_NAME." but latter on requests for its refund, the deposited amount cannot be refunded.");

//define("SMSSENDER_ID","TEST SMS") ; //Promotional
//define("SMSSENDER_USER","praveen@suryashaktiinfotech.com:Sipl@2016") ; //Promotional

//define("SMSSENDER_ID","SIPLTD") ; //Transactional
//define("SMSSENDER_USER","suryashaktiinfotech@gmail.com:Sipl@2016") ; //Transactional

define("SMSAPIKEY","YTBiY2RkMmZkYTg2ZTU1MjljMzU3ZTZiZWY2ZDRkMWU=") ;
define("SMSSENDER_ID","SIPLtd") ;
define("SMSBRAND","SIPL") ;

define("SENDER_EMAIL","noreply@collegeadmission.in") ;

//define("APP_FEE","300");//300

//define("PAYMENTLEVEL","PAYBYREGISTNO"); // for registraionNo- PAYBYREGISTNO, applicationNo - PAYBYAPPLINO

//define("FEEPAYTYPE","BOTH"); // MULTIOFAPP/FIX/BOTH

//define("FIXAMOUNT",300); // 300, 400 use when FEEPAYTYPE is BOTH
//define("MULTIPLEAMOUNT",300); // 300, 50 use when FEEPAYTYPE is BOTH

//==================== BILLDESK CREDENTIAL =======================
define("BILLERID","VMPTCFTN");
define("SECURITYID","vmptcftn");
define("CHECKSUMKEY","lUTI6CSaZEKFgo46TRI0ViAIkiWtUU8k");

//==================== BILLDESK CREDENTIAL =======================

//==================== HDFC PAYU CREDENTIAL =======================
/*define("MERCHANTKEY","7rnFly");//  ----- for TEST ---
define("MERCHANTSALT","pjVQAWpA");//  ----- for TEST ---
define("PAYUBASEURL","https://test.payu.in"); //  ----- for TEST ---*/

/*define("MERCHANTKEY","nAggo9");//  ----- for LIVE ---
define("MERCHANTSALT","fsoe2OER");//  ----- for LIVE ---
define("PAYUBASEURL","https://secure.payu.in"); //  ----- for LIVE ---*/
//==================== HDFC PAYU CREDENTIAL =======================

//==================== AXIS BANK CREDENTIAL =======================
// AXIS BANK
/*define("APIKEY",'BCE6FF1343B4779A3E0B6C808FACCA');//  ----- for TEST ---
define("MERCHANTID","SCOTT_TEST");//  ----- for TEST ---
define("PAYMENTBASEURL","https://api.juspay.in"); //  ----- for TEST ---*/

// AXIS BANK
/*define("APIKEY",'BBD9999A0804DA58AD9C7D27ED9288');//  ----- for LIVE ---
define("MERCHANTID","SCOTT");//  ----- for LIVE ---
define("PAYMENTBASEURL","https://api.juspay.in"); //  ----- for LIVE ---*/

//==================== AXIS BANK CREDENTIAL =======================
define("BR","%0a"); //for whatsapp chat line break
define("WHATSAPP_API_URL","https://api.whatsapp.com/send?phone=91"); //for whatsapp chat line break
define("CA_URL","https://www.collegeadmission.in/Scottish/admission_notice.shtml");

//define("SESSIONNAME","0");
    $local_timezone = BASE_TIME_ZONE;
    date_default_timezone_set($local_timezone);

   
?>