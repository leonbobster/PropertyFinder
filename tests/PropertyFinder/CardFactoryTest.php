<?php


namespace tests\PropertyFinder;


use PHPUnit\Framework\TestCase;
use PropertyFinder\AirportBusCard;
use PropertyFinder\CardFactory;
use PropertyFinder\FlightCard;
use PropertyFinder\TrainCard;
use InvalidArgumentException;
use RuntimeException;
use stdClass;

class CardFactoryTest extends TestCase
{
    /** @var CardFactory */
    protected $factory;

    public function setUp()
    {
        parent::setUp();
        $this->factory = new CardFactory;
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function create_card_should_throw_exception_if_class_is_not_defined()
    {
        $this->factory->createCard([]);
    }

    /**
     * @test
     * @expectedException RuntimeException
     */
    public function create_card_should_throw_runtime_exception_if_mandatory_constructor_param_is_missing(
    )
    {
        $this->factory->createCard([TrainCard::class => []]);
    }

    /**
     * @test
     * @expectedException RuntimeException
     */
    public function create_card_should_throw_exception_if_try_to_create_not_a_card()
    {
        $this->factory->createCard([stdClass::class => []]);
    }

    /** @test */
    public function create_card_should_create_train_card()
    {
        $spec = [
            TrainCard::class => [
                'source'      => 'Foo',
                'destination' => 'Bar',
                'number'      => '678A',
                'seat'        => '3D'
            ]
        ];

        $card = $this->factory->createCard($spec);

        $this->assertInstanceOf(TrainCard::class, $card);
        $array = (array)$card;;
        foreach ($spec[TrainCard::class] as $key => $val) {
            $this->assertEquals($val, $array["\0*\0{$key}"]);
        }
    }

    /** @test */
    public function create_card_should_create_flight_card()
    {
        $spec = [
            FlightCard::class => [
                'ticketCounter' => '556',
                'source'        => 'Foo',
                'destination'   => 'Bar',
                'number'        => '678A',
                'gate'          => '18',
                'seat'          => '3D'
            ]
        ];

        $card = $this->factory->createCard($spec);

        $this->assertInstanceOf(FlightCard::class, $card);
        $array = (array)$card;;
        foreach ($spec[FlightCard::class] as $key => $val) {
            $this->assertEquals($val, $array["\0*\0{$key}"]);
        }
    }

    /** @test */
    public function create_card_should_create_airport_bus_card()
    {
        $spec = [
            AirportBusCard::class => [
                'source'      => 'Foo',
                'destination' => 'Bar'
            ]
        ];

        $card = $this->factory->createCard($spec);

        $this->assertInstanceOf(AirportBusCard::class, $card);
        $array = (array)$card;;
        foreach ($spec[AirportBusCard::class] as $key => $val) {
            $this->assertEquals($val, $array["\0*\0{$key}"]);
        }
    }
}