<?php

define("BASE_URL","http://vec.collegeadmission.in/Fee_Collection_UG");//Server
//define("BASE_URL","http://kausik/admissionproj/Scottish_Fee_Collection_UG");//Local

define("BASE_TIME_ZONE","Asia/Calcutta");

define("ACADEMIC_SESSION","2020-2021"); // Only candidates matching this session will be allowed to pay admission fee.

define("COLLEGE_FAVICON","ico.jpg");
define("COLLEGE_LOGO","Logo.jpg");
define("COLLEGE_NAME","Vidyasagar Metropolitan College");


define("COLLEGE_TAG","");
define("COLLEGE_ACCREDIATION", "NAAC Accredited");
define("COLLEGE_ADDRESS","39, Sankar Ghosh Lane, Kolkata - 700 006");
define("COLLEGE_PHNO"," +91 033 2241 9508");
define("COLLEGE_EMAIL","vidyasagarevening@yahoo.in");
define("COLLEGE_WEBSITE","www.vec.ac.in");

define("BILLERID","VIDYAEVECO");
define("SECURITYID","vidyaeveco");
define("CHECKSUMKEY","lLr8sdurnQ1j");


define('CORPORATE_ID', '3963');
//define('POST_URL', "https://uat-etendering.axisbank.co.in/easypay2.0/frontend/index.php/api/payment"); // TEST MODE
//define('CHECKSUM_KEY', 'axis'); // TEST MODE CSK Key
//define('ENCRYPTION_KEY', 'axisbank12345678'); // TEST MODE AES key

//define('POST_URL', "https://easypay.axisbank.co.in/index.php/api/payment"); // LIVE MODE
//define('CHECKSUM_KEY', 'D@7!'); // LIVE MODE CSK Key
//define('ENCRYPTION_KEY', 'S@cldeHt146ahD7M'); // LIVE MODE AES key

//define("ACCOUNT_NUMBER","911010026202738"); // UG Account Numbero to be passed here -- 2019-- Ac No. 084010100249621

    $local_timezone = BASE_TIME_ZONE;
    date_default_timezone_set($local_timezone);
	
	
?>
