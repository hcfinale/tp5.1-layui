<?php
namespace app\index\controller;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use think\Controller;

class Live extends Controller{
    public function ceshi(){
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        $writer = new Xlsx($spreadsheet);
        $writer->save('C:\Users\Administrator\Desktop\hello world.xlsx');
    }
    // 读取数据
    public function readExcel(){
        $name = './one.xlsx';
        $res = $this->GetExcelData($name);
        dump($res);
    }
    /**
     * @param string $filename
     * @param int $startLine excel 开始的位置row的开始行数
     * @param array $width  自己想把，找个测试的看看
     * @return array
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Reader\Exception
     */
    public function GetExcelData($filename='one.xlsx',$startLine=2,$width=['nickname'=>'B','p_nickname'=>'C','phone'=>'D','type'=>'A']){
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        switch ($extension){
            case 'xlsx':
                $objReader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $objExcel = $objReader ->load($filename);
                break;
            case 'xls':
                $objReader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                $objExcel = $objReader ->load($filename);
                break;
            case 'csv':
                $PHPReader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                //默认输入字符集
                $PHPReader->setInputEncoding('GBK');
                //默认的分隔符
                $PHPReader->setDelimiter(',');
                //载入文件
                $objExcel = $PHPReader->load($filename);
                break;
        }
        $highestRow = $objExcel ->getSheet(0)->getHighestRow(); // 取得总行数
        $getvalue=$objExcel->getActiveSheet();
        $data=[];
        for($j=$startLine;$j<=(int)$highestRow;$j++){
            $value=[];
            foreach ($width as $key=>$val){
                if($v=$getvalue->getCell($val.$j)->getValue()){
                    $value[$key]=$v;
                } else {
                    $value[$key]='';
                }
            }
            if($value) $data[]=$value;
        }
        return $data;
    }
}