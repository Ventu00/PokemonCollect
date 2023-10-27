$(document).ready(function () {
    // Selección de los botones por la clase "eliminar-carta"
    $(".eliminar-carta").on("click", function () {
      var id = $(this).data("carta-id"); // Obtener el ID de la carta del atributo "data-carta-id"
      eliminar(id);
    });
  });
  
function eliminar(id) {
    if (confirm("¿Estás seguro de que quieres eliminar esta carta?")) {
      $.ajax({
        type: "POST",
        url: "eliminar.php",
        data: { id: id },
        success: function (response) {
          if (response === 'success') {
            // Recargar la página o realizar alguna acción adicional si es necesario
            location.reload();
          } else {
            alert("No se pudo eliminar la carta.");
          }
        },
      });
    }
  }
  