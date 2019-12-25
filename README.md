# Laravel-forum-PHP
A-forum-web-application-developed-in-Laravel-PHP.
This is a forum titled UK markets where people can ask questions or comment on different posts on the website.

Features:
-The web application allows users to comment on existing items in the database. Those comments are stored and displayed alongside the items.
-Bootstrap and pagination are used to present the data effectively.
-Users can log into the web application.
-Items and comments are clearly linked to the user who posted them, for example "Posted by Bob Walton".
-There are multiple levels of authentication in the web application. Explicitly: Users and Admins (that have additional priviledges such as deleting posts and comments of any users).
-Users can only edit items and comments which they themselves posted.
-Users to create and edit only items that they posted.
-Custom validation has been implemented for users input data at various steps.
-Users can upload images which are displayed with their posts.
-Version control has been used effectively.

Advanced:
-The concept of MVC has been implemented in the code structure: 

    MVC separates the UI of an Application into three main aspects:
1.	The Model is set of classes that describes the data you are working with and the rules for how the data can be manipulated. In my code I have models for: Admin (Admin.php), User (User.php), Category, Thread, Image, Post, Vote and Comment. In the model classes I describe the relationships between models. The models have migrations that create tables in the database. From the database we can extract instances(entries) of those models that can populate our view that the user sees, or in other words model update the pages(views) of our website.
2.	The View defines how the application’s UI will be displayed. Views are formed out of blade.php files that can contain html, css, javascript, vue, ajax code. In my project I have views such as:
- login.blade.php that is the page displayed to the user to put in his credentials to log in into my application.
- question.blade.php that is the page where the user can see and input his question details in some fields it displays to him.
3. 	The Controller which is a set of classes which handles communication from the user, the overall application flow and application specific logic. This tells the view what to display and also updates/manipulates the model. There are also routes that specifie the controllers (controllers’ methods) that handle requests made by the user in the views. In my code I have multiple controllers such as:
	-ForumController.php that handles all the logic behind making, editing and deleting posts and comments, displays and uploads images and uses redirects or other imported methods.
	-AdminController.php that handles the logic behind the actions that a forum admin can do. They can see any post and delete them.

A MVC pattern example for my code is: threads.blade.php—sees-->User—uses-->ForumController.php—manipulates-->Thread.php—updates--> threads.blade.php


-A service container to communicate with an external API, using dependency injection has been implemented:

    My service container idea:
I want to make a class that has only one instance of a user authenticating with his social media account, where I can pre-configure methods and tools for each individually. By this, I mean that whenever a user logins with either Facebook or Github (by calling their API), this will create a data in my application about the site he chose to connect to, the information that I got from the site about the user and will login the user from now on with his social media account directly. 

    References:
Firstly, I need the controller SocialDataController.php with 2 methods: redirectToProvider and handleProviderCallback. Those methods can be called from a view using the routes: social-login1.redirect and social-login1.callback. The first one serves as a call to the social website and the second one is the callback from the social website. They both need the {provider} parameter to identify which social website makes the calls.
The first method redirectToProvider is called to provide: the provider of the site (Facebook or Github as $provider parameter), a call to the class SiteDetails where I can store and manipulate information about the site that the user calls (and logs in), and a call to the abstract method callSite from the SocialGatewayContract interface. The method callSite is implemented by both my “gateway” classes FbSocialGateway and GitSocialGateway and makes a request for authentication to the social site (or I should say respective API).
The second method handleProviderCallback is called to provide: the provider of the site (Facebook or Github as $provider parameter), and a call to the abstract method siteConnect from the SocialGatewayContract interface. The method siteConnect is implemented by both my “gateway” classes FbSocialGateway and GitSocialGateway and processes data received from the API by making a new user if it doesn’t exist in the database otherwise authenticates the user.
I know that here I should have had a more concrete & complex implementation of this with user and social sites data manipulation and passing but I only had time for just this functionality to implement into my web application.
The Facebook and Github external APIs are called through Socialite service.
Lastly, I have in the AppServiceProvider class in the register method the logic behind handling the type of the SocialGatewayInterface that needs to be called or injected in my application. Depending of the provider in the request, a new instance of the FbSocialGateway or GitSocialGateway is returned which is singleton in the application. (As the user can only have one email address to his account which is unique and can only login with either Github or Facebook).
The bigger scope for this service container is to provide authentication multiple times through the application whenever is needed such as: for Github you need to authenticate again to reset application tokens, or authenticate again to delete your account. The second scope is to provide data about the social site the user has made his account with and to pass and process any data received from the API about the user.
Right now, both the FbSocialGateway and GitSocialGateway might look the same but normally they would differ. For example, Github doesn’t require a user to have a name but it requires the user to have a nickname, which will throw an error if the fallback request is not implemented accordingly.
Another scope, and why this service container is very powerful, is that I don’t need to change any of my classes or controllers if either Facebook or Github changes their policy of handling requests. I can just go in their class that manipulates the request and change the implementation there, instead of changing my SocialGatewayContract interface or the implementation of other authentication social site.




