                <div id="side_con">
                    <?php if (!get_session('ses_user_idx')) { ?>
                    <div id="login_box">
                        <h2>Login</h2>
                        <p>Please, login into your account.</p>
                        <div class="login_input">
                            <p><input type="text" id="login_id" placeholder="ID" /></p>
                            <p><input type="password" id="login_pw" placeholder="Password" /></p>
                        </div>
                        <a href="/sub/join.php" class="sign_up"><img src="/images/signup.png" alt="Sign up" /></a>
                        <button type="button" id="login"><img src="/images/login_btn.jpg" alt="Create an account" /></button>
                    </div>
                    <?php } else { ?>
                    <div id="login_box">
                        <h2>로그인 됐다.</h2>
                    </div>
                    <?php } ?>
                    <div id="game_zone">
                    </div>
                    <div id="right_banner">
                        <a href="#"><img src="/images/test_ad.png" alt="" /></a>
                    </div>
                </div><!-- /side_con -->
