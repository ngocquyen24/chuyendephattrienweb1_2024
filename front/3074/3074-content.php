<?php
$url_host = $_SERVER['HTTP_HOST'];

$pattern_document_root = addcslashes(realpath($_SERVER['DOCUMENT_ROOT']), '\\');

$pattern_uri = '/' . $pattern_document_root . '(.*)$/';

preg_match_all($pattern_uri, __DIR__, $matches);

$url_path = $url_host . $matches[1][0];

$url_path = str_replace('\\', '/', $url_path);
?>


<div class="type-3074">
    <div class="container">
        <div class="main1">
            <h1>Get Your Repair Started</h1>
            <p class="content1">Exlore new ways to see what's working and fix what's nit. Vivamus sed finibus nulla. Suspendisse ac ex sed sem <br>
                consequat pellentesque ain nulla.</p>
        </div>
        <div class="main2">
            <div class="row">
                <div class="col-lg-4 ">
                    <div class="image-inner">
                        <div class="service-img">
                            <img src="./image/service-pc-mac.jpg" alt="">
                        </div>
                        <div class="service-text">
                            <a class="title-img" href="">PC & MAC Computers</a>
                            <p class="content2">Fusce eu odio ac neque interdum <br> volutpat. Sed vel pharetra quam.</p>
                            <a class="read-more" href="">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ">
                    <div class="image-inner">
                        <div class="service-img">
                            <img src="./image/service-laptop.jpg" alt="">
                        </div>
                        <div class="service-text">
                            <a class="title-img" href="">Laptop Macbook Repair</a>
                            <p class="content2">Fusce eu odio ac neque interdum <br> volutpat. Sed vel pharetra quam.</p>
                            <a class="read-more" href="">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 ">
                    <div class="image-inner">
                        <div class="service-img">
                            <img src="./image/service-phone.jpg" alt="">
                        </div>
                        <div class="service-text">
                            <a class="title-img" href="">Smartphone Repair</a>
                            <p class="content2">Fusce eu odio ac neque interdum <br> volutpat. Sed vel pharetra quam.</p>
                            <a class="read-more" href="">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>