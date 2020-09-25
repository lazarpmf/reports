<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8" defer></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous" defer></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>
<div class="container">
<a href="/home"><img src="img/logo.png"></a>
<hr>
<h1>Statistika:</h1>
<div class="row justify-content-center mt-5 mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ukupno po projektu</div>
                <div class="card-body">
                    {!! $chart1->container() !!}
                </div>
            </div>
        </div>
    </div>


    </div>



{!! $chart1->script() !!}

</body>
</html>