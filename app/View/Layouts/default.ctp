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
    <script type="text/javascript">
    function show_overlay()
    {
      if($(".black_overlay").length != '0')
      {
            
          if (window.innerHeight) 
          {// Firefox
              if(window.scrollMaxY)
              {
                  yWithScroll = window.innerHeight + window.scrollMaxY;
                  xWithScroll = window.innerWidth + window.scrollMaxX;
              }
              else
              {
                  yWithScroll = window.innerHeight;
                  xWithScroll = window.innerWidth ;
              }
          } 
          else if (document.body.scrollHeight > document.body.offsetHeight)
          { // all but Explorer Mac
              yWithScroll = document.body.scrollHeight;
              xWithScroll = document.body.scrollWidth;
          }
          else 
          { // works in Explorer 6 Strict, Mozilla (not FF) and Safari
              yWithScroll = document.body.offsetHeight;
              xWithScroll = document.body.offsetWidth;
          }
          
          $(".black_overlay").css({'height':$(document).height(),'width':$(document).width()});
          $(".black_overlay").show();
              
      }
    }
    
    function hidePopUp()
    {
        $(".black_overlay").hide();
    }    
    $(document).ready(function () {
        
        $( document ).ajaxStart(function() {
            
            show_overlay();
        });
        $( document ).ajaxComplete(function() {
            
            hidePopUp();
        });
        
    });
    </script>
</head>
<body topmargin="10" leftmargin="0" rightmargin="0" bottommargin="0" marginwidth="0" marginheight="0">
<div class="black_overlay">
  <div id="black_overlay_loading"><img src="/jkt/estore/img/ajax-loader.gif" alt="" /></div>
</div>
<div align="center">
    <table border="0" cellpadding="0" style="border-collapse: collapse" width="1002" height="20">
        <tr>
            <td width="21" valign="top" class="bg_left"></td>
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
            <td width="21" valign="top" class="bg_right"></td>
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