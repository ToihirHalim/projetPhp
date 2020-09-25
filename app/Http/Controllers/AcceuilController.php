<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Track;
use App\Situation;
use App\Formulaire;


class AcceuilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $track = app('App\Http\Controllers\FormulaireController')->lastTrack();

        $tracks = Track::all();

        $nbreTest = Formulaire::whereresultat('Positif')->count();
        $nbreTest += Formulaire::whereresultat('Negatif')->count();
        $nbreRecovered = Situation::wheresituation('Recovered')->count();
        $datavilles = 
        $activeCases = [];
        $totalCases = [];
        $dailyCases = [];
        $dailyRecovered = [];
        $dates = [];

        $villes = app('App\Http\Controllers\ApiController')->carte();
        $datavilles = [
            'ville' => array_keys($villes['villes']),
            'nombreCases' => array_values($villes['villes'])
        ];

        foreach($tracks as $element){
            array_push($activeCases, $element->activeCases);
            array_push($totalCases, $element->totalCases);
            array_push($dailyCases, $element->dailyCases);
            array_push($dailyRecovered, $element->dailyRecovered);
            array_push($dates, date('m/d', strtotime($element->date)));
        }

        $data = [
            'activeCases' => $activeCases,
            'dailyCases' => $dailyCases,
            'totalCases' => $totalCases,
            'dates' => $dates,
            'dailyRecovered' => $dailyRecovered,
            'nbreTest' => $nbreTest,
            'nbreContamine' => $track->activeCases,
            'nbreRecovered' => $nbreRecovered,
            'dataVilles' => $datavilles
        ];

        return view('acceuil', [
            'data'=> $data,
        ]);
    }
}
