<section class="product_section layout_padding">

         <div class="container">
            <div class="heading_container heading_center">
               

               <div>

               <form action="{{url('search_product')}}" method="GET">
                   @csrf
               <input style="width:500px;" type="text" name="search" id=""placeholder="Search for something">
                  <input type="submit" value="search">
               </form>
               </div>
            </div>
            @if(session()->has('message'))
<div class="alert alert-success" >
  <!-- showing the message -->
  <!-- add the close option to the message -->
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
  {{session()->get('message')}}

</div>
@endif
            <div class="row">
               <!-- we want to use  the function paginate so we should make sure to use different data $product and $products so that we will not have a problem -->
            @foreach($product as $products)
               <div class="col-sm-6 col-md-4 col-lg-4">
                  <div class="box">
                     <div class="option_container">
                        <div class="options">
                           <a href="{{url('product_detail',$products->id)}}" class="option1">
                           Product Detail
                           </a>
                           
                           <form action="{{url('add_cart',$products->id)}}" method="POST">
                              @csrf
                              <div>
                              <input class="option1" style="border-radius:30px;background-color:black;padding-bottom:13px;padding-top:13px;x;"  type="submit" value="Add To Cart">
                         
                           </div>
                        
                           <div class="row">
                           <div class="col-md-4">
                           <input type="number" name="quantity" value="1" min="1" style="width:60px;height:40px; border-radius:10px;margin-left:60px;">
                           </div>
                           </div>


                           </form>
                        </div>
                     </div>
                     <div class="img-box">
                        <!-- getting the images from database -->
                        <!-- the images of the data are in public/product -->
                        <img src="product/{{$products->image}}" alt="">
                     </div>
                     <div class="detail-box">
                        <h5>
                           <!-- getting the product title -->
                           {{$products->title}}
                        </h5>
                        <!-- if there is a discount_price  for the product show it ,otherwise don't -->
                        @if($products->discount_price!=null)
                        <h6 style="color :red">
                        Discount_price
                        <br>
                        {{$products->discount_price}}$
                        </h6>
               <!-- if there is a discount_price le prix intial sera marque avec une barre  -->
                                
               <h6 style="text-decoration:line-through ;color:blue">
                         Price
                        <br> 
                        {{$products->price}}$
                        </h6>
                        <!-- if there is no discount_price show the price as it is -->
                         @else
                        
                        <br>
                        <h6 style="color :blue">
                        Price
                        <br>
                        {{$products->price}}$
                        </h6>
                        @endif
                     </div>
                  </div>
               </div>
               @endforeach
               <!-- permet de passer d'une page a une autre de products -->
               <span style="padding-top:20px;">
               {!!$product->withQueryString()->links('pagination::bootstrap-5')!!}
               </span>
            </div>
      </section>