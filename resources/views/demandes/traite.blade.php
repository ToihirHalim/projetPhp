@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>{{$demandes->count()}} Demandes traitées</h1>
    </div>
    <div style="font-size: 20px;">
        @foreach($demandes as $formulaire)
        <div class="row pt-2">
        <a href="{{ url('/formulaire/'.$formulaire->id) }}" style="color: darkgrey ">
                Formulaire n.{{ $formulaire->id }}  {{ $formulaire->user->infoPersonnelle->prenom }} {{ $formulaire->user->infoPersonnelle->nom }}
                Age: {{ $formulaire->user->infoPersonnelle->age }} Ville: {{ $formulaire->user->infoPersonnelle->ville }} Adresse: {{ $formulaire->user->infoPersonnelle->adresse }} 
                @if($formulaire->resultat == 'Positif')
                    <strong style="color:red">{{$formulaire->resultat}}</strong>
                @else 
                    <strong style="color:green ">{{$formulaire->resultat}}</strong>
                @endif
                ---> <strong style="color:cornflowerblue ">Afficher</strong>
            </a> 
        </div>
        @endforeach
    </div>
    {{ $demandes->links()}}
</div>
@endsection