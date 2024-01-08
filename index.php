<?php
session_start();
if (isset($_SESSION['unique_id'])) {
  header("location: users.php");
}
?>

<?php include_once "header.php"; ?>

<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Chat Organizacional</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off" onsubmit="return validatePassword()">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>Nombre</label>
            <input type="text" name="fname" placeholder="Nombre" required maxlength="15" minlength="4">
          </div>
          <div class="field input">
            <label>Apellido</label>
            <input type="text" name="lname" placeholder="Apellido" required maxlength="15" minlength="4">
          </div>
        </div>
        <div class="field input">
          <label>Correo</label>
          <input type="text" name="email" placeholder="Correo" required maxlength="30" minlength="4">
        </div>
        <div class="field select">
          <label>Rol del Usuario</label>
          <select name="rol" required>
            <option value="Secretario">Secretario</option>
            <option value="Bodeguero">Bodeguero</option>
          </select>
        </div>
        <div class="field input">
          <label>Contraseña</label>
          <input type="password" name="password" id="password" placeholder="Contraseña" oninput="validatePassword()" required maxlength="30" minlength="4" pattern="^\S*$">
          <i class="fas fa-eye" id="toggleIcon"></i>
        </div>
        <div class="field input">
          <label>Confirmar Contraseña</label>
          <input type="password" name="passwordConf" id="passwordConf" placeholder="Confirmar Contraseña" oninput="validatePassword()" required maxlength="30" minlength="4" pattern="^\S*$">
          <i class="fas fa-eye" id="toggleConfIcon"></i>
        </div>
        <span id="passwordMatch" style="color: red;"></span>
        <div class="field image">
          <label>Seleccione Imagen de Perfil</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Ir al Chat" id="submitButton" disabled>
        </div>
      </form>
      <div class="link">Ya tienes cuenta? <a href="login.php">Inicia Sesion</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/pass-show-hide-conf.js"></script>
  <script src="javascript/signup.js"></script>
  <script>
    function validatePassword() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("passwordConf").value;
      var passwordMatchSpan = document.getElementById("passwordMatch");
      var submitButton = document.getElementById("submitButton");

      if (password !== confirmPassword) {
        passwordMatchSpan.innerHTML = "Las contraseñas no coinciden.";
        submitButton.disabled = true; // Deshabilitar el botón
      } else {
        passwordMatchSpan.innerHTML = "";
        submitButton.disabled = false; // Habilitar el botón
      }
    }
  </script>
  <script>
    function validatePassword() {
      var passwordInput = document.getElementById('password');
      var passwordConfInput = document.getElementById('passwordConf');

      // Elimina los espacios en blanco al principio y al final de la cadena
      passwordInput.value = passwordInput.value.trim();
      passwordConfInput.value = passwordConfInput.value.trim();

      // Actualiza el valor de los campos en el formulario
      if (passwordInput.value !== passwordInput.value.trim()) {
        passwordInput.setCustomValidity('La contraseña no debe contener espacios en blanco.');
      } else if (passwordConfInput.value !== passwordConfInput.value.trim()) {
        passwordConfInput.setCustomValidity('La contraseña de confirmación no debe contener espacios en blanco.');
      } else {
        passwordInput.setCustomValidity('');
        passwordConfInput.setCustomValidity('');
      }
    }
  </script>
</body>

</html>