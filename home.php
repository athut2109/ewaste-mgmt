<?php
//start session
session_start();

//if logged in or not
//if(!isset($_SESSION['userid']) || $_SESSION['userid'] !== true){
//    header("location: login.php");
//    exit;
//}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoBin</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat|Barlow Condensed|Cinzel">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: 0.3s ease-in;
            scroll-behavior: smooth !important;
            font-family: "Montserrat";
        }

        body{
            background-color: #5fbe7f;
            background-image: url('images/bg.png');
            background-repeat: repeat;
            background-size: contain;
            background-blend-mode: soft-light;
        }

        nav {
            background: #ffffff;
            display: flex;
            justify-content: space-around;
            align-items: center;
            max-height: 125px;
            padding: 1rem 1.5rem;
            box-shadow: 2px 3px 2px #b0b0b0;
            position: sticky;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .logo {
            max-width: 60%;
            max-height: 60%;
        }

        .add-items {
            color: white;
            background-color: #088F8F;
            padding: 15px 32px;
            text-align: center;
            display: inline-block;
            font-size: 1.2rem;
            font-weight: bold;
            margin: 4px 2px;
            border-color: #000000;
            border-width: 3px;
        }

        .add-items:hover {
            color: #000000;
            background-color: #7FFFD4;
        }

        .nav-item {
            margin-left: 2rem;
            margin-right: 2rem;
            font-size: 20px;
        }

        .nav-link {
            font-weight: bold;
        }

        .nav-button:hover {
            background-color: #009E60;
        }

        ul li {
            list-style-type: none;
        }

        a {
            text-decoration: none;
            color: #008000;
        }

        a:hover {
            color: #90EE90;
        }

        .hero {
            display: flex;
            background-color: #3e3e3e;
            background-image: url("images/hero-bg.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            align-items: center;
            justify-content: space-around;
            background-blend-mode: overlay;
            height: 50rem;
        }

        .hero-text, .about-text{
            padding: 0 5rem;
        }

        .hero .hero-text p{
            padding: 2rem 3rem 2rem 0rem;
            color: #ffffff;
            font-size: 1.5rem;
            font-family: "Montserrat";
        }

        .about {
            display: flex;
            align-items: center;
            justify-content: space-around;
            height: 45rem;
        }

        .about .about-text p{
            margin-top: -1rem;
            padding: 2rem 0rem;
            font-size: 1.5rem;
            font-family: "Montserrat";
        }

        .process{
            width: 840px;
            height: 360px;
            position: relative;
            padding: 0 5rem;
        }

        .contact-info {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 2rem;
            max-width: 1380px;
            margin: 2rem auto 2rem;
            font-family: "Montserrat";
        }

        .video-wrapper {
            position: relative;
            padding: 0 5rem;
        }

        .contact-info ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .contact-info ul li {
            font-size: 24px;
            margin-bottom: 25px;
        }

        .contact-info .map-wrapper {
            margin-top: 20px;
            position: relative;
            border-radius: 10px;
        }

        .contact-info .map-wrapper iframe {
            border: none;
            width: 560px; /* Adjusted width for responsiveness */
            height: 350px;
        }

        h1 {
            font-size: 5.5rem;
            color: #ffffff;
            font-family: "Barlow Condensed";
        }

        h2 {
            text-align: center;
            font-size: 6rem;
            font-family: "Cinzel";
            margin-top: 2rem;
        }

        h3{
            font-size: 3rem;
            font-family: "Barlow Condensed";

        }

        .services {
            max-width: 1380px;
            margin: 2rem auto 2rem;
            height: auto; /* Removed fixed height */
        }

        .service-cards {
            display: flex;
            flex-wrap: wrap; /* Added to make cards responsive */
            align-items: center;
            justify-content: space-around;
            gap: 2rem;
            margin-top: 2rem;
            background-color: #ffffff30;
            padding: 40px 20px;
            border-radius: 16px;
            box-shadow: 0 0 20px #000000;
            max-width: 1380px;
            text-align: center;
        }

        .card {
            position: relative;
            width: 30%; /* Adjusted width for responsiveness */
            height: auto;
        }

        .services .service-info p{
            font-size: 26px;
            margin: 5rem auto 3rem;
            font-weight: bold;
            text-align: center;
        }

        .service-title{
            color: #ffffff;
            height: 25rem;
            align-items: center;
            display: grid;
            background-image: url('images/service-bg.jpeg');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #323232;
            background-blend-mode: overlay;
        }

        .service-cards .card h1{
            font-size: 2rem;
        }

        .image {
            display: block;
            width: 100%;
            height: 30rem;
            border-radius: 16px;
        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
            background-color: #000000;
            border-radius: 16px;
        }

        .card:hover .overlay {
            opacity: 0.75;
        }

        .text {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
        }

        .text p{
            margin-top: -15px;
            font-size: 18px;
        }

        .contact h2{
            color: #ffffff;
            height: 25rem;
            align-items: center;
            display: grid;
            background-image: url('images/contact-us.jpg');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-color: #323232;
            background-blend-mode: overlay;
        }

        .contact-links ul li a{
            color: #000000;
        }

        .contact-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 2rem;
            max-width: 1100px;
            margin: 2rem auto 2rem;
        }

        footer {
            color: #008000;
            background: #ffffff;
            height: 7rem;
            align-items: center;
        }

        footer p{
            text-align: center;
            padding: 40px 0 0 0;
            font-size: 1.35rem;
        }

/* Media Queries for responsiveness */

    /*for windowed screen*/
    @media screen and (max-width: 1280px){
        .hero, .about {
            flex-direction: column;
            text-align: center;
            padding: 0;
        }

        .hero-text, .about-text {
            margin: 0;
        }

        .video-wrapper{
            padding: 0;
        }

        .process{
            width: 635 !important;
            height: 360 !important;
            padding: 0;
        }

        .hero .hero-text p{
            text-align: center;
            margin-top: 1rem;
            padding: 1rem 3rem;
        }

        .about .about-text p{
            font-size: 20px;
            margin-bottom: -15px;
        }

        .logo {
            height: 50% !important;
            width: 50% !important;
        }

        h1, h2{
            font-size: 4rem;
        }

        .nav-item{
            margin-left: 1.3rem;
            margin-right: 1.3rem;
            font-size: 18px;
        }

        .text{
            font-size: 14px;
        }

        .contact-links{
            margin-left: 3rem;
        }

        .map-wrapper iframe{
            width: 360px !important;
            height: 300px !important;
            margin-right: 3rem;
        }
    }

    /*For Tablet*/
    @media screen and (max-width: 768px) {
        .hero, .about {
            flex-direction: column;
            text-align: center;
        }

        .hero-text, .about-text {
            margin: 0;
        }

        .add-items {
            margin-top: 2rem;
            padding: 12px 28px;
            font-size: 16px;
        }

        .video-wrapper iframe {
            margin-top: -5rem;
            width: 480px;
        }

        .process{
            margin-top: 1rem;
            width: 640px;
            height: 300px;
        }

        .services{
            justify-content: center;
            align-items: center;
        }

        .service-cards {
            width: 70%;
            margin: 1rem auto;
        }

        .card {
            width: 100%;
        }

        .service-cards .card p{
            font-size: 18px;
        }

        .services .service-info p{
            font-size: 1rem;
            margin: 2rem auto;
        }

        .service-title, .contact h2{
            height: 17rem !important;
        }

        .about .about-text p{
            font-size: 15px;
            margin-top: -20px;
            margin-bottom: -30px;
        }

        .text p{
            margin-top: 0;
        }

        .contact h2{
            height: 12rem;
        }

        .contact-info {
            flex-direction: column;
            text-align: center;
        }

        .contact-links{
            margin-left: 0;
        }

        .map-wrapper iframe{
            margin-right: 0rem;
        }

        .nav-item{
            margin-left: 1rem;
            margin-right: 1rem;
            font-size: 16px;
        }

        .logo {
            height: 50%;
            width: 50%;
        }

        h1, h2{
            font-size: 3rem;
        }

        h3{
            font-size: 2rem;
        }

        .hero .hero-text p{
            text-align: center;
            padding: 1rem 5rem;
            font-size: 18px;
        }
    }

    /*For Mobile*/
    @media screen and (max-width: 480px) {
        .add-items {
            margin-top: 2rem;
            padding: 12px 28px;
            font-size: 16px;
        }

        .video-wrapper iframe {
            margin-top: -5rem;
            width: 360px;
            height: 240px;
        }

        .process{
            width: 400px;
            height: 240px;
            margin-bottom: 25px;
        }

        .about .about-text p{
            font-size: 14px;
            margin-top: -25px;
            margin-bottom: -50px;
        }

        .service-cards {
            width: 90%;
            margin: 1rem auto;
        }

        .card {
            width: 100%;
        }

        .image{
            height: 360px !important;
        }

        .service-cards .card p{
            font-size: 14px;
        }

        .nav-item{
            margin-left: .5rem;
            margin-right: .5rem;
            font-size: 10px;
        }

        .logo {
            height: 50%;
            width: 50%;
        }

        h1, h2{
            font-size: 2.5rem;
        }

        .hero .hero-text p{
            text-align: center;
            padding: 1rem 3rem;
            font-size: 18px;
        }

        .contact-links ul li{
            font-size: 18px;
        }

        footer{
            height: 3rem;
        }
        
        footer p{
            text-align: center;
            justify-content: center;
            padding: 10px 0;
            font-size: 14px;
        }
    }
    </style>

</head>
<body>
<!--Navigation Bar-->
<nav>
    <a href="home.php">
        <img src="images\demo_logo.png" class="logo">
        <ul style="display: flex;  justify-content: space-between;  align-items: center;">
            <li class="nav-item">
                <a href="#home" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
                <a href="profile.php" class="nav-link">Profile</a>
            </li>
            <li class="nav-item">
                <a href="#services" class="nav-link">Services</a>
            </li>
            <li class="nav-item">
                <a href="#contact-us" class="nav-link">Contact</a>
    </a>
</nav>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="hero-text">
        <h1>Welcome to EcoBin</h1>
        <p>
            Join us in making a difference: conveniently recycle your e-waste with our eco-friendly collection service, contributing to a cleaner, sustainable future.
        </p>
        <button class="add-items" onclick="location.href='add_item.html'">Add Items</button>
    </div>
    <div class="video-wrapper">
        <iframe width="635" height="360" src="https://www.youtube.com/embed/JfU0107bVs8?autoplay=1&mute=1&loop=1"></iframe>
    </div>
</section>

<!--About Section-->
<section class="about" id="about">
    <div class="about-image">
        <image  src="images\e-waste-process.jpg" alt="E-Waste Process" class="process">
    </div>
    <div class="about-text">
        <h3>What is EcoBin?</h3>
        <p>
            EcoBin is a group of companies focused on
            providing customer-centric technology solutions and services through the
            best environment-friendly practices. EcoBin's unique business model provides an
            entire life cycle of Green IT products through its IT solution centers, remotely
            managed services, advanced level repair, refurbishing and ewaste
            management.
            <br><br>
            EcoBin specializes in e-waste management and disposal. Our
            process of e-waste recycling prioritizes environmental
            protection. It also seeks to prioritize proper handling,
            processing and managing environmentally hazardous
            substances that are present in the e-waste.
        </p>
        <button class="add-items" onclick="location.href='add_item.html'">Add Items</button>
    </div>
</section>

<!--Services Section-->
<h2 class="service-title">Our Services</h2>
<section class="services" id="services">
    <div class="service-info">
        <p>Explore our range of specialized e-waste services tailored to meet your needs and environmental goals. Our team offers secure data destruction, efficient collection, and responsible recycling solutions, ensuring your electronic devices are handled with the utmost care and environmental consciousness. We strive to streamline the process, providing convenient options for businesses and individuals alike to dispose of their e-waste responsibly.</p>
    </div>
    <div class="service-cards">
        <div class="card">
            <img src="images/recycle.jpg" alt="Recycle" class="image">
            <div class="overlay">
                <div class="text">
                    <h1>Recycling</h1>
                    <br>
                    <p>Obsolete electronics are valuable source for secondary raw materials, if treated properly. If not, they are a source of toxins and carcinogens. EcoBin specializes in the collection, segregation and recycling of these electronic equipment. We understand that some components and materials in the electronic equipment are re-usable.</p>
                </div>
            </div>
        </div>
        <div class="card">
            <img src="images/data-del.png" alt="Data Sanitization" class="image">
            <div class="overlay">
                <div class="text">
                    <h1>Data Sanitization</h1>
                    <br>
                    <p>Data Sanitization involves permanently deleting and destroying data from a storage device, to ensure it cannot be recovered. Data sanitization is a highly effective method for scrubbing the data off especially when your organization's confidentiality matters</p>
                </div>
            </div>
        </div>
        <div class="card">
            <img src="images/data-rec.jpg" alt="Asset Recovery" class="image">
            <div class="overlay">
                <div class="text">
                    <h1>Asset Recovery</h1>
                    <br>
                    <p>Asset recovery refers to the process of reclaiming or disposing of information technology equipment and devices, including computer equipment, in a responsible and efficient manner. The goal is to maximize returns on investment, minimize environmental impact, and ensure data security and privacy compliance.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Contact Section-->
<section class="contact" id="contact-us">
    <h2>Contact Us</h2>
    <section class="contact-info">
        <div class="contact-links">
            <ul>
                <li><strong>Phone:</strong> <a href="tel:0123456789">+91 0123456789</a></li>
                <li><strong>Email:</strong> <a href="mailto:info@ecobin.com">info@ecobin.com</a></li>
                <li><strong>Location:</strong> Pillai College of Engineering, New Panvel</li>
            </ul>
        </div>
        <div class="map-wrapper">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3772.669319454159!2d73.12509517471877!3d18.99020605466122!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7e866de88667f%3A0xc1c5d5badc610f5f!2sPillai%20College%20of%20Engineering%2C%20New%20Panvel%20(Autonomous)!5e0!3m2!1sen!2sin!4v1707770577804!5m2!1sen!2sin" width="600" height="450" style="border:3rem;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>
</section>

<footer>
    <p>&copy; 2024 EcoBin | All rights reserved.</p>
</footer>
</body>
</html>