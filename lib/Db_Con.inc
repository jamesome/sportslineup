<?php
    class DB_Con {

        private $con;
        private $stmt;
        private $result;
        private $array;
        private $total;

        protected $Host;
        protected $DBUser;
        protected $DBPass;
        protected $Database;

        function __construct()
        {
            global $com;

            if ($com['dev_mode'] == 'L') {
                $this->host_real();
            } else {
                $this->host_dev();
            }

            $this->Connect();
        }

        function host_real()
        {
            $this->Host = '';
            $this->DBUser = '';
            $this->DBPass = '';
            $this->Database = '';
        }

        function host_dev()
        {
            $this->Host = 'hjj.score888.com:5903';
            // $this->Host = '192.168.0.152';
            $this->DBUser = 'hol1000';
            $this->DBPass = 'ghfcjselqldb';
            $this->Database = '_hol_test';
        }

        function Connect()
        {
            $this->con = mysqli_connect("$this->Host","$this->DBUser","$this->DBPass","$this->Database");
            if (mysqli_connect_errno()) {
                print(sprintf("데이터베이스 연결 실패[%s]", iconv("EUC-KR", "UTF-8", mysqli_connect_error()) )."::". mysqli_connect_errno());
                throw new Exception( sprintf("데이터베이스 연결 실패[%s]", iconv("EUC-KR", "UTF-8", mysqli_connect_error()) ), mysqli_connect_errno());
                exit;
            }
            if (@$this->con) {
                mysqli_query($this->con, "set names utf8");
                //mysql_select_db("$Database");
            }
        }

        function query($qry, $wlog=true)
        {
            global $root_path, $com;

            if ($wlog) {
                $filepath = $root_path."/data_logs/sql/".date("YmdH",time())."_log";
                $fp = @fopen($filepath, "a+");
                if ($fp) {
                    fwrite($fp, '['.date("H:i:s",time()).'] '.$qry.";\n");
                    fclose($fp);

                    @chmod($filepath, 0777);
                }
            }

            if (!$this->is_dbcon()) {$this->Connect();}
            mysqli_multi_query($this->con, "$qry");
            $this->stmt = mysqli_store_result($this->con);

            // if(!$this->stmt){
            //     if($com['dev_mode'] != 'L'){
            //         echo "$qry [".mysqli_error($this->con)."]";
            //     }
            //     die("Don't MySQL Query");
            // }
            return $this->stmt;
        }

        function total()
        {
           $this->total = mysqli_num_rows($this->stmt);
           return $this->total;
        }

        function fetch($st='')
        {
            $st = $st?$st:$this->stmt;

            if ($st) {
                $this->array = mysqli_fetch_array($st, MYSQLI_ASSOC);
                //mysqli_free_result($st);
                return $this->array;
            }
        }

        function row($st='')
        {
            $st = $st?$st:$this->stmt;

            if ($st) {
                $this->array = mysqli_fetch_row($st);
                return $this->array;
            }
        }

        function affected()
        {
            $rows = mysqli_affected_rows($this->con);
            return $rows;
        }

        function lastid()
        {
            $this->stmt = $this->query("select last_insert_id() as last_id");
            $row = $this->fetch($this->stmt);
            return $row['last_id'];
        }

        function mres($str)
        {
            //$str = mysqli_real_escape_string($this->con, $str);
            $str = addslashes($str);

            return $str;
        }

        function next_result()
        {
            if (is_object($this->con)) {
                if (mysqli_more_results($this->con)) {
                    if (mysqli_next_result($this->con)) {
                        $this->stmt = mysqli_store_result($this->con);
                        return $this->stmt;
                    }
                }
            }
        }

        function close()
        {
            // mysqli_close($this->con);
            if ($this->con) {
                unset($this->con);
            }
        }

        function is_dbcon()
        {
          return is_object( $this->con );
        }

        function __destruct()
        {
            $this->close();
            unset($this);
        }
    }
?>
