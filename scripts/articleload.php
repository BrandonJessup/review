<?php

class ArticleData {
    public $title;
    public $body;
}

include 'dbconnect.php';

function validArticle($title) {
    $dbh = DatabaseHelpers::getDatabaseConnection();

    $stmt = $dbh->prepare("SELECT * FROM articles WHERE title=:title LIMIT 1");
    $stmt->execute(["title" => $title]);

    // No row was found with matching title in database.
    if ($stmt->fetch()) {
        return true;
    }
    else {
        return false;
    }
}

function getFolderName($title) {
    $dbh = DatabaseHelpers::getDatabaseConnection();

    $stmt = $dbh->prepare("SELECT id FROM articles WHERE title=:title LIMIT 1");
    $stmt->execute(["title" => $title]);

    $id = $stmt->fetch();
    $folderName = $id['id'] . " - " . $title;

    return $folderName;
}

function parseArticle($path) {
    $file = fopen($path . "/article", "r");

    $articleData = new ArticleData;

    // Read the first line to get the page title.
    $firstLine = rtrim(fgets($file));
    // Ensure title line matches our article format.
    if (strpos($firstLine, "title: ") !== false) {
        $articleData->title = ltrim($firstLine, "title: ");

        // Ensure the next line conforms to the syntax by checking for 5 # symbols.
        $separatorLine = rtrim(fgets($file));
        if ($separatorLine === "#####") {
            // Feed the main contents of the article into our return variable.
            $articleData->body = "";
            while ($line = fgets($file)) {
                $articleData->body .= $line;
            }
        }
        else {
            $articleData->body = "Article is not in the proper format!";
        }
    }
    else {
        $articleData->title = "Article Error";
        $articleData->body = "Article is not in the proper format!";
    }

    fclose($file);
    return $articleData;
}
