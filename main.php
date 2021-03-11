<?php
require __DIR__."/vendor/autoload.php";
try{
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
}catch(\Exception  $e){
    return ".env missing , or payscribe config not found!!";
}


class Payscribe {
    // Properties




    static function sendreq($fields,$path,$token){
if($path == "account"){
    $url = "https://www.payscribe.ng/api/account/";
}else{

        if($_ENV['PAYSCRIBE_TYPE'] == "sandbox"){
            $url = "https://www.payscribe.ng/sandbox/$path";
        }
    
    if($_ENV['PAYSCRIBE_TYPE'] == "live"){
            $url =  "https://www.payscribe.ng/api/v1/$path";
        }
}

  $fields_string = json_encode($fields);

  //open connection
  $ch = curl_init();

  //set the url, number of POST vars, POST data
  curl_setopt($ch,CURLOPT_URL, $url);
  curl_setopt($ch,CURLOPT_POST, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      "Authorization: Bearer $token",
      "Cache-Control: no-cache",
  ));

    //So that curl_exec returns the contents of the cURL; rather than echoing it
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true); 

    //execute post
    $result = curl_exec($ch);
    return json_decode($result);
}

    static  function Account(){

        $data =["username"=>$_ENV['PAYSCRIBE_USERNAME']];

        $url = "account";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }




    static function DataLookup($network){
        $data =["network"=>$network];

        $url = "data/lookup";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }
    
    static function VendData($plan,$recipent,$network){
        $data =["plan"=>$plan,"recipent"=>$recipent,"network"=>$network];

        $url = "data/vend";

        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);

    }
    
    static function RechargeCard($qty,$amount,$name){
        $data =["qty"=>$qty,"amount"=>$amount,"display_name"=>$amount];

        $url = "rechargecard";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }
    
    
    static function GetCards($trans_id){
        $data =["trans_id"=>$trans_id];

        $url = "rechargecardpins";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }
    
    
    static function ValidateCard($type,$no){
        $data =["type"=>$type,"account"=>$no];

        $url = "multichoice/validate";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }
    
    static function MultichoicePay($plan,$code,$phone,$token,$trans_id){
        $data =["plan"=>$plan,
                "productCode"=>$code,
                "phone"=>$phone,
                "productToken"=>$token,
                "trans_id"=>$trans_id 
               ];

        $url = "multichoice/vend";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }
    
    static function StartimesValidate($no,$amount){
        $data =["account"=>$no,"amount"=>$amount];

        $url = "startimes/validate";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }
    
    static function StartimesVend($no,$amount,$pcode,$Pcode,$phone,$name,$tid){
        $data =[ 
                "smart_card_no"=>$no,
                "amount"=>$amount,
                "product_code"=>$pcode,
                "productCode"=>$Pcode,
                "phone_number"=>$phone,
                "customer_name"=>$name,
                "transaction_id"=>$tid
               ];

        $url = "startimes/vend";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }
    
    static function ATWLookup(){
        $data = [];
        $url = "airtime_to_wallet";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }
    
    static function ATWProcess($network,$amount,$phone,$from){
        $data =["network"=>$network,"amount"=>$amount,"phone_number"=>$phone,"from"=>$from];

        $url = "airtime_to_wallet/vend";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }
    
    static function VendAirtime($network,$amount,$recipent){
        $data =["network"=>$network,"amount"=>$amount,"recipent"=>$recipent,"ported"=>false];

        $url = "airtime";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }
    
    
    static function ValidateElectricity($number,$type,$amount,$service){
        $data =["meter_number"=>$number,"meter_type"=>$type,"amount"=>$amount,"service"=>$service];

        $url = "electricity/validate";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }

    
    
    static function ElectricityVend($productCode,$productToken,$phone){
        $data =["productCode"=>$productCode,"productToken"=>$productToken,"phone"=>$phone];

        $url = "electricity/vend";
        return self::sendreq($data,$url,$_ENV['PAYSCRIBE_KEY']);
    }



}
