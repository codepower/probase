 
 
 <?php
header("Content-Type:text/html;charset=utf8");
require_once('mysqlidb.php');
const SHOW_TABLE_STATUS="SHOW TABLE STATUS";
$sql="SELECT
`COLUMN_NAME` as field,
`COLUMN_COMMENT` as label,
`COLUMN_DEFAULT` as `default`,
`DATA_TYPE` as `type`,
`CHARACTER_MAXIMUM_LENGTH` as  `strlen`,
`NUMERIC_PRECISION` as `intlen`,
`NUMERIC_SCALE` as `declen`,
`COLUMN_KEY` as `ckey`,
`EXTRA` as `extra`,
`COLUMN_TYPE` as ctype
FROM information_schema.`COLUMNS` where TABLE_SCHEMA='%s' AND TABLE_NAME = '%s'";
$dbinfo=array(
    'hostname'=>'localhost',
    'username'=>'root',
    'password'=>'root',
    'database'=>'appbase'
);
$db=new MYSQLIDB($dbinfo);
$tableList=$db->query(SHOW_TABLE_STATUS);
//var_dump($tableList); 
foreach ($tableList as $table) {
    $result=$db->query(sprintf($sql,$dbinfo['database'],$table['Name']));
    $modelName=str_replace('ab_','',$table['Name']);
    $file=fopen('model/'.$modelName.'.php','w+');
    fwrite($file,"<?php \r\nclass ".ucfirst($modelName)."Model extends MysqliModel{\r\n\tprivate \$tableName='".$modelName."';\r\n\tprivate function getFieldInfo(){\r\n\t\treturn [\r\n\t\t");
    $i=0;
    //表中字段遍历
    foreach ($result as &$field) {
        if($i>0) {
            fwrite($file,",\r\n\t\t");
        }
        fwrite($file,"'".$field['field']."'=>[\r\n\t\t\t");
        $j=0;
        foreach ($field as $key=>$item) {
            switch($key){
                case 'label':{
                    if(empty($item)&&$field['ckey']=='PRI')  $item='主键';
                    if(empty($item)) $item=$field['field'];
                    fwrite($file,"'$key'=>'$item'");
                    break;
                }
                case 'default':{
                    if($item===''||$item===0||(!empty($item)))
                    fwrite($file,",\r\n\t\t\t'require'=>true");
                    break;
                }
                case 'intlen':{
                    if($item){
                        if(strpos($field['ctype'],'unsigned')!==false){
                            $max=pow(10,$item)-1;
                            $min=0;
                        }else{
                            $max=pow(10,$item-1)-1;
                            $min=0-$max;
                        }
                        fwrite($file,",\r\n\t\t\t'interger'=>[$min,$max]");
                        break;
                    }
                }
                case 'declen':{
                    if($item){
                        $max=pow(10,$item)-1;
                        $min=0;
                        fwrite($file,",\r\n\t\t\t'decimal'=>[$min,$max]");
                        break;
                    }
                }
                case 'strlen':{
                    if($item){
                        fwrite($file,",\r\n\t\t\t'string'=>[0,$item]");
                        break;
                    }
                }
            }
        }
        fwrite($file,"\r\n\t\t]");
        $i++;
    }
    fwrite($file,"\r\n\t\t];\r\n\t}\r\n}");
}
echo '创建成功';