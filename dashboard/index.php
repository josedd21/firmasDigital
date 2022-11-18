<?php require_once "vistas/parte_superior.php"?>

<!--INICIO del cont principal-->
<div class="container">
    <h1>Contenido principal</h1>
    
    
    
 <?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$consulta = "SELECT id, cedula, sede,nombre, cargo, area, signatur FROM personas";
$resultado = $conexion->prepare($consulta);
$resultado->execute();
$data=$resultado->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="container">
       <!-- <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button>    
            </div>    
        </div>    -->
    </div>    
    <br>  
<div class="container">
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>Id</th>
                                <th>Cedula</th>
                                <th>sede</th>
                                <th>Nombre</th>
                                <th>cargo</th>                                
                                <th>area</th>  
                                <th>Firma</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                                <td><?php echo $dat['id'] ?></td>
                                <td><?php echo $dat['cedula'] ?></td>
                                <td><?php echo $dat['sede'] ?></td>
                                <td><?php echo $dat['nombre'] ?></td>
                                <td><?php echo $dat['cargo'] ?></td>
                                <td><?php echo $dat['area'] ?></td>    
                                <td><?php echo $dat['signatur'] ?></td>
                                <td></td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">
                <div class="form-group">
                <label for="cedula" class="col-form-label">Cedula:</label>
                <input disabled type="text" class="form-control" id="cedula">
                </div>
                <div class="form-group">
                <label for="sede" class="col-form-label">Sede:</label>
                <input disabled type="text" class="form-control" id="sede">
                </div>
                <div class="form-group">
                <label for="nombre" class="col-form-label">Nombre:</label>
                <input disabled type="text" class="form-control" id="nombre">
                </div>
                <div class="form-group">
                <label for="cargo" class="col-form-label">Cargo:</label>
                <input disabled type="text" class="form-control" id="cargo">
                </div>                
                <div class="form-group">
                <label for="area" class="col-form-label">Area:</label>
                <input disabled type="text" class="form-control" id="area">
                <div class="form-group">
                <h2>Firma Empleado</h2>

                    <form method="post" action="dashboard/process.php" enctype="multipart/form-data">
                        <div id="signature-pad">
                            <div style="border:solid 1px teal; width:460px;height:150px;padding:3px;position:relative;">
                                <div id="note" onmouseover="my_function();">The signature should be inside box</div>
                                <canvas id="the_canvas" width="350px" height="100px"></canvas>
                                
                            </div>
                          
                        </div>
                    <form> 
                    <div class="modal-footer" style="margin:10px;">
                    <input type="hidden" id="signature" name="signature">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
                </div>
                </div>           
            </div>
          
               
                <script>
                var wrapper = document.getElementById("signature-pad");
                var clearButton = wrapper.querySelector("[data-action=clear]");
                var savePNGButton = wrapper.querySelector("[data-action=save-png]");
                var canvas = wrapper.querySelector("canvas");
                var el_note = document.getElementById("note");
                var signaturePad;
                signaturePad = new SignaturePad(canvas);

                clearButton.addEventListener("click", function (event) {
                    document.getElementById("note").innerHTML="The signature should be inside box";
                    signaturePad.clear();
                });
                savePNGButton.addEventListener("click", function (event){
                    if (signaturePad.isEmpty()){
                        alert("Please provide signature first.");
                        event.preventDefault();
                    }else{
                        var canvas  = document.getElementById("the_canvas");
                        var dataUrl = canvas.toDataURL();
                        document.getElementById("signature").value = dataUrl;
                    }
                });
                function my_function(){
                    document.getElementById("note").innerHTML="";
                }
                </script>
                        
                    </div>
                </div>    
        </form>    
        </div>
    </div>
</div>  
      
    
    
</div>

<!--FIN del cont principal-->
<?php require_once "vistas/parte_inferior.php"?>