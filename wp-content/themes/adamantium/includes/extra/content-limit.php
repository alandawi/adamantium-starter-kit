<?php
/*
  Usage:
  <?php the_content_limit(510, "..."); ?>
*/

function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
  $content = get_the_content($more_link_text, $stripteaser, $more_file);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  $content = strip_tags($content);

  if (strlen($_GET['p']) > 0) {
    echo "<p>";
    echo $content;
    echo "</p>";
  }
  else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
      $content = substr($content, 0, $espacio);
      $content = $content;
      echo "<p>";
      echo $content;
      echo "...";
      echo "</p>";
  }
  else {
    echo "<p>";
    echo $content;
    echo "</p>";
  }
}
?>