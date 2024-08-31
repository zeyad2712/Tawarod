const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const signUpBtn = document.getElementById('signup');

signUpBtn.addEventListener('click', () => {
    container.classList.add("active");

});

registerBtn.addEventListener('click', () => {
    container.classList.remove("active");
}); 

document.querySelector('form').addEventListener('submit',function(event){
    var form=event.target;
    var formAction=form.querySelector('#form_action').value;
    localStorage.setItem('formAction',formAction);


});

console.log(registerBtn);

