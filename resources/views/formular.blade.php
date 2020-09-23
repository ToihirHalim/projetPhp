<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Acceuil</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        
    </head>
    <body>
        <main class="py-4">
            <div class="container">
                <form action=" {{ url('/formular/create/')}} " enctype="multipart/form-data" method="post">
                @csrf
                @method('PATCH')
                    <div class="p-3 m-2" style="background-color:#FFFF">
                        <div class="pl-3">
                            <div class="row justify-content-center">
                                <h2>Formulaire  </h2>
                            </div>
                            <div class="row">
                                Nom: {{ $user->infoPersonnelle->nom }} 
                            </div>
                            <div class="row">
                                Prenom: {{ $user->infoPersonnelle->prenom }} 
                            </div>
                            <div class="row">
                                Age: {{ $user->infoPersonnelle->age }} 
                            </div>
                            <div class="row">
                                Adresse: {{ $user->infoPersonnelle->adresse }} 
                            </div>
                            <div class="row">
                                Telephone: 0{{ $user->infoPersonnelle->telephone }} 
                            </div>
                            <div class="row">
                                Ville: {{ $user->infoPersonnelle->ville }} 
                            </div>

                            <div class="pt-3">
                                <div class="row "> <h3> - Avez-vous été testé pour le corona virus? *</h3></div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                    <input type="radio" id="test1" name="test" value="1" checked>
                                    <label for="1"><h5> Non effectué..</h5></label>
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                    <input type="radio" id="test2" name="test" value="2">
                                    <label for="2"><h5> Oui. et le résultat du test est négatif.</h5></label>
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                    <input type="radio" id="test3" name="test" value="3">
                                    <label for="3"><h5> Oui et en attente du résultat du test .</h5></label>
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                    <input type="radio" id="test4" name="test" value="4">
                                    <label for="4"><h5> Oui. et le résultat du test est positif.</h5></label>
                                    </div>
                                </div>
                                
                                
                                <div class="row "> <h3> - En ce qui concerne l'isolement médical. lequel des éléments suivants s'applique à vous: *</h3></div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                    <input type="radio" id="isolement1" name="isolement" value="1" checked>
                                    <label for="1"><h5> Je suis en isolement médical parce que j'ai rencontré une personne contaminée.</h5></label>
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                    <input type="radio" id="isolement2" name="isolement" value="2">
                                    <label for="2"><h5> Je suis en isolement médical parce que j'ai des symptômes.</h5></label>
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                    <input type="radio" id="isolement3" name="isolement" value="3">
                                    <label for="3"><h5> Je ne suis pas en isolement médical mais j'étais proche de quelqu'un en isolement médical.</h5></label>
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                    <input type="radio" id="isolement4" name="isolement" value="4">
                                    <label for="4"><h5> Je ne suis pas en isolement médical.</h5></label>
                                    </div>
                                </div>
                                
                                <div class="row "> <h3> - Avez-vous actuellement ou avez-vous déjà vécu l'une des situations suivantes:</h3></div>
                                
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCheck1" name="myCheck1" value="" onclick="myFunction()">
                                        <label for="myCheck"><h5> Insuffisance cardiaque chronique.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCheck2" name="myCheck2" value="" onclick="myFunction()">
                                        <label for="myCheck"><h5> Cas précédent de crise cardiaque.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCheck3" name="myCheck3" value="" onclick="myFunction()">
                                        <label for="myCheck"><h5> Diabète.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCheck4" name="myCheck4" value="" onclick="myFunction()">
                                        <label for="myCheck"><h5> Hypertension artérielle.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCheck5" name="myCheck5" value="" onclick="myFunction()">
                                        <label for="myCheck"><h5> Maladie rénale chronique.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCheck6" name="myCheck6" value="" onclick="myFunction()">
                                        <label for="myCheck"><h5> Maladie pulmonaire chronique.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCheck7" name="myCheck7" value="" onclick="myFunction()">
                                        <label for="myCheck"><h5> Le cancer.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCheck8" name="myCheck8" value="" onclick="myFunction()">
                                        <label for="myCheck"><h5> Système immunitaire affaibli.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCheck9" name="myCheck9" value="" onclick="myFunction()">
                                        <label for="myCheck"><h5> Prenez des médicaments anti-immuns.</h5></label> 
                                    </div>
                                </div>
                                
                                <div class="row "> <h3> - Avez-vous eu les symptômes suivants aujourd'hui?.Veuillez les cocher si c'est le cas :</h3></div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCkeck11" name="myCkeck11" value="" onclick="myFunction1()">
                                        <label for="myCkeck1"><h5> Fièvre supérieure à 38 degrés.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCkeck12" name="myCkeck12" value="" onclick="myFunction1()">
                                        <label for="myCkeck1"><h5> Difficulté à respirer.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCkeck13" name="myCkeck13" value="" onclick="myFunction1()">
                                        <label for="myCkeck1"><h5> Maux d'estomac.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCkeck14" name="myCkeck14" value="" onclick="myFunction1()">
                                        <label for="myCkeck1"><h5> Douleurs musculaires.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCkeck15" name="myCkeck15" value="" onclick="myFunction1()">
                                        <label for="myCkeck1"><h5> Fatigue ou faiblesse importante.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCkeck16" name="myCkeck16" value="" onclick="myFunction1()">
                                        <label for="myCkeck1"><h5> Congestion nasale ou nez qui coule.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCkeck17" name="myCkeck17" value="" onclick="myFunction1()">
                                        <label for="myCkeck1"><h5> Inflammation de la gorge.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCkeck18" name="myCkeck18" value="" onclick="myFunction1()">
                                        <label for="myCkeck1"><h5> Toux sèche.</h5></label> 
                                    </div>
                                </div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <input type="checkbox" id="myCkeck19" name="myCkeck19" value="" onclick="myFunction1()">
                                        <label for="myCkeck1"><h5> Toux Avec mucus.</h5></label> 
                                    </div>
                                </div>
                                
                                <div class="row "> <h3> - Depuis combien du temps avez-vous toussé ?</h3></div>
                                <div class="row pl-200">
                                    <div style="padding-left: 200px;">
                                        <label for="myCkeck1"><input type="number" id="toux" value="0" name="toux" min="0" step="1"/></label> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row pt-4 justify-content-center">
                        <button class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </main>
        <script>
            function myFunction() {
                var checkBox1 = document.getElementById("myCheck1");
                var checkBox2 = document.getElementById("myCheck2");
                var checkBox3 = document.getElementById("myCheck3");
                var checkBox4 = document.getElementById("myCheck4");
                var checkBox5 = document.getElementById("myCheck5");
                var checkBox6 = document.getElementById("myCheck6");
                var checkBox7 = document.getElementById("myCheck7");
                var checkBox8 = document.getElementById("myCheck8");
                var checkBox9 = document.getElementById("myCheck9");

                var virgule = "";
                if (checkBox1.checked == true){
                    checkBox1.value = virgule + "1";
                    virgule = ",";
                }else{
                    checkBox1.value = "";
                }

                if (checkBox2.checked == true){
                    checkBox2.value = virgule + "2";
                    virgule = ",";
                }else{
                    checkBox2.value = "";
                }
                
                if (checkBox3.checked == true){
                    checkBox3.value = virgule + "3";
                    virgule = ",";
                }else{
                    checkBox3.value = "";
                }
                
                if (checkBox4.checked == true){
                    checkBox4.value = virgule + "4";
                    virgule = ",";
                }else{
                    checkBox4.value = "";
                }
                if (checkBox5.checked == true){
                    checkBox5.value = virgule + "5";
                    virgule = ",";
                }else{
                    checkBox5.value = "";
                }

                if (checkBox6.checked == true){
                    checkBox6.value = virgule + "6";
                    virgule = ",";
                }else{
                    checkBox6.value = "";
                }
                
                if (checkBox7.checked == true){
                    checkBox7.value = virgule + "7";
                    virgule = ",";
                }else{
                    checkBox7.value = "";
                }
                
                if (checkBox8.checked == true){
                    checkBox8.value = virgule + "8";
                    virgule = ",";
                }else{
                    checkBox8.value = "";
                }

                if (checkBox9.checked == true){
                    checkBox9.value = virgule + "9";
                    virgule = ",";
                }else{
                    checkBox9.value = "";
                }
            }
            function myFunction1() {
                var checkBox1 = document.getElementById("myCkeck11");
                var checkBox2 = document.getElementById("myCkeck12");
                var checkBox3 = document.getElementById("myCkeck13");
                var checkBox4 = document.getElementById("myCkeck14");
                var checkBox5 = document.getElementById("myCkeck15");
                var checkBox6 = document.getElementById("myCkeck16");
                var checkBox7 = document.getElementById("myCkeck17");
                var checkBox8 = document.getElementById("myCkeck18");
                var checkBox9 = document.getElementById("myCkeck19");

                var virgule = "";
                if (checkBox1.checked == true){
                    checkBox1.value = virgule + "1";
                    virgule = ",";
                }else{
                    checkBox1.value = "";
                }

                if (checkBox2.checked == true){
                    checkBox2.value = virgule + "2";
                    virgule = ",";
                }else{
                    checkBox2.value = "";
                }
                
                if (checkBox3.checked == true){
                    checkBox3.value = virgule + "3";
                    virgule = ",";
                }else{
                    checkBox3.value = "";
                }
                
                if (checkBox4.checked == true){
                    checkBox4.value = virgule + "4";
                    virgule = ",";
                }else{
                    checkBox4.value = "";
                }
                if (checkBox5.checked == true){
                    checkBox5.value = virgule + "5";
                    virgule = ",";
                }else{
                    checkBox5.value = "";
                }

                if (checkBox6.checked == true){
                    checkBox6.value = virgule + "6";
                    virgule = ",";
                }else{
                    checkBox6.value = "";
                }
                
                if (checkBox7.checked == true){
                    checkBox7.value = virgule + "7";
                    virgule = ",";
                }else{
                    checkBox7.value = "";
                }
                
                if (checkBox8.checked == true){
                    checkBox8.value = virgule + "8";
                    virgule = ",";
                }else{
                    checkBox8.value = "";
                }

                if (checkBox9.checked == true){
                    checkBox9.value = virgule + "9";
                    virgule = ",";
                }else{
                    checkBox9.value = "";
                }
            }
        </script>
    </body>
</html>
