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
          <h2 class="text-success">Health centers</h2>
        </header>

        <?php
          $q = mysqli_real_escape_string($conn, isset($_GET['q']) ? $_GET['q'] : '');
        ?>
        <form autocomplete="off" class="my-2">
          <input type="search" name="q" class="form-control" placeholder="Search Name..." value="<?php echo $q?>">
        </form>
        <table class="table">
          <thead>
            <tr>
              <th>Action</th>
              <th>No.</th>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
            <?php              
              $query = mysqli_query($conn, "SELECT * FROM `center` WHERE NOT `center_id`=1 AND center_name LIKE '%$q%' ORDER BY `center_name` ASC");
              $index = 1;
              if(mysqli_num_rows($query)>0){
                while($rows = mysqli_fetch_assoc($query)){?>
                  <tr>
                    <td>
                      <div>
                        <button type="button" class="btn btn-success edit-center" data-id="<?php echo $rows['center_id']?>" data-bs-toggle="modal" data-bs-target='#editCenterModal'>Edit</button>
                      </div>
                    </td>
                    <td><?php echo $index++?></td>
                    <td><?php echo htmlspecialchars($rows['center_name'])?></td>
                  </tr><?php
                }
              }
              else{?>
                <tr><td colspan="3">No results</td></tr><?php
              }
            ?>            
          </tbody>
        </table>
      </div>
    </section>

    <!-- update health center -->
    <div class="modal fade" id="editCenterModal" tabindex="-1" aria-labelledby="editCenterModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editCenterModalLabel">Edit</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="editCenterModalButtonClose"></button>
          </div>

          <form class="modal-body d-flex align-items-start justify-content-start gap-3 flex-wrap" autocomplete="off" id="editCenterForm">
            <!-- ... -->
          </form>
        </div>
      </div>
    </div>
  </body>
</html>