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
      <input type="text" class="form-control" placeholder="Nombre" id="nombre" value="<?php echo $data['contratista']['nombre'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>
<div class="row">
	<div class="col-xs-4">
      <label style="margin-top: 7px;">Direccion <strong style="color: #dd4b39">*</strong>: </label>
    </div>
	<div class="col-xs-5">
      <input type="text" class="form-control" placeholder="Direccion" id="direccion" value="<?php echo $data['contratista']['contradireccion'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>
<div class="row">
	<div class="col-xs-4">
      <label style="margin-top: 7px;">Mail <strong style="color: #dd4b39">*</strong>: </label>
    </div>
	<div class="col-xs-5">
      <input type="text" class="form-control" placeholder="Email" id="mail" value="<?php echo $data['contratista']['contramail'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>
<div class="row">
  <div class="col-xs-4">
      <label style="margin-top: 7px;">Mail Alternativo<strong style="color: #dd4b39">*</strong>: </label>
    </div>
  <div class="col-xs-5">
      <input type="text" class="form-control" placeholder="Email Alternativo" id="mail1" value="<?php echo $data['contratista']['contramail1'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>
<div class="row">
  <div class="col-xs-4">
      <label style="margin-top: 7px;">Celular 1 <strong style="color: #dd4b39">*</strong>: </label>
    </div>
  <div class="col-xs-5">
      <input type="text" class="form-control" placeholder="celular1" id="cel1" value="<?php echo $data['contratista']['contracelular1'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>
<div class="row">
  <div class="col-xs-4">
      <label style="margin-top: 7px;">Celular 2 <strong style="color: #dd4b39">*</strong>: </label>
    </div>
  <div class="col-xs-5">
      <input type="text" class="form-control" placeholder="celular 2" id="cel2" value="<?php echo $data['contratista']['contracelular2'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>
<div class="row">
  <div class="col-xs-4">
      <label style="margin-top: 7px;">Telefono <strong style="color: #dd4b39">*</strong>: </label>
    </div>
  <div class="col-xs-5">
      <input type="text" class="form-control" placeholder="Telefono" id="telefono" value="<?php echo $data['contratista']['contratelefono'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>
<div class="row">
	<div class="col-xs-4">
      <label style="margin-top: 7px;">Contacto <strong style="color: #dd4b39">*</strong>: </label>
    </div>
	<div class="col-xs-5">
      <input type="text" class="form-control" placeholder="Contacto" id="cont" value="<?php echo $data['contratista']['contratelefono'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>
</div>