Hugh Ybarar Assist RX Code Test

##What was the test?

The test was a basic prove your skills kind of thing. The company requested that I finish building a paritally finished application. The applicaton consisted of two database tables patients, and songs. The client wanted the application to list the patients, and give the user the option of saving a song for each patient. There was a bunch of php and javascript that needed to be implemented. That just about sums up the test.
How was the test?
I think I spent a little more time working on this than I should have haha. I recently graduated and this is the only web related project I had going on at the time so instead of using plugins and libraries I just built things from scratch. I had a lot of fun working on this little project. But then i'm weird like that, coding is fun for me.

##What I did

To start out I had to restructure the folder structure. I'm used to having everything broken into individual pages with a single index.php controller acting as a sort of routing mechanism. So I broke the entire program and rebuilt it using the new file structure.
I kind of got stuck for a bit on the ajax controller. I have never implemented ajax in that manner before so it took me a little bit to restructure my entries to work in a similar fashion.
I had to make a bunch of edits to the patients, and song models. Because of the way that I built the project I had to make my own custom crud entries. To be honest i'm really glad I got to write crud again because it had been a while since I wrote my last crut statement. I have been using the FuelPHP ORM model so it was nice to get back into some good old fashion crud. Though I still prefer ORM!
There was one thing about the crud I was not really sure about. When I wrote the redundant song query, and the song not being used delete query, I was not sure if you wanted php to handle that or to build some sort trigger that automatically did that. I am confident in MySQL but I have not touched triggers in forever and a day so I was not sure what needed to be done there. I just built a crud statement that runs every time a user adds a new song, so everytime a user clicks the database updates.
I was going to use a plugin for the pagination control but then decided to build my own because I have never built one before. So I built the paginator. That was fun, it had more crud and I had to think.
added a 404 page for grins and giggles
For the ui aspect I went with GetBootstrap. I would consider myself more of a stronger back end and functionality developer than I am a designer. I can design but I tend to spend two to three times longer on the design aspect than the development aspect so I decided to use bootstrap awesome style. They are quick and easy and in my honest opinion look very good. So I did not write a lot of CSS but I do know how to write css. I can do just about anything in css if need be, but coming up with the design itself is not my strongest feature.
The site is responsive, but I did not finish building the responsive design because this was more of a proof of concept and not a full blown launch project. but it is responsive down to the cellphone and back.
If you're still reading this I implemented a little hidden easter egg. If you did not find it try entering the konami code on any of the pages. If you don't know what the konami code is just press, up up down down left right left right b a and have fun ^_^

##Was it hard?

In my experience nothing in programming is really hard, its more of implementing new things and trying new things out that become a challenge. My work flow usually consists of developing something, finding something I have never seen, done, or heard about, investigating, reading documentation, understanding, and then implementing. Since I have been coding whenever i come across something new It generally only takes a week to get up and running efficiently with it.
So that all being said, I thought the project was fun and time consuming but not hard. There was code to write, and I had to think when building some of the functionality but the test was not hard.

##What did you learn?

I learned another way to write ajax functionality and I learned how to build my own simple dynamic pagination control. I also learned that Itunes api only gives sample previews and not whole song plays. which was kind of a bummer.

##What If I had more time?

For starters I would probably use a framework and build it all out again. I enjoy coding in raw php and javascript but there is a lot of security functionality that a framework provides that I would not like to write myself and be able to implement.
I prefer non relational database just because it seems easier and quicker to implement so I would have built the site using a MEAN stack but for the scope of this project and the fact that you're looking for a PHP developer I could just as easily use a LAMP stack.
If the site were going live I would like to have had a development server to test on and a live server to push the site live and test again.
The first thing I did wrong in this project in my opinion is I built it for the desktop first. I have been trained Mobile first and that bit me in the butt. If I were to build this site again i would design it and build it for mobile first, and then build it up to the desktop version.
Thats about it I guess. Thank you for taking the time to read my comments and consider me as an applicant I look forward to hearing from you guys over at AssistRX. Have a good one1

