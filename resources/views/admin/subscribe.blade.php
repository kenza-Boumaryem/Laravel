<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css');
   <style>
    body {
        background-color: black;
        color: white;
        font-family: Arial, sans-serif;
    }
   
    .title_deg {
        text-align: center;
        font-size: 25px;
        font-weight: bold;
        padding: 40px 0;
    }
    
    .table_deg {
        border: 2px solid white;
        width: 100%;
        margin: auto;
        text-align: center;
        border-collapse: collapse;
    }
    
    .th_deg {
        background-color: skyblue;
        padding: 10px;
    }
    
    .table_deg th,
    .table_deg td {
        padding: 10px;
        border-bottom: 1px solid white;
    }
    
    .img_size {
        width: 200px;
        height: 100px;
    }
    
    .btn-a {
        display: inline-block;
        padding: 10px 20px;
        font-size: 14px;
        text-align: center;
        text-decoration: none;
        background-color: #17a2b8;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s ease;
       
    }
    
    .btn:hover {
        background-color: dodgerblue;
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
          <h1 class="title_deg">All Subscribers</h1>

          <table class="table_deg">
            <tr class="th_deg">
              <th>id</th>
              <th>Email</th>
              <th>Repondre</th>
            </tr>
            @foreach($sub as $sub)
              <tr>
                <td>{{$sub->id}}</td>
                <td>{{$sub->email}}</td>
                <td>
                  <a href="{{url('send_email_subscriber',$sub->id)}}" class="btn-a">Send Email</a>
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
