<? include "inc/head_set.php"; ?>
<? include "../inc/jquery_load.php"; ?>
    </head>
    <body>
        <? include "inc/header.php"; ?>
                    <div id="main_con" class="board">
                        <div class="con_tit">
                            <h2>Soccer</h2>
                            <div class="path">
                                <img src="/images/admin/icon_home.png" alt="home" />
                                <span>&gt;</span>
                                News
                                <span>&gt;</span>
                                <b>Soccer</b>
                            </div>
                        </div><!-- /con_tit -->

                        <div class="write">
                            <table>
                                <colgroup>
                                    <col width="45" />
                                    <col width="" />
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <th>Title</th>
                                        <td><input type="text" class="write_input" /></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><textarea></textarea></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="date_select">
                                <strong>Published Date</strong>
                                <select id="pbsh_day">
                                    <option value="" selected="selected">Day</option>
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
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
                                <select id="pbsh_month">
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
                                <select id="pbsh_year">
                                    <option value="" selected="selected">Year</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                </select>
                            </p>

                            <div class="write_btns">
                                <button type="submit" class="write_btn type_red">Write</button>
                                <a href="#" class="write_btn type_gray">Cancel</a>
                            </div>
                        </div>
                    </div><!-- /main_con -->
<? include "inc/footer.php"; ?>
<? include "../inc/commonJsFile.php"; ?>
        <script type="text/javascript" src="../js/adminWrite.js"></script>
    </body>
</html>
