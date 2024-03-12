<?php

/**
 * while integration please use sendEasyPayRequest function along with parameters
 */
require_once 'AesForJava.php';

class EasyPay extends AesForJava {

    function __construct($POST_URL = '', $CHECKSUM_KEY = '', $ENCRYPTION_KEY = '') {
        if (empty($POST_URL) || empty($CHECKSUM_KEY) || empty($ENCRYPTION_KEY))
            throw new Exception('POST_URL, CHECKSUM_KEY, ENCRYPTION_KEY params are missing', '001');

        define('POST_URL', $POST_URL);
        define('CHECKSUM_KEY', $CHECKSUM_KEY);
        define('ENCRYPTION_KEY', $ENCRYPTION_KEY);
    }

    function sendEasyPayRequest($cid = '', $rid = '', $crn = '', $amt = '', $ver = '', $typ = '', $cny = '', $rtu = '', $ppi = '', $re1 = 'MN', $re2 = '', $re3 = '', $re4 = '', $re5 = '') {
        $i = $this->createEasypayRequest($cid, $rid, $crn, $amt, $ver, $typ, $cny, $rtu, $ppi, $re1 = 'MN', $re2, $re3, $re4, $re5);
        header('Location:' . POST_URL . "?i=" . $i);
    }

    function calcCheckSum($cid, $rid, $crn, $amt, $key) {
        $str = $cid . $rid . $crn . $amt . $key;
        return hash("sha256", $str);
    }

    function createEasypayRequest($cid = '', $rid = '', $crn = '', $amt = '', $ver = '', $typ = '', $cny = '', $rtu = '', $ppi = '', $re1 = 'MN', $re2 = '', $re3 = '', $re4 = '', $re5 = '') {
        $req_params = array('CID', 'RID', 'CRN', 'AMT', 'VER', 'TYP', 'CNY', 'RTU', 'PPI');
        $postUrl = POST_URL;
        $checksumkey = CHECKSUM_KEY; /* ask easypay team for check-sum key */
        $encryption_key = ENCRYPTION_KEY; /* ask easypay team for encryption key */

        $arr = array(
            "CID" => $cid,
            "RID" => $rid,
            "CRN" => $crn,
            "AMT" => $amt,
            "VER" => $ver,
            "TYP" => $typ,
            "CNY" => $cny,
            "RTU" => $rtu,
            "PPI" => $ppi,
            "RE1" => $re1,
            "RE2" => $re2,
            "RE3" => $re3,
            "RE4" => $re4,
            "RE5" => $re5,
        );

        foreach ($arr as $key => $value) {
            if (in_array($key, $req_params) && empty($value)) {
                $missing_params[] = $key;
            }
        }

        if (!empty($missing_params)) {
            echo "MISSING PARAMETERS ARE : " . implode(' , ', $missing_params);
            exit;
        }

        $arr['CKS'] = $this->calcCheckSum($cid, $rid, $crn, $amt, $checksumkey);

        $aesJava = new AesForJava();
        $str = urldecode(http_build_query($arr));
        $value_i = $aesJava->encrypt($str, $encryption_key, 128);
        return $value_i;
    }

}
