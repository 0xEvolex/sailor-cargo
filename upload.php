<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Sailor Cargo - Upload</title>
    <link rel="stylesheet" href="assets/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .background {
            background: url('images/katherine-mccormack-j1egA73qp7c-unsplash.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.9);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 300px;
            display: flex; /* Added */
            flex-direction: column; /* Added */
            justify-content: center; /* Added */
            align-items: center; /* Added */
        }

        h2 {
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        .green-button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-bottom: 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        .green-button:hover {
            background-color: #45a049;
        }

        a {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="container">
            <h2>Upload Result</h2>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $target_dir = "uploads/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true); // Create the directory if it doesn't exist
                }
                $target_file = $target_dir . basename($_FILES["file"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                // Check if the file is an image
                $check = getimagesize($_FILES["file"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    echo "<p>File is not an image.</p>";
                    $uploadOk = 0;
                }

                // Check if the file already exists
                if (file_exists($target_file)) {
                    echo "<p>Sorry, the file already exists.</p>";
                    $uploadOk = 0;
                }

                // Check file size (5MB limit)
                if ($_FILES["file"]["size"] > 5000000) {
                    echo "<p>Sorry, the file is too large.</p>";
                    $uploadOk = 0;
                }

                // Restrict file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</p>";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "<p>Sorry, your file was not uploaded.</p>";
                // If everything is ok, try to upload the file
                } else {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                        echo "<p>The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.</p>";
                        echo "<a class='green-button' href='" . $target_file . "'>Here is your image</a>";
                    } else {
                        echo "<p>Sorry, there was an error uploading your file.</p>";
                    }
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
