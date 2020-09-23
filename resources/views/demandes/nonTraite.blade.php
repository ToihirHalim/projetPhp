@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>{{$demandes->count()}} Demandes Non Traitées</h1>
    </div>

    <div class="row " style="font-size: 20px;">
    
        @foreach($demandes as $formulaire)
        
        <div class="col-9 pt-2">
            <a href="{{ url('/formulaire/'.$formulaire->id.'/treat') }}" style="color: darkgrey ">
                Formulaire n.{{ $formulaire->id }}  {{ $formulaire->user->infoPersonnelle->prenom }} {{ $formulaire->user->infoPersonnelle->nom }}
                Age: {{ $formulaire->user->infoPersonnelle->age }} Ville: {{ $formulaire->user->infoPersonnelle->ville }} Adresse: {{ $formulaire->user->infoPersonnelle->adresse }} 
                ---> <strong style="color:cornflowerblue ">Traiter</strong>
            </a>
        </div>
        @endforeach
    </div>
    {{ $demandes->links()}}
</div>
@endsection