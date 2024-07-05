<div class="w-75 p-3">
  <header class="d-flex align-items-center justify-content-between mb-1">
    <button type="button" id="backButton" class="btn btn-light"><img src="../images/arrow_left.svg" alt="icon" width="20" height="20" loading="lazy"></button>
    <h2 class="text-success">Add patient</h2>
  </header>

  <form class="d-flex align-items-start justify-content-start gap-3 flex-wrap" autocomplete="off" id="addPatientForm">
    <div class="w-100">
      <label class="form-label">First name</label>
      <input type="text" class="form-control" name="addPatient[]" placeholder="..." required>
    </div>
    <div class="w-100">
      <label class="form-label">Middle name (optional)</label>
      <input type="text" class="form-control" name="addPatient[]" placeholder="...">
    </div>
    <div class="w-100">
      <label class="form-label">Last name</label>
      <input type="text" class="form-control" name="addPatient[]" placeholder="..." required>
    </div>
    <div class="w-100">
      <label class="form-label">Birth date</label>
      <input type="date" class="form-control" name="addPatient[]" placeholder="..." required>
    </div>
    <div class="w-100">
      <label class="form-label">Address</label>
      <input type="text" class="form-control" name="addPatient[]" placeholder="..." required>
    </div>
    <div class="w-100">
      <label class="form-label">Occupation</label>
      <input type="text" class="form-control" name="addPatient[]" placeholder="..." required>
    </div>
    <div class="w-100">
      <label class="form-label">Blood type</label>
      <select class="form-select" name="addPatient[]" placeholder="..." required>
        <option value="">Select...</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
        <option value="B+">B+</option>
        <option value="B-">B-</option>
        <option value="AB+">AB+</option>
        <option value="AB-">AB-</option>
        <option value="O+">O+</option>
        <option value="0-">0-</option>
      </select>
    </div>
    <div class="w-100">
      <label class="form-label">Contact no.</label>
      <input type="number" class="form-control" name="addPatient[]" placeholder="..." required>
    </div>
    <div class="w-100">
      <label class="form-label">Email (optional)</label>
      <input type="email" class="form-control" name="addPatient[]" placeholder="...">
    </div>
    <div class="w-100 text-end">
      <button type="submit" class="btn btn-success">Add</button>
    </div>
  </form>
</div>
