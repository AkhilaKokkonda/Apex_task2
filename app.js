document.addEventListener("DOMContentLoaded", () => {
  loadComponent("components/navbar.html", "navbar");
  loadComponent("components/footer.html", "footer");

  setupPasswordToggle();
  setupLoginForm();
  setupRegisterForm();
  setupRealTimeValidation();
});

/* Load reusable HTML components */
function loadComponent(file, elementId) {
  fetch(file)
    .then(res => res.text())
    .then(data => {
      document.getElementById(elementId).innerHTML = data;
    });
}

/* Show/Hide password */
function setupPasswordToggle() {
  document.querySelectorAll(".toggle-password").forEach(btn => {
    btn.addEventListener("click", () => {
      const input = btn.previousElementSibling;
      input.type = input.type === "password" ? "text" : "password";
    });
  });
}

/* Show alerts dynamically */
function showAlert(message, type = "success") {
  const alertBox = document.createElement("div");
  alertBox.className = `alert alert-${type} mt-3`;
  alertBox.innerText = message;
  document.querySelector(".container").prepend(alertBox);
  setTimeout(() => alertBox.remove(), 3000);
}

/* Login form with AJAX */
function setupLoginForm() {
  const form = document.getElementById("loginForm");
  if (!form) return;

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    if (!form.checkValidity()) {
      form.classList.add("was-validated");
      return;
    }
    const formData = new FormData(form);
    fetch("php/login.php", {
      method: "POST",
      body: formData
    }).then(r => r.json())
      .then(data => {
        showAlert(data.msg, data.status === "success" ? "success" : "danger");
        if (data.status === "success") form.reset();
      });
  });
}

/* Register form with AJAX */
function setupRegisterForm() {
  const form = document.getElementById("registerForm");
  if (!form) return;

  const pw = document.getElementById("regPassword");
  const confirm = document.getElementById("confirmPassword");
  const feedback = document.getElementById("passwordMatchFeedback");

  function checkMatch() {
    if (!pw.value || !confirm.value) { feedback.textContent = ""; return false; }
    if (pw.value === confirm.value) { feedback.textContent = "Passwords match ✓"; feedback.className = "text-valid"; return true; }
    else { feedback.textContent = "Passwords do not match"; feedback.className = "text-invalid"; return false; }
  }
  pw.addEventListener("input", checkMatch);
  confirm.addEventListener("input", checkMatch);

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    if (!form.checkValidity() || !checkMatch()) {
      form.classList.add("was-validated");
      return;
    }

    const formData = new FormData(form);
    formData.append("password", pw.value);

    fetch("php/register.php", {
      method: "POST",
      body: formData
    }).then(r => r.json())
      .then(data => {
        showAlert(data.msg, data.status === "success" ? "success" : "danger");
        if (data.status === "success") form.reset();
      });
  });
}

/* Real-time username/email validation */
function setupRealTimeValidation() {
  const username = document.getElementById("username");
  const email = document.getElementById("regEmail");

  username?.addEventListener("blur", () => {
    fetch(`php/check_user.php?type=username&value=${username.value}`)
      .then(r => r.json()).then(data => {
        const feedback = document.getElementById("usernameFeedback");
        feedback.textContent = data.exists ? "Username already taken" : "Username available";
        feedback.className = data.exists ? "text-invalid" : "text-valid";
      });
  });

  email?.addEventListener("blur", () => {
    fetch(`php/check_user.php?type=email&value=${email.value}`)
      .then(r => r.json()).then(data => {
        const feedback = document.getElementById("emailFeedback");
        feedback.textContent = data.exists ? "Email already registered" : "Email available";
        feedback.className = data.exists ? "text-invalid" : "text-valid";
      });
  });
}
