<?php 
//--------------------------------------------------------------------------------------------------------------//
// CODE FOR CREATING MENUS --START--
//---------------------------------------------------------------------------------------------------------------//
if (!is_user_logged_in())
{
	return;
}
else
{

	add_menu_page(__("Estadísticas Generales",estadisticasAL), //page_title			
				          __("Estadísticas", estadisticasAL), //menu_title
				          "read", //capability
				          "estadisticas", //menu_slug
				          "", //function
				          plugins_url("/images/icon.png", //icon_url
				          dirname(__FILE__))); //position

	

	switch($role)
	{
			
		case "al_superadministrador":
		case "administrator":

			add_submenu_page("estadisticas",  //parent_slug
				     		__("Estadísticas de Usuarios", estadisticasAL), //page_title
				     		__("Usuarios", estadisticasAL), //menu_title
				     		"read",  //capability
				     		"usuarios" //menu_slug
				     		); //function

			add_submenu_page("estadisticas",  //parent_slug
				     		__("Estadísticas de Visitas", estadisticasAL), //page_title
				     		__("Visitas", estadisticasAL), //menu_title
				     		"read",  //capability
				     		"visitas" //menu_slug
				     		); //function

			add_submenu_page("estadisticas",  //parent_slug
				     		__("Estadísticas de Publicaciones", estadisticasAL), //page_title
				     		__("Publicaciones", estadisticasAL), //menu_title
				     		"read",  //capability
				     		"publicaciones" //menu_slug
				     		); //function



			//add_menu_page("WP Mail Bank", __("WP Mail Bank", mail_bank), "read", "smtp_mail","", plugins_url("/assets/images/mail.png" , dirname(__FILE__)));
			//add_submenu_page("smtp_mail", "Settings", __("Settings", mail_bank), "read", "smtp_mail","smtp_mail");
			//add_submenu_page("smtp_mail", "Send Test Email", __("Send Test Email", mail_bank), "read", "send_test_email","send_test_email");
			//add_submenu_page("", "", "", "read", "send_test_email",  "send_test_email");
			//add_submenu_page("smtp_mail", "Plugin Updates", __("Plugin Updates",mail_bank), "read", "mail_plugin_updates", "mail_plugin_updates");
			//add_submenu_page("smtp_mail", "Feature Requests", __("Feature Requests",mail_bank), "read", "mail_feature_requests", "mail_feature_requests");
			//add_submenu_page("smtp_mail", "Recommendations", __("Recommendations", mail_bank), "read", "recommended_plugins", "recommended_plugins" );
			//add_submenu_page("smtp_mail", "Our Other Services", __("Our Other Services", mail_bank), "read", "other_services", "other_services" );
			//add_submenu_page("smtp_mail", "System Status", __("System Status", mail_bank), "read", "mail_system_status", "mail_system_status" );
		break;
	}
}

//--------------------------------------------------------------------------------------------------------------//
// CODE FOR CREATING MENUS --END--
//---------------------------------------------------------------------------------------------------------------//

?>