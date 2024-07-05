
<?php
  $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
  $query = mysqli_query($conn, "SELECT * FROM `user` INNER JOIN `center` ON `user`.`center_id` = `center`.`center_id` WHERE `user_token`='$userToken'");
  if(mysqli_num_rows($query)>0){
    $rows = mysqli_fetch_assoc($query);
    $userId = $rows['user_id'];?>  

    <nav class="bg-success py-3 vh-100 w-25 overflow-auto print-d-none position-sticky top-0">
      <?php
        if($rows['role'] !== "Super"){?>
          <h6 class="px-3 text-success opacity-75 text-uppercase text-center p-2 bg-white"><?php echo htmlspecialchars($rows['center_name'])?></h6>
          <h5 class="px-3 text-light opacity-75">Hi, <?php echo $rows['fullname']?></h5><?php
        }
      ?>
      <span class="px-3 text-light opacity-75">You're logged-in as an <?php echo $rows['role']?></span>
      <p class="mb-0 px-3 py-2 text-light fst-italic">Quick access</p>
      <a href="./add_patient.php" class="text-decoration-none <?php echo $rows['role'] === "Admin" || $rows['role'] === "Staff" ? "" : "d-none"?>">
        <div class="px-3 py-2 fs-5 shadow-sm d-flex align-items-center justify-content-start gap-1">
          <img src="../images/add.svg" alt="add" width="20" height="20" loading="lazy">
          <span class="text-light">Add patient</span>
        </div>
      </a>
      <a href="./add_health_center.php" class="text-decoration-none <?php echo $rows['role'] === "Super" ? "" : "d-none"?>">
        <div class="px-3 py-2 fs-5 shadow-sm d-flex align-items-center justify-content-start gap-1">
          <img src="../images/add.svg" alt="add" width="20" height="20" loading="lazy">
          <span class="text-light">Add health center</span>
        </div>
      </a>
      <a href="./add_account.php" class="text-decoration-none <?php echo $rows['role'] === "Super" || $rows['role'] === "Admin" ? "" : "d-none"?>">
        <div class="px-3 py-2 fs-5 shadow-sm d-flex align-items-center justify-content-start gap-1">
          <img src="../images/add.svg" alt="add" width="20" height="20" loading="lazy">
          <span class="text-light">Add account</span>
        </div>
      </a>
      <p class="mb-0 px-3 py-2 text-light fst-italic">Modules</p>
      <a href="./" class="text-decoration-none">
        <div class="px-3 py-2 fs-5 shadow-sm d-flex align-items-center justify-content-start gap-1">
          <img src="../images/dashboard.svg" alt="dashboard" width="20" height="20" loading="lazy">
          <span class="text-light">Dashboard</span>
        </div>
      </a>
      <a href="./health_centers.php" class="text-decoration-none <?php echo $rows['role'] === "Super"? "" : "d-none"?>">
        <div class="px-3 py-2 fs-5 shadow-sm d-flex align-items-center justify-content-start gap-1">
          <img src="../images/center.svg" alt="center" width="20" height="20" loading="lazy">
          <span class="text-light">Health centers</span>
        </div>
      </a>
      <a href="./appointments.php" class="text-decoration-none <?php echo $rows['role'] === "Admin" || $rows['role'] === "Staff"? "" : "d-none"?>">
        <div class="px-3 py-2 fs-5 shadow-sm d-flex align-items-center justify-content-start gap-1">
          <img src="../images/pen.svg" alt="center" width="20" height="20" loading="lazy">
          <span class="text-light">Appointments</span>
        </div>
      </a>
      <a href="./requests.php" class="text-decoration-none <?php echo $rows['role'] === "Admin" || $rows['role'] === "Staff" ? "" : "d-none"?>">
        <div class="px-3 py-2 fs-5 shadow-sm d-flex align-items-center justify-content-start gap-1">
          <img src="../images/bell.svg" alt="icon" width="20" height="20" loading="lazy">
          <span class="text-light">Requests</span>
          <div class="bg-danger rounded badge">
            <?php
              $receiveTotal = intval(mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `request` WHERE `receiver_id`=$userId AND `see_receiver`='false'"))[0]);
              $sendTotal = intval(mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `request` WHERE `sender_id`=$userId AND `see_sender`='false'"))[0]);

              $total = $receiveTotal + $sendTotal;
              echo $total > 9 ? "9+" : $total;
            ?>
          </div>
        </div>
      </a>
      <a href="./patients.php" class="text-decoration-none <?php echo $rows['role'] === "Admin" || $rows['role'] === "Staff" ? "" : "d-none"?>">
        <div class="px-3 py-2 fs-5 shadow-sm d-flex align-items-center justify-content-start gap-1">
          <img src="../images/patient.svg" alt="patient" width="20" height="20" loading="lazy">
          <span class="text-light">Patients</span>
        </div>
      </a>
      <a href="./report.php" class="text-decoration-none <?php echo $rows['role'] === "Admin" || $rows['role'] === "Staff" ? "" : "d-none"?>">
        <div class="px-3 py-2 fs-5 shadow-sm d-flex align-items-center justify-content-start gap-1">
          <img src="../images/report.svg" alt="report" width="20" height="20" loading="lazy">
          <span class="text-light">Report</span>
        </div>
      </a>
      <a href="./accounts.php" class="text-decoration-none <?php echo $rows['role'] === "Super" || $rows['role'] === "Admin" ? "" : "d-none"?>">
        <div class="px-3 py-2 fs-5 shadow-sm d-flex align-items-center justify-content-start gap-1">
          <img src="../images/account.svg" alt="account" width="20" height="20" loading="lazy">
          <span class="text-light">Accounts</span>
        </div>
      </a>
      <a href="../terms_and_conditions.php" class="text-decoration-none">
        <div class="px-3 py-2 fs-5 shadow-sm d-flex align-items-center justify-content-start gap-1">
          <img src="../images/about.svg" alt="about" width="20" height="20" loading="lazy">
          <span class="text-light">Terms & Conditions</span>
        </div>
      </a>

      <footer class="p-3 text-light opacity-75">
        mrms &copy; 2024.
      </footer>
    </nav><?php
  }
?>