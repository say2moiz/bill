<?php
require_once("mpdf/mpdf.php");
require_once('autoload.php');
function html2pdf(){
    $html = '';
    $html .= '<title>Bill</title>';
    $html .= '<link rel="shortcut icon" type="image/png" href="images/bill.ico"/>';
    $html .= '<style>';
    $html .= 'html, body, div, span, applet, object, iframe,h1, h2, h3, h4, h5, h6, p, blockquote, pre,a, abbr, acronym, address, big, cite, code,del, dfn, em, img, ins, kbd, q, s, samp,small, strike, strong, sub, sup, tt, var,b, u, i, center,dl, dt, dd, ol, ul, li,fieldset, form, label, legend,table, caption, tbody, tfoot, thead, tr, th, td,article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary,time, mark, audio, video {	margin: 0;	padding: 0;	border: 0;	font-size: 100%;	font: inherit;	vertical-align: baseline;}/* HTML5 display-role reset for older browsers */article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {	display: block;}body {	line-height: 1;}ol, ul {	list-style: none;}blockquote, q {	quotes: none;}blockquote:before, blockquote:after,q:before, q:after {	content: "";	content: none;}table {	border-collapse: collapse;	border-spacing: 0;}';
    $html .= 'input:focus {outline-width: 0;}';
    $html .= '.clearfix:before, .clearfix:after {content: "";display: table;}';
    $html .= '.clearfix:after {clear: both;}';
    $html .= '.clearfix { *zoom: 1;}';


    $html .= '#container{clear: both; display: block; float: none; width: 80%;padding: 10% 10%;font-family: "Fjalla One", sans-serif;}';
    $html .= '#container .top{clear: both;width: 100%;border-bottom: 1px solid #000;padding-bottom: 1%;}';
    $html .= '#container .top .topRight{display: inline-block;float: right;width: 100%;text-align:right;}';
    $html .= '#container .top .topRight .companyName{float: right;clear: both;font-weight: bold;font-size: 24px;padding-bottom: 4%;}';
    $html .= '#container .top .topRight .address,#container .top .topRight .address div{clear: both;float: right;font-size: 18px;}';
    $html .= '#container .top .topRight .address .addLine2,#container .top .topRight .address .addLine3,#container .top .topRight .address .phone{margin-top: 3%;}';
    $html .= '#container .mid{clear: both;width: 100%;border-bottom: 1px solid #000;padding: 4% 0% 1% 0%;}';
    $html .= '#container .mid .midHeading{width: 100%; text-align: center; font-size: 24px; font-weight: bold;padding-bottom: 4%;}';
    $html .= '#container .mid .row,#container .bottom .row{clear: both;margin: 1% 0%;}';
    $html .= '#container .mid .col,#container .bottom .col{display: inline-block;float: left;}';
    $html .= '#container .mid .col1,#container .bottom .col1{margin-left: 1%;width: 36%;}';
    $html .= '#container .mid .col2,#container .bottom .col2{width: 38%;}';
    $html .= '#container .mid .col3,#container .bottom .col3{width: 25%;text-align: right;}';
    $html .= '#container .bottom{padding-top: 4%;}';
    $html .= '#container .footer{margin: 40% 0% 0% 1%;}';
    $html .= '#container .footer .leftSign{float: left; display: inline-block;border-top:1px solid #000; padding-top: 0.5%;width: 132px;}';
    $html .= '#container .footer .rightSign{float: right; display: inline-block;border-top:1px solid #000;padding-top: 0.5%;width: 85px;}';
    $html .= '@media print {.pageBreak {page-break-before: always;}}';
    $html .= '</style>';
    $html .= '</head>';
    $html .= '<body>';
    for($i=0;$i<count($_SESSION['bills']['result']);$i++){
        $tempAdd = explode(',',$_SESSION['caddress']);
        if($i>0){
        $html .= '<div id="container" class="pageBreak">';
        }else{
            $html .= '<div id="container">';
        }
        $html .= '<div class="top clearfix">';
        $html .= '<div class="topRight">';
        $html .= '<div class="companyName">'.$_SESSION['cname'].'</div>';
        $html .= '<div class="address">';
        for($j=0;$j<count($tempAdd);$j++){
            $html .= '<div class="addLine1">'.$tempAdd[$j].'</div>';
        }
        $html .= '<div class="phone">Phone: '.$_SESSION['cphone'].'</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="mid clearfix">';
        $html .= '<div class="midHeading">'.$_SESSION['billtype'].'</div>';
        $html .= '<div class="row clearfix">';
        $html .= '<div class="col col1">Name: </div>';
        $html .= '<div class="col col2">'.$_SESSION['bills']['result'][$i]->cname.'</div>';
        $html .= '<div class="col col3"></div>';
        $html .= '</div>';
        $html .= '<div class="row clearfix">';
        $html .= '<div class="col col1">Address: </div>';
        $html .= '<div class="col col2">'.$_SESSION['bills']['result'][$i]->caddress.'</div>';
        $html .= '<div class="col col3"></div>';
        $html .= '</div>';
        $html .= '<div class="row clearfix">';
        $html .= '<div class="col col1">Meter no.: </div>';
        $html .= '<div class="col col2">'.$_SESSION['bills']['result'][$i]->meternum.'</div>';
        $html .= '<div class="col col3"></div>';
        $html .= '</div>';
        $html .= '<div class="row clearfix">';
        $html .= '<div class="col col1">New Reading: </div>';
        $html .= '<div class="col col2">'.$_SESSION['bills']['result'][$i]->newReadTime.'</div>';
        $html .= '<div class="col col3">'.round($_SESSION['bills']['result'][$i]->currentReading,3)." ".$_SESSION['bills']['result'][$i]->unit.'</div>';
        $html .= '</div>';
        $html .= '<div class="row clearfix">';
        $html .= '<div class="col col1">Old Reading: </div>';
        $html .= '<div class="col col2">'.$_SESSION['bills']['result'][$i]->oldReadTime.'</div>';
        $html .= '<div class="col col3">'.round($_SESSION['bills']['result'][$i]->previousReading,3)." ".$_SESSION['bills']['result'][$i]->unit.'</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="bottom">';
        $html .= '<div class="row clearfix">';
        $html .= '<div class="col col1">Energy Consumption: </div>';
        $html .= '<div class="col col2">&nbsp;</div>';
        $html .= '<div class="col col3">'.round($_SESSION['bills']['result'][$i]->energyUsed,3)."".$_SESSION['bills']['result'][$i]->unit.'</div>';
        $html .= '</div>';
        $html .= '<div class="row clearfix">';
        $html .= '<div class="col col1">Price per '.$_SESSION['bills']['result'][$i]->unit.': </div>';
        $html .= '<div class="col col2">'.$_SESSION['bills']['result'][$i]->unitPrice." ".$_SESSION['currency'].'</div>';
        $html .= '<div class="col col3"></div>';
        $html .= '</div>';
        $html .= '<div class="row clearfix">';
        $html .= '<div class="col col1">Total amount due: </div>';
        $html .= '<div class="col col2">&nbsp;</div>';
        $html .= '<div class="col col3">'.ceil($_SESSION['bills']['result'][$i]->charges)." ".$_SESSION['currency'].'</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="footer">';
        $html .= '<div class="leftSign">Tenants signature</div>';
        $html .= '<div class="rightSign">Real estate</div>';
        $html .= '</div>';
        $html .= '</div>';
    }
    $html .= '</body>';
    $html .= '</html>';
    ob_start();
    $template = ob_get_contents();
    $template = $html;
    ob_end_clean();
    $mpdf=new mPDF();
    $mpdf->WriteHTML($template);
    $mpdf->Output('pdfs/'.$_SESSION['pair'], 'F');
    //echo "PDF has been generated successfully";
}
?>