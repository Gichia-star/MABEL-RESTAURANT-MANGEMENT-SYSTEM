<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload and Manage Images</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #4CAF50;
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: center;
        }
        input[type="file"] {
            margin: 10px 0;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .delete-form {
            text-align: center;
        }
        .feedback {
            text-align: center;
            color: #d9534f;
            font-weight: bold;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #4CAF50;
            text-decoration: none;
            font-size: 16px;
        }
        a:hover {
            text-decoration: underline;
        }
        .back-button {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        .back-button a {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #007bff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
        }
        .back-button a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Upload and Manage Promotions / Event Images</h2>

        <!-- Upload Form -->
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <input type="file" name="image1" accept="image/*"><br>
                <input type="file" name="image2" accept="image/*"><br>
                <input type="file" name="image3" accept="image/*"><br>
                <input type="submit" name="upload" value="Upload Images">
            </div>
        </form>

        <!-- Delete Form -->
        <form action="upload.php" method="post" class="delete-form">
            <div class="form-group">
                <select name="imagePath">
                    <?php
                    // Populate select options with existing images
                    if (file_exists('images.json')) {
                        $imagePaths = json_decode(file_get_contents('images.json'), true);
                        if ($imagePaths) {
                            foreach ($imagePaths as $imagePath) {
                                echo '<option value="' . $imagePath . '">' . basename($imagePath) . '</option>';
                            }
                        } else {
                            echo '<option value="">No images available</option>';
                        }
                    }
                    ?>
                </select><br>
                <input type="submit" id="delete-btn" name="delete" value="Delete Image">
            </div>
        </form>

        <a href="slider.php">View Slider</a>

        <div class="back-button">
            <a href="adminsystem.html">Back to Admin System</a>
        </div>

        <?php
        // Handle image upload
        if (isset($_POST['upload'])) {
            $target_dir = "uploads/";

            // Ensure the uploads directory exists
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $imagePaths = [];

            // Load existing image paths
            if (file_exists('images.json')) {
                $existingPaths = json_decode(file_get_contents('images.json'), true);
                if ($existingPaths) {
                    $imagePaths = $existingPaths;
                }
            }

            for ($i = 1; $i <= 3; $i++) {
                if (!empty($_FILES["image" . $i]["name"])) {
                    $target_file = $target_dir . basename($_FILES["image" . $i]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Check if image file is an actual image or fake image
                    $check = getimagesize($_FILES["image" . $i]["tmp_name"]);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        echo '<div class="feedback">File is not an image.</div>';
                        $uploadOk = 0;
                    }

                    // Check file size
                    if ($_FILES["image" . $i]["size"] > 5000000) {
                        echo '<div class="feedback">Sorry, your file is too large.</div>';
                        $uploadOk = 0;
                    }

                    // Allow certain file formats
                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {
                        echo '<div class="feedback">Sorry, only JPG, JPEG, PNG & GIF files are allowed.</div>';
                        $uploadOk = 0;
                    }

                    // Check if $uploadOk is set to 0 by an error
                    if ($uploadOk == 0) {
                        echo '<div class="feedback">Sorry, your file was not uploaded.</div>';
                    // if everything is ok, try to upload file
                    } else {
                        if (move_uploaded_file($_FILES["image" . $i]["tmp_name"], $target_file)) {
                            $imagePaths[] = $target_file;
                        } else {
                            echo '<div class="feedback">Sorry, there was an error uploading your file.</div>';
                        }
                    }
                }
            }

            // Save image paths to a JSON file
            if (!empty($imagePaths)) {
                $jsonData = json_encode(array_unique($imagePaths));
                file_put_contents('images.json', $jsonData);
                echo '<div class="feedback" style="color: #5bc0de;">Images have been uploaded successfully.</div>';
            } else {
                echo '<div class="feedback">No images were uploaded.</div>';
            }
        }

        // Handle image deletion
        if (isset($_POST['delete'])) {
            $imagePath = $_POST['imagePath'];

            // Check if the file exists and delete it
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Load existing image paths from JSON file
            $imagePaths = [];
            if (file_exists('images.json')) {
                $imagePaths = json_decode(file_get_contents('images.json'), true);
            }

            // Remove the deleted image path from the array
            if (($key = array_search($imagePath, $imagePaths)) !== false) {
                unset($imagePaths[$key]);
            }

            // Save updated image paths back to JSON file
            $jsonData = json_encode(array_values($imagePaths));
            file_put_contents('images.json', $jsonData);

            // Feedback to user
            echo '<div class="feedback" style="color: #5bc0de;">Image has been deleted successfully.</div>';
        }
        ?>
    </div>
</body>
</html>
