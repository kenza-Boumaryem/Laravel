
<!DOCTYPE html>
<html>
   <head>
   <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- il faut ajouter home/ dans les liens css et js -->
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
   <style>


.center{
    margin:auto;
    width:70%;
    text-align:center;
    padding:30px;
    
}
table,th,td{

    border:1px solid grey;
    font-family:"Goudy Bookletter 1911";
}
.th_deg{
font-size:30px;
padding:5px;
background:skyblue;

}
.img_deg{
    height:200px;
    width:200px;
}
.total_deg{
    font-size:20px;
    padding:40px;
}
   </style>
   
    </head>
   <body>
      <div class="hero_area">
         <!-- header section strats
           home/header.blade.php -->
        @include('home.header');
        
         
      
      
      @if(session()->has('message'))
<div class="alert alert-success" >
  <!-- showing the message -->
  <!-- add the close option to the message -->
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
  {{session()->get('message')}}

</div>
@endif
      <div class="center">
    <table>
    <tr>
        <th class="th_deg">Product title</th>
        <th class="th_deg">Product quantity</th>
        <th class="th_deg">price</th>
        <th class="th_deg">Image</th>
        <th class="th_deg">Action</th>
    </tr>
    <?php
    $totalprice=0;
    
    
    ?>
    @foreach($cart as $cart)
    <tr>

    <td>{{$cart->product_title}}</td>
    <td>{{$cart->quantity}}</td>
    <td>{{$cart->price}}$</td>
    <td><img class="img_deg"src="/product/{{$cart->image}}" alt=""></td>
    <td><a onclick="return confirm('are you sure to remove this product')" class="btn btn-danger"href="{{url('remove_cart',$cart->id)}}">Remove Product</a></td>
    </tr>
    <!-- faire la somme de tous les prix des produits -->
    <?php
    $totalprice=$totalprice+$cart->price;
    ?>
    @endforeach
   


    </table>
    <div>
        <h1 class="total_deg">Total Price:  {{$totalprice}}</h1>
    </div>
    

      
      <a href="{{url('qr_code')}}" class="btn btn-primary">Generate Qr code</a>
      <div>
         <br>
    <h1 style="font-size:25px;padding-bottom:15px">Proceed to Order</h1>
    <a href="{{url('cash_order')}}" class="btn btn-success">Cash on Delivery</a>
    <!-- on va envoyer aussi le prix totale -->
    <a href="{{url('stripe',$totalprice)}}" class="btn btn-success">Pay using card</a>
    </div>




      </div>
     
     
      <!-- footer start -->
     
      <!-- footer end -->
      <!-- <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div> -->
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
   </body>
</html>
