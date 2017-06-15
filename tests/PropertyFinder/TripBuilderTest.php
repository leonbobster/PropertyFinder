<?php

namespace tests\PropertyFinder;

use PHPUnit\Framework\TestCase;
use PropertyFinder\AirportBusCard;
use PropertyFinder\Card;
use PropertyFinder\FlightCard;
use PropertyFinder\TrainCard;
use PropertyFinder\TripBuilder;

/**
 * Class TripBuilderTest
 *
 * @package tests\PropertyFinder
 */
class TripBuilderTest extends TestCase
{
    public function test_build()
    {
        $cards = [
            new FlightCard('Kiev', 'Madrid', 'KV333', '12', '14B', '77'),
            new TrainCard('Madrid', 'Barcelona', '78A', '45B'),
            new AirportBusCard('Barcelona', 'Gerona Airport'),
            new FlightCard('Gerona Airport', 'Stockholm', 'SK455', '45B', '3A', '344'),
            new FlightCard('Stockholm', 'Berlin', 'B323', '12C', '12A', '567')
        ];
        $cardToString = function (Card $card): string {
            return $card->__toString();
        };
        $strings = array_map($cardToString, $cards);
        $iterator = iterator_to_array((new TripBuilder)->build($cards)->iterator());
        shuffle($cards);
        $this->assertEquals(
            $strings,
            array_map($cardToString, $iterator)
        );
    }
}
