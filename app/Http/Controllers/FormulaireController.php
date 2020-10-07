<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Formulaire;
use App\User;
use App\Track;
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

        $lastTrack = $this->lastTrack();
        $dailyCases = $lastTrack->dailyCases;
        $activeCases = $lastTrack->activeCases;
        $totalCases = $lastTrack->totalCases;
        $dailyRecovered = $lastTrack->dailyRecovered;
        

        if($resultat == 'Positif' && $sit->situation != 'Positif'){
            $dailyCases++;
            $activeCases++;

            if($sit->situation != 'Recovered'){
                $totalCases++;
            }

        }else if($resultat == 'Negatif' && $sit->situation == 'Positif'){
            $dailyRecovered++;
            $activeCases--;
        }


        if(($resultat == 'Positif' && $sit->situation != 'Positif') || ($sit->situation == 'Unknown')){
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
        
        $data = [
            "activeCases" => $activeCases ? $activeCases : 0,
            "totalCases" => $totalCases ? $totalCases : 0,
            "dailyCases" => $dailyCases ? $dailyCases : 0,
            "dailyRecovered" => $dailyRecovered ? $dailyRecovered  : 0
        ];

        $lastTrack->update($data);
        
        return redirect('/demandes/nontraite');
    }

    public function lastTrack(){
        $lastTrack = Track::latest()->first();

        $today = date('Y-m-d');
        $conpareday = strtotime($today);
        $yesterday = strtotime('yesterday');

        if($lastTrack == null){
            $lastTrack = new Track();
            $lastTrack->date = $today;
            $lastTrack->save();
            return $lastTrack;
        }

        
        $lastday = strtotime($lastTrack->date);

        while(true){
            if($lastday == $conpareday ){

                return $lastTrack;

            }else if($lastday == $yesterday){
                
                $activeCases = $lastTrack->activeCases;
                $totalCases = $lastTrack->totalCases;

                $lastTrack = new Track();
                $lastTrack->totalCases = $totalCases;
                $lastTrack->activeCases = $activeCases;
                $lastTrack->date = $today;
                $lastTrack->save();

                return $lastTrack;

            }else if($lastday < $conpareday){
                $activeCases = $lastTrack->activeCases;
                $totalCases = $lastTrack->totalCases;
                $nextday = strtotime('next day', $lastday);
                $nextday = date('Y-m-d', $nextday);

                $lastTrack = new Track();
                $lastTrack->totalCases = $totalCases;
                $lastTrack->activeCases = $activeCases;
                $lastTrack->date = $nextday;
                $lastTrack->save();

                $lastday = strtotime($lastTrack->date);
            }
        }

        return $lastTrack;
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
