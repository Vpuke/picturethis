<a href="https://github.styleci.io/repos/226868587"><img src="https://github.styleci.io/repos/226868587/shield?branch=master" alt="StyleCI"></a>

# Picture This
<img src="https://media.giphy.com/media/6LzPPnutAquju/giphy.gif" width="100%" height ="700vh">

### About

In this assignment we are going to build an Instagram clone using PHP, HTML, CSS, Javascript and SQLite database.

### Requirements

* As a user I should be able to create an account. 
* As a user I should be able to login.
* As a user I should be able to logout.
* As a user I should be able to edit my account email, password and biography.
* As a user I should be able to upload a profile avatar image.
* As a user I should be able to create new posts with image and description.
* As a user I should be able to edit my posts.
* As a user I should be able to delete my posts.
* As a user I should be able to like posts.
* As a user I should be able to remove likes from posts.

### Extra

* As a user I'm able to delete my account along with all posts and comments.

### Features added for Picture That

* As a use I should be able to search and see a list of posts by query.
* As a user I should be able to follow and unfollow other users and see their feeds.
* Link to pull request https://github.com/Vpuke/picturethis/pull/3
* Features added by  [Terese Thulin](https://github.com/teresethulin)


### Getting started

* First you have to clone the repository picturethis, either via [this link](https://github.com/vpuke/picturethis) in Github desktop or `git clone https://github.com/vpuke/picturethis.git`in the terminal of your choice.
* Create server in terminal of your choice while in root of repository: ```PHP -S Localhost:1337```.
* Open Browser and write ```localhost:1337``` in address field.

### Testers

* [Viktor Sjöblom](https://github.com/viktorsjoblom) 
* [Henrik Björkvall](https://github.com/henricbjork)

### Code review

* [Jesper Lundqvist](https://github.com/jesperlndqvst) 

* <strike>register.php:12-43 - The form does not contain front end validation, which makes it possible to enter information that is not correct, such as an e-mail address that is not designed as an e-mail address. Add requeried to all input fields and change email input from text to email.</strike>

* <strike>app/register.php - In here, back end validation is needed for email addresses. It is now possible to enter email addresses in the database without an “@“ for example.</strike>

* app/register.php - Validation for empty data is also needed. It is now possible to enter empty strings in all fields and it still ends up in the database.

* <strike>settings.php:33 - Users are notified to go to settings or edit profile to update their biography when they are in settings.</strike> This is default message for biography.

* <strike>update-email-settings.php - Here again, back end validation is needed as it is now possible to remove the front end validation and then enter email addresses without “@“.</strike>

* <strike>footer.css:20-34 - Since all elements here have the same styling, you can minimize the code by selecting all with a comma. This will prevent you from repeating yourself.</strike>

* <strike>index.php:12 - Don't forget to add loading lazy to the images.</strike>

* <strike>profile.css: 20 && 73 - You can write: “margin: 10px” instead of: “margin: 10px 10px”, as it does the same thing.</strike>

* <strike>main.js:13-29 Since you do not use the event attribute in these functions, there is no need to define event in the event listener.</strike>

* overall - Nicely written code that is easy to read and well indented. It was fun and educational for me to study your code. Good work!

### Made by

* [Viktor Puke](https://github.com/vpuke) 

### License

This project is licensed under MIT license, please see further details [here](https://github.com/Vpuke/picturethis/blob/master/LICENSE)
