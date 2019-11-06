<div class="container">
    <h1>IndexController/index</h1>
    <div class="box">

        <!-- jQuery 1.7.2+ or Zepto.js 1.0+ -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.1.5/dist/sweetalert2.all.min.js"></script>

        <style type="text/css">
            .grid-sizer,
            .grid-item { 
                width: 20%; 
            }
            .grid-item {
                height: 100%;
            }
            .grid-item--width2 {    
                width: 33%; 
                display: inline-block; 
            }
            .grid {
                position: relative;
                width: 100%;
                height: auto;
                margin-top: 200px;
            }
            .swal2-popup {
                height: 90vh !important;
            }
            .gallery-item {
                background-size: cover;
                background-position: center center;
                min-height: 180px;
                background-repeat: no-repeat;
                max-width: 60vw;
                max-height: 200px;
            }
            .gallery-img {
                max-width: 60vw;
            }
        </style>
        
        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>
        
        <div class="grid">
            <h2>Public Images:</h2>

            <?php foreach ($this->public_images as $p_image) { ?>

                <div class="grid-item gallery-item gitem_public grid-item--width2" style="background-image: url('<?php echo $p_image ?>')"></div>
                
            <?php } ?>

            <hr>

            <?php
                $user = UserModel::getUserDataByUserNameOrEmail(Session::get('user_name'));
                if(isset($user->user_id)) {
            ?>
                <h2>Own uploads:</h2>

            <?php
                    foreach ($this->private_images as $pr_image) {

            ?>
                        <div class="grid-item gallery-item gitem_private grid-item--width2" data-image-id="<?php echo $pr_image["id"] ?>" style="background-image: url('<?php echo $pr_image["src"] ?>"></div>
                        
            <?php        
                    }                
                } else {
                    return;
                }
            ?>

        </div>
        
            
    </div>
</div>
<script>
    $(".gitem_public").on("click",function() {
        let img = $(this).attr("style").replace("background-image: url('", "").replace("')", "");
        Swal.fire({
            //title: '<strong>HTML <u>example</u></strong>',
            //icon: 'info',
            width: window.innerWidth,
            html: `<img class="gallery-img" src="${img}">`,
            showCloseButton: false,
            showCancelButton: false,
            focusConfirm: false
        })
    })

    $(".gitem_private").click(function() {
        
        let img = $(this).attr("style").replace("background-image: url('", "").replace("')", "");
        Swal.fire({
            width: window.innerWidth,
            html: `<img class="gallery-img" src="${img}">`,
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText:
                '<strong>DELETE</strong>',
            confirmButtonColor: '#ff0000',
            cancelButtonColor: '#0000ff',
            confirmButtonAriaLabel: 'delete-img',
            cancelButtonText:
                '<strong>OKAY</strong>',
            cancelButtonAriaLabel: 'done'
        }).then((result) => {
            if (result.value) {
                $.post("/huge/index/delete",{
                    id: $(this).attr("data-image-id")
                })
                Swal.fire({
                    showCloseButton: true,
                    html: '<h1>Deleted!<br>Your file has been deleted.</h1>',
                    icon: 'success'
                }).then(() => {
                    location.reload();
                })
            }
        })
    })
</script>
