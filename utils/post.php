<?php

/* Stack Mobile - Bringing Stack Exchange Sites to Mobile Devices
   Copyright (C) 2012  Nathan Osman

   This program is free software: you can redistribute it and/or modify
   it under the terms of the GNU General Public License as published by
   the Free Software Foundation, either version 3 of the License, or
   (at your option) any later version.

   This program is distributed in the hope that it will be useful,
   but WITHOUT ANY WARRANTY; without even the implied warranty of
   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
   GNU General Public License for more details.

   You should have received a copy of the GNU General Public License
   along with this program.  If not, see <http://www.gnu.org/licenses/>. */

class Post
{
    // Generates a list of questions
    public static function GenerateQuestionList($site, $response)
    {
        $questions_html = array();
        
        while($question = $response->Fetch(FALSE))
        {
            // Generate the brief portion of the question shown
            $preview = strip_tags($question['body']);
            $preview = substr($preview, 0, 100) . ((strlen($preview) > 100)?'&hellip;':'');
            
            // Generate the tags for the post
            $tags_html = array();
            
            foreach($question['tags'] as $tag)
                $tags_html[] = "<span class='tag'>$tag</span>";
            
            $tags_html = implode('', $tags_html);
            
            // Generate the URL for the question
            $question_url = ViewUtils::GetDocumentRoot() . "/{$site['site']['api_site_parameter']}/questions/{$question['question_id']}";
            
            $questions_html[] = "<li><a href='$question_url' class='question'><h3>{$question['title']}</h3><p>$preview</p><p>$tags_html</p></a></li>";
        }
        
        return implode('', $questions_html);
    }
}

?>