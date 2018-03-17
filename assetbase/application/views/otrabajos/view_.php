
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
   
      <label style="margin-top: 7px;">Nro <strong style="color: #dd4b39">*</strong>: </label>
    </div>
  <div class="col-xs-5">
      <input type="text" class="form-control" placeholder="Nro Orden de trabajo" id="nro" value="<?php echo $data['ot']['nro'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
    
</div><br>
<div class="row">
<div class="col-xs-4">
      <label style="margin-top: 7px;">Cliente <strong style="color: #dd4b39">*</strong>: </label>
    </div>
  <div class="col-xs-5">
      <select class="form-control select2" id="cliid" style="width: 100%;">
        <?php 
            echo '<option value="-1"></option>';
          foreach ($data['clientes'] as $c) {
           echo '<option value="'.$c['cliId'].'">'.$c['cliLastName'].', '.$c['cliName'].'</option>';
          }
        ?>
      </select>
    </div>
</div><br>

 <div class="row">
        <div class="col-xs-4">
            <label style="margin-top: 7px;">Fecha <strong style="color: #dd4b39">*</strong>: </label>
          </div>
        <div class="col-xs-5">
            <input type="text" class="form-control" id="vfech" placeholder="dd-mm-aaaa" value="<?php echo $data['ot']['fecha_inicio'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?> >
          </div>
      </div><br>

<div class="row">
  <div class="col-xs-4">
      <label style="margin-top: 7px;">Nota: </label>
  </div>
  <div class="col-xs-5">
      <textarea placeholder="Orden de trabajo" class="form-control" rows="10" id="vsdetalle" value=""></textarea>
  </div>
</div><br>


<div class="row">
<div class="col-xs-4">
      <label style="margin-top: 7px;">Sucursal <strong style="color: #dd4b39">*</strong>: </label>
    </div>
  <div class="col-xs-5">
      <select class="form-control select2" id="sucid" style="width: 100%;">
        <?php 
            echo '<option value="-1"></option>';
          foreach ($data['sucursal'] as $s) {
           echo '<option value="'.$s['id_sucursal'].'">'.$s['descripc'].', '.$s['descripc'].'</option>';
          }
        ?>
      </select>
    </div>
</div><br>