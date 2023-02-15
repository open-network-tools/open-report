<?php
    namespace OpenNetworkTools\Template;

    use OpenNetworkTools\OpenReport;

    class ExtremeNetworksCoverTemplate {

        private $openReport;

        public function __construct(OpenReport $openReport) {
            $this->openReport = $openReport;

            $this->getPDF()->setPrintHeader(false);
            $this->getPDF()->setPrintFooter(false);

            $this->getPDF()->AddPage();

            $this->getPDF()->setJPEGQuality(75);
            $this->getPDF()->Image('./ressources/2023-extremenetworks-logo.png', 15,20, 60, 15, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

            if($this->openReport->getVariable('PDF_CUSTOMER_LOGO')){
                $this->getPDF()->Image($this->openReport->getVariable('PDF_CUSTOMER_LOGO'), 65,170, 80, 40, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
            }

            $this->getPDF()->Ln(120);
            $this->getPDF()->setFont("helvetica", "B", 20);
            $this->getPDF()->writeHTML('<span style="color: #472E8D;">'.$this->openReport->getVariable("PDF_TITLE").'</span>', true, false, true, false, '');
            $this->getPDF()->setFont("helvetica", "B", 14);
            $this->getPDF()->writeHTML('<span style="color: #472E8D;">'.$this->openReport->getVariable("PDF_SUBTITLE").'</span>', true, false, true, false, '');

            $this->getPDF()->Ln(100);
            $this->getPDF()->setFont("helvetica", "", 8);
            $this->getPDF()->writeHTML('<span style="color: #472E8D;">Published : </span>'.$this->openReport->getVariable("PDF_PUBLISH"), true, false, true, false, '');
            $this->getPDF()->writeHTML('<span style="color: #472E8D;">Author : </span>'.$this->openReport->getVariable("PDF_AUTHOR"), true, false, true, false, '');
            $this->getPDF()->writeHTML('<span style="color: #472E8D;">Version : </span>'.$this->openReport->getVariable("PDF_VERSION"), true, false, true, false, '');

            $this->getPDF()->setPrintHeader(true);
            $this->getPDF()->setPrintFooter(true);
        }

        private function getPDF(){
            return $this->openReport->getPDF();
        }

    }