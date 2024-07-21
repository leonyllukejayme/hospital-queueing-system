function date_time() {
    let date = new Date();

    let options = { month: "long", day: "numeric", year: "numeric" };
    let formatDate = date.toLocaleDateString("en-US", options);
    let hours = date.getHours();
    let minutes = date.getMinutes();
    let seconds = date.getSeconds();

    // Check whether AM or PM
    let newformat = hours >= 12 ? "PM" : "AM";

    // Find current hour in AM-PM Format
    hours = hours % 12;

    // To display "0" as "12"
    hours = hours ? hours : 12;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    document.getElementById("date").innerHTML = formatDate;
    document.getElementById("time").innerHTML =
        hours + ":" + minutes + ":" + seconds + " " + newformat;
        setTimeout(date_time, 1000);
    }
