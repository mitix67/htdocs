// HTML structure
const sliderContainer = document.querySelector('.slider-container');
const sliderImages = document.querySelectorAll('.slider-container-img');

// Slider settings
const slideDuration = 5000; // Duration of each slide in milliseconds
let currentSlide = 0;

// Function to show the next slide
function showNextSlide() {
    // Hide the current slide
    sliderImages[currentSlide].classList.remove('active');

    // Increment the current slide index
    currentSlide = (currentSlide + 1) % sliderImages.length;

    // Show the next slide
    sliderImages[currentSlide].classList.add('active');

    document.querySelectorAll('.thumbnail').forEach((thumb) => {
        thumb.classList.remove('active');
    });
    document.querySelectorAll('.thumbnail')[currentSlide].classList.add('active');
}


// Create the image thumbnails
const thumbnailContainer = document.createElement('div');
thumbnailContainer.classList.add('thumbnail-container');

sliderImages.forEach((image, index) => {
    // Create a thumbnail for each image
    const thumbnail = document.createElement('img');
    thumbnail.src = image.src;
    thumbnail.classList.add('thumbnail');

    // Add click event listener to each thumbnail
    thumbnail.addEventListener('click', () => {
        // Remove active class from all thumbnails
        document.querySelectorAll('.thumbnail').forEach((thumb) => {
            thumb.classList.remove('active');
        });

        // Add active class to the clicked thumbnail
        thumbnail.classList.add('active');

        // Show the corresponding slide
        sliderImages.forEach((slide) => {
            slide.classList.remove('active');
        });
        sliderImages[index].classList.add('active');
    });

    // Append the thumbnail to the thumbnail container
    thumbnailContainer.appendChild(thumbnail);
});

// Append the thumbnail container to the slider container
sliderContainer.appendChild(thumbnailContainer);

// Create the previous and next buttons
const prevButton = document.createElement('button');
prevButton.innerHTML = '<i class="fa-solid fa-chevron-left"></i>';
prevButton.classList.add('slider-button', 'prev-button');
prevButton.addEventListener('click', () => {
    // Show the previous slide
    sliderImages[currentSlide].classList.remove('active');
    currentSlide = (currentSlide - 1 + sliderImages.length) % sliderImages.length;
    sliderImages[currentSlide].classList.add('active');

    // Update the active thumbnail
    document.querySelectorAll('.thumbnail').forEach((thumb) => {
        thumb.classList.remove('active');
    });
    document.querySelectorAll('.thumbnail')[currentSlide].classList.add('active');
    
});


const nextButton = document.createElement('button');
nextButton.innerHTML = '<i class="fa-solid fa-chevron-right"></i>';
nextButton.classList.add('slider-button', 'next-button');
nextButton.addEventListener('click', () => {
    // Show the next slide
    sliderImages[currentSlide].classList.remove('active');
    currentSlide = (currentSlide + 1) % sliderImages.length;
    sliderImages[currentSlide].classList.add('active');

    // Update the active thumbnail
    document.querySelectorAll('.thumbnail').forEach((thumb) => {
        thumb.classList.remove('active');
    });
    document.querySelectorAll('.thumbnail')[currentSlide].classList.add('active');
});

// Append the buttons to the slider container
sliderContainer.appendChild(prevButton);
sliderContainer.appendChild(nextButton);

// Function to start the slider
function startSlider() {
    // Show the first slide
    sliderImages[currentSlide].classList.add('active');
    document.querySelectorAll('.thumbnail')[currentSlide].classList.add('active');
    // Set an interval to show the next slide
    const interval = setInterval(showNextSlide, slideDuration);
}

// Start the slider
startSlider();