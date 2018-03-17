<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Grupos</h3>
                    <?php
                    if (strpos($permission,'Add') !== false) {
                        echo '<button class="btn btn-block btn-success" style="width: 100px; margin-top: 10px;" data-toggle="modal" onclick="LoadGrp(0,\'Add\')" id="btnAdd" >Agregar</button>';
                    }
                    ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="groups" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th width="20%">Acciones</th>
                                <th>Nombre</th>
                                <th>Escritorio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($list as $g)
                            {
                                echo '<tr>';
                                echo '<td>';
                                if (strpos($permission,'Edit') !== false) {
                                    echo '<i class="fa fa-fw fa-pencil text-light-blue" style="cursor: pointer; margin-left: 15px;" onclick="LoadGrp('.$g['grpId'].',\'Edit\')"></i>';
                                }
                                if (strpos($permission,'Del') !== false) {
                                    echo '<i class="fa fa-fw fa-times-circle text-light-blue" style="cursor: pointer; margin-left: 15px;" onclick="LoadGrp('.$g['grpId'].',\'Del\')"></i>';
                                }
                                if (strpos($permission,'View') !== false) {
                                    echo '<i class="fa fa-fw fa-search text-light-blue" style="cursor: pointer; margin-left: 15px;" onclick="LoadGrp('.$g['grpId'].',\'View\')"></i>';
                                }
                                echo '</td>';
                                echo '<td style="text-align: left">'.$g['grpName'].'</td>';
                                echo '</td>';
                                echo '<td style="text-align: left">'.$g['grpDash'].'</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->

<script>
var idGrupo = 0;
var acGrupo = '';

function LoadGrp(id_, action){
    console.log(id_);
    console.log(action);
    idGrupo = id_;
    acGrupo = action;
    LoadIconAction('modalAction',action);
    WaitingOpen('Cargando menu');
    $.ajax({
        type: 'POST',
        data: { id : id_, act: action },
        url: 'index.php/group/getMenu',
        success: function(result){
            WaitingClose();
            $("#modalBodyGrp").html(result.html);
            setTimeout("$('#modalGrp').modal('show')",800);
        },
        error: function(result){
            WaitingClose();
            alert("error"+result);
        },
        dataType: 'json'
    });
}

$('#btnSave').click(function(){
    if(acGrupo == 'View')
    {
        $('#modalGrp').modal('hide');
        return;
    }

    var hayError = true;
    var permission = [];
    $('#permission :checked').each(function() {
        hayError = false;
        permission.push($(this).attr('id'));
    });

    if($('#grpName').val() == '')
    {
        hayError = true;
    }

    if(hayError == true){
        $('#errorGrp').fadeIn('slow');
        return;
    }

    $('#errorGrp').fadeOut('slow');
    WaitingOpen('Guardando cambios');
    $.ajax({
        type: 'POST',
        data: { id : idGrupo, act: acGrupo, name: $('#grpName').val(), dash: $('#grpDash').val(), options: permission },
        url: 'index.php/group/setGrupo',
        success: function(result){
            WaitingClose();
            $('#modalGrp').modal('hide');
            setTimeout("cargarView('group', 'index', '"+$('#permission').val()+"');",1000);
        },
        error: function(result){
            WaitingClose();
            alert("error");
        },
        dataType: 'json'
    });
});

$(function () {
    /* cargo plugin DataTable (debe ir al final de los script) */
    $("#groups").DataTable({
      "aLengthMenu": [ 10, 25, 50, 100 ],
      "autoWidth": true,
      "info": true,
      "ordering": true,
      "order": [[1, "asc"]],
      "paging": true,
      "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Sig.",
          "sPrevious": "Ant."
        },
        "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
      },
      "lengthChange": true,
      "searching": true,
      "sPaginationType": "full_numbers",
      "columnDefs": [ {
          "targets": [ 0 ], //no busco en acciones
          "searchable": false
      },
      {
        "targets": [ 0 ], //no ordena columna 0
        "orderable": false
      } ]
    });
});
</script>


<!-- Modal -->
<div class="modal fade" id="modalGrp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><span id="modalAction"> </span> Grupo</h4>
            </div>
            <div class="modal-body" id="modalBodyGrp">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnSave">Guardar</button>
            </div>
        </div>
    </div>
</div>