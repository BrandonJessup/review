<?php
include 'scripts/articleload.php';

$urlTail = $_SERVER['QUERY_STRING'];

// Remove the dashes from the tail if there are any.
$urlTail = str_replace("-", " ", $urlTail);

// Will be echoed into HTML.
$articleData = new ArticleData;
$articleData->title = "";
$articleData->body = "";

// No article is being requested, load the default page.
if ($urlTail === "") {
    $articleData->title = "Review Site";
    $articleData->body = "this is the default page";
}
// URL appears to be requesting we load an article.
else {
    // Article matching URL tail was found.
    if (validArticle($urlTail)) {
        // The path where the article is located.
        $folder = "articles/" . getFolderName($urlTail);

        // TODO: parse found article.
        // NOTE: $folder holds the correct value (has been tested)
        $articleData = parseArticle($folder);
    }
    // No article matching URL tail could be found.
    else {
        $articleData->title = "Article Not Found";
        $articleData->body = "article could not be found!";
    }
}
?>
<html>
    <head>
        <title><?php echo $articleData->title; ?></title>
    </head>
    <body>
        <?php echo $articleData->body; ?>
    </body>
</html>
