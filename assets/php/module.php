<?php
	function is_time_slot_exists($datebooked, $timeslotid, $studioid) {
		$db = new Database();
		
		$sql = "SELECT booking_timeslot.timeslotid, status.description
		FROM booking JOIN booking_timeslot ON booking.bookingno = booking_timeslot.bookingno 
		JOIN status ON booking.statusid = status.id
		WHERE booking.datebooked = '$datebooked' AND timeslotid = $timeslotid AND studioid = $studioid LIMIT 0,1";
		
		$result = $db->query($sql);
		$row = $db->fetchArray($result);
    	$id = $row[0];
    	$status = $row[1];
    	
		if(!empty($id)) {
			return $status;
    	}
    	else {
    		if (isAvailableTimeslot($datebooked, $timeslotid, $studioid))
    			return 'available';
    		elseif (isNotAvailableTimeslot($datebooked, $timeslotid, $studioid))
    			return 'notavailable';
    		elseif (isPublicHoliday($datebooked, $studioid))
				return 'available';
    		elseif (isCloseAllDay($datebooked, $studioid))
    			return 'notavailable';
    		elseif (isWeekend($datebooked)){
    			return 'available';
    		}
    		else 
    		{
    			if ($timeslotid > 12){
    				return 'available';
    			}
    			else
    				return 'notavailable';
    		}
    			
    	}
	}
	
	function isWeekend($date) {
		return (date('N', strtotime($date)) >= 6);
	}
	
	function isPublicHoliday($date, $studioid)
	{
		$db = new Database();
		$sql = "SELECT * FROM timeslot_publicholiday WHERE date='".date('Y-m-d', strtotime($date))."' and studioid=$studioid";
	
		$duperaw = $db->query($sql);
		if (mysql_num_rows($duperaw) > 0)
		{
			return true;
		}
	
		return false;
	}
	
	function isNotAvailableTimeslot($date, $timeslotid, $studioid)
	{
		$db = new Database();
		$sql = "SELECT * FROM timeslot_notavailable WHERE date='".date('Y-m-d', strtotime($date))."' AND studioid=$studioid AND timeslotid=$timeslotid";
	
		$duperaw = $db->query($sql);
		if (mysql_num_rows($duperaw) > 0)
		{
			return true;
		}
	
		return false;
	}
	
	function isAvailableTimeslot($date, $timeslotid, $studioid)
	{
		$db = new Database();
		$sql = "SELECT * FROM timeslot_available WHERE date='".date('Y-m-d', strtotime($date))."' AND studioid=$studioid AND timeslotid=$timeslotid";
	
		$duperaw = $db->query($sql);
		if (mysql_num_rows($duperaw) > 0)
		{
			return true;
		}
	
		return false;
	}
	
	function isCloseAllDay($date, $studioid)
	{
		$db = new Database();
		$sql = "SELECT * FROM timeslot_close WHERE date='".date('Y-m-d', strtotime($date))."' and studioid=$studioid";
	
		$duperaw = $db->query($sql);
		if (mysql_num_rows($duperaw) > 0)
		{
			return true;
		}
	
		return false;
	}
	
	function update_booking_running_id () {
		$db = new Database();
		
		$sql = "SELECT bookingid from runningid";
		$result = $db->query($sql);
		$row = $db->fetchArray($result);
		
		$rnum = ($row[0] + 1);
		
		$sql1 = "UPDATE runningid SET bookingid='{$rnum}'";
		$db->query($sql1) or die(mysql_error());

	}
	
	function select_booking_id() {
		$db = new Database();
		
		$sql = "SELECT bookingid from runningid";
		$result = $db->query($sql);
		$row = $db->fetchArray($result);
		$bookingno = 'R'.($row[0] + 1);

		return $bookingno;
	}
	
	function insert_new_booking($bookno, $memberid, $studioid, $bookeddate, $timeslotid)
	{
		$db = new Database();
		
		if ($studioid == 1)
		{
			$roarcredit = count(explode(',', $timeslotid)) * STUDIOAPRICE;
		}
		elseif ($studioid == 2)
		{
			$roarcredit = count(explode(',', $timeslotid)) * STUDIOBPRICE;
		}
	
		$sql = "INSERT INTO booking
		(bookingno, memberid, studioid, statusid, dateinserted, dateupdated, datebooked, paymentdatetime, amount)
		VALUES ('$bookno',$memberid,$studioid,2,CURDATE(),CURDATE(),'$bookeddate',CURDATE(),$roarcredit);";
		
		$db->query($sql) or die(mysql_error());
		
		$bookingid = mysql_insert_id();
		
		foreach (explode(',', $timeslotid) as $id)
		{
			$sql = "INSERT INTO booking_timeslot(bookingno,timeslotid) VALUES ('$bookno', $id); ";
			$db->query($sql) or die(mysql_error());
		}
		
		return $bookingid;
	}
	
	function update_roar_credit($memberid, $roaramount, $add, $remarks, $adminid)
	{
		$db = new Database();
				
		$sql = "SELECT id,amount FROM roarcredit WHERE memberid = '{$memberid}' LIMIT 0, 1";
		$result = $db->query($sql);
		$row = '';
		while ($row = mysql_fetch_row($result)) {
			$curroaramount =  $row[1];
			$roarcreditid = $row[0];
		}
		
		$debit = 0;
		$credit = 0;
		
		if($add)
		{
			$debit = $roaramount;
			$newroaramount = $curroaramount + $roaramount;
		}
		else
		{
			$credit = $roaramount;
			$newroaramount = $curroaramount - $roaramount;
		}
		
		$sql = "INSERT INTO roarcredit_history (roarcreditid,oldamount,newamount,credit,debit,remarks,adminid,dateupdated) 
		VALUES ($roarcreditid,$curroaramount,$newroaramount,$credit,$debit,$remarks,$adminid,CURDATE());";
		
		$db->query($sql) or die(mysql_error());
		
		$sql = "UPDATE roarcredit SET amount=$newroaramount, dateupdated=CURDATE() WHERE memberid=$memberid;";
		
		$db->query($sql) or die(mysql_error());
	}
	
	//User
	function select_username($memberid)
	{
		$db = new Database();
		
		$sql = "SELECT name FROM member WHERE id = '{$memberid}' LIMIT 0, 1";
		$result = $db->query($sql);
		$row = '';
		while ($row = mysql_fetch_row($result)) {
			$name =  $row[0];
		}
		
		return $name;
	}
	
	//Select All For Dropdown	
	function select_all_timeslot()
	{
		$db = new Database();
		$sql = "SELECT id,description,starttime,endtime FROM timeslot";
		$result = $db->query($sql);
		
		while($row = $db->fetchArray($result))
			$rows[] = $row;
	
		return $rows;
	}
	
	function select_timeslot($id)
	{
		$db = new Database();
		$sql = "SELECT id,description,starttime,endtime FROM timeslot WHERE id=$id";
		$result = $db->query($sql);
		$row = $db->fetchArray($result);
	
		return $row;
	}
	
	function select_timeslot_starttime()
	{
		$db = new Database();
		$sql = "SELECT starttime FROM timeslot";
		$result = $db->query($sql);
		
		while ($row = $db->fetchArray($result))
		{
			$rows[] = $row['starttime'];
		}
	
		return $rows;
	}
	
	function select_timeslot_endtime()
	{
		$db = new Database();
		$sql = "SELECT endtime FROM timeslot";
		$result = $db->query($sql);
		
		while ($row = $db->fetchArray($result))
		{
			$rows[] = $row['endtime'];
		}
	
		return $rows;
	}
	

	function select_all_bank()
	{
		$db = new Database();
		$sql = "SELECT id,description FROM bank";
		$result = $db->query($sql);
	
		while($row = $db->fetchArray($result))
			$rows[] = $row;
	
		return $rows;
	}
	
	function select_bank($id)
	{
		$db = new Database();
		$sql = "SELECT id,description FROM bank WHERE id=$id";
		$result = $db->query($sql);
		$row = $db->fetchArray($result);
	
		return $row;
	}
	
	function select_all_paymenttype()
	{
		$db = new Database();
		$sql = "SELECT id,description FROM paymenttype where active=1";
		$result = $db->query($sql);
	
		while($row = $db->fetchArray($result))
			$rows[] = $row;
	
		return $rows;
	}
	
	function select_paymenttype($id)
	{
		$db = new Database();
		$sql = "SELECT id,description FROM paymenttype where id=$id";
		$result = $db->query($sql);
		$row = $db->fetchArray($result);
	
		return $row;
	}
	
	function select_all_status()
	{
		$db = new Database();
		$sql = "SELECT id,description FROM status";
		$result = $db->query($sql);
	
		while($row = $db->fetchArray($result))
			$rows[] = $row;
	
		return $rows;
	}
	
	function select_all_roar_status()
	{
		$db = new Database();
		$sql = "SELECT id,description FROM roarcredit_status";
		$result = $db->query($sql);
	
		while($row = $db->fetchArray($result))
			$rows[] = $row;
	
		return $rows;
	}
	
	function select_status($id)
	{
		$db = new Database();
		$sql = "SELECT id,description FROM status WHERE id=$id";
		$result = $db->query($sql);
		$row = $db->fetchArray($result);
	
		return $row;
	}
	
	function select_all_studio()
	{
		$db = new Database();
		$sql = "SELECT id,description FROM studio";
		$result = $db->query($sql);
		
		while($row = $db->fetchArray($result))
			$rows[] = $row;
	
		return $rows;
	}
	
	function select_studio($id)
	{
		$db = new Database();
		$sql = "SELECT id,description FROM studio WHERE id=$id";
		$result = $db->query($sql);
		$row = $db->fetchArray($result);
	
		return $row;
	}
	
	function select_all_active_roarpackage()
	{
		$db = new Database();
		$sql = "SELECT * FROM roarcredit_packages where active = 1 and startdate < NOW() and (enddate = '0000-00-00' or enddate > NOW());";
		$result = $db->query($sql);
	
		while($row = $db->fetchArray($result))
			$rows[] = $row;
	
		return $rows;
	}
?>