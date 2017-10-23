$(document).ready(function(){
	$('#calendar').fullCalendar({
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
