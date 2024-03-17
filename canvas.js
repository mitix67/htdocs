var canvas = document.getElementById('canvas');
var ctx = canvas.getContext('2d');

var images = ['images/canvas/image1.png', 'images/canvas/image2.png', 'images/canvas/image3.png', 'images/canvas/image4.png'];
var loadedImages = [];
var currentImage = 0;
var nextImage = 1;
var x = 0;
var intervalId;
var isHovering = false;

images.forEach(function(src, index) {
    var img = new Image();
    img.src = src;
    img.onload = function() {
        loadedImages[index] = img;
        if (index === 0) {
            intervalId = setInterval(draw, 2);
        }
    };
});

canvas.addEventListener('mouseover', function() {
    isHovering = true;
    clearInterval(intervalId);
});

canvas.addEventListener('mouseout', function() {
    isHovering = false;
    intervalId = setInterval(draw, 2);
});

function draw() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    if (isHovering) {
        ctx.drawImage(loadedImages[currentImage], 0, 0, canvas.width, canvas.height);
    } else {
        ctx.drawImage(loadedImages[currentImage], x, 0, loadedImages[currentImage].width * (canvas.height / loadedImages[currentImage].height), canvas.height);
        ctx.drawImage(loadedImages[nextImage], x + loadedImages[currentImage].width, 0, loadedImages[nextImage].width * (canvas.height / loadedImages[nextImage].height), canvas.height);
        x--;
        if (x <= -loadedImages[currentImage].width){
            x = 0;
            currentImage = nextImage;
            nextImage = (nextImage + 1) % loadedImages.length;
        }
    }
}
