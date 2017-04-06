-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 06, 2017 at 06:39 AM
-- Server version: 5.6.33-cll-lve
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Hardware_DB09`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat_images`
--

CREATE TABLE IF NOT EXISTS `cat_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `ssid` int(11) NOT NULL,
  `images` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1484 ;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41668 ;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=116 ;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2318 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ads`
--

CREATE TABLE IF NOT EXISTS `tbl_ads` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `ads_name` varchar(200) NOT NULL,
  `ads_image1` varchar(255) NOT NULL,
  `ads_image2` varchar(255) NOT NULL,
  `clientid` int(11) NOT NULL,
  `ads_type` varchar(20) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE IF NOT EXISTS `tbl_brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `brandname` varchar(255) NOT NULL,
  `catalogue` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_categories`
--

CREATE TABLE IF NOT EXISTS `tbl_categories` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` varchar(200) NOT NULL,
  `cat_img` varchar(255) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dealer`
--

CREATE TABLE IF NOT EXISTS `tbl_dealer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `brand_id` varchar(255) NOT NULL,
  `firmname` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobileno` varchar(20) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `pincode` int(10) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event`
--

CREATE TABLE IF NOT EXISTS `tbl_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(100) NOT NULL,
  `event_image` varchar(255) NOT NULL,
  `detail` varchar(500) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_event_photos`
--

CREATE TABLE IF NOT EXISTS `tbl_event_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eid` int(11) NOT NULL,
  `img` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inquiry`
--

CREATE TABLE IF NOT EXISTS `tbl_inquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `wts_new` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `inquiry_type` varchar(25) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `details` text NOT NULL,
  `inquirydate` datetime NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'enable',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pages`
--

CREATE TABLE IF NOT EXISTS `tbl_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_title` varchar(200) NOT NULL,
  `page_contant` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL,
  `sscat_id` int(11) NOT NULL,
  `manufacture_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `pcode` varchar(100) NOT NULL,
  `pname` varchar(200) NOT NULL,
  `product_img` varchar(200) NOT NULL,
  `pdetail` text NOT NULL,
  `note` varchar(255) NOT NULL,
  `whats_new` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_photos`
--

CREATE TABLE IF NOT EXISTS `tbl_product_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `img` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=266 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_roles`
--

CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategories`
--

CREATE TABLE IF NOT EXISTS `tbl_subcategories` (
  `subcat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `subcat_name` varchar(200) NOT NULL,
  `subcat_img` varchar(255) NOT NULL,
  `detail` varchar(200) NOT NULL,
  PRIMARY KEY (`subcat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=170 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subscription`
--

CREATE TABLE IF NOT EXISTS `tbl_subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sub_subcategories`
--

CREATE TABLE IF NOT EXISTS `tbl_sub_subcategories` (
  `sscat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `subcat_id` int(11) NOT NULL,
  `ssname` varchar(200) NOT NULL,
  `sub_sub_img` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  PRIMARY KEY (`sscat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=303 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `type` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `profile_img` varchar(255) NOT NULL,
  `brochar_img` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `created_date` date NOT NULL,
  `approved_date` datetime NOT NULL,
  `contact` varchar(255) NOT NULL,
  `about_manf` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `phase` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_whatsnew_product`
--

CREATE TABLE IF NOT EXISTS `tbl_whatsnew_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pname` varchar(200) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `manufacture_id` int(11) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `detail` text NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `whatsnew_img`
--

CREATE TABLE IF NOT EXISTS `whatsnew_img` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `img_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
