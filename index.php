<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Image Compressor - VermaTimes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <?php include "header.php"; ?>
    <div class="container" style="min-height:100vh">
        <h1 class="py-5">Compress Images Online</h1>

        <p>Accepted Formats: <span class="badge bg-secondary">JPG/JPEG</span> <span class="badge bg-secondary">PNG</span> <span class="badge bg-secondary">Gif</span></p>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <input type="file" class="form-control" id="examplefile" name="gimage" accept="image/*" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Upload</button>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            if (isset($_FILES['gimage'])) {
                $name = $_FILES['gimage']['name'];
                $temp = $_FILES['gimage']['tmp_name'];
                $size = $_FILES['gimage']['size'] / 1024;
                $dir = "database/$name";
                if (move_uploaded_file($temp, $dir)) {
                    setcookie("dir", $dir, time() + (86400), "/");
                    setcookie("size", $size, time() + (86400), "/");
                    setcookie("name", $name, time() + (86400), "/");
                    header("Location: compress.php");
                    // echo "<script>location.href='compress.php';</script>";
                } else {
                    echo "<script>alert('error occured! try again')</script>";
                }
            }
        }

        ?>
        <div style="margin: 150px auto 30px auto">
            <h4>What is image compression?</h4>
            <p>Image compression is a process applied to a graphics file to minimize its size in bytes without degrading image quality below an acceptable threshold. By reducing the file size, more images can be stored in a given amount of disk or memory space. The image also requires less bandwidth when being transmitted over the internet or downloaded from a webpage, reducing network congestion and speeding up content delivery.</p>
            <h4>What is the use of image compression?</h4>
            <p>The objective of image compression is to reduce irrelevance and redundancy of the image data to be able to store or transmit data in an efficient form. It is concern with minimizing the number of bits require to represent an image. Image compression may be lossy or lossless.</p>
            <h4>What is need of image compression?</h4>
            <p>The objective is to reduce irrelevance and redundancy of the image data to be able to store or transmit data in an efficient form. It is concern with minimizing the number of bits require to represent an image. This may be lossy or lossless.</p>
            <h4>What are advantages of image compression?</h4>
            <p>It takes up less space on the hard drive and retains the same physical size, unless edit the image’s physical size in an image editor. The file size reduction with the help of internet, to create image rich sites without using much bandwidth or storage space.</p>
        </div>
    </div>
    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>