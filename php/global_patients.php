<div class="<?php echo isset($_GET['view']) ? "w-100" : "w-75"?> p-3 print-w-100">
  <?php
    $q = mysqli_real_escape_string($conn, isset($_GET['q']) ? $_GET['q'] : '');

    // qrcode
    if(isset($_GET['code'])){?>
      <header class="d-flex align-items-center justify-content-between">
        <button type="button" id="backButton" class="btn btn-ligh print-d-none"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
        <button type="button" class="btn btn-success d-flex align-items-center justify-content-center gap-2 print-d-none" id="printQR"><img src="../images/print.svg" alt="icon" width="20" height="20" loading="lazy"><span>Print</span></button>
      </header><?php

      $code = mysqli_real_escape_string($conn, isset($_GET['code']) ? $_GET['code'] : "");
      $query = mysqli_query($conn, "SELECT * FROM `patient` WHERE `patient_code`=$code");
      if(mysqli_num_rows($query)>0){
        $rows = mysqli_fetch_assoc($query);
        $fullname = $rows['first_name'] . (empty($rows['middle_name']) ? " " : " " . $rows['middle_name']) . " " . $rows['last_name'];

        // generate QR
        $PNG_TEMP_DIR = '../qrcode/';
        if(!file_exists($PNG_TEMP_DIR))
          mkdir($PNG_TEMP_DIR);
        $filename = $PNG_TEMP_DIR . sha1($code) . ".png"; 
        QRcode::png($code, $filename);?>
        <h6 class="mt-3">Reminder:</h6>
        <p class="fst-italic text-dark" style="text-indent: .5in;">Always bring this document when you have transactions at the Health Center. You can have your prenatal checkup at any Health Center provided below. Lastly, you don't need to request medical records; just visit the provided link and find QRCODE icon then click it.</p>
        <h6>Health Centers</h6>
        <ul>
          <?php 
            $query = mysqli_query($conn, "SELECT * FROM `center` WHERE NOT `center_id`=1 ORDER BY `center_name` ASC");
            if(mysqli_num_rows($query)>0){
              while($rows = mysqli_fetch_assoc($query)){?>
                <li><?php echo htmlspecialchars($rows['center_name'])?></li><?php
              }
            }
          ?>          
        </ul>
        <div class="d-flex align-items-center justify-content-center gap-2 shadow-sm p-2 border border-success">
          <div class="d-flex align-items-center justify-content-center flex-column gap-1">
            <img src="../qrcode/<?php echo $filename?>" alt="icon" width="100" height="100" loading="lazy" class="border">
            <strong><?php echo $code?></strong>
          </div>
          <div>
            <h5 class="text-success">Maternal Record Management System</h5>
            <strong><?php echo $fullname?></strong>
            <p class="mb-0">visit: <span class="text-decoration-underline fw-bold"><?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME']?></span></p>
          </div>          
        </div><?php
      }
    }

    // prenatal
    elseif(isset($_GET['prenatal'])){
      $patientId = $_GET['prenatal'];?>
      <header class="d-flex align-items-center justify-content-between">
        <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
        <h2 class="text-success">Prenatal</h2>
      </header>

      <div class="my-2 d-flex align-items-center justify-content-between">
        <div>
          <h3 class="mb-0">
            <?php
              $query = mysqli_query($conn, "SELECT * FROM `patient` WHERE `patient_id`=$patientId");
              if(mysqli_num_rows($query)>0){
                $rows = mysqli_fetch_assoc($query);
                $patientName = $rows['first_name'] . " " . (empty($rows['middle_name']) ? "" : $rows['middle_name'] . " ") . $rows['last_name'];
                echo $patientName;

                $_SESSION['PATIENT_NAME'] = $patientName;
              }
            ?>
          </h3>
        </div>
        <div class="<?php echo isset($_GET['view']) ? "d-none" : ""?>">
          <button type="button" class="btn btn-success d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#addFirstCheckupModal" id="ddFirstCheckupButton" data-id="<?php echo $patientId?>"><img src="../images/add.svg" alt="icon" width="20" height="20" loading="lazy"><span>First checkup</span></button>
        </div>
      </div>
      
      <div class="overflow-auto" style="min-height: 20rem;">
        <table class="table">
          <thead>
            <tr>
              <th>Action</th>
              <th>Pregnancy_No.</th>
              <th>Status</th>
              <th>Died</th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = mysqli_query($conn, "SELECT * FROM `maternal` WHERE `patient_id`=$patientId ORDER BY `maternal_id` ASC");
              $index = 1;
              if(mysqli_num_rows($query)>0){
                while($rows = mysqli_fetch_assoc($query)){?>
                  <tr>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Modules
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item view-first-checkup" href="#" data-bs-toggle="modal" data-bs-target="#viewFirstCheckupModal" data-id="<?php echo $rows['maternal_id']?>">First checkup</a></li>
                          <li><a class="dropdown-item" href="?trimesters=<?php echo $rows['maternal_id']?><?php echo isset($_GET['view']) ? "&view" : ""?>">Trimesters</a></li>
                          <li><a class="dropdown-item" href="?babies=<?php echo $rows['maternal_id']?><?php echo isset($_GET['view']) ? "&view" : ""?>">Babies</a></li>
                          <li><a class="dropdown-item" href="?p_im=<?php echo $rows['maternal_id']?><?php echo isset($_GET['view']) ? "&view" : ""?>">Immunization</a></li>
                        </ul>
                      </div>
                    </td>
                    <td><?php echo $index++?></td>
                    <td class="<?php echo $rows['patient_status'] === "Alive" ? "bg-success-subtle" : "bg-danger-subtle"?>"><?php echo htmlspecialchars($rows['patient_status'])?></td>
                    <td><?php echo htmlspecialchars($rows['datetime_died'])?></td>
                    <td><?php echo htmlspecialchars($rows['remarks'])?></td>
                  </tr>
                  <?php
                }
              }
              else{?>
                <tr><td colspan="5">No results</td></tr><?php
              }
            ?>            
          </tbody>
        </table>
      </div><?php
    }

    // trimesters
    elseif(isset($_GET['trimesters'])){
      $maternalId = $_GET['trimesters'];
      $_SESSION['MATERNAL_ID'] = $maternalId;?>
      <header class="d-flex align-items-center justify-content-between">
        <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
        <h2 class="text-success">Prenatal / Trimesters</h2>
      </header>
      
      <div class="my-2 d-flex align-items-center justify-content-between">
        <div>
          <h3 class="mb-0"><?php echo htmlspecialchars($_SESSION['PATIENT_NAME'])?></h3>
        </div>
        <div class="<?php echo isset($_GET['view']) ? "d-none" : ""?>">
          <button type="button" class="btn btn-success d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#addTrimesterModal" id="addTrimesterButton" data-id="<?php echo $maternalId?>"><img src="../images/add.svg" alt="icon" width="20" height="20" loading="lazy"><span>Trimester</span></button>
        </div>
      </div>

      <div class="overflow-auto mt-3">
        <h5>First Trimester</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Action</th>
              <th>Checkup_no.</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = mysqli_query($conn, "SELECT * FROM `first_trimester` WHERE `maternal_id`=$maternalId");
              $index = 1;
              if(mysqli_num_rows($query)>0){
                while($rows = mysqli_fetch_assoc($query)){?>
                  <tr>
                    <td>
                      <div>
                        <button type="button" class="btn btn-success view-trimester" data-bs-toggle="modal" data-bs-target="#viewTrimesterModal" data-trimester="First Trimester" data-id="<?php echo $rows['first_trimester_id']?>">View</button>
                      </div>
                    </td>
                    <td><?php echo $index++?></td>
                    <td><?php echo htmlspecialchars($rows['date'])?></td>
                  </tr><?php
                }
              }
              else{?>
                <tr><td colspan="3">No results</td></tr><?php
              }
            ?>      
          </tbody>
        </table>

        <h5>Second Trimester</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Action</th>
              <th>Checkup_no.</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = mysqli_query($conn, "SELECT * FROM `second_trimester` WHERE `maternal_id`=$maternalId");
              $index = 1;
              if(mysqli_num_rows($query)>0){
                while($rows = mysqli_fetch_assoc($query)){?>
                  <tr>
                    <td>
                      <div>
                        <button type="button" class="btn btn-success view-trimester" data-bs-toggle="modal" data-bs-target="#viewTrimesterModal" data-trimester="Second Trimester" data-id="<?php echo $rows['second_trimester_id']?>">View</button>
                      </div>
                    </td>
                    <td><?php echo $index++?></td>
                    <td><?php echo htmlspecialchars($rows['date'])?></td>
                  </tr><?php
                }
              }
              else{?>
                <tr><td colspan="3">No results</td></tr><?php
              }
            ?>      
          </tbody>
        </table>

        <h5>Last Trimester</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Action</th>
              <th>Checkup_no.</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = mysqli_query($conn, "SELECT * FROM `last_trimester` WHERE `maternal_id`=$maternalId");
              $index = 1;
              if(mysqli_num_rows($query)>0){
                while($rows = mysqli_fetch_assoc($query)){?>
                  <tr>
                    <td>
                      <div>
                        <button type="button" class="btn btn-success view-trimester" data-bs-toggle="modal" data-bs-target="#viewTrimesterModal" data-trimester="Last Trimester" data-id="<?php echo $rows['last_trimester_id']?>">View</button>
                      </div>
                    </td>
                    <td><?php echo $index++?></td>
                    <td><?php echo htmlspecialchars($rows['date'])?></td>
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
      <?php
    }

    // patient immunization
    elseif(isset($_GET['p_im'])){
      $maternalId = $_GET['p_im'];?>
      <header class="d-flex align-items-center justify-content-between">
        <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
        <h2 class="text-success">Prenatal / Immunization</h2>
      </header>

      <form autocomplete="off" id="patientImmForm" data-id="<?php echo $maternalId?>">
        <div class="my-2 d-flex align-items-center justify-content-between">
          <div>
            <h3 class="mb-0"><?php echo htmlspecialchars($_SESSION['PATIENT_NAME'])?></h3>
          </div>
          <div class="<?php echo isset($_GET['view']) ? "d-none" : ""?>">
            <button type="submit" class="btn btn-success" id="patientImmButton"><span>Update</span></button>
          </div>
        </div>
        
        <div class="overflow-auto" style="min-height: 20rem;">
          <table class="table">
            <thead>
              <tr>
                <th>Action</th>
                <th>Tetanus-containing Vaccine</th>
                <th>Date given</th>
                <th>When to Return (Next Dose)</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $doses = array("1st dose - as early as possible during pregnancy", "2nd dose - at least 4 weeks after dose 1", "3rd dose - at least 4 weeks after dose 2", "4th dose - at least 1 year after dose 3", "5th dose - at least 1 year after dose 4");

                $query = mysqli_query($conn, "SELECT * FROM `patient_imm` WHERE `maternal_id`=$maternalId ORDER BY `patient_imm_id` ASC");
                $index = 0;
                $count = 0;
                if(mysqli_num_rows($query)>0){
                  while($rows = mysqli_fetch_assoc($query)){?>
                    <tr>
                      <td>
                        <div>
                          <button type="button" class="btn btn-success patient-imm-managed" data-bs-toggle="modal" data-bs-target="#patientImmMangedByModal" data-id="<?php echo $rows['patient_imm_id']?>">Managed by</button>
                        </div>
                      </td>
                      <td><?php echo $doses[$index]?></td>
                      <td><input type="date" class="form-control" <?php echo empty($rows['date_given']) ? "" : "readonly"?> value="<?php echo $rows['date_given']?>"></td>
                      <td><input type="date" class="form-control" <?php echo empty($rows['when_return']) ? "" : "readonly"?> value="<?php echo $rows['when_return']?>"></td>
                    </tr><?php
                    $index++;
                    $count++;
                  }

                  for($i=$count; $i<5; $i++){?>
                    <tr>
                      <td>
                        <div>
                          <button type="button" class="btn btn-success" disabled>Managed by</button>
                        </div>
                      </td>
                      <td><?php echo $doses[$i]?></td>
                      <td><input type="date" class="form-control" name="patientImmGiven[]"></td>
                      <td><input type="date" class="form-control" name="patientImmReturn[]"></td>
                    </tr><?php
                  }
                }
                else{
                  foreach($doses as $dose){?>
                    <tr>
                      <td>
                        <div>
                          <button type="button" class="btn btn-success" disabled>Managed by</button>
                        </div>
                      </td>
                      <td><?php echo $dose?></td>
                      <td><input type="date" class="form-control" name="patientImmGiven[]"></td>
                      <td><input type="date" class="form-control" name="patientImmReturn[]"></td>
                    </tr><?php
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </form><?php
    }

    // babies
    elseif(isset($_GET['babies'])){
      $maternalId = $_GET['babies'];?>
      <header class="d-flex align-items-center justify-content-between">
        <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
        <h2 class="text-success">Prenatal / Babies</h2>
      </header>
      
      <div class="my-2 d-flex align-items-center justify-content-between">
        <div>
          <h3 class="mb-0"><?php echo htmlspecialchars($_SESSION['PATIENT_NAME'])?></h3>
        </div>
        <div>
          <button type="button" class="btn btn-success d-flex align-items-center justify-content-center gap-2 <?php echo mysqli_fetch_row(mysqli_query($conn, "SELECT * FROM `baby` WHERE `maternal_id`=$maternalId"))[0] == 0 ? "" : "d-none"?>" data-bs-toggle="modal" data-bs-target="#addBabyModal" id="addBabyModalButtonOpen" data-id="<?php echo $maternalId?>"><img src="../images/add.svg" alt="icon" width="20" height="20" loading="lazy"><span>Add</span></button>
        </div>
      </div>
      
      <div class="overflow-auto mt-3" style="min-height: 20rem;">
        <table class="table">
          <thead>
            <tr>
              <th>Action</th>
              <th>Order_birth</th>
              <th>Child_no.</th>
              <th>Type_of_Delivery</th>              
              <th>First_name</th>
              <th>Middle_name</th>
              <th>Last_name</th>
              <th>Extension_name</th>
              <th>Sex</th>
              <th>Date_of_Delivery</th>
              <th>Place_of_Birth</th>
              <th>Blood_type</th>
              <th>Weight</th>
              <th>Length/Height</th>
              <th>Circular_head_size</th>
              <th>Chest_circumference</th>
              <th>Status</th>
              <th>Died</th>          
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = mysqli_query($conn, "SELECT * FROM `baby` WHERE `maternal_id`=$maternalId");
              $index = 1;
              if(mysqli_num_rows($query)>0){
                while($rows = mysqli_fetch_assoc($query)){?>
                  <tr>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          Modules
                        </button>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="?b_im=<?php echo $rows['baby_id']?>&name=<?php echo $rows['first_name'] . ' ' . $rows['last_name']?><?php echo isset($_GET['view']) ? "&view" : ""?>">Immunization</a></li>
                          <li><a class="dropdown-item" href="?milestones=<?php echo $rows['baby_id']?>&name=<?php echo $rows['first_name'] . ' ' . $rows['last_name']?><?php echo isset($_GET['view']) ? "&view" : ""?>">Milestones</a></li>
                          <li><a class="dropdown-item" href="?metrics=<?php echo $rows['baby_id']?>&name=<?php echo $rows['first_name'] . ' ' . $rows['last_name']?><?php echo isset($_GET['view']) ? "&view" : ""?>">Metrics</a></li>
                          <li><a class="dropdown-item baby-father" href="#" data-id="<?php echo $rows['father_id']?>" data-bs-toggle="modal" data-bs-target="#fatherBabyModal">Father</a></li>
                          <li><a class="dropdown-item baby-managed-by" href="#" data-id="<?php echo $rows['history_id']?>" data-bs-toggle="modal" data-bs-target="#managedByBabyModal">Managed by</a></li>
                        </ul>
                      </div>
                    </td>
                    <td><?php echo $index++?></td>
                    <td><?php echo htmlspecialchars($rows['child_no'])?></td>
                    <td><?php echo htmlspecialchars($rows['type_delivery'])?></td>
                    <td><?php echo htmlspecialchars($rows['first_name'])?></td>
                    <td><?php echo htmlspecialchars($rows['middle_name'])?></td>
                    <td><?php echo htmlspecialchars($rows['last_name'])?></td>
                    <td><?php echo htmlspecialchars($rows['extension_name'])?></td>
                    <td><?php echo htmlspecialchars($rows['sex'])?></td>
                    <td><?php echo htmlspecialchars($rows['datetime_delivery'])?></td>
                    <td><?php echo htmlspecialchars($rows['place_birth'])?></td>
                    <td><?php echo htmlspecialchars($rows['blood_type'])?></td>
                    <td><?php echo htmlspecialchars($rows['weight'])?></td>
                    <td><?php echo htmlspecialchars($rows['length'])?></td>
                    <td><?php echo htmlspecialchars($rows['circular_head'])?></td>
                    <td><?php echo htmlspecialchars($rows['circular_chest'])?></td>
                    <td class="<?php echo $rows['baby_status'] === "Alive" ? "bg-success-subtle" : "bg-danger-subtle"?>"><?php echo htmlspecialchars($rows['baby_status'])?></td>
                    <td><?php echo htmlspecialchars($rows['datetime_died'])?></td>
                    <td><?php echo htmlspecialchars($rows['remarks'])?></td>
                  </tr><?php
                }
              }
              else{?>
                <tr><td colspan="19">No results</td></tr><?php
              }
            ?>      
          </tbody>
        </table>
      </div><?php
    }

    // milestones
    elseif(isset($_GET['milestones']) && isset($_GET['name'])){
      $babyId = $_GET['milestones'];
      $babyName = $_GET['name'];?>
      <header class="d-flex align-items-center justify-content-between">
        <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
        <h2 class="text-success">Prenatal / Babies / Milestones</h2>
      </header>
      
      <div class="my-2 d-flex align-items-center justify-content-between">
        <div>
          <h3 class="mb-0"><?php echo htmlspecialchars($_SESSION['PATIENT_NAME'])?> > <?php echo $babyName?></h3>
        </div>
        <div class="<?php echo isset($_GET['view']) ? "d-none" : ""?>">
          <button type="button" class="btn btn-success d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#addMilestoneModal" id="addMilestoneButtonOpen" data-id="<?php echo $babyId?>"><img src="../images/add.svg" alt="icon" width="20" height="20" loading="lazy"><span>Milestone</span></button>
        </div>
      </div>
      
      <div class="overflow-auto mt-3">
        <table class="table">
          <thead>
            <tr>
              <th>Action</th>
              <th>No.</th>
              <th>Date_of_achievement</th>
              <th>Description</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = mysqli_query($conn, "SELECT * FROM `developmental` WHERE `baby_id`=$babyId");
              $index = 1;
              if(mysqli_num_rows($query)>0){
                while($rows = mysqli_fetch_assoc($query)){?>
                  <tr>
                    <td>
                      <div>
                        <button type="button" class="btn btn-success milestone-managed" data-bs-toggle="modal" data-bs-target="#milestoneManagedByModal" data-id="<?php echo $rows['history_id']?>">Managed by</button>
                      </div>
                    </td>
                    <td><?php echo $index++?></td>
                    <td><?php echo htmlspecialchars($rows['date_achievement'])?></td>
                    <td><?php echo htmlspecialchars($rows['description'])?></td>
                  </tr><?php
                }
              }
              else{?>
                <tr><td colspan="4">No results</td></tr><?php
              }
            ?>      
          </tbody>
        </table>
      </div><?php
    }

    // metrics
    elseif(isset($_GET['metrics']) && isset($_GET['name'])){
      $babyId = $_GET['metrics'];
      $babyName = $_GET['name'];?>
      <header class="d-flex align-items-center justify-content-between">
        <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
        <h2 class="text-success">Prenatal / Babies / Metrics</h2>
      </header>
      
      <div class="my-2 d-flex align-items-center justify-content-between">
        <div>
          <h3 class="mb-0"><?php echo htmlspecialchars($_SESSION['PATIENT_NAME'])?> > <?php echo $babyName?></h3>
        </div>
        <div class="<?php echo isset($_GET['view']) ? "d-none" : ""?>">
          <button type="button" class="btn btn-success d-flex align-items-center justify-content-center gap-2" data-bs-toggle="modal" data-bs-target="#addMetricModal" id="addMetricModalButtonOpen" data-id="<?php echo $babyId?>"><img src="../images/add.svg" alt="icon" width="20" height="20" loading="lazy"><span>Metric</span></button>
        </div>
      </div>
      
      <div class="overflow-auto mt-3">
        <table class="table">
          <thead>
            <tr>
              <th>Action</th>
              <th>No.</th>
              <th>Date_of_measurement</th>
              <th>Weight</th>
              <th>Length</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $query = mysqli_query($conn, "SELECT * FROM `growth` WHERE `baby_id`=$babyId");
              $index = 1;
              if(mysqli_num_rows($query)>0){
                while($rows = mysqli_fetch_assoc($query)){?>
                  <tr>
                    <td>
                      <div>
                        <button type="button" class="btn btn-success metric-managed" data-bs-toggle="modal" data-bs-target="#metricManagedByModal" data-id="<?php echo $rows['history_id']?>">Managed by</button>
                      </div>
                    </td>
                    <td><?php echo $index++?></td>
                    <td><?php echo htmlspecialchars($rows['date_measurement'])?></td>
                    <td><?php echo htmlspecialchars($rows['weight'])?></td>
                    <td><?php echo htmlspecialchars($rows['length'])?></td>
                  </tr><?php
                }
              }
              else{?>
                <tr><td colspan="5">No results</td></tr><?php
              }
            ?>      
          </tbody>
        </table>
      </div><?php
    }

    // baby immunization
    elseif(isset($_GET['b_im']) && isset($_GET['name'])){
      $babyId = $_GET['b_im'];
      $babyName = $_GET['name'];?>
      <header class="d-flex align-items-center justify-content-between">
        <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
        <h2 class="text-success">Prenatal / Babies / Immunization</h2>
      </header>
      
      <form autocomplete="off" id="babyImmForm" data-id="<?php echo $babyId?>">
        <div class="my-2 d-flex align-items-center justify-content-between">
          <div>
            <h3 class="mb-0"><?php echo htmlspecialchars($_SESSION['PATIENT_NAME'])?> > <?php echo $babyName?></h3>
          </div>
          <div class="<?php echo isset($_GET['view']) ? "d-none" : ""?>">
            <button type="submit" class="btn btn-success" id="babyImmButton"><span>Update</span></button>
          </div>
        </div>
        
        <div class="overflow-auto">
          <table class="table">
            <thead>
              <tr>
                <th>Action</th>
                <th>Months</th>
                <th>Vaccines</th>
                <th>Vaccine Date</th>
                <th>When to Return</th>
              </tr>
            </thead>
            <tbody>
              <?php
                $months = array("During Birth","1 1/2","2 1/2","3 1/2","9","12");
                $vaccine = array("BCG (1 dose), HEPATITIS B (1 dose)","PENTAVALENT (DPT-Hep B-HiB) (1 dose), ORAL POLIO (1 dose), PHEUMOCOCCAL CONJUGATE","PENTAVALENT (DPT-Hep B-HiB) (1 dose), ORAL POLIO (1 dose), PHEUMOCOCCAL CONJUGATE (1 dose)","PENTAVALENT (DPT-Hep B-HiB) (1 dose), ORAL POLIO (1 dose), INACTIVATED POLIO (1 dose), PHEUMOCOCCAL CONJUGATE (1 dose)","MEASLES, MUMPS RUBELLA (1 dose)","MEASLES, MUMPS RUBELLA (1 dose)");

                $query = mysqli_query($conn, "SELECT * FROM `baby_imm` WHERE `baby_id`=$babyId ORDER BY `baby_imm_id` ASC");
                $index = 0;
                $count = 0;
                if(mysqli_num_rows($query)>0){
                  while($rows = mysqli_fetch_assoc($query)){?>
                    <tr>
                      <td>
                        <div>
                          <button type="button" class="btn btn-success baby-imm-managed" data-bs-toggle="modal" data-bs-target="#babyImmMangedByModal" data-id="<?php echo $rows['baby_imm_id']?>">Managed by</button>
                        </div>
                      </td>
                      <td><?php echo $months[$index]?></td>
                      <td><?php echo $vaccine[$index]?></td>
                      <td><input type="date" class="form-control" <?php echo empty($rows['vaccine_date']) ? "" : "readonly"?> value="<?php echo $rows['vaccine_date']?>"></td>
                      <td><input type="date" class="form-control" <?php echo empty($rows['when_return']) ? "" : "readonly"?> value="<?php echo $rows['when_return']?>"></td>
                    </tr><?php
                    $index++;
                    $count++;
                  }

                  for($i=$count; $i<6; $i++){?>
                    <tr>
                      <td>
                        <div>
                          <button type="button" class="btn btn-success" disabled>Managed by</button>
                        </div>
                      </td>
                      <td><?php echo $months[$i]?></td>
                      <td><?php echo $vaccine[$i]?></td>
                      <td><input type="date" class="form-control" name="babyImmDate[]"></td>
                      <td><input type="date" class="form-control" name="babyImmReturn[]"></td>
                    </tr><?php
                  }
                }
                else{
                  for($index = 0; $index < count($months); $index++){?>
                    <tr>
                      <td>
                        <div>
                          <button type="button" class="btn btn-success" disabled>Managed by</button>
                        </div>
                      </td>
                      <td><?php echo $months[$index]?></td>
                      <td><?php echo $vaccine[$index]?></td>
                      <td><input type="date" class="form-control" name="babyImmDate[]"></td>
                      <td><input type="date" class="form-control" name="babyImmReturn[]"></td>
                    </tr><?php
                  }
                }
              ?>
            </tbody>
          </table>
        </div>
      </form><?php
    }

    // records
    else{?>
      <header class="d-flex align-items-center justify-content-between mb-1">
        <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
        <h2 class="text-success"><?php echo isset($_GET['view']) ? "Patient" : "Patients"?></h2>
      </header>
      <form autocomplete="off" class="my-2 d-flex align-items-center justify-content-center gap-3 flex-nowrap <?php echo isset($_GET['view']) ? "d-none" : ""?>">
        <input type="search" name="q" class="form-control" placeholder="Search Name..." value="<?php echo $q?>">
        <span>or</span>
        <button type="button" class="btn btn-light p-0" data-bs-toggle="modal" data-bs-target="#qrcodeModal"><img src="../images/qrcode.svg" alt="icon" width="30" height="30" loading="lazy" id="qrcodeModalButtonOpen"></button>
      </form>

      <div class="modal fade" id="qrcodeModal" tabindex="-1" aria-labelledby="qrcodeModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-m">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="qrcodeModalLabel">QR code</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="qrcodeModalButtonClose"></button>
            </div>
            <div class="modal-body">
              <div class="rounded text-center">
                <h5>QR CODE SCANNER</h5>
                <video id="webcam" class="border w-50" style="aspect-ratio: 16/9"></video>
              </div>
              <div class="text-center my-3">-----<span>or</span>-----</div>
              <form class="d-flex align-items-center justify-content-center gap-2 flex-nowrap" autocomplete="off">
                <input type="number" class="form-control" placeholder="Enter the 6 Digits Code..." name="patient_code" required id="qrcodeScan">
                <button type="submit" class="btn btn-success" id="qrcodeScanFind">Find</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <script>
        let scanner = new Instascan.Scanner({video: document.getElementById("webcam")})

        // open camera
        $('#qrcodeModalButtonOpen').off('click').on('click', function(){
          Instascan.Camera.getCameras().then(function(cameras){
            cameras.length > 0 ? scanner.start(cameras[0]) : alert("No camera found!")
          }).catch(function(e){
            console.error(e)
          })
          scanner.addListener("scan", function(result){
            $('#qrcodeScan').val(result)
            $('#qrcodeScanFind')[0].click()
          })
        })
        
        // close camera
        $('#qrcodeModalButtonClose').off('click').on('click', function(){
          Instascan.Camera.getCameras().then(function(cameras){
            cameras.length > 0 ? scanner.stop(cameras[0]) : alert("No camera found!")
          }).catch(function(e){
            console.error(e)
          })
        })
      </script>
      
      <div class="overflow-auto" style="min-height: 20rem;">
        <table class="table">
          <thead>
            <tr>
              <th>Action</th>
              <th>No.</th>
              <th>First_name</th>
              <th>Middle_name</th>
              <th>Last_name</th>
              <th>Birth_date</th>
              <th>Address</th>
              <th>Occupation</th>
              <th>Blood_type</th>
              <th>Contact_no.</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
            <?php              
              // for Admin and Staff
              if(isset($_COOKIE['_HC'])){
                $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
                $query1 = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
                if(mysqli_num_rows($query1)>0){
                  $rows1 = mysqli_fetch_assoc($query1);
                  $centerId = $rows1['center_id'];

                  // patient_code scanned
                  if(isset($_GET['patient_code'])){    
                    $patientCode = $_GET['patient_code'];                
                    $sql = "SELECT * FROM `patient` WHERE `patient_code`='$patientCode'";
                  }
                  else{
                    $sql = "SELECT * FROM `patient` WHERE (CONCAT(`first_name`,' ',`middle_name`, ' ', `last_name`) LIKE '%$q%' || CONCAT(`first_name`, ' ', `last_name`) LIKE '%$q%') AND `center_id`=$centerId ORDER BY `first_name` ASC";
                  }

                  $query = mysqli_query($conn, $sql);
                  $index = 1;
                  if(mysqli_num_rows($query)>0){
                    while($rows = mysqli_fetch_assoc($query)){?>
                      <tr>
                        <td>
                          <?php
                            $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
                            $query1 = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
                            if(mysqli_num_rows($query1)>0){
                              $rows1 = mysqli_fetch_assoc($query1);
                              $centerId = $rows1['center_id'];
                              $userId = $rows1['user_id'];

                              if($rows['center_id'] == $centerId){?>
                                <div class="dropdown">
                                  <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Modules
                                  </button>
                                  <ul class="dropdown-menu">
                                    <li><a class="dropdown-item edit-patient" href="#" data-id="<?php echo $rows['patient_id']?>" data-bs-toggle="modal" data-bs-target="#editPatientModal">Edit</a></li>
                                    <li><a class="dropdown-item" href="?code=<?php echo $rows['patient_code']?>">Generate QR</a></li>
                                    <li><a class="dropdown-item" href="?prenatal=<?php echo $rows['patient_id']?>">Prenatal</a></li>
                                    <li><a class="dropdown-item managed-by" href="#" data-id="<?php echo $rows['patient_id']?>" data-bs-toggle="modal" data-bs-target="#managedByPatientModal">Managed by</a></li>
                                  </ul>
                                </div><?php
                              }
                              else{
                                $query2 = mysqli_query($conn, "SELECT * FROM `request` WHERE `allowed`='true' AND `sender_id`=$userId AND `patient_id`=".$rows['patient_id']);
                                if(mysqli_num_rows($query2)>0){?>
                                  <div class="dropdown">
                                    <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                      Modules
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li><a class="dropdown-item edit-patient" href="#" data-id="<?php echo $rows['patient_id']?>" data-bs-toggle="modal" data-bs-target="#editPatientModal">Edit</a></li>
                                      <li><a class="dropdown-item" href="?code=<?php echo $rows['patient_code']?>">Generate QR</a></li>
                                      <li><a class="dropdown-item" href="?prenatal=<?php echo $rows['patient_id']?>">Prenatal</a></li>
                                      <li><a class="dropdown-item managed-by" href="#" data-id="<?php echo $rows['patient_id']?>" data-bs-toggle="modal" data-bs-target="#managedByPatientModal">Managed by</a></li>
                                    </ul>
                                  </div><?php                                
                                }
                                else{
                                  $query3 = mysqli_query($conn, "SELECT * FROM `center` WHERE `center_id`=".$rows['center_id']);
                                  if(mysqli_num_rows($query3)>0){
                                    $_SESSION['CENTER_NAME'] = mysqli_fetch_assoc($query3)['center_name'];
                                  }?>
                                  <div>
                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#accessPatientModal" id="accessPatientModalButtonOpen" data-id="<?php echo $rows['patient_id']?>">Access</button>
                                  </div><?php
                                }
                              }                          
                            }
                          ?>
                        </td>
                        <td><?php echo $index++?></td>
                        <td><?php echo htmlspecialchars($rows['first_name'])?></td>
                        <td><?php echo htmlspecialchars($rows['middle_name'])?></td>
                        <td><?php echo htmlspecialchars($rows['last_name'])?></td>
                        <td><?php echo htmlspecialchars($rows['birth_date'])?></td>
                        <td><?php echo htmlspecialchars($rows['address'])?></td>
                        <td><?php echo htmlspecialchars($rows['occupation'])?></td>
                        <td><?php echo htmlspecialchars($rows['blood_type'])?></td>
                        <td><?php echo htmlspecialchars($rows['contact'])?></td>
                        <td><?php echo htmlspecialchars($rows['email'])?></td>
                      </tr>
                      <?php
                    }
                  }
                  else{?>
                    <tr><td colspan="11">No results</td></tr><?php
                  }
                }
              }
              // patient viewing
              else{
                if(isset($_GET['patient_code'])){
                  $patientCode = $_GET['patient_code'];
                  $sql = "SELECT * FROM `patient` WHERE `patient_code`='$patientCode'";
                  $query = mysqli_query($conn, $sql);
                  $index = 1;
                  if(mysqli_num_rows($query)>0){
                    while($rows = mysqli_fetch_assoc($query)){?>
                      <tr>
                        <td>
                          <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Modules
                            </button>
                            <ul class="dropdown-menu">
                              <li class="<?php echo isset($_GET['view']) ? "d-none" : ""?>"><a class="dropdown-item edit-patient" href="#" data-id="<?php echo $rows['patient_id']?>" data-bs-toggle="modal" data-bs-target="#editPatientModal">Edit</a></li>
                              <li class="<?php echo isset($_GET['view']) ? "d-none" : ""?>"><a class="dropdown-item" href="?code=<?php echo $rows['patient_code']?>">Generate QR</a></li>
                              <li><a class="dropdown-item" href="?prenatal=<?php echo $rows['patient_id']?><?php echo isset($_GET['view']) ? "&view" : ""?>">Prenatal</a></li>
                              <li><a class="dropdown-item managed-by" href="#" data-id="<?php echo $rows['patient_id']?>" data-bs-toggle="modal" data-bs-target="#managedByPatientModal">Managed by</a></li>
                            </ul>
                          </div>
                        </td>
                        <td><?php echo $index++?></td>
                        <td><?php echo htmlspecialchars($rows['first_name'])?></td>
                        <td><?php echo htmlspecialchars($rows['middle_name'])?></td>
                        <td><?php echo htmlspecialchars($rows['last_name'])?></td>
                        <td><?php echo htmlspecialchars($rows['birth_date'])?></td>
                        <td><?php echo htmlspecialchars($rows['address'])?></td>
                        <td><?php echo htmlspecialchars($rows['occupation'])?></td>
                        <td><?php echo htmlspecialchars($rows['blood_type'])?></td>
                        <td><?php echo htmlspecialchars($rows['contact'])?></td>
                        <td><?php echo htmlspecialchars($rows['email'])?></td>
                      </tr>
                      <?php
                    }
                  }
                  else{?>
                    <tr><td colspan="11">No results</td></tr><?php
                  }
                }
              }
            ?>            
          </tbody>
        </table>
      </div><?php
    }?>
</div>

<!-- patient managed by -->
<div class="modal fade" id="managedByPatientModal" tabindex="-1" aria-labelledby="managedByPatientModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="managedByPatientModalLabel">Managed by</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="managedByPatientModalButtonClose"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Description</th>
              <th>Author</th>
              <th>Health_Center</th>
            </tr>
          </thead>
          <tbody id="managedByPatientTBody">
            <!-- ... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- patient edit -->
<div class="modal fade" id="editPatientModal" tabindex="-1" aria-labelledby="editPatientModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="editPatientModalLabel">Edit</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="editPatientModalButtonClose"></button>
      </div>
      
      <form class="modal-body d-flex align-items-start justify-content-start gap-3 flex-wrap" autocomplete="off" id="editPatientForm">
        <!-- ... -->
      </form>
    </div>
  </div>
</div>

<!-- add first checkup -->
<div class="modal fade" id="addFirstCheckupModal" tabindex="-1" aria-labelledby="addFirstCheckupModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addFirstCheckupModalLabel">First checkup</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="addFirstCheckupModalButtonClose"></button>
      </div>
      
      <form class="modal-body d-flex align-items-start justify-content-start gap-3 flex-wrap" autocomplete="off" id="addFirstCheckupForm">
        <div class="w-100">
          <label class="form-label">Weight (kg)</label>
          <input id="addFirstCheckupWeight" type="number" class="form-control" name="addFirstCheckup[]" placeholder="..." required>
        </div>
        <div class="w-100">
          <label class="form-label">Height (m)</label>
          <input id="addFirstCheckupHeight" type="number" class="form-control" name="addFirstCheckup[]" placeholder="..." required>
        </div>
        <div class="w-100">
          <label class="form-label">BMI</label>
          <input id="addFirstCheckupBMI" type="text" readonly class="form-control" name="addFirstCheckup[]" placeholder="..." required>
        </div>
        <div class="w-100">
          <label class="form-label">Last Menstrual Period</label>
          <input type="date" class="form-control" name="addFirstCheckup[]" placeholder="..." required>
        </div>
        <div class="w-100">
          <label class="form-label">Expected Date of Delivery</label>
          <input type="date" class="form-control" name="addFirstCheckup[]" placeholder="..." required>
        </div>
        <div class="w-100 text-end">
          <button type="submit" class="btn btn-success">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- first checkup -->
<div class="modal fade" id="viewFirstCheckupModal" tabindex="-1" aria-labelledby="viewFirstCheckupModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="viewFirstCheckupModalLabel">First checkup</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="viewFirstCheckupModalButtonClose"></button>
      </div>
      <div class="modal-body" id="viewFirstCheckupModalBody">
        <!-- .. -->
      </div>
    </div>
  </div>
</div>

<!-- add trimester -->
<div class="modal fade" id="addTrimesterModal" tabindex="-1" aria-labelledby="addTrimesterModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addTrimesterModalLabel">Trimester</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="addTrimesterModalButtonClose"></button>
      </div>
      
      <div class="modal-body">
        <form class="d-flex align-items-start justify-content-start gap-3 flex-wrap" autocomplete="off" id="addTrimesterForm">
          <div class="w-100">
            <label class="form-label">Type of Trimester</label>
            <select class="form-select" id="typeTrimester">
              <option value="">Select...</option>
              <option value="First Trimester">First Trimester</option>
              <option value="Second Trimester">Second Trimester</option>
              <option value="Last Trimester">Last Trimester</option>
            </select>
          </div>

          <!-- First Trimester -->
          <div class="d-flex align-items-start justify-content-start gap-3 flex-wrap w-100 d-none" id="firstTrimester">
            <div class="w-100">
              <label class="form-label">Weight</label>
              <input type="text" class="form-control" placeholder="..." name="addFirstTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Height</label>
              <input type="text" class="form-control" placeholder="..." name="addFirstTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Age of Gestation</label>
              <input type="text" class="form-control" id="firstAgeGestation" placeholder="..." name="addFirstTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Blood Pressure</label>
              <input type="text" class="form-control" placeholder="..." name="addFirstTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Nutritional Status</label>
              <select class="form-select" name="addFirstTrimester[]">
                <option value="">Select...</option>
                <option value="Normal">Normal</option>
                <option value="Underweight">Underweight</option>
                <option value="Overweight">Overweight</option>
              </select>
            </div>
            <div class="w-100">
              <label class="form-label">Pagbuo ng Birth Plan</label>
              <textarea class="form-control" placeholder="..." name="addFirstTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Pagsusuri ng ngipin</label>
              <textarea class="form-control" placeholder="..." name="addFirstTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Laboratory Tests Done</label>
              <textarea class="form-control" placeholder="..." name="addFirstTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Hemoglobin count</label>
              <textarea class="form-control" placeholder="..." name="addFirstTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Urinalysis</label>
              <textarea class="form-control" placeholder="..." name="addFirstTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Complete Blood Count (CBC)</label>
              <textarea class="form-control" placeholder="..." name="addFirstTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">STIs gamit ang syndromic approach</label>
              <select class="form-select" name="addFirstTrimester[]">
                <option value="">Select...</option>
                <option value="Syphilis">Syphilis</option>
                <option value="HIV">HIV</option>
                <option value="Hepatitis B">Hepatitis B</option>
              </select>
            </div>
            <div class="w-100">
              <label class="form-label">Stool Examination</label>
              <textarea class="form-control" placeholder="..." name="addFirstTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Acetic Acid Wash</label>
              <textarea class="form-control" placeholder="..." name="addFirstTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Tetanus-containing Vaccine</label>
              <textarea class="form-control" placeholder="..." name="addFirstTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Treatments</label>
              <select class="form-select" name="addFirstTrimester[]">
                <option value="">Select...</option>
                <option value="Syphilis">Syphilis</option>
                <option value="Antiretroviral (ARV)">Antiretroviral (ARV)</option>
                <option value="Bacteriuria">Bacteriuria</option>
                <option value="Anemia">Anemia</option>
              </select>
            </div>
            <div class="w-100">
              <label class="form-label">Pinag-usapan/Serbisyong ibinigay</label>
              <textarea class="form-control" placeholder="..." name="addFirstTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Petsa ng Pagbalik</label>
              <input type="date" class="form-control" placeholder="..." name="addFirstTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Remarks</label>
              <textarea class="form-control" placeholder="..." name="addFirstTrimester[]"></textarea>
            </div>
          </div>

          <!-- Second Trimester -->
          <div class="d-flex align-items-start justify-content-start gap-3 flex-wrap w-100 d-none" id="secondTrimester">
            <div class="w-100">
              <label class="form-label">Weight</label>
              <input type="text" class="form-control" placeholder="..." name="addSecondTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Height</label>
              <input type="text" class="form-control" placeholder="..." name="addSecondTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Age of Gestation</label>
              <input type="text" id="secondAgeGestation" class="form-control" placeholder="..." name="addSecondTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Blood Pressure</label>
              <input type="text" class="form-control" placeholder="..." name="addSecondTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Nutritional Status</label>
              <select class="form-select" name="addSecondTrimester[]">
                <option value="">Select...</option>
                <option value="Normal">Normal</option>
                <option value="Underweight">Underweight</option>
                <option value="Overweight">Overweight</option>
              </select>
            </div>
            <div class="w-100">
              <label class="form-label">Pagsusuri ng kalagayan ng buntis</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Mga payong binigay</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Mga pagbabago sa Birth Plan</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Pagsusuri ng ngipin</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Laboratory Tests Done</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Urinalysis</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Complete Blood Count (CBC)</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Etiologic tests para sa STIs, kung kailangan</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Pap Smear, kung kinakailangan</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Gestational diabetes (oral glucose challenge test), kung kinakailangan</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Bacteriuria, kung kinakailangan</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Treatments</label>
              <select class="form-select" name="addSecondTrimester[]">
                <option value="">Select...</option>
                <option value="Deworming">Deworming</option>
                <option value="Antiretroviral (ARV)">Antiretroviral (ARV)</option>
                <option value="Bacteriuria">Bacteriuria</option>
                <option value="Anemia">Anemia</option>
              </select>
            </div>
            <div class="w-100">
              <label class="form-label">Pinag-usapan/Serbisyong ibinigay</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Petsa ng Pagbalik</label>
              <input type="date" class="form-control" placeholder="..." name="addSecondTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Remarks</label>
              <textarea class="form-control" placeholder="..." name="addSecondTrimester[]"></textarea>
            </div>
          </div>

          <!-- Last Trimester -->
          <div class="d-flex align-items-start justify-content-start gap-3 flex-wrap w-100 d-none" id="lastTrimester">
            <div class="w-100">
              <label class="form-label">Weight</label>
              <input type="text" class="form-control" placeholder="..." name="addLastTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Height</label>
              <input type="text" class="form-control" placeholder="..." name="addLastTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Age of Gestation</label>
              <input type="text" id="lastAgeGestation" class="form-control" placeholder="..." name="addLastTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Blood Pressure</label>
              <input type="text" class="form-control" placeholder="..." name="addLastTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Nutritional Status</label>
              <select class="form-select" name="addLastTrimester[]">
                <option value="">Select...</option>
                <option value="Normal">Normal</option>
                <option value="Underweight">Underweight</option>
                <option value="Overweight">Overweight</option>
              </select>
            </div>
            <div class="w-100">
              <label class="form-label">Pagsusuri ng kalagayan ng buntis</label>
              <textarea class="form-control" placeholder="..." name="addLastTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Mga payong binigay</label>
              <textarea class="form-control" placeholder="..." name="addLastTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Mga pagbabago sa Birth Plan</label>
              <textarea class="form-control" placeholder="..." name="addLastTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Pagsusuri ng ngipin</label>
              <textarea class="form-control" placeholder="..." name="addLastTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Laboratory Tests Done</label>
              <textarea class="form-control" placeholder="..." name="addLastTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Urinalysis</label>
              <textarea class="form-control" placeholder="..." name="addLastTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Complete Blood Count (CBC)</label>
              <textarea class="form-control" placeholder="..." name="addLastTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Bacteriuria, kung kinakailangan</label>
              <textarea class="form-control" placeholder="..." name="addLastTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Blood/RH group, kung kinakailangan</label>
              <textarea class="form-control" placeholder="..." name="addLastTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Treatments</label>
              <select class="form-select" name="addLastTrimester[]">
                <option value="">Select...</option>
                <option value="Antiretroviral (ARV)">Antiretroviral (ARV)</option>
                <option value="Bacteriuria">Bacteriuria</option>
                <option value="Anemia">Anemia</option>
              </select>
            </div>
            <div class="w-100">
              <label class="form-label">Pinag-usapan/Serbisyong ibinigay</label>
              <textarea class="form-control" placeholder="..." name="addLastTrimester[]"></textarea>
            </div>
            <div class="w-100">
              <label class="form-label">Petsa ng Pagbalik</label>
              <input type="date" class="form-control" placeholder="..." name="addLastTrimester[]">
            </div>
            <div class="w-100">
              <label class="form-label">Remarks</label>
              <textarea class="form-control" placeholder="..." name="addLastTrimester[]"></textarea>
            </div>
          </div>

          <div class="w-100 text-end d-none" id="buttonTrimester">
            <button type="submit" class="btn btn-success">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- view trimester -->
<div class="modal fade" id="viewTrimesterModal" tabindex="-1" aria-labelledby="viewTrimesterModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="viewTrimesterModalLabel">View Trimester</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="viewTrimesterModalButtonClose"></button>
      </div>
      
      <div class="modal-body" id="viewTrimesterModalBody">
        <!-- ... -->
      </div>
    </div>
  </div>
</div>

<!-- patient immunization managed by -->
<div class="modal fade" id="patientImmMangedByModal" tabindex="-1" aria-labelledby="patientImmMangedByModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="patientImmMangedByModalLabel">Managed by</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="patientImmMangedByModalButtonClose"></button>
      </div>
      
      <div class="modal-body" id="patientImmMangedByModalBody">
        <!-- ... -->
      </div>
    </div>
  </div>
</div>

<!-- add baby -->
<div class="modal fade" id="addBabyModal" tabindex="-1" aria-labelledby="addBabyModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addBabyModalLabel">Add</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="addBabyModalButtonClose"></button>
      </div>
      
      <form class="modal-body d-flex align-items-start justify-content-start gap-1 flex-wrap" autocomplete="off" id="addBabyForm">

        <!-- patient status -->
        <h6 class="mb-0">Patient Status (optional)</h6>
        <section class="d-flex align-items-start justify-content-start gap-2 flex-wrap w-100">
          <aside class="w-100 d-flex align-items-start justify-content-start gap-3 flex-nowrap">
            <div class="w-100">
              <label class="form-label">Status</label>
              <select class="form-select" name="updatePatientStatus[]">
                <option value="">Select...</option>
                <option value="Died">Died</option>
              </select>
            </div>
            <div class="w-100">
              <label class="form-label">If status is Died</label>
              <input type="datetime-local" class="form-control" name="updatePatientStatus[]" placeholder="...">
            </div>
            <div class="w-100">
              <label class="form-label">Remarks when Died</label>
              <textarea class="form-control" name="updatePatientStatus[]" placeholder="..."></textarea>
            </div>
          </aside>
        </section>

        <!-- father -->
        <h6 class="mb-0 mt-3">Father (optional)</h6>
        <section class="d-flex align-items-start justify-content-start gap-2 flex-wrap w-100">
          <aside class="w-100 d-flex align-items-start justify-content-start gap-3 flex-nowrap">
            <div class="w-100">
              <label class="form-label">First Name</label>
              <input type="text" class="form-control" placeholder="..." name="addFather[]">
            </div>
            <div class="w-100">
              <label class="form-label">Middle Name</label>
              <input type="text" class="form-control" placeholder="..." name="addFather[]">
            </div>
            <div class="w-100">
              <label class="form-label">Last Name</label>
              <input type="text" class="form-control" placeholder="..." name="addFather[]">
            </div>
            <div class="w-100">
              <label class="form-label">Extension Name</label>
              <input type="text" class="form-control" placeholder="..." name="addFather[]">
            </div>
          </aside>            
          <aside class="w-100 d-flex align-items-start justify-content-start gap-3 flex-nowrap">
            <div class="w-100">
              <label class="form-label">Contact no.</label>
              <input type="number" class="form-control" placeholder="..." name="addFather[]">
            </div>
            <div class="w-100">
              <label class="form-label">Address</label>
              <input type="text" class="form-control" placeholder="..." name="addFather[]">
            </div>
          </aside>
        </section>

        <!-- number of babies -->
        <h6 class="mb-0 mt-3">Number of Babies</h6>
        <div class="w-100">
          <select class="form-select" id="numberOfBabies">
            <option value="">Select..</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </div>

        <!-- babies -->
        <section id="sectionBabies">
          <!-- .. -->
        </section>

        <div class="w-100 text-end d-none" id="addBabyModalButtonAdd">
          <button type="submit" class="btn btn-success">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- baby managed by -->
<div class="modal fade" id="managedByBabyModal" tabindex="-1" aria-labelledby="managedByBabyModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="managedByBabyModalLabel">Managed by</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="managedByBabyModalButtonClose"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Description</th>
              <th>Author</th>
              <th>Health_Center</th>
            </tr>
          </thead>
          <tbody id="managedByBabyTBody">
            <!-- ... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- baby father -->
<div class="modal fade" id="fatherBabyModal" tabindex="-1" aria-labelledby="fatherBabyModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="fatherBabyModalLabel">Father</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="fatherBabyModalButtonClose"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>First_name</th>
              <th>Middle_name</th>
              <th>Last_name</th>
              <th>Extension_name</th>
              <th>Contact_no.</th>
              <th>Address</th>
            </tr>
          </thead>
          <tbody id="fatherBabyTBody">
            <!-- ... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- add milestone -->
<div class="modal fade" id="addMilestoneModal" tabindex="-1" aria-labelledby="addMilestoneModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addMilestoneModalLabel">Milestone</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="addMilestoneModalButtonClose"></button>
      </div>
      
      <form class="modal-body d-flex align-items-start justify-content-start gap-3 flex-wrap" autocomplete="off" id="addMilestoneForm">
        <div class="w-100">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="addMilestone[]" placeholder="..." required></textarea>
        </div>
        <div class="w-100 text-end">
          <button type="submit" class="btn btn-success">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- milestone managed by -->
<div class="modal fade" id="milestoneManagedByModal" tabindex="-1" aria-labelledby="milestoneManagedByModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="milestoneManagedByModalLabel">Managed by</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="milestoneManagedByModalButtonClose"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Description</th>
              <th>Author</th>
              <th>Health_Center</th>
            </tr>
          </thead>
          <tbody id="milestoneManagedByTBody">
            <!-- ... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- add metric -->
<div class="modal fade" id="addMetricModal" tabindex="-1" aria-labelledby="addMetricModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addMetricModalLabel">Metric</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="addMetricModalButtonClose"></button>
      </div>
      
      <form class="modal-body d-flex align-items-start justify-content-start gap-3 flex-wrap" autocomplete="off" id="addMetricForm">
        <div class="w-100">
          <label class="form-label">Weight</label>
          <input type="text" class="form-control" name="addMetric[]" placeholder="..." required>
        </div>
        <div class="w-100">
          <label class="form-label">Lenght/Height</label>
          <input type="text" class="form-control" name="addMetric[]" placeholder="..." required>
        </div>
        <div class="w-100 text-end">
          <button type="submit" class="btn btn-success">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- metrics managed by -->
<div class="modal fade" id="metricManagedByModal" tabindex="-1" aria-labelledby="metricManagedByModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="metricManagedByModalLabel">Managed by</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="metricManagedByModalButtonClose"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Description</th>
              <th>Author</th>
              <th>Health_Center</th>
            </tr>
          </thead>
          <tbody id="metricManagedByTBody">
            <!-- ... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- baby immunization managed by -->
<div class="modal fade" id="babyImmMangedByModal" tabindex="-1" aria-labelledby="babyImmMangedByModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="babyImmMangedByModalLabel">Managed by</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="babyImmMangedByModalButtonClose"></button>
      </div>
      
      <div class="modal-body" id="babyImmMangedByModalBody">
        <!-- ... -->
      </div>
    </div>
  </div>
</div>

<!-- access patient -->
<div class="modal fade" id="accessPatientModal" tabindex="-1" aria-labelledby="accessPatientModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="accessPatientModalLabel">Access</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="accessPatientModalButtonClose"></button>
      </div>
      
      <div class="modal-body">
        <p>This patient is from <?php echo $_SESSION['CENTER_NAME']?>. To add or update records, you must first request acccess to this health center. Please wait a few minutes for confirmation.</p>
        <button type="button" class="btn btn-success" id="requestNow">Request now</button>
      </div>
    </div>
  </div>
</div>
