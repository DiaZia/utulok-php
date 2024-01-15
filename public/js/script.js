function changeColor(element) {
    var randomColor = '#' + Math.floor(Math.random() * 16777215).toString(16);
    element.style.color = randomColor;
}

document.addEventListener('DOMContentLoaded', function() {
    var statsElements = document.querySelectorAll('.stat');

    statsElements.forEach(function (element) {
        element.addEventListener('mouseout', function () {
            element.style.color = '';
        });
    })
})


function imageEnlarge(element) {
    element.classList.add('enlarged');

    setTimeout(function () {
        element.classList.remove('enlarged');
    }, 300);
}


document.addEventListener('DOMContentLoaded', function () {
    const image = document.querySelector('.pet-carousel-image');
    const prevButton = document.querySelector('.arrow.prev');
    const nextButton = document.querySelector('.arrow.next');



    let currentImageIndex = 0;
    var path = "public/images/pic" + petId + "/obrazok" + petId;
    var images = [path + ".jpg", path + ".1.jpg",
        path + ".2.jpg", path + ".3.jpg"];


    prevButton.addEventListener('click', function () {
        currentImageIndex = (currentImageIndex - 1) % images.length;
        image.src = images[currentImageIndex];
    });

    nextButton.addEventListener('click', function () {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        image.src = images[currentImageIndex];
    });
});
