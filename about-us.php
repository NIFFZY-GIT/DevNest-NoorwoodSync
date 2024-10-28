<?php
require 'config.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Noorwood Company</title>
    <script src="scriptss.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://smtpjs.com/v3/smtp.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script>
window.embeddedChatbotConfig = {
chatbotId: "xYab3amLnm91LwMETAtb3",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="xYab3amLnm91LwMETAtb3"
domain="www.chatbase.co"
defer>
</script>
    <style>

@import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');

*{
margin: 0;
padding: 0;
box-sizing: border-box;
font-family: 'Poppins';
margin: 0;

          
          
}
body{
    background: linear-gradient(to bottom right, #e6f7ff, #f0f8ff);
            color: #333;
            line-height: 1.6;
            scroll-behavior: smooth;
            /* background: url('images/hero1.jpg'); */
            background-size: cover;
}



header{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    padding: 20px 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
      background: beige;
 
}

header .hi{
    display: flex;
    position: relative;
/* background-color: #d4af37; */
border-radius: 100%;

    align-content: center;
  
}

header .hi h1{


    font-size: 30px;
    align-content: center;
}
.hi{
color: black;
font-family: "Kanit", sans-serif;
font-weight: 100;
font-style: normal;
}

header {
    position: fixed; /* Change from absolute to fixed for better positioning */
    top: 0;
    left: 0;
    width: 100%;
    padding: 20px 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: beige; /* Add a background color */
    z-index: 1000; /* Ensure it stays above other content */
}

header .hi {
    display: flex;
    align-items: center; /* Align items vertically */
}

header .hi h1 {
    font-size: 30px;
    margin-left: 10px; /* Add some space between logo and title */
}

header ul {
    display: flex;
    align-items: center; /* Align items vertically */
}

header ul li {
    list-style: none;
    position: relative; /* Add for dropdown positioning */
}

header ul li a {
    color: #333;
    font-weight: 400;
    margin-left: 40px;
    font-size: 18px; /* Use lowercase 'px' */
    text-decoration: none;
    transition: color 0.1s, font-weight 0.1s;
}

header ul li a:hover {
    color: #017143;
    font-weight: bold;
}

/* Dropdown Menu Styles */


.dropdown-content li {
    padding: 8px 16px; /* Padding for dropdown items */
}




img .logo{
    width: 80px;  /* Set the width to 200 pixels */
    height: 100px; /* Set the height to 100 pixels */
}
        /* General Styles */
       

        h2 {
            color: #2E8B57;
            text-align: center;
            margin-top: 40px;
            font-weight: 700;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }

        p {
            text-align: center;
            margin: 0 20px;
            font-size: 1.1em;
            color: #555;
        }
.hero-content p{
    color: white;
}
        /* Navigation Styles */
        .navbar {
            display: flex;
            width: 100%;
            justify-content: space-around;
            align-items: center;
            background-color: #2E8B57;
            padding: 10px 20px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .navbar a:hover {
            background-color: #FFD700;
        }

        /* Hero Section */
        .hero {
    width: 100%;
    height: 70vh;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    text-align: center;
    padding: 0px;
    
    /* border-bottom: 5px solid #FFD700; */
    position: relative;
    background-size: cover;
    background: url('images/hero2.jpg') no-repeat center center fixed;
    overflow: hidden;
}

/* 
.hero::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); Adjust the opacity as needed
    z-index: 1;
} */

.hero > * {
    position: relative;
    z-index: 2;
    
}


        .hero h1 {
            font-size: 3.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-in-out;
        }

        .hero p {
            font-size: 1.4em;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        /* Image Slider Section */
        .slider {
            overflow: hidden;
            width: 100%;
            height: 400px;
            position: relative;
            margin-bottom: 50px;
        }

        .slides img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            animation: slide 15s infinite;
        }

        /* Image Sliding Animation */
        /* @keyframes slide {
            0%,
            33% {
                transform: translateX(0);
            }

            34%,
            66% {
                transform: translateX(-100%);
            }

            67%,
            100% {
                transform: translateX(-200%);
            }
        } */

        /* Section Styles */
        section {
            padding: 50px 20px;
            position: relative;
            z-index: 1;
        }

        .about-us,
        .our-products,
        .our-story {
            background-color: white;
            border-radius: 15px;
            margin: 20px auto;
            padding: 30px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.5s forwards;
        }

        .about-us:hover::after,
        .our-products:hover::after,
        .our-story:hover::after {
            transform: scaleX(1);
        }

        /* Product List Styling */
       .our-products ul {
            list-style: none;
            padding: 0;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .our-products ul li {
            padding: 10px;
            background: #f9f9f9;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .our-products ul li:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .our-products ul li i {
            margin-right: 10px;
            color: #2E8B57;
            font-size: 1.5em;
        }

        /* Contact Button & Info */
        .contact-button {
            background-color: #FFD700;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.1em;
            border-radius: 25px;
            cursor: pointer;
            display: block;
            margin: 30px auto;
            transition: background-color 0.3s, transform 0.3s;
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .contact-button:hover {
            background-color: #2E8B57;
            transform: translateY(-3px);
            cursor: pointer;
        }

        .contact-info {
            display: none;
            text-align: center;
            margin-top: 10px;
            font-size: 1em;
            color: #333;
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5em;
            }

            .hero p {
                font-size: 1.2em;
            }

            .about-us,
            .our-products,
            .our-story {
                padding: 15px;
            }

            ul {
                grid-template-columns: 1fr; /* Stack items on smaller screens */
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
      
        .form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 50vh; /* Full viewport height */
}

form {
    width: 100%;
    max-width: 600px;
    background: #e8eefa;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #548aff;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
}

form label {
    display: block;
    margin-bottom: 10px;
    font-size: 1.1em;
    color: #333;
    font-weight: bold;
}

form input,
form textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1em;
    background-color: #f9f9f9;
}

form input:focus,
form textarea:focus {
    border-color: #017143;
    outline: none;
    background-color: #fff;
}

form button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #017143;
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1.1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

form button:hover {
    background-color: #32a852;
}

        .contact{
    justify-content: center;
    align-items: center;
    text-align: center;
    height: 60vh; /* Adjust this as needed */
}

.contact-header {
    text-align: center;
    margin-bottom: 20px;
}

.contact-title {
    font-size: 2.5em;
    color: #017143;
    margin-bottom: 10px;
    font-weight: bold;
}

.contact-description {
    font-size: 1.2em;
    color: #555;
    margin-bottom: 20px;
}

.dropdown {
    position: relative;
}

.dropdown .dropbtn {
    cursor: pointer;
}
btn{
    cursor: pointer;
}

.dropdown-content {
    display: none;
    position: absolute;
    border-radius: 20px;
    width: 100%;
    background-color: beige;
    min-width: 160px;
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
}

.dropdown-content li {
    list-style: none;
}

.dropdown-content li a {
    color: #333;
    display: block;
    text-align: left;
    font-size: 16px;
    transition: background-color 0.3s;
}

.dropdown-content li a:hover {
    background-color: #017143;
    color: #fff;
}


.dropdown:hover .dropdown-content {
    display: block;
}
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <header>
        <div class="hi">
            <a href="" class="logo"><img src="images/logo1.png" alt="logo" style="width: 120px;"></a>
            <h1>Norwood International</h1>
        </div>
        <ul class="nav-links">
    <li><a href="index.php">Home</a></li>
    <li class="dropdown">
        <a href="#" class="dropbtn">Products</a>
        <ul class="dropdown-content">
            <li><a href="tea.php">Tea</a></li>
            <li><a href="bites.php">Snacks</a></li>
        </ul>
    </li>
    <li><a href="feedback.php">Feedback</a></li>
    <li><a href="cart.php">Cart</a></li>
    <li><a href="#contact" class="contct-button">Contact Us</a></li>
</ul>

    </header>
   
      
   

    <!-- Hero Section -->
    <section class="hero">
        <!-- <div class="hero-content">
            <h1>Welcome to Noorwood</h1>
            <p>“Experience Nature in Every Sip and Snack.”</p>
        </div> -->
    </section>

    <!-- Image Slider Section -->
    <!-- <section class="slider">
        <div class="slides">
            <img src="https://media.istockphoto.com/id/1132448388/photo/beautiful-tea-garden-rows-scene-isolated-with-blue-sky-and-cloud-design-concept-for-the-tea.jpg?s=612x612&w=0&k=20&c=gnebzGesox4lMrMMdtVeYOdYPoCXahHE41PR8D1ygug=" alt="Tea Plantation">
            <img src="uploaded/22.jpg" alt="Tea Cup">
            <img src="uploaded/22.jpg" alt="Snack Products">
        </div>
    </section> -->

    <!-- About Us Section -->
    <section class="about-us" id="about">
        <h2>About Us</h2>
        <p>At Noorwood, our mission is to deliver premium tea and snack products that capture the essence of nature.</p>
        <p><strong>Vision:</strong> To become a global leader in organic tea and snack products, promoting wellness and sustainability.</p>
        <p><strong>Mission:</strong> To provide customers with the finest blends and healthy snacks, crafted with care and passion.</p>
    </section>

    <!-- Our Products Section -->
    <section class="our-products" id="products">
        <h2>Our Products</h2>
        <ul>
            <li><i class="fas fa-coffee"></i> Black Tea</li>
            <li><i class="fas fa-lemon"></i> Green Tea</li>
            <li><i class="fas fa-herb"></i> Herbal Infusions</li>
            <li><i class="fas fa-cookie"></i> Organic Cookies</li>
            <li><i class="fas fa-carrot"></i> Vegetable Chips</li>
        </ul>
    </section>

    <!-- Our Story Section -->
    <section class="our-story" id="story">
        <h2>Our Story</h2>
        <p>Noorwood was founded with a passion for tea and an appreciation for natural snacks. We believe in sourcing only the finest ingredients directly from local farmers.</p>
        <p>Our ethical practices ensure fair trade, supporting both communities and the environment. Sustainability lies at the heart of everything we do, from eco-friendly packaging to organic farming initiatives.</p>
    </section>
    <section class="contact" id="contact">

        </div>
        <div class="contact-header">
    <h1 class="contact-title">Contact Us</h1>
    <!-- <p class="contact-description">If you have any questions, feel free to reach out!</p>
</div> -->

        <div class="form-container">
   
        <form id="contact-form">
            <!-- <input type="hidden" name="access_key" value="d0af20aa-a9d3-4bc7-93b8-aef98b60a43d"> -->
            <input type="hidden" name="access_key" value="0a286682-e28d-4558-9425-cb954224a75d" />
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit" class="btn">Submit</button>
        </form>
        </div>
    </section>

    <section class="location" id="location">
  <div class="contact-header">
    <h1 class="contact-title">Our Location</h1>
    <p class="contact-description">
      Visit us or reach out anytime at our convenient location!
    </p>
  </div>

  <div class="map-container">
    <iframe 
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15844.637233475405!2d79.96555702320148!3d6.871506836366043!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2511ff4c2142b%3A0xc20797ac18fb760f!2sNorwood%20Lanka%20Tea&#39;s%20International!5e0!3m2!1sen!2slk!4v1729269794328!5m2!1sen!2slk" 
      width="100%" 
      height="450" 
      style="border-radius: 12px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border: none;" 
      allowfullscreen="" 
      loading="lazy" 
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>
</section>

<style>
  .location {
    padding: 50px 20px;
    /* background-color: #d0facb; */
    text-align: center;
  }

  .contact-header h1 {
    font-size: 36px;
    color: #333;
    margin-bottom: 10px;
  }

  .contact-description {
    font-size: 18px;
    color: #666;
    margin-bottom: 30px;
  }

  .map-container {
    max-width: 800px;
    margin: 0 auto;
    overflow: hidden;
  }

  iframe {
    width: 100%;
    height: 450px;
    border-radius: 12px;
  }
  /* footer{
    background-color: #f5f5dc;
}

footer .social{
    display: flex;
    justify-content: center;
}

footer .social a{
   font-size: 40px;
   padding: 10px;

} */
</style>


<main>
    <!-- Your page content goes here -->
</main>

<footer style="background-color: #f5f5dc; color: #017143; padding: 20px 0; text-align: center; font-family: Arial, sans-serif;">
    <div style="margin-bottom: 10px;">
        <h3 style="margin-bottom: 15px;">Connect with Us</h3>
    </div>
    <div style="font-size: 24px;">
        <a href="https://wa.me/94716195982" style="margin: 0 15px; color: #25D366; text-decoration: none;">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
        <a href="https://www.facebook.com/norwoodteasinternational/" style="margin: 0 15px; color: #4267B2; text-decoration: none;">
            <i class="fa-brands fa-facebook"></i>
        </a>
        <a href="mailto:norwoodlankateasinternational@gmail.com">
  <i class="fa-solid fa-envelope" style="margin: 0 15px; color: #DA3902;"></i>
</a>

    </div>
    <div style="margin-top: 15px; font-size: 14px;">
        <p>&copy; 2024 Your Company. All rights reserved.</p>
    </div>
    <style>
        footer a:hover {
            color: #ffffff;
        }

        footer i {
            transition: transform 0.3s ease;
        }

        footer a:hover i {
            transform: scale(1.2);
        }
  
     
      

        main {
            flex: 1;
        }

        footer {
            background-color: #f5f5dc;
             color: #017143;
      
            padding: 20px 0;
            text-align: center;
        }

      
    </style>
</footer>

</body>

</html>
