# core
PHP RESTful Web Service

## Create the database "php_service_test"

-- ----------------------------
-- Table structure for `customer`
-- ----------------------------
```sql
DROP TABLE IF EXISTS `customer`;

CREATE TABLE `customer` (

  `idCustommer` int(11) NOT NULL AUTO_INCREMENT,
    `firstNameCustommer` varchar(50) NOT NULL,
  `lastNameCustommer` varchar(100) NOT NULL,
  `emailCustommer` varchar(50) NOT NULL,
  `addressCustommer` varchar(50) NOT NULL,
  `cityCustommer` varchar(50) NOT NULL,
  `countryCustommer` varchar(50) NOT NULL,
  PRIMARY KEY (`idCustommer`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES ('1', 'Albert', 'Richard', 'albert.richard@gmail.com', '54, rue Royale', 'Nantes', 'France');
INSERT INTO `customer` VALUES ('2', 'Furt', 'Franck', 'Frankfurt@gmail.com', 'Lyonerstr. 34', 'Frankfurt', 'Germany');
INSERT INTO `customer` VALUES ('3', 'Lin', 'tchin', 'tLin@gmail.com', 'Bronz Sok.', 'Singapore', 'Singapore');
INSERT INTO `customer` VALUES ('4', 'Newton', 'Steeve', 'Allentsteeve@gmail.com', '7586 Pompton St.', 'Allentown', 'USA');
```

##### You can add a user with using POST:
http://127.0.0.1/core/api.php?tag=insert&fname=William&lname=Smith&email=w.smith@yahoo.com&adr=Dalas22th&city=Dalas&country=USA

You should get this output JSON message:
{
  "status": "200 OK",
  "state": 1,
  "return": "5"
}

If there is an error during registration, it gives this output JSON:
{
  "status": "406 Not Acceptable",
  "state": 0,
  "return": ""
}
##### Get all customers with using POST:
http://127.0.0.1/core/api.php?tag=customers
