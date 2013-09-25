<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to Unbrako Admin Panel</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<?php
echo $this->Html->css('admin_login');
?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#forgetmain').click(function(){
                $('.forgetmain').show();
            })
        })
    </script>
</head>

<body>
<header class="c-both">
    <?php echo $this->html->image('logo.jpg',array('width'=>150,'height'=>'34'));?>
    <h1 class="site-heading">Admin Panel</h1>
</header>
<section class="main-bdybg c-both">
    <article class="loginsec">
        <h3>Login</h3>
        <?php
        echo $this->Form->create('Users',array('controller'=>'users','action'=>'login','admin'=>true));
        ?>
        <div class="loginmain">
            <?php echo $this->Session->flash('success');?>
            <?php echo $this->Session->flash('failure');?>
            <br/>
            <label>Email</label>
            <?php echo $this->Form->input('User.e_mail',array('label'=>false,'div'=>false)); ?>
            <label>Password</label>
            <?php echo $this->Form->input('User.password',array('label'=>false,'div'=>false ,'type'=>'password','class'=>'forgerttxt')); ?>
            <?php echo $this->Form->end('submit.jpg');  ?>
            <p><a href="#" id="forgetmain">Can’t access your account?</a></p>
        </div>

        <div class="loginmain forgetmain" style="display: none;">
            <?php
            echo $this->Form->create('Users',array('controller'=>'users','action'=>'forgotPassword','admin'=>true));
            ?>
            <label>Enter your username to receive your password.</label>
            <?php echo $this->Form->input('User.uname',array('label'=>false,'div'=>false ,'class'=>'forgerttxt')); ?>
            <?php echo $this->Form->end('buttons/submit.jpg');  ?>
        </div>

    </article>
    <div class="c-both"></div>
</section>
<footer class="foter-mn c-both">Copyright © 2013 Global Pueblo Solutions. All rights reserved.</footer>
</body>
</html>
