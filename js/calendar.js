			$(document).ready(function() {

				 $( ".datepicker" ).datepicker({
				 	dateFormat: "yy-mm-dd",
					showOn: "button",
					showAnim: 'slideDown',
					showButtonPanel: true ,
					autoSize: true,
					buttonImage: "../images/calendar.png",
					buttonImageOnly: true,
					closeText: "Borrar"
				});
				$(document).on("click", ".ui-datepicker-close", function(){
					$('.datepicker').val("");
					dataTable.columns(2).search("").draw();
				});
				//CALENDAR
				
			} );

		//IDIOMA ESPAÑOL
		jQuery(function($) {
    	$.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: 'Atrás',
        nextText: 'Siguiente',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'
        ],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sabado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mie;', 'Juv', 'Vie', 'Sab'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S&aacute;'],
        weekHeader: 'Sm',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
});