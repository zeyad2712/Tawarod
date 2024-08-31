const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const signUpBtn = document.getElementById('signup');

signUpBtn.addEventListener('click', () => {
    container.classList.add("active");

});

registerBtn.addEventListener('click', () => {
    container.classList.remove("active");
}); 



