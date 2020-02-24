<?php

namespace Modules\Customers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Customers\Entities\MarketingChannel;

class MarketingChannelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $request = new Request();
        $request->name = "Website";
        $website = new MarketingChannel();
        $website->store($request);

        $request->name = "Recommendations";
        $email = new MarketingChannel();
        $email->store($request);

        $request->name = "Passed by";
        $email = new MarketingChannel();
        $email->store($request);

        $request->name = "Google search";
        $google_search = new MarketingChannel();
        $google_search->store($request);

        $request->name = "Instagram";
        $instagram = new MarketingChannel();
        $instagram->store($request);

        $request->name = "Facebook";
        $facebook = new MarketingChannel();
        $facebook->store($request);

        $request->name = "E-mail";
        $email = new MarketingChannel();
        $email->store($request);

        $request->name = "Other";
        $other = new MarketingChannel();
        $other->store($request);

        // $this->call("OthersTableSeeder");
    }
}
