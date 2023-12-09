function convertTimeToMinutes(timeString) {
    // Split the time string into an array of hours, minutes, and seconds.
    const timeArray = timeString.split(':');
  
    // Convert the hours and seconds to minutes.
    const hoursInMinutes = parseInt(timeArray[0]) * 60;
    const secondsInMinutes = parseInt(timeArray[2]);
  
    // Calculate the total number of minutes in the time string.
    const totalMinutes = hoursInMinutes + parseInt(timeArray[1]) + secondsInMinutes;
  
    // Return the total number of minutes.
    return totalMinutes;
  }