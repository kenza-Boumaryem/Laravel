<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use App\Models\Contact;
use App\Models\User;
use App\Models\Subscribe;
use App\Models\NotificationU;
use PDF;
use Notification;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewUserNotification;

class AdminController extends Controller
{
    //
    public function view_category(){
if(Auth::id()){
//getting the data from Category table and storing them in a variable called data
$data=Category::all();


//view se trouve dans views/admin/category.blade.php
//sending this data to the view admin/category
        return view('admin.category',compact('data'));
}
else{
    return  redirect('login');
}

    }
    //
    public function add_category(Request $request){

        //we will add the category'data to our database
$data=new Category;
//ce que l'admin ecrit dans l'input(f category.blade.php drna name="category") sera ecrit dans 
//la colonne category_name dans la base de donnees
$data->category_name=$request->category;
$data->save();
//after saving the data we want to stay on the same page
return redirect()->back()->with('message','category added successfully');



            }
//getting the id that is mentioned in the url
            public function delete_category($id){
$data=Category::find($id);
$data->delete();
return redirect()->back()->with('message','category Deleted successfully');

            }

public function view_product(){
//we will send the data  of catergory to product.blade.php
//because we  need all the categories as options in our form so that the admin choose 
//getting all the data from the database
$category= Category::all();
//we will send the variable category that contains all the categories(we do this by using :compact('name of the variable'))
         return view('admin.product',compact('category'));
            }

        //using $request because we will get all the data from the form in product.blade.php
        public function add_product(Request $request){

     $product=new Product;
     //premier title c'est le nom du colonne dans la base de donnees
     //deuxieme title est la valeur de l'attribut name="" qui se trouve dans form dans le fichier product.blade.php 
     $product->title=$request->title;
     $product->description=$request->description;
     $product->price=$request->price;
     $product->quantity=$request->Quantity;
     $product->discount_price=$request->dis_price;
     $product->category=$request->category;
     //storing the image
     $image=$request->image;
     //giving the image a unique name using the time function
     //getClientOriginalExtension() :to get the extension of the image
     $imagename=time().'.'.$image->getClientOriginalExtension();
     //storing the image in a folder called product(public/product)
     $request->image->move('product',$imagename);
     $product->image=$imagename;
     //saving the data
     $product->save();
     return redirect()->back()->with('message','Product added successfully');


        }


    public function show_product(){
  //Product est le nom du modele
        $product=Product::all();
        //sending the data to the view
          return view('admin.show_product',compact('product'));

    }

public function delete_product($id){

$product=Product::find($id);
$product->delete();
    return redirect()->back()->with('message','Product Deleted Successfully');
}

public function update_product($id){
    $product=Product::find($id);
    //we need also to send all the categories
    //because when he will edit we need to show him all the categories
    $category=Category::all();
    //envoyer le produit a editer a notre view admin/update_product.blade.php
    //envoyer les categories
return view('admin.update_product',compact('product','category'));
}

public function update_product_confirm(Request $request,$id){
    if(Auth::id()){
        $product=Product::find($id);
        //premier title c'est le nom du colonne dans la base de donnees
            //deuxieme title est la valeur de l'attribut name="" qui se trouve dans form dans le fichier update_product.blade.php 
       $product->title=$request->title;
       $product->description=$request->description;
       $product->price=$request->price;
       $product->quantity=$request->Quantity;
       $product->discount_price=$request->dis_price;
       $product->category=$request->category;
       //storing the image
       $image=$request->image;
       //if there is an image it means if the admin changed the image
       if($image){
           //giving the image a unique name using the time function
       //getClientOriginalExtension() :to get the extension of the image
       $imagename=time().'.'.$image->getClientOriginalExtension();
       //storing the image in a folder called product(public/product)
       $request->image->move('product',$imagename);
       //now after this we will store the image in the database
       $product->image=$imagename;
       }
       //if the admin didn't change the pic and he let the older one
       //we're not gonna do anything about the image
       
       //saving the data
       $product->save();
       return redirect()->back()->with('message','Product Updated successfully');
       
    }
    else{
        return redirect('login');
    }


}


public function order(){
    $order=Order::all();

return view('admin.order',compact('order'));
}
public function delivered($id){
  $order=Order::find($id);
  //changer la colonne devlivery status et payement_status si l'admin clique sur le bouton delivered
  $order->delivery_status="delivered";
  $order->payment_status="Paid";
  $order->save();
return redirect()->back();


}
public function print_pdf($id){
    //finding the specific order from the table orders in database
    $order=Order::find($id);
$pdf=PDF::loadView('admin.pdf',compact('order'));
//the pdf name will be order_details
return $pdf->download('order_details.pdf');
}
public function send_email($id){
 $order=Order::find($id);
return view('admin.email_info',compact('order'));
}

public function send_user_email(Request $request,$id){
    // on recupere le id du order pour ensuite recuperer l'email de celui qui a fait order
$order=order::find($id);
//$details se trouve dans app/Notifications/sendEmailNotification

$details=[
    //on recupere du data a partir de l'input et on va les stockeer dans dans $details qu'on va envoyer a sendEmailNotification
    // 1ere greeting qu'on ecrit ici doit etre la meme dans qui dans app/Notifications/sendEmailNotification dans la fonction toMail(greeting qui est entre crochets)
   //2eme greeting corespond a celle qui est dans name="" dans l'input greeting dans email_info.blade.php
    'greeting'=>$request->greeting,
    'firstline'=>$request->firstline,
    'body'=>$request->body,
    'button'=>$request->button,
    'url'=>$request->url,
    'lastline'=>$request->lastline,


];
//$order ici va permettre d'envoyer l'email au destination  pas besoin de specfier email il va automatiquement
//envoyer l'email a l'email de l'utilsateur qui a fait cet ordre
Notification ::send($order,new SendEmailNotification($details));
return redirect()->back();

}
public function searchdata(Request $request){
    //search c'est celle qui est name="" dans l'input dans order.blade.php
    //recuperer ce que l'user a ecrit dans la barre de recherche
    $searchText=$request->search;
    //name est la colonne dans la table order dans database 
    //chercher dans la table order ce que l'user a ecrit  dans la barre de recherhce
    //user peut chercher dans la barre de recherche soit phone,product-title,name
    $order=Order::where('name','LIKE',"%$searchText%")->orWhere('phone','LIKE',"%$searchText%")->orWhere('product_title','LIKE',"%$searchText%")->get();
    return view('admin.order',compact('order'));
    //si ce que l'user a tape n'existe pas 


}
public function message(){

    $contact=Contact::all();
   
    return view('admin.message',compact('contact'));
}

public function send_email_message($id){
    $contact=Contact::find($id);
return view('admin.email_info_message',compact('contact'));
}
public function send_user_email_message(Request $request,$id){
 $contact=Contact::find($id);
 //$details se trouve dans app/Notifications/sendEmailNotification
 
 $details=[
     //on recupere du data a partir de l'input et on va les stockeer dans dans $details qu'on va envoyer a sendEmailNotification
     // 1ere greeting qu'on ecrit ici doit etre la meme dans qui dans app/Notifications/sendEmailNotification dans la fonction toMail(greeting qui est entre crochets)
    //2eme greeting corespond a celle qui est dans name="" dans l'input greeting dans email_info.blade.php
     'greeting'=>$request->greeting,
     'firstline'=>$request->firstline,
     'body'=>$request->body,
     'button'=>$request->button,
     'url'=>$request->url,
     'lastline'=>$request->lastline,
 
 
 ];
 //$order ici va permettre d'envoyer l'email au destination  pas besoin de specfier email il va automatiquement
 //envoyer l'email a l'email de l'utilsateur qui a fait cet ordre
 Notification ::send($contact,new SendEmailNotification($details));
 return redirect()->back();


}

public function utilisateur(){

    $user=User::all();
    //sending the data to the view
      return view('admin.show_utilisateur',compact('user'));
}
public function delete_user($id){
 $data=User::find($id);
$data->delete();
return redirect()->back()->with('message','User Deleted successfully');

}


public function deletenotif(Request $request){

    $id = $request->input('key');
    //$notify = json_decode($valeur);

    $data = NotificationU::find($id)->delete();
    
    
     response()->json(['message' => 'Requête AJAX traitée avec succès'.$id]);

}

public function send_subsc(){


    $sub=subscribe::all();
   
    return view('admin.subscribe',compact('sub'));


}
public function send_email_subscriber($id){
    $subscribe=subscribe::find($id);
return view('admin.email_info_sub',compact('subscribe'));
}
public function send_user_email_sub(Request $request,$id){
    $subscribe=subscribe::find($id);
    //$details se trouve dans app/Notifications/sendEmailNotification
    
    $details=[
        //on recupere du data a partir de l'input et on va les stockeer dans dans $details qu'on va envoyer a sendEmailNotification
        // 1ere greeting qu'on ecrit ici doit etre la meme dans qui dans app/Notifications/sendEmailNotification dans la fonction toMail(greeting qui est entre crochets)
       //2eme greeting corespond a celle qui est dans name="" dans l'input greeting dans email_info.blade.php
        'greeting'=>$request->greeting,
        'firstline'=>$request->firstline,
        'body'=>$request->body,
        'button'=>$request->button,
        'url'=>$request->url,
        'lastline'=>$request->lastline,
    
    
    ];
    //$order ici va permettre d'envoyer l'email au destination  pas besoin de specfier email il va automatiquement
    //envoyer l'email a l'email de l'utilsateur qui a fait cet ordre
    Notification ::send($subscribe,new SendEmailNotification($details));
    return redirect()->back();
   
   
   }
   public function delete_message($id){
    $data=Contact::find($id);
    $data->delete();
return redirect()->back()->with('message','Message Deleted successfully');

            
   }



}
