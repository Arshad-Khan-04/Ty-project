<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PixelPrint</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>
<?php 
session_start();
include 'includes/header.php'; ?>
<section class="hero-cont">
    <div class="hero">
        <div class="left">
            <img src="assets/images/hero/hero.webp">
            <div class="box-1">
                <h4>My Name, My Pride</h4>
                <p>100 Visiting Cards at Rs 200</p>
                <button onclick="location.href='pages/visitingCard.php'">Shop Now</button>
            </div>
        </div>
        <div class="right">
            <img src="assets/images/hero/home-2.webp">
            <div class="box-2">
                <h4>Wear your brand with pride</h4>
                <p>Starting at Rs. 550</p>
                <button onclick="location.href='pages/poloTshirt.php'">Custom Polo T-shirts</button>
                <button onclick="location.href='pages/office.php'">Custom T-shirts</button>
            </div>
        </div>
    </div>
</section>
<section class="cat-cont">
    <div class="cate">
        <h3>Explore all categories</h3>
        <div class="cate-list">
            <div class="cart cat">
                <a href="product_list.php?category=Visiting Cards"><img src="assets/images/categories/1.png"></a>
                <p>Visiting Cards</p>
            </div>
            <div class="polo cat">
                <a href="product_list.php?category=Custom Polo t-shirts"><img src="assets/images/categories/2.png"></a>
                <p>Custom Polo t-shirts</p>
            </div>
            <div class="T-shirts cat">
                <a href="product_list.php?category=Office Shirt"><img src="assets/images/categories/3.png"></a>
                <p>Office Shirt</p>
            </div>
            <div class="logic cat">
                <a href="product_list.php?category=Custom Stamp & Ink"><img src="assets/images/categories/4.png"></a>
                <p>Custom Stamp & Ink</p>
            </div>
            <div class="photo cat">
                <a href="product_list.php?category=Photo Gifts"><img src="assets/images/categories/5.png"></a>
                <p>Photo Gifts</p>
            </div>
            <div class="bag cat">
                <a href="product_list.php?category=Custom Bags"><img src="assets/images/categories/6.png"></a>
                <p>Custom Bags</p>
            </div>
            <div class="stationery cat">
                <a href="product_list.php?category=Custom Stationery"><img src="assets/images/categories/7.png"></a>
                <p>Custom Stationery</p>
            </div>
        </div>
    </div>
</section>


<section class="second-cont">
        <div class="seco">
            <div class="side-1">
                <img src="assets/images/categories/new-home.webp">
                
                <div class="box1">
                    <h4>Special Gifts for <br>your favourite <br>people</h4>
                    <p>Start at Rs 140</p>
                    <button>Shop Now</button>
                </div>
            </div>
            <div class="side-2">
                <img src="assets/images/categories/new-home1.webp">

        <div class="box2">
            <h4>Preserve your<br>cherished <br>moments</h4>
            <p>Start at Rs 650</p>
            <button id="btn-1">Photo Albums</button>
            <br>
            <button id="btn-2">Layflat Photo Albums</button>
        </div>
            </div>
        </div>
    </section>
<?php include 'includes/footer.php'; ?>
</body>
</html>
