<?php
  $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
  $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
  if(mysqli_num_rows($query)>0){
    $rows = mysqli_fetch_assoc($query);
    $centerId = $rows['center_id'];?>  
    <div class="w-75 p-3">
      <header class="d-flex align-items-center justify-content-between mb-1">
        <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
        <h2 class="text-success">Dashboard</h2>
      </header>

      <section class="d-flex align-items-start justify-content-start gap-2 flex-wrap">
        <?php
          // Super
          if($rows['role'] === "Super"){?>
            <div href="./health_centers.php" class="text-decoration-none">
              <div class="bg-success p-3 rounded" style="min-width: 15rem;">
                <header class="d-flex align-items-center justify-content-center gap-2">
                  <img src="../images/center.svg" alt="icon" width="30" height="30" loading="lazy">
                  <h3 class="mb-0 text-light"><?php echo mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `center` WHERE NOT `center_id`=1"))[0]?></h3>
                </header>
                <section class="text-start">
                  <p class="mb-0 text-light">Health Centers</p>
                </section>
              </div>
            </div>
            <div href="./accounts.php" class="text-decoration-none">
              <div class="bg-success p-3 rounded" style="min-width: 15rem;">
                <header class="d-flex align-items-center justify-content-center gap-2">
                  <img src="../images/account.svg" alt="icon" width="30" height="30" loading="lazy">
                  <h3 class="mb-0 text-light"><?php echo mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `user`"))[0]?></h3>
                </header>
                <section class="text-start">
                  <p class="mb-0 text-light">Accounts</p>
                </section>
              </div>
            </div><?php
          }
          // Admin
          elseif($rows['role'] === "Admin"){?>
            <div href="./patients.php" class="text-decoration-none">
              <div class="bg-success p-3 rounded" style="min-width: 15rem;">
                <header class="d-flex align-items-center justify-content-center gap-2">
                  <img src="../images/patient.svg" alt="icon" width="30" height="30" loading="lazy">
                  <h3 class="mb-0 text-light"><?php echo mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `patient` WHERE `center_id`=$centerId"))[0]?></h3>
                </header>
                <section class="text-start">
                  <p class="mb-0 text-light">Patients</p>
                </section>
              </div>
            </div>
            <div href="./prenatal.php" class="text-decoration-none">
              <div class="bg-success p-3 rounded" style="min-width: 15rem;">
                <header class="d-flex align-items-center justify-content-center gap-2">
                  <img src="../images/prenatal.svg" alt="icon" width="30" height="30" loading="lazy">
                  <h3 class="mb-0 text-light"><?php echo mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `maternal` WHERE `center_id`=$centerId"))[0]?></h3>
                </header>
                <section class="text-start">
                  <p class="mb-0 text-light">Prenatal</p>
                </section>
              </div>
            </div>
            <div href="./babies.php" class="text-decoration-none">
              <div class="bg-success p-3 rounded" style="min-width: 15rem;">
                <header class="d-flex align-items-center justify-content-center gap-2">
                  <img src="../images/baby.svg" alt="icon" width="30" height="30" loading="lazy">
                  <h3 class="mb-0 text-light"><?php echo mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `baby` WHERE `center_id`=$centerId"))[0]?></h3>
                </header>
                <section class="text-start">
                  <p class="mb-0 text-light">Babies</p>
                </section>
              </div>
            </div>
            <div href="./accounts.php" class="text-decoration-none">
              <div class="bg-success p-3 rounded" style="min-width: 15rem;">
                <header class="d-flex align-items-center justify-content-center gap-2">
                  <img src="../images/account.svg" alt="icon" width="30" height="30" loading="lazy">
                  <h3 class="mb-0 text-light"><?php echo mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `user` WHERE `center_id`=$centerId"))[0]?></h3>
                </header>
                <section class="text-start">
                  <p class="mb-0 text-light">Accounts</p>
                </section>
              </div>
            </div><?php
          }
          // Staff
          elseif($rows['role'] === "Staff"){?>
            <div href="./patients.php" class="text-decoration-none">
              <div class="bg-success p-3 rounded" style="min-width: 15rem;">
                <header class="d-flex align-items-center justify-content-center gap-2">
                  <img src="../images/patient.svg" alt="icon" width="30" height="30" loading="lazy">
                  <h3 class="mb-0 text-light"><?php echo mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `patient` WHERE `center_id`=$centerId"))[0]?></h3>
                </header>
                <section class="text-start">
                  <p class="mb-0 text-light">Patients</p>
                </section>
              </div>
            </div>
            <div href="./prenatal.php" class="text-decoration-none">
              <div class="bg-success p-3 rounded" style="min-width: 15rem;">
                <header class="d-flex align-items-center justify-content-center gap-2">
                  <img src="../images/prenatal.svg" alt="icon" width="30" height="30" loading="lazy">
                  <h3 class="mb-0 text-light"><?php echo mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `maternal` WHERE `center_id`=$centerId"))[0]?></h3>
                </header>
                <section class="text-start">
                  <p class="mb-0 text-light">Prenatal</p>
                </section>
              </div>
            </div>
            <div href="./babies.php" class="text-decoration-none">
              <div class="bg-success p-3 rounded" style="min-width: 15rem;">
                <header class="d-flex align-items-center justify-content-center gap-2">
                  <img src="../images/baby.svg" alt="icon" width="30" height="30" loading="lazy">
                  <h3 class="mb-0 text-light"><?php echo mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `baby` WHERE `center_id`=$centerId"))[0]?></h3>
                </header>
                <section class="text-start">
                  <p class="mb-0 text-light">Babies</p>
                </section>
              </div>
            </div><?php
          }
        ?>
      </section>
    </div><?php
  }
?>