<style type="text/css" media="screen">
    .class-permisos {
        margin-top: 5 !important;
    }
</style>

<div class="row">
	<div class="col-xs-12">
		<div class="alert alert-danger alert-dismissable" id="errorGrp" style="display: none">
	        <h4><i class="icon fa fa-ban"></i> Error!</h4>
	        Revise que todos los campos esten completos
      </div>
	</div>
</div>
<div class="row">
	<div class="col-md-3 col-xs-12">
      <label style="margin-top: 7px;">Nombre <strong style="color: #dd4b39">*</strong>: </label>
    </div>
	<div class="col-md-9 col-xs-12">
      <input type="text" class="form-control" placeholder="Nombre" id="grpName" value="<?php echo $data['name'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>

	<br><br>

	<div class="col-md-3 col-xs-12">
      <label style="margin-top: 7px;">Escritorio <strong style="color: #dd4b39">*</strong>: </label>
    </div>
	<div class="col-md-9 col-xs-12">
      <input type="text" class="form-control" placeholder="Controlador de Escritorio" id="grpDash" value="<?php echo $data['dash'];?>" <?php echo ($data['read'] == true ? 'disabled="disabled"' : '');?>  >
    </div>
</div>
<div class="row">
	<div class="col-md-3">
      <label style="margin-top: 7px;">Permisos <strong style="color: #dd4b39">*</strong>: </label>
    </div>

    <div class="col-md-9">
        <?php foreach ($data['list'] as $it) { ?>
        <div id="permission">
            <a role="button" data-toggle="collapse" href="#collapse<?php echo str_replace(array(" ", "_"), "-", $it->name);?>" aria-expanded="false" aria-controls="collapse<?php echo str_replace(array(" ", "_"), "-", $it->name);?>" class="modal-title"><?php echo str_replace("_", " ", $it->name);?></a>
            <div class="collapse" id="collapse<?php echo str_replace(array(" ", "_"), "-", $it->name);?>">
                <div>
                <?php
                if(count($it->childrens) > 0)
                {
                    foreach ($it->childrens as $c)
                    {
                        ?>
                        <a role="button" data-toggle="collapse" href="#collapse<?php echo str_replace(array(" ", "_"), "-", $c->name);?>" aria-expanded="false" aria-controls="collapse<?php echo str_replace(array(" ", "_"), "-", $c->name);?>" class="modal-title"><i class="fa fa-fw fa-arrow-right" style="color: #00a65a"></i><?php echo str_replace("_", " ", $c->name);?></a><br>
                        <div class="collapse" id="collapse<?php echo str_replace(array(" ", "_"), "-", $c->name);?>">
                            <div>
                            <?php
                                foreach ($c->actions as $a) {
                                    if($a['grpactId'] == null)
                                        echo '<input type="checkbox" id="'.$a['menuAccId'].'" style="margin-left: 10%;" '.($data['read'] == true ? 'disabled="disabled"' : '').'> '.$a['actDescription'].'<br>';
                                    else
                                        echo '<input type="checkbox" id="'.$a['menuAccId'].'" style="margin-left: 10%;" '.($data['read'] == true ? 'disabled="disabled"' : '').' checked> '.$a['actDescription'].'<br>';
                                }
                            ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    foreach ($it->actions as $a) {
                        if($a['grpactId'] == null)
                            echo '<input type="checkbox" id="'.$a['menuAccId'].'" style="margin-left: 5%;" '.($data['read'] == true ? 'disabled="disabled"' : '').'> '.$a['actDescription'].'<br>';
                        else
                            echo '<input type="checkbox" id="'.$a['menuAccId'].'" style="margin-left: 5%;" '.($data['read'] == true ? 'disabled="disabled"' : '').' checked> '.$a['actDescription'].'<br>';
                    }
                }
            ?>
            </div>
        </div>
        </div>
        <?php } ?>






        <?php /*<div class="row">
            <div class="col-md-4 class-permisos">Menu</div>
            <div class="col-md-4 class-permisos">SubMenu</div>
            <div class="col-md-4 class-permisos">Permisos</div>
        </div>
        <?php foreach ($data['list'] as $it) { ?>
        <div class="row">
            <div class="col-md-4">
                <a role="button" data-toggle="collapse" href="#collapse<?php echo $it->name;?>" aria-expanded="false" aria-controls="collapse<?php echo $it->name;?>" class="modal-title"><?php echo str_replace("_", " ", $it->name);?></a>
            </div>
            <?php if(count($it->childrens) == 0) { ?>
            <div class="col-md-4 col-md-offset-4">
                <div class="collapse" id="collapse<?php echo $it->name;?>">
                    <?php foreach ($it->actions as $a) {
                    if($a['grpactId'] == null)
                        echo '<input type="checkbox" id="'.$a['menuAccId'].'" style="margin-left: 5%;" '.($data['read'] == true ? 'disabled="disabled"' : '').'> '.$a['actDescription'].'<br>';
                    else
                        echo '<input type="checkbox" id="'.$a['menuAccId'].'" style="margin-left: 5%;" '.($data['read'] == true ? 'disabled="disabled"' : '').' checked> '.$a['actDescription'].'<br>';
                    } ?>
                </div>
            </div>
            <?php } else { ?>
                <?php foreach ($it->childrens as $c) { ?>
                    <div class="col-md-4">
                        <a role="button" data-toggle="collapse" href="#collapse<?php echo $c->name;?>" aria-expanded="false" aria-controls="collapse<?php echo $c->name;?>" class="modal-title"><i class="fa fa-fw fa-angle-right"></i><?php echo str_replace("_", " ", $c->name);?></a>
                    </div>
                    <div class="col-md-4">
                        <div class="collapse" id="collapse<?php echo $c->name;?>">
                            <?php foreach ($c->actions as $a) {
                                if($a['grpactId'] == null)
                                    echo '<input type="checkbox" id="'.$a['menuAccId'].'" style="margin-left: 10%;" '.($data['read'] == true ? 'disabled="disabled"' : '').'> '.$a['actDescription'].'<br>';
                                else
                                    echo '<input type="checkbox" id="'.$a['menuAccId'].'" style="margin-left: 10%;" '.($data['read'] == true ? 'disabled="disabled"' : '').' checked> '.$a['actDescription'].'<br>';
                            } ?>
                        </div>
                        <span>&nbsp;</span> <!-- hack porque el collapse de bootstrap hace lío -->
                    </div>
                    <div class="col-md-4"></div>
                <?php } ?>
            <?php } ?>
        </div>
        <?php } ?>
    </div> */?>
</div>
