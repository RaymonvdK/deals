<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deals = $this->getDeals();

        return view('deals', ['deals' => $deals]);
    }

    
    /**
     * Display a listing of filtered resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function filter($category)
    {
        $deals = $this->getDeals();

        return view('deals', ['deals' => $deals->where('category', $category)]);
    }

    /**
     * Display the specified resource.
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
     * Return the deals supplied by the socialdeal API
     */
    protected function getDeals(): Collection
    {
        $request = (new Client)->get('https://media.socialdeal.nl/demo/deals.json');
        
        return collect(json_decode($request->getBody())->deals)->sortBy(request()->sortby);
    }
}
