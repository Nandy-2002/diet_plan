// import './bootstrap';

function togglePasswordVisibility(button) {
    const passwordInput = button.previousElementSibling;
    const toggleIcon = button.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye'); // Change to eye icon
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash'); // Change to eye-slash icon
    }
}
