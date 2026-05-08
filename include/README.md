১. include সম্পর্কে জানা দরকার

২. সমস্যা কোথায়?

        এখন ধরো ভুল করে তুমি একই ফাইল দুইবার include করলে:

        <?php
        include 'functions.php';
        include 'functions.php';

        sayHello();
        ?>

        এখন PHP error দিবে:

        Fatal error: Cannot redeclare sayHello()

        কারণ একই function দুইবার তৈরি করার চেষ্টা হয়েছে।

৩. এখানেই include_once

        এই সমস্যা এড়ানোর জন্য include_once ব্যবহার করা হয়।

        <?php
        include_once 'functions.php';
        include_once 'functions.php';

        sayHello();
        ?>

        এখন কোনো error হবে না।

        কারণ:

        প্রথমবার file include হবে
        দ্বিতীয়বার PHP দেখবে file already include হয়েছে
        তাই আবার include করবে না