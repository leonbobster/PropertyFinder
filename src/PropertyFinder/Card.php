<?php

namespace PropertyFinder;

use Iterator;

/**
 * Class Card
 */
abstract class Card
{
    /** @var string */
    protected $source;

    /** @var string */
    protected $destination;

    /** @var Card */
    protected $next;

    /**
     * Card constructor.
     *
     * @param string $source
     * @param string $destination
     */
    public function __construct($source, $destination)
    {
        $this->source = $source;
        $this->destination = $destination;
    }

    /**
     * @return string
     */
    abstract public function __toString(): string;

    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @param Card $card
     */
    public function setNext(Card $card)
    {
        $this->next = $card;
    }

    /**
     * @return Card|null
     */
    public function getNext()
    {
        return $this->next;
    }

    /**
     * @return Iterator
     */
    public function iterator(): Iterator
    {
        return new class($this) implements Iterator
        {
            /** @var Card */
            protected $root;

            /** @var Card */
            protected $current;

            /** @var int */
            protected $key = 0;

            /**
             *  constructor.
             *
             * @param Card $root
             */
            public function __construct(Card $root)
            {
                $this->root = $this->current = $root;
            }

            /**
             * @return Card
             */
            public function current()
            {
                return $this->current;
            }

            public function next()
            {
                $this->key++;
                return $this->current = $this->current->getNext();
            }

            /**
             * @return int
             */
            public function key()
            {
                return $this->key;
            }

            /**
             * @return bool
             */
            public function valid()
            {
                return $this->current !== null;
            }

            public function rewind()
            {
                $this->current = $this->root;
            }

        };
    }
}
