<?php
    namespace OpenNetworkTools\Template;

    use OpenNetworkTools\Node\Toolbox;
    use OpenNetworkTools\OpenNode\Reader;
    use OpenNetworkTools\OpenReport;

    class ExtremeNetworksFilesAnalyseListTemplate {

        private $openReport;

        public function __construct(OpenReport $openReport){
            $this->openReport = $openReport;
            $this->openReport->getPDF()->AddPage();
            $this->openReport->getPDF()->Bookmark('Files analyse list', 0, 0, '', 'B', array(0,64,128));
            $this->openReport->getPDF()->Cell(0, 10, 'Files analyse list', 0, 1, 'L');

            $this->openReport->getPDF()->setFont('helvetica', '', 8);
            $tbl = '<table border="1" cellpadding="1" cellspacing="0">';
            $tbl .= '<tr>';
            $tbl .= '<th style="width: 50%">Filename</th>';
            $tbl .= '<th style="text-align:center; width: 15%">Lines</th>';
            $tbl .= '<th style="text-align:center; width: 35%">Templates</th>';
            $tbl .= '</tr>';
            foreach ($this->openReport->getVariable('AUDIT_FILE_DIRECTORY') as $file){
                $reader = new Reader();
                $reader->loadConfigFile("./scripts/configs/".$file);
                if(Toolbox::determineModel($reader->getConfigFile()) == "none"){
                    $tbl .= '<tr style="background-color: #f8d7da"><td colspan="3">'.$file.'</td></tr>';
                } else {
                    $tbl .= '<tr style="background-color: #d4edda"><td colspan="3">'.$file.'</td></tr>';
                }
            }
            $tbl .= '</table>';
            $this->openReport->getPDF()->writeHTML($tbl);
        }

    }