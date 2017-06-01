<?php


namespace PropertyFinder;

/**
 * Class FlightCard
 *
 * @package PropertyFinder
 */
class FlightCard extends Card
{
    /** @var string */
    protected $number;

    /** @var string */
    protected $gate;

    /** @var string */
    protected $seat;

    /** @var string */
    protected $ticketCounter;

    /**
     * FlightCard constructor.
     *
     * @param string $source
     * @param string $destination
     * @param string $number
     * @param string $gate
     * @param string $seat
     * @param string $ticketCounter
     */
    public function __construct(
        string $source,
        string $destination,
        string $number,
        string $gate,
        string $seat,
        string $ticketCounter
    ) {
        parent::__construct($source, $destination);
        $this->number = $number;
        $this->gate = $gate;
        $this->seat = $seat;
        $this->ticketCounter = $ticketCounter;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            "From %s, take flight %s to %s. Gate %s, seat %s.\nBaggage drop at ticket counter %s.",
            $this->source,
            $this->number,
            $this->destination,
            $this->gate,
            $this->seat,
            $this->ticketCounter
        );
    }
}
