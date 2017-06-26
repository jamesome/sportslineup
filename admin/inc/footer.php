                </div>
            </div>
            <div id="main_footer">
                <p class="copyright">COPYRIGHT &copy; SPORTSLINEUP. ALL RIGHTS RESERVED.</p>
            </div>
            <script>
                var gnb_inner = document.getElementById('gnb_inner'),
                    main_footer = document.getElementById('main_footer');

                function gnb_height(){
                    var _gnb_height = ($(window).height() - main_footer.clientHeight - 1) + 'px'
                    gnb_inner.style.minHeight = _gnb_height;
                }

                gnb_height();
                $(window).resize(function(){
                    gnb_height();
                });
            </script>
        </div>
    </body>
</html>