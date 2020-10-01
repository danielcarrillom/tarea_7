

			$(document).ready(function() {
				var dataTable = $('#employee-grid').DataTable( {
					"processing": true,
					"serverSide": true,
					"ajax":{
						/*HACE POSIBLE LA VISTA DE DATOS EN EL MANTENEDOR*/
						type: "post",
						url :"sc/historial_clinico_ajax.php", 
						error: function(){  
							$(".employee-grid-error").html("");
							$("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="8">No se encontraron registros.</th></tr></tbody>');
							$("#employee-grid_processing").css("display","none");
							
						}
					}
				} );
				
				$("#employee-grid_filter").css("display","none");  
				$('.search-input-text').on( 'keyup click', function () {  
					var i =$(this).attr('data-column');  
					var v =$(this).val(); 
					dataTable.columns(i).search(v).draw();
				} );
				$('.search-input-select').on( 'change', function () {  
					var i =$(this).attr('data-column');  
					var v =$(this).val();  
					dataTable.columns(i).search(v).draw();
				} );
				
			} );

