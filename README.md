
# Payscribe php sdk documentation
![enter image description here](https://www.payscribe.ng/assets/img/payscribe_logo.png)


 # [installation]
 

    #with composer
    composer require geezywap/payscribe
    
if you are having composer error add this below to your composer.json and restart installation.
"minimum-stability": "dev"

# [Usage]
Add configurations to .env file
`PAYSCRIBE_KEY=apikey`
`PAYSCRIBE_TYPE=sandbox/live`
`PAYSCRIBE_USERNAME = payscribe_email`
   
your php init goes here!! :)

    <?php
    require __DIR__."/vendor/autoload.php";
    use Payscribe;
    //your code goes here
    
	 
	 
[*User Account*]

    Payscribe::Account()
[*Data Lookup*]
  
  *networks:  mtn, airtel, 9mobile, glo*

    Payscribe::DataLookup("network")
[*Data Vending*]

     Payscribe::VendData("plan","recipen","network")
  [*Recharge Card Pin*]
Print recharge card pin, minimum quantity is 1 and maximum is 50,000.

Please note that this pin works for all network.

Parameters

-   qty(required): the quantity of pin you want to generate
-   amount(required): Amount from NGN50, to NGN50,000
-   display_name(optional): This is the name you want to show on the recharge card slip
     Payscribe::Recharge("qty","amount","name")
  
  [*Fetch Recharge Card Pin*]
  
You can fetch all generated pin for a particular transaction using the transaction ID

Parameter: trans_id( required): The trasaction ID

     Payscribe::GetCards("trans_id")  
  
  
  [*Validate smart card number*]
Validate startimes smart card number to get bouquet and customer details before vending

Parameters

-   account(required): The iuc number you are validating
-   amount(required): the amount you are paying 



	     Payscribe::ValidateCard("trans_id")  
	     
  [*Vend Multichoice - GOTV, DSTV*]
  
  Make payment for GOTV - DSTV

Parameters

-   phone(required): The buyer' phone number
-   productCode(required): The productCode as returned when validating the iuc number
-   plan: the plan you are buying
-   productToken(required): The token received when validating the iuc number
-   trans_id (optional): your transaction id, which you can use as reference later on    

	    Payscribe::MultichoicePay("plan","productCode","phone_number","productToken","trans_id") 

[*Validate startimes smart card number*]
Validate startimes smart card number to get bouquet and customer details before vending

Parameters

-   account(required): The iuc number you are validating
-   amount(required): the amount you are paying
	 
	    Payscribe::StartimesValidate("type","account")
	
[*Vend Startimes*]
Make payment for startimes

Parameters

-   bouquet(required): the plan you're purchasing either NOVA, CLASSIC...
-   cycle(required): This is the cycle for the plan you selected either daily, weekly, or monthly
-   productCode(requred): as seen on the validation
-   phone(required): the user phone number
-   productToken(required): as seen on the validation endpoint
-   trans_id(optional): your reference id

		   Payscribe::StartimesVend("bouquet","circle","productCode","phone","productToken","trans_id")

[*Airtime to Wallet*]
You may need to get fetch the available networks and our current rate before sending the airtime

Please note that wallet will only be credited when the airtime is received.

    Payscribe::ATWLookup()

[*Process Airtime to Wallet*]
Airtime to wallet.

Your wallet will be credited once airtime is received

Parameters

-   network(required): The network you are sending; mtn, glo, 9mobile, or airtel
-   phone_number(required): Our phone phone number, kindly visit the airtime to wallet lookup to see available network and respective number
-   from (required): The phone number you are sending it from
-   amount(required): The amount you are sending. Minimum of NGN500 And maximum of NGN20,000 per transaction

	     Payscribe::ATWProcess("network","amount","phone","from")
[*Validate Electricity*]

Validate electricity

Parameters

-   meter_number(required): The meter number you want to validate
-   meter_type(required): postpaid or prepaid
-   service(required): This is the available disco : ikedc, ekedc, phedc, aedc, ibedc, kedco
-   amount(required): The amount you are purchasing minimum of N100

 

		  Payscribe::ValidateElectricity("number","type","amount","service")
[*Pay Electricity*]
Pay electricity bill

Parameters

-   productCode(required): The product code as seen when validating
-   productToken(required): The productToken as seen when validating.

	      Payscribe::ElectricityVend("productCode","productToken")
[*Vend Airtime*]

Purchase airtime (Glo, Mtn, Airtel, 9mobile)

Parameters

-   network(required): The network you are vending; mtn, glo, 9mobile or airtel
-   amount(required): Minimum of NGN50
-   recipent(required): The phone number you are buying to, set it to array if you're sending to multiple recipent
-   ported(optional): set to true if the number is a ported number.
  

		Payscribe::VendAirtime("network","amount","recipent")
