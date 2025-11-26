<?php
include_once("header.php");
include_once("../dboperation.php");
?>
<section class="p-4 p-md-5" style="background-image: url(https://mdbcdn.b-cdn.net/img/Photos/Others/background3.webp);">
  <div class="row d-flex justify-content-center">
    <div class="col-md-10 col-lg-8 col-xl-5">
      <div class="card rounded-3">
        <div class="card-body p-4">
          <div class="text-center mb-4">
            <h3>Settings</h3>
            <h6>Payment</h6>
          </div>

          <form action="paymentaction.php" method="POST" id="paymentForm" onsubmit="return validateForm();">
            <p class="fw-bold mb-4">Add new card:</p>
            <img class="img-fluid" src="https://img.icons8.com/color/48/000000/visa.png" />
            <img class="img-fluid" src="https://img.icons8.com/color/48/000000/mastercard-logo.png" />

            <!-- Cardholder Name -->
            <div class="mb-3">
              <input type="text" name="cardholder" id="cardholder"
                class="form-control form-control-lg"
                placeholder="John Doe" required />
              <label class="form-label" for="cardholder">Cardholder's Name</label>
            </div>

            <div class="row mb-4">
              <!-- Card Number -->
              <div class="col-7">
                <input type="text" name="cardnumber" id="cardnumber"
                  class="form-control form-control-lg"
                  placeholder="1234567812345678"
                  maxlength="16"
                  required
                  oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                <label class="form-label" for="cardnumber">Card Number</label>
              </div>

              <!-- Expiry Date -->
              <div class="col-3">
                <input type="text" name="expiry" id="expiry"
                  class="form-control form-control-lg"
                  placeholder="MM/YYYY"
                  maxlength="7"
                  required />
                <label class="form-label" for="expiry">Expire</label>
              </div>

              <!-- CVV -->
              <div class="col-2">
                <input type="password" name="cvv" id="cvv"
                  class="form-control form-control-lg"
                  placeholder="CVV"
                  maxlength="4"
                  required
                  oninput="this.value=this.value.replace(/[^0-9]/g,'');" />
                <label class="form-label" for="cvv">CVV</label>
              </div>
            </div>

            <button type="submit" class="btn btn-success btn-lg btn-block">Add card</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function validateForm() {
    const name = document.getElementById("cardholder").value.trim();
    const number = document.getElementById("cardnumber").value.trim();
    const expiry = document.getElementById("expiry").value.trim();
    const cvv = document.getElementById("cvv").value.trim();

    // Name
    if (name === "") {
        alert("Please enter cardholder name.");
        return false;
    }

    // Card Number (16 digits only)
    const cardRegex = /^[0-9]{16}$/;
    if (!cardRegex.test(number)) {
        alert("Please enter a valid 16-digit card number.");
        return false;
    }

    // Expiry Date (MM/YYYY)
    const expRegex = /^(0[1-9]|1[0-2])\/\d{4}$/;
    if (!expRegex.test(expiry)) {
        alert("Please enter expiry in MM/YYYY format.");
        return false;
    } else {
        // Check not expired
        const [month, year] = expiry.split("/");
        const expDate = new Date(year, month - 1);
        const today = new Date();
        if (expDate < today) {
            alert("This card has expired.");
            return false;
        }
    }

    // CVV (3–4 digits)
    const cvvRegex = /^[0-9]{3,4}$/;
    if (!cvvRegex.test(cvv)) {
        alert("Please enter a valid CVV (3 or 4 digits).");
        return false;
    }

    return true;
}
</script>

<?php
include_once("footer.php");
?>
