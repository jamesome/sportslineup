<?php
    class Js_load
    {
        function load_JqueryCdn()
        {
            return $this->jqueryCdn();
        }

        protected function jqueryCdn()
        {
            $result = '';

            $result = '<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>'."\n";

            return $result;
        }

    }
?>
