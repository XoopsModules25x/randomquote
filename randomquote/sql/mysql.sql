#
# Table structure for table `citas`
#

CREATE TABLE citas (
  id int(11) NOT NULL auto_increment,
  texto varchar(255) NOT NULL default '',
  autor varchar(255) NOT NULL default '',
  PRIMARY KEY  (id),
) ENGINE=MyISAM;

