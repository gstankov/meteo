<?php
    
    // Link collection
    $links = [
        0 => "http://api.sat24.com/",
        1 => "http://vrijeme.hr/irc-anim.gif",
        2 => "http://vrijeme.hr/kradar-anim.gif",
        3 => "http://api.sat24.com/animated/EU/visual/1/Central%20European%20Standard%20Time/3118322",
        4 => "https://images.lightningmaps.org/blitzortung/europe/index.php?animation=5",
        5 => "https://icons.wxug.com/data/640x480/2xeu_st_anim.gif",
    ];
    
    // From now on...
    $sources = [];
    
    foreach ($links as $src) {
        
        $sources[] = [
            "link" => $src,
            "info" => get_headers($src, 1)
        ];

    }
    
    /*
    echo "<pre>";
    print_r($sources);
    echo "</pre>";
    */
    
?>
<html>
    <head>
        <title>Meteo</title>
        <style type="text/css">
        
            body {
                padding: 0px; margin: 0px;
                background: #000;
                width: 100%; text-align: center;
                font-family: arial;
            }
            body img {
                width: 632px;
            }
            .info {
                display: inline-block;
                width: 632px;
                color: green;
                font-size: 10px;
                border: 1px solid green;
                padding: 5px; margin: 2px;
            }
        </style>
        <link rel="shortcut icon" type="image/png" href="favicon.png" />
    </head>
    <body>

        <?php
            
            $out = '';
            $size = 0;
            
            foreach ($sources as $src) {
                
                $out.= '<div class="info">';
                    $out.= '<img src="'.$src['link'].'" /></br></br>';
                    $out.= $src['info']['Last-Modified'] . ", ";
                    $out.= round($src['info']['Content-Length'] / (1024 * 1024), 2) . ' mb';
                $out.= '</div></br>';
                
                $size = $size + $src['info']['Content-Length'];
                
            }
            
            $out.= '<div class="info">Total: ';
                $out.= round($size / (1024 * 1024), 2) . ' mb';
            $out.= '</div>';
            
            echo $out;
            
        ?>
        
    </body>
</html>

