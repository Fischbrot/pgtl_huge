<div class="container">
    <h1>IndexController/index</h1>
    <div class="box">
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

        <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <!-- Magnific Popup core JS file -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
        <style type="text/css">
        .grid-sizer,
        .grid-item { width: 20%; }
        /* 2 columns */
        .grid-item--width2 {    width: 33%; display: inline-block; }
        </style>
        
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        
        <div class="grid" style="
            position: relative;
            width: 100%;
            height: auto;
            margin-top: 200px;
        ">
            <h2>Public Images:</h2>

            <?php foreach ($this->public_images as $p_image) { ?>


            
                    <div class="grid-item grid-item--width2" style="height: 100%; background-image: url('<?php echo $p_image ?>'); background-size: cover; background-position: center center; min-height: 180px;background-repeat: no-repeat;"></div>
                
            <?php } ?>
            <hr>
            <?php
                $user = UserModel::getUserDataByUserNameOrEmail(Session::get('user_name'));
                if(isset($user->user_id)) {
            ?>
                <?php foreach ($this->private_images as $pr_image) { ?>
                    <h2>Own uploads:</h2>
                    <div class="grid-item grid-item--width2" style="height: 100%; background-image: url('<?php echo $pr_image ?>'); background-size: cover; background-position: center center; min-height: 180px;background-repeat: no-repeat;"></div>
                <?php } ?>
            <?php
                } else {
                    return;
                }
            ?>
        </div>
        
            
    </div>
</div>
