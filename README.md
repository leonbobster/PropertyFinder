# PropertyFinder

I believe TripBuilder sorts cards with O(2n) &asymp; O(n) complexity.
https://github.com/leonbobster/PropertyFinder/blob/master/src/PropertyFinder/TripBuilder.php#L22

### Requirements:
PHP7.0+

### Installation:
You should have composer installed on the machine you run application.
```
composer install
php index.php
```

### Run tests:
```
./vendor/bin/phpunit tests/
```

### Usage example:
```php
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
foreach ($trip->iterator() as $leg) {
    echo new DummyDecorator($leg) . PHP_EOL; // Decorator pattern demo
}
echo 'You have arrived at your final destination.';
```
