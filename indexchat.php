<?php

$index = $_GET['index'];

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewpoint" content="width=device-width", initial-scale="1.0">
    <meta http-equiv="X-RU-Compatible" content="ie=edge">
    <title>Чат</title>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <style>
        body {
            margin: 0;
            overflow: hidden;
            font-family: "Lucida Sans Unicode";
        }
        #messages {
            height: 88vh;
            overflow-x: hidden;
            padding: 10px;
            background-image: url(background.jpg);
        }
        form {
            display: flex;

        }
        input{
            font-size: 1.2rem;
            padding: 10px;
            margin: 10px 5px;
            appearance: none;
            -webkit-appearance: none;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        #message {
            flex: 2
        }
        .msg {
            background-color: #ffffff ;
            padding: 5px 10px;
            border-radius: 5px;
            margin-bottom: 8px;
            width: fit-content
        }

        .msg p{
            margin: 0;
            font-weight: bold
        }
        .msg span{
            font-size: 0.7rem;
            margin-left: 15px
        }
    </style>

    <script
            src="https://code.jquery.com/jquery-3.6.3.min.js"
            integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
            crossorigin="anonymous">

    </script>
    <script>
        var from = null; start = 0; url = 'http://localhost/lab3canals/foochat.php';
        $(document).ready(function (){
            from = prompt("Please enter your name");
            load();
            $('form').submit(function (e) {
                $.post(url, {
                    message: $('#message').val(),
                    sender: from,
                    i: '<?php echo $index; ?>'
                });
                $('#message').val('');
                return false;
            })
        });

        function load() {
            let tid = setInterval(() => {
                $.get('foochat.php?start=' + start + '&i=<?php echo $index; ?>', function(result) {
                    if(result.items){
                        result.items.forEach(item => {
                            start = item.id;
                            document.querySelector('#messages').innerHTML +=
                                ('<div class="msg"><p>'+item.sender+'</p>'+item.message);
                        })

                    };
                });
            }, 500);

        }

        function renderMessage(item){
            let time = new Date(item.created);
            time = `${time.getHours()}:${time.getMinutes() < 10 ? '0' : ''}${time.getMinutes()}`;
            return `<div class="msg"><p>${item.sender}</p>${item.message}<span>${time}</span></div>`;
        }
    </script>

</head>
<div id="messages"></div>
<form>
    <input type="text" id="message" autocomplete="off" autofocus placeholder="Наберите сообщение...">
    <input type="submit" value="Отправить">
</form>
</html>