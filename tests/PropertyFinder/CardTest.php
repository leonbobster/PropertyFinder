<?php

namespace tests\PropertyFinder;

use Iterator;

class CardTest extends CardTestCase
{
    /** @test */
    public function to_route_should_return_iterator_of_destinations()
    {
        $trip = $this->createCard(1, 2);
        $next = $this->createCard(2, 3);
        $next->setNext($this->createCard(3, 4));
        $trip->setNext($next);

        $this->assertInstanceOf(Iterator::class, $trip->toRoute());
        $this->assertEquals([1, 2, 3, 4], iterator_to_array($trip->toRoute()));
    }
}
