<? include "../inc/head_set.php"; ?>
        <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.min.css"/>
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
                <h2><img src="/images/join_title.png" alt="Create an account." /></h2>

                <ul>
                    <li class="w100">
                        <label for="join_id"><strong>ID</strong><span>*</span></label>
                        <input type="text" class="input style1" id="join_id" />
                    </li>
                    <li class="w100">
                        <label for="join_pass1"><strong>Password</strong><span>*</span></label>
                        <input type="text" class="input style1" id="join_pass1" />
                    </li>
                    <li class="w100">
                        <label for="join_pass2"><strong>Password confirmation</strong><span>*</span></label>
                        <input type="text" class="input style1" id="join_pass2" />
                    </li>
                    <li>
                        <label><strong>Mobile Number</strong><span>*</span></label>
                        <p class="input_box">
                            <select>
                                <option>+89</option>
                                <option>+89</option>
                                <option>+89</option>
                            </select>
                            <input type="text" class="input" style="width:172px;" />
                            <button type="button" class="box_btn">Verify</button>
                        </p>
                    </li>
                    <li class="right">
                        <label><strong>Verification Code</strong><span>*</span></label>
                        <p class="input_box">
                            <input type="text" class="input" style="width:239px;" />
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
                    <button type="submit" class="btn"><img src="/images/btn_join.png" alt="Create an account" /></button>
                </div>
            </div>
        </div>
        <script type="text/javascript" scr="//cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
    </body>
</html>
