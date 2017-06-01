<?php


namespace PropertyFinder;

/**
 * Class AirportBusCard
 *
 * @package PropertyFinder
 */
class AirportBusCard extends Card
{
    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'Take the airport bus from %s to %s. No seat assignment.',
            $this->source,
            $this->destination
        );
    }
}
