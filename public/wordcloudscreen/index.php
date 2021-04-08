<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>wordcloud2.js - tag cloud/Wordle presentation on 2D canvas or HTML</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <!-- Le styles -->
  <!--<link href="//netdna.bootstrapcdn.com/bootstrap/2.2.2/css/bootstrap.min.css" rel="stylesheet">-->
  <!--<link href="//netdna.bootstrapcdn.com/bootstrap/2.2.2/css/bootstrap-responsive.min.css" rel="stylesheet">-->
  <link href="//fonts.googleapis.com/css?family=Finger+Paint" id="link-webfont" rel="stylesheet">

  <link href="main.css" rel="stylesheet">

  <script defer src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script defer src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/2.2.2/bootstrap.min.js"></script>
  <script defer src="./src/wordcloud2.js"></script>
  <script defer src="./index.js"></script>

  <style>


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

  #box {
    pointer-events: none;
    position: absolute;
    box-shadow: 0 0 200px 200px rgba(255, 255, 255, 0.5);
    border-radius: 50px;
    cursor: pointer;
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
  <script type="text/javascript">
    if (window.location.hostname === 'timdream.org') {
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-4623408-2']);
      _gaq.push(['_trackPageview']);
    }

    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();

  </script>
</head>
<body>

<div class="span12" id="canvas-container">
  <canvas id="canvas" class="canvas"></canvas>
  <div id="html-canvas" class="canvas hide"></div>
</div>

  <div class="container" style="display: none" >

    <form id="form" method="get" action="">
      <div class="row">

        <div class="span6">
          <button class="btn btn-primary" type="submit">Run</button>
          <div class="btn-group">
            <button class="btn" type="button" id="btn-canvas" disabled title="Show drawn canvas element.">Canvas</button>
            <button class="btn" type="button" id="btn-html-canvas" title="Show Word Cloud with elements.">Elements</button>
          </div>
          <a class="btn" id="btn-save" href="#" download="wordcloud.png" title="Save canvas">Save Image</a>
          <span id="loading" hidden>......</span>
        </div>
        <div class="span6">
          <select id="examples" class="">
            <option selected>Examples</option>
            <option value="love">Love of the world</option>
            <option value="web-tech">Web Technologies</option>
            <option value="quick-fox">The quick brown fox</option>
            <option value="les-miz">Les Misérables</option>
            <option value="red-chamber" lang="zh-tw">紅樓夢</option>
            <option value="taiwan">Taiwan</option>
          </select>
        </div>
      </div>
      <div class="tabbable">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab-list" data-toggle="tab">List</a></li>
          <li><a href="#tab-config" data-toggle="tab">Configuration</a></li>
          <li><a href="#tab-dim" data-toggle="tab">Dimension</a></li>
          <li><a href="#tab-mask" data-toggle="tab">Mask image</a></li>
          <li><a href="#tab-webfont" data-toggle="tab">Web Font</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="tab-list">
            <textarea id="input-list" placeholder="Put your list here." rows="2" cols="30" class="span12"></textarea>
          </div>
          <div class="tab-pane" id="tab-config">
            <label>Options as a literal Javascript object</label>
            <textarea id="config-option" placeholder="Put your literal option object here." rows="2" cols="30" class="span12"></textarea>
            <!--
            XXX Security consideration:
              Do not implement a feature that allow users to submit/share their script here
              directly or indirectly. Doing so would invite XSS attack on your site.
            -->
            <span class="help-block">See <a href="https://github.com/timdream/wordcloud2.js/blob/gh-pages/API.md">API</a> document for available options.</span>
          </div>
          <div class="tab-pane" id="tab-dim">
            <label for="config-width">Width</label>
            <div class="input-append">
              <input type="number" id="config-width" class="input-small" min="1">
              <span class="add-on">px</span>
            </div>
            <span class="help-block">Leave blank to use page width.</span>
            <label for="config-height">Height</label>
            <div class="input-append">
              <input type="number" id="config-height" class="input-small" min="1">
              <span class="add-on">px</span>
            </div>
            <span class="help-block">Leave blank to use 0.65x of the width.</span>
            <label for="config-height">Device pixel density (<span title="Dots per 'px' unit">dppx</span>)</label>
            <div class="input-append">
              <input type="number" id="config-dppx" class="input-mini" min="1" value="1" required>
              <span class="add-on">x</span>
            </div>
            <span class="help-block">Adjust the weight, grid size, and canvas pixel size for high pixel density displays.</span>
          </div>
          <div class="tab-pane" id="tab-mask">
            <label for="config-mask">Image mask</label>
            <input type="file" id="config-mask"><button id="config-mask-clear" class="btn" type="button">Clear</button>
            <span class="help-block">A silhouette image which the white area will be excluded from drawing texts. The <code>shape</code> option will continue to apply as the shape of the cloud to grow.</span>
            <span class="help-block">When there is an image set, <code>clearCanvas</code> will be set to <code>false</code>.</span>
          </div>
          <div class="tab-pane" id="tab-webfont">
            <label for="config-css">Extra Web Font CSS</label>
            <input type="url" id="config-css" size="40" class="input-xxlarge" placeholder="https://fonts.googleapis.com/css?family=Libre+Baskerville:700" value="https://fonts.googleapis.com/css?family=Finger+Paint">
            <span class="help-block">Find your favorite font on <a href="https://www.google.com/webfonts">Google Web Fonts</a>. Re-run if the font didn't load in time.</span>
         </div>
        </div>
      </div>
    </form>
  </div>
</body>
</html>
