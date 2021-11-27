@extends('user.layouts.dashboard')
@section('content')
<div class="container text-dark">
    <div class="row col-12 text-right mb-3">
        <button type="button" class="btn btn-outline-primary w-25" id="add_product" data-bs-toggle="modal" data-bs-target="#product_add_modal"><i class="fas fa-plus-square"></i> Add New Product</button>
    </div>
    <div class="row col-12 text-center">
        <table id="products_table" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th width="300">Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Created By</th>
                    <th>Categories</th>
                    <th>Craeted At</th>
                    <th>Updated At</th>
                    <th >Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->price}}</td>
                        <td><img src="{{asset("uploads")}}/{{$product->image_url}}" width="75"/></td>
                        <td>{{$product->created_by}}</td>
                        <td>@php $category_ids=json_decode($product->category_ids); foreach($category_ids as $category_id){echo $category_id." ";} @endphp</td>
                        <td>{{$product->created_at}}</td>
                        <td>{{$product->updated_at}}</td>
                        <td class="d-flex"> 
                            <button type="button" class="btn btn-outline-success mr-2  update" data-id="{{$product->id}}"  data-bs-toggle="modal" data-bs-target="#product_update_modal"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-outline-danger delete" data-id="{{$product->id}}"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- product update modal -->
<div class="modal fade text-dark" id="product_update_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-edit"></i> Update <span class="p-1 mb-1 bg-dark text-white rounded product-id-area"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="save-updated-data" enctype="multipart/form-data">
        <input type="hidden" id="product_id" name="product_id">
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control product-data" id="name" name="name" placeholder="Product Name">
                </div>
                <div class="col-6">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control product-data" id="description" name="description" placeholder="Description">
                </div>
                <div class="col-6">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control product-data" id="quantity" name="quantity" placeholder="Quantity" min="1">
                </div>
                <div class="col-6">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control product-data" id="price" name="price" placeholder="Price" min="1">
                </div>
                <div class="col-6">
                    <label for="price" class="form-label">Upload Image</label>
                    <input type="file" class="form-control "  name="image_url"/>
                </div>
                <div class="col-6">
                    <input type="hidden" id="category_ids_table" name="category_ids_table">
                    <label for="category_ids" class="form-label">Categories</label>
                    <select class="selectpicker form-control" id="category_ids" name="category_ids" multiple data-live-search="true">
                        <option value="0">--Select--</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>    
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success save-updated-data">Update</button>
        </div>
    </form>
    </div>
  </div>
</div>


<!-- product update modal -->
<div class="modal fade text-dark" id="product_add_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-plus-square"></i> Add new product</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="add-new-product" enctype="multipart/form-data">
        <input type="hidden" id="product_id_add" name="product_id">
        <div class="modal-body">
            <div class="row">
                <div class="col-6">
                    <label for="name_add" class="form-label">Product Name</label>
                    <input type="text" class="form-control product-data-add" id="name_add" name="name" placeholder="Product Name">
                </div>
                <div class="col-6">
                    <label for="description_add" class="form-label">Description</label>
                    <input type="text" class="form-control product-data-add" id="description_add" name="description" placeholder="Description">
                </div>
                <div class="col-6">
                    <label for="quantity_add" class="form-label">Quantity</label>
                    <input type="number" class="form-control product-data-add" id="quantity_add" name="quantity" placeholder="Quantity" min="1">
                </div>
                <div class="col-6">
                    <label for="price_add" class="form-label">Price</label>
                    <input type="number" class="form-control product-data-add" id="price_add" name="price" placeholder="Price" min="1">
                </div>
                <div class="col-6">
                    <label for="image_url_add" class="form-label">Upload Image</label>
                    <input type="file" class="form-control product-data-add"  id="image_url_add" name="image_url"/>
                </div>
                <div class="col-6">
                    <input type="hidden" id="category_ids_table_add" name="category_ids_table_add">
                    <label for="category_ids_add" class="form-label">Categories</label>
                    <select class="selectpicker form-control" id="category_ids_add" name="category_ids" multiple data-live-search="true">
                        <option value="0">--Select--</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>    
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success add-new-product">Add</button>
        </div>
    </form>
    </div>
  </div>
</div>
<script type="text/javascript"  src={{asset("custom/user/dashboard/js/products.js")}}></script>
@endsection