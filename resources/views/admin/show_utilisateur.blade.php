<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css');
   <style>
    body {
        background-color: black;
        color: white;
    }
   
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
        border-collapse: collapse;
    }
    .th_deg{
        background-color:skyblue;
        padding: 10px;
    }
    .img_size{
        width:200px;
        height:100px;
    }
    td, th {
       
        padding: 10px;
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
            <div class="alert alert-success">
              <!-- showing the message -->
              <!-- add the close option to the message -->
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              {{session()->get('message')}}
            </div>
          @endif
          <h1 class="title_deg">All Users</h1>

          <table class="table_deg">
            <tr class="th_deg">
              <th>user_id</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Delete</th>
            </tr>
            @foreach($user as $user)
              <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>{{$user->address}}</td>
                <td>
                  <a onclick="return confirm('Are you sure you want to delete the user?')" href="{{url('delete_user',$user->id)}}" class="btn btn-danger">Delete</a>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>
