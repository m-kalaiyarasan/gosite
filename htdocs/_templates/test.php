

<div class="container mt-5">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">S.NO</th>
          <!-- <th scope="col">Domain ID</th> -->
          <th scope="col">Plan</th>
          <!-- <th scope="col">URL</th> -->
          <th scope="col">Status</th>
          <th scope="col">Actions</th>

        </tr>
      </thead>
      <tbody>
        <?php

        
        $username = Session::get('session_user');
        $subscription = new Subscription();
        $details = $subscription->getUniquePlans($username);
        // $getdetail = $subscription->getdetails();

         echo "<pre>";
        // print_r($details);
        echo "</pre>";

        $purchase = new Purchase($username);
        $domian = $purchase->getDomain('domain');
        print($domain);
        // $planId = 'plan_PdgDRV9wFR8Jn4'; // Example plan ID
  
    




        if ($details !== false) {
            // Iterate over the details array
foreach ($details as $index => $site) {

  $planId = htmlspecialchars($site['plan_id']);
  
  if ($purchase->isPlanIdExists($planId)) {
    $status = "In use";
  } else {
    $status = "Not In Use";
  }


    echo "<tr>";
    echo "<th scope='row'>" . ($index + 1) . "</th>";
    // echo "<td>" . htmlspecialchars($site['id']) . "</td>";
    echo "<td>" . htmlspecialchars($site['plan_name']) . "</td>";
   // echo "<td><a href='"."http://". htmlspecialchars($site['domain']) .".gosite.in". "'>" . htmlspecialchars($site['domain']) .".gosite.in". "</a></td>";
    echo "<td>" . $status . "</td>";
   if($status === "Not In Use"){ 
    ?>


  <td><button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target="#siteModal<?print($index);?>">Use Now</button></td>

   <div class="modal fade" id="siteModal<?php echo $index; ?>" tabindex="-1" aria-labelledby="siteModalLabel<?php echo $index; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                
            
  <section id="upload" class="upload-section py-5">
        <div class="container">
            <h2 class="text-center mb-4">Launch Your Websites <i class="fa fa-rocket" style="font-size:48px;color:rgb(255, 62, 62)"></i>
            </h2>
            <br>
            <div class="upload-area mx-auto">
                <div class="upload-content">
                    <!-- <i class="bi bi-cloud-upload"></i> -->
                    <form action="uploadtest.php" method="POST" enctype="multipart/form-data"><br>
        <h5>Enter Domain Name</h5>
        <? print(htmlspecialchars($site['plan_id'])); ?>
        <input class="form-control" type="text" id="domain" name="domain" required placeholder="" />
        <br>

        <h5>Upload Your Project: (.zip)</h5 >
        <input type="file" class="form-control form-control-lg" id="file" name="file" accept=".zip" />
        <br>
        <input type="hidden" name="plan_id" value="<? ECHO htmlspecialchars($site['plan_id']); ?>">
        <input type="hidden" name="plan_name" value="<? ECHO htmlspecialchars($site['plan_name']); ?>">  
        <button type="submit" class="btn btn-primary">Deploy Now</button>
                    </form>
                    <br>
                    <!-- //add like "read here how to upload -> link" for help button -->
                    <a href="documents.php" class="btn btn-link">Read here how to upload</a>
               </div>
            </div>
        </div>
    </section>
    


            </div>
        </div>
    </div>
  
  <? }
    ?>
    <?php
}

} else {
    echo 'No purchase details found for the specified username.';
}

        ?>
      </tbody>
    </table>
  </div>