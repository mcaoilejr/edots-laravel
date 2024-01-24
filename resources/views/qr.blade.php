<!DOCTYPE html>
<html lang="en">
 
<head>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>QR Code</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      </head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js">
    </script>
</head>
 
<body>
  <div>
      
    <div class="row">
        <div class="col-md-12 text-center">  
            <img src="{{asset('public/images/upper.png')}}"  />
        </div>
    </div>

    <div class="row px-5">
        <div class="col-md-12">
            <table width="100%">
                <tr>
                    <td width="100" style="align:center;">
                        <div id="qrcode"></div>
                    </td>
                    <td style="vertical-align: top;" class="px-4">
                        <h4>{{$title}}</h4>
                        <p>Date Encoded: {{$date}}</p>
                        <p>Document Type: {{$type}}</p>
                    </td>
                    <td style="vertical-align: top;">
                        Date: {{Carbon\Carbon::now()->format('M d, Y')}}
                    </td>
                </tr>

            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text-center" >  
            <img  src="{{asset('public/images/lower.png')}}"  />
        </div>
    </div>
  </div>


    <script>
        var qrcode = new QRCode("qrcode", {
            text: <?= json_encode($link, JSON_UNESCAPED_UNICODE); ?>,
            width: 150,
            height: 150,
            colorDark : "#000000",
            colorLight : "#ffffff",
            correctLevel : QRCode.CorrectLevel.H
        });
    </script>
</body>
 
</html>