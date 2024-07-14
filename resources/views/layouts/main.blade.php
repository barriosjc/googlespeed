<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Juan Carlos Barrios" />
    <title>Challenge Broobe</title>
    
    <!-- Incluir jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
    
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">


    
    <!-- Incluir jQuery BlockUI -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style type="text/css">
        div.blockMsg {
            width:  40%;
            top:    30%;
            left:   30%;
            text-align: center;
            background-color: rgb(96, 158, 220);
            border: 1px solid #ddd;
            -moz-border-radius: 10px;
            -webkit-border-radius: 10px;
            -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=50)"; 
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=50); 
            -moz-opacity:.70;
            opacity:.70;
            padding: 15px;
            color: #fff;
        }
        </style>
        {{-- cdn de sb asmin2 --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/css/sb-admin-2.css" integrity="sha512-gOfBez3ehpchNxj4TfBZfX1MDLKLRif67tFJNLQSpF13lXM1t9ffMNCbZfZNBfcN2/SaWvOf+7CvIHtQ0Nci2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Incluir tu archivo CSS personalizado -->
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">        
</head>
<body>
    @include('layouts.header')

    @include('layouts.content')
   
    @include('layouts.footer')

    <!-- Incluir Bootstrap JS (si es necesario) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.4/js/sb-admin-2.min.js"></script>
</body>
</html>

