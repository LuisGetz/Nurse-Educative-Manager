<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="src/icon/material-icons.css">
  <link rel="stylesheet" href="src/bs5/bootstrap.min.css">
  <link rel="stylesheet" href="src/css/style-log.css">
</head>

<body>
  <div class="login col-8 col-md-6 col-lg-5 col-xl-4 col-xxl-3 h-auto m-auto rounded-4 p-4 d-flex align-items-center flex-column">
    <img src="src/img/nem-favicon.svg" class="w-25 m-4">
    <form id="form-login" class="needs-validation w-100" novalidate>
      <h1 class="text-center">¡Bienvenido!</h1>
      <p class="text-center text-secondary">Por favor, ingrese sus datos para acceder a la plataforma</p>
      <div class="mb-3 account">
        <label for="" class="form-label">Correo Electrónico</label>
        <div class="input-group mb-3 position-relative">
          <span class="input-group-text rounded-start-5">
            <span class="material-symbols-rounded">
              account_circle
            </span>
          </span>
          <input type="email" class="form-control rounded-end-5" name="username" id="" aria-describedby="helpId" placeholder="tucorreo@gmail.com" required />
          <div class="invalid-tooltip">
            Inserte un correo.
          </div>
        </div>
      </div>

      <div class="passw mb-3">
        <label for="" class="form-label">Contraseña</label>
        <div class="input-group mb-3">
          <span class="input-group-text rounded-start-5">
            <span class="material-symbols-rounded">
              lock
            </span>
          </span>
          <input type="password" class="form-control" name="passw" id="txt-pass" placeholder="••••••••" required />
          <div class="invalid-tooltip">
            Requiere de una contraseña para continuar.
          </div>
          <span class="input-group-text rounded-end-5 hovered-span">
            <span class="material-symbols-rounded">
              <label for="check-pass" id="checklabelI">
                visibility
              </label>
            </span>
          </span>
        </div>
        <p class="text-secondary">Las credenciales no se guardan.</p>
      </div>
      <input class="form-check-input" type="checkbox" value="" id="check-pass" style="display: none;" />

      <div class="row">
        <div class="col">
          <button type="submit" class="btn btn-primary rounded-pill w-100 mt-4 d-flex justify-content-center align-items-center">
            <span class="material-symbols-rounded me-2">
              login
            </span>
            Entrar
          </button>
        </div>
      </div>
    </form>
  </div>

  <div class="d-flex justify-content-center align-items-center w-100" id="container-toast">
  </div>

  <audio src="src/audio/error.mp3" id="errorAud"></audio>

  <script src="src/bs5/bootstrap.bundle.min.js"></script>
  <script src="src/js/index-log.js"></script>
</body>

</html>