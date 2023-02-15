<?php
    namespace OpenNetworkTools\Template;

    use OpenNetworkTools\OpenReport;

    class DefaultTestTOCTemplate {

        private $openReport;

        public function __construct(OpenReport $openReport) {
            $this->openReport = $openReport;

            $this->getPDF()->AddPage();
            $this->getPDF()->Bookmark("Title 1", 0, 0);
            $this->getPDF()->setFont('helvetica', 'B', 16);
            $this->getPDF()->writeHTML('<span style="color: #472E8D">Title 1</span>', true, false, true, false, '');
            $this->getPDF()->Ln(0.75);
            $this->getPDF()->setFont('helvetica', '', 10);
            $this->getPDF()->writeHTML("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum sollicitudin tincidunt. Fusce aliquet turpis eu sollicitudin ultricies. Aliquam erat volutpat. Aliquam at mauris sollicitudin, tincidunt magna at, vestibulum sem. Pellentesque ac tempus diam. Fusce dapibus lorem tincidunt velit euismod, a convallis tortor maximus. Praesent iaculis dui lorem, at suscipit massa tincidunt vitae. Sed at lectus ut magna convallis ultrices ac non libero. In efficitur orci nulla, eget tristique est lobortis et. Phasellus ac erat volutpat, vestibulum ex eget, bibendum nunc. Morbi ac laoreet ex.", true, false, true, false, 'J');
            $this->getPDF()->Ln();
            $this->getPDF()->writeHTML("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum sollicitudin tincidunt. Fusce aliquet turpis eu sollicitudin ultricies. Aliquam erat volutpat. Aliquam at mauris sollicitudin, tincidunt magna at, vestibulum sem. Pellentesque ac tempus diam. Fusce dapibus lorem tincidunt velit euismod, a convallis tortor maximus. Praesent iaculis dui lorem, at suscipit massa tincidunt vitae. Sed at lectus ut magna convallis ultrices ac non libero. In efficitur orci nulla, eget tristique est lobortis et. Phasellus ac erat volutpat, vestibulum ex eget, bibendum nunc. Morbi ac laoreet ex.", true, false, true, false, 'J');
            $this->getPDF()->Ln();

            $this->getPDF()->Bookmark("Paragraph 1.1", 1, 0);
            $this->getPDF()->setFont('helvetica', 'B', 14);
            $this->getPDF()->writeHTML('<span style="color: #472E8D">Paragraph 1.1</span>', true, false, true, false, '');
            $this->getPDF()->Ln(0.75);
            $this->getPDF()->setFont('helvetica', '', 10);
            $this->getPDF()->writeHTML("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum sollicitudin tincidunt. Fusce aliquet turpis eu sollicitudin ultricies. Aliquam erat volutpat. Aliquam at mauris sollicitudin, tincidunt magna at, vestibulum sem. Pellentesque ac tempus diam. Fusce dapibus lorem tincidunt velit euismod, a convallis tortor maximus. Praesent iaculis dui lorem, at suscipit massa tincidunt vitae. Sed at lectus ut magna convallis ultrices ac non libero. In efficitur orci nulla, eget tristique est lobortis et. Phasellus ac erat volutpat, vestibulum ex eget, bibendum nunc. Morbi ac laoreet ex.", true, false, true, false, 'J');
            $this->getPDF()->Ln();

            $this->getPDF()->Bookmark("Sub-paragraph 1.1.1", 2, 0);
            $this->getPDF()->setFont('helvetica', 'B', 11);
            $this->getPDF()->writeHTML('<span style="color: #472E8D">Sub-paragraph 1.1.1</span>', true, false, true, false, '');
            $this->getPDF()->Ln(0.75);
            $this->getPDF()->setFont('helvetica', '', 10);
            $this->getPDF()->writeHTML("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum sollicitudin tincidunt. Fusce aliquet turpis eu sollicitudin ultricies. Aliquam erat volutpat. Aliquam at mauris sollicitudin, tincidunt magna at, vestibulum sem. Pellentesque ac tempus diam. Fusce dapibus lorem tincidunt velit euismod, a convallis tortor maximus. Praesent iaculis dui lorem, at suscipit massa tincidunt vitae. Sed at lectus ut magna convallis ultrices ac non libero. In efficitur orci nulla, eget tristique est lobortis et. Phasellus ac erat volutpat, vestibulum ex eget, bibendum nunc. Morbi ac laoreet ex.", true, false, true, false, 'J');
            $this->getPDF()->Ln();
            $content = <<<EOF
<pre style="background-color:#E0E0E0;color:#0E0E0E;">
int main() {
    printf("HelloWorld");
    return 0;
}
</pre>
EOF;
            $this->getPDF()->writeHTML($content, true, false, true, false, '');


            $this->getPDF()->Bookmark("Sub-paragraph 1.1.2", 2, 0);
            $this->getPDF()->setFont('helvetica', 'B', 11);
            $this->getPDF()->writeHTML('<span style="color: #472E8D">Sub-paragraph 1.1.2</span>', true, false, true, false, '');
            $this->getPDF()->Ln(0.75);
            $this->getPDF()->setFont('helvetica', '', 10);
            $this->getPDF()->writeHTML("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum sollicitudin tincidunt. Fusce aliquet turpis eu sollicitudin ultricies. Aliquam erat volutpat. Aliquam at mauris sollicitudin, tincidunt magna at, vestibulum sem. Pellentesque ac tempus diam. Fusce dapibus lorem tincidunt velit euismod, a convallis tortor maximus. Praesent iaculis dui lorem, at suscipit massa tincidunt vitae. Sed at lectus ut magna convallis ultrices ac non libero. In efficitur orci nulla, eget tristique est lobortis et. Phasellus ac erat volutpat, vestibulum ex eget, bibendum nunc. Morbi ac laoreet ex.", true, false, true, false, 'J');
            $this->getPDF()->Ln();


            $this->getPDF()->Bookmark("Paragraph 1.2", 1, 0);
            $this->getPDF()->setFont('helvetica', 'B', 14);
            $this->getPDF()->writeHTML('<span style="color: #472E8D">Paragraph 1.2</span>', true, false, true, false, '');
            $this->getPDF()->Ln(0.75);
            $this->getPDF()->setFont('helvetica', '', 10);
            $this->getPDF()->writeHTML("Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer rutrum sollicitudin tincidunt. Fusce aliquet turpis eu sollicitudin ultricies. Aliquam erat volutpat. Aliquam at mauris sollicitudin, tincidunt magna at, vestibulum sem. Pellentesque ac tempus diam. Fusce dapibus lorem tincidunt velit euismod, a convallis tortor maximus. Praesent iaculis dui lorem, at suscipit massa tincidunt vitae. Sed at lectus ut magna convallis ultrices ac non libero. In efficitur orci nulla, eget tristique est lobortis et. Phasellus ac erat volutpat, vestibulum ex eget, bibendum nunc. Morbi ac laoreet ex.", true, false, true, false, 'J');
            $this->getPDF()->Ln();


            $this->getPDF()->Bookmark("Paragraph 1.3", 1, 0);
            $this->getPDF()->setFont('helvetica', 'B', 14);
            $this->getPDF()->writeHTML('<span style="color: #472E8D">Paragraph 1.3</span>', true, false, true, false, '');
            $this->getPDF()->Ln(0.75);
            $this->getPDF()->setFont('helvetica', '', 8);

            $tbl = '<table border="1" cellpadding="1" cellspacing="0">';
            $tbl .= '<tr>';
            $tbl .= '<th style="width: 50%">Filename</th>';
            $tbl .= '<th style="text-align:center; width: 10%">Lines</th>';
            $tbl .= '<th style="text-align:center; width: 10%">Size</th>';
            $tbl .= '<th style="text-align:center; width: 30%">Templates</th>';
            $tbl .= '</tr>';
            for($i=1;$i<100;$i++){
                $tbl .= '<tr><td colspan="4">'.$i.'</td></tr>';
            }
            $tbl .= '</table>';

            $this->getPDF()->writeHTML($tbl);
        }

        private function getPDF(){
            return $this->openReport->getPDF();
        }

    }