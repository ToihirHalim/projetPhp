@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-3 m-2" style="background-color:#FFFF">
        <div class="pl-3">
            <div class="row justify-content-center">
                <h2>Formulaire N.{{ $formulaire['id'] }} </h2>
            </div>
            <div class="row">
                Nom: {{ $formulaire['nom'] }} 
            </div>
            <div class="row">
                Prenom: {{ $formulaire['prenom'] }} 
            </div>
            <div class="row">
                Age: {{ $formulaire['age'] }} 
            </div>
            <div class="row">
                Adresse: {{ $formulaire['adresse'] }} 
            </div>
            <div class="row">
                Telephone: 0{{ $formulaire['telephone'] }} 
            </div>
            <div class="row">
                Ville: {{ $formulaire['ville'] }} 
            </div>
        
            <div class="pt-3">
                <div class="row "> <h3> - Avez-vous été testé pour le corona virus? *</h3></div>
                <div class="row "><h5 style="padding-left: 100px;">=> {{$formulaire['test']}} </h5> </div>
                
                <div class="row "> <h3> - En ce qui concerne l'isolement médical. lequel des éléments suivants s'applique à vous: *</h3></div>
                <div class="row pl-100"> <h5 style="padding-left: 100px;">=> {{$formulaire['isolement']}} </h5> </div>
                
                <div class="row "> <h3> - Avez-vous actuellement ou avez-vous déjà vécu l'une des situations suivantes:</h3></div>
                
                @foreach($formulaire['situations'] as $key => $situation)
                <div class="row "><h5 style="padding-left: 100px;">=> {{$formulaire['situations'][$key]}} </h5> </div>
                @endforeach
                
                
                <div class="row "> <h3> - Avez-vous eu les symptômes suivants aujourd'hui?.Veuillez les cocher si c'est le cas :</h3></div>
                @foreach($formulaire['symptomes'] as $key => $situation)
                <div class="row "><h5 style="padding-left: 100px;">=> {{$formulaire['symptomes'][$key]}} </h5> </div>
                @endforeach
                
                <div class="row "> <h3> - Depuis combien du temps avez-vous toussé ?</h3></div>
                <div class="row pl-100"> <h5 style="padding-left: 100px;">=> {{$formulaire['toux']}} fois. </h5> </div>
                <br>
                @if($formulaire['resultat'] == 'Positif')
                    <div class="row justify-content-center"> <h2 style=" color:red"> <strong>{{$formulaire['resultat']}}</strong> </h2> </div>
                @else 
                    <div class="row justify-content-center"> <h2 style=" color:green"> <strong>{{$formulaire['resultat']}}</strong> </h2> </div>
                @endif
                
            </div>
        </div>
    </div>
</div>
@endsection