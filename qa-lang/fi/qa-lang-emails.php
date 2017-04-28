<?php
/*
	Question2Answer by Gideon Greenspan and contributors
	http://www.question2answer.org/

	File: qa-include/qa-lang-emails.php
	Description: Language phrases for email notifications


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

	return array(
		'a_commented_body'        => "Vastausta sivustolla ^site_title on kommentoinut ^c_handle:\n\n^open^c_content^close\n\Vastauksesi oli:\n\n^open^c_context^close\n\nVoit vastata lisäämällä oman kommenttisi:\n\n^url\n\nKiitos,\n\n^site_title",
		'a_commented_subject'     => '^site_title: Joku on kommentoinut vastaustasi',

		'a_followed_body'         => "Kommenttiisi sivustolla ^site_title on tullut uusi kysymys käyttäjän ^q_handle toimesta:\n\n^open^q_title^close\n\Vastauksesi oli:\n\n^open^a_content^close\n\nKlikkaa tästä vastataksesi uuteen kysymykseen:\n\n^url\n\nKiitos,\n\n^site_title",
		'a_followed_subject'      => '^site_title: Kommenttiisi on lisätty kysymys',

		'a_selected_body'         => "Onnittelut! Vastauksesi sivustolla ^site_title on valittu parhaaksi käyttäjän ^s_handle toimesta:\n\n^open^a_content^close\n\nKysymys oli:\n\n^open^q_title^close\n\nKlikkaa tästä nähdäksesi vastauksesi:\n\n^url\n\nKiitos,\n\n^site_title",
		'a_selected_subject'      => '^site_title: Vastauksesi on valittu parhaaksi!',

		'c_commented_body'        => "Uusi kommentti käyttäjän ^c_handle toimesta on on lisätty kommenttiisi sivustolla ^site_title:\n\n^open^c_content^close\n\nKeskustelu:\n\n^open^c_context^close\n\nVoit vastata lisäämällä uuden kommentin:\n\n^url\n\nKiitos,\n\n^site_title",
		'c_commented_subject'     => '^site_title: Kommenttiisi on lisätty uusi kommentti',

		'confirm_body'            => "Klikkaa tästä vahvistaaksesi sähköpostiosoitteesi sivustolla ^site_title.\n\n^url\n\nKiitos,\n^site_title",
		'confirm_subject'         => '^site_title: Sähköpostiosoitteesi vahvistaminen',

		'feedback_body'           => "Kommentit:\n^message\n\nNimi:\n^name\n\nSähköposti:\n^email\n\nEdellinen sivu:\n^previous\n\nUKäyttäjä:\n^url\n\nIP-osoite:\n^ip\n\nSelain:\n^browser",
		'feedback_subject'        => '^ palaute',

		'flagged_body'            => "Postaus käyttäjältä ^p_handle on saanut ^flags:\n\n^open^p_context^close\n\nKlikkaa tästä nähdäksesi postauksen:\n\n^url\n\n\nKlikkaa tästä nähdäksesi kaikki liputetut postaukset:\n\n^a_url\n\n\nKiitos,\n\n^site_title",
		'flagged_subject'         => '^site_title: liputettu postaus',

		'moderate_body'           => "Postaus käyttäjältä ^p_handle vaatii hyväksyntäsi:\n\n^open^p_context^close\n\nKlikkaa tästä hyväksyäksesi tai estääksesi postauksen:\n\n^url\n\n\nKlikkaa tästä selataksesi kaikkia jonossa olevia postauksia:\n\n^a_url\n\n\nKiitos,\n\n^site_title",
		'moderate_subject'        => '^site_title: moderointipyyntö',

		'new_password_body'       => "Uusi salasanasi sivustolle ^site_title on seuraava:\n\nSalasana: ^password\n\nSuosittelemme salasanasi vaihtamista välittömästi kirjauduttuasi sisään.\n\nKiitos,\n^site_title\n^url",
		'new_password_subject'    => '^site_title - Uusi salasanasi',

		'private_message_body'    => "Olet saanut yksityisviestin käyttäjältä ^f_handle sivustolla ^site_title:\n\n^open^message^close\n\n^moreKiitos,\n\n^site_title\n\n\nBlokataksesi yksityisviestejä mene profiilisivullesi:\n^a_url",
		'private_message_info'    => "Lisätietoja käyttäjästä ^f_handle:\n\n^url\n\n",
		'private_message_reply'   => "Klikkaa tästä vastataksesi käyttäjän ^f_handle yksityisviestiin:\n\n^url\n\n",
		'private_message_subject' => 'Yksityisviesti käyttäjältä ^f_handle sivustolla ^site_title',

		'q_answered_body'         => "Kysymyksesi sivustolla ^site_title on vastattu käyttäjän ^a_handle toimesta:\n\n^open^a_content^close\n\nKysymyksesi oli:\n\n^open^q_title^close\n\nVoit valita halutessasi tämän vastauksen parhaaksi tästä linkistä:\n\n^url\n\nKiitos,\n\n^site_title",
		'q_answered_subject'      => '^site_title: Kysymykseesi on vastattu',

		'q_commented_body'        => "Kysymystäsi sivustolla ^site_title on kommentoinut ^c_handle:\n\n^open^c_content^close\n\nKysymys oli:\n\n^open^c_context^close\n\nVoit vastata lisäämällä oman kommenttisi:\n\n^url\n\nKiitos,\n\n^site_title",
		'q_commented_subject'     => '^site_title: Joku on kommentoinut kysymystäsi',

		'q_posted_body'           => "Käyttäjä ^q_handle on esittänyt uuden kysymyksen:\n\n^open^q_title\n\n^q_content^close\n\nKlikkaa tästä nähdäksesi kysymyksen:\n\n^url\n\nKiitos,\n\n^site_title",
		'q_posted_subject'        => '^site_title: Sivulla on uusi kysymys',

		'remoderate_body'         => "Käyttäjän ^p_handle editoima postaus vaatii uudelleenhyväksyntäsi:\n\n^open^p_context^close\n\nKlikkaa tästä hyväksyäksesi tai piilottaaksesi editoidun postauksen:\n\n^url\n\n\nKlikkaa tästä selataksesi kaikkia jonossa olevia postauksia:\n\n^a_url\n\n\nKiitos,\n\n^site_title",
		'remoderate_subject'      => '^site_title: Moderointipyyntö',

		'reset_body'              => "Ole hyvä ja klikkaa tästä asettaaksesi salasanasi uudelleen sivustolla ^site_title.\n\n^url\n\nVaihtoehtoisesti, syötä koodi alla olevaan kenttään.\n\nKoodi: ^code\n\nJos et pyytänyt resetoimaan salasanaasi, älä välitä tästä viestistä.\n\nKiitos,\n^site_title",
		'reset_subject'           => '^site_title: Aseta unohtunut salasanasi uudelleen',

		'to_handle_prefix'        => "^,\n\n",

		'u_registered_body'       => "Uusi käyttäjä on rekisteröitynyt käyttäjätunnuksella ^u_handle.\n\nKlikkaa tästä nähdäksesi käyttäjäprofiilin:\n\n^url\n\nKiitos,\n\n^site_title",
		'u_registered_subject'    => '^site_title: Sivustolla on uusi rekisteröitynyt käyttäjä',
		'u_to_approve_body'       => "Uusi käyttäjä on rekisteröitynyt käyttäjätunnuksella ^u_handle.\n\nKlikkaa tästä hyväksyäksesi käyttäjän:\n\n^url\n\nKlikkaa tästä selataksesi kaikkia hyväksymistäsi odottavia käyttäjiä:\n\n^a_url\n\nKiitos,\n\n^site_title",

		'u_approved_body'         => "Voit katsoa uutta käyttäjäprofiiliasi täällä:\n\n^url\n\nKiitos,\n\n^site_title",
		'u_approved_subject'      => '^site_title: Käyttäjätilisi on hyväksytty',

		'wall_post_body'          => "^f_handle on postannut seinällesi sivustolla ^site_title:\n\n^open^post^close\n\nVoit vastata postaukseen täällä:\n\n^url\n\nKiitos,\n\n^site_title",
		'wall_post_subject'       => '^site_title: Uusi postaus seinälläsi',

		'welcome_body'            => "Kiitos rekisteröitymisestäsi sivustolla ^site_title.\n\n^custom^confirmSisäänkirjautumistietosi ovat seuraavat:\n\nKäyttäjätunnus: ^handle\nSähköpostiosoite: ^email\n\nOle hyvä ja pidä tämä tieto tallessa.\n\nKiitos,\n\n^site_title\n^url",
		'welcome_confirm'         => "Ole hyvä ja klikkaa tästä vahvistaaksesi sähköpostiosoitteesi.\n\n^url\n\n",
		'welcome_subject'         => 'Tervetuloa sivustolle ^site_title!',
	);


/*
	Omit PHP closing tag to help avoid accidental output
*/