<?php

function lay_du_lieu($xdata,$query)
{
	try {
		$data = $xdata->query($query);
		if($data)
		{					
			if($data->length> 0)
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

function get_nodes_list($data,$query)
{
	return $data->query($query);
}

?>