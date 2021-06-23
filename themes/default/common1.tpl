<?php 
$filters = array(
// Бренд
'brands' => array(
'name' => 'Бренд',
'type' => 'checkbox',
'values' => array(
'Total' => 'Total',
'Elf' => 'Elf',
)
),
/*// Цена
'price' => array(
'name' => 'Цена',
'type' => 'range',
'from' => 'GTE',
'to' => 'LTE',
'value' => 'руб.',
),*/
// Тип
'type' => array(
'name' => 'Тип',
'type' => 'checkbox',
'values' => array(
'вакуумное' => 'вакуумное',
'гидравлическое' => 'гидравлическое',
'компрессорное' => 'компрессорное',
'многофункциональное' => 'многофункциональное',
'моторное' => 'моторное',
'редукторное' => 'редукторное',
'смазка' => 'смазка',
'теплоноситель' => 'теплоноситель',
'трансмиссионное' => 'трансмиссионное',
'турбинное' => 'турбинное',
)
),
// Тип масла
/*'oil_type' => array(
'name' => 'Тип масла',
'type' => 'checkbox',
'values' => array(
'минеральное' => 'минеральное',
'полусинтетическое' => 'полусинтетическое',
'синтетическое' => 'синтетическое',
'универсальное' => 'универсальное',
'промывочное' => 'промывочное',
'гидрокрекинговое' => 'гидрокрекинговое',
/* 1 => 'минеральное',
2 => 'полусинтетическое',
3 => 'синтетическое',
4 => 'универсальное',
5 => 'промывочное',
6 => 'гидрокрекинговое', */
/*	)
),*/
/*// Класс вязкости
'viscosity' => array(
'name' => 'Класс вязкости',
'type' => 'checkbox',
'values' => array(
/*'0' => '0',
'00' => '00',
'000' => '000',
'1' => '1',
'2' => '2',
'3' => '3',
'5' => '5',
'10' => '10',*/
/*'15' => '15',
'22' => '22',
'32' => '32',
'46' => '46',
'68' => '68',
'100' => '100',
'150' => '150',
'220' => '220',
'320' => '320',
'460' => '460',
'680' => '680',
'1000' => '1000',
'0W20' => '0W20',
'0W30' => '0W30',
'0W40' => '0W40',
'5W20' => '5W20',
'5W30' => '5W30',
'5W40' => '5W40',
'5W50' => '5W50',
'10W30' => '10W30',
'10W40' => '10W40',
'10W50' => '10W50',
'10W60' => '10W60',
'15W40' => '15W40',
'15W50' => '15W50',
'20W20' => '20W20',					
'20W40' => '20W40',
'20W50' => '20W50',
'20W60' => '20W60',
'25W40' => '25W40',					
'SAE30' => 'SAE30',					
)
),*/
// Объем
'capacity' => array(
'name' => 'Объем',
'type' => 'checkbox',
'values' => array(
'1' => '1',
'2' => '2',
'4' => '4',
'5' => '5',
'20' => '20',
'60' => '60',
'208' => '208',
)
),
);
?>
<?php 
$firstBread['name'] = "Главная";
$firstBread['url'] = "/";
?>
<?php // if ($_SERVER['REMOTE_ADDR'] == '78.140.9.206' || $_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104' || $_SERVER['REMOTE_ADDR'] == '95.170.159.81') { ?>
<div class="breadcrumbsDesign">
    <p>
        <a href="<?php echo $firstBread['url']; ?>" title="<?php echo $firstBread['name']; ?>">
            <span class="bold"><?php echo $firstBread['name']; ?></span>
        </a> » 
        <?php if (strripos($_SERVER['REQUEST_URI'],'oils') && strripos($_SERVER['REQUEST_URI'],'.html')) {
			$href = '/oils/';
			$title = '';
        } else if (strripos($_SERVER['REQUEST_URI'],'efeles') && strripos($_SERVER['REQUEST_URI'],'.html')) {
			$href = '/efeles/';
			$title = '';
        } else {
			$href = $_SERVER['REQUEST_URI'];
			$title = Engine_Application::getPageHeader();
        } ?>
        <a href="<?php echo $href; ?>" title="<?php echo Engine_Application::getPageHeader(); ?>">
            <span class="underline"><?php echo Engine_Application::getPageHeader(); ?></span>
        </a>
    </p>
</div>
<div class="commonWrapper">
    <?php //if ((!$auth->hasIdentity()) && !(strripos($_SERVER['REQUEST_URI'],'oils'))) $allwidth = true;?>
    <div class="commonWL" style="margin-right: 0px;">
        <h1><?php echo $title; ?></h1>
        <?php echo $this->layout()->content; ?>
    </div>
    <div class="commonWL2" style="padding-top: 0px;">
        <?php if (strripos($_SERVER['REQUEST_URI'],'oils')) {   ?>                
        <script type="text/javascript">
            $(document).ready(function () {
                $('.splLink1').click(function () {
                    $(this).parent().children('div.splCont1').toggle('normal');
                    return false;
                });
            });
        </script>         
        <?php //echo '<pre>'; print_r($GET['filters']); echo '</pre>'; ?>
        <?php if (isset($_GET['filters']['viscosity'])) { foreach ($_GET['filters']['viscosity'] as $getBrand) {
        $viscosityArray[$getBrand] = "checked";
        } } ?>
        <script>
            function isCheckedSearch() {
                if ($('#typeвакуумное').is(":checked")) {
                    var listLI = '';
                    listLI = listLI + '<li id="viscosity68"><label><input type="checkbox" name="filters[viscosity][]" <?php if (isset($viscosityArray["68"])) { echo $viscosityArray["68"]; } ?> value="68">68</label></li>';
                    listLI = listLI + '<li id="viscosity100"><label><input type="checkbox" name="filters[viscosity][]" value="100" <?php if (isset($viscosityArray["100"])) { echo $viscosityArray["100"]; } ?> >100</label></li>';
                    listLI = listLI + '<li id="viscosity150"><label><input type="checkbox" name="filters[viscosity][]" value="150" <?php if (isset($viscosityArray["150"])) { echo $viscosityArray["150"]; } ?> >150</label></li>';
                    $("#viscosityUL").append(listLI);
                }
                if ($('#typeгидравлическое').is(":checked")) {
                    var listLI = '';
                    listLI = listLI + '<li id="viscosity2"><label><input type="checkbox" name="filters[viscosity][]" value="2" <?php if (isset($viscosityArray["2"])) { echo $viscosityArray["2"]; } ?> >2</label></li>';
                    listLI = listLI + '<li id="viscosity3"><label><input type="checkbox" name="filters[viscosity][]" value="3" <?php if (isset($viscosityArray["3"])) { echo $viscosityArray["3"]; } ?> >3</label></li>';
                    listLI = listLI + '<li id="viscosity5"><label><input type="checkbox" name="filters[viscosity][]" value="5" <?php if (isset($viscosityArray["5"])) { echo $viscosityArray["5"]; } ?> >5</label></li>';
                    listLI = listLI + '<li id="viscosity10"><label><input type="checkbox" name="filters[viscosity][]" value="10" <?php if (isset($viscosityArray["10"])) { echo $viscosityArray["10"]; } ?> >10</label></li>';
                    listLI = listLI + '<li id="viscosity15"><label><input type="checkbox" name="filters[viscosity][]" value="15" <?php if (isset($viscosityArray["15"])) { echo $viscosityArray["15"]; } ?> >15</label></li>';
                    listLI = listLI + '<li id="viscosity22"><label><input type="checkbox" name="filters[viscosity][]" value="22" <?php if (isset($viscosityArray["22"])) { echo $viscosityArray["22"]; } ?> >22</label></li>';
                    listLI = listLI + '<li id="viscosity32"><label><input type="checkbox" name="filters[viscosity][]" value="32" <?php if (isset($viscosityArray["32"])) { echo $viscosityArray["32"]; } ?> >32</label></li>';
                    listLI = listLI + '<li id="viscosity46"><label><input type="checkbox" name="filters[viscosity][]" value="46" <?php if (isset($viscosityArray["46"])) { echo $viscosityArray["46"]; } ?> >46</label></li>';
                    listLI = listLI + '<li id="viscosity68"><label><input type="checkbox" name="filters[viscosity][]" value="68" <?php if (isset($viscosityArray["68"])) { echo $viscosityArray["68"]; } ?>>68</label></li>';
                    listLI = listLI + '<li id="viscosity100"><label><input type="checkbox" name="filters[viscosity][]" value="100" <?php if (isset($viscosityArray["100"])) { echo $viscosityArray["100"]; } ?> >100</label></li>';
                    $("#viscosityUL").append(listLI);
                }
                if ($('#typeкомпрессорное').is(":checked")) {
                    var listLI = '';
                    listLI = listLI + '<li id="viscosity32"><label><input type="checkbox" name="filters[viscosity][]" value="32" <?php if (isset($viscosityArray["32"])) { echo $viscosityArray["32"]; } ?> >32</label></li>';
                    listLI = listLI + '<li id="viscosity46"><label><input type="checkbox" name="filters[viscosity][]" value="46" <?php if (isset($viscosityArray["46"])) { echo $viscosityArray["46"]; } ?> >46</label></li>';
                    listLI = listLI + '<li id="viscosity68"><label><input type="checkbox" name="filters[viscosity][]" value="68" <?php if (isset($viscosityArray["68"])) { echo $viscosityArray["68"]; } ?>>68</label></li>';
                    listLI = listLI + '<li id="viscosity100"><label><input type="checkbox" name="filters[viscosity][]" value="100" <?php if (isset($viscosityArray["100"])) { echo $viscosityArray["100"]; } ?> >100</label></li>';
                    listLI = listLI + '<li id="viscosity150"><label><input type="checkbox" name="filters[viscosity][]" value="150" <?php if (isset($viscosityArray["150"])) { echo $viscosityArray["150"]; } ?> >150</label></li>';
                    $("#viscosityUL").append(listLI);
                }
                if ($('#typeтеплоноситель').is(":checked")) {
                    var listLI = '';
                    listLI = listLI + '<li id="viscosity32"><label><input type="checkbox" name="filters[viscosity][]" value="32" <?php if (isset($viscosityArray["32"])) { echo $viscosityArray["32"]; } ?> >32</label></li>';
                    $("#viscosityUL").append(listLI);
                }
                if ($('#typeтурбинное').is(":checked")) {
                    var listLI = '';
                    listLI = listLI + '<li id="viscosity32"><label><input type="checkbox" name="filters[viscosity][]" value="32" <?php if (isset($viscosityArray["32"])) { echo $viscosityArray["32"]; } ?> >32</label></li>';
                    listLI = listLI + '<li id="viscosity46"><label><input type="checkbox" name="filters[viscosity][]" value="46" <?php if (isset($viscosityArray["46"])) { echo $viscosityArray["46"]; } ?> >46</label></li>';
                    listLI = listLI + '<li id="viscosity68"><label><input type="checkbox" name="filters[viscosity][]" value="68" <?php if (isset($viscosityArray["68"])) { echo $viscosityArray["68"]; } ?>>68</label></li>';
                    listLI = listLI + '<li id="viscosity100"><label><input type="checkbox" name="filters[viscosity][]" value="100" <?php if (isset($viscosityArray["100"])) { echo $viscosityArray["100"]; } ?> >100</label></li>';
                    $("#viscosityUL").append(listLI);
                }
                if ($('#typeредукторное').is(":checked")) {
                    var listLI = '';
                    listLI = listLI + '<li id="viscosity100"><label><input type="checkbox" name="filters[viscosity][]" value="100" <?php if (isset($viscosityArray["100"])) { echo $viscosityArray["100"]; } ?> >100</label></li>';
                    listLI = listLI + '<li id="viscosity150"><label><input type="checkbox" name="filters[viscosity][]" value="150" <?php if (isset($viscosityArray["150"])) { echo $viscosityArray["150"]; } ?> >150</label></li>';
                    listLI = listLI + '<li id="viscosity220"><label><input type="checkbox" name="filters[viscosity][]" value="220" <?php if (isset($viscosityArray["220"])) { echo $viscosityArray["220"]; } ?> >220</label></li>';
                    listLI = listLI + '<li id="viscosity320"><label><input type="checkbox" name="filters[viscosity][]" value="320" <?php if (isset($viscosityArray["320"])) { echo $viscosityArray["320"]; } ?> >320</label></li>';
                    listLI = listLI + '<li id="viscosity460"><label><input type="checkbox" name="filters[viscosity][]" value="460" <?php if (isset($viscosityArray["460"])) { echo $viscosityArray["460"]; } ?> >460</label></li>';
                    listLI = listLI + '<li id="viscosity680"><label><input type="checkbox" name="filters[viscosity][]" value="680" <?php if (isset($viscosityArray["680"])) { echo $viscosityArray["680"]; } ?> >680</label></li>';
                    listLI = listLI + '<li id="viscosity1000"><label><input type="checkbox" name="filters[viscosity][]" value="1000" <?php if (isset($viscosityArray["1000"])) { echo $viscosityArray["1000"]; } ?> >1000</label></li>';
                    $("#viscosityUL").append(listLI);
                }
                if ($('#typeмоторное').is(":checked")) {
                    var listLI = '';
                    listLI = listLI + '<li id="viscosity0W20"><label><input type="checkbox" name="filters[viscosity][]" value="0W20" <?php if (isset($viscosityArray["0W20"])) { echo $viscosityArray["0W20"]; } ?> >0W20</label></li>';
                    listLI = listLI + '<li id="viscosity0W30"><label><input type="checkbox" name="filters[viscosity][]" value="0W30" <?php if (isset($viscosityArray["0W30"])) { echo $viscosityArray["0W30"]; } ?> >0W30</label></li>';
                    listLI = listLI + '<li id="viscosity0W40"><label><input type="checkbox" name="filters[viscosity][]" value="0W40" <?php if (isset($viscosityArray["0W40"])) { echo $viscosityArray["0W40"]; } ?> >0W40</label></li>';
                    listLI = listLI + '<li id="viscosity5W20"><label><input type="checkbox" name="filters[viscosity][]" value="5W20" <?php if (isset($viscosityArray["5W20"])) { echo $viscosityArray["5W20"]; } ?> >5W20</label></li>';
                    listLI = listLI + '<li id="viscosity5W30"><label><input type="checkbox" name="filters[viscosity][]" value="5W30" <?php if (isset($viscosityArray["5W30"])) { echo $viscosityArray["5W30"]; } ?> >5W30</label></li>';
                    listLI = listLI + '<li id="viscosity5W40"><label><input type="checkbox" name="filters[viscosity][]" value="5W40" <?php if (isset($viscosityArray["5W40"])) { echo $viscosityArray["5W40"]; } ?> >5W40</label></li>';
                    listLI = listLI + '<li id="viscosity5W50"><label><input type="checkbox" name="filters[viscosity][]" value="5W50" <?php if (isset($viscosityArray["5W50"])) { echo $viscosityArray["5W50"]; } ?> >5W50</label></li>';
                    listLI = listLI + '<li id="viscosity10W30"><label><input type="checkbox" name="filters[viscosity][]" value="10W30" <?php if (isset($viscosityArray["10W30"])) { echo $viscosityArray["10W30"]; } ?> >10W30</label></li>';
                    listLI = listLI + '<li id="viscosity10W40"><label><input type="checkbox" name="filters[viscosity][]" value="10W40" <?php if (isset($viscosityArray["10W40"])) { echo $viscosityArray["10W40"]; } ?> >10W40</label></li>';
                    listLI = listLI + '<li id="viscosity10W50"><label><input type="checkbox" name="filters[viscosity][]" value="10W50" <?php if (isset($viscosityArray["10W50"])) { echo $viscosityArray["10W50"]; } ?> >10W50</label></li>';
                    listLI = listLI + '<li id="viscosity10W60"><label><input type="checkbox" name="filters[viscosity][]" value="10W60" <?php if (isset($viscosityArray["10W60"])) { echo $viscosityArray["10W60"]; } ?> >10W60</label></li>';
                    listLI = listLI + '<li id="viscosity15W40"><label><input type="checkbox" name="filters[viscosity][]" value="15W40" <?php if (isset($viscosityArray["15W40"])) { echo $viscosityArray["15W40"]; } ?> >15W40</label></li>';
                    listLI = listLI + '<li id="viscosity15W50"><label><input type="checkbox" name="filters[viscosity][]" value="15W50" <?php if (isset($viscosityArray["15W50"])) { echo $viscosityArray["15W50"]; } ?> >15W50</label></li>';
                    listLI = listLI + '<li id="viscosity20W20"><label><input type="checkbox" name="filters[viscosity][]" value="20W20" <?php if (isset($viscosityArray["20W20"])) { echo $viscosityArray["20W20"]; } ?> >20W20</label></li>';
                    listLI = listLI + '<li id="viscosity20W40"><label><input type="checkbox" name="filters[viscosity][]" value="20W40" <?php if (isset($viscosityArray["20W40"])) { echo $viscosityArray["20W40"]; } ?> >20W40</label></li>';
                    listLI = listLI + '<li id="viscosity20W50"><label><input type="checkbox" name="filters[viscosity][]" value="20W50" <?php if (isset($viscosityArray["20W50"])) { echo $viscosityArray["20W50"]; } ?> >20W50</label></li>';
                    listLI = listLI + '<li id="viscosity20W60"><label><input type="checkbox" name="filters[viscosity][]" value="20W60" <?php if (isset($viscosityArray["20W60"])) { echo $viscosityArray["20W60"]; } ?> >20W60</label></li>';
                    listLI = listLI + '<li id="viscosity25W40"><label><input type="checkbox" name="filters[viscosity][]" value="25W40" <?php if (isset($viscosityArray["25W40"])) { echo $viscosityArray["25W40"]; } ?> >25W40</label></li>';
                    listLI = listLI + '<li id="viscositySAE30"><label><input type="checkbox" name="filters[viscosity][]" value="SAE30" <?php if (isset($viscosityArray["SAE30"])) { echo $viscosityArray["SAE30"]; } ?> >SAE30</label></li>';
                    $("#viscosityUL").append(listLI);
                }
                if ($('#typeтрансмиссионное').is(":checked")) {
                    var listLI = '';
                    listLI = listLI + '<li id="viscosity85W90"><label><input type="checkbox" name="filters[viscosity][]" value="85W90" <?php if (isset($viscosityArray["85W90"])) { echo $viscosityArray["85W90"]; } ?> >85W90</label></li>';
                    listLI = listLI + '<li id="viscosity80W90"><label><input type="checkbox" name="filters[viscosity][]" value="80W90" <?php if (isset($viscosityArray["80W90"])) { echo $viscosityArray["80W90"]; } ?> >80W90</label></li>';
                    listLI = listLI + '<li id="viscosity80W110"><label><input type="checkbox" name="filters[viscosity][]" value="80W110" <?php if (isset($viscosityArray["80W110"])) { echo $viscosityArray["80W110"]; } ?> >80W110</label></li>';
                    listLI = listLI + '<li id="viscosity80W140"><label><input type="checkbox" name="filters[viscosity][]" value="80W140" <?php if (isset($viscosityArray["80W140"])) { echo $viscosityArray["80W140"]; } ?> >80W140</label></li>';
                    listLI = listLI + '<li id="viscosity75W80"><label><input type="checkbox" name="filters[viscosity][]" value="75W80" <?php if (isset($viscosityArray["75W80"])) { echo $viscosityArray["75W80"]; } ?> >75W80</label></li>';
                    listLI = listLI + '<li id="viscosity75W90"><label><input type="checkbox" name="filters[viscosity][]" value="75W90" <?php if (isset($viscosityArray["75W90"])) { echo $viscosityArray["75W90"]; } ?> >75W90</label></li>';
                    listLI = listLI + '<li id="viscosity75W140"><label><input type="checkbox" name="filters[viscosity][]" value="75W140" <?php if (isset($viscosityArray["75W140"])) { echo $viscosityArray["75W140"]; } ?> >75W140</label></li>';
                    $("#viscosityUL").append(listLI);
                }
            }
            $(document).ready(function () {
                isCheckedSearch();
                $("#typeвакуумное").click(function () {
                    if ($('#typeвакуумное').is(":checked")) {
                        var listLI = '';
                        listLI = listLI + '<li id="viscosity68"><label><input type="checkbox" name="filters[viscosity][]" value="68">68</label></li>';
                        listLI = listLI + '<li id="viscosity100"><label><input type="checkbox" name="filters[viscosity][]" value="100">100</label></li>';
                        listLI = listLI + '<li id="viscosity150"><label><input type="checkbox" name="filters[viscosity][]" value="150">150</label></li>';
                        $("#viscosityUL").append(listLI);
                    } else {
                        $('#viscosity68').remove();
                        $('#viscosity100').remove();
                        $('#viscosity150').remove();
                    }
                });
                $("#typeгидравлическое").click(function () {
                    if ($('#typeгидравлическое').is(":checked")) {
                        var listLI = '';
                        listLI = listLI + '<li id="viscosity2"><label><input type="checkbox" name="filters[viscosity][]" value="2">2</label></li>';
                        listLI = listLI + '<li id="viscosity3"><label><input type="checkbox" name="filters[viscosity][]" value="3">3</label></li>';
                        listLI = listLI + '<li id="viscosity5"><label><input type="checkbox" name="filters[viscosity][]" value="5">5</label></li>';
                        listLI = listLI + '<li id="viscosity10"><label><input type="checkbox" name="filters[viscosity][]" value="10">10</label></li>';
                        listLI = listLI + '<li id="viscosity15"><label><input type="checkbox" name="filters[viscosity][]" value="15">15</label></li>';
                        listLI = listLI + '<li id="viscosity22"><label><input type="checkbox" name="filters[viscosity][]" value="22">22</label></li>';
                        listLI = listLI + '<li id="viscosity32"><label><input type="checkbox" name="filters[viscosity][]" value="32">32</label></li>';
                        listLI = listLI + '<li id="viscosity46"><label><input type="checkbox" name="filters[viscosity][]" value="46">46</label></li>';
                        listLI = listLI + '<li id="viscosity68"><label><input type="checkbox" name="filters[viscosity][]" value="68">68</label></li>';
                        listLI = listLI + '<li id="viscosity100"><label><input type="checkbox" name="filters[viscosity][]" value="100">100</label></li>';
                        $("#viscosityUL").append(listLI);
                    } else {
                        $('#viscosity2').remove();
                        $('#viscosity3').remove();
                        $('#viscosity5').remove();
                        $('#viscosity10').remove();
                        $('#viscosity15').remove();
                        $('#viscosity22').remove();
                        $('#viscosity32').remove();
                        $('#viscosity46').remove();
                        $('#viscosity68').remove();
                        $('#viscosity100').remove();
                    }
                });
                $("#typeкомпрессорное").click(function () {
                    if ($('#typeкомпрессорное').is(":checked")) {
                        var listLI = '';
                        listLI = listLI + '<li id="viscosity32"><label><input type="checkbox" name="filters[viscosity][]" value="32">32</label></li>';
                        listLI = listLI + '<li id="viscosity46"><label><input type="checkbox" name="filters[viscosity][]" value="46">46</label></li>';
                        listLI = listLI + '<li id="viscosity68"><label><input type="checkbox" name="filters[viscosity][]" value="68">68</label></li>';
                        listLI = listLI + '<li id="viscosity100"><label><input type="checkbox" name="filters[viscosity][]" value="100">100</label></li>';
                        listLI = listLI + '<li id="viscosity150"><label><input type="checkbox" name="filters[viscosity][]" value="150">150</label></li>';
                        $("#viscosityUL").append(listLI);
                    } else {
                        $('#viscosity32').remove();
                        $('#viscosity46').remove();
                        $('#viscosity68').remove();
                        $('#viscosity100').remove();
                        $('#viscosity150').remove();
                    }
                });
                $("#typeтеплоноситель").click(function () {
                    if ($('#typeтеплоноситель').is(":checked")) {
                        var listLI = '';
                        listLI = listLI + '<li id="viscosity32"><label><input type="checkbox" name="filters[viscosity][]" value="32">32</label></li>';
                        $("#viscosityUL").append(listLI);
                    } else {
                        $('#viscosity32').remove();
                    }
                });
                $("#typeтурбинное").click(function () {
                    if ($('#typeтурбинное').is(":checked")) {
                        var listLI = '';
                        listLI = listLI + '<li id="viscosity32"><label><input type="checkbox" name="filters[viscosity][]" value="32">32</label></li>';
                        listLI = listLI + '<li id="viscosity46"><label><input type="checkbox" name="filters[viscosity][]" value="46">46</label></li>';
                        listLI = listLI + '<li id="viscosity68"><label><input type="checkbox" name="filters[viscosity][]" value="68">68</label></li>';
                        listLI = listLI + '<li id="viscosity100"><label><input type="checkbox" name="filters[viscosity][]" value="100">100</label></li>';
                        $("#viscosityUL").append(listLI);
                    } else {
                        $('#viscosity32').remove();
                        $('#viscosity46').remove();
                        $('#viscosity68').remove();
                        $('#viscosity100').remove();
                    }
                });
                $("#typeредукторное").click(function () {
                    if ($('#typeредукторное').is(":checked")) {
                        var listLI = '';
                        listLI = listLI + '<li id="viscosity100"><label><input type="checkbox" name="filters[viscosity][]" value="100">100</label></li>';
                        listLI = listLI + '<li id="viscosity150"><label><input type="checkbox" name="filters[viscosity][]" value="150">150</label></li>';
                        listLI = listLI + '<li id="viscosity220"><label><input type="checkbox" name="filters[viscosity][]" value="220">220</label></li>';
                        listLI = listLI + '<li id="viscosity320"><label><input type="checkbox" name="filters[viscosity][]" value="320">320</label></li>';
                        listLI = listLI + '<li id="viscosity460"><label><input type="checkbox" name="filters[viscosity][]" value="460">460</label></li>';
                        listLI = listLI + '<li id="viscosity680"><label><input type="checkbox" name="filters[viscosity][]" value="680">680</label></li>';
                        listLI = listLI + '<li id="viscosity1000"><label><input type="checkbox" name="filters[viscosity][]" value="1000">1000</label></li>';
                        $("#viscosityUL").append(listLI);
                    } else {
                        $('#viscosity100').remove();
                        $('#viscosity150').remove();
                        $('#viscosity220').remove();
                        $('#viscosity320').remove();
                        $('#viscosity460').remove();
                        $('#viscosity680').remove();
                        $('#viscosity1000').remove();
                    }
                });
                $("#typeмоторное").click(function () {
                    if ($('#typeмоторное').is(":checked")) {
                        var listLI = '';
                        listLI = listLI + '<li id="viscosity0W20"><label><input type="checkbox" name="filters[viscosity][]" value="0W20">0W20</label></li>';
                        listLI = listLI + '<li id="viscosity0W30"><label><input type="checkbox" name="filters[viscosity][]" value="0W30">0W30</label></li>';
                        listLI = listLI + '<li id="viscosity0W40"><label><input type="checkbox" name="filters[viscosity][]" value="0W40">0W40</label></li>';
                        listLI = listLI + '<li id="viscosity5W20"><label><input type="checkbox" name="filters[viscosity][]" value="5W20">5W20</label></li>';
                        listLI = listLI + '<li id="viscosity5W30"><label><input type="checkbox" name="filters[viscosity][]" value="5W30">5W30</label></li>';
                        listLI = listLI + '<li id="viscosity5W40"><label><input type="checkbox" name="filters[viscosity][]" value="5W40">5W40</label></li>';
                        listLI = listLI + '<li id="viscosity5W50"><label><input type="checkbox" name="filters[viscosity][]" value="5W50">5W50</label></li>';
                        listLI = listLI + '<li id="viscosity10W30"><label><input type="checkbox" name="filters[viscosity][]" value="10W30">10W30</label></li>';
                        listLI = listLI + '<li id="viscosity10W40"><label><input type="checkbox" name="filters[viscosity][]" value="10W40">10W40</label></li>';
                        listLI = listLI + '<li id="viscosity10W50"><label><input type="checkbox" name="filters[viscosity][]" value="10W50">10W50</label></li>';
                        listLI = listLI + '<li id="viscosity10W60"><label><input type="checkbox" name="filters[viscosity][]" value="10W60">10W60</label></li>';
                        listLI = listLI + '<li id="viscosity15W40"><label><input type="checkbox" name="filters[viscosity][]" value="15W40">15W40</label></li>';
                        listLI = listLI + '<li id="viscosity15W50"><label><input type="checkbox" name="filters[viscosity][]" value="15W50">15W50</label></li>';
                        listLI = listLI + '<li id="viscosity20W20"><label><input type="checkbox" name="filters[viscosity][]" value="20W20">20W20</label></li>';
                        listLI = listLI + '<li id="viscosity20W40"><label><input type="checkbox" name="filters[viscosity][]" value="20W40">20W40</label></li>';
                        listLI = listLI + '<li id="viscosity20W50"><label><input type="checkbox" name="filters[viscosity][]" value="20W50">20W50</label></li>';
                        listLI = listLI + '<li id="viscosity20W60"><label><input type="checkbox" name="filters[viscosity][]" value="20W60">20W60</label></li>';
                        listLI = listLI + '<li id="viscosity25W40"><label><input type="checkbox" name="filters[viscosity][]" value="25W40">25W40</label></li>';
                        listLI = listLI + '<li id="viscositySAE30"><label><input type="checkbox" name="filters[viscosity][]" value="SAE30">SAE30</label></li>';
                        $("#viscosityUL").append(listLI);
                    } else {
                        $('#viscosity0W20').remove();
                        $('#viscosity0W30').remove();
                        $('#viscosity0W40').remove();
                        $('#viscosity5W20').remove();
                        $('#viscosity5W30').remove();
                        $('#viscosity5W40').remove();
                        $('#viscosity5W50').remove();
                        $('#viscosity10W30').remove();
                        $('#viscosity10W40').remove();
                        $('#viscosity10W50').remove();
                        $('#viscosity10W60').remove();
                        $('#viscosity15W40').remove();
                        $('#viscosity15W50').remove();
                        $('#viscosity20W20').remove();
                        $('#viscosity20W40').remove();
                        $('#viscosity20W50').remove();
                        $('#viscosity20W60').remove();
                        $('#viscosity25W40').remove();
                        $('#viscositySAE30').remove();
                    }
                });
                $("#typeтрансмиссионное").click(function () {
                    if ($('#typeтрансмиссионное').is(":checked")) {
                        var listLI = '';
                        listLI = listLI + '<li id="viscosity85W90"><label><input type="checkbox" name="filters[viscosity][]" value="85W90">85W90</label></li>';
                        listLI = listLI + '<li id="viscosity80W90"><label><input type="checkbox" name="filters[viscosity][]" value="80W90">80W90</label></li>';
                        listLI = listLI + '<li id="viscosity80W110"><label><input type="checkbox" name="filters[viscosity][]" value="80W110">80W110</label></li>';
                        listLI = listLI + '<li id="viscosity80W140"><label><input type="checkbox" name="filters[viscosity][]" value="80W140">80W140</label></li>';
                        listLI = listLI + '<li id="viscosity75W80"><label><input type="checkbox" name="filters[viscosity][]" value="75W80">75W80</label></li>';
                        listLI = listLI + '<li id="viscosity75W90"><label><input type="checkbox" name="filters[viscosity][]" value="75W90">75W90</label></li>';
                        listLI = listLI + '<li id="viscosity75W140"><label><input type="checkbox" name="filters[viscosity][]" value="75W140">75W140</label></li>';
                        $("#viscosityUL").append(listLI);
                    } else {
                        $('#viscosity85W90').remove();
                        $('#viscosity80W90').remove();
                        $('#viscosity80W110').remove();
                        $('#viscosity80W140').remove();
                        $('#viscosity75W80').remove();
                        $('#viscosity75W90').remove();
                        $('#viscosity75W140').remove();
                    }
                });
            });
        </script>
<style>
.splCont1 ul li {
	padding: 3px 0;
}
</style>
        <form method="get">                              
            <div class="search-menu">
                <div class="byPram">Поиск по параметрам</div>
                <div class="seachBlock">
                    <?php foreach ($filters as $filterKey => $filter) { ?>
                    <div class="search-menu__filter ">
                        <button class="splLink1" type="button"></button>
                        <div class="search-menu__title"><?php echo $filter['name']; ?></div>
                        <?php
                        $display = 'none';
                        foreach ($filter['values'] as $key => $value) {
                        if (isset($_GET['filters'][$filterKey])) {
                        foreach ($_GET['filters'][$filterKey] as $getBrand) {
                        if ($getBrand == $value) {
                        $display = 'block';
                        break;
                        }
                        }
                        }
                        }
                        ?>
                        <div class="splCont1 seach<?php echo $filterKey; ?> hide<?php echo $filterKey; ?>" style="margin: 0 0 0 30px; display: <?php echo $display; ?>;">
                            <?php
                            switch ($filter['type']) {
                            case 'checkbox':
                            echo '<ul>';
                            $kk = 1;
                            foreach ($filter['values'] as $key => $value) {
                            $checked = '';
                            if (isset($_GET['filters'][$filterKey])) {                            
                            foreach ($_GET['filters'][$filterKey] as $getBrand) {
                            if ($getBrand === $value) {
                            $checked = 'checked';
                            break;
                            }
                            }
                            }
                            echo '<li>
                            <label>
                            <input type="checkbox" id="' . $filterKey . $key . '" name="filters[' . $filterKey . '][]" value="' . $key . '" ' . $checked . '>
                            ' . $value . '
                            </label>
                            </li>';
                            }
                            $kk++;
                            echo '</ul>';
                            break;
                            case 'range':
                            echo '
                            <p>от</p>
                            <input type="text" size="5" name="filters[' . $filterKey . '][' . $filter['from'] . ']" value="' . (isset($_GET['filters'][$filterKey][$filter['from']]) ? $_GET['filters'][$filterKey][$filter['from']] : '') . '">
                            ' . $filter['value'] . '<p>до</p>
                            <input type="text" size="5" name="filters[' . $filterKey . '][' . $filter['to'] . ']" value="' . (isset($_GET['filters'][$filterKey][$filter['to']]) ? $_GET['filters'][$filterKey][$filter['to']] : '') . '">
                            ' . $filter['value'] . '';
                            break;
                            }
                            ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="search-menu__filter ">
                        <button class="splLink1" type="button"></button>
                        <div class="search-menu__title">Класс вязкости</div>
                        <div class="splCont1 seachviscosity hideviscosity" style="margin: 0 0 0 30px; display: block;">
                            <ul id="viscosityUL">

                            </ul>
                        </div>
                    </div>
                    <?php /* <p style="width: 200px; margin: 0 0 0 20px;">*Раздел "КЛАСС ВЯЗКОСТИ" находится в разработке</p> */ ?>
                    <button class="searchButton" type="submit"></button>
                </div>
            </div>
        </form>
        <?php } ?>
        <?php if (strpos($_SERVER['REQUEST_URI'], "account/signup")) { ?>
        <div class="client-block" style="margin: 15px 0 10px 20px; width: 190px;">
            <div class="white-block" style="text-align: justify;">
                <p style="font-family: Arial; font-size: 12px;">Компания «Томавтотрейд» никогда и ни при каких условиях не разглашает личные данные своих клиентов.</p>
                <p style="font-family: Arial; font-size: 12px;">Ваша информация будет использована лишь для оформления заказов и более удобной работы с сайтом.</p>
            </div>
        </div>
        <?php } ?>
        <?php if ($auth->hasIdentity()) { ?>
        <div class="client-block">
            <div class="white-block">
                <div class="client-name">
                    <div class="client-logo">
                        <p><?php if($this->layout()->userInfo['name'] != '') echo $this->layout()->userInfo['name']; ?></p>
                    </div>
                </div>
                <?php $modelUser = new User_Models_UserUser(); 
                $user = $modelUser->getUser($this->layout()->userInfo['user_id']);  ?>
                <div class="client-info">
                    <p><span style="font-weight: bold;">Телефон: </span><span><?php echo $this->layout()->userInfo['phone']; ?></span></p>
                    <p><span style="font-weight: bold;">E-mail: </span><span><?php echo $user['email']; ?></span></p>
                    <p><span style="font-weight: bold;">Адрес: </span><span><?php echo $this->layout()->userInfo['address'];?></span></p>
                </div>
                <ul class="left-menu">
                    <?php /* <li class=""><a href="/control/profile/">&nbsp;&mdash;&nbsp;Личные данные</a></li> */ ?>
                    <li class="liUM mess"><a href="/messages/mailbox/">Сообщения</a> <?php /* &nbsp;<b>(<?php echo $this->layout()->unread; ?>)</b> */ ?></li>
                    <?php if (!$this->layout()->isManager) { ?>
                    <li class="liUM can" id="basket"><?php echo Basket_Models_Control::getCount(); ?></li>
                    <li class="liUM can2"><a href="/control/history/">История заказов</a></li>
                    <li class="liUM price"><a href="/prices/">Прайс листы</a></li>
                    <?php } ?>
                    <!---->
                </ul>
                <a href="/guestbook/"><div class="writeTo"></div></a>
            </div>
            <?php /* <a href="/account/logout/" class="client-exit"></a> */ ?>
        </div>	
        <?php } ?>
        <?php if (isset($_SESSION['basket'])) { ?>
        <div class="client-block">
            <div class="white-block">
                <div class="curorder">
                    <div class="curtitle">
                        <p>ТЕКУЩИЙ ЗАКАЗ</p>
                    </div>
                </div>
                <div class="orders">
                    <?php $shopitem = Basket_Models_Control::getShopItems();
                    /*echo '<pre>'; print_r($_SESSION['basket']); print_r($shopitem); echo '</pre>';*/ ?>
                    <?php if (is_array($shopitem['items'])) { foreach ($shopitem['items'] as $key => $value) { ?>
                    <div class="order" style="margin: 10px 0 0 20px;">                        
                        <p style="float: left; width: 140px; font-weight: bold; margin-right: 15px; color: #00aaf0; font-family: Arial; font-size: 12px; text-decoration: underline;"><?php echo $value['name']; ?></p>
                        <p style="float: left; color: #00aaf0; font-weight: bold; width: 35px; text-align: right;font-family: Arial; font-size: 12px;"><?php echo $value['count']; ?></p>
                        <br style="clear: left;"/>
                    </div>
                    <?php } } ?>
                </div>
                <div class="orderprice">
                    <p><span>Итоговая сумма: </span><span style="font-weight: bold;"><?php echo $shopitem['totalprice']; ?></span></p>
                </div>
                <a href="/order/"><div class="sendorder"></div></a>
            </div>
        </div>	
        <?php } ?>
	<div style="margin: 3px 0 0 11px; width: 213px; overflow: auto;">
		<?php /* <a href="#">
                	<img style="width: 200px; overflow: auto;" src="/media/filebrowser/uploads/banners/2016/06/4.jpg" />
		</a>  
		<a href="#">
                	<img style="width: 200px; overflow: auto;" src="/media/filebrowser/uploads/banners/2016/06/240x300.jpg" />
		</a> */ ?>
        </div>
</div> 
<?php /* } else { ?>
<?php echo $this->layout()->content; ?>
<?php } */ ?>