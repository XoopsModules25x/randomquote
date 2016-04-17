#
# Table structure for table `randomquote_quotes` (6 fields)
#

CREATE TABLE `randomquote_quotes` (
  `id`            INT(11)      NOT NULL AUTO_INCREMENT,
  `quote`         TEXT         NOT NULL,
  `author`        VARCHAR(255) NOT NULL DEFAULT '',
  `quote_status`  INT(10)      NOT NULL DEFAULT '0',
  `quote_waiting` INT(10)      NOT NULL DEFAULT '0',
  `quote_online`  TINYINT(1)   NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
)
  ENGINE =MyISAM;
