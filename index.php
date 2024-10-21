<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/customerindex.css">
    <link rel="icon" type="/image/png" href="images/icon.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Norwood</title>
</head>
<style>
@import url('https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap');

*{
margin: 0;
padding: 0;
box-sizing: border-box;
font-family: 'Poppins';
}

/* body{
           background: url('images/hero1.jpg');
           background-size: cover;
} */
section{
    position: relative;
    width: 100%;
    min-height: 100vh;
    padding: 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: beige;
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


header ul{
    position: relative;
    display: flex;
}

header ul li{
    list-style: none;
}

header ul li a{
    display: inline-block;
    color: #333;
    font-weight: 400;
    margin-left: 40px;
    font-size: 18PX;
    text-decoration: none;
    transition: 0.1s;
}
header ul li a:hover{
    color: #017143;
    font-weight: bold;
}

img .logo{
    width: 80px;  /* Set the width to 200 pixels */
    height: 100px; /* Set the height to 100 pixels */
}


.content{
    margin-top: 80px;
    position: relative;
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.content .textBox{
    position: relative;
    max-width: 600px;
}

.content .textBox h2{
    color: #333;
    font-size: 3.5em;
    line-height: 1.4em;
    font-weight: 500;
}

.content .textBox h2 span{
    color: #017143;
    font-size: 1.2em;
    font-weight: 900;
}

.content .textBox p{
    color:#333;
}

.btnshop{
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    background: #017143;
    color: #ffff;
    border-radius: 40px;
    font-weight: 500;
    letter-spacing: 1px;
    text-decoration: none;
}
.btnshop:hover{
    background: #01834d;
    color: beige;
}
.content .imgBox{
    width: 600px;
    display: flex;
    justify-content: flex-end;
    padding-right: 50px;
}

.circle{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #017143;
    clip-path: circle(600px at right 700px);
}

footer{
    background-color: #f5f5dc;
}

footer .social{
    display: flex;
    justify-content: center;
}

footer .social a{
   font-size: 40px;
   padding: 10px;
}



.dropdown {
    position: relative;
}

.dropdown .dropbtn {
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


header ul {
    display: flex;
    list-style: none;
}

header ul li {
    position: relative;
}

header ul li a {
    text-decoration: none;
    font-size: 18px;
    color: #333;
    margin-left: 40px;
    padding: 10px;
    transition: color 0.3s;
}
.imgBox img {
    width: 100%; /* Adjusted width */
    height: auto;

}
.dropdown ul li a{
    margin: 0px;
    border-radius: 20px;
}

header ul li a:hover {
    color: #017143;
}

</style>
<body>




    <section>
        <div class="circle"></div>
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
                <li><a href="about-us.php">About Us</a></li>
            </ul>


        </header>
        <div class="content">
        <div class="textBox">
    <h2>Discover exquisite <span>teas</span> and delightful <span style="color:rgb(90, 17, 17)">snacks</span> in a cozy haven.</h2>
    <p>Discover the finest selection of Sri Lankan teas and healthy snacks, crafted with natural ingredients. Explore our range of premium products and experience the authentic taste of Sri Lanka delivered right to your doorstep.</p>



    <?php if (isset($_SESSION['userId']) ): ?>
   <a href="logout.php" class="btnshop" id="logoutBtn">Logout</a>
<?php else: ?>
    <a href="login.php" class="btnshop">Login</a>
<?php endif; ?>

<script>
    document.getElementById('logoutBtn').addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you really want to log out?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, log out',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'logout.php';
            }
        });
    });
</script>









</div>
            <div class="imgBox">
                <img src="images/image1.png" alt="">
            </div>
        </div>
    </section>

        <footer class="footer">
            <div class="social">
                <a href="https://web.whatsapp.com/"><i class="fa-brands fa-whatsapp" style="color: #000000;"></i></a>
                <a href="https://web.facebook.com/?_rdc=1&_rdr"><i class="fa-brands fa-facebook" style="color: #000000;"></i></a>
                <a href="https://web.facebook.com/?_rdc=1&_rdr"><i class="fa-solid fa-envelope" style="color: #000000;"></i></a>                    
            </div>
            <p align="center"> © Copyright Norwood.lk 2023. All rights reserved</p>
            <p align="center"> Established in 2022</p>
            <p align="center"> Privacy Policy | Terms of Service | Contact Us</p>
            <br>
        </footer>
    
</body>
</html>