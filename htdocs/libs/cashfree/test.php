<?php
include_once 'payment.class.php';

$url = "https://ee08e626ecd88c61c85f5c69c0418cb5.m.pipedream.net";

// Get JSON data from the URL
$jsonData = file_get_contents($url);

// Convert JSON string to PHP array
$data = json_decode($jsonData, true);

// Print the data
echo "<pre>";
// print_r($data);
print($data['success']);
echo "</pre>";

if($data['success']){
    print("success");
}
else{
    print("faild");

}
session_start();

$id = $_SESSION['link_id'];

echo "<pre>";
print_r($_SESSION);
echo "</pre>";



$cashfree = new Payment(get_config('cf_AppId'), get_config('cf_SecKey'));

$verify = $cashfree->verifyPayment($id);

print($verify);

?>
