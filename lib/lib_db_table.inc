<?php
    function call_procedure_data($fn, $arr)
    {
        global $dbcon;

        if ($arr != NULL) {
            if (!is_array($arr)) {
                $arr[0] = $arr;
            }

            foreach ($arr as $k=>$v) {
                if (is_string($v) || is_null($v)) {
                    $arr[$k] = '"'.$v.'"';
                }
            }

            $arr = implode(',', $arr);
        }

        $sql = " CALL $fn ($arr)";

        $dbcon->query($sql);
        $row = $dbcon->fetch();

        while($st = $dbcon->next_result()){
            //$row = $dbcon->fetch($st);
            //print_r($row);
        }

        return $row;
    }

    function call_procedure_list($fn, $arr)
    {
        global $dbcon;

        if ($arr != NULL) {
            if (!is_array($arr)) {
                $arr[0] = $arr;
            }

            foreach ($arr as $k=>$v) {
                if (is_string($v) || is_null($v)) {
                    $arr[$k] = '"'.$v.'"';
                }
            }

            $arr = implode(',', $arr);
        }

        $sql = " CALL $fn ($arr)";

        $dbcon->query($sql);
        $i=0;
        $ret = array();

        while ($row = $dbcon->fetch()) {
            $ret[$i++] = $row;
        }

        while ($st = $dbcon->next_result()) {
            //$row = $dbcon->fetch($st);
            //print_r($row);
        }

        return $ret;
    }

    function get_table_data($table, $sel, $qry)
    {
        global $dbcon;

        $sql = " SELECT $sel FROM $table where $qry limit 1";
        $dbcon->query($sql);
        $row = $dbcon->fetch();

        return $row;
    }

    function get_table_list($table, $sel, $qry, $skip_num=0, $list_max=0)
    {
        global $dbcon;

        $LIMIT_sql = '';

        if ($list_max) {
            $LIMIT_sql = "LIMIT $skip_num, $list_max";
        }

        $sql = " SELECT $sel FROM $table where $qry $LIMIT_sql ";
        $dbcon->query($sql);
        $i=0;
        $ret = array();

        while ($row = $dbcon->fetch()) {
            $ret[$i++] = $row;
        }

        return $ret;
    }

    function get_table_one_list( $table, $sel, $qry, $skip_num=0, $list_max=0)
    {
        global $dbcon;

        $LIMIT_sql = '';

        if ($list_max) {
            $LIMIT_sql = "LIMIT $skip_num, $list_max";
        }

        $sql = " SELECT $sel FROM $table where $qry $LIMIT_sql ";
        $dbcon->query($sql);
        $i=0;
        $ret = array();

        while ($row = $dbcon->row()) {
            $ret[$i++] = $row[0];
        }

        return $ret;
    }

    function get_table_tcount($table, $qry, $groupby='')
    {
        global $dbcon;

        if ($groupby) {
            $sql = " SELECT count(distinct $groupby) as cnt FROM $table where $qry ";
        } else {
            $sql = " SELECT count(*) as cnt FROM $table where $qry ";
        }

        $dbcon->query($sql);
        $row = $dbcon->fetch();

        return $row['cnt'];
    }
    /// table 정보

    function set_table_insert($table, $qry)
    {
        global $dbcon;

        $sql = " INSERT INTO $table SET $qry ";
        $dbcon->query($sql);
        $idx = $dbcon->lastid();

        return $idx;
    }

    function set_table_update($table, $qry, $where='')
    {
        global $dbcon;

        $sql = " UPDATE $table SET $qry where $where ";
        $ret = $dbcon->query($sql);

        return $ret;
    }

    function set_table_delete($table, $where='')
    {
        global $dbcon;

        $sql = " DELETE FROM $table where $where ";
        $ret = $dbcon->query($sql);

        return $ret;
    }

?>
