<?php 
    $answer = 'Selamat datang di Virtual Assistant Cioccolato Brownie';

    if(isset($_POST['submit']))
    {
        $say = rawurlencode($_POST['say']);
        $json = file_get_contents("http://localhost/CIOVITA/Program-O-master/chatbot/conversation_start.php?bot_id=1&say=".$say."");
        $json_data = json_decode($json); 
        $answer = $json_data->botsay; 
    }
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Ciovita | Cioccolato Brownie</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <style type="text/css">
            .wrapper{
                width: 600px;
                margin: 300;
                position: relative;
                left: 100px;
            }
            .page-header h1{
                margin: 0;
            }
            table tr td:last-child a{
                margin-right: 20px;
            }
            td{
                text-align: center;
            }
            table {
                border-collapse: collapse;
                width: 420px;
                margin-left: 50px;
            }
        </style>
            
        <script type="text/javascript">
            $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
        <script>
            var windowReady = false;
            var voiceReady = false;

            var defaultparams = 
            {
                rate: 1,
                pitch: 1,
                volume: 1,
                text: 'Terima Kasih',
                voice: 'Indonesian Female'
            };

            $(window).load( function() 
            {
                windowReady = true;
                $('#voiceselection').hide();
	            $('#text').show();
                $('#waitingdiv').show();
                responsiveVoice.speak('<?php echo $answer; ?>',$('#voiceselection').val());
                
                responsiveVoice.AddEventListener("OnLoad",function()
                {
                    console.log("ResponsiveVoice Loaded Callback") ;
                });

                CheckLoading();
            });

            responsiveVoice.OnVoiceReady = function() 
            {
                voiceReady = true;
                CheckLoading();
            }

            function CheckLoading() 
            {
                if (voiceReady && windowReady) 
                {
                    $('#voicetestdiv').fadeIn(0.5);
                    $('#waitingdiv').fadeOut(0.5);
                    var voicelist = responsiveVoice.getVoices();
                    var vselect = $("#voiceselection");
                    vselect.html("");
                    $.each(voicelist, function() 
                    {
                        vselect.append($("<option />").val(this.name).text(this.name));
                    });	      
                    $('#voiceselection').val(getUrlParameter('voice') || defaultparams.voice);
                }
            }

            var getUrlParameter = function getUrlParameter(sParam) 
            {
                var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

                for (i = 0; i < sURLVariables.length; i++) 
                {
                    sParameterName = sURLVariables[i].split('=');
                    if(sParameterName[0] === sParam) 
                    {
                        return sParameterName[1] === undefined ? true : sParameterName[1];
                    }
                }
            };

            function getUrlVars()
            {
                var vars = [], hash;
                var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                for(var i = 0; i < hashes.length; i++)
                {
                    hash = hashes[i].split('=');
                    vars.push(hash[0]);
                    vars[hash[0]] = hash[1];
                }
                return vars;
            }

        </script>
        <script>
            function redirectTele() {
            window.open("https://t.me/CiovitaBot")
            }
            function redirectLine() {
            window.open("https://liff.line.me/1645278921-kWRPP32q?accountId=351vaxaf&openerPlatform=native&openerKey=talkroom%3Aheader#mst_challenge=aozBc3K2dXeN8kvHZfWTyD1svxOMB4B0bRgUagPMLw4")
            }
        </script>

    </head>

    <body background="background.jpg">
        <script src="https://code.responsivevoice.org/responsivevoice.js?key=3XSc6fPC"></script>
        <div class="wrapper">
        <div class="container-fluid">
        <div class="row">
        <div class="col-md-20">
        <div class="page-header clearfix">
            <h1 class = "alert text-center"></h1>
        </div>
        <div class="card-body">
        <form method="POST" action='' class="form-group alert">
        <table cellpadding="10">
            
        <div class="mb-3">
            <h5>
            <label>Tanya Ciovita : </label>
            <p></p>
            <input type='text' name='say' autofocus class='form-control'>
            </h5>
        </div>
        <div class="mb-3">
            <input type='submit' value='Kirim' name='submit' class='btn btn-success'> 
        </div>
        <div class="form-group">
            <h5>
            <?php 
                echo $answer; 
            ?>
            </h5>
        </div>
         
        <div class="form-group">
            <div style="display: none;" id="waitingdiv">
                <h6>Sedang memproses...</h6><br>
                <h5>--- Ciovita dapat diakses melalui Line dan Telegram ---</h5><br>
        </div>
        <div class="form-group"> 
        <table>
            
                <td style="text-align:center;">
                    <img src="linee.jpg" width="150" height=auto/>
                    <input type="button" value="Line" class="btn btn-success"  id="btnLine" onClick="redirectLine()"/>
                </td>
                <td style="text-align:center;">
                    <img src="telee.jpg" width="150" height=auto/>
                    <input type="button" value="Telegram" class="btn btn-primary" id="btnTele" onClick="redirectTele()"/>
                </td>
        </table> 
        </div>
        
        </form>
       
            <select id="voiceselection" style="display: none;">
                <option selected="selected" value="Indonesian Female">Indonesian Female</option>
            </select>

            <div style="display: block;" id="counterBox1" class="counterBox">
			
			    <input id="playbutton" value="Panggil" type="hidden">
			
                <input id="stopbutton" value="Berhenti" type="hidden"><br>
            </div>
        </div>
        </div>
    </div>
    </div>
    </div> 
    </body>
</html>