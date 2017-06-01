<?php


namespace PropertyFinder;

/**
 * Class DummyDecorator
 *
 * Just for demo purpose.
 *
 * @package PropertyFinder
 */
class DummyDecorator implements StringifiableInterface
{
    /** @var Card */
    private $card;

    /**
     * DummyDecorator constructor.
     *
     * @param Card $card
     */
    public function __construct(Card $card)
    {
        $this->card = $card;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '-> ' . $this->card;
    }
}
