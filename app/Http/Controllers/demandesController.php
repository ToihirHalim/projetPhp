<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Formulaire;
use PHPUnit\Framework\Constraint\IsTrue;

class demandesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexTraite(){
        
        $demandes = Formulaire::where('resultat','!=','Unknown')->orderBy('updated_at','DESC')->paginate(10);

        return view('demandes.traite',[
            'demandes' => $demandes,
        ]);
    }

    public function indexNonTraite(){
        $demandes = Formulaire::where('resultat','=','Unknown')->paginate(10);

        return view('demandes.nonTraite',[
            'demandes' => $demandes,
        ]);
    }
}
