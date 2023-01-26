<?php
namespace Mobilyte\Tools;

ini_set('allow_url_fopen', 1);
class LocationData {
  public function __construct() {
    
  }

  public function getUserIP() {
    // Get real visitor IP behind CloudFlare network
    $ip = '';
    if (! empty($_SERVER['HTTP_CLIENT_IP'])) {
        // to get shared ISP IP address
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } else if (! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // check for IPs passing through proxy servers
        // check if multiple IP addresses are set and take the first one
        $ipAddressList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        foreach ($ipAddressList as $ip) {
            if (! empty($ip)) {
                // if you prefer, you can check for valid IP address here
                $ipAddress = $ip;
                break;
            }
        }
    } else if (! empty($_SERVER['HTTP_X_FORWARDED'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED'];
    } else if (! empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    } else if (! empty($_SERVER['HTTP_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_FORWARDED_FOR'];
    } else if (! empty($_SERVER['HTTP_FORWARDED'])) {
        $ip = $_SERVER['HTTP_FORWARDED'];
    } else if (! empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    
    echo $ip;
    
    return $ip;

  }

  public function ipToLocationinfo($show="") {
    $ipAddress = $this->getUserIP();
    $Data = "";
//     $ipAddress =trim(str_replace(",", "", $ipAddress));
    $url = "http://api.ipstack.com/".$ipAddress."?access_key=d153fa940fd5ba8a89864b3662e0e6fa";
    
    // die($ipAddress);
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    //  curl_setopt($ch,CURLOPT_HEADER, false);
        $output=curl_exec($ch);
        curl_close($ch);
        $details = json_decode($output);

        //$details = json_decode(file_get_contents("http://api.ipstack.com/208.185.48.71?access_key=f9043ee810a37a6eb8944072b394d8be"));
        //$details = json_decode(file_get_contents("http://api.ipstack.com/".$ipAddress."?access_key=f9043ee810a37a6eb8944072b394d8be"));

        //echo "<pre>"; print_r($details); die('kala');

        if (!empty($details)) {
            if (!$show) {
                return $details;
            } else {
                $Data .= "City : ".$details->city."<br>";
                $Data .= "Region : ".$details->region_name."<br>";
                $Data .= "region_code : ".$details->region_code."<br>";
                $Data .= "Country_name : ".$details->country_name."<br>";
                $Data .= "Country_code : ".$details->country_code."<br>";
                $Data .= "Loction(lat,Long) : ".$details->latitude.",".$details->longitude."<br>";
                $Data .= "Zip : ".$details->zip."<br>";
                $Data .= "Phone : ".$details->phone."<br>";
                $Data .= "Organization : ".$details->org."<br>";
                return $Data;
            }
        } else {
            return "Unable to find the visitor loction info.";
        }
    }
}
