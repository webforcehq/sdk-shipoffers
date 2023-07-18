<?php

namespace thiio\shipoffers\Test;

use PHPUnit\Framework\TestCase;

use thiio\shipoffers\Client;
use thiio\shipoffers\exceptions\InvalidArgumentException;

class ClientTest extends TestCase
{
    /**
     * @test
     */
    public function buildClient(): void{
        $client = new Client("myusername","mypassword" , 'asdasdsa');
        $this->assertInstanceOf(Client::class,$client);
    }

    /**
     * @test
     */
    public function itShouldThrowAnErrorDueLackOfUsernam(): void{
        $client = new Client(null,"mypassword", 'asdasdsa');
        $this->expectException(InvalidArgumentException::class);
    }

     /**
     * @test
     */
    public function itShouldThrowAnErrorDueLackOfPassword(): void{
        $client = new Client("myusername",null, 'asdsdas');
        $this->expectException(InvalidArgumentException::class);
    }
}
