<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <?php
        echo $this->multi_menu->inject_item('<li><a href="#" onClick="cargarView(\''.$grpDash.'\', \'index\', \'View\')" data-permission="View-"><i class="fa fa-dashboard"></i><span>Escritorio</span></a></li>', 'first')
                              ->render();
        ?>
        <!-- /.sidebar-menu -->

    </section>
    <!-- /.sidebar -->

</aside>

<script>
/**
 * Determina la acción a tomar al hacer click en el menú del sistema.
 */
$(".sidebar .sidebar-menu a").click(function(event) {
    event.preventDefault();
    var permission  = $(this).data("permission");
    var url         = $(this).attr("href").split("/");
    var base        = '<?php echo base_url() ?>'.split('/');
    var base_folder = base[base.length-2];
    var index       = parseInt( $.inArray(base_folder, base) );

    var controller  = url[index+1];
    var action      = url[index+2];

    // Si el controlador no está definido, es porque es un elemento padre del menú.
    // No enlaza a ningún sitio. Solamente despiega o retrae submenú
    // Por lo tanto sólo tiene las acciones de Bootstap
    if( (typeof controller === "undefined") || (controller == '') ) {
        controller = '';
        action = 'index';
        if( typeof permission === "undefined" ) {
            permission = '';
        }
        console.log( "controlador no definido => no hace nada");
    } else {
        // Si el controlador está definido llamo a la vista correspondiente
        // verificando previamente que la accion y los permisos esten definidos.
        if( typeof action === "undefined" ) {
            action = 'index';
        }
        if( typeof permission === "undefined" ) {
            permission = '';
        }
        cargarView(controller, action, permission);
    }

    console.log( "controlador: "+controller);
    console.log( "metodo: "+action);
    console.log( "permisos: "+permission );
});

/**
 * Llama a la vista, mandando controlador, metodo y permisos
 */
function cargarView(controller, action, actions) {
    WaitingOpen();
    $('#content').empty();
    $("#content").load("<?php echo base_url(); ?>index.php/"+controller+"/"+action+"/"+actions);
    WaitingClose();
}
</script>