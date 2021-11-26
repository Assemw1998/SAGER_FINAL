@extends('user.layouts.dashboard')
@section('content')
<div class="container row  d-flex justify-content-between">
    <div class="card text-white bg-dark mb-4 " style="max-width: 18rem;">
        <div class="card-header">Users Total</div>
        <div class="card-body">
            <h5 class="card-title"><span class="p-1 mb-1 bg-danger text-white rounded">
            @if(isset($total_archives[0]->total_users))
                {{$total_archives[0]->total_users}} </span>Users</h5>
            @else 
                {{"There is no data yet"}} 
            @endif
        </div>
    </div>

    <div class="card text-white bg-warning  mb-4 " style="max-width: 18rem;">
        <div class="card-header">Prodcts Total</div>
        <div class="card-body">
            <h5 class="card-title"><span class="p-1 mb-1 bg-danger text-white rounded">
            @if(isset($total_archives[0]->total_products))
                {{$total_archives[0]->total_products}} </span>Products</h5>
            @else 
                {{"There is no data yet"}} 
            @endif
        </div>
    </div>


    <div class="card text-white bg-info " style="max-width: 18rem;">
        <div class="card-header">Categories Total</div>
        <div class="card-body">
            <h5 class="card-title"><span class="p-1 mb-1 bg-danger text-white rounded">
            @if(isset($total_archives[0]->total_category))
                {{$total_archives[0]->total_category}} </span>Categories</h5>
            @else 
                {{"There is no data yet"}} 
            @endif
        </div>
    </div>
</div>
<div class="container row d-flex justify-content-center mt-3">
    <div class="col-12 w-75">
        <div>
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>
<script type="text/javascript" src={{asset("custom/user/dashboard/js/index.js")}}></script>
@endsection

		
		
