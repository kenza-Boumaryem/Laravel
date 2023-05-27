<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css');
   <style>
    .title_deg{
        text-align:center;
        font-size: 25px;
        font-weight:bold;
        padding-bottom:40px;
    }
    .table_deg{
        border:2px solid white;
        width:100%;
        margin:auto;
        text-align:center;
    }
    .th_deg{
        background-color:skyblue;
    }
    .img_size{
        width:200px;
        height:100px;
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
<h1 class="title_deg">All Orders</h1>
<div style="padding-left:400px;padding-bottom:30px;">
  <form action="{{url('search')}}" method="get">
    @csrf
    <input style="color:black;" type="text" name="search" placeholder="Search for something">
    <input type="submit" class="btn btn-outline-primary"value="Search">
  </form>
</div>

          <table class="table_deg">

           <tr class="th_deg">
            <th style="padding:10px;">Name</th>
            <th style="padding:10px;">Email</th>
            <th style="padding:10px;">Address</th>
            <th style="padding:10px;">Phone</th>
            <th style="padding:10px;">Product_title</th>
            <th style="padding:10px;">Quantity</th>
            <th style="padding:10px;">Price</th>
            <th style="padding:10px;">Payment_status</th>
            <th style="padding:10px;">delivery_status</th>
            <th style="padding:10px;">Image</th>
            <th style="padding:10px;">Delivered</th>
            <th style="padding:10px;">Print PDF</th>
            <th style="padding:10px;">Send Email</th>
            
           </tr>
           @forelse($order as $order)
<tr>
<td>{{$order->name}}</td>
<td>{{$order->email}}</td>
<td>{{$order->address}}</td>
<td>{{$order->phone}}</td>
<td>{{$order->product_title}}</td>
<td>{{$order->quantity}}</td>
<td>{{$order->price}}</td>
<td>{{$order->payment_status}}</td>
<td>{{$order->delivery_status}}</td>
<td>
    <!-- images are in public/product -->
    <img  class="img_size"src="/product/{{$order->image}}" alt="">


</td>

<td>
    <!-- si l'admin n'a pas clique sur le bouton deliverd -->
    @if($order->delivery_status=='processing')
    <a href="{{url('delivered',$order->id)}}" onclick="return confirm('are you sure that this product is delivered')"class="btn btn-primary">Delivered</a>
    <!-- si l'admin a clique sur le bouton delivered on va lui affiche un message -->
    @else
    <p style="color:green;">Delivered</p>
    
    @endif
</td>
<td>

<a href="{{url('print_pdf',$order->id)}}"class="btn btn-secondary">Print PDF</a>
</td>
<td>
    <a href="{{url('send_email',$order->id)}}"class="btn btn-info">Send Email</a>
</td>



</tr>
<!-- si on veut utiliser l'annotation empty il  faut pas utiliser foreach mais il faut utiliser forelse -->
@empty
<!-- si l'user cherche quelque chose qui ne se trouve pas dans le tableau on va lui afficher no data Found -->
<tr>
  <td colspan="16">No Data Found</td>
</tr>
@endforelse
          </table>


          </div>
          </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>