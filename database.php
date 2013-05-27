<?php 

class Database
{

	public function connect($hostname, $username, $password, $database)
	{
                $currentConnection 	= mysql_connect($hostname, $username, $password);
		$currentDatabase	= mysql_select_db($database);
		
		if(!$currentConnection)
		{
                        die("ERROR: Connection..");
		}
		
		if(!$currentDatabase)
		{
                        die("ERROR: Database..");
		}
	}	

	public function getData($strQuery) 
	{
		$output	= array();
		$result	= @mysql_query($strQuery);
		
		if($result)
		{
			while($row = mysql_fetch_assoc($result))
			{
				array_push($output, $row);
			}
			
			return $output;
		}
	}

	public function query($strQuery)
	{
		$bolSQLResult = @mysql_query($strQuery);
		
		if($bolSQLResult)
		{
			return true;
		}
	}
}

?>