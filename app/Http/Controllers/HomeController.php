<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//importer la classe model user
use App\Models\User;
use App\Models\Product;
use App\Models\Carte;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Subscribe;
use App\Notifications\NewUserNotification;
use App\Notifications\NewMessageNotification;

use Session;
use Stripe;
use App\Models\Comment;
use App\Models\Reply;
//dans  routes/web we created a route and we added the name of the controller(HomeController)and the function index

class HomeController extends Controller
{
//create a function index


// public function index(){
//     //dans view/home/userpage : this file include the template of our website
//     return view('home.userpage');
// }
// we want to show the products in th
public function index(){
    //getting all the product data from the table and send it to the view
//the view is Home/userpage.blade.php et dans userpage on a 
//@include(home.product) so we will send it exaclty to home/product.blade.php
 //we could have a lot od data to show so we should preciser how much data we want to show using the function paginate(number of data)   
$product=Product::paginate(10);
$comment=Comment::orderby('id','desc')->get();
$reply=Reply::all();

    return view('home.userpage',compact('product','comment','reply'));
}




//create a function redirect
public function redirect(){
    //verifier si le user est normal ou bien admin
    //declarer une variable qui contiendra la valeur de la colonne usertype qui se trouve dans la base de donnees
    $usertype=Auth::user()->usertype;
    if($usertype==1){ 
        //the name of the folder is admin and the file is home :views/admin/home
        //compter combien de lignes (produits) qu'on a dans la table products dans database
       $total_product=product::all()->count();
       $total_order=Order::all()->count();
       $total_user=User::all()->count();
       $order=order::all();
       $total_revenue=0;
       //calculer le revenue total by adding all the prices
       foreach($order as $order){
        $total_revenue=$total_revenue+$order->price;
       }
       $total_delivered=order::where('delivery_status','=','delivered')->get()->count();
       $total_processing=order::where('delivery_status','=','processing')->get()->count();
        return view('admin.home',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
    }
    else{
        //this view is already created in ressource/view/profile/dashboard.blade.php
        //and it's the view that get the user after login
       // return view('dashboard');
       //in our userpage we used a variable called $product
       //so not get an error we should do what we did in the function index

       $product=Product::paginate(3);
       //sending all the comments
       //to keep the new comments in the begining we will add orderby()
       $comment=Comment::orderby('id','desc')->get();
       $reply=Reply::all();
       return view('home.userpage',compact('product','comment','reply'));
    }
   
     
}
public function product_detail($id){
//getting the product and send it to the view 
$product=Product::find($id);
return view('home.product_details',compact('product'));
}
//we made $request cauz the user will give a number of quantity in the input so we should get it
public function add_cart(Request $request,$id){
//checker if the user is login or not
//if the user is login he will stay in the same page
if(Auth::id()){
    //get the user data 
$user=Auth::user();
$userid=$user->id;
   //get the product data
$product=Product::find($id);

// si l'utilisateur ajoute le meme product 2 fois il faut que uniquement la quantite augmente
//pour cela on va faire un if si le id du user et du product est le meme 2 fois
$product_exist_id=Carte::where('Product_id','=',$id)->where('user_id','=',$userid)->get('id')->first();


if($product_exist_id){


    $carte=Carte::find($product_exist_id)->first();
    $quantity=$carte->quantity;
    $carte->quantity=$quantity+$request->quantity;
    if($product->discount_price!=null){
        $carte->price=$product->discount_price*$carte->quantity;
    }
    else{
    $carte->price=$product->price*$carte->quantity;
    }
    $carte->save();
    return redirect()->back()->with('message','Product Added successfully');
}
//si le produit n'existe pas deja on va l'ajouter dans la carte

else{


    $carte=new Carte;
    //remplir le tableau carte par les infos du user 
    //premier name est le nom du colonne dans le tableau cartes
    //2eme name est le nom du colonne dans le tableau users
    $carte->name=$user->name;
    $carte->email=$user->email;
    $carte->phone=$user->phone;
    $carte->address=$user->address;
    $carte->user_id=$user->id;
    //remplir le tableau carte par les infos du produit
    $carte->product_title=$product->title;
    //if the product has a discount price we will store it instead of price
    if($product->discount_price!=null){
        $carte->price=$product->discount_price*$request->quantity;
    }
    else{
    $carte->price=$product->price*$request->quantity;
    }
    $carte->image=$product->image;
    $carte->product_id=$product->id;
    //2eme quantity est celle qui est dans name=""dans l'inpt dans product.blade.php
    
    $carte->quantity=$request->quantity;
    
    $carte->save();
    return redirect()->back()->with('message','Product Added successfully');


}

}
else{
    //if the user is not login he will be directed to the login page
    return redirect('login');
}


}
public function show_cart(){
//if the user is login
if(Auth::id()){
//getting the id of the user who  is login
$id=Auth::user()->id;
//getting the informations of the product that have this user_id
$cart=Carte::where('user_id','=',$id)->get();

    return view('home.showcart',compact('cart'));
}
else{
    //if the user is not login we wil retirect him to the login page 
    return redirect('login');
}

}
public function remove_cart($id){
$cart=Carte::find($id);
$cart->delete();
return redirect()->back();

}
public function cash_order(){
    //getting the  data of the user that he's login
$user=Auth::user();
//getting the id of the user that he's login
$userid=$user->id;
//on cherche dans la table carte les informations de  celui qui a le id du user qui est en login
$data=Carte::where('user_id','=',$userid)->get();
//le user qui a ce id peut avoir plusieurs lignes dans la table carte
//pour cela il faut que qu'on utilise une boucle pour recuperer tous ce data
foreach($data as $data){
   $order=new Order;
   //1er name est le nom du colonne dans la table order
   // //2eme name est le nom du colonne dans la table carte
     $order->name=$data->name;
     $order->email=$data->email;
     $order->phone=$data->phone;
     $order->address=$data->address;
     $order->user_id=$data->user_id;
     $order->product_title=$data->product_title;
     $order->price=$data->price;
     $order->quantity=$data->quantity;
     $order->image=$data->image;
     $order->product_id=$data->product_id;
     $order->payment_status='cash on delivery';
     $order->delivery_status='processing';
     $order ->save();
//getting the id of the cart from the cart table
//le but est de supprimer tous ce qui est dans cart table apres
//avoir le stocker dans order table
     $cart_id=$data->id;
     $cart=carte::find($cart_id);
     $cart->delete();


}
return redirect()->back()->with('message','we have Received your order , we will connect with u soon...');

}

public function stripe($totalprice){


return view('home.stripe',compact('totalprice'));

}
public function stripePost(Request $request,$totalprice)
{
    //we get stripe_secret from the file .env
    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

    Stripe\Charge::create ([
        //we multiply by 100 to make it in dollar because if we don't it will be count on cent
            "amount" => $totalprice*100,
            "currency" => "usd",
            //stripeToken se trouve dans stripe.blade.php
            "source" => $request->stripeToken,
            "description" => "Thanks for your order" 
    ]);
        //getting the  data of the user that he's login
$user=Auth::user();
//getting the id of the user that he's login
$userid=$user->id;
//on cherche dans la table carte les informations de  celui qui a le id du user qui est en login
$data=Carte::where('user_id','=',$userid)->get();
//le user qui a ce id peut avoir plusieurs lignes dans la table carte
//pour cela il faut que qu'on utilise une boucle pour recuperer tous ce data
foreach($data as $data){
   $order=new Order;
   //1er name est le nom du colonne dans la table order
   // //2eme name est le nom du colonne dans la table carte
     $order->name=$data->name;
     $order->email=$data->email;
     $order->phone=$data->phone;
     $order->address=$data->address;
     $order->user_id=$data->user_id;
     $order->product_title=$data->product_title;
     $order->price=$data->price;
     $order->quantity=$data->quantity;
     $order->image=$data->image;
     $order->product_id=$data->product_id;
     $order->payment_status='Paid';
     $order->delivery_status='processing';
     $order ->save();
//getting the id of the cart from the cart table
//le but est de supprimer tous ce qui est dans cart table apres
//avoir le stocker dans order table
     $cart_id=$data->id;
     $cart=carte::find($cart_id);
     $cart->delete();


}
  
    Session::flash('success', 'Payment successful!');
          
    return back();
}
public function show_order(){
//if the auth id existe:if the user is login
if(Auth::id()){
  $user=Auth::user();
  $userid=$user->id;
  //chercher ce userid dans la table orders poour recupere order's data de ce user
  $order=Order::where('user_id','=',$userid)->get();
   

    return view('home.order',compact('order'));
}
else{
    return redirect('login');
}

}
public function cancel_order($id){
$order=Order::find($id);
$order->delivery_status='You Canceled the order';
$order->save();
return redirect()->back();


}
public function add_comment(Request $request){

//if the user is login then he could make a comment
if(Auth::id()){
$comment=new Comment;
//getting the username from the login informations
//1er name est la colonne dans la table comments
//2eme name est celle de la table users
$comment->name=Auth::user()->name;
$comment->user_id=Auth::user()->id;
//dernier comment correspond a celle qui est dans name="" dans l'input dans userpage.blade.php
$comment->comment=$request->comment;

$comment->save();
return redirect()->back();


}
else{
    return redirect('login');
}





}
public function add_reply(Request $request){

if(Auth::id()){
    $reply=new Reply;
    $reply->name=Auth::user()->name;
    $reply->user_id=Auth::user()->id;
    //commentId   se trouve dans name="" l'input hidden dans userpage
    $reply->comment_id=$request->commentId;
   //2eme reply  se trouve dans name="" l'input  dans userpage
    $reply->reply=$request->reply;
    $reply->save();
    return redirect()->back();
}
else{
    return redirect('login');
}



}




public function contacter(){

    return view('home.contact');
}
public function product_search(Request $request){
    $comment=Comment::orderby('id','desc')->get();
    $reply=Reply::all();
    $search_text=$request->search;
    $product=Product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"$search_text")->paginate(2);
    return view('home.userpage',compact('product','comment','reply'));

}
public function product(){
    $product=Product::paginate(3);
$comment=Comment::orderby('id','desc')->get();
$reply=Reply::all();
    return view('home.all_product',compact('product','comment','reply'));
}

public function search_product(Request $request){
    $comment=Comment::orderby('id','desc')->get();
    $reply=Reply::all();
    $search_text=$request->search;
    $product=Product::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"$search_text")->paginate(2);
    return view('home.all_product',compact('product','comment','reply'));

}
public function contact_util(Request $request){
    if(Auth::id()){

        $contact=new Contact;
        $contact->user_id=Auth::user()->id;
        $contact->phone=Auth::user()->phone;
        $contact->name=$request->Nom;
        $contact->email=$request->Email;
        $contact->message=$request->Message; 
        $contact->save();
    
$lastRow = Contact::latest()->take(1)->get();
$Nom=$lastRow->pluck('name');
$admin=User::find(2);
$admin->notify(new NewMessageNotification($Nom));



        return redirect()->back();

    }
   

    else{
        return redirect('login');
    }
}


public function qr_code(){
    if(Auth::id()){
        $user=Auth::user();
        $userid=$user->id;
      
        $data=Carte::where('user_id','=',$userid)->get();
    }



    return view('home.qr_code',compact('data'));
}

public function shop(){
    $product=Product::paginate(3);
    $comment=Comment::orderby('id','desc')->get();
    $reply=Reply::all();
    return view('home.all_product',compact('product','comment','reply'));
}


public function subscribe(Request $request){

    $sub=new subscribe;
    $sub->email=$request->email;
    $sub->save();
    return redirect()->back();


}














}
