<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/6 0006
 * Time: 下午 3:23
 */
namespace Org\Util;


class ExcelToArray
{
    public function __construct()
    {
        Vendor("PHPExcel.Classes.PHPExcel");//引入phpexcel类(注意你自己的路径)
        Vendor("PHPExcel.Classes.PHPExcel.IOFactory");
    }

    public function read($filename, $file_type)
    {
        if (strtolower($file_type) == 'xls')//判断excel表类型为2003还是2007
        {
            Vendor("PHPExcel.Classes.Reader.Excel5");
            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
        } elseif (strtolower($file_type) == 'xlsx') {
            Vendor("PHPExcel.Classes.Reader.Excel2007");
            $objReader = \PHPExcel_IOFactory::createReader('Excel2007');
        } else {
            return false;
        }
        $objReader->setReadDataOnly(true);
        $objPHPExcel = $objReader->load($filename);
        $objWorksheet = $objPHPExcel->getActiveSheet();
        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();
        $highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
        $excelData = array();
        $tranArray = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M'];
        for ($row = 2; $row <= $highestRow; $row++) {
            for ($col = 0; $col < $highestColumnIndex; $col++) {
                if ($col == 0) { //转换时间格式
                    $excelData[$row][] = gmdate("Y-m-d", \PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("$tranArray[$col]$row")->getValue()));
                } else if ($col == 1 || $col == 2) {
                    $excelData[$row][] = gmdate("H:i", \PHPExcel_Shared_Date::ExcelToPHP($objPHPExcel->getActiveSheet()->getCell("$tranArray[$col]$row")->getValue()));
                } else {
                    $excelData[$row][] = (string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                }
            }
        }
        return $excelData;
    }
}