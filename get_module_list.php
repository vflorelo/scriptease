<?php
$modulefiles_dir = "/usr/share/modules/modulefiles";
#$modulefiles_dir = "modules";
$modules_array   = array_diff(scandir($modulefiles_dir),array('..', '.','.hidden'));
natcasesort($modules_array);
$xml_str         = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n".
                   "<modules>\n";
if(is_dir($modulefiles_dir)){
  $xml_str      .= "  <query_str>0</query_str>\n";
  foreach($modules_array as $module_name){
    $module_path   = $modulefiles_dir . "/" . $module_name ;
    $version_array = array_diff(scandir($module_path),array('..', '.'));
    foreach($version_array as $module_version){
      $version_file = $modulefiles_dir . "/" . $module_name . "/" . $module_version ;
      if(is_file($version_file)){
        $xml_str .= "  <entry>\n".
                    "    <module_name>$module_name</module_name>\n".
                    "    <module_version>$module_version</module_version>\n".
                    "  </entry>\n";
        }
      }
    }
  }
else{
  $xml_str      .= "  <query_str>1</query_str>\n";
  }
$xml_str .= "</modules>";
print $xml_str;
?>
