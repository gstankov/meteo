<?php
    
    // Headers
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
    header("Pragma: no-cache"); // HTTP 1.0.
    header("Expires: 0"); // Proxies.

    // Just headers
    stream_context_set_default(
        array(
            'http' => array(
                'method' => 'HEAD'
            )
        )
    );
    
    // Link collection
    $links = [
        0 => "http://api.sat24.com/",
        1 => "http://vrijeme.hr/kompozit-anim.gif",
        2 => "http://api.sat24.com/animated/EU/visual/1/Central%20European%20Standard%20Time/3118322",
        3 => "https://images.lightningmaps.org/blitzortung/europe/index.php?animation=5",
        4 => "https://icons.wxug.com/data/640x480/2xeu_st_anim.gif",
    ];
    
    // From now on...
    $sources = [];
    
    foreach ($links as $src) {
        
        if ($info = get_headers($src, 1)) {
            
            $sources[] = [
                "link" => $src,
                "info" => $info
            ];
            
        } else {
            
            $errors[$src];
            
        }

    }
    
    /*
    echo "<pre>";
    print_r($sources);
    echo "</pre>";
    
    // Display errors
    if (isset($errors)) {
        echo "<pre>";
        print_r($errors);
        echo "</pre>";
    }
    
    exit();
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
                color: #F00;
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
        <link rel="apple-touch-icon" href="favicon.png" />
    </head>
    <body>

        <?php
            
            $out = '';
            $total = 0;
            
            foreach ($sources as $src) {
                
                $out.= '<div class="info">';
                    $out.= '<img src="'.$src['link'].'" /></br></br>';
                    $out.= $src['info']['Last-Modified'] . ", ";
                    if (isset($src['info']['Content-Length'])) $out.= round($src['info']['Content-Length'] / (1024 * 1024), 2) . ' mb';
                $out.= '</div></br>';
                
                if (isset($src['info']['Content-Length'])) $total = $total + $src['info']['Content-Length'];
                
            }
            
            $out.= '<div class="info">Total: ';
                $out.= round($total / (1024 * 1024), 2) . ' mb';
            $out.= '</div>';
            
            echo $out;
            
        ?>
        
    </body>
</html>