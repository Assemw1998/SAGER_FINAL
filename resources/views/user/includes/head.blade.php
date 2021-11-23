<meta charset="utf-8">
<title>{{ config('app.name') }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">

<!--Includes CSS lIB-->
<!--Bootstrap-->
<link href = {{ asset("libraries/bootstrap/css/bootstrap.css") }} rel="stylesheet" />
<!--fontawesome-->
<link href={{ asset("libraries/fontawesome/css/all.css") }} rel="stylesheet"/>
<!--jquery-confirm-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">


<!--Includes JS lIB-->
<!--Bootstrap-->
<script type="text/javascript" src={{ asset("libraries/bootstrap/js/bootstrap.js") }}></script>
<!--JQ-->
<script type="text/javascript" src={{ asset("libraries/jquery/js/jquery.js") }}></script>  
<script type="text/javascript" src={{ asset("libraries/jquery/js/ajax.js") }}></script> 
<!--fontawesome-->
<script type="text/javascript" src={{ asset("libraries/fontawesome/js/all.js") }} ></script> 
<!--for the Animation Background-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script> 
<!--jquery-confirm-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>