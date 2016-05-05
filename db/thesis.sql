-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 23, 2013 at 04:49 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thesis`
--
CREATE DATABASE IF NOT EXISTS `thesis` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `thesis`;

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `action` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `score` int(11) NOT NULL,
  `description` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`action`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`action`, `score`, `description`) VALUES
('buy', 4, 'User click button "Mua ngay"'),
('search', 1, 'search item'),
('viewDetail', 2, 'Click and view the detail of item');

-- --------------------------------------------------------

--
-- Table structure for table `authassignment`
--

CREATE TABLE IF NOT EXISTS `authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authitem`
--

CREATE TABLE IF NOT EXISTS `authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authitem`
--

INSERT INTO `authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 2, '', NULL, 'N;'),
('banned', 2, '', NULL, 'N;'),
('createUser', 0, 'create a new user', NULL, 'N;'),
('deleteUser', 0, 'remove a user from system', NULL, 'N;'),
('member', 2, '', NULL, 'N;'),
('readUser', 0, 'read user profile information', NULL, 'N;'),
('updateUser', 0, 'update a users information', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `authitemchild`
--

CREATE TABLE IF NOT EXISTS `authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authitemchild`
--

INSERT INTO `authitemchild` (`parent`, `child`) VALUES
('member', 'banned'),
('admin', 'createUser'),
('admin', 'deleteUser'),
('admin', 'member'),
('banned', 'readUser'),
('member', 'updateUser');

-- --------------------------------------------------------

--
-- Table structure for table `behaviour`
--

CREATE TABLE IF NOT EXISTS `behaviour` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `action` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `itemID` int(11) NOT NULL,
  `times` int(11) NOT NULL DEFAULT '1',
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `userID` (`userID`),
  KEY `action` (`action`),
  KEY `itemID` (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`ID`, `Name`) VALUES
(3, 'Quán ăn'),
(4, 'Spa và Làm đẹp'),
(5, 'Phụ kiện và Mỹ Phẩm'),
(6, 'Thời trang nữ'),
(7, 'Thời trang nam'),
(8, 'Góc gia đình'),
(9, 'Thực phẩm'),
(10, 'Trẻ em'),
(11, 'Sách và truyện'),
(12, 'Điện máy'),
(13, 'Khóa học và đi chơi'),
(14, 'Điện - Điện tử');

-- --------------------------------------------------------

--
-- Table structure for table `categoryurl`
--

CREATE TABLE IF NOT EXISTS `categoryurl` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `WebsiteID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  `LocationID` int(11) NOT NULL,
  `URL` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `CategoryName` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `WebsiteID` (`WebsiteID`),
  KEY `CategoryID` (`CategoryID`),
  KEY `CategoryName` (`CategoryName`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `categoryurl`
--

INSERT INTO `categoryurl` (`ID`, `WebsiteID`, `CategoryID`, `LocationID`, `URL`, `CategoryName`) VALUES
(13, 24, 3, 3, 'http://www.nhommua.com/tp-ho-chi-minh/cafe-am-thuc/', 'Quán ăn'),
(14, 24, 13, 3, 'http://www.nhommua.com/tp-ho-chi-minh/hotel-tour/', ''),
(15, 24, 4, 3, 'http://www.nhommua.com/tp-ho-chi-minh/lam-dep/', ''),
(16, 24, 5, 3, 'http://www.nhommua.com/tp-ho-chi-minh/san-pham/', ''),
(17, 24, 13, 3, 'http://www.nhommua.com/tp-ho-chi-minh/dich-vu-gia-re.html', ''),
(18, 24, 13, 4, 'http://www.nhommua.com/ha-noi/hotel-tour/', ''),
(19, 24, 3, 4, 'http://www.nhommua.com/ha-noi/cafe-am-thuc/', ''),
(20, 24, 4, 4, 'http://www.nhommua.com/ha-noi/lam-dep/', ''),
(21, 24, 5, 4, 'http://www.nhommua.com/ha-noi/san-pham/', ''),
(23, 24, 13, 4, 'http://www.nhommua.com/ha-noi/dich-vu-gia-re.html', ''),
(24, 14, 3, 3, 'http://www.muachung.com/tp-ho-chi-minh/nha-hang', '');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Value` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`ID`, `Name`, `Value`) VALUES
(1, 'numOfBestPriceViaMail', '3'),
(2, 'numOfBestInterestedViaMail', '3'),
(3, 'numOfUserUserViaMail', '4');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `response` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'new',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`ID`, `name`, `email`, `message`, `response`, `status`, `date`) VALUES
(40, 'Nguyễn Văn An', 'an.cse09@gmail.com', 'Tôi muốn sản phẩm của website chúng tôi được hiển thị trên hệ thống tìm kiếm của anh/chị', '', 'viewed', '2013-12-19 08:20:46'),
(41, 'Nguyễn Hoàng Thiện', 'tinypro1410@gmail.com', 'Website bị lỗi hiển thị tại URL ......', '', 'new', '2013-12-19 08:22:25');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Website` int(11) NOT NULL,
  `Category` int(11) NOT NULL,
  `Name` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Price` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `OriginalPrice` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Purchases` int(10) NOT NULL,
  `URL` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ImageURL` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Location` int(11) NOT NULL,
  `Address` varchar(500) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Description` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Condition` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `Category` (`Category`),
  KEY `Website` (`Website`),
  KEY `Location` (`Location`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=543 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ID`, `Website`, `Category`, `Name`, `Price`, `OriginalPrice`, `Purchases`, `URL`, `ImageURL`, `Location`, `Address`, `Description`, `Condition`, `Update`) VALUES
(515, 14, 11, '5 tập Bé khám phá thế giới xung quanh+6 tập tô màu', '82000', '137000', 23, 'http://muachung.vn/sach-truyen/5-tap-be-kham-pha-the-gioi-xung-quanh-6-tap-to-mau-45207.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/46/3/qqrbh/5-tap-be-kham-pha-the-gioi-xung-quanh-6-tap-to-mau.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\n* Chỉ với 82.000đ sở hữu bộ sách giúp\r\nbé học tiếng Anh và khám phá thế giới cùng sách tô màu do\r\nCông ty TNHH Văn Hóa Hương Thủy phát hành - Tiết kiệm\r\n41% so với giá trị thực là 137.000đ.\r\n* Bộ 5 cuốn Bé\r\nkhám phá thế giới xung quanh – song ngữ\r\nViệt-Anh dành cho các bé lứa\r\ntuổi mầm non (2+) giúp bé làm quen với những đồ vật, sự vật gần gũi\r\nquanh mình, biết được đặc điểm, công dụng của từng sự vật đó đồng\r\nthời học các tên gọi bằng tiếng Anh của chúng.\r\n* Bộ sách được thiết kế bằng bìa cứng, in\r\ntranh màu đẹp mắt sẽ cuốn hút, hấp dẫn các bé thêm hứng thú khám\r\nphá.\r\n* 5 cuốn gồm: Hoa, Nhạc cụ, Gia vị, Thức ăn,\r\nĐộng vật biển.\r\nSách có chất lượng in đẹp, khổ 15x15cm, giá\r\nbìa 13.000đ/cuốn.\r\n* Túi 6 cuốn tập tô màu theo\r\ncác chủ đề nhân vật hoạt hình, động vật, phong cảnh, giao thông để\r\nbé thỏa sức sáng tạo trong thế giới sắc màu, giúp bé tinh mắt, quan\r\nsát tốt, và phát huy sáng tạo.\r\nBộ túi in đẹp, giá bìa 72.000đ.\r\n* Công ty TNHH Văn Hóa Hương Thủy là nhà cung\r\ncấp.\r\n \r\n \r\n \r\n  \r\n', '\r\nĐiều kiện sử dụng\r\n\r\n* Hết hạn lấy hàng: 10/11/2013\r\nTại Hà Nội: Nhận hàng\r\nngay tại VP Muachung.\r\nTại Đà Nẵng nhận sách từ\r\nngày 18/10/2013. Tại Hải\r\nPhòng nhận sách từ ngày 14/10/2013. Địa chỉ VP Muachung các\r\ntỉnh xem tại phần Chi tiết sản phẩm.\r\n* Thời gian nhận hàng: 8h - 18h thứ 2 đến thứ\r\n6 và sáng thứ 7. Riêng VPGD Muachung 152 Phó Đức Chính, HN mở\r\ncửa từ 8h-18h30 từ Thứ 2 đến Thứ 7 hàng tuần.\r\n* Phí giao sách tận nơi:\r\n15.000đ/Cuốn.\r\n* Chỉ áp dụng cho KH tại HN,\r\nĐà Nẵng, Hải Phòng.\r\n\r\n', '2013-10-26 05:25:49'),
(516, 14, 11, 'Giúp bạn hiểu vị trí của mình trong nền kinh tế', '83000', '105000', 26, 'http://muachung.vn/sach-truyen/bo-sach-cua-alan-phan-mot-tu-duy-khac-ve-kinh-te-44856.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/45/9/rcsgd/bo-sach-cua-alan-phan-mot-tu-duy-khac-ve-kinh-te.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\n \r\n* 2 cuốn trong bộ sách của Tiến sĩ\r\nAlan Phan - Doanh nhân Việt kiều đầu tiên đưa công ty tư nhân của\r\nmình lên sàn chứng khoán Mỹ vào năm 1987, với kinh nghiệm kinh\r\ndoanh 42 năm ở Mỹ và Trung Quốc.\r\n* Một tư duy\r\nkhác về Kinh tế và Xã hội Việt Nam\r\nlà cuốn sách Tiến sĩ Alan Phan bày tỏ những góc\r\nnhìn mới về Việt Nam đặc biệt ở 2 lĩnh vực kinh tế và xã hội, khẳng\r\nđịnh những tiềm năng và nghị lực của người Việt Nam hoàn toàn có\r\nthể đưa đến thành công và sự giàu có, nhưng điều gì đã khiến người\r\nViệt chưa thể phát huy hết mình?\r\n* Cuốn là sự kết nối của những suy nghĩ và\r\nnhận định được Tiến sĩ ghi lại qua từng năm tháng từ năm 2009 đến\r\n2011.\r\nSách bìa mềm, dày 183 trang, khổ 14,5x20,5cm,\r\ngiá bìa 50.000đ.\r\n* Đừng hoang\r\ntưởng về biển lớn là cuốn\r\nsách Tiến sĩ Alan Phan viết lên từ kinh nghiệm bản thân mình đã làm\r\nkinh doanh nhiều năm ở nước ngoài muốn giúp cho các doanh nhân Việt\r\nNam cần ý thức phải thay đổi tư duy đã quen thuộc khi bước chân ra\r\nkinh doanh trên trường quốc tế.\r\n* Văn phong sâu lắng, nhưng không kém phần hóm\r\nhỉnh, viết về kinh tế mà sinh động, thú vị, chứ không hề cứng nhắc\r\nkhô khan, vốn đã thân quen với những độc giả “ruột” của Góc nhìn\r\nAlan.\r\nSách bìa mềm, dày 210 trang, khổ 14.5x20,5cm, giá bìa\r\n55.000đ.\r\n* Sách có chất lượng in và chất lượng giấy ở\r\nmức khá.\r\n* Sách do Công ty CP sách Thái Hà là nhà cung\r\ncấp.\r\n \r\n \r\n \r\n \r\n \r\n  \r\n', '\r\nĐiều kiện sử dụng\r\n\r\n* Hết hạn lấy hàng: 10/11/2013\r\nTại Hà Nội: Nhận hàng\r\nngay tại VP Muachung.\r\nTại Đà Nẵng nhận sách từ\r\nngày 17/10/2013. Tại Hải\r\nPhòng nhận sách từ ngày 12/10/2013. Địa chỉ VP Muachung các\r\ntỉnh xem tại phần Chi tiết sản phẩm.\r\n* Thời gian nhận hàng: 8h - 18h thứ 2 đến thứ\r\n6 và sáng thứ 7. Riêng VPGD Muachung 152 Phó Đức Chính, HN mở\r\ncửa từ 8h-18h30 từ Thứ 2 đến Thứ 7 hàng tuần.\r\n* Phí giao sách tận nơi:10.000đ/Bộ\r\nsách.\r\n* Chỉ áp dụng cho KH tại HN,\r\nHải Phòng, Đà Nẵng.\r\n\r\n', '2013-10-26 05:25:51'),
(517, 14, 11, 'Em ở bên ai cũng đều là khoảng trống trong anh', '70000', '99000', 13, 'http://muachung.vn/sach-truyen/em-o-ben-ai-cung-deu-la-khoang-trong-trong-anh-45095.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/46/1/1dnlh/em-o-ben-ai-cung-deu-la-khoang-trong-trong-anh.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\n* Sở hữu cuốn tiểu thuyết tình cảm đặc\r\nsắc Em ở bên ai cũng là khoảng trống trong anh do Cty CP\r\nvăn hóa và truyền thông Phương Đông phát hành, chỉ với 70.000đ - Tiết kiệm\r\n30% so với giá trị thực là 99.000đ.\r\n* Là cuốn tiểu thuyết nồng\r\nnàn, sâu sắc khác hẳn những tác phẩm ngôn tình êm ái hiện\r\nnay.\r\n* Tác giả Trần Ai đã khắc họa một câu\r\nchuyện tình giữa “cha” và “con” như khắc vào tâm khảm, cùng cuộc\r\nđấu tranh vượt qua khoảng cách thời gian để họ tìm được\r\nnhau.\r\nDịch giả Thanh Loan, sách bìa mềm, dày 366\r\ntrang, khổ 13,5x20,5cm.\r\n* Chất lượng in và chất lượng giấy ở mức\r\nkhá.\r\n* Do Cty CP văn hóa và truyền thông Phương\r\nĐông là nhà cung cấp.\r\n', '\r\nĐiều kiện sử dụng\r\n\r\n* Hết hạn lấy hàng: 09/11/2013\r\nTại Hà Nội, HCM: Nhận\r\nsách ngay tại VP Muachung.\r\nTại Nha Trang, Vũng Tàu nhận\r\nsách từ ngày 12/10/2013.\r\nĐịa chỉ VP Muachung các tỉnh xem tại phần Chi tiết sản phẩm.\r\n* Thời gian nhận hàng: 8h - 18h thứ 2 đến thứ\r\n6 và sáng thứ 7. Riêng Muachung 152 Phó Đức Chính, HN\r\nmở cửa từ 8h-18h30 từ Thứ 2 đến Thứ 7 hàng tuần.\r\n* Phí giao sách tận nơi:\r\n10.000đ/Cuốn.\r\n* Chỉ áp dụng cho KH tại HN,\r\nHCM, Nha Trang, Vũng Tàu.\r\n\r\n', '2013-10-26 05:25:51'),
(518, 14, 11, 'Hình ảnh Đại tướng trong lòng sử gia người Pháp', '85000', '101000', 64, 'http://muachung.vn/sach-truyen/vo-nguyen-giap-44960.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/45/10/c1qxs/vo-nguyen-giap.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\n* Sở hữu cuốn sách ý\r\nnghĩa về vị Đại tướng suốt đời của nhân dân Việt Nam, hoặc tặng bạn\r\nbè người thân để lưu giữ một kỷ niệm về vị anh hùng vĩ đại của dân\r\ntộc trong thế kỷ 20.\r\n* Cuốn sách lần đầu ra mắt\r\nnăm 1977, được giới sử học Pháp đánh giá là một trong những cuốn\r\nsách giá trị nhất viết về Võ Nguyên Giáp, nhà quân sự lỗi lạc, vị\r\ntướng lĩnh tài ba, nhân vật nổi bật của lịch sử hiện đại Việt Nam\r\nvà thế giới thế kỷ 20.\r\n* Cuốn sách được tác giả\r\nviết từ góc nhìn của một người đã trực tiếp trải nghiệm và\r\ntham gia vào hàng ngũ chiến đấu cùng Việt Nam thể hiện\r\ntình cảm kính trọng đối với người anh hùng của nhân dân Việt\r\nNam.\r\n* Sách được tác giả viết như tiểu sử của một\r\nnhà quân sự lớn, bên cạnh đó còn có những phân tích khoa học, gửi\r\ngắm nhiều điều tâm đắc đối với lịch sử Việt Nam hiện đại và Đại\r\ntướng Võ Nguyên Giáp.\r\n* Sách do dịch giả Nguyễn Văn Sự chuyển ngữ,\r\ndày 251 trang, bìa mềm, khổ 15,5x24cm, có kèm nhiều ảnh tư\r\nliệu về cuộc đời Đại tướng.\r\n* Chất lượng in đẹp, chất lượng giấy ở mức\r\nkhá.\r\n* Sách do NXB Thế Giới và Công ty CP sách Thái\r\nHà liên kết phát hành. Công ty CP sách Thái Hà là nhà cung\r\ncấp.\r\n \r\n \r\n \r\n  \r\n', '\r\nĐiều kiện sử dụng\r\n\r\n* Hết hạn lấy hàng: 08/11/2013\r\nTại Hà Nội: Nhận hàng\r\nngay tại VP Muachung.\r\nTại Đà Nẵng nhận sách từ\r\nngày 16/10/2013. Tại Hải\r\nPhòng nhận sách từ ngày 11/10/2013. Địa chỉ VP Muachung các\r\ntỉnh xem tại phần Chi tiết sản phẩm.\r\n* Thời gian nhận hàng: 8h - 18h thứ 2 đến thứ\r\n6 và sáng thứ 7. Riêng VPGD Muachung 152 Phó Đức Chính, HN mở\r\ncửa từ 8h-18h30 từ Thứ 2 đến Thứ 7 hàng tuần.\r\n* Phí giao sách tận nơi:10.000đ/Bộ\r\nsách.\r\n* Chỉ áp dụng cho KH tại HN,\r\nHải Phòng, Đà Nẵng.\r\n\r\n', '2013-10-26 05:25:52'),
(519, 14, 11, '100 câu chuyện về các nàng công chúa Wandisney', '92000', '120000', 27, 'http://muachung.vn/sach-truyen/100-cau-chuyen-ve-cac-nang-cong-chua-44576.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/45/6/co9nl/100-cau-chuyen-ve-cac-nang-cong-chua.png', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\n* Hãy tặng các bé gái dễ thương cuốn\r\n100 câu chuyện về các nàng công chúa\r\nbé gái nên đọc (tập 1) do NXB Mỹ Thuật phát\r\nhành. Chỉ với 92.000đ.\r\n* 100 truyện là những câu\r\nchuyện viết tiếp về các nàng công chúa nổi tiếng trong các truyện\r\ncổ tích đã được hàng Wandisney dựng thành phim hoạt hình,\r\ntập 1 kể truyện về: Nàng tiên cá Ariel, Aurora - công\r\nchúa ngủ trong rừng, Hoa Mộc Lan, Jamine - nàng công chúa Ba Tư vợ\r\ncủa Aladdin.\r\n* Các nàng công chúa trong những câu chuyện cố\r\ntích quen thuộc, lại tiếp tục cuộc sống hạnh phúc của mình như thế\r\nnào sẽ khơi gợi trí tò mò và cuốn hút các bé say mê theo\r\ndõi.\r\n* Cuốn sách là những câu chuyện thắp\r\nsáng tuổi thơ của các bé gái và phần nào giúp bé thỏa mãn giấc mơ\r\nđược là nàng công chúa xinh đẹp của mình.\r\n*Truyện bìa cứng, in màu, với nhiều hình minh\r\nhọa từ phim hoạt hình hết sức sống động, sách dày 207 trang, khổ\r\n17x25cm.\r\n* Nhà sách Minh Thắng (thuộc công ty Minh Tân\r\nBooks) là nhà cung cấp.\r\n \r\n \r\n \r\n  \r\n', '\r\nĐiều kiện sử dụng\r\n\r\n* Hết hạn lấy hàng: 07/11/2013\r\nTại Hà Nội: Nhận hàng\r\nngay tại VP Muachung.\r\nTại Đà Nẵng nhận sách từ\r\nngày 15/10/2013. Tại Hải\r\nPhòng nhận sách từ ngày 10/10/2013. Địa chỉ VP Muachung các\r\ntỉnh xem tại phần Chi tiết sản phẩm.\r\n* Thời gian nhận hàng: 8h - 18h thứ 2 đến thứ\r\n6 và sáng thứ 7. Riêng VPGD Muachung 152 Phó Đức Chính, HN mở\r\ncửa từ 8h-18h30 từ Thứ 2 đến Thứ 7 hàng tuần.\r\n* Phí giao sách tận nơi:\r\n10.000đ/Cuốn.\r\n* Chỉ áp dụng cho Khách\r\nhàng tại HN, Hải Phòng, Đà Nẵng.\r\n\r\n', '2013-10-26 05:25:53'),
(521, 14, 11, 'Từ điển không thể thiếu của người học tiếng Anh', '103000', '158000', 35, 'http://muachung.vn/sach-truyen/tu-dien-anh-anh-viet-va-viet-anh-44575.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/45/6/26gd7/tu-dien-anh-anh-viet-va-viet-anh.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\n* Chỉ với 103.000đ sở hữu\r\ncuốn Từ điển Anh – Anh – Việt, Việt –\r\nAnh do NXB Thời Đại và nhà sách Minh Thắng phát hành\r\n– Tiết kiệm 35% so với giá bìa\r\n158.000đ.\r\n* Từ điển Anh –\r\nAnh – Việt, Việt – Anh gồm 2 phần Anh\r\n– Anh – Việt và Việt Anh rất thiết thực và hữu ích đối với người\r\nhọc và sử dụng tiếng Anh.\r\n* Sử dụng phiên âm mới nhất, các từ được định\r\nnghĩa và giải thích rõ ràng, có hướng dẫn cách dùng đúng từ trong\r\ntiếng Anh. Trình bày dễ hiểu cập nhật.\r\nPhần 1: Anh – Anh – Việt gồm 300.000\r\ntừ.\r\nPhần 2: Việt – Anh gồm 275.000 từ.\r\n* Sách dày 1354 trang, khổ 13x19cm, bìa cứng,\r\nkèm thêm bảng động từ bất quy\r\ntắc.\r\n* Chất lượng in và chất lượng giấy ở mức khá,\r\ndo nhà sách Minh Thắng là nhà cung cấp.\r\n \r\n \r\n  \r\n', '\r\nĐiều kiện sử dụng\r\n\r\n* Hết hạn lấy hàng: 06/11/2013\r\nTại Hà Nội, HCM: Nhận\r\nhàng ngay tại VP Muachung.\r\nTại Đà Nẵng nhận sách từ\r\nngày 14/10/2013. Tại Hải\r\nPhòng nhận sách từ ngày 09/10/2013. Tại Nha Trang,\r\nVũng Tàu nhận hàng từ ngày 12/10/2013. Địa chỉ VP Muachung các\r\ntỉnh xem tại phần Chi tiết sản phẩm.\r\n* Thời gian nhận hàng: 8h - 18h thứ 2 đến thứ\r\n6 và sáng thứ 7. Riêng VPGD Muachung 152 Phó Đức Chính, HN mở\r\ncửa từ 8h-18h30 từ Thứ 2 đến Thứ 7 hàng tuần.\r\n* Phí giao sách tận nơi:\r\n15.000đ/Cuốn.\r\n* Chỉ áp dụng cho Khách\r\nhàng tại các tỉnh có VP Muachung.\r\n\r\n', '2013-10-26 05:25:54'),
(522, 14, 13, 'Ốp silicon bảo vệ iphone 5/4/4S', '60000', '100000', 49, 'http://muachung.vn/dien-may/redeal-op-silicon-bao-ve-iphone-5-4-4a-41810-46242.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/47/3/033pp/redeal-op-silicon-bao-ve-iphone-5-4-4a-41810.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nỐp lưng Silicon cao cấp\r\ndành cho iPhone 5/4/4S. Kiểu dáng thời trang, hiện đại, là món\r\nphụ kiện sành điệu\r\nNắp đậy màn hình cảm ứng thông\r\nminh giúp người sử dụng có thể sử dụng chức năng cảm ứng\r\nngay cả khi nắp được đậy trên màn hình.\r\nVỏ mỏng ôm gọn chiếc điện thoại,\r\nchống trầy xước mặt lưng, đường viền và cả mặt cảm ứng của\r\niPhone.\r\nXuất xứ: Trung\r\nQuốc\r\nChất liệu: Silicon dẻo mềm,\r\nêm, chắc chắn. Màu sắc: Trắng,\r\nđen\r\nCó 02 mẫu: mẫu dài (12cmx6cm) cho\r\niphone 5 và mẫu ngắn (11,3cmx6cm) cho iPhone 4/4S\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n01/12/2013.\r\n01 phiếu đổi được 01 sản\r\nphẩm.\r\nĐịa chỉ nhận\r\nhàng: VP Mua Chung Hà\r\nNội (Xem địa chỉ trong phần thông tin chi\r\ntiết)\r\nGiờ mở cửa: 8h -\r\n18h30 ( thứ 2 - sáng thứ 7)\r\nPhí giao hàng tận nơi: 10.000đ/1 sản phẩm\r\nChỉ áp dụng cho khách\r\nhàng tại Hà Nội\r\n\r\n', '2013-10-26 05:26:33'),
(524, 14, 13, 'Tai nghe cao cấp iphone ipod, ipad', '89000', '180000', 35, 'http://muachung.vn/dien-may/redeal-redeal-redeal-redeal-redeal-tai-nghecao-ca-p-iphone-ipod-ipad-35672-38280-40193-41535-44561-46241.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/47/3/ns8i6/redeal-redeal-redeal-redeal-redeal-tai-nghecao-ca-p-iphone-ipod-ipad-35672-38280-40193-41535-44561.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nTai Nghe iPhone/iPod/iPad tinh\r\ntế\r\nTai nghe dành riêng cho các dòng iPhone\r\n(3/4/5) và các dòng iPod, iPad (1/2/3/4/mini) của\r\nApple.\r\nTai nghe thiết kế đẹp mắt, vừa vặn êm tai,\r\nmàu trắng đặc trưng.\r\nSản phẩm được thiết kế hai màng loa độc đáo,\r\ncho âm thanh stereo to, rõ và thật với âm Bass, Treble sống động,\r\nthỏa thích thưởng thức âm nhạc mọi lúc mọi nơi với nút điều khiển\r\nđa năng thông minh.\r\n\r\nJack cắm chuẩn 3.5\r\nXuất xứ: Trung Quốc\r\n\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy\r\nhàng:\r\n01/12/2013.\r\n01 phiếu đổi\r\nđược 01 sản phẩm.\r\nĐịa chỉ nhận\r\nhàng: 04 VP MuaChung (Xem địa chỉ và thời gian làm việc\r\ncuối bài).\r\nPhí giao hàng tận nơi:\r\n10.000đ/01 sản\r\nphẩm.\r\nÁp dụng với khách\r\nhàng tại Hà Nội\r\n\r\n', '2013-10-26 05:26:34'),
(525, 14, 13, 'Pin dự phòng chính hãng YooBao 2200Mah-YB6101', '255000', '325000', 11, 'http://muachung.vn/dien-may/pin-du-phong-chinh-hang-yoobao-2200mah-yb6101-45402.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/46/5/t4x0i/pin-du-phong-chinh-hang-yoobao-2200mah-yb6101.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nDùng để sạc cho hầu hết các loại\r\nmáy điện thoại có kết nối cổng USB như: iPhone, iPad, Mp3, Samsung,\r\nNokia, Motorola, Sonyericson, Htc, ...\r\nDung lượng lưu trữ: 2200mah (Giúp\r\nkéo dài thêm thời gian sử dụng 1 lần cho các máy như iPhone,\r\nSamsung Galaxy S1, Nokia E71, HTC ...)\r\nBảo hành chính hãng 1 đổi 1 trong\r\nvòng 12 tháng.\r\nCam kết hàng chính hãng\r\nYoobao (Hàng nhái của Yoobao và nhiều thương hiệu không uy\r\ntín với dùng dung lượng 2200mah chỉ giúp kéo dài thêm thơi gian sử\r\ndụng 0.2-0.5 lần cho iPhone). Đáp ứng mọi chuẩn về sự an toàn, có\r\ngiấy chứng nhận CE, FC và ROHS.\r\nNăm bóng đèn LED hiển thị mức\r\nđiện ra. Đèn chiếu sáng LED tới 110 giờ.\r\nMàu sắc: Trắng. Tặng\r\nkèm 1 túi đựng chính hãng Yoobao.\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n30/11/2013.\r\n01 phiếu đổi\r\nđược 01 sản phẩm. \r\nPhí giao hàng tận nơi:\r\n10.000đ/01 sản phẩm.\r\n     Áp dụng cho khách hàng tại Hà\r\nNội.\r\n\r\n', '2013-10-26 05:26:35'),
(526, 14, 13, 'Chăm sóc sức khỏe gia đình bạn với Cân điện tử', '159000', '310000', 49, 'http://muachung.vn/dien-may/cham-soc-suc-khoe-gia-dinh-ban-voi-can-dien-tu-45582.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/46/6/ovjj3/cham-soc-suc-khoe-gia-dinh-ban-voi-can-dien-tu.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nCân sức khỏe điện tử  dễ sử\r\ndụng, độ chính xác cao, thích hợp cho cả người lớn và trẻ em. Kiểu\r\ndáng thể thao sang trọng mỏng đẹp ưu nhìn.\r\nSử dụng công nghệ cảm biến, mặt\r\nkiếng chịu lực, chịu nhiệt trong suốt 6 ly. \r\nMàn hình LCD, hiển thị rõ ràng,\r\nnhỏ gọn, có nhiều đơn vị cân để\r\nlựa chọn: kg / lb\r\nTải trọng tối đa: 180kg. Độ chính\r\nxác: 0.1kg\r\nXuất xứ: Trung\r\nQuốc.\r\nBảo hành 1 tháng, đổi mới trong\r\nvòng 1 tuần nếu phát sinh lỗi do nhà sản xuất\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHạn lấy sản phẩm: 29/11/2013.\r\n01 phiếu đổi được 01 sản phẩm\r\nĐịa chỉ nhận\r\nhàng: 04 VP\r\nMuaChung\r\n Lưu ý: sản phẩm không giao hàng tận\r\nnơi.\r\nGiờ nhận: 8h - 18h từ thứ 2 đến thứ\r\n7\r\nĐịa chỉ bảo\r\nhành:\r\nShop Hoàng Huy: 147 Đội Cấn, Ba\r\nĐÌnh, Hà Nội.\r\nHotline: 0904953908.\r\nChỉ áp dụng với khách hàng tại Hà\r\nNội.\r\n\r\n', '2013-10-26 05:26:36'),
(527, 14, 13, 'Ấm siêu tốc 2 lớp Meide1,8L tiết kiệm điện', '140000', '200000', 26, 'http://muachung.vn/dien-may/am-sieu-toc-2-lop-meide1-8l-tiet-kiem-dien-45803.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/46/9/24qj8/am-sieu-toc-2-lop-meide1-8l-tiet-kiem-dien.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nẤm điện\r\nsiêu tốc 2 lớp Meide 1,8L - Sản phẩm hiện đại, tiện dụng,\r\nsiêu tiết kiệm thời gian và rất an toàn.\r\nSản phẩm thông minh với chức năng\r\nngắt điện tự động, giúp đảm bảo sự an toàn cho cả gia đình\r\nbạn.\r\nThích hợp sử dụng ở nơi công sở,\r\nkhách sạn, nhà nghỉ, trường học hoặc là trong các hộ gia\r\nđình.\r\nXuất\r\nxứ: Trung Quốc.\r\nDung\r\ntích: 1,8L.\r\nKích\r\nthước: Chiều cao 24cm, Đường kính đế\r\n16,5cm.\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n27/11/2013.\r\n01 phiếu đổi\r\nđược 01 sản phẩm. \r\nPhí giao hàng tận nơi:\r\n15.000đ/01 sản phẩm.\r\nChỉ áp dụng khách\r\nhàng tại Hà Nội.\r\n\r\n', '2013-10-26 05:26:37'),
(528, 14, 13, 'Máy tập cơ bụng 6 lò xo - mẫu mới nhất 2013', '770000', '1000000', 31, 'http://muachung.vn/dien-may/may-tap-co-bung-6-lo-xo-mau-moi-nhat-2013-43615.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/44/7/9axxz/may-tap-co-bung-6-lo-xo-mau-moi-nhat-2013.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\n01 Máy xoay tập cơ bụng\r\nADrocket 6 lò xo - thế hệ mới\r\nChức\r\nnăng: Phẳng bụng, eo thon, giúp cơ bụng săn chắc\r\ntuyệt vời. Đặc biệt, làm giảm đau cổ, gáy, ngăn ngừa các chứng bệnh\r\nvề cột sống -những bệnh thường gặp của giới văn phòng.\r\nVới công nghệ trợ lực của dây kéo\r\ngiúp bạn dễ dàng thực hiện các động tác trong quá trình tập\r\nluyện\r\nXuất xứ: Trung\r\nQuốc. Màu sắc: đen + đỏ\r\nKích thước máy:Cao 66cm, Rộng\r\n61cm, Dài 57cm . Trọng\r\nlượng:7,5kg. Trọng lượng tối đa người\r\ntập: 125kg.\r\nSản phẩm nhỏ, gọn, dễ cất giữ, dễ\r\ndàng tập luyện mọi lúc, mọi nơi, là món quà ý nghĩa để\r\nbạn lựa chọn là quà biếu, quà tặng người thân.\r\nBảo hành: 3\r\ntháng\r\nBộ sản phẩm gồm: máy tập + đĩa\r\nCD\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n23/11/2013.\r\n01 phiếu đổi 01 sản\r\nphẩm.\r\nĐịa chỉ nhận\r\nhàng: 04 Vp Muachung Hà Nội (Xem địa chỉ, giờ mở cửa\r\ncác VP bên dưới\r\nMuachung không giao hàng tận\r\nnơi. \r\nÁp dụng cho khách\r\nhàng tại Hà Nội\r\nSố điện thoại liên hệ của\r\nnhà cung cấp: 0915805666\r\n\r\n', '2013-10-26 05:26:38'),
(529, 14, 13, 'Pin sạc tích điện siêu tốc 5600mAh', '250000', '400000', 118, 'http://muachung.vn/dien-may/pin-sac-tich-dien-sieu-toc-5600mah-42021.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/43/1/j8s46/pin-sac-tich-dien-sieu-toc-5600mah.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\n\r\n\r\nPin sạc dự phòng Power Bank với thiết kế nhỏ\r\ngọn có thể bỏ vào túi, tiện lợi cầm đi mọi lúc mọi nơi\r\nkhi hết pin chỉ cần cắm vào ổ điện hoặc\r\nlaptop là có thể sạc lại.\r\nThời gian sạc đầy pin nhanh, thời gian trữ\r\npin lâu, độ bền cao cho bạn tha hồ trò chuyện, nghe nhạc, chơi\r\ngame, lướt web ở những nơi công cộng mà ko có nguồn\r\nđiện.\r\nCó 4 đầu sạc thay thế có thể sạc được cho các\r\ndòng điện thoại như iPhone, HTC, LG, Sony, Samsung, Nokia... các\r\ndòng thiết bị số như máy Mp3, Mp4, iPad, iPod...\r\nDung lượng 5600mAh, có đèn báo dung lượng\r\npin. Ngoài chức năng sạc, pin sạc còn có chức năng làm đèn led\r\nchiếu sáng.\r\nCổng cắm sạc USB tiện lợi. Kích thước Chiều\r\ncao 8,7cm x Chiều rộng 5,5cm x Độ dầy 2,5cm.\r\n\r\nSản phẩm bảo hành 1\r\nđổi 1 trong vòng 3 tháng tại Số 7 ngõ 7 phố Mạc Thị Bưởi, Hai\r\nBà Trưng, Hà Nội - 0904865898.\r\nXuất xứ: Trung Quốc. Màu\r\nsắc: Xanh, Trắng.\r\n\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n11/11/2013.\r\n01 phiếu đổi\r\nđược 01 sản phẩm. \r\nĐịa chỉ nhận hàng: 04 VP\r\nMuaChung Hà Nội (Xem địa chỉ, giờ làm việc các VP cuối\r\nbài)\r\nPhí giao hàng tận nơi:\r\n10.000đ/01 sản phẩm.\r\nÁp dụng cho khách hàng tại Hà\r\nNội.\r\n\r\n', '2013-10-26 05:26:39'),
(530, 14, 13, 'Tự làm bánh ngon với Máy làm + nướng bánh Nikai', '240000', '400000', 1, 'http://muachung.vn/dien-may/tu-lam-banh-ngon-voi-may-lam-nuong-banh-nikai-46489.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/47/5/5ib4s/tu-lam-banh-ngon-voi-may-lam-nuong-banh-nikai.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nMáy làm và nướng Sandwich\r\n-  thiết kế thông minh và tiện\r\ndụng\r\nXuất\r\nxứ: Trung Quốc\r\nKhuôn bánh được mạ một lớp men\r\nchống dính màu đen. Các khuôn bánh có hình tam giác, xếp lại với\r\nnhau thành hình chữ nhật. Giữa các khuôn bánh có một đường ngăn\r\ncách.\r\nMáy thực hiện nướng một mẻ bánh\r\nchỉ mất từ 5-7 phút.\r\nSản phẩm bảo\r\nhành 1 tháng tại địa chỉ Nhà cung cấp (vui lòng xem cuối\r\nbài).\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n3/12/2013\r\n01 phiếu đổi được 01 sản\r\nphẩm.\r\nĐịa chỉ nhận hàng: 04 Văn phòng\r\nMuaChung Hà Nội\r\nThời gian nhận hàng: 08h-\r\n18h00 Từ thứ 2 đến sáng thứ 7.\r\nChỉ áp dụng với khách\r\nhàng tại Hà Nội. Không giao hàng tận nơi.\r\n\r\n', '2013-10-26 05:26:40'),
(531, 14, 13, 'Thiết bị định vị dẫn đường PND-EV2 cho ÔTô (39303)', '1990000', '3290000', 0, 'http://muachung.vn/dien-may/thiet-bi-dinh-vi-dan-duong-pnd-ev2-cho-oto-39303-46240.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/47/3/6ump9/thiet-bi-dinh-vi-dan-duong-pnd-ev2-cho-oto-39303.jpg', 3, 'Số 4 - Khu tập thể 27/7 Trung Kính ,Yên Hòa, Cầu Giấy, Hà\r\nNội ', '\r\nĐiểm nổi bật\r\nXuất xứ: Trung Quốc\r\nKích thước 135.2 x\r\n84.7 x 12.2mm (Dài x Rộng x Sâu)\r\nMàn hình có khả năng hiện thị 3D\r\nkhi dẫn đường, hỗ trợ eBook định dạng txt\r\nThiết bị PNVD - EV2 giúp bạn\r\ntìm kiếm lộ trình nhanh nhất và ngắn nhất từ vị trí hiện\r\ntại của bạn đến địa điểm cần đến. Nếu bạn đi sai, thiết bị\r\nsẽ ngay lập tức tự động tìm và thông báo lộ trình đúng cho\r\nbạn.\r\nThiết bị định vị PNVD - EV2\r\n còn giúp bạn yên tâm khi ngồi sau tay lái với tính năng thông\r\nminh thông báo địa điểm nguy hiểm như: đoạn đường\r\nthường xảy ra tai nạn, điểm bắn tốc độ và giới hạn tốc\r\nđộ.\r\nBảo hành: 12 tháng\r\ntại CÔNG TY TNHH NAVI\r\nINFO\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHạn sử dụng phiếu:\r\n02/12/2013\r\n01 voucher đổi được 01 thiết bị\r\nđịnh vị thông minh \r\nKhông có giá trị quy đổi thành\r\ntiền, không áp dụng cùng các chương trình khuyến mại\r\nkhác.\r\n Mỗi khách hàng được mua tối\r\nđa 3 Voucher\r\nKhách hàng không phải bù\r\nthêm tiền\r\nMiễn phí lắp đặt tại nhà\r\ncung cấp. Khách hàng muốn lắp đặt tại nhà vui lòng liên hệ\r\nnhà cung cấp để biết thông tin chi phí.\r\nVoucher đã bao gồm\r\nVAT.\r\nQuý khách vui lòng gọi điện thoại\r\ntrước để được phục vụ tốt nhất.\r\nCÔNG TY TNHH NAVI INFO\r\nĐịa chỉ: Số 4 - Khu tập thể 27/7 Trung Kính ,Yên\r\nHòa, Cầu Giấy, Hà Nội\r\nHotline: 0986423456 \r\nWebsite: http://www.naviinfo.com/\r\nGiờ mở cửa: 08h00 - 18h00 hàng ngày\r\n\r\n', '2013-10-26 05:26:40'),
(532, 14, 13, 'Thư giãn hiệu quả với Gối massage hồng ngoại', '550000', '800000', 0, 'http://muachung.vn/dien-may/thu-gian-hieu-qua-voi-goi-massage-hong-ngoai-42659.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/43/7/dur8n/thu-gian-hieu-qua-voi-goi-massage-hong-ngoai.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\n\r\nGối hồng ngoại massage được thiết kế gọn nhẹ,\r\ndễ sử dụng.\r\n\r\n\r\nGối được trang bị 4 mâm cầu xoay, có\r\nchức năng tạo nhiệt giúp việc massage tác động hiệu quả\r\nvào các cơ huyệt, các vùng cơ bắp đau, mỏi, tác động sâu vào huyệt,\r\nthúc đẩy lưu thông, tăng cường tuần hoàn máu. \r\n\r\n\r\nLàm giảm đau, giảm tình trạng căng cơ,\r\ngiúp thư giãn xua tan mệt mỏi.\r\n\r\n\r\nCó bảng điều khiển giúp dễ dàng điều chỉnh chế\r\nđộ massage.\r\n\r\n\r\nCó thể dùng để massage cho nhiều vị\r\ntrí trên cơ thể như: gáy, vai, lưng, bụng, đùi, bắp chân,\r\nbàn chân, bàn tay.\r\n\r\n\r\nThuận tiện để sử dụng tại văn phòng, nhà\r\nriêng, trên ôtô. \r\n\r\n\r\nChất liệu: Được làm từ nhựa tổng hợp và cao su\r\nrất an toàn.\r\n\r\n\r\nMàu sắc: Tím.\r\n\r\n\r\nXuất xứ: Trung Quốc.\r\n\r\n\r\nBảo hành: trong vòng 3 tháng và đổi hàng trong\r\n1 tuần kể từ ngày mua nếu phát sinh lỗi từ phía nhà sản xuất. Hàng\r\nđã mua không trả lại. \r\n\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy\r\nhàng: 1/12/2013\r\n01 phiếu đổi được 01 sản\r\nphẩm\r\nĐịa chỉ nhận\r\nhàng: VP Muachung Hà Nội\r\n Giờ nhận sản phẩm: 08h\r\n- 18h00 thứ 2 đến sáng thứ 7\r\nPhí giao hàng tận\r\nnơi 20.000đ/01 sản\r\nphẩm\r\nÁp dụng\r\ncho khách hàng tại Hà Nội\r\n\r\n', '2013-10-26 05:26:41'),
(533, 14, 13, 'Chuột game thủ YiSHE M300', '135000', '220000', 53, 'http://muachung.vn/dien-may/chuot-game-thu-yishe-m300-46239.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/47/3/dnv7y/chuot-game-thu-yishe-m300.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\n01 Chuột quang Yishe M300 - sản phẩm\r\ndành riêng cho game thủ\r\nChuột quang dành cho game thủ được thiết kế\r\nvới kiểu dáng đầy cá tính, hiện đại\r\nChuột với mắt Laser giúp chạy cực chuẩn trên\r\nmọi nền\r\nKích thước chuột to cũng là một ưu thế dành\r\ncho game thủ, chuột có chiều dài 10.5 cm cầm rất "đầm\r\ntay”\r\nCác nút bấm rất nảy tạo cảm giác "thật tay"\r\nkhi sử dụng\r\nXuất xứ: Trung Quốc\r\nMàu sắc đen - Loại: Chuột quang - Kiểu giao\r\ntiếp: USB - Số nút: 7 -  chiều dài dây xấp xỉ\r\n170cm\r\nBảo hành 1 năm\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n01/12/2013\r\n01 phiếu đổi được 01 sản\r\nphẩm.\r\nPhí giao hàng tận nơi\r\n10.000đ/sản phẩm\r\nĐịa chỉ nhận hàng: VP Mua\r\nChung (Xem địa chỉ trong phần thông tin chi\r\ntiết)\r\nGiờ mở cửa: 8h - 18h30 (\r\nthứ 2 -  thứ 7)\r\nÁp dụng cho khách hàng\r\ntại Hà Nội\r\n\r\n', '2013-10-26 05:26:42'),
(534, 14, 13, 'Máy sấy tóc Caige - 2 công tắc điều chỉnh', '125000', '200000', 6, 'http://muachung.vn/dien-may/may-say-toc-caige-2-cong-tac-dieu-chinh-45735.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/46/8/b5gag/may-say-toc-caige-2-cong-tac-dieu-chinh.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nXuất xứ: Trung Quốc.\r\nBảo hành 6 tháng tại 32/35 Lê Văn Lương, Hà\r\nNội.\r\nKích thước: Ống\r\nsấy dài: 20 cm, tay cầm: 15 cm\r\nCông tắc điều khiển đơn giản, dễ\r\nsử dụng với 2 chế độ điều khiển mức gió, sức nóng vừa\r\nphải, giúp tóc khô mượt, không xơ rối.\r\nMáy được thiết kế chống rò rỉ\r\nđiện nên rất an toàn khi sử dụng. Hơn nữa, máy được thiết kế với\r\ntốc độ gió cao, động cơ chạy rất êm không gây ồn trong quá trình\r\nsấy.\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n30/11/2013\r\n1 phiếu đổi được 01 sản phẩm.\r\nĐịa chỉ nhận sản phẩm: VP\r\nMuaChung Hà Nội\r\nGiờ nhận: 8h - 18h từ thứ 2 đến thứ 6 và sáng\r\nthứ 7.\r\nPhí giao hàng: 10.000đ/01 sản phẩm.\r\nChỉ áp dụng cho khách hàng tại Hà\r\nNội\r\n\r\n', '2013-10-26 05:26:42'),
(535, 14, 13, 'Sảng khoái với máy massage toàn thân Puli PL602', '192000', '330000', 2, 'http://muachung.vn/dien-may/sang-khoai-voi-may-massage-toan-than-puli-pl602-43775.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/44/8/zzgq1/sang-khoai-voi-may-massage-toan-than-puli-pl602.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nMáy massage toàn thân\r\nPuli PL602 tiện lợi và nhỏ gọn thiết kế thông minh, nhỏ gọn, đơn giản nhưng tiện dụng và rất\r\nhiệu quả.\r\nĐặc biệt máy có nút điều chỉnh\r\ntốc độ đa cấp độ, giúp bạn lựa chọn lực massage theo ý thích, máy\r\nmassage có thể đánh tan vùng mỡ tích tụ lâu ngày.\r\nMassage toàn bộ cơ thể của bạn\r\nnhư: hông, tay, đùi, cổ, đầu, lưng, mặt, bụng.. Có tác dụng lưu\r\nthông máu, tăng tính linh hoạt của làn da, làm săn chắc cơ\r\nbắp.\r\nKích thước máy: Chiều dài nhất\r\n19cm x Chiều rộng nhất 13cm x Đường kính đầu massage\r\n10,5cm.\r\nCông suất: 28W, Điện áp 220V ~\r\n50Hz.\r\nXuất\r\nxứ: Trung Quốc.\r\nBảo hành: 1 tháng với\r\nnhững lỗi từ phía nhà sản xuất tại địa chỉ Nhà cung cấp 147 Đội\r\nCấn, Ba Đình, Hà Nội - 0904953908 (Vui lòng liên hệ trước khi\r\nđến).\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n07/12/2013.\r\n01 phiếu đổi\r\nđược 01 sản phẩm. \r\nPhí giao hàng tận nơi:\r\n15.000đ/01 sản phẩm.\r\nChỉ áp dụng khách\r\nhàng tại Hà Nội.\r\n\r\n', '2013-10-26 05:26:43'),
(536, 14, 13, 'Tai nghe cao cấp cho Iphone 5', '90000', '200000', 41, 'http://muachung.vn/dien-may/tai-nghe-cao-cap-cho-iphone-5-45581.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/46/6/cy3e0/tai-nghe-cao-cap-cho-iphone-5.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nTai Nghe iPhone 5 tinh tế và đẳng\r\ncấp giảm giá\r\nXuất xứ: Trung Quốc\r\nMàu sắc: Trắng\r\nTai nghe dành riêng cho các dòng iPhone 5 của\r\nApple.\r\nThiết kế đẹp mắt, vừa vặn êm tai, hai\r\nmàng loa độc đáo, cho âm thanh stereo to, rõ và thật với âm Bass,\r\nTreble sống động, thỏa thích thưởng thức âm nhạc mọi lúc mọi\r\nnơi.\r\nChất lượng âm thanh chuẩn, sợi dây tốt hơn,\r\nbền hơn, đầu nhựa trắng sứ và chắc chắn tuyệt vời.\r\nTai nghe cao cấp iphone 5 sử dụng Jack 3.5 mm\r\ndùng cho iPhone cũng như các loại điện thoại sử dụng Jack 3.5\r\nkhác.\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy\r\nhàng:\r\n24/11/2013.\r\n01 phiếu đổi\r\nđược 01 sản phẩm.\r\nĐịa chỉ nhận\r\nhàng: 04 VP MuaChung (Xem địa chỉ và thời gian làm việc\r\ncuối bài).\r\nPhí giao hàng tận nơi:\r\n10.000đ/01 sản\r\nphẩm.\r\nBảo hành sản phẩm 01 đổi 01 trong\r\n01 tháng tại địa chỉ 35A Hàng Điếu - Hoàn kiếm - Hà Nôi ( với các\r\nlỗi về kĩ thuật, lỗi sản xuất, không bảo hành với các lỗi người\r\ndùng, phụ kiện Bảo hành phải còn nguyên vẹn hình thức ban\r\nđầu). \r\nÁp dụng với khách\r\nhàng tại Hà Nội\r\n\r\n', '2013-10-26 05:26:44'),
(537, 14, 13, 'Bộ cáp, sạc, tai nghe, miếng dán màn hình iPhone', '100000', '200000', 69, 'http://muachung.vn/dien-may/bo-cap-sac-tai-nghe-mieng-dan-man-hinh-iphone-45343.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/46/4/psumz/bo-cap-sac-tai-nghe-mieng-dan-man-hinh-iphone.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nBộ sản phẩm dùng cho\r\nIphone cực tiện lợi bao\r\ngồm: 01 Dây cáp + 01 Cục sạc + 01 Tai nghe + 02 Miếng\r\ndán màn hình (01 miếng cho 3G hoặc 3GS, 01 miếng cho Iphone 4G hoặc\r\n4S).\r\nBộ cáp sạc hỗ trợ cho tất cả các\r\ndòng iPhone: 3G, 3GS, 4G, 4S.\r\nTai nghe Jack 3.5 mm tích hợp\r\ndùng cho iPhone cũng như các loại điện thoại sử dụng Jack 3.5\r\nkhác. \r\n2 miếng dán màn hình 3\r\nlớp: Bảo vệ chống va chạm gây trầy xước màn hình, dễ dàng vệ\r\nsinh, Chống tia cực tím phát ra từ màn hình, Miếng dán được dính\r\nvào bề mặt màn hình bằng từ tính, không sử dụng keo,…\r\nXuất xứ:\r\nTrung Quốc.\r\nBảo hành sản phẩm 01 đổi\r\n01 trong vòng 01 tháng (Với các lỗi về kỹ thuật. Không bảo\r\nhành với các lỗi người dùng) tại iPhone 99 Online Shop - 35A Hàng\r\nĐiếu, Hà Nội.\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy\r\nhàng: 21/11/2013.\r\n\r\n01 phiếu đổi\r\nđược 01 bộ sản\r\nphẩm.\r\nPhí giao hàng tận nơi:\r\n10.000đ/01 sản\r\nphẩm.\r\nÁp\r\ndụng với khách hàng tại Hà Nội.\r\n\r\n', '2013-10-26 05:26:45'),
(538, 14, 13, 'Đèn led tích điện 26 bóng tiện lợi', '90000', '160000', 64, 'http://muachung.vn/dien-may/den-led-tich-dien-26-bong-tien-loi-45453.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/46/5/a5xv8/den-led-tich-dien-26-bong-tien-loi.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nDẹp tan nỗi lo mất điện\r\nvới Đèn led tích điện 26 bóng tiện dụng \r\nKích thước nhỏ gọn rất tiện lợi\r\nkhi mang theo trong những chuyến du lịch.\r\nLà vật dụng cần thiết cho người\r\ncao tuổi thường đi vệ sinh đêm.\r\nĐèn giúp bạn chiếu sáng khi cho\r\nbạn khi sửa chữa máy tính dưới gầm bàn, dưới gầm ô tô – những nơi\r\nthiếu ánh sáng\r\nCó 26 bóng đèn LED nhỏ\r\ntạo nên ánh đèn rất sáng, khi sạc đầy đèn có thể sáng tới 8\r\ngiờ.\r\nXuất xứ: Trung Quốc\r\nMàu sắc: Hồng, Xanh,\r\nTrắng.\r\n\r\nSản phẩm bảo hành 01\r\ntháng do lỗi kĩ thuật. 01 đổi 01 tại nhà cung cấp trong vòng 07\r\nngày.\r\n\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n21/11/2013.\r\n01 phiếu đổi\r\nđược 01 sản phẩm. \r\nĐịa chỉ nhận hàng: 04 VP MuaChung\r\nHà Nội.\r\nPhí giao hàng tận nơi:\r\n10.000đ/01 sản phẩm.\r\nÁp dụng cho khách hàng tại Hà\r\nNội.\r\n\r\n', '2013-10-26 05:26:46'),
(539, 14, 13, 'Bếp hồng ngoại Philiger XR20/JB2', '660000', '950000', 10, 'http://muachung.vn/dien-may/bep-hong-ngoai-philiger-xr20-jb2-44570.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/45/6/r7ar5/bep-hong-ngoai-philiger-xr20-jb2.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nBếp Philiger Model XR20/JB2, nhập\r\nkhẩu phân phối và bảo hành chính hãng tại Công ty TNHH MTV\r\nTM&DV Tân Hoàng Mai.\r\nMặt bếp cấu tạo bằng vật liệu\r\nchuyên biệt có độ bền cao, chịu được nhiệt độ lên tới\r\n650oC.\r\nMàu sắc: Trắng - Đen trang nhã.\r\nKích thước: 36cm x 28cm x 6cm (Dài x Rộng x Cao). Công suất:\r\n2000W. Nguồn điện:\r\n220V-50Hz\r\nHọa tiết hoa văn đẹp, trang nhã,\r\nđa chức năng (Chiên, xào, nấu Lẩu, nấu súp, đun nước, giữ ấm,\r\nkhoá phím, hẹn giờ)\r\nĐặc biệt bếp sử dụng được với tất\r\ncả các chất liệu nồi như: nồi inox, nồi thủy tinh...\r\nXuất xứ: Trung Quốc. Bảo hành\r\n18 tháng.\r\nTặng kèm 1 vỉ nướng tiện\r\ndụng.\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n30/11/2013.\r\n01 phiếu đổi\r\nđược 01 sản phẩm. \r\nĐịa chỉ nhận\r\nhàng: 04 VP MuaChung.\r\nLưu\r\ný: Muachung không giao hàng tận nơi, KH vui lòng nhận sản phẩm tại\r\n4 VP.\r\n\r\n', '2013-10-26 05:26:47'),
(540, 14, 13, 'Ấm siêu tốc 1,8L', '135000', '220000', 32, 'http://muachung.vn/dien-may/am-sieu-toc-1-8l-44558.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/45/6/27epq/am-sieu-toc-1-8l.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nẤm điện siêu tốc\r\nvới thiết kế hiện đại, kiểu dáng trang nhã, thích\r\nhợp sử dụng ở nơi công sở, khách sạn, nhà nghỉ, trường học hoặc là\r\ntrong các hộ gia đình.\r\nSản phẩm thông minh với chức năng\r\nngắt điện tự động, giúp đảm bảo sự an toàn cho cả gia đình\r\nbạn.\r\nDung\r\ntích: 1,8L.\r\nCông\r\nsuất: 220V ~ 50Hz\r\nCông suất\r\ntiêu thụ: 1000W.\r\nKích\r\nthước: Chiều cao 25cm, Đường kính đế\r\n15cm.\r\nXuất\r\nxứ: Trung Quốc.\r\n\r\nSản phẩm bảo hành 2 tháng, 1 đổi\r\n1 trong vòng 1 tuần tại CH Hoàng Huy - 147 Đội Cấn, Ba Đình, Hà Nội\r\n- 0904 953 908.\r\n\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n17/11/2013\r\n01 phiếu đổi\r\nđược 01 sản phẩm. \r\nĐịa chỉ nhận\r\nhàng: VP MuaChung (Xem địa chỉ, giờ làm việc\r\ncác VP bên dưới).\r\nPhí giao hàng tận nơi:\r\n15.000đ/01 sản phẩm.\r\nChỉ áp dụng khách\r\nhàng tại Hà Nội.\r\n\r\n', '2013-10-26 05:26:47'),
(541, 14, 13, 'Bếp hồng ngoại mặt đá cao cấp Hsakuji 1688', '740000', '1000000', 3, 'http://muachung.vn/dien-may/bep-hong-ngoai-mat-da-cao-cap-hsakuji-1688-44555.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/45/6/nyb1n/bep-hong-ngoai-mat-da-cao-cap-hsakuji-1688.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nBếp hồng ngoại mặt đá cao cấp\r\nHsaKuji Model 1688.\r\nBếp hồng ngoại HsaKuji 1688 được\r\nthiết kế với mặt bếp ceramic chống xước cùng công nghệ vi xử\r\nlí mới nhất, dễ dàng vệ sinh bếp sau khi dùng.\r\nMàu sắc: Đen - Vàng sang trọng.\r\nKích thước: 38cm x 31cm x 6cm (Dài x Rộng x Cao). Công suất:\r\n2000W. Nguồn điện:\r\n220V-50Hz\r\nHọa tiết hoa văn đẹp, trang nhã,\r\nđa chức năng (Chiên, xào, nấu Lẩu, nấu súp, đun nước, giữ ấm,\r\nkhoá phím, hẹn giờ)\r\nĐặc biệt bếp sử dụng được với tất\r\ncả các chất liệu nồi như: nồi inox, nồi thủy tinh... thay thế bếp\r\ngas.\r\nXuất xứ: Trung Quốc. Bảo hành\r\n3 tháng tại Shop Hoàng Huy - Số 14, Ngõ 147 Đội\r\nCấn, Ba Đình, Hà Nội - 0915 805 666.\r\nTặng kèm 1 vỉ nướng tiện\r\ndụng.\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n27/11/2013.\r\n01 phiếu đổi\r\nđược 01 sản phẩm. \r\nĐịa chỉ nhận\r\nhàng: 04 VP MuaChung.\r\nLưu\r\ný: Muachung không giao hàng tận nơi, Khách hàng vui lòng nhận\r\nsản phẩm tại 4 VP.\r\n\r\n', '2013-10-26 05:26:48'),
(542, 14, 13, 'Nồi áp suất đa năng KHAMAX Model KL 699', '690000', '1000000', 24, 'http://muachung.vn/dien-may/noi-ap-suat-da-nang-khamax-model-kl-699-42608.html', 'http://muachung10.vcmedia.vn/thumb_w/360/i:product/43/7/a9fel/noi-ap-suat-da-nang-khamax-model-kl-699.jpg', 3, 'Lô A31 - tổ 59 - ngõ 48 đường Nguyễn Chánh - phường Trung Hòa\r\n- Cầu Giấy - Hà Nội ', '\r\nĐiểm nổi bật\r\nNồi áp suất đa năng\r\nKHAMAX Model KL 699 loại 6 lít\r\nBộ sản phẩm gồm: 01\r\nnồi áp suất, 01 Thìa xới cơm, 01 ruột nồi, 01 cốc múc nước, 01 Dây\r\nđiện, 01 Sách hướng dẫn (Tiếng Việt + Tiếng Việt).\r\nCông suất: 1000w. Nguồn điện 220v - 50Hz.\r\nKích thước Chiều cao 33cm, Đường kính đáy nồi 26,5cm (cả tai\r\n33cm).\r\nLòng nồi inox cao cấp có độ bền cao, giữ\r\nnhiệt tốt, khi hầm xương sẽ mềm và cho vị ngon hơn.\r\nNồi áp suất Khamax được cài đặt\r\nchế độ nấu nhanh, bạn có thể hầm xương chỉ trong vòng 15 phút mà\r\nvẫn giữ được hương vị của thực phẩm. Công suất lên đến 1000W giúp\r\nthức ăn chín nhanh, tiết kiệm thời gian.\r\nSản phẩm được tích hợp nhiều chức\r\nnăng nấu tự động như nấu cơm, canh, cháo, hầm… cho phép bạn chế\r\nbiến nhiều món ăn dinh dưỡng cho gia đình. Bên cạnh đó dung tích\r\nlên đến 6L rất phù hợp với việc nấu ăn trong gia đình lớn và các\r\nbữa liên hoan bạn bè.\r\nNồi áp suất điện có thiết kế nút\r\nvặn điều khiển và đèn báo giúp bạn dễ dàng thao tác và theo dõi quá\r\ntrình chế biến. Nắp nồi có thể tháo rời thuận tiện cho việc lau\r\nchùi, bảo quản.\r\nXuất xứ: Trung Quốc sản xuất\r\ntheo công nghệ hiện đại của Nhật Bản.\r\nSản phẩm bảo hành 1\r\nnăm.\r\n', '\r\nĐiều kiện sử dụng\r\n\r\nHết hạn lấy hàng:\r\n13/11/2013.\r\n01 phiếu đổi\r\nđược 01 sản phẩm. \r\nĐịa chỉ nhận\r\nhàng: 04 VP MuaChung (Xem địa chỉ, giờ làm việc các VP\r\nbên dưới).\r\nLưu ý: Muachung không\r\ngiao hàng tận nơi, KH vui lòng nhận sản phẩm tại 4\r\nVP.\r\n\r\n', '2013-10-26 05:26:49');

-- --------------------------------------------------------

--
-- Table structure for table `itemitem`
--

CREATE TABLE IF NOT EXISTS `itemitem` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `itemID1` int(11) NOT NULL,
  `itemID2` int(11) NOT NULL,
  `ratings` float NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `userID` (`itemID1`),
  KEY `itemID` (`itemID2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Location` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`ID`, `Location`) VALUES
(3, 'Hồ Chí Minh'),
(4, 'Hà Nội'),
(5, 'Đà Nẵng'),
(6, 'Nha Trang'),
(7, 'Hải Phòng'),
(8, 'Vũng Tàu'),
(15, 'Qui Nhơn');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `URL` varchar(1000) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Message` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Code` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `File` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Line` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Trace` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Status` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'new',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=191 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`ID`, `URL`, `Message`, `Code`, `File`, `Line`, `Trace`, `Time`, `Status`) VALUES
(95, 'muachung.vn', 'Start crawling website Mua chung', '14', '', '', '', '2013-12-21 10:43:12', 'new'),
(96, 'muachung.vn', 'Finish crawling website Mua chung', '14', '', '', '', '2013-12-21 10:43:17', 'new'),
(97, 'http://www.nhommua.com', 'Start crawling website Nhóm mua', '24', '', '', '', '2013-12-21 10:43:17', 'new'),
(98, 'http://www.nhommua.com', 'Finish crawling website Nhóm mua', '24', '', '', '', '2013-12-21 10:43:51', 'new'),
(99, 'http://www.sieumua.com', 'Start crawling website Siêu mua', '36', '', '', '', '2013-12-21 10:43:51', 'new'),
(100, 'http://www.sieumua.com', 'Finish crawling website Siêu mua', '36', '', '', '', '2013-12-21 10:43:51', 'new'),
(101, 'http://www.hotdeal.vn', 'Start crawling website Hotdeal', '37', '', '', '', '2013-12-21 10:43:52', 'new'),
(102, 'http://www.hotdeal.vn', 'Finish crawling website Hotdeal', '37', '', '', '', '2013-12-21 10:43:52', 'new'),
(103, 'http://www.cungmua.com/', 'Start crawling website Cùng mua', '38', '', '', '', '2013-12-21 10:43:52', 'new'),
(104, 'http://www.cungmua.com/', 'Finish crawling website Cùng mua', '38', '', '', '', '2013-12-21 10:43:52', 'new'),
(105, 'http://www.runhau.vn', 'Start crawling website Rủ nhau', '39', '', '', '', '2013-12-21 10:43:52', 'new'),
(106, 'http://www.runhau.vn', 'Finish crawling website Rủ nhau', '39', '', '', '', '2013-12-21 10:43:52', 'new'),
(107, 'http://cohoimua.vn', 'Start crawling website Cơ hội mua', '40', '', '', '', '2013-12-21 10:43:52', 'new'),
(108, 'http://cohoimua.vn', 'Finish crawling website Cơ hội mua', '40', '', '', '', '2013-12-21 10:43:52', 'new'),
(109, 'http://www.lazada.vn/', 'Start crawling website Lazada', '41', '', '', '', '2013-12-21 10:43:52', 'new'),
(110, 'http://www.lazada.vn/', 'Finish crawling website Lazada', '41', '', '', '', '2013-12-21 10:43:52', 'new'),
(111, 'http://www.zalora.vn/', 'Start crawling website Zaloda', '42', '', '', '', '2013-12-21 10:43:52', 'new'),
(112, 'http://www.zalora.vn/', 'Finish crawling website Zaloda', '42', '', '', '', '2013-12-21 10:43:52', 'new'),
(113, 'http://www.sendo.vn/', 'Start crawling website Sendo', '43', '', '', '', '2013-12-21 10:43:52', 'new'),
(114, 'http://www.sendo.vn/', 'Finish crawling website Sendo', '43', '', '', '', '2013-12-21 10:43:52', 'new'),
(115, 'http://kay.vn/', 'Start crawling website Kay', '44', '', '', '', '2013-12-21 10:43:52', 'new'),
(116, 'http://kay.vn/', 'Finish crawling website Kay', '44', '', '', '', '2013-12-21 10:43:52', 'new'),
(117, 'http://baza.vn/', 'Start crawling website Baza', '46', '', '', '', '2013-12-21 10:43:52', 'new'),
(118, 'http://baza.vn/', 'Finish crawling website Baza', '46', '', '', '', '2013-12-21 10:43:52', 'new'),
(119, 'muachung.vn', 'Start crawling website Mua chung', '14', '', '', '', '2013-12-21 11:11:28', 'new'),
(120, 'muachung.vn', 'Finish crawling website Mua chung', '14', '', '', '', '2013-12-21 11:11:33', 'new'),
(121, 'http://www.nhommua.com', 'Start crawling website Nhóm mua', '24', '', '', '', '2013-12-21 11:11:34', 'new'),
(122, 'http://www.nhommua.com', 'Finish crawling website Nhóm mua', '24', '', '', '', '2013-12-21 11:12:11', 'new'),
(123, 'http://www.sieumua.com', 'Start crawling website Siêu mua', '36', '', '', '', '2013-12-21 11:12:11', 'new'),
(124, 'http://www.sieumua.com', 'Finish crawling website Siêu mua', '36', '', '', '', '2013-12-21 11:12:11', 'new'),
(125, 'http://www.hotdeal.vn', 'Start crawling website Hotdeal', '37', '', '', '', '2013-12-21 11:12:11', 'new'),
(126, 'http://www.hotdeal.vn', 'Finish crawling website Hotdeal', '37', '', '', '', '2013-12-21 11:12:11', 'new'),
(127, 'http://www.cungmua.com/', 'Start crawling website Cùng mua', '38', '', '', '', '2013-12-21 11:12:11', 'new'),
(128, 'http://www.cungmua.com/', 'Finish crawling website Cùng mua', '38', '', '', '', '2013-12-21 11:12:11', 'new'),
(129, 'http://www.runhau.vn', 'Start crawling website Rủ nhau', '39', '', '', '', '2013-12-21 11:12:11', 'new'),
(130, 'http://www.runhau.vn', 'Finish crawling website Rủ nhau', '39', '', '', '', '2013-12-21 11:12:11', 'new'),
(131, 'http://cohoimua.vn', 'Start crawling website Cơ hội mua', '40', '', '', '', '2013-12-21 11:12:12', 'new'),
(132, 'http://cohoimua.vn', 'Finish crawling website Cơ hội mua', '40', '', '', '', '2013-12-21 11:12:12', 'new'),
(133, 'http://www.lazada.vn/', 'Start crawling website Lazada', '41', '', '', '', '2013-12-21 11:12:12', 'new'),
(134, 'http://www.lazada.vn/', 'Finish crawling website Lazada', '41', '', '', '', '2013-12-21 11:12:12', 'new'),
(135, 'http://www.zalora.vn/', 'Start crawling website Zaloda', '42', '', '', '', '2013-12-21 11:12:12', 'new'),
(136, 'http://www.zalora.vn/', 'Finish crawling website Zaloda', '42', '', '', '', '2013-12-21 11:12:12', 'new'),
(137, 'http://www.sendo.vn/', 'Start crawling website Sendo', '43', '', '', '', '2013-12-21 11:12:12', 'new'),
(138, 'http://www.sendo.vn/', 'Finish crawling website Sendo', '43', '', '', '', '2013-12-21 11:12:12', 'new'),
(139, 'http://kay.vn/', 'Start crawling website Kay', '44', '', '', '', '2013-12-21 11:12:12', 'new'),
(140, 'http://kay.vn/', 'Finish crawling website Kay', '44', '', '', '', '2013-12-21 11:12:12', 'new'),
(141, 'http://baza.vn/', 'Start crawling website Baza', '46', '', '', '', '2013-12-21 11:12:12', 'new'),
(142, 'http://baza.vn/', 'Finish crawling website Baza', '46', '', '', '', '2013-12-21 11:12:12', 'new'),
(143, 'muachung.vn', 'Start crawling website Mua chung', '14', '', '', '', '2013-12-21 11:16:04', 'new'),
(144, 'muachung.vn', 'Finish crawling website Mua chung', '14', '', '', '', '2013-12-21 11:16:08', 'new'),
(145, 'http://www.nhommua.com', 'Start crawling website Nhóm mua', '24', '', '', '', '2013-12-21 11:16:08', 'new'),
(146, 'http://www.nhommua.com', 'Finish crawling website Nhóm mua', '24', '', '', '', '2013-12-21 11:16:44', 'new'),
(147, 'http://www.sieumua.com', 'Start crawling website Siêu mua', '36', '', '', '', '2013-12-21 11:16:44', 'new'),
(148, 'http://www.sieumua.com', 'Finish crawling website Siêu mua', '36', '', '', '', '2013-12-21 11:16:44', 'new'),
(149, 'http://www.hotdeal.vn', 'Start crawling website Hotdeal', '37', '', '', '', '2013-12-21 11:16:45', 'new'),
(150, 'http://www.hotdeal.vn', 'Finish crawling website Hotdeal', '37', '', '', '', '2013-12-21 11:16:45', 'new'),
(151, 'http://www.cungmua.com/', 'Start crawling website Cùng mua', '38', '', '', '', '2013-12-21 11:16:45', 'new'),
(152, 'http://www.cungmua.com/', 'Finish crawling website Cùng mua', '38', '', '', '', '2013-12-21 11:16:45', 'new'),
(153, 'http://www.runhau.vn', 'Start crawling website Rủ nhau', '39', '', '', '', '2013-12-21 11:16:45', 'new'),
(154, 'http://www.runhau.vn', 'Finish crawling website Rủ nhau', '39', '', '', '', '2013-12-21 11:16:45', 'new'),
(155, 'http://cohoimua.vn', 'Start crawling website Cơ hội mua', '40', '', '', '', '2013-12-21 11:16:45', 'new'),
(156, 'http://cohoimua.vn', 'Finish crawling website Cơ hội mua', '40', '', '', '', '2013-12-21 11:16:45', 'new'),
(157, 'http://www.lazada.vn/', 'Start crawling website Lazada', '41', '', '', '', '2013-12-21 11:16:45', 'new'),
(158, 'http://www.lazada.vn/', 'Finish crawling website Lazada', '41', '', '', '', '2013-12-21 11:16:45', 'new'),
(159, 'http://www.zalora.vn/', 'Start crawling website Zaloda', '42', '', '', '', '2013-12-21 11:16:45', 'new'),
(160, 'http://www.zalora.vn/', 'Finish crawling website Zaloda', '42', '', '', '', '2013-12-21 11:16:45', 'new'),
(161, 'http://www.sendo.vn/', 'Start crawling website Sendo', '43', '', '', '', '2013-12-21 11:16:45', 'new'),
(162, 'http://www.sendo.vn/', 'Finish crawling website Sendo', '43', '', '', '', '2013-12-21 11:16:45', 'new'),
(163, 'http://kay.vn/', 'Start crawling website Kay', '44', '', '', '', '2013-12-21 11:16:45', 'new'),
(164, 'http://kay.vn/', 'Finish crawling website Kay', '44', '', '', '', '2013-12-21 11:16:45', 'new'),
(165, 'http://baza.vn/', 'Start crawling website Baza', '46', '', '', '', '2013-12-21 11:16:45', 'new'),
(166, 'http://baza.vn/', 'Finish crawling website Baza', '46', '', '', '', '2013-12-21 11:16:45', 'new'),
(167, 'muachung.vn', 'Start crawling website Mua chung', '14', '', '', '', '2013-12-22 10:43:11', 'new'),
(168, 'muachung.vn', 'Finish crawling website Mua chung', '14', '', '', '', '2013-12-22 10:43:16', 'new'),
(169, 'http://www.nhommua.com', 'Start crawling website Nhóm mua', '24', '', '', '', '2013-12-22 10:43:16', 'new'),
(170, 'http://www.nhommua.com', 'Finish crawling website Nhóm mua', '24', '', '', '', '2013-12-22 10:43:52', 'new'),
(171, 'http://www.sieumua.com', 'Start crawling website Siêu mua', '36', '', '', '', '2013-12-22 10:43:52', 'new'),
(172, 'http://www.sieumua.com', 'Finish crawling website Siêu mua', '36', '', '', '', '2013-12-22 10:43:52', 'new'),
(173, 'http://www.hotdeal.vn', 'Start crawling website Hotdeal', '37', '', '', '', '2013-12-22 10:43:52', 'new'),
(174, 'http://www.hotdeal.vn', 'Finish crawling website Hotdeal', '37', '', '', '', '2013-12-22 10:43:52', 'new'),
(175, 'http://www.cungmua.com/', 'Start crawling website Cùng mua', '38', '', '', '', '2013-12-22 10:43:52', 'new'),
(176, 'http://www.cungmua.com/', 'Finish crawling website Cùng mua', '38', '', '', '', '2013-12-22 10:43:52', 'new'),
(177, 'http://www.runhau.vn', 'Start crawling website Rủ nhau', '39', '', '', '', '2013-12-22 10:43:52', 'new'),
(178, 'http://www.runhau.vn', 'Finish crawling website Rủ nhau', '39', '', '', '', '2013-12-22 10:43:52', 'new'),
(179, 'http://cohoimua.vn', 'Start crawling website Cơ hội mua', '40', '', '', '', '2013-12-22 10:43:52', 'new'),
(180, 'http://cohoimua.vn', 'Finish crawling website Cơ hội mua', '40', '', '', '', '2013-12-22 10:43:52', 'new'),
(181, 'http://www.lazada.vn/', 'Start crawling website Lazada', '41', '', '', '', '2013-12-22 10:43:52', 'new'),
(182, 'http://www.lazada.vn/', 'Finish crawling website Lazada', '41', '', '', '', '2013-12-22 10:43:53', 'new'),
(183, 'http://www.zalora.vn/', 'Start crawling website Zaloda', '42', '', '', '', '2013-12-22 10:43:53', 'new'),
(184, 'http://www.zalora.vn/', 'Finish crawling website Zaloda', '42', '', '', '', '2013-12-22 10:43:53', 'new'),
(185, 'http://www.sendo.vn/', 'Start crawling website Sendo', '43', '', '', '', '2013-12-22 10:43:53', 'new'),
(186, 'http://www.sendo.vn/', 'Finish crawling website Sendo', '43', '', '', '', '2013-12-22 10:43:53', 'new'),
(187, 'http://kay.vn/', 'Start crawling website Kay', '44', '', '', '', '2013-12-22 10:43:53', 'new'),
(188, 'http://kay.vn/', 'Finish crawling website Kay', '44', '', '', '', '2013-12-22 10:43:53', 'new'),
(189, 'http://baza.vn/', 'Start crawling website Baza', '46', '', '', '', '2013-12-22 10:43:53', 'new'),
(190, 'http://baza.vn/', 'Finish crawling website Baza', '46', '', '', '', '2013-12-22 10:43:53', 'new');

-- --------------------------------------------------------

--
-- Table structure for table `mostinterest`
--

CREATE TABLE IF NOT EXISTS `mostinterest` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `categoryID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `rating` float NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `categoryID` (`categoryID`),
  KEY `itemID` (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `password` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `role` varchar(64) NOT NULL,
  `lasttimeLogin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subscribe` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `username`, `password`, `email`, `role`, `lasttimeLogin`, `subscribe`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'an.cse09@gmail.com', 'admin', '2013-12-04 15:50:08', 1),
(2, 'anvnguyen', '2c405c8c90f38d6098fb6c86e791f192', 'anvnguyen@outlook.com', 'member', '2013-12-04 15:52:07', 0),
(3, 'tam.nguyen', '3bf39e24b3335845f60e75c09c06e1ce', 'tam.nguyen@yahoo.com', 'member', '2013-12-07 03:57:24', 1),
(4, 'thien.nguyen', '03367e73b0f369d71695ac09ff0fc35c', 'tinypro1410@gmail.com', 'member', '2013-12-07 03:58:09', 1),
(5, 'quang.nguyen', '1d1263f55418d3e81610d8fed836d39b', 'quang.nguyen@gmail.com', 'member', '2013-12-07 03:58:50', 1),
(6, 'huy.huynh', 'e8f7d814d1ae2e4b376f03680b703c2c', 'huy.huynh@gmail.com', 'member', '2013-12-07 03:59:16', 1),
(7, 'quang.nguyen', '1d1263f55418d3e81610d8fed836d39b', 'quang.nguyen@gmail.com', 'member', '2013-12-07 04:13:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `useritem`
--

CREATE TABLE IF NOT EXISTS `useritem` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `rating` double(11,3) NOT NULL,
  `sum` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `useruser`
--

CREATE TABLE IF NOT EXISTS `useruser` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `itemID` int(11) NOT NULL,
  `rating` float NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `userID` (`userID`),
  KEY `itemID` (`itemID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE IF NOT EXISTS `website` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `URL` varchar(100) CHARACTER SET utf16 COLLATE utf16_bin NOT NULL,
  `LastCrawl` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`ID`, `Name`, `URL`, `LastCrawl`) VALUES
(14, 'Mua chung', 'muachung.vn', '0000-00-00 00:00:00'),
(24, 'Nhóm mua', 'http://www.nhommua.com', '0000-00-00 00:00:00'),
(36, 'Siêu mua', 'http://www.sieumua.com', '0000-00-00 00:00:00'),
(37, 'Hotdeal', 'http://www.hotdeal.vn', '0000-00-00 00:00:00'),
(38, 'Cùng mua', 'http://www.cungmua.com/', '0000-00-00 00:00:00'),
(39, 'Rủ nhau', 'http://www.runhau.vn', '0000-00-00 00:00:00'),
(40, 'Cơ hội mua', 'http://cohoimua.vn', '0000-00-00 00:00:00'),
(41, 'Lazada', 'http://www.lazada.vn/', '0000-00-00 00:00:00'),
(42, 'Zaloda', 'http://www.zalora.vn/', '0000-00-00 00:00:00'),
(43, 'Sendo', 'http://www.sendo.vn/', '0000-00-00 00:00:00'),
(44, 'Kay', 'http://kay.vn/', '0000-00-00 00:00:00'),
(46, 'Baza', 'http://baza.vn/', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `xpath`
--

CREATE TABLE IF NOT EXISTS `xpath` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `URL` varchar(300) NOT NULL,
  `WebsiteID` int(11) NOT NULL,
  `Name` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Price` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `OriginalPrice` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ExpiredDate` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Purchases` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `ImageURL` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Address` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Description` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `Condition` varchar(300) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `WebsiteID` (`WebsiteID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `xpath`
--

INSERT INTO `xpath` (`ID`, `URL`, `WebsiteID`, `Name`, `Price`, `OriginalPrice`, `ExpiredDate`, `Purchases`, `ImageURL`, `Address`, `Description`, `Condition`) VALUES
(5, 'http://www.muachung.com/tp-ho-chi-minh/nha-hang/nha-hang-thai-taste-3256.html', 14, '//h2[@class=''pro-detail-name'']/strong', '//span[@class=''buy'']', '//p[@class=''text'']/del', '//div[@class=''pBottom10 lh20 deal_tos_info'']/ul/li/span/strong', '//div[@class=''main_view main-boxcontFull v3_SC_borderTop v3_SC_buyer pTop15 pBottom10'']/div[@class=''mainBlueBoxNew pTop10'']/ul/li/a/span', '//div[@class=''zoom-small-image slider-wrapper theme-default nivoSlider'']/a/img/attribute::src', '//span[@class=''delivery'']', '//div[@class=''subinfoInner'']/ul', '//div[@class=''tab-inner-text condition'']/ul'),
(6, 'http://www.nhommua.com/tp-ho-chi-minh/khach-san-resort/khach-san-ngoc-tung-riverside-7F02000105037C.html', 24, '//h1[@class=''title-dealdt'']', '//p[@class=''pro-price'']/span', '//p[@class=''save-price'']/del', '//div[@class=''pBottom10 lh20 deal_tos_info'']/ul/li/span/strong', '//div[@class=''count-buy more-city'']/p/span', '//div[@class=''thumbnail'']/ul/li/a/img/attribute::src', '//ul[@class=''points'']/li/p/span', '//li[@class=''liCond'']/div', '//ul[@class=''highlights-cond'']/li/div'),
(9, 'http://www.sieumua.com/the-nho-transcend-sdhc-class-4-8gb-gia-chi-co-145000d-voi-nhung-the-nho-dung-luong-lon-toc-do-cao-nay-ban-co-the-tha-ho-luu-giu-nhung-khoanh-khac-dang-nho.html', 36, '//div[@class=''tts-index'']/h1', '//span[@class=''price_value price'']', '//span[@class=''price-value'']/span[@class=''price'']', '', '//div[@class=''dealstatus totalcount'']/span[@class=''number'']', '//div[@class=''neoslideshow c28'']/img/attribute::src', '//div[@class=''company-details-content'']/div', '//div[@class=''reviewbox dkbox c41'']/div[@class=''dkbox-content'']/ul', '//div[@class=''reviewbox dkbox c41'']/div[@class=''dkbox-content'']/div/div[@class=''dkbox-content'']'),
(10, 'http://www.hotdeal.vn/ho-chi-minh/dao-tao-giai-tri/combo-2-ve-xem-phim-4d-world-rider-50713.html', 37, '//div[@class=''span6 product-info'']/h1[@class=''product-title'']', '//div[@class=''sell-price'']', '//div[@class=''list-price'']', '', '//div[@class=''buy-number'']', '//div[@class=''main-slider-content c17'']/ul[@class=''sliders-wrap-inner'']/li/img/attribute::src', '//div[@class=''address-box'']/div[@class=''address'']', '//div[@class=''span6 product-conditions'']', '//div[@class=''span6 product-feature'']'),
(11, 'http://www.cungmua.com/dich-vu-in-lich-treo-tuong-co-khung-nep-kho-30-x-40cm_p17920.html?cmpid=17920&cmps=category&cmpm=bannerlist&cmpc=banner2', 38, '//div[@class=''index_middle content Col_CC'']/div[@class=''L'']/h1', '//span[@class=''detail_price'']/span', '//span[@class=''detail_trueprice'']', '', '//span[@class="panel_text"]', '//div[@class="deal_img_big"]/img/attribute::src', '//ul[@class=''list_map'']/li/p', '//h2[@class=''deal_detail_name_long'']', '//h2[@class=''deal_detail_name_long'']'),
(12, 'http://www.runhau.vn/tp-ho-chi-minh/deal/4479-o-cam-dien-cao-cap-prota-an-toan-va-tiet-kiem-dien-sgs-241865-.html', 39, '//h2[@class=''deal-title'']', '//div[@class=''deal-info'']/a', '//div[@class=''deal-price'']/div/p/span', '', '//div[@class=''deal-price deal-count'']/div/p/span', '//div[@class=''slideshow c8'']//img/attribute::src', '//div[@class=''deal-detail-right'']/div', '//div[@class=''deal-highlight-list'']', '//div[@class=''deal-fileprint'']'),
(13, 'http://cohoimua.vn/views/280-dien-thoai-assa-103.html', 40, '//div[@class=''detai_product_right'']/h1', '//div[@class=''detai_product_gia'']/span[@class=''c17'']', '//div[@class=''detai_product_gia'']/span[@class=''c16'']', '', '', '//div[@class=''detai_product'']/div/img/attribute::src', '', '//div[@class=''detai_product_content'']', ''),
(14, 'http://www.lazada.vn/acer-aspire-e1-571g-33124g50mnks-core-i3-25ghz-156-4gb-den-80679.html', 41, '//div[@class=''prod_content'']/h1', '//div[@class=''final_price'']/span', '//span[@class=''price_erase'']/span[2]', '', '', '//div[@class=''prd-media'']/div[2]/attribute::data-zoom-image', '', '//ul[@class=''prd-attributesList ui-listBulleted'']', '//div[@class=''prd-specification'']'),
(15, 'http://www.zalora.vn/Dong-Ho-Thoi-Trang-85782.html', 42, '//span[@class=''prd-title fsm'']', '//span[@class=''prd-price prd-special-price rfloat'']/span', '//span[@class=''prd-old-price rfloat'']/span', '', '//span[@class=''prd-old-price rfloat'']/span', '//a[@class=''prd-imageBox'']/span[2]/img/attribute::src', '//span[@class=''prd-old-price rfloat'']/span', '//div[@class=''box mtm fss clearfix'']', '//div[@class=''box mtm fss clearfix'']'),
(16, 'http://www.sendo.vn/thoi-trang-nam/quan-nam/san-pham-khac/quan-lung-nam-tui-day-keo-ma-nl0257-kem-376709/', 43, '//div[@class=''product-name'']/h1', '//span[@class=''regular-price none'']/span', '', '', '', '//div[@class=''img-zoom-83 clearfix p_10'']/a/img/attribute::src', '', '', ''),
(17, 'http://kay.vn/tp-ho-chi-minh/thoi-trang/polo-men-s-leather-dress-belt-reversible-177.html', 44, '//div[@class=''pro-detail-name bot middle middle-bg middle-inner'']/h2', '//p[@class=''text large'']/i', '//p[@class=''text'']/del', '', '', '//div[@class=''ad-image'']/img/attribute::src', '//div[@class=''footer-copyright'']/p', '//div[@class=''subinfoInner'']', '//div[@class=''tab-inner-text condition'']/div/ul'),
(18, 'http://baza.vn/product/details/f6xoXajj/so-mi-nam-phong-cach-han-quoc', 46, '//div[@class=''p10 mt10 fs13 tal'']/div', '//div[@class=''mb10'']/div[@class=''price_tag'']', '//li[@class=''tac w33per fl'']/div', '', '', '//div[@class=''mt5 ofh photo c14'']/a/attribute::href', '//div[@class=''fl pt15 b'']', '//div[@class=''mb10 p10'']/div[@class=''p10'']', '//div[@class=''product'']/div[@class=''mb10'']/div[@class=''p10'']');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `authassignment`
--
ALTER TABLE `authassignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `authitemchild`
--
ALTER TABLE `authitemchild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `behaviour`
--
ALTER TABLE `behaviour`
  ADD CONSTRAINT `behaviour_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `behaviour_ibfk_2` FOREIGN KEY (`itemID`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `behaviour_ibfk_3` FOREIGN KEY (`action`) REFERENCES `actions` (`action`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `categoryurl`
--
ALTER TABLE `categoryurl`
  ADD CONSTRAINT `categoryurl_ibfk_1` FOREIGN KEY (`WebsiteID`) REFERENCES `website` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categoryurl_ibfk_2` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`Category`) REFERENCES `category` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_ibfk_2` FOREIGN KEY (`Website`) REFERENCES `website` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `item_ibfk_3` FOREIGN KEY (`Location`) REFERENCES `location` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `itemitem`
--
ALTER TABLE `itemitem`
  ADD CONSTRAINT `itemitem_ibfk_1` FOREIGN KEY (`itemID1`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `itemitem_ibfk_2` FOREIGN KEY (`itemID2`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mostinterest`
--
ALTER TABLE `mostinterest`
  ADD CONSTRAINT `mostinterest_ibfk_1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mostinterest_ibfk_2` FOREIGN KEY (`itemID`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `useruser`
--
ALTER TABLE `useruser`
  ADD CONSTRAINT `useruser_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `useruser_ibfk_2` FOREIGN KEY (`itemID`) REFERENCES `item` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `xpath`
--
ALTER TABLE `xpath`
  ADD CONSTRAINT `xpath_ibfk_1` FOREIGN KEY (`WebsiteID`) REFERENCES `website` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
