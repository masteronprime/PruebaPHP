$(document).ready(function() {
    $("#btnllamarfuncion").click(function() {
      var moneda = $("#moneda").val();
      var monto = $("#monto").val();
      
      $.ajax({
        url: "prueba.php", 
        type: "GET",
        data: { 
          action: "llamarFuncion",
          moneda: moneda,
          monto: monto
        }, 
        success: function(response) {
          $("#resultado").text("Resultado: " + response);
        },
        error: function() {
          alert("Error al llamar a la función.");
        }
      });
    });
})