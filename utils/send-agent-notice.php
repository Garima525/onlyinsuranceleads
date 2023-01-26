<?php
// $agent = false;
// require_once "../../lib/PHPMailer/PHPMailerAutoload.php";
require_once "../lib/PHPMailer/PHPMailerAutoload.php";
// $agent = unserialize(base64_decode($_REQUEST['agent']));
// if(!isset($_REQUEST['debug'])) {
//     if(isset($_REQUEST['agent'] )) {
//       if(isset($agent) && !empty($agent)){
//         if(isset($agent['name']) && !is_null($agent['name']) && !empty($agent['name'])){
//
//         }
//       }
//         // $agent = unserialize(base64_decode($_REQUEST['agent']));
//     }
// } else {
//     //error_log("NOT Sending Notice");
// }

if(isProperAgentURL($agent)){
  //sendNotice($agent);
  sendNotice_sendgrid($agent);
}

/**
 * @author Garima
 * @created 26 Jan 2023
 * 
 * Email API for Sendgrid
 */
function sendNotice_sendgrid($agent)
{
    $actual_link = $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    $email_html =
    '<html>
       <head>
          <title></title>
          <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <meta http-equiv="X-UA-Compatible" content="IE=edge" />
       </head>
       <body>
          <table border="0" cellpadding="0" cellspacing="0" width="100%">
             <!-- HERO -->
             <tr>
                <td>
                   <table>
                      <tr>
                         <td>
                            <p> An agent has hit their personal URL!</p>
                            <br/>
                            <p>When : ' .date("m/d/Y") ." at " .date("h:i A") .'</p>
                            <p>Name : ' .$agent["name"] .' Insurance Agency</p>
                            <p>Phone : ' .$agent["phone"] .'</p>
                            <br />
                            <p>Email : ' .$agent["email"] .'</p>
                            <p>PURL : ' .$agent["purl"] .'</p>
                            <p>URL : ' .$actual_link .'</p>
                            <p>PURL Hits : ' .($agent["hits"] + 1) .'</p>
                         </td>
                      </tr>
                   </table>
                </td>
             </tr>
          </table>
       </body>
    </html>';
    
    $to_arr = [
        [
         "email" => 'david@onlyinsuranceleads.com',
         "name" => "David Cohen" 
        ],
        [
         "email" => 'service@onlyinsuranceleads.com',
         "name" => "Only Insurance Leads" 
        ],
        [
         "email" => 'stephanie@onlyinsuranceleads.com',
         "name" => "Stephanie"
        ]
        
        /*,
        [
         "email" => 'harish@infostride.com',
         "name" => "Harish C"
        ]*/
    ];
    
    if(isset($agent['salesperson_email'])){
        $to_arr[] = [ 'email' => $agent['salesperson_email']];
    }
    
    $jayParsedAry = [
        "personalizations" => [
            [
                "to" => $to_arr,
                "subject" => "OnlyInsuranceLeads PURL " .$agent["name"] ." Insurance Agency",
            ],
        ],
        "from" => [
            "email" => "info@OnlyInsuranceLeads.com",
            "name" => "OnlyInsuranceLeads",
        ],
        "content" => [
            [
                "type" => "text/html",
                "value" => "$email_html",
            ],
        ],
    ];
    // print_r($jayParsedAry); die();
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.sendgrid.com/v3/mail/send",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => json_encode($jayParsedAry),
        CURLOPT_HTTPHEADER => [
            "Content-Type: application/json",
            "Authorization: Bearer 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",
        ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    //echo $response; die();
    if ($err) {
        //echo "cURL Error #:" . $err;
        return false;
    } else {
        return true;
    }
}

function sendNotice($agent) {
    error_log("Sending Notice");
    // $actual_link = $_SERVER['HTTP_REFERER'];
    $actual_link = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    $nl = "\r\n";

    //PHPMailer Object
    $mail = new PHPMailer;
    $mail->isSMTP();
    // $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->Host = "kr5l-d26p.accessdomain.com";
    $mail->Port = 587;
    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;
    $mail->Username = "purl@onlyinsuranceleads.com";
    $mail->Password = "9ny3mNXnDbHxhs@";

    //From email address and name
    // $mail->From = "service@OnlyInsuranceLeads.com";
    $mail->From = "info@OnlyInsuranceLeads.com";

    $mail->FromName = "OnlyInsuranceLeads";

    // To address and name
    // $mail->addAddress('seth@OnlyInsuranceLeads.com', 'Only Insurance Leads');

    $mail->addAddress('david@OnlyInsuranceLeads.com', 'David Cohen');
    $mail->addAddress('service@OnlyInsuranceLeads.com', 'Only Insurance Leads');
    $mail->addAddress('stephanie@onlyinsuranceleads.com', 'Stephanie');

    // $mail->addAddress('kkambeya@designsnsuch.com', 'Kalanda Kambeya');
    // $mail->addAddress('hafiz.bilalahmadgondal@gmail.com', 'Bilal Ahmad');


    if(isset($agent['salesperson_email'])){
        $mail->addAddress($agent['salesperson_email']);
    }

    //Address to which recipient will reply
    $mail->addReplyTo("service@OnlyInsuranceLeads.com", "Reply");

    //Send HTML or Plain Text email
    $mail->isHTML(false);

    $mail->Subject = 'OnlyInsuranceLeads PURL '.$agent['name'];
    $message = '';
    $message .= 'An agent has hit their personal URL!'.$nl.$nl;
    $message .= 'When: '.date("m/d/Y").' at '.date("h:i A").$nl;
    $message .= 'Name: '.$agent['name'].$nl;
    $message .= 'Phone: '.$agent['phone'].$nl;
    $message .= 'Email: '.$agent['email'].$nl;
    $message .= 'PURL: '.$agent['purl'].$nl;
    $message .= 'URL: '.$actual_link.$nl;
    $message .= 'PURL Hits: '.($agent['hits'] + 1).$nl;

    //TODO have to remove , testing debug die
    // $message .= 'Request parameters are : '.$nl;
    // foreach ($_REQUEST as $key => $value) {
    //   $message .= 'Key: '.$key.$nl;
    //   $message .= 'Value: '.$value.$nl;
    // }
    // $message .= 'Server parameters are : '.$nl;
    // foreach ($_SERVER as $key => $value) {
    //     $message .= 'Key: '.$key.$nl;
    //     $message .= 'Value: '.$value.$nl;
    // }
    //END

    $message .= $agent['hitDates'];
    $message = wordwrap($message, 70, $nl);

    $mail->Body = $message;
    if(!$mail->send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        // echo "Message has been sent successfully ";
    }
}
?>
