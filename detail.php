<?php
$url = "https://api.petfinder.com/v2/animals/";
$id=0;
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $getUrl = $url . $id;
    $headers = array();
    $headers[] = "Authorization: Bearer " . $token;
    // send get request
    $petRes = _httpGet($getUrl, $headers);
    //    echo gettype($petRes); - string
    $animals = json_decode($petRes)->{'animals'};
}
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
<?php require_once "includes/header.php";?>
<main id="main">
    <section id="main_top">
        <span id="slogan" class="display-2">AnimalShelterFinder</span>
<!--        <form class="main_top__form form-inline my-2 my-lg-0">-->
<!--            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
<!--            <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>-->
<!--        </form>-->

    </section>

    <section id="main_map">

<?= $id ?>


    </section>


</main>

</body>

</html>
