<?php
date_default_timezone_set("Asia/Taipei");
session_start();
class DB
{
    protected $dsn = "mysql:host=localhost;charset=utf8;dbname=db02ex01";
    protected $pdo;
    protected $table;

    public function __construct($table)
    {
        $this->table = $table;
        $this->pdo = new PDO($this->dsn, 'root', '');
    }

    function all($array = '', $other = '')
    {
        $sql = "select * from `$this->table` ";
        $sql = $this->sql_all($sql, $array, $other);
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    function count($array = '', $other = '')
    {
        $sql = "select count(*) from `$this->table` ";
        $sql = $this->sql_all($sql, $array, $other);
        return $this->pdo->query($sql)->fetchColumn();
    }
    private function math($math, $col, $array = '', $other = '')
    {
        $sql = "select $math(`$col`) from `$this->table` ";
        $sql = $this->sql_all($sql, $array, $other);
        return $this->pdo->query($sql)->fetchColumn();
    }
    function sum($col, $array = '', $other = '')
    {
        return $this->math('sum', $col, $array, $other);
    }
    function max($col, $array = '', $other = '')
    {
        return $this->math('max', $col, $array, $other);
    }
    function min($col, $array = '', $other = '')
    {
        return $this->math('min', $col, $array, $other);
    }

    function find($id)
    {
        $sql = "select * from `$this->table` ";
        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .= " where " . join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .= " where `id` = '$id'";
        }
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function save($array)
    {
        if (isset($array['id'])) {
            $sql = "update `$this->table` set ";
            $tmp = $this->a2s($array);
            $sql .= join(",", $tmp);
            $sql .= " where `id` = '{$array['id']}'";
        } else {
            $sql = "insert into `$this->table` ";
            $cols = "(`" . join("`,`", array_keys($array)) . "`)";
            $vals = "('" . join("','", $array) . "')";
            $sql .= $cols . " values " . $vals;
        }
        return $this->pdo->exec($sql);
    }

    function del($id)
    {
        $sql = "delete from `$this->table` ";
        if (is_array($id)) {
            $tmp = $this->a2s($id);
            $sql .= " where " . join(" && ", $tmp);
        } else if (is_numeric($id)) {
            $sql .= " where `id` = '$id'";
        }
        return $this->pdo->exec($sql);
    }

    function q($sql)
    {
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    private function a2s($array)
    {
        foreach ($array as $col => $value) {
            $tmp[] = "`$col` = '$value'";
        }
        return $tmp;
    }
    private function sql_all($sql, $array, $other)
    {
        if (isset($this->table) && !empty($this->table)) {
            if (is_array($array)) {
                if (!empty($array)) {
                    $tmp = $this->a2s($array);
                    $sql .= " where " . join(" && ", $tmp);
                }
            } else {
                $sql .= " $array ";
            }
            $sql .= $other;
            return $sql;
        }
    }
}
function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
function to($url)
{
    header("location:$url");
}

$Total = new DB('total');
$User = new DB('user');
$News = new DB('news');
$Que = new DB('que');
$Log = new DB('log');


if (!isset($_SESSION['visited'])) {
    if ($Total->count(['date' => date('Y-m-d')]) > 0) {
        $total = $Total->find(['date' => date('Y-m-d')]);
        $total['total']++;
        $Total->save($total);
    } else {
        $Total->save(['date' => date('Y-m-d'), 'total' => 1]);
    }
    $_SESSION['visited'] = 1;
}
