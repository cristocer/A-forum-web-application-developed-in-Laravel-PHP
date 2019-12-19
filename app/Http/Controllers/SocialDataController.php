<?php

namespace App\Http\Controllers;

use App\SocialSites\SiteDetails;
use App\SocialData\FbSocialGateway;
use App\SocialData\SocialGatewayContract;
use Illuminate\Http\Request;

class SocialDataController extends Controller
{   
    //calls the coresponding site: Facebook or Github that is store in the provider
    public function redirectToProvider(SiteDetails $siteDetails,SocialGatewayContract $socialGateway,$provider){
        
        return $siteDetails->callSite($provider);

    }
    public function handleProviderCallback(SiteDetails $siteDetails,SocialGatewayContract $socialGateway,$provider){
        
        return $socialGateway->siteConnect($provider);
    }
}
