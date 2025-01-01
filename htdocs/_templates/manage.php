<?php
$username = Session::get('session_user');
$purchase = new Purchase($username);
$details = $purchase->getdetails();
?>


<div class="container mt-5">
  <? if ($details !== false){ ?>
    <table class="table table-striped">
      <thead>
        <tr>
          <th colspan="6" ><h4 class="text-center"> Your Sites </h4></th>
        </tr>
        <tr>
          <th scope="col">S.NO</th>
          <!-- <th scope="col">Domain ID</th> -->
          <th scope="col">Site Name</th>
          <th scope="col">URL</th>
          <th scope="col">Status</th>
          <th scope="col">Plan</th>
          <th scope="col">Actions</th>

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

  if(htmlspecialchars($site['status']) == 1){
    $status = "Active";
  }
  else{
    $status = "Inactive";
  }

    echo "<tr>";
    echo "<th scope='row'>" . ($index + 1) . "</th>";
    // echo "<td>" . htmlspecialchars($site['id']) . "</td>";
    echo "<td>" . htmlspecialchars($site['domain']) . "</td>";
    echo "<td><a href='"."http://". htmlspecialchars($site['domain']) .".gosite.in". "'>" . htmlspecialchars($site['domain']) .".gosite.in". "</a></td>";
    echo "<td>" . $status . "</td>";
    echo "<td>" . htmlspecialchars($site['plan_name']) . "</td>";
   
    echo "<td><button type='button' class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#siteModal" . $index . "'>Manage</button></td>";
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
                    <form action="editsite.php" method="post" onsubmit="return confirmDelete();">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($site['id']); ?>">
                  
                        <div class="mb-3">
                            <label for="siteName<?php echo $index; ?>" class="form-label">Site Name</label>
                            <input type="text" class="form-control" id="siteName<?php echo $index; ?>" name="name" value="<?php echo htmlspecialchars($site['domain']); ?>">
                        </div>
                        <div class="mb-3">
                            <!-- URL - Change automatically when you change the site name -->
                        </div>
                        <div class="mb-3">
                            <label for="siteStatus<?php echo $index; ?>" class="form-label">Status</label>
                            <select class="form-select" id="siteStatus<?php echo $index; ?>" name="status">
                                <!-- <option value="Inactive">select</option> -->
                                <option value="Active" <?php echo $site['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                                <option value="Deactivate" <?php echo $site['status'] == 'Deactivate' ? 'selected' : ''; ?>>Deactivate</option>
                            </select>
                        </div>
                        <!-- <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">delete</button> -->

                        <!-- <button type="submit" name="action" value="save" class="btn btn-primary">Save changes</button> -->
                        <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
                    </form>
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
    
  <a href='dashboard.php?host' class='btn btn-primary'> See Here </a>
  </center><br>";
}

        ?>
      </tbody>
    </table>
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