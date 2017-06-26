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
                            <select id="set_month">
                                <option value="" selected="selected">Month</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                            <select id="set_year">
                                <option value="" selected="selected">Year</option>
                                <option value="2017">2017</option>
                                <option value="2015">2015</option>
                                <option value="1988">1988</option>
                                <option value="1980">1980</option>
                                <option value="1979">1979</option>
                            </select>
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
