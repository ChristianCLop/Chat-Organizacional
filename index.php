<?php 
  session_start();
  if(isset($_SESSION['unique_id'])){
    header("location: users.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="form signup">
      <header>Chat Organizacional</header>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="name-details">
          <div class="field input">
            <label>Nombre </label>
            <input type="text" name="fname" placeholder="Ingrese nombre" required>
          </div>
          <div class="field input">
            <label>Apellido </label>
            <input type="text" name="lname" placeholder="Ingrese apellido" required>
          </div>
        </div>
        <div class="field input">
          <label>Correo Electrónico</label>
          <input type="email" name="email" placeholder="Ingrese correo electrónico" required>
        </div>
        <div class="field input">
          <label>Contraseña</label>
          <input type="password" name="password" placeholder="Ingrese contraseña" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field image">
          <label>Seleccione Imagen</label>
          <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Registrarse">
        </div>
      </form>
      <div class="link">Ya estas Registrado? <a href="login.php">Iniciar Sesión</a></div>
    </section>
  </div>

  <script src="javascript/pass-show-hide.js"></script>
  <script src="javascript/signup.js"></script>

</body>
</html>
