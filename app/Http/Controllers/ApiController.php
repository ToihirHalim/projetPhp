<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Formulaire;
use \App\Situation;
use \App\InfoPersonnelle;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function users(){
        return [
            "status" => "succes",
            "users" => User::all()
        ];
    }

    public function user(User $user){ 
        $user->situation;
        $user->infoPersonnelle;

        return [
            "status" => "succes",
            "user" => $user
        ];;
    }

    public function login(Request $request){

        $user = User::whereemail($request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                return $this->user($user);
            }
        }

        $data = [
            "status" => "Error : user doesnt exist",
            'user' => null,
        ];

        return  $data;
    }

    public function register(Request $request){
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->save()){
            $data = [
                'user_id' => $user->id,
            ];
            Situation::create($data);

            $data = [
                'user_id' => $user->id,
                'nom' => $request->name,
                'prenom' => $request->prenom,
                'age' => $request->age,
                'sexe' => $request->sexe,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone,
                'ville' => $request->ville,
            ];
            InfoPersonnelle::create($data);

            return $this->user($user);
        }

        $data = [
            "status" => "Error : email already used",
            'user' => null,
        ];

        return  $data;
    }

    public function formulaire(Request $request){

        $formulaire = new Formulaire();
        $formulaire->user_id = $request->user_id;
        $formulaire->test = $request->test;
        $formulaire->isolement = $request->isolement;
        $formulaire->situations = $request->situations;
        $formulaire->symptomes = $request->symptomes;
        $formulaire->toux = $request->toux;

        $formulaire->save();

        return [
            "status" => "succes",
            "form" => $formulaire
        ];
    }

    public function carte(){
        
        $contamines = Situation::wheresituation('Positif')->get();
        $villesobj = InfoPersonnelle::all('ville');
        $villes = [];
        
        foreach($villesobj as $element){

            $villes[$element->ville] = 0;

            foreach($contamines as $contamine){
                if($contamine->user->infoPersonnelle->ville === $element->ville){
                    $villes[$element->ville]++;
                }
            }
        }

        return [
            "satutus" => "succes",
            "total_contamine" => $contamines->count(),
            "villes" => $villes
        ];
    }
}
