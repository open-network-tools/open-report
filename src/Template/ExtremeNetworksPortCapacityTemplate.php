<?php
    namespace OpenNetworkTools\Template;

    use OpenNetworkTools\Node\Toolbox;
    use OpenNetworkTools\OpenNode\Reader;
    use OpenNetworkTools\OpenReport;

    class ExtremeNetworksPortCapacityTemplate {

        private $openReport;

        public function __construct(OpenReport $openReport) {
            $this->openReport = $openReport;

            $this->getPDF()->AddPage();
            $this->getPDF()->Bookmark("Ports capacity", 0, 0);
            $this->getPDF()->setFont('helvetica', 'B', 16);
            $this->getPDF()->writeHTML('<span style="color: #472E8D">Ports capacity</span>', true, false, true, false, '');
            $this->getPDF()->Ln(0.75);
            $this->getPDF()->setFont('helvetica', '', 10);
            $this->getPDF()->writeHTML("\@TODO", true, false, true, false, 'J');
            $this->getPDF()->Ln(1.5);

            $this->getPDF()->setFont('helvetica', '', 8);
            $tbl = '<table border="0.75" cellpadding="1" cellspacing="0">';
            $tbl .= '<tr style="background-color: #472E8D;">';
            $tbl .= '<th colspan="3" style="width: 40%;">&nbsp;</th>';
            $tbl .= '<th colspan="4" style="text-align:center; width: 60%;"><span style="color: #FFFFFF; font-weight: bold;">Ports informations</span></th>';
            $tbl .= '</tr>';
            $tbl .= '<tr style="background-color: #472E8D;">';
            $tbl .= '<th style="width: 15%"><span style="color: #FFFFFF; font-weight: bold;">IP Address</span></th>';
            $tbl .= '<th style="text-align:center; width: 5%"><span style="color: #FFFFFF; font-weight: bold;">Unit</span></th>';
            $tbl .= '<th style="text-align:center; width: 20%"><span style="color: #FFFFFF; font-weight: bold;">Model</span></th>';
            $tbl .= '<th style="text-align:center; width: 15%"><span style="color: #FFFFFF; font-weight: bold;">Switch capacity</span></th>';
            $tbl .= '<th style="text-align:center; width: 15%"><span style="color: #FFFFFF; font-weight: bold;">Count admin UP</span></th>';
            $tbl .= '<th style="text-align:center; width: 15%"><span style="color: #FFFFFF; font-weight: bold;">Count oper UP</span></th>';
            $tbl .= '<th style="text-align:center; width: 15%"><span style="color: #FFFFFF; font-weight: bold;">Capacity</span></th>';
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
                            $tbl .= '<td style="text-align: center;">'.$openRunning->getInterfaces()->countEthernet().'</td>';
                            $tbl .= '<td style="text-align: center;">'.$openRunning->getInterfaces()->countEthernet('adminUp').'</td>';
                            $tbl .= '<td style="text-align: center;">'.$openRunning->getInterfaces()->countEthernet('operUp').'</td>';
                            $capacity = round($openRunning->getInterfaces()->countEthernet('operUp')*100/$openRunning->getInterfaces()->countEthernet(), 2);
                            if($capacity < 50) $tbl .= '<td style="background-color: #d4edda; text-align: center;">'.$capacity.' %</td>';
                            elseif($capacity < 75) $tbl .= '<td style="background-color: #fff3cd; text-align: center;">'.$capacity.' %</td>';
                            elseif($capacity <= 100) $tbl .= '<td style="background-color: #f8d7da; text-align: center;">'.$capacity.' %</td>';
                            else $tbl .= '<td style="text-align: center;">'.$capacity.' %</td>';
                            $tbl .= '</tr>';
                        }
                    } else {
                        $tbl .= '<tr style="background-color: #f8d7da"><td colspan="7">'.$file.' - '.$model.'</td></tr>';
                    }
                }

                //if($file == "10_14_113_100_20230112-104101-804.txt") print_r($reader);
            }

            $tbl .= '</table>';

            $this->getPDF()->writeHTML($tbl);
        }

        private function getPDF(){
            return $this->openReport->getPDF();
        }

    }