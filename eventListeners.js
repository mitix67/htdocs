
if (document.getElementById('brand') != null) {
document.getElementById('brand').addEventListener('change', function() {
    var brand = this.value;
    var model = document.getElementById('model');
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'functions.php?brand=' + brand, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            model.innerHTML = xhr.responseText;
        }
    }
    xhr.send();
});

document.getElementById('sendMessageButton').addEventListener('click', function() {
    document.getElementById('playground').innerHTML = '';
});

}
let months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

function convertDateNameToNumber(dateName) {
    const monthIndex = months.findIndex(month => month.toLowerCase() === dateName.toLowerCase());
    return monthIndex !== -1 ? monthIndex + 1 : null;
}

if(document.getElementById('calendar-btn-left') != null) {
    document.getElementById('calendar-btn-left').addEventListener('click', function() {
        var date = document.getElementById('month-year');
        date = date.innerHTML.split(' ');
        var month = date[0];

        var currentDate = new Date();
        month = convertDateNameToNumber(month) - 1;
        console.log(month);
        currentDate.setMonth(month);
        var year = currentDate.getFullYear();
        var day = currentDate.getDate();
        var formattedDate = year + '-' + month + '-' + day;
        // Send the formattedDate to index.html or perform any other desired action
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var doc = document.querySelector('html');
                doc.innerHTML = xhr.responseText;
            }
        }
        xhr.send('formattedDate=' + formattedDate);
    });

    document.getElementById('calendar-btn-right').addEventListener('click', function() {
        var date = document.getElementById('month-year');
        date = date.innerHTML.split(' ');
        var month = date[0];

        var currentDate = new Date();
        month = convertDateNameToNumber(month) + 1;
        console.log(month);
        currentDate.setMonth(month);
        var year = currentDate.getFullYear();
        var day = currentDate.getDate();
        var formattedDate = year + '-' + month + '-' + day;
        // Send the formattedDate to index.html or perform any other desired action
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'index.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var doc = document.querySelector('html');
                doc.innerHTML = xhr.responseText;
            }
        }
        xhr.send('formattedDate=' + formattedDate);
    });
}