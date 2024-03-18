
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

    document.getElementById('sendMessageButton2').addEventListener('click', function() {
        document.getElementById('playground').innerHTML = '';
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'functions.php?brand=0', true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('playground').innerHTML = xhr.responseText;
            }
        }
        xhr.send();
    });
}

var isFirst = true;

function generateCalendarById(id) {
    if(document.getElementById('calendar-btn-left') != null) {

        var date;
        
        console.log(id);

        if (document.getElementById('month-year') == null) 
        {
            console.log('month-year is null');
            date = new Date();
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'calendar.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var doc = document.getElementById('calendar-container');
                    doc.innerHTML = xhr.responseText;
                }
            }
            var actualDate = new Date();
            var tempMonth = actualDate.getMonth() + 1;
            var formattedDate = actualDate.getFullYear() + '-' + tempMonth + '-' + actualDate.getDate();
            xhr.send('formattedDate=' + formattedDate + '&id=' + id);
        }
        else
        {
            date = document.getElementById('month-year');
            date = date.innerHTML.split(' ');
            var month = date[0];
        }
        var elementLeft = document.getElementById('calendar-btn-left');
        elementLeft.addEventListener('click', elementLeft.fn=function() {
            month = date.getMonth() - 1;
            if (month < 0) 
            {
                month = 11;
                date.setFullYear(date.getFullYear() - 1);
            }
            date.setMonth(month);
            console.log(month);
            var year = date.getFullYear();
            var day = date.getDate();
            var formattedDate = year + '-' + month + '-' + day;
            
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'calendar.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var doc = document.getElementById('calendar-container');
                    doc.innerHTML = xhr.responseText;
                }
            }
            xhr.send('formattedDate=' + formattedDate + '&id=' + id);
        });

        var elementRight = document.getElementById('calendar-btn-right');

        elementRight.addEventListener('click', elementRight.fn=function() {
            if (isFirst) {
                month = date.getMonth() + 2;
                isFirst = false;
            }
            else
                month = date.getMonth() + 1;
            if (month > 11) 
            {
                month = 0;
                date.setFullYear(date.getFullYear() + 1);
            }
            date.setMonth(month);
            var year = date.getFullYear();
            var day = date.getDate();
            var formattedDate = year + '-' + month + '-' + day;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'calendar.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var doc = document.getElementById('calendar-container');
                    doc.innerHTML = xhr.responseText;
                }
            }
            xhr.send('formattedDate=' + formattedDate + '&id=' + id);
        });
    }
}

if (document.getElementById('admin-panel-container') != null) {

    var date;
    
    if (document.getElementById('month-year') == null) 
    {
        console.log('month-year is null');
        date = new Date();
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'calendar.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var doc = document.getElementById('admin-panel-container');
                doc.innerHTML = xhr.responseText;
            }
        }
        var actualDate = new Date();
        var tempMonth = actualDate.getMonth() + 1;
        var formattedDate = actualDate.getFullYear() + '-' + tempMonth + '-' + actualDate.getDate();
        xhr.send("formattedDate=" + formattedDate + "&id=" + 5);
    }
    else
    {
        date = document.getElementById('month-year');
        date = date.innerHTML.split(' ');
        var month = date[0];
    }

    document.getElementById('calendar-btn-left-admin').addEventListener('click', function() {
        month = date.getMonth() - 1;
        if (month < 0) 
        {
            month = 11;
            date.setFullYear(date.getFullYear() - 1);
        }
        date.setMonth(month);
        console.log(month);
        var year = date.getFullYear();
        var day = date.getDate();
        var formattedDate = year + '-' + month + '-' + day;
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'calendar.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
            var doc = document.getElementById('admin-panel-container');
            doc.innerHTML = xhr.responseText;
            }
        }
        xhr.send('formattedDate=' + formattedDate + '&id=' + 5);
    });

    document.getElementById('calendar-btn-right-admin').addEventListener('click', function() {
        if (isFirst) {
            month = date.getMonth() + 2;
            isFirst = false;
        }
        else
            month = date.getMonth() + 1;
        if (month > 11) 
        {
            month = 0;
            date.setFullYear(date.getFullYear() + 1);
        }
        date.setMonth(month);
        var year = date.getFullYear();
        var day = date.getDate();
        var formattedDate = year + '-' + month + '-' + day;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'calendar.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var doc = document.getElementById('admin-panel-container');
                doc.innerHTML = xhr.responseText;
            }
        }
        xhr.send('formattedDate=' + formattedDate + '&id=' + 5);
    });
}

var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];


function convertMonthToInt(month) {
    var monthIndex = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'].indexOf(month);
    return monthIndex + 1;
}

var index = 0;
var startDate = new Date();
var endDate = new Date();
if (document.getElementById('calendar-container') != null) {
    function getDateFromButton(event){
        var date = event.innerHTML;
        date = date.substring(6, date.indexOf('</span>'));
        var calendarDate = document.getElementById('month-year').innerHTML;
        var month = calendarDate.split(' ')[0];
        month = convertMonthToInt(month);
        var year  = calendarDate.split(' ')[1];

        if (month < 10) {
            month = '0' + month;
        }

        if (date < 10) {
            date = '0' + date;
        }

        console.log(date);
        console.log(month);
        console.log(year);

        var formattedDate = year + '-' + month + '-' + date;

        var dateJS = new Date(year, month - 1, date);
        var today = new Date();

        if (event.querySelector('div') != null || event.querySelector('div') != null)
        {
            alert('W tej dacie już istnieje rezerwacja');
            return 0;
        }

        console.log(document.getElementById('reservation-date-start').querySelector('div') != null || document.getElementById('reservation-date-stop').querySelector('div') != null);

        if (index == 0)
        {
            if (dateJS < today) {
                alert('Nie możesz wybrać daty z przeszłości!');
            }
            else
            {
                clearColors();
                startDate = dateJS;
                event.style.backgroundColor = '#2c7aca';
                event.style.color = 'white';
                document.getElementById('reservation-date-start').value = formattedDate;
                event.setAttribute('data-date', startDate);
                index++;
            }
        }
        else
        {
            endDate = dateJS;
            if (startDate < endDate) {
                event.style.backgroundColor = '#2c7aca';
                event.style.color = 'white';
                event.setAttribute('data-date', endDate);
                document.getElementById('reservation-date-stop').value = formattedDate;

                if (startDate.getMonth() != endDate.getMonth()) {
                    var divs = getDivsUntilEndDate(endDate);
                    if (divs == 0)
                    {
                        alert('W tej dacie już istnieje rezerwacja!');
                        index = 0;
                        document.getElementById('reservation-date-start').value = null;
                        document.getElementById('reservation-date-stop').value = null;
                        clearColors();
                    }
                    else
                        setColorForDivsBetween(divs);
                    
                }
                else
                {
                    var divs = getDivsWithColorBetween(startDate, endDate);
                    if (divs === 0)
                    {
                        alert('W tej dacie już istnieje rezerwacja!');
                        index = 0;
                        document.getElementById('reservation-date-start').value = null;
                        document.getElementById('reservation-date-stop').value = null;
                        clearColors();
                    }
                    else
                        setColorForDivsBetween(divs);
                }
                index = 0;
            }
            else
            {
                alert('End date must be after start date');
            }

        }
    }
}
else{
    function getDateFromButton(event){}
}

function setReservationOverlay(event, id) {
    document.getElementById('reservation').style.display = 'block';
    document.getElementById('whole-body').style.display = 'none';
    document.getElementById('footer').style.display = 'none';
    document.getElementById('whole-body').style.opacity = 0.5;
    document.getElementById('whole-body').style.backgroundColor = "gray";
    document.getElementById('reservation').style.opacity = 0.9;
    document.getElementById('whole-body').style.filter = "blur(10px)";

    generateCalendarById(id);

    var img = document.getElementById('id=' + id).getAttribute('src');
    var textToGen = '<img src="' + img + '" style="width: 50%; height: 50%; object-fit: cover;">';
    console.log(textToGen);

    var divToGenerate = '<div class="form-group d-none"><input type="number" class="form-control" id="id" name="id_samochodu" value="' + id + '"required> </div>'

    document.getElementById('generate-id-here').innerHTML += textToGen;
    document.getElementById('generate-id-here').innerHTML += divToGenerate;
    console.log('overlay!');
}


function disableReservationOverlay() {
    document.getElementById('reservation').style.display = 'none';
    document.getElementById('whole-body').style.display = 'block';
    document.getElementById('footer').style.display = 'block';
    document.getElementById('whole-body').style.opacity = 1;
    document.getElementById('whole-body').style.backgroundColor = "";
    document.getElementById('reservation').style.opacity = 0;
    document.getElementById('whole-body').style.filter = "";

    var elementLeft = document.getElementById('calendar-btn-left');
    elementLeft.removeEventListener('click', elementLeft.fn);

    var elementRight = document.getElementById('calendar-btn-right');
    elementRight.removeEventListener('click', elementRight.fn);
    document.getElementById('calendar-container').innerHTML = "";
    document.getElementById('generate-id-here').innerHTML = "";
}


function getDivsWithColorBetween(startDate, endDate) {
    var divs = document.querySelectorAll('.day_num');
    var result = [];
    var pushDivs = false;
    var isNotNull = false;
    divs.forEach((div) => {

        var color = div.style.color;

        var date = new Date(div.getAttribute('data-date'));

        if (color === 'white') {
            console.log(endDate);

            if (date.toString() === endDate.toString()) {
                pushDivs = false;
            }

            if (date.toString() === startDate.toString()) {
                pushDivs = true;
            }
        }
        if (pushDivs == true) {
            result.push(div);
            if (div.querySelector('div') != null)
            {
                isNotNull = true;
            }
        }

    });
    if (isNotNull == true)
        result = 0;
    
    return result;
}

function setColorForDivsBetween(divs) {
    divs.forEach((div) => {

        if (div.className == 'day_num ignore') {
            div.style.backgroundColor = '#64affd';
            div.style.color = 'white';
        }
        else{
            div.style.backgroundColor = '#2c7aca';
            div.style.color = 'white';
        }

    });
}

function clearColors() {
    var divs = document.querySelectorAll('.day_num');
    divs.forEach((div) => {
        div.style.backgroundColor = '';
        div.style.color = '';
    });
}

function getDivsUntilEndDate(endDate) {
    var divs = document.querySelectorAll('.day_num');
    var result = [];
    var pushDivs = true;
    var isNotNull = false;

    divs.forEach((div) => {
        var date = new Date(div.getAttribute('data-date'));

        if (div.querySelector('div') != null)
        {
            isNotNull = true;
        }

        if (pushDivs) {
            result.push(div);
        }

        if (date.toString() === endDate.toString()) {
            pushDivs = false;
        }
    });
    console.log(result);

    if (isNotNull == true)
        result = 0;
    return result;
}

if (document.getElementById('form-add-image-file-field') != null) {
    document.getElementById('form-add-image-file-field').addEventListener('click', function() {
        var container = document.getElementById('form-add-image-file-container');
        var input = '<input type="file" class="form-control" id="imagesPath" name="imagesPath[]">';

        container.innerHTML += input;

    });
}

if (document.getElementById('calendar-btn-left-display') != null) {

    var date;
    
    var id = document.getElementById('calendar-btn-right-display').getAttribute('data-id');
    console.log(id);

    if (document.getElementById('month-year') == null) 
    {
        console.log('month-year is null');
        date = new Date();
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'calendar.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var doc = document.getElementById('display-panel-container');
                doc.innerHTML = xhr.responseText;
            }
        }
        var actualDate = new Date();
        var tempMonth = actualDate.getMonth() + 1;
        var formattedDate = actualDate.getFullYear() + '-' + tempMonth + '-' + actualDate.getDate();
        xhr.send("formattedDate=" + formattedDate + "&id=" + id);
    }
    else
    {
        date = document.getElementById('month-year');
        date = date.innerHTML.split(' ');
        var month = date[0];
    }

    document.getElementById('calendar-btn-left-display').addEventListener('click', function() {
        month = date.getMonth() - 1;
        if (month < 0) 
        {
            month = 11;
            date.setFullYear(date.getFullYear() - 1);
        }
        date.setMonth(month);
        console.log(month);
        var year = date.getFullYear();
        var day = date.getDate();
        var formattedDate = year + '-' + month + '-' + day;
        
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'calendar.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
            var doc = document.getElementById('display-panel-container');
            doc.innerHTML = xhr.responseText;
            }
        }
        xhr.send('formattedDate=' + formattedDate + '&id=' + id);
    });

    document.getElementById('calendar-btn-right-display').addEventListener('click', function() {
        if (isFirst) {
            month = date.getMonth() + 2;
            isFirst = false;
        }
        else
            month = date.getMonth() + 1;
        if (month > 11) 
        {
            month = 0;
            date.setFullYear(date.getFullYear() + 1);
        }
        date.setMonth(month);
        var year = date.getFullYear();
        var day = date.getDate();
        var formattedDate = year + '-' + month + '-' + day;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'calendar.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var doc = document.getElementById('display-panel-container');
                doc.innerHTML = xhr.responseText;
            }
        }
        xhr.send('formattedDate=' + formattedDate + '&id=' + id);
    });
}