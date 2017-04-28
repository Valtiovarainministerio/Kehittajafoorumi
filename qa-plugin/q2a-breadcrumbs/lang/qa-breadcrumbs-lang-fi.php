<?php
    /*
        Question2Answer (c) Gideon Greenspan
        Q2A Breadcrumbs (c) Amiya Sahu (developer.amiya@outlook.com)

        http://www.question2answer.org/


        File: qa-plugin/q2a-breadcrumbs/qa-breadcrumbs-lang-default.php
        Version: See define()s at top of qa-include/qa-base.php
        Description: Widget module class for AdSense widget plugin


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

    /* don't allow this page to be requested directly from browser */
    if ( !defined( 'QA_VERSION' ) ) {
        header( 'Location: /' );
        exit;
    }

    return array(
        "opt_yes"                     => "Yes",
        "opt_no"                      => "No",
        "opt_truncate"                => "Truncate title in breadcrumb ",
        "not_found"                   => "Sivua ei löytynyt",
        "recent_que"                  => "Uusimmat",
        "home"                        => "Etusivu",
        "hot"                         => "Päivän polttavimmat",
        "most_votes"                  => "Eniten peukutuksia",
        "most_answers"                => "Eniten vastauksia",
        "most_views"                  => "Eniten lukukertoja",
        "no_ans"                      => "No Answer",
        "no_selected_ans"             => "No Selected Answer",
        "no_upvoted_ans"              => "No Upvoted Answer",
        "questions"                   => "Kysymykset",
        "unanswered"                  => "Vastaamatta",
        "categories"                  => "Aihealueet",
        "tags"                        => "Avainsanat",
        "tag"                         => "Avainsana",
        "users"                       => "Käyttäjät",
        "user"                        => "Käyttäjä",
        "ask"                         => "Kysy kysymys",
        "save_changes"                => "Save Changes",
        "custom_css"                  => "Custom CSS",
        "message"                     => "Viesti",
        "top_users"                   => "Top Scoring Users",
        "special"                     => "Special Users",
        "blocked"                     => "Blocked Users",
        "activity"                    => "Recent Activities",
        "settings_saved"              => "Breadcrumbs settings has been saved ",
        "dont_use_link_for_last_elem" => "Do not use link for the last element (usually it is a self link )",
        "searching_for"               => "Haku: ",
        "all_my_updates"              => "All My Updates",
        "my_favorites"                => "Suosikkini",
        "my_content"                  => "My Content",
        "login"                       => "Kirjaudu",
        "register"                    => "Rekisteröidy",
        "forgot"                      => "Unohdin salasanani",
        "messages"                    => "Yksityisviestit",
        "message"                     => "Yksityisviesti",
        "sent"                        => "Lähetetyt viestit",
        "inbox"                       => "Saapuneet viestit",
        "message_for_x"               => "Viesti käyttäjälle: ^",
        "account"                     => "Oma profiili",
        "favorites"                   => "Suosikkini",
        "answers"                     => "Vastaukset",
        "wall"                        => "Wall",
    );