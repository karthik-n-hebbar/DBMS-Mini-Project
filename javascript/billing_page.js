
var date = new Date();
var year = date.getFullYear();
var month = String(date.getMonth() + 1).padStart(2, '0');
var todayDate = String(date.getDate()).padStart(2, '0');
var datePattern = year + '-' + month + '-' + todayDate;
document.getElementById("date").value = datePattern;
// document.write(datePattern);

var hour = String(date.getHours()).padStart(2, '0');
var minutes = String(date.getMinutes()).padStart(2, '0');
var seconds = String(date.getSeconds()).padStart(2, '0');
var timePattern = hour + ':' + minutes + ':' + seconds;
document.getElementById("time").value = timePattern;
// document.write(timePattern);

function hey() {
    calc_amt()
}

function calc_amt() {
    var entry_point = document.getElementById('entry_point').value
    var exit_point = document.getElementById('exit_point').value

    switch (entry_point) {
        case 'Bannerghatta Road':
            if (exit_point == 'Mysore Road') {
                document.getElementById("amount").value = 60;
            }
            else if (exit_point == 'Kanakpura Road') {
                document.getElementById("amount").value = 35;
            } else {
                alert('Entry And Exit Are Same');
            }
            break;

        case 'Kanakpura Road':
            if (exit_point == 'Mysore Road') {
                document.getElementById("amount").value = 25;
            }
            else if (exit_point == 'Bannerghatta Road') {
                document.getElementById("amount").value = 35;
            } else {
                alert('Entry And Exit Are Same');
            }
            break;

        case 'Mysore Road':
            if (exit_point == 'Kanakpura Road') {
                document.getElementById("amount").value = 25;
            }
            else if (exit_point == 'Bannerghatta Road') {
                document.getElementById("amount").value = 60;
            } else {
                alert('Entry And Exit Are Same');
            }
            break;
    }
}
