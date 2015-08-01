<?php

function lay_du_lieu($xdata,$query)
{
	try {
		$data = $xdata->query($query);
		if($data)
		{			
			if(count($data) > 0)
				return $data->item(0)->nodeValue;
			else
				return '';
		}
		else 
		{
			return '';
		}
	}
	catch (Exception $r)
	{
		return '';
	}
		
}

?>