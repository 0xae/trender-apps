define(function() {
    var measures = {
        second: 1,
        minute: 60,
        hour: 3600,
        day: 86400,
        week: 604800,
        month: 2592000,
        year: 31536000
    };
    
    var chkMultiple = function(amount, type) {
        return (amount > 1) ? amount + " " + type + "s":"a " + type;
    };

    return function(thedate) {
        var dateStr, amount, denomination,
            current = new Date().getTime(),
            diff = (current - thedate.getTime()) / 1000; // work with seconds
            
        if(diff > measures.year) {
            denomination = "year";
        } else if(diff > measures.month) {
            denomination = "month";
        } else if(diff > measures.week) {
            denomination = "week";
        } else if(diff > measures.day) {
            denomination = "day";
        } else if(diff > measures.hour) {
            denomination = "hour";
        } else if(diff > measures.minute) {
            denomination = "minute";
        } else {
            dateStr = "a few seconds ago";
            return dateStr;
        }
        amount = Math.round(diff/measures[denomination]);
        dateStr = "about " + chkMultiple(amount, denomination) + " ago";
        return dateStr;
    };
});
