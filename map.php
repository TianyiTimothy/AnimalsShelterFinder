<?php require_once "includes/header.php"; ?>
<?php require_once "keys/keys.php";

if (!isset($_SESSION['access_token'])) {
    header("Location: login.php");
}
?>


<section id="main_top">
    <span id="slogan" class="display-2">AnimalShelterFinder</span>
    <form class="main_top__form form-inline my-2 my-lg-0">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
    </form>

</section>

<section id="main_map">

    <div id="map"></div>
    <script>
        var map;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: 43.6532, lng: -79.3832},
                zoom: 16
            });
        }
    </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=
<?= $GMP_API_KEY; ?>&callback=initMap"
                async defer></script>

    <?php
    //    https://maps.googleapis.com/maps/api/place/findplacefromtext/json?
    //input=Museum%20of%20Contemporary%20Art%20Australia&
    //inputtype=textquery&
    //fields=photos,formatted_address,name,rating,opening_hours,geometry&
    //key=YOUR_API_KEY
    // get parameters
    if (isset($_GET['address'])) {
//        echo $_GET['address'];
        // keys
        require_once "keys/keys.php";
        // send get request
        require_once "includes/http_functions.php";
        $res = _httpGet("https://maps.googleapis.com/maps/api/place/findplacefromtext/json?" .
            "input=" . $_GET['address'] .
//            "&inputtype=textquery&" .
//            "fields=photos,formatted_address,name,rating,opening_hours,geometry&" .
            "key=" . $GMP_API_KEY);
//        var_dump($res);
        ?>
<!--        <script src="https://maps.googleapis.com/maps/api/place/findplacefromtext/json?key=--><?//= $GMP_API_KEY; ?><!--&input=--><?//= $_GET['address']; ?><!--" async defer></script>-->

        <?php

    } else {
//        echo "nope";
    }
    ?>

</section>


<?php require_once "includes/footer.php"; ?>
