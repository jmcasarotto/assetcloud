<input type="hidden" id="permission" value="<?php echo $permission;?>">
<section class="content"> 
<div class="row">
<div class="col-xs-12">
	<div class="alert alert-danger alert-dismissable" id="error" style="display: none">
        <h4><i class="icon fa fa-ban"></i> Error!</h4>
        Revise que todos los campos esten completos
  </div>
</div>
</div>
<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Reporte Ordenes de Servicio</h3>
        </div>
	         
	          	<form class="form-inline">
					
					<div class="box-body">  
					  	<div class="form-group">
						    
						    <div class="checkbox" style="margin-left: 20px;">
							    <label>
							      <input type="checkbox" class="check" id="selSector">
							    </label>
							</div>
						    <label for="buscSector">Sector<strong style="color: #dd4b39">*</strong></label>
						    	<input type="text" class="form-control buscSector" placeholder="Buscar Sector..." id="buscSector" style="width: 80%;">
						    
                    		<input type="text" class="hidden idSector" id="idSector">
							
					  	</div>

					  	<div class="form-group">
						    <div class="checkbox" style="margin-left: 20px;">
							    <label>
							      <input type="checkbox" class="check" id="selEquipo">
							    </label>
							</div>
						    <label for="equipSelec">Equipo <strong style="color: #dd4b39">*</strong></label>
						    	<select class="form-control" id="equipSelec" placeholder="Seleccione tipo...">
								  <option value=""></option>						  			  
								</select>						    	
						    
						    
					  	</div>
					  
							</br> </br>
					  
					  	<div class="form-group">
						    <div class="checkbox">
							    <label>
							      <input type="checkbox" class="check" id="selFecha">
							    </label>
							</div>
						    <label for="desde">Desde</label>
						    <input type="text" class="form-control fecha check" id="desde" placeholder="">
						</div>  

						<div class="form-group" style="margin-left: 20px;">
							    <label for="hasta">Hasta</label>
							    <input type="text" class="form-control fecha check" id="hasta" placeholder="">
						</div> </br> </br>
						<button class="btn btn-default" id="consulta" onclick="javascript:consReporte()">Consultar</button>   
					</div>

				</form>

				<div id="tablaReportes"></div>
 		
 	  </div>
 	</div>
</div>
</section>

<!-- Datepicker -->
<script>  
  $(".fecha").datepicker();
</script>


<!-- Habilitar y deshabilitar fecha sector y equipo-->
<script>
	$(function() {
	  enabDisabFecha();
	  $("#selFecha").click(enabDisabFecha);
	});
	function enabDisabFecha() {
	  if (this.checked) {
	    $("input.fecha").removeAttr("disabled");
	  } else {
	    $("input.fecha").attr("disabled", true);
	    $("input.fecha").val('');
	  }
	}


	$(function() {
	  enabDisabSector();
	  $("#selSector").click(enabDisabSector);
	});
	function enabDisabSector() {
	  if (this.checked) {
	    $("input.buscSector").removeAttr("disabled");
	  } else {
	    $("input.buscSector").attr("disabled", true);
	    $("input.buscSector").val('');
	  }
	}

	$(function() {
	  enabDisabEquipo();
	  $("#selEquipo").click(enabDisabEquipo);
	});
	function enabDisabEquipo() {
	  if (this.checked) {
	    $("select#equipSelec").removeAttr("disabled");
	  } else {
	    $("select#equipSelec").attr("disabled", true);
	    $("select#equipSelec").val('');
	  }
	}

</script>



<!-- Trae sectores y equipos p/ sector seleccionado -->
<script> 

	$( function() {

      var dataF = function () {
          var tmp = null;
          $.ajax({
              'async': false,
              'type': "POST",
              'global': false,
              'dataType': 'json',
              'url': "Sservicio/getSector",
              'success': function (data) {
                  tmp = data;
              }
          });
          return tmp;
      }();

      $(function() {
          $(".buscSector").autocomplete({
              source: dataF,
              delay: 100,
              minLength: 1,
              focus: function(event, ui) {
                  // prevent autocomplete from updating the textbox
                  event.preventDefault();
                  // manually update the textbox
                  $(this).val(ui.item.label);
              },
              select: function(event, ui) {
                  // prevent autocomplete from updating the textbox
                  event.preventDefault();
                  // manually update the textbox and hidden field
                  $(this).val(ui.item.label);
                  $("#idSector").val(ui.item.value);
              },
          });
      });

      $(function() {
        
        $.ajax({
                //'data' : {id_sector : id },
                'async': true,
                'type': "POST",
                'global': false,
                'dataType': 'json',
                'url': "Sservicio/getEquipo",
                'success': function (data) {
                    
                    var $select = $("#equipSelec");

                    for (var i = 0; i < data.length; i++) {

                      $select.append($('<option />', { value: data[i]['id_equipo'], text: data[i]['descripcion'] }));
                    }

                 },
                'error' : function (data){
                  console.log('Error en getEquiSector');
                  alert('error');
                 }

        });
      });


  } );

</script>

<!-- Validacion de campos y Envio form -->
<script> 
  function consReporte() {  
      
      ///  VALIDACIONES
    // var hayError = false;
      
    // if ($('#equipo').val() == '') {
    //         hayError = true;
    //     }
    // if ($('#sector').val() == '') {
    //         hayError = true;
    //     }   
         
    // if(hayError == true){
    //    $('#error').fadeIn('slow');
    //    return;
    // }
    // else{
        //$('#error').fadeOut('slow');
        var id_eq = $('#equipSelec').val();
        var id_sec = $('#idSector').val();
        var de = $('#desde').val();
        var a = $('#hasta').val();	


        WaitingOpen('Buscando...');
        $.ajax({    
            data:{
            	id_equipo: id_eq,
            	id_sector: id_sec,
            	desde: de,
            	hasta: a
            },
            type: 'POST',             
            dataType: 'json',
            url: 'index.php/Reporte/getReporte',                
            success: function(result){   
                    limpCombo();
                    WaitingClose();  
                    $('#tablaReportes').html(result.html);
            		//alert('success');
            },
            error: function(result){
                   	limpCombo();
                    WaitingClose();                                              
                    alert("Error en consulta Ordenes");
            }
        });
    
  }

  function limpCombo(){

  		$('.check').attr('checked',false);

        $("input.buscSector").attr("disabled", true);
	    $("input.buscSector").val('');
	    $("#idSector").val('');

	    $("select#equipSelec").attr("disabled", true);
	    $("select#equipSelec").val('');

	    $("input.fecha").attr("disabled", true);
	    $("input.fecha").val('');
  }
</script>
<!-- / Validacion de campos y Envio form -->


