<?php

namespace App\Http\Controllers;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class DealController extends Controller
{
    /**
     * Display all the Deals. 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deals = $this->getDeals();

        return view('deals', ['deals' => $deals]);
    }

    
    /**
     * Display a listing of filtered Deals.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter($category)
    {
        $deals = $this->getDeals();

        return view('deals', ['deals' => $deals->where('category', $category)]);
    }

    /**
     * Display the specified Deal.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $deals = $this->getDeals();

        return view('deal_detail', ['deal' => $deals->where('unique', $id)->first()]);
    }

    /**
     * Return the Deals supplied by the socialdeal API
     */
    protected function getDeals(): Collection
    {
        $request = null;
        try {
            //We put this code in a try/catch because the enpoint could fail. 
            $request = (new Client)->get('https://media.socialdeal.nl/demo/deals.jso');
        } catch (Exception $e) {
            //Here we log what happend. Could implement BugSnag here. 
            Log::error('Retrieving the deals failed.');

            //We return an empty collection because the endpoint failed. In the view it will handle the empty collection. 
            return new Collection();
        }
        
        //If the endpoint returned data we will return it as a collection so it can be used like Eloquent. It's sorted if present in the request.
        return collect(json_decode($request->getBody())->deals)->sortBy(request()->sorting);
    }
}
