let html5QrCode;

document.addEventListener("DOMContentLoaded", () => {
  html5QrCode = new Html5Qrcode("reader1");
});

function startScanner1() {
  html5QrCode.start(
    { facingMode: "environment" },
    { fps: 10, qrbox: 250 },
    decodedText => {
      console.log("QR detectado:", decodedText);
      document.getElementById('txt-con-imss-id').value = decodedText;
      stopScanner1();
    },
    error => {
      console.warn("QR no detectado", error);
    }
  ).catch(err => {
    console.error("No se pudo iniciar el escáner:", err);
  });
}

function stopScanner1() {

  html5QrCode.stop().then(() => {
    document.getElementById('reader1').innerHTML = `
      <span class="material-symbols-rounded" style="font-size: 150px;">qr_code_2</span>
      <p class="fs-4">Escanear QR</p>
    `;
  }).catch(err => {
    console.error("Error al detener el escáner:", err);
  });
}
