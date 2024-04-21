document.querySelector('.register').addEventListener('click', function(event) {
    event.preventDefault();
    document.querySelector('.login-container h2').style.display = 'none';
    document.querySelector('.login-container form').style.display = 'none';
    document.querySelector('.register-container').style.display = 'block';
});
document.getElementById('togglePassword').addEventListener('click', function() {
    var passwordField = document.getElementById('password');
    var fieldType = passwordField.getAttribute('type');
    passwordField.setAttribute('type', fieldType === 'password' ? 'text' : 'password');
    this.classList.toggle('fa-eye-slash');
});
// Toggle visibility of registration password
document.getElementById('toggleRegPassword').addEventListener('click', function() {
    var regPasswordField = document.getElementById('reg-password');
    var fieldType = regPasswordField.getAttribute('type');
    regPasswordField.setAttribute('type', fieldType === 'password' ? 'text' : 'password');
    this.classList.toggle('fa-eye-slash');
});
// Toggle visibility of confirm password
document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
    var confirmPasswordField = document.getElementById('confirm-password');
    var fieldType = confirmPasswordField.getAttribute('type');
    confirmPasswordField.setAttribute('type', fieldType === 'password' ? 'text' : 'password');
    this.classList.toggle('fa-eye-slash');
});
// Check if password matches confirm password as user types
document.getElementById('confirm-password').addEventListener('input', function() {
    var confirmPassword = this.value;
    var password = document.getElementById('reg-password').value;
    var passwordMatchError = document.getElementById('password-match-error');
    var registerButton = document.getElementById('register-button');
    
    if (password === confirmPassword) {
        passwordMatchError.textContent = '';
        registerButton.disabled = false;
    } else {
        passwordMatchError.textContent = 'Password does not match';
        registerButton.disabled = true;
    }
});
$(window).scroll(function(){
    if ($(window).scrollTop() > 20){
        $('.navbar').addClass('sticky');
    } else {
        $('.navbar').removeClass('sticky'); 
    }
    if ($(window).scrollTop() > 500){
        $('.scroll-up-btn').addClass('show');
    } else {
        $('.scroll-up-btn').removeClass('show'); 
    }
});