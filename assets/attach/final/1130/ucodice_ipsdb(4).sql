-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Sep 14, 2016 at 05:20 AM
-- Server version: 5.5.50-cll
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ips`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE IF NOT EXISTS `about` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  `page_url` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL COMMENT '0=in-active,1=active',
  `filename` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_name` (`page_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `page_name`, `page_url`, `content`, `timestamp`, `status`, `filename`) VALUES
(1, 'Vision/Mission/Values', 'vision_mission_values', '<div>\r\n<div id="contentPrimary">\r\n<h3><span style="color: #b22222;"><strong>Vision</strong></span></h3>\r\n<p style="text-align: justify; padding-left: 33px;">IPS will be the Knowledge Leaders of Choice by delivering Technology-based Business Solutions which help our Clients Succeed. To be the Knowledge Leader, we continue to push ourselves in new and exciting directions. Our Vision, Mission and Values were developed to help guide our actions.</p>\r\n<h3 style="text-align: justify;"><span style="color: #b22222;"><strong>Mission</strong></span></h3>\r\n<ul style="list-style-type: disc;">\r\n<li>Be recognized and sought after as the premier provider of integrated consulting, design, project delivery and related compliance services.</li>\r\n<li>Consistently meet our clients&rsquo; expectations and help them succeed through delivering quality technical services at a fair reward and with a quality experience.</li>\r\n<li>Be an organization of professionalism and purpose, guided by respect for the individual.</li>\r\n</ul>\r\n<h3 style="text-align: justify;"><span style="color: #b22222;"><strong>Values</strong></span></h3>\r\n<ul style="list-style-type: disc;">\r\n<li><strong>Entrepreneurship- </strong>We consistently seek new opportunities in a persistent quest for excellence to deliver value and help our clients succeed. We thrive on challenge.</li>\r\n<li><strong>Passion-</strong>&nbsp; We approach our work enthusiastically with contagious energy and drive. We love what we do.</li>\r\n<li><strong>Creativity / Innovation- </strong>We enjoy creating and continually improving our solutions, tools, methods and entire service delivery system for the benefit of our customers and the world. We are imaginative and visionary.</li>\r\n<li><strong>Integrity / Respect-&nbsp;</strong> We conduct ourselves with uncompromising honesty and true commitment to the welfare of our customers and each other. We are ethical professionals.</li>\r\n<li><strong>Relationships-</strong> We sustain long- term relationships of compelling mutual value through teamwork and committed individuals. We are good partners.</li>\r\n<li><strong>Success / Rewards-</strong> We are driven to succeed and be recognized and rewarded for goal attainment. We are winners. &ldquo;We know a lot, deliver it well, and positively impact our clients&rsquo; bottom line.&rdquo;</li>\r\n</ul>\r\n</div>\r\n</div>', '2016-08-10 05:11:22', '1', '1472197730.jpg'),
(2, 'Global Strength', 'global_strength', '<p>Opened in 2007, IPS International&rsquo;s fully operational offices in India focusing on providing engineering, design construction and commissioning services for Biotech, API and Pharmaceutical companies. Our team of 30+ experienced professionals is dedicated to improving operations, revitalizing facilities and staying compliant in the global marketplace. Focusing on key technologies, we offer cost effective business solutions to successfully deliver your technically complex facility on-time and on budget. We understand the regulatory environment requirements in India and around the world, including the availability of material and equipment in India enable us to specify and procure locally available systems while maintaining compliance with International Standards.</p>\r\n<p>We specialize in:</p>\r\n<p>&bull; Containment strategies for using potent and cytotoxic compounds in OSD and Sterile / Injectable facilities</p>\r\n<p>&bull; Advanced aseptic technology including Annex I from EMEA&rsquo;s Regulations and Guidelines for Good Manufacturing Practice for Active Pharmaceutical Ingredients</p>\r\n<p>&bull; Biotechnology including vaccine production with cell culture, downstream purification, disposable techniques and bio-safety level 2-3</p>\r\n<p>&bull; R&amp;D Laboratory and Facility Design and Vivarium Design meeting AAALAC requirements</p>\r\n<p>&bull; Our expertise includes process design, process development, critical utilities such as WFI and Clean Steam Design, clean room design and specialized HVAC Our approach and our subject knowledge expertise in engineering, construction and commissioning and qualification has been the cornerstone of our success. We continually find ways to do things better and more efficiently, delivering higher quality, controlling costs and the operational functionality required to effectively successfully execute your overall project and business objectives &ndash; resulting in real value for our clients.</p>', '2016-08-10 07:13:26', '1', '1471411284.jpg'),
(3, 'Team', 'team', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-08-10 07:23:17', '1', '1471411269.jpg'),
(5, 'Capabilities/Strengths', 'capabilities_strengths', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-08-10 12:23:12', '1', '1471411194.jpg'),
(6, 'Success Stories', 'success_stories', '<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Delivery Method </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;">Design </span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Objective </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;">Construct a new dedicated manufacturing facility for the production of OSD and Parenteral cytotoxic pharmaceutical products.</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;">&nbsp;&nbsp;&nbsp; Total Site: 58,520sqmt</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;">&nbsp;&nbsp;&nbsp; Cyto Block: 2,850spmt </span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;">&nbsp;&nbsp;&nbsp; Anti-hormonal Block: 1,500sqmt</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;">&nbsp;&nbsp;&nbsp; Utility Block: 858sqmt</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Capabilities</strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">The new cGMP facility included two dedicated areas, one for oral dosage and the other for parenteral products for international market distribution. Solid dosage capabilities included wet and dry granulation through compression, coating, and final packaging. Parenteral operations supported formulation and primary/secondary packaging. Various isolation technologies were assigned to provide for primary containment and facility elements provided transition area supporting secondary containment and cGMP zoning (FDA , EMEA, MHRA, WHO). Produced materials will be used for submission and commercial use with batch sizes ranging from 0.75kg to 60kg.</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Size</strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">35,000 Square Feet </span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Cost </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">$30 Million </span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Completion Date </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">2 th Quarter 2006 </span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Services </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Services provided included:</span></p>\r\n<ul>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Potent Compound &amp; cGMP Risk Assessment </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Design Philosophy </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Process Equipment URS &amp; Specifications </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Conceptual Design </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Detailed Design </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Construction Administration </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Validation Master Plan </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Compound Evaluation/Categorization (OEL)</span></p>\r\n</li>\r\n</ul>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>IPS Value Added </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">IPS developed a risk-based approach to design the facility to include for the protection of both product and personnel.</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Objective </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">To provide a conceptual design package for a Greenfield, large volume sterile filling facility with future expansions in consideration. Also, provide all supporting functions such as Utility Block, GMP Warehouse, Administration Building, QA/QC areas, etc. </span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">The production building (utilizing RABS for the fill finish equipment) overall concept design for Architectural alone was from IPS US offices. </span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">All other buildings, including the centralized warehouse, utility building, QA/QC labs, microbiology labs, canteen, administration block, roads, transformer yard, ETP, scrap yard, fire system and pipe racks were conceptualized by IPS&rsquo; Hyderabad office. All utility and equipment were also selected by this office along with structural details such ascolumn locations, sizes of the columns, and a stability study. The project was executed and managed from the Hyderabad office.</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Capabilities </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">The conceptual design includes: </span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull; <span style="font-size: small;">Development of a site master plan including, roadways, parking spaces, security checkpoints etc</span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull; <span style="font-size: small;">Design conforming to regulatory requirements of the USFDA, MHRA and TGA</span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull; <span style="font-size: small;">Development of programming for all processing areas</span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull; <span style="font-size: small;">Review Best Available Technologies (BAT&rsquo;s) and process equipment available for the specialized process</span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull; <span style="font-size: small;">Develop optimum solutions for an integrated approach to warehousing, weighing, sampling, in-process staging, and processing areas. </span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull; <span style="font-size: small;">Develop HVAC, Electrical, Process, Architectural and Structural design and philosophies. </span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull;<span style="font-size: small;"> Development of Capital Cost Estimate.</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Size </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">136,000 Square Feet </span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Services </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Services provided include: </span></p>\r\n<ul>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">GMP Risk Assessment </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Capacity Analysis </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Conceptual Design </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Design Philosophy </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Cost Estimate</span></p>\r\n</li>\r\n</ul>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>IPS Value Added </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">IPS had a Subject Matter Expert (SME) involved throughout the project from the USA. A cost-effective design, involving personnel from India office and overview and support from the united states, resulting in a design package conforming to regulatory bodies.</span></p>', '2016-08-26 07:03:58', '1', '1472197478.jpg'),
(7, 'Board of Directors', 'board_of_directors', '<p style="font-weight: normal;" align="justify"><span style="font-size: small;">Bringing years of experience to the table, Our Board, comprised of industry veterans, has successful track records and expertise in numerous technically complex and compliant industries. The IPS International Team creates results-oriented strategies that yield practical, cost-effective business solutions to achieve your project goals and business objectives.</span></p>', '2016-08-26 07:44:20', '1', '1472197460.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE IF NOT EXISTS `career` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `vacancies` int(10) NOT NULL,
  `experiance` varchar(11) NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0=in-active,1=active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `career`
--

INSERT INTO `career` (`id`, `job_title`, `description`, `vacancies`, `experiance`, `status`) VALUES
(6, 'PHP developer', '<div class="job_field_desc" style="text-align: justify;">A team leader is responsible for mentoring his team &amp; take the team &amp; company growth to heights. We are looking for experienced, fun-loving &amp; positive attitude guy. Technical Requirement for this position:</div>\r\n<div class="job_field_desc" style="text-align: justify;">1. Frameworks (Cake PHP, CodeIgnitor, Laravel, Symphony, etc) (Any One)</div>\r\n<div class="job_field_desc" style="text-align: justify;">2. Open Sources (Drupal, Joomla, Wordpress, Open-cart, etc) (Any One)</div>\r\n<div class="job_field_desc" style="text-align: justify;">3. Team Handling - Handling team of developer.</div>\r\n<div class="job_field_desc" style="text-align: justify;">4. UI knowledge - Should have great eye for look n feel.</div>\r\n<div class="job_field_desc" style="text-align: justify;">5. Management Skills - Can manage team, work, client, deadlines, etc</div>', 5, '2-3', '1'),
(7, 'SEO Executive', '<p style="text-align: justify;">The SEO/SMO Manager is responsible for planing &amp; implementing SEO/SMO strategies to increase visibility, traffic, ranking &amp; keyword positions for client business. Candidate should be goal oriented. Responsibility Define requirements Make strategy Plan tasks Management &amp; execution of SEO/SMO Prepare report Adevertisement ideas, implementation, costing etc. Keyword Research SEO Analysis Content Management Google Analytics management Google webmaster management PPC understanding &amp; Management Keep pace with SEO, search engine, social media and internet marketing industry trends and development Position requirement 2+ years experience in SEM/SMO/SEO</p>', 3, '2-4', '1'),
(8, '8', '<p style="margin: 0px;">IPS is hiring!&nbsp;We are looking for&nbsp;a&nbsp;talented <strong>MEP&nbsp;Construction Project Manager&nbsp;</strong>to join our industry leading&nbsp;Construction Management team&nbsp;in the <strong>Hicksville, Long Island, NY</strong> area.</p>\r\n<p style="margin: 0px;">&nbsp;</p>\r\n<p style="margin: 0px;">The MEP (Mechanical, electrical and plumbing) Construction Project Manager&nbsp;is the leader of their project.&nbsp;As such, the Project Manager seeks financial success, schedule attainment, safety objectives and above all positive client and subcontractor relationships.&nbsp; The Project Manager must demonstrate sound business sense, technical knowledge, strong leadership, organizational ability, time management, communication skill and professional client service technique.&nbsp;</p>\r\n<p style="margin: 0px;">&nbsp;</p>', 2, '5', '1'),
(9, '7', '<p style="margin: 0px;">IPS has an immediate need for a talented <strong>Senior Scheduler </strong>to join our industry leading team.&nbsp;</p>\r\n<p style="margin: 0px;">&nbsp;</p>\r\n<p style="margin: 0px;">The&nbsp;Senior Scheduler&nbsp;will possess skills and expertise in the following areas: Project Scope coordination and analysis; Project Execution Plan preparation, coordination, &amp; monitoring, Project Estimate preparation and coordination, Work package review; Project Schedule development; Critical path analysis; Contractor coordination and management; Project management assistance; Integrated cost and scheduling; Total Project &amp; Annual Budget development; Financial analysis; Cost accounting and forecasting; Variance analysis; Performance reporting; Project change management; Risk &amp; Contingency planning and root cause analysis; direct supervision of internal resources engaged on project work which would include annual performance management in addition to oversight of external resources to execute project work.</p>', 5, '3', '1'),
(10, '7', '<p style="margin: 0px;">IPS is hiring!&nbsp; We are looking for&nbsp;a talented&nbsp;<strong>Civil Engineer</strong> to work with our industry leading Project Controls team&nbsp;at an exciting client&nbsp;located on&nbsp;<strong>Long Island, NY</strong>.&nbsp;</p>\r\n<p style="margin: 0px;">&nbsp;</p>\r\n<p style="margin: 0px;">Job Duties and Responsibilities&nbsp;</p>\r\n<ul>\r\n<li>Prepare &amp; check civil engineering calculations &amp; drawings in accordance with the latest industry codes &amp; standards using computer programs AutoCAD in support of modifications.</li>\r\n<li>Approve vendor drawings &amp; shop drawings.</li>\r\n<li>Evaluate soil boring data and soil reports.</li>\r\n<li>Participate in site investigations, prepare as-built sketches of field conditions for design purposes, witness &amp; perform key inspections during the course of construction &amp; resolve field problems encountered during construction.</li>\r\n<li>Prepare, update &amp; analyze cost estimates &amp; budgets.</li>\r\n<li>Participate in project meetings for the development and subsequent progress of projects with civil engineering requirements.</li>\r\n<li>Prepare project documents, bid packages, contract documents &amp; specifications, evaluate contractor proposals, &amp; participate in pre-bid &amp; pre-award meetings.</li>\r\n<li>Prepare general scope of work documents to obtain outside consultants for engineering assistance. Evaluate and approve consultants&rsquo; final reports, drawings &amp; specifications.</li>\r\n</ul>', 5, '5', '1');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `address` text NOT NULL,
  `locations` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `address`, `locations`) VALUES
(4, '<p><span class="address-title">IPS International Private Ltd.<br /></span> <span class="address">C-1, C Block<br /></span> <span class="address">Community Center<br /></span> <span class="address">Naraina Vihar, New Delhi - 110028<br /></span> <span class="address">New Delhi<br /></span> <span class="address">T: +91 011 2577 7806<br /></span> <span class="address">F: +91 011 2577 9152<br /></span></p>', '<table class="table-responsive" border="0" width="100%">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p><strong>IPS Pennsylvania (Headquarters)</strong><br /> 721 Arbor Way, Suite100<br /> Blue Bell, PA 19422<br /> T: 610.828.4090<br /> F: 610.828.3656<br /> <a href="https://www.google.com/maps/place/IPS-Integrated+Project+Services,+Inc./@40.140072,-75.286436,17z/data=!3m1!4b1!4m2!3m1!1s0x89c6bcf97046a82b:0x69b7376a405c8995?hl=en">Directions</a></p>\r\n<p><strong>IPS Indiana</strong><br /> 320 N. Meridian Street<br /> Suite 212 <br /> Indianapolis, IN 46204<br /> T: 317.247.1200<br /> F: 317.247.0776<br /> <a href="https://www.google.com/maps/place/320+N+Meridian+St+%23212,+Indianapolis,+IN+46204/@39.771881,-86.158416,17z/data=!3m1!4b1!4m2!3m1!1s0x886b50bf19a3d113:0x626e7de6eafcf4c6">Directions</a></p>\r\n<p><strong>IPS New Jersey</strong><br /> 3 Executive Drive, 2nd Fl.<br /> Somerset, NJ 08873<br /> T: 732.748.1990<br /> F: 732.748.1993<br /> <a href="https://www.google.com/maps/place/IPS/@40.541429,-74.524023,17z/data=!3m1!4b1!4m2!3m1!1s0x89c3c0bd16bb17bf:0xe4d212660b7a8850">Directions</a></p>\r\n<p><strong>IPS Massachusetts</strong><br /> 2 Heritage Drive, 4th Floor<br /> Quincy, MA 02171<br /> T: 603.570.3650<br /> F: 781.848.5508<br /> <a href="https://www.google.com/maps/place/2+Heritage+Dr,+Quincy,+MA+02171/@42.2777379,-71.0344795,17z/data=!3m1!4b1!4m2!3m1!1s0x89e37b6369294717:0xf960c12257005a8e">Directions</a></p>\r\n<p><strong>IPS-Integrated Project Services Limited</strong><br /> 3120 Park Square, Birmingham Business Park<br /> Solihull Parkway <br /> Birmingham, B37 7YN United Kingdom<br /> T: +44 (0) 121 289 3471<br /> <a href="https://goo.gl/maps/DZsCnVmjqGt">Directions</a></p>\r\n<p><strong>IPS-Integrated Project Services Pte. Ltd.</strong><br /> 3A International Business Park<br /> #01-12 ICON@IBP<br /> Singapore 609434<br /> T: +65 6662 9370<br /> F: +65 6570 9221<br /> <a href="https://www.google.com/maps/place/3A+International+Business+Park,+Singapore+609935/@1.3276015,103.748579,382m/data=!3m2!1e3!4b1!4m5!3m4!1s0x31da100a87f29a03:0x982ad0fb8ab21e20!8m2!3d1.3275999!4d103.749234">Directions</a></p>\r\n<p><strong>IPS Biopharmaceutical Technical Consulting Limited Liability Company</strong><br /> Unit 7D, No. 728, Hua Min Han Zun Guo Ji<br /> West Yan&rsquo;an Road, Changning District<br /> Shanghai, P. R. China (200050)<br /> T: +86 21 64821336<br /> <a href="https://goo.gl/maps/pZKuw6ZRKtQ2">Directions</a></p>\r\n<p><strong>IPS-Mehtalia Pvt. Ltd.</strong><br /> Unit B 101-109, 1st Floor<br /> Kailash Vaibhav Industrial Complex, Park Site<br /> Vikhroli West, Mumbai - 400079<br /> Mumbai<br /> T: +91 022 6720 9717<br /> F: +91 022 2414 5185<br /> <a href="https://www.google.com/maps/place/Kailash+Vaibhav+Complex/@19.121535,72.9207978,15z/data=!4m5!1m2!2m1!1sKailash+Vaibhav+Industrial+Complex,+Park+Site+Vikhroli+West,+Mumbai+-+400079+Maharashtra,+India!3m1!1s0x3be7c78cf5374443:0x90fb0881c8852a1c">Directions</a></p>\r\n<p><strong>IPS International Private Ltd.</strong><br /> 1st Floor, Unit No. 5, 6, 7, &amp; 8, Door No. 7-1-58<br /> Amrutha Business Complex, Opp. Lal Banglow<br /> Ameerpet, Hyderabad - 500016<br /> Hyderabad<br /> T: +91 040-6522 4456<br /> F: +91 040 6555 6673<br /> <a href="https://www.google.com/maps/place/Amrutha+Business+Complex,+Ameerpet+Rd,+Divyashakti+Appartments,+Ameerpet,+Hyderabad,+Telangana+500016,+India/@17.4346478,78.4522808,18z/data=!4m5!1m2!2m1!1s1st+Floor,+Amrutha+Business+Complex,+Opp.+Lal+Banglow,+Ameerpet,+Hyderabad+-+500016+Andhra+Pradesh,+India!3m1!1s0x3bcb90c83adad4c1:0x80973c3a608361c1">Directions</a></p>\r\n</td>\r\n<td>&nbsp;</td>\r\n<td valign="top">\r\n<p><strong>IPS California</strong><br /> 2860 Michelle Drive, Suite 200<br /> Irvine, CA 92606<br /> T: 949.679.4682<br /> F: 949.679.4683<br /> <a href="https://goo.gl/maps/V9qzjSjQtMv">Directions</a></p>\r\n<p><strong>IPS Kansas</strong><br /> 6201 College Blvd.<br /> Suite 175<br /> Overland Park, KS 66211<br /> T: 913.345.9084<br /> <a href="https://www.google.com/maps/place/First+National+Bank+Bldg,+6201+College+Blvd,+Overland+Park,+KS+66211/@38.9266637,-94.6563558,17z/data=!3m1!4b1!4m2!3m1!1s0x87c0ea300e747ba3:0x27c324ef90ba08d6">Directions</a></p>\r\n<p><strong>IPS North Carolina</strong><br /> 2803 Slater Road<br /> Suite 105<br /> Morrisville, NC 27560<br /> T: 919.460.6636<br /> F: 919.460.6648<br /> <a href="https://www.google.com/maps/place/2803+Slater+Rd+%23130,+Morrisville,+NC+27560/@35.8630913,-78.8245693,17z/data=!3m1!4b1!4m2!3m1!1s0x89acf1ce50e6a9b7:0x12c68cdff6e2b2f7">Directions</a></p>\r\n<p><strong>IPS-Integrated Project Services, ULC</strong><br /> 20 Adelaide St E<br /> Suite 202<br /> Toronto, ON M5C 2T6 Canada<br /> <a href="https://www.google.com/maps/place/20+Adelaide+St+E+%23202,+Toronto,+ON+M5C+2T6,+Canada/@43.6508605,-79.3798293,17z/data=!3m1!4b1!4m5!3m4!1s0x89d4cb32ffae904b:0xc6dd149c87a8cfba!8m2!3d43.6508605!4d-79.3776406">Directions</a></p>\r\n<p><strong>IPS-Servi&ccedil;os de Projetos Integrados Ltda.</strong><br /> Rua Cincinato Braga<br /> 340 - 15&ordm; andar - conj. 151<br /> S&atilde;o Paulo - SP, 01333-010, Brazil<br /> T: +55 (11) 2361-3703/3263-0885<br /> F: + 55 (11) 2361-3704<br /> <a href="http://maps.google.com/maps?hl=en&amp;tab=wl">Directions</a></p>\r\n<p><strong>IPS-Integrated Project Services GmbH</strong><br /> Elisabethenstrasse 28<br /> 4051 Basel<br /> Switzerland<br /> <a href="https://goo.gl/maps/cUE1z7xBDju">Directions</a></p>\r\n<p><strong>IPS-Mehtalia Pvt. Ltd.</strong><br /> 303, 3rd Floor, 637 Building<br /> Opp. Sears Tower, Gulbai Tekra Road<br /> Panchvati, Ahmedabad - 380015, Gujarat, India<br /> Ahmedabad<br /> T: +91 079 2640 1711 / 079 2640 1721<br /> F: +91 079 2640 1731<br /> <a href="https://www.google.com/maps/place/637,+Panchvati+Lane+-+2,+Panchavati+Society,+Gulbai+Tekra,+Ahmedabad,+Gujarat+380009,+India/@23.0248669,72.5538573,19.75z/data=!4m2!3m1!1s0x395e84e5728a2a4b:0xc7737beb1a3d23c4">Directions</a></p>\r\n<p><strong>IPS International Private Ltd.</strong><br /> C-1, C Block<br /> Community Center<br /> Naraina Vihar, New Delhi - 110028<br /> New Delhi<br /> T: +91 011 2577 7806 <br /> F: +91 011 2577 9152<br /> <a href="https://www.google.com/maps/place/C-1,+Community+Centre,+C-Block+Community+Center,+Block+C,+Naraina+Vihar,+Naraina,+New+Delhi,+Delhi+110028,+India/@28.6260639,77.1433815,17z/data=!3m1!4b1!4m2!3m1!1s0x390d0328c8eb3fb5:0x11409756ff933b0f?hl=en">Directions</a></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>');

-- --------------------------------------------------------

--
-- Table structure for table `expertise`
--

CREATE TABLE IF NOT EXISTS `expertise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  `page_url` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL COMMENT '0=inactive;1=active;',
  `filename` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `expertise`
--

INSERT INTO `expertise` (`id`, `page_name`, `page_url`, `content`, `timestamp`, `status`, `filename`) VALUES
(8, 'API/Small Molecule Manufacturing', 'api_small_molecule_manufacturing', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-08-23 09:34:11', '1', '1471331558.jpg'),
(11, 'Oral Solid Dosage', 'oral_solid_dosage', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-08-23 12:54:46', '1', '1471865544.jpg'),
(12, 'Biotechnology  Vaccines', 'biotechnology__vaccines', '<p><strong>Taking Technology to Production</strong><br />With biomanufacturing technical expertise spanning R&amp;D to pilot-scale and large-scale production, our team knows the technology, trends and regulatory environment to successfully deliver any sized project. Our unique approach and technical expertise enables us to significantly improve operational capabilities, throughput and process control, optimize cost and minimize risk.<br /><br /><strong>Bioprocess Expertise</strong></p>\r\n<ul>\r\n<li>Cell Culture Process</li>\r\n<li>Flu Egg Vaccine Production</li>\r\n<li>Traditional / SU Technologies in Cell Culture</li>\r\n<li>Process Capacity Modeling / Simulation</li>\r\n<li>BL2+ / BL3 Facility Design</li>\r\n<li>Total Cost of Ownership Comparison</li>\r\n<li>Project Experience</li>\r\n</ul>\r\n<p><strong>BL2+/BL3 Facility Design</strong></p>\r\n<p>Since 1992, we have successfully completed vaccine and research facilities design for a variety of viruses, including:</p>\r\n<ul>\r\n<li>anthracis bacillus</li>\r\n<li>pneumonia / meningitus</li>\r\n<li>meningococcal A / C / Y / W</li>\r\n<li>varicella</li>\r\n<li>MMR</li>\r\n<li>papillomavirus</li>\r\n<li>staphylococcus aureus</li>\r\n<li>staphylococcus polysaccharide conjugate</li>\r\n<li>Influenza H5N1</li>\r\n<li>HIV</li>\r\n<li>small pox</li>\r\n</ul>\r\n<p><strong>IPS Biotech Experience</strong></p>\r\n<ul>\r\n<li>Biologics Manufacturing</li>\r\n<li>Large Scale (&gt;3,000L)</li>\r\n<li>Multi-product, Multi-use</li>\r\n<li>Biocontainment</li>\r\n<li>Process Scale-up</li>\r\n<li>Technology Transfer</li>\r\n<li>Greenfield / Renovations</li>\r\n<li>Single-Use Process</li>\r\n<li>Modular Design</li>\r\n<li>Conceptual Design</li>\r\n<li>Cell Culture Monoclonal Antibodies</li>\r\n<li>Microbial Fermentation</li>\r\n<li>Blood Products</li>\r\n<li>Process Utilities</li>\r\n<li>Vaccines</li>\r\n<li>Process Modeling</li>\r\n<li>FDA GMPs</li>\r\n<li>International / ICH GMPs</li>\r\n<li>Biosimilars</li>\r\n<li>Process Validation</li>\r\n</ul>\r\n<p>Our team is comprised of dedicated industry experts with operating company experience.<br /><br />&nbsp;&nbsp;&nbsp; <span style="text-decoration: underline;"><strong>Tom Piombino, PE</strong></span> has focused primarily on biologics and vaccine facilities, including advanced facility design and technologies for bioprocessing. Tom leads the IPS bioprocess leadership team and interfaces with clients as a SME, assisting with the integration of bioprocessing equipment, cGMP''s and advanced facility design initiatives. <br />&nbsp;&nbsp;&nbsp; <span style="text-decoration: underline;"><strong>Tim Schuster</strong></span> is a well-known expert in the biotechnology industry and offers extensive experience in bioprocess engineering, project management and facility and critical utilities systems worldwide.<br />&nbsp;&nbsp;&nbsp; <span style="text-decoration: underline;"><strong>Dave Wareheim</strong></span>, a published author and presenter on cell culture and SU systems, is a driving force toward SU systems in the industry.&nbsp; He led the effort for streamlining downstream processing and, as co-inventor, was instrumental in a patent submission and design/build of the first ever system. <br /><br /><strong>Expert Insight</strong><br /><br /><strong>Multimedia</strong><br />&nbsp;&nbsp;&nbsp; "IPS Brings Their Full Range of Services to INTERPHEX 2016", INTERPHEX Events, April 2016<br />&nbsp;&nbsp;&nbsp; "INTERPHEX on Location 2015", INTERPHEX Events, April 2015<br />&nbsp;&nbsp;&nbsp; "On the Floor at INTERPHEX 2013: The Biomanufacturing Tour",&nbsp; PHARMAevolution, May, 2013<br />&nbsp;&nbsp;&nbsp; "Biomanufacturing, The 4th Decade: The Sky''s the Limit", Pharmaceutical Processing, Nov/Dec 2012, Vol. 27, No. 19<br /><br /><strong>&nbsp;Publications</strong><br />&nbsp;&nbsp;&nbsp; "Biomanufacturing Trends &amp; Technologies", INTERPHEX Blog, February 2014<br />&nbsp;&nbsp;&nbsp; "Risk Assessment for Single-Use Disposable Projects", Contract Pharma, January/February 2014<br />&nbsp;&nbsp;&nbsp; "Facility of the Future: Next Generation Manufacturing Forum: Part 3": &ldquo;Identifying Facility Requirements Based on Specific Business Drivers and Uncertainties Using the Enabling Technologies&rdquo;, Pharmaceutical Engineering, May/June 2013, Vol. 33, No. 3<br />&nbsp;&nbsp;&nbsp; "Biomanufacturing, The 4th Decade: The Sky''s the Limit", Pharmaceutical Processing,April 2013<br />&nbsp;&nbsp;&nbsp; &ldquo;Facility of the Future: Next Generation Manufacturing Forum: Part 2: &ldquo;Tools for Change-Enabling Technologies and Business and Regulatory Approaches&rdquo;, Pharmaceutical Engineering, March/April 2013, Vol. 33 No. 2<br />&nbsp;&nbsp;&nbsp; &ldquo;Facility of the Future: Next Generation Manufacturing Forum: Part 1: &ldquo;Why We Cannot Stay Here&rdquo; &ndash; The Challenges, Risks, and Business Drivers for Changing the Paradigm," Pharmaceutical Engineering, January/February 2013, Vol. 33 No. 1<br />&nbsp;&nbsp;&nbsp; "Biopharmaceutical Manufacturing in the Twenty-First Century - the Next Generation Manufacturing Facility", Pharmaceutical Engineering, March/April 2012, Vol. 32 No. 2<br />&nbsp;&nbsp;&nbsp; "NextGen Biomanufacturing: Developing the Manufacturing Facility of the Future", Pharmaceutical Processing, March 2012<br />&nbsp;&nbsp;&nbsp; Single-Use (SU) Systems. Encyclopedia of Industrial Biotechnology (Wiley &amp; Sons, Ltd.), April 2010</p>', '2016-08-24 12:31:35', '1', '1471865583.jpg'),
(13, 'Advanced Aseptic Processing', 'advanced_aseptic_processing', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-08-22 11:34:12', '1', '1471865652.jpg'),
(14, 'Potent compounds and Containment', 'potent_compounds_and_containment', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-08-22 11:34:56', '1', '1471865696.jpg'),
(15, 'Biopharmaceuticals', 'biopharmaceuticals', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-08-23 09:30:08', '1', '1471865842.png'),
(16, 'Vaccine manufacturing processes', 'vaccine_manufacturing_processes', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-08-23 09:29:56', '1', '1471865875.jpg'),
(17, 'Parenteral drug', 'parenteral_drug', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-08-23 12:54:32', '1', '1471865913.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `home_content`
--

CREATE TABLE IF NOT EXISTS `home_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_image` varchar(100) NOT NULL,
  `s_image` varchar(100) NOT NULL,
  `r_b_content` text NOT NULL,
  `body_content` text NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0=in-active,1=active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `home_content`
--

INSERT INTO `home_content` (`id`, `f_image`, `s_image`, `r_b_content`, `body_content`, `status`) VALUES
(1, '1471147541.jpg', '1471147542.jpg', '<p id="news" style="font-size: 16px; padding: 1px; line-height: 23px; font-family: Helvetica; text-align: justify;">IPS International is a leading provider of Technical Consulting, Design, Engineering, Construction, Project Controls, Commissioning and Qualification services for technically complex Biotech, API and pharmaceutical facilities worldwide.</p>', '<p style="color: #ed2930; text-align: center; font-family: Calligraffitti;"><strong> <span style="font-size: 35px; text-align: center;">WHY WORK WITH US</span> </strong></p>\r\n<ul class="ul_home" style="line-height: 29px; font-weight: 600; font-size: 16px; font-family: ColaborateLight;">\r\n<li>Focusing on key technologies, we offer cost effective business solutions to successfully deliver your technically complex facility on-time and on budget.</li>\r\n<li>We understand the regulatory environment requirements in India and around the world.</li>\r\n<li>We are knowledgeable about the availability of material and equipment in India which enables us to specify and procure locally available systems while maintaining compliance with International Standards.</li>\r\n<li>We effectively utilize our worldwide relationships and partnerships to derive maximum benefit for our clients.</li>\r\n</ul>', '1');

-- --------------------------------------------------------

--
-- Table structure for table `job_post`
--

CREATE TABLE IF NOT EXISTS `job_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` int(15) NOT NULL,
  `gender` int(11) NOT NULL COMMENT '''1'' for male and ''0'' for female',
  `education` varchar(255) NOT NULL,
  `post_applied` varchar(255) NOT NULL,
  `tech_skills` varchar(255) NOT NULL,
  `rev_exp` varchar(255) NOT NULL,
  `curt_ctc` varchar(255) NOT NULL,
  `expt_ctc` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `job_post`
--

INSERT INTO `job_post` (`id`, `name`, `email`, `contact`, `gender`, `education`, `post_applied`, `tech_skills`, `rev_exp`, `curt_ctc`, `expt_ctc`, `resume`) VALUES
(12, 'testing expertise', 'ajeet@ucodice.com', 2147483647, 1, '', 'Test-1', '', 'rrrr444444', '555gggggg', 'ygyfgfhgfh6767676767', '_99782_2016_12_08_1470999710.txt'),
(13, 'test', 'test@ucodice.com', 1234567890, 0, 'PG', 'Test-1', 'php', '12', '1234567890', '123456789023456', '_62408_2016_12_08_1471001034.docx'),
(14, 'Remo', 'test@ucodice.com', 234734334, 1, '', 'PHP developer', '', '2 years', '123', '123', '_67179_2016_17_08_1471437638.pdf'),
(15, 'Remo', 'test@uco.com', 234734334, 1, '', 'PHP developer', '', '2 years', '123', '123', '_39688_2016_17_08_1471438236.docx'),
(16, 'test', 'test@ucodice.com', 2147483647, 0, 'PG', 'PHP developer', 'php', '2', '1234567890', '1234567890', '_31583_2016_19_08_1471580443.docx'),
(17, 'dsds', 'test@uco.com', 34343, 1, '', 'PHP developer', '', '2', '2', '2', '_95158_2016_19_08_1471587916.pdf'),
(18, 'test', 'test@ucodice.com', 434343, 1, '', 'PHP developer', '', '2 years', '10,000', '15,000', '_45206_2016_19_08_1471607603.docx'),
(19, 'pooja', 'pooja@ucodice.com', 2147483647, 0, 'PG', 'PHP developer', 'php', '1', '1234567890', '1234567890', '_58645_2016_23_08_1471936440.docx'),
(20, 'sdfghj', 'pooja@ucodice.com', 1234567890, 0, 'PG', 'PHP developer', 'php', 'azsxdfvg', '1234567890', '1234567890', '_16603_2016_23_08_1471936604.docx'),
(21, 'pooja', 'pooja@ucodice.com', 987654321, 0, 'PG', 'PHP developer', 'php', 'azsxdfvg', '1234567890', '1234567890', '_66952_2016_23_08_1471950134.docx'),
(22, 'dummy', 'test@ucodice.com', 4342342, 0, '', 'PHP developer', '', '2 years', '10000', '15000', '_89546_2016_23_08_1471955762.pdf'),
(23, 'Renu sharma', 'test@ucodice.com', 4342342, 0, '', 'PHP developer', '', '2 years', '10000', '15000', '_33984_2016_23_08_1471956056.docx'),
(24, 'rihan', 'test@ucodice.com', 4534535, 1, '', 'PHP developer', '', '3 years', '2000', '15000', '_39693_2016_23_08_1471957602.pdf'),
(25, 'Vansh', 'test@ucodice.com', 22233000, 0, '', 'PHP developer', '', '1 year', '5000', '10000', '_4949_2016_24_08_1472013211.pdf'),
(26, 'Pooja', 'pooja@ucodice.com', 2147483647, 0, 'PG', 'PHP developer', 'php', '2', '1234567890', '1234567890', '_78319_2016_24_08_1472014968.docx'),
(27, 'test', 'test@ucodice.com', 987654321, 1, 'PG', 'PHP developer', 'php', '2', '1234567890', '1234567890', '_66749_2016_24_08_1472015265.docx'),
(28, 'test', 'test@ucodice.com', 98765432, 0, 'PG', 'PHP developer', 'php', '2', '1234567890', '1234567890', '_6270_2016_24_08_1472029042.docx'),
(29, 'Remo', 'test@ucodice.com', 323213123, 0, '', 'PHP developer', '', '2 years', '6000', '10000', '_60945_2016_24_08_1472030260.pdf'),
(30, 'Sheenu', 'test@ucodice.com', 545353, 1, '', 'PHP developer', '', '1 year', '5000', '8000', '_20566_2016_24_08_1472030944.pdf'),
(31, 'pooja', 'pooja@ucodice.com', 987654321, 0, 'PG', 'PHP developer', 'php', '2', '1234567890', '1234567890', '_98698_2016_24_08_1472035668.docx'),
(32, 'RInky', 'test@ucodice.com', 43434, 0, '', 'PHP developer', '', '4 years', '20000', '40000', '_69190_2016_24_08_1472037068.pdf'),
(33, 'Vishu', 'test@ucodice.com', 45353453, 1, '', 'PHP developer', '', '4 years', '20000', '40000', '_56028_2016_24_08_1472039210.docx'),
(34, 'Philosophy', 'Komal@ucodice.com', 3232323, 1, 'd', 'PHP developer', '2', '11', '1221', '1212', '_78623_2016_26_08_1472189235.pdf'),
(35, 'rihan', 'test@uco.com', 345345, 1, '', 'SEO Executive', '', '2 years', '6000', '10000', '_39737_2016_26_08_1472206690.pdf'),
(36, 'pooja', 'pooja@ucodice.com', 987654321, 0, 'PG', 'PHP developer', 'php', '2', '1234567890', '1234567890', '_44329_2016_30_08_1472531509.txt'),
(37, '<script>alert</script>', 'ram@uco.com', 2147483647, 0, '<script>alert</script>', 'PHP developer', '<script>alert</script>', '<script>alert</script>', '<script>alert</script>', '<script>alert</script>', '_90897_2016_31_08_1472629297.docx'),
(38, 'pooja', 'pooja@ucodice.com', 987654321, 0, 'PG', 'PHP developer', 'php', '2', '1234567890', '1234567890', '_60926_2016_02_09_1472810311.docx'),
(39, 'pooja', 'pooja@ucodice.com', 2147483647, 0, 'PG', 'PHP developer', 'php', '2', '1234567890', '1234567890', '_56518_2016_02_09_1472810511.docx'),
(40, 'pooja', 'pooja@ucodice.com', 2147483647, 0, 'PG', 'PHP developer', 'php', '2', '1234567890', '1234567890', '_18276_2016_02_09_1472810834.docx'),
(41, 'nitin', 'Newuser@ucodice.com', 2147483647, 1, '', 'PHP developer', '', '3 years', '15000', '20000', '_52408_2016_05_09_1473060120.pdf'),
(42, 'newman', 'neelam@ucodice.com', 2147483647, 1, '10', 'Project Controls', 'fd', '3', '23232', '2332', '_37886_2016_06_09_1473161106.docx'),
(43, 'fd', 'dsf@g.bf', 2147483647, 1, '312', 'Project Controls', '21aaeweq', '2', '2213', '231', '_53682_2016_06_09_1473161311.docx'),
(44, 'ucodice', 'test@ucodice.com', 454543534, 0, '', 'Project Controls', '', '2 years', '7000', '15000', '_87027_2016_06_09_1473161400.pdf'),
(45, 'ucodice', 'test@ucodice.com', 454353453, 1, '', 'Project Controls', '', '2 years', '7000', '15000', '_97205_2016_06_09_1473161549.docx'),
(46, 'ucodice', 'test@ucodice.com', 34234234, 1, '', 'Project Controls', '', '2 years', '7000', '15000', '_62070_2016_06_09_1473164275.docx'),
(47, 'pooja', 'pooja@ucodice.com', 987654321, 0, 'PG', 'Project Manager', 'php', '2', '1234567890', '1234567890', '_72952_2016_06_09_1473167482.pdf'),
(48, 'pooja', 'pooja@ucodice.com', 2147483647, 0, 'PG', 'Project Manager', 'php', '2', '1234567890', '1234567890', '_74059_2016_06_09_1473167993.pdf'),
(49, 'Komal', 'komal@ucodice.com', 2147483647, 0, 'b.tech', 'Project Manager', 'kjskaj', '8', '7000', '15000', '_34522_2016_12_09_1473683136.docx'),
(50, 'Komal', 'komal@ucodice.com', 2147483647, 1, 'b.tech', 'Project Controls', 'kjskaj', '8', '7000', '15000', '_39914_2016_12_09_1473683192.doc'),
(51, 'ucodice', 'test@ucodice.com', 34534535, 1, '', 'Project Controls', '', '2 years', '8000', '15000', '_22176_2016_12_09_1473685110.pdf'),
(52, 'pooja', 'pooja@ucodice.com', 98765432, 0, 'PG', '8', 'php', '2', '1234567890', '1234567890', '_61594_2016_12_09_1473685320.docx'),
(53, 'pooja', 'pooja@ucodice.com', 2147483647, 0, 'PG', '8', 'php', '2', '1234567890', '1234567890', '_38117_2016_12_09_1473686199.docx'),
(54, 'ucodice', 'test@ucodice.com', 433334343, 1, '', '7', '', '2 years', '8000', '10000', '_15897_2016_13_09_1473739850.docx'),
(55, 'pooja', 'pooja@ucodice.com', 2147483647, 0, '', '7', '', '2', '1234567890', '1234567890', '_13924_2016_13_09_1473748620.docx'),
(56, 'pooja', 'pooja@ucodice.com', 987654321, 0, 'PG', 'Project Manager', 'php', '2', '1234567890', '1234567890', '_29004_2016_13_09_1473752589.pdf'),
(57, 'ucodice', 'test@ucodice.com', 85675476, 1, '', 'Project Controls', '', '2 years', '5000', '8000', '_3669_2016_13_09_1473760759.pdf'),
(58, 'ucodice1', 'test@ucodice.com', 85675476, 1, '', 'Project Controls', '', '2 years', '5000', '8000', '_17274_2016_13_09_1473760796.docx'),
(59, 'pooja', 'pooja@ucodice.com', 987654321, 0, 'PG', 'Project Controls', 'php', '2', '1234567890', '1234567890', '_14342_2016_13_09_1473761140.pdf'),
(60, 'pooja', 'pooja@ucodice.com', 987654321, 0, 'PG', 'Project Manager', 'php', '2', '1234567890', '1234567890', '_15556_2016_13_09_1473761166.pdf'),
(61, 'pooja', 'pooja@ucodice.com', 2147483647, 0, 'PG', '8', 'php', '2', '1234567890', '1234567890', '_80018_2016_13_09_1473761372.pdf'),
(62, 'ucodice', 'test@ucodice.com', 2147483647, 1, '', '7', '', '2 years', '5000', '10000', '_84911_2016_13_09_1473765589.pdf'),
(63, 'ucodice', 'test@ucodice.com', 2147483647, 1, '', '7', '', '2 years', '5000', '10000', '_55139_2016_13_09_1473765665.docx'),
(64, 'Komal', 'Komal@ucodice.com', 2147483647, 0, 'b.tech', '7', 'kjskaj', '8', '7000', '15000', '_48073_2016_14_09_1473829570.docx'),
(65, 'ucodice', 'test@ucodice.com', 2147483647, 1, '', '7', '', '3423423424', '54354545', '12', '_71713_2016_14_09_1473829721.docx'),
(66, 'Komal', 'Komal@ucodice.com', 2147483647, 0, 'b.tech', '7', 'kjskaj', '8', '7000', '15000', '_14943_2016_14_09_1473829844.docx');

-- --------------------------------------------------------

--
-- Table structure for table `job_title`
--

CREATE TABLE IF NOT EXISTS `job_title` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `designation` varchar(50) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `job_title`
--

INSERT INTO `job_title` (`id`, `designation`, `status`) VALUES
(7, 'Project Control', 1),
(8, 'Project Manager', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logo`
--

CREATE TABLE IF NOT EXISTS `logo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(100) NOT NULL,
  `tittle` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0=inactive,1=active',
  `link` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `logo`
--

INSERT INTO `logo` (`id`, `image_name`, `tittle`, `status`, `link`) VALUES
(1, '1471005494.jpg', 'logo', '1', '#'),
(2, '1471005650.png', 'logo', '1', 'http://ucodice.com'),
(3, '1471005686.jpg', 'logo', '1', 'http://ipsdb.com/'),
(4, '1471005697.jpg', 'logo', '1', 'http://ipsdb.com/'),
(5, '1471005718.jpg', 'logo', '1', 'http://ipsdb.com/'),
(6, '1471005735.png', 'logo', '1', 'http://ipsdb.com/'),
(7, '1471005751.jpg', 'logo', '1', 'http://ipsdb.com/'),
(8, '1471005769.jpg', 'logo', '1', 'http://ipsdb.com/'),
(9, '1471005789.jpg', 'logo', '1', 'http://ipsdb.com/'),
(10, '1471005819.jpg', 'logo', '1', 'http://ipsdb.com/'),
(11, '1471005834.jpg', 'logo', '1', 'http://ipsdb.com/');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` text NOT NULL,
  `filename` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0=in-active,1=active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `date`, `title`, `filename`, `status`) VALUES
(5, '2016-08-16', 'Dummy Data', '_36920_2016_23_08_1471937534.pdf', '1'),
(7, '2015-11-02', 'Dummy', '_69871_2016_23_08_1471936703.pdf', '1'),
(8, '2015-06-09', 'ips', '_51767_2016_23_08_1471936326.pdf', '1'),
(9, '2017-05-12', 'test', '_33557_2016_23_08_1471936485.pdf', '1'),
(10, '2016-09-01', 'Title', '_56693_2016_13_09_1473763169.pdf', '1'),
(14, '2016-09-23', 'test new', '_13172_2016_14_09_1473830490.pdf', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  `page_url` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL COMMENT '0=in-active,1=active',
  `filename` varchar(200) NOT NULL,
  `pdf` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_name` (`page_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `page_name`, `page_url`, `content`, `timestamp`, `status`, `filename`, `pdf`) VALUES
(30, 'Construction Management', 'construction_management', '<ul style="font-size: 15px; list-style-type: disc;">\r\n<li>Constructability Reviews</li>\r\n<li>Construction Management</li>\r\n<li>Cost Management</li>\r\n<li>Design Reviews</li>\r\n<li>Estimating</li>\r\n<li>Field Inspection/Execution</li>\r\n<li>Logistics Planning</li>\r\n<li>Process Equipment Installation</li>\r\n<li>Procurement Strategy</li>\r\n<li>Project Controls</li>\r\n<li>Project Management</li>\r\n<li>Risk Analysis</li>\r\n<li>Safety</li>\r\n<li>Schedule Management</li>\r\n</ul>', '2016-09-08 04:37:34', '1', '1473309454.jpg', NULL),
(31, 'Design/Engineering', 'design_engineering', '<ul style="list-style-type: disc;">\r\n<li>Concept Engineering</li>\r\n<li>Value Engineering</li>\r\n<li>Target Costing</li>\r\n<li>Size, Spec &amp; Procurement of L.L. Equipment</li>\r\n<li>Detailed Engineering</li>\r\n<ul style="list-style-type: square;">\r\n<li>Architectural</li>\r\n<li>Process</li>\r\n<li>Automation</li>\r\n<li><u>Mechanical</u></li>\r\n<li>Piping / FP</li>\r\n<li>Electrical</li>\r\n</ul>\r\n<li>Construction Admin</li>\r\n</ul>', '2016-09-08 04:38:06', '1', '1473309486.jpg', NULL),
(32, 'Board of Directors', 'board_of_directors', '<p style="font-weight: normal;" align="justify"><span style="font-size: small;">Bringing years of experience to the table, Our Board, comprised of industry veterans, has successful track records and expertise in numerous technically complex and compliant industries. The IPS International Team creates results-oriented strategies that yield practical, cost-effective business solutions to achieve your project goals and business objectives.</span></p>', '2016-09-08 04:38:55', '1', '1473309535.jpg', NULL),
(33, 'Success Stories', 'success_stories', '<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Delivery Method </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;">Design </span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Objective </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;">Construct a new dedicated manufacturing facility for the production of OSD and Parenteral cytotoxic pharmaceutical products.</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;">&nbsp;&nbsp;&nbsp; Total Site: 58,520sqmt</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;">&nbsp;&nbsp;&nbsp; Cyto Block: 2,850spmt </span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;">&nbsp;&nbsp;&nbsp; Anti-hormonal Block: 1,500sqmt</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;">&nbsp;&nbsp;&nbsp; Utility Block: 858sqmt</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Capabilities</strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">The new cGMP facility included two dedicated areas, one for oral dosage and the other for parenteral products for international market distribution. Solid dosage capabilities included wet and dry granulation through compression, coating, and final packaging. Parenteral operations supported formulation and primary/secondary packaging. Various isolation technologies were assigned to provide for primary containment and facility elements provided transition area supporting secondary containment and cGMP zoning (FDA , EMEA, MHRA, WHO). Produced materials will be used for submission and commercial use with batch sizes ranging from 0.75kg to 60kg.</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Size</strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">35,000 Square Feet </span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Cost </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">$30 Million </span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Completion Date </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">2 th Quarter 2006 </span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Services </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Services provided included:</span></p>\r\n<ul>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Potent Compound &amp; cGMP Risk Assessment </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Design Philosophy </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Process Equipment URS &amp; Specifications </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Conceptual Design </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Detailed Design </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Construction Administration </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Validation Master Plan </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Compound Evaluation/Categorization (OEL)</span></p>\r\n</li>\r\n</ul>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>IPS Value Added </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">IPS developed a risk-based approach to design the facility to include for the protection of both product and personnel.</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Objective </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">To provide a conceptual design package for a Greenfield, large volume sterile filling facility with future expansions in consideration. Also, provide all supporting functions such as Utility Block, GMP Warehouse, Administration Building, QA/QC areas, etc. </span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">The production building (utilizing RABS for the fill finish equipment) overall concept design for Architectural alone was from IPS US offices. </span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">All other buildings, including the centralized warehouse, utility building, QA/QC labs, microbiology labs, canteen, administration block, roads, transformer yard, ETP, scrap yard, fire system and pipe racks were conceptualized by IPS&rsquo; Hyderabad office. All utility and equipment were also selected by this office along with structural details such ascolumn locations, sizes of the columns, and a stability study. The project was executed and managed from the Hyderabad office.</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Capabilities </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">The conceptual design includes: </span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull; <span style="font-size: small;">Development of a site master plan including, roadways, parking spaces, security checkpoints etc</span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull; <span style="font-size: small;">Design conforming to regulatory requirements of the USFDA, MHRA and TGA</span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull; <span style="font-size: small;">Development of programming for all processing areas</span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull; <span style="font-size: small;">Review Best Available Technologies (BAT&rsquo;s) and process equipment available for the specialized process</span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull; <span style="font-size: small;">Develop optimum solutions for an integrated approach to warehousing, weighing, sampling, in-process staging, and processing areas. </span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull; <span style="font-size: small;">Develop HVAC, Electrical, Process, Architectural and Structural design and philosophies. </span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify">&bull;<span style="font-size: small;"> Development of Capital Cost Estimate.</span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Size </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">136,000 Square Feet </span></p>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>Services </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Services provided include: </span></p>\r\n<ul>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">GMP Risk Assessment </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Capacity Analysis </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Conceptual Design </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Design Philosophy </span></p>\r\n</li>\r\n<li>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">Cost Estimate</span></p>\r\n</li>\r\n</ul>\r\n<p style="margin-bottom: 0.35cm; line-height: 115%;" align="justify"><span style="font-size: small;"><strong>IPS Value Added </strong></span></p>\r\n<p style="margin-bottom: 0.35cm; font-weight: normal; line-height: 115%;" align="justify"><span style="font-size: small;">IPS had a Subject Matter Expert (SME) involved throughout the project from the USA. A cost-effective design, involving personnel from India office and overview and support from the united states, resulting in a design package conforming to regulatory bodies.</span></p>', '2016-09-08 04:39:49', '1', '1473309589.jpg', NULL),
(34, 'Capabilities/Strengths', 'capabilities_strengths', '<ul style="font-size: 15px; list-style-type: disc;">\r\n<li>R&amp;D , PDL, Kilo Lab to high capacity commercial projects</li>\r\n<li>Full service engineering, Procurement, Construction, Support</li>\r\n<li>Subject Matter Experts (SMEs) from the US, Europe and Asia are available to our Clients</li>\r\n<li>Single Window Services Available from Concept to Commissioning</li>\r\n<li>Premier Sterile and Potent Facility Design Expert.</li>\r\n<li>Specialized HVAC Knowledge</li>\r\n<li>Expertise in Commissioning and Qualification Ensuring Compliance, Qualification and Validation</li>\r\n<li>Higher Level Documentation to ensure International Regulatory Compliance</li>\r\n<li>Staff Trained by IPS-USA &amp; Seamless Support from IPS-USA</li>\r\n<li>TEFR/ DPR studies Including Due Diligence</li>\r\n<li>Comprehensive Management Services for Valuation of Assets</li>\r\n</ul>', '2016-09-08 04:44:31', '1', '1473309871.jpg', NULL),
(35, 'Team', 'team', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-09-08 04:45:01', '1', '1473309901.jpg', NULL),
(37, 'Vision/Mission/Values', 'vision_mission_values', '<div>\r\n<div id="contentPrimary">\r\n<h3><span style="color: #b22222;"><strong>Vision</strong></span></h3>\r\n<p style="text-align: justify; padding-left: 33px;">IPS will be the Knowledge Leaders of Choice by delivering Technology-based Business Solutions which help our Clients Succeed. To be the Knowledge Leader, we continue to push ourselves in new and exciting directions. Our Vision, Mission and Values were developed to help guide our actions.</p>\r\n<h3 style="text-align: justify;"><span style="color: #b22222;"><strong>Mission</strong></span></h3>\r\n<ul style="list-style-type: disc;">\r\n<li>Be recognized and sought after as the premier provider of integrated consulting, design, project delivery and related compliance services.</li>\r\n<li>Consistently meet our clients&rsquo; expectations and help them succeed through delivering quality technical services at a fair reward and with a quality experience.</li>\r\n<li>Be an organization of professionalism and purpose, guided by respect for the individual.</li>\r\n</ul>\r\n<h3 style="text-align: justify;"><span style="color: #b22222;"><strong>Values</strong></span></h3>\r\n<ul style="list-style-type: disc;">\r\n<li><strong>Entrepreneurship- </strong>We consistently seek new opportunities in a persistent quest for excellence to deliver value and help our clients succeed. We thrive on challenge.</li>\r\n<li><strong>Passion-</strong>&nbsp; We approach our work enthusiastically with contagious energy and drive. We love what we do.</li>\r\n<li><strong>Creativity / Innovation- </strong>We enjoy creating and continually improving our solutions, tools, methods and entire service delivery system for the benefit of our customers and the world. We are imaginative and visionary.</li>\r\n<li><strong>Integrity / Respect-&nbsp;</strong> We conduct ourselves with uncompromising honesty and true commitment to the welfare of our customers and each other. We are ethical professionals.</li>\r\n<li><strong>Relationships-</strong> We sustain long- term relationships of compelling mutual value through teamwork and committed individuals. We are good partners.</li>\r\n<li><strong>Success / Rewards-</strong> We are driven to succeed and be recognized and rewarded for goal attainment. We are winners. &ldquo;We know a lot, deliver it well, and positively impact our clients&rsquo; bottom line.&rdquo;</li>\r\n</ul>\r\n</div>\r\n</div>', '2016-09-08 04:45:42', '1', '1473309942.jpg', NULL),
(38, 'Parenteral drug', 'parenteral_drug', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-09-08 04:46:13', '1', '1473309973.jpg', NULL),
(39, 'Vaccine manufacturing processes', 'vaccine_manufacturing_processes', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-09-08 04:46:26', '1', '1473309986.jpg', NULL),
(40, 'Biopharmaceuticals', 'biopharmaceuticals', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-09-08 04:46:51', '1', '1473310011.jpg', NULL),
(41, 'Potent compounds and Containment', 'potent_compounds_and_containment', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-09-08 04:47:06', '1', '1473310026.jpg', NULL),
(42, 'Advanced Aseptic Processing', 'advanced_aseptic_processing', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-09-08 04:47:18', '1', '1473310038.jpg', NULL),
(43, 'Biotechnology Vaccines', 'biotechnology_vaccines', '<p><strong>Taking Technology to Production</strong><br />With biomanufacturing technical expertise spanning R&amp;D to pilot-scale and large-scale production, our team knows the technology, trends and regulatory environment to successfully deliver any sized project. Our unique approach and technical expertise enables us to significantly improve operational capabilities, throughput and process control, optimize cost and minimize risk.<br /><br /><strong>Bioprocess Expertise</strong></p>\r\n<ul>\r\n<li>Cell Culture Process</li>\r\n<li>Flu Egg Vaccine Production</li>\r\n<li>Traditional / SU Technologies in Cell Culture</li>\r\n<li>Process Capacity Modeling / Simulation</li>\r\n<li>BL2+ / BL3 Facility Design</li>\r\n<li>Total Cost of Ownership Comparison</li>\r\n<li>Project Experience</li>\r\n</ul>\r\n<p><strong>BL2+/BL3 Facility Design</strong></p>\r\n<p>Since 1992, we have successfully completed vaccine and research facilities design for a variety of viruses, including:</p>\r\n<ul>\r\n<li>anthracis bacillus</li>\r\n<li>pneumonia / meningitus</li>\r\n<li>meningococcal A / C / Y / W</li>\r\n<li>varicella</li>\r\n<li>MMR</li>\r\n<li>papillomavirus</li>\r\n<li>staphylococcus aureus</li>\r\n<li>staphylococcus polysaccharide conjugate</li>\r\n<li>Influenza H5N1</li>\r\n<li>HIV</li>\r\n<li>small pox</li>\r\n</ul>\r\n<p><strong>IPS Biotech Experience</strong></p>\r\n<ul>\r\n<li>Biologics Manufacturing</li>\r\n<li>Large Scale (&gt;3,000L)</li>\r\n<li>Multi-product, Multi-use</li>\r\n<li>Biocontainment</li>\r\n<li>Process Scale-up</li>\r\n<li>Technology Transfer</li>\r\n<li>Greenfield / Renovations</li>\r\n<li>Single-Use Process</li>\r\n<li>Modular Design</li>\r\n<li>Conceptual Design</li>\r\n<li>Cell Culture Monoclonal Antibodies</li>\r\n<li>Microbial Fermentation</li>\r\n<li>Blood Products</li>\r\n<li>Process Utilities</li>\r\n<li>Vaccines</li>\r\n<li>Process Modeling</li>\r\n<li>FDA GMPs</li>\r\n<li>International / ICH GMPs</li>\r\n<li>Biosimilars</li>\r\n<li>Process Validation</li>\r\n</ul>\r\n<p>Our team is comprised of dedicated industry experts with operating company experience.<br /><br />&nbsp;&nbsp;&nbsp; <span style="text-decoration: underline;"><strong>Tom Piombino, PE</strong></span> has focused primarily on biologics and vaccine facilities, including advanced facility design and technologies for bioprocessing. Tom leads the IPS bioprocess leadership team and interfaces with clients as a SME, assisting with the integration of bioprocessing equipment, cGMP''s and advanced facility design initiatives. <br />&nbsp;&nbsp;&nbsp; <span style="text-decoration: underline;"><strong>Tim Schuster</strong></span> is a well-known expert in the biotechnology industry and offers extensive experience in bioprocess engineering, project management and facility and critical utilities systems worldwide.<br />&nbsp;&nbsp;&nbsp; <span style="text-decoration: underline;"><strong>Dave Wareheim</strong></span>, a published author and presenter on cell culture and SU systems, is a driving force toward SU systems in the industry.&nbsp; He led the effort for streamlining downstream processing and, as co-inventor, was instrumental in a patent submission and design/build of the first ever system. <br /><br /><strong>Expert Insight</strong><br /><br /><strong>Multimedia</strong><br />&nbsp;&nbsp;&nbsp; "IPS Brings Their Full Range of Services to INTERPHEX 2016", INTERPHEX Events, April 2016<br />&nbsp;&nbsp;&nbsp; "INTERPHEX on Location 2015", INTERPHEX Events, April 2015<br />&nbsp;&nbsp;&nbsp; "On the Floor at INTERPHEX 2013: The Biomanufacturing Tour",&nbsp; PHARMAevolution, May, 2013<br />&nbsp;&nbsp;&nbsp; "Biomanufacturing, The 4th Decade: The Sky''s the Limit", Pharmaceutical Processing, Nov/Dec 2012, Vol. 27, No. 19<br /><br /><strong>&nbsp;Publications</strong><br />&nbsp;&nbsp;&nbsp; "Biomanufacturing Trends &amp; Technologies", INTERPHEX Blog, February 2014<br />&nbsp;&nbsp;&nbsp; "Risk Assessment for Single-Use Disposable Projects", Contract Pharma, January/February 2014<br />&nbsp;&nbsp;&nbsp; "Facility of the Future: Next Generation Manufacturing Forum: Part 3": &ldquo;Identifying Facility Requirements Based on Specific Business Drivers and Uncertainties Using the Enabling Technologies&rdquo;, Pharmaceutical Engineering, May/June 2013, Vol. 33, No. 3<br />&nbsp;&nbsp;&nbsp; "Biomanufacturing, The 4th Decade: The Sky''s the Limit", Pharmaceutical Processing,April 2013<br />&nbsp;&nbsp;&nbsp; &ldquo;Facility of the Future: Next Generation Manufacturing Forum: Part 2: &ldquo;Tools for Change-Enabling Technologies and Business and Regulatory Approaches&rdquo;, Pharmaceutical Engineering, March/April 2013, Vol. 33 No. 2<br />&nbsp;&nbsp;&nbsp; &ldquo;Facility of the Future: Next Generation Manufacturing Forum: Part 1: &ldquo;Why We Cannot Stay Here&rdquo; &ndash; The Challenges, Risks, and Business Drivers for Changing the Paradigm," Pharmaceutical Engineering, January/February 2013, Vol. 33 No. 1<br />&nbsp;&nbsp;&nbsp; "Biopharmaceutical Manufacturing in the Twenty-First Century - the Next Generation Manufacturing Facility", Pharmaceutical Engineering, March/April 2012, Vol. 32 No. 2<br />&nbsp;&nbsp;&nbsp; "NextGen Biomanufacturing: Developing the Manufacturing Facility of the Future", Pharmaceutical Processing, March 2012<br />&nbsp;&nbsp;&nbsp; Single-Use (SU) Systems. Encyclopedia of Industrial Biotechnology (Wiley &amp; Sons, Ltd.), April 2010</p>', '2016-09-08 04:47:33', '1', '1473310053.jpg', NULL),
(44, 'Oral Solid Dosage', 'oral_solid_dosage', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-09-08 04:48:27', '1', '1473310107.jpg', NULL),
(45, 'API/Small Molecule Manufacturing', 'api_small_molecule_manufacturing', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>', '2016-09-08 04:48:58', '1', '1473310138.jpg', NULL),
(69, 'PDF1', 'pdf1', 'null', '2016-09-08 12:31:58', '1', 'null', '_45526_2016_08_09_1473337918.pdf'),
(72, 'SME', 'sme', '<h2 style="color: #e13a3e;">Subject Matter Expert</h2>\r\n<p style="font-size: 17px;"><strong>Coming Soon</strong></p>', '2016-09-09 07:00:56', '1', '1473404456.jpg', NULL),
(73, 'Quality Policy', 'quality_policy', '', '2016-09-13 07:28:37', '', 'null', '_64044_2016_13_09_1473751717.pdf'),
(74, 'About us', 'about_us', '<ul style="font-size: 15px; list-style-type: disc;">\r\n<li>Founded in 1989, Integrated Project Services is Privately owned and Managed Global Company based in USA</li>\r\n<li>IPS has offices in UK, China, Singapore, Brazil &amp; India</li>\r\n<li>Over 900 Passionate Professionals World Wide &amp; 315+ in India</li>\r\n<li>Pioneer in Single Source EPCMV for Technically Complex Facilities</li>\r\n<li>Partnering with 700+ Clients on 6000+ Projects completed</li>\r\n<li>Wealth of Experience for Technically Complex Projects Ranging up to $1500 M</li>\r\n<li>Experts in USFDA compliance</li>\r\n</ul>', '2016-09-14 05:05:07', '1', '1473829506.jpg', NULL),
(76, 'Global Presence', 'global_presence', '<ul class="padding_lr" style="list-style-type: none;">\r\n<li><strong>Locations / Directions</strong></li>\r\n<li>IPS has locations in the United States, Brazil, Canada, China, India, Singapore, Switzerland, and the United Kingdom to better serve you through regional execution of capital projects. Our regional offices allow us to be more responsive to your needs.&nbsp;</li>\r\n</ul>\r\n<table>\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p><strong>IPS International Private Ltd.</strong><br /> C-1, C Block<br /> Community Center<br /> Naraina Vihar, New Delhi 110028<br />New Delhi <strong>T</strong>: +91 011 2577 7806 <strong>F</strong>: +91 011 2577 9152</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>IPS International Private Ltd.</strong><br />1st Floor, Unit No. 5, 6, 7, &amp; 8, Door No. 7-1-58<br />Amrutha Business Complex, Opp. Lal Banglow<br /> Ameerpet, Hyderabad 500016<br />Hyderabad <strong>T</strong>: +91 040-6522 4456 <strong>F</strong>: +91 040 6555 6673</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>IPS-Mehtalia Pvt. Ltd.</strong><br />303, 3rd Floor, 637 Building<br />Opp. Sears Tower, Gulbai Tekra Road<br /> Panchvati, Ahmedabad 380015, Gujarat, India<br />Ahmedabad <strong>T</strong>: +91 079 2640 1711 / 079 2640 1721 <strong>F</strong>: +91 079 2640 1731</p>\r\n</td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<p><strong>IPS-Mehtalia Pvt. Ltd.</strong><br />Unit B 101-109, 1st Floor<br />Kailash Vaibhav Industrial Complex, Park Site<br /> Vikhroli West, Mumbai 400079<br />Mumbai <strong>T</strong>: +91 022 6720 9717 <strong>F</strong>: +91 022 2414 5185</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', '2016-09-14 06:02:34', '1', '1473832953.jpg', NULL),
(77, 'Technical Consulting', 'technical_consulting', '<ul style="font-size: 15px; list-style-type: disc;">\r\n<li>Program Management</li>\r\n<li>Strategic Planning</li>\r\n<li>Master Planning</li>\r\n<li>Feasibility Studies</li>\r\n<li>Asset Disposal</li>\r\n<li>Facility Operations</li>\r\n<li>Energy / Sustainability</li>\r\n<li>Environmental Health &amp; Safety</li>\r\n<li>Facility due diligence</li>\r\n<li>Facility Evaluation</li>\r\n</ul>', '2016-09-14 07:34:38', '1', '1473838478.jpg', NULL),
(78, 'Commissioning and Qualification', 'commissioning_and_qualification', '<ul style="font-size: 15px; list-style-type: disc;">\r\n<li>Equipment Start-up</li>\r\n<li>Risk-based Commissioning &amp; Qualification</li>\r\n<li>Validation (IQ/OQ/PQ/ UAT/CSV/PV/MV)</li>\r\n<li>Compliance Audits</li>\r\n<li>Documentation</li>\r\n<ul style="font-size: 15px; list-style-type: square;">\r\n<li>Process Bid Pkg. Review</li>\r\n<li>O&amp;M Manuals</li>\r\n<li>As-Built</li>\r\n<li>Reports</li>\r\n<li>ETOPs</li>\r\n</ul>\r\n</ul>', '2016-09-14 09:04:31', '1', '1473843871.jpg', NULL),
(79, 'About us.', 'about_us.', '<ul style="font-size: 15px; list-style-type: disc;">\r\n<li>Founded in 1989, Integrated Project Services is Privately owned and Managed Global Company based in USA</li>\r\n<li>IPS has offices in UK, China, Singapore, Brazil &amp; India</li>\r\n<li>Over 900 Passionate Professionals World Wide &amp; 315+ in India</li>\r\n<li>Pioneer in Single Source EPCMV for Technically Complex Facilities</li>\r\n<li>Partnering with 700+ Clients on 6000+ Projects completed</li>\r\n<li>Wealth of Experience for Technically Complex Projects Ranging up to $1500 M</li>\r\n<li>Experts in USFDA compliance</li>\r\n</ul>', '2016-09-14 10:57:41', '1', '1473850661.jpg', NULL),
(80, 'Awards', 'awards', '', '2016-09-14 11:08:03', '1', 'null', '_33038_2016_14_09_1473851283.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `privacy`
--

CREATE TABLE IF NOT EXISTS `privacy` (
  `id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy`
--

INSERT INTO `privacy` (`id`, `title`, `content`) VALUES
(0, 'Privacy', '<p style="font-size: 18px;"><strong>Coming Soon</strong></p>');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_url` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0=in-active,1=active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `page_url`, `filename`, `content`, `status`) VALUES
(6, '', '1472126251.jpg', '<h3 class="h3_style">The Experience and Talent to Help Clients Succeed</h3>\r\n<p class="font_style">We are acknowledged technical experts and our areas of expertise reflect that knowledge and in-depth, real-world experience. Part of the IPS ''difference'' is that you get, on every project, experts with a successful track record in delivering cost effective solutions that achieve your project goals and business objectives. Below are highlights of our recent experience.</p>\r\n<ul class="font_style " style="list-style-type: disc;">\r\n<li class="li_style">We performed the initial study, conceptual design, cost estimate, basic and detail design and project execution for a Clinical Laboratory Facility. The project included a conceptual study of an existing clinical facility from a civil, fire safety, HVAC and infrastructure angle. IPS International proceeded to detail design where civil related items such as architectural details for the lab areas, central utility building including a closed loop chilled water system, structural details including the utility building, a new fire hydrant system including a ring main, sprinkler system, fire alarm system, a new electrical system including PCC, MCC and DBs, single line diagrams for the new HVAC, lighting and fire alarm system, a new HVAC systems including AHU, Chillers, duct design and routing and piping design. Infrastructure development including new security blocks, parking spaces, roads and storm water drains were also designed in detail.</li>\r\n<li class="li_style">IPSI performed the conceptual design, cost estimate, basic and detail design and construction support and full-time construction site presence for a complex 80,000sf cytotoxic facility located in India. Designed to meet FDA and EU regulatory approval, the project was a Greenfield pharmaceutical manufacturing facility for injectables as well oral solid dosage using cytotoxic and anti-hormonal products. Solid dosage capabilities included all unit operations including wet / dry granulation, compression, coating and primary/secondary packaging. Aseptic operation included formulation, filling, lyophilization and primary and secondary packaging. Isolation Technology was used to provide primary containment for both product and personnel.</li>\r\n<li class="li_style">The project was a 300,000sf Vivarium building for Pre-Clinical (Toxicology Study) testing and one floor for breeding. We were brought in during the middle of the design phase to re-examine the programming, evaluate their existing design, complete the detail design, prepare the BOQ and help Vivo with meeting AAALAC certification. IPS International independently performed a design review and a GAP analysis of the existing design, reconfigured rooms, modified the layout, pressurization plans and developed a BOQ based on our observations.</li>\r\n<li class="li_style">The project consisted of a complete rework on the existing purified water and jacket water lines to 5 reactors. The piping design, line sizing, isometrics and on site supervision for the work was completed. In addition to the main headers and sub connections, instrument locations and instruments were installed including flow meters, automated butterfly valves, automated solenoid valves, hose connections and soft water lines to a new sink.</li>\r\n<li class="li_style">IPSI provided the conceptual design including process equipment selection and cost estimate for an 110,000sf sterile facility for contract filling. The facility was located in Indoor and was designed to meet USFDA and EU requirements including the latest Annex I requirements. A life cycle analysis was performed to select between isolator system and Restricted Access Barrier (RAB) system. The sterile operation included formulation, sterile filling, lyophilization, and packaging. The project included all site utilities, ETP and critical utilities like WFI and Clean Steam systems.</li>\r\n<li class="li_style">IPSI is currently designing a vaccine plant including a BSL level 3 suite. IPSI is contracted to do concept development, basic and detail design as well as construction support. The project is a Greenfield site near Hyderabad. The project includes four (4) cell culture/downstream purification modules, three with BSL-2 level protection and one with BSL-3 design. A central sterile fill-finish and packaging wing will support all four cell culture modules. The project also includes design of the critical utilities like WFI and Clean Steam as well as a biohazard waste treatment system (kill system), ETP and all necessary central utilities.</li>\r\n<li class="li_style">The project consists of a conceptual cost estimate for a new OSD facility catered towards contract manufacturing and multiple products / multiple ingredients with an annual output of about 2 Billion tablets per year. As part of the engineering effort, IPS developed an overall site plan, internal conceptual production building details, process equipment list and a cost estimate for the new facility. The project was executed and managed from the Hyderabad office.</li>\r\n<li class="li_style">IPSI provided the conceptual design including process equipment selection and cost estimate for a Greenfield Cytotoxic sterile and oral solid dosage facility in Aurangabad, India. The facility was designed to meet FDA and EU approval. Solid dosage capabilities included all unit operations including wet and dry granulation, compression, coating and primary/secondary packaging. Aseptic operation included formulation, filling, lyophilization and primary and secondary packaging. Isolation Technology was used to provide primary containment for both product and personnel.</li>\r\n</ul>', '1');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  `page_url` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL COMMENT '0=in-active,1=active',
  `filename` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_name` (`page_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `page_name`, `page_url`, `content`, `timestamp`, `status`, `filename`) VALUES
(10, 'Design/Engineering', 'design_engineering', '<ul style="list-style-type: disc;">\r\n<li>Engineering</li>\r\n<li>Process Architecture</li>\r\n<li>Architectural</li>\r\n<li>Mechanical</li>\r\n<li>Electrical</li>\r\n<li>Process Technology</li>\r\n<li>Process Engineering</li>\r\n<li>Equipment</li>\r\n<li>Computer Process Simulation and Modeling</li>\r\n<li>Environmental</li>\r\n<li>BIM Technology</li>\r\n<li>Conceptual Design / Engineering</li>\r\n<li>Detailed Engineering</li>\r\n<li>Energy/ Sustainability</li>\r\n<li>3D Simulation</li>\r\n<li>Automation</li>\r\n</ul>', '2016-08-16 06:34:12', '1', '1471410640.jpg'),
(11, 'Construction Management', 'construction_management', '<ul style="font-size: 15px; list-style-type: disc;">\r\n<li>Constructability Reviews</li>\r\n<li>Construction Management</li>\r\n<li>Cost Management</li>\r\n<li>Design Reviews</li>\r\n<li>Estimating</li>\r\n<li>Field Inspection/Execution</li>\r\n<li>Logistics Planning</li>\r\n<li>Process Equipment Installation</li>\r\n<li>Procurement Strategy</li>\r\n<li>Project Controls</li>\r\n<li>Project Management</li>\r\n<li>Risk Analysis</li>\r\n<li>Safety</li>\r\n<li>Schedule Management</li>\r\n</ul>', '2016-08-16 06:49:30', '1', '1471410443.jpg'),
(12, 'Commissioning and Qualification', 'commissioning_and_qualification', '<ul style="font-size: 15px; list-style-type: disc;">\r\n<li>C&amp;Q / Validation Master Planning</li>\r\n<li>Qualification: IQ / OQ / PQ</li>\r\n<li>ASTM E2500</li>\r\n<li>FMEA / Fault Tree</li>\r\n<li>Risk / Value Mapping</li>\r\n<li>Logistics Planning</li>\r\n<li>Operations Strategy</li>\r\n<li>Design Qualification</li>\r\n<li>URS / FRS Development</li>\r\n<li>Retrocommissioning</li>\r\n<li>Commissioning</li>\r\n<li>FAT / SAT</li>\r\n<li>Project Information Management</li>\r\n<li>Quality System</li>\r\n<li>Implementation</li>\r\n<li>Test Plan Development</li>\r\n<li>Procurement Specifications</li>\r\n<li>Validation &amp; cGMP Training</li>\r\n<li>Process / Cleaning Validation</li>\r\n<li>Automation and Computer Systems Validation</li>\r\n<li>Document Management</li>\r\n<li>Calibration</li>\r\n<li>FDA 483/WL Remediation</li>\r\n</ul>', '2016-08-16 06:59:01', '1', '1471409917.jpg'),
(13, 'Technical Consulting', 'technical_consulting', '<ul style="font-size: 15px; list-style-type: disc;">\r\n<li>Facility Operations / Operations Strategy</li>\r\n<li>Operational Excellence and Planning</li>\r\n<li>Strategic Master Planning</li>\r\n<li>Technology Transfer</li>\r\n<li>Lean Approaches to Capital Projects</li>\r\n<li>Total Calibration Program Management</li>\r\n<li>Energy Audits / Conservation/Management</li>\r\n<li>Environmental Impact Analysis / Assessment</li>\r\n</ul>', '2016-08-17 04:41:59', '1', '1472036373.png');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(100) NOT NULL,
  `tittle` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL COMMENT '0=inactive,1=active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `image_name`, `tittle`, `status`) VALUES
(8, '1473757541.png', 'IPSI', '1'),
(9, '1473757575.png', 'IPSI', '1'),
(10, '1473757581.png', 'IPSI', '1'),
(11, '1473757657.png', 'IPSI', '1');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_name` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL COMMENT '0=in-active,1=active',
  `filename` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `page_name` (`page_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `page_name`, `content`, `timestamp`, `status`, `filename`) VALUES
(10, '', '<h2 style="color: #e13a3e;">Subject Matter Expert</h2>\r\n<p style="font-size: 17px;"><strong>Coming Soon</strong></p>', '2016-08-17 05:33:45', '1', '1471412025.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tabs`
--

CREATE TABLE IF NOT EXISTS `tabs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tab` varchar(50) NOT NULL,
  `parent_tab` varchar(50) NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL COMMENT '0=inactive,1=active',
  `page_url` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `tabs`
--

INSERT INTO `tabs` (`id`, `tab`, `parent_tab`, `status`, `page_url`) VALUES
(28, 'Home', '0', '1', 'home'),
(29, 'Services', '0', '1', 'services'),
(30, 'About us', '0', '1', 'about_us'),
(31, 'Expertise', '0', '1', 'expertise'),
(32, 'Projects', '0', '1', 'projects'),
(33, 'Recognition', '0', '1', 'recognition'),
(34, 'SME', '0', '1', 'sme'),
(35, 'Careers', '0', '1', 'careers'),
(37, 'News and Events', '0', '1', 'news_and_event'),
(38, 'Contact Us', '0', '1', 'contact_us'),
(39, 'Technical Consulting', '29', '1', 'technical_consulting'),
(40, 'Commissioning and Qualification', '29', '1', 'commissioning_and_qualification'),
(41, 'Construction Management', '29', '1', 'construction_management'),
(42, 'Design/Engineering', '29', '1', 'design_engineering'),
(43, 'Vision/Mission/Values', '30', '1', 'vision_mission_values'),
(44, 'Global Presence', '30', '1', 'global_presence'),
(45, 'Team', '30', '1', 'team'),
(46, 'Capabilities/Strengths', '30', '1', 'capabilities_strengths'),
(47, 'Success Stories', '32', '1', 'success_stories'),
(48, 'Board of Directors', '30', '1', 'board_of_directors'),
(49, 'API/Small Molecule Manufacturing', '31', '1', 'api_small_molecule_manufacturing'),
(50, 'Oral Solid Dosage', '31', '1', 'oral_solid_dosage'),
(51, 'Biotechnology Vaccines', '31', '1', 'biotechnology_vaccines'),
(52, 'Advanced Aseptic Processing', '31', '1', 'advanced_aseptic_processing'),
(53, 'Potent compounds and Containment', '31', '1', 'potent_compounds_and_containment'),
(54, 'Biopharmaceuticals', '31', '1', 'biopharmaceuticals'),
(55, 'Vaccine manufacturing processes', '31', '1', 'vaccine_manufacturing_processes'),
(56, 'Parenteral drug', '31', '1', 'parenteral_drug'),
(59, 'Quality Policy', '30', '1', 'quality_policy'),
(62, 'About us.', '30', '1', 'about_us.'),
(63, 'Awards', '33', '1', 'awards');

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE IF NOT EXISTS `tb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`id`, `user_id`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tb_events`
--

CREATE TABLE IF NOT EXISTS `tb_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(100) NOT NULL,
  `event_html` text NOT NULL,
  `event_status` int(11) NOT NULL,
  `event_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_events`
--

INSERT INTO `tb_events` (`id`, `event_title`, `event_html`, `event_status`, `event_added`) VALUES
(4, 'Save Tree', '<p style="text-align: justify;">In botany, a tree is a perennial plant with an elongated stem, or trunk, supporting branches and leaves in most species. In some usages, the definition of a tree may be narrower, including only woody plants with secondary growth, plants that are usable as lumber or plants above a specified height. Trees are not a taxonomic group but include a variety of plant species that have independently evolved a woody trunk and branches as a way to tower above other plants to compete for sunlight. In looser senses, the taller palms, the tree ferns, bananas and bamboos are also trees. Trees tend to be long-lived, some reaching several thousand years old. The tallest known tree, a coast redwood named Hyperion, stands 115.6 m (379 ft) high. Trees have been in existence for 370 million years. It is estimated that there are just over 3 trillion mature trees in the world.</p>', 1, '2016-08-11 12:14:19'),
(6, 'Petrol save', '<p>Drive Smart Save Fuel is a Mobile Game developed to facilitate deeper penetration of PCRA Conservation Tips &amp; Messages and side by making you enhance your learning &amp; driving skills. This game teaches you how to play smartly in order to save fuel while driving &amp; scoring best as much as you can. Your driving and efficiency skills will be judged and given score based on your driving.</p>', 1, '2016-09-13 10:34:52');

-- --------------------------------------------------------

--
-- Table structure for table `tb_news`
--

CREATE TABLE IF NOT EXISTS `tb_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_headline` varchar(200) NOT NULL,
  `news_html` text NOT NULL,
  `news_status` int(2) NOT NULL,
  `publish_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `tb_news`
--

INSERT INTO `tb_news` (`id`, `news_headline`, `news_html`, `news_status`, `publish_time`) VALUES
(2, 'GST paased ', '<p>Opened in 2007, IPS International''s fully operational offices in India focusing on providing engineering, design construction and commissioning <a href="/pdf/services.pdf">services</a> for Biotech, API and Pharmaceutical companies.&nbsp; Our team of 30+ experienced professionals is dedicated to improving operations, revitalizing facilities and staying compliant in the global marketplace.</p>\n	<p>Focusing on key technologies, we offer cost effective business solutions to successfully deliver your technically complex facility on-time and on budget. We understand the regulatory environment requirements in India and around the world, including the availability of material and equipment in India enable us to specify and procure locally available systems while maintaining compliance with International Standards.</p>\n	<p>We specialize in:</p>\n	<ul>\n	<li>Containment strategies for using potent and cytotoxic compounds in OSD and Sterile / Injectable facilities</li>\n	<li>Advanced aseptic technology including Annex I from<strong> </strong>EMEA''s Regulations and Guidelines for Good Manufacturing Practice for Active Pharmaceutical Ingredients</li>\n	<li>Biotechnology including vaccine production with cell culture, downstream purification, disposable techniques and bio-safety level 2-3</li>\n	<li>R&amp;D Laboratory and Facility Design and Vivarium Design meeting AAALAC requirements</li>\n	<li>Our expertise includes process design, process development, critical utilities such as WFI and Clean Steam Design, clean room design and specialized HVAC </li>\n	</ul>\n	<p>Our approach and our subject knowledge expertise in engineering, construction and commissioning and qualification has been the <a href="/pdf/Advantage India 2010.pdf">cornerstone of our success</a>. We continually find ways to do things better and more efficiently, delivering higher quality, controlling costs and the operational functionality required to effectively successfully execute your overall project and business objectives - resulting in real value for our clients.</p>\n	<p><strong>Key Benefits of Working with IPS International</strong></p>\n	<ul>\n	<li>Worldwide Relationships and Partnerships<strong></strong></li>\n	<li>Local Offices in China and India<strong></strong></li>\n	<li>Local Government and Manufacturing Knowledge; Multi-lingual Staff<strong></strong></li>\n	<li>Extensive FDA, EU and Compliance Experience<strong></strong></li>\n	<li>Process and Operational Expertise<strong></strong></li>\n	<li>Tech Transfer Expertise<strong></strong></li>\n	<li>Successfully address aggressive schedules, challenging regulatory issues, performance roadblocks and tight budgets</li>\n	<li>Understand the importance of balancing cost, control, quality and technology</li>\n	<li>Integrated solutions to meet your business objectives and make your capital projects a success</li>\n	</ul>', 1, '2016-08-04 04:08:32'),
(5, 'match drawn', '2nd test between india and west indies drawn', 1, '2016-08-04 04:08:48'),
(6, 'android 7 launched', '<p>google launched new android version 7</p>', 1, '2016-08-04 04:10:28');

-- --------------------------------------------------------

--
-- Table structure for table `tb_testimonial`
--

CREATE TABLE IF NOT EXISTS `tb_testimonial` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(50) NOT NULL,
  `designation` varchar(30) NOT NULL,
  `experince` varchar(30) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `client_image` varchar(100) NOT NULL,
  `comment_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tb_testimonial`
--

INSERT INTO `tb_testimonial` (`id`, `client_name`, `designation`, `experince`, `comment`, `status`, `client_image`, `comment_added`) VALUES
(1, 'test1', '', '', '<p>qwerty6 ertyuio rftyuio</p>', 1, 'image.png', '2016-08-05 11:55:33'),
(2, 'test1', 'dseg', '1', '<p>SDcsgd</p>', 1, 'image.png', '2016-08-05 12:01:57'),
(3, 'test', 'dseg', '5', '<p>xfvd</p>', 1, '1470812531.jpg', '2016-08-05 12:20:44'),
(4, 'ASDFGHJ', 'SDFGHJ', '1', '<p>sdfghjk</p>', 1, 'image.png', '2016-08-11 10:10:40'),
(5, 'hhh', 'hhh', 'hh', '<p>nknjjhjhjh</p>', 1, '1470910650.jpg', '2016-08-11 10:11:01'),
(6, '', '', '', '', 1, 'image.png', '2016-08-12 04:24:37'),
(7, 'sdfghj', 'asdfgh', 'xcfvgb', 'asdfgsdfvsdcvdcvxc', 1, 'image.png', '2016-08-12 04:48:57'),
(8, '', '', '', '', 1, 'image.png', '2016-08-12 04:49:05'),
(9, '', '', '', '', 1, 'image.png', '2016-08-12 04:55:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
