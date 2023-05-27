<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css');
   <style>
     .center{
    margin:auto;
    width:60%;
    border:2px solid white;
    text-align:center;
    margin-top:40px;
    } 
    .font_size{
       
        text-align:center;
        font-size: 25px;
        font-weight:bold;
        padding-bottom:40px;
    }
    .img_size{
        width:150px;
        height:150px;
    }
    .th_color{
        background:skyblue;
    }
    .th_deg{
        padding:25px;
        font-family:Apple Chancery;
        font-size:20px;

    }
   </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar');
      <!-- partial -->
      @include('admin.header');
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">

          @if(session()->has('message'))
          <div class="alert alert-success" >
  <!-- showing the message -->
  <!-- add the close option to the message -->
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
       {{session()->get('message')}}

</div>
@endif

         <h2 class="fon_size">All Products</h2>
          <table class="center">
         <tr class="th_color">
         <th class="th_deg">Product title</th>
         <th class="th_deg">Description</th>
         <th class="th_deg">Quantity</th>
         <th class="th_deg">category</th>
         <th class="th_deg">Price</th>
         <th class="th_deg">Discount Price</th>
         <th class="th_deg">Product Image</th>
         <th class="th_deg">Delete</th>
         <th class="th_deg">Edit</th>
         </tr>
@foreach($product as $product)
       <tr>
    <td>{{$product->title}}</td>
    <td>{{$product->description}}</td>
    <td>{{$product->quantity}}</td>
    <td>{{$product->category}}</td>
    <td>{{$product->price}}</td>
    <td>{{$product->discount_price}}</td>
    <td>
        <!-- product est le nom du folder qui est dans public :public/product
        image est le nom du colonne dans database -->
        <img class="img_size"src="/product/{{$product->image}}" alt="">
    </td>
    <td>
        <!-- to get the id from the database:{{$product->id}} as we did en haut -->
        <a onclick="return confirm('are you sure to delete the product ?')"href="{{url('delete_product',$product->id)}}" class="btn btn-danger">Delete</a>
    </td>
    <td>
        <a href="{{url('update_product',$product->id)}}"class="btn btn-success">Edit</a>
    </td>
    
</tr>
@endforeach




          </table>







            </div>
            </div>
            
            
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>