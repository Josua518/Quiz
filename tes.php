<?php if(isset($_GET['image'])):
    $image = $_GET['image'];

    if(preg_match('#^data:image/(.*);base64,(.*)$#s', $image, $match)){
        $base64 = $match[2];
        $imageBody = base64_decode($base64);
        $imageFormat = $match[1];

        header('Content-type: application/octet-stream');
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false); // required for certain browsers
        header("Content-Disposition: attachment; filename=\"file.".$imageFormat."\";" ); //png is default for toDataURL
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".strlen($imageBody));
        echo $imageBody;
    }
    exit();
endif;?>

<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js?ver=1.7.2'></script>
<canvas id="canvas" width="300" height="150"></canvas>
<button id="btn">Save</button>
<script>
    $(document).ready(function(){
        var canvas = document.getElementById('canvas');
        var oCtx = canvas.getContext("2d");
        oCtx.beginPath();
        oCtx.moveTo(0,0);
        oCtx.lineTo(300,150);
        oCtx.stroke();

        $('#btn').on('click', function(){
            // opens dialog but location doesnt change due to SaveAs Dialog
            document.location.href = '/script.php?image=' + canvas.toDataURL();
        });
    });