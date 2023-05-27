<!-- on a copie le code qu'on a avait dans home/userpage.blade.php
et on va utiliser uniquement le header et le footer -->


<!DOCTYPE html>
<html>

   <head>
    <!-- to get the css -->
    <!-- <base href="/public"> -->
    <!-- au lieu de ca on va faire {{asset('')}} -->
      <!-- Basic -->
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
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats
           home/header.blade.php -->
        @include('home.header');
        
      
      <!-- we don't need foreach because the we will show the detail of a single product -->
      <div class="col-sm-6 col-md-4 col-lg-4"style="margin:auto;width:50%;padding:30px">
                  
                     <div class="img-box">
                        <!-- getting the images from database -->
                        <!-- the images of the data are in public/product -->
                        <img src="/product/{{$product->image}}" style="padding:20px;">
                     </div>
                     <div class="detail-box">
                        <h5>
                           <!-- getting the product title -->
                           {{$product->title}}
                        </h5>
                        <!-- if there is a discount_price  for the product show it ,otherwise don't -->
                        @if($product->discount_price!=null)
                        <h6 style="color :red">
                        Discount_price
                        <br>
                        {{$product->discount_price}}$
                        </h6>
               <!-- if there is a discount_price le prix intial sera marque avec une barre  -->
                                
               <h6 style="text-decoration:line-through ;color:blue">
                         Price
                        <br> 
                        {{$product->price}}$
                        </h6>
                        <!-- if there is no discount_price show the price as it is -->
                         @else
                        
                        <br>
                        <h6 style="color :blue">
                        Price
                        <br>
                        {{$product->price}}$
                        </h6>
                        @endif
                        <h6> Product category:{{$product->category}}</h6>
                        <h6> Product description:{{$product->description}}</h6>
                        <h6> Avaialble Quantity:{{$product->quantity}}</h6>
                     <!-- Add to Cart -->
                     <form action="{{url('add_cart',$product->id)}}" method="POST">
                              @csrf
                        <div class="row">
                           <div class="col-md-4">
                           <input type="number" name="quantity" value="1" min="1" style="width:100px;">
                           </div>
                     <div class="col-md-4">
                     <input type="submit" value="Add to Cart">
                     </div>
                    
                    </div>


                           </form>
                    </div>
                  </div>
               </div>
    
      @include('home.footer');
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
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