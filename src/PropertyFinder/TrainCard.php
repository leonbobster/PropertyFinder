<?php


namespace PropertyFinder;

/**
 * Class TrainCard
 *
 * @package PropertyFinder
 */
class TrainCard extends Card
{
    /** @var string */
    protected $number;

    /** @var string */
    protected $seat;

    /**
     * TrainCard constructor.
     *
     * @param string $source
     * @param string $destination
     * @param string $number
     * @param string $seat
     */
    public function __construct(string $source, string $destination, string $number, string $seat)
    {
        parent::__construct($source, $destination);
        $this->number = $number;
        $this->seat = $seat;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            'Take train %s from %s to %s. Sit in seat %s.',
            $this->number,
            $this->source,
            $this->destination,
            $this->seat
        );
    }
}
