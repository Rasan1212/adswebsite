<?php

namespace App\Components\Gateways;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Contracts\GatewayInterface;
use Illuminate\Support\Facades\Config;

class PayStack implements GatewayInterface
{
    protected $request;
    protected $config;

    public function __construct(Request $request, array $config)
    {
        $this->request = $request;
        $this->config = $config;
    }

    public function isActive(): bool
    {
        return (bool) setting('paystack_allow', 0);
    }

    public function isConfigured(): bool
    {
        return (Config::get('paystack.publicKey') != null && Config::get('paystack.secretKey') != null);
    }

    public function getName(): string
    {
        return "PayStack";
    }

    public function getIcon(): string
    {
        return '<svg width="16" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 578 512">
<path d="M181.4,250.5c-0.6-1.4-1.3-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9
	c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6c-1.1,2.9-1.1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4
	c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3c1-1.1,1.8-2.3,2.3-3.7C182.3,256.7,182.4,253.5,181.4,250.5z M181.4,250.5
	c-0.6-1.4-1.3-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5
	c-0.9,1-1.8,2.2-2.3,3.6c-1.1,2.9-1.1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4c1.4,0.6,2.8,0.9,4.3,0.9
	c2.9,0,5.7-1.2,7.7-3.3c1-1.1,1.8-2.3,2.3-3.7C182.3,256.7,182.4,253.5,181.4,250.5z M181.4,250.5c-0.6-1.4-1.3-2.6-2.3-3.6
	c-0.9-1-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6
	c-1.1,2.9-1.1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3
	c1-1.1,1.8-2.3,2.3-3.7C182.3,256.7,182.4,253.5,181.4,250.5z M236.1,250.5c-0.6-1.4-1.4-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4
	c-2.6-1.3-5.8-1.3-8.5,0c-1.4,0.6-2.5,1.5-3.5,2.5c-1,1.1-1.8,2.2-2.3,3.6c-1,2.9-1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7
	s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0c1.3-0.6,2.4-1.5,3.4-2.5c1-1.1,1.8-2.3,2.3-3.7C237.3,256.7,237.3,253.5,236.1,250.5z
	 M236.1,250.5c-0.6-1.4-1.4-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-2.6-1.3-5.8-1.3-8.5,0c-1.4,0.6-2.5,1.5-3.5,2.5
	c-1,1.1-1.8,2.2-2.3,3.6c-1,2.9-1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0c1.3-0.6,2.4-1.5,3.4-2.5
	c1-1.1,1.8-2.3,2.3-3.7C237.3,256.7,237.3,253.5,236.1,250.5z M181.4,250.5c-0.6-1.4-1.3-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4
	c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6c-1.1,2.9-1.1,6.1,0,9
	c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3c1-1.1,1.8-2.3,2.3-3.7
	C182.3,256.7,182.4,253.5,181.4,250.5z M181.4,250.5c-0.6-1.4-1.3-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9
	s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6c-1.1,2.9-1.1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4
	c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3c1-1.1,1.8-2.3,2.3-3.7C182.3,256.7,182.4,253.5,181.4,250.5z M236.1,250.5
	c-0.6-1.4-1.4-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-2.6-1.3-5.8-1.3-8.5,0c-1.4,0.6-2.5,1.5-3.5,2.5c-1,1.1-1.8,2.2-2.3,3.6
	c-1,2.9-1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0c1.3-0.6,2.4-1.5,3.4-2.5c1-1.1,1.8-2.3,2.3-3.7
	C237.3,256.7,237.3,253.5,236.1,250.5z M236.1,250.5c-0.6-1.4-1.4-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-2.6-1.3-5.8-1.3-8.5,0
	c-1.4,0.6-2.5,1.5-3.5,2.5c-1,1.1-1.8,2.2-2.3,3.6c-1,2.9-1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0
	c1.3-0.6,2.4-1.5,3.4-2.5c1-1.1,1.8-2.3,2.3-3.7C237.3,256.7,237.3,253.5,236.1,250.5z M181.4,250.5c-0.6-1.4-1.3-2.6-2.3-3.6
	c-0.9-1-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6
	c-1.1,2.9-1.1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3
	c1-1.1,1.8-2.3,2.3-3.7C182.3,256.7,182.4,253.5,181.4,250.5z M181.4,250.5c-0.6-1.4-1.3-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4
	c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6c-1.1,2.9-1.1,6.1,0,9
	c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3c1-1.1,1.8-2.3,2.3-3.7
	C182.3,256.7,182.4,253.5,181.4,250.5z M236.1,250.5c-0.6-1.4-1.4-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-2.6-1.3-5.8-1.3-8.5,0
	c-1.4,0.6-2.5,1.5-3.5,2.5c-1,1.1-1.8,2.2-2.3,3.6c-1,2.9-1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0
	c1.3-0.6,2.4-1.5,3.4-2.5c1-1.1,1.8-2.3,2.3-3.7C237.3,256.7,237.3,253.5,236.1,250.5z M427.2,250.5c-0.5-1.4-1.3-2.6-2.3-3.6
	s-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.7,2.2-2.2,3.6c-1,2.9-1,6.1,0,9
	c0.4,1.4,1.2,2.7,2.2,3.7s2.2,1.9,3.5,2.5c1.4,0.6,2.7,0.9,4.3,0.9c1.6,0,3-0.3,4.4-0.9c1.3-0.6,2.4-1.5,3.4-2.5
	c1-1.1,1.8-2.3,2.3-3.7C428.3,256.7,428.3,253.5,427.2,250.5z M427.2,250.5c-0.5-1.4-1.3-2.6-2.3-3.6s-2.1-1.8-3.4-2.4
	c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.7,2.2-2.2,3.6c-1,2.9-1,6.1,0,9
	c0.4,1.4,1.2,2.7,2.2,3.7s2.2,1.9,3.5,2.5c1.4,0.6,2.7,0.9,4.3,0.9c1.6,0,3-0.3,4.4-0.9c1.3-0.6,2.4-1.5,3.4-2.5
	c1-1.1,1.8-2.3,2.3-3.7C428.3,256.7,428.3,253.5,427.2,250.5z M236.1,250.5c-0.6-1.4-1.4-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4
	c-2.6-1.3-5.8-1.3-8.5,0c-1.4,0.6-2.5,1.5-3.5,2.5c-1,1.1-1.8,2.2-2.3,3.6c-1,2.9-1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7
	s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0c1.3-0.6,2.4-1.5,3.4-2.5c1-1.1,1.8-2.3,2.3-3.7C237.3,256.7,237.3,253.5,236.1,250.5z
	 M181.4,250.5c-0.6-1.4-1.3-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9
	c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6c-1.1,2.9-1.1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4
	c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3c1-1.1,1.8-2.3,2.3-3.7C182.3,256.7,182.4,253.5,181.4,250.5z M557,32H21.1
	C9.5,32,0,41.5,0,53.1v405.7C0,470.5,9.5,480,21.1,480h535.8c11.6,0,21.1-9.5,21.1-21V53.1C578,41.5,568.5,32,557,32z M33,223.5
	c0-2.4,2-4.4,4.3-4.4h68.6c2.4,0,4.3,2,4.4,4.5v7.7c-0.1,2.4-2,4.4-4.4,4.4H37.3c-2.3,0-4.3-2-4.3-4.4V223.5z M80.2,295.8
	c0,2.3-1.9,4.3-4.3,4.3H37.3c-2.3,0-4.3-2-4.3-4.4V288c0-1.2,0.5-2.2,1.3-3c0.8-0.9,1.9-1.3,3-1.3h38.6c2.4-0.1,4.3,1.9,4.3,4.4
	V295.8z M110.3,274.2c-0.1,2.5-2,4.4-4.4,4.4H37.3c-2.3,0-4.3-2-4.3-4.4v-7.8c0-1.2,0.4-2.2,1.3-3c0.8-0.9,1.9-1.3,3-1.3h68.6
	c2.4,0,4.2,1.9,4.4,4.3V274.2z M114.5,252.7c0,2.4-1.9,4.4-4.3,4.4H37.3c-2.3,0-4.3-2-4.3-4.4v-7.8c0-1.1,0.5-2.2,1.2-3
	c0.8-0.9,1.9-1.3,3-1.3h73c2.3,0.1,4.3,2,4.3,4.3V252.7z M195.1,265.5c-1.2,3-2.9,5.7-5.1,8c-2.1,2.2-4.7,3.9-7.5,5.1
	c-2.9,1.2-5.9,1.8-9,1.8c-2.7,0-5.3-0.6-7.9-1.5c-1.9-0.7-3.7-1.8-5.1-3.3v21.8c0.1,0.8-0.3,1.5-0.8,1.9c-0.5,0.5-1.1,0.8-1.8,0.8
	h-9.7c-0.7,0-1.3-0.3-1.8-0.8c-0.4-0.5-0.7-1.2-0.7-1.9v-63.8c-0.1-0.7,0.2-1.4,0.7-1.9c0.4-0.6,1.1-0.9,1.8-0.9h9.5
	c0.8,0,1.5,0.4,1.9,0.9c0.4,0.5,0.7,1.2,0.7,1.9v1.4c1.4-1.5,3-2.6,4.8-3.5c2.7-1.3,5.6-2,8.6-1.9c3.1,0,6.1,0.6,8.9,1.8
	c2.8,1.2,5.3,2.9,7.4,5.1c2.2,2.3,3.9,5,5.1,7.9c1.3,3.4,2,7,1.9,10.6C197.1,258.5,196.5,262.2,195.1,265.5z M251.7,276.8
	c0,0.7-0.3,1.4-0.8,1.9c-0.4,0.5-1.1,0.8-1.8,0.8h-9.6c-0.7,0-1.3-0.4-1.8-0.8c-0.5-0.5-0.8-1.2-0.8-1.9v-1.3
	c-1.2,1.3-2.8,2.4-4.4,3.3c-2.6,1.3-5.5,2-8.4,1.9c-6.2,0-12.1-2.5-16.5-6.9c-2.3-2.3-4-5-5.3-8c-1.4-3.4-2.1-7-2-10.6
	c0-3.7,0.6-7.3,2-10.6c1.2-3,3-5.7,5.3-8c4.5-4.3,10.4-6.8,16.6-6.8c2.9,0,5.8,0.6,8.4,1.9c1.7,0.7,3.2,1.8,4.4,3.3v-1.2
	c0-0.8,0.3-1.5,0.8-2c0.4-0.5,1.1-0.8,1.8-0.8h9.6c0.7,0,1.4,0.3,1.8,0.9c0.4,0.5,0.7,1.2,0.7,1.9V276.8z M306.1,235l-15.9,51.9
	c-1.2,4.2-3.7,8-6.9,10.9c-3.2,2.6-7.3,4-12.2,4c-2.7,0-5.5-0.5-8.1-1.4c-2.4-0.8-4.5-2.1-6.4-3.8c-0.9-0.8-1.7-2.2-0.3-4.4l3.4-5
	c0.5-0.9,1.5-1.4,2.5-1.5h0.1c1,0,1.8,0.3,2.5,0.8c0.8,0.6,1.7,1.1,2.6,1.5c0.9,0.3,1.9,0.6,2.9,0.6c1.2,0.1,2.3-0.3,3.2-1
	c1-0.8,1.7-1.8,2.1-3l1.3-3.8l0.5-1.4h-5.8c-0.7,0-1.5-0.3-2-0.8c-0.5-0.4-0.7-1.1-1-1.7L254.9,235c-0.3-0.8-0.3-1.7,0-2.6
	c0.4-1.1,1.2-1.5,2.7-1.5h11c0.8,0,1.5,0.3,2,0.9c0.5,0.6,0.7,1.2,0.9,1.8l8.5,29.7h2l8-29.7c0.1-0.7,0.5-1.3,1-1.8
	c0.6-0.6,1.3-0.9,2.2-0.9H304c1.5,0,2.1,0.6,2.2,1.3C306.5,233,306.4,234,306.1,235z M348.4,270.2c-1,2.1-2.5,3.9-4.4,5.3
	c-2,1.5-4.3,2.6-6.8,3.4c-2.8,0.9-5.8,1.2-8.8,1.2c-6.4,0.2-12.7-1.7-18-5.3c-2.1-1.6-3.2-2.9-3.5-4.4c-0.3-1.4,0.3-2.8,1.5-3.7
	l4.2-3.2c1.1-0.9,2.2-1.2,3.1-0.9c0.8,0.4,1.5,0.8,2.2,1.3c1.5,1.2,3.1,2.3,4.9,3.2c1.9,1,4.1,1.4,6.1,1.4s3.6-0.4,4.5-1.1
	c1-0.7,1.4-1.4,1.4-2.3c0-0.9-0.5-1.8-1.4-2.1c-1.6-0.7-3.3-1.2-4.9-1.5l-7.7-1.7c-4-0.8-7.1-2.5-9.5-4.8c-2.4-2.3-3.6-5.6-3.6-9.6
	c0-2.1,0.6-4.2,1.5-6.2c1-2,2.4-3.7,4.2-5.1c2-1.4,4.2-2.5,6.5-3.3c2.7-0.9,5.5-1.3,8.4-1.2c4.7,0,8.7,0.6,11.9,2
	c3.2,1.4,5.5,2.7,7,4c0.8,0.7,1.3,1.6,1.4,2.6c-0.1,1-0.4,1.8-1.1,2.5l-3.5,4c-1.3,1.5-3.2,1.8-5.3,0.4c-1.6-1.1-3.2-1.8-4.9-2.6
	c-1.7-0.7-3.6-1.1-5.5-1.1c-1.5-0.1-2.8,0.2-4.1,0.9c-1,0.5-1.4,1.2-1.4,2s0.4,1.5,1,1.9c0.7,0.6,2,1.2,3.9,1.5l7.3,1.5
	c1.8,0.4,3.8,0.9,5.6,1.7c1.7,0.7,3.3,1.7,4.7,2.9c1.4,1.2,2.5,2.7,3.4,3.8c0.9,1.9,1.3,4,1.2,6
	C349.9,265.8,349.4,268.2,348.4,270.2z M390.7,275.2c-1.7,1.8-3.8,3.1-6.2,3.9c-2.5,0.9-5.3,1.3-7.9,1.3c-2.1,0-4.1-0.3-6.1-0.9
	c-2-0.5-3.8-1.4-5.3-2.7c-1.7-1.4-2.9-3-3.8-4.9c-1.1-2.3-1.6-4.7-1.5-7.2V244h-5.5c-0.8,0-1.5-0.3-1.9-0.9
	c-0.4-0.5-0.7-1.2-0.7-1.9v-7.4c0-0.7,0.3-1.4,0.7-1.9c0.5-0.6,1.2-0.9,1.9-0.9h5.5v-12c0-0.7,0.4-1.4,0.9-1.9s1.2-0.8,1.9-0.8h9.7
	c0.7,0.1,1.3,0.4,1.8,0.8c0.5,0.4,0.8,1.2,0.8,1.9v11.9h12.5c0.7,0,1.4,0.3,1.9,0.8c0.6,0.4,0.9,1.1,0.9,1.9v7.4
	c0,0.8-0.4,1.4-0.9,1.9c-0.5,0.6-1.2,0.9-2,0.9h-12.5V261c-0.1,0.9,0.1,1.7,0.4,2.6c0.2,0.6,0.6,1.1,1,1.5c0.4,0.4,0.8,0.6,1.3,0.7
	c0.5,0.1,1,0.2,1.4,0.2c1.3-0.1,2.7-0.5,3.9-1.3c0.7-0.5,1.6-0.8,2.5-0.8c0.9,0.2,1.7,0.7,2.1,1.5l3.5,5.6
	C391.9,272.3,391.8,274.2,390.7,275.2z M442.7,276.8c0,1.5-1.1,2.6-2.6,2.6h-9.6c-0.7,0-1.3-0.3-1.8-0.8c-0.5-0.4-0.8-1.1-0.8-1.8
	v-1.3c-1.2,1.3-2.7,2.4-4.4,3.3c-2.6,1.2-5.5,1.9-8.4,1.8c-6.3,0-12.1-2.5-16.5-6.9c-2.2-2.3-4.1-5-5.3-8c-1.4-3.4-2.1-7-2-10.6
	c0-3.6,0.6-7.2,2-10.5c1.2-3,3-5.7,5.3-8c4.5-4.3,10.4-6.8,16.6-6.8c2.9,0,5.8,0.6,8.4,1.9c1.8,0.7,3.2,1.8,4.4,3.3v-1.2
	c0-0.8,0.3-1.5,0.8-2s1.1-0.8,1.8-0.8h9.6c0.8,0,1.5,0.3,1.8,0.9c0.4,0.5,0.7,1.2,0.7,1.9V276.8z M494.5,269
	c-2.1,3.4-5.1,6.1-8.6,8.1c-3.7,2.1-8,3.2-12.9,3.2c-6.9,0-13.3-2.5-18.2-7.3c-2.4-2.2-4.2-5-5.5-8c-2.6-6.4-2.6-13.6,0-20
	c1.3-3.1,3.2-5.8,5.5-8.1c2.3-2.3,5-4.1,8.1-5.4c3.3-1.3,6.7-2,10.1-2c4.9,0,9.2,1.2,12.9,3.2c3.5,1.9,6.4,4.7,8.5,8
	c0.6,0.8,0.6,1.7,0.3,2.6c-0.3,0.8-0.8,1.5-1.5,1.9l-5.5,4.2c-1,0.9-2,1.1-2.9,0.8c-0.8-0.4-1.5-0.9-2-1.5c-1.2-1.5-2.6-2.8-4.2-3.8
	c-1.6-1-3.5-1.5-5.4-1.4c-1.6,0-3,0.3-4.4,0.9c-1.3,0.5-2.4,1.4-3.4,2.4s-1.7,2.2-2.2,3.6c-0.5,1.5-0.8,3-0.8,4.5s0.3,2.9,0.8,4.4
	c0.6,2.1,2,3.8,3.8,5.1c1.8,1.3,3.9,1.9,6.1,1.9c1.9,0.2,3.7-0.4,5.4-1.3c1.6-1.1,3-2.3,4.2-3.8c0.5-0.6,1.2-1.2,2-1.5
	c0.9-0.3,1.9-0.1,2.9,0.8l5.5,4.3c0.7,0.5,1.2,1.2,1.7,1.7C495,267.2,494.9,268.2,494.5,269z M544.6,277.7c-0.3,0.7-1,1.5-2.6,1.5
	h-10.8c-1.3,0-2.6-0.7-3.3-2l-11.3-17.4h-2.7v16.8c0,0.7-0.3,1.4-0.8,1.9c-0.4,0.5-1.1,0.8-1.8,0.8h-9.6c-0.7,0-1.4-0.3-1.9-0.8
	s-0.8-1.1-0.8-1.9V213c0-0.7,0.3-1.4,0.8-1.9s1.2-0.8,1.9-0.8h9.6c0.7,0,1.3,0.3,1.8,0.8s0.8,1.2,0.8,1.9v34.5h2.5l10.4-14.6
	c0.3-0.6,0.8-1.2,1.5-1.5c0.5-0.2,1.1-0.4,1.7-0.4h10.3c1.6,0,2.2,0.7,2.5,1.4c0.4,0.9,0.1,2-0.5,2.8l-13.1,17.2l15.3,22.4
	C545.1,275.7,545.2,276.8,544.6,277.7z M424.9,246.8c-1-1-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9
	c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.7,2.2-2.2,3.6c-1,2.9-1,6.1,0,9c0.4,1.4,1.2,2.7,2.2,3.7s2.2,1.9,3.5,2.5
	c1.4,0.6,2.7,0.9,4.3,0.9c1.6,0,3-0.3,4.4-0.9c1.3-0.6,2.4-1.5,3.4-2.5c1-1.1,1.8-2.3,2.3-3.7c1.1-2.9,1.1-6.1,0-9.1
	C426.7,249,425.9,247.8,424.9,246.8z M233.8,246.8c-0.9-1-2.1-1.8-3.4-2.4c-2.6-1.3-5.8-1.3-8.5,0c-1.4,0.6-2.5,1.5-3.5,2.5
	c-1,1.1-1.8,2.2-2.3,3.6c-1,2.9-1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0c1.3-0.6,2.4-1.5,3.4-2.5
	c1-1.1,1.8-2.3,2.3-3.7c1.1-2.9,1.1-6-0.1-9.1C235.5,249,234.7,247.8,233.8,246.8z M179.1,246.8c-0.9-1-2.1-1.8-3.4-2.4
	c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6c-1.1,2.9-1.1,6.1,0,9
	c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3c1-1.1,1.8-2.3,2.3-3.7
	c1-2.9,1.1-6,0.1-9.1C180.8,249,180.1,247.8,179.1,246.8z M181.4,250.5c-0.6-1.4-1.3-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4
	c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6c-1.1,2.9-1.1,6.1,0,9
	c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3c1-1.1,1.8-2.3,2.3-3.7
	C182.3,256.7,182.4,253.5,181.4,250.5z M236.1,250.5c-0.6-1.4-1.4-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-2.6-1.3-5.8-1.3-8.5,0
	c-1.4,0.6-2.5,1.5-3.5,2.5c-1,1.1-1.8,2.2-2.3,3.6c-1,2.9-1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0
	c1.3-0.6,2.4-1.5,3.4-2.5c1-1.1,1.8-2.3,2.3-3.7C237.3,256.7,237.3,253.5,236.1,250.5z M427.2,250.5c-0.5-1.4-1.3-2.6-2.3-3.6
	s-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.7,2.2-2.2,3.6c-1,2.9-1,6.1,0,9
	c0.4,1.4,1.2,2.7,2.2,3.7s2.2,1.9,3.5,2.5c1.4,0.6,2.7,0.9,4.3,0.9c1.6,0,3-0.3,4.4-0.9c1.3-0.6,2.4-1.5,3.4-2.5
	c1-1.1,1.8-2.3,2.3-3.7C428.3,256.7,428.3,253.5,427.2,250.5z M427.2,250.5c-0.5-1.4-1.3-2.6-2.3-3.6s-2.1-1.8-3.4-2.4
	c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.7,2.2-2.2,3.6c-1,2.9-1,6.1,0,9
	c0.4,1.4,1.2,2.7,2.2,3.7s2.2,1.9,3.5,2.5c1.4,0.6,2.7,0.9,4.3,0.9c1.6,0,3-0.3,4.4-0.9c1.3-0.6,2.4-1.5,3.4-2.5
	c1-1.1,1.8-2.3,2.3-3.7C428.3,256.7,428.3,253.5,427.2,250.5z M236.1,250.5c-0.6-1.4-1.4-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4
	c-2.6-1.3-5.8-1.3-8.5,0c-1.4,0.6-2.5,1.5-3.5,2.5c-1,1.1-1.8,2.2-2.3,3.6c-1,2.9-1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7
	s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0c1.3-0.6,2.4-1.5,3.4-2.5c1-1.1,1.8-2.3,2.3-3.7C237.3,256.7,237.3,253.5,236.1,250.5z
	 M181.4,250.5c-0.6-1.4-1.3-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9
	c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6c-1.1,2.9-1.1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4
	c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3c1-1.1,1.8-2.3,2.3-3.7C182.3,256.7,182.4,253.5,181.4,250.5z M181.4,250.5
	c-0.6-1.4-1.3-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5
	c-0.9,1-1.8,2.2-2.3,3.6c-1.1,2.9-1.1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4c1.4,0.6,2.8,0.9,4.3,0.9
	c2.9,0,5.7-1.2,7.7-3.3c1-1.1,1.8-2.3,2.3-3.7C182.3,256.7,182.4,253.5,181.4,250.5z M236.1,250.5c-0.6-1.4-1.4-2.6-2.3-3.6
	c-0.9-1-2.1-1.8-3.4-2.4c-2.6-1.3-5.8-1.3-8.5,0c-1.4,0.6-2.5,1.5-3.5,2.5c-1,1.1-1.8,2.2-2.3,3.6c-1,2.9-1,6.1,0,9
	c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0c1.3-0.6,2.4-1.5,3.4-2.5c1-1.1,1.8-2.3,2.3-3.7
	C237.3,256.7,237.3,253.5,236.1,250.5z M236.1,250.5c-0.6-1.4-1.4-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-2.6-1.3-5.8-1.3-8.5,0
	c-1.4,0.6-2.5,1.5-3.5,2.5c-1,1.1-1.8,2.2-2.3,3.6c-1,2.9-1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0
	c1.3-0.6,2.4-1.5,3.4-2.5c1-1.1,1.8-2.3,2.3-3.7C237.3,256.7,237.3,253.5,236.1,250.5z M181.4,250.5c-0.6-1.4-1.3-2.6-2.3-3.6
	c-0.9-1-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6
	c-1.1,2.9-1.1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3
	c1-1.1,1.8-2.3,2.3-3.7C182.3,256.7,182.4,253.5,181.4,250.5z M181.4,250.5c-0.6-1.4-1.3-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4
	c-1.5-0.6-2.9-0.9-4.4-0.9s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6c-1.1,2.9-1.1,6.1,0,9
	c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3c1-1.1,1.8-2.3,2.3-3.7
	C182.3,256.7,182.4,253.5,181.4,250.5z M236.1,250.5c-0.6-1.4-1.4-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-2.6-1.3-5.8-1.3-8.5,0
	c-1.4,0.6-2.5,1.5-3.5,2.5c-1,1.1-1.8,2.2-2.3,3.6c-1,2.9-1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0
	c1.3-0.6,2.4-1.5,3.4-2.5c1-1.1,1.8-2.3,2.3-3.7C237.3,256.7,237.3,253.5,236.1,250.5z M236.1,250.5c-0.6-1.4-1.4-2.6-2.3-3.6
	c-0.9-1-2.1-1.8-3.4-2.4c-2.6-1.3-5.8-1.3-8.5,0c-1.4,0.6-2.5,1.5-3.5,2.5c-1,1.1-1.8,2.2-2.3,3.6c-1,2.9-1,6.1,0,9
	c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.9,3.5,2.5c2.7,1.3,5.9,1.3,8.6,0c1.3-0.6,2.4-1.5,3.4-2.5c1-1.1,1.8-2.3,2.3-3.7
	C237.3,256.7,237.3,253.5,236.1,250.5z M181.4,250.5c-0.6-1.4-1.3-2.6-2.3-3.6c-0.9-1-2.1-1.8-3.4-2.4c-1.5-0.6-2.9-0.9-4.4-0.9
	s-2.9,0.3-4.3,0.9c-1.3,0.6-2.5,1.5-3.5,2.5c-0.9,1-1.8,2.2-2.3,3.6c-1.1,2.9-1.1,6.1,0,9c0.5,1.4,1.3,2.7,2.3,3.7s2.2,1.8,3.5,2.4
	c1.4,0.6,2.8,0.9,4.3,0.9c2.9,0,5.7-1.2,7.7-3.3c1-1.1,1.8-2.3,2.3-3.7C182.3,256.7,182.4,253.5,181.4,250.5z"/>
</svg>';
    }

    public function getViewName()
    {
        return "checkout.paystack";
    }

    public function initialize()
    {
    }

    public function render()
    {
        return view('checkout.paystack')->render();
    }

    public function processPayment($transaction)
    {
        $request = $this->request;
        $plan_id = $request->plan_id;
        if ($plan_id == 0) {
            $plan = ads_plan();
        } else {
            $plan = Plan::find($request->plan_id); //get from plan db
        }

        if ($request->type == "yearly") {
            $amount = $plan->yearly_price;
            $var_type = "addAnnualPlan";
        } else {
            $amount = $plan->monthly_price;
            $var_type = "addMonthlyPlan";
        }

        $data = array(
            "amount" => (int) $amount * 100,
            "reference" => $transaction->id,
            "email" => $request->email,
            "currency" =>  setting('currency', "USD"),
            "orderID" => $transaction->id,
        );

        $transaction->transaction_id = $transaction->id;
        $transaction->save();


        return paystack()->getAuthorizationUrl($data)->redirectNow();
    }

    public function verifyPayment($transaction, $request): bool
    {
        return paystack()->isTransactionVerificationValid($transaction->id);
    }
}
