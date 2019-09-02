<?php

namespace Modules\Companies\Tests;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompaniesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
{
    $response = $this->get('/companies');

    $response->assertViewHas('company');

    /*$routedata = $response->original->getData()['routedata'];
    $client = $response->original->getData()['client'];
    $clientProfile = $response->original->getData()['clientProfile '];

    $response->assertInstanceOf('\Illuminate\Database\Eloquent\Collection', $routedata);
    $response->assertInstanceOf('\App\Client', $client);
    $response->assertInstanceOf('\App\ClientProfile', $clientProfile);*/

}
}
