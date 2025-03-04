<?php


try{
          
  $username = Session::get('session_user');
  $subscription = new Subscription();
  $details = $subscription->getUniquePlans($username);
  // $getdetail = $subscription->getdetails();

   echo "<pre>";
  // print_r($details);
  echo "</pre>";

  $purchase = new Purchase($username);
  $domian = $purchase->getDomain('domain');
  // print($domain);

}
catch(Exception $e){

  // echo $e->getMessage();
  // echo "<center><h3>You Don't have Plan,</h3></center><br>";
}
  




?>


<div class="container mt-5">
  <?if ($details !== false && !empty($details)) {?>
    <table class="table table-striped table-bordered text-center">
      <thead>
      <tr>
          <th colspan="6" ><h4 class="text-center"> Your Plan </h4></th>
        </tr>
        <tr class="bg-primary text-light">
          <th class="bg-primary text-light" scope="col">S.NO</th>
          <!-- <th scope="col">Domain ID</th> -->
          <th class="bg-primary text-light" scope="col">Plan</th>
          <th class="bg-primary text-light" scope="col">Domain</th>
          <!-- <th scope="col">URL</th> -->
          <th class="bg-primary text-light" scope="col">Status</th>
          <th class="bg-primary text-light" scope="col">Actions</th>

        </tr>
      </thead>
      <tbody>
        <?php

  
    




            // Iterate over the details array
foreach ($details as $index => $site) {

  $planId = htmlspecialchars($site['plan_id']);
  
  if ($purchase->isPlanIdExists($planId)) {
    $status = "In use";
    $domain = $purchase->getDomainById($planId);
    // print($domain);
  } else {
    $status = "Not In Use";
    $domain = "None";
  }


    echo "<tr>";
    echo "<th scope='row'>" . ($index + 1) . "</th>";
    // echo "<td>" . htmlspecialchars($site['id']) . "</td>";
    echo "<td>" . htmlspecialchars($site['plan_name']) . "</td>"; 
    echo "<td>" . $domain . "</td>";
   // echo "<td><a href='"."http://". htmlspecialchars($site['domain']) .".gosite.in". "'>" . htmlspecialchars($site['domain']) .".gosite.in". "</a></td>";
    echo "<td>" . $status . "</td>";
   if($status === "Not In Use"){ 
    ?>

  <td><button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target="#siteModal<?print($index);?>">Host Now</button></td>
  <? }else{
    ?>
      <td><button type='button' class='btn btn-primary btn-sm' disabled  >In Use</button></td>

    <?
  }
    ?>
    
   <div class="modal fade" id="siteModal<?php echo $index; ?>" tabindex="-1" aria-labelledby="siteModalLabel<?php echo $index; ?>" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                
            
  <section id="upload" class="upload-section py-5">
        <div class="container">
            <h2 class="text-center mb-2">Launch Your Websites <i class="fa fa-rocket" style="font-size:48px;color:rgb(255, 62, 62)"></i>
            </h2>
            <br>
            <div class="">
                <div class="upload-content">
                    <!-- <i class="bi bi-cloud-upload"></i> -->
                    <form action="uploadtest.php" method="POST" enctype="multipart/form-data"><br>
        <h5>Enter Domain Name</h5>
        <input class="form-control" type="text" id="domain" name="domain" required placeholder="" />
        <br>

    <!-- subdomain or custom domain selection -->
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="domainType" id="inlineRadio1" value="subdomain" checked>
          <label style="text-decoration:none;" class="form-check-label" for="inlineRadio1"><p>Subdomain</p></label>
        </div>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="domainType" id="inlineRadio2" value="custom">
          <label style="text-decoration:none;" class="form-check-label" for="inlineRadio2">Custom</label>
          
        </div>
        <br>
        <br>
        

        <h5>Upload Your Project: (.zip)</h5 >
        <input type="file" class="form-control form-control-lg" id="file" name="file" accept=".zip" />
        <br>
        <h4>(or)</h4>
        <h5>Enter Git Repo Link</h5 >
        <input type="text" class="form-control form-control-lg" id="git" name="git" />
        <br>
        <input type="hidden" name="plan_id" value="<? ECHO htmlspecialchars($site['plan_id']); ?>">
        <input type="hidden" name="plan_name" value="<? ECHO htmlspecialchars($site['plan_name']); ?>">  
        <button type="submit" class="btn btn-primary">Deploy Now</button>
                    </form>
                    <br>
                    <!-- //add like "read here how to upload -> link" for help button -->
                    <a href="documents.php" class="btn btn-link mt-4">Read here how to upload</a>
               </div>
            </div>
        </div>
    </section>
    


            </div>
        </div>
    </div>
  

    <?php
}

} else {
    echo "<center><h3>You Don't have Plan,</h3>
    
    <a href='index.php#pricing' class='btn btn-primary'>Get a Plan</a>
    </center><br>";

  //create a button and redirect to the plans page
   
}

        ?>
      </tbody>
    </table>
  </div>