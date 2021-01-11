// Set the time we're counting down to (before next session)
var currentTime = new Date().getTime();
var currentMinutes = Math.floor((currentTime % (1000 * 60 * 60)) / (1000 * 60));
var currentSeconds = Math.floor((currentTime % (1000 * 60)) / 1000);
var countDownTime = (60 * 60 - currentMinutes * 60 - currentSeconds) * 1000;
var countDownDate = currentTime + countDownTime;

// Display the default timer value
var elapsedMinutes = 60 - currentMinutes - 1;
timer_display(elapsedMinutes);

// Update the count down every 1 second
var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));

    // Display the result
    timer_display(minutes);

    // If the count down is finished
    if (distance < 0) {
        //clearInterval(x);
        // Set the next hour session
        countDownDate += 60 * 60 * 1000;
    }
}, 1000);

function timer_display(minutes) {
    document.getElementById("next-session-timer").innerHTML = minutes + " minutes";
}