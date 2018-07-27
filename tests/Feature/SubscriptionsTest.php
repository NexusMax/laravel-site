<?php

namespace Tests\Feature;

use App\Http\Controllers\MyaccountController;
use App\User;
use Illuminate\Http\Request;
use Tests\TestCase;

class SubscriptionsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = User::where('id', 3)->first();
        $this->be($user);

        $request = Request::create('/subscriptions', 'GET');
        $controller = new MyaccountController($request);
        $response = $controller->subscriptions();

        $subscriptionsArray = array_shift($response->getData()['subscriptions']);

        $this->assertInternalType('array', $response->getData());
        $this->assertInternalType('array', $response->getData()['subscriptions']);
        $this->assertArrayHasKey('type', $subscriptionsArray);
        $this->assertArrayHasKey('date', $subscriptionsArray);
        $this->assertArrayHasKey('cost', $subscriptionsArray);
        $this->assertInternalType('string', $subscriptionsArray['type']);
        $this->assertInternalType('string', $subscriptionsArray['date']);
        $this->assertInternalType('string', $subscriptionsArray['cost']);
        $this->assertEquals('месяц', explode(' ', $subscriptionsArray['type'])[1]);
        $this->assertLessThanOrEqual(12, explode(' ', $subscriptionsArray['type'])[0]);
        $this->assertGreaterThanOrEqual(1, explode(' ', $subscriptionsArray['type'])[0]);
    }
}
