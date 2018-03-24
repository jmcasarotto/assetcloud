<div class="container-fluid">
    <div class="col-xs-2"></div>
<div class="col-xs-8">
    <div class="row">
        <div class="col-xs-12">
            <h3>Formulario de Registro</h3>
        </div>
    </div>
    <div class="row well">
        <form action="crear" method="post" id="altacliente">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">Datos de la cuenta</div>
                    <div class="panel-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">Email </label>(*)
                                <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@ejemplo.com">
                                <span class="label label-danger" id="emailerror">Email incorrecto</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                <span class="label label-danger" id="passworderror">Es necesario ingresar el password</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-6">
                                <label for="usrname">Nombre</label>
                                <input type="text" class="form-control" id="usrname" name="usrname" placeholder="Nombre">
                                <span class="label label-danger" id="usrnameerror">Es necesario un Nombre</span>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="usrLastName">Apellido</label>
                                <input type="text" class="form-control" id="usrLastName" name="usrLastName" placeholder="Apellido">
                                <span class="label label-danger" id="usrLastNameError">Es necesario un Apellido</span>
                            </div></div>
                        <div class="form-row col-xs-12">
                            <div class="form-group">
                                <label for="razonsocial">Razon Social</label>
                                <input type="text" class="form-control" id="razonsocial" placeholder="Razon Social" name="razonsocial">
                                <span class="label label-danger" id="razonsocialerror">Razon Social invalida</span>
                            </div>
                        </div>
                        <div class="form-row col-xs-12">
                            <div class="form-group">
                                <label for="direccion">Direccion</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Av. Libertador 1850">
                                <span class="label label-danger" id="direccionerror">Direccion incorrecta</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="telefonofijo">Telefono fijo</label>
                                <input type="text" class="form-control" id="telefonofijo" name="telefonofijo" placeholder="4262020">
                                <span class="label label-danger" id="telefonofijoerror">Telefono incorrecto</span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="celular">Celular</label>
                                <input type="text" class="form-control" id="celular" name="celular" placeholder="264-583776">
                                <span class="label label-danger" id="celularerror">Celular incorreto</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-6">
                                <label for="pais">Pais</label>
                                <select class="form-control" id="pais" name="pais">
                                    <option value="">-- SELECCIONE --</option>
                                    <?php
                                    foreach($paises as $p)
                                    {
                                        echo '<option value="'.$p['Codigo'].'">'.$p['Pais'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="provincia">Provincia</label>
                                <select class="form-control" id="provincia" name="provincia">
                                    <option value="">-- SELECCIONE --</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row col-xs-12">
                            <div class="form-group">
                                <label for="direccion">Localidad</label>
                                <input type="text" class="form-control" id="localidad" name="localidad" placeholder="Ejemplo: Rawson">
                                <span class="label label-danger" id="localidaderror">Localidad incorrecta</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">Datos de la Unidad de Negocio</div>
                    <div class="panel-body">
                        <div class="form-row">
                            <div class="form-group col-xs-6">
                                <label for="logo">Logo</label>
                                <output id="list"></output>
                                <input type="file" accept="image/*" class="form-control" id="logo" name="logo" placeholder="Logo">
                                <p id="data"></p>
                                <span class="label-danger" id="errorimage">Formato incorrecto!!</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-6">
                                <label for="descripcion">Nombre</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Nombre de la Empresa">
                                <span class="label label-danger" id="descripcionerror">Ingrese un nombre para la empresa</span>
                            </div>

                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-6">
                                <label for="cuit">Cuit</label>
                                <input type="text" class="form-control" id="cuit" name="cuit" placeholder="CUIT">
                                <span class="label label-danger" id="cuiterror">CUIT incorrecto</span>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="emailempresa">Email</label>
                                <input type="email" class="form-control" id="emailempresa" name="emailempresa" placeholder="Direccion de Correo">
                                <span class="label label-danger" id="emailempresaerror">Email incorreto</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-6">
                                <label for="direccionempresa">Direccion</label>
                                <input type="text" class="form-control" id="direccionempresa" name="direccionempresa" placeholder="Direccion de la Empresa">
                                <span class="label label-danger" id="direccionempresaerror">Direccion incorreto</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-6">
                                <label for="telefonoempresa">Telefono</label>
                                <input type="text" class="form-control" id="telefonoempresa" name="telefonoempresa" placeholder="Telefono">
                                <span class="label label-danger" id="telefonoempresaerror">Telefono incorreto</span>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="celularempresa">Celular</label>
                                <input type="text" class="form-control" id="celularempresa" name="celularempresa" placeholder="Celular de la Empresa">
                                <span class="label label-danger" id="celularempresaerror">Celular incorreto</span>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-6">
                                <label for="zona">Zona</label>
                                <input type="text" class="form-control" id="zona" name="zona" placeholder="Zona">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-6">
                                <label for="gps">GPS</label>
                                <input type="text" class="form-control" id="gps" name="gps" placeholder="GPS">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-xs-6">
                                <label for="paisempresa">Pais</label>
                                <select class="form-control" id="paisempresa" name="paisempresa">
                                    <option value="">-- SELECCIONE --</option>
                                    <?php
                                    foreach($paises as $p)
                                    {
                                        echo '<option value="'.$p['Codigo'].'">'.$p['Pais'].'</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-xs-6">
                                <label for="provinciaempresa">Provincia</label>
                                <select class="form-control" id="provinciaempresa" name="provinciaempresa">
                                    <option value="">-- SELECCIONE --</option>
                                </select>
                            </div>
                            <div class="form-group col-xs-12">
                                <label for="localidadempresa">Localidad</label>
                                <input type="text" class="form-control" id="localidadempresa" name="localidadempresa" placeholder="Ejemplo: Rivadavia">
                                <span class="label label-danger" id="localidadempresaerror">Localidad incorrecta</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="form-row col-xs-6">
                     <button type="submit" class="btn btn-primary">Crear</button>
                </div>
            </form>
    </div>
        <div class="col-xs-2"></div>
    </div>
</div>
<script>
    $( document ).ready(function() {
        $("#emailerror").hide();
        $("#passworderror").hide();
        $("#usrnameerror").hide();
        $("#usrLastNameError").hide();
        $("#razonsocialerror").hide();
        $("#direccionerror").hide();
        $("#localidaderror").hide();
        $("#telefonofijoerror").hide();
        $("#celularerror").hide();
        $("#descripcionerror").hide();
        $("#cuiterror").hide();
        $("#direccionempresaerror").hide();
        $("#telefonoempresaerror").hide();
        $("#celularempresaerror").hide();
        $("#emailempresaerror").hide();
        $("#localidadempresaerror").hide();
        $("#errorimage").hide();

//        $('#pais option[value="AR"]').attr("selected", "selected");

        $('#pais').change(function(e)
        {
                var cod = $('#pais').val();
                var url = 'provincias/'+cod;

            $.get(url, function(data){
                $("#provincia").html(data);
            });
        });

        $('#paisempresa').change(function(e)
        {
            var cod = $('#paisempresa').val();
            var url = 'provincias/'+cod;

            $.get(url, function(data){
                $("#provinciaempresa").html(data);
            });
        });

        var _URL = window.URL || window.webkitURL;

        $("#logo").change(function(e) {
            var image, file;
            file = this.files[0];
            if (file['type'] == "image/jpeg" || file['type'] == "image/png" || file['type'] == "image/jpg") {
                $('#errorimage').hide();

                var sizeByte = this.files[0].size;
                var sizekiloBytes = parseInt(sizeByte / 1024);

                image = new Image();

                image.onload = function() {
                    document.getElementById("data").innerHTML = 'Datos imagen: tamano = ' + sizekiloBytes  + ' KB , ancho (width) = ' + this.width + ' , altura (height) = ' + this.height;

                    if(sizekiloBytes > $('#file').attr('size')){
                        alert('El tamaño supera el limite permitido!');
                        $(this).val('');
                    }


                };

                image.src = _URL.createObjectURL(file);

            }
            else
            {

                $('#errorimage').show();
                $('#logo').val('');
            }
        });
            $("#altacliente").on("submit", function(e){
            e.preventDefault();
            var hayError = false;
                var fileSize = $('#logo')[0].files[0];
                var sizekiloBytes = parseInt(fileSize / 1024);

        if($('#email').val() == '') {
            $("#emailerror").show();
            var hayError = true;
        }
        if($('#password').val() == '') {
            $("#passworderror").show();
            var hayError = true;
        }
//        if($('#usrname').val() == '') {
//            $("#usrnameerror").show();
//            var hayError = true;
//        }
//        if($('#usrLastName').val() == '') {
//            $("#usrLastNameError").show();
//            var hayError = true;
//        }
//        if($('#razonsocial').val() == '') {
//            $("#razonsocialerror").show();
//            var hayError = true;
//        }
//        if($('#direccion').val() == '') {
//            $("#direccionerror").show();
//            var hayError = true;
//        }
//        if($('#localidad').val() == '') {
//            $("#localidaderror").show();
//            var hayError = true;
//        }
//        if($('#telefonofijo').val() == '') {
//            $("#telefonofijoerror").show();
//            var hayError = true;
//        }
//        if($('#celular').val() == '') {
//            $("#celularerror").show();
//            var hayError = true;
//        }
//        if($('#descripcion').val() == '') {
//            $("#descripcionerror").show();
//            var hayError = true;
//        }
//        if($('#emailempresa').val() == '') {
//            $("#emailempresaerror").show();
//            var hayError = true;
//        }
//        if($('#cuit').val() == '') {
//            $("#cuiterror").show();
//            var hayError = true;
//        }
//        if($('#direccionempresa').val() == '') {
//            $("#direccionempresaerror").show();
//            var hayError = true;
//        }
//        if($('#celularempresa').val() == '') {
//            $("#celularempresaerror").show();
//            var hayError = true;
//        }
//        if($('#localidadempresa').val() == '') {
//            $("#localidadempresaerror").show();
//            var hayError = true;
//        }
//        if($('#telefonoempresa').val() == '') {
//            $("#telefonoempresaerror").show();
//            var hayError = true;
//        }

        if(sizekiloBytes >  $('#file').attr('size'))
        {
            alert('El tamaño supera el limite permitido!');
            return false;
        }
        else
        {

            //Preparo los datos para enviarlos al controlador
            var formData = new FormData(document.getElementById("altacliente"));

            WaitingOpen('Guardando cambios');

            $.ajax({
                cache: false,
                contentType: false,
                data: formData,
                dataType: "html",
                processData: false,
                type: "POST",
                url: "crear",
                success: function(data){
//                    console.log(data);
                    WaitingClose();
//                    location.href = 'login';
//                    cargarView( 'login');
                },
                error: function(result){
                    WaitingClose();
                    alert(result);
                    //VER QUE MENSAJE MOSTRAR
//                    alert('Hubo un error al realizar la operación!');
                }
            });
        }
    })

        function archivo(evt) {
            var files = evt.target.files; // FileList object
//            document.getElementById("list1").innerHTML = ['<button id="test" class="btn btn-danger">X</button>'].join('');
            // Obtenemos la imagen del campo "file".
            for (var i = 0, f; f = files[i]; i++) {
                //Solo admitimos imágenes.
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();
                reader.onload = (function(theFile) {
                    return function(e) {
                        // Insertamos la imagen
                        document.getElementById("list").innerHTML = ['<img class="img-thumbnail" alt="Cinque Terre" height="150" width="150" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                    };
                })(f);

                reader.readAsDataURL(f);
            }
        }

        document.getElementById('logo').addEventListener('change', archivo, false);
    });
</script>
