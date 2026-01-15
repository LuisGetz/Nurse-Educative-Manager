//#region qrFunctions

//#region qr1 */
let innerDiv = document.getElementById('reader1').innerHTML
function startScanner1() {
  html5QrCode.start(
    { facingMode: "environment" },
    {
      fps: 10,
      qrbox: { width: 180, height: 150 },
    },
    decodedText => {
      console.log("QR detectado:", decodedText)
      document.getElementById('txt-con-imss-id').value = decodedText
      stopScanner1()
    },
    error => {
      //console.warn("QR no detectado", error)
    }
  ).catch(err => {
    console.error("No se pudo iniciar el escáner:", err)
  })
  document.getElementById('btn-start-scanner1').classList.add('disabled', 'btn-outline-secondary')
  document.getElementById('btn-start-scanner1').classList.remove('btn-outline-primary')
  document.getElementById('btn-stop-scanner1').classList.remove('disabled', 'btn-outline-secondary')
  document.getElementById('btn-stop-scanner1').classList.add('btn-danger')
}

function stopScanner1() {
  html5QrCode.stop().then(() => {
    document.getElementById('reader1').innerHTML = innerDiv
    document.getElementById('btn-stop-scanner1').classList.add('disabled', 'btn-outline-secondary')
    document.getElementById('btn-stop-scanner1').classList.remove('btn-danger')
    document.getElementById('btn-start-scanner1').classList.remove('disabled', 'btn-outline-secondary')
    document.getElementById('btn-start-scanner1').classList.add('btn-primary')
  }).catch(err => {
    console.error("Error al detener el escáner:", err)
  })
}
//#endregion

//#region qr2
let innerDiv2 = document.getElementById('reader2').innerHTML
console.log(innerDiv2)
function startScanner2() {
  html5QrCode2.start(
    { facingMode: "environment" },
    {
      fps: 10,
      qrbox: { width: 180, height: 150 },
    },
    decodedText => {
      console.log("QR detectado:", decodedText)
      document.getElementById('txtJustQR').value = decodedText
      stopScanner2()
    },
    error => {
      //console.warn("QR no detectado", error)
    }
  ).catch(err => {
    console.error("No se pudo iniciar el escáner:", err)
  })
  document.getElementById('btn-start-scanner2').classList.add('disabled', 'btn-outline-secondary')
  document.getElementById('btn-start-scanner2').classList.remove('btn-outline-primary')
  document.getElementById('btn-stop-scanner2').classList.remove('disabled', 'btn-outline-secondary')
  document.getElementById('btn-stop-scanner2').classList.add('btn-danger')
}

function stopScanner2() {
  html5QrCode2.stop().then(() => {
    document.getElementById('reader2').innerHTML = innerDiv2
    document.getElementById('btn-stop-scanner2').classList.add('disabled', 'btn-outline-secondary')
    document.getElementById('btn-stop-scanner2').classList.remove('btn-danger')
    document.getElementById('btn-start-scanner2').classList.remove('disabled', 'btn-outline-secondary')
    document.getElementById('btn-start-scanner2').classList.add('btn-primary')
  }).catch(err => {
    console.error("Error al detener el escáner:", err)
  })
}
//#endregion

//#region qr3
let innerDiv3 = document.getElementById('reader3').innerHTML
function startScanner3() {
  html5QrCode3.start(
    { facingMode: "environment" },
    {
      fps: 10,
      qrbox: { width: 180, height: 150 },
    },
    decodedText => {
      console.log("QR detectado:", decodedText)
      document.getElementById('txtFolderQR').value = decodedText
      stopScanner3()
    },
    error => {
      //console.warn("QR no detectado", error)
    }
  ).catch(err => {
    console.error("No se pudo iniciar el escáner:", err)
  })
  document.getElementById('btn-start-scanner3').classList.add('disabled', 'btn-outline-secondary')
  document.getElementById('btn-start-scanner3').classList.remove('btn-outline-primary')
  document.getElementById('btn-stop-scanner3').classList.remove('disabled', 'btn-outline-secondary')
  document.getElementById('btn-stop-scanner3').classList.add('btn-danger')
}

function stopScanner3() {
  html5QrCode3.stop().then(() => {
    document.getElementById('reader3').innerHTML = innerDiv3
    document.getElementById('btn-stop-scanner3').classList.add('disabled', 'btn-outline-secondary')
    document.getElementById('btn-stop-scanner3').classList.remove('btn-danger')
    document.getElementById('btn-start-scanner3').classList.remove('disabled', 'btn-outline-secondary')
    document.getElementById('btn-start-scanner3').classList.add('btn-primary')
  }).catch(err => {
    console.error("Error al detener el escáner:", err)
  })
}
//#endregion

//#endregion

document.addEventListener('DOMContentLoaded', () => {
  //#region startQR
  html5QrCode = new Html5Qrcode("reader1")
  html5QrCode2 = new Html5Qrcode("reader2")
  html5QrCode3 = new Html5Qrcode("reader3")
  //#endregion

  //#region escritorios
  let width = window.innerWidth

  const bench1 = document.getElementById('bench1')
  const bench2 = document.getElementById('bench2')
  const bench3 = document.getElementById('bench3')
  const bench4 = document.getElementById('bench4')
  const bench4_1 = document.getElementById('bench4_1')
  const bench5 = document.getElementById('bench5')
  const bench6 = document.getElementById('bench6')
  const bench7 = document.getElementById('bench7')

  const list1 = document.getElementById('item1')
  list1.addEventListener('click', function () {
    hide()
    noselect()
    bench1.classList.remove('hide')
    list1.classList.add('select')
  })
  const list2 = document.getElementById('item2')
  list2.addEventListener('click', function () {
    hide()
    noselect()
    bench2.classList.remove('hide')
    list2.classList.add('select')
  })
  const list3 = document.getElementById('item3')
  list3.addEventListener('click', function () {
    hide()
    noselect()
    bench3.classList.remove('hide')
    list3.classList.add('select')
  })

  const list4 = document.getElementById('item4')
  list4.addEventListener('click', function () {
    hide()
    noselect()
    bench4.classList.remove('hide')
    list4.classList.add('select')
  })
  const list4_1 = document.getElementById('item4_1')
  list4_1.addEventListener('click', function () {
    hide()
    bench4_1.classList.remove('hide')
  })
  const list4_2 = document.getElementById('item4_2')
  list4_2.addEventListener('click', function () {
    hide()
    bench4.classList.remove('hide')
  })

  const list5 = document.getElementById('item5')
  list5.addEventListener('click', function () {
    hide()
    noselect()
    bench5.classList.remove('hide')
    list5.classList.add('select')
  })
  const list6 = document.getElementById('item6')
  list6.addEventListener('click', function () {
    hide()
    noselect()
    bench6.classList.remove('hide')
    list6.classList.add('select')
  })
  const list6_1 = document.getElementById('item6_1')
  list6_1.addEventListener('click', function () {
    hide()
    noselect()
    bench6.classList.remove('hide')
    list6.classList.add('select')
  })
  const list7 = document.getElementById('item7')
  list7.addEventListener('click', function () {
    hide()
    noselect()
    bench7.classList.remove('hide')
    list7.classList.add('select')
  })

  function hide() {
    bench1.classList.add('hide')
    bench2.classList.add('hide')
    bench3.classList.add('hide')
    bench4.classList.add('hide')
    bench4_1.classList.add('hide')
    bench5.classList.add('hide')
    bench6.classList.add('hide')
    bench7.classList.add('hide')
  }
  function noselect() {
    list1.classList.remove('select')
    list2.classList.remove('select')
    list3.classList.remove('select')
    list4.classList.remove('select')
    list5.classList.remove('select')
    list6.classList.remove('select')
    list7.classList.remove('select')
  }

  const sinconcheck = document.getElementById('sin-con-check')
  const txtconsin = document.getElementById('txt-con-sin')
  sinconcheck.addEventListener('change', () => {
    if (sinconcheck.checked) {
      txtconsin.value = 'Primeros Auxilios'
    } else {
      txtconsin.value = ''
    }
  })
  //#endregion

  //#region modo oscuro y claro
  document.getElementById('btn-theme').addEventListener('click', function () {
    let theme = document.querySelector('html').getAttribute('data-bs-theme')
    if (theme == "light") {
      document.getElementById('icon2').classList.remove('hide')
      document.getElementById('icon').classList.add('hide')
      document.querySelector('html').setAttribute('data-bs-theme', 'dark')
    } else {
      document.getElementById('icon2').classList.add('hide')
      document.getElementById('icon').classList.remove('hide')
      document.querySelector('html').setAttribute('data-bs-theme', 'light')
    }
  })
  //#endregion

  //#region bs5
  const validation = (() => {
    'use strict'

    const forms = document.querySelectorAll('.needs-validation')

    Array.from(forms).forEach(form => {
      form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
  })()

  //#endregion

  //#region function 
  function removeValidation(form) {
    if (form.classList.contains('was-validated')) {
      form.classList.remove('was-validated')
    }
  }

  function tooltip() {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  }

  const qrDrawer = document.getElementById('qrDrawer')
  function qrGenerate(num) {
    new QRCode(qrDrawer, num)
  }

  window.removeValidation = function (formId) {
    console.log("Ejecutando removeValidation para:", formId)
    formToRemo = document.getElementById(formId)
    removeValidation(formToRemo)
  }
  //#endregion

  //#region toast
  var containerToast = document.getElementById('container-toast')
  function toast(select, content) {
    switch (select) {
      case 'success':
        containerToast.innerHTML = `<div class="toast show fade align-items-center text-bg-success border-0" role="alert" style="position:absolute; bottom: 20px; z-index: 9999;" data-bs-delay="3000">
                                      <div class="d-flex">
                                        <div class="toast-body">
                                          ${content}
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                      </div>
                                    </div>`
        break

      case 'info':
        containerToast.innerHTML = `<div class="toast show fade align-items-center text-bg-primary border-0" role="alert" style="position:absolute; bottom: 20px; z-index: 9999;" data-bs-delay="3000">
                                      <div class="d-flex">
                                        <div class="toast-body">
                                          ${content}
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                      </div>
                                    </div>`
        break

      case 'danger':
        containerToast.innerHTML = `<div class="toast show fade align-items-center text-bg-danger border-0" role="alert" style="position:absolute; bottom: 20px; z-index: 9999;" data-bs-delay="3000">
                                      <div class="d-flex">
                                        <div class="toast-body">
                                          ${content}
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                      </div>
                                    </div>`
        document.getElementById("errorAud").play()
        break
    }
  }
  //#endregion

  //#region forms & tabs
  //#region general
  const TabGenForm = document.getElementById('tab-gen-form')
  TabGenForm.addEventListener('submit', (event) => {
    event.preventDefault()
    const DataTabGenForm = new FormData(TabGenForm)
    fetch('src/db/tab-gen.php', {
      method: 'POST',
      body: DataTabGenForm
    })
      .then(response => response.json())
      .then(data => {
        if (data.log) {
          TabGenForm.reset()
          removeValidation(TabGenForm)
          loadTBGen()
        } else if (data.error) {
          console.log(data.error)
        }
      })
      .catch(error => console.log(error))
  })
  const TableGen = document.getElementById('table-gen')
  function loadTBGen() {
    fetch('src/db/show-gen.php')
      .then(response => response.json())
      .then(data => {
        TableGen.innerHTML = ''
        for (let row of data) {
          TableGen.innerHTML += `
                <tr>
                  <td>${row.numimss}</td>
                  <td>${row.nombre}</td>
                  <td>${row.edad}</td>
                  <td>${row.grupo}</td>
                  <td><button type="button" class="btn bg-success-subtle d-inline-flex rounded-4 p-2 gen-btn" data-bs-toggle="modal" data-bs-target="#modalGen" num="${row.numimss}"><span class="material-symbols-rounded text-success">manage_accounts</span></button></td>
                </tr>`
        }
        genbtn()
      })
      .catch(error => console.log(error))
  }
  loadTBGen()

  const TxtSearchGen = document.getElementById('gen-searh-txt')
  TxtSearchGen.addEventListener('keyup', () => {
    const TxtSearchGenVal = TxtSearchGen.value
    if (TxtSearchGenVal != "") {
      const gensearch = `src/db/show-gen.php?search=${TxtSearchGenVal}`
      fetch(gensearch)
        .then(response => response.json())
        .then(data => {
          TableGen.innerHTML = ''
          for (let row of data) {
            TableGen.innerHTML += `
                <tr>
                  <td>${row.numimss}</td>
                  <td>${row.nombre}</td>
                  <td>${row.edad}</td>
                  <td>${row.grupo}</td>
                  <td><button type="button" class="btn bg-success-subtle d-inline-flex rounded-4 p-2 gen-btn" data-bs-toggle="modal" data-bs-target="#modalGen" num="${row.numimss}">
                    <span class="material-symbols-rounded text-success">manage_accounts</span>
                  </button>
                  </td>
                </tr>`
          }
          genbtn()
        })
        .catch(error => console.log(error))

    } else {
      loadTBGen()
    }
  })

  const mgid = document.getElementById('mg-id')
  const mgidg = document.getElementById('mg-id-g')
  const mgnumimss = document.getElementById('mg-numimss')
  const mgname = document.getElementById('mg-name')
  const mgage = document.getElementById('mg-age')
  const mgsexo = document.getElementById('mg-sexo')
  const mggroup = document.getElementById('mg-group')
  const mgalerg = document.getElementById('mg-alerg')
  const mgphone = document.getElementById('mg-phone')
  function genbtn() {
    const genBtns = document.querySelectorAll('.gen-btn')
    genBtns.forEach((button, index) => {
      button.addEventListener('click', () => {
        const attr = button.getAttribute('num')
        fetch(`src/db/show-gen.php?search=${attr}`)
          .then(response => response.json())
          .then(data => {
            qrDrawer.innerHTML = ''
            console.log(data)
            const userData = data[0]
            mgid.value = userData.numimss
            mgidg.value = userData.grupoid
            mgnumimss.value = userData.numimss
            mgname.value = userData.nombre
            mgage.value = userData.edad
            mgsexo.value = userData.sexo
            mggroup.value = userData.grupoid
            mgalerg.value = userData.alergia
            mgphone.value = userData.telefono

            qrGenerate(userData.numimss)
          })
      })
    })
  }

  const btnResQr = document.querySelectorAll('.mg-btn-close')
  btnResQr.forEach((btn, index) => {
    btn.addEventListener('click', () => {
      qrDrawer.innerHTML = ''
    })
  })

  const modal = new bootstrap.Modal(document.getElementById('modalGen'))
  const mgform = document.getElementById('mg-form')
  const mgbtnedit = document.getElementById('mg-btn-edit')
  mgbtnedit.addEventListener('click', (event) => {
    event.preventDefault()
    formdataMG = new FormData(mgform)
    if (window.confirm("¿Esta seguro de guardar los cambios?")) {
      fetch('src/db/tab-gen.php', {
        method: 'POST',
        body: formdataMG
      })
        .then(response => response.json())
        .then(data => {
          if (data.log) {
            console.log(data)
            modal.hide()
            loadTBGen()
            removeValidation(mgform)
            updatesenddoce()
          } else {
            console.log(data)
            mgform.classList.add('was-validated')
          }
        })
    } else {
      console.log('pos no')
    }
  })

  const mgbtndel = document.getElementById('mg-btn-del')
  mgbtndel.addEventListener('click', (event) => {
    event.preventDefault()
    if (window.confirm('¿Esta seguro de eliminar este registro?')) {
      fetch(`src/db/show-gen.php?del=${mgid.value}&cat=${mggroup.value}`)
        .then(response => response.text())
        .then(data => {
          console.log('hecho')
          modal.hide()
          loadTBGen()
        })
    } else {
      console.log('no se elimino')
    }
  }
  )
  //#endregion

  //#region users
  const TabUserForm = document.getElementById('tab-user-form')
  TabUserForm.addEventListener('submit', (event) => {
    event.preventDefault()
    const DataTabUserForm = new FormData(TabUserForm)
    fetch('src/db/users.php', {
      method: 'POST',
      body: DataTabUserForm
    })
      .then(response => response.json())
      .then(data => {
        console.log(data)
        if (data.log) {
          TabUserForm.reset()
          removeValidation(TabUserForm)
          loadTBUser()
          console.log(data.log)
        } else if (data.error) {
          console.log(data.error)
        }
      })
    //.catch(error => console.log(error))
  })
  const TableUsers = document.getElementById('table-users')
  function loadTBUser() {
    fetch('src/db/users.php?getdata')
      .then(response => response.json())
      .then(data => {
        TableUsers.innerHTML = ''
        for (let row of data) {
          TableUsers.innerHTML += `
                <tr>
                  <td>${row.numimss}</td>
                  <td>${row.username}</td>
                  <td>${row.nombres}</td>
                  <td>${row.correo}</td>
                  <td><button type="button" class="btn bg-warning-subtle d-inline-flex rounded-4 p-2 user-btn" data-bs-toggle="modal" data-bs-target="#modalUser" num="${row.numimss}"><span class="material-symbols-rounded text-warning">admin_panel_settings</span></button></td>
                </tr>`
        }
        genUser()
      })
      .catch(error => console.log(error))
  }
  loadTBUser()

  const TxtSearchUser = document.getElementById('user-search-txt')
  TxtSearchUser.addEventListener('keyup', () => {
    const TxtSearchUserVal = TxtSearchUser.value
    if (TxtSearchUserVal != "") {
      const usersearch = `src/db/users.php?search=${TxtSearchUserVal}`
      fetch(usersearch)
        .then(response => response.json())
        .then(data => {
          TableUsers.innerHTML = ''
          for (let row of data) {
            TableUsers.innerHTML += `
                <tr>
                  <td>${row.numimss}</td>
                  <td>${row.username}</td>
                  <td>${row.nombres}</td>
                  <td>${row.correo}</td>
                  <td><button type="button" class="btn bg-warning-subtle d-inline-flex rounded-4 p-2 user-btn" data-bs-toggle="modal" data-bs-target="#modalUser" num="${row.numimss}">
                    <span class="material-symbols-rounded text-warning">admin_panel_settings</span>
                  </button>
                  </td>
                </tr>`
          }
          genUser()
        })
        .catch(error => console.log(error))

    } else {
      loadTBUser()
    }
  })

  const musid = document.getElementById('mus-id')
  const musiimss = document.getElementById('mus-imss')
  const mususername = document.getElementById('mus-username')
  const musnames = document.getElementById('mus-names')
  const musemail = document.getElementById('mus-email')
  const muspassword = document.getElementById('mus-password')
  function genUser() {
    const genBtns = document.querySelectorAll('.user-btn')
    genBtns.forEach((button, index) => {
      button.addEventListener('click', () => {
        const attr = button.getAttribute('num')
        fetch(`src/db/users.php?search=${attr}`)
          .then(response => response.json())
          .then(data => {
            console.log(data)
            const userData = data[0]
            musid.value = userData.numimss
            musiimss.value = userData.numimss
            mususername.value = userData.username
            musnames.value = userData.nombres
            musemail.value = userData.correo
            muspassword.value = userData.password
          })
      })
    })
  }

  const modalUser = new bootstrap.Modal(document.getElementById('modalUser'))
  const musform = document.getElementById('mus-form')
  const musbtnedit = document.getElementById('mus-btn-edit')
  musbtnedit.addEventListener('click', () => {
    console.log(musid.value)
    formdatamus = new FormData(musform)
    if (window.confirm("¿Esta seguro de guardar los cambios?")) {
      fetch('src/db/users.php', {
        method: 'POST',
        body: formdatamus
      })
        .then(response => response.json())
        .then(data => {
          if (data.log) {
            console.log(data)
            loadTBUser()
            modalUser.hide()
            removeValidation(musform)
          } else {
            console.log(data)
            musform.classList.add('was-validated')
          }
        })
    } else {
      console.log('pos no')
    }
  })

  const musbtndel = document.getElementById('mus-btn-del')
  musbtndel.addEventListener('click', () => {
    if (window.confirm('¿Esta seguro de eliminar este registro?')) {
      fetch(`src/db/users.php?del=${musid.value}`)
        .then(response => response.text())
        .then(data => {
          console.log('hecho')
          modalUser.hide()
          loadTBUser()
        })
    } else {
      console.log('no se elimino')
    }
  }
  )
  //#endregion

  //#region medic
  const MedicForm = document.getElementById('medic-form')
  MedicForm.addEventListener('submit', (event) => {
    event.preventDefault()
    const DataMedicForm = new FormData(MedicForm)
    fetch('src/db/medic.php', {
      method: 'POST',
      body: DataMedicForm
    })
      .then(response => response.json())
      .then(data => {
        console.log(data)
        if (data.log) {
          MedicForm.reset()
          removeValidation(MedicForm)
          loadTBMedic()
          consmedic()
          console.log(data.log)
        } else if (data.error) {
          console.log(data.error)
        }
      })
      .catch(error => console.log(error))
  })
  const TableMedic = document.getElementById('table-medic')
  function loadTBMedic() {
    fetch('src/db/medic.php?getdata')
      .then(response => response.json())
      .then(data => {
        console.log(data)
        TableMedic.innerHTML = ''
        for (let row of data) {
          let medtype;
          let medcad
          if (row.tipo === 'Pastilla') {
            medtype = `<span class="bg-primary bg-opacity-25 rounded-pill p-1 px-2 d-inline-flex" style="font-size: 0.7rem;">
                            <small class="material-symbols-rounded text-primary me-1" style="font-size: 1rem;">pill</small>
                            <span class="fw-bold text-primary">Pastillas</span>
                        </span>`
          } else if (row.tipo === 'Botiquín') {
            medtype = `<span class="bg-danger bg-opacity-25 rounded-pill p-1 px-2 d-inline-flex" style="font-size: 0.7rem;">
                          <small class="material-symbols-rounded text-danger me-1" style="font-size: 1rem;">healing</small>
                          <span class="fw-bold text-danger">Botiquín</span>
                      </span>`
          } else {
            medtype = `<span class="bg-dark bg-opacity-25 rounded-pill p-1 px-2 d-inline-flex" style="font-size: 0.7rem;">
                          <small class="material-symbols-rounded text-dark me-1" style="font-size: 1rem;">help</small>
                          <span class="fw-bold text-dark">Otro</span>
                      </span>`
          }
          if (row.estado === 'Caducado') {
            medcad = `<small class="bg-danger rounded-pill text-white fw-bold p-1 px-2" style="font-size: 0.7rem;">Vencido</small>`
          } else {
            medcad = `<small class="bg-success rounded-pill text-white fw-bold p-1 px-2" style="font-size: 0.7rem;">Vigente</small>`
          }

          TableMedic.innerHTML += `
                <tr>
                  <td>${row.id}</td>
                  <td>${medtype}</td>
                  <td>${row.nombre}</td>
                  <td>${row.cantidad}</td>
                  <td>${row.fechaCad}</td>
                  <td>${medcad}</td>
                  <td class="d-flex align-items-center justify-content-center"><button type="button" class="btn bg-primary-subtle d-inline-flex rounded-4 p-2 medic-btn" data-bs-toggle="modal" data-bs-target="#modalMedic" num="${row.id}">
                      <span class="material-symbols-rounded text-primary">
                          admin_meds
                      </span>
                  </button></td>
                </tr>`
        }
        tooltip()
        genMedic()
      })
    //.catch(error => console.log(error))
  }
  loadTBMedic()

  const TxtSearchMedic = document.getElementById('medic-search-txt')
  TxtSearchMedic.addEventListener('keyup', () => {
    const TxtSearchMedicVal = TxtSearchMedic.value
    if (TxtSearchMedicVal != "") {
      const usersearch = `src/db/medic.php?search=${TxtSearchMedicVal}`
      fetch(usersearch)
        .then(response => response.json())
        .then(data => {
          TableMedic.innerHTML = ''
          for (let row of data) {
            let medtype;
            let medcad
            if (row.tipo === 'Pastilla') {
              medtype = `<span class="bg-primary bg-opacity-25 rounded-pill p-1 px-2 d-inline-flex" style="font-size: 0.7rem;">
                              <small class="material-symbols-rounded text-primary me-1" style="font-size: 1rem;">pill</small>
                              <span class="fw-bold text-primary">Pastillas</span>
                          </span>`
            } else if (row.tipo === 'Botiquín') {
              medtype = `<span class="bg-danger bg-opacity-25 rounded-pill p-1 px-2 d-inline-flex" style="font-size: 0.7rem;">
                            <small class="material-symbols-rounded text-danger me-1" style="font-size: 1rem;">healing</small>
                            <span class="fw-bold text-danger">Botiquín</span>
                        </span>`
            } else {
              medtype = `<span class="bg-dark bg-opacity-25 rounded-pill p-1 px-2 d-inline-flex" style="font-size: 0.7rem;">
                            <small class="material-symbols-rounded text-dark me-1" style="font-size: 1rem;">help</small>
                            <span class="fw-bold text-dark">Otro</span>
                        </span>`
            }
            if (row.estado === 'Caducado') {
              medcad = `<small class="bg-danger rounded-pill text-white fw-bold p-1 px-2" style="font-size: 0.7rem;">Vencido</small>`
            } else {
              medcad = `<small class="bg-success rounded-pill text-white fw-bold p-1 px-2" style="font-size: 0.7rem;">Vigente</small>`
            }

            TableMedic.innerHTML += `
                  <tr>
                    <td>${row.id}</td>
                    <td>${medtype}</td>
                    <td>${row.nombre}</td>
                    <td>${row.cantidad}</td>
                    <td>${row.fechaCad}</td>
                    <td>${medcad}</td>
                    <td class="d-flex align-items-center justify-content-center"><button type="button" class="btn bg-primary-subtle d-inline-flex rounded-4 p-2 medic-btn" data-bs-toggle="modal" data-bs-target="#modalMedic" num="${row.id}">
                        <span class="material-symbols-rounded text-primary">
                            admin_meds
                        </span>
                    </button></td>
                  </tr>`
          }
          genMedic()
        })
        .catch(error => console.log(error))

    } else {
      loadTBMedic()
    }
  })

  const medid = document.getElementById('med-id')
  const medname = document.getElementById('med-name')
  const medcad = document.getElementById('med-cad')
  const medtype = document.getElementById('med-type')
  const medcant = document.getElementById('med-cant')
  function genMedic() {
    const medicBtns = document.querySelectorAll('.medic-btn')
    medicBtns.forEach((button, index) => {
      button.addEventListener('click', () => {
        const attr = button.getAttribute('num')
        fetch(`src/db/medic.php?search=${attr}`)
          .then(response => response.json())
          .then(data => {
            console.log(data)
            const userData = data[0]
            medid.value = userData.id
            medname.value = userData.nombre
            medcad.value = userData.fechaCad
            medtype.value = userData.tipo
            medcant.value = userData.cantidad
          })
      })
    })
  }

  const modalMedic = new bootstrap.Modal(document.getElementById('modalMedic'))
  const mmedform = document.getElementById('modal-medic-form')
  const mmedbtnedit = document.getElementById('medic-btn-edit')
  mmedbtnedit.addEventListener('click', () => {
    console.log(medid.value)
    formdatamed = new FormData(mmedform)
    if (window.confirm("¿Esta seguro de guardar los cambios?")) {
      fetch('src/db/medic.php', {
        method: 'POST',
        body: formdatamed
      })
        .then(response => response.json())
        .then(data => {
          if (data.log) {
            console.log(data)
            loadTBMedic()
            modalMedic.hide()
            consmedic()
            removeValidation(mmedform)
          } else {
            console.log(data)
            mmedform.classList.add('was-validated')
          }
        })
    } else {
      console.log('pos no')
    }
  })

  const medicbtndel = document.getElementById('medic-btn-del')
  medicbtndel.addEventListener('click', () => {
    if (window.confirm('¿Esta seguro de eliminar este registro?')) {
      fetch(`src/db/medic.php?del=${medid.value}`)
        .then(response => response.json())
        .then(data => {
          console.log('hecho')
          modalMedic.hide()
          loadTBMedic()
          consmedic()
        })
    } else {
      console.log('no se elimino')
    }
  }
  )
  //#endregion

  //#region consulta
  function consmedic() {
    const consmed = document.getElementById('cons-med')
    fetch('src/db/consulta.php?med')
      .then(response => response.json())
      .then(data => {
        console.log(data)
        consmed.innerHTML = ''

        if (Array.isArray(data)) {
          for (let rows of data) {
            consmed.innerHTML += `<option value="${rows.id}">${rows.nombre} - ${rows.fechaCad}</option>`
          }
        } else {
          consmed.innerHTML = `<option value="${data.id}">${data.nombre} - ${data.fechaCad}</option>`
        }
      })
  }
  consmedic()

  const consid = document.getElementById('cons-id')
  const consname = document.getElementById('cons-name')
  const consage = document.getElementById('cons-age')
  const conssexo = document.getElementById('cons-sexo')
  const consgp = document.getElementById('cons-gp')
  const consalerg = document.getElementById('cons-alerg')
  const FormConImssId = document.getElementById('form-con-imss-id')
  FormConImssId.addEventListener('submit', (event) => {
    event.preventDefault()
    const DataFormConImssId = new FormData(FormConImssId)
    fetch('src/db/consulta.php', {
      method: 'POST',
      body: DataFormConImssId
    })
      .then(response => response.json())
      .then(data => {
        console.log(data)
        if (data.error) {
          console.log(data.error)
        } else {
          FormConImssId.reset()
          removeValidation(FormConImssId)
          const info = data[0]
          consid.value = info.imss
          consname.value = info.name
          consage.value = info.age
          conssexo.value = info.sexo
          consgp.value = info.grupoN
          consalerg.value = info.alerg
        }
      })
      .catch(error => toast('danger', 'No se encontró el dato.'))
  })

  const ConsForm = document.getElementById('cons-form')
  ConsForm.addEventListener('submit', (event) => {
    event.preventDefault()
    const DataConsForm = new FormData(ConsForm)
    fetch('src/db/consulta.php', {
      method: 'POST',
      body: DataConsForm
    })
      .then(response => response.json())
      .then(data => {
        if (data.log) {
          removeValidation(ConsForm)
          ConsForm.reset()
          loadTBMedic()
          consmedic()
          loadTBHist()
          //loadTabStats()
        } else {
          console.log(data)
        }
      })
  })
  //#endregion

  //#region historial
  const TableHist = document.getElementById('table-hist')
  function loadTBHist() {
    fetch('src/db/histcon.php?getdata')
      .then(response => response.json())
      .then(data => {
        console.log(data)
        TableHist.innerHTML = ''
        for (let row of data) {
          TableHist.innerHTML += `
                <tr>
                  <td>${row.id}</td>
                  <td>${row.nombre}</td>
                  <td>${row.grupo}</td>
                  <td>${row.sintomas}</td>
                  <td>${row.fecha}</td>
                  <td><button type="button" class="btn bg-primary-subtle d-inline-flex rounded-4 p-2 hist-btn" data-bs-toggle="modal" data-bs-target="#histModal" num="${row.id}">
                  <span class="material-symbols-rounded text-primary">
                      more_vert
                  </span>
                  </button></td>
                </tr>`
        }
        histBtns()
      })
      .catch(error => toast('danger', 'Estamos teniendo problemas para obtener los datos. Inténtalo de nuevo.'))
  }
  loadTBHist()

  const TxtSearchHist = document.getElementById('hist-search-txt')
  TxtSearchHist.addEventListener('keyup', () => {
    const TxtSearchHistVal = TxtSearchHist.value
    if (TxtSearchHistVal != "") {
      const usersearch = `src/db/histcon.php?search=${TxtSearchHistVal}`
      fetch(usersearch)
        .then(response => response.json())
        .then(data => {
          TableHist.innerHTML = ''
          for (let row of data) {
            TableHist.innerHTML += `
                <tr>
                  <td>${row.id}</td>
                  <td>${row.nombre}</td>
                  <td>${row.grupo}</td>
                  <td>${row.sintomas}</td>
                  <td>${row.fecha}</td>
                  <td><button type="button" class="btn bg-primary-subtle d-inline-flex rounded-4 p-2 hist-btn" data-bs-toggle="modal" data-bs-target="#histModal" num="${row.id}">
                  <span class="material-symbols-rounded text-primary">
                      more_vert
                  </span>
                  </button></td>
                </tr>`
          }
          histBtns()
        })
        .catch(error => console.log(error))

    } else {
      loadTBHist()
    }
  })

  const ModConsId = document.getElementById('modal-cons-id')
  const ModConsNum = document.getElementById('modal-cons-num')
  const ModConsMed = document.getElementById('modal-cons-med')
  const ModTxtConSin = document.getElementById('modal-txt-con-sin')
  const ModConsCant = document.getElementById('modal-cons-cant')
  const ModConsDatetime = document.getElementById('modal-cons-datetime')
  const alertDiv = document.getElementById('alert-div')
  console.log(alertDiv)

  function medicmodalhist() {
    fetch('src/db/histcon.php?allmedic')
      .then(response => response.json())
      .then(data => {
        console.log(data)
        ModConsMed.innerHTML = ''
        for (let dataset of data) {
          ModConsMed.innerHTML += `<option value="${dataset.id}">${dataset.nombre} - ${dataset.fechaCad}</option>`
        }
      })
  }
  medicmodalhist()

  function histBtns() {
    const medicBtns = document.querySelectorAll('.hist-btn')
    medicBtns.forEach((button, index) => {
      button.addEventListener('click', () => {
        const attr = button.getAttribute('num')
        fetch(`src/db/histcon.php?cons=${attr}`)
          .then(response => response.json())
          .then(data => {
            console.log(data)
            const userData = data[0]
            ModConsId.value = userData.id
            ModConsNum.value = userData.alumno
            ModTxtConSin.value = userData.sintomas
            ModConsMed.value = userData.medic
            ModConsCant.value = userData.cantidad
            ModConsDatetime.value = userData.fechaHora

            console.log('Valor de casa:', userData.casa, typeof userData.casa)

            if (userData.casa == '1') {
              alertDiv.innerHTML = `<div class="alert alert-info" role="alert">
            <img src="src/img/report.svg" class="me-2" width="40px" height="40px">
            El alumno fué enviado a reposar a casa.
          </div>`
            } else {
              alertDiv.innerHTML = ''
            }
          })
      })
    })
  }

  const modalHist = new bootstrap.Modal(document.getElementById('histModal'))
  MHistForm = document.getElementById('modal-cons-form')
  MHistEdit = document.getElementById('mhis-btn-edit')
  MHistEdit.addEventListener('click', () => {
    console.log(medid.value)
    formdatamodalhist = new FormData(MHistForm)
    if (window.confirm("¿Esta seguro de guardar los cambios?")) {
      fetch('src/db/histcon.php', {
        method: 'POST',
        body: formdatamodalhist
      })
        .then(response => response.json())
        .then(data => {
          if (data.log) {
            console.log(data)
            modalHist.hide()
            loadTBHist()
            loadTBMedic()
            removeValidation(MHistForm)
          } else {
            console.log(data)
            MHistForm.classList.add('was-validated')
          }
        })
    } else {
      console.log('pos no')
    }
  })

  const MHistDel = document.getElementById('mhis-btn-del')
  MHistDel.addEventListener('click', () => {
    if (window.confirm('¿Esta seguro de eliminar este registro?')) {
      fetch(`src/db/histcon.php`)
        .then(response => response.json())
        .then(data => {
          console.log('hecho')
          modalHist.hide()
          loadTBHist()
          loadTBMedic()
          //loadTabStats()
        })
    } else {
      console.log('no se elimino')
    }
  }
  )
  //#endregion

  //#region justificante
  const TableSendDocentes = document.getElementById('TableSendDocentes')
  const JustTxtScan = document.getElementById('form-just-scan')
  const FormJust = document.getElementById('form-data-just')
  const FormJustnombre = document.getElementById('FormJustnombre')
  const FormJustgp = document.getElementById('FormJustgp')
  const FormJustIMSS = document.getElementById('FormJustIMSS')
  console.log(FormJustIMSS)

  function updatesenddoce() {
    console.log('tabla justificanete')
    fetch('src/db/justifi.php?docente')
      .then(response => response.json())
      .then(data => {
        TableSendDocentes.innerHTML = ''
        for (let row of data) {
          TableSendDocentes.innerHTML += `
              <tr>
                <td><input class="form-check-input" type="checkbox" name="num[]" value="${row.numtelef}"></td>
                <td>${row.nombre}</td>
                <td>${row.numtelef}</td>
              </tr>`
        }
      })
  }
  updatesenddoce()

  var JustIMSS
  JustTxtScan.addEventListener('submit', (e) => {
    let justformdata = new FormData(JustTxtScan)
    e.preventDefault()
    fetch('src/db/justifi.php', {
      method: 'POST',
      body: justformdata
    })
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          console.log(data)
        } else {
          console.log(data)
          JustTxtScan.classList.remove('was-validated')
          JustTxtScan.reset()
          if (data.numimss == null) {
            toast('danger', 'No se encontró el dato.')
          } else {
            FormJustIMSS.value = data.numimss
            JustIMSS = data.numimss
            FormJustnombre.value = data.name
            FormJustgp.value = data.grupo
          }
        }
      })
  })

  var urldatajust
  var formurldatajust
  var ModalBodyJustPrev = document.getElementById('ModalBodyJustPrev')
  console.log(ModalBodyJustPrev)
  const modalJust = new bootstrap.Modal(document.getElementById('JustModalPrev'))
  const iframe = document.getElementById('frame-JustPrev')
  FormJust.addEventListener('submit', (e) => {
    e.preventDefault()
    formurldatajust = new FormData(FormJust)
    fetch('src/db/justifi.php', {
      method: 'POST',
      body: formurldatajust
    })
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          console.log(data)
        } else if (data.message) {
          FormJust.classList.remove('was-validated')
          modalJust.show()
          ModalBodyJustPrev.innerHTML = ""
          ModalBodyJustPrev.innerHTML = `<iframe class="" src="src/assets/just.php?${data.message}" style="width: 1090px;height: 590px" frameborder="0" id="frame-JustPrev"></iframe>`
          urldatajust = data.message
        }
      })
  })

  const btnMJustSave = document.getElementById('btnM-JustSave')
  btnMJustSave.addEventListener('click', (e) => {
    console.log("estas salvando")
    btnMJustSave.innerHTML = ''
    btnMJustSave.innerHTML = `<div class="spinner-border spinner-border-sm me-1" role="status">
      <span class="visually-hidden" > Loading...</span >
      </div> Guardando...`

    const iframe = document.getElementById('frame-JustPrev')
    console.log(iframe)
    const iframeContent = iframe.contentDocument?.body
    console.log(iframeContent)
    const opt = {
      margin: 1,
      filename: 'documento.pdf',
      image: {
        type: 'jpeg',
        quality: 1.2
      },
      html2canvas: {
        scale: 6
      },
      jsPDF: {
        unit: 'in',
        format: 'a3',
        orientation: 'landscape'
      }
    }
    console.log('aqui se establecieron medidas')
    console.log(urldatajust)


    var pdform = new FormData()
    html2pdf().from(iframeContent).set(opt).output('blob').then((blob) => {
      // Crear un archivo a partir del Blob
      const filepdf = new File([blob], 'documento.pdf', { type: 'application/pdf' });
      console.log('blob generado')

      pdform.append('pdf', filepdf, 'documento.pdf')
      console.log('se agrego al formulario')

      fetch('src/upload/recive.php', {
        method: 'POST',
        body: pdform
      }).then(response => response.json())
        .then(data => {
          console.log(data)
          modalJust.hide()
          btnMJustSave.innerHTML = `<span class="material-symbols-rounded">
          save
          </span > Guardar Cambios`
        })
    })
  }
  )

  //#region tabla de mandado 
  const tableDocSend = document.getElementById('tableDocSend')
  tableDocSend.addEventListener('submit', (e) => {
    var contenido = `<div class="spinner-border spinner-border-sm" role="status">
                      <span class="visually-hidden">Loading...</span>
                    </div> Enviando...`
    toast('info', contenido)
    e.preventDefault()
    const tableDocSendForm = new FormData(tableDocSend)
    tableDocSendForm.append('numimss', JustIMSS)
    tableDocSendForm.append('url', urldatajust)
    fetch('src/upload/sender.php', {
      method: 'POST',
      body: tableDocSendForm
    })
      .then(response => response.json())
      .then(data => {
        console.log(data)
        if (data.error) {
          toast('danger', 'No se mandó el documento. <a class="link-warning" href="src/upload/documento.pdf" download>Descárgalo.</a>')
        } else if (data.log) {
          toast('success', 'Se mandó correctamente.')
          histJust()
          FormJust.reset()
          tableDocSend.reset()
        }
      })
  })
  //#endregion

  //#region historial justificantes
  var tableHistJust = document.getElementById('tableHistJust')
  function histJust() {
    fetch('src/db/justifi.php?getdata')
      .then(response => response.json())
      .then(data => {
        tableHistJust.innerHTML = ''
        for (let row of data) {
          tableHistJust.innerHTML += `
              <tr>
                <td>${row.id}</td>
                <td>${row.alumno}</td>
                <td>${row.fecha}</td>
                <td><button id type="button" class="btn bg-dark-subtle d-inline-flex rounded-4 p-2 just-hist-btn" data-bs-toggle="modal" data-bs-target="#JustHistModal" num="${row.id}"><span class="material-symbols-rounded text-dark">description</span></button></td>
              </tr>`
        }
        justhistbtn()
      })
  }
  histJust()


  ModalBodyJustHistPrev = document.getElementById('ModalBodyJustHistPrev')
  function justhistbtn() {
    const genBtns = document.querySelectorAll('.just-hist-btn')
    genBtns.forEach((button, index) => {
      button.addEventListener('click', () => {
        const attr = button.getAttribute('num')
        fetch(`src/db/justifi.php?num=${attr}`)
          .then(response => response.json())
          .then(data => {
            console.log(data)
            ModalBodyJustHistPrev.innerHTML = ''
            ModalBodyJustHistPrev.innerHTML = `<iframe class="" src="src/assets/justH.php?${data.link}" style="width: 1090px;height: 590px" frameborder="0" id="frame-JustHistPrev"></iframe>`
          })
      })
    })
  }

  const btnMJustPrint = document.getElementById('btnM-JustPrint').addEventListener('click', (e) => {
    const iframeHistJust = document.getElementById('frame-JustHistPrev')
    const iframeHistJustContent = iframeHistJust.contentWindow || iframeHistJust.contentDocument
    console.log(iframeHistJust)
    iframeHistJustContent.focus()
    iframeHistJustContent.print()
  })

  const JustHistSearchTxt = document.getElementById('just-hist-search-txt')
  JustHistSearchTxt.addEventListener('keyup', () => {
    const JustHistSearchTxtVal = JustHistSearchTxt.value
    if (JustHistSearchTxtVal != "") {
      const usersearch = `src/db/justifi.php?search=${JustHistSearchTxtVal}`
      fetch(usersearch)
        .then(response => response.json())
        .then(data => {
          tableHistJust.innerHTML = ''
          for (let row of data) {
            tableHistJust.innerHTML += `
              <tr>
                <td>${row.id}</td>
                <td>${row.nombre}</td>
                <td>${row.fecha}</td>
                <td><button id type="button" class="btn bg-dark-subtle d-inline-flex rounded-4 p-2 just-hist-btn" data-bs-toggle="modal" data-bs-target="#JustHistModal" num="${row.id}"><span class="material-symbols-rounded text-dark">description</span></button></td>
              </tr>`
          }
          justhistbtn()
        })
      //.catch(error => console.log(error))
    } else {
      histJust()
    }
  })
  //#endregion
  //#endregion

  //#region folder
  const FormFolderQR = document.getElementById('FormFolderQR')
  const folderCons = document.getElementById('folderCons')
  const folderJust = document.getElementById('folderJust')
  const divAlert = document.getElementById('alerta')
  var btnAlert = ''

  function btnTooltip() {
    new bootstrap.Tooltip(btnAlert)
  }

  function alertBtnC() {
    btnAlert.addEventListener('click', () => {
      const tooltip = bootstrap.Tooltip.getInstance(btnAlert)
      divAlert.classList.add('d-none')
      divAlert.classList.remove('d-block')
      tooltip.hide()
      folderCons.innerHTML = ''
      folderJust.innerHTML = ''
    })
  }

  function FFolderJust(data) {
    folderJust.innerHTML = ''
    for (let row of data) {
      folderJust.innerHTML += `
              <tr>
                <td>${row.id}</td>
                <td>${row.alumno}</td>
                <td>${row.fecha}</td>
                <td><button id type="button" class="btn bg-dark-subtle d-inline-flex rounded-4 p-2 just-hist-btn" data-bs-toggle="modal" data-bs-target="#JustHistModal" num="${row.id}"><span class="material-symbols-rounded text-dark">description</span></button></td>
              </tr>`
    }
    justhistbtn()
  }

  function FFolderHistcon(data) {
    folderCons.innerHTML = ''
    for (let row of data) {
      folderCons.innerHTML += `
                <tr>
                  <td>${row.id}</td>
                  <td>${row.nombre}</td>
                  <td>${row.grupo}</td>
                  <td>${row.sintomas}</td>
                  <td>${row.fecha}</td>
                  <td><button type="button" class="btn bg-primary-subtle d-inline-flex rounded-4 p-2 hist-btn" data-bs-toggle="modal" data-bs-target="#histModal" num="${row.id}"><span class="material-symbols-rounded text-primary">more_vert</span></button></td>
                </tr>`
    }
    histBtns()
  }
  function FAlert(alumno) {
    divAlert.innerHTML = ''
    divAlert.innerHTML = `<div class="alert alert-dismissible fade show align-items-center mb-0" role="alert">
            <button type="button" class="btn-close" id="closeFolder" data-bs-dismiss="alert" aria-label="Close" data-bs-toggle="tooltip" data-bs-placement="left"
              data-bs-custom-class="custom-tooltip"
              data-bs-title="Cerrar expediente"></button>
            <div class="d-flex justify-content-start align-items-center">
              <div class="me-2">
                <span class="material-symbols-rounded fs-4 p-2 rounded-4 text-white" style="background: var(--enf-two-col);">
                  person
                </span>
              </div>
              <div>
                <p class="fw-bold fs-5 text-align-center m-0">Alumno:</p>
              </div>
            </div>
            <div class="mt-2">
              <span class="fw-bold">${alumno[0].nombre}</span>
              <p class="text-muted m-0">${alumno[0].grupo}</p>
            </div>
          </div>`
    btnAlert = document.getElementById('closeFolder')
    btnTooltip()
    alertBtnC()
  }


  FormFolderQR.addEventListener('submit', (e) => {
    e.preventDefault()
    fetch('src/db/folder.php', {
      method: 'POST',
      body: new FormData(FormFolderQR)
    })
      .then(response => response.json())
      .then(data => {
        if (data.error) {
          toast('danger', data.error)
          removeValidation(FormFolderQR)
          FormFolderQR.reset()
        } else {
          divAlert.classList.remove('d-none')
          divAlert.classList.add('d-block')
          console.log(data)
          FormFolderQR.reset()
          removeValidation(FormFolderQR)
          FFolderJust(data.justificantes)
          FFolderHistcon(data.histcon)
          console.log(data.alumno)
          FAlert(data.alumno)
        }
      })
  })
  //#endregion

  //#region stats
  let state = false
  let info

  tabCons = document.getElementById('cons-stat-tab')
  tabInstance = new bootstrap.Tab(tabCons)
  list5.addEventListener('click', () => {
    if (state) {
      if (tabCons.classList.contains('active')) {
        console.log('si tiene active')
      } else {
        tabInstance.show()
      }
    }
  })

  let cardconsultas = document.getElementById('card-consultas')
  let cardmedic = document.getElementById('card-medic')
  let cardalumnos = document.getElementById('card-alumnos')
  let cardpersonal = document.getElementById('card-personal')
  let statstablemedic = document.getElementById('stats-table-medic')
  let statstablegender = document.getElementById('stats-table-gender')
  let statstablegroups = document.getElementById('stats-table-group')
  function dataTables() {
    cardconsultas.innerHTML = info.dashboard.consultas
    cardmedic.innerHTML = info.dashboard.medicamentos
    cardalumnos.innerHTML = info.dashboard.alumnos
    cardpersonal.innerHTML = info.dashboard.personal

    let row = info.tables.medic[0]
    console.log(`json : ${row.labels.length}`)
    for (let i = 0; i < row.labels.length; i++) {
      statstablemedic.innerHTML += `<tr>
                        <th scope="row">${i + 1}</th>
                        <td>${row.labels[i]}</td>
                        <td>${row.porcentajes[i]}</td>
                        <td>
                          <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: ${row.porcentajes[i]}%">${row.porcentajes[i]}%</div>
                          </div>
                        </td>
                      </tr>`
    }

    row = info.tables.gender[0]
    for (let i = 0; i < row.labels.length; i++) {
      statstablegender.innerHTML += `<tr>
                        <th scope="row">${i + 1}</th>
                        <td>${row.labels[i]}</td>
                        <td>${row.porcentajes[i]}</td>
                        <td>
                          <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: ${row.porcentajes[i]}%">${row.porcentajes[i]}%</div>
                          </div>
                        </td>
                      </tr>`
    }

    row = info.tables.groups[0]
    console.log(`json : ${row}`)
    for (let i = 0; i < row.labels.length; i++) {
      statstablegroups.innerHTML += `<tr>
                        <th scope="row">${i + 1}</th>
                        <td>${row.labels[i]}</td>
                        <td>${row.visitas[i]}</td>
                        <td>
                          <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: ${row.porcentajes[i]}%">${row.porcentajes[i]}%</div>
                          </div>
                        </td>
                      </tr>`
    }
  }

  let screen = document.getElementById('loading-screen')
  let loadedScreen = document.getElementById('loaded-screen')
  function loadStats() {
    console.log(info)
    screen.classList.add('d-none')
    loadedScreen.classList.remove('d-none')
    state = true
    graphStats('cons-stat-canva', 'line', 'cons')
    dataTables()
  }

  function btnCargaStats(url) {
    screen.innerHTML = `<div class="spinner-border text-primary" role="status" style="width: 150px;height: 150px;font-size: 50px;">
                              <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="fs-1 fw-bold">Cargando datos</p>
                            <p class="fs-6 text-muted">Estamos cargando los datos, por favor, tenga paciencia.</p>`
    console.log('empezo a cargar')
    fetch(url)
      .then(response => response.json())
      .then(data => {
        info = data
        console.log('terminó')
        console.log(info)
        loadStats()
      })
      .catch(error => {
        screen.innerHTML = `<span class="material-symbols-rounded text-body-tertiary" style="font-size: 150px;">
                              sync_problem
                            </span>
      <p class="fs-1 fw-bold">No se pueden obtener datos</p>
      <p class="fs-6 text-muted">Algo salió mal obteniendo los datos, Reinteta más tarde.</p>
      <button class="btn btn-primary rounded-pill d-flex justify-content-center align-items-center fs-6" id="button-load">
      <span class="material-symbols-rounded me-1 fs-4">
        replay
      </span>
      Reintentar
    </button>`
        document.getElementById('button-load').addEventListener('click', btnCargaStats)
      })
  }
  const buttonload = document.getElementById('button-load').addEventListener('click', (e) => {
    btnCargaStats('src/db/ai.php')
  })

  //#region charts #//
  let actualChart = null
  btnsStats = document.querySelectorAll('.navlinkStats')
  btnsStats.forEach(button => {
    button.addEventListener('click', () => {
      const attr = button.getAttribute('CanvaId')
      const typeChart = button.getAttribute('CanvaType')
      const datakey = button.getAttribute('CanvaKey')
      console.log(datakey)
      //console.log(info[datakey])
      console.log(attr)

      console.log(state)
      //if(state){
      switch (attr) {
        case 'none':
          console.log('smile! :)')
          break

        default:
          graphStats(attr, typeChart, datakey)
          break
      }
      /*       }else{
              console.log('eh falso')
            } */
    })
  })

  function graphStats(graphic, type, data) {
    console.log('➡️ Entrando a graphStats con state =', state)
    if (state) {
      const ctx = document.getElementById(graphic)
      console.log(ctx)

      if (!ctx) {
        console.log('el grafico no existe :((')
      }

      if (actualChart != null) {
        console.log(actualChart)
        actualChart.clear();
        actualChart.destroy()
      }

      actualChart = new Chart(ctx, {
        type: type,
        data: info[data],
        options: {
          responsive: true,
          maintainAspectRatio: false
        }
      })
    } else {
      console.log('nothing!')
    }

  }

  //#endregion #//

  //#endregion

  //#region modal alertmed
  let AlertMed = new bootstrap.Modal(document.getElementById('AlertMed'))

  let btnadminalertmed = document.getElementById('btn-admin-alert-med').addEventListener('click', (e) => {
    document.getElementById('item2').click()
  })

  let modalAlertMed = document.getElementById('modalAlertMed')
  fetch('src/db/modalmed.php')
    .then(response => response.json())
    .then(data => {
      let alerts = ''
      modalAlertMed.innerHTML = ''

      let listalert = ''
      if (data.caducado.cantidad > 0) {
        for (let i = 0; i < data.caducado.nombre.length; i++) {
          listalert += `<li class="list-group-item d-inline-flex justify-content-between">${data.caducado.nombre[i]} <span class="badge text-bg-danger rounded-pill">Vencido: ${data.caducado.fechaCad[i]}</span></li>`
        }
        alerts = alerts + `<div class="card mb-3 border-danger">
          <div class="card-header text-bg-danger d-flex justify-content-between align-items-center">
            <div class="d-inline-flex">
              <span class="material-symbols-rounded me-1">
                event_busy
              </span>
              Caducados
            </div>
            <div>
              <span class="badge bg-white text-danger fs-6">${data.caducado.cantidad}</span>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="titles">
                <h5 class="card-title fs-2">${data.caducado.porcentaje}%</h5>
                <p class="card-text text-seconday">Medicamentos vencidos</p>
              </div>
              <div class="icon">
                <span class="material-symbols-rounded rounded-pill text-bg-danger p-2 fs-2">
                  medication
                </span>
              </div>
            </div>
            <div class="progress mt-3" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-danger" style="width: ${data.caducado.porcentaje}%"></div>
            </div>
            <button class="btn btn-outline-danger mt-3 d-inline-flex justify-content-between w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-cadMedic" aria-expanded="false" aria-controls="collapse-cadMedic">
              Ver más detalles
              <span class="material-symbols-rounded">
                arrow_drop_down
              </span>
            </button>
            </p>
            <div class="collapse border border-0" id="collapse-cadMedic">
              <ul class="list-group border-danger">
                ${listalert}
              </ul>
            </div>
          </div>
        </div>`
      }

      listalert = ''

      if (data.stock.porcentaje > 0) {
        for (let i = 0; i < data.stock.nombre.length; i++) {
          listalert += `<li class="list-group-item d-inline-flex justify-content-between">${data.stock.nombre[i]} <span class="badge bg-warning text-white rounded-pill">Agotado</span></li>`
        }
        alerts = alerts + `<div class="card mb-3 border-warning">
          <div class="card-header bg-warning d-flex justify-content-between align-items-center">
            <div class="d-inline-flex text-white">
              <span class="material-symbols-rounded me-1">
                event_busy
              </span>
              Caducados
            </div>
            <div>
              <span class="badge bg-white text-warning fs-6">${data.stock.cantidad}</span>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="titles">
                <h5 class="card-title fs-2">${data.stock.porcentaje}%</h5>
                <p class="card-text text-seconday">Medicamentos sin stock</p>
              </div>
              <div class="icon">
                <span class="material-symbols-rounded rounded-pill text-white bg-warning p-2 fs-2">
                  inventory_2
                </span>
              </div>
            </div>
            <div class="progress mt-3" role="progressbar" aria-label="warning example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-warning" style="width: ${data.stock.porcentaje}%"></div>
            </div>
            <button class="btn btn-outline-warning mt-3 d-inline-flex justify-content-between w-100" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-NoStock" aria-expanded="false" aria-controls="collapse-NoStock">
              Ver más detalles
              <span class="material-symbols-rounded">
                arrow_drop_down
              </span>
            </button>
            </p>
            <div class="collapse border border-0" id="collapse-NoStock">
              <ul class="list-group border-warning">
                ${listalert}
              </ul>
            </div>
          </div>
        </div>`
      }

      if (data.caducado.cantidad > 0 && data.stock.porcentaje > 0) {
        modalAlertMed.innerHTML = alerts
        AlertMed.show()
      }
    })
  //#endregion

})