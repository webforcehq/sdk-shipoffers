<?php

namespace WebforceHQ\ShipOffers\Test;

use PHPUnit\Framework\TestCase;
use WebforceHQ\ShipOffers\Client;
use WebforceHQ\ShipOffers\Exceptions\InvalidArgumentException;

//vendor/bin/phpunit src/tests/ClientTest.php
final class ClientTest extends TestCase
{
    /**
     * @test
     */
    public function buildClient(): void
    {
        $client = new Client("myusername", "mypassword", 'asdasdsa');
        $this->assertInstanceOf(Client::class, $client);
    }

    /**
     * @test
     */
    public function itShouldThrowAnErrorDueLackOfUsernam(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Username is a required parameter');
        $client = new Client(null, "mypassword", 'asdasdsa');
    }

     /**
     * @test
     */
    public function itShouldThrowAnErrorDueLackOfPassword(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Password is a required parameter');
        $client = new Client("myusername", null, 'asdasdsa');
    }
}
