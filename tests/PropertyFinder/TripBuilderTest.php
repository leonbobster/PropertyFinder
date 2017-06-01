<?php

namespace tests\PropertyFinder;

use PropertyFinder\Card;
use PropertyFinder\TripBuilder;

/**
 * Class TripBuilderTest
 *
 * @package tests\PropertyFinder
 */
class TripBuilderTest extends CardTestCase
{
    /** @var TripBuilder */
    protected $builder;

    public function setUp()
    {
        parent::setUp();
        $this->builder = new TripBuilder;
    }

    /** @test */
    public function build_should_create_continuous_trip()
    {
        $cards = $this->createTrip(5);
        shuffle($cards);

        $this->assertEquals(
            [1, 2, 3, 4, 5, 6],
            iterator_to_array($this->builder->build($cards)->toRoute())
        );
    }

    /**
     * @test
     * @expectedException \PropertyFinder\Exception\RoundTripException
     */
    public function build_should_throw_round_trip_exception()
    {
        $this->builder->build([
            $this->createCard(1, 2),
            $this->createCard(2, 1)
        ]);
    }

    /**
     * @param int $n Number of legs.
     *
     * @return Card[]
     */
    protected function createTrip($n): array
    {
        return array_map(function ($i) {
            return $this->createCard($i, $i + 1);
        }, range(1, $n));
    }
}
