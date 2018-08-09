# PropertyFinder

O(n) complexity
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


/*
From Kiev, take flight KV333 to Madrid. Gate 12, seat 14B.
Baggage drop at ticket counter 77.
Take train 78A from Madrid to Barcelona. Sit in seat 45B.
Take the airport bus from Barcelona to Gerona Airport. No seat assignment.
From Gerona Airport, take flight SK455 to Stockholm. Gate 45B, seat 3A.
Baggage drop at ticket counter 344.
From Stockholm, take flight B323 to Berlin. Gate 12C, seat 12A.
Baggage drop at ticket counter 567.
You have arrived at your final destination.
*/
```
