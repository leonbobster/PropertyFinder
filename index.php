<?php

require_once __DIR__ . '/vendor/autoload.php';

use PropertyFinder\TrainCard;
use PropertyFinder\AirportBusCard;
use PropertyFinder\TripBuilder;
use PropertyFinder\FlightCard;
use PropertyFinder\CardFactory;
use PropertyFinder\DummyDecorator;

$spec = [
    [
        TrainCard::class => [
            'source'      => 'Madrid',
            'destination' => 'Barcelona',
            'number'      => '78A',
            'seat'        => '45B'
        ]
    ],
    [
        AirportBusCard::class => [
            'source'      => 'Barcelona',
            'destination' => 'Gerona Airport'
        ]
    ],
    [
        FlightCard::class => [
            'source'        => 'Gerona Airport',
            'destination'   => 'Stockholm',
            'number'        => 'SK455',
            'gate'          => '45B',
            'seat'          => '3A',
            'ticketCounter' => '344'
        ]
    ],
    [
        FlightCard::class => [
            'source'        => 'Stockholm',
            'destination'   => 'Berlin',
            'number'        => 'B323',
            'gate'          => '12C',
            'seat'          => '12A',
            'ticketCounter' => '567'
        ]
    ]
];

// you can create tickets from a spec array
$cards = (new CardFactory)->createArray($spec);
// or instantiate directly whenever you want
$cards[] = new FlightCard('Kiev', 'Madrid', 'KV333', '12', '14B', '77');

shuffle($cards);

$trip = (new TripBuilder)->build($cards);
foreach ($trip->iterator() as $card) {
    echo new DummyDecorator($card) . PHP_EOL; // Decorator pattern demo
}
echo 'You have arrived at your final destination.';