-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2015 at 07:28 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `movie_review_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_actors`
--

CREATE TABLE IF NOT EXISTS `tbl_actors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actors_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  `actors_image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `tbl_actors`
--

INSERT INTO `tbl_actors` (`id`, `actors_name`, `actors_image`) VALUES
(3, 'Akshay kumar ', '78836_6655_Mad-Max-Fury-Road.png'),
(6, 'Rajnikanth', '10723_2297_Rajnikanth.png'),
(7, 'Johnny Lever', '61636_60513_87957_Johnny-Lever.png'),
(8, 'Salman Khan', '74090_Salman-Khan.png'),
(10, 'Hrithik Roshan', '98327_72250_Hrithik-Roshan.png'),
(11, 'Sunil Shetty', '68432_38186_Sunil-Shetty.png'),
(12, 'Varun Dhawan', '10955_Varun-Dhawan.png'),
(13, 'Karan Johar', '63311_8276_Karan-Johar.png'),
(14, 'Ranbir Kapoor', '48031_55831_Ranbir_Kapoor.jpg'),
(15, 'Robert Downey Jr ', '40951_63400_Robert-downey-jr-2011.png'),
(22, 'testww', '22399_Chrysanthemum.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `email`, `password`) VALUES
(1, 'admin', 'viaviweb@gmail.com', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cid`, `category_name`) VALUES
(2, 'Tamil'),
(5, 'Hindi'),
(6, 'Nepali'),
(7, 'Teluga'),
(8, 'English'),
(11, 'یقین ہے کہ یہ براہ کرم یقینی بنائیں');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `created` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`id`, `movie_id`, `user_id`, `comment`, `created`) VALUES
(2, '2', '87', 'testing', '1443177420'),
(12, '25', '84', 'test', '1443177420'),
(23, '25', '84', 'viaviweb', '1443180720'),
(24, '25', '84', 'eeeeeeeee', '1443183548'),
(25, '25', '84', 'eeeeeeeee', '1443186300');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_genres`
--

CREATE TABLE IF NOT EXISTS `tbl_genres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `genres_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tbl_genres`
--

INSERT INTO `tbl_genres` (`id`, `genres_name`) VALUES
(1, 'Dance'),
(3, 'Romance'),
(6, 'Comedy'),
(7, 'Action'),
(9, 'Animation'),
(10, 'Musical'),
(11, ' کرم یقینی بنائیں');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movie`
--

CREATE TABLE IF NOT EXISTS `tbl_movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` varchar(255) NOT NULL,
  `genre_id` varchar(255) NOT NULL,
  `movie_title` varchar(255) NOT NULL,
  `movie_casts` varchar(255) NOT NULL,
  `movie_image` varchar(255) NOT NULL,
  `movie_poster_img` varchar(255) NOT NULL,
  `movie_desc` text NOT NULL,
  `movie_date` date NOT NULL,
  `movie_view` int(11) NOT NULL,
  `movie_rating` varchar(255) NOT NULL,
  `movie_total_rate` int(11) NOT NULL,
  `movie_rate_avg` int(11) NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tbl_movie`
--

INSERT INTO `tbl_movie` (`id`, `cid`, `genre_id`, `movie_title`, `movie_casts`, `movie_image`, `movie_poster_img`, `movie_desc`, `movie_date`, `movie_view`, `movie_rating`, `movie_total_rate`, `movie_rate_avg`, `url`) VALUES
(2, '5', '1,10', 'Hamari Adhuri Kahani', '6,10', '43936_49005_hamari-adhuri-kahani.png', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec posuere metus et leo egestas auctor. Aliquam erat volutpat. Fusce gravida, ligula eu sodales rutrum, arcu elit imperdiet diam, vel mattis justo lacus ac eros. Ut vulputate sapien porttitor elit porta, et lobortis arcu rhoncus. Maecenas laoreet condimentum nisl, vel malesuada dolor gravida vel. Suspendisse accumsan iaculis pellentesque. Ut mattis et lectus vitae elementum. Integer et finibus tortor. In non neque mattis, mollis lorem a, pulvinar libero. Nunc felis odio, vehicula auctor nibh ultricies, suscipit ultrices mi. Nullam sollicitudin augue sit amet ante ornare volutpat. Ut at quam vitae neque bibendum varius a id dolor. Nulla efficitur, tellus eu aliquet faucibus, ante eros ullamcorper dolor, eget cursus mi sapien a magna. Nam imperdiet eleifend egestas.</p>\r\n\r\n<p>Duis placerat enim quis augue mattis, nec ultricies ante volutpat. Aliquam erat volutpat. Etiam aliquet velit eu nisl tincidunt, nec porttitor elit eleifend. Cras faucibus auctor sapien a placerat. Donec a elit pharetra urna bibendum mattis eu eget leo. Morbi vel facilisis tortor, eget ultrices ipsum. Aliquam eu erat non ligula convallis pulvinar. Nullam dapibus molestie felis ac laoreet. Aliquam tincidunt sollicitudin magna, et ullamcorper lacus eleifend a.</p>\r\n\r\n<p>Curabitur elementum enim ipsum, sed placerat enim tristique eu. Fusce volutpat neque mauris, quis viverra lacus molestie ut. Cras finibus malesuada gravida. Praesent vel magna sed tellus vestibulum pharetra sed ac nisi. Pellentesque odio lorem, ultricies eu ornare et, faucibus eget odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pharetra lectus sapien, sit amet convallis magna faucibus a. Ut placerat justo vitae porttitor lacinia. Vivamus justo neque, rutrum fermentum accumsan eu, dignissim in magna. Vivamus nec quam eget quam laoreet porttitor. Suspendisse ut blandit felis. Phasellus venenatis mi dui, vitae aliquet nisl eleifend in. Morbi hendrerit non elit quis fermentum. Nullam nisl nunc, placerat bibendum magna nec, aliquam semper dolor.</p>\r\n\r\n<p>Curabitur at pulvinar metus. Cras pretium scelerisque nulla, et porta urna commodo ut. In eleifend ipsum vel faucibus mollis. Vestibulum in tempus quam. Nulla rutrum augue ac enim auctor, sit amet fermentum libero pellentesque. Donec auctor pulvinar enim vitae ornare. Nullam porta accumsan dolor vel maximus. Sed at nisl sed justo consequat venenatis a ac erat. Integer id hendrerit nulla. Sed blandit porta diam, sed scelerisque odio gravida in. Donec semper orci nulla, pulvinar fermentum augue ultricies sed.</p>\r\n\r\n<p>Nunc dapibus, magna eget cursus dapibus, massa lacus fringilla eros, ut convallis lectus magna in leo. Aenean tempor aliquet mollis. Maecenas eu iaculis dolor, in euismod ante. Nam tempus lectus eu ligula pulvinar, quis rhoncus sapien consequat. Suspendisse potenti. Nulla consectetur nulla at urna euismod, non accumsan felis suscipit. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse ultrices justo et justo vestibulum, vel lobortis diam gravida. Pellentesque vitae nunc quis elit fringilla auctor. Vestibulum malesuada ut nunc ac dapibus. Pellentesque tincidunt lorem hendrerit placerat maximus. Maecenas mi mauris, pulvinar et libero et, vestibulum malesuada felis. Nam vel nunc blandit, ultricies nulla at, finibus nisl.</p>\r\n', '2015-08-29', 2, '0', 3, 3, 'hamari-adhuri-kahani-668.html'),
(6, '8', '1', '  Mad Max Fury Road', '10', '93237_6713_hot-pursuit.png', '', '<p>Years after the collapse of civilization, the tyrannical Immortan Joe enslaves apocalypse survivors inside the desert fortress the Citadel. When the warrior Imperator Furiosa (Charlize Theron) leads the despot&#39;s five wives in a daring escape, she forges an alliance with Max Rockatansky (Tom Hardy),</p>\r\n', '2015-08-25', 0, '3', 2, 3, '--mad-max-fury-road-33.html'),
(9, '5', '9', 'PK', '6,13', '69931_80291_pk.png', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec posuere metus et leo egestas auctor. Aliquam erat volutpat. Fusce gravida, ligula eu sodales rutrum, arcu elit imperdiet diam, vel mattis justo lacus ac eros. Ut vulputate sapien porttitor elit porta, et lobortis arcu rhoncus. Maecenas laoreet condimentum nisl, vel malesuada dolor gravida vel. Suspendisse accumsan iaculis pellentesque. Ut mattis et lectus vitae elementum. Integer et finibus tortor. In non neque mattis, mollis lorem a, pulvinar libero. Nunc felis odio, vehicula auctor nibh ultricies, suscipit ultrices mi. Nullam sollicitudin augue sit amet ante ornare volutpat. Ut at quam vitae neque bibendum varius a id dolor. Nulla efficitur, tellus eu aliquet faucibus, ante eros ullamcorper dolor, eget cursus mi sapien a magna. Nam imperdiet eleifend egestas.</p>\r\n\r\n<p>Duis placerat enim quis augue mattis, nec ultricies ante volutpat. Aliquam erat volutpat. Etiam aliquet velit eu nisl tincidunt, nec porttitor elit eleifend. Cras faucibus auctor sapien a placerat. Donec a elit pharetra urna bibendum mattis eu eget leo. Morbi vel facilisis tortor, eget ultrices ipsum. Aliquam eu erat non ligula convallis pulvinar. Nullam dapibus molestie felis ac laoreet. Aliquam tincidunt sollicitudin magna, et ullamcorper lacus eleifend a.</p>\r\n\r\n<p>Curabitur elementum enim ipsum, sed placerat enim tristique eu. Fusce volutpat neque mauris, quis viverra lacus molestie ut. Cras finibus malesuada gravida. Praesent vel magna sed tellus vestibulum pharetra sed ac nisi. Pellentesque odio lorem, ultricies eu ornare et, faucibus eget odio. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Integer pharetra lectus sapien, sit amet convallis magna faucibus a. Ut placerat justo vitae porttitor lacinia. Vivamus justo neque, rutrum fermentum accumsan eu, dignissim in magna. Vivamus nec quam eget quam laoreet porttitor. Suspendisse ut blandit felis. Phasellus venenatis mi dui, vitae aliquet nisl eleifend in. Morbi hendrerit non elit quis fermentum. Nullam nisl nunc, placerat bibendum magna nec, aliquam semper dolor.</p>\r\n\r\n<p>Curabitur at pulvinar metus. Cras pretium scelerisque nulla, et porta urna commodo ut. In eleifend ipsum vel faucibus mollis. Vestibulum in tempus quam. Nulla rutrum augue ac enim auctor, sit amet fermentum libero pellentesque. Donec auctor pulvinar enim vitae ornare. Nullam porta accumsan dolor vel maximus. Sed at nisl sed justo consequat venenatis a ac erat. Integer id hendrerit nulla. Sed blandit porta diam, sed scelerisque odio gravida in. Donec semper orci nulla, pulvinar fermentum augue ultricies sed.</p>\r\n', '2015-08-17', 0, '4', 1, 2, 'pk-439.html'),
(10, '5', '3,7', 'bahubali', '13', '17837_75820_baahubali.png', '', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '2015-08-14', 0, '3', 1, 5, 'bahubali-371.html'),
(11, '6', '6', 'ABCD2', '10,13', '17074_34588_abcd2.png', '', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '2015-08-28', 0, '3', 0, 0, 'abcd2-616.html'),
(12, '5', '9,10', 'Bangistan ', '12,14', '38293_85131_bangistan.png', '', '<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using &#39;Content here, content here&#39;, making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for &#39;lorem ipsum&#39; will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n', '2015-08-15', 0, '5', 1, 1, 'bangistan--321.html'),
(14, '8', '3,6,7', 'all is well', '6', '94989_28787_all-is-well.png', '', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '2015-08-03', 0, '1', 1, 4, 'all-is-well-630.html'),
(15, '6', '6,10', 'Hitman Agent47', '11,14', '19635_48043_hitman-agent47.png', '', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '2015-09-26', 0, '1', 1, 3, 'hitman-agent47-554.html'),
(16, '7', '7', 'Brothers', '3', '8493_59045_brothers.png', '', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '2015-01-01', 0, '1', 1, 4, 'brothers-292.html'),
(17, '2', '6', 'Ant Man', '8,12,14', '65924_Koala.jpg', '', '<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n\r\n<p><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n', '2015-08-07', 0, '3', 1, 4, 'ant-man-806.html'),
(18, '2', '6,7', 'Drishyam', '13', '21267_43954_drishyam.png', '', '<p>So, each click&nbsp;or keypress from keyboard on the page = status field updated with the timestamp when the click is made or keypress is done. When a user do not click on anything or keypress on the page for about 5*60 = 300 seconds, he/she will be treated as a offline user. Of course you can edit this value as you want.</p>\r\n\r\n<p>So, each click&nbsp;or keypress from keyboard on the page = status field updated with the timestamp when the click is made or keypress is done. When a user do not click on anything or keypress on the page for about 5*60 = 300 seconds, he/she will be treated as a offline user. Of course you can edit this value as you want.</p>\r\n', '2009-11-18', 0, '1', 1, 5, 'drishyam-429.html'),
(22, '6', '1,6', 'Jupiter Ascending', '6,7,10', '58840_76950_jupiter-ascending.png', '', '<p>A young woman discovers her destiny as an heiress of intergalactic nobility and must fight to protect the inhabitants of Earth from an ancient and destructive industry.</p>\r\n\r\n<p>A young woman discovers her destiny as an heiress of intergalactic nobility and must fight to protect the inhabitants of Earth from an ancient and destructive industry.</p>\r\n', '2015-08-26', 0, '3', 1, 4, 'jupiter-ascending-441.html'),
(23, '2', '3,6,7', 'Avengers Age Of Ultron', '15', '30224_47006_avengers-age-of-ultron.png', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec tincidunt nisi. Nunc quam neque, tempus vel tellus a, interdum porta felis. Nunc vulputate nibh placerat facilisis gravida. Suspendisse at sapien eleifend, bibendum dolor eget, egestas ante. Sed ut volutpat purus. Integer auctor sem mi, in elementum nisi facilisis nec. Cras at quam sit amet erat ullamcorper pretium. Nulla hendrerit vel ipsum eleifend vestibulum. Etiam dolor orci, dictum non quam nec, eleifend molestie turpis. Donec elit urna, porttitor ut feugiat et, auctor pulvinar dui. Aliquam augue ligula, sagittis vitae ipsum eget, consectetur viverra ligula. Maecenas sit amet convallis purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan semper arcu, a gravida eros placerat eu.</p>\r\n\r\n<p>Aliquam id elit facilisis, porttitor lectus id, rutrum turpis. Praesent vel ligula lorem. Vivamus bibendum lectus mi, ornare lobortis purus consectetur nec. Etiam iaculis tellus eu mauris ultrices, quis pharetra justo vehicula. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras euismod congue fermentum. In metus justo, vehicula hendrerit metus quis, finibus viverra est. Morbi ligula enim, dignissim ut volutpat nec, porttitor nec nunc. Sed magna justo, finibus vitae mattis ut, eleifend ac dui.</p>\r\n', '2015-08-28', 0, '1', 1, 2, 'avengers-age-of-ultron-952.html'),
(24, '7', '1,3,6', 'The Main From Uncle ', '13,14,15', '66156_54901_the-main-from-uncle.png', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec tincidunt nisi. Nunc quam neque, tempus vel tellus a, interdum porta felis. Nunc vulputate nibh placerat facilisis gravida. Suspendisse at sapien eleifend, bibendum dolor eget, egestas ante. Sed ut volutpat purus. Integer auctor sem mi, in elementum nisi facilisis nec. Cras at quam sit amet erat ullamcorper pretium. Nulla hendrerit vel ipsum eleifend vestibulum. Etiam dolor orci, dictum non quam nec, eleifend molestie turpis. Donec elit urna, porttitor ut feugiat et, auctor pulvinar dui. Aliquam augue ligula, sagittis vitae ipsum eget, consectetur viverra ligula. Maecenas sit amet convallis purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan semper arcu, a gravida eros placerat eu.</p>\r\n\r\n<p>Aliquam id elit facilisis, porttitor lectus id, rutrum turpis. Praesent vel ligula lorem. Vivamus bibendum lectus mi, ornare lobortis purus consectetur nec. Etiam iaculis tellus eu mauris ultrices, quis pharetra justo vehicula. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras euismod congue fermentum. In metus justo, vehicula hendrerit metus quis, finibus viverra est. Morbi ligula enim, dignissim ut volutpat nec, porttitor nec nunc. Sed magna justo, finibus vitae mattis ut, eleifend ac dui.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec tincidunt nisi. Nunc quam neque, tempus vel tellus a, interdum porta felis. Nunc vulputate nibh placerat facilisis gravida. Suspendisse at sapien eleifend, bibendum dolor eget, egestas ante. Sed ut volutpat purus. Integer auctor sem mi, in elementum nisi facilisis nec. Cras at quam sit amet erat ullamcorper pretium. Nulla hendrerit vel ipsum eleifend vestibulum. Etiam dolor orci, dictum non quam nec, eleifend molestie turpis. Donec elit urna, porttitor ut feugiat et, auctor pulvinar dui. Aliquam augue ligula, sagittis vitae ipsum eget, consectetur viverra ligula. Maecenas sit amet convallis purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan semper arcu, a gravida eros placerat eu.</p>\r\n\r\n<p>Aliquam id elit facilisis, porttitor lectus id, rutrum turpis. Praesent vel ligula lorem. Vivamus bibendum lectus mi, ornare lobortis purus consectetur nec. Etiam iaculis tellus eu mauris ultrices, quis pharetra justo vehicula. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras euismod congue fermentum. In metus justo, vehicula hendrerit metus quis, finibus viverra est. Morbi ligula enim, dignissim ut volutpat nec, porttitor nec nunc. Sed magna justo, finibus vitae mattis ut, eleifend ac dui.</p>\r\n', '2001-08-23', 0, '4', 3, 4, 'the-main-from-uncle--571.html'),
(25, '8', '3,6', 'Blackhat', '8,11,13,15', '39028_19635_48043_hitman-agent47.png', '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec tincidunt nisi. Nunc quam neque, tempus vel tellus a, interdum porta felis. Nunc vulputate nibh placerat facilisis gravida. Suspendisse at sapien eleifend, bibendum dolor eget, egestas ante. Sed ut volutpat purus. Integer auctor sem mi, in elementum nisi facilisis nec. Cras at quam sit amet erat ullamcorper pretium. Nulla hendrerit vel ipsum eleifend vestibulum. Etiam dolor orci, dictum non quam nec, eleifend molestie turpis. Donec elit urna, porttitor ut feugiat et, auctor pulvinar dui. Aliquam augue ligula, sagittis vitae ipsum eget, consectetur viverra ligula. Maecenas sit amet convallis purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan semper arcu, a gravida eros placerat eu.</p>\r\n\r\n<p>Aliquam id elit facilisis, porttitor lectus id, rutrum turpis. Praesent vel ligula lorem. Vivamus bibendum lectus mi, ornare lobortis purus consectetur nec. Etiam iaculis tellus eu mauris ultrices, quis pharetra justo vehicula. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras euismod congue fermentum. In metus justo, vehicula hendrerit metus quis, finibus viverra est. Morbi ligula enim, dignissim ut volutpat nec, porttitor nec nunc. Sed magna justo, finibus vitae mattis ut, eleifend ac dui.</p>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec tincidunt nisi. Nunc quam neque, tempus vel tellus a, interdum porta felis. Nunc vulputate nibh placerat facilisis gravida. Suspendisse at sapien eleifend, bibendum dolor eget, egestas ante. Sed ut volutpat purus. Integer auctor sem mi, in elementum nisi facilisis nec. Cras at quam sit amet erat ullamcorper pretium. Nulla hendrerit vel ipsum eleifend vestibulum. Etiam dolor orci, dictum non quam nec, eleifend molestie turpis. Donec elit urna, porttitor ut feugiat et, auctor pulvinar dui. Aliquam augue ligula, sagittis vitae ipsum eget, consectetur viverra ligula. Maecenas sit amet convallis purus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis accumsan semper arcu, a gravida eros placerat eu.</p>\r\n\r\n<p>Aliquam id elit facilisis, porttitor lectus id, rutrum turpis. Praesent vel ligula lorem. Vivamus bibendum lectus mi, ornare lobortis purus consectetur nec. Etiam iaculis tellus eu mauris ultrices, quis pharetra justo vehicula. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras euismod congue fermentum. In metus justo, vehicula hendrerit metus quis, finibus viverra est. Morbi ligula enim, dignissim ut volutpat nec, porttitor nec nunc. Sed magna justo, finibus vitae mattis ut, eleifend ac dui.</p>\r\n', '2015-08-24', 0, '2', 5, 3, 'blackhat-524.html');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE IF NOT EXISTS `tbl_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `rate` int(11) NOT NULL,
  `dt_rate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=96 ;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`id`, `movie_id`, `ip`, `rate`, `dt_rate`) VALUES
(23, 6, '::1', 3, '2015-08-21 23:47:44'),
(25, 23, '::1', 2, '2015-08-21 23:54:45'),
(26, 14, '::1', 4, '2015-08-22 05:36:56'),
(28, 25, '::1', 4, '2015-08-31 07:12:33'),
(32, 24, '::1', 3, '2015-08-31 08:22:39'),
(33, 22, '::1', 4, '2015-08-31 08:45:29'),
(34, 18, '::1', 5, '2015-08-31 08:50:05'),
(35, 12, '::1', 1, '2015-08-31 09:30:38'),
(36, 10, '::1', 5, '2015-08-31 09:39:12'),
(37, 2, '::1', 3, '2015-08-31 09:40:19'),
(38, 2, '123', 5, '2015-09-18 21:09:02'),
(41, 6, '4', 2, '2015-09-18 21:13:25'),
(42, 7, '4', 2, '2015-09-18 21:17:28'),
(43, 9, '4', 2, '2015-09-18 21:34:46'),
(74, 24, '4', 4, '2015-09-18 23:06:26'),
(75, 24, '8', 4, '2015-09-18 23:06:57'),
(95, 25, '1', 1, '2015-09-26 09:26:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_registration`
--

CREATE TABLE IF NOT EXISTS `tbl_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=88 ;

--
-- Dumping data for table `tbl_registration`
--

INSERT INTO `tbl_registration` (`id`, `username`, `email`, `password`) VALUES
(84, 'demo', 'demo@gmail.com', '321'),
(87, 'test', 'test@gmail.com', '1010');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_views`
--

CREATE TABLE IF NOT EXISTS `tbl_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) NOT NULL,
  `view` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Dumping data for table `tbl_views`
--

INSERT INTO `tbl_views` (`id`, `movie_id`, `view`, `ip`) VALUES
(7, 24, 0, '::1'),
(23, 2, 0, '::1'),
(24, 9, 0, '::1'),
(25, 10, 0, '::1'),
(26, 0, 0, '::1'),
(27, 6, 0, '::1'),
(28, 18, 0, '::1'),
(29, 22, 0, '::1'),
(30, 11, 0, '::1'),
(31, 16, 0, '::1'),
(50, 25, 0, '2'),
(52, 2, 0, '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
