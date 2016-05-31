#
# Table structure for table `randomquote_quotes` (5 fields)
#

CREATE TABLE `randomquote_quotes` (
  `id`           INT(11)      NOT NULL AUTO_INCREMENT,
  `quote`        TEXT         NOT NULL,
  `author`       VARCHAR(255) NOT NULL DEFAULT '',
  `quote_status` INT(10)      NOT NULL DEFAULT 0,
  `create_date`  TIMESTAMP    NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id`),
  KEY (`quote_status`)
)
  ENGINE = MyISAM;
