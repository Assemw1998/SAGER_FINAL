@extends('user.layouts.dashboard')
@section('content')
<div class="container text-dark">
    <div class="row col-12 text-right mb-3">
        <button type="button" class="btn btn-outline-primary w-25" id="add_category" data-bs-toggle="modal" data-bs-target="#category_add_modal"><i class="fas fa-plus-square"></i> Add New Category</button>
    </div>
    <div class="row col-12 text-center">
        <table id="categories_table" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Craeted At</th>
                    <th>Updated At</th>
                    <th >Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{$category->created_at}}</td>
                        <td>{{$category->updated_at}}</td>
                        <td> 
                            <button type="button" class="btn btn-outline-success mr-2  update" data-id="{{$category->id}}"  data-bs-toggle="modal" data-bs-target="#category_update_modal"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-outline-danger delete" data-id="{{$category->id}}"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- category update modal -->
<div class="modal fade text-dark" id="category_update_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-edit"></i> Update <span class="p-1 mb-1 bg-dark text-white rounded category-id-area"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="save-updated-data">
        <input type="hidden" id="product_id" name="product_id">
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control category-data" id="name" name="name" placeholder="Category Name">
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

<!-- category add modal -->
<div class="modal fade text-dark" id="category_add_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-plus-square"></i> Add Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" id="save-add-data">
        <input type="hidden" id="product_id" name="product_id">
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <label for="name" class="form-label">Category Name</label>
                    <input type="text" class="form-control category-data-add" id="name" name="name" placeholder="Category Name">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success add-new-category-btn">Add</button>
        </div>
    </form>
    </div>
  </div>
</div>
<script type="text/javascript"  src={{asset("custom/user/dashboard/js/categories.js")}}></script>
@endsection