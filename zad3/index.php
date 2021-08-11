<?php
require_once 'Onet.php';

$onet = new Onet();
$news = $onet->getList();

foreach ($news as $item){
    echo <<<EOT
<p>
    <a href="{$item['url']}">
        {$item['title']}<br>
        <img src="{$item['img']}">
    </a>
</p>
<br>
EOT;
}
