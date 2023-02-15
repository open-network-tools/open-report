<?php
    namespace OpenNetworkTools\OpenReport;

    class Toolbox {

        static function filesize($bytes, $decimals = 2){
            $sz = 'BKMGTP';
            $factor = floor((strlen($bytes) - 1) / 3);
            return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
        }

    }