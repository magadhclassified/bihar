<?php

$faqs_list = '';

$sqlquery = mysql_query('SELECT * FROM faqs WHERE status = 1 ORDER BY ordering ASC');
while($row = mysql_fetch_assoc($sqlquery)){ 

	$am_id = filer_out_limit($row['id']);
	$am_question = filer_out_limit($row['question']);
	$am_answer = filer_out_limit($row['answer']);
	
	$faqs_list .= '<p class="question"><span class="faqq">Q</span>' . $am_question . '</p> 
<p class="answer"><span class="faqq faqa">A</span>' . nl2br($am_answer) . '</p> ';
		
}

?>