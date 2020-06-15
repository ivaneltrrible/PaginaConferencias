//EFI
(function () {
  "use strict";

  document.addEventListener("DOMContentLoaded", function () {
    //Campos datos usuario
    let nombre = document.querySelector("#nombre");
    let apellido = document.querySelector("#apellido");
    let email = document.querySelector("#email");

    //Campos pases diario
    let paseDia = document.querySelector("#paseDia");
    let paseDiario = document.querySelector("#paseDiario");
    let paseDosDias = document.querySelector("#paseDosDias");

    //Botones y Divs
    let regalo = document.querySelector("#regalo");
    let calcular = document.querySelector("#calcular");
    let listaProductos = document.querySelector("#lista-productos");
    let botonRegistro = document.querySelector("#btnRegistro");
    let error = document.querySelector("#error");
    let sumaTotal = document.getElementById("suma-total");
    //Extras
    let camisas = document.getElementById("camisa_evento");
    let etiquetas = document.getElementById("etiquetas");
    if (botonRegistro) {
      botonRegistro.disabled = true;
    }

    // // let botonNotificar = $("#btnRegistro").css("opacity");

    // // console.log(botonNotificar);
    // // if (botonNotificar == 0.5) {
    // //   $("#btnRegistro").mouseover(function() {
    // //     console.log(
    // //       "tienes que volver a calcular los montos cada vez que cambies un producto"
    // //     );
    // //   });
    // // }
    // == Eventos == //
    if (document.getElementById("calcular")) {
      calcular.addEventListener("click", calcularMontos);
      paseDia.addEventListener("click", mostrarDias);
      paseDiario.addEventListener("change", mostrarDias);
      paseDosDias.addEventListener("change", mostrarDias);

      // == Evento Div Error == //
      nombre.addEventListener("blur", validarDatos);
      apellido.addEventListener("blur", validarDatos);
      email.addEventListener("blur", validarEmail);

      //Funciones

      //funcion si cambia de boletos, producto etc tenga que volver a calcular monto a pagar
      //para que se habilite boton de pagar
      $(
        "#paseDiario, #paseDosDias, #paseDia, #camisa_evento, #etiquetas"
      ).change(function () {
        botonRegistro.disabled = true;
      });

      //Funcion para avisar a usuario que tiene que volver a calcular los montos en cada cambio de producto final

      function validarDatos() {
        if (this.value == "") {
          error.style.display = "block";
          error.innerHTML = "El campo " + this.name + " es obligatorio";
          this.style.border = "1px solid red";
          error.style.border = "1px solid red";
          // alert('El campo Email es obligatorio');
        } else {
          error.style.display = "none";
          this.style.border = "1px solid #cccccc";
        }
      }

      function validarEmail() {
        if (this.value.indexOf("@") > -1 && this.value.indexOf(".com") > -1) {
          error.style.display = "none";
          this.style.border = "1px solid #cccccc";
        } else {
          error.style.display = "block";

          error.innerHTML =
            "El campo " + this.name + " debe llevar un @ y un .com";
          this.style.border = "1px solid red";
          error.style.border = "1px solid red";
        }
      }

      function calcularMontos(event) {
        //para que no cambie de selector o pagina
        event.preventDefault();

        if (regalo.value === "") {
          alert("Debes de ingresar un regalo :)");
          regalo.focus();
        } else {
          //sirve para que no puedan poner letras en lugar de numeros
          let boletosDia = parseInt(paseDia.value, 10) || 0,
            boletosDosDias = parseInt(paseDosDias.value, 10) || 0,
            boletoDiario = parseInt(paseDiario.value, 10) || 0,
            cantidadCamisas = parseInt(camisas.value, 10) || 0,
            cantidadEtiquetas = parseInt(etiquetas.value, 10) || 0;

          //operacion de calcular todas las operaciones
          let totalPagar =
            boletosDia * 30 +
            boletosDosDias * 45 +
            boletoDiario * 50 +
            cantidadCamisas * 10 * 0.93 +
            cantidadEtiquetas * 2;

          //Arreglo de lista de productos ===
          let listadoProductos = [];

          //if Validaciones de que no sea 0

          if (boletosDia >= 1) {
            listadoProductos.push(boletosDia + " Pases por dia");
          }
          if (boletosDosDias >= 1) {
            listadoProductos.push(boletosDosDias + " Pase por dos dias");
          }
          if (boletoDiario >= 1) {
            listadoProductos.push(boletoDiario + " Pase completo");
          }
          if (cantidadCamisas == 1) {
            listadoProductos.push(cantidadCamisas + " Camisa");
          }
          if (cantidadEtiquetas == 1) {
            listadoProductos.push(cantidadEtiquetas + " Etiqueta");
          }
          if (cantidadCamisas >= 2) {
            listadoProductos.push(cantidadCamisas + " Camisas");
          }
          if (cantidadEtiquetas >= 2) {
            listadoProductos.push(cantidadEtiquetas + " Etiquetas");
          }

          console.log(listadoProductos);

          //Sirve para que cada ves que oprimas calcular se borre el contenido sin repetir lista
          listaProductos.style.display = "block";
          listaProductos.innerHTML = "";
          for (let i = 0; i < listadoProductos.length; i++) {
            listaProductos.innerHTML += listadoProductos[i] + "<br/>";
          }
          //Imprime en total toda la suma y solo acepta 2 decimales
          sumaTotal.innerHTML = "$ " + totalPagar.toFixed(2);
          botonRegistro.disabled = false;
          document.getElementById("total_pedido").value = totalPagar;
        }
      } //Funcion de Calcacular Montos Termina ==== //

      function mostrarDias() {
        let boletosDia = parseInt(paseDia.value, 10) || 0,
          boletosDosDias = parseInt(paseDosDias.value, 10) || 0,
          boletoDiario = parseInt(paseDiario.value, 10) || 0;

        let diasElegidos = [];
        //cuando sea 0 ocultara el display del dia
        if (boletosDia > 0) {
          diasElegidos.push("viernes");
          // // console.log('sirve el if');
        } else {
          document.getElementById("viernes").style.display = "none";
        } //para ocultar los dias no seleccionados
        if (boletosDosDias > 0) {
          diasElegidos.push("viernes", "sabado");
        } else {
          document.getElementById("sabado", "viernes").style.display = "none";
        } //para ocultar los dias no seleccionados
        if (boletoDiario > 0) {
          diasElegidos.push("viernes", "sabado", "domingo");
        } else {
          document.getElementById(
            "domingo",
            "sabado",
            "viernes"
          ).style.display = "none";
        } //para ocultar los dias no seleccionados
        for (let i = 0; i < diasElegidos.length; i++) {
          document.getElementById(diasElegidos[i]).style.display = "block";
          // $(diasElegidos[i]).show();
        }
      }
    } // if termina
  }); //Dom Contenet Load Termina //
})();