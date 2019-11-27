<?php

    $errores = [
      "id" => "",
      "nombre" => "",
      "correo" => "",
      "contrasenia" => "",
      "confirmaContra" => "" ,
      "fotoPerfil" => "" ,
    ];

    $datosCorrectos = [
      "id" => "",
      "nombre" => "",
      "correo" => "",
      "contrasenia" => "",
      "fotoPerfil" => "" ,
    ];


    $hayErrores = false;
    $cargaArchivo = false;
    $insercionDato = 0;

        /*------Validaciones-------*/
        if (!empty($_POST) && !empty($_FILES)) {

            //Nombre
            if (strlen($_POST["nombre"]) < 4) {
              $errores["nombre"] = "El nombre debe contener 4 o mas caracteres.";
              $hayErrores = true;
            }else {
              $datosCorrectos["nombre"] = $_POST["nombre"];
            }

            $patron = "/^[a-z ,.'-]+$/i";
            if (preg_match($patron, $_POST["nombre"]) == 0) {
              $errores["nombre"] .= "<br> El nombre debe contener solo letras.";
              $hayErrores = true;
            }else{
              $datosCorrectos["nombre"] = $_POST["nombre"];
            }

            //Email
            if (!filter_var($_POST["correo"], FILTER_VALIDATE_EMAIL)) {
              $errores["correo"] = "<br> Formato incorrecto de email.";
              $hayErrores = true;
            }else{
              $datosCorrectos["correo"] = $_POST["correo"];
            }

            //contraseña
            if (strlen($_POST["contrasenia"]) < 8) {
              $errores["contrasenia"] = "<br> La contrasenia debe tener al menos 8 caracteres.";
              $hayErrores = true;
            }else{
              $datosCorrectos["contrasenia"] = password_hash($_POST["contrasenia"], PASSWORD_DEFAULT);
            }

            if (!ctype_alnum($_POST["contrasenia"])) {
              $errores["contrasenia"] .= "<br> La contraseña debe ser alfanumerica.";
              $hayErrores = true;
            }else{
              $datosCorrectos["contrasenia"] = password_hash($_POST["contrasenia"], PASSWORD_DEFAULT);
            }

            if (!($_POST["contrasenia"] == $_POST["confirmaContra"])) {
              $errores["confirmaContra"] .= "<br> Las contraseñas no coinciden.";
              $hayErrores = true;
            }

            //fotoPerfil
            if ($_FILES["fotoPerfil"]["error"] != 0) {
              $errores["fotoPerfil"] = "<br> Hubo un problema al cargar la foto.";
              $hayErrores = true;
            }

            $extension = pathinfo($_FILES["fotoPerfil"]["name"], PATHINFO_EXTENSION);

            if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png")) {
              $errores["fotoPerfil"] = "<br> La foto debe ser png, jpg o jpeg.";
              $hayErrores = true;
            }

            if ($_FILES["fotoPerfil"]["size"] > 4000000) {
              $errores["fotoPerfil"] .= "<br> La foto no debe superar los 4MB";
              $hayErrores = true;
            }


            /*------Insercion-------*/
            if ($hayErrores == false) {

              $arrayUsuarios = json_decode(file_get_contents("../database/users.json"), true);
              $idNuevo = count($arrayUsuarios["users"]) + 1;

              $cargaArchivo = move_uploaded_file($_FILES["fotoPerfil"]["tmp_name"], "../img/fotos-usuarios/". $idNuevo . "." . $extension);

              $usuarioNuevo = [
                "id" => $idNuevo,
                "nombre" => $datosCorrectos["nombre"],
                "correo" => $datosCorrectos["correo"],
                "contrasenia" => $datosCorrectos["contrasenia"],
                "fotoPerfil" => "../img/fotos-usuarios/" . $idNuevo. "." . $extension ,
              ];


              $arrayUsuarios["users"][] = $usuarioNuevo;

              $usuarioFinal = json_encode($arrayUsuarios);
              $insercionDato = file_put_contents("../database/users.json", $usuarioFinal);

            }
            /*------EndInsercion-------*/

        }

 ?>

<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/7c3c4957c1.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/style.css">

  <link rel="shortcut icon" type="image/png" href="../img/bs-favicon.png" />
  <title> BookStore | Login or Register</title>

</head>

<body>

  <!-- Header -->
  <header id="header" class="__background-login">

    <?php require_once("../modulos/navigationBar.php"); ?>

    <!-- TextHeader -->
    <section class="__header-login">
      <div class="container">
        <div class="row">
          <article class="col-12">
            <div class="pl-4">
              <h1 class="text-uppercase text-center">REGISTRO / LOGIN</h1>
              <blockquote class="blockquote text-center">
                <p class="mb-0 text-white-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                <footer class="text-white-50 blockquote-footer">Someone famous in <cite title="Source Title">Source Title</cite></footer>
              </blockquote>
            </div>
          </article>
        </div>
      </div>
    </section>
    <!-- EndTextHeader -->

  </header>
  <!-- EndHeader -->

  <!-- Main -->
  <main>

    <section class="container">

      <!-- Path -->
      <div class="mt-5">
        <nav aria-label="breadcrumb ">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a class="text-reset" href="../index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registro</li>
          </ol>
        </nav>
      </div>
      <!-- EndPath -->

      <?php if ($cargaArchivo && $insercionDato != 0 ): ?>
        <div class="alert alert-success" role="alert">

          Usuario registrado satisfactoriamente. <a class="alert-link">Ya puedes loguearte</a>

        </div>
      <?php endif; ?>


    </section>

    <div class="container-login">
      <div class="login-container">
        <div class="register">
          <h2>Registrarse</h2>
          <form action="register.php" method="post" enctype="multipart/form-data">

            <input type="text" class="mb-1" name="nombre" placeholder="Nombre" class="nombre" value="<?=$datosCorrectos["nombre"]; ?>">
            <small id="nameHelp" class="mb-3 form-text text-danger"><?=$errores["nombre"];?></small>

            <input type="email" class="mb-1" name="correo" placeholder="Correo" class="correo" value="<?=$datosCorrectos["correo"]; ?>" >
            <small id="nameHelp" class="mb-3 form-text text-danger"><?=$errores["correo"];?></small>

            <input type="password" class="mb-1" name="contrasenia" placeholder="Contraseña" class="pass">
            <small id="nameHelp" class="mb-3 form-text text-danger"><?=$errores["contrasenia"];?></small>

            <input type="password" class="mb-1" name="confirmaContra" placeholder="Confirma contraseña" class="repass">
            <small id="nameHelp" class="mb-3 form-text text-danger"><?=$errores["confirmaContra"];?></small>

            <div class="input-group mb-2">
                <div class="custom-file">
                  <input type="file" name="fotoPerfil" class="custom-file-input">
                  <label class="custom-file-label __perfil-pic">Foto de perfil</label>
                </div>
            </div>
            <small id="nameHelp" class="mb-3 form-text text-danger"><?=$errores["fotoPerfil"];?></small>

            <div class="form-check">
              <div class="form-group">
                <input class="form-check-input" name="recordarme" type="checkbox" value="recordarme" id="recordarme">
                <label class="form-check-label" for="recordarme">
                  Recordarme
                </label>
              </div>
            </div>

            <input type="submit" class="mt-3 submit" value="REGISTRARSE">
          </form>
        </div>
        <div class="login">
          <h2>Iniciar Sesión</h2>
          <div class="login-items">
            <input type="text" placeholder="Nombre de usuario" class="nombre">
            <input type="password" placeholder="Contraseña" class="pass">

            <button class="correo  text-white"><i class="fas fa-envelope"><a class="text-white" href="https://gmail.com"></i> Acceder con Correo</button>
            <button class="fb text-white"><i class="fab fa-facebook-f"><a class=" text-white" href="https://facebook.com"></i> Acceder con Facebook</button>
            <button class="tw  text-white"><i class="fab fa-twitter"><a class="text-white" href="https://twitter.com"></i> Acceder con Twitter</button>
          </div>
        </div>
      </div>
</div>

  </main>
  <!-- EndMain -->

  <!-- Footer -->
  <footer class="justify-content-center">

    <?php require_once("../modulos/footer.php"); ?>

  </footer>
  <!-- Footer -->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>
