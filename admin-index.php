<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/customerindex.css">
    <link rel="icon" type="/image/png" href="images/icon.png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

section{
    position: relative;
    width: 100%;
    min-height: 100vh;
    padding: 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: beige
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


            <ul>
                <li><a href="admin-index.php">Home</a></li>
                <li><a href="admin-product.php">Products</a></li>
                <li><a href="supplier.php">Suppliers</a></li>
                <li><a href="employee.php">Employees</a></li>
                <li><a href="admin_order.php">Orders</a></li>
                <li><a href="admin-feedback.php">Feedback</a></li>
                <li><a href="admin-dashboard.php">Dashboard</a></li>
            </ul>
        </header>
        <div class="content">
            <div class="textBox">
                <h2>Discover exquisite <span>teas</span> and delightful <span style="color:rgb(90, 17, 17)">snacks</span> in a cozy haven.</h2>
                <p>Discover the finest selection of Sri Lankan teas and healthy snacks, crafted with natural ingredients. Explore our range of premium products and experience the authentic taste of Sri Lanka delivered right to your doorstep.</p>
               


               
   <a href="logout.php" class="btnshop" id="logoutBtn">Logout</a>


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
  
     
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
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