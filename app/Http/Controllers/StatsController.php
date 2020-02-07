<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\ForecastService;

class StatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $numberOfStudiesPerDay = $request->request->get('numberOfStudies');
        $monthlyGrowth = $request->request->get('monthlyGrowth');
        $monthsHorizon = $request->request->get('monthsHorizon');

        assert(is_numeric($numberOfStudiesPerDay), 'numberOfStudiesPerDay must be a number');
        assert(is_numeric($monthlyGrowth), 'monthlyGrowth must be a number');
        assert(is_numeric($monthsHorizon), 'monthsHorizon must be a number');

        $forecastService = new ForecastService();

        return $forecastService->predictCostForNumberOfStudies((int)$numberOfStudiesPerDay, (float)$monthlyGrowth, (int)$monthsHorizon);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
