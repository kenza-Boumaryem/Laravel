<?php
    $productData = array(); 

    foreach ($data as $item) {
        $productData[] = "Product Title: " . $item->product_title . "\n" .
                        "Product Quantity: " . $item->quantity . "\n" .
                        "Product Price: " . $item->price;
    }

    // Générer le code QR avec tous les product_title
    $qrCodeText = implode("\n\n", $productData);
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <style>
       
        /* body {
           
            font-family: Arial, sans-serif;
        } */
       
        .Title {
          
            justify-content: center;
            align-items: center;
            padding-left:360px;
            text-decoration:underline;
            color:blue;
           
        }
        
        /* .qr-code-table {
            border-collapse: collapse;
          
            text-align: center;
        }
        
        .qr-code-table th {
           
            background-color: #f2f2f2;
        }
        
        .qr-code-table td {
            padding: 20px;
        }
        
        .qr-code-table h1 {
            color: blue;
        }   */
        .QRcODE {
  width: 100px;
  height: 50px;
  padding-left:460px;
  padding-top:60px;
} 
    </style>
</head>
<body>
<div class="qr-container">
    <table class="qr-code-table">
        <tr>
            <th colspan="2" class="Title">
                <h1>Scan this QR code to get your order's information:</h1>
            </th>
        </tr>
        <tr>
            <td colspan="2" class="QRcODE">
               
                <?php echo DNS2D::getBarcodeHtml($qrCodeText, 'QRCODE');  ?>
                
               
            </td>
        </tr>
    </table>   

    
   

<!-- <div class="qr-container">
<table >
    <th><h1 style="color:blue"> Scan this QR code to get your order's infromations:</h1></th>
    <tr >
        <td >
            {!! DNS2D::getBarcodeHtml($qrCodeText,'QRCODE') !!}
        </td>
    </tr>
</table>
</div> -->


</div>
</body>
</html>

