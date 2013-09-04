<?php
$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
$limit = 50;
$curr_page = ($page * $limit) - $limit;

$name = select_username($memberid);

$db = new Database();
$sql = "SELECT amount FROM roarcredit WHERE memberid = '{$memberid}' LIMIT 0, 1";
$result = $db->query($sql);
$row = '';
while ($row = mysql_fetch_row($result)) {
	$roaramount =  $row[0];
}
?>

<script type="text/javascript">
			var current_page = '<?php echo $current_page;?>';
			$("#content").ready(function (){
				$("#content .middle .left .menu ul li").each(function (){
					if (current_page == $(this).attr('id')){
						$(this).addClass("active");
						$(this).children().removeClass("cufon");
						$(this).children().addClass("white");

						}

					});

				Cufon.replace('a.cufon', {hover: {color: '#DDD'}});
				Cufon.replace('a.active', {color: '#FFA800'});
				Cufon.replace('div.cufon', {color: '#FFF'});
				Cufon.replace('span.red', {color: 'red'});
				Cufon.replace('span.orange', {color: '#FF7F00'});
				Cufon.replace('span.blue', {color: '#007FFF'});
			
				Cufon.replace('a.white', {color: 'white'});
				});
</script>

<style>
.head1 {
	padding: 0;
	margin-bottom: 20px;
	font-family: 'Raleway', sans-serif;
	color: #e79703;
	font-size: 30px;
	font-weight: bold;
}
</style>
