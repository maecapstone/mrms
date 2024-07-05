<?php include("../php/super_cookie.php")?>
<!DOCTYPE html>
  <html lang="en">
  <?php include("../php/head.php")?>
  <body>
    <?php include("../php/top_navigation.php")?>

    <section class="d-flex align-items-start justify-content-start flex-nowrap">
      <?php include("../php/left_navigation.php")?>
      
      <div class="w-75 p-3">
        <header class="d-flex align-items-center justify-content-between mb-1">
          <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
          <h2 class="text-success">Add health center</h2>
        </header>

        <form class="d-flex align-items-start justify-content-start gap-3 flex-wrap" autocomplete="off" id="addCenterForm">
          <div class="w-100">
            <label class="form-label">Health Center Name</label>
            <input type="text" class="form-control" name="addCenter[]" placeholder="Enter the name of health center..." required>
          </div>
          <div class="w-100 text-end">
            <button type="submit" class="btn btn-success">Add</button>
          </div>
        </form>
      </div>
    </section>
  </body>
</html>