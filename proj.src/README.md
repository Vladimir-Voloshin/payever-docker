Config for docker compose
-------------------------

https://hub.docker.com/r/voloshinvladimir/payever-docker/

Task description
=================

Setup SF2.8 project
 - Test task is Image gallery with simple structure - Album -> Images
 - Albums and images can be loaded from fixtures. Create/edit parts for album and images are NOT required, but welcome
 - Users functionality is NOT needed

We expect:
5 albums to be loaded
First album should contain 5 images
Every other album should contain 20+ images

Ajax GET albums with max 10 images for albums list - we test good skills in SQL

Ajax GET images when looking on Album in details
Images list should contain maximum 10 images
If album has more than 10 images - pagination should be visible, clicking on the page - images list should be changed. 
We expect usage of knp paginator bundle and  serializer

The site should be realized in single-page way, driven by Marionette.js with following routes:

‘’ : albums list
‘/album/:id’ : images list for album with id specified, page 1
‘/album/:id/page/:page’ : images list for album with id specified, page :page

We expect to see usage of Application, Router, Controller, LayoutVew, CollectionView and ItemView

Each route should be accessible when opening the page having url, means when we open the url in a separate tab - correct content must be loaded

Pages should have a design. Design quality doesn’t matter, we test CSS skills. Any modern decorations are welcome.

Store your code in github/bitbucket!
Exclude vendors folder from git project, we will install dependencies using composer.lock

We don’t need your gallery, that is just a test task. If you have samples of your code in github or participation  in other opensource projects - please share a link to github code.


**Requirements for PHP code:** <br />
conform http://symfony.com/doc/current/contributing/code/standards.html
we expect definitive variable names, doc-comments
we expect thin controllers, the business logic must be placed in separate managers, not controllers.
also we test where and what do u write. 
provide phpunit tests, we expect usage of mock objects.

Please don’t be lazy and make easy-to-understand structure, well separated.
We don’t limit you by time. Provide a well coded project, that’s only thing we require as a result. Please ensure that the code likes at least for you, don’t waste your time otherwise.


**Requirements for javascript:** <br />
has to be written on coffeescript<br />

**Requirements for css:** <br />
none, but we suggest to write on scss (compass)<br />

We test skills
----------------

Services self-written, DI
Repository usage, understanding the difference between controllers and other services
Data structure, hierarchy, code optimizations
Git knowledge
Understanding mysql
Javascript, jquery, coffee, backbone/marionette skills, understanding ajax
CSS/SCSS skills

*Please write your code in the way allowing us to test your skills in areas listed.*
