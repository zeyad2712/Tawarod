
const btns = document.querySelectorAll('.fa-eye'); 
const passwords = document.querySelectorAll('.pass'); 

btns.forEach((btn, index) => {
  btn.addEventListener('click', () => {
    const password = passwords[index]; 
    if (password.type === 'password') {
      password.type = 'text';
      btn.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
      password.type = 'password';
      btn.classList.replace('fa-eye-slash', 'fa-eye');
    }
  });
});

