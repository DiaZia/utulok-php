function validateForm() {
    var username = document.getElementById('prihlasovacie_meno').value;
    var password = document.getElementById('prihlasovacie_heslo').value;

    if (username === '' || password === '') {
        alert('Vyplňte všetky polia.');
        return false;
    }

    return true;
}

function validateRegistrationForm() {
    var username = document.getElementById('meno').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('heslo').value;
    var confirmPassword = document.getElementById('potvrdit_heslo').value;

    if (username === '' || email === '' || password === '' || confirmPassword === '') {
        alert('Vyplňte všetky polia.');
        return false;
    }

    if (password.length < 8) {
        alert('Heslo musí mať aspoň 8 znakov.');
        return false;
    }

    var strongPasswordRegex = /^(?=.*[a-z])(?=.*\d).{8,}$/;
    if (!strongPasswordRegex.test(password)) {
        alert('Heslo musí obsahovať aspoň jedno číslo.');
        return false;
    }

    if (password !== confirmPassword) {
        alert('Heslá sa nezhodujú.');
        return false;
    }

    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        alert('Zadajte platnú e-mailovú adresu.');
        return false;
    }

    return true;
}
