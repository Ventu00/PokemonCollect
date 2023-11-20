function actualizarAccion(accion) {
  document.getElementById('accion').value = accion;
}


function mostrarFormulario(accion) {

  var overlay = document.createElement('div');
  overlay.style.position = 'fixed';
  overlay.style.top = '0';
  overlay.style.left = '0';
  overlay.style.width = '100%';
  overlay.style.height = '100%';
  overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
  overlay.style.zIndex = '9999';
  document.body.appendChild(overlay);
  

  var botonMas = document.querySelector('.btn.btn-success.btn-circle.btn-xl.float-right');
  botonMas.disabled = true;

  var formulario = document.querySelector('.hidden-form');
  formulario.style.display = 'block';
  formulario.style.zIndex = '10000'; 

  var botonCancelar = formulario.querySelector('.btn.btn-secondary.mt-2');
  botonCancelar.addEventListener('click', function() {
    formulario.style.display = 'none';
    botonMas.disabled = false;
    document.body.removeChild(overlay);
  });
  var tituloFormulario = formulario.querySelector('.nuevacartatitulo');
  var botonSubmit = formulario.querySelector('.btn.btn-primary.mt-2');

  if (accion === 'agregar') {
    tituloFormulario.textContent = 'Nueva Carta';
    botonSubmit.textContent = 'Agregar';
  } else if (accion === 'editar') {
    tituloFormulario.textContent = 'Editar Carta';
    botonSubmit.textContent = 'Guardar';
  }
}

