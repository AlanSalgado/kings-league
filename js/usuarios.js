let mdlConfirmacion;
var mensaje = document.getElementById("mensajes");

$(document).ready( function () {
    $('#usuarios').DataTable({
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

    $('#correos').DataTable({
        language: {
            "decimal": "",
            "emptyTable": "No hay información",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
            "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
            "infoFiltered": "(Filtrado de _MAX_ total entradas)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Entradas",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
    $("#correos_wrapper").hide();

	
	mdlConfirmacion = document.getElementById('mdlConfirmacion')
    mdlConfirmacion.addEventListener('show.bs.modal', event => {
        let clave=event.relatedTarget.value;
        //Cargar el nombre de la persona a eliminar tomado de la primera celda
        document.getElementById("spnPersona").innerText=
        event.relatedTarget.closest("tr").children[0].innerText;
        
        //Cargar la clave en el value del botón "SI"
        document.getElementById("btnConfirmar").value=clave;
    });


    var cmbTipo = document.getElementById('cmbTipo');
    var cmbInstitucion = document.getElementById('cmbInstitucion');

    cmbTipo.addEventListener('change', function(){
        cmbInstitucion.disabled = (cmbTipo.value!="Coach");
    });


} );

function confirmar(btn){
    //Colocar en el span el nombre de quien eliminar
	console.log("hola")
    const mdlEliminar = new bootstrap.Modal('#mdlConfirmacion', {
        backdrop:'static'
    });
    mdlEliminar.show(btn);
}

setTimeout(function() {
    if (mensaje) {
        mensaje.style.display = 'none';
    }
}, 3000); // Tiempo en milisegundos

function mostrar(){
	let campoContra=document.getElementById("txtPassword");
	if(campoContra.type=='password'){
		campoContra.type='text';
	}else{
		campoContra.type='password';
	}
}
