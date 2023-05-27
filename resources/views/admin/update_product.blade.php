<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- we added this base in ordre to find the css folder that is in public/admin/css -->
    <!-- <base href="/public"> -->
   @include('admin.css');
   <style type="text/css">

.div_center{
    
    text-align:center;
    padding-top:40px;
}
.font_size{
    font-size:40px;
    padding-bottom:40px;
}
.text_color{
    color:black;
    padding-bottom:20px;
}
label{
    display:inline-block;
    width:200px;
}
.div_design{
    padding-bottom:15px;
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
<!-- verifier si il y'a un message  a recuperer-->
          @if(session()->has('message'))
<div class="alert alert-success" >
  <!-- showing the message -->
  <!-- add the close option to the message -->
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
  {{session()->get('message')}}

</div>
@endif
            
            <div class="div_center">

             <h1 class="font_size">Update  Product</h1>
             <!-- we need enctype because we will add in our form an image  -->
             <form action="{{url('/update_product_confirm',$product->id)}}"method="POST"enctype="multipart/form-data">
             @csrf


             <div class="div_design">
               
            <label>Product Title</label>
            <!-- recuperer le title du produit envoye par la fonction update_product dans le controlleur AdminController -->
            <!-- on a utilise value pour que losrqu'on clique sur edit
            les informations de ce produit qu'on veut editer reste dans le formulaire -->
            <input value="{{$product->title}}" required="" class="text_color" type="text" name="title"  >
            </div>
             
            <div class="div_design">
            <label>Product Description</label>
            <input value="{{$product->description}}"required="" class="text_color" type="text" name="description" >
            </div>
            <div class="div_design">
            <label>Product Price</label>
            <input value="{{$product->price}}" required=""class="text_color" type="number" name="price" >
            </div>
            <div class="div_design">
            <label>Discount Price</label>
            <input value="{{$product->discount_price}}" class="text_color" type="number" name="dis_price" >
            </div>
            <div class="div_design">
            <label>Product Quantity</label>
            <input value="{{$product->quantity}}"required="" class="text_color" type="number" min="0" name="Quantity" >
            </div>
            
            <div class="div_design">
            <label>Product Category</label>
            <select  required=""class="text_color" name="category">
                <!-- c-a-d par defaut dans l'option on trouvera celle qu'on a recuperer
                du database de ce produit -->
            <option value="{{$product->category}}" selected="" >{{$product->category}}</option> 
            @foreach($category as $category)
            <!-- recuperer tous les valeurs de la colonne category_name -->
            <option value="{{$category->category_name}}" >{{$category->category_name}}</option>
            @endforeach  
           
            </select>
            </div>
            <div class="div_design">
    
            <label>Current Product Image</label>
           <img  src="/product/{{$product->image}}"height="100px" width="100px" style="margin:auto;" alt="">
            </div>
            <div class="div_design">
            <label>Change Product Image</label>
           <input required="" type="file" name="image" >
            </div>
            <div class="div_design">
          
           <input type="submit" value="Update Product" class="btn btn-primary" >
            </div>
            </form>


            </div>
           
            </div>
            </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>