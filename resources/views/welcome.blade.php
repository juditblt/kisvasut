<!doctype html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Erdei kisvasút</title>
    <style>
        .success{
            border: solid green 2px;
        }
        .error{
            border: solid red 2px;
        }
    </style>
</head>
<body>
    <h1>Erdei kisvasút</h1>
    <h2>Sikeres lekérdezés:</h2>
    <div id="answer" class="success">

    </div>
    <h2>Hiba a lekérdezésben:</h2>
    <div id="badanswer" class="error">

    </div>

    <button onclick="SendRequest()">Lekérdezés</button>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        function SendRequest(){
            axios.get("http://localhost:8000/data.json")
                .then(function (response){
                    // sikeres válaszkor:
                    console.log("siker");
                    //console.log(response);
                    console.log(response.data.fruits[0].type);
                    console.log(response.status);
                    // jelenjen meg a div-ben is:
                    let fruits = response.data.fruits;
                    let text = "";
                    for (let i = 0; i < fruits.length; i++){
                        text+= fruits[i].type + "<br>";
                    }
                    document.getElementById("answer").innerHTML = text;
                })
                .catch(function (error){
                    // sikertelen válaszkor:
                    //console.log("error");
                    document.getElementById("badanswer").innerText = error.response.status;
                });
        }

    </script>
</body>
</html>
