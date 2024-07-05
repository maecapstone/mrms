$(document).ready(function(){

  // compute BMI
 

   $("#addFirstCheckupHeight").off("input").on("input", function(){
    var height = $(this).val()
    var weight = $("#addFirstCheckupWeight").val()

    var bmi = weight / (height * height)
    $("#addFirstCheckupBMI").val(parseFloat(bmi).toFixed(2))
   
  })

  // display password
  $('#signinDisplayPassword').off('click').on('click', function(){
    if($(this)[0].checked) $('#signinPassword').attr('type','text')
    else $('#signinPassword').attr('type','password')
  })

  // signin
  $('#signinForm').off('submit').on('submit', function(e){
    e.preventDefault()
    var formData = new FormData(this)
    $.ajax({
      url: "./php/main.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response){
        if(response['status'] === 'success'){
          location.href = `./${response['role'].toLowerCase()}/`
        }
        else{
          alert("Incorrect Account.")
        }
      }
    })
  })

  // back button
  $('#backButton').off('click').on('click', function(){
    history.back()
  })

  // add center
  $('#addCenterForm').off('submit').on('submit', function(e){
    e.preventDefault()
    var formData = new FormData(this)
    $.ajax({
      url: "../php/main.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response){
        if(response['status'] === "success"){
          alert('Successfully Added.')
          $('#addCenterForm input').val('')
        }
        else alert('Already Exists.')
      }
    })
  })

  // edit center
  $('.edit-center').off('click').on('click', function(){
    var dataId = $(this).attr('data-id')
    $.post('../php/main.php', {editCenterId : dataId}, function(response, status){
      if(status){
        $('#editCenterForm').html(response)

        // update center
        $('#editCenterForm').off('submit').on('submit', function(e){
          e.preventDefault()
          var formData = new FormData(this)
          formData.append('updateCenterId', dataId)
          $.ajax({
            url: "../php/main.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
              if(response['status'] === "success"){
                alert('Successfully Updated.')
                $('#editCenterModalButtonClose')[0].click()
              }
              else alert('Already Exists.')
            }
          })
        })
      }
    })
  })

  // add account
  $('#addAccountForm').off('submit').on('submit', function(e){
    e.preventDefault()
    var password = $('#addAccountPassword').val()
    var confirm = $('#addAccountConfirmPassword').val()

    if(password === confirm){
      var formData = new FormData(this)
      $.ajax({
        url: "../php/main.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
          if(response['status'] === "success"){
            alert('Successfully Added.')
            $('#addAccountForm input').val('')
          }
          else alert('Username Already Exists.')
        }
      })
    }
    else{
      alert('Password and Confirm password not they same.')
    }
  })

  // edit account
  $('.edit-account').off('click').on('click', function(){
    var dataId = $(this).attr('data-id')
    $.post('../php/main.php', {editAccountId : dataId}, function(response, status){
      if(status){
        $('#editAccountForm').html(response)

        // update account
        $('#editAccountForm').off('submit').on('submit', function(e){
          e.preventDefault()
          var password = $('#editAccountNewPassword').val()
          var confirm = $('#editAccountConfirmPassword').val()

          if(password === confirm){
            var formData = new FormData(this)
            formData.append('updateAccountId', dataId)
            $.ajax({
              url: "../php/main.php",
              type: "POST",
              data: formData,
              contentType: false,
              processData: false,
              success: function(response){
                if(response['status'] === "success"){
                  alert('Successfully Updated.')
                  $('#editAccountModalButtonClose')[0].click()
                }
                else alert('Already Exists.')
              }
            })
          }          
          else{
            alert('New password and Confirm password not they same.')
          }
        })
      }
    })
  })

  // add patient
  $('#addPatientForm').off('submit').on('submit', function(e){
    e.preventDefault()

    var formData = new FormData(this)
    $.ajax({
      url: "../php/main.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response){
        if(response['status'] === "success"){
          alert('Successfully Added.')
          $('#addPatientForm input, select').val('')
        }
        else alert('Something went wrong.')
      }
    })
  })

  // managed by patient
  $('.managed-by').off('click').on('click', function(){
    var dataId = $(this).attr('data-id')
    $.post('../php/main.php', {managedById : dataId}, function(response, status){
      if(status){
        $('#managedByPatientTBody').html(response)
      }
    })
  })

  // edit patient
  $('.edit-patient').off('click').on('click', function(){
    var dataId = $(this).attr('data-id')
    $.post('../php/main.php', {editPatientId : dataId}, function(response, status){
      if(status){
        $('#editPatientForm').html(response)

        // update patient
        $('#editPatientForm').off('submit').on('submit', function(e){
          e.preventDefault()

          var formData = new FormData(this)
          formData.append('updatePatientId', dataId)
          $.ajax({
            url: "../php/main.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response){
              if(response['status'] === "success"){
                alert('Successfully Updated.')
                $('#editPatientModalButtonClose')[0].click()
              }
              else alert('Something went wrong.')
            }
          })
        })
      }
    })
  })

  // print qrcode
  $('#printQR').off('click').on('click', function(){
    window.print()
  })

  // first checkup
  $('#addFirstCheckupForm').off('submit').on('submit', function(e){
    e.preventDefault()
    var dataId = $('#ddFirstCheckupButton').attr('data-id')

    var formData = new FormData(this)
    formData.append('addFirstCheckupId', dataId)
    $.ajax({
      url: "../php/main.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response){
        console.log(response)
        try {
            if(response['status'] === "success"){
            alert('Successfully Added.')
            $('#addFirstCheckupForm input').val('')
            $('#addFirstCheckupModalButtonClose')[0].click()
            }
            else alert('Something went wrong.')
        } catch (e) {
            alert('Error parsing server response.');
            console.log('Parsing error:', e);
            console.log('Response:', response);
        }
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error: ' + textStatus + ' - ' + errorThrown);
        console.log('Error Details:', jqXHR.responseText);
    }
    })
  })

  // view first checkup
  $('.view-first-checkup').off('click').on('click', function(e){
    e.preventDefault()
    var dataId = $(this).attr('data-id')
    $.post("../php/main.php", {viewFirstCheckupId: dataId}, function(response, status){
      if(status){
        $('#viewFirstCheckupModalBody').html(response)
      }
    })
  })

  // type of trimester
  $('#typeTrimester').off('change').on('change', function(){
    var typeTrimester = $(this).val()

    if(typeTrimester === "First Trimester"){
      $('#firstTrimester').removeClass('d-none')
      $('#secondTrimester').addClass('d-none')
      $('#lastTrimester').addClass('d-none')
      $('#buttonTrimester').removeClass('d-none')
    }
    else if(typeTrimester === "Second Trimester"){
      $('#firstTrimester').addClass('d-none')
      $('#secondTrimester').removeClass('d-none')
      $('#lastTrimester').addClass('d-none')
      $('#buttonTrimester').removeClass('d-none')
    }
    else if(typeTrimester === "Last Trimester"){
      $('#firstTrimester').addClass('d-none')
      $('#secondTrimester').addClass('d-none')
      $('#lastTrimester').removeClass('d-none')
      $('#buttonTrimester').removeClass('d-none')
    }
  })

  // add trimester
  $('#addTrimesterForm').off('submit').on('submit', function(e){
    e.preventDefault()
    var dataId = $('#addTrimesterButton').attr('data-id')
    var typeTrimester = $('#typeTrimester').val()

    var formData = new FormData(this)
    formData.append('addTrimesterId', dataId)
    formData.append('addTrimesterType', typeTrimester)
    $.ajax({
      url: "../php/main.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response){
        if(response['status'] === "success"){
          alert('Successfully Added.')
          $('#addTrimesterForm input, select, textarea').val('')
          $('#addTrimesterModalButtonClose')[0].click()
        }
        else alert('Something went wrong.')
      }
    })
  })
  
  // view trimester
  $('.view-trimester').off('click').on('click', function(){
    var dataId = $(this).attr('data-id')
    var typeTrimester = $(this).attr('data-trimester')

    $.post('../php/main.php', {viewTrimesterId: dataId, viewTrimesterType: typeTrimester}, function(response, status){
      if(status){
        $('#viewTrimesterModalBody').html(response)
      }
    })
  })

  // patient imm
  $('#patientImmForm').off('submit').on('submit', function(e){
    e.preventDefault()
    var dataId = $(this).attr('data-id')
    var formData = new FormData(this)
    formData.append('patientImmId', dataId)
    $.ajax({
      url: "../php/main.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response){
        if(response['status'] === "success"){
          alert('Successfully Update.')
          $('#patientImmButton').prop('disabled',true)
        }
        else alert('Something went wrong.')
      }
    })
  })

  // patient imm managed
  $('.patient-imm-managed').off('click').on('click', function(){
    var dataId = $(this).attr('data-id')
    $.post("../php/main.php", {patientImmManagedId: dataId}, function(response, status){
      if(status){
        $('#patientImmMangedByModalBody').html(response)
      }
    })
  })

  // number of babies
  $('#numberOfBabies').off('change').on('change', function(){
    var babies = $(this).val()
    var html = ''
    var count = 0
    
    for(var i=0; i<Number(babies); i++){
      count++
      html += `
        <h6 class="mb-0 mt-3">Baby (${count})</h6>
        <section class="d-flex align-items-start justify-content-center gap-2 flex-nowrap w-100">
          <aside class="w-25 d-flex align-items-start justify-content-start gap-3 flex-wrap">
            <div class="w-100">
              <label class="form-label">Type of Delivery</label>
              <select class="form-select" name="addBaby${count}[]" required>
                <option value="">Select...</option>
                <option value="Normal">Normal</option>
                <option value="Caesarean">Caesarean</option>
              </select>
            </div>
            <div class="w-100">
              <label class="form-label">First Name</label>
              <input type="text" class="form-control" name="addBaby${count}[]" placeholder="..." required>
            </div>
            <div class="w-100">
              <label class="form-label">Middle Name (optional)</label>
              <input type="text" class="form-control" name="addBaby${count}[]" placeholder="...">
            </div>
            <div class="w-100">
              <label class="form-label">Last Name</label>
              <input type="text" class="form-control" name="addBaby${count}[]" placeholder="..." required>
            </div>
          </aside>
          <aside class="w-25 d-flex align-items-start justify-content-start gap-3 flex-wrap">
            <div class="w-100">
              <label class="form-label">Extension Name (optional)</label>
              <input type="text" class="form-control" name="addBaby${count}[]" placeholder="...">
            </div>
            <div class="w-100">
              <label class="form-label">Sex</label>
              <select class="form-select" name="addBaby${count}[]" required>
                <option value="">Select...</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div class="w-100">
              <label class="form-label">Date of Delivery</label>
              <input type="datetime-local" class="form-control" name="addBaby${count}[]" placeholder="..." required>
            </div>
            <div class="w-100">
              <label class="form-label">Place of Birth</label>
              <input type="text" class="form-control" name="addBaby${count}[]" placeholder="..." required>
            </div>
          </aside>
          <aside class="w-25 d-flex align-items-start justify-content-start gap-3 flex-wrap">
            <div class="w-100">
              <label class="form-label">Blood Type</label>
              <select class="form-select" name="addBaby${count}[]" required>
                <option value="">Select...</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
              </select>
            </div>
            <div class="w-100">
              <label class="form-label">Weight</label>
              <input type="text" class="form-control" name="addBaby${count}[]" placeholder="..." required>
            </div>
            <div class="w-100">
              <label class="form-label">Length/Height</label>
              <input type="text" class="form-control" name="addBaby${count}[]" placeholder="..." required>
            </div>
            <div class="w-100">
              <label class="form-label">Circular Head Size</label>
              <input type="text" class="form-control" name="addBaby${count}[]" placeholder="..." required>
            </div>
          </aside>
          <aside class="w-25 d-flex align-items-start justify-content-start gap-3 flex-wrap">
            <div class="w-100">
              <label class="form-label">Chest Circumference</label>
              <input type="text" class="form-control" name="addBaby${count}[]" placeholder="..." required>
            </div>
            <div class="w-100">
              <label class="form-label">Status</label>
              <select class="form-select" name="addBaby${count}[]" required>
                <option value="">Select...</option>
                <option value="Alive">Alive</option>
                <option value="Died">Died</option>
              </select>
            </div>
            <div class="w-100">
              <label class="form-label">If status is Died (Optional)</label>
              <input type="datetime-local" class="form-control" name="addBaby${count}[]" placeholder="...">
            </div>
            <div class="w-100">
              <label class="form-label">Remarks when Died (optional)</label>
              <textarea class="form-control" name="addBaby${count}[]" placeholder="..."></textarea>
            </div>
          </aside>
        </section>
      `
    }
    $('#sectionBabies').html(html)
    $('#addBabyModalButtonAdd').removeClass('d-none')
  })

  // add baby
  $('#addBabyForm').off('submit').on('submit', function(e){
    e.preventDefault()
    var dataId = $('#addBabyModalButtonOpen').attr('data-id')
    var babies = Number($('#numberOfBabies').val())

    var formData = new FormData(this)
    formData.append('addBabyFormId', dataId)
    formData.append('addBabyFormBabies', babies)
    $.ajax({
      url: "../php/main.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response){
        console.log(response)
        if(response['status'] === "success"){
          alert('Successfully Added.')
          $('#addBabyForm input, select, textarea').val('')
          $('#addBabyModalButtonClose')[0].click()
          $('#addBabyModalButtonOpen').prop('disabled', true)
        }
        else alert('Something went wrong.')
      }
    })
  })

  // managed by baby
  $('.baby-managed-by').off('click').on('click', function(){
    var dataId = $(this).attr('data-id')
    $.post('../php/main.php', {managedByBabyId : dataId}, function(response, status){
      if(status){
        $('#managedByBabyTBody').html(response)
      }
    })
  })

  // father baby
  $('.baby-father').off('click').on('click', function(){
    var dataId = $(this).attr('data-id')
    $.post('../php/main.php', {fatherBabyId : dataId}, function(response, status){
      if(status){
        $('#fatherBabyTBody').html(response)
      }
    })
  })

  // add milestone
  $('#addMilestoneForm').off('submit').on('submit', function(e){
    e.preventDefault()
    var dataId = $('#addMilestoneButtonOpen').attr('data-id')
      
    var formData = new FormData(this)
    formData.append('addMilestoneFormId', dataId)
    $.ajax({
      url: "../php/main.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response){
        if(response['status'] === "success"){
          alert('Successfully Added.')
          $('#addMilestoneForm textarea').val('')
          $('#addMilestoneModalButtonClose')[0].click()
        }
        else alert('Something went wrong.')
      }
    })
  })

  // managed by milestone
  $('.milestone-managed').off('click').on('click', function(){
    var dataId = $(this).attr('data-id')
    $.post('../php/main.php', {managedByMilestoneId : dataId}, function(response, status){
      if(status){
        $('#milestoneManagedByTBody').html(response)
      }
    })
  })

  // add metric
  $('#addMetricForm').off('submit').on('submit', function(e){
    e.preventDefault()
    var dataId = $('#addMetricModalButtonOpen').attr('data-id')
      
    var formData = new FormData(this)
    formData.append('addMetricFormId', dataId)
    $.ajax({
      url: "../php/main.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response){
        if(response['status'] === "success"){
          alert('Successfully Added.')
          $('#addMetricForm input').val('')
          $('#addMetricModalButtonClose')[0].click()
        }
        else alert('Something went wrong.')
      }
    })
  })

  // managed by metric
  $('.metric-managed').off('click').on('click', function(){
    var dataId = $(this).attr('data-id')
    $.post('../php/main.php', {managedByMetricId : dataId}, function(response, status){
      if(status){
        $('#metricManagedByTBody').html(response)
      }
    })
  })

 // baby imm
  $('#babyImmForm').off('submit').on('submit', function(e){
    e.preventDefault()
    var dataId = $(this).attr('data-id')
    var formData = new FormData(this)
    formData.append('babyImmId', dataId)
    $.ajax({
      url: "../php/main.php",
      type: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(response){
        if(response['status'] === "success"){
          alert('Successfully Update.')
          $('#babyImmButton').prop('disabled',true)
        }
        else alert('Something went wrong.')
      }
    })
  })
  // patient managed
  $('.baby-imm-managed').off('click').on('click', function(){
    var dataId = $(this).attr('data-id')
    $.post("../php/main.php", {babyImmManagedId: dataId}, function(response, status){
      if(status){
        $('#babyImmMangedByModalBody').html(response)
      }
    })
  })

  // selected report
  $('#selectedReport').off('change').on('change', function(){
    $('#applyReport')[0].click()
  })

  // request now
  $('#requestNow').off('click').on('click', function(){
    var patientId = $('#accessPatientModalButtonOpen').attr('data-id')    
    $.post('../php/main.php', {requestNowPatientId : patientId}, function(response, status){
      if(status){
        if(response['status'] === "success"){
          alert("Request sent.")
          $('#accessPatientModalButtonClose')[0].click()
        }
        else{
          alert("Something went wrong.")
        }
      }
    })
  })

  // request read
  $(".request-read").off("click").on('click', function(){
    var requestId = $(this).attr('data-id')
    $.post("../php/main.php", {requestReadId : requestId}, function(response, status){
      if(status){
        if($.trim(response) === ""){
          alert('Marked as read.')
          $(`#requestRead${requestId}`).prop('disabled',true)
        }
      }
    })
  })

  // request accept
  $(".request-accept").off("click").on('click', function(){
    var requestId = $(this).attr('data-id')
    $.post("../php/main.php", {requestAcceptId : requestId}, function(response, status){
      if(status){
        if($.trim(response) === ""){
          alert('Accepted.')
          $(`#requestAccept${requestId}`).prop('disabled',true)
        }
      }
    })
  })

  // request decline
  $(".request-decline").off("click").on('click', function(){
    var requestId = $(this).attr('data-id')
    $.post("../php/main.php", {requestDeclineId : requestId}, function(response, status){
      if(status){
        if($.trim(response) === ""){
          alert('Declined.')
          $(`#requestDecline${requestId}`).prop('disabled',true)
        }
      }
    })
  })

  // send SMS via appointment schedule
  setInterval(function(){
    
    $.get("../php/main.php", {sendSMS : ""}, function(response,status){
      if(status){
        console.log(response)
      }
    })

  }, 3000)


  
  $('#addTrimesterButton').off('click').on("click", function(){
    var maternalId = $(this).attr('data-id')
    console.log(maternalId)

    $.post("../php/main.php", {firstCheckupMaternalId : maternalId}, function(response, status){
      
      var lmp = new Date($.trim(response)); // Assuming response is a valid date string
var currentDate = new Date();

// Calculate the difference in milliseconds
var timeDiff = Math.abs(currentDate.getTime() - lmp.getTime());

// Convert the difference from milliseconds to days
var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));

// Calculate weeks and remaining days
var weeks = Math.floor(diffDays / 7);
var days = diffDays % 7;
      

      $('#firstAgeGestation').val(`${weeks} weeks and ${days} days`)
      $('#secondAgeGestation').val(`${weeks} weeks and ${days} days`)
      $('#lastAgeGestation').val(`${weeks} weeks and ${days} days`)
    })

    
  })


})