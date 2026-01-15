//#region validation
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
//#endregion validation

//#region Check password
var check = document.getElementById('check-pass')
var label = document.getElementById('checklabelI')
const txt = document.getElementById('txt-pass')
label.innerHTML = 'visibility'
check.addEventListener('change', () => {
    if (check.checked) {
        txt.type = "text"
        label.innerHTML = 'visibility_off'
    } else {
        txt.type = "password"
        label.innerHTML = 'visibility'
    }
    txt.reportValidity()
})
//#endregion Check password

//#region Toast
var containerToast = document.getElementById('container-toast')
function toast(content) {
    containerToast.innerHTML = `<div class="toast show fade align-items-center text-bg-danger border-0" role="alert" style="position:absolute; bottom: 20px; z-index: 9999;" data-bs-delay="3000">
                                  <div class="d-flex">
                                    <div class="toast-body">
                                      ${content}
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                  </div>
                                </div>`
    document.getElementById("errorAud").play()
}
//#endregion Toast

//#region Login
const form = document.getElementById('form-login')
form.addEventListener('submit', (e) => {
    txt.reportValidity

    const formdata = new FormData(form)
    e.preventDefault()
    fetch('src/db/log.php', {
        method: 'POST',
        body: formdata
    })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if (data.success) {
                window.location.href = 'app.php'
            } else if (data.error) {
                toast(data.error)
                form.classList.remove('was-validated')
            }
        })
        //.catch(error => toast('Estamos teniendo problemas para conectarnos con el servidor. Reintente más tarde. ' + error))
})
//#endregion Login