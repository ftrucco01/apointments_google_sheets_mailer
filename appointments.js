$(document).ready(function(){
    $('#origin').change(function(){
        if($(this).val() === 'internal'){
            $('#registrationGroup').show();
        } else {
            $('#registrationGroup').hide();
            $('#registration').val('');
        }
    });

    $('#appointmentForm').submit(function(e){
        $('.spinner-container').show();
        e.preventDefault();

        $.ajax({
            type: 'POST',
            url: 'add-apointment.php',
            data: $(this).serialize(),
            success: function(response){
                $('#appointmentForm')[0].reset();
                $('#messageContainer').html('<div class="alert alert-success">Cita agendada con éxito</div>').show();
                $('.spinner-container').hide();
            },
            error: function(){
                $('#messageContainer').html('<div class="alert alert-danger">Error al agendar la cita</div>').show();
                $('.spinner-container').hide();
            }
        });
    });

    function populateAppointmentTimes(checkupType) {
        let interval = checkupType === 'work' ? 30 : 15;
        let timeOptions = '';
        for (let hour = 7; hour <= 15; hour++) {
            let maxMinutes = (hour === 15) ? 0 : 60;
            for (let minutes = 0; minutes < maxMinutes; minutes += interval) {
                let timeString = hour.toString().padStart(2, '0') + ':' + minutes.toString().padStart(2, '0');
                timeOptions += `<option value="${timeString}">${timeString}</option>`;
            }
        }
        $('#appointmentTime').html(timeOptions);
    }


    $('#checkup').change(function(){
        populateAppointmentTimes($(this).val());
    });

    populateAppointmentTimes($('#checkup').val());

    $("#date").datepicker({
        beforeShowDay: function(date) {
          var day = date.getDay();
          return [(day != 0), '']; // Deshabilita los domingos
        }
      });

});