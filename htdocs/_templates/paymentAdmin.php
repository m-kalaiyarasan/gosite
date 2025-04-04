<?php
$username = Session::get('session_user');
$purchase = new Purchase($username);
$details = $purchase->getPaymentDetails();
?>


<div class="container mt-5">
  <div class="table-responsive">

  <? if ($details !== false){ ?>
    <table class="table table-striped table-bordered text-center">
      <thead>
        <tr>
          <th  colspan="9" ><h4 class="text-center"> Payment Details</h4></th>
          <!-- <th class="bg-primary text-light" colspan="7" ><h4 class="text-center"> Your Sites </h4></th> -->
        </tr>
        <tr >
          <th class="bg-primary text-light" scope="col">S.NO</th>
          <!-- <th class="bg-primary text-light" scope="col">Domain ID</th> -->
          <th class="bg-primary text-light" scope="col">Username</th>
          <!-- <th class="bg-primary text-light" scope="col">URL</th> -->
          <th class="bg-primary text-light" scope="col">Email</th>
          <th class="bg-primary text-light" scope="col">Date</th>
          <th class="bg-primary text-light" scope="col">Amount</th>
          <th class="bg-primary text-light" scope="col">Plan</th>
          <th class="bg-primary text-light" scope="col">Days left</th>
          <th class="bg-primary text-light" scope="col">Status</th>
          <th class="bg-primary text-light" scope="col">Action</th>

        </tr>
      </thead>
      <tbody>

        <?php
  }
        // Example data, replace with your actual data source

        // $username = Session::get('session_user');
        // $purchase = new Purchase($username);
        // $details = $purchase->getdetails();
        if ($details !== false) {
            // Iterate over the details array
           


        
foreach ($details as $index => $site) {

  // if(htmlspecialchars($site['status']) == 1){
  //   $status = "Active";
  // }
  // else{
  //   $status = "Inactive";
  // }
  $planId = htmlspecialchars($site['link_id']);
  
  if ($purchase->isPlanIdExists($planId)) {
    $status = "Live";
    $domain = $purchase->getDomainById($planId);
    // print($domain);
  } else {
    $status = "- - - - ";
    $domain = "- - - - ";
  }
  // $status = htmlspecialchars($site['status']);

    echo "<tr>";
    echo "<th scope='row'>" . ($index + 1) . "</th>";
    // echo "<td>" . htmlspecialchars($site['id']) . "</td>";
    echo "<td>" .  htmlspecialchars($site['username'])  . "</td>";
    // echo "<td><a href='"."http://". htmlspecialchars($site['domain']) . "'target='_blank'>" . htmlspecialchars($site['domain']) . "</a></td>";
    echo "<td>" .  htmlspecialchars($site['customer_email'])  . "</td>";
    echo "<td>" .  htmlspecialchars($site['link_created_at'])  . "</td>";
    echo "<td>" . htmlspecialchars($site['link_amount']) . "</td>";
    echo "<td>" . htmlspecialchars($site['plan_type']) . "</td>";
    echo "<td>" . htmlspecialchars($site['payment_status']) . "</td>";

    echo "<td>" . Purchase::daysLeftInSubscription(htmlspecialchars($site['end_at'])) . "</td>";

   

    // echo "<td><button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#siteModal" . $index . "'>Pull</button></td>";
   
    echo "<td><button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#siteModal" . $index . "'>Details</button></td>";
    ?>
    <!-- Modal -->
    <div class="modal fade" id="siteModal<?php echo $index; ?>" tabindex="-1" aria-labelledby="siteModalLabel<?php echo $index; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="siteModalLabel<?php echo $index; ?>">Site Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
              
                <h5>Username : <?=htmlspecialchars($site['username'])?></h5>
                <h5>Site Name : <?=$domain?></h5>
                <h5>Status : <?=$status?></h5>
                <h5>Plan Name : <?=htmlspecialchars($site['plan_name'])?></h5>
                <h5>Plan Id : <?=htmlspecialchars($site['link_id'])?></h5>
                <h5>Start date : <?=htmlspecialchars($site['link_created_at'])?></h5>
                <h5>Expire on : <?=htmlspecialchars($site['end_at'])?></h5>
                <h5>Days left : <?=Purchase::daysLeftInSubscription(htmlspecialchars($site['end_at']))?></h5>
            
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    echo "</tr>";
}

} else {
  echo "<center><h3>You Don't have Site in Live,</h3>
    
  <a href='admin.php?host' class='btn btn-primary'> See Here </a>
  </center><br>";
}

        ?>
      </tbody>
    </table>
    </div>
  </div>

  <script>
    function confirmDelete() {
        const deleteButton = document.querySelector('button[name="action"][value="delete"]');
        if (document.activeElement === deleteButton) {
            return confirm("Are you sure you want to delete this site?");
        }
        return true; // Allow other actions (like Save) without confirmation.
    }
</script>