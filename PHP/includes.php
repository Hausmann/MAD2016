<?php
    //Gibt den Inhalt als HTML-Tabelle zurück
	function dbquery($dbserver, $dbuser, $dbpassword, $dbDatabase, $str_query)
	{
		$db_link = mysqli_connect ($dbserver, $dbuser, $dbpassword, $dbDatabase);

		if (!$db_link)
		{
			die('Connect Error:' . mysqli_connect_errno());
		}

		$result = mysqli_query ($db_link, $str_query);

		if (!$result)
		{
			$message  = 'Ungültige Abfrage: ' . mysqli_error($db_link) . "\n";
			die($message);
		}

        echo '<table border="1"><tr>';
        $finfo = mysqli_fetch_fields($result);
        foreach ($finfo as $val) {
            echo "<th>";
            echo $val->name;
            echo "</th>";
        }
        echo "</tr>";

		while ($row = mysqli_fetch_row($result))
		{
			$y = 0;
			echo "<tr>";
			while ($y < (count($row)))
			{
				echo "<td>". utf8_encode($row[$y]) ."</td>";
				$y = $y + 1;
			}
			echo "</tr>";
		}
		echo "</table>";

        mysqli_close($db_link);
	}


    //Verbindung zum Datenbankserver herstellen
    function connectDatabase($dbserver, $dbuser, $dbpassword, $dbDatabase)
    {
        $db_link = mysqli_connect ($dbserver, $dbuser, $dbpassword, $dbDatabase);

		if (!$db_link)
		{
			die('Connect Error:' . mysqli_connect_errno());
		}

        return $db_link;
    }

    //Gibt den Inhalt als return zurück
    function dbqueryReturnOption($dbserver, $dbuser, $dbpassword, $dbDatabase, $str_query)
	{
		$db_link = connectDatabase($dbserver, $dbuser, $dbpassword, $dbDatabase);

		$result = mysqli_query ($db_link, $str_query);

		if (!$result)
		{
			echo $message  = 'Ungültige Abfrage: ' . mysqli_error($db_link) . "\n";
			die($message);
		}

		while ($row = mysqli_fetch_row($result))
		{
			$y = 1;
            echo '<option value="' . $row[0] . '">';
			while ($y < (count($row)))
			{
				echo utf8_encode($row[$y]) . " ";
				$y = $y + 1;
			}
            echo '</option>';
		}

        mysqli_close($db_link);
	}

    function insertInto($dbserver, $dbuser, $dbpassword, $dbDatabase, $str_query)
    {
        $db_link = connectDatabase($dbserver, $dbuser, $dbpassword, $dbDatabase);

        $result = mysqli_query ($db_link, $str_query);

		if (!$result)
		{
			echo $message  = 'Ungültige Abfrage: ' . mysqli_error($db_link) . "\n";
			die($message);
		}

        return true;
    }
?>
