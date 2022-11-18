$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'>Cargar</button>"  
       }],
       //<button class='btn btn-danger btnBorrar'>Borrar</button></div></div>
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        }
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#1cc88a");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nueva Persona");            
    $("#modalCRUD").modal("show");        
    id=null;
    opcion = 1; //alta
});    
    
var fila; //capturar la fila para editar o borrar el registro  
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    id = parseInt(fila.find('td:eq(0)').text());
    cedula = fila.find('td:eq(1)').text();
    sede = fila.find('td:eq(2)').text();
    nombre = fila.find('td:eq(3)').text();
    cargo = fila.find('td:eq(4)').text();
    area = fila.find('td:eq(5)').text();
    signatur=fila.find('td:eq(5)').text();
    //area = parseInt(fila.find('td:eq(5)').text());

    $("#cedula").val(cedula);
    $("#sede").val(sede);
    $("#nombre").val(nombre);
    $("#cargo").val(cargo);
    $("#area").val(area);
    $("#signatur").val(signatur);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#4e73df");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");            
    $("#modalCRUD").modal("show");  
    
});

//botón BORRAR
/*$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, id:id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
});*/

jQuery(document).ready(function($){

    var canvas = document.getElementById("signature");
    var signaturePad = new SignaturePad(canvas);

    $('#clear-signature').on('click', function(){
        signaturePad.clear();
    });
    //Funcion donde guardara en un input type hidden el codigo base64 que generará el propio canva
    function getSignaturePad() {
        var imageData = signaturePad.toDataURL();
        document.getElementById("datos-img").setAttribute("value", imageData);
        console.log(imageData);
    }
    //Al momento que se envie el formulario que se guarde en la carpeta del servidor la imagen generada en el canva
    $('#formPersonas').submit(function() {
        getSignaturePad(); //Carga la funcion donde se genera la funcion donde se guarda la imagen
        return true;
    });
});

$("#formPersonas").submit(function(e){
    e.preventDefault();    
    cedula = $.trim($("#cedula").val());
    sede = $.trim($("#sede").val());
    nombre = $.trim($("#nombre").val());  
    cargo = $.trim($("#cargo").val());
    area = $.trim($("#area").val());
    signatur = $.trim($("#signatur").val());  
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {cedula:cedula, sede:sede,nombre:nombre, cargo:cargo, area:area, signatur:signatur, id:id, opcion:opcion},
        success: function(data){  
            console.log(data);
            id = data[0].id;   
            cedula = data[0].cedula;
            sede = data[0].sede;
            nombre = data[0].nombre;         
            cargo = data[0].cargo;
            area = data[0].area;
            signatur = data[0].signatur;
            if(opcion == 1){tablaPersonas.row.add([id,cedula,sede,nombre,cargo,area,signatur]).draw();}
            else{tablaPersonas.row(fila).data([id,cedula,sede,nombre,cargo,area,signatur]).draw();}          
        }        
    });
    $("#modalCRUD").modal("hide");    

});    
    
});