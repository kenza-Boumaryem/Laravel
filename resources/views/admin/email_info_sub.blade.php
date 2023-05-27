<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
   @include('admin.css');
  </head>
  <style>
    label{
        display:inline-block;
        width:200px;
        font-size:15px;
        font-weight:bold;

    }
  </style>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
     @include('admin.sidebar');
      <!-- partial -->
      @include('admin.header');
        <!-- partial -->
       
        
        <div class="main-panel">
          <div class="content-wrapper">
     <!-- this informations are coming from the admin controller from the function send_email -->
        <h1 style="text-align:center; font-size:25px">Send Email to {{$subscribe->email}}</h1>
<form action="{{url('send_user_email_sub',$subscribe->id)}}" method="POST">
    @csrf
<div style="padding-left:35%;padding-top:30px;">
    <label for="">Email Greeting :</label>
    <input style="color:black" type="text" name="greeting">
</div>

<div style="padding-left:35%;padding-top:30px;">
    <label for="">Email's First Line:</label>
    <input style="color:black" type="text" name="firsline">
</div>
<div style="padding-left:35%;padding-top:30px;">
    <label for="">Email Body :</label>
    <input style="color:black" type="text" name="body">

</div>
<div style="padding-left:35%;padding-top:30px;">
    <label for="">Email button name :</label>
    <input style="color:black"type="text" name="button">
</div>
<div style="padding-left:35%;padding-top:30px;">
    <label for="">Email Url :</label>
    <input style="color:black"type="text" name="url">
</div>
<div style="padding-left:35%;padding-top:30px;">
    <label for="">Email last line :</label>
    <input style="color:black"type="text" name="lastline">
</div>
<div style="padding-left:35%;padding-top:30px;">
   
    <input  type="submit" value="Send Email" class="btn btn-primary">
</div>






</form>










            </div>
            </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>