<?php

  if ($file = $_GET['file']) {

    $ext  = explode('.', $file);
    $code = file_get_contents($file);

    switch (strtolower(end($ext))) {
        case 'css':
            $mode = 'css';
            break;

        case 'diff':
            $mode = 'diff';
            break;

        case 'go':
            $mode = 'go';
            break;

        case 'html':
            $mode = 'htmlmixed';
            break;

        case 'less':
            $mode = 'less';
            break;

        case 'java':
            $mode = 'java';
            break;

        case 'json':
        case 'js':
            $mode = 'javascript';
            break;

        case 'md':
            $mode = 'markdown';
            break;

        case 'phps':
        case 'php':
            $mode = 'htmlmixed';
            break;

        case 'pyc':
        case 'py':
            $mode = 'python';
            break;

        case 'rb':
            $mode = 'ruby';
            break;

        case 'scss':
            $mode = 'sass';
            break;

        case 'sql':
            $mode = 'sql';
            break;

        case 'xml':
            $mode = 'xml';
            break;

        default:
            $mode = 'htmlmixed';
    }
  }

?><!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./lib/codemirror.css">
    <script src="./lib/codemirror.js"></script>
    <script src="./addon/hint/show-hint.js"></script>
    <link rel="stylesheet" href="./addon/hint/show-hint.css">
    <script src="./addon/edit/closetag.js"></script>
    <script src="./addon/hint/html-hint.js"></script>
    <script src="./mode/xml/xml.js"></script>
    <script src="./mode/javascript/javascript.js"></script>
    <script src="./mode/css/css.js"></script>
    <script src="./mode/<?= $mode; ?>/<?= $mode; ?>.js"></script>
    <style>
    body, html {
      height  : 100%;
      margin  : 0;
      overflow: hidden;
      padding : 0;
      width   : 100%;
    }
    .CodeMirror {
      left    : 0;
      height  : 100%;
      position: fixed;
      top     : 0;
      width   : 100%;
    }
    </style>
  </head>
  <body>
    <form>
      <textarea id="code" name="code"><?= $code; ?></textarea>
    </form>
    <script type="text/javascript">
      var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
        mode       : '<?= $mode; ?>',
        linenumbers: true,
        smartIndent: true
      });
    </script>
  </body>
</html>