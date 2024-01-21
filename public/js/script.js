
function changeColor(element) {
    element.style.color = '#' + Math.floor(Math.random() * 16777215).toString(16);
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
    var addInput = document.createElement('input');
    addInput.type = 'hidden';
    addInput.name = 'add';
    addInput.value = 'true';
    form.appendChild(addInput);
    form.querySelector("input[name='quantity']").value = quantity;
    form.querySelector("input[name='add']").value = true;
    form.submit();
}

document.addEventListener("DOMContentLoaded", function () {
    // Function to handle form submission using AJAX
    function cancelAdoptionAjax(adoptionId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "App/Helpers/CancelAdoption.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var adoptionContainer = document.getElementById("adoption" + adoptionId);
                adoptionContainer.parentNode.removeChild(adoptionContainer);
            }
        };

        xhr.send("cancelAdoption=" + adoptionId);
    }

    var cancelAdoptionForms = document.querySelectorAll(".cancelAdoptionForm");
    cancelAdoptionForms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
        var adoptionId = form.querySelector("input[name='cancelAdoption']").value;
        cancelAdoptionAjax(adoptionId);
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    function deleteProductAjax(productId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "App/Helpers/DeleteProduct.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var productContainer = document.getElementById("cart" + productId);
                    productContainer.parentNode.removeChild(productContainer);

                }
            }
        };

        xhr.send("deleteProduct=" + productId);
        updateTotalPrice();
    }

    var deleteProductForms = document.querySelectorAll(".deleteProductForm");
    deleteProductForms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            var productId = form.querySelector("input[name='deleteProduct']").value;
            deleteProductAjax(productId);
        });
    });
});

function updateTotalPrice() {
    var userId = document.querySelector(".cart").getAttribute("data-cart-userId");
    var xhr = new XMLHttpRequest()
    xhr.open("POST", "App/Helpers/CalculatePrice.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var totalPriceElement = document.getElementById("totalPrice");
            var responseJson = JSON.parse(xhr.responseText);
            var totalPrice = responseJson.totalPrice.toFixed(2);
            totalPriceElement.innerHTML = 'Cena spolu: ' + totalPrice + ' €';
        }
    };

    xhr.send("userId=" + userId);
}
document.addEventListener("DOMContentLoaded", function () {
    var quantityInputs = document.querySelectorAll(".quantity-input");

    quantityInputs.forEach(function (input) {
        input.addEventListener("change", function () {
            var cartId = input.getAttribute("data-cart-id");
            var newQuantity = input.value;
            updateQuantity(cartId, newQuantity);
        });
    });

    function updateQuantity(cartId, newQuantity) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "App/Helpers/ChangeQuantity.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");


        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log("Quantity updated successfully");
            } else {
                console.error("Failed to update quantity");
            }
            updateTotalPrice();
        };

        xhr.send("cartId=" + cartId + "&newQuantity=" + newQuantity);
    }

})

document.addEventListener("DOMContentLoaded", function () {
    function orderAjax(userId) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "App/Helpers/OrderProducts.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        var orderId= null;
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                    var responseJson = JSON.parse(xhr.responseText);
                    orderId = responseJson.orderId;

                    if (orderId !== null) {
                        var xhr2 = new XMLHttpRequest();
                        xhr2.open("POST", "App/Helpers/DeleteCart.php", true);
                        xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                        xhr2.onreadystatechange = function () {
                            if (xhr.readyState === 4) {
                                if (xhr.status === 200) {
                                    var cartElements = document.querySelectorAll("[id^='cart']");
                                    cartElements.forEach(function (cartElement) {
                                        cartElement.parentNode.removeChild(cartElement);
                                    });
                                    alert("Objednávka úspešne vytvorená.");
                                    updateTotalPrice();
                                }
                            }
                        };
                    }
                    xhr2.send("userId=" + userId + "&orderId=" + orderId);
                }
            }
        };

        xhr.send("userId=" + userId);

    }

    var orderForms = document.querySelectorAll(".orderForm");
    orderForms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            event.preventDefault();
            var userId = form.querySelector("input[name='userCart']").value;
            orderAjax(userId);
        });
    });
});