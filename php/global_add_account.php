<div class="w-75 p-3">
  <header class="d-flex align-items-center justify-content-between mb-1">
    <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
    <h2 class="text-success">Add account</h2>
  </header>

  <form class="d-flex align-items-start justify-content-start gap-3 flex-wrap" autocomplete="off" id="addAccountForm">
    <?php
      $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
      $query1 = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
      if(mysqli_num_rows($query1)>0){
        $rows1 = mysqli_fetch_assoc($query1);
        $centerId = $rows1['center_id'];

        //Super
        if($rows1['role'] === "Super"){?>
          <div class="w-100">
            <label class="form-label">Health Center</label>
            <select class="form-select" name="addAccount[]" placeholder="..." required>
              <option value="">Select...</option>
              <?php
                $query = mysqli_query($conn, "SELECT * FROM `center` WHERE NOT `center_id`=1 ORDER BY `center_name` ASC");
                if(mysqli_num_rows($query)>0){
                  while($rows = mysqli_fetch_assoc($query)){?>
                    <option value="<?php echo htmlspecialchars($rows['center_name'])?>"><?php echo htmlspecialchars($rows['center_name'])?></option><?php
                  }
                }
              ?>        
            </select>
          </div><?php
        }

        //Admin
        else{?>
          <div class="w-100">
            <label class="form-label">Health Center</label>
            <select class="form-select" name="addAccount[]" placeholder="..." required>
              <?php
                $query = mysqli_query($conn, "SELECT * FROM `center` WHERE `center_id`=$centerId");
                if(mysqli_num_rows($query)>0){
                  $rows = mysqli_fetch_assoc($query);?>
                  <option value="<?php echo htmlspecialchars($rows['center_name'])?>"><?php echo htmlspecialchars($rows['center_name'])?></option><?php
                }
              ?>        
            </select>
          </div><?php
        }
      }
    ?>
    <div class="w-100">
      <label class="form-label">Username</label>
      <input type="text" class="form-control" name="addAccount[]" placeholder="..." required>
    </div>
    <div class="w-100">
      <label class="form-label">Password</label>
      <input type="password" class="form-control" name="addAccount[]" id="addAccountPassword" placeholder="..." required>
    </div>
    <div class="w-100">
      <label class="form-label">Confirm password</label>
      <input type="password" class="form-control" placeholder="..." id="addAccountConfirmPassword" required>
    </div>
    <div class="w-100">
      <label class="form-label">Fullname</label>
      <input type="text" class="form-control" name="addAccount[]" placeholder="..." required>
    </div>
    <div class="w-100">
      <label class="form-label">Email (optional)</label>
      <input type="email" class="form-control" name="addAccount[]" placeholder="...">
    </div>
    <div class="w-100">
      <label class="form-label">Contact no.</label>
      <input type="number" class="form-control" name="addAccount[]" placeholder="..." required>
    </div>
    <div class="w-100">
      <label class="form-label">Role</label>
      <select class="form-select" name="addAccount[]" placeholder="..." required>
        <?php
          $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
          $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
          if(mysqli_num_rows($query)>0){
            $rows = mysqli_fetch_assoc($query);
            if($rows['role'] === "Super"){?>
              <option value="Admin" selected>Admin</option><?php
            }
            else{?>
              <option value="Staff" selected>Staff</option><?php
            }
          }
        ?>       
      </select>
    </div>
    <div class="w-100">
      <label class="form-label">Role description</label>
      <input type="text" class="form-control" name="addAccount[]" placeholder="..." required>
    </div>
    <div class="w-100 text-end">
      <button type="submit" class="btn btn-success">Add</button>
    </div>
  </form>
</div>