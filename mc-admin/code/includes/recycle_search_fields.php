<?php

if(!isset($is_caller)){exit('Direct access not allowed.');}

// -------------------------------------------------------------------------------------------------------------------------
// Show
// -------------------------------------------------------------------------------------------------------------------------

$srch_active_listbox = '<select name="show" class="web_form_search_item"><option value="0">Show...</option>';
if($search_data_show == 1){$srch_active_listbox .= '<option value="1" selected="selected">Active</option>';}else{$srch_active_listbox .= '<option value="1">Active</option>';}
if($search_data_show == 2){$srch_active_listbox .= '<option value="2" selected="selected">Inactive</option>';}else{$srch_active_listbox .= '<option value="2">Inactive</option>';}
if($search_data_show == 3){$srch_active_listbox .= '<option value="3" selected="selected">Featured</option>';}else{$srch_active_listbox .= '<option value="3">Featured</option>';}
if($search_data_show == 4){$srch_active_listbox .= '<option value="4" selected="selected">Non-Featured</option>';}else{$srch_active_listbox .= '<option value="4">Non-Featured</option>';}
if($search_data_show == 5){$srch_active_listbox .= '<option value="5" selected="selected">FP</option>';}else{$srch_active_listbox .= '<option value="5">FP</option>';}
if($search_data_show == 6){$srch_active_listbox .= '<option value="6" selected="selected">Non-FP</option>';}else{$srch_active_listbox .= '<option value="6">Non-FP</option>';}
$srch_active_listbox .= '</select> ';

// -------------------------------------------------------------------------------------------------------------------------
// Order By
// -------------------------------------------------------------------------------------------------------------------------

$srch_order_listbox = '<select name="order" class="web_form_search_item"><option value="date_created">Order By...</option>';
if($search_data_order == 'date_created'){$srch_order_listbox .= '<option value="date_created" selected="selected">Date Created</option>';}else{$srch_order_listbox .= '<option value="date_created">Date Created</option>';}
if($search_data_order == 'title'){$srch_order_listbox .= '<option value="title" selected="selected">Title</option>';}else{$srch_order_listbox .= '<option value="title">Title</option>';}
$srch_order_listbox .= '</select> ';

// -------------------------------------------------------------------------------------------------------------------------
// Sort
// -------------------------------------------------------------------------------------------------------------------------

$srch_sort_listbox = '<select name="sort" class="web_form_search_item"><option value="DESC">Sort...</option>';
if($search_data_sort == 'DESC'){$srch_sort_listbox .= '<option value="DESC" selected="selected">Descending</option>';}else{$srch_sort_listbox .= '<option value="DESC">Descending</option>';}
if($search_data_sort == 'ASC'){$srch_sort_listbox .= '<option value="ASC" selected="selected">Ascending</option>';}else{$srch_sort_listbox .= '<option value="ASC">Ascending</option>';}
$srch_sort_listbox .= '</select> ';

?>