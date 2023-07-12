<?php

namespace Thiio\Shipoffers\Test;

use PHPUnit\Framework\TestCase;

use Thiio\Shipoffers\Client;
use Thiio\Shipoffers\Exceptions\ShipOffersException;

class ClientTest extends TestCase
{

    /**
     * @test
     */
    public function buildClient(): void{
        $client = new Client("myusername","mypassword");
        $this->assertInstanceOf(Client::class,$client);
    }

    /**
     * @test
     */
    public function itShouldThrowAnErrorDueLackOfUsernam(): void{
        $client = new Client(null,"mypassword");
        $this->expectException(ShipOffersException::class);
    }

     /**
     * @test
     */
    public function itShouldThrowAnErrorDueLackOfPassword(): void{
        $client = new Client("myusername",null);
        $this->expectException(ShipOffersException::class);
    }

}
