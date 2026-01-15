<?php
include('./head.php');
?>

<!-- toast -->
<div class="d-flex justify-content-center align-items-center w-100" id="container-toast">
</div>

<div class="shadow rounded-3 contenedor m-2 p-2" id="bench1">
  <div class="row">
    <div class="col-lg-12 col-xl-3">
      <div class="card" style="width: 18rem; margin: auto;">
        <div class="card-header">
          Escáner QR
        </div>
        <div class="card-body">
          <div class="d-flex justify-content-center align-items-center flex-column" id="reader1" style="height: 190px;">
            <span class="material-symbols-rounded" style="font-size: 130px;">
              qr_code_2
            </span>
            <p class="fs-4">Escanear QR</p>
          </div>
          <div class="mt-3 w-100 d-flex justify-content-center align-items-center">
            <button class="btn btn-primary rounded-pill me-2" onclick="startScanner1()" title="Iniciar Camara"">
              <span class="material-symbols-rounded align-middle">photo_camera</span>
            </button>
            <button class="btn btn-danger rounded-pill" onclick="stopScanner1()" title="Detener Camara">
              <span class="material-symbols-rounded align-middle">no_photography</span>
            </button>
          </div>
        </div>
        <div class="card-footer text-body-secondary p-3">
          <div class="input-group input-group-sm">
            <input type="text" class="form-control" placeholder="No. IMSS" aria-label="Recipient's username" aria-describedby="button-addon2" id="txt-con-imss-id">
            <button class="btn btn-outline-success d-flex justify-content-center align-items-center" type="button" id="button-addon2" title="Buscar">
              <span class="material-symbols-rounded">send</span>
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-xl-9">
      <form action="" class="needs-validation" novalidate id="cons-form">
        <input type="hidden" name="imss" id="cons-id">
        <div class="mb-3 position-relative">
          <label class="form-label">Nombre</label>
          <div class="input-group">
            <span class="input-group-text">
              <span class="material-symbols-rounded">
                school
              </span>
            </span>
            <input type="text" class="form-control rounded-end-2 " name="name" id="cons-name" aria-describedby="helpId" placeholder="" required readonly />
            <div class="invalid-tooltip">
              Rellene el campo.
            </div>
          </div>
        </div>
        <div class="row">
          <div class="mb-3 position-relative col-6">
            <label class="form-label">Edad</label>
            <div class="input-group">
              <span class="input-group-text">
                <span class="material-symbols-rounded">
                  timer
                </span>
              </span>
              <input type="text" class="form-control rounded-end-2" name="age" id="cons-age" aria-describedby="helpId" placeholder="" required />
              <div class="invalid-tooltip">
                Rellene este campo.
              </div>
            </div>
          </div>
          <div class="mb-3 col-6">
            <label for="" class="form-label">Sexo</label>
            <div class="input-group campo-invalido">
              <div class="input-group-text">
                <span class="material-symbols-rounded">
                  wc
                </span>
              </div>
              <select class="form-select form-select" name="sexo" id="cons-sexo" required readonly>
                <option value="" selected disabled>Seleccione...</option>
                <option value="Femenino">Femenino</option>
                <option value="Masculino">Masculino</option>
              </select>
            </div>
          </div>
        </div>

        <div class="mb-3 position-relative">
          <label class="form-label">Grupo y Especialidad</label>
          <div class="input-group mb-3">
            <span class="input-group-text">
              <span class="material-symbols-rounded">
                book
              </span>
            </span>
            <input type="text" class="form-control rounded-end-2" name="gp" id="cons-gp" aria-describedby="helpId" placeholder="" required />
            <div class="invalid-tooltip">
              Rellene este campo.
            </div>
          </div>
        </div>

        <div class="mb-3 position-relative">
          <label class="form-label">Alergías y/o Discapacidades</label>
          <div class="input-group">
            <span class="input-group-text">
              <span class="material-symbols-rounded">
                accessible
              </span>
            </span>
            <textarea class="form-control" rows="3" name="alerg" id="cons-alerg"></textarea>
          </div>
        </div>

        <div class="mb-3 position-relative">
          <label class="form-label">Síntomas</label>
          <div class="input-group rounded-top">
            <span class="input-group-text" style="border-bottom-left-radius: 0px;">
              <span class="material-symbols-rounded">
                sick
              </span>
            </span>
            <textarea class="form-control rounded-top-1" id="txt-con-sin" rows="3" required name="sint" id="cons-sint" style="border-top-left-radius: 0px !important;"></textarea>
            <div class="invalid-tooltip">
              Rellene el campo.
            </div>
          </div>
          <div class="accordion accordion-flush border border-top-0 rounded-bottom-2 mb-3" id="accordionExample">
            <div class="accordion-item rounded-bottom-2">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed rounded-bottom-2" style="background-color: var(--bs-tertiary-bg);" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Mas opciones
                </button>
              </h2>
              <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="sin-con-check" />
                    <label class="form-check-label"> Primeros Auxilios </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="casa" value="1" />
                    <label class="form-check-label"> Mandado a casa </label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="mb- col-9">
              <label for="" class="form-label">Medicamento</label>
              <div class="input-group">
                <span class="input-group-text">
                  <span class="material-symbols-rounded">
                    vaccines
                  </span>
                </span>
                <select class="form-select form-select" name="med" id="cons-med">
                </select>
              </div>
            </div>

            <div class="mb-3 position-relative col-3">
              <label class="form-label">Cantidad</label>
              <div class="input-group">
                <span class="input-group-text">
                  <span class="material-symbols-rounded">
                    add_circle
                  </span>
                </span>
                <input type="number" class="form-control" name="cant" aria-describedby="helpId" placeholder="" id="cons-cant" required />
              </div>
              <div class="invalid-tooltip">
                Rellene este campo.
              </div>
            </div>
          </div>

          <div class="mb-3 position-relative">
            <label class="form-label">Fecha y Hora</label>
            <div class="input-group">
              <span class="input-group-text">
                <span class="material-symbols-rounded">
                  calendar_clock
                </span>
              </span>
              <input type="datetime-local" class="form-control rounded-end-2" name="datetime" id="cons-datetime" required />
              <div class="invalid-tooltip">
                Rellene este campo.
              </div>
            </div>
          </div>

          <div class="row justify-content-end mb-2" role="group" aria-label="Basic mixed styles example">
            <button type="reset" onclick="removeValidation('cons-form')" class="btn rounded-pill me-2 w-auto btn-danger d-flex justify-content-center align-items-center">
              <span class="material-symbols-rounded me-2">
                ink_eraser
              </span>
              Limpiar</button>
            <button type="submit" class="btn btn-primary rounded-pill me-2 w-auto d-flex justify-content-center align-items-center">
              <span class="material-symbols-rounded me-1">
                save
              </span>
              Guardar
            </button>
          </div>
      </form>
    </div>
  </div>
</div>
</div>

<img src="src/upload/pina.jpg" alt="" style="display: none;">
<audio src="src/audio/error.mp3" id="errorAud"></audio>


<script src="index.js"></script>