<?php
include_once("header.php");
?>
<section class="py-5">
  <div class="container-fluid">
    <span class="btn btn-warning" onclick="window.location.href='signup.php'">Back</span>
    <div class="bg-secondary py-5 my-5 rounded-5" style="background: url('images/bg-leaves-img-pattern.png') no-repeat;">
      <div class="container my-5">
        <div class="row">
          <div class="col-md-6 p-5">
            <div class="section-header">
              <h2 class="section-title display-4"><span class="text-primary">Amazing discounts</span> Are waiting You</h2>
            </div>
          </div>
          <div class="col-md-6 p-5">
            <form id="customerForm" action="customeraction.php" method="post" novalidate>
              
              <!-- Name -->
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Enter Your Name">
                <div class="bg-secondary text-dark" id="nameError"></div>
              </div>
              
              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="abc@mail.com">
                <div class="bg-secondary text-dark" id="emailError"></div>
              </div>
              
              <!-- Contact -->
              <div class="mb-3">
                <label for="phone" class="form-label">Contact</label>
                <input type="text" class="form-control form-control-lg" name="contact" id="phone" placeholder="Enter Your Contact Number">
                <div class="bg-secondary text-dark" id="phoneError"></div>
              </div>
              
              <!-- Landmark -->
              <div class="mb-3">
                <label for="landmark" class="form-label">Landmark</label>
                <input type="text" class="form-control form-control-lg" name="landmark" id="landmark" placeholder="Enter Your Landmark">
                <div class="bg-secondary text-dark" id="landmarkError"></div>
              </div>
              
              <!-- Address -->
              <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control form-control-lg" name="address" id="address" placeholder="Enter Your Address">
                <div class="bg-secondary text-dark" id="addressError"></div>
              </div>
              
              <!-- Pincode -->
              <div class="mb-3">
                <label for="pincode" class="form-label">Pincode</label>
                <input type="text" class="form-control form-control-lg" name="pincode" id="pincode" placeholder="Enter Your Pincode">
                <div class="bg-secondary text-dark" id="pincodeError"></div>
              </div>
              
              <!-- Username -->
              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Username">
                <div class="bg-secondary text-dark" id="usernameError"></div>
              </div>
              
              <!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Set your password</label>
                <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password">
                <div class="bg-secondary text-dark" id="passwordError"></div>
              </div>
              
              <div class="d-grid gap-2">
                <input type="submit" value="Submit" class="btn btn-dark btn-lg">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
const form = document.getElementById("customerForm");

function showError(inputId, errorId, message) {
  const input = document.getElementById(inputId);
  const errorDiv = document.getElementById(errorId);
  if (message) {
    errorDiv.innerText = message;
    input.classList.add("is-invalid");
  } else {
    errorDiv.innerText = "";
    input.classList.remove("is-invalid");
  }
}

// Validation rules
function validateField(inputId, errorId) {
  const value = document.getElementById(inputId).value.trim();
  let error = "";

  switch (inputId) {
    case "name":
      if (value === "") error = "Name is required";
      break;
    case "email":
      const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/;
      if (value === "") error = "Email is required";
      else if (!emailPattern.test(value)) error = "Invalid email format";
      break;
    case "phone":
      const phonePattern = /^\d{10}$/;
      if (value === "") error = "Contact number is required";
      else if (!phonePattern.test(value)) error = "Enter 10-digit phone number";
      break;
    case "landmark":
      if (value === "") error = "Landmark is required";
      break;
    case "address":
      if (value === "") error = "Address is required";
      break;
    case "pincode":
      const pinPattern = /^\d{6}$/;
      if (value === "") error = "Pincode is required";
      else if (!pinPattern.test(value)) error = "Enter valid 6-digit pincode";
      break;
    case "username":
      if (value === "") error = "Username is required";
      break;
    case "password":
      if (value === "") error = "Password is required";
      else if (value.length < 6) error = "Password must be at least 6 characters";
      break;
  }

  showError(inputId, errorId, error);
  return error === "";
}

// Real-time validation while typing
["name","email","phone","landmark","address","pincode","username","password"].forEach(id => {
  document.getElementById(id).addEventListener("input", () => {
    validateField(id, id + "Error");
  });
});

// Validate on submit
form.addEventListener("submit", function(e) {
  let valid = true;
  ["name","email","phone","landmark","address","pincode","username","password"].forEach(id => {
    if (!validateField(id, id + "Error")) valid = false;
  });

  if (!valid) e.preventDefault();
});
</script>

<?php
include_once("footer.php");
?>
