<?php

namespace PropertyFinder;

use PropertyFinder\Exception\RoundTripException;
use PropertyFinder\Exception\TripBuilderException;

/**
 * Class TripBuilder
 *
 * @package PropertyFinder
 */
class TripBuilder
{
    /**
     * @param Card[] $cards
     *
     * @return Card
     *
     * @throws TripBuilderException
     */
    public function build(array $cards): Card
    {
        $sources = $destinations = [];
        foreach ($cards as $card) {
            $sources[$card->getSource()] = $card;
            $destinations[$card->getDestination()] = $card;
        }
        $start = null;
        /** @var Card $card */
        foreach ($sources as $source => $card) {
            $dst = $card->getDestination();
            if (isset($sources[$dst])) {
                $card->setNext($sources[$dst]);
            }
            if (empty($destinations[$source])) { // starting point
                $start = $card;
            }
        }
        if ($start === null) {
            throw new RoundTripException;
        }
        return $start;
    }
}
