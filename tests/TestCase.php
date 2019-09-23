<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function checkValidationIfRequired($data, $login,$route,$keys_not_required = array()){

        foreach($data as $key => $value){
            if(in_array($key, $keys_not_required)) continue;

            $data[$key] = null;
            $response = $this->actingAs($login)->json('POST', route($route),$data);
            $response->assertStatus(422);

            $data[$key] = $value;
        }

    }

}
