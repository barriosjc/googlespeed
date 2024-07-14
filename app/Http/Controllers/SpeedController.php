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
        $apiToken = env("API_TOKEN");
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

            return response()->json($data['lighthouseResult']['categories']);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch data', 'message' => $e->getMessage()], 500);
        }
    }
    
    public function metrics_save(Request $request) {
        
        try {
            $strategy_id = Strategy::where('name', $request->strategy)->first()->id;
            $mhr = new MetricHistoryRun;
            $mhr->url = $request->url;
            $mhr->accessibility_metric = $request->accessibility ?? 0 ;
            $mhr->pwa_metric = $request->pwa ?? 0;
            $mhr->performance_metric = $request->performance ?? 0;
            $mhr->seo_metric = $request->seo ?? 0;
            $mhr->best_practices_metric = $request->bestpractices ?? 0;
            $mhr->strategy_id = $strategy_id;
            $mhr->save();

            return response()->json(['success' => 'Se guardaron correctamento los datos']);
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch data', 'message' => $e->getMessage()], 500);
        }
    }

    public function list_filtro() 
    {
        $mhr = [];
        $categories = Category::all();
        $strategies = Strategy::all();
        
        return view("speed.report", compact('strategies', 'categories', 'mhr')) ;
    }

    public function list_generar(Request $request) 
    {
        $categories = Category::all();
        $strategies = Strategy::all();
        $query = MetricHistoryRun::query();
// dd($request);
        if ($request->has('categories') ) {
            foreach ($request->categories as  $value) {
                $query->where(strtolower($value)."_metric", '>', 0);
            }
        }
        if ($request->has('url') && !empty($request->url)) {
            $query->where('url', '=', $request->url);
        }
        if ($request->has('strategy_id') && !empty($request->strategy_id)) {
            $query->where('strategy_id', '=', $request->strategy_id);
        }
    
        $mhr = $query->orderBy('url', 'asc')
                     ->orderBy('created_at', 'asc')
                     ->get();
  
        return view("speed.report", compact('strategies', 'categories', 'mhr')) ;
    }
}
