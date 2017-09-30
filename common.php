<?php

//writes the html head - requires the page title
function writeHTMLHead($title){
  echo '<!doctype html>\r\n
        <html lang="en">\r\n
        <head>\r\n
          <meta charset="utf-8">\r\n
          <title>$title</title>\r\n
          <link rel="stylesheet" href="css/style.css">\r\n
        </head>\r\n
        <body>\r\n';
}//end of writeHTMLHead

//writes the html footer
function writeHTMLFooter
  echo '</body>\r\n
        </html>';
}//end of writeHTMLFooter
