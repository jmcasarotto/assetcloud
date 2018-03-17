<input type="hidden" id="permission" value="<?php echo $permission;?>">
 <div class="row">
  <div class="col-xs-12">
    <div class="alert alert-danger alert-dismissable" id="error3" style="display: none">
          <h4><i class="icon fa fa-ban"></i> Error!</h4>
          Revise que todos los campos obligatorios esten seleccionados
      </div>
  </div>
</div>
<section class="content">
  <div class="row" >
    <div class="col-sm-12 col-md-12">
      <div class="box">
        <div class="box-header">
        <h3 class="box-title">Equipo/Sector</h3>
       
        </div><!-- /.box-header -->
        <div class="box-body">

        
         <div class="row" >
                        <div class="col-sm-12 col-md-12">
                          <div role="tabpanel" class="tab-pane">
                            <div class="form-group">
                              <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="panel-title">Datos del Equipo</h4>
                                  </div>
     
                                  <div class="panel-body">

                                    <div class="col-xs-4">Codigo:
                                       <select id="codigoe" name="codigoe" class="form-control"/>
                                          <input type="hidden" id="id_equipo" name="id_equipo">
                                    </div>

                                    <div class="col-xs-4">Ubicacion:
                                      <input type="text" id="ubicacione" name="ubicacione" class="form-control" disabled>
                                    </div>
                                    <div class="col-xs-4">Marca:
                                     <input type="text" id="marcae" name="marcae" class="form-control" disabled>
                                      
                                    </div>
                                    
                                    <div class="col-xs-4">Fecha de Ingreso:
                                      <input type="date" id="fecha_ingresoe"  name="fecha_ingresoe" class="form-control input-md" disabled>
                                    </div>
                
                                    <div class="col-xs-4">Fecha de Garantia:
                                        <input type="date" id="fecha_garantiae"  name="fecha_garantiae" class="form-control input-md" disabled>
                                    </div>
                
                                    <div class="col-xs-8">Descripcion: 
                                    </div>        

                                    <div class="row">
                                      <div class="col-lg-12">
                                      
                                      <textarea class="form-control" id="descripcione" name="descripcione" disabled></textarea>
                                      </div>
                                    </div>

                                  </div>
                               </div>
                              </div>
                            </div>
                          </div>
                          </div>
                          <div>
                          <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#choras" aria-controls="home" role="tab" data-toggle="tab">Contratista</a></li>

                          </ul>

                          <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="choras">

                          <div class="row" >
                            <div class="col-sm-12 col-md-12">
                              <br>
                              <fieldset><legend></legend></fieldset>
                                <div class="col-xs-4">'+
                                  <select id="empresae" name="empresae" class="form-control"/>'+
                                  <input type="hidden" id="id_contratista" name="id_contratista">'+
                                </div>
                                            
                                <div class="col-xs-4">
                                  <button type="button" class="btn btn-success" id="adde"><i class="fa fa-check">Agregar</i></button>
                                </div>

                                </div>

                              </div>
                            </div>
                             
                            <div class="row" >
                              <div class="col-sm-12 col-md-12">

                                <table class="table table-bordered" id="tablaempresa"> 
                                    <thead>
                                      <tr>                     
                                        <br>
                                        <th width="2%"></th>
                                        <th width="10%">Contratistas Asignados</th>
                                      </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                              </div>
                          </div>
      </div>
       
     

      <div class="modal-footer">
       
        <button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="guardarsi()" >SI</button>
      </div>  <!-- /.modal footer -->

       </div>  <!-- /.modal-body -->
    </div> <!-- /.modal-content -->

  </div>  <!-- /.modal-dialog modal-lg -->

</section>
<!-- / Modal -->




