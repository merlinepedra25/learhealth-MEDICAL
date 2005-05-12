-- --------------------------------------------------------

-- 
-- Table structure for table `form`
-- 

CREATE TABLE `form` (
  `form_id` int(11) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `description` text NOT NULL,
  PRIMARY KEY  (`form_id`)
) TYPE=MyISAM COMMENT='Contains the EMR extending forms STARTWITHDATA';

-- 
-- Dumping data for table `form`
-- 

INSERT INTO `form` VALUES (800, 'Test Data', 'Some random data');
INSERT INTO `form` VALUES (1710, 'Patient Vitals', 'Patient Vital Statistics');

-- --------------------------------------------------------

-- 
-- Table structure for table `form_data`
-- 

CREATE TABLE `form_data` (
  `form_data_id` int(11) NOT NULL default '0',
  `form_id` int(11) NOT NULL default '0',
  `external_id` int(11) NOT NULL default '0',
  `last_edit` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`form_data_id`)
) TYPE=MyISAM COMMENT='Links in the form data STARTWITHDATA';

-- 
-- Dumping data for table `form_data`
-- 

INSERT INTO `form_data` VALUES (2057, 800, 1110, '2005-03-14 15:09:50');
INSERT INTO `form_data` VALUES (20350, 800, 10061, '2005-04-08 09:05:24');
INSERT INTO `form_data` VALUES (20351, 800, 10001, '2005-04-08 09:07:50');
        
