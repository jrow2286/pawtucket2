<?php
/* ----------------------------------------------------------------------
 * themes/default/views/Contribute/form_html.php : sample Contribute form
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2014 Whirl-i-Gig
 *
 * For more information visit http://www.CollectiveAccess.org
 *
 * This program is free software; you may redistribute it and/or modify it under
 * the terms of the provided license as published by Whirl-i-Gig
 *
 * CollectiveAccess is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTIES whatsoever, including any implied warranty of 
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  
 *
 * This source code is free and modifiable under the terms of 
 * GNU General Public License. (http://www.gnu.org/copyleft/gpl.html). See
 * the "license.txt" file for details, or visit the CollectiveAccess web site at
 * http://www.CollectiveAccess.org
 *
 * ----------------------------------------------------------------------
 */
 
	$t_subject = $this->getVar('t_subject');	
?>

	<div id="pageTitle">
		<span class='pageTitle'>p{ART}icipate</span>
	
	</div>
	<div id="contentArea" class="contribute">	
		<div class="contributeForm">
			<h1>Contribute to the Archive</h1>
			<p>
				Use the form below to contribute your media to the Mattress Factory Archive.
			</p>
			
			{{{form}}}
				
				<div class="contributeField">
					{{{ca_objects.preferred_labels:error}}}
					<span class='title'>Title</span><br/>
					{{{ca_objects.preferred_labels.name%width=400px}}}
				</div>
				<div class="contributeField">
					{{{ca_objects.date:error}}}
					<span class='title'>Date</span><br/>
					{{{ca_objects.date.dates_value%width=400px}}}   
					{{{ca_objects.date.dc_dates_types%force=created}}} 
					{{{ca_objects.date.dates_comment%force="dated via online contribution"}}}
				</div>
				<div class="contributeField">
					{{{ca_objects.description:error}}}
					<span class='title'>Description</span><br/>
					{{{ca_objects.description.description_text%width=400px&height=120px}}} 
					
					{{{ca_objects.description.description_source%force=non_MF_source}}}   
				</div>
				
				<div class="contributeField">
					{{{ca_object_representations.media:error}}}
					<span class='title'>Media (1)</span>{{{ca_object_representations.media}}} 
					
					Caption {{{ca_object_representations.preferred_labels.name%width=350px}}} 
					<br/><br/>
					
					{{{ca_object_representations.media:error}}}
					<span class='title'>Media (2)</span>{{{ca_object_representations.media}}}
					
					Caption {{{ca_object_representations.preferred_labels.name%width=350px}}} 
					 <br/><br/>
					
					{{{ca_object_representations.media:error}}}
					<span class='title'>Media (3)</span>{{{ca_object_representations.media}}}
					
					Caption {{{ca_object_representations.preferred_labels.name%width=350px}}} 
					 <br/><br/>
				</div>

				<br style="clear: both;"/>
<?php					
		print $this->render('Contribute/spam_check_html.php');
		print $this->render('Contribute/terms_and_conditions_check_html.php');
?>

				<div style="float: right; margin-left: 20px;">{{{reset%label=Reset}}}</div>
				<div style="float: right;">{{{submit%label=Save}}}</div>
			{{{/form}}}
			<div class='clearfix'></div>
		</div><!-- end Contribute form -->
		<div class='clearfix'></div>
	</div>
