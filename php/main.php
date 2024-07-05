<?php
  include("connection.php");
  include("../sms/vendor/autoload.php");

  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  // sign in
  if(isset($_POST['signinUsername']) && isset($_POST['signinPassword'])){
    $username = mysqli_real_escape_string($conn, $_POST['signinUsername']);
    $password = sha1($_POST['signinPassword']);
    $response = array();

    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE BINARY `username`='$username' AND `password`='$password'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      setcookie("_HC",$rows['user_token'], time() + (86400 * 30), "/");
      $response['status'] = "success";
      $response['role'] = $rows['role'];
    }
    else{
      $response['status'] = "error";
    }

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // add center
  if(isset($_POST['addCenter'])){
    $response = array();
    $centerName = mysqli_real_escape_string($conn, $_POST['addCenter'][0]);

    $query = mysqli_query($conn, "SELECT * FROM `center` WHERE `center_name`='$centerName'");
    if(mysqli_num_rows($query)>0){
      $response['status'] = "error";      
    }
    else{
      $response['status'] = "success";
      mysqli_query($conn, "INSERT INTO `center`(`center_name`) VALUES('$centerName')");
    }
    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // edit center
  if(isset($_POST['editCenterId'])){
    $dataId = $_POST['editCenterId'];
    $query = mysqli_query($conn, "SELECT * FROM `center` WHERE `center_id`=$dataId");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);?>
      <div class="w-100">
        <label class="form-label">Health Center Name</label>
        <input type="text" class="form-control" name="editCenter[]" placeholder="Enter the name of health center..." required value="<?php echo $rows['center_name']?>">
      </div>
      <div class="w-100 text-end">
        <button type="submit" class="btn btn-success">Update</button>
      </div><?php
    }
  }

  // update center
  if(isset($_POST['editCenter']) && isset($_POST['updateCenterId'])){
    $response = array();
    $centerName = mysqli_real_escape_string($conn, $_POST['editCenter'][0]);
    $dataId = $_POST['updateCenterId'];

    $query = mysqli_query($conn, "SELECT * FROM `center` WHERE `center_name`='$centerName'");
    if(mysqli_num_rows($query)>0){
      $response['status'] = "error";      
    }
    else{
      $response['status'] = "success";
      mysqli_query($conn, "UPDATE `center` SET `center_name`='$centerName' WHERE `center_id`=$dataId");
    }
    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // add account
  if(isset($_POST['addAccount'])){
    $centerName = mysqli_real_escape_string($conn, $_POST['addAccount'][0]);
    $username = mysqli_real_escape_string($conn, $_POST['addAccount'][1]);
    $password = sha1($_POST['addAccount'][2]);
    $fullname = mysqli_real_escape_string($conn, $_POST['addAccount'][3]);
    $email = mysqli_real_escape_string($conn, $_POST['addAccount'][4]);
    $contact = mysqli_real_escape_string($conn, $_POST['addAccount'][5]);
    $role = mysqli_real_escape_string($conn, $_POST['addAccount'][6]);
    $desc = mysqli_real_escape_string($conn, $_POST['addAccount'][7]);
    $userToken = sha1($username);
    $response = array();

    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE BINARY `username`='$username'");
    if(mysqli_num_rows($query)>0){
      $response['status'] = "error";
    }
    else{
      $response['status'] = "success";

      $query1 = mysqli_query($conn, "SELECT * FROM `center` WHERE `center_name`='$centerName'");
      if(mysqli_num_rows($query1)>0){
        $rows1 = mysqli_fetch_assoc($query1);
        $centerId = $rows1['center_id'];
        mysqli_query($conn, "INSERT INTO `user`(`username`,`password`,`fullname`,`email`,`contact`,`role`,`role_desc`,`user_token`,`center_id`) VALUES('$username','$password','$fullname','$email','$contact','$role','$desc','$userToken',$centerId)");
      }      
    }

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // edit account
  if(isset($_POST['editAccountId'])){
    $dataId = $_POST['editAccountId'];
    $query = mysqli_query($conn, "SELECT * FROM `user` INNER JOIN `center` ON `user`.`center_id` = `center`.`center_id` WHERE `user_id`=$dataId");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);?>
      <div class="w-100">
        <label class="form-label">Health Center</label>
        <input type="text" class="form-control" disabled placeholder="..." value="<?php echo $rows['center_name']?>">
      </div>
      <div class="w-100">
        <label class="form-label">Username</label>
        <input type="text" class="form-control" disabled placeholder="..." value="<?php echo $rows['username']?>">
      </div>
      <div class="w-100">
        <label class="form-label">New password (optional)</label>
        <input type="password" class="form-control" name="editAccount[]" id="editAccountNewPassword" placeholder="...">
      </div>
      <div class="w-100">
        <label class="form-label">Confirm password (optional)</label>
        <input type="password" class="form-control" placeholder="..." id="editAccountConfirmPassword">
      </div>
      <div class="w-100">
        <label class="form-label">Fullname</label>
        <input type="text" class="form-control" name="editAccount[]" placeholder="..." required value="<?php echo $rows['fullname']?>">
      </div>
      <div class="w-100">
        <label class="form-label">Email (optional)</label>
        <input type="email" class="form-control" name="editAccount[]" placeholder="..." value="<?php echo $rows['email']?>">
      </div>
      <div class="w-100">
        <label class="form-label">Contact no.</label>
        <input type="number" class="form-control" name="editAccount[]" placeholder="..." required value="<?php echo $rows['contact']?>">
      </div>
      <div class="w-100">
        <label class="form-label">Role</label>
        <input type="text" class="form-control" placeholder="..." disabled value="<?php echo $rows['role']?>">
      </div>
      <div class="w-100">
        <label class="form-label">Role description</label>
        <input type="text" class="form-control" name="editAccount[]" placeholder="..." required value="<?php echo $rows['role_desc']?>">
      </div>
      <div class="w-100 text-end">
        <button type="submit" class="btn btn-success">Update</button>
      </div><?php
    }
  }

  // update account
  if(isset($_POST['editAccount']) && isset($_POST['updateAccountId'])){
    $response = array();
    $dataId = $_POST['updateAccountId'];
    $password = sha1($_POST['editAccount'][0]);
    $fullname = mysqli_real_escape_string($conn, $_POST['editAccount'][1]);
    $email = mysqli_real_escape_string($conn, $_POST['editAccount'][2]);
    $contact = mysqli_real_escape_string($conn, $_POST['editAccount'][3]);
    $desc = mysqli_real_escape_string($conn, $_POST['editAccount'][4]);
    $response = array();

    if(empty(trim($_POST['editAccount'][0])))
      $sql = "UPDATE `user` SET `fullname`='$fullname', `email`='$email', `contact`='$contact', `role_desc`='$desc' WHERE `user_id`=$dataId";
    else
      $sql = "UPDATE `user` SET `password`='$password', `fullname`='$fullname', `email`='$email', `contact`='$contact', `role_desc`='$desc' WHERE `user_id`=$dataId";

    mysqli_query($conn, $sql);
    $response['status'] = "success";

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // add patient
  if(isset($_POST['addPatient'])){
    $firstName = mysqli_real_escape_string($conn, $_POST['addPatient'][0]);
    $middleName = mysqli_real_escape_string($conn, $_POST['addPatient'][1]);
    $lastName = mysqli_real_escape_string($conn, $_POST['addPatient'][2]);
    $birthDate = mysqli_real_escape_string($conn, $_POST['addPatient'][3]);
    $address = mysqli_real_escape_string($conn, $_POST['addPatient'][4]);
    $occupation = mysqli_real_escape_string($conn, $_POST['addPatient'][5]);
    $bloodType = mysqli_real_escape_string($conn, $_POST['addPatient'][6]);
    $contact = mysqli_real_escape_string($conn, $_POST['addPatient'][7]);
    $email = mysqli_real_escape_string($conn, $_POST['addPatient'][8]);
    $response = array();
  
    $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      $centerId = $rows['center_id'];
      $userId = $rows['user_id'];

      // generate 6 digits code for the patient
      do{
        $code = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        $count = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) FROM `patient` WHERE `patient_code`='$code'"))[0];
      }
      while($count > 0);

      // insert patient
      mysqli_query($conn, "INSERT INTO `patient`(`first_name`,`middle_name`,`last_name`,`birth_date`,`address`,`occupation`,`blood_type`,`contact`,`email`,`center_id`,`patient_code`) VALUES('$firstName','$middleName','$lastName','$birthDate','$address','$occupation','$bloodType','$contact','$email','$centerId','$code')");

      $query1 = mysqli_query($conn, "SELECT * FROM `patient` ORDER BY `patient_id` DESC LIMIT 1");
      if(mysqli_num_rows($query1)>0){
        $rows1 = mysqli_fetch_assoc($query1);
        $patientId = $rows1['patient_id'];

        // insert patient history
        mysqli_query($conn, "INSERT INTO `patient_history`(`description`,`user_id`,`datetime`,`patient_id`) VALUES('Added',$userId,NOW(),$patientId)");

        $response['status'] = "success";
      }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // managed by patient
  if(isset($_POST['managedById'])){
    $dataId = $_POST['managedById'];    
    $query = mysqli_query($conn, "SELECT * FROM `patient_history` INNER JOIN `user` ON `patient_history`.`user_id` = `user`.`user_id` INNER JOIN `center` ON `user`.`center_id` = `center`.`center_id` WHERE `patient_id`=$dataId ORDER BY `datetime` DESC");
    if(mysqli_num_rows($query)>0){
      while($rows = mysqli_fetch_assoc($query)){?>
        <tr>
          <td><?php echo htmlspecialchars($rows['datetime'])?></td>
          <td><?php echo htmlspecialchars($rows['description'])?></td>
          <td><?php echo htmlspecialchars($rows['fullname'])?></td>
          <td><?php echo htmlspecialchars($rows['center_name'])?></td>
        </tr><?php
      }
    }
    else{?>
      <tr><td colspan="3">No results</td></tr><?php
    }
  }

  // edit patient
  if(isset($_POST['editPatientId'])){
    $dataId = $_POST['editPatientId'];
    $query = mysqli_query($conn, "SELECT * FROM `patient` WHERE `patient_id`=$dataId");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);?>
      <div class="w-100">
        <label class="form-label">First name</label>
        <input type="text" class="form-control" required name="editPatient[]" placeholder="..." value="<?php echo $rows['first_name']?>">
      </div>
      <div class="w-100">
        <label class="form-label">Middle name (optional)</label>
        <input type="text" class="form-control" name="editPatient[]" placeholder="..." value="<?php echo $rows['middle_name']?>">
      </div>
      <div class="w-100">
        <label class="form-label">Last name</label>
        <input type="text" class="form-control" required name="editPatient[]" placeholder="..." value="<?php echo $rows['last_name']?>">
      </div>
      <div class="w-100">
        <label class="form-label">Birth date</label>
        <input type="date" class="form-control" required name="editPatient[]" placeholder="..." value="<?php echo $rows['birth_date']?>">
      </div>
      <div class="w-100">
        <label class="form-label">Address</label>
        <input type="text" class="form-control" required name="editPatient[]" placeholder="..." value="<?php echo $rows['address']?>">
      </div>
      <div class="w-100">
        <label class="form-label">Occupation</label>
        <input type="text" class="form-control" required name="editPatient[]" placeholder="..." value="<?php echo $rows['occupation']?>">
      </div>
      <div class="w-100">
        <label class="form-label">Blood_type</label>
        <select class="form-select" required name="editPatient[]">
          <?php
            $types = array("A+","A-","B+","B-","AB+","AB-","O+","O-");
            foreach($types as $type){
              if($rows['blood_type'] === $type){?>
                <option selected value="<?php echo $type?>"><?php echo htmlspecialchars($type)?></option><?php
              }
              else{?>
                <option value="<?php echo $type?>"><?php echo htmlspecialchars($type)?></option><?php
              }
            }
          ?>
        </select>
      </div>
      <div class="w-100">
        <label class="form-label">Contact no.</label>
        <input type="number" class="form-control" required name="editPatient[]" placeholder="..." value="<?php echo $rows['contact']?>">
      </div>
      <div class="w-100">
        <label class="form-label">Email (optional)</label>
        <input type="email" class="form-control" name="editPatient[]" placeholder="..." value="<?php echo $rows['email']?>">
      </div>
      <div class="w-100 text-end">
        <button type="submit" class="btn btn-success">Update</button>
      </div><?php
    }
  }

  // update patient
  if(isset($_POST['updatePatientId']) && isset($_POST['editPatient'])){
    $firstName = mysqli_real_escape_string($conn, $_POST['editPatient'][0]);
    $middleName = mysqli_real_escape_string($conn, $_POST['editPatient'][1]);
    $lastName = mysqli_real_escape_string($conn, $_POST['editPatient'][2]);
    $birthDate = mysqli_real_escape_string($conn, $_POST['editPatient'][3]);
    $address = mysqli_real_escape_string($conn, $_POST['editPatient'][4]);
    $occupation = mysqli_real_escape_string($conn, $_POST['editPatient'][5]);
    $bloodType = mysqli_real_escape_string($conn, $_POST['editPatient'][6]);
    $contact = mysqli_real_escape_string($conn, $_POST['editPatient'][7]);
    $email = mysqli_real_escape_string($conn, $_POST['editPatient'][8]);
    $patientId = $_POST['updatePatientId'];
    $response = array();
  
    $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      $centerId = $rows['center_id'];
      $userId = $rows['user_id'];

      //  update patient
      mysqli_query($conn, "UPDATE `patient` SET `first_name`='$firstName', `middle_name`='$middleName', `last_name`='$lastName', `birth_date`='$birthDate', `address`='$address', `occupation`='$occupation', `blood_type`='$bloodType', `contact`='$contact', `email`='$email' WHERE `patient_id`=$patientId");

      // insert patient history
      mysqli_query($conn, "INSERT INTO `patient_history`(`description`,`user_id`,`datetime`,`patient_id`) VALUES('Updated',$userId,NOW(),$patientId)");

      $response['status'] = "success";
    }

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // add first checkup
  if(isset($_POST['addFirstCheckup']) && isset($_POST['addFirstCheckupId'])){
    $weight = mysqli_real_escape_string($conn, $_POST['addFirstCheckup'][0]);
    $height = mysqli_real_escape_string($conn, $_POST['addFirstCheckup'][1]);
    $bmi = mysqli_real_escape_string($conn, $_POST['addFirstCheckup'][2]);
    $lastMenstrual = mysqli_real_escape_string($conn, $_POST['addFirstCheckup'][3]);
    $expectedDate = mysqli_real_escape_string($conn, $_POST['addFirstCheckup'][4]);
    $dataId = $_POST['addFirstCheckupId'];
    $response = array();

    // get patient birth date
    $query3= mysqli_query($conn, "SELECT * FROM `patient` WHERE `patient_id`=$dataId");
    if(mysqli_num_rows($query3)>0){
      $rows3 = mysqli_fetch_assoc($query3);
      $patientBirthDate = $rows3['birth_date'];
      $age = date_diff(date_create($patientBirthDate), date_create(date("Y-m-d")))->format("%y");

      $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
      $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
      if(mysqli_num_rows($query)>0){
        $rows = mysqli_fetch_assoc($query);
        $centerId = $rows['center_id'];
        $userId = $rows['user_id'];

        // insert maternal
        mysqli_query($conn, "INSERT INTO `maternal`(`patient_status`,`datetime_died`,`patient_id`,`center_id`,`remarks`) VALUES('Alive','',$dataId,$centerId,'')");

        //insert history
        mysqli_query($conn, "INSERT INTO `history`(`description`,`user_id`,`datetime`) VALUES('Added',$userId,NOW())");

        //get maternal id
        $query1 = mysqli_query($conn, "SELECT * FROM `maternal` ORDER BY `maternal_id` DESC LIMIT 1");
        if(mysqli_num_rows($query1)>0){
          $rows1 = mysqli_fetch_assoc($query1);
          $maternalId = $rows1['maternal_id'];

          // get history id
          $query2 = mysqli_query($conn, "SELECT * FROM `history` ORDER BY `history_id` DESC LIMIT 1");
          if(mysqli_num_rows($query2)>0){
            $rows2 = mysqli_fetch_assoc($query2);
            $historyId = $rows2['history_id'];

            // insert first checkup
            mysqli_query($conn, "INSERT INTO `checkup`(`checkup_date`,`age`,`weight`,`height`,`bmi`,`last_menstrual`,`expected_delivery`,`maternal_id`,`history_id`) VALUES(NOW(),'$age','$weight','$height','$bmi','$lastMenstrual','$expectedDate',$maternalId,$historyId)");

            $response['status'] = "success";
          }
        }
      }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // view first checkup
  if(isset($_POST['viewFirstCheckupId'])){
    $dataId = $_POST['viewFirstCheckupId'];

    $query = mysqli_query($conn, "SELECT * FROM `checkup` INNER JOIN `history` ON `checkup`.`history_id` = `history`.`history_id` INNER JOIN `user` ON `history`.`user_id` = `user`.`user_id` INNER JOIN `center` ON `user`.`center_id` = `center`.`center_id` WHERE `maternal_id`=$dataId");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);?>
      <table class="table">
        <thead>
          <tr>
            <th>Checkup_date</th>
            <th>Age</th>
            <th>Weight</th>
            <th>Height</th>
            <th>BMI</th>
            <th>Last_menstrual_period</th>
            <th>Expected_delivery</th>
          </tr>
        </thead>
        <tbody>
          <td><?php echo htmlspecialchars($rows['checkup_date'])?></td>
          <td><?php echo htmlspecialchars($rows['age'])?></td>
          <td><?php echo htmlspecialchars($rows['weight'])?></td>
          <td><?php echo htmlspecialchars($rows['height'])?></td>
          <td><?php echo htmlspecialchars($rows['bmi'])?></td>
          <td><?php echo htmlspecialchars($rows['last_menstrual'])?></td>
          <td><?php echo htmlspecialchars($rows['expected_delivery'])?></td>
        </tbody>
      </table>
      
      <h5>Managed by</h5>
      <table class="table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Author</th>
            <th>Health_Center</th>
          </tr>
        </thead>
        <tbody>
          <td><?php echo htmlspecialchars($rows['datetime'])?></td>
          <td><?php echo htmlspecialchars($rows['description'])?></td>
          <td><?php echo htmlspecialchars($rows['fullname'])?></td>
          <td><?php echo htmlspecialchars($rows['center_name'])?></td>
        </tbody>
      </table><?php
    }
  }

  // add trimester
  if(isset($_POST['addTrimesterId']) && isset($_POST['addTrimesterType']) && isset($_POST['addFirstTrimester']) && isset($_POST['addSecondTrimester']) && isset($_POST['addLastTrimester'])){
    $dataId = $_POST['addTrimesterId'];
    $typeTrimester = mysqli_real_escape_string($conn, $_POST['addTrimesterType']);
    $response = array();
    
    $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      $centerId = $rows['center_id'];
      $userId = $rows['user_id'];

      // insert history
      mysqli_query($conn, "INSERT INTO `history`(`description`,`user_id`,`datetime`) VALUES('Added',$userId,NOW())");

      $query1 = mysqli_query($conn, "SELECT * FROM `history` ORDER BY `history_id` DESC LIMIT 1");
      if(mysqli_num_rows($query1)>0){
        $rows1 = mysqli_fetch_assoc($query1);
        $historyId = $rows1['history_id'];

        // First Trimester
        if($typeTrimester === "First Trimester"){
          $weight = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][0]);
          $height = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][1]);
          $ageGestation = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][2]);
          $bloodPressure = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][3]);
          $nutritional = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][4]);
          $pagbuo = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][5]);
          $pagsusuri = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][6]);
          $laboratory = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][7]);
          $hemoglobin = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][8]);
          $urinalysis = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][9]);
          $cbc = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][10]);
          $sti = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][11]);
          $stool = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][12]);
          $acetic = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][13]);
          $tetanus = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][14]);
          $treatments = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][15]);
          $pinag_usapan = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][16]);
          $date_return = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][17]);
          $remarks = mysqli_real_escape_string($conn, $_POST['addFirstTrimester'][18]);

          mysqli_query($conn, "INSERT INTO `first_trimester`(`date`,`weight`,`height`,`age_gestation`,`blood_pressure`,`nutritional`,`pagbuo`,`pagsusuri`,`laboratory`,`hemoglobin`,`urinalysis`,`cbc`,`sti`,`stool`,`acetic`,`tetanus`,`treatments`,`pinag_usapan`,`date_return`,`remarks`,`maternal_id`,`history_id`) VALUES(NOW(),'$weight','$height','$ageGestation','$bloodPressure','$nutritional','$pagbuo','$pagsusuri','$laboratory','$hemoglobin','$urinalysis','$cbc','$sti','$stool','$acetic','$tetanus','$treatments','$pinag_usapan','$date_return','$remarks',$dataId,$historyId)");

          $response['status'] = "success";
        }
        // Second Trimester
        elseif($typeTrimester === "Second Trimester"){
          $weight = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][0]);
          $height = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][1]);
          $age = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][2]);
          $bloodPressure = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][3]);
          $nutritional = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][4]);
          $buntis = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][5]);
          $payong = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][6]);
          $birthPlan = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][7]);
          $ngipin = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][8]);
          $laboratory = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][9]);
          $urinalysis = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][10]);
          $cbc = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][11]);
          $etiologic = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][12]);
          $smear = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][13]);
          $diabetes = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][14]);
          $bacteriuria = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][15]);
          $treatments = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][16]);
          $pinag_usapan = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][17]);
          $date_return = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][18]);
          $remarks = mysqli_real_escape_string($conn, $_POST['addSecondTrimester'][19]);

          mysqli_query($conn, "INSERT INTO `second_trimester`(`date`,`weight`,`height`,`age`,`blood_pressure`,`nutritional`,`buntis`,`payong`,`birthplan`,`ngipin`,`laboratory`,`urinalysis`,`cbc`,`etiologic`,`smear`,`diabetes`,`bacteriuria`,`treatments`,`pinag_usapan`,`date_return`,`remarks`,`maternal_id`,`history_id`) VALUES(NOW(),'$weight','$height','$age','$bloodPressure','$nutritional','$buntis','$payong','$birthPlan','$ngipin','$laboratory','$urinalysis','$cbc','$etiologic','$smear','$diabetes','$bacteriuria','$treatments','$pinag_usapan','$date_return','$remarks',$dataId,$historyId)");

          $response['status'] = "success";
        }
        // Last Trimester
        elseif($typeTrimester === "Last Trimester"){
          $weight = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][0]);
          $height = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][1]);
          $age = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][2]);
          $bloodPressure = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][3]);
          $nutritional = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][4]);
          $buntis = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][5]);
          $payong = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][6]);
          $birthPlan = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][7]);
          $ngipin = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][8]);
          $laboratory = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][9]);
          $urinalysis = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][10]);
          $cbc = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][11]);
          $bacteriuria = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][12]);
          $blood_rh = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][13]);
          $treatments = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][14]);
          $pinag_usapan = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][15]);
          $date_return = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][16]);
          $remarks = mysqli_real_escape_string($conn, $_POST['addLastTrimester'][17]);

          mysqli_query($conn, "INSERT INTO `last_trimester`(`date`,`weight`,`height`,`age`,`blood_pressure`,`nutritional`,`buntis`,`payong`,`birthplan`,`ngipin`,`laboratory`,`urinalysis`,`cbc`,`bacteriuria`,`blood_rh`,`treatments`,`pinag_usapan`,`date_return`,`remarks`,`maternal_id`,`history_id`) VALUES(NOW(),'$weight','$height','$age','$bloodPressure','$nutritional','$buntis','$payong','$birthPlan','$ngipin','$laboratory','$urinalysis','$cbc','$bacteriuria','$blood_rh','$treatments','$pinag_usapan','$date_return','$remarks',$dataId,$historyId)");

          $response['status'] = "success";
        }
      }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // view trimester
  if(isset($_POST['viewTrimesterId']) && isset($_POST['viewTrimesterType'])){
    
    $dataId = $_POST['viewTrimesterId'];
    $typeTrimester = mysqli_real_escape_string($conn, $_POST['viewTrimesterType']);

    // First Trimester
    if($typeTrimester === "First Trimester"){
      $query = mysqli_query($conn, "SELECT * FROM `first_trimester` INNER JOIN `history` ON `first_trimester`.`history_id` = `history`.`history_id` INNER JOIN `user` ON `history`.`user_id` = `user`.`user_id` INNER JOIN `center` ON `user`.`center_id` = `center`.`center_id` WHERE `first_trimester_id`=$dataId");
      if(mysqli_num_rows($query)>0){
        $rows = mysqli_fetch_assoc($query);?>

        <div class="d-flex align-items-start justify-content-start gap-3 flex-wrap w-100 mb-2">
          <div class="w-100">
            <label class="form-label">Weight</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['weight']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Height</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['height']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Age of Gestation</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['age_gestation']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Blood Pressure</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['blood_pressure']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Nutritional Status</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['nutritional']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Pagbuo ng Birth Plan</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['pagbuo'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Pagsusuri ng ngipin</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['pagsusuri'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Laboratory Tests Done</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['laboratory'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Hemoglobin count</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['hemoglobin'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Urinalysis</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['urinalysis'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Complete Blood Count (CBC)</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['cbc'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">STIs gamit ang syndromic approach</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['sti']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Stool Examination</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['stool'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Acetic Acid Wash</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['acetic'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Tetanus-containing Vaccine</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['tetanus'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Treatments</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['treatments']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Pinag-usapan/Serbisyong ibinigay</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['pinag_usapan'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Petsa ng Pagbalik</label>
            <input type="date" class="form-control" placeholder="..." readonly value="<?php echo $rows['date_return']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Remarks</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['remarks'])?></textarea>
          </div>
        </div>
        
        <h5>Managed by</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Description</th>
              <th>Author</th>
              <th>Health_Center</th>
            </tr>
          </thead>
          <tbody>
            <td><?php echo htmlspecialchars($rows['datetime'])?></td>
            <td><?php echo htmlspecialchars($rows['description'])?></td>
            <td><?php echo htmlspecialchars($rows['fullname'])?></td>
            <td><?php echo htmlspecialchars($rows['center_name'])?></td>
          </tbody>
        </table><?php
      }
    }
    // Second Trimester
    elseif($typeTrimester === "Second Trimester"){
      $query = mysqli_query($conn, "SELECT * FROM `second_trimester` INNER JOIN `history` ON `second_trimester`.`history_id` = `history`.`history_id` INNER JOIN `user` ON `history`.`user_id` = `user`.`user_id` INNER JOIN `center` ON `user`.`center_id` = `center`.`center_id` WHERE `second_trimester_id`=$dataId");
      if(mysqli_num_rows($query)>0){
        $rows = mysqli_fetch_assoc($query);?>

        <div class="d-flex align-items-start justify-content-start gap-3 flex-wrap w-100 mb-2">
          <div class="w-100">
            <label class="form-label">Weight</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['weight']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Height</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['height']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Age of Gestation</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['age']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Blood Pressure</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['blood_pressure']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Nutritional Status</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['nutritional']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Pagsusuri ng kalagayan ng buntis</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['buntis'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Mga payong binigay</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['payong'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Mga pagbabago sa Birth Plan</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['birthplan'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Pagsusuri ng ngipin</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['ngipin'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Laboratory Tests Done</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['laboratory'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Urinalysis</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['urinalysis'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Complete Blood Count (CBC)</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['cbc'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Etiologic tests para sa STIs, kung kailangan</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['etiologic'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Pap Smear, kung kinakailangan</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['smear'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Gestational diabetes (oral glucose challenge test), kung kinakailangan</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['diabetes'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Bacteriuria, kung kinakailangan</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['bacteriuria'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Treatments</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['treatments']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Pinag-usapan/Serbisyong ibinigay</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['pinag_usapan'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Petsa ng Pagbalik</label>
            <input type="date" class="form-control" placeholder="..." readonly value="<?php echo $rows['date_return']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Remarks</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['remarks'])?></textarea>
          </div>
        </div>

        <h5>Managed by</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Description</th>
              <th>Author</th>
              <th>Health_Center</th>
            </tr>
          </thead>
          <tbody>
            <td><?php echo htmlspecialchars($rows['datetime'])?></td>
            <td><?php echo htmlspecialchars($rows['description'])?></td>
            <td><?php echo htmlspecialchars($rows['fullname'])?></td>
            <td><?php echo htmlspecialchars($rows['center_name'])?></td>
          </tbody>
        </table><?php      
      }
    }
    // Last Trimester
    elseif($typeTrimester === "Last Trimester"){
      $query = mysqli_query($conn, "SELECT * FROM `last_trimester` INNER JOIN `history` ON `last_trimester`.`history_id` = `history`.`history_id` INNER JOIN `user` ON `history`.`user_id` = `user`.`user_id` INNER JOIN `center` ON `user`.`center_id` = `center`.`center_id` WHERE `last_trimester_id`=$dataId");
      if(mysqli_num_rows($query)>0){
        $rows = mysqli_fetch_assoc($query);?>

        <div class="d-flex align-items-start justify-content-start gap-3 flex-wrap w-100 mb-2">
          <div class="w-100">
            <label class="form-label">Weight</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['weight']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Height</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['height']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Age of Gestation</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['age']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Blood Pressure</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['blood_pressure']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Nutritional Status</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['nutritional']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Pagsusuri ng kalagayan ng buntis</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['buntis'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Mga payong binigay</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['payong'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Mga pagbabago sa Birth Plan</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['birthplan'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Pagsusuri ng ngipin</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['ngipin'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Laboratory Tests Done</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['laboratory'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Urinalysis</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['urinalysis'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Complete Blood Count (CBC)</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['cbc'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Bacteriuria, kung kinakailangan</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['bacteriuria'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Blood/RH group, kung kinakailangan</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['blood_rh'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Treatments</label>
            <input type="text" class="form-control" placeholder="..." readonly value="<?php echo $rows['treatments']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Pinag-usapan/Serbisyong ibinigay</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['pinag_usapan'])?></textarea>
          </div>
          <div class="w-100">
            <label class="form-label">Petsa ng Pagbalik</label>
            <input type="date" class="form-control" placeholder="..." readonly value="<?php echo $rows['date_return']?>">
          </div>
          <div class="w-100">
            <label class="form-label">Remarks</label>
            <textarea class="form-control" placeholder="..." readonly><?php echo htmlspecialchars($rows['remarks'])?></textarea>
          </div>
        </div>
      
        <h5>Managed by</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Date</th>
              <th>Description</th>
              <th>Author</th>
              <th>Health_Center</th>
            </tr>
          </thead>
          <tbody>
            <td><?php echo htmlspecialchars($rows['datetime'])?></td>
            <td><?php echo htmlspecialchars($rows['description'])?></td>
            <td><?php echo htmlspecialchars($rows['fullname'])?></td>
            <td><?php echo htmlspecialchars($rows['center_name'])?></td>
          </tbody>
        </table><?php 
      }
    }
  }

  // patient imm
  if(isset($_POST['patientImmGiven']) && isset($_POST['patientImmReturn']) && isset($_POST['patientImmId'])){
    $dataId = $_POST['patientImmId'];
    $response = array();

    $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      $centerId = $rows['center_id'];
      $userId = $rows['user_id'];

      for($index = 0; $index < count($_POST['patientImmGiven']); $index++){
        if(!empty($_POST['patientImmGiven'][$index]) && !empty($_POST['patientImmReturn'][$index])){
          // insert history
          mysqli_query($conn, "INSERT INTO `history`(`description`,`user_id`,`datetime`) VALUES('Added',$userId,NOW())");

          $query1 = mysqli_query($conn, "SELECT * FROM `history` ORDER BY `history_id` DESC LIMIT 1");
          if(mysqli_num_rows($query1)>0){
            $rows1 = mysqli_fetch_assoc($query1);
            $historyId = $rows1['history_id'];

            mysqli_query($conn, "INSERT INTO `patient_imm`(`date_given`,`when_return`,`maternal_id`,`history_id`) VALUES('".$_POST['patientImmGiven'][$index]."','".$_POST['patientImmReturn'][$index]."',$dataId,$historyId)");
          }
        }
      }

      $response['status'] = "success";
    }
    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // patient imm managed by
  if(isset($_POST['patientImmManagedId'])){
    $dataId = $_POST['patientImmManagedId'];

    $query = mysqli_query($conn, "SELECT * FROM `patient_imm` INNER JOIN `history` ON `patient_imm`.`history_id` = `history`.`history_id` INNER JOIN `user` ON `history`.`user_id` = `user`.`user_id` INNER JOIN `center` ON `user`.`center_id` = `center`.`center_id` WHERE `patient_imm_id`=$dataId");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);?>
      <table class="table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Author</th>
            <th>Health_Center</th>
          </tr>
        </thead>
        <tbody>
          <td><?php echo htmlspecialchars($rows['datetime'])?></td>
          <td><?php echo htmlspecialchars($rows['description'])?></td>
          <td><?php echo htmlspecialchars($rows['fullname'])?></td>
          <td><?php echo htmlspecialchars($rows['center_name'])?></td>
        </tbody>
      </table><?php
    }
  }

  // add baby
  if(isset($_POST['addBabyFormId']) && isset($_POST['addBabyFormBabies']) && isset($_POST['updatePatientStatus']) && isset($_POST['addFather'])){
    $dataId = $_POST['addBabyFormId'];
    $response = array();

    // update patient status
    $patientStatus = mysqli_real_escape_string($conn, $_POST['updatePatientStatus'][0]);
    $patientDied = mysqli_real_escape_string($conn, $_POST['updatePatientStatus'][1]);
    $patientRemarks = mysqli_real_escape_string($conn, $_POST['updatePatientStatus'][2]);
    if($patientStatus === "Died"){
      mysqli_query($conn, "UPDATE `maternal` SET `patient_status`='Died', `datetime_died`='$patientDied', `remarks`='$patientRemarks' WHERE `maternal_id`=$dataId");
    }

    // get userId and centerId
    $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      $centerId = $rows['center_id'];
      $userId = $rows['user_id'];

      // insert history
      mysqli_query($conn, "INSERT INTO `history`(`description`,`user_id`,`datetime`) VALUES('Added',$userId,NOW())");

      // get historyId
      $query1 = mysqli_query($conn, "SELECT * FROM `history` ORDER BY `history_id` DESC LIMIT 1");
      if(mysqli_num_rows($query1)>0){
        $rows1 = mysqli_fetch_assoc($query1);
        $historyId = $rows1['history_id'];

        // insert father
        $firstName = mysqli_real_escape_string($conn, $_POST['addFather'][0]);
        $middleName = mysqli_real_escape_string($conn, $_POST['addFather'][1]);
        $lastName = mysqli_real_escape_string($conn, $_POST['addFather'][2]);
        $extensionName = mysqli_real_escape_string($conn, $_POST['addFather'][3]);
        $contact = mysqli_real_escape_string($conn, $_POST['addFather'][4]);
        $address = mysqli_real_escape_string($conn, $_POST['addFather'][5]);
        mysqli_query($conn, "INSERT INTO `father`(`first_name`,`middle_name`,`last_name`,`extension_name`,`contact`,`address`) VALUES('$firstName','$middleName','$lastName','$extensionName','$contact','$address')");

        // get father id
        $query2 = mysqli_query($conn, "SELECT * FROM `father` ORDER BY `father_id` DESC LIMIT 1");
        if(mysqli_num_rows($query2)>0){
          $rows2 = mysqli_fetch_assoc($query2);
          $fatherId = $rows2['father_id'];

          $babies = intval($_POST['addBabyFormBabies']);
          $count = 0;
          for($index=0; $index<$babies; $index++){
            $count++;
            $addBaby = "addBaby$count";

            $typeDelivery = mysqli_real_escape_string($conn, $_POST[$addBaby][0]);
            $firstName = mysqli_real_escape_string($conn, $_POST[$addBaby][1]);
            $middleName = mysqli_real_escape_string($conn, $_POST[$addBaby][2]);
            $lastName = mysqli_real_escape_string($conn, $_POST[$addBaby][3]);
            $extensionName = mysqli_real_escape_string($conn, $_POST[$addBaby][4]);
            $sex = mysqli_real_escape_string($conn, $_POST[$addBaby][5]);
            $dateDelivery = mysqli_real_escape_string($conn, $_POST[$addBaby][6]);
            $placeBirth = mysqli_real_escape_string($conn, $_POST[$addBaby][7]);
            $bloodType = mysqli_real_escape_string($conn, $_POST[$addBaby][8]);
            $weight = mysqli_real_escape_string($conn, $_POST[$addBaby][9]);
            $length = mysqli_real_escape_string($conn, $_POST[$addBaby][10]);
            $circularHead = mysqli_real_escape_string($conn, $_POST[$addBaby][11]);
            $circularChest = mysqli_real_escape_string($conn, $_POST[$addBaby][12]);
            $status = mysqli_real_escape_string($conn, $_POST[$addBaby][13]);
            $died = mysqli_real_escape_string($conn, $_POST[$addBaby][14]);
            $remarks = mysqli_real_escape_string($conn, $_POST[$addBaby][15]);

            // get patientId 
            $query3 = mysqli_query($conn, "SELECT * FROM `maternal` WHERE `maternal_id`=$dataId");
            if(mysqli_num_rows($query3)>0){
              $rows3 = mysqli_fetch_assoc($query3);
              $patientId = $rows3['patient_id'];

              // get the last childno
              $query4 = mysqli_query($conn, "SELECT * FROM `baby` WHERE `patient_id`=$patientId ORDER BY `baby_id` DESC LIMIt 1");
              if(mysqli_num_rows($query4)>0){
                $rows4 = mysqli_fetch_assoc($query4);
                $childNo = intval($rows4['child_no']) + 1;
              }
              else{
                $childNo = 1;
              }
              mysqli_query($conn, "INSERT INTO `baby`(`type_delivery`,`first_name`,`middle_name`,`last_name`,`extension_name`,`sex`,`datetime_delivery`,`place_birth`,`blood_type`,`weight`,`length`,`circular_head`,`circular_chest`,`baby_status`,`datetime_died`,`remarks`,`maternal_id`,`history_id`,`father_id`,`center_id`,`patient_id`,`child_no`) VALUES('$typeDelivery','$firstName','$middleName','$lastName','$extensionName','$sex','$dateDelivery','$placeBirth','$bloodType','$weight','$length','$circularHead','$circularChest','$status','$died','$remarks',$dataId,$historyId,$fatherId,$centerId,$patientId,'$childNo')");

              $response['status'] = "success";
            }           
          }
        }
      }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // managed by baby
  if(isset($_POST['managedByBabyId'])){
    $dataId = $_POST['managedByBabyId'];    
    $query = mysqli_query($conn, "SELECT * FROM `history` INNER JOIN `user` ON `history`.`user_id` = `user`.`user_id` INNER JOIN `center` ON `user`.`center_id` = `center`.`center_id` WHERE `history_id`=$dataId ORDER BY `datetime` DESC");
    if(mysqli_num_rows($query)>0){
      while($rows = mysqli_fetch_assoc($query)){?>
        <tr>
          <td><?php echo htmlspecialchars($rows['datetime'])?></td>
          <td><?php echo htmlspecialchars($rows['description'])?></td>
          <td><?php echo htmlspecialchars($rows['fullname'])?></td>
          <td><?php echo htmlspecialchars($rows['center_name'])?></td>
        </tr><?php
      }
    }
    else{?>
      <tr><td colspan="3">No results</td></tr><?php
    }
  }

  // father baby
  if(isset($_POST['fatherBabyId'])){
    $dataId = $_POST['fatherBabyId'];    
    $query = mysqli_query($conn, "SELECT * FROM `father` WHERE `father_id`=$dataId");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);

      if(empty($rows['first_name']) && empty($rows['middle_name']) && empty($rows['last_name']) && empty($rows['extension_name']) && empty($rows['contact']) && empty($rows['address'])){?>
        <tr><td colspan="6">No results</td></tr><?php
      }
      else{?>
        <tr>
          <td><?php echo htmlspecialchars($rows['first_name'])?></td>
          <td><?php echo htmlspecialchars($rows['middle_name'])?></td>
          <td><?php echo htmlspecialchars($rows['last_name'])?></td>
          <td><?php echo htmlspecialchars($rows['extension_name'])?></td>
          <td><?php echo htmlspecialchars($rows['contact'])?></td>
          <td><?php echo htmlspecialchars($rows['address'])?></td>
        </tr><?php
      }
    }
    else{?>
      <tr><td colspan="6">No results</td></tr><?php
    }
  }

  // add milestone
  if(isset($_POST['addMilestoneFormId'])){
    $dataId = $_POST['addMilestoneFormId'];
    $desc = mysqli_real_escape_string($conn, $_POST['addMilestone'][0]);
    $response = array();

    // get userId and centerId
    $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      $centerId = $rows['center_id'];
      $userId = $rows['user_id'];

      // insert history
      mysqli_query($conn, "INSERT INTO `history`(`description`,`user_id`,`datetime`) VALUES('Added',$userId,NOW())");

      // get historyId
      $query1 = mysqli_query($conn, "SELECT * FROM `history` ORDER BY `history_id` DESC LIMIT 1");
      if(mysqli_num_rows($query1)>0){
        $rows1 = mysqli_fetch_assoc($query1);
        $historyId = $rows1['history_id'];

        // insert new milestone
        mysqli_query($conn, "INSERT INTO `developmental`(`date_achievement`,`description`,`baby_id`,`history_id`) VALUES(NOW(),'$desc',$dataId, $historyId)");
        $response['status'] = 'success';
      }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // managed by milestone
  if(isset($_POST['managedByMilestoneId'])){
    $dataId = $_POST['managedByMilestoneId'];    
    $query = mysqli_query($conn, "SELECT * FROM `history` INNER JOIN `user` ON `history`.`user_id` = `user`.`user_id` INNER JOIN `center` ON `user`.`center_id` = `center`.`center_id` WHERE `history_id`=$dataId ORDER BY `datetime` DESC");
    if(mysqli_num_rows($query)>0){
      while($rows = mysqli_fetch_assoc($query)){?>
        <tr>
          <td><?php echo htmlspecialchars($rows['datetime'])?></td>
          <td><?php echo htmlspecialchars($rows['description'])?></td>
          <td><?php echo htmlspecialchars($rows['fullname'])?></td>
          <td><?php echo htmlspecialchars($rows['center_name'])?></td>
        </tr><?php
      }
    }
    else{?>
      <tr><td colspan="3">No results</td></tr><?php
    }
  }

  // add metric
  if(isset($_POST['addMetricFormId'])){
    $dataId = $_POST['addMetricFormId'];
    $weight = mysqli_real_escape_string($conn, $_POST['addMetric'][0]);
    $length = mysqli_real_escape_string($conn, $_POST['addMetric'][1]);
    $response = array();

    // get userId and centerId
    $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      $centerId = $rows['center_id'];
      $userId = $rows['user_id'];

      // insert history
      mysqli_query($conn, "INSERT INTO `history`(`description`,`user_id`,`datetime`) VALUES('Added',$userId,NOW())");

      // get historyId
      $query1 = mysqli_query($conn, "SELECT * FROM `history` ORDER BY `history_id` DESC LIMIT 1");
      if(mysqli_num_rows($query1)>0){
        $rows1 = mysqli_fetch_assoc($query1);
        $historyId = $rows1['history_id'];

        // insert new milestone
        mysqli_query($conn, "INSERT INTO `growth`(`date_measurement`,`weight`,`length`,`baby_id`,`history_id`) VALUES(NOW(),'$weight','$length',$dataId, $historyId)");
        $response['status'] = 'success';
      }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // managed by metric
  if(isset($_POST['managedByMetricId'])){
    $dataId = $_POST['managedByMetricId'];    
    $query = mysqli_query($conn, "SELECT * FROM `history` INNER JOIN `user` ON `history`.`user_id` = `user`.`user_id` INNER JOIN `center` ON `user`.`center_id` = `center`.`center_id` WHERE `history_id`=$dataId ORDER BY `datetime` DESC");
    if(mysqli_num_rows($query)>0){
      while($rows = mysqli_fetch_assoc($query)){?>
        <tr>
          <td><?php echo htmlspecialchars($rows['datetime'])?></td>
          <td><?php echo htmlspecialchars($rows['description'])?></td>
          <td><?php echo htmlspecialchars($rows['fullname'])?></td>
          <td><?php echo htmlspecialchars($rows['center_name'])?></td>
        </tr><?php
      }
    }
    else{?>
      <tr><td colspan="3">No results</td></tr><?php
    }
  }

  // baby imm
  if(isset($_POST['babyImmDate']) && isset($_POST['babyImmReturn']) && isset($_POST['babyImmId'])){
    $dataId = $_POST['babyImmId'];
    $response = array();

    $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      $centerId = $rows['center_id'];
      $userId = $rows['user_id'];

      for($index = 0; $index < count($_POST['babyImmDate']); $index++){
        if(!empty($_POST['babyImmDate'][$index]) && !empty($_POST['babyImmReturn'][$index])){
          // insert history
          mysqli_query($conn, "INSERT INTO `history`(`description`,`user_id`,`datetime`) VALUES('Added',$userId,NOW())");

          $query1 = mysqli_query($conn, "SELECT * FROM `history` ORDER BY `history_id` DESC LIMIT 1");
          if(mysqli_num_rows($query1)>0){
            $rows1 = mysqli_fetch_assoc($query1);
            $historyId = $rows1['history_id'];

            mysqli_query($conn, "INSERT INTO `baby_imm`(`vaccine_date`,`when_return`,`baby_id`,`history_id`) VALUES('".$_POST['babyImmDate'][$index]."','".$_POST['babyImmReturn'][$index]."',$dataId,$historyId)");
          }
        }
      }

      $response['status'] = "success";
    }
    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // baby imm managed by
  if(isset($_POST['babyImmManagedId'])){
    $dataId = $_POST['babyImmManagedId'];

    $query = mysqli_query($conn, "SELECT * FROM `baby_imm` INNER JOIN `history` ON `baby_imm`.`history_id` = `history`.`history_id` INNER JOIN `user` ON `history`.`user_id` = `user`.`user_id` INNER JOIN `center` ON `user`.`center_id` = `center`.`center_id` WHERE `baby_imm_id`=$dataId");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);?>
      <table class="table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Author</th>
            <th>Health_Center</th>
          </tr>
        </thead>
        <tbody>
          <td><?php echo htmlspecialchars($rows['datetime'])?></td>
          <td><?php echo htmlspecialchars($rows['description'])?></td>
          <td><?php echo htmlspecialchars($rows['fullname'])?></td>
          <td><?php echo htmlspecialchars($rows['center_name'])?></td>
        </tbody>
      </table><?php
    }
  }
  
  // request now
  if(isset($_POST['requestNowPatientId'])){
    $patientId = $_POST['requestNowPatientId'];
    $response = array();

    $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
    $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_token`='$userToken'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      $senderId = $rows['user_id'];

      // get the center id
      $query1 = mysqli_query($conn, "SELECT * FROM `patient` WHERE `patient_id`=$patientId");
      if(mysqli_num_rows($query1)>0){
        $rows1 = mysqli_fetch_assoc($query1);
        $centerId = $rows1['center_id'];

        // get the admin for the Health center
        $query2 = mysqli_query($conn, "SELECT * FROM `user` WHERE `role`='Admin' AND `center_id`=$centerId");
        if(mysqli_num_rows($query2)>0){
          $rows2 = mysqli_fetch_assoc($query2);
          $receiverId = $rows2['user_id'];

          // check there is already request
          $query3 = mysqli_query($conn, "SELECT * FROM `request` WHERE `sender_id`=$senderId AND `patient_id`=$patientId");
          if(mysqli_num_rows($query3)>0){
            $rows3 = mysqli_fetch_assoc($query3);
            $requestId = $rows3['request_id'];
            mysqli_query($conn, "UPDATE `request` SET `datetime`=NOW(), `allowed`='false' WHERE `request_id`=$requestId");
          }
          else{
            mysqli_query($conn, "INSERT INTO `request`(`sender_id`,`receiver_id`,`patient_id`,`center_id`,`datetime`,`see_sender`) VALUES($senderId,$receiverId,$patientId,$centerId,NOW(),'true')");
          }
          $response['status'] = "success";
        }
      }
    }

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // request read
  if(isset($_POST['requestReadId'])){
    $requestId = $_POST['requestReadId'];
    mysqli_query($conn, "UPDATE `request` SET `see_sender`='true' WHERE `request_id`=$requestId");
  }

  // request accept
  if(isset($_POST['requestAcceptId'])){
    $requestId = $_POST['requestAcceptId'];
    mysqli_query($conn, "UPDATE `request` SET `see_sender`='false', `allowed`='true', `see_receiver`='true' WHERE `request_id`=$requestId");
  }

  // request decline
  if(isset($_POST['requestDeclineId'])){
    $requestId = $_POST['requestDeclineId'];
    mysqli_query($conn, "UPDATE `request` SET `allowed`='false' WHERE `request_id`=$requestId");
  }

  // vew Patient Record
  if(isset($_POST['vewPatientRecordQrcode'])){
    $patientCode = $_POST['vewPatientRecordQrcode'];
    $response = array();
    $query = mysqli_query($conn, "SELECT * FROM `patient` WHERE `patient_code`='$patientCode'");
    if(mysqli_num_rows($query)>0){
      $rows = mysqli_fetch_assoc($query);
      $response['status'] = "success";
    }

    header("Content-Type: application/json");
    echo json_encode($response);
  }

  // confirm phone number
  if(isset($_POST['confirmPhoneNumber']) && isset($_POST['confirmPatientCode'])){
    $phoneNumber = $_POST['confirmPhoneNumber'];
    $patientCode = $_POST['confirmPatientCode'];
    $response = array();

    $query = mysqli_query($conn, "SELECT * FROM `patient` WHERE `contact`='$phoneNumber' AND `patient_code`='$patientCode'");
    if(mysqli_num_rows($query)>0){
      $response['status'] = "success";
    }

    header("Content-Type: application/json");
    echo json_encode($response);
  }


  // send sms
  if(isset($_GET['sendSMS'])){
    $dateNow = date("Y-m-d");

    $message = "Hello Rica Mendiola, this is reminder for your prenatal appointment scheduled on May 02,2024 8:00 am at Sibalom Health Center. Please remember to bring any necessary documents and questions you may have. Looking forward to seeing you then! If you need to reschedule or have any concerns feel free to reach out. Take Care!";

    $basic  = new \Vonage\Client\Credentials\Basic("33308996", "ee5SbtSKyByHethU");
    $client = new \Vonage\Client($basic);

    try{

      // sms for first trimester
      $query = mysqli_query($conn, "SELECT * FROM `first_trimester` WHERE `sms_sent`='false'");
      if(mysqli_num_rows($query)>0){
        while($rows = mysqli_fetch_assoc($query)){

          if($rows['date'] == $dateNow){
            echo $rows['date'];

            $response = $client->sms()->send(
              new \Vonage\SMS\Message\SMS("639771598041", "BRAND_NAME", $message)
            );

            $message = $response->current();
    
            if ($message->getStatus() == 0) {
                mysqli_query($conn, "UPDATE `first_trimester` SET `sms_sent`='true' WHERE `first_trimester_id`=".$rows['first_trimester_id']);
            }
          }
        }
      }

      // sms for second trimester
      $query = mysqli_query($conn, "SELECT * FROM `second_trimester` WHERE `sms_sent`='false'");
      if(mysqli_num_rows($query)>0){
        while($rows = mysqli_fetch_assoc($query)){

          if($rows['date'] == $dateNow){
            echo $rows['date'];

            $response = $client->sms()->send(
              new \Vonage\SMS\Message\SMS("639771598041", "BRAND_NAME", $message)
            );

            $message = $response->current();
    
            if ($message->getStatus() == 0) {
                mysqli_query($conn, "UPDATE `second_trimester` SET `sms_sent`='true' WHERE `second_trimester_id`=".$rows['second_trimester_id']);
            }
          }
        }
      }

      // sms for last trimester
      $query = mysqli_query($conn, "SELECT * FROM `last_trimester` WHERE `sms_sent`='false'");
      if(mysqli_num_rows($query)>0){
        while($rows = mysqli_fetch_assoc($query)){

          if($rows['date'] == $dateNow){
            echo $rows['date'];

            $response = $client->sms()->send(
              new \Vonage\SMS\Message\SMS("639771598041", "BRAND_NAME", $message)
            );

            $message = $response->current();
    
            if ($message->getStatus() == 0) {
                mysqli_query($conn, "UPDATE `last_trimester` SET `sms_sent`='true' WHERE `last_trimester_id`=".$rows['last_trimester_id']);
            }
          }
        }
      }

      // sms for patient immunization
      $query = mysqli_query($conn, "SELECT * FROM `patient_imm` WHERE `sms_sent`='false'");
      if(mysqli_num_rows($query)>0){
        while($rows = mysqli_fetch_assoc($query)){

          if($rows['when_return'] == $dateNow){
            echo $rows['when_return'];

            $response = $client->sms()->send(
              new \Vonage\SMS\Message\SMS("639771598041", "BRAND_NAME", $message)
            );

            $message = $response->current();
    
            if ($message->getStatus() == 0) {
                mysqli_query($conn, "UPDATE `patient_imm` SET `sms_sent`='true' WHERE `patient_imm_id`=".$rows['patient_imm_id']);
            }
          }
        }
      }

      // sms for baby immunization
      $query = mysqli_query($conn, "SELECT * FROM `baby_imm` WHERE `sms_sent`='false'");
      if(mysqli_num_rows($query)>0){
        while($rows = mysqli_fetch_assoc($query)){

          if($rows['when_return'] == $dateNow){
            echo $rows['when_return'];

            $response = $client->sms()->send(
              new \Vonage\SMS\Message\SMS("639771598041", "BRAND_NAME", $message)
            );

            $message = $response->current();
    
            if ($message->getStatus() == 0) {
                mysqli_query($conn, "UPDATE `baby_imm` SET `sms_sent`='true' WHERE `baby_imm_id`=".$rows['baby_imm_id']);
            }
          }
        }
      }




    }
    catch(Exception $e){

    }

  }


      if(isset($_POST['firstCheckupMaternalId'])){
        $maternalId = $_POST['firstCheckupMaternalId'];

      $query = mysqli_query($conn, "SELECT * FROM `checkup` WHERE `maternal_id`=$maternalId");
      if(mysqli_num_rows($query)>0){
        $rows = mysqli_fetch_assoc($query);
        echo $rows['last_menstrual'];
      }
    }

?>