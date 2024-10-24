/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.28-MariaDB : Database - sports_blogging
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`sports_blogging` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `sports_blogging`;

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_type` varchar(50) NOT NULL,
  `is_active` enum('Active','InActive') DEFAULT 'Active',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `role` */

insert  into `role`(`role_id`,`role_type`,`is_active`) values 
(1,'Admin','Active'),
(2,'User','Active');


/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT 2,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text NOT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `user_image` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `is_approved` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `is_active` enum('Active','InActive') DEFAULT 'InActive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user` */

insert  into `user`(`user_id`,`role_id`,`first_name`,`last_name`,`email`,`password`,`gender`,`date_of_birth`,`user_image`,`address`,`is_approved`,`is_active`,`created_at`,`updated_at`) values 
(1,1,'Muhammad','Talha','talha@gmail.com','talha','Male','2000-02-15','../User_Image/1716715585_IMG-20221130-WA0002.jpg','Pakistan  ','Approved','Active','2024-05-21 18:00:11','2024-05-26 14:26:25'),
(2,1,'Qasim','Moosani','qasim@gmail.com','qasim','Male','2001-02-12','../User_Image/1716548893_1716546329_1716302218_IMG-20221128-WA0046.jpg.jpg','house 1122 hyderabad','Approved','Active','2024-05-22 08:16:41','2024-05-25 11:00:09'),
(3,2,'Ahsan','Ali ','ahsan123@gmail.com','ahsan','Male','2000-08-22','../User_Image/1716432063_IMG-20221128-WA0043.jpg','Hyderabad, Sindh, Pakistan ','Approved','Active','2024-05-23 07:48:33','2024-05-26 14:42:16'),
(4,2,'Khaleeque','Ahmed','khaleeque12@gmail.com','khaleeque','Male','2000-07-27','../User_Image/1716432478_IMG-20221130-WA0063.jpg','Digri, Sindh, Pakistan ','Approved','Active','2024-05-23 07:47:58','2024-05-26 14:40:57'),
(5,2,'Hassan','Naqvi','hassan12@gmail.com','hassan','Male','2001-06-19','../User_Image/1716616361_IMG-20221130-WA0003.jpg','Hyderabada, Pakistan','Pending','InActive','2024-05-25 10:52:41',NULL),
(6,2,'Abdul','Moiz','moiz12@gmail.com','moiz','Male','2000-10-30','../User_Image/1716616439_IMG-20221128-WA0042.jpg','Hyderabad, Pakistan','Approved','InActive','2024-05-25 10:53:59',NULL),
(7,2,'Mubashir','Ahmed','mubashir12@gmail.com','mubashir','Male','2000-09-28','../User_Image/1716616623_IMG-20221130-WA0009.jpg','Hyderabad,Pakistan','Pending','InActive','2024-05-25 10:57:03',NULL),
(8,2,'Zain','Ali','zain12@gmail.com','zain','Male','2000-12-27','../User_Image/1716616719_IMG-20211116-WA0001.jpg','Hyderabad, Pakistan','Rejected','InActive','2024-05-25 10:58:39',NULL);


/*Table structure for table `blog` */

DROP TABLE IF EXISTS `blog`;

CREATE TABLE `blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `blog_title` varchar(200) DEFAULT NULL,
  `post_per_page` int(11) DEFAULT NULL,
  `blog_background_image` text DEFAULT NULL,
  `blog_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`blog_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `blog` */

insert  into `blog`(`blog_id`,`user_id`,`blog_title`,`post_per_page`,`blog_background_image`,`blog_status`,`created_at`,`updated_at`) values 
(1,1,'News',3,'../Blog_Image/1716617124_SPORTSNEWS_LOGO.jpg','Active','2024-05-25 11:05:24','2024-05-26 22:03:42'),
(2,1,'Articles',3,'../Blog_Image/1716617175_istockphoto-174859622-612x612.jpg','Active','2024-05-25 11:06:15','2024-05-27 10:48:40'),
(3,2,'Trending',3,'../Blog_Image/1716617264_5KufCkI2.jpg','Active','2024-05-25 11:07:44',NULL);

/*Table structure for table `category` */

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(100) DEFAULT NULL,
  `category_description` text DEFAULT NULL,
  `category_image` text DEFAULT NULL,
  `category_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `category` */

insert  into `category`(`category_id`,`category_title`,`category_description`,`category_image`,`category_status`,`created_at`,`updated_at`) values 
(1,'Cricket','Cricket is a bat-and-ball game that is played between two teams of eleven players on a field.','../Category_Image/1716617373_istockphoto-1255328634-612x612.jpg','Active','2024-05-25 11:09:33',NULL),
(2,'Football','Football is a family of team sports that involve, to varying degrees, kicking a ball to score a goal.','../Category_Image/1716617452_216-scaled-1.jpg','Active','2024-05-25 11:10:52',NULL),
(3,'Tennis','Tennis is a racket sport that is played either individually against a single opponent (singles) or between two teams of two players each (doubles).','../Category_Image/1716617564_tennis-game-tennis-balls-rackets-background_488220-348.jpg','Active','2024-05-25 11:12:44',NULL),
(4,'Basketball','Basketball is a team sport in which two teams, most commonly of five players each, opposing one another on a rectangular court.','../Category_Image/1716617883_istockphoto-959080376-612x612.jpg','Active','2024-05-25 11:18:03','2024-05-26 22:04:50'),
(5,'Hockey','Hockey is a term used to denote a family of various types of both summer and winter team sports which originated on either an outdoor field, sheet of ice, or dry floor such as in a gymnasium.','../Category_Image/1716617962_istockphoto-1440779743-612x612.jpg','Active','2024-05-25 11:19:22','2024-05-26 22:04:38'),
(6,'Snooker','Snooker is a cue sport played on a rectangular billiards table covered with a green cloth called baize.','../Category_Image/1716618041_360_F_102692223_qRZ5M3hbgK746vZYT43BohruJ1OeVdnC.jpg','Active','2024-05-25 11:20:41',NULL);

/*Table structure for table `following_blog` */

DROP TABLE IF EXISTS `following_blog`;

CREATE TABLE `following_blog` (
  `follow_id` int(11) NOT NULL AUTO_INCREMENT,
  `follower_id` int(11) DEFAULT NULL,
  `blog_following_id` int(11) DEFAULT NULL,
  `status` enum('Followed','Unfollowed') DEFAULT 'Followed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`follow_id`),
  KEY `blog_following_id` (`blog_following_id`),
  KEY `follower_id` (`follower_id`),
  CONSTRAINT `following_blog_ibfk_1` FOREIGN KEY (`blog_following_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `following_blog_ibfk_2` FOREIGN KEY (`follower_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `following_blog` */

insert  into `following_blog`(`follow_id`,`follower_id`,`blog_following_id`,`status`,`created_at`,`updated_at`) values 
(1,3,2,'Followed','2024-05-26 11:50:15',NULL),
(2,3,1,'Followed','2024-05-26 12:58:20',NULL),
(5,4,3,'Followed','2024-05-26 22:20:34',NULL);

/*Table structure for table `post` */

DROP TABLE IF EXISTS `post`;

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_id` int(11) DEFAULT NULL,
  `post_title` varchar(200) NOT NULL,
  `post_summary` text NOT NULL,
  `post_description` longtext NOT NULL,
  `featured_image` text DEFAULT NULL,
  `post_status` enum('Active','InActive') DEFAULT NULL,
  `is_comment_allowed` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_id`),
  KEY `blog_id` (`blog_id`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`blog_id`) REFERENCES `blog` (`blog_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post` */

insert  into `post`(`post_id`,`blog_id`,`post_title`,`post_summary`,`post_description`,`featured_image`,`post_status`,`is_comment_allowed`,`created_at`,`updated_at`) values 
(1,1,'Pak vs Ireland','Pakistan won the 3-match T20I series 2-1','Pakistan 181 for 4 (Babar 75, Rizwan 56, Mark Adair 3-28) beat Ireland 178 for 7 (Tucker 73, Balbirnie 35, Tector 30*, Shaheen 3-14, Abbas 2-43) by six wickets\r\n\r\nAn imperiously accurate bowling spell from Shaheen Shah Afridi and quick half-centuries from Mohammad Rizwan and Babar Azam took Pakistan to a six-wicket win over Ireland to complete a 2-1 T20I series victory in Dublin on Tuesday.\r\n\r\n\r\nIreland, inspired by a 41-ball 73 from stand-in captain Lorcan Tucker, put up a competitive 178. But Babar and Rizwan made light work of what was, in truth, a below-par total, and another tame bowling performance and sloppy fielding effort from Ireland meant the result was beyond doubt long before the winning runs were struck.\r\n\r\nAfter Babar won the toss and asked Ireland to bat as in the second game, Shaheen and Mohammad Amir bowled a tidy first three overs in stark contrast to the manner in which the two were taken apart two days earlier. Shaheen got his first wicket in that period, but Hasan Ali conceded 16 in his first over as Andy Balbirnie and Tucker began to make up for lost time. Off 49 eventful deliveries as Pakistan\'s bowling plans fell apart slightly, Ireland\'s second-wicket partnership plundered 85, seemingly setting themselves up for a score around 200.','../Post_Image/1716624627_o1fik1tg_ireland-vs-pakistan_625x300_10_May_24.jpg','Active',1,'2024-05-25 13:10:27','2024-05-26 22:04:14'),
(2,1,'Real Madrid CF vs Villarreal CF','Villarreal 4-4 Real Madrid An eventful match ends 4-4.','Alexander Sorloth produced a remarkable second-half hat-trick as Villarreal came from three goals down to draw 4-4 with Real Madrid in a La Liga thriller.\r\nCarlo Ancelotti’s side looked to be in for another comfortable afternoon as a brace from Arda Guler and goals from Joselu and Lucas Vazquez saw them take a 4-1 lead at the break.\r\nSorloth’s goal at 2-0 down appeared to be nothing more than a consolation going into the second period but the Norwegian’s quick-fire hat-trick in the space of eight minutes brought the hosts level.\r\n\r\nThe 28-year-old’s four goals saw him take the lead in the race for the Pichichi but having failed to claim all three points, Villarreal can no longer qualify for European football next season.\r\nAs for Los Blancos, Ancelotti won’t be too concerned by the result having wrapped up the league title and playing a significantly weakened line-up ahead of their UEFA Champions League final against Borussia Dortmund.\r\nArda Guler opened the scoring for the visitors with a clinical finish after some well-worked build-up play before Joselu doubled their lead with an excellent header and his tenth league goal of the campaign.\r\nSorloth\'s equally impressive headed effort was almost instantly cancelled out by Vazquez\'s tidy finish before Guler looked to put the game to bed with his second and Madrid\'s fourth of the contest.\r\nMarcelino made three changes at half-time but it was captain Gerard Moreno, who was in the starting eleven after returning from injury, who set up the three second-half strikes.\r\nThe first with an excellent cross to find the head of Sorloth once again, before some intricate and accurate passing created the next two which the Norwegian finished smartly on his left foot.\r\nVillarreal looked the more likely to find a winner with Sorloth going closest as they pushed for all three points but the result sees them remain in eighth, four points adrift of Real Betis in the final European spot with just one game to play.\r\nReal Madrid remain 12 points clear at the top of the table having been crowned champions at the start of the month but their wait for a victory away to Villarreal in La Liga extends to seven games.','../Post_Image/1716627343_1632514427_381477_1632514542_noticia_normal_recorte1.jpg','Active',1,'2024-05-25 13:55:43',NULL),
(3,3,'Babar to lead a pace-heavy Pakistan side at T20 World Cup','They name five quicks in the 15-member squad with Abrar Ahmed the only specialist legspinner','Babar Azam will lead a Pakistan side for the third successive time at the T20 World Cup when he will fly out with the 15-member squad for the tournament next month. The PCB neither named a vice-captain nor any traveling reserves even though the World Cup will be played in the USA and the Caribbean over almost a month.\r\n\r\nIn an announcement that came hours before the ICC deadline to submit the final squad, there were a few surprises with Pakistan sticking to the touring party they chose for the T20Is in Ireland and England. No one from outside that group was selected. Hasan Ali, who was released back to Warwickshire earlier this week, missed out, alongside Irfan Khan and Agha Salman.\r\n\r\n\r\nAbbas Afridi made the final cut, meaning Pakistan go into the tournament with five specialist fast bowlers. Imad Wasim, who came out of retirement for this tournament, was the left-arm spin option, with Abrar Ahmed the only specialist legspinner.\r\n\r\n\"This is an extremely talented and balanced side that has a mixture of youth and experience. These players have been playing together for some time and look well prepared and settled for next month\'s event,\" a statement attributed to the selection committee in a PCB release said.\r\n\r\n\"Haris Rauf is fully fit and bowling well in the nets. It would have been nice if he had gotten an outing at Headingley [in the first T20I against England which was washed out], but we remain confident that he will continue to maintain an upward trajectory in the upcoming matches, as he will have an important role to play along with other strike bowlers in the T20 World Cup.\"\r\n\r\nESPNcricinfo learnt that an initial squad was finalised and sent to PCB chairman Mohsin Naqvi on May 23, but a conflict around due process emerged, with certain members of the selection panel feeling they had not been consulted properly. Naqvi asked to see the minutes of the meeting and voting patterns of prior meetings, which had not been recorded.\r\n\r\nAs a result, the squad was rejected and returned to the selection panel, with Naqvi insisting the members achieve consensus on the squad and the meeting minutes be recorded. The PCB rejected any notion of the chairman interfering in specific selection decisions, and that the reason for the initial squad being rejected was the failure to follow due process as set out for the selection committee.\r\n\r\nPakistan had opted to not announce a provisional squad at the start of the month, something most other sides did. In the end, they were the last team to officially confirm their final squad, with all 19 other teams having submitted theirs a few days ago.\r\n\r\nPakistan are currently in the middle of a T20I series in England, with the second match in Birmingham on Saturday. They fly out to the USA after the series concludes, with all four of Pakistan\'s group stage matches in the United States. They don\'t play any warm-up games before the big tournament.','../Post_Image/1716629894_381429.3.jpg','Active',1,'2024-05-25 14:38:14',NULL),
(4,3,'Barcelona Sack Club Legend Xavi Hernandez After Trophyless Season','Xavi Hernandez will take charge of the team\'s final La Liga match on Sunday at Sevilla before departing.','Barcelona sacked coach Xavi Hernandez on Friday after the Catalan giants failed to win a trophy this season. Xavi will take charge of the team\'s final La Liga match on Sunday at Sevilla before departing. \"Barcelona president Joan Laporta has told Xavi Hernandez he will not continue as coach for the 2024-25 season,\" said Barcelona in a statement. Former Bayern Munich and Germany coach Hansi Flick is heavily tipped to replace Xavi.\r\n\r\nBarcelona Sack Club Legend Xavi Hernandez After Trophyless SeasonXavi Hernandez will take charge of the team\'s final La Liga match on Sunday at Sevilla before departing.Agence France-PresseUpdated: May 24, 2024 05:49 PM ISTRead Time: 2 min\r\n\r\nBarcelona Sack Club Legend Xavi Hernandez After Trophyless Season\r\nBarcelona sacked coach Xavi Hernandez on Friday after the club failed to win a trophy.© AFP\r\nBarcelona sacked coach Xavi Hernandez on Friday after the Catalan giants failed to win a trophy this season. Xavi will take charge of the team\'s final La Liga match on Sunday at Sevilla before departing. \"Barcelona president Joan Laporta has told Xavi Hernandez he will not continue as coach for the 2024-25 season,\" said Barcelona in a statement. Former Bayern Munich and Germany coach Hansi Flick is heavily tipped to replace Xavi.\r\n\r\nPlayUnmute\r\nFullscreen\r\nIn January, Xavi said he would leave at the end of the season but, after a run of strong form, in April he and president Laporta agreed the coach would stay for the next campaign, with his contract expiring in June 2025.\r\n\r\nHowever, the situation quickly changed with Spanish media reporting Laporta was angered by Xavi\'s comments suggesting it was hard for the financially-hamstrung club to compete with Real Madrid and other elite European sides.\r\n\r\n\"Barcelona want to thank Xavi for his work as coach, which adds to his unmatchable career as a player and the captain of the first team, and wish him all the best in the future,\" continued Barcelona\'s statement.\r\n\r\n\"In the coming days, Barcelona will reveal the new coaching structure for the first team staff.\"\r\n\r\nBarcelona won La Liga last season but were not able to successfully defend the title in the current campaign.','../Post_Image/1716630073_luig9ndo_xavi-hernandez-afp_625x300_24_May_24.jpg','Active',1,'2024-05-25 14:41:13',NULL),
(5,3,'Rafael Nadal Faces Alexander Zverev At Farewell French Open As Iga Swiatek, Naomi Osaka Eye Clash','RafaelNadalwill face world number four Alexander Zverev in a blockbuster first round match at his farewell French Open while women\'s champion Iga Swiatek and fellow four-time major winner Naomi Osaka are on a second round collision course','Rafael Nadal will face world number four Alexander Zverev in a blockbuster first round match at his farewell French Open while women\'s champion Iga Swiatek and fellow four-time major winner Naomi Osaka are on a second round collision course. Defending men\'s champion and 24-time Grand Slam champion Novak Djokovic will face French veteran Pierre Hugues-Herbert in his opener. Nadal, who has won Roland Garros on 14 occasions, is unseeded after injury saw his ranking plummet to 276. He and Zverev met in the semi-finals in 2022 when the German was forced to retire after suffering a serious ankle injury. Nadal, the winner of 22 Grand Slam titles, will turn 38 next week and this season will be his last on tour.\r\n\r\nHe holds a 7-3 winning head-to-head record against Germany\'s Zverev with five of those victories coming on clay.\r\n\r\nZverev, 27, arrives in Paris on the back of lifting the Rome Open title last weekend.\r\n\r\n\"I\'m going to play the French Open thinking that I can give my all, 100 per cent,\" said Nadal after a second round exit in Rome last week.\r\n\r\nAs well as 14 titles in Paris, Nadal can boast a record of 112 wins and just three losses, two of which came against Djokovic who will be chasing a fourth French Open title.\r\n\r\nDjokovic turned 37 on Wednesday and marked the occasion by winning the 1,100th match of his career in Geneva.\r\n\r\nThe Serb has yet to win a title in 2024 with runs to the semi-finals at the Australian Open and Monte Carlo Masters his best performances.\r\n\r\nFollowing Thursday\'s draw, Djokovic is seeded to face Zverev in the semi-finals.\r\n\r\nWorld number two Jannik Sinner, who took Djokovic\'s Australian Open title in January, faces Christopher Eubanks of the United States.\r\n\r\nThird-seeded Wimbledon champion Carlos Alcaraz, a semi-finalist in Paris in 2023, plays a qualifier.\r\n\r\nSinner and Alcaraz are seeded to meet in the semi-finals but both men have been suffering from injuries which forced them to skip the Rome event.\r\n\r\nAndy Murray, the 2016 runner-up, is also competing at the tournament for the final time.\r\n\r\nThe 37-year-old tackles 2015 champion Stan Wawrinka, 39, in a battle of grizzled Grand Slam veterans.\r\n\r\nThe pair have met 22 times in a two-decade rivalry with Murray boasting a 13-9 edge.\r\n\r\nThree of those clashes have come at Roland Garros with Murray winning in the semi-finals in 2016 while the Swiss came out on top in the last-four in 2017 and first round in 2020.\r\n\r\nIn the women\'s draw, top seed and world number one Swiatek will take on a qualifier with Osaka facing Lucia Bronzetti of Italy in their openers before a potential second round clash.\r\n\r\nSwiatek is bidding to win a fifth major and fourth French Open title.\r\n\r\n\"It feels like home here,\" said Swiatek who arrives at the tournament with clay-court titles in Madrid and Rome under her belt. \r\n\r\nFormer world number one Osaka, now ranked 134, has never got past the third round in Paris. Bronzetti, the world number 48, has yet to win a main draw in two visits.\r\n\r\nOsaka, 26, has endured a bittersweet relationship with the French Open.\r\n\r\nIn 2021, she was fined for opting out of mandatory media commitments before withdrawing from the competition after just one match insisting she was protecting her mental health.\r\n\r\nOsaka missed the 2023 edition due to being pregnant before giving birth to a baby girl in July.\r\n\r\nSwiatek, meanwhile, is bidding to become the first player to lift three successive women\'s titles in Paris since Justine Henin in 2007.\r\n\r\nWorld number two Aryna Sabalenka starts against 101-ranked Erika Andreeva of Russia.\r\n\r\nThird seed and US Open champion Coco Gauff faces a qualifier in the first round and is seeded to face Swiatek in the semi-finals.\r\n','../Post_Image/1716630220_eh1it6lg_s_625x300_23_May_24.jpg','Active',1,'2024-05-25 14:43:40',NULL),
(6,3,'Picks for 2023-24 NBA award winners','NBA.com\'s writers reveal their picks for Kia MVP, Kia Rookie of the Year, Kia Defensive Player of the Year and more.','With just a few days left in the regular season, list your picks for 2023-24 NBA award winners.\r\n\r\nSteve Aschburner\r\n\r\nVoter fatigue? More like voter surrender, acknowledging Denver’s Nikola Jokic as the league’s best player again. The eye test is plenty, but his on/off impact for the Nuggets is greater than in his two previous MVP seasons. Victor Wembanyama ultimately ran away with the ROY and, before long, will have his name edged on the awards immediately above and below him on our lists.\r\n\r\nMy closest call was Oklahoma City’s Mark Daigneault edging Minnesota’s Chris Finch in COY.\r\n\r\nKia MVP = Nikola Jokic, Denver Nuggets\r\nKia Rookie of the Year = Victor Wembanyama, San Antonio Spurs\r\nKia Defensive Player of the Year = Rudy Gobert, Minnesota Timberwolves\r\nKia Sixth Man of the Year = Naz Reid, Minnesota Timberwolves\r\nKia Most Improved Player = Tyrese Maxey, Philadelphia 76ers\r\nKia Clutch Player of the Year = DeMar DeRozan, Chicago Bulls\r\nNBA Coach of the Year = Mark Daigneault, Oklahoma City Thunder\r\nBrian Martin\r\n\r\nI’ve got two players joining exclusive clubs with their latest honors. Nikola Jokic edges out Luka Doncic to become the seventh player to win three Kia MVPs in a four-season span. In doing so, Jokic joins Bill Russell, Wilt Chamberlain, Kareem Abdul-Jabbar, Larry Bird, Magic Johnson and LeBron James as the only players to accomplish that feat.\r\n\r\nRudy Gobert holds off fellow Frenchman Victor Wembanyama to win his fourth Kia Defensive Player of the Year award, tying Dikembe Mutombo and Ben Wallace for the most ever. Wemby, though, may have something to say about Gobert trying to be the first to five.\r\n\r\nKia MVP = Nikola Jokic, Denver Nuggets\r\nKia Rookie of the Year = Victor Wembanyama, San Antonio Spurs\r\nKia Defensive Player of the Year = Rudy Gobert, Minnesota Timberwolves\r\nKia Sixth Man of the Year = Malik Monk, Sacramento Kings\r\nKia Most Improved Player = Jalen Williams, Oklahoma City Thunder\r\nKia Clutch Player of the Year = DeMar DeRozan, Chicago Bulls\r\nNBA Coach of the Year = Mark Daigneault, Oklahoma City Thunder\r\nJohn Schuhmann\r\n\r\nThe first three awards listed below were relatively easy selections. Bogdanovic has the box score numbers and the Hawks have been much better with him on the floor. Most Improved was the toughest pick, but Williams has seen a big jump in per-36 numbers and has improved his efficiency.\r\n\r\nGilgeous-Alexander has shot 57% in the clutch, with the Thunder 22-11 in clutch games that he’s played in. Daigneault, meanwhile has a team in the top six on both ends of the floor with it getting 41% of its minutes (the league’s fourth-highest rate) from rookies or second-year players.\r\n\r\nKia MVP = Nikola Jokic, Denver Nuggets\r\nKia Rookie of the Year = Victor Wembanyama, San Antonio Spurs\r\nKia Defensive Player of the Year = Rudy Gobert, Minnesota Timberwolves\r\nKia Sixth Man of the Year = Bogdan Bogdanovic, Atlanta Hawks\r\nKia Most Improved Player = Jalen Williams, Oklahoma City Thunder\r\nKia Clutch Player of the Year = Shai Gilgeous-Alexander, Oklahoma City Thunder\r\nNBA Coach of the Year = Mark Daigneault, Oklahoma City Thunder\r\nShaun Powell\r\n\r\nNot many sleepless night choices this season, although in the case of Joel Embiid (MVP) and Alperen Sengun (Most Improved), the new 65-game minimum for eligibility probably cost them some hardware and would’ve cost me some Zs.\r\n\r\nWith a third MVP in four seasons, Jokic would crash the company of Larry Bird, Magic Johnson, LeBron James, Moses Malone and Michael Jordan for the greatest such stretches since the ABA-NBA merger in 1976. Gobert getting a fourth DPOY would tie him with Dikembe Mutombo and Ben Wallace for most ever and punch his ticket to the Hall of Fame.\r\n\r\nAnd Curry needs the Clutch Award because really, what else has he done in his career?\r\n\r\nKia MVP = Nikola Jokic, Denver Nuggets\r\nKia Rookie of the Year = Victor Wembanyama, San Antonio Spurs\r\nKia Defensive Player of the Year = Rudy Gobert, Minnesota Timberwolves\r\nKia Sixth Man of the Year = Malik Monk, Sacramento Kings\r\nKia Most Improved Player = Coby White, Chicago Bulls\r\nKia Clutch Player of the Year = Stephen Curry, Golden State Warriors\r\nNBA Coach of the Year = Chris Finch, Minnesota Timberwolves\r\nMichael C. Wright\r\n\r\nThe MVP seemed obvious, as Jokic appears poised to snag another one. Defensive Player of the Year, Clutch Player of the Year and NBA Coach of the Year were tougher. Gobert receives the DPOY nod for now, but Wembanyama has a legit case as a rookie and could wind up swaying my vote. Curry and DeMar DeRozan are neck and neck for Clutch. Chris Finch and Jamahl Mosely deserve serious consideration for Coach of the Year, too.\r\n\r\nKia MVP = Nikola Jokic, Denver Nuggets\r\nKia Rookie of the Year = Victor Wembanyama, San Antonio Spurs\r\nKia Defensive Player of the Year = Rudy Gobert, Minnesota Timberwolves\r\nKia Sixth Man of the Year = Malik Monk, Sacramento Kings\r\nKia Most Improved Player = Tyrese Maxey, Philadelphia 76ers\r\nKia Clutch Player of the Year = Stephen Curry, Golden State Warriors\r\nNBA Coach of the Year = Mark Daigneault, Oklahoma City Thunder','../Post_Image/1716630430_jokic-wemby-fist-bump.jpg','Active',1,'2024-05-25 14:47:10',NULL),
(7,3,'Pakistan Hockey Team Finally Receive Visas for Netherlands Tour','Secretary of the Pakistan Hockey Federation, Rana Mujahid announced on Thursday that the national team has successfully obtained visas for their upcoming tour to the Netherlands. ','The competition is structured into two pools, with Pakistan placed in Pool B alongside Canada, France, and Malaysia. Pool A comprises Austria, Korea, New Zealand, South Africa, and Poland.\r\n\r\nThe Pakistani squad has been rigorously preparing for this crucial series of matches, focusing on strategic plays and enhancing team coordination.\r\n\r\nRana Mujahid confirmed that the Pakistan team already left for Amsterdam on Thursday to kickstart their training regime ahead of their clash against the Dutch hockey team.\r\n\r\nPakistan’s hockey fraternity eagerly anticipates the team’s performance, hoping for a successful campaign that will elevate Pakistan’s status in international hockey.\r\n\r\nUnder the managerial brilliance of Roelant Oltmans, the team reached the final of the Sultan Azlan Shah Cup where they lost to Japan on penalty shootouts.\r\n\r\nDespite failing to qualify for the Paris Olympics 2024 and the FIH Hockey World Cup the team has earned its reputation back on the international stage as a formidable side following their performances in the Sultan Azlan Shah Cup.\r\n\r\nDespite failing to qualify for the Paris Olympics 2024 and the FIH Hockey World Cup the team has earned its reputation back on the international stage as a formidable side following their performances in the Sultan Azlan Shah Cup.\r\n\r\n','../Post_Image/1716630738_hockey.jpg','Active',1,'2024-05-25 14:52:18',NULL),
(8,3,'WHEN DOES SNOOKER GOAT RONNIE O\'SULLIVAN RETURN TO ACTION?','Ronnie O\'Sullivan is set to chase a record sixth Shanghai Masters title with the elite invitational event the first major snooker tournament of the new season in July.','Ronnie O\'Sullivan is set for a short break away from the green baize before he returns to action at the prestigious Shanghai Masters in July.\r\nThe seven-time world champion lost 13-10 to an inspired Stuart Bingham in the last eight of the World Championship, but is unlikely to have an extended break due to a busy 2024/25 season which begins with the ranking version of the Championship League at the Morningside Arena in Leicester next month (June 10 - July 3).\r\nO\'Sullivan won the elite invitational Shanghai event for a record fifth time with an 11-9 win over Luca Brecel last September with this year\'s competition provisionally scheduled for July 15-21 in the Chinese city.\r\n\r\n\"I\'m contracted to play in certain events, to do certain exhibition events in China so I\'ll fulfil all of those commitments because obviously they get prioritised,\" O\'Sullivan told Eurosport in Sheffield.\r\n\"And then if I\'ve got time to fit in some other bits I will, but I like my life, I like to spend some time at home. I\'ve got quite a good year, I look at my calendar and I\'m excited.\"\r\nKyren Wilson is likely to be one of the leading attractions at the event after lifting his first Crucible crown with an 18-14 victory over Jak Jones on Monday.\r\nHe is due to play his first competitive match as world champion when he faces Ryan Day at the Helsinki International Snooker Cup on Saturday May 25 with Brecel, Bingham, Judd Trump, Robert Milkins, Jimmy White and Jack Lisowski also competing in the Finnish capital.\r\n\r\n','../Post_Image/1716630929__methode_times_prod_web_bin_fc7b2caf-84cf-4a29-9ad8-fa7168975b2b.jpg','Active',1,'2024-05-25 14:55:29',NULL),
(9,1,'Novak Djokovic suffers semi-final defeat to Tomas Machac at Geneva Open in final warm-up ahead of French Open','Tomas Machac will play the Geneva Open final on Saturday against Casper Ruud or Flavio Cobolli after knocking out world No 1 Novak Djokovic','Novak Djokovic will head to the French Open without a title in 2024 after the world No 1 was defeated 4-6 6-0 1-6 by Tomas Machac in the semi-finals of the Geneva Open.\r\n\r\nThe 44th-ranked Machac beat Djokovic in the last clay-court event to prepare for Roland Garros, which gets under way on Sunday.\r\n\r\nDjokovic\'s record in 2024 has dropped to 14-6 overall and 0-3 in semi-finals, including earlier this year at the Australian Open against Jannik Sinner.\r\n\r\nMachac took his first match-point chance which came on Djokovic\'s serve and clinched victory when the top-ranked Serb pushed a backhand long.\r\n\r\nDjokovic struggled physically at times and received a medical timeout at the end of the first set, which he had led 4-1 before fading.\r\n\r\n\r\nSponsored Links\r\nRecommended byWhat is Outbrain\r\nPower your home for free with government solar panels. Save energy and money!\r\n(Topic | Search Ads)\r\nElevate your brand with premium corporate gifts. Impress clients and employees alike!\r\n(Topic | Search Ads)\r\nIncrease your production with filling machines. The solution for fast, accurate filling!\r\n(Topic | Search Ads)\r\nBirds refuse to leave plane alone - when pilots realise why they instantly land\r\nBirds refuse to leave plane alone - when pilots realise why they instantly land\r\n(loansocieties.com)\r\nEnhance Efficiency with Advanced Packaging Machine Solutions!\r\n(Topic | Search Ads)\r\nOld Woman (89) Is Denied Business Class – Then Flight Attendant Discovers Who She Really Is\r\nOld Woman (89) Is Denied Business Class – Then Flight Attendant Discovers Who She Really Is\r\n(Loan Societies)\r\nModular Homes 2024 (View Prices)\r\nModular Homes 2024 (View Prices)\r\n(Modular Houses | Search Ads)\r\nThe best accident lawyers in Karachi that require no fees unless you win!\r\n(Topic | Search Ads)\r\nTransform Your Space with Lush Apartment Gardens!\r\n(Topic | Search Ads)\r\nDisappointing Photos of Cruise Ship Vacations in Real Life\r\nDisappointing Photos of Cruise Ship Vacations in Real Life\r\n(loansocieties.com)\r\nTrending\r\nTransfer Centre LIVE! Ipswich supremo Schwartz flies in for McKenna talks\r\nCARNAGE! Six-car pile-up in F3 Monaco Sprint\r\nPapers: Chelsea to make £60m move for Palace winger Olise\r\n\'We go for next season\' - is Ten Hag expecting Man Utd stay?\r\nF1\'s most intense moment: Why Monaco Qualifying is unmissable\r\nOkolie DEMOLISHES Rozanski inside a round to win world title\r\nFA Cup final: Ten Hag future, \'Double Double\' & predict the score!\r\nArum: Fury anxious for Usyk rematch... then AJ at Wembley?\r\nMaguire ruled out of FA Cup final: Preview & predict the score!\r\nOkolie blows away Rozanski to become two-weight world champion\r\nWatch\r\nLatest News\r\nHe broke for a 3-1 lead and seemed in command, but his Czech opponent - who had pushed him hard in Dubai last year before losing - stepped on the gas to win five successive games.\r\n\r\n\r\n \r\nThe 37-year-old looked fresher in the second set and moved well, producing several superb forehand winners to level the match in style\r\n\r\nDjokovic won the opening game of the deciding set, but it was downhill after that as another surge from Machac proved unstoppable.\r\n\r\nHe warmly greeted Machac at the net, and smiled as he walked off court applauding the fans.\r\n\r\n\"I have no reaction right now, I just fought for every ball,\" Machac said. \"When you play against Novak, you just hope. You just try to play your best and see what it looks like.\r\n\r\n\"I am looking forward to playing in a final for the first time,\" he added.\r\n\r\nMachac will face either two-time Geneva champion Casper Ruud or Flavio Cobolli in Saturday\'s final, live on Sky Sports Tennis.\r\n\r\nThe world No 1 now heads to Paris where he faces France\'s Pierre-Hugues Herbert in the first round.','../Post_Image/1716631336_Novak_Djokovic_vs_Tomas_Machac_1.jpg','Active',1,'2024-05-25 15:02:16',NULL),
(10,1,'NBA Playoffs 2023-24','Mavericks take 2-0 lead over Wolves with crunch Doncic 3-pointer','Doncic had 32 points, 13 assists and 10 rebounds for his eighth triple-double in 42 career postseason games for the Mavericks, who erased an 15-point deficit midway through the third quarter.\r\n\r\nLuka Doncic hit the go-ahead 3-pointer with Rudy Gobert guarding him at the top of the key with 3 seconds left, posting his fifth triple-double of the playoffs to lead the Dallas Mavericks to a 109-108 victory and a 2-0 lead over the Minnesota Timberwolves in the Western Conference finals on Friday night.\r\n\r\nDoncic had 32 points, 13 assists and 10 rebounds for his eighth triple-double in 42 career postseason games for the Mavericks, who erased an 18-point deficit that stood late in the second quarter and were still down 16 midway through the third.\r\n\r\nNaz Reid went 7 for 9 from 3-point range for 23 points, but his last try at the buzzer rimmed in and out to send the Wolves to Dallas for Game 3 on Sunday in a big hole after another off night by stars Anthony Edwards and Karl-Anthony Towns.\r\n\r\nKyrie Irving had 13 of his 20 points in the fourth quarter, including a corner 3-pointer with 1:05 left that pulled the Mavericks within two. Then the Wolves sandwiched turnovers around a short miss by Doncic. Edwards recklessly threw the ball out of bounds off a drive with 13 seconds left, giving the Mavericks the ball with the chance to win.\r\n\r\nDoncic took the inbounds pass and dribbled to set up a screen by Dereck Lively II that triggered a switch by the Wolves, with NBA All-Defensive second team pick Jaden McDaniels dropping with Lively’s roll and Defensive Player of the Year Gobert staying out on the top of the key.\r\n\r\nAfter the swish, Doncic flexed his arms and yelled at the stunned crowd as his teammates swarmed him.\r\n','../Post_Image/1716631522_2024-05-25T032703Z_1098454365_MT1USATODAY23378748_RTRMADP_3_NBA-PLAYOFFS-DALLAS-MAVERICKS-AT-MINNESOTA-TIMBERWOLVES.jpeg','Active',0,'2024-05-25 15:05:22',NULL),
(11,1,'Ireland men stun Belgium','Ireland men stun Belgium for first points as FIH Hockey Pro League resumes','FIH Hockey Pro League action resumed in Antwerp, Belgium on Wednesday with plenty of thrilling encounters to keep fans entertained. There were mixed fortunes for the host nation whose men’s side were stunned by the plucky Irish team, while India would have hoped for more from the day’s proceedings. This is how the action unfolded…\r\n\r\n(Men’s) Belgium 1 - 2 Ireland\r\n\r\nIreland worked tirelessly to upset hosts Belgium 2-1 in a riveting clash and so earned their first ever points in the FIH Hockey Pro League. The Irish came out positively against the much-favoured Olympic champions and dominated the first half. They were rewarded in the 11th minute when a long pass into the circle took two touches before falling to Matthew Nelson for a deflection at the post. Lee Cole then extended their lead to 2-0 with a penalty stroke in the 20th minute.\r\n\r\nBelgium gradually assumed more control through the second half, but Ireland’s defensive effort was immense. Guillermo Hainaut’s 55th-minute field goal for the hosts set up a tense finish. Despite being a man down, Ireland hung on to thwart the Belgians who were pressing hard after pulling off their goalkeeper, and record a memorable win. \r\n\r\nPlayer of the match went to Irish captain Sean Murray, who reflected on Ireland’s historic victory: “It took a few games to get there, but we knew coming here it was going to be tough… We believe that we can win, we can get results, and we showed that today with a hard-fought win. We defended with our hands on the ground, hearts on the line, and it worked.”\r\n\r\n','../Post_Image/1716631682_VXXSGtJJcP.jpg','Active',1,'2024-05-25 15:08:02',NULL),
(12,1,'Ronnie O’Sullivan v Judd Trump','The two sporting icons square off in the Riyadh Season World Masters of Snooker, with a place in tonight’s final up for grabs','Ronnie O’Sullivan will look to keep his impressive start to the year going when he takes on Judd Trump in the semi-final of the World Masters of Snooker in Riyadh this afternoon.\r\n\r\nThe 12-man event is the inaugural tournament to be held in Saudi Arabia, featuring a prize pot of £788,000 and a controversial new Golden Ball worth an additional 20 points, extending the maximum possible break to 167.\r\n\r\nO’Sullivan who has already won The Masters and the UK Championship among other events this year, breezed past John Higgins 4-0 in his quarter-final match to reach the final four.\r\n\r\nTrump, meanwhile, who lost to O’Sullivan in the World Grand Prix final, will hope to enact revenge having won 4-3 in a tight encounter against Shaun Murphy in his quarter-final match.\r\n\r\nRonnie O’Sullivan not happy with form despite reaching final in Saudi Arabia\r\nRonnie O’Sullivan saw room for improvement despite reaching the final of the inaugural World Masters of Snooker by beating Judd Trump 4-1.\r\n\r\nThe world number one’s victory set up a clash with world champion Luca Brecel later on Wednesday evening in Saudi Arabia.\r\n\r\nBut O’Sullivan, who produced a break of 123 in the third frame before winning the next two to seal his place in the final, was not happy with his display.\r\n\r\nHe told Eurosport: “It wasn’t great. Judd was probably the worst I’ve ever seen him play - I think I dragged him down to my level.\r\n\r\n“I played really well last night (in a 4-0 win over John Higgins), I had a bit of expectation coming in here, thinking I can put two matches together playing well, but that’s put that out the window.”\r\n\r\nIn the other semi-final, Brecel recorded four breaks over 70 to sink Mark Allen 4-2.\r\n\r\nIt continued a welcome return to form for the Belgian, who last month at the Welsh Open reached his first ranking quarter-final since his Crucible win.\r\n\r\nBrecel compiled a break of 125 in the fourth frame to keep Allen at bay, although the Northern Irishman contributed to a high-quality contest with breaks of 121 and 133 in the third and fifth frames respectively.\r\n\r\nBrecel told Eurosport: “I played good, I felt good. Every week, I seem to play a little bit better.\r\n\r\n“Wales was the first step. I now feel very good about myself. Mark is so tough to beat. Every frame he plays the same way, and it’s very difficult to play against.”','../Post_Image/1716631940__124378520_63b668101235f32d60312b29b6ae99288a1a11b3.jpg','Active',1,'2024-05-25 15:12:20',NULL),
(13,2,'SRH go off-script to land a winning formula','Their use of (part-time) spinners at Chepauk highlights the randomness of T20','Until Friday, Sunrisers Hyderabad had the worst record of any spin-bowling team in IPL 2024: the fewest wickets (13), the worst combined average (54.00), and the worst economy rate (11.20). That average and economy rate were magnitudes worse than those of the second-worst spin attacks by those respective measures, Chennai Super Kings (46.78) and Royal Challengers Bengaluru (9.93).\r\n\r\nOn Friday night, in Qualifier 2 against Rajasthan Royals, SRH picked a starting XI that suggested they were looking to bowl as little spin as possible. They picked four specialist quicks, and the bowler in their XI who had sent down the next-most overs behind those four, this season, was Nitish Kumar Reddy, a seam-bowling allrounder.\r\n\r\nRR won the toss and chose to bowl. SRH captain Pat Cummins said he would have preferred to bowl first too. Both teams expected dew to play a significant role later in the night and advantage the chasing team. This had been the case in the two playoff games in Ahmedabad - that venue had favoured the chasing side more than any other this season, giving them six wins in eight games.\r\n\r\nChennai, the venue for this game, had been the second-best chasing venue, with the team batting second winning five and losing two until Friday.\r\n\r\n****\r\n\r\n\r\nBefore Friday, only two SRH spinners had breached the 20-over mark in IPL 2024. These two bowlers - Mayank Markande (11.77) and Shahbaz Ahmed (10.71) - had the worst economy rates of any spinner to have bowled that many overs.\r\n\r\nBoth started Friday night on the subs bench. It\'s likely Markande, a legspinner who came into this game with eight wickets at an average of 32.37, was SRH\'s first choice for Impact Player if things went well, or even reasonably well, with the bat. Shahbaz had only taken three wickets with his left-arm orthodox in 13 innings, at an average of 75.00.\r\n\r\nShahbaz had done a commendable job as a utility allrounder, but in ideal circumstances SRH wouldn\'t have wanted to lean on his batting. They had a top seven full of fearsome ball-strikers, and in Cummins a more-than-useful end-overs hitter at No. 8.\r\n\r\nIf all went to plan for SRH, Shahbaz may have played no part in Qualifier 2 of IPL 2024.','../Post_Image/1716632120_381448.4.jpg','Active',1,'2024-05-25 15:15:20',NULL),
(14,2,' Guardiola warns against complacency as Manchester City chase FA Cup glory','Manager does not take success ‘for granted’ before United final Win would seal league and Cup Double in consecutive seas','Pep Guardiola has warned Manchester City’s players that complacency could be their downfall if they presume the club’s success will last forever because such attitudes have cost others in the past.\r\n\r\nCity face Manchester United in the FA Cup final on Saturday with the aim of becoming the first club in history to do the league and FA Cup Double in consecutive seasons. If City defeat their most bitter rivals at Wembley it would be the 18th trophy of Guardiola’s eight-year tenure. In the same period United have won three.\r\n\r\nPhil Foden scores Manchester City’s second goal against Manchester United at the Etihad in March 2024\r\n‘World class’ Phil Foden centre of attention for Manchester City in FA Cup final\r\nRead more\r\n“Many good teams thought in the past that it [winning] is taken for granted and look now, it’s difficult,” Guardiola said. “Always I say to the players to look at what they have done; always arriving in the finals is difficult. I don’t change my mind.\r\n\r\n“It’s so difficult to win [in previous rounds] at Spurs away, against Newcastle at home, Luton when they were in their good moment. To arrive here is difficult – I don’t take it for granted. This is the reason why. We respect the opponents a lot, know we can easily lose every game and at the same time we can win it. I’ve never had the feeling that it doesn’t matter, absolutely not. The finals, when you arrive, is: ‘Wow, what a privilege to be here again.’ People think: ‘Ah, it’s City, it’s what they have done for the last decade.’”\r\n\r\nGuardiola will go head-to-head with Erik ten Hag, who United have decided to sack regardless of the result. United finished eighth in the league and defeat by City would mean they will not play European football next season.\r\n\r\n“In big clubs like United, City, when you don’t win always you are in trouble,” Guardiola said. “I would be in trouble if we didn’t win. He [Ten Hag] has done many good things. I have huge respect for his job in the past and now at United I completely agree when I listen to him when he says they have not had a full squad this season and had a lot of injuries.','../Post_Image/1716632273_5067.jpg','Active',1,'2024-05-25 15:17:53',NULL),
(15,2,'When Age Catches Up to a Tennis Player','They consider their bodies and the results on the court to determine when to hang it up.','For two decades, men’s tennis pretty much meant Roger Federer, Rafael Nadal and Novak Djokovic.\r\n\r\nNow, Federer is retired and a hobbled Nadal is nearing the end. Djokovic won three Grand Slam events last year, but at 36 he is suddenly struggling, even as he heads into the French Open ranked No. 1.\r\n\r\nBut below Mount Olympus, life is different for tennis mortals. Andy Murray, Stan Wawrinka and Marin Cilic all won Grand Slam events and are still playing, as are Gaël Monfils, Richard Gasquet, Fabio Fognini, Roberto Bautista Agut and Kei Nishikori, players who once cracked the top 10.\r\n\r\nThese players still scuffle along in reduced circumstances, far lower in the rankings than during their halcyon days. These old men of the court — all 34 to 39 years old — win a few matches here and there without much chance of regaining their former glory, yet they keep grinding.\r\n\r\nNow, only Monfils, ranked 36th, is even in the top 50. Murray is 75th, while Bautista Agut, Wawrinka, Fognini and Gasquet are from 80th through 124th. Cilic has fallen to 1,063rd but just had a second knee surgery in the hopes of coming back, while Nishikori is ranked 347th and still striving to get back on the court. (The miraculous inverse to all this is Adrian Mannarino, who suddenly at 35 cracked the top 20 for the first time this year.)\r\n\r\n“Every day I ask myself why I’m still doing this,” Monfils said with a laugh, before citing his “passion for the game” as his motivation. (He has extra incentive: His wife, Elina Svitolina, who is 29 and still in the WTA’s top 20, “pushes me quite a lot.”)\r\n\r\n','../Post_Image/1716632422_25sp-french-old-inyt-01-qmkb-superJumbo.jpg','Active',1,'2024-05-25 15:20:22',NULL);

/*Table structure for table `post_attachment` */

DROP TABLE IF EXISTS `post_attachment`;

CREATE TABLE `post_attachment` (
  `post_attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `post_attachment_title` varchar(200) DEFAULT NULL,
  `post_attachment_path` text DEFAULT NULL,
  `is_active` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_attachment_id`),
  KEY `fk1` (`post_id`),
  CONSTRAINT `fk1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_attachment` */

/*Table structure for table `post_category` */

DROP TABLE IF EXISTS `post_category`;

CREATE TABLE `post_category` (
  `post_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`post_category_id`),
  KEY `post_id` (`post_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `post_category_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_category_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_category` */

insert  into `post_category`(`post_category_id`,`post_id`,`category_id`,`created_at`,`updated_at`) values 
(1,1,1,'2024-05-25 13:10:27',NULL),
(3,2,2,'2024-05-25 13:55:43',NULL),
(4,3,1,'2024-05-25 14:38:14',NULL),
(5,4,2,'2024-05-25 14:41:13',NULL),
(6,5,3,'2024-05-25 14:43:40',NULL),
(7,6,4,'2024-05-25 14:47:10',NULL),
(8,7,5,'2024-05-25 14:52:18',NULL),
(9,8,6,'2024-05-25 14:55:29',NULL),
(10,9,3,'2024-05-25 15:02:16',NULL),
(11,10,4,'2024-05-25 15:05:22',NULL),
(12,11,5,'2024-05-25 15:08:02',NULL),
(13,12,6,'2024-05-25 15:12:20',NULL),
(14,13,1,'2024-05-25 15:15:20',NULL),
(15,14,2,'2024-05-25 15:17:53',NULL),
(16,15,3,'2024-05-25 15:20:22',NULL);

/*Table structure for table `post_comment` */

DROP TABLE IF EXISTS `post_comment`;

CREATE TABLE `post_comment` (
  `post_comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_active` enum('Active','InActive') DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`post_comment_id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`),
  CONSTRAINT `post_comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_comment_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `post_comment` */

insert  into `post_comment`(`post_comment_id`,`post_id`,`user_id`,`comment`,`is_active`,`created_at`) values 
(1,1,3,'My comment','Active','2024-05-25 22:59:32'),
(2,1,3,'See I can do more','Active','2024-05-25 23:17:08'),
(3,14,4,'My comment','InActive','2024-05-26 10:34:44'),
(4,13,4,'I should comment on this?','Active','2024-05-26 10:36:14'),
(5,15,4,'Here another one','Active','2024-05-26 10:50:53'),
(6,8,4,'comment','Active','2024-05-26 11:08:07'),
(7,13,3,'This Post Is Really Good','Active','2024-05-27 10:49:45');



/*Table structure for table `setting` */

DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `setting_key` varchar(100) DEFAULT NULL,
  `setting_value` varchar(100) DEFAULT NULL,
  `setting_status` enum('Active','InActive') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`setting_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `setting_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `setting` */

/*Table structure for table `user_feedback` */

DROP TABLE IF EXISTS `user_feedback`;

CREATE TABLE `user_feedback` (
  `feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`feedback_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*Data for the table `user_feedback` */

insert  into `user_feedback`(`feedback_id`,`user_id`,`user_name`,`user_email`,`feedback`,`created_at`) values 
(1,4,NULL,NULL,'My Feedback','2024-05-26 11:12:27'),
(5,NULL,'Danish','danish@gmail.com','My feedback is Necessary','2024-05-26 11:16:03');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
