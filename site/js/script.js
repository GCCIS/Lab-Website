$(document).ready(function(){
   if(typeof room !== 'undefined'){
	 $('#calendar').fullCalendar({
                defaultView: 'agendaWeek',
                eventBackgroundColor: "#FF4308",
                eventBorderColor: "#FF4308",
              //eventBackgroundColor: 'rgb(255, 56, 0)',
		        minTime: "08:00:00",
                maxTime: "22:00:00",
		        nowIndicator: true,
                header: false,
                themeSystem: 'bootstrap3',
                theme: 'darkly',
                allDaySlot: false,
                contentHeight: "auto",
                events: {
                            url: 'handlers/eventSchedules.php',
                                type: 'POST', // Send post data
                                data: {
                                        roomNum: room
                                },
                                error: function() {
                                        alert('There was an error while fetching events.');
                                }
                        }
        });
   }
	$('#taCalendar').fullCalendar({
                defaultView: 'agendaWeek',
                eventBackgroundColor: "#FF4308",
                minTime: "08:00:00",
                maxTime: "22:00:00",
                nowIndicator: true,
		        header: false,        
                themeSystem: 'bootstrap3',
                theme: 'darkly',
                allDaySlot: false,
		        contentHeight: "auto",
                events: {
                            url: 'handlers/taSchedule.php',
                            type: 'POST',
                            error: function(){
                                alert('There was an error while fetching ta events');
                    }
		}
	});
});
