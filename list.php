<?php require_once "includes/header.php"; ?>


<section id="main_top">
    <span id="slogan" class="display-2">AnimalShelterFinder</span>
    <!--    <form class="main_top__form form-inline my-2 my-lg-0">-->
    <!--        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">-->
    <!--        <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>-->
    <!--    </form>-->

</section>

<section id="main_map">
    <?php
    //    get token
    require_once "includes/http_functions.php";
    require_once "includes/functions.php";
    $token = getPetFinderToken($PFD_API_KEY,$PFD_SEC);
//    $getUrl = "https://api.petfinder.com/v2/{CATEGORY}/{ACTION}?{parameter_1}={value_1}&{parameter_2}={value_2}";
//    $getUrl = "https://api.petfinder.com/v2/animals?type=dog&page=2";
    $getUrl = "https://api.petfinder.com/v2/animals";
    $headers = array();
    $headers[] = "Authorization: Bearer " . $token;
    // send get request
    $petRes = _httpGet($getUrl, $headers);
    //    echo gettype($petRes); - string
    $animals = json_decode($petRes)->{'animals'};
    //    echo $animals->{'animals'};
    //    var_dump($animals[10]);
    // show needed data
    ?>

    <div class="row">
        <?php
        foreach ($animals as $animal) {
            $type = $animal->{'type'};
            $address = $animal->{'contact'}->{'address'}->{'address1'} . " " . $animal->{'contact'}->{'address'}->{'address2'};
            $name = $animal->{'name'};
            $description = $animal->{'description'};
            $id = $animal->{'id'};

//        echo strlen($address); - 1
            // if length != 1, have address
            $haveAddress = strlen($address) != 1;
//        if ($haveAddress){echo "yes";}
            $photos = $animal->{'photos'};
            if (count($photos) > 0) {
                $imgSrc = $photos[0]->{'large'};
            } else {
                $imgSrc = "img/adopt.png";
            }
//        echo "<img src='" . $imgSrc . "' alt='animal image'/>";
//        echo $address . " --- " . $type . " --- " . $name . "---" . count($photos) . "<br/>";


            echo '<div class="col-sm-4">';
            echo '    <div class="card">';
            echo '<a href="detail.php?id=' . $id . '">';
            echo '        <img class="card-img-top" src="' . $imgSrc . '" alt="Card image cap">';
            echo '</a>';
            echo '<div class="card-body">';
            echo '            <h5 class="card-title">' . $name . '</h5>';
            echo '            <p class="card-text">' . $description . '</p>';
            // only if there is an address, the button is clickable
            if ($haveAddress) {
                echo '            <a href="map.php?address=' . $address . '" class="btn btn-primary">See location on Map</a>';
            } else {
                echo '            <a href="#" class="btn btn-primary disabled">NO ADDRESS</a>';
            }
            echo '<a href="detail.php?id=' . $id . '" class="btn btn-primary ml-2">Detail</a>';
            echo '        </div>';
            echo '</div>';
            echo '</div>';
        }

        ?>
    </div>

    <!--    <div id="map"></div>-->
    <!--    <script>-->
    <!--        var map;-->
    <!---->
    <!--        function initMap() {-->
    <!--            map = new google.maps.Map(document.getElementById('map'), {-->
    <!--                center: {lat: -34.397, lng: 150.644},-->
    <!--                zoom: 8-->
    <!--            });-->
    <!--        }-->
    <!--    </script>-->
    <!--    <script src="https://maps.googleapis.com/maps/api/js?key=--><? //= $GMP_API_KEY; ?><!--&callback=initMap"-->
    <!--            async defer></script>-->


</section>


<?php require_once "includes/footer.php"; ?>
