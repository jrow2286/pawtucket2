<?php
/* ----------------------------------------------------------------------
 * controllers/FrontController.php
 * ----------------------------------------------------------------------
 * CollectiveAccess
 * Open-source collections management software
 * ----------------------------------------------------------------------
 *
 * Software by Whirl-i-Gig (http://www.whirl-i-gig.com)
 * Copyright 2013 Whirl-i-Gig
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
 
	require_once(__CA_LIB_DIR__."/core/Error.php");
 	require_once(__CA_APP_DIR__.'/helpers/accessHelpers.php');
	require_once(__CA_MODELS_DIR__."/ca_sets.php");
	require_once(__CA_MODELS_DIR__."/ca_objects.php");
 
 	class FrontController extends ActionController {
 		# -------------------------------------------------------
 		 
 		# -------------------------------------------------------
 		public function __construct(&$po_request, &$po_response, $pa_view_paths=null) {
 			parent::__construct($po_request, $po_response, $pa_view_paths);
 			$this->config = caGetFrontConfig();
 			caSetPageCSSClasses(array("front"));
 		}
 		# -------------------------------------------------------
 		/**
 		 *
 		 */ 
 		public function __call($ps_function, $pa_args) {
 			AssetLoadManager::register("carousel");
 			$va_access_values = caGetUserAccessValues($this->request);
 			$this->view->setVar('access_values', $va_access_values);

 			#
 			# --- if there is a set configured to show on the front page, load it now
 			#
 			if($vs_set_code = $this->config->get("front_page_set_code")){
 				$t_set = new ca_sets();
 				$t_set->load(array('set_code' => $vs_set_code));
				# Enforce access control on set
				if((sizeof($va_access_values) == 0) || (sizeof($va_access_values) && in_array($t_set->get("access"), $va_access_values))){
					$this->view->setVar('featured_set_id', $t_set->get("set_id"));
					$this->view->setVar('featured_set', $t_set);
					$va_featured_ids = array_keys(is_array($va_tmp = $t_set->getItemRowIDs(array('checkAccess' => $va_access_values, 'shuffle' => 1))) ? $va_tmp : array());
					$this->view->setVar('featured_set_item_ids', $va_featured_ids); 
				}
 			}
 			
 			$this->view->setVar('config', $this->config);
 			
 			
 			//
 			// Try to load selected page if it exists in Front/, otherwise load default Front/front_page_html.php
 			//
 			$ps_function = preg_replace("![^A-Za-z0-9_\-]+!", "", $ps_function);
 			$vs_path = "Front/{$ps_function}_html.php";
 			if (file_exists(__CA_THEME_DIR__."/views/{$vs_path}")) {
 				$this->render($vs_path);
 			} else {
 				$this->render("Front/front_page_html.php");
 			}
 		}
 		# ------------------------------------------------------
 	}
 ?>