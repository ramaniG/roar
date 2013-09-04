<?php 
		$sql = "SELECT id, description FROM timeslot";
		$result = $db->query($sql);
		if($db->numRows($result) > 0) {
			while ($row = mysql_fetch_row($result)) {
				
				if(is_time_slot_exists($datebooked, $row[0], $studioid)) {
					echo "<option style='color: red;' disabled value='{$row[0]}'>{$row[1]} (Not Available)</option>";
				}
				else {
					echo "<option style='color: green;' value='{$row[0]}'>{$row[1]} (Available)</option>";
				}
			}
		}
	?>