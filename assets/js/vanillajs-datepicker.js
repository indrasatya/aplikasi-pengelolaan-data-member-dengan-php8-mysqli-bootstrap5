// memanggil konstruktor Datepicker dengan elemen input dan secara opsional
const elem = document.querySelector('input[class="form-control form-control-datepicker"]');
const datepicker = new Datepicker(elem, {
  autohide: true,
  format: 'dd-mm-yyyy',
});