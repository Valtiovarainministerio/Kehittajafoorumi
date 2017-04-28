<?php
	/* 
	 * Remove links to profile page on avatar image
	 * Original function in qa-include/app/users.php 
 	 */
	function qa_get_user_avatar_html($flags, $email, $handle, $blobid, $width, $height, $size, $padding=false)
	/*
		Return HTML to display for the user's avatar, constrained to $size pixels, with optional $padding to that size
		Pass the user's fields $flags, $email, $handle, and avatar $blobid, $width and $height
	*/
		{
			require_once QA_INCLUDE_DIR.'app/format.php';

			if (qa_opt('avatar_allow_gravatar') && ($flags & QA_USER_FLAGS_SHOW_GRAVATAR))
				$html=qa_get_gravatar_html($email, $size);
			elseif (qa_opt('avatar_allow_upload') && (($flags & QA_USER_FLAGS_SHOW_AVATAR)) && isset($blobid))
				$html=qa_get_avatar_blob_html($blobid, $width, $height, $size, $padding);
			elseif ( (qa_opt('avatar_allow_gravatar')||qa_opt('avatar_allow_upload')) && qa_opt('avatar_default_show') && strlen(qa_opt('avatar_default_blobid')) )
				$html=qa_get_avatar_blob_html(qa_opt('avatar_default_blobid'), qa_opt('avatar_default_width'), qa_opt('avatar_default_height'), $size, $padding);
			else
				$html=null;

			return (isset($html) && strlen($handle)) ? ($html) : $html;
		}

?>