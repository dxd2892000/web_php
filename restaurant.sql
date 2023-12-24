-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 10:48 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restaurant`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cus_id` int(5) NOT NULL,
  `cus_name` varchar(50) NOT NULL,
  `cus_phone` varchar(50) NOT NULL,
  `cus_email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cus_id`, `cus_name`, `cus_phone`, `cus_email`) VALUES
(1, 'Dương Xuân Đức', '0963685229', 'dxd@gmail.com'),
(2, 'Nguyễn Thế Phong', '0967562486', 'ntp@gmail.com'),
(3, 'Trần Anh Minh', '0786529459', 'tam@gmail.com'),
(4, 'Nguyễn Thị Vang', '0972654782', 'ntv@gmail.com'),
(5, 'Đỗ Phương Nam', '0862479538', 'dpm@gmail.com'),
(6, 'Trần Thành Đạt', '0756984294', 'ttd@gmail.com'),
(7, 'Nguyễn Văn An', '0936487241', 'nva@gmail.com'),
(8, 'Hoàng Văn Sơn', '0987165959', 'hvs@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `image_gallery`
--

CREATE TABLE `image_gallery` (
  `image_id` int(2) NOT NULL,
  `image_name` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `in_order`
--

CREATE TABLE `in_order` (
  `id` int(5) NOT NULL,
  `order_id` int(5) NOT NULL,
  `menu_id` int(5) NOT NULL,
  `quantity` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(5) NOT NULL,
  `menu_name` varchar(100) NOT NULL,
  `menu_description` varchar(255) NOT NULL,
  `menu_price` decimal(6,2) NOT NULL,
  `menu_image` varchar(255) NOT NULL,
  `category_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_name`, `menu_description`, `menu_price`, `menu_image`, `category_id`) VALUES
(1, 'Bún riêu cua', 'Đây là một trong những món ăn đặc trưng của người Việt, được yêu thích vì vị ngọt đậm đà. Bên cạnh đó, sự thơm nồng của nước lèo và hương vị đặc biệt của cua cũng tạo sự ấn tượng khó phai cho thực khách.', 35.00, 'bun_rieu_cua.jpg', 1),
(2, 'Bún bò huế', 'Món ăn này có hương vị đặc trưng của miền Trung với sự kết hợp của những nguyên liệu đơn giản, dễ tìm như bò, bún và các loại rau ăn kèm.', 40.00, 'bun_bo_hue.jpg', 1),
(3, 'Bún giò heo', 'Khi ăn, thực khách sẽ cho các nguyên liệu vào trong bát, rồi đổ thêm nước dùng hấp dẫn và ngọt vị. ', 40.00, 'bun_gio_heo.jpg', 1),
(4, 'Bún mắm', 'Giống như tên gọi, điểm đặc biệt của một trong các món bún ngon này là được chế biến từ các nguyên liệu đặc trưng của miền Tây – mắm cá linh, cá sặc.', 35.00, 'bun_mam.jpg', 1),
(5, 'Bún cá Châu Đốc', 'Món ăn này được làm từ cá Châu Đốc tươi ngon và được chế biến kỹ lưỡng với các nguyên liệu như bún, rau sống, giá đỗ,… ', 30.00, 'bun_ca_Chau_Doc', 1),
(6, 'Bún ốc', 'Với hương vị đậm đà, thơm ngon của nước dùng được làm từ xương heo, cà chua và các gia vị tự nhiên, ', 30.00, 'bun_oc.jpg', 1),
(7, 'Bún gạo lứt', 'Đây là một món ăn được làm từ gạo lứt tươi và thường được kết hợp với các loại rau thơm, giò heo, chả cá, bò viên, tôm, trứng,…', 50.00, 'bun_gao_lut.jpg', 1),
(8, 'Bún cá', 'Điểm đặc trưng của món ăn này là sự hòa quyện tròn vị từ những miếng cá tươi và thơm ngon kết hợp với một số loại rau củ tươi sống, nước lèo đậm đà cùng những sợi bún dai dai.', 35.00, 'bun_ca.jpg', 1),
(9, 'Bún chả cá', 'Khi ăn, cá được cho vào nồi nước dùng được nấu từ cá, các loại rau và gia vị tạo nên một hương vị thơm ngon đặc trưng.', 45.00, 'bun_cha_ca.jpg', 1),
(10, 'Bún nước lèo', 'Bún nước lèo được làm từ bún tươi, nước dùng từ xương heo hoặc xương gà cùng các gia vị tự nhiên giúp tăng hương vị cho món ăn.', 35.00, 'bun_nuoc_leo.jpg', 1),
(11, 'Bún mọc', 'Sự hòa quyện vừa đủ giữa những viên mọc thơm ngon, sự dai dai của sợi bún và gia vị đặc biệt từ nước lèo, món bún mọc không chỉ là một món ăn truyền thống mà còn là một món ăn đầy đủ chất dinh dưỡng, rất dễ chế biến cho buổi sáng của cả gia đình.', 40.00, 'bun_moc.jpg', 1),
(12, 'Bún thang', 'Lúc trước, món ăn này thường được dùng trong các dịp đặc biệt như Tết Nguyên Đán nhưng hiện nay bún thang đã dần nổi tiếng, phổ biến và xuất hiện khắp các nhà hàng, quán ăn.', 45.00, 'bun_thang.jpg', 1),
(13, 'Bún đỏ', 'Hương vị của món ăn này thơm ngon, đậm đà và có thể được thưởng thức vào bất cứ thời điểm nào trong ngày, từ buổi sáng đến tối.', 45.00, 'bun_do.jpg', 1),
(14, 'Bún sứa', 'Đây là một trong những món ăn đặc trưng của vùng biển, mang hương vị độc đáo và độ dinh dưỡng cao. ', 40.00, 'bun_sua.jpg', 1),
(15, 'Bún xào chay', 'Đây là một trong các món bún ngon được chế biến từ các nguyên liệu đa dạng như bún, rau củ, nấm, đậu hũ non. ', 30.00, 'bun_xao_chay.jpg', 1),
(16, 'Bún măng vịt', 'Điểm nhấn của món ăn này là nước dùng đậm đà, thơm ngon được nấu từ xương vịt và nhiều gia vị khác.', 35.00, 'bun_mang_vit.jpg', 1),
(17, 'Bún gà', 'Đây là một món ăn truyền thống của Việt Nam được làm từ sợi bún mềm mịn, thịt gà thơm ngon kết hợp cùng nước dùng đậm đà và rau, nấm các loại.', 35.00, 'bun_ga.jpg', 1),
(18, 'Bún đậu mắm tôm', 'Với hương vị đậm đà, hấp dẫn đặc trưng của mắm tôm, đậu, bún rau thơm cùng nhiều nguyên liệu khác, bún đậu đã trở thành món ăn “quốc dân”, được lòng cả du khách trong và ngoài nước.', 35.00, 'bun_dau_mam_tom.jpg', 1),
(19, 'Bún dọc mùng', 'Món ăn này có nguồn gốc từ Huế và nổi tiếng với hương vị thơm ngon, thanh đạm. Bún dọc mùng được làm từ bún tươi, mềm và dọc mùng non xanh được rửa sạch, thái sợi nhỏ. ', 30.00, 'bun_doc_mung.jpg', 1),
(20, 'Cơm lam', 'Cơm lam là loại cơm được làm từ gạo (thường là gạo nếp) cùng một số nguyên liệu khác, cho vào ống tre, giang, nứa và nướng chín trên lửa.', 30.00, 'com_lam', 2),
(21, 'Cơm gà Hội An', 'Cơm gà đơn giản là cơm nấu ăn với gà luộc nhưng cái đặc sắc là những yếu tố trong món ăn như cơm, gà, nước chấm hay đồ chua ăn kèm đều mang hương vị, phong cách ẩm thực rất riêng của miền Trung.', 45.00, 'com_ga_Hoi_An', 2),
(22, 'Cơm hến', 'Ăn cơm hến như là một món trộn với những nguyên liệu phong phú mà đơn giản như hến luộc, nước hến, hoa chuối thái rối, khế chua, rau răm', 40.00, 'com_hen_Hue.jpg', 2),
(23, 'Cơm cháy Ninh Bình', 'Cơm cháy là một món ăn trông thì đơn giản nhưng thực ra khá công phu. ', 35.00, 'com_chay.jpg', 2),
(24, 'Cơm niêu', 'Cơm niêu ăn cùng những món ăn gia đình truyền thống như cá kho tộ, cà pháo chấm mắm tôm, canh cua mồng tơi… là ngon nhất.', 40.00, 'com_nieu.jpg', 2),
(25, 'Cơm âm phủ', 'Đây là một món ăn nổi tiếng của Huế do một nhà hàng mang tên “Âm Phủ” có tuổi thọ hơn 80 năm sáng tạo ra, lâu dần trở thành món đặc sản.', 45.00, 'com_am_phu.jpg', 2),
(26, 'Cơm tấm', 'Cơm tấm vốn là món đặc sản truyền thống của người dân miền Nam mà đặc biệt là người Sài Gòn.', 45.00, 'com_tam.jpg', 2),
(27, 'Cơm dừa Bến Tre', 'Xứ dừa Bến Tre không chỉ nổi tiếng với các sản phẩm kẹo dừa, rượu dừa, qua bàn tay tinh tế của người dân nơi đây biến món cơm dân dã hằng ngày trở thành một đặc sản.', 40.00, 'com_dua_Ben_Tre.jpg', 2),
(28, 'Cơm ghẹ Phú Quốc', 'Cơm chiên ghẹ ở Phú Quốc là sự kết hợp hài hòa giữa cơm trắng thơm dẻo, những thớ thịt ghẹ luộc tươi ngon với trứng gà, nước tương và vị cay của ớt. Sự hòa quyện hoàn hảo này tạo ra món ăn gần gũi nhưng cũng vô cùng đậm đà, hấp dẫn.', 55.00, 'com_ghe_Phu_Quoc.jpg', 2),
(29, 'Phở Bò', 'Với món phở bò, nước dùng được hầm từ xương bò cùng các loại gia vị như hồi, quế, thảo quả', 35.00, 'pho_bo.jpg', 3),
(30, 'Phở gà', 'Phở gà phải dậy mùi thơm của thịt gà, thêm chút lá chanh cho vào lúc cần thiết để hương vị đúng chuẩn mà không bị đắng.', 35.00, 'pho_ga.jpg', 3),
(31, 'Phở xào', 'Phở xào mặc dù không dùng nước dùng nhưng vẫn khiến nhiều người yêu thích bởi sự hài hòa của nó. ', 35.00, 'pho_xao.jpg', 3),
(32, 'Phở gân bò', 'Phở gân bò là món ăn dễ gây nghiện bởi phần nước dùng ngọt thanh, có chút ngậy béo, những miếng gân được cắt khúc vừa miệng dai dai,', 50.00, 'pho_gan_bo.jpg', 3),
(33, 'Phở chiên phồng', 'Đây là một trong các loại phở Hà Nội ngon trứ danh, nổi tiếng tại Ngũ Xá.', 40.00, 'pho_chien_phong.jpg', 3),
(34, 'Phở gan cháy', 'Phở gan cháy là một món nổi tiếng của vùng đất quan họ Bắc Ninh. ', 45.00, 'pho_gan_chay.jpg', 3),
(35, 'Phở thịt quay Cao Bằng', 'Thịt heo được tẩm ướp với các gia vị đặc trưng của vùng núi Tây Bắc. ', 45.00, 'pho_thit_quay_Cao_Bang.jpg', 3),
(36, 'Phở vịt quay Lạng Sơn', 'Phở không chỉ nổi danh ở Hà Nội mà vùng Tây Bắc cũng nhiều món phở ngon đấy nhé', 40.00, 'pho_vit_quay_Lang_Son.jpg', 3),
(37, 'Phở gạo lứt', 'Phở gạo lứt rất giàu dinh dưỡng, thích hợp cho những bạn đang ăn chay, thuần chay hoặc chế độ ăn thực dưỡng. ', 45.00, 'pho_gao_lut.jpg', 3),
(38, 'Phở trộn', 'Ngon không kém các món phở nước, hay phở xào, chiên, phở trộn là sự kết hợp đúng vị của các nguyên liệu và nước sốt. ', 35.00, 'pho_tron.jpg', 3),
(39, 'Phở sắn', 'Phở sắn/ khoai mì là món ăn quen thuộc của người dân Quảng Nam. ', 35.00, 'pho_san.jpg', 3),
(40, 'Phở bò sốt vang', 'Bát phở hội tụ sắc, hương và vị với thịt bò đỏ nâu, mềm ngọt, có chút sần sật. Nước dùng nâu đỏ, hơi sánh, dậy mùi thơm của quế, hồi, thảo quả. ', 40.00, 'pho_bo_sot_vang.jpg', 3),
(41, 'Xôi gấc', 'xôi gấc thường được nấu vào những ngày đám và mỗi khi tết đến xuân về.', 10.00, 'xoi_gac.jpg', 4),
(42, 'Xôi đậu xanh', ' xôi đậu xanh cũng là món ăn quen thuộc thường được nấu để đãi khách', 10.00, 'xoi_dau_xanh.jpg', 4),
(43, 'Xôi xéo', 'Đối với người dân Hà Nội, xôi xéo từ lâu đã trở thành món quá đỗi quen thuộc.', 15.00, 'xoi_xeo.jpg', 4),
(44, 'Xôi hạt sen', 'Hạt nếp dẻo mềm, óng ả đẹp mắt được trộn lẫn với hạt sen bùi bùi, thơm thơm cùng với cơm dừa bào sợi ngon ngọt mà còn cấp tốc nữa chứ.', 15.00, 'xoi_hat_sen.jpg', 4),
(45, 'Xôi lạc', 'Xôi lạc gắn liền với nhiều kỉ niệm đẹp của tuổi thơ bên gia đình. ', 10.00, 'xoi_lac.jpg', 4),
(46, 'Xôi sắn', 'Món ăn gây hấp dẫn bởi cái vị bùi ngọt của sắn trộn lẫn trong những hạt nếp dẻo thơm, thêm 1 ít hành phi cháy tỏi, đậu phộng bùi bùi và mỡ hành beo béo.', 10.00, 'xoi_san.jpg', 4),
(47, 'Xôi lá dứa', 'xôi lá dứa cũng là một món ăn lý tưởng dành cho buổi sáng siêu tốc với chiếc nồi cơm điện.', 15.00, 'xoi_la_dua.jpg', 4),
(48, 'Xôi mặn', 'xôi mặn luôn nằm trong top món ăn sáng hấp dẫn và dinh dưỡng nhất cho một ngày dài hoạt động.', 20.00, 'xoi_man.jpg', 4),
(49, 'Xôi gà', ' xôi gà cũng đang dần chiếm được vị trí quan trọng trong lòng người thưởng thức.', 25.00, 'xoi_ga.jpg', 4),
(50, 'Xôi dừa', ' xôi dừa lại khiến người ta dần mê mẫn và chìm đắm trong cái hương vị mê hồn ấy.', 15.00, 'xoi_dua.jpg', 4),
(51, 'Xôi lá cẩm', ' Điểm nhấn của món xôi nằm ở phần hạt nếp tím dẻo, nóng hổi, thơm lừng mùi lá cẩm, được phủ lên một lớp đậu xanh ngọt lịm, dừa sợi béo ngon.', 15.00, 'xoi_la_cam.jpg', 4),
(52, 'Xôi nếp cẩm', 'Hạt xôi nếp cẩm vừa dẻo vừa thơm, ăn kèm với đậu xanh bùi bùi, cơm dừa đậu phộng béo ngọt. ', 15.00, 'xoi_nep_cam.jpg', 4),
(53, 'Xôi đậu đỏ', 'xôi đậu đỏ khoác cho mình chiếc áo màu đỏ trông vô cùng thu hút. ', 10.00, 'xoi_dau_do.jpg', 4),
(54, 'Xôi đỗ đen', 'Nếp gạo dẻo, đậu đen mềm ngọt toả hương thơm nức mũi. ', 10.00, 'xoi_do_den.jpg', 4),
(55, 'Xôi mít', 'Xôi mít là cái tên đang gây sốt của làng ẩm thực đường phố trong thời gian gần đây.', 20.00, 'xoi_mit.jpg', 4),
(56, 'Xôi khoai môn', 'Nếp gạo dẻo thơm, được tạo màu tím nhạt từ quả thanh long trộn lẫn với khoai môn bùi ngọt.', 15.00, 'xoi_khoai_mon.jpg', 4),
(57, 'Bánh mì chảo', 'Bánh mì chảo là món bánh mì rất đặc biệt vì nhân bánh được cho hết vào chảo nào là pate, trứng, xúc xích, chả cá, phô mai', 25.00, 'banh_mi_chao.jpg', 5),
(58, 'Bánh mì cay', 'Bánh mì cay hay còn được gọi là bánh mì que nhân đơn giản chỉ với pate Hải Phòng nhưng ăn một lại muốn thêm.', 10.00, 'banh_mi_que_Hai_Phong.jpg', 5),
(59, 'Bánh mì bột lọc', 'Bánh mì với nhân là bánh bột lọc bên ngoài là bánh mì giòn bên trong lại là bánh bột lọc dai dai.', 20.00, 'banh_mi_bot_loc_MienTrung.jpg', 5),
(60, 'Bánh mì chả cá hấp, chiên', 'Bánh mì nhân chả cá chiên, ai không ăn dầu mỡ thì có ngay chả cá hấp luôn nha!', 25.00, 'banh_mi_cha_ca.jpg', 5),
(61, 'Bánh mì ép', 'Nhân bánh mì ép đều là những món quen thuộc của bánh mì Việt Nam là chả lụa, giăm bông, chà bông,... ăn kèm với rau mùi và dưa chua. ', 20.00, 'banh_mi_ep_Thua_Thien_Hue.jpg', 5),
(62, 'Bánh mì gà xé', 'bánh mì gà xé thơm ngon. Vẫn là rau mùi và dưa chua nhưng ăn với gà xé thì thật ngon ăn một lần là nhớ mãi.', 20.00, 'banh_mi_ga_xe_Da_Nang.jpg', 5),
(63, 'Bánh mì đầu nhọn', 'Bánh mì Hội An cũng có nhân thịt, pate, giò, chả, rau và nước sốt thơm ngon nhưng đặc biệt hơn là bánh mì này có hai đầu nhọn trông lạ mắt và vô cùng ngon thu hút những khách nước ngoài đến với Đà Nẵng.', 20.00, 'banh_mi_dau_nhon_Hoi_An.jpg', 5),
(64, 'Bánh mì xíu mại', 'Bánh mì xíu mại nóng hổi thơm ngon, viên xíu mại béo béo ăn cùng bánh mì giòn trong thời tiết se lạnh của Đà Lạt', 20.00, 'banh_mi_xiu_mai_Da_Lat.jpg', 5),
(65, 'Bánh mì chả cá sợi', 'Bánh mì chả cá sợi ngon nhất khi ăn nóng vì chả cá vừa nóng dai mà bánh mì vẫn còn giòn không ngấm dầu', 25.00, 'banh_mì_cha_ca_soi.jpg', 5),
(66, 'Bánh mì phá lấu', ' với những du khách \"sành ăn\" ở Sài Gòn thì sẽ bị gây nghiện với món bánh mì phá lấu lòng heo dai giòn của bao tử, béo béo của lá mía cùng nhiều bộ phận khác lạ miệng mà ngon vô cùng.', 30.00, 'banh_mi_pha_lau.jpg', 5),
(67, 'Bánh mì Pate', 'Bánh mì pate ngày nay có mặt ở khắp nơi trên đất nước Việt Nam nhưng món ngon này có nguồn gốc lâu đời nhất là ở Sài Gòn ', 15.00, 'banh_mi_pate.jpg', 5),
(68, 'Bánh mì bì', 'Bánh mì giòn với nhân bì heo dai dai cùng thịt ba rọi heo kho trộn trong thính gạo thơm thơm ăn cùng với đồ chua và dưa leo chua', 20.00, 'banh_mi_bi.jpg', 5),
(69, 'Bánh mì thịt nướng', 'bánh mì thịt nướng có nơi tọa lạc hiếm khi thấy xe đẩy nữa nhưng mùi vị vẫn thơm ngon không có thay đổi đâu nha!', 25.00, 'banh_mi_thit_nuong.jpg', 5),
(70, 'Bánh mì heo quay', 'bánh mì heo quay quan trọng nhất vẫn là heo quay da phải giòn thịt thì thấm hương vị ướp', 25.00, 'banh_mi_heo_quay.jpg', 5),
(71, 'Bánh mì kem', 'lúc nhỏ có món ăn vặt này là hơi bị xịn xò luôn á', 15.00, 'banh_mi_kem.jpg', 5),
(72, 'Bánh mì nướng muối ớt', ' chỉ đơn giản là phết muối ớt lên bánh mì rồi nước trên than củi là ăn.', 15.00, 'banh_mi_nuong.jpg', 5),
(73, 'Bánh mì hấp', 'Chỉ cần đem bánh mì khô đi hấp lên với một ít nước mắm thêm thịt băm và ăn kèm rau sống sẽ làm cho bữa ăn của bạn thêm thú vị và hấp dẫn vô cùng!', 15.00, 'banh_mi_hap.jpg', 5),
(74, 'Bánh mì thanh long', 'Bánh mì thanh long được ông \"vua bánh mì\" Kao Siêu Lực cho ra đời với nhiệm vụ vô cùng cao cả \"giải cứu nông sản\" ', 10.00, 'banh_mi_thanh_long.jpg', 5),
(75, 'Bánh mì bóng đêm', 'Bánh mì bóng đêm hay còn gọi là bánh mì đen, bánh mì tinh than tre.', 10.00, 'banh_mi_bong_dem.jpg', 5),
(76, 'Mì bò trứng', 'Món mì bò tuy đơn giản nhưng lại ngon miệng và đầy đủ dinh dưỡng.', 35.00, 'mi_bo_trung.jpg', 6),
(77, 'Mì Quảng', 'Mì Quảng (tức là Mì của xứ Quảng) là một món ăn có nguồn gốc xuất xứ và cũng là đặc sản của tỉnh Quảng Nam và thành phố Đà Nẵng tại Việt Nam.', 35.00, 'mi-quang.jpg', 6),
(78, 'Mì ngao', ' mì ngao nóng hổi, thơm ngon này đảm bảo sẽ hấp dẫn bất cứ ai thưởng thức. ', 30.00, 'mi_ngao.jpg', 6),
(79, 'Mì xào', 'Mì xào là món ăn được yêu thích từ người lớn đến trẻ nhỏ ', 30.00, 'mi_xao.jpg', 6),
(80, 'Mì trộn gà', 'Từng sợi mì dai ngon, thịt gà mềm ngọt lại đậm đà, món ăn thích hợp dùng cho bữa sáng hoặc đổi vị cho bữa tối.', 35.00, 'mì_ga_tron.jpg', 6),
(81, 'Mì vịt tiềm', 'Mì vịt tiềm là món ăn ngon nổi tiếng của người Hoa và có giá trị dinh dưỡng cao, vì thịt vịt có vị ngọt, tính hàn và công dụng dưỡng vị, bổ thận.', 40.00, 'mi_vit_tiem.jpg', 6),
(82, 'Bánh tráng cuộn sốt trứng', 'Nếu bạn là một tín đồ của món ăn vặt thì hãy thử thưởng ngay món bánh tráng cuộn sốt trứng', 20.00, 'banh_trang_cuon_sot_trung.jpg', 7),
(83, 'Rong biển cháy tỏi', 'Với vị rong biển đậm đà, giòn rụm quyện cùng phần tỏi thơm lừng kết hợp cùng vị cay cay từ ớt rất kích thích', 25.00, 'rong_bien_chay_toi.jpg', 7),
(84, 'Bánh tráng trộn', 'Món bánh tráng trộn được phối trộn từ vị cay của bò khô cùng vị béo bùi của lạc, của trứng cút và vị thơm của hành phi.', 15.00, 'banh_trang_tron.jpg', 7),
(85, 'Xoài lắc', 'Xoài lắc là một trong những món ăn vặt được yêu thích bậc nhất Sài Gòn. ', 15.00, 'xoai_lac.jpg', 7),
(86, 'Bánh tráng cuốn sốt me', 'Món bánh tráng cuốn sốt me đã làm mê đắm bao tín đồ ăn vặt bởi phần bánh tráng dẻo thơm quyện cùng vị chua của xoài, vị béo thơm của đậu phộng, trứng cút hòa quyện cùng cái thơm của rau răm rất kích thích.', 20.00, 'banh_trang_cuon_sot_me.jpg', 7),
(87, 'Bánh tôm', 'Nếu bạn đang tìm một món bánh thơm ngon, hấp dẫn thì hãy thưởng thức ngay món bánh tôm.', 25.00, 'banh_tom.jpg', 7),
(88, 'Cá viên chiên nước mắm', 'Món cá viên chiên nước mắm là một trong những món ăn được nhiều bạn trẻ ưa chuộng nhất. ', 15.00, 'ca_vien_chien_nuoc_mam.jpg', 7),
(89, 'Nộm khô bò', 'Món nộm khô bò thường được các bạn trẻ thưởng thức vào những buổi chiều mát ở những quán lề đường', 25.00, 'nom_kho_bo.jpg', 7),
(90, 'Bánh tráng nướng mắm ruốc', 'Bánh tráng nướng mắm ruốc được xem là một đặc sản đến từ vùng đất biển Phan Thiết. ', 20.00, 'banh_trang_nuoc_mam_ruoc.jpg', 7),
(91, 'Cút lộn xào me', 'Món cút lộn xào me đã chinh phục được nhiều thực khách từ lần đầu tiên thưởng thức. ', 30.00, 'cut_lon_xao_me.jpg', 7),
(92, 'Khoai tây lốc xoáy', 'Khoai tây lốc xoáy được biết đến là một món ăn vặt đến từ Hàn Quốc ', 20.00, 'khoai_tay_loc_xoay.jpg', 7),
(93, 'Sụn gà rang muối', ' sụn gà được chiên vàng giòn đấy hấp dẫn kết hợp cùng lớp muối được phủ đều bên ngoài rất vừa vị và thơm ngon', 35.00, 'sun_ga_rang_muoi.jpg', 7),
(94, 'Bánh cay', ' Bánh cay được nhiều người yêu thích bởi phần khoai mì được xử lý và chiên vàng quyện cùng vị cay từ ớt đã tạo nên một món ăn rất kích thích.', 20.00, 'banh_cay.jpg', 7),
(95, 'Da heo chiên nước mắm', 'Phần da heo được chiên giòn rụm, có màu vàng đẹp mắt kết hợp cùng phần nước sốt đậm đà có đủ vị mặn, ngọt, cay rất hấp dẫn. ', 25.00, 'da_heo_chien_nuoc_mam.jpg', 7),
(96, 'Mực rim me', 'Chỉ với mực khô và me đã tạo nên một món ăn vặt đậm đà, thơm ngon với vị thơm đặc trưng từ mực khô kết hợp cùng vị chua ngọt đầy hấp dẫn.', 30.00, 'muc_rim_me.jpg', 7),
(97, 'Dừa sấy', ' Phần dừa thơm béo kết hợp cùng phần đường ngọt vừa vị', 15.00, 'dua_say.jpg', 7),
(98, 'Bánh tráng tỏi', ' bánh tráng dẻo thơm kết hợp cùng phần muối, tỏi rất đậm đà và tròn vị.', 15.00, 'banh_trang_toi.jpg', 7),
(99, 'Khoai lang que', ' màu sắc bắt mắt, hương thơm nức mũi, còn khoai lang thì được chiên giòn rụm ', 15.00, 'khoai_lang_que.jpg', 7),
(100, 'Bánh xèo', 'Bánh xèo là một loại bánh phổ biến ở châu Á, phiên bản bánh xèo của Nhật Bản và Triều Tiên có bột bên ngoài, bên trong có nhân là tôm, thịt, giá đỗ', 15.00, 'banh_xeo_mien_nam.jpg', 7),
(101, 'Bánh chuối chiên', ' Bánh chuối chiên vị thanh ngọt chấm thêm một ít tương ớt cay cay là ngon khỏi chê', 10.00, 'banh_chuoi_chien.jpg', 7),
(102, 'Chè đỗ đen', 'Chè đậu đen là món chè được yêu thích của rất nhiều người dù trong những ngày hè nóng với cốc chè đá mát lạnh', 10.00, 'che_do_den.jpg', 8),
(103, 'Chè trôi nước', ' Chè trôi nước với phần vỏ dai dai được làm từ bột nếp, phần nhân đậu xanh thơm bùi, nước đường thanh ngọt cùng với vị béo của cốt dừa tạo nên vị ngon thanh đạp và riêng biệt cho món chè này.', 15.00, 'che_troi_nuoc.jpg', 8),
(104, 'Chè khúc bạch', 'Món chè này rất phổ biến ở Việt Nam và có công năng giải nhiệt tuyệt vời.', 20.00, 'che_khu_bach.jpg', 8),
(105, 'Chè sen long nhãn', 'Chè sen long nhãn là một trong các món chè Việt Nam ngày xưa dùng để tiến vua, không phải chỉ vì độ ngọt thanh, mà còn có giá trị bổ dưỡng cao, cải thiện tình trạng suy nhược cơ thể. ', 20.00, 'che_sen.jpg', 8),
(106, 'Chè bưởi', 'Điểm đặc biệt của loại chè này là thành phần chính là cùi bưởi, ngoài ra, còn có một số thành phần khác như đậu xanh, bột năng, lá dứa, đường, cốt dừa.', 15.00, 'che_buoi.jpg', 8),
(107, 'Chè chuối', 'Chè chuối là món ăn phổ biến, đơn giản mà lại dễ làm nên lấy lòng được rất nhiều người.', 15.00, 'che_chuoi.jpg', 8),
(108, 'Chè ngô', 'Chè bắp hay còn gọi là chè ngô là một trong những món chè được yêu thích, đặc biệt là vào mùa hè. ', 10.00, 'che_ngo.jpg', 8),
(109, 'Chè đậu đỏ', 'Món chè đậu đỏ này có tác dụng thanh nhiệt rất tốt, nhất là trong những ngày hè nắng nóng oi bức. ', 15.00, 'che_dau_do.jpg', 8),
(110, 'Chè thập cẩm', 'Chè thập cẩm là một món ăn quen thuộc, được nhiều người yêu thích, nhờ sự kết hợp của nhiều nguyên liệu', 10.00, 'che_thap_cam.jpg', 8),
(111, 'Nước dừa', 'Nước dừa tươi là một trong những thức ăn truyền thống của người dân miền Tây trong suốt nhiều thập kỷ.', 15.00, 'nuoc_dua.jpg', 9),
(112, 'Bia', ' mỗi khu vực sẽ có một loại bia đặc trưng khác nhau và phù hợp với khẩu vị người dân vùng miền', 15.00, 'bia.jpg', 9),
(113, 'Nước mía', 'Một loại nước có vị ngọt tự nhiên sau dừa là nước mía.', 10.00, 'nuoc_mia.jpg', 9),
(114, 'Trà Atiso', 'Trà atiso là loại nước giải khát có chức năng làm sạch gan và giải độc cơ thể.', 10.00, 'tra_atiso.jpg', 9),
(115, 'Trà chanh', 'trà chanh cũng là món nước giải khát với cách pha chế vô cùng đơn giản.', 10.00, 'tra_chanh.jpg', 9),
(116, 'Sinh tố', 'Sinh tố là loại thức uống phổ biến với nguyên liệu chính chủ yếu là các loại trái cây theo mùa', 25.00, 'sinh_to.jpg', 9),
(117, 'Cà phê', 'Cà phê đá sẽ có vị đắng hòa cùng một chút ngọt bùi, còn cà phê sữa có vị béo của sữa đặc và hương thơm nức mũi từ cà phê.', 20.00, 'ca_phe.jpg', 9),
(118, 'Trà đào cam xả', 'Trà đào chanh sả, như chính tên gọi của mình vậy, có vị đậm ngọt thanh của đào, có vị chua chua dịu nhẹ của chanh, có mùi thơm của sả.', 30.00, 'tra_dao_cam_xa.jpg', 9),
(119, 'Sữa tươi trân châu đường đen', 'Sữa tươi trân châu đường đen – một cái tên quen thuộc đang gây bão phủ sóng với giới trẻ. ', 30.00, 'sua_tuoi_tran_chau_duong_den.jpg', 9),
(120, 'Trà hoa quả', 'Mùa hè nóng nực đến rồi, những cốc trà sữa, cốc kem sữa có thể sẽ khiến nhiều người e ngại vì không đủ thanh mát', 25.00, 'tra_hoa_qua.jpg', 9);

-- --------------------------------------------------------

--
-- Table structure for table `menu_categories`
--

CREATE TABLE `menu_categories` (
  `category_id` int(3) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_categories`
--

INSERT INTO `menu_categories` (`category_id`, `category_name`) VALUES
(1, 'Bún'),
(2, 'Cơm'),
(3, 'Phở'),
(4, 'Xôi'),
(5, 'Bánh mì'),
(6, 'Mì'),
(7, 'Ăn vặt'),
(8, 'Chè'),
(9, 'Đồ uống');

-- --------------------------------------------------------

--
-- Table structure for table `placed_orders`
--

CREATE TABLE `placed_orders` (
  `order_id` int(5) NOT NULL,
  `order_time` datetime NOT NULL,
  `cus_id` int(5) NOT NULL,
  `delivery_address` varchar(255) NOT NULL,
  `delivered` tinyint(1) NOT NULL DEFAULT 0,
  `canceled` tinyint(1) NOT NULL DEFAULT 0,
  `cancellation_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservation_id` int(5) NOT NULL,
  `date_created` datetime NOT NULL,
  `cus_id` int(5) NOT NULL,
  `selected_time` datetime NOT NULL,
  `amounts` int(2) NOT NULL,
  `table_id` int(3) NOT NULL,
  `liberated` tinyint(1) NOT NULL DEFAULT 0,
  `canceled` tinyint(1) NOT NULL DEFAULT 0,
  `cancellation_reason` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tables`
--

CREATE TABLE `tables` (
  `table_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tables`
--

INSERT INTO `tables` (`table_id`) VALUES
(1),
(2),
(3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(2) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `full_name`, `password`) VALUES
(1, 'ducdx', 'ducdx@gmail.com', 'duongxuanduc', 'duc12345');

-- --------------------------------------------------------

--
-- Table structure for table `website_settings`
--

CREATE TABLE `website_settings` (
  `option_id` int(5) NOT NULL,
  `option_name` varchar(255) NOT NULL,
  `option_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `website_settings`
--

INSERT INTO `website_settings` (`option_id`, `option_name`, `option_value`) VALUES
(1, 'restaurant_name', 'HUS FOODIE'),
(2, 'restaurant_email', 'husfoodie@gmail.com'),
(3, 'admin_email', 'admin_email@gmail.com'),
(4, 'restaurant_phonenumber', '0123456789'),
(5, 'restaurant_address', '334 Nguyễn Trãi, Thanh Xuân, TX, Hà Nội');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `image_gallery`
--
ALTER TABLE `image_gallery`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `in_order`
--
ALTER TABLE `in_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_menu` (`menu_id`),
  ADD KEY `fk_order` (`order_id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `FK_menu_category_id` (`category_id`);

--
-- Indexes for table `menu_categories`
--
ALTER TABLE `menu_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `placed_orders`
--
ALTER TABLE `placed_orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `fk_client` (`cus_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `tables`
--
ALTER TABLE `tables`
  ADD PRIMARY KEY (`table_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `website_settings`
--
ALTER TABLE `website_settings`
  ADD PRIMARY KEY (`option_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cus_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `image_gallery`
--
ALTER TABLE `image_gallery`
  MODIFY `image_id` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `in_order`
--
ALTER TABLE `in_order`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `menu_categories`
--
ALTER TABLE `menu_categories`
  MODIFY `category_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `placed_orders`
--
ALTER TABLE `placed_orders`
  MODIFY `order_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservation_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tables`
--
ALTER TABLE `tables`
  MODIFY `table_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `website_settings`
--
ALTER TABLE `website_settings`
  MODIFY `option_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `in_order`
--
ALTER TABLE `in_order`
  ADD CONSTRAINT `fk_menu` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`menu_id`),
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`order_id`) REFERENCES `placed_orders` (`order_id`);

--
-- Constraints for table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `FK_menu_category_id` FOREIGN KEY (`category_id`) REFERENCES `menu_categories` (`category_id`);

--
-- Constraints for table `placed_orders`
--
ALTER TABLE `placed_orders`
  ADD CONSTRAINT `fk_customer` FOREIGN KEY (`cus_id`) REFERENCES `customers` (`cus_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
