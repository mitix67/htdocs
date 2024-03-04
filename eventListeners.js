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