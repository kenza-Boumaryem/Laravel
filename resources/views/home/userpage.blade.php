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
      <link rel="shortcut icon" href="images/WhatsApp Image 2023-05-26 at 20.36.52.jpeg" type="">
      <title>Electronic's store</title>
      <!-- il faut ajouter home/ dans les liens css et js -->
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}" />
      <!-- font awesome style -->
      <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{asset('home/css/style.css')}}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet" />
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats
           home/header.blade.php -->
        @include('home.header');
         <!-- end header section -->
         <!-- slider section -->
         @include('home.slider');
         <!-- end slider section -->
      </div>
      <!-- why section -->
     
      <!-- end why section -->
     @include('home.why'); 
      <!-- arrival section -->
      @include('home.new_arrival');
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('home.product');
      <!-- end product section -->

<!-- Comment and reply system starts here -->

<div style="text-align:center; padding-bottom:30px;">
<div class="heading_container heading_center">
   <h1 style="text-decoration: underline;font-size:40px;padding-top:20px;padding-bottom:20px;text-align:center"><b>Comments</b></h1>
  </div>
   <form action="{{url('add_comment')}}" method="POST">
      @csrf
      <textarea style="height:150px;width:600px;" name="comment" placeholder="Comment something here"></textarea>
      <br>
      <input type="submit" class="btn btn-primary" value="Comment">
   </form>
</div>


</div>
<div style="padding-left:20%;">
   <h1 style="font-size:20px;padding-bottom:20px;"><b>All Comments</b></h1>
   <!-- showing all the comments -->
   @foreach($comment as $comment)
   <div>
      <b>{{$comment->name}}</b>
      <p>{{$comment->comment}}</p>
      <!-- javascript::void(0): to avoid reloading the page -->
      <!-- storing the comment id in data-Commentid -->
      <a style="color:blue;" href="javascript:void(0)" onclick="reply(this)" data-Commentid="{{$comment->id}}">Reply</a>
      <div style="padding-left:3%;padding-bottom:10px;">
         @foreach($reply as $rep)
         @if($rep->comment_id==$comment->id)
         <b>{{$rep->name}}</b>
         <p>{{$rep->reply}}</p>
         <a style="color:blue;" href="javascript:void(0)" onclick="reply(this)" data-Commentid="{{$comment->id}}">Reply</a>
         @endif
         @endforeach
      </div>
   </div>
   @endforeach

   <div style="display:none;" class="replyDiv">
      <form action="{{url('add_reply')}}" method="POST">
         @csrf
         <input type="text" id="commentId" name="commentId" hidden="">
         <textarea style="height:100px;width:500px;" placeholder="Write something here" name="reply"></textarea>
         <br>
         <button type="submit" class="btn btn-warning" style="background-color:Orange">Reply</button>
         <a href="javascript:void(0);" class="btn btn-info" onclick="reply_close(this)">Close</a>
      </form>
   </div>
</div>




<!-- Comment and reply system ends here -->
      <!-- subscribe section -->
      @include('home.subscribe');
      <!-- end subscribe section -->
      <!-- client section -->
      @include('home.client');
      <!-- end client section -->
      <!-- footer start -->
      @include('home.footer');
      <!-- footer end -->
     
      
      <script>
         function reply(caller){
            //it will insret the div of reply whenver someone click on reply
document.getElementById('commentId').value=$(caller).attr('data-commentId');
            $('.replyDiv').insertAfter($(caller));
$('.replyDiv').show();

         }
         //if someone click on the close option we're going to close this:it means the div of the reply
         function reply_close(caller){
            //it will insret the div of reply whenver someone click on reply
$('.replyDiv').hide();

         }
      </script>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="js/custom.js"></script>
      <!-- ce code permet de ne pas rafraichir la page a chque fois -->
      <script>
    document.addEventListener("DOMContentLoaded", function (event) {
        var scrollpos = sessionStorage.getItem('scrollpos');
        if (scrollpos) {
            window.scrollTo(0, scrollpos);
            sessionStorage.removeItem('scrollpos');
        }
    });

    window.addEventListener("beforeunload", function (e) {
        sessionStorage.setItem('scrollpos', window.scrollY);
    });
</script>
   </body>
</html>