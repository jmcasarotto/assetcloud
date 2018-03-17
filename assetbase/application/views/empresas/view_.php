
<div class="row">
	<div class="col-xs-12">
		<div class="alert alert-danger alert-dismissable" id="errorCust" style="display: none">
	        <h4><i class="icon fa fa-ban"></i> Error!</h4>
	        Revise que todos los campos esten completos
      </div>
	</div>
</div>
<div class="nav-tabs-custom">
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
    <li><a href="#tab_2" data-toggle="tab">Imagen</a></li>
    <li><a href="#tab_3" data-toggle="tab">Acerca de</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab_1"> <!-- Datos generales del cliente -->
      <div class="row">
        <div class="col-xs-4">
            <label style="margin-top: 7px;">Nro. <strong style="color: #dd4b39">*</strong>: </label>
          </div>
        <div class="col-xs-5">
            <input type="text" class="form-control" placeholder="" id="cliNroCustomer" value="<?php echo $data['empresa']['id_empresa'];?>" disabled="disabled" >
          </div>
      </div><br>
      <div class="row">
        <div class="col-xs-4">
            <label style="margin-top: 7px;">Razon Social <strong style="color: #dd4b39">*</strong>: </label>
          </div>
        <div class="col-xs-5">
            <input type="text" class="form-control" placeholder="Nombre" id="empName" value="<?php echo $data['empresa']['descripcion'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
          </div>
      </div><br>
      <div class="row">
        <div class="col-xs-4">
            <label style="margin-top: 7px;">CUIT <strong style="color: #dd4b39">*</strong>: </label>
          </div>
        <div class="col-xs-5">
            <input type="text" class="form-control" placeholder="CUIT" id="empcuit" value="<?php echo $data['empresa']['empcuit'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
          </div>
      </div><br>
      
      <div class="row">
        <div class="col-xs-4">
            <label style="margin-top: 7px;">Domicilio: </label>
          </div>
        <div class="col-xs-5">
            <input type="input" class="form-control" placeholder="ej: Barrio Los Olivos M/E Casa/23" id="empAddress" value="<?php echo $data['empresa']['empdir'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
          </div>
      </div><br>
      <div class="row">
        <div class="col-xs-4">
            <label style="margin-top: 7px;">Teléfono:</label>
          </div>
        <div class="col-xs-5">
            <input type="text" class="form-control" placeholder="0264 - 4961020" id="empPhone" value="<?php echo $data['empresa']['emptelefono'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?> >
          </div>
      </div><br>
      <div class="row">
        <div class="col-xs-4">
            <label style="margin-top: 7px;">Celular: </label>
          </div>
        <div class="col-xs-5">
            <input type="text" class="form-control" placeholder="0264 - 155095888" id="empMovil" value="<?php echo $data['empresa']['empcelular'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?> >
          </div>
      </div><br>
      <div class="row">
        <div class="col-xs-4">
            <label style="margin-top: 7px;">Mail: </label>
          </div>
        <div class="col-xs-5">
            <input type="text" class="form-control" placeholder="" id="empEmail" value="<?php echo $data['empresa']['empemail'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?> >
          </div>
      </div><br>
      <div class="row">
        <div class="col-xs-4">
            <label style="margin-top: 7px;">Zona: </label>
          </div>
        <div class="col-xs-5">
            <select class="form-control" id="zonaId"  <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?> >
              <?php 
                foreach ($data['zone'] as $z) {
                  echo '<option value="'.$z['zonaId'].'" '.($data['customer']['zonaId'] == $z['zonaId'] ? 'selected' : '').'>'.$z['zonaName'].'</option>';
                }
              ?>
            </select>
          </div>
      </div><br>
     

   


   