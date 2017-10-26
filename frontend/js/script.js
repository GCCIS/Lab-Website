$(document).ready(function(){
	$('#calendar').fullCalendar({
                header: false,
                themeSystem: 'bootstrap3',
                theme: 'darkly',
                defaultView: 'basicWeek',
                events: {
                	url: 'handlers/eventSchedules.php',
                        type: 'POST', // Send post data
                        error: function() {
                                alert('There was an error while fetching events.');
                        }
                }
	});
});
