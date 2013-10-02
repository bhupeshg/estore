<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Language" content="en-us">
    <?php echo $this->Html->charset("utf-8"); ?>
    <title>
        Welcome to Unbrako Admin Panel
    </title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <?php
    echo $this->Html->css('admin');
    echo $this->Html->script('ddaccordion');

    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    ?>

    <script type="text/javascript">
        ddaccordion.init({
            headerclass: "submenuheader", //Shared CSS class name of headers group
            contentclass: "submenu", //Shared CSS class name of contents group
            revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
            mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
            collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
            defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
            onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
            animatedefault: false, //Should contents open by default be animated into view?
            persiststate: true, //persist state of opened contents within browser session?
            toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
            togglehtml: ["suffix", "<img src='../img/plus.gif' class='statusicon' />", "<img src='../img/minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
            animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
            oninit: function (headers, expandedindices) { //custom code to run when headers have initalized
                //do nothing
            },
            onopenclose: function (header, index, state, isuseractivated) { //custom code to run whenever a header is opened or closed
                //do nothing
            }
        })
    </script>
</head>

<body>
<header class="c-both">
    <?php echo $this->Html->image('logo.jpg',array('width'=>150,'height'=>'34'));?>

    <h1 class="site-heading">Admin Panel</h1>
</header>
<section class="main-bdybg c-both">
    <nav class="nav">
        <div class="sidebarmenu">
            <a class="menuitem submenuheader" href="">Manage Customers</a>
            <div class="submenu">
                <ul>
                    <!--li><?php //echo $this->Html->link('Create Customer',array('controller'=>'users','action'=>'create','admin'=>true))?></li-->
                    <li><?php echo $this->Html->link('View Customers',array('controller'=>'users','action'=>'listCustomers','admin'=>true))?></li>
                </ul>
            </div>
            <?php echo $this->Html->link('Change Password',array('controller'=>'users','action'=>'changePassword','admin'=>true),array('class'=>'menuitem'))?>
            <?php echo $this->Html->link('Logout',array('controller'=>'users','action'=>'logout','admin'=>true),array('class'=>'menuitem'))?>
        </div>
    </nav>
    <article class="rightpenel">
        <?php echo $this->fetch('content'); ?>
    </article>
</section>
<footer class="foter-mn c-both">Copyright © 2013 Global Pueblo Solutions. All rights reserved.</footer>
<?php //echo $this->element('sql_dump'); ?>
</body>
</html>