var totalImporte;

// configura una enlace "Agregar una etiqueta"
var $addDetFacLink = $('<a href="#" type="button" class="add_detFac_link pull-right btn btn-info">Añadir detalle</a>');
var $newLinkLi = $('<li></li>').append($addDetFacLink);

$(document).ready(function() {
        
        totalImporte = 0;
        ocultarMostrarCheque();
        cambioDeValorImporteSerie();
        cambioDeValorModalidad(); 
        
    $('.js-datepicker').datepicker({
        });
       
        // Obtiene la ul que contiene la colección de etiquetas
        var collectionHolder = $('ul.det-fact');

        // Añade el ancla "Agregar una etiqueta" y las etiquetas li y ul
        collectionHolder.append($newLinkLi);

        // cuenta las entradas actuales en el formulario (p. ej. 2),
        // la usa como índice al insertar un nuevo elemento (p. ej. 2)
        collectionHolder.data('index', collectionHolder.find(':input').length);

        $addDetFacLink.on('click', function (e) {

            // evita crear el enlace con una "#" en la URL
            e.preventDefault();

            // añade un detalleFactura form (ve el siguiente bloque de código)
            addDetForm(collectionHolder, $newLinkLi);
       
        });
        
    
        
        
});

function ocultarMostrarCheque() {

    $('select#aduanabundle_factura_modalidad').on('change', function () {
       
        valor = $(this).val();
        
        if (valor == 1) {

            $("#cheques").addClass("hidden");
            $("#modalidad").addClass("hidden");
            $("#aduanabundle_factura_bancoModalidad").addClass("hidden");
            $("#numModalidad").removeClass("hidden");
             quitarChequeTotal();
            
       
        } else if(valor == 2) {
           
            $("#modalidad").removeClass("hidden");
            $("#aduanabundle_factura_bancoModalidad").addClass("hidden");
            $("#numModalidad").addClass("hidden");
            $("#cheques").removeClass("hidden");
            quitarModEfectivoTotal();
        
        }else if(valor == 3) {
           
            $("#modalidad").removeClass("hidden");
            $("#aduanabundle_factura_bancoModalidad").removeClass("hidden");
            $("#numModalidad").addClass("hidden");
            $("#cheques").addClass("hidden");
        
        } 
    
    });

}

function agregarDetallesDeFactura() {

    // Añade el ancla "Agregar una etiqueta" y las etiquetas li y ul
    collectionHolder.append($newLinkLi);

    // cuenta las entradas actuales en el formulario (p. ej. 2),
    // la usa como índice al insertar un nuevo elemento (p. ej. 2)
    collectionHolder.data('index', collectionHolder.find(':input').length);

    $addDetFacLink.on('click', function (e) {

        // evita crear el enlace con una "#" en la URL
        e.preventDefault();

        // añade un detalleFactura form (ve el siguiente bloque de código)
        addDetForm(collectionHolder, $newLinkLi);
    });
}

function addDetForm(collectionHolder, $newLinkLi) {

    // Obtiene los datos del prototipo explicado anteriormente
    var prototype = collectionHolder.data('prototype');

    // Consigue el nuevo índice
    var indice = collectionHolder.data('index');

    // Sustituye el '__name__' en el prototipo HTML para que
    // en su lugar sea un número basado en cuántos elementos hay
    var newForm = prototype.replace(/__name__/g, indice);

    // Incrementa en uno el índice para el siguiente elemento
    collectionHolder.data('index', indice + 1);


    // Muestra el formulario en la página en un elemento li,
    // antes del enlace 'Agregar una etiqueta'
    var $newFormLi = $('<li></li>').append(newForm);

    $newLinkLi.before($newFormLi);
    
    sumarTotalImporte();

    // add a delete link to the new form
    addDetFormDeleteLink($newFormLi);
   
}

function addDetFormDeleteLink($tagFormLi) {

    var $removeFormButton = $('<button type="button" class="btn btn-danger">Eliminar</button>');

    $tagFormLi.append($removeFormButton);

    $removeFormButton.on('click', function (e) {
        
        // remove the li for the tag form
        var subImporte = parseInt($("input[id*='aduanabundle_factura_detallesFactura_'][id$='subtotal']").val());
        borrarlineaImporte(subImporte);
        $tagFormLi.remove();
    });
}

function sumarTotalImporte() {

    var invoices_total = function () {

        var invoice_amounts = $("input[id*='aduanabundle_factura_detallesFactura_'][id$='subtotal']");
        var total = 0;
        
        invoice_amounts.each(function (idx) {
            
            if (!isNaN(parseInt($(this).val()))) {
               
                total += parseInt($(this).val());
            
            }
        
        });
        
        return total;
    };

   
        $("input[id*='aduanabundle_factura_detallesFactura_'][id$='subtotal']").each(function (idx) {
                  
            $(this).on('change', function () {
                

                if(!isNaN(parseInt($(this).val()) ) ){
                   
                   totalImporte +=  invoices_total();
              
                } else {
                
                    totalImporte +=  invoices_total() + parseInt($('#aduanabundle_factura_total').val());
               
                }   
                
                $('#aduanabundle_factura_total').val(totalImporte);
            
            });
        });
   





}

function borrarlineaImporte(importe){
    
    totalImporte =  totalImporte - importe;
    
    if(totalImporte >= 0){
        
        $('#aduanabundle_factura_total').val(totalImporte);
   
    } else {
    
        var valor = 0;
        
        $('#aduanabundle_factura_total').val(valor);
    }
        
   
    
    
}

function quitarModEfectivoTotal(){
    
    var valor =   parseInt($("#aduanabundle_factura_numeroModalidad").val());
    
    if(valor > 0 || !isNaN(valor)){
          totalImporte =  totalImporte - valor;
          $('#aduanabundle_factura_total').val(totalImporte);
          $("#aduanabundle_factura_numeroModalidad").val("");
    }
}

function quitarChequeTotal(){
    
    var valor =   parseInt( $("#aduanabundle_factura_importe").val());
    
    if(valor > 0 || !isNaN(valor)){
        
          totalImporte =  totalImporte - valor;
          $('#aduanabundle_factura_total').val(totalImporte);
          $("#aduanabundle_factura_importe").val("");
   
    }
}

function cambioDeValorModalidad() {

 
        $("#aduanabundle_factura_numeroModalidad").each(function () {
            
            $(this).on('change', function () {
                totalImporte += parseInt($(this).val());
                $('#aduanabundle_factura_total').val(totalImporte);
            });
        });
   

}

function cambioDeValorImporteSerie() {
 
        $("#aduanabundle_factura_importe").each(function () {
            
            $(this).on('change', function () {
                
                totalImporte += parseInt($(this).val());
                $('#aduanabundle_factura_total').val(totalImporte);
            });
        });
   

}