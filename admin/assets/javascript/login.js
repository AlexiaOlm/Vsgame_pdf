document.getElementById('entrar').addEventListener('submit', function(event) {
    const nombreUsuario = document.getElementById('username');
    const contraseña = document.getElementById('password');

    if(!nombreUsuario.validity.valid) {
        nombreUsuario.setCustomValidity('Debe introducir un usuario.');
    } else if (!contraseña.validity.valid) {
        contraseña.setCustomValidity('Debe introducir una contraseña.');
    } else {
        nombreUsuario.setCustomValidity('');
        contraseña.setCustomValidity('');
    }
})