<div class="w-75 p-3">
  <header class="d-flex align-items-center justify-content-between mb-1">
    <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
    <h2 class="text-success">Requests</h2>
  </header>

  <?php
    $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      $centerId = $rows['center_id'];
      $userId = $rows['user_id'];
      $role = $rows['role'];?>

      <section class="mt-3 d-flex align-items-start justify-content-between gap-3">
        <aside class="rounded p-3 shadow-sm <?php echo $role === "Admin" ? "w-50" : "w-100"?>">
          <h6>Your requests</h6>
          <table class="table">
            <thead>
              <tr>
                <th>Action</th>
                <th>When</th>
                <th>Description</th>
                <th>Allowed</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query1 = mysqli_query($conn, "SELECT * FROM `request` INNER JOIN `patient` ON `request`.`patient_id` = `patient`.`patient_id` INNER JOIN `center` ON `request`.`center_id`= `center`.`center_id` WHERE `request`.`sender_id`=$userId ORDER BY `datetime` DESC");
                if(mysqli_num_rows($query1)>0){
                  while($rows1 = mysqli_fetch_assoc($query1)){?>
                    <tr>
                      <td>
                        <button type="button" class="btn btn-success request-read" id="requestRead<?php echo $rows1['request_id']?>" <?php echo $rows1['see_sender'] === "true" ? "disabled" : "false"?> data-id="<?php echo $rows1['request_id']?>">Read</button>
                      </td>
                      <td><?php echo htmlspecialchars($rows1['datetime'])?></td>
                      <td><?php echo "You are requesting to access patient ".$rows1['first_name'] . ' ' . $rows1['last_name']." from ".$rows1['center_name']?></td>
                      <td><?php echo htmlspecialchars($rows1['allowed'])?></td>
                    </tr><?php
                  }
                }
                else{?>
                  <tr>
                    <td colspan="4">No requests</td>
                  </tr><?php
                }
              ?>
            </tbody>
          </table>
        </aside>

        <?php 
          if($role === "Admin"){?>
            <aside class="rounded p-3 shadow-sm w-50">
              <h6>Other requests</h6>
              <table class="table">
                <thead>
                  <tr>
                    <th>Action</th>
                    <th>When</th>
                    <th>Description</th>
                    <th>Allowed</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $query1 = mysqli_query($conn, "SELECT * FROM `request` INNER JOIN `patient` ON `request`.`patient_id` = `patient`.`patient_id` INNER JOIN `center` ON `request`.`center_id`= `center`.`center_id` INNER JOIN `user` ON `request`.`sender_id` = `user`.`user_id` WHERE `request`.`receiver_id`=$userId ORDER BY `datetime` DESC");
                    if(mysqli_num_rows($query1)>0){
                      while($rows1 = mysqli_fetch_assoc($query1)){?>
                        <tr>
                          <td>
                            <?php
                              if($rows1['allowed'] === "false"){?>
                                <button type="button" class="btn btn-success request-accept" id="requestAccept<?php echo $rows1['request_id']?>" data-id="<?php echo $rows1['request_id']?>">Accept</button><?php
                              }
                              else{?>
                                <button type="button" class="btn btn-danger request-decline" id="requestDecline<?php echo $rows1['request_id']?>" data-id="<?php echo $rows1['request_id']?>">Decline</button><?php
                              }
                            ?>
                          </td>
                          <td><?php echo htmlspecialchars($rows1['datetime'])?></td>
                          <td><?php echo $rows1['fullname']." requesting to access patient ".$rows1['first_name'] . ' ' . $rows1['last_name']?></td>
                          <td><?php echo htmlspecialchars($rows1['allowed'])?></td>
                        </tr><?php
                      }
                    }
                    else{?>
                      <tr>
                        <td colspan="4">No requests</td>
                      </tr><?php
                    }
                  ?>
                </tbody>
              </table>
            </aside><?php
          }
        ?>
      </section><?php
    }
  ?>
</div>