<?php

require_once __DIR__ . '/vendor/autoload.php';

use PropertyFinder\TrainCard;
use PropertyFinder\AirportBusCard;
use PropertyFinder\TripBuilder;
use PropertyFinder\FlightCard;


$cards = [
    new TrainCard('Madrid', 'Barcelona', '78A', '45B'),
    new AirportBusCard('Barcelona', 'Gerona Airport'),
    new FlightCard('Gerona Airport', 'Stockholm', 'SK455', '45B', '3A', '344'),
    new FlightCard('Stockholm', 'Berlin', 'B323', '12C', '12A', '567'),
    new FlightCard('Kiev', 'Madrid', 'KV333', '12', '14B', '77')
];

shuffle($cards);

foreach ((new TripBuilder)->build($cards)->iterator() as $card) {
    echo $card . PHP_EOL;
}
echo 'You have arrived at your final destination.';