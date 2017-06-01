<?php


namespace PropertyFinder;

use InvalidArgumentException;
use ReflectionClass;
use RuntimeException;

/**
 * Class CardFactory
 *
 * @package PropertyFinder
 */
class CardFactory
{
    /** @var ReflectionClass */
    private $reflection;

    /**
     * @param array $spec
     *
     * @return Card
     */
    public function createCard(array $spec): Card
    {
        $class = key($spec);
        if (null === $class || !is_string($class)) {
            throw new InvalidArgumentException('You should define a class of the Card.');
        }
        $this->reflection = new ReflectionClass($class);
        /** @var Card $card */
        $card = $this->reflection->newInstanceArgs($this->constructorArgs($spec[$class]));
        if (!$card instanceof Card) {
            throw new RuntimeException(sprintf(
                'Only instance of "%s" can be created.',
                Card::class
            ));
        }
        return $card;
    }

    /**
     * @param array $spec
     *
     * @return Card[]
     */
    public function createArray(array $spec): array
    {
        return array_map(function (array $spec) {
            return $this->createCard($spec);
        }, $spec);
    }

    /**
     * @param array $spec
     *
     * @return array
     */
    private function constructorArgs(array $spec): array
    {
        $args = [];
        $constructor = $this->reflection->getConstructor();
        if ($constructor === null) {
            return $args;
        }
        $params = $constructor->getParameters();
        foreach ($params as $param) {
            $val = $spec[$param->name] ?? null;
            if (!isset($spec[$param->name]) && !$param->isDefaultValueAvailable()) {
                throw new RuntimeException(sprintf(
                    'Not able to create Card, mandatory constructor parameter "%s" is missing.',
                    $param->name
                ));
            }
            $args[] = $val;
        }
        return $args;
    }
}
