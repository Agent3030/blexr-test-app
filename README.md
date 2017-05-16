# Blexr test application
1. **Working demo**
    Working demo is available on address: 
    [dizo.online:8080](dizo.online:8080)
2. **Run local**
    You can easily run this application using docker.
    Install [Docker](https://docs.docker.com/engine/installation/linux/ubuntu/) and [Docker Compose](https://docs.docker.com/compose/install/#alternative-install-options) (of course if you don't have them).
  After successful installation go to the project root directory and run: 
   ` docker-compose up -d `
  That's all. Application  is available on 
  ` http://localhost:8080`
  Next step. You have to apply necessary migrations:
  `php yii migrate`
  and fill betting odds database table:
    `php yii fill-odds`
  Unfortunately, I didn't find clear algorithm to calculate betting odds and data after fill will be different from your example.
  In working demo I use data from test task. You can insert this data to DB manually from csv.file
  `/docker/odds_db/odds-test.csv `
3. **Markup and frontend**
  In `/markup` directory you can find all files and code regarding calculator  modal window. For development, I'm using `SASS` preprocessor and `gulp` project builder. I didn't use any html template engines, because this project to small to us it.
  In  `/markup/src`  - all source files
  In  `/markup/dist`  - distribution files.
  I've used JQuery and Bootstrap for responsive design? modals and other frontend manipulation. 
  As an application  backround I used standart framework starter theme.
4. **PHP**
  As I have experience with Yii2 framework. I've used it for backend development         
I installed basic template. As a database I've used postres. In such projects no difference between postgres and MySql. I used posgress for only one reason. It have remote access in base, from other side, for remote access to MySQL necessary to change config files.    
For log I've used [ipinfo.io](www.ipinfo.io) to get user info and store it to DB by user IP. 
