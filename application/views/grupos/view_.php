<div class="row">
	<div class="col-xs-12">
		<div class="alert alert-danger alert-dismissable" id="error" style="display: none">
	        <h4><i class="icon fa fa-ban"></i> Error!</h4>
	        Revise que todos los campos esten completos
      </div>
	</div>
</div>
<div class="row">	
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="col-xs-6">
		      <label style="margin-top: 7px;">Descripcion <strong style="color: #dd4b39">*</strong>: </label>		    
		      <input type="text" class="form-control" placeholder="Grupo" id="descrip" value="<?php echo $data['grupo']['descripcion'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
		    </div>  
	    </div>	    
	</div><br>
</div>