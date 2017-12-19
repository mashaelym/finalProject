<?php

namespace viewHelper;

class arrayToHtml
{
  
  /**
   * Static method to convert array to html method
   */
  public static function generate(array $inputArray)
  {

  //generate table
    $tableOpenString = '<table style="border: 1px solid black; border-collapse: collapse;">';
    $headerString = '<thead><tr>';

  //generate headers
    foreach ($inputArray[0] as $columnName)
    {
      $headerString.='<td style="border: 1px solid black;">' . $columnName . '</td>';
    }

    $headerString.='</thead></tr>';
  
  //generate body
    $tableBodyString = '<tbody>';
    for ($i=1 ; $i<=sizeof($inputArray)-1 ; $i++)
    {
        $currentArray = $inputArray[$i];  

        if (sizeof($currentArray)==sizeof($inputArray[0]))
        {
          $tableBodyString.='<tr>';
         foreach ($currentArray as $row)
         {
            $tableBodyString.='<td style="border: 1px solid black;">' . $row .'</td>';
         }
         $tableBodyString.='</tr>';
        }
    }
    $tableBodyString.='</tbody>';
    $tableCloseString = '</table>';

    $htmlOutput = $tableOpenString . $headerString . $tableBodyString . $tableCloseString;

    return $htmlOutput;  
    
  }
  
}
?>