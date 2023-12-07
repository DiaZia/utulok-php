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


function animateText() {
    var textElement = document.getElementById('animatedText');
    textElement.style.animation = 'bounce 1s ease';
}

document.getElementById('animatedText').addEventListener('mouseover', animateText);

function imageChange(element) {
    var petIndex = element.dataset.petIndex;

    var currentImageIndex = parseInt(element.alt);
    var path = "public/images/pic" + petIndex + "/obrazok" + petIndex;
    var images = [path + ".jpg", path + ".1.jpg",
        path + ".2.jpg", path + ".3.jpg"];

    currentImageIndex = (currentImageIndex + 1) % images.length;
    element.src = images[currentImageIndex];
    element.alt = currentImageIndex;
}