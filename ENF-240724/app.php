<?php
include('src/assets/head.php');
?>

<!-- modal medicamentos -->
<div class="modal fade modal-lg modal-dialog-scrollable" id="AlertMed" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Alerta de Medicamentos</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="modalAlertMed">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Aceptar</button>
        <button type="button" class="btn btn-outline-primary d-inline-flex rounded-pill" id="btn-admin-alert-med" data-bs-dismiss="modal">
          <span class="material-symbols-rounded me-1" style="font-size: 28px;">
            admin_meds
          </span>
          Administrar Medicamentos</button>
      </div>
    </div>
  </div>
</div>

<!-- toast -->
<div class="d-flex justify-content-center align-items-center w-100" id="container-toast">
</div>

<div class="shadow rounded-3 contenedor m-2 p-2" id="bench1">
  <div class="row">
    <div class="col-lg-12 col-xl-3">
      <div class="card rounded-4 mx-auto" style="width: 18rem;">
        <div class="card-header border-0 rounded-top-4 border-0"
          style="background: var(--enfp-col1); color: white;">
          <h5 class="mb-0 d-flex align-items-center">
            <span class="material-symbols-rounded me-2 fs-2">qr_code_scanner</span>
            Escáner de Identificación
          </h5>
        </div>
        <div class="card-body h-auto">
          <div class="qr-container rounded-3 d-flex align-items-center justify-content-center flex-column mb-3" id="reader1" onclick="startScanner1()">
            <span class="material-symbols-rounded text-muted"
              style="font-size: 3rem; opacity: 0.3;">
              qr_code_scanner
            </span>
            <p class="text-secondary fw-bold">Presione para escanear</p>
          </div>
          <div class="mb-3 w-100 d-inline-flex justify-content-center">
            <button class="btn btn-primary rounded-4 me-2 d-inline-flex" onclick="startScanner1()" title="Iniciar Camara" id="btn-start-scanner1">
              <span class=" material-symbols-rounded">
                play_arrow
              </span>
              Iniciar
            </button>
            <button class="btn btn-outline-secondary rounded-4 d-inline-flex disabled" onclick="stopScanner1()" title="Detener Camara" id="btn-stop-scanner1">
              <span class="material-symbols-rounded">
                stop
              </span>
              Detener
            </button>
          </div>
          <form class="needs-validation" id="form-con-imss-id" novalidate>
            <div class="input-group position-relative">
              <input type="text" class="form-control rounded-start-3" name="txt-con-imss-id" id="txt-con-imss-id" placeholder="Ingrese matrícula" required>
              <div class="invalid-tooltip">
                Rellene este campo.
              </div>
              <button class="btn btn-success d-inline-flex rounded-end-3">
                <span class="material-symbols-rounded">search</span>
              </button>
            </div>
          </form>
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

<div class="shadow rounded-3 contenedor m-2 p-2" id="bench2">
  <div class="row mb-auto">
    <div class="col-lg-12 col-xl-3">

      <div class="card rounded-4 mx-auto">
        <div class="card-header border-0 rounded-top-4 border-0"
          style="background: var(--enfp-col1); color: white;">
          <h5 class="mb-0 d-flex align-items-center">
            <span class="material-symbols-rounded me-2 fs-2">medication_liquid</span>
            Registro de Medicamentos
          </h5>
        </div>
        <div class="card-body">
          <form action="" class="needs-validation" id="medic-form" novalidate>
            <div class="mb-3 position-relative">
              <label class="form-label">Nombre</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">
                  <span class="material-symbols-rounded">
                    medication
                  </span>
                </span>
                <input type="text" class="form-control" name="name" aria-describedby="helpId" placeholder="" required />
              </div>
              <div class="invalid-tooltip">
                Rellene este campo.
              </div>
            </div>

            <div class="mb-3 position-relative">
              <label class="form-label">Fecha de Caducidad</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">
                  <span class="material-symbols-rounded">
                    calendar_month
                  </span>
                </span>
                <input type="date" class="form-control" name="cad" aria-describedby="helpId" placeholder="" required />
              </div>
              <div class="invalid-tooltip">
                Rellene este campo.
              </div>
            </div>

            <div class="mb-3 position-relative">
              <label for="" class="form-label">Tipo</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">
                  <span class="material-symbols-rounded">
                    category
                  </span>
                </span>
                <select class="form-select form-select" name="type" id="" required>
                  <option selected disabled value="">Seleccione...</option>
                  <option value="Pastilla">Pastillas</option>
                  <option value="Botiquín">Botiquín</option>
                </select>
              </div>
              <div class="invalid-tooltip">
                Rellene este campo.
              </div>
            </div>

            <div class="mb-3 position-relative">
              <label class="form-label">Cantidad</label>
              <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">
                  <span class="material-symbols-rounded">
                    add_circle
                  </span>
                </span>
                <input type="number" class="form-control" name="cant" aria-describedby="helpId" placeholder="" required />
              </div>
              <div class="invalid-tooltip">
                Rellene este campo.
              </div>
            </div>

            <div class="d-flex justify-content-end">
              <button type="reset" onclick=" removeValidation('medic-form')" class="btn btn-danger w-auto me-2 rounded-pill d-flex justify-content-center align-items-center">
                <span class="material-symbols-rounded me-2">ink_eraser</span>
                Limpiar</button>
              <button type="submit" class="btn btn-primary w-auto rounded-pill d-flex justify-content-center align-items-center">
                <span class="material-symbols-rounded me-1">
                  save
                </span>
                Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-xl-9">
      <div class="card rounded-4 mx-auto">
        <div class="card-header border-0 rounded-top-4 border-0 d-flex justify-content-between align-items-center" style="background: var(--enfp-col1); color: white;">
          <h5 class="mb-0 d-flex align-items-center">
            <span class="material-symbols-rounded me-2 fs-2">shelves</span>
            Inventario de Medicamentos
          </h5>
          <div class="w-25">
            <div class="input-group input-group-sm">
              <span class="input-group-text d-inline-flex rounded-start-3">
                <span class="material-symbols-rounded">
                  search
                </span>
              </span>
              <input type="text" class="form-control rounded-end-3" placeholder="Buscar..." name="medic-searh-txt" id="medic-search-txt">
            </div>
          </div>
        </div>
        <div class="card-body h-auto p-0">
          <div class="table-desk">
            <table class="table mb-0 table-borderless table-hover">
              <thead class="sticky-top text-center">
                <tr class="border-bottom table-secondary">
                  <th scope="col">No.</th>
                  <th scope="col">Tipo</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Fecha de Cad.</th>
                  <th scope="col">Estado</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody class="text-center" id="table-medic"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalMedic" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Validar informacion</h1>
        <button type="button" onclick="removeValidation('modal-medic-form')" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" class="mb-3 needs-validation" id="modal-medic-form" novalidate>
          <input type="hidden" name="med-id" id="med-id">
          <div class="mb-3 position-relative">
            <label class="form-label">Nombre</label>
            <div class="input-group">
              <span class="input-group-text">
                <span class="material-symbols-rounded">
                  medication
                </span>
              </span>
              <input type="text" class="form-control" name="med-name" id="med-name" aria-describedby="helpId" placeholder="" required />
            </div>
            <div class="invalid-tooltip">
              Rellene este campo.
            </div>
          </div>

          <div class="mb-3 position-relative">
            <label class="form-label">Fecha de Caducidad</label>
            <div class="input-group">
              <span class="input-group-text">
                <span class="material-symbols-rounded">calendar_month</span>
              </span>
              <input type="date" class="form-control" name="med-cad" id="med-cad" aria-describedby="helpId" placeholder="" required />
            </div>
            <div class="invalid-tooltip">
              Rellene este campo.
            </div>
          </div>

          <div class="mb-3 position-relative">
            <label for="" class="form-label">Tipo</label>
            <div class="input-group">
              <span class="input-group-text">
                <span class="material-symbols-rounded">category</span>
              </span>
              <select class="form-select form-select" name="med-type" id="med-type" id="" required>
                <option selected disabled value="">Seleccione...</option>
                <option value="Pastilla">Pastillas</option>
                <option value="Botiquín">Botiquín</option>
              </select>
            </div>
            <div class="invalid-tooltip">
              Rellene este campo.
            </div>
          </div>

          <div class="mb-3 position-relative">
            <label class="form-label">Cantidad</label>
            <div class="input-group">
              <span class="input-group-text">
                <span class="material-symbols-rounded">add_circle</span>
              </span>
              <input type="number" class="form-control" name="med-cant" id="med-cant" aria-describedby="helpId" placeholder="" required />
            </div>
            <div class="invalid-tooltip">
              Rellene este campo.
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="removeValidation('modal-medic-form')" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
          Cancelar
        </button>
        <button type="button" class="btn btn-outline-danger rounded-pill d-inline-flex" id="medic-btn-del">
          <p class="material-symbols-rounded me-1 mb-0">delete</p>
          Eliminar
        </button>
        <button type="button" class="btn btn-outline-primary rounded-pill d-inline-flex" id="medic-btn-edit">
          <p class="material-symbols-rounded me-1 mb-0">edit_square</p>
          Editar
        </button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="shadow rounded-3 contenedor m-2 p-2" id="bench3">
  <div class="card border-0">
    <div class="card-header border-0 rounded-top-4 border-0 d-flex justify-content-between align-items-center" style="background: var(--enfp-col1); color: white;">
      <h5 class="mb-0 d-flex align-items-center">
        <span class="material-symbols-rounded me-2 fs-2">source_notes</span>
        Historial
      </h5>
      <div class="w-25">
        <div class="input-group input-group-sm">
          <span class="input-group-text d-inline-flex rounded-start-3">
            <span class="material-symbols-rounded">
              search
            </span>
          </span>
          <input type="text" class="form-control rounded-end-3" placeholder="Buscar..." name="user-searh-txt" id="hist-search-txt">
        </div>
      </div>
    </div>
    <div class="table-hist border rounded-bottom-4">
      <table class="table m-0 table-borderless table-hover text-center">
        <thead class="sticky-top table-secondary">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Grupo</th>
            <th scope="col">Síntomas</th>
            <th scope="col">Fecha</th>
            <th scope="col">Acciones</th>
          </tr>
        </thead>
        <tbody class="table-group-divider" id="table-hist"></tbody>
      </table>
    </div>
  </div>
</div>
<div class="modal fade" id="histModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Validar Datos</h1>
        <button type="button" onclick="removeValidation('modal-cons-form')" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" class="needs-validation" novalidate id="modal-cons-form">
          <input type="hidden" name="id" id="modal-cons-num">

          <div class="mb-3 position-relative">
            <label class="form-label">ID de Consulta</label>
            <div class="input-group">
              <span class="input-group-text">
                <span class="material-symbols-rounded">
                  tag
                </span>
              </span>
              <input type="text" name="id" id="modal-cons-id" class="form-control" required readonly>
              <div class="invalid-tooltip">
                Rellene este campo.
              </div>
            </div>
          </div>

          <div class="mb-3 position-relative">
            <label class="form-label">Síntomas</label>
            <div class="input-group">
              <span class="input-group-text">
                <span class="material-symbols-rounded">
                  sick
                </span>
              </span>
              <textarea class="form-control" id="modal-txt-con-sin" rows="3" required name="sint" id="modal-cons-sint"></textarea>
              <div class="invalid-tooltip">
                Rellene este campo.
              </div>
            </div>
          </div>
          <div id="alert-div">
          </div>

          <div class="row">
            <div class="mb-3 col-9 ">
              <label for="" class="form-label">Medicamento</label>
              <div class="campo-invalido">
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      medication
                    </span>
                  </span>
                  <select class="form-select form-select" name="med" id="modal-cons-med">
                  </select>
                </div>
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
                <input type="number" class="form-control" name="cant" aria-describedby="helpId" placeholder="" id="modal-cons-cant" required />
                <div class="invalid-tooltip">
                  Rellene este campo.
                </div>
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
              <input type="datetime-local" class="form-control" name="datetime" id="modal-cons-datetime" required readonly />
              <div class="invalid-tooltip">
                Rellene este campo.
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="removeValidation('modal-cons-form')" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
          Cancelar
        </button>
        <button type="button" class="btn btn-outline-danger rounded-pill d-flex align-items-center" id="mhis-btn-del">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
            <path d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
          </svg>
          Eliminar
        </button>
        <button type="button" class="btn btn-outline-primary rounded-pill d-flex align-items-center" id="mhis-btn-edit">
          <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
            <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
          </svg>
          Editar
        </button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="shadow rounded-3 contenedor m-2 p-2" id="bench4">
  <div class="row">
    <div class="col-lg-12 col-xl-3 d-flex justify-content-center mb-3">
      <div>
        <div class="card rounded-4 mx-auto" style="width: 18rem;">
          <div class="card-header border-0 rounded-top-4 border-0"
            style="background: var(--enfp-col1); color: white;">
            <h5 class="mb-0 d-flex align-items-center">
              <span class="material-symbols-rounded me-2 fs-2">qr_code_scanner</span>
              Escáner de Identificación
            </h5>
          </div>
          <div class="card-body h-auto">
            <div class="qr-container rounded-3 d-flex align-items-center justify-content-center flex-column mb-3" id="reader2" onclick="startScanner2()">
              <span class="material-symbols-rounded text-muted"
                style="font-size: 3rem; opacity: 0.3;">
                qr_code_scanner
              </span>
              <p class="text-secondary fw-bold">Presione para escanear</p>
            </div>
            <div class="mb-3 w-100 d-inline-flex justify-content-center">
              <button class="btn btn-primary rounded-4 me-2 d-inline-flex" onclick="startScanner2()" title="Iniciar Camara" id="btn-start-scanner2">
                <span class=" material-symbols-rounded">
                  play_arrow
                </span>
                Iniciar
              </button>
              <button class="btn btn-outline-secondary rounded-4 d-inline-flex disabled" onclick="stopScanner2()" title="Detener Camara" id="btn-stop-scanner2">
                <span class="material-symbols-rounded">
                  stop
                </span>
                Detener
              </button>
            </div>
            <form class="needs-validation" id="form-just-scan" novalidate>
              <div class="input-group position-relative">
                <input type="text" class="form-control rounded-start-3" name="txtJustQR" id="txtJustQR" placeholder="Ingrese matrícula" required>
                <div class="invalid-tooltip">
                  Rellene este campo.
                </div>
                <button class="btn btn-success d-inline-flex rounded-end-3" type="submit">
                  <span class="material-symbols-rounded">search</span>
                </button>
              </div>
            </form>
          </div>
        </div>

        <button type="button" class="btn btn-primary mt-2 rounded-4 d-flex justify-content-center align-items-center" style="width: 18rem;" id="item4_1">
          <span class="material-symbols-rounded me-1">
            history
          </span>
          Historial
        </button>
      </div>


    </div>
    <div class="col-lg-12 col-xl-9">
      <form action="" class="needs-validation" id="form-data-just" novalidate>
        <input type="hidden" name="FormJustIMSS" id="FormJustIMSS">

        <div class="mb-3 position-relative">
          <label class="form-label">Nombre</label>
          <div class="input-group">
            <span class="input-group-text">
              <span class="material-symbols-rounded">
                school
              </span>
            </span>
            <input type="text" class="form-control rounded-end-2" name="nombre" required id="FormJustnombre" readonly />
            <div class="invalid-tooltip">
              Rellene este campo
            </div>
          </div>
        </div>

        <div class="row">
          <div class="mb-3 position-relative">
            <label class="form-label">Grado, Grupo y Especialidad</label>
            <div class="input-group">
              <span class="input-group-text">
                <span class="material-symbols-rounded">
                  book
                </span>
              </span>
              <input type="text" class="form-control rounded-end-2" name="gp" required id="FormJustgp" readonly />
              <div class="invalid-tooltip">
                Rellene este campo
              </div>
            </div>
          </div>

          <div class="row pe-0">
            <div class="col-6">
              <div class="mb-3 position-relative">
                <label class="form-label">Fecha Inicial</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      event_upcoming
                    </span>
                  </span>
                  <input type="date" class="form-control rounded-end-2" name="datestart" required id="FormJustdatestart" />
                  <div class="invalid-tooltip">
                    Rellene este campo
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6 pe-0">
              <div class="mb-3 pe-0 position-relative">
                <label class="form-label">Fecha Final</label>
                <div class="input-group w-100">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      <span class="material-symbols-rounded">
                        event_available
                      </span>
                    </span>
                  </span>
                  <input type="date" class="form-control rounded-end-2" name="dateend" id="FormJustdateend" />
                  <div class="invalid-tooltip">
                    Rellene este campo
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row pe-0">
            <div class="col-6">
              <div class="mb-3 position-relative">
                <label class="form-label">Hora Inicial</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      alarm
                    </span>
                  </span>
                  <input type="time" class="form-control rounded-end-2" name="hourstart" required id="FormJusthourstart" />
                  <div class="invalid-tooltip">
                    Rellene este campo
                  </div>
                </div>
              </div>
            </div>

            <div class="col-6 pe-0">
              <div class="mb-3 position-relative">
                <label class="form-label">Hora Final</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      alarm_on
                    </span>
                  </span>
                  <input type="time" class="form-control rounded-end-2" name="hourend" required id="FormJusthourend" />
                  <div class="invalid-tooltip">
                    Rellene este campo
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="mb-3 position-relative">
            <label class="form-label">Motivo</label>
            <div class="input-group">
              <span class="input-group-text">
                <span class="material-symbols-rounded">
                  info
                </span>
              </span>
              <input type="text" class="form-control rounded-end-2" name="mot" required id="FormJustmot" />
              <div class="invalid-tooltip">
                Rellene este campo
              </div>
            </div>
          </div>

          <div class="mb-3 position-relative">
            <label class="form-label">Detalles</label>
            <div class="input-group">
              <span class="input-group-text">
                <span class="material-symbols-rounded">
                  description
                </span>
              </span>
              <textarea class="form-control rounded-end-2" rows="3" name="det" id="FormJustdet"></textarea>
              <div class="invalid-tooltip">
                Rellene este campo
              </div>
            </div>
          </div>
          <input type="hidden" name="firma" value="<?php echo $_SESSION['nombres']; ?>">

          <div class="row justify-content-end mb-2 pe-0" role="group" aria-label="Basic mixed styles example">
            <button type="reset" onclick="removeValidation('form-data-just')" class="btn btn-danger rounded-pill me-2 w-auto d-flex justify-content-center align-items-center">
              <span class="material-symbols-rounded me-2">
                ink_eraser
              </span>
              Limpiar</button>
            <button type="submit" class="btn btn-primary rounded-pill w-auto d-flex justify-content-center align-items-center" id="btn-JustPrev">
              <span class="material-symbols-rounded me-1">
                check_circle
              </span>
              Continuar
            </button>
          </div>
      </form>
    </div>
  </div>

  <div class="row m-1">
    <div class="card rounded-4 mx-auto px-0">
      <div class="card-header border-0 rounded-top-4 border-0 d-flex justify-content-between align-items-center" style="background: var(--enfp-col1); color: white;">
        <h5 class="mb-0 d-flex align-items-center">
          <span class="material-symbols-rounded me-2 fs-2">call</span>
          Enviar a Docentes
        </h5>
      </div>
      <div class="card-body h-auto p-0">
        <form id="tableDocSend">
          <div class="table-contact border rounded-bottom-4 m-0 p-0">
            <table class="table table-borderless table-hover m-0">
              <thead class="table-success sticky-top">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Docente</th>
                  <th scope="col">No. Celular</th>
                </tr>
              </thead>
              <tbody id="TableSendDocentes">
              </tbody>
              <tfoot class="sticky-bottom table-secondary ">
                <th colspan="2" class="fw-normal">
                  Envía el documento a quien requieras.
                </th>
                <th>
                  <div class="d-flex justify-content-end">
                    <form action="" id="sendpdfform">
                      <div class="input-group input-group-sm w-100 rounded-pill">
                        <input type="text" class="form-control rounded-start-3" placeholder="Numero..." name="num[]">
                        <button class="btn btn-success d-inline-flex rounded-end-3" type="submit">
                          <span class="material-symbols-rounded">send</span>
                          </svg>
                        </button>
                      </div>
                    </form>
                  </div>
                </th>
                </th>
              </tfoot>
            </table>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
<div class="shadow rounded-3 contenedor m-2 p-2 hide" id="bench4_1">
  <button type="button" class="btn rounded-pill mb-2" id="item4_2">
    <svg xmlns="http://www.w3.org/2000/svg" class="mb-1" height="18px" viewBox="0 -960 960 960" width="18px" fill="#e8eaed">
      <path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z" />
    </svg>
    Regresar
  </button>
  <div class="card border-0">
    <div class="card-header border-0 rounded-top-4 border-0 d-flex justify-content-between align-items-center" style="background: var(--enfp-col1); color: white;">
      <h5 class="mb-0 d-flex align-items-center">
        <span class="material-symbols-rounded me-2 fs-2">overview</span>
        Historial de Justificantes
      </h5>
      <div class="w-25">
        <div class="input-group input-group-sm">
          <span class="input-group-text d-inline-flex rounded-start-3">
            <span class="material-symbols-rounded">
              search
            </span>
          </span>
          <input type="text" class="form-control rounded-end-3" placeholder="Buscar..." name="user-searh-txt" id="just-hist-search-txt">
        </div>
      </div>
    </div>
    <div class="card-body h-auto p-0">
      <div class="table-hist-just border rounded-bottom-2">
        <table class="table m-0 table-borderless table-hover">
          <thead class="sticky-top table-secondary">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre </th>
              <th scope="col">Fecha</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody id="tableHistJust">
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- historial justificantes -->
<div class="modal fade" id="JustModalPrev" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Vista previa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="ModalBodyJustPrev">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-outline-primary rounded-pill d-flex align-items-center" id="btnM-JustSave"> <span class="material-symbols-rounded">
            save
          </span> Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

<!-- historial justificantes -->
<div class="modal fade" id="JustHistModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Vista previa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="ModalBodyJustHistPrev">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-outline-dark rounded-pill" id="btnM-JustPrint"> <span class="material-symbols-rounded" style="padding-right: 5px;">
            print
          </span> Imprimir</button>
        <button type="button" class="btn btn-outline-danger rounded-pill" id="btnM-JustSave"> <span class="material-symbols-rounded">
            delete_forever
          </span>Eliminar</button>
      </div>
    </div>
  </div>
</div>
<!-- comentario -->
<div class="shadow rounded-3 contenedor m-2 p-2" id="bench5">
  <div id="loading-screen" class="m-0 p-0 d-flex justify-content-center align-items-center flex-column mt-5">
    <p id="icon-load">
      <span class="material-symbols-rounded text-body-tertiary" style="font-size: 150px;">
        database_off
      </span>
    <p class="fs-1 fw-bold">Sin estadisticas disponibles</p>
    <p class="fs-6 text-muted">Parece que aún no has cargado información en el sistema.</p>
    <small>Presione el botón de abajo para obtener las estadísticas.</small>
    </p>

    <button class="btn btn-primary rounded-pill d-flex justify-content-center align-items-center fs-6" id="button-load">
      <span class="material-symbols-rounded me-1 fs-4">
        cloud_download
      </span>
      Obtener datos
    </button>
  </div>

  <div id="loaded-screen" class="m-0 p-0 d-none">
    <div class="row">
      <!-- card 1 -->
      <div class="col col-12 col-sm-6 col-lg-3">
        <div class="card text-bg-primary mb-3">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="text">
              <h5 class="card-title">Total Consultas</h5>
              <h1 class="card-text" id="card-consultas">25</h1>
            </div>
            <div class="iconC">
              <span class="material-symbols-rounded fs-1">
                ecg
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- card 1 -->
      <div class="col col-12 col-sm-6 col-lg-3">
        <div class="card text-bg-danger mb-3">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="text">
              <h5 class="card-title">Medicamentos</h5>
              <h1 class="card-text" id="card-medic">25</h1>
            </div>
            <div class="iconC">
              <span class="material-symbols-rounded fs-1">
                pill
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- card 1 -->
      <div class="col col-12 col-sm-6 col-lg-3">
        <div class="card text-bg-secondary mb-3">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="text">
              <h5 class="card-title">Alumnos</h5>
              <h1 class="card-text" id="card-alumnos">25</h1>
            </div>
            <div class="iconC">
              <span class="material-symbols-rounded fs-1">
                school
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- card 1 -->
      <div class="col col-12 col-sm-6 col-lg-3">
        <div class="card text-bg-success mb-3">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="text">
              <h5 class="card-title">Personal</h5>
              <h1 class="card-text" id="card-personal">25</h1>
            </div>
            <div class="iconC">
              <span class="material-symbols-rounded fs-1">
                person
              </span>
            </div>
          </div>
        </div>
      </div>

    </div>
    <div class="row">
      <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
        <li class="nav-item ms-3" role="presentation">
          <button class="nav-link navlinkStats fs-6 active d-flex justify-content-center align-items-center" id="cons-stat-tab" data-bs-toggle="tab" data-bs-target="#cons-stat-tab-pane" type="button" role="tab" aria-controls="cons-stat-tab-pane" aria-selected="true" CanvaId="cons-stat-canva" CanvaType="line" CanvaKey="cons">
            <span class="material-symbols-rounded fs-4 me-1">
              ecg
            </span>
            Consultas
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link navlinkStats fs-6 d-flex justify-content-center align-items-center" id="medic-stat-tab" data-bs-toggle="tab" data-bs-target="#medic-stat-tab-pane" type="button" role="tab" aria-controls="medic-stat-tab-pane" aria-selected="false" CanvaId="medic-stat-canva" CanvaType="pie" CanvaKey="medic">
            <span class="material-symbols-rounded fs-4 me-1">
              medical_services
            </span>
            Medicamentos
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link navlinkStats fs-6 d-flex justify-content-center align-items-center" id="mot-stat-tab" data-bs-toggle="tab" data-bs-target="#mot-stat-tab-pane" type="button" role="tab" aria-controls="mot-stat-tab-pane" aria-selected="false" CanvaId="mot-stat-canva" CanvaType="bar" CanvaKey="mot">
            <span class="material-symbols-rounded fs-4 me-1">
              clinical_notes
            </span>
            Motivos
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link navlinkStats fs-6 d-flex justify-content-center align-items-center" id="gender-stat-tab" data-bs-toggle="tab" data-bs-target="#gender-stat-tab-pane" type="button" role="tab" aria-controls="gender-stat-tab-pane" aria-selected="false" CanvaId="gender-stat-canva" CanvaType="doughnut" CanvaKey="gender">
            <span class="material-symbols-rounded fs-4 me-1">
              wc
            </span>
            Genero
          </button>
        </li>
        <li class="nav-item me-2" role="presentation">
          <button class="nav-link navlinkStats fs-6 d-flex justify-content-center align-items-center" id="roles-stat-tab" data-bs-toggle="tab" data-bs-target="#roles-stat-tab-pane" type="button" role="tab" aria-controls="roles-stat-tab-pane" aria-selected="false" CanvaId="none">
            <span class="material-symbols-rounded fs-4 me-1">
              groups
            </span>
            Roles
          </button>
        </li>
      </ul>
      <div class="tab-content tab-content-stat h-100" id="myTabContent">
        <div class="tab-pane fade show active" id="cons-stat-tab-pane" role="tabpanel" tabindex="0">
          <div class="card mt-5">
            <div class="card-header">
              Consultas por Día
            </div>
            <div class="card-body">
              <canvas id="cons-stat-canva" class="w-100" style="height: 450px;"></canvas>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="medic-stat-tab-pane" role="tabpanel" tabindex="0">
          <div class="row d-flex align-items-stretch">
            <div class="col col-12 col-md-6">
              <div class="card mt-5">
                <div class="card-header">
                  Uso de Medicamentos
                </div>
                <div class="card-body">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Hombres</th>
                        <th scope="col">Mujeres</th>
                        <th scope="col">Porcentaje</th>
                      </tr>
                    </thead>
                    <tbody id="stats-table-medic">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col col-12 col-md-6">
              <div class="card mt-5">
                <div class="card-header">
                  Distribución de Medicamentos
                </div>
                <div class="card-body">
                  <canvas id="medic-stat-canva" class="w-100" style="height: 450px;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="mot-stat-tab-pane" role="tabpanel" tabindex="0">
          <div class="card mt-5">
            <div class="card-header">
              Motivos de Consulta
            </div>
            <div class="card-body">
              <canvas id="mot-stat-canva" class="w-100" style="height: 450px;"></canvas>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="gender-stat-tab-pane" role="tabpanel" tabindex="0">
          <div class="row d-flex align-items-stretch">
            <div class="col col-12 col-md-6">
              <div class="card mt-5">
                <div class="card-header">
                  Distribución Porcentual por Rol
                </div>
                <div class="card-body">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Grupo</th>
                        <th scope="col">Visitas</th>
                        <th scope="col">Porcentajes</th>
                      </tr>
                    </thead>
                    <tbody id="stats-table-gender"></tbody>
                  </table>
                </div>
              </div>
            </div>

            <div class="col col-12 col-md-6">
              <div class="card mt-5">
                <div class="card-header">
                  Distribución de Género
                </div>
                <div class="card-body">
                  <canvas id="gender-stat-canva" class="w-100" style="height: 450px;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="roles-stat-tab-pane" role="tabpanel" tabindex="0">
          <div class="card mt-5">
            <div class="card-header">
              Distribución por Grupo
            </div>
            <div class="card-body">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Grupo</th>
                    <th scope="col">Visitas</th>
                    <th scope="col">Porcentaje</th>
                  </tr>
                </thead>
                <tbody id="stats-table-group"></tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<div class="shadow rounded-3 contenedor m-2 p-2" id="bench6">
  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link rounded-pill d-flex justify-content-center align-items-center active" id="alumnos-tab" data-bs-toggle="pill" data-bs-target="#alumnos" type="button" role="tab" aria-controls="alumnos" aria-selected="true">
        <span class="material-symbols-rounded me-1">
          groups
        </span>
        General
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link rounded-pill d-flex justify-content-center align-items-center" id="usuarios-tab" data-bs-toggle="pill" data-bs-target="#usuarios" type="button" role="tab" aria-controls="usuarios" aria-selected="false">
        <span class="material-symbols-rounded me-1">
          key
        </span>
        Usuarios
      </button>
    </li>
<!--     <li class="nav-item" role="presentation">
      <button class="nav-link rounded-pill d-flex justify-content-center align-items-center" id="datos-tab" data-bs-toggle="pill" data-bs-target="#datos" type="button" role="tab" aria-controls="datos" aria-selected="false">
        <span class="material-symbols-rounded me-1">
          database
        </span>
        Datos
      </button>
    </li> -->
  </ul>
  <div class="tab-content tabGen" id="pills-tabContent">
    <div class="tab-pane fade show active border rounded-3 p-2" id="alumnos" role="tabpanel" aria-labelledby="alumnos-tab" tabindex="0">
      <div class="row">
        <div class="col-lg-12 col-xl-3 mb-2">
          <div class="card rounded-4 mx-auto">
            <div class="card-header border-0 rounded-top-4 border-0"
              style="background: var(--enfp-col1); color: white;">
              <h5 class="mb-0 d-flex align-items-center">
                <span class="material-symbols-rounded me-2 fs-2">person_add</span>
                Registrar Personas
              </h5>
            </div>
            <div class="card-body p-1 px-2">
              <div class="form-scroll">
                <form class="needs-validation" id="tab-gen-form" novalidate>
                  <div class="mb-3 position-relative">
                    <label class="form-label">Numero IMSS</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <span class="material-symbols-rounded">
                          tag
                        </span>
                      </span>
                      <input type="text" class="form-control" name="num" aria-describedby="helpId" placeholder="" required />
                      <div class="invalid-tooltip">
                        Rellene este campo.
                      </div>
                      </span>
                    </div>
                  </div>

                  <div class="mb-3 position-relative">
                    <label class="form-label">Nombre</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <span class="material-symbols-rounded">
                          id_card
                        </span>
                      </span>
                      <input type="text" class="form-control" name="name" aria-describedby="helpId" placeholder="" required />
                      <div class="invalid-tooltip">
                        Rellene este campo.
                      </div>
                    </div>
                  </div>

                  <div class="mb-3 position-relative">
                    <label class="form-label">Edad</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <span class="material-symbols-rounded">
                          timer
                        </span>
                      </span>
                      <input type="text" class="form-control" name="age" aria-describedby="helpId" placeholder="" required />
                      <div class="invalid-tooltip">
                        Rellene este campo.
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="" class="form-label">Sexo</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <span class="material-symbols-rounded">
                          wc
                        </span>
                      </span>
                      <select class="form-select form-select" name="sexo" required>
                        <option value="" selected disabled>Seleccione...</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                      </select>
                    </div>
                  </div>

                  <div class="mb-3 position-relative">
                    <label class="form-label">Grupo</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <span class="material-symbols-rounded">
                          book
                        </span>
                      </span>
                      <select class="form-select" aria-label="Default select example" name="group" required>
                        <option selected disabled value="">Seleccione...</option>
                        <option value="1">1°A</option>
                        <option value="2">1°B</option>
                        <option value="3">1°A</option>
                        <option value="4">1°B</option>
                        <option value="5">1°C</option>
                        <option value="6">1°D</option>
                        <option value="7">1°E</option>
                        <option value="8">1°F</option>
                        <option value="9">1°G</option>
                        <option value="10">2°A Administracion de Recursos Humanos</option>
                        <option value="11">2°B Administracion de Recursos Humanos</option>
                        <option value="12">2°A Contabilidad</option>
                        <option value="13">2°A Logistica</option>
                        <option value="14">2°A Programación</option>
                        <option value="15">2°B Programación</option>
                        <option value="16">2°A Soporte y Mantenimiento</option>
                        <option value="17">3°A Administracion de Recursos Humanos</option>
                        <option value="18">3°B Administracion de Recursos Humanos</option>
                        <option value="19">3°A Contabilidad</option>
                        <option value="20">3°A Logistica</option>
                        <option value="21">3°A Programación</option>
                        <option value="22">3°B Programación</option>
                        <option value="23">3°A Soporte y Mantenimiento</option>
                        <option value="24">4°A Administracion de Recursos Humanos</option>
                        <option value="25">4°B Administracion de Recursos Humanos</option>
                        <option value="26">4°A Contabilidad</option>
                        <option value="27">4°A Logistica</option>
                        <option value="28">4°A Programación</option>
                        <option value="29">4°B Programación</option>
                        <option value="30">4°A Soporte y Mantenimiento</option>
                        <option value="31">5°A Administracion de Recursos Humanos</option>
                        <option value="32">5°B Administracion de Recursos Humanos</option>
                        <option value="33">5°A Contabilidad</option>
                        <option value="34">5°A Logistica</option>
                        <option value="35">5°A Programación</option>
                        <option value="36">5°B Programación</option>
                        <option value="37">5°A Soporte y Mantenimiento</option>
                        <option value="38">6°A Administracion de Recursos Humanos</option>
                        <option value="39">6°B Administracion de Recursos Humanos</option>
                        <option value="40">6°A Contabilidad</option>
                        <option value="41">6°A Logistica</option>
                        <option value="42">6°A Programación</option>
                        <option value="43">6°B Programación</option>
                        <option value="44">6°A Soporte y Mantenimiento</option>
                        <option value="45">Docente</option>
                      </select>
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
                      <textarea class="form-control" rows="3" name="alerg"></textarea>
                      <div class="invalid-tooltip">
                        Rellene este campo.
                      </div>
                    </div>
                  </div>

                  <div class="mb-3 position-relative">
                    <label class="form-label">Numero Telefonico</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <span class="material-symbols-rounded">
                          phone_in_talk
                        </span>
                      </span>
                      <input type="text" class="form-control" name="phone" aria-describedby="helpId" placeholder="" />
                      <div class="invalid-tooltip">
                        Rellene este campo.
                      </div>
                    </div>
                    <small id="helpId" class="form-text text-muted">*Solo aplica para <b>Docentes</b></small>
                  </div>

                  <div class="w-100 d-flex justify-content-end mt-2 mb-2">
                    <button type="reset" onclick="removeValidation('tab-gen-form')" class="btn btn-danger w-auto rounded-pill me-2 d-flex justify-content-center align-items-center">
                      <span class="material-symbols-rounded me-2">
                        ink_eraser
                      </span>
                      Limpiar
                    </button>
                    <button type="submit" class="btn btn-primary w-auto rounded-pill d-flex justify-content-center align-items-center">
                      <span class="material-symbols-rounded me-2">
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
        <div class="col-lg-12 col-xl-9">

          <div class="card rounded-4 mx-auto">
            <div class="card-header border-0 rounded-top-4 border-0 d-flex justify-content-between align-items-center" style="background: var(--enfp-col1); color: white;">
              <h5 class="mb-0 d-flex align-items-center">
                <span class="material-symbols-rounded me-2 fs-2">group</span>
                Personas Registradas
              </h5>
              <div class="w-25">
                <div class="input-group input-group-sm">
                  <span class="input-group-text d-inline-flex rounded-start-3">
                    <span class="material-symbols-rounded">
                      search
                    </span>
                  </span>
                  <input type="text" class="form-control rounded-end-3" placeholder="Buscar..." name="gen-searh-txt" id="gen-searh-txt">
                </div>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="tables-config">
                <table class="table mb-0 table-borderless table-hover">
                  <thead class="sticky-top table-secondary">
                    <tr class="border-bottom">
                      <th scope="col">No. IMSS</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Edad</th>
                      <th scope="col">Grupo</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="table-gen">
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="tab-pane fade border rounded-3 p-2" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab" tabindex="0">
      <div class="row">
        <div class="col-lg-12 col-xl-3">
          <div class="card rounded-4 mx-auto">
            <div class="card-header border-0 rounded-top-4 border-0"
              style="background: var(--enfp-col1); color: white;">
              <h5 class="mb-0 d-flex align-items-center">
                <span class="material-symbols-rounded me-2 fs-2">add_moderator</span>
                Registrar Usuarios
              </h5>
            </div>
            <div class="card-body p-1 px-2">
              <div class="form-scroll">
                <form action="" class="needs-validation" novalidate id="tab-user-form">
                  <div class="mb-3 position-relative">
                    <label class="form-label">Numero IMSS</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <span class="material-symbols-rounded">
                          tag
                        </span>
                      </span>
                      <input type="text" class="form-control" name="num-imss" aria-describedby="helpId" placeholder="" required />
                      <div class="invalid-tooltip">
                        Rellene este campo.
                      </div>
                    </div>
                  </div>

                  <div class="mb-3 position-relative">
                    <label class="form-label">Nombre de Usuario</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <span class="material-symbols-rounded">
                          account_circle
                        </span>
                      </span>
                      <input type="text" class="form-control" name="username" aria-describedby="helpId" placeholder="" required />
                      <div class="invalid-tooltip">
                        Rellene este campo.
                      </div>
                    </div>
                  </div>

                  <div class="mb-3 position-relative">
                    <label class="form-label">Nombre Completo</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <span class="material-symbols-rounded">
                          id_card
                        </span>
                      </span>
                      <input type="text" class="form-control" name="names" aria-describedby="helpId" placeholder="" required />
                      <div class="invalid-tooltip">
                        Rellene este campo.
                      </div>
                    </div>
                  </div>

                  <div class="mb-3 position-relative">
                    <label class="form-label">Correo Electronico:</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <span class="material-symbols-rounded">
                          alternate_email
                        </span>
                      </span>
                      <input type="email" class="form-control" name="email" aria-describedby="helpId" placeholder="" required />
                      <div class="invalid-tooltip">
                        Rellene este campo.
                      </div>
                    </div>
                  </div>

                  <div class="mb-3 position-relative">
                    <label class="form-label">Contraseña</label>
                    <div class="input-group">
                      <span class="input-group-text">
                        <span class="material-symbols-rounded">
                          password
                        </span>
                      </span>
                      <input type="text" class="form-control" name="password" aria-describedby="helpId" placeholder="" required />
                      <div class="invalid-tooltip">
                        Rellene este campo.
                      </div>
                    </div>
                  </div>


                  <div class="w-100 d-flex justify-content-end mt-2 mb-2">
                    <button type="reset" onclick="removeValidation('tab-user-form')" class="btn btn-danger rounded-pill me-2 d-flex justify-content-center align-items-center">
                      <span class="material-symbols-rounded me-2">
                        ink_eraser
                      </span>
                      Limpiar
                    </button>
                    <button type="submit" name="btn-g" class="btn btn-primary rounded-pill d-flex justify-content-center align-items-center">
                      <span class="material-symbols-rounded me-2">
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
        <div class="col-lg-12 col-xl-9">
          <div class="card rounded-4 mx-auto">
            <div class="card-header border-0 rounded-top-4 border-0 d-flex justify-content-between align-items-center" style="background: var(--enfp-col1); color: white;">
              <h5 class="mb-0 d-flex align-items-center">
                <span class="material-symbols-rounded me-2 fs-2">security</span>
                Usuarios Registrados
              </h5>
              <div class="w-25">
                <div class="input-group input-group-sm">
                  <span class="input-group-text d-inline-flex rounded-start-3">
                    <span class="material-symbols-rounded">
                      search
                    </span>
                  </span>
                  <input type="text" class="form-control rounded-end-3" placeholder="Buscar..." name="user-searh-txt" id="user-search-txt">
                </div>
              </div>
            </div>
            <div class="card-body p-0">
              <div class="tables-config">
                <table class="table mb-0 table-borderless table-hover">
                  <thead class="sticky-top table-secondary">
                    <tr class="border-bottom">
                      <th scope="col">No. IMSS</th>
                      <th scope="col">Nombre de Usuario</th>
                      <th scope="col">Nombres</th>
                      <th scope="col">Correo</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="table-users">

                  </tbody>
                </table>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
    <div class="tab-pane fade border rounded-3 p-2" id="datos" role="tabpanel" aria-labelledby="datos-tab" tabindex="0">
      <div class="row">
        <div class="col col-12 col-lg-6">
          <div class="title-data d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px" fill="#e8eaed">
              <path d="M280-120 80-320l200-200 57 56-104 104h607v80H233l104 104-57 56Zm400-320-57-56 104-104H120v-80h607L623-784l57-56 200 200-200 200Z" />
            </svg>
            <h3 class="ms-3">Transferir datos</h3>
          </div>
          <div class="alert alert-danger" role="alert">
            <div class="title-icon text-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="" height="48px" viewBox="0 -960 960 960" width="48px" fill="#e8eaed">
                <path d="M440-440h80v-200h-80v200Zm40 120q17 0 28.5-11.5T520-360q0-17-11.5-28.5T480-400q-17 0-28.5 11.5T440-360q0 17 11.5 28.5T480-320ZM160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160Zm320-300Zm0 420q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80ZM320-280h320v-280q0-66-47-113t-113-47q-66 0-113 47t-47 113v280Z" />
              </svg>
              <h4 class="alert-heading">¡Cuidado!</h4>
            </div>
            <p>Si desea transferir los grupos y datos de los alumnos, tenga en cuenta que este proceso <b>eliminara</b> algunos datos en toda la aplicacion, impidendo mostrar totalmente datos estadisticos e historiales de forma precisa.</p>
            <hr>
            <p class="mb-0">Si leiste el texto anterior cuidadosamente puedes <a class="alert-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDataTransfer" aria-controls="offcanvasDataTransfer">Continuar</a>.</p>
          </div>
        </div>
        <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasDataTransfer" aria-labelledby="offcanvasTopLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasTopLabel">Transferencia de datos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            Al oprimir en <b>continuar</b>, la aplicacion se reiniciara, esto con el fin de hacer que los cambios surtan efecto.
            <div class="row">
              <div class="col-9">
                <form action="">
                  <div class="mt-3">
                    <select class="form-select form-select" name="">
                      <option selected disabled>Seleccionar...</option>
                      <option value="">De 1° Semestre a 2° Semestre</option>
                      <option value="">De 2° Semestre a 3° Semestre</option>
                    </select>
                  </div>
              </div>

              <div class="col-3 mt-3">
                <button type="button" class="btn btn-warning">
                  Continuar
                </button>
              </div>
              </form>

            </div>

          </div>
        </div>

        <div class="col col-12 col-lg-6">
          <div class="title-data d-flex">
            <svg xmlns="http://www.w3.org/2000/svg" height="36px" viewBox="0 -960 960 960" width="36px" fill="#e8eaed">
              <path d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
            </svg>
            <h3 class="ms-2">Eliminar Estadisticas e Historiales</h3>
          </div>
          <div class="alert alert-danger" role="alert">
            <div class="title-icon text-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="" height="48px" viewBox="0 -960 960 960" width="48px" fill="#e8eaed">
                <path d="M440-440h80v-200h-80v200Zm40 120q17 0 28.5-11.5T520-360q0-17-11.5-28.5T480-400q-17 0-28.5 11.5T440-360q0 17 11.5 28.5T480-320ZM160-200v-80h80v-280q0-83 50-147.5T420-792v-28q0-25 17.5-42.5T480-880q25 0 42.5 17.5T540-820v28q80 20 130 84.5T720-560v280h80v80H160Zm320-300Zm0 420q-33 0-56.5-23.5T400-160h160q0 33-23.5 56.5T480-80ZM320-280h320v-280q0-66-47-113t-113-47q-66 0-113 47t-47 113v280Z" />
              </svg>
              <h4 class="alert-heading">¡Cuidado!</h4>
            </div>
            <p>Si va a realizar este proceso, lo que hara es que eliminara <b>todos los historiales y estadisticas</b>, asegurese de haber capturado los datos necesarios, despues podra proseguir.</p>
            <hr>
            <p class="mb-0">Si leiste el texto anterior cuidadosamente puedes <a class="alert-link" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDeleteData" aria-controls="offcanvasDeleteData">Continuar</a>.</p>
          </div>
        </div>
        <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasDeleteData" aria-labelledby="offcanvasTopLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasTopLabel">Eliminacion de datos</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <p>Al oprimir en <b>continuar</b>, la aplicacion se reiniciara, esto con el fin de hacer que los cambios surtan efecto.</p>

            <button type="button" class="btn btn-warning mt-3" data-bs-toggle="button" aria-pressed="false" autocomplete="off">
              Continuar
            </button>

          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalGen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Validar informacion</h1>
            <button type="button" class="btn-close mg-btn-close" id="mg-btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" id="mg-form" novalidate>
              <input type="hidden" name="mg-id" id="mg-id">
              <input type="hidden" name="mg-id-g" id="mg-id-g">
              <div class="mb-3 position-relative">
                <label class="form-label">Numero IMSS</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      tag
                    </span>
                  </span>
                  <input type="text" class="form-control" name="mg-numimss" id="mg-numimss" aria-describedby="helpId" placeholder="" required />
                  <div class="invalid-tooltip">
                    Rellene este campo.
                  </div>
                </div>
              </div>

              <div class="mb-3 position-relative">
                <label class="form-label">Nombre</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      id_card
                    </span>
                  </span>
                  <input type="text" class="form-control" name="mg-name" id="mg-name" aria-describedby="helpId" placeholder="" required />
                  <div class="invalid-tooltip">
                    Rellene este campo.
                  </div>
                </div>
              </div>

              <div class="mb-3 position-relative">
                <label class="form-label">Edad</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      timer
                    </span>
                  </span>
                  <input type="text" class="form-control" name="mg-age" id="mg-age" aria-describedby="helpId" placeholder="" required />
                  <div class="invalid-tooltip">
                    Rellene este campo.
                  </div>
                </div>
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Sexo</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      wc
                    </span>
                  </span>
                  <select class="form-select form-select" name="mg-sexo" id="mg-sexo" required>
                    <option value="" disabled>Seleccione...</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                  </select>
                </div>
              </div>

              <div class="mb-3 position-relative">
                <label class="form-label">Grupo</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      book
                    </span>
                  </span>
                  <select class="form-select" aria-label="Default select example" name="mg-group" id="mg-group" required>
                    <option selected disabled value="">Seleccione...</option>
                    <option value="1">1°A</option>
                    <option value="2">1°B</option>
                    <option value="3">1°A</option>
                    <option value="4">1°B</option>
                    <option value="5">1°C</option>
                    <option value="6">1°D</option>
                    <option value="7">1°E</option>
                    <option value="8">1°F</option>
                    <option value="9">1°G</option>
                    <option value="10">2°A Administracion de Recursos Humanos</option>
                    <option value="11">2°B Administracion de Recursos Humanos</option>
                    <option value="12">2°A Contabilidad</option>
                    <option value="13">2°A Logistica</option>
                    <option value="14">2°A Programación</option>
                    <option value="15">2°B Programación</option>
                    <option value="16">2°A Soporte y Mantenimiento</option>
                    <option value="17">3°A Administracion de Recursos Humanos</option>
                    <option value="18">3°B Administracion de Recursos Humanos</option>
                    <option value="19">3°A Contabilidad</option>
                    <option value="20">3°A Logistica</option>
                    <option value="21">3°A Programación</option>
                    <option value="22">3°B Programación</option>
                    <option value="23">3°A Soporte y Mantenimiento</option>
                    <option value="24">4°A Administracion de Recursos Humanos</option>
                    <option value="25">4°B Administracion de Recursos Humanos</option>
                    <option value="26">4°A Contabilidad</option>
                    <option value="27">4°A Logistica</option>
                    <option value="28">4°A Programación</option>
                    <option value="29">4°B Programación</option>
                    <option value="30">4°A Soporte y Mantenimiento</option>
                    <option value="31">5°A Administracion de Recursos Humanos</option>
                    <option value="32">5°B Administracion de Recursos Humanos</option>
                    <option value="33">5°A Contabilidad</option>
                    <option value="34">5°A Logistica</option>
                    <option value="35">5°A Programación</option>
                    <option value="36">5°B Programación</option>
                    <option value="37">5°A Soporte y Mantenimiento</option>
                    <option value="38">6°A Administracion de Recursos Humanos</option>
                    <option value="39">6°B Administracion de Recursos Humanos</option>
                    <option value="40">6°A Contabilidad</option>
                    <option value="41">6°A Logistica</option>
                    <option value="42">6°A Programación</option>
                    <option value="43">6°B Programación</option>
                    <option value="44">6°A Soporte y Mantenimiento</option>
                    <option value="45">Docente</option>
                  </select>
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
                  <textarea class="form-control" rows="3" name="mg-alerg" id="mg-alerg"></textarea>
                  <div class="invalid-tooltip">
                    Rellene este campo.
                  </div>
                </div>
              </div>

              <div class="mb-3 position-relative">
                <label class="form-label">Numero Telefonico</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      phone_in_talk
                    </span>
                  </span>
                  <input type="text" class="form-control" name="mg-phone" id="mg-phone" aria-describedby="helpId" placeholder="" />
                  <div class="invalid-tooltip">
                    Rellene este campo.
                  </div>
                </div>
                <small id="helpId" class="form-text text-muted">*Solo aplica para <b>Docentes</b></small>
              </div>

              <div class="container-fluid d-flex justify-content-center align-items-center">
                <div class="card d-inline-block">
                  <div class="card-header">Codigo QR</div>
                  <div class="card-body">
                    <div class="qrDrawer" id="qrDrawer"></div>
                  </div>
                </div>
              </div>

          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary rounded-pill mg-btn-close" data-bs-dismiss="modal">
              Cancelar
            </button>
            <button type="submit" class="btn btn-outline-danger rounded-pill d-flex align-items-center" id="mg-btn-del">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                <path d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
              </svg>
              Eliminar
            </button>
            <button type="submit" class="btn btn-outline-primary rounded-pill d-flex align-items-center" id="mg-btn-edit">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
              </svg>
              Editar
            </button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Validar informacion</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="" class="needs-validation" novalidate id="mus-form">
              <input type="hidden" name="mus-id" id="mus-id">
              <div class="mb-3 position-relative">
                <label class="form-label">Numero IMSS</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      tag
                    </span>
                  </span>
                  <input type="text" class="form-control" name="mus-imss" id="mus-imss" aria-describedby="helpId" placeholder="" required />
                  <div class="invalid-tooltip">
                    Rellene este campo.
                  </div>
                </div>
              </div>

              <div class="mb-3 position-relative">
                <label class="form-label">Nombre de Usuario</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      account_circle
                    </span>
                  </span>
                  <input type="text" class="form-control" name="mus-username" id="mus-username" aria-describedby="helpId" placeholder="" required />
                  <div class="invalid-tooltip">
                    Rellene este campo.
                  </div>
                </div>
              </div>

              <div class="mb-3 position-relative">
                <label class="form-label">Nombre Completo</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      id_card
                    </span>
                  </span>
                  <input type="text" class="form-control" name="mus-names" id="mus-names" aria-describedby="helpId" placeholder="" required />
                  <div class="invalid-tooltip">
                    Rellene este campo.
                  </div>
                </div>
              </div>

              <div class="mb-3 position-relative">
                <label class="form-label">Correo Electronico:</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      alternate_email
                    </span>
                  </span>
                  <input type="email" class="form-control" name="mus-email" id="mus-email" aria-describedby="helpId" placeholder="" required />
                  <div class="invalid-tooltip">
                    Rellene este campo.
                  </div>
                </div>
              </div>

              <div class="mb-3 position-relative">
                <label class="form-label">Contraseña</label>
                <div class="input-group">
                  <span class="input-group-text">
                    <span class="material-symbols-rounded">
                      password
                    </span>
                  </span>
                  <input type="password" class="form-control" name="mus-password" id="mus-password" aria-describedby="helpId" placeholder="" required />
                  <div class="invalid-tooltip">
                    Rellene este campo.
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">
              Cancelar
            </button>
            <button type="button" class="btn btn-outline-danger rounded-pill d-flex align-items-center" id="mus-btn-del">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                <path d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z" />
              </svg>
              Eliminar
            </button>
            <button type="button" class="btn btn-outline-primary rounded-pill d-flex align-items-center" id="mus-btn-edit">
              <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF">
                <path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z" />
              </svg>
              Editar
            </button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="shadow rounded-3 contenedor m-2 p-2" id="bench7">
  <div class="row d-flex" style="max-height: 80vh !important;">
    <div class="col-lg-12 col-xl-3" style="max-height: 85% !important;">
      <div class="card rounded-4 mx-auto" style="width: 18rem;">
        <div class="card-header border-0 rounded-top-4 border-0"
          style="background: var(--enfp-col1); color: white;">
          <h5 class="mb-0 d-flex align-items-center">
            <span class="material-symbols-rounded me-2 fs-2">qr_code_scanner</span>
            Escáner de Identificación
          </h5>
        </div>
        <div class="card-body h-auto">
          <div class="qr-container rounded-3 d-flex align-items-center justify-content-center flex-column mb-3" id="reader3" onclick="startScanner3()">
            <span class="material-symbols-rounded text-muted"
              style="font-size: 3rem; opacity: 0.3;">
              qr_code_scanner
            </span>
            <p class="text-secondary fw-bold">Presione para escanear</p>
          </div>
          <div class="mb-3 w-100 d-inline-flex justify-content-center">
            <button class="btn btn-primary rounded-4 me-2 d-inline-flex" onclick="startScanner3()" title="Iniciar Camara" id="btn-start-scanner3">
              <span class=" material-symbols-rounded">
                play_arrow
              </span>
              Iniciar
            </button>
            <button class="btn btn-outline-secondary rounded-4 d-inline-flex disabled" onclick="stopScanner3()" title="Detener Camara" id="btn-stop-scanner3">
              <span class="material-symbols-rounded">
                stop
              </span>
              Detener
            </button>
          </div>
          <form class="needs-validation" id="FormFolderQR" novalidate>
            <div class="input-group position-relative">
              <input type="text" class="form-control rounded-start-3" name="txtFolderQR" id="txtFolderQR" placeholder="Ingrese matrícula" required>
              <div class="invalid-tooltip">
                Rellene este campo.
              </div>
              <button class="btn btn-success d-inline-flex rounded-end-3" type="submit">
                <span class="material-symbols-rounded">search</span>
              </button>
            </div>
          </form>
        </div>
        <div class="card-footer d-none" id="alerta">
        </div>
      </div>
    </div>

    <div class="col-lg-12 col-xl-9" style="max-height: 48%">
      <div class="row d-flex justify-content-center" style="max-height: 45vh; overflow-y: auto;">
        <div class="col-11">

          <div class="card border-0 p-0 w-100 mb-3">
            <div class="card-header border-0 rounded-top-4 border-0 d-flex justify-content-between align-items-center" style="background: var(--enfp-col1); color: white;">
              <h5 class="mb-0 d-flex align-items-center">
                <span class="material-symbols-rounded me-2 fs-2">medical_information</span>
                Consultas
              </h5>
            </div>
            <div class="card-body border rounded-bottom-4 p-0" style="min-height: 285px;max-height: 285px; overflow-y: auto;">
              <table class="table mb-0 table-hover" style="max-height: 280px;">
                <thead class="border-bottom sticky-top">
                  <thead class="table-secondary sticky-top">
                    <tr>
                      <th scope="col">ID</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Grupo</th>
                      <th scope="col">Síntomas</th>
                      <th scope="col">Fecha</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                </thead>
                <tbody id="folderCons">
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-11">
          <div class="card border-0 p-0 w-100 mb-3">
            <div class="card-header border-0 rounded-top-4 border-0 d-flex justify-content-between align-items-center" style="background: var(--enfp-col1); color: white;">
              <h5 class="mb-0 d-flex align-items-center">
                <span class="material-symbols-rounded me-2 fs-2">quick_reference</span>
                Justificantes
              </h5>
            </div>
            <div class="card-body border rounded-bottom-4 p-0" style="min-height: 285px;max-height: 285px; overflow-y: auto;">
              <table class="table mb-0 table-hover" style="max-height: 280px;">
                <thead class="table-secondary sticky-top">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre </th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody id="folderJust">

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<img src="src/upload/pina.jpg" alt="" style="display: none;">
<audio src="src/audio/error.mp3" id="errorAud"></audio>


<?php include('src/assets/foot.php'); ?>