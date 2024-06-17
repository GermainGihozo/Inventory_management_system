document.addEventListener('DOMContentLoaded', () => {
  const changePasswordForms = document.querySelectorAll('.change-password-form');

  changePasswordForms.forEach(form => {
      form.addEventListener('submit', (event) => {
          const newPassword = form.querySelector('input[name="new_password"]').value;
          if (newPassword.length < 6) {
              alert('Password must be at least 6 characters long.');
              event.preventDefault();
          }
      });
  });
});
