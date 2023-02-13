<?php

namespace OpenNetworkTools\Template;

use OpenNetworkTools\OpenReport;

class DefaultHeaderTemplate {

    private $openReport;

    public function __construct(OpenReport $openReport){
        $this->openReport = $openReport;
        $this->openReport->getPDF()->setHeaderData("", 0, $this->openReport->getVariable("PDF_TITLE"), $this->openReport->getVariable("PDF_AUTHOR"), array(0,64,255), array(0,64,128));
        $this->openReport->getPDF()->setHeaderFont(array('helvetica', '', 10));
        $this->openReport->getPDF()->setFooterData(array(0,64,0), array(0,64,128));
        $this->openReport->getPDF()->setFooterFont(array('helvetica', '', 10));

        $this->openReport->getPDF()->setDefaultMonospacedFont('courier');
        $this->openReport->getPDF()->setMargins(10, 20, 10);
        $this->openReport->getPDF()->setHeaderMargin(8);
        $this->openReport->getPDF()->setFooterMargin(8);
        $this->openReport->getPDF()->setAutoPageBreak(TRUE, 0);
    }

}