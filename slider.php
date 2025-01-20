<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Slider</title>
    <style>
        .event-box {
            width: 100%;
            height: 1000px;
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
        .back-btn {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        .back-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="event-box">
        <div class="event">
            <p id="event2">Events</p>
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
        <a href="upload.php" class="back-btn">Back to Upload page</a>
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
</body>
</html>
