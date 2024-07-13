<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\MetricHistoryRun;
use App\Models\Strategy;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class SpeedController extends Controller
{
    public function index(){
        $strategies = Strategy::orderBy("name","desc")->get();
        $categories = Category::orderBy("name","desc")->get();
        $mhr = new MetricHistoryRun;
        return view("speed.inputs", compact('strategies', 'categories', 'mhr')) ;
    }

    public function getApiData(Request $request)
    {
        $client = new Client();
        $apiToken = "AIzaSyDCrPAzhzWxZbJxPYIEURODTvBFVVRNHbY";
        $url = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed";
        $url = $url . "?url=" . $request->url;
        $url = $url . "&key=" . $apiToken;
        foreach ($request->categories as $category) {
            $url = $url . "&category=" . $category;
        }
        $url = $url . "&strategy=" . $request->strategy;

        try {
            // $url = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url=https://broobe.com&key=$apiToken&category=PERFORMANCE&category=SEO&strategy=DESKTOP";
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Accept' => 'application/json',
                ],
                'verify' => false,
            ]);
    
            $data = json_decode($response->getBody(), true);


            // return view('speed.inputs', compact('data'));
            return response()->json($data['lighthouseResult']['categories']);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch data', 'message' => $e->getMessage()], 500);
        }
    }
    
}
