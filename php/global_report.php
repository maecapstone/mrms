<form class="w-75 p-3">
  <header class="d-flex align-items-center justify-content-between mb-1">
    <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
    <h2 class="text-success">Report</h2>
  </header>

  <?php
    $m = isset($_GET['m']) ? $_GET['m'] : "";
    $y = isset($_GET['y']) ? $_GET['y'] : "";
    $s = isset($_GET['s']) ? $_GET['s'] : "";
    $from = isset($_GET['from']) ? $_GET['from'] : "";
    $to = isset($_GET['to']) ? $_GET['to'] : "";  
  ?>

  <select class="form-select mb-3" id="selectedReport" name="s">
    <option value="">Select type of report...</option>
    <?php
      $values = array("Number of vaccinated children","Number of prenatal per/month","Maternal mortality rate","Births by delivery method","Maternal age distribution");

      for($i=0; $i<count($values); $i++){
        if($s === $values[$i]){?>
          <option selected value="<?php echo $values[$i]?>"><?php echo $values[$i]?></option><?php
        }
        else{?>
          <option value="<?php echo $values[$i]?>"><?php echo $values[$i]?></option><?php
        }
      }
    ?>
  </select>

  <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
    <?php
      if($s === "Number of prenatal per/month"){?>
        <input type="number" class="form-control" name="m" placeholder="Month: ex) 1 for January" value="<?php echo $m?>">
        <input type="number" class="form-control" name="y" placeholder="Year: ex) 2024" value="<?php echo $y?>"><?php
      }
      elseif($s === "Maternal age distribution"){?>
        <label class="form-label fw-bold">From</label>
        <input type="date" class="form-control" name="from" value="<?php echo $from?>">
        <label class="form-label fw-bold">To</label>
        <input type="date" class="form-control" name="to" value="<?php echo $to?>"><?php
      }
    ?>
    <button type="submit" class="btn btn-dark <?php echo $s === "Number of prenatal per/month" || $s === "Maternal age distribution" ? "" : "d-none"?>" id="applyReport">Apply</button>
  </div>

  <button type="button" class="btn btn-success btn-sm d-flex align-items-center justify-content-center gap-2 <?php echo empty($s) ? "d-none" : "d-none"?>"><img src="../images/print.svg" alt="icon" width="20" height="20" loading="lazy"><span>PRINT</span></button>

  <div class="mt-3 p-3 overflow-auto">
    <?php
      $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
      $query1 = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
      if(mysqli_num_rows($query1)>0){
        $rows1 = mysqli_fetch_assoc($query1);
        $centerId = $rows1['center_id'];
        $userId = $rows1['user_id'];

        // reports
        if($s === "Number of vaccinated children"){?>
          <div>
            <?php 
                $baby = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `baby` WHERE `center_id`=$centerId"))[0];
                echo "As of ".date("Y-m-d").", there were $baby vaccinated children.";
              ?>
          </div><?php
        }
        elseif($s === "Number of prenatal per/month"){
          $month = "";
          if($m == 1)
            $month = "January";
          elseif($m == 2)  
            $month = "February";
          elseif($m == 3)  
            $month = "March";
          elseif($m == 4)  
            $month = "April";
          elseif($m == 5)  
            $month = "May";
          elseif($m == 6)  
            $month = "June";
          elseif($m == 7)  
            $month = "July";
          elseif($m == 8)  
            $month = "August";
          elseif($m == 9)  
            $month = "September";
          elseif($m == 10)  
            $month = "October";
          elseif($m == 11)  
            $month = "November";
          elseif($m == 12)  
            $month = "December";
          
          if(!empty($month)){?>
            <div>
              <?php 
                $appointments = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `checkup` INNER JOIN `maternal` ON `checkup`.`maternal_id` = `maternal`.`maternal_id` WHERE `maternal`.`center_id`=$centerId AND YEAR(`checkup`.`checkup_date`) = $y AND MONTH(`checkup`.`checkup_date`) = $m"))[0];
                echo "As of ".date("Y-m-d").", there were $appointments prenatal appointments in $month $y.";
              ?>
            </div><?php
          }
        }
        elseif($s === "Maternal mortality rate"){?>
          <div>
            <?php
              $maternalDeaths = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `maternal` WHERE `patient_status`='Died' AND `center_id`=$centerId"))[0];
              $liveBirths = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `baby` WHERE `baby_status`='Alive' AND `center_id`=$centerId"))[0];
              
              try{
                $mmr = number_format((intval($maternalDeaths) / intval($liveBirths)) * 100000, 2);
                echo "As of ".date("Y-m-d").", the maternal mortality rate is $mmr maternal deaths per 100,000 live births.";
              }
              catch(DivisionByZeroError $e){
                echo "No records yet.";
              }
            ?>
          </div><?php        
        }
        elseif($s === "Births by delivery method"){?>
          <div>
            <?php 
                $normal = intval(mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `baby` WHERE `type_delivery`='Normal' AND `center_id`=$centerId"))[0]);
                $caesarean = intval(mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `baby` WHERE `type_delivery`='Caesarean' AND `center_id`=$centerId"))[0]);
                $total = $normal + $caesarean;

                try{
                  $normalPer = number_format(($normal / $total) * 100, 2);
                  $caesareanPer = number_format(($caesarean / $total) * 100, 2);
                  echo "As of ".date("Y-m-d").", there were $total births: $normal vaginal delivery (normal) with the percentage of $normalPer and $caesarean cesarean sections (C-sections) with the percentage of $caesareanPer.";
                }
                catch(DivisionByZeroError $e){
                  echo "No records yet.";
                }
              ?>
          </div><?php
        }
        elseif($s === "Maternal age distribution" && isset($_GET['from']) && isset($_GET['to'])){
          $total = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `checkup` INNER JOIN `maternal` ON `checkup`.`maternal_id` = `maternal`.`maternal_id` WHERE `maternal`.`center_id`=$centerId AND `checkup_date` >= '$from' AND `checkup_date` <= '$to'"))[0];?>
          <p class="fw-bold">Summary:</p>
          <p><?php echo "Total number of births: $total"?></p><?php

          if(intval($total) > 0){?>
            <p class="fw-bold">Age Distribution:</p>
          
            <table class="table">
              <thead>
                <tr>
                  <th>Maternal Age Group</th>
                  <th>Number of Births</th>
                  <th>Percentage of Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $val1Birth = 0;
                  $val1Per = 0;
                  $val2Birth = 0;
                  $val2Per = 0;
                  $val3Birth = 0;
                  $val3Per = 0;
                  $val4Birth = 0;
                  $val4Per = 0;
                  $val5Birth = 0;
                  $val5Per = 0;
                  $val6Birth = 0;
                  $val6Per = 0;
                  $query = mysqli_query($conn, "SELECT * FROM `checkup` INNER JOIN `maternal` ON `checkup`.`maternal_id` = `maternal`.`maternal_id` WHERE `maternal`.`center_id`=$centerId AND `checkup_date` >= '$from' AND `checkup_date` <= '$to'");
                  if(mysqli_num_rows($query)>0){
                    while($rows = mysqli_fetch_assoc($query)){
                      if(intval($rows['age']) < 20){
                        $val1Birth++;
                      }
                      elseif(intval($rows['age']) >= 20 && intval($rows['age']) <= 24){
                        $val2Birth++;
                      }
                      elseif(intval($rows['age']) >= 25 && intval($rows['age']) <= 29){
                        $val3Birth++;
                      }
                      elseif(intval($rows['age']) >= 30 && intval($rows['age']) <= 34){
                        $val4Birth++;
                      }
                      elseif(intval($rows['age']) >= 35 && intval($rows['age']) <= 39){
                        $val5Birth++;
                      }
                      elseif(intval($rows['age']) >= 40){
                        $val6Birth++;
                      }
                    }
                  }
                ?>     
                <tr>
                  <td>Under 20 years</td>
                  <td><?php echo $val1Birth?></td>
                  <td><?php echo number_format(($val1Birth / intval($total)) * 100 ) . "%"?></td>
                </tr>
                <tr>
                  <td>20-24 years</td>
                  <td><?php echo $val2Birth?></td>
                  <td><?php echo number_format(($val2Birth / intval($total)) * 100 ) . "%"?></td>
                </tr> 
                <tr>
                  <td>25-29 years</td>
                  <td><?php echo $val3Birth?></td>
                  <td><?php echo number_format(($val3Birth / intval($total)) * 100 ) . "%"?></td>
                </tr>
                <tr>
                  <td>30-34 years</td>
                  <td><?php echo $val4Birth?></td>
                  <td><?php echo number_format(($val4Birth / intval($total)) * 100 ) . "%"?></td>
                </tr>
                <tr>
                  <td>35-39 years</td>
                  <td><?php echo $val5Birth?></td>
                  <td><?php echo number_format(($val5Birth / intval($total)) * 100 ) . "%"?></td>
                </tr>
                <tr>
                  <td>40 years and above</td>
                  <td><?php echo $val6Birth?></td>
                  <td><?php echo number_format(($val6Birth / intval($total)) * 100 ) . "%"?></td>
                </tr>

              </tbody>
            </table><?php
          }
        }
      }
    ?>
  </div>
</form>