
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.getElementById('password');
    const passwordStrength = document.getElementById('passwordStrength');
    
 passwordInput.addEventListener('input', function() {
        const password = this.value;
        let strength = 0;
        if (password.length >= 8) strength += 25;
        if (/[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password)) strength += 25;
        if (/[^A-Za-z0-9]/.test(password)) strength += 25;
        strength = Math.min(strength, 100);
        passwordStrength.style.width = strength + '%';
        if (strength < 40) passwordStrength.style.backgroundColor = '#dc3545';
        else if (strength < 70) passwordStrength.style.backgroundColor = '#fd7e14';
        else passwordStrength.style.backgroundColor = '#28a745';
    });
    });


