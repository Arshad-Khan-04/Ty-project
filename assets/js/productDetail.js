// productDetail.js

document.addEventListener("DOMContentLoaded", function () {
    // On page load, remove any previously stored user-uploaded image
    localStorage.removeItem("userUploadImage");

    const uploadInput = document.getElementById("uploadImage");
    const removeButton = document.getElementById("removeUpload");
    const productImage = document.getElementById("productImage");
    const defaultImage = productImage.src; // default product image URL

    // Event listener: When a file is selected
    uploadInput.addEventListener("change", function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                const base64Image = e.target.result;
                // Save to localStorage
                localStorage.setItem("userUploadImage", base64Image);
                productImage.src = base64Image;
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove uploaded image and revert to default
    removeButton.addEventListener("click", function () {
        localStorage.removeItem("userUploadImage");
        productImage.src = defaultImage;
    });

    // Add to Cart functionality
    const addToCartButton = document.getElementById("addToCart");
    addToCartButton.addEventListener("click", function () {
        const quantityInput = document.getElementById("quantity");
        const quantity = parseInt(quantityInput.value);
        if (isNaN(quantity) || quantity <= 0) {
            alert("Please enter a valid quantity.");
            return;
        }
        // Build product object
        const product = {
            id: "<?php echo $product['Product_Id']; ?>",
            name: "<?php echo $name; ?>",
            price: "<?php echo $price; ?>",
            quantity: quantity
        };

        // Retrieve current cart from localStorage (or initialize empty array)
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        const existing = cart.find(item => item.id === product.id);
        if (existing) {
            existing.quantity += quantity;
        } else {
            cart.push(product);
        }
        localStorage.setItem("cart", JSON.stringify(cart));
        alert("Product added to cart!");
    });
});
