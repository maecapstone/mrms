<?php
    include("./php/connection.php");

    //if user logged in 
    if(isset($_COOKIE['_HC'])){
        $userToken = mysqli_real_escape_string($conn, $_COOKIE['_HC']);
        $query = mysqli_query($conn,"SELECT * FROM `user` WHERE `user_token`='$userToken'");

        if(mysqli_num_rows($query)>0){
            $rowss = mysqli_fetch_array($query);

            if($rowss['role'] === "Super"){
                header("location: ./super/");
            }
            elseif($rowss['role'] === "Admin"){
                header("location: ./admin/");
            }
            else{
              header("location: ./staff/");
          }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maternal Record Management System</title>
    <link rel="icon" href="./images/logo.png">
    <link rel="stylesheet" href="./bootstrap-5.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script type="text/javascript" src="./bootstrap-5.3.1-dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./js/jquery-3.6.0.min.js" defer></script>
    <script type="text/javascript" src="./js/index.js" defer></script>

    <script type="text/javascript" src="./js/adapter.min.js"></script>
    <script type="text/javascript" src="./js/instascan.min.js"></script>
    <script type="text/javascript" src="./js/vue.min.js"></script>
    <script type="text/javascript" src="./js/jquery-3.6.0.min.js"></script>
  </head>
  <body class="bg-success" id="bodyLoginPage">
    <header class="bg-white p-3">
      <aside class="d-flex align-items-center justify-content-start gap-2">
        <img src="./images/logo.svg" alt="logo" width="50" height="50" loading="lazy" class="rounded-circle">
        <h4 class="mb-0 text-success">Maternal Record Management System</h4>
      </aside>
    </header>
    <div class="bg-white text-center p-3 d-flex align-items-center justify-content-center gap-2">
      <h6 class="mb-0">View patient records</h6>
      <span>&rightarrow;</span>
      <button type="button" class="btn btn-light p-0" data-bs-toggle="modal" data-bs-target="#qrcodeModal"><img src="./images/qrcode.svg" alt="icon" width="30" height="30" loading="lazy" id="qrcodeModalButtonOpen"></button>
    </div>
    <section class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 6rem);">
      <form autocomplete="off" class="d-flex align-items-center justify-content-center gap-3 flex-column" id="signinForm">
        <div>
          <img src="./images/logo.svg" alt="logo" width="100" height="100" loading="lazy" class="rounded-circle shadow">
        </div>
        <div class="d-flex align-items-center justify-content-end gap-2 w-100">
          <label for="signinUsername" class="form-label mb-0 text-light w-25">Username:</label>
          <input type="text" id="signinUsername" name="signinUsername" required class="form-control w-75" placeholder="Type your username...">
        </div>
        <div class="d-flex align-items-center justify-content-end gap-2 w-100">
          <label for="signinPassword" class="form-label mb-0 text-light w-25">Password:</label>
          <input type="password" id="signinPassword" name="signinPassword" required class="form-control w-75" placeholder="Type your password...">
        </div>
        <div class="d-flex align-items-center justify-content-end gap-2 w-100">
          <label for="signinDisplayPassword" class="form-label mb-0 text-light">Display password</label>
          <input type="checkbox" class="form-check-input" id="signinDisplayPassword">
        </div>
        <button type="submit" class="btn btn-light w-100">Sign in</button>

        <footer class="mt-3 text-center text-dark">
         <span class="text-light"><a href="terms_and_conditions.php" class="text-light">Terms & Conditions</a> for DATA SHARING.</span><br>
         <span class="text-light opacity-75">mrms &copy; 2024.</span>
        </footer>
      </form>
    </section>

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
              <div class="d-flex align-items-center justify-content-center gap-2 flex-nowrap">
                <input type="number" class="form-control" placeholder="Enter the 6 Digits Code..." required id="qrcodeScan" autocomplete="off">
                <button type="button" class="btn btn-success" id="qrcodeScanOk">Ok</button>
              </div>
              <div class="d-flex align-items-center justify-content-center gap-2 flex-nowrap mt-3 d-none" id="confirmPhoneNumberDiv">
                <input type="number" class="form-control" placeholder="Confirm your phone number..." required id="confirmPhoneNumber" autocomplete="off">
                <button type="button" class="btn btn-success" id="confirmPhoneNumberButton">Confirm</button>
                <a class="d-none" id="viewPatient"></a>
              </div>
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
            $('#qrcodeScanOk')[0].click()
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

        // qrcode scan ok
        $('#qrcodeScanOk').off('click').on('click', function(){
          var patientCode = $('#qrcodeScan').val()
          
          $.post("./php/main.php", {vewPatientRecordQrcode: patientCode}, function(response, status){
            if(status){
              if(response['status'] === "success"){
                $('#confirmPhoneNumberDiv').removeClass('d-none')
              }
              else{
                alert("QR code is invalid.")
              }
            }
          })
        })

        // confirm phone number
        $('#confirmPhoneNumberButton').off('click').on('click', function(){
          var phoneNumber = $('#confirmPhoneNumber').val()
          var patientCode = $('#qrcodeScan').val()
          
          $.post("./php/main.php", {confirmPhoneNumber: phoneNumber, confirmPatientCode: patientCode}, function(response, status){
            if(status){
              if(response['status'] === "success"){
                $('#viewPatient').attr('href', `./patient/?patient_code=${patientCode}&view`)
                $('#viewPatient')[0].click()
              } 
              else{
                alert("Phone number is incorrect.")
              }
            }
          })
        })
      </script>
  </body>
</html>