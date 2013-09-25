<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Language" content="en-us">
    <?php echo $this->Html->charset("windows-1252"); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
    echo $this->Html->meta(
        'keywords',
        'Unbrako, socket screws, fasteners, FLEXLOC, Durlok, Bumax, high strength fasteners, industrial fasteners, SPS, PCC, quality fasteners, E-CODE, nuts, bolts'
    );
    ?>
    <?php
    echo $this->Html->meta(
        'description',
        'Socket Screws and High Strength Industrial Fasteners'
    );
    ?>
    <?php
    echo $this->Html->meta(
        'description',
        'High Strength, High Quality Industrial Fasteners'
    );
    ?>
    <?php
    echo $this->Html->meta(
        'keywords',
        'Unbrako, socket screws, fasteners, FLEXLOC, Durlok, Bumax, high strength fasteners, industrial fasteners, high quality fasteners, nuts, bolts,
stainless steel fasteners, E CODE, LOT CODE, socket head cap screws'
    );
    ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <?php
    echo $this->Html->css('style');
    echo $this->Html->css('jquery.dropdown');
//    echo $this->Html->script('jquery');
    echo $this->Html->script('fade');
    echo $this->Html->script('toplinks');
    echo $this->Html->script('jquery.dropdown');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>
</head>
<body topmargin="10" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0"
      onLoad="openOffersDialog();">
<div align="center">
    <table border="0" cellpadding="0" style="border-collapse: collapse" width="1002" height="20">
        <tr>
            <td width="21" valign="top" background="/unbrako/img/leftbar.jpg"></td>
            <td width="960" valign="top">
                <div align="center" id="header_main">
                    <?php echo $this->element('header');?>
                </div>
                <div align="center" id="main_body">
                    <?php echo $this->Session->flash('success'); ?>
                    <?php echo $this->Session->flash('failure'); ?>

                    <?php echo $this->fetch('content'); ?>
                </div>
            </td>
            <td width="21" valign="top" background="/unbrako/img/rightbar.jpg"></td>
        </tr>
    </table>
</div>
<div align="center" id="footer_main">
    <?php echo $this->element('footer');?>
</div>
<a href="http://www.canadagoldbuyer.com" target="_blank" class="bottom_link">buy and sell gold</a> <a
    href="http://www.mxguarddog.com" target=_blank" class="white">anti spam</a>
<?php //echo $this->element('sql_dump'); ?>
</body>
</html>