<?php
        $filename = "/home/eric_tu/eric_tu/tmp.txt";~
        $file = fopen( $filename, "w" );~
        $hi = "hihihi";~
        fwrite( $file, $content . "hilight");~
        fclose( $file );