<?php
session_start();
if(!$_SESSION['userlogin']){
header("Location: registration.php");  
}

include '/Classes/PHPExcel.php';
include 'connection.php';
function d($var, $die=FALSE){
    echo '<pre>';
    is_array($var)? print_r($var):var_dump($var);
    echo '</pre>';
    if($die){
      die();  
    }
   
}

if(isset($_POST['export'])){ 
   if (isset($_POST['genre'])) {
  $genres = $_POST['genre'];
   if(isset($genres)){
             $ids = implode(",", $genres);
            
     
            $query = "SELECT name AS Genre, Title, names AS Author, Price
FROM books
INNER JOIN authors ON books.authorid = authors.id
INNER JOIN books_genres ON books.id = books_genres.book_id
INNER JOIN genres ON books_genres.genre_id = genres.id
WHERE genre_id IN ({$ids})
ORDER BY (SELECT COUNT(*) FROM books_genres as b WHERE b.genre_id = genres.id) DESC, genres.name ASC;"; 
     
    
 if ($result = mysqli_query($con, $query)) {
              
       
          
   
      }
     
    while ( $row = mysqli_fetch_assoc($result)){
    $data[]=$row;
   
    
    }
    
 
     $head=  array_keys($data[0]);
    array_unshift($data, $head);
    
    //d($data, true);
   }
  }
  
  
      
  //die();
      $excel=new PHPExcel();
      $excel->setActiveSheetIndex(0);
      
      $excel->getActiveSheet()->getStyle('A1:D1')->applyFromArray(
    array(
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'FF0000')
        )
    )
);
      
      $excel->getActiveSheet()->getColumnDimension('A')->setAutoSize(TRUE);
      $excel->getActiveSheet()->getColumnDimension('B')->setAutoSize(TRUE);
      $excel->getActiveSheet()->getColumnDimension('C')->setAutoSize(TRUE);
      $excel->getActiveSheet()->getColumnDimension('D')->setAutoSize(TRUE);
      $excel->getActiveSheet()->fromArray($data);      
      $styleArray = array('font' => array('bold' => true));
      $excel->getActiveSheet()->getStyle('A1:Y1')->applyFromArray($styleArray);
      
      
      header("Content-Disposition: attachment; filename='Books.xlsx'");
      header("Content-Type: application/force-download");
      header("Content-Type: application/octet-stream");
      header("Content-Type: application/download");
      header("Content-Type: application/vnd.ms-excel");
      header("Content-Transfer-Encoding: binary");
      $file=new PHPExcel_Writer_Excel2007($excel);
      $file->save('php://output');
      
     
      die();
       
      }
   
  
?>
<!doctype html>
<html>
    <head>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <title>Results</title>
    <link rel="stylesheet" href="db.css" type="text/css">
    </head>
    <body>
        
 <?php
 

  
        
$con=mysqli_connect("localhost", "root", "", "library");

// Check connection
if (mysqli_connect_errno()) {
    
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  if (isset($_POST['genre'])) {
  $genres = $_POST['genre'];
  
  foreach ($genres as $k=>$v) {
   
  $rslt="INSERT INTO `history`
          (`genre_id`) 
VALUES ('".$k."')";
   
   mysqli_query($con, $rslt);
   
   }
  }
  
   $AllHistory = "SELECT name, history.id
FROM history
INNER JOIN genres
ON history.genre_id = genres.id;
                   ";
      
       
                    
   
   ?>  <div id="parent">
       <div class="right">
        <table border="1" id="historyTable" cellspacing="0">
       <tbody>
     <tr>                
   <th colspan="2" id="TableHeader">
     History   
    </th> 
</tr>
<?php 

          if(isset($_POST['submit'])){
            $deleteHistory = "truncate `history`";
            mysqli_query($con, $deleteHistory);
          }
 $HistoryResults = mysqli_query($con, $AllHistory);
                    
while ($row = mysqli_fetch_assoc($HistoryResults)):
    
 ?>
 <tr>
<td id="TdIdHistory">
<?=$row['id'].'.' ?>
 </td>
 <td id="TdNameHistory">
 <?=$row['name'] ?>
 </td>   
 </tr>
 <?php endwhile; ?>
 </tbody>
        </table>
       </div>
        <a href="sg.php"><--Back</a>
       <form action='' method='POST'>
        <input type='submit' name='submit' value="Clear History" id="ClearHistoryButton" />
       </form>
        <div class="left">
        <table border="1" id="BookResult" cellspacing="0">
            <tr>
                <th id="thGenre">
                Genre
                </th>
                <th id="thTitle">
                Title
                </th>
                <th id="TdPrice">
                 Price: 
                </th>
            </tr>
        </table>
        <?php
        if(isset($_POST['submit'])){
          $deleteHistory = "truncate `history`";
          mysqli_query($con, $deleteHistory);
          
         }

         if(isset($genres)){
             $ids = implode(",", $genres);
            
            $query = "SELECT title, price, genre_id, name, (SELECT COUNT(*) FROM books_genres as b WHERE b.genre_id = genres.id) as genreCount
FROM books
INNER JOIN books_genres ON books.id = books_genres.book_id
INNER JOIN genres ON books_genres.genre_id = genres.id
WHERE genre_id IN ({$ids})
ORDER BY genreCount DESC, genres.name ASC;

"; 
     
    
 if ($result = mysqli_query($con, $query)) {
              
       
          
   
      }
     
    while ($row = mysqli_fetch_assoc($result)):
        ?> 
        <table border="1" id="BookResult" cellspacing="0" cellpadding="1">    
            <tbody> 
           <tr>   
               <td id="TdGenre">
               <?=$row['name'] ?>
               </td>
                <td id="TdTitleResult">
                  <?=$row['title'] ?> &nbsp;
                  </td>
                  <td id="TdPriceResult">
                   <?=$row['price'] ?>
                </td>
            </tr>
            </tbody>
        </table>  
    <?php endwhile; ?>
      
</div>
   </div>
        <?php
    }          
  

 


?>
          
    </body>
</html>