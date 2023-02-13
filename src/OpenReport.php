<?php
    namespace OpenNetworkTools;

    class OpenReport {

        private $openNode;
        private $pdf;
        private $variables = [];

        public function __construct(){
            $this->pdf = new \TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        }

        public function getOpenNode(){
            return $this->openNode;
        }

        public function setOpenNode($openNode){
            $this->openNode = $openNode;
            return $this;
        }

        public function getPDF(){
            return $this->pdf;
        }

        public function getTemplate($name){
            $cname = "OpenNetworkTools\\Template\\".$name;
            new $cname($this);
            return $this;
        }

        public function addVariable($key, $value){
            $this->variables[$key] = $value;
            return $this;
        }

        public function getVariable($key){
            if(array_key_exists($key, $this->variables)) return $this->variables[$key];
            else throw new \Exception("Key does exists [".$key."]");
        }

        public function initPDF(){
            $this->pdf->setCreator($this->getVariable("PDF_AUTHOR"));
            $this->pdf->setAuthor($this->getVariable("PDF_AUTHOR"));
            $this->pdf->setTitle($this->getVariable("PDF_TITLE"));
        }

        public function addTOC(){
            $this->pdf->addTOCPage();
            $this->pdf->setFont("times", "B", 16);
            $this->pdf->MultiCell(0, 0, 'Table Of Content', 0, 'C', 0, 1, '', '', true, 0);
            $this->pdf->Ln();
            $this->pdf->setFont("helvetica", "", 10);

            $bookmark_templates = [];
            $bookmark_templates[0] = '<table border="0" cellpadding="0" cellspacing="0" style="background-color:#EEFAFF"><tr><td width="155mm"><span style="font-family:times;font-weight:bold;font-size:12pt;color:black;">#TOC_DESCRIPTION#</span></td><td width="25mm"><span style="font-family:courier;font-weight:bold;font-size:12pt;color:black;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
            $bookmark_templates[1] = '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="5mm">&nbsp;</td><td width="150mm"><span style="font-family:times;font-size:11pt;color:green;">#TOC_DESCRIPTION#</span></td><td width="25mm"><span style="font-family:courier;font-weight:bold;font-size:11pt;color:green;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';
            $bookmark_templates[2] = '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="10mm">&nbsp;</td><td width="145mm"><span style="font-family:times;font-size:10pt;color:#666666;"><i>#TOC_DESCRIPTION#</i></span></td><td width="25mm"><span style="font-family:courier;font-weight:bold;font-size:10pt;color:#666666;" align="right">#TOC_PAGE_NUMBER#</span></td></tr></table>';

            $this->pdf->addHTMLTOC(1, 'INDEX', $bookmark_templates, true, 'B', array(128,0,0));

            $this->pdf->endTOCPage();
        }

    }