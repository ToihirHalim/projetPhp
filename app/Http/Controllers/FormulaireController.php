<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Formulaire;
use App\User;
use App\ActiveCases;
use App\DailyCases;
use App\TotalCases;
use App\Situation;

class FormulaireController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showTraite(Formulaire $formulaire){
        $formulaire = $this->getvalues($formulaire);

        return view('formulaire.show',[
            'formulaire' => $formulaire,
        ]);
    }

    public function showNonTraite(Formulaire $formulaire){
        $formulaire = $this->getvalues($formulaire);
        
        return view('formulaire.treat',[
            'formulaire' => $formulaire,
        ]);
    }

    public function create(){

        $resultat1 = request('myCheck1');
        $resultat2 = request('myCheck2');
        $resultat3 = request('myCheck3');
        $resultat4 = request('myCheck4');
        $resultat5 = request('myCheck5');
        $resultat6 = request('myCheck6');
        $resultat7 = request('myCheck7');
        $resultat8 = request('myCheck8');
        $resultat9 = request('myCheck9');
        $resultat11 = request('myCkeck11');
        $resultat12 = request('myCkeck12');
        $resultat13 = request('myCkeck13');
        $resultat14 = request('myCkeck14');
        $resultat15 = request('myCkeck15');
        $resultat16 = request('myCkeck16');
        $resultat17 = request('myCkeck17');
        $resultat18 = request('myCkeck18');
        $resultat19 = request('myCkeck19');
        
        $test = request('test');
        $test = intval($test);
        $isolement = request('isolement');
        $isolement = intval($isolement);
        
        $situations = $resultat1. $resultat2. $resultat3. $resultat4. $resultat5. $resultat6. $resultat7. $resultat8. $resultat9;
        $symptomes = $resultat11. $resultat12. $resultat13. $resultat14. $resultat15. $resultat16. $resultat17. $resultat18. $resultat19;

        $toux = request('toux');
        $toux = intval($toux);
        
        $user = Auth::user();

        $data = [
            'user_id' => $user->id,
            'test' => $test,
            'isolement' => $isolement,
            'situations' => $situations,
            'symptomes' => $symptomes,
            'toux' => $toux,
        ];

        $form = Formulaire::create($data);

        dd($form);
        
    }

    public function show(){
        $user = Auth::user();

        return view('formular',[
            'user' => $user,
        ]);
    }

    public function update(Formulaire $formulaire){
        $sit = $formulaire->user->situation;
        $resultat = request('situation');
        
        $data = [
            "situation" => $resultat,
        ];
        if(($resultat == 'Positif'  && $sit->situatio != 'Positif') || ($sit->situation == 'Unknown')){
            $sit->update($data);
        }else if($sit->situation == 'Positif' && $resultat == 'Negatif'){
            $data = [
                "situation" => 'Recovered',
            ];
            $sit->update($data);
        }
        $data = [
            "Resultat" => $resultat,
        ];
        $formulaire->update($data);
        $this->updateGraphs();
        return redirect('/demandes/nontraite');
    }

    public function updateGraphs(){
        //derniers update
        $last1 = DailyCases::latest()->first();
        $last2 = ActiveCases::latest()->first();
        $last3 = TotalCases::latest()->first();

        $today = date('Y-m-d');
        $conpareday = strtotime($today);
        $data = [
            'date' => $today
        ];
        //premier element 0
        if($last1 == null){
            DailyCases::create($data);
            $last1 = DailyCases::latest()->first();
        }
        if($last2 == null){
            ActiveCases::create($data);
            $last2 = ActiveCases::latest()->first();
        }
        if($last3 == null){
            TotalCases::create($data);
            $last3 = TotalCases::latest()->first();
        }
        
        //new values
        $newActiveCases = Situation::wheresituation('Positif')->count();
        $newTotalCases = Situation::wheresituation('Positif')->count();
        $newTotalCases += Situation::wheresituation('Recovered')->count();
        $newDailyCases = 0;
        $situations = Situation::all();

        foreach($situations as $situation){
            $date = strtotime($situation->updated_at);
            $date = date('Y-m-d',$date);
            $date = strtotime($date);
            if($situation->situation == 'Positif' && $date == $conpareday )
                $newDailyCases++;
        }
        // create blank date and update
        $lastday1 = strtotime($last1->date);
        $lastday2 = strtotime($last2->date);
        $lastday3 = strtotime($last3->date);
        $today = strtotime($today);
        $yesterday = strtotime('yesterday');
        //Daily cases
        while(true){
            if($lastday1 == $today ){
                $data = [
                    'value' => $newDailyCases, 
                ];
                $last1->update($data);
            break;
            }else if($lastday1 == $yesterday){
                $data = [
                    'value' => $newDailyCases,
                    'date' => date('Y-m-d', $today),
                ];
                DailyCases::create($data);
            break;
            }else if($lastday1 < $today){
                $nextday = strtotime('next day', $lastday1);
                $data = [
                    'date' => date('Y-m-d', $nextday),
                ];
                DailyCases::create($data);
                $last1 = DailyCases::latest()->first();
                $lastday1 = strtotime($last1->date);
            }
        }

        //active cases
        while(true){
            if($lastday2 == $today ){
                $data = [
                    'value' => $newActiveCases, 
                ];
                $last2->update($data);
            break;
            }else if($lastday2 == $yesterday){
                $data = [
                    'value' => $newActiveCases,
                    'date' => date('Y-m-d', $today),
                ];
                ActiveCases::create($data);
            break;
            }else if($lastday2 < $today){
                $nextday = strtotime('next day', $lastday2);
                $data = [
                    'value' => $last2->value,
                    'date' => date('Y-m-d', $nextday),
                ];
                ActiveCases::create($data);
                $last2 = ActiveCases::latest()->first();
                $lastday2 = strtotime($last2->date);
            }
        }
        // total cases
        while(true){
            if($lastday3 == $today ){
                $data = [
                    'value' => $newTotalCases, 
                ];
                $last3->update($data);
            break;
            }else if($lastday3 == $yesterday){
                $data = [
                    'value' => $newTotalCases,
                    'date' => date('Y-m-d', $today),
                ];
                TotalCases::create($data);
            break;
            }else if($lastday3 < $today){
                $nextday = strtotime('next day', $lastday3);
                $data = [
                    'value' => $last3->value,
                    'date' => date('Y-m-d', $nextday),
                ];
                TotalCases::create($data);
                $last3 = TotalCases::latest()->first();
                $lastday3 = strtotime($last3->date);
            }
        }
    }
    
    public function getvalues(Formulaire $formulaire){
        $array1 = 'array('. $formulaire->situations .')';
        $parsed1 = eval("return " . $array1 . ";");
        $situations = [];
        foreach($parsed1 as $value){
            if($value == 1)
                array_push($situations, 'Insuffisance cardiaque chronique.');
            if($value == 2)
                array_push($situations, 'Cas précédent de crise cardiaque.');
            if($value == 3)
                array_push($situations, 'Diabète.');
            if($value == 4)
                array_push($situations, 'Hypertension artérielle.');
            if($value == 5)
                array_push($situations, 'Maladie rénale chronique.');
            if($value == 6)
                array_push($situations, 'Maladie pulmonaire chronique.');
            if($value == 7)
                array_push($situations, 'Le cancer.');
            if($value == 8)
                array_push($situations, 'Système immunitaire affaibli.');
            if($value == 9)
                array_push($situations, 'Prenez des médicaments anti-immuns.');
        }
        $array2 = 'array('. $formulaire->symptomes .')';
        $parsed2 = eval("return " . $array2 . ";");
        $symptomes = [];
        foreach($parsed2 as $value){
            if($value == 1)
                array_push($symptomes, 'Fièvre supérieure à 38 degrés.');
            if($value == 2)
                array_push($symptomes, 'Difficulté à respirer.');
            if($value == 3)
                array_push($symptomes, 'Maux d\'estomac.');
            if($value == 4)
                array_push($symptomes, 'Douleurs musculaires.');
            if($value == 5)
                array_push($symptomes, 'Fatigue ou faiblesse importante.');
            if($value == 6)
                array_push($symptomes, 'Congestion nasale ou nez qui coule.');
            if($value == 7)
                array_push($symptomes, 'Inflammation de la gorge.');
            if($value == 8)
                array_push($symptomes, 'Toux sèche.');
            if($value == 9)
                array_push($symptomes, 'Toux Avec mucus.');
        }
        $test = "";
        switch($formulaire->test){
            case 1: $test = 'Non effectué.'; break;
            case 2: $test = 'Oui. et le résultat du test est négatif.'; break;
            case 3: $test = 'Oui et en attente du résultat du test.'; break;
            case 4: $test = 'Oui. et le résultat du test est positif.'; break;
        }
        $isolement = "";
        switch($formulaire->isolement){
            case 1: $isolement = 'Je suis en isolement médical parce que j\'ai rencontré une personne contaminée.'; break;
            case 2: $isolement = 'Je suis en isolement médical parce que j\'ai des symptômes.'; break;
            case 3: $isolement = 'Je ne suis pas en isolement médical mais j\'étais proche de quelqu\'un en isolement médical.'; break;
            case 4: $isolement = 'Je ne suis pas en isolement médical.'; break;
        }
        
        $data = [ 
            'id'=> $formulaire->id,
            'nom' => $formulaire->user->infoPersonnelle->nom,
            'prenom' => $formulaire->user->infoPersonnelle->prenom,
            'age' => $formulaire->user->infoPersonnelle->age,
            'sexe' => $formulaire->user->infoPersonnelle->sexe,
            'adresse' => $formulaire->user->infoPersonnelle->adresse,
            'telephone' => $formulaire->user->infoPersonnelle->telephone,
            'ville' => $formulaire->user->infoPersonnelle->ville,
            'actuelSituation' => $formulaire->user->situation->situation,
            'test' => $test,
            'isolement' => $isolement,
            'situations' => $situations,
            'symptomes' => $symptomes,
            'toux' => $formulaire->toux,
            'resultat' => $formulaire->resultat,
        ];
        return $data;
    }
}
