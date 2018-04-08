# Review Site Template
The goal here is to make an article-based generic review site template that is simple and cut-down as possible. In its current iteration there is no way to navigate between articles other than to enter in the URL of a page manually. A hub page and some semblance of useful design will be added as development progresses.

## Code you must edit
In order to use this, you must change/insert a few bits of code. Don't worry though, what you need to do in each place **_should_** be outlined for you clearly.
1. **scripts/dbconnect.php** lines 4 to 7 - Fill in the info to connect to your database.

## Adding a review
In the current version, articles must be added in the following manner:
1. Add title of the article to your database, this must not contain any hyphens. Whatever you put in this field will be seen in the webpage's URL when the article is open.
2. Create a folder in the articles directory and name it the 'id' and 'title' fields from the database, separating them by a hyphen. Ex. *5 - men in black ii*. See below for instructions for database table.
3. Create a file titled *article* (no extension) and fill in the contents according to the review syntax listed below.

## Review syntax
The file must be titled simply *article*. The first line of the article must be *title:* followed by the text you wish to appear in the browser tab (this is the HTML title tag). The second line must be a set of 5 number signs. Following those first two lines the rest of the file functions as the inside of a html body element.

```
title: Men in Black II
#####
<h1>Men in Black II</h1>
<p>I liked it a lot. I might even watch it a second time.</p>
```

## What does the database table look like?
I'm using MySQL for this and the columns in the table that store the article information are structured as follows:
1. **id** - unique value that auto-increments with each new article added.
2. **title** - what you wish to appear appended to the URL when the article is loaded, for example, a value of *men in black ii* will appear in the URL as *men-in-black-ii*. Use only numbers and lowercase letters.
3. **date** - timestamp that fills in current date automatically when row is created, serves as a sort of date-of-article-posted value.

Note that 'title' is the only column here that you will be entering manually for each review.

```
CREATE TABLE `articles` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` TINYTEXT NOT NULL COLLATE 'utf8_unicode_ci',
	`date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP PRIMARY KEY (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=MyISAM
AUTO_INCREMENT=1
;
```
