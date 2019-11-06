<div class="container">
    <h1>Upload image!</h1>
    <div class="box">

        <!-- echo out the system feedback (error and success messages) -->
        <?php $this->renderFeedbackMessages(); ?>

        <form action="upload" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">
            <br>
            Not Public:
            <input type="checkbox" name="hide" id="hide">
            <br><br>
            <input type="submit" value="Upload Image" name="submit">
        </form>

    </div>
</div>
