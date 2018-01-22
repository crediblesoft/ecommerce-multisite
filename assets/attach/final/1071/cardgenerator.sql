-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2016 at 02:19 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cardgenerator`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `user_id`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin_card_image`
--

CREATE TABLE IF NOT EXISTS `tb_admin_card_image` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `image_path` text NOT NULL,
  `image_name` text NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `mac_address` varchar(50) NOT NULL,
  `image_use_counter` int(11) NOT NULL,
  `show_status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'hide 0, show 1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_card`
--

CREATE TABLE IF NOT EXISTS `tb_card` (
  `id` int(11) NOT NULL,
  `card_name` varchar(100) NOT NULL,
  `pappersize` varchar(20) NOT NULL,
  `papper_side` int(11) NOT NULL,
  `keywords` varchar(500) NOT NULL,
  `sort` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `card_step0` varchar(10) NOT NULL,
  `card_step1` varchar(10) NOT NULL,
  `card_step2` varchar(10) NOT NULL,
  `card_step3` varchar(10) NOT NULL,
  `card_step4` varchar(10) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'hide 0, show 1'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_card`
--

INSERT INTO `tb_card` (`id`, `card_name`, `pappersize`, `papper_side`, `keywords`, `sort`, `categories_id`, `card_step0`, `card_step1`, `card_step2`, `card_step3`, `card_step4`, `status`) VALUES
(8, 'color test', 'Portrait', 1, 'asdsa', 1, 2, 'done', 'done', '', 'done', '', '0'),
(16, 'Great Wedding', 'Landscape', 2, '2 sides card', 1, 3, 'done', 'done', 'done', 'done', 'done', '1'),
(12, 'New Card', 'Landscape', 1, 'wedding', 1, 3, 'done', 'done', 'done', 'done', 'done', '1'),
(1, 'new card', 'Portrait', 1, 'bday card', 1, 2, 'done', 'done', 'done', 'done', 'done', '1'),
(17, 'New card', 'Portrait', 1, 'Xszcz', 1, 1, 'done', '', '', '', '', '0'),
(15, 'New Card design', 'Portrait', 1, 'asdashd', 1, 1, 'done', 'done', 'done', 'done', 'done', '1'),
(10, 'new card test', 'Portrait', 1, 'birth', 1, 2, 'done', 'done', 'done', 'done', 'done', '1'),
(14, 'new testing', 'Portrait', 1, 'wasdsd', 1, 1, 'done', 'done', 'done', 'done', 'done', '1'),
(11, 'Portrait', 'Portrait', 2, 'sadsad', 1, 1, 'done', 'done', 'done', 'done', 'done', '1'),
(19, 'tesdf', 'Portrait', 1, 'tewsd', 1, 2, 'done', '', '', '', '', '0'),
(13, 'Test', 'Portrait', 1, 'test', 1, 2, 'done', 'done', 'done', 'done', 'done', '1'),
(18, 'testttt', 'Portrait', 1, 'asdsad', 1, 1, 'done', 'done', 'done', 'done', 'done', '0'),
(6, 'Two Side card', 'Landscape', 2, 'wqqwer', 1, 3, 'done', 'done', 'done', 'done', 'done', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_card_background_image_delete`
--

CREATE TABLE IF NOT EXISTS `tb_card_background_image_delete` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `div_id` varchar(100) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `image_path` varchar(300) NOT NULL,
  `image_name` varchar(300) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `mac_address` varchar(50) NOT NULL,
  `tb_color_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'hide 0, show 1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_card_detail`
--

CREATE TABLE IF NOT EXISTS `tb_card_detail` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `background` text NOT NULL,
  `background_data` text NOT NULL,
  `card_data` text NOT NULL,
  `card_data2` text NOT NULL,
  `card_data3` text NOT NULL,
  `card_data4_image` text NOT NULL,
  `design_path` text NOT NULL,
  `path` text NOT NULL,
  `fonts_used_id` varchar(400) NOT NULL COMMENT 'those id which use in this card',
  `categories_id` int(11) NOT NULL,
  `tb_color_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'hide 0, show 1'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_card_detail`
--

INSERT INTO `tb_card_detail` (`id`, `card_id`, `background`, `background_data`, `card_data`, `card_data2`, `card_data3`, `card_data4_image`, `design_path`, `path`, `fonts_used_id`, `categories_id`, `tb_color_id`, `status`) VALUES
(1, 10, '', '<div id=\\''background_card_div_image0\\'' ondblclick=\\''my_image_change(\\"background_card_div_image0\\")\\'' title=\\''Drag and drop to change position !.\\'' class=\\''background_div_image \\'' data-toggle=\\''popover\\'' style=\\''z-index: 10; top: -7px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1102.22px; height: 917px; right: auto; bottom: auto; left: -46px;\\''><img style=\\''width: 100%;height:100%;\\''  id=\\''background_card_item_image0\\'' src=\\''http://localhost/cardgenerator/assests/images/background/_28176_2016_21_07_1469096831.jpg\\'' alt=\\''\\'' /></div>', '<div id=\\"page_datadiv_image1\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 204px; position: absolute; z-index: 105; cursor: move; width: 291px; height: 164px; left: 190.267px; right: auto; bottom: auto;\\"><p style=\\"color:#333333;max-width: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image1\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_44891_2016_21_07_1469096876.jpg\\" id=\\"Npage_dataitem_image1\\" alt=\\"\\"></p></div>', '', '<div id=\\"page_data_contener_4291277157885988\\" ondblclick=\\"my_text_change(&quot;page_data_contener_4291277157885988&quot;)\\" class=\\"_contener\\" data-toggle=\\"popover\\" style=\\"text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 402; height: 104px; width: 319px; position: absolute; top: 147px; left: 182px; cursor: move; border-width: 1px; border-style: solid dashed; border-color: rgb(255, 0, 0); right: auto; bottom: auto;\\"><div divtype=\\"transbox\\" id=\\"page_data_transbox657334785736559\\" ondblclick=\\"my_text_change(undefined)\\" class=\\"transbox center_center_middil\\" data-toggle=\\"popover\\" style=\\"color:#ff8040;z-index: 400; position: relative; top: 0px; left: 0px; height: 74px; width: 100%; line-height: 24px; font-size: 40px; font-family: Calibri;\\"><p style=\\"width:100%; text-align:undefined;\\">HAPPY BDAY DEAR</p></div></div><div id=\\"page_data_contener_527093939801434\\" ondblclick=\\"my_text_change(&quot;page_data_contener_527093939801434&quot;)\\" class=\\"_contener\\" data-toggle=\\"popover\\" style=\\"text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 402; height: 270px; width: 270px; position: absolute; top: 319px; left: 200px; cursor: move; border-width: 1px; border-style: solid dashed; border-color: rgb(0, 0, 0); right: auto; bottom: auto;\\"><div divtype=\\"transbox\\" id=\\"page_data_transbox5944407495211034\\" ondblclick=\\"my_text_change(undefined)\\" class=\\"transbox center_center_middil\\" data-toggle=\\"popover\\" style=\\"color:#09135e;z-index: 401; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px; font-size: 40px; font-family: Calibri;\\"><p style=\\"width:100%; text-align:undefined;\\">NEW TEST</p></div></div>', '', '', '_97045_2016_21_07_1469096825.jpg', 'Calibri|Calibri', 2, 3, '0'),
(2, 11, '', '<div id=\\''background_card_div_image0\\'' ondblclick=\\''my_image_change(\\"background_card_div_image0\\")\\'' title=\\''Drag and drop to change position !.\\'' class=\\''background_div_image \\'' data-toggle=\\''popover\\'' style=\\''z-index: 10; top: -8px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1103px; height: 919px; right: auto; bottom: auto; left: -54px;\\''><img style=\\''width: 100%;height:100%;\\''  id=\\''background_card_item_image0\\'' src=\\''http://localhost/cardgenerator/assests/images/background/_76431_2016_09_08_1470723245.jpg\\'' alt=\\''\\'' /></div>', '<div id=\\"page_datadiv_image1\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 30px; position: absolute; z-index: 103; cursor: move; width: 156px; height: 116px; left: 28.1833px; right: auto; bottom: auto;\\"><p style=\\"max-width: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image1\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_32882_2016_09_08_1470723593.jpg\\" id=\\"Npage_dataitem_image1\\" alt=\\"\\"></p></div>', '', '<div id=\\"page_data_contener_7661682615219555\\" ondblclick=\\"my_text_change(&quot;page_data_contener_7661682615219555&quot;)\\" class=\\"_contener\\" data-toggle=\\"popover\\" style=\\"text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 401; height: 103px; width: 301px; position: absolute; top: 131px; left: 220px; cursor: move; border-width: 1px; border-style: solid dashed; border-color: rgb(255, 0, 0); right: auto; bottom: auto;\\"><div divtype=\\"transbox\\" id=\\"page_data_transbox8322546082837970\\" ondblclick=\\"my_text_change(undefined)\\" class=\\"transbox center_center_middil\\" data-toggle=\\"popover\\" style=\\"color:#317a05;z-index: 400; position: relative; top: 0px; left: 0px; height: 73px; width: 100%; line-height: 24px; font-size: 40px;\\"><p style=\\"width:100%; text-align:undefined;\\">WELCOME</p></div></div>', '', '', '_55114_2016_09_08_1470723210.jpg', '', 1, 1, '0'),
(3, 12, '', '<div id=\\''background_card_div_image0\\'' ondblclick=\\''my_image_change(\\"background_card_div_image0\\")\\'' title=\\''Drag and drop to change position !.\\'' class=\\''background_div_image \\'' data-toggle=\\''popover\\'' style=\\''z-index: 10; top: 0px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 927px; height: 702px; right: auto; bottom: auto; left: -11px;\\''><img style=\\''width: 100%;height:100%;\\''  id=\\''background_card_item_image0\\'' src=\\''http://localhost/cardgenerator/assests/images/background/_37442_2016_09_08_1470737533.jpg\\'' alt=\\''\\'' /></div>', '<div id=\\"page_datadiv_image1\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 56px; position: absolute; z-index: 102; cursor: move; width: 320px; height: 179px; left: 34.05px; right: auto; bottom: auto;\\"><p style=\\"max-width: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image1\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_61041_2016_09_08_1470737558.jpg\\" id=\\"Npage_dataitem_image1\\" alt=\\"\\"></p></div>', '', '<div id=\\"page_data_contener_803812337915953\\" ondblclick=\\"my_text_change(&quot;page_data_contener_803812337915953&quot;)\\" class=\\"_contener\\" data-toggle=\\"popover\\" style=\\"text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 401; height: 270px; width: 270px; position: absolute; top: 105px; left: 460px; cursor: move; border-width: 1px; border-style: solid dashed; border-color: rgb(255, 0, 0); right: auto; bottom: auto;\\"><div divtype=\\"final_div_image\\" id=\\"page_data_final_image668332133942416\\" data-toggle=\\"popover\\" class=\\"final_div_image center_center_middil\\" style=\\"width: 100%; height:100px;left:0px; top:0px;position: relative;z-index:400;\\" imagename=\\"ajimg\\"><img class=\\"center-block img img-responsive\\" src=\\"http://localhost/cardgenerator/assests/images/step4Image/_54934_2016_11_08_1470898659.jpg\\" alt=\\"undefined\\"></div></div>', '<img style=\\"display: block;height:auto;max-height:60px;max-width:60px;margin-right:15px;\\" id=\\"image_1350839879632521\\" title=\\"ajimg2\\" img_work=\\"page_data_final_image668332133942416\\" class=\\"temp_page_data_final_image668332133942416\\" src=\\"http://localhost/cardgenerator/assests/images/step4Image/_61492_2016_11_08_1470898671.jpg\\" /> <img style=\\"display: block;height:auto;max-height:60px;max-width:60px;margin-right:15px;\\" id=\\"image_5459873333460629\\" title=\\"ajimg\\" img_work=\\"page_data_final_image668332133942416\\" class=\\"org_page_data_final_image668332133942416\\" src=\\"http://localhost/cardgenerator/assests/images/step4Image/_54934_2016_11_08_1470898659.jpg\\" /> ', '', '_23449_2016_09_08_1470737528.jpg', '', 3, 1, '0'),
(4, 13, '', '<div id=\\''background_card_div_image0\\'' ondblclick=\\''my_image_change(\\"background_card_div_image0\\")\\'' title=\\''Drag and drop to change position !.\\'' class=\\''background_div_image \\'' data-toggle=\\''popover\\'' style=\\''z-index: 10; top: -2px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1136px; height: 904px; right: auto; bottom: auto; left: -72px;\\''><img style=\\''width: 100%;height:100%;\\''  id=\\''background_card_item_image0\\'' src=\\''http://localhost/cardgenerator/assests/images/background/_53952_2016_10_08_1470802945.jpg\\'' alt=\\''\\'' /></div>', '', '', '<div id=\\"page_data_contener_4541889831041029\\" ondblclick=\\"my_text_change(&quot;page_data_contener_4541889831041029&quot;)\\" class=\\"_contener\\" data-toggle=\\"popover\\" style=\\"text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 127px; width: 362px; position: absolute; top: 57px; left: 74px; cursor: move; border-width: 1px; border-style: solid dashed; border-color: rgb(255, 0, 0); right: auto; bottom: auto;\\"><div divtype=\\"transbox\\" id=\\"page_data_transbox9062454131236472\\" ondblclick=\\"my_text_change(undefined)\\" class=\\"transbox center_center_middil\\" data-toggle=\\"popover\\" style=\\"z-index: 400; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px;\\"><p style=\\"width:100%; text-align:undefined;\\">HEEEEELO KSDKJDKAJ</p></div></div>', '', '', '_33148_2016_10_08_1470802931.jpg', '', 2, 3, '0'),
(5, 14, '', '<div id=\\''background_card_div_image0\\'' ondblclick=\\''my_image_change(\\"background_card_div_image0\\")\\'' title=\\''Drag and drop to change position !.\\'' class=\\''background_div_image \\'' data-toggle=\\''popover\\'' style=\\''z-index: 10; top: 0px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1405.01px; height: 934px; left: -355.014px;\\''><img style=\\''width: 100%;height:100%;\\''  id=\\''background_card_item_image0\\'' src=\\''http://localhost/cardgenerator/assests/images/background/_94073_2016_10_08_1470815505.jpg\\'' alt=\\''\\'' /></div>', '<div id=\\"page_datadiv_image1\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 487px; position: absolute; z-index: 103; cursor: move; width: 350.41px; right: auto; height: 225px; bottom: auto; left: 23.0167px;\\"><p style=\\"color:#333333;max-width: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image1\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_48370_2016_10_08_1470830500.jpg\\" id=\\"Npage_dataitem_image1\\" alt=\\"\\"></p></div>', '', '', '', '', '_92446_2016_10_08_1470815497.jpg', '', 1, 3, '0'),
(6, 15, '', '<div id=\\''background_card_div_image0\\'' ondblclick=\\''my_image_change(\\"background_card_div_image0\\")\\'' title=\\''Drag and drop to change position !.\\'' class=\\''background_div_image \\'' data-toggle=\\''popover\\'' style=\\''z-index: 10; top: 0px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1192.89px; height: 903px;\\''><img style=\\''width: 100%;height:100%;\\''  id=\\''background_card_item_image0\\'' src=\\''http://localhost/cardgenerator/assests/images/background/_95785_2016_12_08_1470981634.jpg\\'' alt=\\''\\'' /></div>', '<div id=\\"page_datadiv_image1\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 22px; position: absolute; z-index: 101; cursor: move; width: 242px; height: 180px; left: 20.9667px; right: auto; bottom: auto;\\"><p style=\\"color:#333333;max-width: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image1\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_77545_2016_12_08_1470981829.jpg\\" id=\\"Npage_dataitem_image1\\" alt=\\"\\"></p></div><div id=\\"page_datadiv_image2\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 30px; position: absolute; z-index: 102; cursor: move; width: 239px; height: 175px; left: 329.05px; right: auto; bottom: auto;\\"><p style=\\"color:#333333;max-width: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image2\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_11972_2016_12_08_1470981848.jpg\\" id=\\"Npage_dataitem_image2\\" alt=\\"\\"></p></div><div id=\\"page_datadiv_image3\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 299px; position: absolute; z-index: 104; cursor: move; width: 298px; height: 192px; left: 160.7px; right: auto; bottom: auto;\\"><p style=\\"max-width: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image3\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_60574_2016_12_08_1470988206.jpg\\" id=\\"Npage_dataitem_image3\\" alt=\\"\\"></p></div>', '', '<div id=\\"page_data_contener_9445086977050630\\" ondblclick=\\"my_text_change(&quot;page_data_contener_9445086977050630&quot;)\\" class=\\"_contener\\" data-toggle=\\"popover\\" style=\\"text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 121px; width: 344px; position: absolute; top: 666px; left: 166px; cursor: move; border-width: 1px; border-style: solid dashed; border-color: rgb(255, 0, 0); right: auto; bottom: auto;\\"><div divtype=\\"transbox\\" id=\\"page_data_transbox248185509032497\\" ondblclick=\\"my_text_change(undefined)\\" class=\\"transbox center_center_middil\\" data-toggle=\\"popover\\" style=\\"z-index: 400; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px;\\"><p style=\\"width:100%; text-align:undefined;\\">ARENBJHGD</p></div></div>', '', '', '_61456_2016_12_08_1470981629.jpg', '', 1, 1, '0'),
(7, 16, '', '<div id=\\''background_card_div_image0\\'' ondblclick=\\''my_image_change(\\"background_card_div_image0\\")\\'' title=\\''Drag and drop to change position !.\\'' class=\\''background_div_image \\'' data-toggle=\\''popover\\'' style=\\''z-index: 10; top: -22px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 955.44px; height: 795px;\\''><img style=\\''width: 100%;height:100%;\\''  id=\\''background_card_item_image0\\'' src=\\''http://localhost/cardgenerator/assests/images/background/_15786_2016_12_08_1470996079.jpg\\'' alt=\\''\\'' /></div>', '<div id=\\"page_datadiv_image1\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 32px; position: absolute; z-index: 101; cursor: move; width: 250px; height: 184.353px; left: 40.4333px; right: auto; bottom: auto;\\"><p style=\\"max-width: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image1\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_88116_2016_12_08_1470996111.jpg\\" id=\\"Npage_dataitem_image1\\" alt=\\"\\"></p></div><div id=\\"page_datadiv_image2\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 36px; position: absolute; z-index: 102; cursor: move; width: 249px; height: 180px; left: 312.05px; right: auto; bottom: auto;\\"><p style=\\"max-width: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image2\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_51742_2016_12_08_1470996134.jpg\\" id=\\"Npage_dataitem_image2\\" alt=\\"\\"></p></div><div id=\\"page_datadiv_image3\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 248px; position: absolute; z-index: 104; cursor: move; width: 255px; height: 186px; left: 199.883px; right: auto; bottom: auto;\\"><p style=\\"max-width: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image3\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_72924_2016_12_08_1470996153.jpg\\" id=\\"Npage_dataitem_image3\\" alt=\\"\\"></p></div>', '', '<div id=\\"page_data_contener_5006761451944007\\" ondblclick=\\"my_text_change(&quot;page_data_contener_5006761451944007&quot;)\\" class=\\"_contener\\" data-toggle=\\"popover\\" style=\\"text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 401; height: 174px; width: 232px; position: absolute; top: 234px; left: 565px; cursor: move; border-width: 1px; border-style: solid dashed; border-color: rgb(255, 0, 0); right: auto; bottom: auto;\\"><div divtype=\\"transbox\\" id=\\"page_data_transbox8439421201760501\\" ondblclick=\\"my_text_change(undefined)\\" class=\\"transbox center_center_middil\\" data-toggle=\\"popover\\" style=\\"z-index: 400; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px;\\"><p style=\\"width:100%; text-align:undefined;\\">Tanu weds Manu</p></div></div>', '', '', '_55017_2016_12_08_1470996074.jpg', '', 3, 1, '0'),
(8, 18, '', '<div id=\\''background_card_div_image0\\'' ondblclick=\\''my_image_change(\\"background_card_div_image0\\")\\'' title=\\''Drag and drop to change position !.\\'' class=\\''background_div_image \\'' data-toggle=\\''popover\\'' style=\\''z-index: 10; top: 0px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1057.2px; height: 881px;\\''><img style=\\''width: 100%;height:100%;\\''  id=\\''background_card_item_image0\\'' src=\\''http://localhost/cardgenerator/assests/images/background/_88879_2016_08_09_1473317513.jpg\\'' alt=\\''\\'' /></div>', '<div id=\\"page_datadiv_image1\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 94px; position: absolute; z-index: 101; cursor: move; width: 397px; height: 295px; left: 88.2833px; right: auto; bottom: auto;\\"><p style=\\"max-width: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image1\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_69277_2016_08_09_1473317526.jpg\\" id=\\"Npage_dataitem_image1\\" alt=\\"\\"></p></div>', '', '<div id=\\"page_data_contener_2308158393127193\\" ondblclick=\\"my_text_change(&quot;page_data_contener_2308158393127193&quot;)\\" class=\\"_contener\\" data-toggle=\\"popover\\" style=\\"text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 81px; width: 434px; position: absolute; top: 17px; left: 130px; cursor: move; border-width: 1px; border-style: solid dashed; border-color: rgb(255, 0, 0); right: auto; bottom: auto;\\"><div divtype=\\"transbox\\" id=\\"page_data_transbox9345914150566416\\" ondblclick=\\"my_text_change(undefined)\\" class=\\"transbox center_center_middil\\" data-toggle=\\"popover\\" style=\\"z-index: 400; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px;\\"><p style=\\"width:100%; text-align:undefined;\\">HELLO</p></div></div>', '', '', '_91281_2016_08_09_1473317501.jpg', '', 1, 1, '0'),
(9, 19, '', '', '', '', '', '', '', '_78182_2016_22_09_1474528216.jpg', '', 2, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_card_detail_second_side`
--

CREATE TABLE IF NOT EXISTS `tb_card_detail_second_side` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `background` text NOT NULL,
  `background_data` text NOT NULL,
  `card_data` text NOT NULL,
  `card_data2` text NOT NULL,
  `card_data3` text NOT NULL,
  `card_data4_image` text NOT NULL,
  `card_step1` varchar(10) NOT NULL,
  `card_step2` varchar(10) NOT NULL,
  `card_step3` varchar(10) NOT NULL,
  `card_step4` varchar(10) NOT NULL,
  `fonts_used_id` varchar(400) NOT NULL COMMENT 'those id which use in this card',
  `categories_id` int(11) NOT NULL,
  `tb_color_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'hide 0, show 1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_card_detail_second_side`
--

INSERT INTO `tb_card_detail_second_side` (`id`, `card_id`, `background`, `background_data`, `card_data`, `card_data2`, `card_data3`, `card_data4_image`, `card_step1`, `card_step2`, `card_step3`, `card_step4`, `fonts_used_id`, `categories_id`, `tb_color_id`, `status`) VALUES
(1, 11, '', '<div id=\\''background_card_div_image0\\'' ondblclick=\\''my_image_change(\\"background_card_div_image0\\")\\'' title=\\''Drag and drop to change position !.\\'' class=\\''background_div_image \\'' data-toggle=\\''popover\\'' style=\\''z-index: 10; top: -34px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1271px; right: auto; height: 962px; bottom: auto; left: -44px;\\''><img style=\\''width: 100%;height:100%;\\''  id=\\''background_card_item_image0\\'' src=\\''http://localhost/cardgenerator/assests/images/background/_69998_2016_09_08_1470723721.jpg\\'' alt=\\''\\'' /></div>', '<div id=\\"page_datadiv_image1\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 711px; position: absolute; z-index: 103; cursor: move; width: 209px; height: 153px; left: 18.1167px; right: auto; bottom: auto;\\"><p style=\\"max-width: 100%; max-height: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image1\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_90911_2016_09_08_1470723758.jpg\\" id=\\"Spage_dataitem_image1\\" alt=\\"\\"></p></div>', '', '<div id=\\"page_data_contener_2809126209630246\\" ondblclick=\\"my_text_change(&quot;page_data_contener_2809126209630246&quot;)\\" class=\\"_contener\\" data-toggle=\\"popover\\" style=\\"text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 401; height: 116px; width: 288px; position: absolute; top: 47px; left: 12px; cursor: move; border-width: 1px; border-style: solid dashed; border-color: rgb(255, 0, 0); right: auto; bottom: auto;\\"><div divtype=\\"transbox\\" id=\\"page_data_transbox9296725151583200\\" ondblclick=\\"my_text_change(undefined)\\" class=\\"transbox center_center_middil\\" data-toggle=\\"popover\\" style=\\"color: rgb(51, 51, 51); z-index: 400; position: relative; top: 0px; height: 86px; width: 100%; line-height: 24px; font-size: 36px; text-align: left; left: 0px;\\"><p style=\\"width:100%; text-align:left;\\">CHRISTENING</p></div></div>', '', 'done', 'done', 'done', 'done', '', 1, 1, '0'),
(2, 16, '', '<div id=\\''background_card_div_image0\\'' ondblclick=\\''my_image_change(\\"background_card_div_image0\\")\\'' title=\\''Drag and drop to change position !.\\'' class=\\''background_div_image \\'' data-toggle=\\''popover\\'' style=\\''z-index: 10; top: 0px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 929.193px; height: 704px;\\''><img style=\\''width: 100%;height:100%;\\''  id=\\''background_card_item_image0\\'' src=\\''http://localhost/cardgenerator/assests/images/background/_88714_2016_12_08_1470996213.jpg\\'' alt=\\''\\'' /></div>', '<div id=\\"page_datadiv_image1\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 50px; position: absolute; z-index: 101; cursor: move; width: 261px; right: auto; height: 206px; bottom: auto; left: 115px;\\"><p style=\\"max-width: 100%; max-height: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image1\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_60690_2016_12_08_1470996240.jpg\\" id=\\"Spage_dataitem_image1\\" alt=\\"\\"></p></div><div id=\\"page_datadiv_image2\\" title=\\"Drag and drop to change position and double click to change image!\\" class=\\"div_image\\" data-toggle=\\"popover\\" style=\\"top: 51px; position: absolute; z-index: 102; cursor: move; width: 265.544px; height: 205px; left: 477.456px; right: auto; bottom: auto;\\"><p style=\\"max-width: 100%; max-height: 100%;\\" class=\\"item_image\\" id=\\"page_dataitem_image2\\"><img src=\\"http://localhost/cardgenerator/assests/images/background/_16979_2016_12_08_1470996247.jpg\\" id=\\"Spage_dataitem_image2\\" alt=\\"\\"></p></div>', '', '<div id=\\"page_data_contener_9172898541487046\\" ondblclick=\\"my_text_change(&quot;page_data_contener_9172898541487046&quot;)\\" class=\\"_contener\\" data-toggle=\\"popover\\" style=\\"text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 147px; width: 364px; position: absolute; top: 258px; left: 248px; cursor: move; border-width: 1px; border-style: solid dashed; border-color: rgb(255, 0, 0); right: auto; bottom: auto;\\"><div divtype=\\"transbox\\" id=\\"page_data_transbox6489977257776096\\" ondblclick=\\"my_text_change(undefined)\\" class=\\"transbox center_center_middil\\" data-toggle=\\"popover\\" style=\\"z-index: 400; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px;\\"><p style=\\"width:100%; text-align:undefined;\\">Thanks</p></div></div>', '', 'done', 'done', 'done', 'done', '', 3, 1, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_card_detail_user`
--

CREATE TABLE IF NOT EXISTS `tb_card_detail_user` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `login_id` int(11) NOT NULL,
  `step1` text NOT NULL,
  `step2` text NOT NULL,
  `step3` text NOT NULL,
  `step4` text NOT NULL,
  `side2_step1` text NOT NULL,
  `side2_step2` text NOT NULL,
  `side2_step3` text NOT NULL,
  `side2_step4` text NOT NULL,
  `categories_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `mack_address` varchar(50) NOT NULL,
  `payment_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT 'not paid 0, paid 1, cancel 2',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'hide 0, show 1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_card_priview_delete`
--

CREATE TABLE IF NOT EXISTS `tb_card_priview_delete` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `card_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_card_text_validetion`
--

CREATE TABLE IF NOT EXISTS `tb_card_text_validetion` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `card_text_div_id` varchar(400) NOT NULL,
  `main_container_id` varchar(100) NOT NULL,
  `textarea_data` varchar(500) NOT NULL,
  `textarea_height` int(11) NOT NULL DEFAULT '0',
  `textarea_color` int(11) NOT NULL DEFAULT '0',
  `textarea_sort` int(11) NOT NULL DEFAULT '0',
  `textarea_display_title` varchar(200) NOT NULL,
  `max_characters` varchar(100) NOT NULL,
  `max_lines` varchar(100) NOT NULL,
  `default_size` varchar(100) NOT NULL,
  `max_size` varchar(100) NOT NULL,
  `min_size` varchar(100) NOT NULL,
  `text_algin` varchar(100) NOT NULL,
  `colours` varchar(100) NOT NULL,
  `font_style` varchar(100) NOT NULL,
  `text_line_height` int(11) NOT NULL DEFAULT '20',
  `stetus` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'hide 0, show 1',
  `card_side` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_card_text_validetion`
--

INSERT INTO `tb_card_text_validetion` (`id`, `card_id`, `card_text_div_id`, `main_container_id`, `textarea_data`, `textarea_height`, `textarea_color`, `textarea_sort`, `textarea_display_title`, `max_characters`, `max_lines`, `default_size`, `max_size`, `min_size`, `text_algin`, `colours`, `font_style`, `text_line_height`, `stetus`, `card_side`) VALUES
(1, 1, 'page_data_transbox3318657765661400', 'page_data_contener_3526456736406140', 'HAPPY BDAY TO YOU', 26, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 1),
(9, 6, 'page_data_transbox4297388347065468', 'page_data_contener_3369747718066936', 'TANU WEDS MANU', 26, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 1),
(10, 6, 'page_data_transbox8168810801772049', 'page_data_contener_5888822435297181', 'Thanks', 26, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 2),
(12, 1, 'page_data_transbox8849576899599101', 'page_data_contener_9142711906248102', 'HAPPY BDAY TO YOU', 26, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 1),
(13, 1, 'page_data_transbox4696559409323582', 'page_data_contener_5613871873367017', 'HEJWHJWRH', 26, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '3', '', 24, '1', 1),
(14, 1, 'page_data_transbox8272970900903767', 'page_data_contener_1094967634026302', 'HAPPY BDAY TO YOU DEAR', 19, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 1),
(15, 1, 'page_data_transbox3230262681997591', 'page_data_contener_5865711898120031', 'HAPPY BDAY TO YOU DEAR', 21, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 1),
(16, 1, 'page_data_transbox8705329947506151', 'page_data_contener_2516581648834888', 'HAPPY BDAYTO YOU', 26, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 1),
(17, 10, 'page_data_transbox657334785736559', 'page_data_contener_4291277157885988', 'HAPPY BDAY DEAR', 20, 0, 1, 'Display', '35', '2', '40', '20', '8', '', '', '1', 24, '1', 1),
(18, 11, 'page_data_transbox8322546082837970', 'page_data_contener_7661682615219555', 'WELCOME', 19, 0, 1, 'Display', '350', '2', '40', '20', '8', '', '', '', 24, '1', 1),
(20, 13, 'page_data_transbox9793992126571864', 'page_data_contener_3150152484099189', 'HAPPY NEW YEAR', 26, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 1),
(21, 14, 'page_data_transbox5798513349253249', 'page_data_contener_820093800612605', 'HELLO NEW', 26, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 1),
(22, 13, 'page_data_transbox9062454131236472', 'page_data_contener_4541889831041029', 'HEEEEELO KSDKJDKAJ', 26, 0, 1, 'Display', '350', '2', '12', '20', '8', '', '', '', 24, '1', 1),
(23, 15, 'page_data_transbox248185509032497', 'page_data_contener_9445086977050630', 'ARENBJHGD', 26, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 1),
(24, 16, 'page_data_transbox8439421201760501', 'page_data_contener_5006761451944007', 'Tanu weds Manu', 26, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 1),
(25, 16, 'page_data_transbox6489977257776096', 'page_data_contener_9172898541487046', 'Thanks', 26, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 2),
(26, 18, 'page_data_transbox9345914150566416', 'page_data_contener_2308158393127193', 'HELLO', 26, 0, 1, 'Display', '35', '2', '12', '20', '8', '', '', '', 24, '1', 1),
(38, 11, 'page_data_transbox9296725151583200', 'page_data_contener_2809126209630246', 'CHRISTENING', 23, 0, 1, 'Display', '35', '2', '36', '20', '8', 'left', '', '', 24, '1', 2),
(39, 10, 'page_data_transbox5944407495211034', 'page_data_contener_527093939801434', 'NEW TEST', 26, 0, 1, 'Display', '35', '2', '40', '20', '8', '', '', '1', 24, '1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_card_theme_delete`
--

CREATE TABLE IF NOT EXISTS `tb_card_theme_delete` (
  `id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `path` varchar(500) NOT NULL,
  `tb_color_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'hide 0, show 1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_categories`
--

CREATE TABLE IF NOT EXISTS `tb_categories` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `cat_image` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'hide 0, show 1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_categories`
--

INSERT INTO `tb_categories` (`id`, `category`, `cat_image`, `status`) VALUES
(1, 'Anniversary', '1464092621.jpg', '1'),
(2, 'Birthday', '1464092608.jpg', '1'),
(3, 'Wedding', '1464093051.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_colors`
--

CREATE TABLE IF NOT EXISTS `tb_colors` (
  `id` int(11) NOT NULL,
  `color_name` varchar(50) NOT NULL,
  `color_code` varchar(50) NOT NULL,
  `add_date` date NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'hide 0, show 1'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_colors`
--

INSERT INTO `tb_colors` (`id`, `color_name`, `color_code`, `add_date`, `status`) VALUES
(1, 'Blue', '#332ae4', '2016-02-25', '1'),
(3, 'Green', '#12ea04', '2016-02-25', '1'),
(5, 'light green', '#acfd86', '2016-07-21', '1'),
(2, 'Red', '#f01212', '2016-02-25', '1'),
(4, 'Yellow', '#fcf90d', '2016-02-25', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fonts`
--

CREATE TABLE IF NOT EXISTS `tb_fonts` (
  `id` int(11) NOT NULL,
  `fonts_name` varchar(50) NOT NULL,
  `fonts_path` varchar(200) NOT NULL,
  `add_date` date NOT NULL,
  `update_date` date NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'hide 0, show 1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_fonts`
--

INSERT INTO `tb_fonts` (`id`, `fonts_name`, `fonts_path`, `add_date`, `update_date`, `status`) VALUES
(1, 'Calibri', 'Calibri', '2016-02-25', '2016-02-25', '1'),
(2, 'Font_awesome', 'Font_awesome', '2016-02-25', '2016-09-23', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_fonts_file`
--

CREATE TABLE IF NOT EXISTS `tb_fonts_file` (
  `id` int(11) NOT NULL,
  `tb_fonts_id` int(11) NOT NULL,
  `fonts_path` varchar(300) NOT NULL,
  `fonts_format` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_fonts_file`
--

INSERT INTO `tb_fonts_file` (`id`, `tb_fonts_id`, `fonts_path`, `fonts_format`) VALUES
(1, 1, 'font_family/ttf/_83617_2016_25_02_1456380885.ttf', 'ttf'),
(3, 2, 'font_family/otf/_16601_2016_25_02_1456380931.otf', 'otf'),
(2, 2, 'font_family/ttf/_34866_2016_25_02_1456380930.ttf', 'ttf');

-- --------------------------------------------------------

--
-- Table structure for table `tb_step4_images`
--

CREATE TABLE IF NOT EXISTS `tb_step4_images` (
  `id` int(11) NOT NULL,
  `main_container_id` varchar(200) NOT NULL,
  `image_div_id` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `is_main` int(11) NOT NULL DEFAULT '0',
  `image_title` varchar(100) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '1',
  `card_id` int(11) NOT NULL,
  `card_side` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_step4_images`
--

INSERT INTO `tb_step4_images` (`id`, `main_container_id`, `image_div_id`, `image`, `is_main`, `image_title`, `sort`, `card_id`, `card_side`) VALUES
(1, '', 'page_data_final_image668332133942416', '_54934_2016_11_08_1470898659.jpg', 1, 'ajimg', 1, 13, 1),
(2, '', 'page_data_final_image668332133942416', '_61492_2016_11_08_1470898671.jpg', 0, 'ajimg2', 1, 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_categories`
--

CREATE TABLE IF NOT EXISTS `tb_sub_categories` (
  `id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `sub_categories` varchar(50) NOT NULL,
  `add_date` date NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'hide 0, show 1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE IF NOT EXISTS `tb_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ebay_id` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id`, `name`, `email`, `ebay_id`, `date`, `status`) VALUES
(1, 'Ajeet verma', 'ajeet@ucodice.com', '123456', '2016-06-21 12:47:26', '1'),
(2, 'Birbal', 'birbal@ucodice.com', 'birbal123', '2016-07-04 16:24:39', '1'),
(3, 'Neeraj', 'neeraj@ucodice.com', '1234567', '2016-09-29 14:51:55', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_cards`
--

CREATE TABLE IF NOT EXISTS `tb_user_cards` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `card_id` int(11) NOT NULL,
  `card_detail_id` int(11) NOT NULL,
  `card_session_id` varchar(200) NOT NULL,
  `side1` text NOT NULL,
  `side2` text NOT NULL,
  `side1_image` varchar(100) NOT NULL,
  `side2_image` varchar(100) NOT NULL,
  `card_html` text NOT NULL,
  `second_sidehtml` text NOT NULL,
  `date_added` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 inactive, 1 active'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user_cards`
--

INSERT INTO `tb_user_cards` (`id`, `user_id`, `reference_no`, `card_id`, `card_detail_id`, `card_session_id`, `side1`, `side2`, `side1_image`, `side2_image`, `card_html`, `second_sidehtml`, `date_added`, `status`) VALUES
(1, 1, '010816060801407', 10, 1, 'a01685b67ad7963db613618329a10aa0', '', '', 'side_1_10_a01685b67ad7963db613618329a10aa0', '', '\n								<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -7px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1102.22px; height: 917px; right: auto; bottom: auto; left: -46px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_28176_2016_21_07_1469096831.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 681px; position: absolute; z-index: 102; cursor: move; width: 291px; height: 164px; left: 22.2667px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_44891_2016_21_07_1469096876.jpg" id="Npage_dataitem_image1" alt=""></p></div><div title="" id="page_data_contener_4291277157885988" ondblclick="my_text_change(&quot;page_data_contener_4291277157885988&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 104px; width: 319px; position: absolute; top: 33px; left: 276px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox657334785736559" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#ff8040;z-index: 400; position: relative; top: 0px; left: 0px; height: 74px; width: 100%; line-height: 24px;"><p style="color:#ff8040;width: 100%;">HAPPY BDAY DEAR</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '', '2016-08-01', 1),
(2, 1, '100816044453934', 11, 2, '75cd9049a062fd625970d03dcfe43bf5', '', '', 'side_1_11_75cd9049a062fd625970d03dcfe43bf5', 'side_2_11_75cd9049a062fd625970d03dcfe43bf5', '\n								<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -8px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1103px; height: 919px; right: auto; bottom: auto; left: -54px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_76431_2016_09_08_1470723245.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 30px; position: absolute; z-index: 103; cursor: move; width: 156px; height: 116px; left: 28.1833px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_32882_2016_09_08_1470723593.jpg" id="Npage_dataitem_image1" alt=""></p></div><div title="" id="page_data_contener_7661682615219555" ondblclick="my_text_change(&quot;page_data_contener_7661682615219555&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 103px; width: 301px; position: absolute; top: 27px; left: 222px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox8322546082837970" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 73px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%;">WELCOME</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '\n									<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -34px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1271px; right: auto; height: 962px; bottom: auto; left: -44px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_69998_2016_09_08_1470723721.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 711px; position: absolute; z-index: 103; cursor: move; width: 209px; height: 153px; left: 18.1167px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%; max-height: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_90911_2016_09_08_1470723758.jpg" id="Spage_dataitem_image1" alt=""></p></div><div title="" id="page_data_contener_2809126209630246" ondblclick="my_text_change(&quot;page_data_contener_2809126209630246&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 116px; width: 288px; position: absolute; top: 20px; left: 313px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox9296725151583200" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 86px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%;">thank you</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '2016-08-10', 1),
(3, 1, '100816044757995', 11, 2, 'dff6960397fb59d8f6cd7287153b6625', '', '', 'side_1_11_dff6960397fb59d8f6cd7287153b6625', 'side_2_11_dff6960397fb59d8f6cd7287153b6625', '\n								<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -8px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1103px; height: 919px; right: auto; bottom: auto; left: -54px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_76431_2016_09_08_1470723245.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 30px; position: absolute; z-index: 103; cursor: move; width: 156px; height: 116px; left: 28.1833px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_32882_2016_09_08_1470723593.jpg" id="Npage_dataitem_image1" alt=""></p></div><div title="" id="page_data_contener_7661682615219555" ondblclick="my_text_change(&quot;page_data_contener_7661682615219555&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 103px; width: 301px; position: absolute; top: 27px; left: 222px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox8322546082837970" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 73px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%;">WELCOME</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '\n									<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -34px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1271px; right: auto; height: 962px; bottom: auto; left: -44px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_69998_2016_09_08_1470723721.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 711px; position: absolute; z-index: 103; cursor: move; width: 209px; height: 153px; left: 18.1167px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%; max-height: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_90911_2016_09_08_1470723758.jpg" id="Spage_dataitem_image1" alt=""></p></div><div title="" id="page_data_contener_2809126209630246" ondblclick="my_text_change(&quot;page_data_contener_2809126209630246&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 116px; width: 288px; position: absolute; top: 20px; left: 313px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox9296725151583200" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 86px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%;">thank you</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '2016-08-10', 1),
(4, 1, '100816054610274', 14, 5, '25568e883feb5340ceea1f3277edc5d0', '', '', 'side_1_14_25568e883feb5340ceea1f3277edc5d0', '', '\n								<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: 0px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1405.01px; height: 934px; left: -355.014px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_94073_2016_10_08_1470815505.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 21px; position: absolute; z-index: 101; cursor: move; width: 304px; height: 233px; left: 306px; right: auto; bottom: auto; overflow: hidden;"><p style="color:#333333;" class="item_image" id="page_dataitem_image1"><img style="width: 325.483px; height: 233px; margin-left: -10.7415px;" src="http://localhost/cardgenerator/assests/images/user_uploaded/220.jpg?1470831359" id="Npage_dataitem_image1" alt=""></p></div><div id="page_datadiv_image2" title="" class="div_image" data-toggle="popover" style="top: 487px; position: absolute; z-index: 103; cursor: move; width: 350.41px; right: auto; height: 225px; bottom: auto; left: 23.0167px; overflow: hidden;"><p style="color:#333333;" class="item_image" id="page_dataitem_image2"><img style="width: 350px; height: 254.405px; margin-top: -14.7026px;" src="http://localhost/cardgenerator/assests/images/user_uploaded/127.jpg?1470831359" id="Npage_dataitem_image2" alt=""></p></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '', '2016-08-10', 1),
(5, 1, '160816100921105', 16, 7, '3200026116711943562e2abcdc73b467', '', '', 'side_1_16_3200026116711943562e2abcdc73b467', 'side_2_16_3200026116711943562e2abcdc73b467', '\n								<div style="margin-top: 15%; margin-left: 21%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -22px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 955.44px; height: 795px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_15786_2016_12_08_1470996079.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 32px; position: absolute; z-index: 101; cursor: move; width: 250px; height: 184.353px; left: 40.4333px; right: auto; bottom: auto; overflow: hidden;"><p style="color:#333333;" class="item_image" id="page_dataitem_image1"><img style="width: 250px; height: 187.5px; margin-top: -1.75px;" src="http://localhost/cardgenerator/assests/images/user_uploaded/bday228.jpg?1471322358" id="Npage_dataitem_image1" alt=""></p></div><div id="page_datadiv_image2" title="" class="div_image" data-toggle="popover" style="top: 36px; position: absolute; z-index: 102; cursor: move; width: 249px; height: 180px; left: 312.05px; right: auto; bottom: auto; overflow: hidden;"><p style="color:#333333;" class="item_image" id="page_dataitem_image2"><img style="width: 288px; height: 180px; margin-left: -19.5px;" src="http://localhost/cardgenerator/assests/images/user_uploaded/bday124.jpg?1471322358" id="Npage_dataitem_image2" alt=""></p></div><div id="page_datadiv_image3" title="" class="div_image" data-toggle="popover" style="top: 248px; position: absolute; z-index: 104; cursor: move; width: 255px; height: 186px; left: 199.883px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image3"><img src="http://localhost/cardgenerator/assests/images/background/_72924_2016_12_08_1470996153.jpg" id="Npage_dataitem_image3" alt=""></p></div><div title="" id="page_data_contener_5006761451944007" ondblclick="my_text_change(&quot;page_data_contener_5006761451944007&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 401; height: 174px; width: 232px; position: absolute; top: 234px; left: 565px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox8439421201760501" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%;">Tanu weds Manu</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '\n									<div style="margin-top: 15%; margin-left: 21%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: 0px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 929.193px; height: 704px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_88714_2016_12_08_1470996213.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 50px; position: absolute; z-index: 101; cursor: move; width: 261px; right: auto; height: 206px; bottom: auto; left: 115px; overflow: hidden;"><p style="color:#333333;" class="item_image" id="page_dataitem_image1"><img style="width: 261px; height: 242.73px; margin-top: -18.365px;" src="http://localhost/cardgenerator/assests/images/user_uploaded/ff21.jpg?1471322358" id="Spage_dataitem_image1" alt=""></p></div><div id="page_datadiv_image2" title="" class="div_image" data-toggle="popover" style="top: 51px; position: absolute; z-index: 102; cursor: move; width: 265.544px; height: 205px; left: 477.456px; right: auto; bottom: auto; overflow: hidden;"><p style="color:#333333;" class="item_image" id="page_dataitem_image2"><img style="width: 273.333px; height: 205px; margin-left: -3.89167px;" src="http://localhost/cardgenerator/assests/images/user_uploaded/ff4.jpg?1471322358" id="Spage_dataitem_image2" alt=""></p></div><div title="" id="page_data_contener_9172898541487046" ondblclick="my_text_change(&quot;page_data_contener_9172898541487046&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 147px; width: 364px; position: absolute; top: 258px; left: 248px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox6489977257776096" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%;">Thanks</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '2016-08-16', 1),
(6, 1, '160816102711528', 16, 7, 'c0ad5cd6ae65e9e4091bb3cbf70dc433', '', '', 'side_1_16_c0ad5cd6ae65e9e4091bb3cbf70dc433', 'side_2_16_c0ad5cd6ae65e9e4091bb3cbf70dc433', '\n								<div style="margin-top: 15%; margin-left: 21%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -22px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 955.44px; height: 795px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_15786_2016_12_08_1470996079.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 32px; position: absolute; z-index: 101; cursor: move; width: 250px; height: 184.353px; left: 40.4333px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_88116_2016_12_08_1470996111.jpg" id="Npage_dataitem_image1" alt=""></p></div><div id="page_datadiv_image2" title="" class="div_image" data-toggle="popover" style="top: 36px; position: absolute; z-index: 102; cursor: move; width: 249px; height: 180px; left: 312.05px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image2"><img src="http://localhost/cardgenerator/assests/images/background/_51742_2016_12_08_1470996134.jpg" id="Npage_dataitem_image2" alt=""></p></div><div id="page_datadiv_image3" title="" class="div_image" data-toggle="popover" style="top: 248px; position: absolute; z-index: 104; cursor: move; width: 255px; height: 186px; left: 199.883px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image3"><img src="http://localhost/cardgenerator/assests/images/background/_72924_2016_12_08_1470996153.jpg" id="Npage_dataitem_image3" alt=""></p></div><div title="" id="page_data_contener_5006761451944007" ondblclick="my_text_change(&quot;page_data_contener_5006761451944007&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 401; height: 174px; width: 232px; position: absolute; top: 234px; left: 565px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox8439421201760501" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%;">Tanu weds Manu</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '\n									<div style="margin-top: 15%; margin-left: 21%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: 0px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 929.193px; height: 704px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_88714_2016_12_08_1470996213.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 50px; position: absolute; z-index: 101; cursor: move; width: 261px; right: auto; height: 206px; bottom: auto; left: 115px;"><p style="color:#333333;max-width: 100%; max-height: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_60690_2016_12_08_1470996240.jpg" id="Spage_dataitem_image1" alt=""></p></div><div id="page_datadiv_image2" title="" class="div_image" data-toggle="popover" style="top: 51px; position: absolute; z-index: 102; cursor: move; width: 265.544px; height: 205px; left: 477.456px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%; max-height: 100%;" class="item_image" id="page_dataitem_image2"><img src="http://localhost/cardgenerator/assests/images/background/_16979_2016_12_08_1470996247.jpg" id="Spage_dataitem_image2" alt=""></p></div><div title="" id="page_data_contener_9172898541487046" ondblclick="my_text_change(&quot;page_data_contener_9172898541487046&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 147px; width: 364px; position: absolute; top: 258px; left: 248px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox6489977257776096" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%;">Thanks</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '2016-08-16', 1),
(7, 1, '160816055928260', 11, 2, '17cd1a857001ff79374dd09814b7179f', '', '', 'side_1_11_17cd1a857001ff79374dd09814b7179f', 'side_2_11_17cd1a857001ff79374dd09814b7179f', '\n								<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -8px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1103px; height: 919px; right: auto; bottom: auto; left: -54px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_76431_2016_09_08_1470723245.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 30px; position: absolute; z-index: 103; cursor: move; width: 156px; height: 116px; left: 28.1833px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_32882_2016_09_08_1470723593.jpg" id="Npage_dataitem_image1" alt=""></p></div><div title="" id="page_data_contener_7661682615219555" ondblclick="my_text_change(&quot;page_data_contener_7661682615219555&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 103px; width: 301px; position: absolute; top: 27px; left: 222px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox8322546082837970" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 73px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%; font-size: 8px;">welcome<br>asdasda<br>asfdsadf<br><br><br><br>sdfsdf<br><br>sfsdf<br><br><br>sdfdsg</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '\n									<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -34px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1271px; right: auto; height: 962px; bottom: auto; left: -44px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_69998_2016_09_08_1470723721.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 711px; position: absolute; z-index: 103; cursor: move; width: 209px; height: 153px; left: 18.1167px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%; max-height: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_90911_2016_09_08_1470723758.jpg" id="Spage_dataitem_image1" alt=""></p></div><div title="" id="page_data_contener_2809126209630246" ondblclick="my_text_change(&quot;page_data_contener_2809126209630246&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 116px; width: 288px; position: absolute; top: 20px; left: 313px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox9296725151583200" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 86px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%;">thank you asdkhasjdhasdh  sdad kjas</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '2016-08-16', 1);
INSERT INTO `tb_user_cards` (`id`, `user_id`, `reference_no`, `card_id`, `card_detail_id`, `card_session_id`, `side1`, `side2`, `side1_image`, `side2_image`, `card_html`, `second_sidehtml`, `date_added`, `status`) VALUES
(8, 1, '450330', 16, 7, 'acd49547979cafded9da7c25ab5c93b6', '', '', 'side_1_16_acd49547979cafded9da7c25ab5c93b6', 'side_2_16_acd49547979cafded9da7c25ab5c93b6', '\n								<div style="margin-top: 15%; margin-left: 21%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -22px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 955.44px; height: 795px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_15786_2016_12_08_1470996079.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 32px; position: absolute; z-index: 101; cursor: move; width: 250px; height: 184.353px; left: 40.4333px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_88116_2016_12_08_1470996111.jpg" id="Npage_dataitem_image1" alt=""></p></div><div id="page_datadiv_image2" title="" class="div_image" data-toggle="popover" style="top: 36px; position: absolute; z-index: 102; cursor: move; width: 249px; height: 180px; left: 312.05px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image2"><img src="http://localhost/cardgenerator/assests/images/background/_51742_2016_12_08_1470996134.jpg" id="Npage_dataitem_image2" alt=""></p></div><div id="page_datadiv_image3" title="" class="div_image" data-toggle="popover" style="top: 248px; position: absolute; z-index: 104; cursor: move; width: 255px; height: 186px; left: 199.883px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image3"><img src="http://localhost/cardgenerator/assests/images/background/_72924_2016_12_08_1470996153.jpg" id="Npage_dataitem_image3" alt=""></p></div><div title="" id="page_data_contener_5006761451944007" ondblclick="my_text_change(&quot;page_data_contener_5006761451944007&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 401; height: 174px; width: 232px; position: absolute; top: 234px; left: 565px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox8439421201760501" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%;">Tanu weds Manu</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '\n									<div style="margin-top: 15%; margin-left: 21%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: 0px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 929.193px; height: 704px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_88714_2016_12_08_1470996213.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 50px; position: absolute; z-index: 101; cursor: move; width: 261px; right: auto; height: 206px; bottom: auto; left: 115px;"><p style="color:#333333;max-width: 100%; max-height: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_60690_2016_12_08_1470996240.jpg" id="Spage_dataitem_image1" alt=""></p></div><div id="page_datadiv_image2" title="" class="div_image" data-toggle="popover" style="top: 51px; position: absolute; z-index: 102; cursor: move; width: 265.544px; height: 205px; left: 477.456px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%; max-height: 100%;" class="item_image" id="page_dataitem_image2"><img src="http://localhost/cardgenerator/assests/images/background/_16979_2016_12_08_1470996247.jpg" id="Spage_dataitem_image2" alt=""></p></div><div title="" id="page_data_contener_9172898541487046" ondblclick="my_text_change(&quot;page_data_contener_9172898541487046&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 147px; width: 364px; position: absolute; top: 258px; left: 248px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox6489977257776096" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%;">Thanks</p></div></div>                                    </div>\n									\n                                </div>\n                            \n                                                        <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '2016-08-17', 1),
(9, 3, '091817', 11, 2, 'b7a0f6b1b406c689491bdfc597d3bc17', '', '', 'side_1_11_b7a0f6b1b406c689491bdfc597d3bc17', 'side_2_11_b7a0f6b1b406c689491bdfc597d3bc17', '\n								<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -8px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1103px; height: 919px; right: auto; bottom: auto; left: -54px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_76431_2016_09_08_1470723245.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 30px; position: absolute; z-index: 103; cursor: move; width: 156px; height: 116px; left: 28.1833px; right: auto; bottom: auto; overflow: hidden;"><p style="color:#333333;" class="item_image" id="page_dataitem_image1"><img style="width: 163.041px; height: 116px; margin-left: -3.52074px;" src="http://localhost/cardgenerator/assests/images/user_uploaded/413.jpg?1475140915" id="Npage_dataitem_image1" alt=""></p></div><div title="" id="page_data_contener_7661682615219555" ondblclick="my_text_change(&quot;page_data_contener_7661682615219555&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 400; height: 103px; width: 301px; position: absolute; top: 27px; left: 222px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox8322546082837970" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; left: 0px; height: 73px; width: 100%; line-height: 24px;"><p style="color:#333333;width: 100%;">Test</p></div></div>                                    </div>\n                                </div>\n                            \n                            \n                            <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '\n									<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -34px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1271px; right: auto; height: 962px; bottom: auto; left: -44px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_69998_2016_09_08_1470723721.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 711px; position: absolute; z-index: 103; cursor: move; width: 209px; height: 153px; left: 18.1167px; right: auto; bottom: auto; overflow: hidden;"><p style="color:#333333;" class="item_image" id="page_dataitem_image1"><img style="width: 209px; height: 158.348px; margin-top: -2.67412px;" src="http://localhost/cardgenerator/assests/images/user_uploaded/back12.jpg?1475140915" id="Spage_dataitem_image1" alt=""></p></div><div title="" id="page_data_contener_2809126209630246" ondblclick="my_text_change(&quot;page_data_contener_2809126209630246&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 401; height: 116px; width: 288px; position: absolute; top: 47px; left: 12px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox9296725151583200" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#333333;z-index: 400; position: relative; top: 0px; height: 86px; width: 100%; line-height: 24px; font-size: 36px; text-align: left; left: 0px;"><p style="color:#333333;width: 100%; text-align: left;">CHRISTENING</p></div></div>                                    </div>\n                                </div>\n                            \n                            \n                            <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '2016-09-29', 1),
(10, 3, '155990', 10, 1, '6ca1b7e5e0bb6c3387d70e3d0eef2643', '', '', 'side_1_10_6ca1b7e5e0bb6c3387d70e3d0eef2643', '', '\n								<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -7px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1102.22px; height: 917px; right: auto; bottom: auto; left: -46px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_28176_2016_21_07_1469096831.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 204px; position: absolute; z-index: 105; cursor: move; width: 291px; height: 164px; left: 190.267px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_44891_2016_21_07_1469096876.jpg" id="Npage_dataitem_image1" alt=""></p></div><div title="" id="page_data_contener_4291277157885988" ondblclick="my_text_change(&quot;page_data_contener_4291277157885988&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 401; height: 104px; width: 319px; position: absolute; top: 145px; left: 182px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox657334785736559" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#ff8040;z-index: 400; position: relative; top: 0px; left: 0px; height: 74px; width: 100%; line-height: 24px; font-size: 40px; font-family: Calibri;"><p style="color:#ff8040;width: 100%;">HAPPY BDAY DEAR</p></div></div><div title="" id="page_data_contener_527093939801434" ondblclick="my_text_change(&quot;page_data_contener_527093939801434&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 402; height: 270px; width: 270px; position: absolute; top: 319px; left: 200px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox5944407495211034" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#09135e;z-index: 401; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px; font-size: 40px; font-family: Calibri;"><p style="color:#09135e;width: 100%;">NEW TEST</p></div></div>                                    </div>\n                                </div>\n                            \n                            \n                            <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '', '2016-10-03', 1),
(11, 3, '887792', 10, 1, 'efd0f28119fc719d619ba1c3c1089149', '', '', 'side_1_10_efd0f28119fc719d619ba1c3c1089149', '', '\n								<div align="center" class="watermark crd_dsgn_watermrk" title="" style="margin-top: 30%; margin-left: 3%;">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: none; background: rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-top: none; border-right: none; border-bottom: none; border-left: 0px solid; border-image: initial; width: 13px; right: 0px; left: 0px; background: rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div class="background center-block" title="">\n                                    <div id="page_data" title="">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -7px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1102.22px; height: 917px; right: auto; bottom: auto; left: -46px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_28176_2016_21_07_1469096831.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 204px; position: absolute; z-index: 105; cursor: move; width: 291px; height: 164px; left: 190.267px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_44891_2016_21_07_1469096876.jpg" id="Npage_dataitem_image1" alt=""></p></div><div id="page_data_contener_4291277157885988" ondblclick="my_text_change(&quot;page_data_contener_4291277157885988&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 401; height: 104px; width: 319px; position: absolute; top: 145px; left: 182px; cursor: move; right: auto; bottom: auto;" title=""><div divtype="transbox" id="page_data_transbox657334785736559" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#ff8040;z-index: 400; position: relative; top: 0px; left: 0px; height: 74px; width: 100%; line-height: 24px; font-size: 40px; font-family: Calibri;" title=""><p style="color:#ff8040;width:100%; text-align:undefined;">HAPPY BDAY DEAR</p></div></div><div id="page_data_contener_527093939801434" ondblclick="my_text_change(&quot;page_data_contener_527093939801434&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 402; height: 270px; width: 270px; position: absolute; top: 319px; left: 200px; cursor: move; right: auto; bottom: auto;" title=""><div divtype="transbox" id="page_data_transbox5944407495211034" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#09135e;z-index: 401; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px; font-size: 40px; font-family: Calibri;" title=""><p style="color:#09135e;width:100%; text-align:undefined;">NEW TEST</p></div></div>                                    </div>\n                                </div>\n                            \n                            \n                            <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: none; background: rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '', '2016-10-03', 1),
(12, 3, '920229', 10, 1, '7af9dfdfffddc65e4366779eb48f3ffe', '', '', 'side_1_10_7af9dfdfffddc65e4366779eb48f3ffe', '', '\n								<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="position: absolute; cursor: move; bottom: auto; height: 917px; left: -46px; background: none repeat scroll 0px 0px transparent; right: auto; top: -7px; width: 1102.22px; z-index: 10;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_28176_2016_21_07_1469096831.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="position: absolute; cursor: move; height: 164px; left: 190.267px; right: auto; bottom: auto; top: 204px; width: 291px; z-index: 105;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_44891_2016_21_07_1469096876.jpg" id="Npage_dataitem_image1" alt=""></p></div><div title="" id="page_data_contener_4291277157885988" ondblclick="my_text_change(&quot;page_data_contener_4291277157885988&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 401; height: 104px; width: 319px; position: absolute; top: 145px; left: 182px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox657334785736559" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color: rgb(255, 128, 64); z-index: 400; position: relative; top: 0px; left: 0px; width: 100%; line-height: 24px; font-size: 40px; font-family: Calibri; height: 74px;"><p style="color:#ff8040;width: 100%;">HAPPY BDAY DEAR</p></div></div><div title="" id="page_data_contener_527093939801434" ondblclick="my_text_change(&quot;page_data_contener_527093939801434&quot;)" class="_contener" data-toggle="popover" style="text-align: center; z-index: 402; height: 270px; width: 270px; position: absolute; top: 319px; left: 200px; cursor: move; right: auto; bottom: auto; padding-bottom: 10px; padding-top: 15px;"><div title="" divtype="transbox" id="page_data_transbox5944407495211034" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#09135e;z-index: 401; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px; font-size: 40px; font-family: Calibri;"><p style="color:#09135e;width: 100%;">NEW TEST</p></div></div>                                    </div>\n                                </div>\n                            \n                            \n                            <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '', '2016-10-03', 1),
(13, 3, '099173', 10, 1, 'd9e4a9e971060e8552ad6ab9c3403bf7', '', '', 'side_1_10_d9e4a9e971060e8552ad6ab9c3403bf7', '', '\n								<div style="margin-top: 30%; margin-left: 3%;" title="" class="watermark crd_dsgn_watermrk" align="center">Proof</div>\n								<!--only for border line only start-->\n                            <span class="card_border_top" style="height: 13px; top: 0px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--<hr style="margin-bottom: 0; margin-top: 12px; border-color: #ff0000;position: relative;z-index: 200;">-->\n                            <span class="card_border_left" style="border-right: 0px solid; width: 13px; position: relative; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <span class="card_border_right" style="border-width: medium medium medium 0px; border-style: none none none solid; border-color: -moz-use-text-color; -moz-border-top-colors: none; -moz-border-right-colors: none; -moz-border-bottom-colors: none; -moz-border-left-colors: none; border-image: none; width: 13px; right: 0px; left: 0px; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n                            \n                            \n                                \n                                <div title="" class="background center-block">\n                                    <div title="" id="page_data">\n                                        <div id="background_card_div_image0" ondblclick="my_image_change(&quot;background_card_div_image0&quot;)" title="" class="background_div_image " data-toggle="popover" style="z-index: 10; top: -7px; position: absolute; background: none repeat scroll 0% 0% transparent; cursor: move; width: 1102.22px; height: 917px; right: auto; bottom: auto; left: -46px;"><img style="width: 100%;height:100%;" id="background_card_item_image0" src="http://localhost/cardgenerator/assests/images/background/_28176_2016_21_07_1469096831.jpg" alt=""></div><div id="page_datadiv_image1" title="" class="div_image" data-toggle="popover" style="top: 204px; position: absolute; z-index: 105; cursor: move; width: 291px; height: 164px; left: 190.267px; right: auto; bottom: auto;"><p style="color:#333333;max-width: 100%;" class="item_image" id="page_dataitem_image1"><img src="http://localhost/cardgenerator/assests/images/background/_44891_2016_21_07_1469096876.jpg" id="Npage_dataitem_image1" alt=""></p></div><div title="" id="page_data_contener_4291277157885988" ondblclick="my_text_change(&quot;page_data_contener_4291277157885988&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 402; height: 104px; width: 319px; position: absolute; top: 147px; left: 182px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox657334785736559" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#ff8040;z-index: 400; position: relative; top: 0px; left: 0px; height: 74px; width: 100%; line-height: 24px; font-size: 40px; font-family: Calibri;"><p style="color:#ff8040;width: 100%;">HAPPY BDAY DEAR</p></div></div><div title="" id="page_data_contener_527093939801434" ondblclick="my_text_change(&quot;page_data_contener_527093939801434&quot;)" class="_contener" data-toggle="popover" style="text-align: center; padding-top: 10px; padding-bottom: 10px; z-index: 402; height: 270px; width: 270px; position: absolute; top: 319px; left: 200px; cursor: move; right: auto; bottom: auto;"><div title="" divtype="transbox" id="page_data_transbox5944407495211034" ondblclick="my_text_change(undefined)" class="transbox center_center_middil" data-toggle="popover" style="color:#09135e;z-index: 401; position: relative; top: 0px; left: 0px; height: 100px; width: 100%; line-height: 24px; font-size: 40px; font-family: Calibri;"><p style="color:#09135e;width: 100%;">NEW TEST</p></div></div>                                    </div>\n                                </div>\n                            \n                            \n                            <!--only for border line only start-->\n                            <span class="card_border_bottom" style="height: 18px; bottom: 26px; position: relative; border: medium none; background: none repeat scroll 0% 0% rgb(248, 248, 248);"></span>\n                            <!--only for border line only end-->\n    								', '', '2016-10-04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_images`
--

CREATE TABLE IF NOT EXISTS `tb_user_images` (
  `id` int(11) NOT NULL,
  `session_id` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL,
  `image_height` int(11) NOT NULL,
  `image_width` int(11) NOT NULL,
  `image_styles` varchar(500) NOT NULL,
  `card_id` int(11) NOT NULL,
  `card_side` int(11) NOT NULL DEFAULT '1',
  `used` int(11) NOT NULL DEFAULT '0' COMMENT '0 not used, 1 used for card ',
  `image_div_id` varchar(100) NOT NULL COMMENT 'id of contained div',
  `add_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`,`password`);

--
-- Indexes for table `tb_admin_card_image`
--
ALTER TABLE `tb_admin_card_image`
  ADD PRIMARY KEY (`id`), ADD KEY `card_id` (`card_id`,`ip_address`,`mac_address`,`image_use_counter`,`show_status`);

--
-- Indexes for table `tb_card`
--
ALTER TABLE `tb_card`
  ADD PRIMARY KEY (`id`), ADD KEY `card_name` (`card_name`,`pappersize`,`papper_side`,`keywords`,`sort`,`categories_id`,`card_step0`,`card_step1`,`card_step2`,`card_step3`,`card_step4`,`status`);

--
-- Indexes for table `tb_card_background_image_delete`
--
ALTER TABLE `tb_card_background_image_delete`
  ADD PRIMARY KEY (`id`), ADD KEY `card_id` (`card_id`,`div_id`,`categories_id`,`image_path`,`image_name`,`ip_address`,`mac_address`,`tb_color_id`,`status`);

--
-- Indexes for table `tb_card_detail`
--
ALTER TABLE `tb_card_detail`
  ADD PRIMARY KEY (`id`), ADD KEY `card_id` (`card_id`,`fonts_used_id`,`categories_id`,`tb_color_id`,`status`);

--
-- Indexes for table `tb_card_detail_second_side`
--
ALTER TABLE `tb_card_detail_second_side`
  ADD PRIMARY KEY (`id`), ADD KEY `card_id` (`card_id`,`card_step1`,`card_step2`,`card_step3`,`card_step4`,`fonts_used_id`,`categories_id`,`tb_color_id`,`status`);

--
-- Indexes for table `tb_card_detail_user`
--
ALTER TABLE `tb_card_detail_user`
  ADD PRIMARY KEY (`id`), ADD KEY `card_id` (`card_id`,`login_id`,`categories_id`,`color_id`,`ip_address`,`mack_address`,`payment_status`,`status`);

--
-- Indexes for table `tb_card_priview_delete`
--
ALTER TABLE `tb_card_priview_delete`
  ADD PRIMARY KEY (`id`), ADD KEY `card_id` (`card_id`);

--
-- Indexes for table `tb_card_text_validetion`
--
ALTER TABLE `tb_card_text_validetion`
  ADD PRIMARY KEY (`id`), ADD KEY `card_id` (`card_id`,`card_text_div_id`,`max_characters`,`max_lines`,`default_size`,`max_size`,`min_size`,`text_algin`,`colours`,`font_style`,`stetus`);

--
-- Indexes for table `tb_card_theme_delete`
--
ALTER TABLE `tb_card_theme_delete`
  ADD PRIMARY KEY (`id`), ADD KEY `card_id` (`card_id`,`categories_id`,`path`,`tb_color_id`,`status`);

--
-- Indexes for table `tb_categories`
--
ALTER TABLE `tb_categories`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `category_2` (`category`), ADD KEY `category` (`category`,`status`);

--
-- Indexes for table `tb_colors`
--
ALTER TABLE `tb_colors`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `color_name_2` (`color_name`,`color_code`), ADD KEY `color_name` (`color_name`,`color_code`,`add_date`,`status`);

--
-- Indexes for table `tb_fonts`
--
ALTER TABLE `tb_fonts`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `fonts_name` (`fonts_name`), ADD UNIQUE KEY `fonts_path` (`fonts_path`), ADD UNIQUE KEY `fonts_name_3` (`fonts_name`,`fonts_path`), ADD KEY `fonts_name_2` (`fonts_name`,`fonts_path`,`add_date`,`update_date`,`status`);

--
-- Indexes for table `tb_fonts_file`
--
ALTER TABLE `tb_fonts_file`
  ADD PRIMARY KEY (`id`), ADD KEY `tb_fonts_id` (`tb_fonts_id`,`fonts_path`,`fonts_format`);

--
-- Indexes for table `tb_step4_images`
--
ALTER TABLE `tb_step4_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_sub_categories`
--
ALTER TABLE `tb_sub_categories`
  ADD PRIMARY KEY (`id`), ADD KEY `categories_id` (`categories_id`,`sub_categories`,`add_date`,`status`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_cards`
--
ALTER TABLE `tb_user_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user_images`
--
ALTER TABLE `tb_user_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tb_admin_card_image`
--
ALTER TABLE `tb_admin_card_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_card`
--
ALTER TABLE `tb_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tb_card_background_image_delete`
--
ALTER TABLE `tb_card_background_image_delete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_card_detail`
--
ALTER TABLE `tb_card_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tb_card_detail_second_side`
--
ALTER TABLE `tb_card_detail_second_side`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_card_detail_user`
--
ALTER TABLE `tb_card_detail_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_card_priview_delete`
--
ALTER TABLE `tb_card_priview_delete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_card_text_validetion`
--
ALTER TABLE `tb_card_text_validetion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `tb_card_theme_delete`
--
ALTER TABLE `tb_card_theme_delete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_categories`
--
ALTER TABLE `tb_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_colors`
--
ALTER TABLE `tb_colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_fonts`
--
ALTER TABLE `tb_fonts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_fonts_file`
--
ALTER TABLE `tb_fonts_file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_step4_images`
--
ALTER TABLE `tb_step4_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tb_sub_categories`
--
ALTER TABLE `tb_sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_user_cards`
--
ALTER TABLE `tb_user_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tb_user_images`
--
ALTER TABLE `tb_user_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
