<?php
if ($page == 0) $page = 1;
$prev = $page - 1;
$next = $page + 1;
$lastpage = ceil($total_pages/$limit);
$lpm1 = $lastpage - 1;

$pagination = "";
if($lastpage > 1)
{	
$pagination .= " <div class=\"pagination\">";
if ($page > 1) { 
$pagination.= " <a href=\"$targetpage?page=$prev$pager\">&laquo; Previous</a>";
}
else {
$pagination.= " <span class=\"disabled\">&laquo; Previous</span>";	
}
if ($lastpage < 7 + ($adjacents * 2)){	
for ($counter = 1; $counter <= $lastpage; $counter++)
{
if ($counter == $page) {
$pagination.= " <span class=\"current\">$counter</span>";
}
else {
$pagination.= " <a href=\"$targetpage?page=$counter$pager\">$counter</a>";					
}
}
}
elseif($lastpage > 5 + ($adjacents * 2)) {
if($page < 1 + ($adjacents * 2)) {
for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
if ($counter == $page) {
$pagination.= " <span class=\"current\">$counter</span>";
}
else {
$pagination.= " <a href=\"$targetpage?page=$counter$pager\">$counter</a>";
}
}
$pagination.= " ...";
$pagination.= " <a href=\"$targetpage?page=$lpm1$pager\">$lpm1</a>";
$pagination.= " <a href=\"$targetpage?page=$lastpage$pager\">$lastpage</a>";		
}
//in middle; hide some front and some back
elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {
$pagination.= " <a href=\"$targetpage?page=1$pager\"> 1</a>";
$pagination.= " <a href=\"$targetpage?page=2$pager\"> 2</a>";
$pagination.= " ...";
for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
if ($counter == $page) {
$pagination.= " <span class=\"current\">$counter</span>";
}
else {
$pagination.= " <a href=\"$targetpage?page=$counter$pager\">$counter</a>";
}
}
$pagination.= " ...";
$pagination.= " <a href=\"$targetpage?page=$lpm1$pager\">$lpm1</a>";
$pagination.= " <a href=\"$targetpage?page=$lastpage$pager\">$lastpage</a>";		
}
//close to end; only hide early pages
else {
$pagination.= " <a href=\"$targetpage?page=1$pager\">1</a>";
$pagination.= " <a href=\"$targetpage?page=2$pager\">2</a>";
$pagination.= " ...";
for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
if ($counter == $page) {
$pagination .= "<span class=\"current\">  $counter  </span>";
}
else {
$pagination .= "<a href=\"$targetpage?page=$counter$pager\"> $counter  </a>";
}
}
}
}
if ($page < $counter - 1) {
$pagination.= " <a href=\"$targetpage?page=$next$pager\">  Next &raquo;</a>";
}
else {
$pagination.= " <span class=\"disabled\">  Next &raquo;</span>";
}
$pagination.= "</div>\n";
}
?>