<?php
include_once 'payment.class.php';



session_start();

$id = $_SESSION['link_id'];

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

$cashfree = new Payment(get_config('cf_AppId'), get_config('cf_SecKey'));

$verify = $cashfree->verifyPayment($id);

print($verify);
if($verify == "PAID"){  
    // $update = $cashfree->updateStatus($id,$verify);
   header("Location: ../../dashboard.php?host");
   exit;
}
elseif($verify == "ACTIVE"){    
    print("Your Payment is pending");
}
elseif($verify == "pending"){    
    print("Your Payment is still pending");
}
// else{
//     print("therila da mapla");
// }

   header("Location: ../../dashboard.php?host");
   exit;

?>
