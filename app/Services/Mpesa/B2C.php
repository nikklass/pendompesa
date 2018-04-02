<?php
date_default_timezone_set('Africa/Nairobi');


$SERVICEID = "100554000"; 
//$SHORTCODE = "898740";
//$SHORTCODE = "871600"; 
$SHORTCODE = "883305";
$IniShortCode = "11223344556";

$spId = "100554";
 
//$spId = "203000";


//$spPass= "Kenya@123" ;

$spPass = "Nairobi#21";


//$spPass = "Pi3nd0poaz2018";


//$timestamp_ = date("YdmHis");
//$tstamp = substr(date("YmdHis"),0,16);

$username = "PendoMediaB2CInit"; 


$userpass = "Pi3nd0poaz*2018" ;
            

$SecurityCred = `/data/bin/encrypt3.php $userpass` ;


log_this("\n\n>>>>> Security Credential Is: $SecurityCred\n\n");


$RECEIVER = "254721735369"; // 4 B2C 

$rx_short_code = "902004"; // 4 B2B


$reqTime = date('Y-m-d') . "T" . date('H:i:s') . ".0000521Z"; //2014-10-21T09:47:19.0000521Z

//$real_pass = base64_encode(hash('sha256', $spId . "" . $password . "" . $timestamp_));


$tstamp = date("YmdHis");



$spSecret= sprintf("%s%s%s",$spId,$spPass,$tstamp) ;

log_this("\n\n>>>>>>>>>>> SP SECRET IS: $spSecret\n\n");


$real_pass = base64_encode( hash("sha256",$spSecret ) );

//$meURL="https://172.31.180.101:18423/safapi/interfaces/C2BPaymentValidationAndConfirmation";
//$url = 'https://196.201.214.137:18423/mminterface/registerURL';

$qURL="https://172.31.180.101:18423/safapi/QueTimeout.php";
$resURL="https://172.31.180.101:18423/safapi/B2CResult.php";



$url = 'https://192.168.9.49:18423/mminterface/request';





//$url = "https://196.201.214.136:18423/mminterface/request";
//$url="http://196.201.214.137:8310/queryTransactionService/services/transaction";

//$rand = rand(123456, 654321);
//$srcConID = $spId . "_SmartYouth_" . $rand;

$tstamp2 = $tstamp.mt_rand(0,999); 

$srcConID=md5(sprintf("%s%s%s",$spId,$spPass,$tstamp2));

$reqTime = date('Y-m-d') . "T" . date('H:i:s') . ".0000521Z"; //2014-10-21T09:47:19.0000521Z


function log_this($lmsg)
{  
  
    $flog = sprintf("/data/log/safapi_b2c_prod_%s.log",date("Ymd"));
  $tlog = sprintf("\n%s%s : %s",date("Y-m-d H:i:s T: "),$_SERVER["REMOTE_ADDR"],$lmsg);
  
  //`echo $tlog >> $flog`;
  $f = fopen($flog, "a");
  fwrite($f,$tlog);
  fclose($f);
  
}



   
    
$curlData="<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:req=\"http://api-v1.gen.mm.vodafone.com/mminterface/request\">
   <soapenv:Header>
      <tns:RequestSOAPHeader xmlns:tns=\"http://www.huawei.com/schema/osg/common/v2_1\">
          <tns:spId>$spId</tns:spId>
            <tns:spPassword>$real_pass</tns:spPassword>
            <tns:timeStamp>$tstamp</tns:timeStamp>
            <tns:serviceId>$SERVICEID</tns:serviceId>
      </tns:RequestSOAPHeader>
   </soapenv:Header>
   <soapenv:Body>
      <req:RequestMsg><![CDATA[<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<Request xmlns=\"http://api-v1.gen.mm.vodafone.com/mminterface/request\">
    <Transaction>
        <CommandID>PromotionPayment</CommandID>
        <LanguageCode></LanguageCode>
        <OriginatorConversationID>$srcConID</OriginatorConversationID>
        <ConversationID> </ConversationID>
        <Remark> </Remark>
                <Parameters>
            <Parameter>
                <Key>Amount</Key>
                <Value>600</Value>
            </Parameter>
        </Parameters>
        <ReferenceData>
            <ReferenceItem>
                <Key>QueueTimeoutURL</Key>
              <Value>$qURL</Value>  
            </ReferenceItem>
            <ReferenceItem>
                <Key>Occasion</Key>
                <Value>BirthDay</Value>
            </ReferenceItem>
        </ReferenceData>
        <Timestamp>$tstamp</Timestamp>
    </Transaction>
    <Identity>
       <Caller>
<CallerType>2</CallerType>
<ThirdPartyID>broker_4</ThirdPartyID>
<Password>T50mhFnEwrPNy0BU0b+n+8Hwdb2LhsKG0KSPemuiXiZrcYoemz5vIl0uUzs1OSUPi5cumPF4djZuuIERNVA+znH85Iy2k+DQQtFRGTVKBWNZZpDjus9RE0BD7iuBFjiAzr5UNJcpeetSO0nmG7O9sfXJ/tBWCnRPRE8vWNzlrq0tBhFl1EtWvkBDY7Daj/MWeigkumOGwB0/GDvO0AsOJZtHuGeddGHEi/lb1oJxlCOKXts8ZxopnbuDN5sB4qD3P5QUxgTfE1KFHEeklvwWUcnNpuDz7q12k0yzYhsJEE4MyiVwjZVuo66TPQd4AjU+JDzEIAwG4IJx98dh5C4AOA==</Password>
<ResultURL>$resURL</ResultURL>
</Caller>

        <Initiator>
            <IdentifierType>11</IdentifierType>
            <Identifier>$username</Identifier>
<SecurityCredential>$SecurityCred</SecurityCredential> 
            <ShortCode>$SHORTCODE</ShortCode>
        </Initiator>
        <PrimaryParty>
            <IdentifierType>4</IdentifierType>
            <Identifier>$SHORTCODE</Identifier>
            <ShortCode>$SHORTCODE</ShortCode>
        </PrimaryParty>
        <ReceiverParty>
            <IdentifierType>1</IdentifierType>
            <Identifier>$RECEIVER</Identifier>
            <ShortCode>ShortCode1</ShortCode>
        </ReceiverParty>
        <AccessDevice>
            <IdentifierType>1</IdentifierType>
            <Identifier>Identifier3</Identifier>
        </AccessDevice>
    </Identity>
    <KeyOwner>1</KeyOwner>
</Request>]]></req:RequestMsg>
   </soapenv:Body>
</soapenv:Envelope>";



log_this("<==========> REQUEST <==============>\n$curlData\n\n<=========== END REQUEST =============>");

echo date('Y-m-d H:i:s') . ': Request: ' . $curlData . "\n\n";
//$url = 'http://196.201.214.136:8310/mminterface/request';
//$url = "https://196.201.214.136:18423/mminterface/request";
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_TIMEOUT, 120);
curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 120);
curl_setopt($curl, CURLOPT_ENCODING, 'utf-8');

curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'SOAPAction:""',
    'Content-Type: text/xml; charset=utf-8',
));
curl_setopt($curl, CURLOPT_VERBOSE, TRUE);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($curl, CURLOPT_SSLVERSION, 6);  



// <><><><> CERTIFICATE SECTION HERE <><><><><><>

//curl_setopt($curl, CURLOPT_CAINFO, '/etc/apache2/ssl/certs/syil_mpesa.pem');
curl_setopt($curl, CURLOPT_CAINFO, '/etc/httpd/ssl/saf_bundles.pem');

//curl_setopt($curl, CURLOPT_SSL_CIPHER_LIST, 'RC4-SHA');

curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');
//curl_setopt($curl, CURLOPT_SSLCERT, '/etc/apache2/ssl/certs/syil_mpesa.cer');
curl_setopt($curl, CURLOPT_SSLCERT, '/etc/httpd/ssl/saf_apache.crt');

curl_setopt($curl, CURLOPT_SSLCERTTYPE, 'PEM');





curl_setopt($curl, CURLOPT_SSLKEY, '/etc/httpd/ssl/apache.key');

curl_setopt($curl, CURLOPT_SSLKEYPASSWD, '');

// <><><><> CERTIFICATE SECTION HERE <><><><><><>



curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)');



curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $curlData);
curl_setopt($curl, CURLOPT_HEADERFUNCTION, 'read_header'); // get header

$result = curl_exec($curl);
if (curl_errno($curl)) {
    echo "\n>>>>>>>CURL ERROR >>>>>>>>>>\n" . curl_error($curl) . "\n\n";
}

//echo date('Y-m-d H:i:s') . ": Response: $result\n";
echo date('Y-m-d H:i:s') . ": RESPONSE: \n";

print_r($result);


//log_this(print_r($result,true));


log_this(sprintf("<==========> RESPONSE <==============>\n%s\n\n<=========== END RESPONSE =============>",
print_r($result,true)));
curl_close($curl);

//$xml = new SimpleXMLElement($result);
//print_r($xml);

function read_header($curl, $string) {
    print "Received header: $string\n\n";
    return strlen($string);
}

//echo $curlData . "\n";
?>                          
