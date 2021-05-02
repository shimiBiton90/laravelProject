<?php

namespace App\Http\Controllers;

use App\Countries;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CountriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view(null);
    }

    public function getCountries(){
        $countries = Countries::all();
        if(!count($countries)){
            $this->insertCountries();
            $countries = Countries::all();
        }
        return response()->json($countries);
    }


    public function insertCountries(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://restcountries.eu/rest/v2/all',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Cookie: __cfduid=d389d6a350fad353c4b259eac7bc7a89d1619691289'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $data = json_decode($response);
        $countries = array();
        foreach ($data as $country){
            array_push($countries, ["name" => $country->name]);
        }
        DB::table('countries')->insert($countries);

        return $countries;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function show(Countries $countries)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function edit(Countries $countries)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Countries $countries)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function destroy(Countries $countries)
    {
        //
    }
}
