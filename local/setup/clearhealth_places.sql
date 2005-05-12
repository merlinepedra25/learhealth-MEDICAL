
-- 
-- Table structure for table `countries`
-- 

CREATE TABLE `countries` (
  `countries_name` varchar(64) NOT NULL default '',
  `countries_iso_code_2` char(2) NOT NULL default '',
  `countries_iso_code_3` char(3) NOT NULL default '',
  PRIMARY KEY  (`countries_iso_code_3`),
  KEY `IDX_COUNTRIES_NAME` (`countries_name`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `countries`
-- 

INSERT INTO `countries` VALUES ('Afghanistan', 'AF', 'AFG');
INSERT INTO `countries` VALUES ('Albania', 'AL', 'ALB');
INSERT INTO `countries` VALUES ('Algeria', 'DZ', 'DZA');
INSERT INTO `countries` VALUES ('American Samoa', 'AS', 'ASM');
INSERT INTO `countries` VALUES ('Andorra', 'AD', 'AND');
INSERT INTO `countries` VALUES ('Angola', 'AO', 'AGO');
INSERT INTO `countries` VALUES ('Anguilla', 'AI', 'AIA');
INSERT INTO `countries` VALUES ('Antarctica', 'AQ', 'ATA');
INSERT INTO `countries` VALUES ('Antigua and Barbuda', 'AG', 'ATG');
INSERT INTO `countries` VALUES ('Argentina', 'AR', 'ARG');
INSERT INTO `countries` VALUES ('Armenia', 'AM', 'ARM');
INSERT INTO `countries` VALUES ('Aruba', 'AW', 'ABW');
INSERT INTO `countries` VALUES ('Australia', 'AU', 'AUS');
INSERT INTO `countries` VALUES ('Austria', 'AT', 'AUT');
INSERT INTO `countries` VALUES ('Azerbaijan', 'AZ', 'AZE');
INSERT INTO `countries` VALUES ('Bahamas', 'BS', 'BHS');
INSERT INTO `countries` VALUES ('Bahrain', 'BH', 'BHR');
INSERT INTO `countries` VALUES ('Bangladesh', 'BD', 'BGD');
INSERT INTO `countries` VALUES ('Barbados', 'BB', 'BRB');
INSERT INTO `countries` VALUES ('Belarus', 'BY', 'BLR');
INSERT INTO `countries` VALUES ('Belgium', 'BE', 'BEL');
INSERT INTO `countries` VALUES ('Belize', 'BZ', 'BLZ');
INSERT INTO `countries` VALUES ('Benin', 'BJ', 'BEN');
INSERT INTO `countries` VALUES ('Bermuda', 'BM', 'BMU');
INSERT INTO `countries` VALUES ('Bhutan', 'BT', 'BTN');
INSERT INTO `countries` VALUES ('Bolivia', 'BO', 'BOL');
INSERT INTO `countries` VALUES ('Bosnia and Herzegowina', 'BA', 'BIH');
INSERT INTO `countries` VALUES ('Botswana', 'BW', 'BWA');
INSERT INTO `countries` VALUES ('Bouvet Island', 'BV', 'BVT');
INSERT INTO `countries` VALUES ('Brazil', 'BR', 'BRA');
INSERT INTO `countries` VALUES ('British Indian Ocean Territory', 'IO', 'IOT');
INSERT INTO `countries` VALUES ('Brunei Darussalam', 'BN', 'BRN');
INSERT INTO `countries` VALUES ('Bulgaria', 'BG', 'BGR');
INSERT INTO `countries` VALUES ('Burkina Faso', 'BF', 'BFA');
INSERT INTO `countries` VALUES ('Burundi', 'BI', 'BDI');
INSERT INTO `countries` VALUES ('Cambodia', 'KH', 'KHM');
INSERT INTO `countries` VALUES ('Cameroon', 'CM', 'CMR');
INSERT INTO `countries` VALUES ('Canada', 'CA', 'CAN');
INSERT INTO `countries` VALUES ('Cape Verde', 'CV', 'CPV');
INSERT INTO `countries` VALUES ('Cayman Islands', 'KY', 'CYM');
INSERT INTO `countries` VALUES ('Central African Republic', 'CF', 'CAF');
INSERT INTO `countries` VALUES ('Chad', 'TD', 'TCD');
INSERT INTO `countries` VALUES ('Chile', 'CL', 'CHL');
INSERT INTO `countries` VALUES ('China', 'CN', 'CHN');
INSERT INTO `countries` VALUES ('Christmas Island', 'CX', 'CXR');
INSERT INTO `countries` VALUES ('Cocos (Keeling) Islands', 'CC', 'CCK');
INSERT INTO `countries` VALUES ('Colombia', 'CO', 'COL');
INSERT INTO `countries` VALUES ('Comoros', 'KM', 'COM');
INSERT INTO `countries` VALUES ('Congo', 'CG', 'COG');
INSERT INTO `countries` VALUES ('Cook Islands', 'CK', 'COK');
INSERT INTO `countries` VALUES ('Costa Rica', 'CR', 'CRI');
INSERT INTO `countries` VALUES ('Cote D''Ivoire', 'CI', 'CIV');
INSERT INTO `countries` VALUES ('Croatia', 'HR', 'HRV');
INSERT INTO `countries` VALUES ('Cuba', 'CU', 'CUB');
INSERT INTO `countries` VALUES ('Cyprus', 'CY', 'CYP');
INSERT INTO `countries` VALUES ('Czech Republic', 'CZ', 'CZE');
INSERT INTO `countries` VALUES ('Denmark', 'DK', 'DNK');
INSERT INTO `countries` VALUES ('Djibouti', 'DJ', 'DJI');
INSERT INTO `countries` VALUES ('Dominica', 'DM', 'DMA');
INSERT INTO `countries` VALUES ('Dominican Republic', 'DO', 'DOM');
INSERT INTO `countries` VALUES ('East Timor', 'TP', 'TMP');
INSERT INTO `countries` VALUES ('Ecuador', 'EC', 'ECU');
INSERT INTO `countries` VALUES ('Egypt', 'EG', 'EGY');
INSERT INTO `countries` VALUES ('El Salvador', 'SV', 'SLV');
INSERT INTO `countries` VALUES ('Equatorial Guinea', 'GQ', 'GNQ');
INSERT INTO `countries` VALUES ('Eritrea', 'ER', 'ERI');
INSERT INTO `countries` VALUES ('Estonia', 'EE', 'EST');
INSERT INTO `countries` VALUES ('Ethiopia', 'ET', 'ETH');
INSERT INTO `countries` VALUES ('Falkland Islands (Malvinas)', 'FK', 'FLK');
INSERT INTO `countries` VALUES ('Faroe Islands', 'FO', 'FRO');
INSERT INTO `countries` VALUES ('Fiji', 'FJ', 'FJI');
INSERT INTO `countries` VALUES ('Finland', 'FI', 'FIN');
INSERT INTO `countries` VALUES ('France', 'FR', 'FRA');
INSERT INTO `countries` VALUES ('France, Metropolitan', 'FX', 'FXX');
INSERT INTO `countries` VALUES ('French Guiana', 'GF', 'GUF');
INSERT INTO `countries` VALUES ('French Polynesia', 'PF', 'PYF');
INSERT INTO `countries` VALUES ('French Southern Territories', 'TF', 'ATF');
INSERT INTO `countries` VALUES ('Gabon', 'GA', 'GAB');
INSERT INTO `countries` VALUES ('Gambia', 'GM', 'GMB');
INSERT INTO `countries` VALUES ('Georgia', 'GE', 'GEO');
INSERT INTO `countries` VALUES ('Germany', 'DE', 'DEU');
INSERT INTO `countries` VALUES ('Ghana', 'GH', 'GHA');
INSERT INTO `countries` VALUES ('Gibraltar', 'GI', 'GIB');
INSERT INTO `countries` VALUES ('Greece', 'GR', 'GRC');
INSERT INTO `countries` VALUES ('Greenland', 'GL', 'GRL');
INSERT INTO `countries` VALUES ('Grenada', 'GD', 'GRD');
INSERT INTO `countries` VALUES ('Guadeloupe', 'GP', 'GLP');
INSERT INTO `countries` VALUES ('Guam', 'GU', 'GUM');
INSERT INTO `countries` VALUES ('Guatemala', 'GT', 'GTM');
INSERT INTO `countries` VALUES ('Guinea', 'GN', 'GIN');
INSERT INTO `countries` VALUES ('Guinea-bissau', 'GW', 'GNB');
INSERT INTO `countries` VALUES ('Guyana', 'GY', 'GUY');
INSERT INTO `countries` VALUES ('Haiti', 'HT', 'HTI');
INSERT INTO `countries` VALUES ('Heard and Mc Donald Islands', 'HM', 'HMD');
INSERT INTO `countries` VALUES ('Honduras', 'HN', 'HND');
INSERT INTO `countries` VALUES ('Hong Kong', 'HK', 'HKG');
INSERT INTO `countries` VALUES ('Hungary', 'HU', 'HUN');
INSERT INTO `countries` VALUES ('Iceland', 'IS', 'ISL');
INSERT INTO `countries` VALUES ('India', 'IN', 'IND');
INSERT INTO `countries` VALUES ('Indonesia', 'ID', 'IDN');
INSERT INTO `countries` VALUES ('Iran (Islamic Republic of)', 'IR', 'IRN');
INSERT INTO `countries` VALUES ('Iraq', 'IQ', 'IRQ');
INSERT INTO `countries` VALUES ('Ireland', 'IE', 'IRL');
INSERT INTO `countries` VALUES ('Israel', 'IL', 'ISR');
INSERT INTO `countries` VALUES ('Italy', 'IT', 'ITA');
INSERT INTO `countries` VALUES ('Jamaica', 'JM', 'JAM');
INSERT INTO `countries` VALUES ('Japan', 'JP', 'JPN');
INSERT INTO `countries` VALUES ('Jordan', 'JO', 'JOR');
INSERT INTO `countries` VALUES ('Kazakhstan', 'KZ', 'KAZ');
INSERT INTO `countries` VALUES ('Kenya', 'KE', 'KEN');
INSERT INTO `countries` VALUES ('Kiribati', 'KI', 'KIR');
INSERT INTO `countries` VALUES ('Korea, Democratic People''s Republic of', 'KP', 'PRK');
INSERT INTO `countries` VALUES ('Korea, Republic of', 'KR', 'KOR');
INSERT INTO `countries` VALUES ('Kuwait', 'KW', 'KWT');
INSERT INTO `countries` VALUES ('Kyrgyzstan', 'KG', 'KGZ');
INSERT INTO `countries` VALUES ('Lao People''s Democratic Republic', 'LA', 'LAO');
INSERT INTO `countries` VALUES ('Latvia', 'LV', 'LVA');
INSERT INTO `countries` VALUES ('Lebanon', 'LB', 'LBN');
INSERT INTO `countries` VALUES ('Lesotho', 'LS', 'LSO');
INSERT INTO `countries` VALUES ('Liberia', 'LR', 'LBR');
INSERT INTO `countries` VALUES ('Libyan Arab Jamahiriya', 'LY', 'LBY');
INSERT INTO `countries` VALUES ('Liechtenstein', 'LI', 'LIE');
INSERT INTO `countries` VALUES ('Lithuania', 'LT', 'LTU');
INSERT INTO `countries` VALUES ('Luxembourg', 'LU', 'LUX');
INSERT INTO `countries` VALUES ('Macau', 'MO', 'MAC');
INSERT INTO `countries` VALUES ('Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD');
INSERT INTO `countries` VALUES ('Madagascar', 'MG', 'MDG');
INSERT INTO `countries` VALUES ('Malawi', 'MW', 'MWI');
INSERT INTO `countries` VALUES ('Malaysia', 'MY', 'MYS');
INSERT INTO `countries` VALUES ('Maldives', 'MV', 'MDV');
INSERT INTO `countries` VALUES ('Mali', 'ML', 'MLI');
INSERT INTO `countries` VALUES ('Malta', 'MT', 'MLT');
INSERT INTO `countries` VALUES ('Marshall Islands', 'MH', 'MHL');
INSERT INTO `countries` VALUES ('Martinique', 'MQ', 'MTQ');
INSERT INTO `countries` VALUES ('Mauritania', 'MR', 'MRT');
INSERT INTO `countries` VALUES ('Mauritius', 'MU', 'MUS');
INSERT INTO `countries` VALUES ('Mayotte', 'YT', 'MYT');
INSERT INTO `countries` VALUES ('Mexico', 'MX', 'MEX');
INSERT INTO `countries` VALUES ('Micronesia, Federated States of', 'FM', 'FSM');
INSERT INTO `countries` VALUES ('Moldova, Republic of', 'MD', 'MDA');
INSERT INTO `countries` VALUES ('Monaco', 'MC', 'MCO');
INSERT INTO `countries` VALUES ('Mongolia', 'MN', 'MNG');
INSERT INTO `countries` VALUES ('Montserrat', 'MS', 'MSR');
INSERT INTO `countries` VALUES ('Morocco', 'MA', 'MAR');
INSERT INTO `countries` VALUES ('Mozambique', 'MZ', 'MOZ');
INSERT INTO `countries` VALUES ('Myanmar', 'MM', 'MMR');
INSERT INTO `countries` VALUES ('Namibia', 'NA', 'NAM');
INSERT INTO `countries` VALUES ('Nauru', 'NR', 'NRU');
INSERT INTO `countries` VALUES ('Nepal', 'NP', 'NPL');
INSERT INTO `countries` VALUES ('Netherlands', 'NL', 'NLD');
INSERT INTO `countries` VALUES ('Netherlands Antilles', 'AN', 'ANT');
INSERT INTO `countries` VALUES ('New Caledonia', 'NC', 'NCL');
INSERT INTO `countries` VALUES ('New Zealand', 'NZ', 'NZL');
INSERT INTO `countries` VALUES ('Nicaragua', 'NI', 'NIC');
INSERT INTO `countries` VALUES ('Niger', 'NE', 'NER');
INSERT INTO `countries` VALUES ('Nigeria', 'NG', 'NGA');
INSERT INTO `countries` VALUES ('Niue', 'NU', 'NIU');
INSERT INTO `countries` VALUES ('Norfolk Island', 'NF', 'NFK');
INSERT INTO `countries` VALUES ('Northern Mariana Islands', 'MP', 'MNP');
INSERT INTO `countries` VALUES ('Norway', 'NO', 'NOR');
INSERT INTO `countries` VALUES ('Oman', 'OM', 'OMN');
INSERT INTO `countries` VALUES ('Pakistan', 'PK', 'PAK');
INSERT INTO `countries` VALUES ('Palau', 'PW', 'PLW');
INSERT INTO `countries` VALUES ('Panama', 'PA', 'PAN');
INSERT INTO `countries` VALUES ('Papua New Guinea', 'PG', 'PNG');
INSERT INTO `countries` VALUES ('Paraguay', 'PY', 'PRY');
INSERT INTO `countries` VALUES ('Peru', 'PE', 'PER');
INSERT INTO `countries` VALUES ('Philippines', 'PH', 'PHL');
INSERT INTO `countries` VALUES ('Pitcairn', 'PN', 'PCN');
INSERT INTO `countries` VALUES ('Poland', 'PL', 'POL');
INSERT INTO `countries` VALUES ('Portugal', 'PT', 'PRT');
INSERT INTO `countries` VALUES ('Puerto Rico', 'PR', 'PRI');
INSERT INTO `countries` VALUES ('Qatar', 'QA', 'QAT');
INSERT INTO `countries` VALUES ('Reunion', 'RE', 'REU');
INSERT INTO `countries` VALUES ('Romania', 'RO', 'ROM');
INSERT INTO `countries` VALUES ('Russian Federation', 'RU', 'RUS');
INSERT INTO `countries` VALUES ('Rwanda', 'RW', 'RWA');
INSERT INTO `countries` VALUES ('Saint Kitts and Nevis', 'KN', 'KNA');
INSERT INTO `countries` VALUES ('Saint Lucia', 'LC', 'LCA');
INSERT INTO `countries` VALUES ('Saint Vincent and the Grenadines', 'VC', 'VCT');
INSERT INTO `countries` VALUES ('Samoa', 'WS', 'WSM');
INSERT INTO `countries` VALUES ('San Marino', 'SM', 'SMR');
INSERT INTO `countries` VALUES ('Sao Tome and Principe', 'ST', 'STP');
INSERT INTO `countries` VALUES ('Saudi Arabia', 'SA', 'SAU');
INSERT INTO `countries` VALUES ('Senegal', 'SN', 'SEN');
INSERT INTO `countries` VALUES ('Seychelles', 'SC', 'SYC');
INSERT INTO `countries` VALUES ('Sierra Leone', 'SL', 'SLE');
INSERT INTO `countries` VALUES ('Singapore', 'SG', 'SGP');
INSERT INTO `countries` VALUES ('Slovakia (Slovak Republic)', 'SK', 'SVK');
INSERT INTO `countries` VALUES ('Slovenia', 'SI', 'SVN');
INSERT INTO `countries` VALUES ('Solomon Islands', 'SB', 'SLB');
INSERT INTO `countries` VALUES ('Somalia', 'SO', 'SOM');
INSERT INTO `countries` VALUES ('South Africa', 'ZA', 'ZAF');
INSERT INTO `countries` VALUES ('South Georgia and the South Sandwich Islands', 'GS', 'SGS');
INSERT INTO `countries` VALUES ('Spain', 'ES', 'ESP');
INSERT INTO `countries` VALUES ('Sri Lanka', 'LK', 'LKA');
INSERT INTO `countries` VALUES ('St. Helena', 'SH', 'SHN');
INSERT INTO `countries` VALUES ('St. Pierre and Miquelon', 'PM', 'SPM');
INSERT INTO `countries` VALUES ('Sudan', 'SD', 'SDN');
INSERT INTO `countries` VALUES ('Suriname', 'SR', 'SUR');
INSERT INTO `countries` VALUES ('Svalbard and Jan Mayen Islands', 'SJ', 'SJM');
INSERT INTO `countries` VALUES ('Swaziland', 'SZ', 'SWZ');
INSERT INTO `countries` VALUES ('Sweden', 'SE', 'SWE');
INSERT INTO `countries` VALUES ('Switzerland', 'CH', 'CHE');
INSERT INTO `countries` VALUES ('Syrian Arab Republic', 'SY', 'SYR');
INSERT INTO `countries` VALUES ('Taiwan', 'TW', 'TWN');
INSERT INTO `countries` VALUES ('Tajikistan', 'TJ', 'TJK');
INSERT INTO `countries` VALUES ('Tanzania, United Republic of', 'TZ', 'TZA');
INSERT INTO `countries` VALUES ('Thailand', 'TH', 'THA');
INSERT INTO `countries` VALUES ('Togo', 'TG', 'TGO');
INSERT INTO `countries` VALUES ('Tokelau', 'TK', 'TKL');
INSERT INTO `countries` VALUES ('Tonga', 'TO', 'TON');
INSERT INTO `countries` VALUES ('Trinidad and Tobago', 'TT', 'TTO');
INSERT INTO `countries` VALUES ('Tunisia', 'TN', 'TUN');
INSERT INTO `countries` VALUES ('Turkey', 'TR', 'TUR');
INSERT INTO `countries` VALUES ('Turkmenistan', 'TM', 'TKM');
INSERT INTO `countries` VALUES ('Turks and Caicos Islands', 'TC', 'TCA');
INSERT INTO `countries` VALUES ('Tuvalu', 'TV', 'TUV');
INSERT INTO `countries` VALUES ('Uganda', 'UG', 'UGA');
INSERT INTO `countries` VALUES ('Ukraine', 'UA', 'UKR');
INSERT INTO `countries` VALUES ('United Arab Emirates', 'AE', 'ARE');
INSERT INTO `countries` VALUES ('United Kingdom', 'GB', 'GBR');
INSERT INTO `countries` VALUES ('United States', 'US', 'USA');
INSERT INTO `countries` VALUES ('United States Minor Outlying Islands', 'UM', 'UMI');
INSERT INTO `countries` VALUES ('Uruguay', 'UY', 'URY');
INSERT INTO `countries` VALUES ('Uzbekistan', 'UZ', 'UZB');
INSERT INTO `countries` VALUES ('Vanuatu', 'VU', 'VUT');
INSERT INTO `countries` VALUES ('Vatican City State (Holy See)', 'VA', 'VAT');
INSERT INTO `countries` VALUES ('Venezuela', 'VE', 'VEN');
INSERT INTO `countries` VALUES ('Viet Nam', 'VN', 'VNM');
INSERT INTO `countries` VALUES ('Virgin Islands (British)', 'VG', 'VGB');
INSERT INTO `countries` VALUES ('Virgin Islands (U.S.)', 'VI', 'VIR');
INSERT INTO `countries` VALUES ('Wallis and Futuna Islands', 'WF', 'WLF');
INSERT INTO `countries` VALUES ('Western Sahara', 'EH', 'ESH');
INSERT INTO `countries` VALUES ('Yemen', 'YE', 'YEM');
INSERT INTO `countries` VALUES ('Yugoslavia', 'YU', 'YUG');
INSERT INTO `countries` VALUES ('Zaire', 'ZR', 'ZAR');
INSERT INTO `countries` VALUES ('Zambia', 'ZM', 'ZMB');
INSERT INTO `countries` VALUES ('Zimbabwe', 'ZW', 'ZWE');

-- --------------------------------------------------------

-- 
-- Table structure for table `states`
-- 

CREATE TABLE `states` (
  `zone_code` varchar(32) NOT NULL default '',
  `zone_name` varchar(32) NOT NULL default '',
  `country` char(3) default NULL,
  PRIMARY KEY  (`zone_code`,`zone_name`),
  KEY `country` (`country`),
  KEY `zone_code` (`zone_code`)
) TYPE=MyISAM;

-- 
-- Dumping data for table `states`
-- 

INSERT INTO `states` VALUES ('AL', 'Alabama', 'USA');
INSERT INTO `states` VALUES ('AK', 'Alaska', 'USA');
INSERT INTO `states` VALUES ('AS', 'American Samoa', 'USA');
INSERT INTO `states` VALUES ('AZ', 'Arizona', 'USA');
INSERT INTO `states` VALUES ('AR', 'Arkansas', 'USA');
INSERT INTO `states` VALUES ('AF', 'Armed Forces Africa', 'USA');
INSERT INTO `states` VALUES ('AA', 'Armed Forces Americas', 'USA');
INSERT INTO `states` VALUES ('AC', 'Armed Forces Canada', 'USA');
INSERT INTO `states` VALUES ('AE', 'Armed Forces Europe', 'USA');
INSERT INTO `states` VALUES ('AM', 'Armed Forces Middle East', 'USA');
INSERT INTO `states` VALUES ('AP', 'Armed Forces Pacific', 'USA');
INSERT INTO `states` VALUES ('CA', 'California', 'USA');
INSERT INTO `states` VALUES ('CO', 'Colorado', 'USA');
INSERT INTO `states` VALUES ('CT', 'Connecticut', 'USA');
INSERT INTO `states` VALUES ('DE', 'Delaware', 'USA');
INSERT INTO `states` VALUES ('DC', 'District of Columbia', 'USA');
INSERT INTO `states` VALUES ('FM', 'Federated States Of Micronesia', 'USA');
INSERT INTO `states` VALUES ('FL', 'Florida', 'USA');
INSERT INTO `states` VALUES ('GA', 'Georgia', 'USA');
INSERT INTO `states` VALUES ('GU', 'Guam', 'USA');
INSERT INTO `states` VALUES ('HI', 'Hawaii', 'USA');
INSERT INTO `states` VALUES ('ID', 'Idaho', 'USA');
INSERT INTO `states` VALUES ('IL', 'Illinois', 'USA');
INSERT INTO `states` VALUES ('IN', 'Indiana', 'USA');
INSERT INTO `states` VALUES ('IA', 'Iowa', 'USA');
INSERT INTO `states` VALUES ('KS', 'Kansas', 'USA');
INSERT INTO `states` VALUES ('KY', 'Kentucky', 'USA');
INSERT INTO `states` VALUES ('LA', 'Louisiana', 'USA');
INSERT INTO `states` VALUES ('ME', 'Maine', 'USA');
INSERT INTO `states` VALUES ('MH', 'Marshall Islands', 'USA');
INSERT INTO `states` VALUES ('MD', 'Maryland', 'USA');
INSERT INTO `states` VALUES ('MA', 'Massachusetts', 'USA');
INSERT INTO `states` VALUES ('MI', 'Michigan', 'USA');
INSERT INTO `states` VALUES ('MN', 'Minnesota', 'USA');
INSERT INTO `states` VALUES ('MS', 'Mississippi', 'USA');
INSERT INTO `states` VALUES ('MO', 'Missouri', 'USA');
INSERT INTO `states` VALUES ('MT', 'Montana', 'USA');
INSERT INTO `states` VALUES ('NE', 'Nebraska', 'USA');
INSERT INTO `states` VALUES ('NV', 'Nevada', 'USA');
INSERT INTO `states` VALUES ('NH', 'New Hampshire', 'USA');
INSERT INTO `states` VALUES ('NJ', 'New Jersey', 'USA');
INSERT INTO `states` VALUES ('NM', 'New Mexico', 'USA');
INSERT INTO `states` VALUES ('NY', 'New York', 'USA');
INSERT INTO `states` VALUES ('NC', 'North Carolina', 'USA');
INSERT INTO `states` VALUES ('ND', 'North Dakota', 'USA');
INSERT INTO `states` VALUES ('MP', 'Northern Mariana Islands', 'USA');
INSERT INTO `states` VALUES ('OH', 'Ohio', 'USA');
INSERT INTO `states` VALUES ('OK', 'Oklahoma', 'USA');
INSERT INTO `states` VALUES ('OR', 'Oregon', 'USA');
INSERT INTO `states` VALUES ('PW', 'Palau', 'USA');
INSERT INTO `states` VALUES ('PA', 'Pennsylvania', 'USA');
INSERT INTO `states` VALUES ('PR', 'Puerto Rico', 'USA');
INSERT INTO `states` VALUES ('RI', 'Rhode Island', 'USA');
INSERT INTO `states` VALUES ('SC', 'South Carolina', 'USA');
INSERT INTO `states` VALUES ('SD', 'South Dakota', 'USA');
INSERT INTO `states` VALUES ('TN', 'Tennessee', 'USA');
INSERT INTO `states` VALUES ('TX', 'Texas', 'USA');
INSERT INTO `states` VALUES ('UT', 'Utah', 'USA');
INSERT INTO `states` VALUES ('VT', 'Vermont', 'USA');
INSERT INTO `states` VALUES ('VI', 'Virgin Islands', 'USA');
INSERT INTO `states` VALUES ('VA', 'Virginia', 'USA');
INSERT INTO `states` VALUES ('WA', 'Washington', 'USA');
INSERT INTO `states` VALUES ('WV', 'West Virginia', 'USA');
INSERT INTO `states` VALUES ('WI', 'Wisconsin', 'USA');
INSERT INTO `states` VALUES ('WY', 'Wyoming', 'USA');
INSERT INTO `states` VALUES ('AB', 'Alberta', 'CAN');
INSERT INTO `states` VALUES ('BC', 'British Columbia', 'CAN');
INSERT INTO `states` VALUES ('MB', 'Manitoba', 'CAN');
INSERT INTO `states` VALUES ('NF', 'Newfoundland', 'CAN');
INSERT INTO `states` VALUES ('NB', 'New Brunswick', 'CAN');
INSERT INTO `states` VALUES ('NS', 'Nova Scotia', 'CAN');
INSERT INTO `states` VALUES ('NT', 'Northwest Territories', 'CAN');
INSERT INTO `states` VALUES ('NU', 'Nunavut', 'CAN');
INSERT INTO `states` VALUES ('ON', 'Ontario', 'CAN');
INSERT INTO `states` VALUES ('PE', 'Prince Edward Island', 'CAN');
INSERT INTO `states` VALUES ('QC', 'Quebec', 'CAN');
INSERT INTO `states` VALUES ('SK', 'Saskatchewan', 'CAN');
INSERT INTO `states` VALUES ('YT', 'Yukon Territory', 'CAN');
INSERT INTO `states` VALUES ('NDS', 'Niedersachsen', 'DEU');
INSERT INTO `states` VALUES ('BAW', 'Baden-WÃ¼rttemberg', 'DEU');
INSERT INTO `states` VALUES ('BAY', 'Bayern', 'DEU');
INSERT INTO `states` VALUES ('BER', 'Berlin', 'DEU');
INSERT INTO `states` VALUES ('BRG', 'Brandenburg', 'DEU');
INSERT INTO `states` VALUES ('BRE', 'Bremen', 'DEU');
INSERT INTO `states` VALUES ('HAM', 'Hamburg', 'DEU');
INSERT INTO `states` VALUES ('HES', 'Hessen', 'DEU');
INSERT INTO `states` VALUES ('MEC', 'Mecklenburg-Vorpommern', 'DEU');
INSERT INTO `states` VALUES ('NRW', 'Nordrhein-Westfalen', 'DEU');
INSERT INTO `states` VALUES ('RHE', 'Rheinland-Pfalz', 'DEU');
INSERT INTO `states` VALUES ('SAR', 'Saarland', 'DEU');
INSERT INTO `states` VALUES ('SAS', 'Sachsen', 'DEU');
INSERT INTO `states` VALUES ('SAC', 'Sachsen-Anhalt', 'DEU');
INSERT INTO `states` VALUES ('SCN', 'Schleswig-Holstein', 'DEU');
INSERT INTO `states` VALUES ('THE', 'ThÃ¼ringen', 'DEU');
INSERT INTO `states` VALUES ('WI', 'Wien', 'AUT');
INSERT INTO `states` VALUES ('NO', 'NiederÃ¶sterreich', 'AUT');
INSERT INTO `states` VALUES ('OO', 'OberÃ¶sterreich', 'AUT');
INSERT INTO `states` VALUES ('SB', 'Salzburg', 'AUT');
INSERT INTO `states` VALUES ('KN', 'KÃ¤rnten', 'AUT');
INSERT INTO `states` VALUES ('ST', 'Steiermark', 'AUT');
INSERT INTO `states` VALUES ('TI', 'Tirol', 'AUT');
INSERT INTO `states` VALUES ('BL', 'Burgenland', 'AUT');
INSERT INTO `states` VALUES ('VB', 'Voralberg', 'AUT');
INSERT INTO `states` VALUES ('AG', 'Aargau', 'CHE');
INSERT INTO `states` VALUES ('AI', 'Appenzell Innerrhoden', 'CHE');
INSERT INTO `states` VALUES ('AR', 'Appenzell Ausserrhoden', 'CHE');
INSERT INTO `states` VALUES ('BE', 'Bern', 'CHE');
INSERT INTO `states` VALUES ('BL', 'Basel-Landschaft', 'CHE');
INSERT INTO `states` VALUES ('BS', 'Basel-Stadt', 'CHE');
INSERT INTO `states` VALUES ('FR', 'Freiburg', 'CHE');
INSERT INTO `states` VALUES ('GE', 'Genf', 'CHE');
INSERT INTO `states` VALUES ('GL', 'Glarus', 'CHE');
INSERT INTO `states` VALUES ('JU', 'GraubÃ¼nden', 'CHE');
INSERT INTO `states` VALUES ('JU', 'Jura', 'CHE');
INSERT INTO `states` VALUES ('LU', 'Luzern', 'CHE');
INSERT INTO `states` VALUES ('NE', 'Neuenburg', 'CHE');
INSERT INTO `states` VALUES ('NW', 'Nidwalden', 'CHE');
INSERT INTO `states` VALUES ('OW', 'Obwalden', 'CHE');
INSERT INTO `states` VALUES ('SG', 'St. Gallen', 'CHE');
INSERT INTO `states` VALUES ('SH', 'Schaffhausen', 'CHE');
INSERT INTO `states` VALUES ('SO', 'Solothurn', 'CHE');
INSERT INTO `states` VALUES ('SZ', 'Schwyz', 'CHE');
INSERT INTO `states` VALUES ('TG', 'Thurgau', 'CHE');
INSERT INTO `states` VALUES ('TI', 'Tessin', 'CHE');
INSERT INTO `states` VALUES ('UR', 'Uri', 'CHE');
INSERT INTO `states` VALUES ('VD', 'Waadt', 'CHE');
INSERT INTO `states` VALUES ('VS', 'Wallis', 'CHE');
INSERT INTO `states` VALUES ('ZG', 'Zug', 'CHE');
INSERT INTO `states` VALUES ('ZH', 'ZÃ¼rich', 'CHE');
INSERT INTO `states` VALUES ('A CoruÃ±a', 'A CoruÃ±a', 'ESP');
INSERT INTO `states` VALUES ('Alava', 'Alava', 'ESP');
INSERT INTO `states` VALUES ('Albacete', 'Albacete', 'ESP');
INSERT INTO `states` VALUES ('Alicante', 'Alicante', 'ESP');
INSERT INTO `states` VALUES ('Almeria', 'Almeria', 'ESP');
INSERT INTO `states` VALUES ('Asturias', 'Asturias', 'ESP');
INSERT INTO `states` VALUES ('Avila', 'Avila', 'ESP');
INSERT INTO `states` VALUES ('Badajoz', 'Badajoz', 'ESP');
INSERT INTO `states` VALUES ('Baleares', 'Baleares', 'ESP');
INSERT INTO `states` VALUES ('Barcelona', 'Barcelona', 'ESP');
INSERT INTO `states` VALUES ('Burgos', 'Burgos', 'ESP');
INSERT INTO `states` VALUES ('Caceres', 'Caceres', 'ESP');
INSERT INTO `states` VALUES ('Cadiz', 'Cadiz', 'ESP');
INSERT INTO `states` VALUES ('Cantabria', 'Cantabria', 'ESP');
INSERT INTO `states` VALUES ('Castellon', 'Castellon', 'ESP');
INSERT INTO `states` VALUES ('Ceuta', 'Ceuta', 'ESP');
INSERT INTO `states` VALUES ('Ciudad Real', 'Ciudad Real', 'ESP');
INSERT INTO `states` VALUES ('Cordoba', 'Cordoba', 'ESP');
INSERT INTO `states` VALUES ('Cuenca', 'Cuenca', 'ESP');
INSERT INTO `states` VALUES ('Girona', 'Girona', 'ESP');
INSERT INTO `states` VALUES ('Granada', 'Granada', 'ESP');
INSERT INTO `states` VALUES ('Guadalajara', 'Guadalajara', 'ESP');
INSERT INTO `states` VALUES ('Guipuzcoa', 'Guipuzcoa', 'ESP');
INSERT INTO `states` VALUES ('Huelva', 'Huelva', 'ESP');
INSERT INTO `states` VALUES ('Huesca', 'Huesca', 'ESP');
INSERT INTO `states` VALUES ('Jaen', 'Jaen', 'ESP');
INSERT INTO `states` VALUES ('La Rioja', 'La Rioja', 'ESP');
INSERT INTO `states` VALUES ('Las Palmas', 'Las Palmas', 'ESP');
INSERT INTO `states` VALUES ('Leon', 'Leon', 'ESP');
INSERT INTO `states` VALUES ('Lleida', 'Lleida', 'ESP');
INSERT INTO `states` VALUES ('Lugo', 'Lugo', 'ESP');
INSERT INTO `states` VALUES ('Madrid', 'Madrid', 'ESP');
INSERT INTO `states` VALUES ('Malaga', 'Malaga', 'ESP');
INSERT INTO `states` VALUES ('Melilla', 'Melilla', 'ESP');
INSERT INTO `states` VALUES ('Murcia', 'Murcia', 'ESP');
INSERT INTO `states` VALUES ('Navarra', 'Navarra', 'ESP');
INSERT INTO `states` VALUES ('Ourense', 'Ourense', 'ESP');
INSERT INTO `states` VALUES ('Palencia', 'Palencia', 'ESP');
INSERT INTO `states` VALUES ('Pontevedra', 'Pontevedra', 'ESP');
INSERT INTO `states` VALUES ('Salamanca', 'Salamanca', 'ESP');
INSERT INTO `states` VALUES ('Santa Cruz de Tenerife', 'Santa Cruz de Tenerife', 'ESP');
INSERT INTO `states` VALUES ('Segovia', 'Segovia', 'ESP');
INSERT INTO `states` VALUES ('Sevilla', 'Sevilla', 'ESP');
INSERT INTO `states` VALUES ('Soria', 'Soria', 'ESP');
INSERT INTO `states` VALUES ('Tarragona', 'Tarragona', 'ESP');
INSERT INTO `states` VALUES ('Teruel', 'Teruel', 'ESP');
INSERT INTO `states` VALUES ('Toledo', 'Toledo', 'ESP');
INSERT INTO `states` VALUES ('Valencia', 'Valencia', 'ESP');
INSERT INTO `states` VALUES ('Valladolid', 'Valladolid', 'ESP');
INSERT INTO `states` VALUES ('Vizcaya', 'Vizcaya', 'ESP');
INSERT INTO `states` VALUES ('Zamora', 'Zamora', 'ESP');
INSERT INTO `states` VALUES ('Zaragoza', 'Zaragoza', 'ESP');
        
