<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Erdei kisvasút</title>
    <style>
        #map {
            background-color: darkseagreen;
            width: 400px;
            height: 400px;
            position: relative;
        }
        .station {
            position: absolute;
        }
    </style>
</head>
<body>
    <!--
    <pre>
       {{--  @php var_dump($stations); @endphp --}}
    </pre>
    -->
    <h1>Erdei kisvasút</h1>

    <div id="map">
        @foreach($stations as $station)
            <div class="station" id="station-{{$station->id}}"
                 onclick="StationClick({{ $station->id }})"
                 style="left: {{$station->long}}px; top: {{$station->lat}}px; background-color: {{ $station->train_in ? 'orange' : 'white'}};">
                {{ $station->name }}
            </div>
        @endforeach
    </div>

    <div id="log">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // a "log" div-re katt.-kor lesz clearInterval()
        let refreshInterval = setInterval(UpdateStations, 1000);

        function UpdateStations(){
            console.log("update");

            axios.get('http://127.0.0.1:8000/stations')
            .then(function (response){
                //console.log(response.data);  // az id van benne
                StationClean(response.data);
            })
            .catch();
        }

        function StationClean(id){
            let stations = document.getElementsByClassName("station");
            for (let i = 0; i < stations.length; i++) {
                if (stations[i].id == "station-"+id){
                    stations[i].style.backgroundColor = "orange";
                }else {
                    stations[i].style.backgroundColor = "white";
                }
            }
        }

        function StationClick(id){
            StationClean(id);
            //console.log("on " + name + " station");
            axios.get('http://127.0.0.1:8000/onstation/'+id)
            .then(function(response){
                let station = response.data;   // adott állomás adatai vannak benne
                console.log(station);
                document.getElementById("log").innerHTML +=
                    station.last_train_in + " - A vonat a(z) " + station.name + " állomásra ért! <br>"
            })
            .catch();
        }

        // a "log" div-re katt-kor:
        document.getElementById("log").addEventListener('click', function (){
           console.log("log clear...");
           this.innerHTML = "";
           clearInterval(refreshInterval);
        });

        // kipróbálás:
        /*
        let stations = document.getElementsByClassName("station");
        for (let i = 0; i < stations.length; i++) {
            stations[i].addEventListener('click', function (){
                console.log('alma');
            })
        }
        document.getElementById("log").addEventListener('click', function (){
            console.log('log clear...');
        });
        */
    </script>

</body>
</html>
