<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\User;
use DB;

class DashboardController extends Controller
{
    public function Index(){
        if(!Auth::check()){
            return redirect('/login');
        }
        $total_archives= DB::table('total_archives')->latest()->get();
        $total_archives=$total_archives[0];
        return view('user\pages\dashboard\index',compact('total_archives'));
    }
    public function Users(){
        if(!Auth::check()){
            return redirect('/login');
        }
        $users= DB::table('users')->get();
        $products= DB::table('products')->get();
        return view('user\pages\dashboard\users',compact('users','products'));
    }

    public function GetUsers(Request $request){
        if(!Auth::check()){
            return redirect('/login');
        }
        $user=DB::table('users')->where('id',$request->id)->get();
        $user=$user[0];
        return $user;
        
    }

    public function UpdateUser(Request $request){
        $data=$request->data;
        $id=$data['id'];
        unset($data['id']);
        if(isset($data['password'])){
            $check_password=$this->CheckCurrentPassword($data['current_password'],$id);
            
            if($check_password===true){
                unset($data['confirm_password'],$data['current_password']);
                $data['password']=Hash::make($data['password']);
                return $this->UpdateQuerie($data,$id); 
            }else{
                return $check_password;
            }
            
            
        }else{
            return $this->UpdateQuerie($data,$id); 
        }
    }

    public function AddUser(Request $request){
        $data=$request->data;
        $if_email_used=DB::table('users')->where('email',$data['email'])->count();
        if($if_email_used>0){
            return "This email already used by another user!";
        }else{
            unset($data['confirm_password']);
            DB::table('users')->insert($data);
            return true;
        }
    }

    public function DeleteUser(Request $request){
        $id=$request->id;
        $product=DB::table('users')->select('product')->where('id',$id)->get();
        $product=$product[0]->product;
        if($product==0){
            DB::table('users')->where('id', $request->id)->delete();
            return true;
        }else{
            return "Can not delete this user, because this user has a product!";
        }
        
    }


    public function UpdateQuerie($data,$id){
        $if_email_used=DB::table('users')->where('email',$data['email'])->where('id',"<>",$id)->count();
        if($if_email_used>0){
            return "This email already used by another user!";
        }else{
            DB::table('users')->where('id', $id)->update($data);
            return true;
        }
    }

    public function CheckCurrentPassword($current_password,$id){
        $password=DB::table('users')->select('password')->where('id',$id)->get();
        $password = $password[0]->password;
        if(!Hash::check($current_password,$password)){
            return "Invalid current password";
        }else{
            return true;
        } 
    }

    public function Proudcts(){
        if(!Auth::check()){
            return redirect('/login');
        }
        $products= DB::table('products')->get();
        $categories= DB::table('categories')->get();
        return view('user\pages\dashboard\proudcts',compact('products','categories'));
    }
    
    public function GetProduct(Request $request){
        if(!Auth::check()){
            return redirect('/login');
        }
        $product=DB::table('products')->where('id',$request->id)->get();
        $product=$product[0];
        return $product;
    }

    public function UpdateProduct(Request $request){
        $data=['name' => $request->name,'description' => $request->description,'quantity' => $request->quantity,'price'=>$request->price,'category_ids'=>$request->category_ids_table];
        $id=$request->product_id;
        if ($request->file('image_url')) {
            $image_path = $request->file('image_url');
            $image_type=$image_path->getClientOriginalName();
            $image_type=explode('.', $image_type);
            $image_type=$image_type[1];
            $image_name=$this->ImageName(5,$image_type);
            $path = $request->file('image_url')->storeAs('proudcts_images', $image_name, 'public');
            $data = array("image_url" =>$path);
            return $this->UpdateProductQuery($data,$id,$request->category_ids_table);
        }else{
            return $this->UpdateProductQuery($data,$id,$request->category_ids_table);
        }  
    }


    function UpdateProductQuery($data,$id,$categories_array){
        $categories_array= json_decode($categories_array,true);
    
        DB::table('category_ids')->where('product_id', $id)->delete();
        foreach($categories_array as $category_array){
            DB::table('category_ids')->insert(['category_id'=>$category_array,'product_id'=>$id]);
        }

        DB::table('products')->where('id',$id)->update($data);
        return true;
    }

    public function AddProduct(Request $request){
        $data=['name' => $request->name,'description' => $request->description,'quantity' => $request->quantity,'price'=>$request->price,'category_ids'=>$request->category_ids_table_add];
        $image_path = $request->file('image_url');
        $image_type=$image_path->getClientOriginalName();
        $image_type=explode('.', $image_type);
        $image_type=$image_type[1];
        $image_name=$this->ImageName(5,$image_type);
        $path = $request->file('image_url')->storeAs('proudcts_images', $image_name, 'public');
        $data += array("image_url" =>$path);

        return $this->AddProductQuery($data,$request->category_ids_table_add);
    }

    public function AddProductQuery($data,$categories_array){
        $categories_array= json_decode($categories_array,true);
        DB::table('products')->insert($data);
        $id=DB::table('products')->select('id')->latest('created_at', 'desc')->first();
        foreach($categories_array as $category_array){
            DB::table('category_ids')->insert(['category_id'=>$category_array,'product_id'=>$id->id]);
        }
        return true;
    }

    public function ImageName($length ,$image_path) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString.".".$image_path;
    }

    public function DeleteProduct(Request $request){
        $id=$request->id;
        DB::table('products')->where('id', $request->id)->delete();
        return true;

    }



    public function Categories(){
        if(!Auth::check()){
            return redirect('/login');
        }
        $categories= DB::table('categories')->get();
        return view('user\pages\dashboard\categories',compact('categories'));
    }

    public function GetCategory(Request $request){
        if(!Auth::check()){
            return redirect('/login');
        }
        $category=DB::table('categories')->where('id',$request->id)->get();
        $category=$category[0];
        return $category;
    }
    
    public function UpdateCategory(Request $request){
        if(!Auth::check()){
            return redirect('/login');
        }
        DB::table('categories')->where('id',$request->id)->update($request->data);
        return true;
    }

    public function AddCategory(Request $request){
        if(!Auth::check()){
            return redirect('/login');
        }
        DB::table('categories')->insert($request->data);
        return true;
    }

    public function DeleteCategory(Request $request){
        if(!Auth::check()){
            return redirect('/login');
        }
        $id=$request->id;
        DB::table('categories')->where('id', $request->id)->delete();
        return true;
    }
    
    
}
