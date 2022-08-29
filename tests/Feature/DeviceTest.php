<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Device;
use Str;

class DeviceTest extends TestCase
{
    /**
     * Required feilds validation test
     * @return void
     */
    public function testRequiredFields()
    {
        $releaseDate = Carbon::today()->subDays(rand(0, 365));
        $device = [
            'id' => Str::uuid(),
            'model' => '',
            'brand' => '',
            'release_date' => $releaseDate->format('Y/d'),
            'os' => 'iOS',
            'is_new' => rand(0, 1),
            'received_datetime' => ''
        ];

        $response = $this->postJson('api/device', $device);

        $response
            ->assertStatus(200);
    }


    /**
     * release_date format test expected YYYY/MM
     * @return void
     */
    public function testReleaseDate()
    {
        $releaseDate = Carbon::today()->subDays(rand(0, 365));

        $device = [
            'id' => Str::uuid(),
            'model' => 'Andriod',
            'brand' => 'Chrome',
            'release_date' => $releaseDate->format('Y/d/m'),
            'os' => 'cOS',
            'is_new' => rand(0, 1),
            'received_datetime' => ''
        ];

        $response = $this->postJson('api/device', $device);

        $response
            ->assertStatus(200);
    }


}
