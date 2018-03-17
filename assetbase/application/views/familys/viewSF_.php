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
      <label style="margin-top: 7px;">Descripción <strong style="color: #dd4b39">*</strong>: </label>
    </div>
	<div class="col-xs-5">
      <input type="text" class="form-control" placeholder="Sub-Familia" id="sfamName" value="<?php echo $data['sfamily']['sfamName'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
</div><br>
<div class="row">
	<div class="col-xs-4">
      <label style="margin-top: 7px;">Familia <strong style="color: #dd4b39">*</strong>: </label>
    </div>
	<div class="col-xs-5">
      <select class="form-control" id="famId"  <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?> >
        <?php 
        	foreach ($data['familys'] as $f) {
        		echo '<option value="'.$f['famId'].'" '.($data['sfamName']['grpId'] == $f['famId'] ? 'selected' : '').'>'.$f['famName'].'</option>';
        	}
        ?>
      </select>
    </div>
</div>
</div>