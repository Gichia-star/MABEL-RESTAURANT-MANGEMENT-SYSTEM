<!DOCTYPE html>
<html>
<head>
    <title>MABLE RESTAURANT | Nairobi</title>
</head>

<body>

<div class="text">
    <a id="link" href="./index.php">Home</a>
    <a id="link" href="./menu.php">Menu</a>
    <a id="link" href="./preorder.php">Pre Orders</a>
    <a id="link" href="./reservation.html">Reservation</a>
    <a id="link" href="./login.html">Login</a>
</div>
  

<div class="Btext">
    <p id="text7">MABLE RESTAURANT</p>
</div>

<p id="text8">Bringing the authentic Kenyan culinary experience to the Heart of Nairobi.</p>

<img src="https://img.freepik.com/premium-photo/top-view-classic-spaghetti-pasta-with-tomato-sauce-dark-plate-copy-space_67155-5968.jpg" alt="Background Image" class="background-image">

<img src="images\my3.png" class="logo">

<div class="img-Container">
    <img src="https://st3.depositphotos.com/4218696/17096/i/450/depositphotos_170968544-stock-photo-top-view-set-of-sushi.jpg" class="image">
    <p id="des1" class="img-descripton">Two simple reasons. One simple Answer.</p>
    <br><br><br>
    <p id="des2" class="img-descripton">Why Mabel Restaurant?</p>
    <br><br><br><br>
    <p id="des3" class="img-descripton">Designed to be the Culinary epicenter, We try to uphold the traditions of the Local Household while bringing out the avours of Kenya with a bounty of fresh seasonal ingredients. We take extra care to deliver fresh farm produce to a local classy table cuisine with an emphasis on seasonal & locally sourced ingredients and with the freshest Seafood.</p>
</div>

<div class="menu">
    <p id="menu1">Discover our</p>
    <p id="menu2">MOUTH WATERING MENU</p>
    <ul type="disc" id="menu3">
        <li>chiken Biriyani ------------------------------Ksh 2500</li>
        <li>Hot Butter Chicken  Meal------------------------Ksh 3000</li>
        <li>Special Chicken -----------------------------------Ksh 1500</li>
        <li>Crab curry-----------------------------------------------Ksh 3500</li>
        <li>Hot Butter Cuttlefish-----------------------------------Ksh 1000</li>
    </ul>
</div>

<div class="menuButton1">
    <button id="menuButton1" onclick="menuButton()">Check Full Menu</button>
</div>
<style>
    .menuButton1 button{
    margin-left: 280px;
    margin-top: 2px; 
    color: rgb(255, 191, 0);
    font-size: 15px;
    padding: 15px 30px;
    border-radius: 50px;
    cursor: pointer;
    border: 2px solid;
    background-color: rgb(0, 0, 0);
}
</style>

<div class="img-Container1">
    <img src="https://img.freepik.com/free-photo/top-view-delicious-pasta-table_23-2150857954.jpg?t=st=1721467259~exp=1721470859~hmac=2ebc546d371e2779689b87c922134044b2672244ed06a8fe75ac133da2b668a2&w=1060" class="image1">
    <p id="Des1" class="img-descripton1">we offer</p>
    <br><br><br>
    <p id="Des2" class="img-descripton1">WONDERFUL <br>FLAVORS</p>
    <br><br><br><br><br>
    <p id="Des3" class="img-descripton1">We want you to sit down and enjoy your meal just like the way you enjoy your homemade dishes! We have embarked on this journey and we are glad that you have taken the time off of your schedule to know our story to experience our experience.</p>
</div>

<img src="https://cultureNairobi.lk/wp-content/uploads/2020/09/Sea-Food-Bowl-in-sri-lankan-style-768x647.jpg" class="image2">

<div id="text-box" class="text-box">
    <p id="Txt1">Discover</p>
    <p id="Txt2">OUR STORY</p>
    <p id="Txt3">ULTIMATE DINING EXPERIENCE LIKE NO OTHER</p>
    <p id="Txt4">Mabel Restaurant has been a local favorite for more than a decade, situated near the coastal lines of the western province of Kenya. Mabel Restaurant is known for its authentic Kenyan food, exotic Indian and Chinese cuisine, and a blend of western and continental dishes.</p>
</div>

<img src="https://savannahrestaurant.lk/images/sig.jpg" class="image3">

<div id="text-box1" class="text-box1">
    <p id="Txtt1">Our</p>
    <p id="Txtt2">RESTAURANT</p>
    <p id="Txtt3">CHECKOUT OUR RESTAURANT AND SPECIAL DISHES</p>
    <p id="Txtt4">Our signature spice blends, crafted with meticulous care, come alive under the expertise of our seasoned chefs, creating an unforgettable culinary experience. Each dish is a harmonious symphony of flavors, ensuring a dining experience that lingers in memory long after the meal is over.</p>
</div>

<div class="box">
    <p id="promotion">Special Foods</p>
    <p id="promot1">EXECUTIVE PACK 01</p>
    <p id="promot2">EXECUTIVE PACK 02</p>
    <p id="promot3">EXECUTIVE PACK 03</p>
    <p id="promot4">Vegetable or Egg Fried Rice or Noodles<br> Mixed Vegetables<br>Egg<br>Chilli Paste<br>Choice of One Meat Item<br>Chicken with Chilli Sauce<br>Beef in Oyster Sauce</p>
    <p id="promot5">Vegetable or Egg Fried Rice or Noodles<br>Mixed Vegetables<br>Chilli Paste<br>Choice of One Sea Food Item<br>Sweet and Sour Fish<br>Deviled Prawns</p>
    <p id="promot6">Vegetable or Egg Fried Rice or Noodles<br>Mixed Vegetables<br>Chilli Paste (Vegetarian)<br>Choice of Two Vegetable Items<br>Mushroom in Hot Butter Sauce<br>Kankun with Garlic<br> Paneer Butter Masala</p>
    <img src="https://savannahrestaurant.lk/images/set-dish1.jpg" class="promo1">
    <img src="https://savannahrestaurant.lk/images/set-dish2.jpg" class="promo2">
    <img src="https://savannahrestaurant.lk/images/set-dish3.jpg" class="promo3">
</div>
<div class="event-box">
        <div class="event">
            <p id="event2">Events / Promotion</p>
            <div class="slider-container">
                <button class="arrow left" onclick="moveSlide(-1)">&#10094;</button>
                <div class="slider" id="slider">
                    <?php
                    $imagePaths = json_decode(file_get_contents('images.json'), true);
                    if ($imagePaths) {
                        foreach ($imagePaths as $imagePath) {
                            echo '<img src="' . $imagePath . '" class="musicpic">';
                        }
                    } else {
                        echo '<p>No images uploaded yet.</p>';
                    }
                    ?>
                </div>
                <button class="arrow right" onclick="moveSlide(1)">&#10095;</button>
            </div>
        </div>
    </div>
    <script>
        let currentSlide = 0;

        function moveSlide(step) {
            const slides = document.querySelectorAll('.slider img');
            const totalSlides = slides.length;
            if (totalSlides === 0) return; // Prevent errors if no images
            currentSlide = (currentSlide + step + totalSlides) % totalSlides;
            const offset = -currentSlide * 100; // 100% for each image
            document.querySelector('.slider').style.transform = `translateX(${offset}%)`;
        }

        // Optional: Add arrow key functionality
        document.addEventListener('keydown', function(event) {
            if (event.key === 'ArrowLeft') {
                moveSlide(-1);
            } else if (event.key === 'ArrowRight') {
                moveSlide(1);
            }
        });
</script>

<div class="img-Container3">
    <p id="park1">Parking facilities</p>
    <img src="https://www.superbcrew.com/wp-content/uploads/2022/07/Impact-of-parking-spaces-featured.jpg" class="parking-img">
    <div class="text-box3">
        <p id="Txtp1">Our</p>
        <p id="Txtp2">Parking facilities</p>
        <p id="Txtp3">Our restaurant offers convenient parking with ample spaces, including accessible spots. We also provide valet services for a seamless experience. Enjoy safe and easy parking, allowing you to focus on your meal.</p>
    </div>
</div>

<div class="box2">
    <p id="contact1">Contact Us</p>
    <div class="contact-text">
        <p id="contact2">Location</p>
        <p id="contact3">Email</p>
        <p id="contact4">Phone</p>
        <p id="contact5">EveryDay From</p>
    </div>
    <div class="contact-text2">
        <p id="contact6">No 25 Kensington Garden,<br>Nairobi 00400</p>
        <p id="contact7">mabelrestaurant@gmail.com</p>
        <p id="contact8">0112545898</p>
        <p id="contact9">EveryDay 11.00 AM to 11.00 PM</p>
    </div>
</div>
<style>

    body{
    font-family: Arial, Helvetica, sans-serif;
    background-color: black;

}

/* upper font styles  */

.text {
            display: flex;
            justify-content: flex-end;
            font-size: 20px;
            gap: 60px;
            color: rgb(218, 180, 8);
            padding: 20px;

        }

        .text a {
            color: inherit;
            text-decoration: none;
        }

        .text a:hover, .text a:active {
            text-decoration: underline;
        }




/* Link styles */


a:link, a:visited {
    color: inherit; /* Keeps the link color consistent with the surrounding text */
    text-decoration: none; /* Removes the underline from links */
}

/* Optional: Define hover and active states if needed */
a:hover, a:active {
    text-decoration: underline; /* Adds an underline when hovering or clicking */
    color: inherit; /* Keeps the color consistent */
}


/* background Image styles  */

.background-image{
    width: 100%;
    height: auto;
    position: absolute;
    top: 0;
    left: 0;
    z-index: -1;
}



/* Logo styles  */

.logo{
    width: 300px;
    height: auto;
    position: absolute;
    top : 0px;
    margin-left: 140px;
    margin-top: 90px;

}
/* background font styles  */

.Btext{
    font-size: 100px;
    color: white;
    font-weight: bolder;
    line-height: 0px;
    margin-left: 180px;
    margin-top: 250px;    
}
#text8{
    color: rgba(255, 179, 0, 0.832);
    font-size: 20px;
    line-height: 0;
    margin-left: 230px;

}



/* Box Image styles  */

.img-Container{
    width: 85%;
    height: 600px;
    background-color: white;
    margin: 20px auto;
    margin-top: 300px;
    margin-left: 220px;
    position: relative;
    display: inline-block;
}
.image{
    width: 100%; 
    height: 100%; 
    object-fit: cover;  
    position: absolute;
    display: block;
    filter: brightness(80%);
}


/* Box Image font styles  */

.img-descripton{
    color: black;
    margin-bottom: 20px;
    position: absolute;

}
#des1{
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
    color: rgb(216, 217, 209);
    font-weight: bolder;
    font-size: 30px;
    margin-top: 150px;
    margin-left: 500px;
}
#des2{
    margin-left: 500px;
    color: rgba(32, 31, 31, 0.897);
    font-weight: bold;
    font-size: 40px;
    margin-top: 150px;

}
#des3{
    margin-left: 500px;
    font-family: 'Gill Sans',  'Trebuchet MS', sans-serif;
    font-size: 21px;
    margin-top: 150px;
    line-height: 30px;

}


/* Menu styles  */

.menu{
    font-size: 30px;
    color: rgba(255, 162, 0, 0.871);
    margin-top: 100px;
}

#menu1{
    font-size: 30px;
    text-align: center;
    font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
}

#menu2{
    font-size: 40px;
    text-align: center;
    font-family: Georgia, 'Times New Roman', Times, serif;
}

#menu3{
    font-family: cursive;
    font-size: 20px;
    color: azure;
    margin-top: 100px;
    margin-left: 80px;
    line-height: 80px;
}



/* Box image 2nd styles    */

.img-Container1{
    width: 100%;
    height: 600px;
    background-color: white;
    margin: 20px auto;
    margin-top: 150px;
    margin-left: 0px;
    position: relative;
    display: inline-block;
}
.image1{
    width: 100%; 
    height: 100%;  
    position: absolute;
    display: block;
    object-fit: cover; 
    filter: brightness(40%);
}


/* Box Image 2nd font styles  */

.img-descripton1{
    color: black;
    margin-bottom: 20px;
    position: absolute;
}
#Des1{
    font-family: cursive;
    color: rgb(255, 157, 0);
    font-weight: bolder;
    font-size: 30px;
    margin-top: 150px;
    margin-left: 600px;
}
#Des2{
    margin-left: 600px;
    color: white;
    font-weight: bold;
    font-size: 40px;
    margin-top: 150px;

}
#Des3{
    margin-left: 600px;
    margin-right: 200px;
    color: rgb(193, 207, 218);
    font-family: 'Gill Sans',  'Trebuchet MS', sans-serif;
    font-size: 20px;
    margin-top: 180px;
    line-height: 30px;

}

/* Third Image styles */

.image2{
    width: 800px;
    height: 600px;
    margin-top: 60px;
    margin-left: 60px;
    filter: brightness(85%);
}

/* text box*/

.text-box{
    width: 600px;
    height: 350px;
    background-color:  rgb(255, 162, 0);
    margin-left: 900px;
    margin-top:3090px;
    transition : all 0.5s ; position: relative; left :0; top :0;
    position:absolute;
    border-radius: 25px;
    cursor: pointer;
}

/* text box descriptions */

#Txt1{
    font-size: 35px;
    color: brown;
    font-weight: bold;
    margin-left: 30px;
    margin-bottom: 0px;
    font-family: "Playwrite Cuba";
    
}

#Txt2{
    font-size: 40px;
    font-weight: bold;
    margin-left: 30px;
    margin-bottom:0px;
    margin-top: 0px;
}

#Txt3{
    font-size: 15px;
    margin-left: 30px;
    margin-top: 0px;
    color: rgb(232, 233, 234);
    
}

#Txt4{
    font-size: 20px;
    margin-left: 30px;
    margin-top: 35px;
    margin-right: 7px;
}

/*  forth image styles*/

.image3{
    width: 800px;
    height: 600px;
    position: static;
    margin-top: 50px;
    margin-left: 650px;
}


/* second text box*/

.text-box1{
    width: 600px;
    height: 350px;
    background-color: rgb(255, 162, 0);
    margin-left: 20px;
    margin-top:3750px;
    transition : all 0.5s ; position: relative; left :0; top :0;
    position:absolute;
    border-radius: 25px;
    cursor: pointer;
}

#Txtt1{
    font-size: 35px;
    color: brown;
    font-weight: bold;
    margin-left: 30px;
    margin-bottom: 0px;
    font-family: "Playwrite Cuba";
    
}

#Txtt2{
    font-size: 40px;
    font-weight: bold;
    margin-left: 30px;
    margin-bottom:0px;
    margin-top: 0px;
}

#Txtt3{
    font-size: 15px;
    margin-left: 30px;
    margin-top: 0px;
    color: rgb(232, 233, 234);
    
}

#Txtt4{
    font-size: 20px;
    margin-left: 30px;
    margin-top: 35px;
    margin-right: 7px;
}

.box{
    width: 100%;
    height: 980px;
    background-color: rgb(22, 22, 22);
    margin-top: 100px;
}

#promotion{
    font-size: 50px;
    font-family: Georgia, 'Times New Roman', Times, serif;
    line-height: 150px;
    text-align: center;
    color: rgb(164, 109, 6);
    font-weight:bold;
}

.promo1{
    width: 500px;
    height: auto;
    margin-top: 100px;
}
.promo2{
    width: 500px;
    height: auto;
}
.promo3{
    position: absolute;
    width: 494px;
    height: 333px;
    margin-left: 5px;
    margin-top: 100px;
}

#promot1{
    color: white;
    display: flex;
    margin-left: 90px;
    font-size: 30px;
    position: absolute;
}
#promot2{
    color: white;
    display: flex;
    font-size: 30px;
    justify-content: center;
    position: absolute;
    margin-left: 600px;
}
#promot3{
    color: white;
    display: flex;
    font-size: 30px;
    justify-content: right;
    position: absolute;
    margin-left: 1100px;
}
#promot4{
    color: rgb(242, 199, 79);
    display: flex;
    font-family: 'Times New Roman', Times, serif;
    font-size: 25px;
    justify-content: right;
    position: absolute;
    margin-left: 40px;
    margin-top: 500px;
}
#promot5{
    color: rgb(242, 199, 79);
    display: flex;
    font-size: 25px;
    font-family: 'Times New Roman', Times, serif;
    justify-content: right;
    position: absolute;
    margin-left: 550px;
    margin-top: 500px;
}
#promot6{
    color: rgb(242, 199, 79);
    display: flex;
    font-size: 25px;
    font-family: 'Times New Roman', Times, serif;
    justify-content: right;
    position: absolute;
    margin-left: 1100px;
    margin-top: 500px;
}
.event-box{
    width: 100%;
    height: 980px;
    background-color: rgb(22, 22, 22);
    margin-top: 100px;
}
.event{
    font-size: 50px;
    font-weight: bold;
    color: rgb(101, 6, 255);
    text-align: center;
    margin-top: 180px;
    font-size: 60px;
    font-family: Georgia, 'Times New Roman', Times, serif;
}
.musicpic{
    width: 90%;
    height: auto;
}

.img-Container3{
    width: 100%;
    height: 980px;
    background-color: rgb(16, 15, 15);
    margin-top: 150px;
}

#park1{
    font-size: 50px;
    font-weight: bold;
    color: rgb(255, 162, 0);
    text-align: center;
    line-height: 200px;
    font-size: 50px;
    font-family: Georgia, 'Times New Roman', Times, serif;
}

.parking-img{
    width: 850px;
    height: 600px;
    position: absolute;
    margin-left: 50px;
}

.text-box3{
    width: 550px;
    height: 350px;
    background-color: rgb(255, 162, 0);
    margin-left: 930px;
    margin-top:150px;
    position:absolute;
    border-radius: 25px;
    cursor: pointer;
    
}
#Txtp1{
    font-size: 35px;
    color: brown;
    font-weight: bold;
    margin-left: 30px;
    margin-bottom: 0px;
    font-family: "Playwrite Cuba";
    
}

#Txtp2{
    font-size: 40px;
    font-weight: bold;
    margin-left: 30px;
    margin-bottom:0px;
    margin-top: 0px;
}
#Txtp3{
    font-size: 20px;
    margin-left: 30px;
    margin-top: 35px;
    margin-right: 7px;
}

.box2{
    width: 100%;
    height: 280px;
    background-color: rgb(245, 169, 17);
    margin-top: 100px;


}
#contact1{
    font-size: 40px;
    color: rgb(230, 222, 222);
    text-align: center;
    font-weight: bold;
    line-height: 70px;
    margin-bottom: 25px;
    font-family: cursive;

}



.contact-text{
    font-size: 25px;
    display: flex;
    justify-content: center;
    gap: 280px;
    font-weight: bold;
}
.contact-text2{
    font-size: 20px;
    color: rgb(38, 36, 36);
    display: flex;
    justify-content: center;
    gap: 180px;
}
.event-box {
            width: 100%;
            height: 980px;
            background-color: rgb(22, 22, 22);
            margin-top: 100px;
        }
        .event {
            font-size: 50px;
            font-weight: bold;
            color: rgb(101, 6, 255);
            text-align: center;
            margin-top: 180px;
            font-size: 60px;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }
        .slider-container {
            position: relative;
            width: 90%;
            margin: 0 auto;
            overflow: hidden;
        }
        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 100%;
        }
        .slider img {
            width: 100%;
            height: auto;
            flex-shrink: 0; /* Prevent images from shrinking */
        }
        .arrow {
            position: absolute;
            top: 50%;
            width: 40px;
            height: 40px;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 24px;
            line-height: 40px;
            text-align: center;
            border-radius: 50%;
            z-index: 1;
            transform: translateY(-50%);
        }
        .left {
            left: 10px;
        }
        .right {
            right: 10px;
        }

</style>
<script>
    function menuButton() {
        window.location.href = 'menu.php';
    }
</script>
</body>
</html>
