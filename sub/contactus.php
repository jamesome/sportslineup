<? include "../inc/head_set.php"; ?>
        <? include "../inc/jquery_load.php"; ?>
    </head>
    <body>
<? include "../inc/header.php"; ?>

            <div id="container_wrap">
<? include "../inc/side_con.php"; ?>

                <div id="container">
                    <div id="main_con" class="contact">
                        <div class="sub_tit">
                            <h2>Contact us</h2>
                            <p>Thank you for taking the time to contact Sportslineup. Please provide the following information to help us direct your comment to the proper Sportslineup department.</p>
                        </div>
                        <ul class="input_list">
                            <li class="w100">
                                <label for="contact_name"><strong>Name</strong><span>*</span></label>
                                <input type="text" class="input style1" id="contact_name" />
                            </li>
                            <li class="w100">
                                <label for="contact_email"><strong>Email</strong><span>*</span></label>
                                <input type="text" class="input style1" id="contact_email" />
                            </li>
                            <li class="w100">
                                <label for="contact_con"><strong>Enter Your Comment</strong><span>*</span></label>
                                <textarea id="contact_con"></textarea>
                            </li>
                        </ul>

                        <div class="btns">
                            <button type="button" id="contact_us" class="btn"><img src="/images/btn_submit_comment.png" alt="Submit Comment" /></button>
                        </div>
                    </div>
                </div><!-- /container -->
            </div><!-- /container_wrap -->
<? include "../inc/footer.php"; ?>
        </div>
<? include "../inc/commonJsFile.php"; ?>
        <script type="text/javascript" src="../js/contactUs.js"></script>
    </body>
</html>
