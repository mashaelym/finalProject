 <?php

namespace htmlHelper;

class arrayToHtml
{
  
  public static function generate(array $inputArray)
  {

    $tableOpenString = '<table>';
    $headerString = '<thead><tr>';

    foreach ($inputArray[0] as $columnName)
    {
      $headerString.="<td>$columnName</td>";
    }

    $headerString.='</thead></tr>';
    $tableBodyString = '<tbody>';
    for ($i=1 ; $i<=sizeof($inputArray)-1 ; $i++)
    {
        $currentArray = $inputArray[$i];  

        if (sizeof($currentArray)==sizeof($inputArray[0]))
        {
          $tableBodyString.='<tr>';
         foreach ($currentArray as $row)
         {
            $tableBodyString.="<td>$row</td>";
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