<style type="text/css">
div.day-number	 { 
	background:#999; 
	position:absolute; 
	z-index:2; 
	top:-5px; 
	right:-25px; 
	padding:5px; 
	color:#fff; 
	font-weight:bold; 
	width:20px; 
	text-align:center; 
}
td.calendar-day, td.calendar-day-np { 
	width:120px; 
	padding:5px 25px 5px 5px; 
	border-bottom:1px solid #999; 
	border-right:1px solid #999; 
}
</style>
<?php
date_default_timezone_set('Asia/Colombo');
include ("config.php");
/* draws a calendar */
function draw_calendar($month,$year,$events = array()){

	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day"><div style="position:relative;height:100px;">';
			/* add in the day number */
			$calendar.= '<div class="day-number">'.$list_day.'</div>';
			
			$event_day = $year.'-'.$month.'-'.$list_day;
			if(isset($events[$event_day])) {
				foreach($events[$event_day] as $event) {
					$calendar.= '<div class="event">'.$event['title'].'</div>';
				}
			}
			else {
				$calendar.= str_repeat('<p>&nbsp;</p>',2);
			}
		$calendar.= '</div></td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np">&nbsp;</td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';
	

	/* end the table */
	$calendar.= '</table>';

	/** DEBUG **/
	$calendar = str_replace('</td>','</td>'."\n",$calendar);
	$calendar = str_replace('</tr>','</tr>'."\n",$calendar);
	
	/* all done, return result */
	return $calendar;
}

function random_number() {
	srand(time());
	return (rand() % 7);
}

/* date settings */
$month = (int) ($_GET['month'] ? $_GET['month'] : date('m'));
$year = (int)  ($_GET['year'] ? $_GET['year'] : date('Y'));

/* select month control */
$select_month_control = '<select name="month" id="month">';
for($x = 1; $x <= 12; $x++) {
	$select_month_control.= '<option value="'.$x.'"'.($x != $month ? '' : ' selected="selected"').'>'.date('F',mktime(0,0,0,$x,1,$year)).'</option>';
}
$select_month_control.= '</select>';

/* select year control */
$year_range = 7;
$select_year_control = '<select name="year" id="year">';
for($x = ($year-floor($year_range/2)); $x <= ($year+floor($year_range/2)); $x++) {
	$select_year_control.= '<option value="'.$x.'"'.($x != $year ? '' : ' selected="selected"').'>'.$x.'</option>';
}
$select_year_control.= '</select>';

/* "next month" control */
$next_month_link = '<a href="?month='.($month != 12 ? $month + 1 : 1).'&year='.($month != 12 ? $year : $year + 1).'" class="control">Next Month &gt;&gt;</a>';

/* "previous month" control */
$previous_month_link = '<a href="?month='.($month != 1 ? $month - 1 : 12).'&year='.($month != 1 ? $year : $year - 1).'" class="control">&lt;&lt; 	Previous Month</a>';


/* bringing the controls together */
$controls = '<form method="get">'.$select_month_control.$select_year_control.'&nbsp;<input type="submit" name="submit" value="Go" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$previous_month_link.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$next_month_link.' </form>';

/* get all events for the given month */
$events = array();
$query = "SELECT title, DATE_FORMAT(event_date,'%Y-%m-%D') AS event_date FROM events WHERE event_date LIKE '$year-$month%'";
$result = mysql_query($query) or die('cannot get results!');
while($row = mysql_fetch_assoc($result)) {
	$events[$row['event_date']][] = $row;
}

echo '<h2 style="float:left; padding-right:30px;">'.date('F',mktime(0,0,0,$month,1,$year)).' '.$year.'</h2>';
echo '<div style="float:left;">'.$controls.'</div>';
echo '<div style="clear:both;"></div>';
echo draw_calendar($month,$year,$events);
echo '<br /><br />';
?>