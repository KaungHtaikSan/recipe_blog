<?php
     
?>

<!DOCTYPE html>
<html class="no-js" lang="en">

<head>

    <!--- basic page needs
    ================================================== -->
    <meta charset="utf-8">
    <title>K Recipes Blog</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- mobile specific metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/vendor.css">
    <link rel="stylesheet" href="css/main.css">

    <!-- script
    ================================================== -->
    <script src="js/modernizr.js"></script>
    <script src="js/pace.min.js"></script>

    <!-- favicons
    ================================================== -->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">


</head>

<body id="top">

    <!-- pageheader
    ================================================== -->
    <div class="s-pageheader">

        <header class="header">
            <div class="header__content row">

                <div class="header__logo">
                    <a class="logo" href="index.php">
                        <h3 style="color: white; font-family: 'Playfair Display', serif;
                        margin-top: auto;">
                            K Recipes Blog</h3>
                    </a>
                </div> <!-- end header__logo -->

                <ul class="header__social">
                    <li>
                        <a href="https://www.facebook.com/"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="https://www.twitter.com"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                    </li>
                    <li>
                        <a href="https://www.pinterest.com"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                    </li>
                </ul> <!-- end header__social -->

                <a class="header__search-trigger" href="#0"></a>

                <div class="header__search">

                    <form role="search" method="post" class="header__search-form" action="index.php">
                        <label>
                            <span class="hide-content">Search for:</span>
                            <input type="search" class="search-field" placeholder="Type Keywords" value="" name="search"
                                title="Search for:" autocomplete="off">
                        </label>
                        <input type="submit" class="search-submit" value="Search">
                    </form>

                    <a href="#0" title="Close Search" class="header__overlay-close">Close</a>


                </div> <!-- end header__search -->

                <a class="header__toggle-menu" href="#0" title="Menu"><span>Menu</span></a>

                <nav class="header__nav-wrap">

                    <!-- <h2 class="header__nav-heading h6">Site Navigation</h2> -->

                    <ul class="header__nav">
                        <li class="current"><a href="index.php" title="">Home</a></li>
                        <li class="has-children">
                            <a href="#0" title="">Recipe Categories</a>
                            <ul class="sub-menu">
                                <li><a href="index.php?category=breakfast">Breakfast & Brunch Recipes</a></li>
                                <li><a href="index.php?category=lunch">Lunch Recipes</a></li>
                                <li><a href="index.php?category=dinner">Dinner Recipes</a></li>
                                <li><a href="index.php?category=appetizer">Appetizers & Snacks Recipes</a></li>
                                <li><a href="index.php?category=desserts">Desserts Recipes</a></li>
                                <li><a href="index.php?category=drinks">Drinks Recipes</a></li>
                                <li><a href="index.php?category=main">Main Dish Recipes</a></li>
                                <li><a href="index.php?category=salads">Salads Recipes</a></li>
                                <li><a href="index.php?category=side">Side Dish Recipes</a></li>
                                <li><a href="index.php?category=soups">Soups Recipes</a></li>

                            </ul>
                        </li>

                        <li><a href="about.php" title="">About</a></li>
                        <li><a href="contact.php" title="">Contact</a></li>

                        <li class="has-children">
                            <a href="#0" title="">Join Now</a>
                            <ul class="sub-menu">
                                <li><a href="signup.php">Sign up</a></li>
                                <li><a href="login.php">Login</a></li>
                            </ul>
                        </li>

                    </ul> <!-- end header__nav -->

                    <a href="#0" title="Close Menu" class="header__overlay-close close-mobile-menu">Close</a>

                </nav> <!-- end header__nav-wrap -->

            </div> <!-- header-content -->
        </header> <!-- header -->
        </section> <!-- end s-pageheader -->
    </div> <!-- end s-pageheader -->