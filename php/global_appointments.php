<div class="w-75 p-3">
  <header class="d-flex align-items-center justify-content-between mb-1">
    <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
    <h2 class="text-success">Appointments</h2>
  </header>

  <?php
    $appoint = isset($_GET['appoint']) ? $_GET['appoint'] : date("Y-m-d");
  ?>

  <form class="d-flex align-items-center justify-content-center gap-2 flex-nowrap mt-3">
    <label class="form-label mb-0">Date</label>
    <input type="date" class="form-control" name="appoint" required value="<?php echo $appoint?>">
    <button type="submit" class="btn btn-success">Find</button>
  </form>

  <?php
    $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      $centerId = $rows['center_id'];
      $userId = $rows['user_id'];?>

      <section class="mt-3 d-flex align-items-start justify-content-start gap-3 flex-column">
        <div class="shadow p-3 rounded w-100">
          <h6>First Trimester</h6>
          <table class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Appointment_date</th>
                <th>Patient_name</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = mysqli_query($conn, "SELECT * FROM `first_trimester` INNER JOIN `maternal` ON `first_trimester`.`maternal_id` = `maternal`.`maternal_id` INNER JOIN `patient` ON `maternal`.`patient_id` = `patient`.`patient_id` WHERE `maternal`.`center_id`=$centerId AND `first_trimester`.`date_return`='$appoint' ORDER BY `patient`.`first_name` ASC");
                if(mysqli_num_rows($query)>0){
                  $index = 1;
                  while($rows = mysqli_fetch_assoc($query)){?>
                    <tr>
                      <td><?php echo $index++?></td>
                      <td><?php echo htmlspecialchars($rows['date_return'])?></td>
                      <td><?php echo htmlspecialchars($rows['first_name'] . ' ' . $rows['last_name'])?></td>
                    </tr><?php
                  }
                }
                else{?>
                  <tr><td colspan="3">No appointments scheduled.</td></tr><?php
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="shadow p-3 rounded w-100">
          <h6>Second Trimester</h6>
          <table class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Appointment_date</th>
                <th>Patient_name</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = mysqli_query($conn, "SELECT * FROM `second_trimester` INNER JOIN `maternal` ON `second_trimester`.`maternal_id` = `maternal`.`maternal_id` INNER JOIN `patient` ON `maternal`.`patient_id` = `patient`.`patient_id` WHERE `maternal`.`center_id`=$centerId AND `second_trimester`.`date_return`='$appoint' ORDER BY `patient`.`first_name` ASC");
                if(mysqli_num_rows($query)>0){
                  $index = 1;
                  while($rows = mysqli_fetch_assoc($query)){?>
                    <tr>
                      <td><?php echo $index++?></td>
                      <td><?php echo htmlspecialchars($rows['date_return'])?></td>
                      <td><?php echo htmlspecialchars($rows['first_name'] . ' ' . $rows['last_name'])?></td>
                    </tr><?php
                  }
                }
                else{?>
                  <tr><td colspan="3">No appointments scheduled.</td></tr><?php
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="shadow p-3 rounded w-100">
          <h6>Last Trimester</h6>
          <table class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Appointment_date</th>
                <th>Patient_name</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = mysqli_query($conn, "SELECT * FROM `last_trimester` INNER JOIN `maternal` ON `last_trimester`.`maternal_id` = `maternal`.`maternal_id` INNER JOIN `patient` ON `maternal`.`patient_id` = `patient`.`patient_id` WHERE `maternal`.`center_id`=$centerId AND `last_trimester`.`date_return`='$appoint' ORDER BY `patient`.`first_name` ASC");
                if(mysqli_num_rows($query)>0){
                  $index = 1;
                  while($rows = mysqli_fetch_assoc($query)){?>
                    <tr>
                      <td><?php echo $index++?></td>
                      <td><?php echo htmlspecialchars($rows['date_return'])?></td>
                      <td><?php echo htmlspecialchars($rows['first_name'] . ' ' . $rows['last_name'])?></td>
                    </tr><?php
                  }
                }
                else{?>
                  <tr><td colspan="3">No appointments scheduled.</td></tr><?php
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="shadow p-3 rounded w-100">
          <h6>Patient Immunization</h6>
          <table class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Appointment_date</th>
                <th>Patient_name</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = mysqli_query($conn, "SELECT * FROM `patient_imm` INNER JOIN `maternal` ON `patient_imm`.`maternal_id` = `maternal`.`maternal_id` INNER JOIN `patient` ON `maternal`.`patient_id` = `patient`.`patient_id` WHERE `maternal`.`center_id`=$centerId AND `patient_imm`.`when_return`='$appoint' ORDER BY `patient`.`first_name` ASC");
                if(mysqli_num_rows($query)>0){
                  $index = 1;
                  while($rows = mysqli_fetch_assoc($query)){?>
                    <tr>
                      <td><?php echo $index++?></td>
                      <td><?php echo htmlspecialchars($rows['when_return'])?></td>
                      <td><?php echo htmlspecialchars($rows['first_name'] . ' ' . $rows['last_name'])?></td>
                    </tr><?php
                  }
                }
                else{?>
                  <tr><td colspan="3">No appointments scheduled.</td></tr><?php
                }
              ?>
            </tbody>
          </table>
        </div>
        <div class="shadow p-3 rounded w-100">
          <h6>Baby Immunization</h6>
          <table class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Appointment_date</th>
                <th>Patient_name</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $query = mysqli_query($conn, "SELECT * FROM `baby_imm` INNER JOIN `baby` ON `baby_imm`.`baby_id` = `baby`.`baby_id` INNER JOIN `patient` ON `baby`.`patient_id` = `patient`.`patient_id` WHERE `baby`.`center_id`=$centerId AND `baby_imm`.`when_return`='$appoint' ORDER BY `patient`.`first_name` ASC");
                if(mysqli_num_rows($query)>0){
                  $index = 1;
                  while($rows = mysqli_fetch_assoc($query)){?>
                    <tr>
                      <td><?php echo $index++?></td>
                      <td><?php echo htmlspecialchars($rows['when_return'])?></td>
                      <td><?php echo htmlspecialchars($rows['first_name'] . ' ' . $rows['last_name'])?></td>
                    </tr><?php
                  }
                }
                else{?>
                  <tr><td colspan="3">No appointments scheduled.</td></tr><?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </section><?php
    }
  ?>
</div>
