
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
        if (currentImageIndex === 0) {
            currentImageIndex = 3;
        } else {
            currentImageIndex = (currentImageIndex - 1) % images.length;
        }

        image.src = images[currentImageIndex];
    });

    nextButton.addEventListener('click', function () {
        currentImageIndex = (currentImageIndex + 1) % images.length;
        image.src = images[currentImageIndex];
    });
});

function openForm() {
    var form = document.getElementById('adoptForm');
    form.style.display = 'block';
}

function closeForm() {
    var form = document.getElementById('adoptForm');
    form.style.display = 'none';
}

function showLoginAlert() {
    alert('Do tejto sekcie sa musíte prihlásiť.');
}

function adoptedAlert() {
    alert('Toto zvieratko už máte v adopcií.');
}

document.addEventListener('DOMContentLoaded', function () {
    var addToCartButton = document.getElementById('cartButton');
    addToCartButton.addEventListener('click', addToCart);
});

function addToCart() {
    console.log('addToCart function called');
    var quantity = document.getElementById('quantity').value;
    var form = document.getElementById('addToCartForm');
    form.querySelector("input[name='quantity']").value = quantity;
    form.submit();
}

document.addEventListener("DOMContentLoaded", function () {
    // Function to handle form submission using AJAX
    function cancelAdoptionAjax(adoptionId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "App/Models/CancelAdoption.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Update the content after successful cancellation
                var adoptionContainer = document.getElementById("adoption" + adoptionId);
                adoptionContainer.parentNode.removeChild(adoptionContainer);
            }
        };

        xhr.send("cancelAdoption=" + adoptionId);
    }

    // Attach event listener to all cancel adoption forms
    var cancelAdoptionForms = document.querySelectorAll(".cancelAdoptionForm");
    cancelAdoptionForms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
        var adoptionId = form.querySelector("input[name='cancelAdoption']").value;
        cancelAdoptionAjax(adoptionId);
        });
    });
});

