<?php
backup_tables();

// backup all tables in db
function backup_tables()
{
    $day_of_backup = ''; //possible values: `Monday` `Tuesday` `Wednesday` `Thursday` `Friday` `Saturday` `Sunday`
    $backup_path = 'uploads/'; //make sure it ends with "/"
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '';
    $db_name = 'iorangeerp';

    //set the correct date for filename
    if (date('l') == $day_of_backup) {
        $date = date("Y-m-d");
    } else {
        //set $date to the date when last backup had to occur
        $datetime1 = date_create($day_of_backup);
        $date = date("Y-m-d");
    }

    if (!file_exists($backup_path.$date.'-backup'.'.sql')) {

        //connect to db
        $link = mysqli_connect($db_host,$db_user,$db_pass);
        mysqli_set_charset($link,'utf8');
        mysqli_select_db($link,$db_name);

        //get all of the tables
        $tables = array();
        $result = mysqli_query($link, 'SHOW TABLES');
        while($row = mysqli_fetch_row($result))
        {
            $tables[] = $row[0];
        }

        //disable foreign keys (to avoid errors)
        $return = 'SET FOREIGN_KEY_CHECKS=0;' . "\r\n";
        $return.= 'SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";' . "\r\n";
        $return.= 'SET AUTOCOMMIT=0;' . "\r\n";
        $return.= 'START TRANSACTION;' . "\r\n";

        //cycle through
        foreach($tables as $table)
        {
            $result = mysqli_query($link, 'SELECT * FROM '.$table);
            $num_fields = mysqli_num_fields($result);
            $num_rows = mysqli_num_rows($result);
            $i_row = 0;

            //$return.= 'DROP TABLE '.$table.';'; 
            $row2 = mysqli_fetch_row(mysqli_query($link,'SHOW CREATE TABLE '.$table));
            $return.= "\n\n".$row2[1].";\n\n"; 

            if ($num_rows !== 0) {
                $row3 = mysqli_fetch_fields($result);
                $return.= 'INSERT INTO '.$table.'( ';
                foreach ($row3 as $th) 
                { 
                    $return.= '`'.$th->name.'`, '; 
                }
                $return = substr($return, 0, -2);
                $return.= ' ) VALUES';

                for ($i = 0; $i < $num_fields; $i++) 
                {
                    while($row = mysqli_fetch_row($result))
                    {
                        $return.="\n(";
                        for($j=0; $j<$num_fields; $j++) 
                        {
                            $row[$j] = addslashes($row[$j]);
                            $row[$j] = preg_replace("#\n#","\\n",$row[$j]);
                            if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                            if ($j<($num_fields-1)) { $return.= ','; }
                        }
                        if (++$i_row == $num_rows) {
                            $return.= ");"; // last row
                        } else {
                            $return.= "),"; // not last row
                        }
                    }
                }
            }
            $return.="\n\n\n";
        }

        // enable foreign keys
        $return .= 'SET FOREIGN_KEY_CHECKS=1;' . "\r\n";
        $return.= 'COMMIT;';

        //set file path
        if (!is_dir($backup_path)) {
            mkdir($backup_path, 0755, true);
        }

        //save file
        $handle = fopen($backup_path.$date.'-backup'.'.sql','w+');
        fwrite($handle,$return);
        fclose($handle);
    }
}

?>
