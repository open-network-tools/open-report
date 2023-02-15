<?php

namespace OpenNetworkTools\OpenReport\Templates\ExtremeNetworks;

use OpenNetworkTools\OpenReport;

class DefaultReport extends OpenReport {

    public function __construct() {
        $this->setPDF(new OpenReport\TCPDF\ExtremeNetworks\DefaultTCPDF('P', 'mm', 'A4', true, 'UTF-8', false));
    }

}