<?php
    namespace OpenNetworkTools\OpenReport\TCPDF\ExtremeNetworks;

    class DefaultTCPDF extends \TCPDF {

        public function Header() {
            $headerdata = $this->getHeaderData();

            $this->setJPEGQuality(75);
            $this->Image('./scripts/ressources/2023-extremenetworks-icon.png', 190,7, 10, 10, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);

            $this->setFont("helvetica", "B", 12);
            $this->writeHTML('<span style="color: #472E8D;">'.$headerdata['title'].'</span>', true, false, true, false, '');
            $this->setFont("helvetica", "B", 10);
            $this->writeHTML('<span style="color: #472E8D;">'.$headerdata['string'].'</span>', true, false, true, false, '');
            $this->setLineStyle(array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' => 0, 'color' => '#000000'));
            $this->Cell(0, 0, '', 'T', 0, 'C');
        }

        public function Footer() {
            parent::Footer();
        }

    }