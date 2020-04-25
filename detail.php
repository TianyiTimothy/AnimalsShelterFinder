<?php
require_once "keys/keys.php";
require_once "includes/functions.php";

$url = "https://api.petfinder.com/v2/animals/";
$id = 0;
if (!isset($_GET['id'])) {
    header("Location: list.php");
}else{

$id = $_GET['id'];
$getUrl = $url . $id;

// get token
$token = getPetFinderToken($PFD_API_KEY, $PFD_SEC);

// set token into header
$headers = array();
$headers[] = "Authorization: Bearer " . $token;

// send get request
$petRes = _httpGet($getUrl, $headers);

$animal = json_decode($petRes)->{'animal'};
$name = $animal->{'name'};
$type = $animal->{'type'};
$age = $animal->{'age'};
$gender = $animal->{'gender'};
$size = $animal->{'size'};
$coat = $animal->{'coat'} ?: "Unknown";
$email = $animal->{'contact'}->{'email'};
$address = $animal->{'contact'}->{'address'}->{'address1'} . " " .
$animal->{'contact'}->{'address'}->{'address2'} === " " ? "Unknown" : $animal;
$city = $animal->{'contact'}->{'address'}->{'city'} . ", " . $animal->{'contact'}->{'address'}->{'state'} . ", " .
    $animal->{'contact'}->{'address'}->{'country'};
$postcode = $animal->{'contact'}->{'address'}->{'postcode'};
$phone = $animal->{'contact'}->{'phone'} ?: "Unknown";
$status = $animal->{'status'};
$updated = $animal->{'status_changed_at'};

$photos = $animal->{'photos'};
//    var_dump($photos);

// get results
//    $animal = json_decode($petRes)->{'animals'};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Animals Shelter Finder</title>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/base.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
</head>

<body>
<?php require_once "includes/header.php"; ?>
<main id="main">
    <section id="main_top">
        <span id="slogan" class="display-2">AnimalShelterFinder</span>
        <!--        <form class="main_top__form form-inline my-2 my-lg-0">-->
        <!--            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
        <!--            <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>-->
        <!--        </form>-->
        <a href="list.php" class="btn btn-dark">Back</a>

    </section>

    <section id="main_info">
        <div id="animalImages" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <?php

                if (count($photos) > 0) {
                    foreach ($photos as $key => $photo) {
                        $image = $photo->{'large'};
//                        echo $image;
                        // todo try another way of ternary operation
                        $class = $key == 0 ? "carousel-item active" : "carousel-item";
                        echo '<div class="' . $class . '">';
                        echo '<img class="d-block w-100" src="' . $image . '" alt="picture of ' . $name . '" />';
                        echo '</div>';
                    }
                } else {
                    // no image from api, use default instead
                    $image = "img/adopt.png";
                    echo '<div class="carousel-item active">';
                    echo '<img class="d-block w-100" src="' . $image . '" alt="picture of ' . $name . '"';
                    echo '</div>';
                }

                ?>
            </div>
            <a class="carousel-control-prev" href="#animalImages" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#animalImages" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <div class="card">
            <?php
            // if starts with "a", use "an" instead of "a" to match funny English grammar
            $grammarStatus = strpos($status, 'a') === 0 ? 'an ' : 'a ';
            echo '<h1>' . $name . ' is ' . $grammarStatus . $status . ' ' . $type . '</h1>';
            ?>
            <div class="card">
                <div class="card-header">About</div>
                <div class="card-body">
                    <?php
                    //            var_dump($petRes);
                    echo '<dl class="row">';
                    echo '<dt class="col-sm-2">Age</dt>';
                    echo '<dd class="col-sm-4">' . $age . '</dd>';
                    echo '<dt class="col-sm-2">Gender</dt>';
                    echo '<dd class="col-sm-4">' . $gender . '</dd>';
                    echo '<dt class="col-sm-2">Size</dt>';
                    echo '<dd class="col-sm-4">' . $size . '</dd>';
                    echo '<dt class="col-sm-2">Coat</dt>';
                    echo '<dd class="col-sm-4">' . $coat . '</dd>';
                    echo '</dl>';


                    //            echo '<ul class="list-inline font-weight-bold">';
                    //            echo '<li class="list-inline-item">'.$age.'</li>';
                    //            echo '| ';
                    //            echo '<li class="list-inline-item">'.$gender.'</li>';
                    //            echo '| ';
                    //            echo '<li class="list-inline-item">'.$size.'</li>';
                    //            echo '| ';
                    //            echo '<li class="list-inline-item">'.$coat.'</li>' . ' Hair';
                    //            echo '</ul>';
                    }

                    ?>
                </div>
            </div>
            <div class="card"> <!--style="width: 20rem"-->
                <div class="card-header">Contact</div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-4">Address:</dt>
                        <dd class="col-sm-8"><?= $address; ?></dd>
                        <dt class="col-sm-4">City:</dt>
                        <dd class="col-sm-8"><?= $city; ?></dd>
                        <dt class="col-sm-4">Postcode:</dt>
                        <dd class="col-sm-8"><?= $postcode; ?></dd>
                        <dt class="col-sm-4">Email:</dt>
                        <dd class="col-sm-8"><?= $email; ?></dd>
                        <dt class="col-sm-4">Phone:</dt>
                        <dd class="col-sm-8"><?= $phone; ?></dd>
                    </dl>

                </div>
                <div class="card-footer text-muted">
                    <dl class="row">
                        <dt class="col-sm-4">Updated:</dt>
                        <dd class="col-sm-8"><?= date('Y-m-d', strtotime($updated)); ?></dd>
                    </dl>
                </div>
            </div>
        </div>

    </section>


</main>

</body>

</html>
