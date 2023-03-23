<?php
if (!isset($_COOKIE['compressed'])) {
    header("Location: index.php");
} else { ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Download Compressed Image</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </head>

    <body>
        <?php include "header.php"; ?>
        <div class="container" style="min-height:100vh">
        <div class="alert alert-success my-4" role="alert">
                            <h2 class="alert-heading">Image is Compressed!</h2>
                            <p>Aww yeah, Your Image has been Compressed Successfully.</p>
                            <hr>
                            <p class="mb-0">Click the Button below to Download.</p>
                        </div>

            <div class="card mb-3 p-5">
            
                <div class="col-md-5 d-block mx-auto">
                    <img src="<?php echo $_COOKIE['compressed'] ?>" class="img-fluid rounded" alt="download compressed image">
                </div>
                <div class="col-md-5 d-block mx-auto">
                    <div class="card-body text-center">
                        
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                            <button type='submit' name="download" class="btn btn-primary my-3">Download</button>
                        </form>
                        <a href="/" class="btn btn-danger">Upload another Image</a>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {

                });
            </script>

            <?php
            if (isset($_POST['download'])) {
                if (headers_sent()) {
                    echo 'HTTP header already sent';
                } else {
                    ob_end_clean();
                    header("Content-Type: application/image");
                    header("Content-Disposition: attachment; filename=\"" . basename($_COOKIE['compressed']) . "\"");
                    readfile($_COOKIE['compressed']);
                    exit;
                }
            }


            ?>

        </div>
        <?php include "footer.php" ?>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>

    </html>
<?php } ?>