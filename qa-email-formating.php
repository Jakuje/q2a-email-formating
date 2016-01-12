<?php

/*
	Ecofys (c) Ruut Brandsma
	http://www.ecofys.com/


	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.question2answer.org/license.php
*/

	function qa_send_notification($userid, $email, $handle, $subject, $body, $subs, $html = false)
	{
		$subs['^url'] = '<a href="' . $subs['^url'] . '">' . $subs['^url'] . '</a>';
		return qa_send_notification_base($userid, $email, $handle, $subject, $body, $subs, true);
	}


	function qa_send_email($params)
	{
		require_once QA_INCLUDE_DIR.'qa-util-string.php';
		if (!$params['html'] || qa_opt('email_formating_overrule')){			 
			$body = "<p>".strtr(
			  $params['html'] ? $params['body'] : qa_html($params['body']),
			  array("\n"=>"</p><p>")
			 )."</p>";
	    $params['body'] = strtr(qa_opt('email_formating_body'), 
	      array("^body" => $body,
	       "^title"=> $params['subject'],
	       "^site_title"=> qa_opt('site_title'),
	       "^site_url"=> qa_opt('site_url'),
	       "^logo_url"=> qa_opt('logo_show') ? (qa_opt('site_url').qa_opt('logo_url')) : ' '
	       ));
			$params['html'] = true;
		}
		return qa_send_email_base($params);
	}

/*
	Omit PHP closing tag to help avoid accidental output
*/
