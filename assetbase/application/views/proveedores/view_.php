<div class="row">
	<div class="col-xs-12">
		<div class="alert alert-danger alert-dismissable" id="error" style="display: none">
	        <h4><i class="icon fa fa-ban"></i> Error!</h4>
	        Revise que todos los campos esten completos
      </div>
	</div>
</div>
<div class="row">
	<div class="col-xs-4">
      <label style="margin-top: 7px;">Nombre <strong style="color: #dd4b39">*</strong>: </label>
    </div>
	<div class="col-xs-5">
      <input type="text" class="form-control" placeholder="Nombre" id="nombre" value="<?php echo $data['proveedor']['provnombre'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>
<div class="row">
<div class="col-xs-4">
      <label style="margin-top: 7px;">CUIT/CUIL <strong style="color: #dd4b39">*</strong>: </label>
    </div>
  <div class="col-xs-5">
      <input type="text" class="form-control" placeholder="CUIT/CUIL" id="cuit" value="<?php echo $data['proveedor']['provcuit'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>

<div class="row">
	<div class="col-xs-4">
      <label style="margin-top: 7px;">Direccion <strong style="color: #dd4b39">*</strong>: </label>
    </div>
	<div class="col-xs-5">
      <input type="text" class="form-control" placeholder="Direccion" id="direccion" value="<?php echo $data['proveedor']['provdomicilio'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>
<div class="row">
	<div class="col-xs-4">
      <label style="margin-top: 7px;">Mail <strong style="color: #dd4b39">*</strong>: </label>
    </div>
	<div class="col-xs-5">
      <input type="text" class="form-control" placeholder="Email" id="mail" value="<?php echo $data['proveedor']['provmail'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>
<div class="row">
	<div class="col-xs-4">
      <label style="margin-top: 7px;">Telefono <strong style="color: #dd4b39">*</strong>: </label>
    </div>
	<div class="col-xs-5">
      <input type="text" class="form-control" placeholder="Telefono" id="telefono" value="<?php echo $data['proveedor']['provtelefono'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>



 <div class="row">
        <div class="col-xs-4">
            <label style="margin-top: 7px;">Estado: </label>
          </div>
        <div class="col-xs-5">
<select class="form-control" id="estado"  <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?> >
              <?php 
                  echo '<option value="8" '.($data['socio']['socEstado'] == '1' ? 'selected' : '').'>Activo</option>';
                  echo '<option value="9" '.($data['socio']['socEstado'] == '2' ? 'selected' : '').'>Inactivo</option>';
                  echo '<option value="10" '.($data['socio']['socEstado'] == '3' ? 'selected' : '').'>Suspendido</option>';
              ?>
            </select>
</div>