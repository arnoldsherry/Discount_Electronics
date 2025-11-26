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
              <h2 class="section-title display-4"><span class="text-primary">Become a</span> Seller</h2>
            </div>
          </div>
          <div class="col-md-6 p-5">
            <form id="sellerForm" action="selleraction.php" method="post" novalidate>
              <!-- Name -->
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control form-control-lg" name="name" id="name" placeholder="Name">
                <div class="bg-secondary text-dark" id="nameError"></div>
              </div>
              <!-- Email -->
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control form-control-lg" name="email" id="email" placeholder="abc@mail.com">
                <div class="bg-secondary text-dark" id="emailError" style="color:black;"></div>
              </div>
              <!-- Phone -->
              <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control form-control-lg" name="phone" id="phone" placeholder="Phone">
                <div class="bg-secondary text-dark" id="phoneError"></div>
              </div>
              <!-- ID Proof -->
              <div class="mb-3">
                <label for="idproof" class="form-label">Enter your ID proof</label>
                <input type="text" class="form-control form-control-lg" name="idproof" id="idproof" placeholder="ID proof">
                <div class="bg-secondary text-dark" id="idproofError"></div>
              </div>
              <!-- License -->
              <div class="mb-3">
                <label for="license" class="form-label">Enter your license</label>
                <input type="text" class="form-control form-control-lg" name="license" id="license" placeholder="License">
                <div class="bg-secondary text-dark" id="licenseError"></div>
              </div>
              <!-- Username -->
              <div class="mb-3">
                <label for="username" class="form-label">Set your username</label>
                <input type="text" class="form-control form-control-lg" name="username" id="username" placeholder="Username">
                <div class="bg-secondary text-dark" id="usernameError"></div>
              </div>
              <!-- Password -->
              <div class="mb-3">
                <label for="password" class="form-label">Set your password</label>
                <input type="password" class="form-control form-control-lg" name="password" id="password" placeholder="Password">
                <div class="bg-secondary text-dark" id="passwordError" ></div>
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
// Real-time inline validation
const form = document.getElementById('sellerForm');
const name = document.getElementById('name');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const idproof = document.getElementById('idproof');
const license = document.getElementById('license');
const username = document.getElementById('username');
const password = document.getElementById('password');

form.addEventListener('submit', function(e) {
  let valid = true;

  // Name validation
  if (name.value.trim() === '') {
    document.getElementById('nameError').innerText = 'Name is required';
    valid = false;
  } else {
    document.getElementById('nameError').innerText = '';
  }

  // Email validation
  const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if (email.value.trim() === '') {
    document.getElementById('emailError').innerText = 'Email is required';
    valid = false;
  } else if (!emailPattern.test(email.value)) {
    document.getElementById('emailError').innerText = 'Invalid email format';
    valid = false;
  } else {
    document.getElementById('emailError').innerText = '';
  }

  // Phone validation
  const phonePattern = /^\d{10}$/;
  if (phone.value.trim() === '') {
    document.getElementById('phoneError').innerText = 'Phone is required';
    valid = false;
  } else if (!phonePattern.test(phone.value)) {
    document.getElementById('phoneError').innerText = 'Enter 10-digit phone number';
    valid = false;
  } else {
    document.getElementById('phoneError').innerText = '';
  }

  // ID proof validation
  if (idproof.value.trim() === '') {
    document.getElementById('idproofError').innerText = 'ID proof is required';
    valid = false;
  } else {
    document.getElementById('idproofError').innerText = '';
  }

  // License validation
  if (license.value.trim() === '') {
    document.getElementById('licenseError').innerText = 'License is required';
    valid = false;
  } else {
    document.getElementById('licenseError').innerText = '';
  }

  // Username validation
  if (username.value.trim() === '') {
    document.getElementById('usernameError').innerText = 'Username is required';
    valid = false;
  } else {
    document.getElementById('usernameError').innerText = '';
  }

  // Password validation
  if (password.value.trim() === '') {
    document.getElementById('passwordError').innerText = 'Password is required';
    valid = false;
  } else if (password.value.length < 6) {
    document.getElementById('passwordError').innerText = 'Password must be at least 6 characters';
    valid = false;
  } else {
    document.getElementById('passwordError').innerText = '';
  }

  if (!valid) e.preventDefault();
});
</script>

<?php
// include_once("footer.php");
?>
