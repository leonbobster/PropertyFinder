<?php


namespace tests\PropertyFinder;


use PHPUnit\Framework\TestCase;
use PropertyFinder\Card;

class CardTestCase extends TestCase
{
    /**
     * @param int $source
     * @param int $destination
     *
     * @return Card
     */
    protected function createCard($source, $destination)
    {
        return new class($source, $destination) extends Card
        {
            public function __toString(): string
            {
                return sprintf('%s -> %s', $this->source, $this->destination);
            }
        };
    }
}
