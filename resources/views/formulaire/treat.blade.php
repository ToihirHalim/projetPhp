@extends('layouts.app')

@section('content')
<div class="container">
    <form action=" {{ url('/formulaire/'.$formulaire['id'])}} " enctype="multipart/form-data" method="post">
    @csrf
    @method('PATCH')
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
                <div class="row">
                Situation: {{ $formulaire['actuelSituation'] }} 
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
                </div>
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="situation" class="col-md-1 col-form-label "> <strong>Situation :</strong> </label>
            <div class="col-2">
                <select name="situation" id="situation" class="form-control-file">
                    <option value="Negatif">Negatif</option>
                    <option value="Positif">Positif</option>
                </select>
            </div>
            @error('situation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="row pt-4 justify-content-center">
            <button class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
@endsection