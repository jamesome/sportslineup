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

                        <div class="list admin_list">
                            <div class="search_wrap">
                                <div class="left_con">
                                    <select>
                                        <option value="Soccer">Soccer</option>
                                        <option value="Baseball">Baseball</option>
                                        <option value="Basketball">Basketball</option>
                                        <option value="Volleyball">Volleyball</option>
                                        <option value="Hockey">Hockey</option>
                                    </select>
                                    <button class="admin_btn type_g">Move</button>
                                </div>
                                <div class="right_con">
                                    <select>
                                        <option value="Title + Contents">Title + Contents</option>
                                        <option value="Title">Title</option>
                                        <option value="Contents">Contents</option>
                                    </select>
                                    <input type="text" class="search_input" />
                                    <button class="admin_btn type_r">Search</button>
                                </div>
                            </div><!-- /search_wrap -->
                            <div class="list_table">
                                <table>
                                    <colgroup>
                                        <col width="70" />
                                        <col width="" />
                                        <col width="130" />
                                        <col width="110" />
                                        <col width="80" />
                                        <col width="75" />
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" onClick="adminList.checkBox();" class="selectall" /></th>
                                            <th>News Title</th>
                                            <th>Published Date</th>
                                            <th>Status</th>
                                            <th>Views</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      
                                    </tbody>
                                </table>
                            </div>

                            <div class="list_btns">
                                <button class="btn_delete">Delete selected</button>
                                <div class="paging">

                                </div>
                                <a href="/admin/board_write.php" class="btn_write">Write</a>
                            </div>
                        </div>
                    </div><!-- /main_con -->
<? include "inc/footer.php"; ?>
<? include "../inc/commonJsFile.php"; ?>
        <script type="text/javascript" src="../js/admin.js"></script>
        <script type="text/javascript" src="../js/adminList.js"></script>
        <script type="text/javascript" src="../js/paging.js"></script>
        <script>
            var g_page_max = '10';
            var news_type = "<?= $_GET['type'] ?>";
            var $check_box = $('.check_box');
        </script>
    </body>
</html>
