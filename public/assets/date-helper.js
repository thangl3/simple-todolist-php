// This script is released to the public domain and may be used, modified and
// distributed without restrictions. Attribution not necessary but appreciated.
// Source: https://weeknumber.net/how-to/javascript

// Returns the ISO week of the date.
Date.prototype.getWeek = function () {
    let date = new Date(this.getTime());
    date.setHours(0, 0, 0, 0);

    // Thursday in current week decides the year.
    date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);

    // January 4 is always in week 1.
    let week1 = new Date(date.getFullYear(), 0, 4);

    // Adjust to Thursday in week 1 and count number of weeks from date to week1.
    return 1 + Math.round(
        ((date.getTime() - week1.getTime()) / 86400000 - 3 + (week1.getDay() + 6) % 7) / 7
    );
}

// Returns the four-digit year corresponding to the ISO week of the date.
Date.prototype.getWeekYear = function() {
    let date = new Date(this.getTime());
    date.setDate(date.getDate() + 3 - (date.getDay() + 6) % 7);

    return date.getFullYear();
}

Date.prototype.getDateString = function () {
    let today = new Date(this.valueOf());

    let dd = today.getDate();
    let mm = today.getMonth() + 1; //January is 0!
    let yyyy = today.getFullYear();

    if(dd < 10) {
        dd = '0' + dd
    } 

    if(mm < 10) {
        mm = '0' + mm
    } 

    return yyyy + '-' + mm + '-' + dd;
}