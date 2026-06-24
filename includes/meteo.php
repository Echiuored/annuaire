<?php

//$apiKey = "30fda8beedb4bfbc946910554fca3587";

$apiKey = "790967dfed625d7cc12f0ee5d13a8733";
$ville = "Villeurbanne";

$url = "https://api.openweathermap.org/data/2.5/weather?q="
    . urlencode($ville)
    . "&appid=" . $apiKey
    . "&units=metric&lang=fr";

$response = file_get_contents($url);

$data = json_decode($response, true);

$villeAffichee = $data["name"]; // 👈 ville officielle API
$temperature = $data["main"]["temp"];
$description = $data["weather"][0]["description"];
$icone = $data["weather"][0]["icon"];
?>