<?php
$con=mysqli_connect("localhost", "root", "", "library");


include '/Classes/PHPExcel.php';
//include '/Classes/PHPExcel/Writer/Excel2007.php';
  

// Check connection
if (mysqli_connect_errno()) {
    
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
die();

//echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

// Set properties
//echo date('H:i:s') . " Set properties\n";
//$objPHPExcel->getProperties()->setCreator("Maarten Balliauw");
//$objPHPExcel->getProperties()->setLastModifiedBy("Maarten Balliauw");
$objPHPExcel->getProperties()->setTitle("Book Store");
$objPHPExcel->getProperties()->setSubject("Book Store");
$objPHPExcel->getProperties()->setDescription("Books");


// Add some data
//echo date('H:i:s') . " Add some data\n";
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Genre');
$objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Title');
$objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Author');
$objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Price');
$objPHPExcel->getActiveSheet()->SetCellValue('A2', "ids");


// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
//$objPHPExcel->getActiveSheet()->setTitle('Simple');

		
// Save Excel 2007 file
//echo date('H:i:s') . " Write to Excel2007 format\n";
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

// Echo done
//echo date('H:i:s') . " Done writing file.\r\n";
        
        