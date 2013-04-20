
<?php

    // Scripts _____________________________________________________________

    $script  = '';
    $scripts = array(
        'script/zepto.min.js',
        'script/moment.min.js',
        'script/main.js'
    );

    foreach ($scripts as $file) {
        $script .= file_get_contents($file);
    }


    // Styles _____________________________________________________________

    $style  = '';
    $styles = array(
        'style/icons.css',
        'style/main.css'
    );

    foreach ($styles as $file) {
        $style .= file_get_contents($file);
    }


    // Index _____________________________________________________________

    $uri = urldecode($_SERVER['REQUEST_URI']);
    $uri = preg_replace("/\/ *$/", "", $uri);
    $uri = preg_replace("/\?.*$/", "", $uri);

?><!DOCTYPE html>
<html>
    <head>
        <title>Index of <?= $uri ?></title>
        <style type="text/css"><?= $style; ?></style>
        <script type="text/javascript"><?= $script; ?></script>
    </head>
    <body class="tab-directory">
        <!-- Left Nav -->
        <nav class="options tabs">
            <a href="#" title="Files" class="directory" data-tab="directory"><span aria-hidden="true" class="icon-list"></span></a>
            <a href="#" title="Search" class="search" data-tab="search"><span aria-hidden="true" class="icon-search"></span></a>
            <a href="#" title="Code" class="code" data-tab="code"><span aria-hidden="true" class="icon-newspaper"></span></a>
        </nav>

        <!-- Search Window -->
        <div class="search tab-content" id="tab-search">
            <form action="/.index/api/search.php" class="frmSearch">
                <input type="text" name="txtQuery" placeholder="Search">
                <button><span aria-hidden="true" class="icon-search"></span></button>

                <p class="note"><b>WARNING:</b> Executes a `find -name "xxx"` command. You can use *, etc.</p>
            </form>
            <hr>
            <h2>Results</h2>
            <ul class="search-results"></ul>
        </div>


        <!-- Code Window -->
        <div class="code tab-content" id="tab-code"></div>


        <!-- Directory Window -->
