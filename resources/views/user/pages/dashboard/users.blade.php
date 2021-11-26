@extends('user.layouts.dashboard')
@section('content')
<div class="container text-dark">
    <div class="row col-12 text-right mb-3">
        <button type="button" class="btn btn-outline-primary w-25" id="add_user" data-bs-toggle="modal" data-bs-target="#add_new_user"><i class="fas fa-user-plus"></i> Add New User</button>
    </div>
    <div class="row col-12 text-center">
        <table id="users_table" class="display">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Full Name</th>
                    <th>Proudcts</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->first_name}} {{$user->last_name}}</td>
                        <td>{{$user->product}}</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                        <td> 
                            <button type="button" class="btn btn-outline-success  update" data-id="{{$user->id}}"  data-bs-toggle="modal" data-bs-target="#user_update_modal"><i class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-outline-danger delete" data-id="{{$user->id}}"><i class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- user update modal -->
<div class="modal fade text-dark" id="user_update_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-edit"></i> Update <span class="p-1 mb-1 bg-dark text-white rounded user-id-area"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
            <div class="row">
                <div class="col-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control user-data" id="email" name="email" placeholder="Email">
                </div>
                <div class="col-6">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control user-data" id="first_name" name="first_name" placeholder="First Name">
                </div>
                <div class="col-6">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control user-data" id="last_name" name="last_name" placeholder="Last Name">
                </div>
                <div class="col-6">
                    <label for="proudct" class="form-label">Products</label>
                    <select id="product" name="product" class="form-select user-data" aria-label="Default select example">
                        <option value="0">--Select--</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 mt-3 mb-2 text-center">
                    <button type="button" class="btn btn-outline-dark show-passwords-btn w-50">Change Password</button>
                </div>
                <div class="password-area d-flex"></div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success save-updated-data">Update</button>
      </div>
    </div>
  </div>
</div>


<!-- user add modal -->
<div class="modal fade text-dark" id="add_new_user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"><i class="fas fa-user-plus"></i> Add new user</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
            <div class="row">
                <div class="col-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control user-data-add" id="email" name="email" placeholder="Email">
                </div>
                <div class="col-6">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" class="form-control user-data-add" id="first_name" name="first_name" placeholder="First Name">
                </div>
                <div class="col-6">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" class="form-control user-data-add" id="last_name" name="last_name" placeholder="Last Name">
                </div>
                <div class="col-6">
                    <label for="proudct" class="form-label">Products</label>
                    <select id="product" name="product" class="form-select user-data-add" aria-label="Default select example">
                        <option value="0">--Select--</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control user-data-add"  name="password" placeholder="Password">
                </div>
                <div class="col-6">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control user-data-add"  name="confirm_password" placeholder="Confirm Password">
                </div>

            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success add-new-user-btn">Add</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript"  src={{asset("custom/user/dashboard/js/users.js")}}></script>
@endsection