 document.getElementById('registerForm').addEventListener('submit', function(e) {
      const pass = document.querySelector('[name="password"]').value;
      const confirm = document.querySelector('[name="password_confirmation"]').value;
      const errorDiv = document.getElementById('error');

      if (pass !== confirm) {
        e.preventDefault();
        errorDiv.textContent = "Passwords do not match.";
      } else if (pass.length < 6) {
        e.preventDefault();
        errorDiv.textContent = "Password must be at least 6 characters.";
      } else {
        errorDiv.textContent = "";
      }
    });