<?php

use App\Models\Project;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use \App\Models\Profile;
use \App\Models\User;
use \App\Models\ProfileProject;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::get('/', function () 
    {
    
    // current datetime
    date_default_timezone_set('Asia/Singapore');
        
    $projects_expiring = Project::where('status','=','live')->orderby('expired_at','asc')->limit(9);
    
    $projects_expiring = $projects_expiring->simplePaginate(3);
    $owners = Profile::all();


    foreach ($projects_expiring as $project_expiring) {
        # code...
    }

    $all_projects = Project::where('status','=','live')->get();
    

    return view('welcome',compact('projects_expiring','owners','all_projects'));
});


Route::get('/profiletest', function () {
    return view('profiletest');
});

Route::get('/projecttest', function () {
    return view('projecttest');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/project', App\Http\Controllers\ProjectController::class);
Route::resource('/profile', App\Http\Controllers\ProfileController::class);
Route::resource('/profileproject', App\Http\Controllers\ProfileProjectController::class);

Route::get('/category/{category}', 'App\Http\Controllers\CategoryController@show');
return view('welcome');





// Forced reduce image
Route::get('/redimg', function () {
    $imgs = scandir('C:/Users/User/Desktop/creative/storage/app/public/project/');
    foreach ($imgs as $img) {
        try {
            $image = Image::make(public_path("storage/project/{$img}"))->fit(547, 308); // open image->fit image->save image
            $image->save();
        } catch (Exception $e) {
            //do nothing
        }
    }

    $imgs = scandir('C:/Users/User/Desktop/creative/storage/app/public/profile/');
    foreach ($imgs as $img) {
        try {
            $image = Image::make(public_path("storage/profile/{$img}"))->fit(300, 300); // open image->fit image->save image
            $image->save();
        } catch (Exception $e) {
            //do nothing
        }
    }
});






// test

Route::get('/profiletest', function () {

     // inputs here
     $num_owners = 30;
     $num_backers = 200;
    
     // create owner / profile / project
 
     for ($x = 1; $x <= $num_owners; $x++) {
         $user = new User;
         $rand_list =['Mac Smith', 'Josan', 'Top Cow Productions', 'IronSpike', 'Dan Brereton', 'Flesk Publications', 'Melissa Pagluica', 'IronSpike', 'Erika Moen', 'Tesladyne LLC', 'Inclusive Press', 'Gabrielle Lyon', 'Dork Storm Press', 'Travis McIntire', 'Felipe Cagno', 'Rukis', 'Brad Guigar', 'Koteri Ink', 'Michael Finn', 'Brad Guigar', 'ComixTribe', 'Holy Crow Press', 'Jason Inman', 'Megan Rose Gedris', 'Clayton McCormack', 'Dark Planet Comics', 'Billy Tucci and Crusade Fine Arts, Ltd.', 'HEK', 'Stephanie Phillips', 'Joe Brusha', 'Dirk Manning', 'Ron Randall', 'Hiveworks Comics', 'Ron Randall', 'Alex Kain', 'Michael Kingston', 'Joey Worldweaver', 'Charlie Stickney', 'TappyToon', 'Space Goat Productions, Inc.', 'Push Publication', 'EMET Comics', 'Ron Randall', 'Simon Amadeus Pillario (A Morgan)', 'Space Between Entertainment', 'Blake Northcott', 'Drew Ford', 'Skidd', 'Pat Shand', 'Andrew Tarusov', 'Anadia', 'Chris Bodily', 'Kelly Dale', 'Michael Kingston', 'Zack Soto', 'Dark Planet Comics', 'Brandon Dixon', 'Jason Inman', 'Pat Shand', 'Graham Nolan', 'Alex Kain', "Devil's Due Ent", 'Robyn Chapman', 'Jon Schnepp', 'Top Cow Productions', 'Thom Collins', 'Antarctic Press', 'Zan Christensen', 'Lando Griffin', 'Push Publication', 'Les Friction', 'Pat Shand', 'Richard Raaphorst', 'Mark Andrew Smith', 'jeff douglas messer', 'Zan Christensen', 'Return of the Condor Heroes Manga', 'Bun Boi', 'Antarctic Press', 'Jessi Eichberger', 'Derec Donovan', 'Adorned by Chi', 'Dark Planet Comics', 'Nathan Schreiber', 'Push Publication', 'Mark Edward Lewis', 'Rivenis', 'SCSM', 'Russell Nohelty', 'Josh Hano', 'Cow House Press', 'Push Publication', 'Pixel Pirate Studio', 'Erasmus Fox, Inc.', 'David Derrick', 'David Crownson', 'Sean Wang', 'Ominous Press', 'Team Kamikaze', 'Jason Rosen', 'Lorraine Avila', 'Ron Marz', 'The Yaoi Army', 'Action Lab Comics', 'joepi', 'EMET Comics', 'Greene County Creative', 'Jason Yungbluth', 'Open Field Studio, LLC', 'Apotheosis Studios', 'Zan Christensen', 'The Intergalactic Postal Service', 'Tavis Maiden'];
         $user->name = $rand_list[array_rand($rand_list, 1)];
         $user->email = "owner" . $x . "@qwe.com";
         $user->password = Hash::make('qweqwe', [
             'rounds' => 12,
         ]);
         $user->push();
 
         $profile = new App\Models\Profile;
         $profile->description = "I am a project owner";
         $profile->user_id = $x;
         $profile->image = 'profile/profiles' . random_int(1, 80) . '.jpg';
         $profile->URL = "https://www.google.com";
         $profile->push();
 
         
         for ($i=0; $i < random_int(1,4); $i++) { 
             
             $project = new App\Models\Project;
             $project->profile_id = $x;
             $project->status = 'live';
 
             $y=random_int(1,130);
             $rand_list1 = ['Scurry: The Drowned Forest - a post-apocalyptic mouse tale', "Scurry: The Shadow's Curse - A Post-Apocalyptic Mouse Tale", 'The Future is Now - Nightfall', 'The Darkness Complete Collection Vol. 1 HC', 'The Crossroads at Midnight', 'Dan Brereton’s GIANTKILLER Monster Edition Hardcover', 'The Thousand Demon Tree by Jeffrey Alan Love', 'Above the Clouds - the complete graphic novel!', 'Patience & Esther: An Edwardian Romance', 'Oh Joy Sex Toy: Volume 4', 'Atomic Robo and the Dawn of a New Era HARDCOVER EDITION!', 'Bingo Love', 'No Small Plans: A graphic novel adventure through Chicago', 'THE TAO OF IGOR: a new Dork Tower collection by John Kovalic', 'TWIZTID HAUNTED HIGH-ONS: The Darkness Rises Collected Ed.', 'The Few and Cursed: Shadow Nation', 'Red Lantern - Conviction', 'Evil Inc After Dark, Vol. 2', 'Kings of Nowhere: Graphic Novel by Koteri Ink', 'The Liberty Brigade - Graphic Novel - 100+ pages of action!!', 'Evil Inc After Dark — NSFW comics with smutty superheroes', 'SINK: Blood & Rain - Crime/Horror GN will Break Kickstarter', 'PUNCH', 'SCIENCE! - An Original Graphic Novel', 'This Book is Full of FILTH', 'Bloody Hel', "Stephan Franck's PALOMINO", "Billy Tucci's ZOMBIE-SAMA! Graphic Novel with John Broglia", 'HEK TREASURY', "Kicking Ice : A Graphic Novel About Women's Hockey", 'Grimm Tales of Terror, a Horror Anthology Comic Book Series', 'TALES OF MR. RHEE Volume 4: "Everything Burns" KS Hardcover', 'TREKKER: THE DARKSTAR ZEPHYR OGN', 'Life of Melody - Complete Graphic Novel', 'TREKKER: CHAPELTOWN Graphic Novel', 'Beyond the Western Deep: Volume Two', 'Headlocked: Tales From The Road', 'SPLIT EARTH SAGA: Where Fantasy Becomes Futuristic', 'White Ash: Volume 1', 'Bloody Sweet Vol. 2 (and Vol. 1) Graphic Novel', '30th Anniversary Evil Dead 2 Comic Book Omnibus and Art Book', 'When Days Rewind Volume 3', 'FRESH ROMANCE brings you VOLUME 2 & VERONA', 'TREKKER: BATTLEFIELDS Graphic Novel', 'The Gospel of Mark: Word for WORD Bible Comic (Book 4)', 'AFTERGLOW - A graphic novel by Pat Shand & K. Lynn Smith', 'EVERGLADE ANGELS - a graphic novel', 'THE LONELY WAR OF CAPT. WILLY SCHULTZ', 'UberQuest: Volume II - Call of the Relic', 'DESTINY, NY: Volume Three (Volumes 1 - 3 available!)', '"Swinging Island" Erotic Graphic Novel', 'Knights of Asherah Volume #2 Fantasy Graphic Novel', 'Black Lantern - Book One', 'Jeremy Dale: Skyward Omnibus', 'Headlocked: The Hard Way', 'The Secret Voice Volume 1 - A Psychedelic Fantasy Epic', 'SILVER Volume 4', 'Drift of Dreams | A Swordsfall Graphic Novel', 'Jupiter Jet & the Forgotten Radio - Original Graphic Novel', 'DESTINY, NY: Volume Four (Volumes 1 - 4 available!)', "Batman artist Graham Nolan's Monster Island Comic & Art Book", 'Beyond the Western Deep: Volume One', 'SQUARRIORS: New Oversize Hardcover & Variant Cards', 'American Cult: A Comics Anthology', 'FIVE', 'GOLGOTHA', 'Occultation I', "Fred Perry's Gold Digger - FREDeral Reserve Gold Brick", 'DASH: The Gay Noir Graphic Novel', 'Suited Racer: Volume 1 | Graphic Novel', 'Noble Love', 'Les Friction: The Graphic Novel - Episode 1', 'DESTINY NY: Volume Two -- ONE HOUR LEFT!', 'Worst Case Scenario Graphic Novelisation', "GLADSTONE'S SCHOOL FOR WORLD CONQUERORS 3", 'THE PILGRIM Book One By Mark Ryan and Mike Grell', "Steve MacIsaac's UNPACKING", "Return of the Condor Heroes Collector's Edition Manga Boxset", 'A Boblin’s Tale, A Graphic Novel', "Fred Perry's GOLD DIGGER Color Gold Brick Seven", "The Author's Apprentice", 'Trigger Mortis', 'Adorned by Chi: The Graphic Novel', 'SILVER Volume 3', 'Big Trouble with Simple Machines: Science Ninjas Comic', 'Love, Tears & Sand', 'Omega 1 - The Hacker Wars | Comic Book', 'Diskordia Book 2', 'ANIMALHEADS, Volume I: ORIGIN STORIES ARE FOR HEROES', 'Ichabod Jones Volume 1-2: A Lovecraftian dark-fantasy comic', 'Nefarious: Graphic Novel Volume 1', 'Lemonade Summer by Gabi Mendez : Kid-Friendly LGBTQ Stories!', 'Noble Love 2: Nobility Lost', 'Papa Cherry Graphic Novel', "Paul Dini's BOO & HISS", 'Ghost of the Gulag Vol.2', 'The Return of Harriet Tubman : Demon Slayer!', 'RUNNERS Volume 1: Bad Goods - Graphic Novel - IN COLOR!', 'Dread Gods Sci-Fi/Fantasy Graphic Novel, Art Book', 'Kamikaze: Volume 2 and SoundBox', 'MONSTERWOOD Book 2: Awakening - A Fantasy Graphic Novel.', 'Celestial Summer: A Graphic Novel', 'Ron Marz, Darryl Banks Team for WW2 Harken’s Raiders Comic', '"Fujoshi Trapped in a Seme\'s Perfect Body 4" Yaoi Gay Manga', 'PRINCELESS : THE PIRATE PRINCESS', 'Suncatcher by Jose Pimienta', 'JELLY VAMPIRE - Not Safe for Children', 'SORGHUM & SPEAR - Fantasy Graphic Novel & Animation Short', 'Weapon Brown: Aftershock', 'Knight & Beard: Volume 1', 'The Last Amazon: Post-Apocalyptic Superhero Graphic Novel', '13: The Astonishing Lives of the Neuromantics', 'Space Bastards - Volume 1 Hardcover', 'Tenko King Volume 2: Heart of the Mountain', 'Code 45 #1-3 - Urban Fantasy ft. Dragons, Drugs, Raves', 'Anguish Garden: The Graphic Novel', "Jonah's Voyage to Atlantis (Comic Book)", 'Icarus & Jellinek Graphic Novels by Gregory A. Wilson', 'WARLOCK 5: Comic written by Cullen Bunn (Deadpool, X-Men)', 'The Bobcat', 'Adamsville Book 3 and Complete Collection Boxset', 'Sweatbands Graphic Novel', 'True Terror - Book #1 (Comic Series/Graphic Novel)', 'Angora Napkin: The Golden McGuffin', 'Halls of the Turnip King', 'JARDIN MÉCANIQUE: THE GRAPHIC NOVEL - LA BANDE DESSINÉE', 'Kickstarter Gold: Happily Ever Aftr The Graphic Novel!', "A KING'S VENGEANCE", 'Tuberculosis 2020', 'When I go to sleep - a graphic novel on insomnia', 'REMEMBER YOUR FIRST KISS?', 'PSYCARIO Limited Edition Graphic Novel', 'La barda: una novela gráfica', 'Impresión "Niña Piñata"', 'Las Bocas de Belcebú - Cómic'];         
             $project->title = $rand_list1[$y];
             $rand_list2 = ["Two mice lost in a cursed land must avoid monstrous predators and find a way home before it's too late to save their colony.", 'A colony of mice in an abandoned house struggle to survive a long, strange winter. The humans are all gone and the sun is rarely seen.', "The night falls in Robo-City Prime. You've just received a message from Max Overload, he needs your help.", 'Celebrate 25 Years of The Darkness', "Abby Howard's ALL-NEW collection of horror comics, ready and waiting to make your Halloween terrifying!", 'An oversized, expanded hardcover collection of the classic American Kaiju Epic', "Jeffrey Alan Love's dream-like images take its viewers on an epic journey in his first painted graphic novel.", 'Intertwines two stories -- a hero who must save a dying world and a girl who must convince an author to finish what he started.', 'Will Patience & Esther escape their lives of servitude in the country for a life with one another? A turn-of-the-century WLW romance!', 'The 4th printed standalone collection of Oh Joy Sex Toy! A free sex ed & sex toy review webcomic by Erika Moen, Matt Nolan & Guests!', 'The hardcover collected edition of the hit comic book series ATOMIC ROBO AND THE DAWN OF A NEW ERA! Also a handsome tote bag.', 'Bingo Love: A Black Queer romance graphic novella', 'Help us put this book into the hands of thousands of Chicago teens and inspire them to design the city they want, need and deserve.', "The Tao of Igor - a self-contained storyline - John Kovalic's first DORK TOWER collection in ten years!  HUZZAH! IT MUST BE MINE!", 'Collected edition of hip-hop icons TWIZTID\'s comic debut HAUNTED HIGH-ONS: "The Darkness Rises" #1-5 written by Dirk Manning!', 'A brand new and complete Few and Cursed tale about a postwoman with a mission to end a war.', 'A fully-illustrated intertwined tale of plight and compassion in the midst of  enslavement, forced colonization, and war atrocities.', 'NSFW comics with smutty superheroes. Adults Only', 'A graphic novel taken place in a world where humans turn in to animals. Shunned, they learn to strive in the criminal underworld.', 'A WW II story featuring Golden Age heroes/villains of the 1940s by Ron Frenz, Barry Kitson, Michael Finn & Mark Waid (editor)', 'TWO great print collections! The smutty supervillain series "Evil Inc After Dark" and the risque relationship romp "Courting Disaster"!', 'A new rain-soaked, blood-drenched 160-page volume of the hit crime thriller comic! Limited hardcover available, collects SINK #6-10.', 'An Inconvenient Guide to Eternal Damnation', 'Breaking through dimensions during class is just a normal day at the ultimate SCIENCE school in this 80 page graphic novel.', 'An an-thot-logy of comic smut and fun activities for grown up weirdoes', 'A 100-page graphic novel about 5 mystically-powered viking warriors who suddenly find themselves caught in the middle of World War I', 'A Neo Noir Graphic Novel Set In LA’s Country Music Clubs', 'An all-new origin story graphic novel featuring offerings for the upcoming revival of the long awaited Shi - Return of the Warrior!', 'Matt Kindt, Brian Hurtt, & Marie Enger present The HEK TREASURY: a deluxe hardcover collection of ALL NEW sci-fi/fantasy themed stories', 'Kicking Ice is Graphic Novel about the importance of inclusiveness, equality, and empowerment in sports.', "Keep the lights on and don't read before bedtime! Tales of Terror Volume 1 Hardcover reprint & Limited Edition Collectibles.", 'Demon-hunter Mr. Rhee faces his most horrific challenge yet when his arch nemesis returns to burn him and everything he loves to ash...', 'BRACE FOR IMPACT: Ron Randall’s sci-fi hero Mercy St. Clair faces deception, betrayal, and destiny aboard THE DARKSTAR ZEPHYR!', 'Help us print Life of Melody - a queer romantic comedy & fantasy graphic novel about a fairy godfather and a beast raising a child.', "PRAY FOR MERCY: Ron Randall's tough sci-fi bounty hunter Mercy St. Clair treks to the final frontier world of CHAPELTOWN!", 'The all-ages fantasy webcomic BEYOND THE WESTERN DEEP returns to Kickstarter with its second hardcover volume!', 'An anthology of short stories set in the Headlocked universe, co-created by some of the biggest names in wrestling.', 'Comic & Art book. Illustration style aims to blend Western approach to power and athleticism & Eastern aesthetics in grace and form.', 'A 200 page, hardbound edition, collecting the first 4 issues of White Ash and an all-new tale of fantasy, horror and forbidden romance.', 'Volume 1 also returns! Hit fantasy romance as a 560p full-color comic book! Vampire ❤️ Witch - From creator Narae Lee.', 'LIMITED EDITION! Oversized hardcover collections of the Evil Dead 2 Comic Books and Art Book of the comic book and board game!', 'The highly anticipated adult light novel is back!', 'Critically-acclaimed romance anthology series FRESH ROMANCE is returning for VOLUME 2 and introducing an original graphic novel, VERONA', 'Sci-fi bounty hunter Mercy St. Clair heads to the remote Delta Quadrant, where she is caught in the crossfires of a raging warzone.', 'Hard hitting, historically accurate, unabridged & untamed graphic novel of the Gospel of Mark! 128-pg, full colour. Aimed at ages 15-40', 'A post-apocalyptic adventure about a girl and her mutated cat from the creators of PLUME and DESTINY, NY.', "An all new graphic novel that will crack you square in the skull – it’s unfiltered survival horror like you've never seen before!", 'One of the most powerful and controversial stories ever told in the medium of comics will finally be completed and collected!', 'A Fantasy/Sci-Fi Graphic Novel', 'Logan used to be a magical girl. Lilith is the last surviving member of a mystical crime family. This is their love story.', 'Sex-positive softcover comic book for adults only.', 'A modern fantasy featuring magic, dark secrets, and Gods that are supposed to be long dead. What could possibly go wrong?', 'Black Lantern is a Halloween themed adventure/comedy graphic novel by Chris Bodily of Hatrobot', "Skyward issue 10: the perfect conclusion for Jeremy Dale's series. The 250+ page Omnibus holds all 10 issues, artwork, and so much more", 'The next chapter in the gritty coming-of-age wrestling drama - exclusive stories by Flair, Foley, Rhodes, & Omega! Cover by Lawler!', "I'm making a super cool fantasy comic filled with  psychic warrior monks, wild kung fu magic battles, monsters, and a bit of romance!", 'A group of conmen and the descendent of Van Helsing team up to steal a treasure…. from a castle full of vampires. What could go wrong?!', 'Xavian corruption has invaded The Tapestry. Wake up or find yourself corrupted.', 'This 17-year-old girl yearns to fly her jetpack across the SOLAR SYSTEM! JUPITER JET returns in a NEW sci-fi adventure graphic novel!', 'Logan used to be a magical girl. Lilith is the last surviving member of a mystical crime family. This is their love story.', 'Monsters! Aliens! Classic adventure comic Monster Island, plus hardcover art book of rare drawings by Graham Nolan, co-creator of Bane!', 'Help us bring the epic all-ages fantasy webcomic BEYOND THE WESTERN DEEP to life with this gorgeous hardcover collection!', 'Squarriors Vol. 1 and Upcoming Vol. 2 collected in individual Kickstarter Oversize hardcovers, TPBs, new game cards & Enamel Pins!', 'From editor/publisher Robyn Chapman comes American Cult, a nonfiction comics anthology about religious cults in the United States', '"FIVE" follows the story of five out of thirteen survivors who have all been transformed by a genetic test gone horribly wrong.', "The creators behind CYBER FORCE, POSTAL, THINK TANK, EDEN'S FALL and APHRODITE IX bring you a new 128-page graphic sci-fi novel!", 'The long-awaited epic 240-page prequel to Occultation II & III.', 'Collecting many of Gold Digger spinoffs and other material from outside regular series', 'A disgraced detective. A bad boy lover. A mysterious femme fatale. And lurking in the heart of 1940s Los Angeles… a primeval horror!', 'A dystopian future filled with propaganda & without privacy. The Suited Racer, the last anon, must use social media to tip the scales.', 'A Samurai-theme hentai Light Novel from PUSH! that features the epic love journey of two prodigal samurai, Aoi & Sakura.', 'A Graphic Novel based on the inspirational music of Les Friction.', 'Logan McBride was a magical girl with a destiny. Now, she\'s a 30-year-old New Yorker with rent to pay. ("Projects of Earth" spotlight.)', "A Graphic novel about the never produced movie 'Worst Case Scenario'.", "Gladstone's School for World Conquerors Book 3 Hardcover. Have a Future as a Super-villain? Enroll Now!", 'Secret Government Psy-Ops and the world of the Occult combine for a ripped from the headlines tale of horror and adventure', "Steve MacIsaac's tale of (not) moving on after heartbreak—serialized in his gay anthology SHIRTLIFTER—is becoming a graphic novel.", "Jin Yong's classic Wuxia love story adapted by comic artist Wee Tian Beng is finally available in a complete deluxe boxset!", 'The story of a cute Goblin named Boblin, and his realization of what his life’s call truly is.', 'OVER 600 pages, this edition collects issues #201-225 of the Gold Digger series by Fred Perry. FIRST TIME in Brick format!', "A comic featuring living books, escaped characters, and a bumbling vampire for an assistant. Welcome to The Author's Apprentice!", 'Trigger Mortis is a 64 page Zombie Western Hardcover Graphic Novel from Derec Donovan', "We're creating an interactive multi-media graphic novel about West African Magical Girls (and a guy)!", 'Con men team up with a female vampire hunter to rip-off vampires--what could go wrong?!', 'Learn physics fundamentals in a 120 page graphic novel! Explore a bold world with fun characters on a scientific treasure hunt! Ages 8+', 'A tropical yuri light novel about two young women that overcome objections, fears, and struggles to find true happiness in paradise.', '
             Help complete the first chapter of this epic, longstanding sci-fi comic, turn it into a trade paper back, and... TV PILOT!', 'Diskordia is an ongoing surreal fantasy webcomic. Help fund the printing of the second book as a deluxe 200 page hardcover', 'Volume I production of the hit webcomic series ANIMALHEADS. Follow four friends as they commit crimes together.', "A Lovecraftian dark fantasy horror-comedy inspired by H.P. Lovecraft's Dreamlands and Cthulhu mythos but set in a Christian Apocalypse.", "We're creating the Nefarious graphic novel! 150+ full color pages that follow the adventures of the master villain, Crow.", 'Coming-of-age short comics about LGBTQ and non-binary youths exploring queer identities and going on grand adventures together.', 'Join Aoi and Sakura as they embark on a new mission as they meet old friends and make new allies to hunt down their enemy, Kiku.', 'Papa Cherry is a gritty supernatural romance story about a struggling guitarist who sells his soul to the Devil to become Rock legend.', 'A ghost mouse torments the cat who killed him in this deliciously twisted graphic novel written by Paul Dini, with art by Dave Alvarez.', 'The continuing story of a blind tiger and his raven as they fight to survive in the unforgiving Taiga.', 'Follow Harriet Tubmans \u200badventures in chapters  #3  to #6!', 'The highly acclaimed sci-fi adventure series gets an upgrade! Volume 1 now in COLOR!', 'Deluxe, definitive Dread Gods hardcover from creators Bart Sears, Ron Marz, Tom Raney', 'The saga continues! Help us print the Kamikaze Volume 2 graphic novel and SoundBox, a thrilling spinoff comic. Also includes Volume 1!', 'MONSTERWOOD Book 2: Awakening is a coming of age, Fantasy Graphic Novel set in the ancient, haunting and beautiful world of Magog.', 'An Exploration of Black Love.', 'Green Lantern Kyle Rayner creators join forces again for graphic novel, art book.', 'Shoujo meets Yaoi / Boys Love! A story about a girl who carelessly wishes to become a man to start her own BL adventure. Huuwaah?!', 'A deluxe hardcover for Princeless Book 3: the story that launched the critically acclaimed spinoff, Raven: Pirate Princess.', 'A graphic novel written and illustrated by Jose Pimienta about a teenage musician in Mexicali in the early 2000s.', 'Emet Comics presents a collection of inappropriate comics by Norwegian creator, Ida Neverdahl.', 'Our saga returns as the Forever War now calls upon Namazzi and the girls of the Eternal Realm.  Executive produced by Nichelle Nichols.', 'Kickstart the reprint of the kickass Weapon Brown graphic novel and bring the next Weapon Brown project to life!', 'A fantasy buddy comedy, starring Knight, an angry young girl who wants to be a hero, and Beard, a gentle giant that hates conflict!', 'A fresh perspective on the graphic novel genre which chronicles the disparate factions and leaders that have risen after World War III', "Yves Navant's queer space opera follows an unlikely hero on a journey to become whole, and to topple the society that ripped him apart.", 'Volume 1 of a hardcover comic book featuring artwork by Darick Robertson, Simon Bisley, Colin MacNeil, Boo Cook, Clint Langley & more!', 'A High Seas Pirate adventure, Treasure, Trouble, Monsters & Magic! The next chapter in the Tenko King series.', 'Urban fantasy miniseries blending dragons, drugs, and underground raves in the metro tunnels of Montreal.', 'A post-apocalyptic Western, which is an allegory for leaving White supremacist movements.', "A comic book inspired by ancient legends, myths and J.R.R. Tolkien's translation of Jonah.", 'Gregory A. Wilson and Áthila Fabbio present the graphic novels of the winged young man, Icarus, and flamepetal prospector, Jellinek.', "Five guardians protect the multiverse. There's only one problem: they hate each other.", 'A Saga from The Old West...& Beyond\n    1898 Indian Territory- Will Firemaker is finding out the Myths & Legends of the Tribe are true', 'Help print the final volume of the LINEWebtoon featured comic series, and reprint books 1 and 2.', "A hilarious graphic novel about a high school tennis coach's quest for glory, and the players he will use to achieve his dreams.", 'A buddy-action comic about two mismatched female detectives and their investigation into a terrorist attack and a dark conspiracy.', 'Pegamoose Press is proud to present Angora Napkin: The Golden McGuffin, a brand new graphic novel by master cartoonist, Troy Little!', 'Prince Tatian Elfiore embarks on a royal mission to the Dwarven mines where all hope for peace hinges on one sacred vegetable!', 'The Jardin Mécanique comic book is a victorian horror steampunk extravaganza illustrated by the incredible Jeik Dion', 'Dating apps, Knights, and a kidnapped Princess come together in this fun LGBTQ friendly fantasy tale. Swipe right today!', 'A vexed warrior who was once a loving father and husband is brought back to life, 25 years later, to avenge the demons responsible.', 'A pandemic comic, based on my artistic work during the COVID-19 quarantine', '“when I go to sleep” a graphic novel about a night I struggled with insomnia, not helped at all by modern technology and social media.', 'A graphic short story about three girlfriends who share their experience of getting their first kiss.', 'JOHN WICK meets LOGAN and SIN CITY in spiritually charged action packed Graphic Novel.', 'Una edición limitada de nuestra novela gráfica "la barda"\nde los creadores de Anterra Crónicas y Gatos Citadinos.', 'Estamos recaudando fondos para imprimir la Novela Gráfica "Niña Piñata" a todo color, encuadernando ejemplares a mano por cuenta propia', 'Cómic spin-off de drama y aventura, desarrollado en un universo steampunk y gótico llamado Ellyllum.'];
             $project->caption = $rand_list2[$y];
             $rand_list = [500, 800, 1000, 1500, 2000];
             $project->goal = $rand_list[array_rand($rand_list, 1)];
             $rand_list = ['art', 'comic', 'game', 'film', 'music'];
             $project->category = $rand_list[array_rand($rand_list, 1)];
     
             $project->image = 'project/covers' . random_int(1, 641) . '.jpg';
 
             $day = random_int(1, 30);
             $month = random_int(8, 11);       // enter a range of months from-to current month to simulate project status
             $year = 2020;    
                     
             $project->created_at =  date_create(date("$year-{$month}-{$day} 0:0:0")); 
             $project->updated_at =  date_create(date("$year-{$month}-{$day} 0:0:0"));
     
             $project->push();
         }
 
     }
 
     // create backer / profile / project backing
 
     for ($x = $num_owners+1; $x <= $num_backers; $x++) {
         $user = new User;
         $rand_list =['Mac Smith', 'Josan', 'Top Cow Productions', 'IronSpike', 'Dan Brereton', 'Flesk Publications', 'Melissa Pagluica', 'IronSpike', 'Erika Moen', 'Tesladyne LLC', 'Inclusive Press', 'Gabrielle Lyon', 'Dork Storm Press', 'Travis McIntire', 'Felipe Cagno', 'Rukis', 'Brad Guigar', 'Koteri Ink', 'Michael Finn', 'Brad Guigar', 'ComixTribe', 'Holy Crow Press', 'Jason Inman', 'Megan Rose Gedris', 'Clayton McCormack', 'Dark Planet Comics', 'Billy Tucci and Crusade Fine Arts, Ltd.', 'HEK', 'Stephanie Phillips', 'Joe Brusha', 'Dirk Manning', 'Ron Randall', 'Hiveworks Comics', 'Ron Randall', 'Alex Kain', 'Michael Kingston', 'Joey Worldweaver', 'Charlie Stickney', 'TappyToon', 'Space Goat Productions, Inc.', 'Push Publication', 'EMET Comics', 'Ron Randall', 'Simon Amadeus Pillario (A Morgan)', 'Space Between Entertainment', 'Blake Northcott', 'Drew Ford', 'Skidd', 'Pat Shand', 'Andrew Tarusov', 'Anadia', 'Chris Bodily', 'Kelly Dale', 'Michael Kingston', 'Zack Soto', 'Dark Planet Comics', 'Brandon Dixon', 'Jason Inman', 'Pat Shand', 'Graham Nolan', 'Alex Kain', "Devil's Due Ent", 'Robyn Chapman', 'Jon Schnepp', 'Top Cow Productions', 'Thom Collins', 'Antarctic Press', 'Zan Christensen', 'Lando Griffin', 'Push Publication', 'Les Friction', 'Pat Shand', 'Richard Raaphorst', 'Mark Andrew Smith', 'jeff douglas messer', 'Zan Christensen', 'Return of the Condor Heroes Manga', 'Bun Boi', 'Antarctic Press', 'Jessi Eichberger', 'Derec Donovan', 'Adorned by Chi', 'Dark Planet Comics', 'Nathan Schreiber', 'Push Publication', 'Mark Edward Lewis', 'Rivenis', 'SCSM', 'Russell Nohelty', 'Josh Hano', 'Cow House Press', 'Push Publication', 'Pixel Pirate Studio', 'Erasmus Fox, Inc.', 'David Derrick', 'David Crownson', 'Sean Wang', 'Ominous Press', 'Team Kamikaze', 'Jason Rosen', 'Lorraine Avila', 'Ron Marz', 'The Yaoi Army', 'Action Lab Comics', 'joepi', 'EMET Comics', 'Greene County Creative', 'Jason Yungbluth', 'Open Field Studio, LLC', 'Apotheosis Studios', 'Zan Christensen', 'The Intergalactic Postal Service', 'Tavis Maiden'];
         $user->name = $rand_list[array_rand($rand_list, 1)];
         $user->email = "backer" . $x . "@qwe.com";
         $user->password = Hash::make('qweqwe', [
             'rounds' => 12,
         ]);
         $user->push();
 
         $profile = new App\Models\Profile;
         $profile->image = 'profile/profiles' . random_int(1, 80) . '.jpg';
         $profile->description = "I am a backer";
         $profile->user_id = $x;
         $profile->push();
     }
 
 
     // generate project backings
     for ($x = 1; $x <= 6 * ($num_backers + $num_owners); $x++) {
         $rand_backer = rand(1, $num_backers);
         $rand_project = rand(1, $project->count());
         $rand_list = [5, 25,50, 88, 128];
         $pledged = $rand_list[array_rand($rand_list, 1)];
 
         App\Models\Profile::find($rand_backer)->backing()->attach(App\Models\Project::find($rand_project), ['pledged' => $pledged]);
     };

    return view('profiletest');
});

