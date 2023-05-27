<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home/css/Contact.css">
    <title>Contact us</title>
</head>
<body>
    <!-- section -->
    <section>
        <!-- contact container -->
        <div class="contact-container">
            <!-- from -->
       <div class="form-container">
        <h3>Message us</h3>
        <form action="{{url('/contact_util')}}" method="POST" class="contact-form" >
        @csrf
<input type="text" placeholder="Your name" required name="Nom">
<input type="email" name="Email" id="" placeholder="Enter Your Email ..."required>
<textarea name="Message" id="" cols="30" rows="10" placeholder="write a Message here..." required></textarea>
<input  type="submit" value="Send" class="send-button">
        </form>
       </div>

    <div class="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d108702.95890996487!2d-8.09025520186021!3d31.63474115112498!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sma!4v1683649821572!5m2!1sfr!2sma"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>


        </div>
    </section>
    
</body>
</html>