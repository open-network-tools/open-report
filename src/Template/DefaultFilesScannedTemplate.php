<?php
    namespace OpenNetworkTools\Template;

    use OpenNetworkTools\Node\Toolbox;
    use OpenNetworkTools\OpenNode\Reader;
    use OpenNetworkTools\OpenReport;

    class DefaultFilesScannedTemplate {

        private $openReport;

        public function __construct(OpenReport $openReport) {
            $this->openReport = $openReport;

            $this->getPDF()->AddPage();
            $this->getPDF()->Bookmark("Files scanned", 0, 0);
            $this->getPDF()->setFont('helvetica', 'B', 16);
            $this->getPDF()->writeHTML('<span style="color: #472E8D">Files scanned</span>', true, false, true, false, '');
            $this->getPDF()->Ln(0.75);
            $this->getPDF()->setFont('helvetica', '', 10);
            $this->getPDF()->writeHTML("As part of the audit that is being carried out, here are all the files that have been analyzed by the script, the red ones certainly point to errors in the file source which does not allow the identification of the equipment model for the analysis.", true, false, true, false, 'J');
            $this->getPDF()->Ln(1.5);

            $this->getPDF()->setFont('helvetica', '', 8);
            $tbl = '<table border="0.75" cellpadding="1" cellspacing="0">';
            $tbl .= '<tr>';
            $tbl .= '<th style="width: 50%"><span style="font-weight: bold;">Filename</span></th>';
            $tbl .= '<th style="text-align:center; width: 10%"><span style="font-weight: bold;">Lines</span></th>';
            $tbl .= '<th style="text-align:center; width: 10%"><span style="font-weight: bold;">Size</span></th>';
            $tbl .= '<th style="text-align:center; width: 30%"><span style="font-weight: bold;">Templates</span></th>';
            $tbl .= '</tr>';

            foreach ($this->openReport->getVariable('AUDIT_FILE_DIRECTORY') as $file){
                $reader = new Reader();
                $reader->loadConfigFile("./scripts/configs/".$file);
                $model = Toolbox::determineModel($reader->getConfigFile());
                if($model == "none"){
                    $tbl .= '<tr style="background-color: #f8d7da">';
                } else {
                    $tbl .= '<tr style="background-color: #d4edda">';
                }
                $tbl .= '<td>'.$file.'</td>';
                $tbl .= '<td style="text-align: center;">'.sizeof($reader->getConfigFile()).'</td>';
                $tbl .= '<td style="text-align: center;">'.OpenReport\Toolbox::filesize(filesize("./scripts/configs/".$file)).'</td>';
                $tbl .= '<td style="text-align: center;">'.$model.'</td>';
                $tbl .= '</tr>';
            }

            $tbl .= '</table>';

            $this->getPDF()->writeHTML($tbl);
        }

        private function getPDF(){
            return $this->openReport->getPDF();
        }

    }