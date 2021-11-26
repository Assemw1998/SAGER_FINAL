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
       // $products= DB::table('products')->get();
        $categories= DB::table('categories')->get();
        $category_ids= DB::table('category_ids')->get();


        $products = DB::table('products')
        ->rightJoin('category_ids', 'products.id', '=', 'category_ids.product_id')
        ->rightJoin('categories', 'category_ids.category_id', '=', 'categories.id')
        ->select('products.*','categories.name as category_name')
        ->get();

        dd($products);
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
        dd($request->category_ids);
        $data=['name' => $request->name,'description' => $request->description,'quantity' => $request->quantity,'price'=>$request->price,'category_ids'=>$request->category_ids];
        $id=$request->product_id;
        if ($request->file('image_url')) {
            $image_path = $request->file('image_url');
            $image_type=$image_path->getClientOriginalName();
            $image_type=explode('.', $image_type);
            $image_type=$image_type[1];
            $image_name=$this->ImageName(5,$image_type);
            $path = $request->file('image_url')->storeAs('proudcts_images', $image_name, 'public');
            $data = array("image_url" =>$path);
            return $this->UpdateProductQuery($data,$id);
        }else{
            return $this->UpdateProductQuery($data,$id);
        }  
    }

    function ImageName($length ,$image_path) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString.".".$image_path;
    }

    function UpdateProductQuery($data,$id){
        DB::table('products')->where('id',$id)->update($data);
        return true;
    }
    
    
}
