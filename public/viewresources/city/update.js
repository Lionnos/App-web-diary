'use strict';

$(() =>
{
	$('#frmCityInsert').formValidation(
	{
		framework: 'bootstrap',
		excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
		live: 'enabled',
		message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
		trigger: null,
		fields:
		{
			txtName:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">Este campo es requerido.</b>'
					}
				}
			}
		}
	});
});


function updateCity(idCity) {

    var isValid = null;
    const newName = $('#txtName').val();


    swal({
        title: 'Confirmar operación',
        text: '¿Realmente desea proceder?',
        icon: 'warning',
        buttons: ['No, cancelar.', 'Si, proceder.']
    }).then((proceed) => {
        if (proceed) {
            $.ajax({
                url: _urlBase + '/city/update/' + idCity,
                method: 'POST',
                data: { txtName: newName },
                success: function(response) {

                    //window.location.href = _urlBase + '/city/update/' + idCity;
					window.location.reload();
                },

                error: function(xhr, status, error) {
					new PNotify({
						title: 'Error',
						text: 'La ciudad ya esta registrada.',
						type: 'error'
					});
                }
            });
        }
        
    });
}


function showEditModal(idCity, cityName) {
    $('#txtName').val(cityName);
    $('#editCityModal').data('idCity', idCity);
    $('#editCityModal').modal('show');
}