@extends('user.layouts.dashboard')
@section('content')
<div class="container row  d-flex justify-content-between">

        <div class="card text-white bg-dark mb-4 " style="max-width: 18rem;">
            <div class="card-header">Users Total</div>
            <div class="card-body">
                <h5 class="card-title"><span class="p-1 mb-1 bg-danger text-white rounded">{{$total_archives->total_users}}</span> Users</h5> 
            </div>
        </div>

        <div class="card text-white bg-success  mb-4 " style="max-width: 18rem;">
            <div class="card-header">Prodcts Total</div>
            <div class="card-body">
                <h5 class="card-title"><span class="p-1 mb-1 bg-danger text-white rounded">{{$total_archives->total_products}}</span> Products</h5>
                <p class="card-text"></p>
            </div>
        </div>


        <div class="card text-white bg-info " style="max-width: 18rem;">
            <div class="card-header">Category Total</div>
            <div class="card-body">
                <h5 class="card-title "><span class="p-1 mb-1 bg-danger text-white rounded">{{$total_archives->total_category}}</span> Categories</h5>
            </div>
        </div>

</div>
@endsection

		
		
