<?php
header("Content-Type:text/html;charset=utf8");
$dbinfo=[
    'hostname'=>'dphost',
    'username'=>'dbuser',
    'password'=>'dbpassword',
    'database'=>'dbname',
    'tbprefix'=>'tablePrefix'
];
/*****************************
数据库访问类(MySQLi版)
******************************/
class MYSQLIDB{
    //当前类的实例
    private static $instance;
    //数据库初始化
    private static $connection;
    //最后一次执行的sql语句
    private static $sql;
    private static $prefix;

    private function __construct($dbinfo){
        if(empty($dbinfo['port'])){
        	$dbinfo['port']=3306;
        }
        self::$connection=new \mysqli($dbinfo['hostname'],$dbinfo['username'],$dbinfo['password'],$dbinfo['database'],$dbinfo['port']);
        self::$prefix=in_array($dbinfo['database'],['information_schema','perfmenance_schema'])?'':$dbinfo['tbprefix'];
        $errno=self::$connection->connect_errno;
        $error=self::$connection->connect_error;
        if($errno){
            $errorInfo="<br/><h1>Error:Could not make a database link ($errno)[$error]</h1><br/>";
            throw  new \ErrorException($errorInfo, 1);
        }
        self::$connection->set_charset("utf8");
    }
    private function __clone(){}

    /*禁止外部序列化对象*/
    private function __sleep(){}

    /*禁止外部反序列化对象*/
    private function __wakeup(){}

    //单例模式初始化
    public static  function getInstance($dbinfo){
        if(!self::$instance instanceof self)
            self::$instance=new self($dbinfo);
        return self::$instance;
    }

    //执行SQL查询返回关联数组
    public function query($sql){
        $result=self::$connection->query($sql);
        self::$sql=$sql;
        if($result!==false){
            $record=array();
            $list=array();
            while($record=$result->fetch_assoc()){
                $list[]=$record;
            }
            return $list;
        }else{
            echo self::$sql;
            echo "<br/>ERROR MESSAGE:".self::$connection->error;
            return false;
        }
    }
}
$db=MYSQLIDB::getInstance($dbinfo);
$tableList=$db->query('SHOW TABLE STATUS');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>数据字典</title>
    <style type="text/css">

        html {
            font-family: sans-serif;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            background-color: #ecf0f3;
        }

        body {
            margin: 0;
            font-size: 14px;
        }
        .box-1080{
            margin:0 auto;
            width:1080px;
        }
        .box-1080 h1{
            text-align:center;
        }
        .box-1080 h3{
            padding-left:1em;
            font-weight:normal;
            color:#fff;
            background-color:#1f8dd6;
            box-shadow: 1px 1px 3px #999;
            padding:0.6em;
            margin-top:2em;
            margin-bottom:0.5em;
            border-radius:2px;
        }
        table {
            empty-cells: show;
            border-spacing: 0;
            background-color: #fff;
            overflow: hidden;
            width: 100%;
            border:1px solid #f2f2f2;
            box-shadow:1px 1px 3px #ccc;
        }

        table td {
            border-width: 0 0 0 1px;
            font-size: inherit;
            margin: 0;
            overflow: visible;
            padding-top:0.7em;
            padding-bottom:0.7em;
            padding-left:0.8em;
            padding-right:0.8em;
            background-color:transparent;
            border-bottom: 1px solid #f2f2f2;
        }

        table th {
            border-width: 0 0 0 1px;
            font-size: inherit;
            margin: 0;
            overflow: visible;
            padding: .5em .4em;
            line-height: 2em;
            background-color:#f9f9fb;
            border-bottom: 1px solid #eee;
            color:#1f8dd6;
        }
        p{text-align:right;padding-top:3em;}
        a{color:#1f8dd6;text-decoration:none;}
        td>strong{
            color:#000;
        }
        table td:first-child,
        table th:first-child {
            border-left-width: 0
        }
    </style>
</head>
<body>
<div class="box-1080">
    <h1><?=$dbinfo['database'];?>数据库的数据字典(共<?=count($tableList);?>张表)</h1>
    <?php foreach ($tableList as $key => $table):?>
    <h3><?=$table['Name'];?>(<?=$table['Comment'];?>)</h3>
    <table>
        <tr>
            <th width="100">序号</th>
            <th width="200">字段名</th>
            <th width="200">字段类型</th>
            <th width="100">允许为空</th>
            <th width="100">默认值</th>
            <th>备注</th>
        </tr>
    <?php
    $sql="SHOW FULL FIELDS FROM `{$table['Name']}`";
    $fields=$db->query($sql);
    foreach ($fields as $rk => $row):?>
        <tr>
            <td align="center"><strong><?= $rk+1 ?></strong></td>
            <td><?=$row['Field'];?></td>
            <td><strong><?= $row['Type'] ?></strong></td>
            <td align="center"><?= $row['Null'] ?></td>
            <td align="center"><?= $row['Default'] ?></td>
            <td ><?= $row['Comment'] ?></td>
        </tr>
    <?php endforeach;?>
</table>
<?php endforeach;?>
<p>版权所有:<a href="https://github.com/codetown">Leo Liu,codetown@163.com</a></p>
</div>
</body>
</html>
