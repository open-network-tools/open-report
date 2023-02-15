<?php
    namespace OpenNetworkTools\Template;

    use OpenNetworkTools\Node\Toolbox;
    use OpenNetworkTools\OpenNode\Reader;
    use OpenNetworkTools\OpenReport;

    class ExtremeNetworksAssetTemplate {

        private $openReport;

        public function __construct(OpenReport $openReport) {
            $this->openReport = $openReport;

            $this->getPDF()->AddPage();
            $this->getPDF()->Bookmark("All assets", 0, 0);
            $this->getPDF()->setFont('helvetica', 'B', 16);
            $this->getPDF()->writeHTML('<span style="color: #472E8D">All assets</span>', true, false, true, false, '');
            $this->getPDF()->Ln(0.75);
            $this->getPDF()->setFont('helvetica', '', 10);
            $this->getPDF()->writeHTML("This chapter groups together all the network assets that were analyzed as part of the audit by the script.", true, false, true, false, 'J');
            $this->getPDF()->Ln(1.5);

            $this->getPDF()->setFont('helvetica', '', 8);
            $tbl = '<table border="0.75" cellpadding="1" cellspacing="0">';
            $tbl .= '<tr style="background-color: #472E8D;">';
            $tbl .= '<th style="width: 15%"><span style="color: #FFFFFF; font-weight: bold;">IP Address</span></th>';
            $tbl .= '<th style="text-align:center; width: 5%"><span style="color: #FFFFFF; font-weight: bold;">Unit #</span></th>';
            $tbl .= '<th style="text-align:center; width: 20%"><span style="color: #FFFFFF; font-weight: bold;">Model</span></th>';
            $tbl .= '<th style="text-align:center; width: 15%"><span style="color: #FFFFFF; font-weight: bold;">Serial number</span></th>';
            $tbl .= '<th style="text-align:center; width: 15%"><span style="color: #FFFFFF; font-weight: bold;">Firmware version</span></th>';
            $tbl .= '<th style="text-align:center; width: 15%"><span style="color: #FFFFFF; font-weight: bold;">Software version</span></th>';
            $tbl .= '<th style="text-align:center; width: 15%"><span style="color: #FFFFFF; font-weight: bold;">Uptime</span></th>';
            $tbl .= '</tr>';

            foreach ($this->openReport->getVariable('AUDIT_FILE_DIRECTORY') as $file){
                $reader = new Reader();
                $reader->loadConfigFile("./scripts/configs/".$file);

                $model = Toolbox::determineModel($reader->getConfigFile());

                if($model != "none"){
                    $reader->setOpenNode(Toolbox::initModel(Toolbox::determineModel($reader->getConfigFile())));
                    $reader->analyseConfigFile();

                    $model = Toolbox::determineModel($reader->getConfigFile());

                    if($reader->getOpenNode()->getOpenRunning()->getSystem()->getMgmtIp()){
                        $openRunning = $reader->getOpenNode()->getOpenRunning();
                        foreach ($openRunning->getSystem()->getStackUnit() as $unitId => $unit){
                            $tbl .= '<tr>';
                            if($unitId == 1){
                                $tbl .= '<td rowspan="'.sizeof($openRunning->getSystem()->getStackUnit()).'">'.$openRunning->getSystem()->getMgmtIp().'</td>';
                            }
                            $tbl .= '<td style="text-align: center;">#'.$unitId.'</td>';
                            $tbl .= '<td style="text-align: center;">'.$openRunning->getSystem()->getStackUnit($unitId)->getSwitchModel().'</td>';
                            $tbl .= '<td style="text-align: center;">'.$openRunning->getSystem()->getStackUnit($unitId)->getSerialNumber().'</td>';
                            $tbl .= '<td style="text-align: center;">'.$openRunning->getSystem()->getStackUnit($unitId)->getVersionFirmware().'</td>';
                            $tbl .= '<td style="text-align: center;">'.$openRunning->getSystem()->getStackUnit($unitId)->getVersionSoftware().'</td>';
                            $tbl .= '<td style="text-align: center;">'.$openRunning->getSystem()->getStackUnit($unitId)->getSwitchUptime().'</td>';
                            $tbl .= '</tr>';
                        }
                    } else {
                        $tbl .= '<tr style="background-color: #f8d7da"><td colspan="7">'.$file.' - '.$model.'</td></tr>';
                    }
                }
            }

            $tbl .= '</table>';

            $this->getPDF()->writeHTML($tbl);
        }

        private function getPDF(){
            return $this->openReport->getPDF();
        }

    }