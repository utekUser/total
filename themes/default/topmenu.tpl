<style>
    ul.dropdown li { position: relative; }
    ul.dropdown,
    ul.dropdown-inside {
        list-style-type: none;
        padding: 0;
    }
    ul.dropdown-inside {
        position: absolute;
        left: -9999px;
        z-index: 1000;
    }
    ul.dropdown li.dropdown-top {
        display: inline;
        float: left;
        margin: 0 1px 0 0;
    }
    ul.dropdown li.dropdown-top a {
        padding: 3px 10px 4px;
        display: block;
    }
    ul.dropdown a.dropdown-top { background: #efefef; }
    ul.dropdown a.dropdown-top:hover { padding: 2px 10px 5px; }
    ul.dropdown li.dropdown-top:hover .dropdown-inside {
        display: block;
        left: 0;
    }
    ul.dropdown .dropdown-inside { background: #fff; }
    ul.dropdown .dropdown-inside a:hover { background: #efefef; }    /*li  a */



    ul.dropdownnew li { position: relative; }
    ul.dropdownnew,
    ul.dropdownnew-inside {
        list-style-type: none;
        padding: 0;
    }
    ul.dropdownnew-inside {
        position: absolute;
        left: -9999px;
        z-index: 1000;
    }
    ul.dropdownnew li.dropdownnew-top {
        display: inline;
        float: left;
        margin: 0 1px 0 0;
    }
    ul.dropdownnew li.dropdownnew-top a {
        padding: 3px 10px 4px;
        display: block;
    }
    ul.dropdownnew a.dropdownnew-top { background: transparent; }
    ul.dropdownnew a.dropdownnew-top:hover { padding: 2px 10px 5px; text-decoration: underline }
    ul.dropdownnew li.dropdownnew-top:hover .dropdownnew-inside {
        display: block;
        left: 0;
    }
    ul.dropdownnew .dropdownnew-inside { background: transparent; }
    ul.dropdownnew .dropdownnew-inside a:hover { background: transparent; }
    #topmenumew ul {
        list-style: none;        
    }
    #topmenumew ul li {
        display: block;
        float: left;
        background: transparent;
        padding-left: 2px;
        margin: 0;
    }
    #topmenumew ul li.menu-li-first {
        background: transparent;
        padding: 0;
    }
    #topmenumew ul li a:hover {
        background: transparent;
    }
    #topmenumew a.menu-first, #topmenumew a {
        background: transparent;
    }
    #topmenumew ul li a {
        color: #4d4937;
        line-height: 30px;
        font-family: OfficinaSansCBook;
        text-transform: uppercase;
        font-size: 14px;
        text-decoration: none;
        display: block;
        height: 30px;
        background: transparent;
        padding: 0 10px;
    }
    #topmenumew a.menu-first:hover, #topmenumew a:hover {
        background: transparent;
        text-decoration: underline;
    }
    #topmenumew ul.dropdownnew-inside {        
        /*background: url(/themes/default/images/newdesign/arrowmenu.png) 43px 0px no-repeat;*/
        /*padding-top: 8px;*/
        margin: 5px 0 0 0;
        box-shadow: 0 0 10px rgba(0,0,0,0.5);
    }
    #topmenumew ul.dropdownnew-inside li {
        padding: 8px 8px 8px 8px;
        background: #ffffff;
        width: 155px;
    }
    #topmenumew ul.dropdownnew-inside li a {
        text-decoration: none;
    }
    #topmenumew ul.dropdownnew-inside li a:hover {
        color: #26b0f1;
    }


    ._nb-popup_to_bottom ._nb-popup-tail {
        top: 0;
        left: 50%;
        margin: -1em -.5em;
        clip: rect(-99em,99em,auto,-99em);
    }
    ._nb-popup-tail {
        position: absolute;
        font-size: 16px;
        width: 1em;
        height: 1em;
        clip: rect(0,0,0,0);
        clip: rect(-99em,99em,auto,-99em);left: 42px;top:-6px;
    }
    ._nb-popup-tail:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #fff;
        box-shadow: 0 0 0 1px rgba(0,0,0,.15),8px 8px 30px -5px rgba(0,0,0,.5);
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        -o-transform: rotate(45deg);
        transform: rotate(45deg);
    }

</style>
<?php foreach ($this->topmenu as $topMenu) {
if ($topMenu['parent'] == 0) {
$menu[$topMenu['id']]['punkt'] = $topMenu;
$menu[$topMenu['id']]['podpunkt'] = null;
} else {
$menu[$topMenu['parent']]['podpunkt'][] = $topMenu;
}        
} ?>

<?php // if ($_SERVER['REMOTE_ADDR'] == '78.140.9.206' || $_SERVER['REMOTE_ADDR'] == '46.161.158.155' || $_SERVER['REMOTE_ADDR'] == '88.204.72.104' || $_SERVER['REMOTE_ADDR'] == '95.170.159.81') { ?>
<div id="topmenumew" style="padding-top: 15px;">      
    <ul class="dropdownnew">
        <?php $i = 0; ?>
        <?php if (is_array($menu)) { foreach ($menu as $notParent) { ?> 
        <li class="<?php if ($i == 0) { ?>menu-li-first<?php } ?> dropdownnew-top">
            <a class="<?php if ($i == 0) { ?>menu-first<?php } ?> dropdownnew-top" href="/<?php echo $notParent['punkt']['url']; ?>/"><?php echo $notParent['punkt']['name']; ?></a>   
			<?php if(count($notParent['podpunkt']) > 0) { ?>
            <ul class="dropdownnew-inside">
                <div class="_nb-popup-tail"><i></i></div>
                <?php if (is_array($notParent['podpunkt'])) { foreach ($notParent['podpunkt'] as $parent) { ?>        
                <li>
                    <a href="/<?php echo $parent['url']; ?>/"><?php echo $parent['name']; ?></a>
                </li>
                <?php } } ?>
            </ul>
            <?php } ?>
        </li>
        <?php $i++; } } ?>
    </ul>
</div>
<br style="clear: both;"><br>
<?php /* } else { ?>
<ul class="dropdown">
    <?php $i = 0; ?>
    <?php foreach ($menu as $notParent) { ?> 
    <li class="<?php if ($i == 0) { ?>menu-li-first<?php } ?> dropdown-top">
        <a class="<?php if ($i == 0) { ?>menu-first<?php } ?> dropdown-top" href="/<?php echo $notParent['punkt']['url']; ?>/"><?php echo $notParent['punkt']['name']; ?></a>
        <?php  ?><ul class="dropdown-inside">
            <?php foreach ($notParent['podpunkt'] as $parent) { ?>        
            <li>
                <a href="/<?php echo $parent['url']; ?>/" style="border-top: 1px solid #cccccc;"><?php echo $parent['name']; ?></a>
            </li>
            <?php } ?>
        </ul> <?php  ?>
    </li>
    <?php $i++; } ?>
</ul>
<?php } */ ?>
