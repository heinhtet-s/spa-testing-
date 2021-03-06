<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
        <link rel="stylesheet" href="{{mix('/css/app.css')}}">
        <!-- Styles -->
       

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>

    </head>
 <body>
     
     <div id="app">
     <product-component></product-component>
     <vue-progress-bar></vue-progress-bar>
    </div>
<script src="{{mix('/js/app.js')}}"></script>
    </body>
</html>
