<?php 

require('includes/indexnav.php');
require('includes/database.php');
      

$display = mysqli_query($conn, "SELECT * FROM botsettings ");
$row = $display->fetch_assoc();
$systemname=$row["SystemName"];
$intro=$row['introMessage'];
$avatarbot="image/".$row["botavatar"];
$avataruser="image/".$row["useravatar"];



         
 ?>
<html>
<link rel="stylesheet" type="text/css" href="css/index.css">
<head>
    <title>DocBot</title>
</head>
<body style=" background: #0a678b;">

<div class="col-sm-12 chatbotbox">

        <div class="wrapper">
            <div class="title">Recomended Medicine<?php //echo $systemname ?> </div>
            <div class="form">
                <div class="bot-inbox inbox">
                    <div class="icon">
                        <img src="<?php echo $avatarbot; ?>" class="icon">
                    </div>
                    <div class="msg-header">
                        <p><?php echo $intro; ?></p>
                    </div>
                </div>
            </div>
            <div class="typing-field" style="background:#102134;">
                <div class="input-data">
                    <form id="sendmessage">
                        <input id="data" type="text" placeholder="Type something here.." required>
                        <button id="send-btn">Send</button>
                    </form>
                </div>
            </div>
        </div>

        </div> 

 <script>
        $(document).ready(function(){
            $("#send-btn").on("click", function(){
                $value = $("#data").val();
                $msg = '<div class="user-inbox inbox"><img src="image/user.png" class="icon"><div class="msg-header"><p>'+ $value +'</p></div></div>';
                $(".form").append($msg);
                $("#data").val('');
                
                // start ajax code
                $.ajax({
                    url: 'messagerecommend.php',
                    type: 'POST',
                    data: 'text='+$value,
                    success: function(result){
                        $replay = '<div class="bot-inbox inbox"><div class="icon"><img src="<?php echo $avatarbot; ?>" class="icon"></div><div class="msg-header"><p>'+ result +'</p></div></div>';
                        $(".form").append($replay);
                        // when chat goes down the scroll bar automatically comes to the bottom
                        $(".form").scrollTop($(".form")[0].scrollHeight);
                    }
                });
            });
        });
   </script>

</body>
</html>