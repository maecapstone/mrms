<div class="w-75 p-3">
  <header class="d-flex align-items-center justify-content-between mb-1">
    <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
    <h2 class="text-success">Accounts</h2>
  </header>

  <?php
    $q = mysqli_real_escape_string($conn, isset($_GET['q']) ? $_GET['q'] : '');
  ?>
  <form autocomplete="off" class="my-2">
    <input type="search" name="q" class="form-control" placeholder="Search Fullname..." value="<?php echo $q?>">
  </form>
  
  <div class="overflow-auto">
    <table class="table">
      <thead>
        <tr>
          <th>Action</th>
          <th>No.</th>
          <th>Username</th>
          <th>Password</th>
          <th>Fullname</th>
          <th>Email</th>
          <th>Contact_no.</th>
          <th>Role</th>
          <th>Role_description</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
          $query1 = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
          if(mysqli_num_rows($query1)>0){
            $rows1 = mysqli_fetch_assoc($query1);
            $centerId = $rows1['center_id'];

            if($rows1['role'] === "Super")
              $sql = "SELECT * FROM `user` WHERE `fullname` LIKE '%$q%' ORDER BY `fullname` ASC";
            else
              $sql = "SELECT * FROM `user` WHERE `center_id`=$centerId AND `fullname` LIKE '%$q%' ORDER BY `fullname` ASC";

            $query = mysqli_query($conn, $sql);
            $index = 1;
            if(mysqli_num_rows($query)>0){
              while($rows = mysqli_fetch_assoc($query)){?>
                <tr>
                  <td>
                    <div>
                      <button type="button" class="btn btn-success edit-account" data-id="<?php echo $rows['user_id']?>" data-bs-toggle="modal" data-bs-target='#editAccountModal'>Edit</button>
                    </div>
                  </td>
                  <td><?php echo $index++?></td>
                  <td><?php echo htmlspecialchars($rows['username'])?></td>
                  <td><?php echo htmlspecialchars($rows['password'])?></td>
                  <td><?php echo htmlspecialchars($rows['fullname'])?></td>
                  <td><?php echo htmlspecialchars($rows['email'])?></td>
                  <td><?php echo htmlspecialchars($rows['contact'])?></td>
                  <td><?php echo htmlspecialchars($rows['role'])?></td>
                  <td><?php echo htmlspecialchars($rows['role_desc'])?></td>
                </tr><?php
              }
            }
            else{?>
              <tr><td colspan="9">No results</td></tr><?php
            }
          }
        ?>            
      </tbody>
    </table>
  </div>
</div>

<!-- edit account -->
<div class="modal fade" id="editAccountModal" tabindex="-1" aria-labelledby="editAccountModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editAccountModalLabel">Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="editAccountModalButtonClose"></button>
      </div>

      <form class="modal-body d-flex align-items-start justify-content-start gap-3 flex-wrap" autocomplete="off" id="editAccountForm">
        <!-- ... -->
      </form>
    </div>
  </div>
</div>