<?php
if (!isset($_COOKIE['dir']) || !isset($_COOKIE['size'])) {
    header("Location: index.php");
} else { ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Image Compressor - VermaTimes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>

    <body>
        <?php include "header.php"; ?>
        <div class="container" style="min-height:100vh">
            <h1 class="py-5">Edit Image Quality</h1>
            <?php
            // echo "<pre>";
            // print_r($_COOKIE['file']);
            // echo "</pre>";
            ?>
            <div class="card mb-3 p-5">
                <div class="col-md-5 d-block mx-auto">
                    <img src="<?php echo $_COOKIE['dir'] ?>" class="img-fluid rounded" alt="compress image online">
                </div>
                <div class="col-md-5 d-block mx-auto">
                    <div class="card-body text-center">
                        <h3 class="card-title text-danger"><?php echo round($_COOKIE['size']) ?> KB <span class="fs-6">(Original Size)</h3>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                            <div class="input-group my-4">
                                <span class="input-group-text bg-secondary text-white">Quality</span>
                                <input value="60" name='quality' type="number" id='quality' class="form-control" data-orgsize="<?php echo round($_COOKIE['size']) ?>">
                                <span class="input-group-text bg-dark text-white">%</span>
                            </div>
                            <p class="my-2">Output : <b><span class="card-text text-success fs-5" id="compressed_size">0 KB</span></b></p>
                            <button type='submit' name="compress" class="btn btn-success my-3">Compress</button>
                        </form>
                        <a href="/" class="btn btn-danger">Upload another Image</a>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    var original_size = $('#quality').attr('data-orgsize');
                    let default_size = Math.round((original_size / 100) * 60);
                    $('#compressed_size').html(default_size + " KB");

                    $('#quality').keyup(function() {
                        let quality = $('#quality').val();
                        let size = Math.round((original_size / 100) * quality);
                        if (size) $('#compressed_size').html(size + " KB");
                    });
                });
            </script>

            <?php
            if (isset($_POST['compress'])) {

                function compress($source, $destination, $quality)
                {

                    $info = getimagesize($source);

                    if ($info['mime'] == 'image/jpeg')
                        $image = imagecreatefromjpeg($source);

                    elseif ($info['mime'] == 'image/gif')
                        $image = imagecreatefromgif($source);

                    elseif ($info['mime'] == 'image/png')
                        $image = imagecreatefrompng($source);

                    imagejpeg($image, $destination, $quality);
                    return $destination;

                }
                $quality = $_POST['quality'];
                if(!$quality) $quality = 60;
                $source_img = $_COOKIE['dir'];
                $destination_img = "compressed/" . $_COOKIE['name'];
                if (compress($source_img, $destination_img, $quality)) {
                    setcookie("compressed", $destination_img, time() + (86400), "/");
                    header("Location: download.php");
                } else {
                    echo "<script>alert('Error Occured!')</script>";
                }
            }


            ?>

        </div>
        <?php include "footer.php" ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } ?>