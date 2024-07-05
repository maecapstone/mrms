<header class="bg-white p-3 d-flex align-items-center justify-content-between gap-2 shadow position-sticky top-0 print-d-none" style="z-index: 50;">
  <aside class="d-flex align-items-center justify-content-start gap-2">
    <img src="../images/logo.svg" alt="logo" width="50" height="50" loading="lazy" class="rounded-circle">
    <h4 class="mb-0 text-success">Maternal Record Management System</h4>
  </aside>
  <aside>
    <div class="dropdown">
      <a href="#" class="text-decoration-none text-dark dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <span class="fw-bold fs-3 text-uppercase text-success">
          <?php
            $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
            $query = mysqli_query($conn, "SELECT `fullname` FROM `user` WHERE `user_token`='$userToken'");
            if(mysqli_num_rows($query)>0){
              $rows = mysqli_fetch_row($query);
              echo substr($rows[0], 0, 1);
            }
          ?>
        </span>
      </a>

      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="../php/logout.php">Log out</a></li>
      </ul>
    </div>
    
  </aside>
</header>