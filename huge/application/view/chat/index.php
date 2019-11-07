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


        
        <?php
            $user = UserModel::getUserDataByUserNameOrEmail(Session::get('user_name'));
            $chats = ChatModel::getChats($user->user_id);

            foreach ($chats as $chat) {
                $chat_id = $chat->id;
                $chat_host = UserModel::getPublicProfileOfUser($chat->chat_host);
                $chat_partner = UserModel::getPublicProfileOfUser($chat->chat_partner);
            }
        ?>

        <a class="goto-chat" href="#chat-<?php echo $chat_id ?>">
            <span>Chat between <?php echo $chat_host->user_name ?> & <?php echo $chat_partner->user_name ?></span> 
        </a>   

            
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
