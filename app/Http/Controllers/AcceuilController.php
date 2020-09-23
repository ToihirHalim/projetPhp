<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActiveCases;
use App\DailyCases;
use App\TotalCases;
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
        $activeCases = ActiveCases::all();
        $dailyCases = DailyCases::all();
        $totalCases = TotalCases::all();
        $contamines = Situation::wheresituation('Positif')->get();
        $nbreTest = Formulaire::whereresultat('Positif')->count();
        $nbreTest += Formulaire::whereresultat('Negatif')->count();
        $nbreContamine = $contamines->count();
        $nbreRecovered = Situation::wheresituation('Recovered')->count();
        
        $datesActiveCases = [];
        $valuesActiveCases = [];
        $datesDailyCases = [];
        $valuesDailyCases = [];
        $datesTotalCases = [];
        $valuesTotalCases = [];
        $villes = [];
        $contamineParVille = [];


        foreach($activeCases as $element){
            array_push($valuesActiveCases, $element->value);
            array_push($datesActiveCases, date('m/d', strtotime($element->date)));
        }
        foreach($dailyCases as $element){
            array_push($valuesDailyCases, $element->value);
            array_push($datesDailyCases, date('m/d', strtotime($element->date)));
        }
        foreach($totalCases as $element){
            array_push($valuesTotalCases, $element->value);
            array_push($datesTotalCases, date('m/d', strtotime($element->date)));
        }
        foreach($contamines as $element){
            $ville = $element->user->infoPersonnelle->ville;
            array_push($villes, $ville);
        }
        
        $villes = array_count_values($villes);
        $contamineParVille = array_values($villes);
        $villes = array_keys($villes);
        
        $activeCases = [
            'values' => $valuesActiveCases,
            'dates' => $datesActiveCases,
        ];
        $dailyCases = [
            'values' => $valuesDailyCases,
            'dates' => $datesDailyCases,
        ];
        $totalCases = [
            'values' => $valuesTotalCases,
            'dates' => $datesTotalCases,
        ];
        $datavilles = [
            'ville' => $villes,
            'nombreCases' => $contamineParVille,
        ];
        $data = [
            'activeCases' => $activeCases,
            'dailyCases' => $dailyCases,
            'totalCases' => $totalCases,
            'dataVilles' => $datavilles,
            'nbreTest' => $nbreTest,
            'nbreContamine' => $nbreContamine,
            'nbreRecovered' => $nbreRecovered,
        ];

        return view('acceuil', [
            'data'=> $data,
        ]);
    }
}
