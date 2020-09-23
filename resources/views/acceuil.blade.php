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
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Covid App
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <div class="d-flex justify-content-between">
                        <a href="{{ url('/acceuil') }}" class=" navbar-brand p-2">Acceuil</a>
                        <a href="{{ url('/demandes/traite') }} " class="navbar-brand p-2">Demandes Traites</a>
                        <a href="{{ url('/demandes/nontraite') }} " class=" navbar-brand p-2">Demandes Non Traites</a>
                    </div>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <br>
            <div class="row ">
                <h4>{{date('D M Y')}}</h4>
            </div>
            <div class="row justify-content-center" style="padding-top: 10px;">
                <h3>Nombre des tests: <strong>{{ $data['nbreTest']}}</strong></h3>
            </div>
            <div class="row justify-content-center">
                <h3><strong>{{ $data['nbreContamine']}}</strong> Personnes Actuellement Contamines</h3>
            </div>
            <div class="row justify-content-center">
                <h3><Strong>{{ $data['nbreRecovered']}}</Strong> Gueris</h3>
            </div>
            <br><br>
            <div class="row justify-content-center">
                <h4>graphes: Contamines / Journalier / Total </h4>
                <br>
                <div id="chart" style="height: 300px; width: 1000px"></div>
            </div>
            <br><br>
            <div class="row justify-content-center">
                <h4>graphes: contaminations par ville </h4>
                <br>
            </div>
            <div class="row">
                <div class="col">
                    <div id="chart5" style="height: 300px; width: 500px"></div>
                </div>
                <div class="row">
                    <div id="chart4" style="height: 300px; width: 500px"></div>
                </div>
            </div>
            <br><br><br>
            <div class="row ">
                <div class="col">
                    <h4 style="text-align:center"> Graphe: Active Cases</h4><br>
                    <div id="chart1" style="height: 250px; "></div>
                </div>
                <div class="col">
                    <h4 style="text-align:center"> Graphe: Daily Cases</h4><br>
                    <div id="chart2" style="height: 250px; "></div>
                </div>
                <div class="col">
                    <h4 style="text-align:center"> Graphe Total Cases</h4><br>
                    <div id="chart3" style="height: 250px; "></div>
                </div>
            </div>
            <br><br><br>
        </div>
    <!-- Charting library -->
    <script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    
    <script>
      const chart = new Chartisan({
        el: '#chart',
        url: "@chart('sample_chart')",
        data: {
            chart: { "labels": <?php echo json_encode($data['totalCases']['dates']); ?> },
            datasets: [
                { "name": "Active Cases", "values": <?php echo json_encode($data['activeCases']['values']); ?> },
                { "name": "Daily Cases", "values": <?php echo json_encode($data['dailyCases']['values']); ?> },
                { "name": "Total Cases", "values": <?php echo json_encode($data['totalCases']['values']); ?> },
            ],
        },
        hooks: new ChartisanHooks()
            .colors(['blue', 'orange', 'red'])
            .legend({ position: 'left' })
            .datasets([{ type: 'line', fill: false }, 'line']),
      });

      const chart1 = new Chartisan({
        el: '#chart1',
        url: "@chart('sample_chart')",
        data: {
            chart: { "labels": <?php echo json_encode($data['activeCases']['dates']); ?> },
            datasets: [
                { "name": "Active Cases", "values": <?php echo json_encode($data['activeCases']['values']); ?> },
            ],
        },
        hooks: new ChartisanHooks()
            .colors('blue')
            .legend({ position: 'left' })
            .datasets([{ type: 'line', fill: false }, 'bar']),
      });

      const chart2 = new Chartisan({
        el: '#chart2',
        url: "@chart('sample_chart')",
        data: {
            chart: { "labels": <?php echo json_encode($data['dailyCases']['dates']); ?> },
            datasets: [
                { "name": "Daily Cases", "values": <?php echo json_encode($data['dailyCases']['values']); ?> },
            ],
        },
        hooks: new ChartisanHooks()
            .colors(['black'])
            .legend({ position: 'left' })
            .datasets([{ type: 'bar', fill: false }, 'bar']),
      });

      const chart3 = new Chartisan({
        el: '#chart3',
        url: "@chart('sample_chart')",
        data: {
            chart: { "labels": <?php echo json_encode($data['totalCases']['dates']); ?> },
            datasets: [
                { "name": "Total Cases", "values": <?php echo json_encode($data['totalCases']['values']); ?> },
            ],
        },
        hooks: new ChartisanHooks()
            .colors(['blue'])
            .legend({ position: 'left' })
            .datasets([{ type: 'line', fill: false }, 'bar']),
      });

      const chart4 = new Chartisan({
        el: '#chart4',
        url: "@chart('sample_chart')",
        data: {
            chart: { "labels": <?php echo json_encode($data['dataVilles']['ville']); ?> },
            datasets: [
                { "name": "comnamines pas ville", "values": <?php echo json_encode($data['dataVilles']['nombreCases']); ?> },
            ],
        },
        hooks: new ChartisanHooks()
            .colors(['blue', 'red', 'orange', '#F226BD', '#A5F226' ])
            .legend({ position: 'left' })
            .datasets([{ type: 'pie', fill: false }, 'bar']),
      });

      const chart5 = new Chartisan({
        el: '#chart5',
        url: "@chart('sample_chart')",
        data: {
            chart: { "labels": <?php echo json_encode($data['dataVilles']['ville']); ?> },
            datasets: [
                { "name": "comnamines pas ville", "values": <?php echo json_encode($data['dataVilles']['nombreCases']); ?> },
            ],
        },
        hooks: new ChartisanHooks()
            .legend({ position: 'left' })
            .datasets([{ type: 'bar', fill: false }, 'bar']),
      });
    </script>
    </body>
</html>
