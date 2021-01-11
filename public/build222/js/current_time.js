// Update the count down every 1 second
var x = setInterval(function() {

    // Get today's date and time
    var now = new Date();

    // Time calculations
    var hours =  now.getHours();
    var minutes = now.getMinutes();

    // Display the result
    timer_display(hours, minutes);

}, 1000);

function timer_display(hours, minutes) {
    document.getElementById("current-time").innerHTML = hours + ":" + minutes;
}