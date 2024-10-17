<?php
$url_host = $_SERVER['HTTP_HOST'];

$pattern_document_root = addcslashes(realpath($_SERVER['DOCUMENT_ROOT']), '\\');

$pattern_uri = '/' . $pattern_document_root . '(.*)$/';

preg_match_all($pattern_uri, __DIR__, $matches);

$url_path = $url_host . $matches[1][0];

$url_path = str_replace('\\', '/', $url_path);
?>


<div class="type-3058">
    <div class="container">
        <div class="faq-section">
        
            <div class="faq">
                <h1>FAQ</h1>
                <details open>
                    <summary class="tb-faq font-faq"> + Duis ac massa vehicula, cursus nibh id?</summary>
                    <p class="tb-faq">Pellentesque dignissim elit nec sagittis dignissim. Curabitur at massa pulvinar, ornare enim volutpat, ultricies augue. Nam rutrum mi non elit bibendum faucibus. Quisque sem massa, semper aliquet ligula non, venenatis semper lectus...</p>
                </details>
                <details>
                    <summary class="tb-faq font-faq">+ Praesent rhoncus euismod nisl?</summary>
                    <p class="tb-faq">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam at lacus purus. Maecenas blandit turpis at sem malesuada.</p>
                </details>
                <details>
                    <summary class="tb-faq bt-line font-faq">+ Donec quis luctus erat?</summary>
                    <p class="tb-faq bt-line">Curabitur fringilla diam nec magna semper, vitae imperdiet purus ornare. Cras a justo sed arcu euismod euismod.</p>
                </details>
            </div>


            <div class="form-section">
                <h3>...or ask your question</h3>
                <form class="form-question">
                    <input class="question" type="text" placeholder="Enter your name" required>
                    <input class="question" type="email" placeholder="Enter your email" required>
                    <textarea class="question text-question"  placeholder="Enter your question" required></textarea>
                    <button class="btn-faq" type="submit">ASK</button>
                </form>
            </div>
        </div>
    </div>