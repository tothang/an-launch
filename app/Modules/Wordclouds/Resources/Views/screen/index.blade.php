<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Wordcloud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Le styles -->
    <!--<link href="//netdna.bootstrapcdn.com/bootstrap/2.2.2/css/bootstrap.min.css" rel="stylesheet">-->
    <!--<link href="//netdna.bootstrapcdn.com/bootstrap/2.2.2/css/bootstrap-responsive.min.css" rel="stylesheet">-->
    <link href="//fonts.googleapis.com/css?family=Finger+Paint" id="link-webfont" rel="stylesheet">
    <script defer src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script defer src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>

    <link href="/wordcloudscreen/main.css?v=<?php echo rand(0,9999); ?>" rel="stylesheet">
    <script defer src="/wordcloudscreen/wordcloud.js"></script>
    <script defer src="/wordcloudscreen/index.js?v=<?php echo rand(0,9999); ?>"></script>

    <style>
        .logo {
            position: fixed;
            top: 20px;
            right: 20px;
            display: block;
            z-index: 5000;
        }
        *[hidden] {
            display: none;
        }
        #canvas-container {
            overflow-x: auto;
            overflow-y: visible;
            position: relative;
        }
        .canvas {
            display: block;
            position: relative;
            overflow: hidden;
        }
        .canvas.hide {
            display: none;
        }
        #html-canvas > span {
            transition: text-shadow 1s ease, opacity 1s ease;
            -webkit-transition: text-shadow 1s ease, opacity 1s ease;
            -ms-transition: text-shadow 1s ease, opacity 1s ease;
        }
        #html-canvas > span:hover {
            text-shadow: 0 0 10px, 0 0 10px #fff, 0 0 10px #fff, 0 0 10px #fff;
            opacity: 0.5;
        }
        textarea {
            height: 20em;
        }
        #config-option {
            font-family: monospace;
        }
        select { width: 100%; }

        #loading {
            animation: blink 2s infinite;
            -webkit-animation: blink 2s infinite;
        }
        @-webkit-keyframes blink {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }
        @keyframes blink {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }

    </style>
    <script>
        var sessionIndex = {!! json_encode($wordcloud->id) !!};
        window.Laravel = {!! json_encode([
            'apiToken' => auth()->check() ? auth()->user()->api_token : '',
        ]) !!};
    </script>
</head>
<body>
<div class="logo">
    <img src="{{ asset(EventInfo::clientLogo()) }}" style="height: 50px"/>
</div>
<div class="span12" id="canvas-container">
    <canvas id="canvas" class="canvas"></canvas>
    <div id="html-canvas" class="canvas hide"></div>
</div>

<div class="container" style="display: none" >

    <form id="form" method="get" action="">
        <div class="row">
            <div class="span6">
                <span id="loading" hidden>......</span>
                <textarea id="input-list" placeholder="Put your list here." rows="2" cols="30" class="span12"></textarea>
                <textarea id="config-option" placeholder="Put your literal option object here." rows="2" cols="30" class="span12"></textarea>
                <input type="number" id="config-dppx" class="input-mini" min="1" value="1" required>
            </div>
        </div>
    </form>

</div>
</body>
</html>
