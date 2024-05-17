function togglePasswordVisibility(inputId) {
  const passwordInput = document.getElementById(inputId);
  const toggleIcon = passwordInput.parentElement.querySelector(".toggle-password img"); // Seleccionar la imagen dentro del mismo contenedor

  if (passwordInput.type === "password") {
      passwordInput.type = "text";
      toggleIcon.src = "img/invisible.png";
  } else {
      passwordInput.type = "password";
      toggleIcon.src = "img/ojo.png";
  }
}

  
  function validateForm() {
    var nombre = document.getElementById("nombre").value.trim();
    var correo = document.getElementById("correo").value.trim();
    var contrasena = document.getElementById("contrasena").value.trim();
    var confirmar_contrasena = document.getElementById("confirmar_contrasena").value.trim();

    var errorMessage = "";

    if (nombre === "") {
        errorMessage += "Por favor, ingrese su nombre.\n";
    }

    if (correo === "") {
        errorMessage += "Por favor, ingrese su correo electrónico.\n";
    } else if (!validateEmail(correo)) {
        errorMessage += "Por favor, ingrese un correo electrónico válido.\n";
    }

    if (contrasena === "") {
        errorMessage += "Por favor, ingrese una contraseña.\n";
    }

    if (confirmar_contrasena === "") {
        errorMessage += "Por favor, confirme su contraseña.\n";
    }

    if (errorMessage !== "") {
        alert(errorMessage);
        return false;
    }

    return true;
}

function validateEmail(email) {
    const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}