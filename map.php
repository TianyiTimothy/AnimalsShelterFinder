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


    <?php

    $address = "Toronto";

    if (isset($_GET['address'])) {
//        echo $_GET['address'];
        // keys
        require_once "keys/keys.php";
        // send get request
        require_once "includes/http_functions.php";

        $address = $_GET['address'];

    } else {
        // todo show all shelters near user
    }
    ?>

    <div id="map"></div>
    <script>
        var map;
        var geocoder;
        var marker;
        var pos;

        function initMap() {
            // use address to get lat & lng from geocoder
            var address = "<?= $address; ?>";
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address': address}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    // alert(results[0].geometry.location);
                    //alert("<?//= $address; ?>//");
                    pos = results[0].geometry.location;

                    map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 12,
                        center: pos
                    });

                    marker = new google.maps.Marker({
                        position: pos,
                        map: map,
                        // bouncing marker
                        animation: google.maps.Animation.BOUNCE
                    });
                }
            });

        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=<?= $GMP_API_KEY; ?>&callback=initMap"
            async defer></script>

</section>


<?php require_once "includes/footer.php"; ?>
