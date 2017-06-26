<? include "../inc/head_set.php"; ?>
        <? include "../inc/jquery_load.php"; ?>
    </head>
    <body>
        <div id="wrapper" class="join">
            <div id="join_header">
                <div class="header_inner">
                    <a href="javascript:history.back();" class="btn_back">Back to the Sportlineup</a>
                    <h1><a href="/"><img src="/images/join_logo.png" alt="sports lineup" /></a></h1>
                </div>
            </div>

            <div id="join_content">
                <h2><img src="/images/join_title.png" alt="Create an account" /></h2>

                <ul class="input_list">
                    <li class="w100">
                        <label for="join_id"><strong>ID</strong><span>*</span></label>
                        <input type="text" class="input style1" id="join_id" />
                    </li>
                    <li class="w100">
                        <label for="join_pass1"><strong>Password</strong><span>*</span></label>
                        <input type="password" class="input style1" id="join_pass1" />
                    </li>
                    <li class="w100">
                        <label for="join_pass2"><strong>Password confirmation</strong><span>*</span></label>
                        <input type="password" class="input style1" id="join_pass2" />
                    </li>
                    <li>
                        <label><strong>Mobile Number</strong><span>*</span></label>
                        <p class="input_box">
                            <select>
                                <option value="87">+87</option>
                                <option value="88">+88</option>
                                <option value="89">+89</option>
                            </select>
                            <input type="text" class="input join_mobile" style="width:172px;" />
                            <button type="button" class="box_btn">Verify</button>
                        </p>
                    </li>
                    <li class="right">
                        <label><strong>Verification Code</strong><span>*</span></label>
                        <p class="input_box">
                            <input type="text" class="input verification_code" style="width:239px;" />
                            <button type="button" class="box_btn">Confirm</button>
                        </p>
                    </li>
                    <li>
                        <label for="join_card"><strong>Card Number</strong></label>
                        <input type="text" class="input style1" id="join_card" />
                    </li>
                    <li class="right">
                        <label><strong>Explration Date</strong></label>
                        <p class="select_box">
                            <input type="text" id="set_month" placeholder="Month" class="input" />
                            <input type="text" id="set_year" placeholder="Year" class="input" />
                        </p>
                    </li>
                    <li>
                        <label for="join_fnc"><strong>First Name on Card</strong></label>
                        <input type="text" class="input style1" id="join_fnc" />
                    </li>
                    <li class="right">
                        <label for="join_lnc"><strong>Last Name on Card</strong></label>
                        <input type="text" class="input style1" id="join_lnc" />
                    </li>
                </ul>

                <div class="btns">
                    <button type="button" id="sign_up" class="btn"><img src="/images/btn_join.png" alt="Create an account" /></button>
                </div>
            </div>
        </div>
<? include "../inc/commonJsFile.php"; ?>
        <script type="text/javascript" src="../js/signUp.js"></script>
    </body>
</html>
