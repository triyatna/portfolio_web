-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2022 at 04:34 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `article_id` int(11) NOT NULL,
  `article_title` varchar(255) NOT NULL,
  `article_content` longtext NOT NULL,
  `article_desc` varchar(500) NOT NULL,
  `article_image` varchar(255) NOT NULL,
  `article_created_time` datetime NOT NULL,
  `article_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_categorie` int(11) NOT NULL,
  `id_author` int(11) NOT NULL,
  `article_slug` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`article_id`, `article_title`, `article_content`, `article_desc`, `article_image`, `article_created_time`, `article_updated_at`, `id_categorie`, `id_author`, `article_slug`, `tags`) VALUES
(4, 'sdadasd2332', '<p>asdasdacccv</p>\r\n\r\n<p>asdasdacccv</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>asdasdacccvasdasdacccvasdasdacccv</p>\r\n\r\n<p>asdasdacccv</p>\r\n', 'asdasdacccv\r\n\r\nasdasdacccv\r\n\r\n\r\n\r\nasdasdacccvasdasdacccvasdasdacccv\r\n\r\nasdasdacccv', 'buy now.png', '2022-07-19 13:36:17', '2022-07-21 02:08:35', 19, 2, 'sdadasd2332', 'asd,cvvf,asdasd'),
(8, 'Lorem Ipsum', '<p style=\"text-align:justify\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vulputate scelerisque ante non imperdiet. Mauris tempor est eu luctus venenatis. Phasellus ultrices cursus mollis. Donec bibendum magna ut ante sodales, sit amet hendrerit turpis tincidunt. Duis scelerisque leo at sem euismod bibendum. Etiam blandit lectus vitae lorem condimentum aliquam. Vivamus pharetra a enim eget ultrices. In ut metus auctor, dignissim eros quis, egestas ante. Duis ut nibh a enim ultricies aliquam et in mauris. Donec nec maximus justo. Curabitur condimentum enim imperdiet elementum tincidunt. Ut et tortor eu lectus placerat porta et quis arcu.</p>\r\n\r\n<p style=\"text-align:justify\">Aliquam at tempus mauris. Praesent velit augue, porta ut turpis quis, vulputate laoreet leo. Sed et consequat urna, rutrum eleifend erat. Suspendisse imperdiet erat non eros cursus, in vehicula risus vestibulum. Morbi vitae lectus ullamcorper, eleifend turpis eget, porta nulla. Proin nec sapien turpis. Ut mattis vestibulum lacinia. Duis tristique, sem vel laoreet cursus, lacus justo lacinia nisi, non varius ante ante vel diam. Suspendisse congue elit eget urna sodales venenatis. Morbi ut metus id quam elementum varius. Donec bibendum sollicitudin magna ut tempus. Sed cursus consectetur placerat. Mauris volutpat tristique blandit. Ut ac facilisis dui. Vivamus viverra euismod tellus, vel gravida sapien tristique et. Mauris consequat ex porttitor sem egestas, vitae imperdiet erat euismod.</p>\r\n\r\n<p style=\"text-align:justify\">Curabitur pharetra feugiat augue, vitae finibus erat aliquam eu. Etiam elementum quis tellus non sodales. Nullam sollicitudin, justo sed vehicula pulvinar, erat mi egestas sapien, a auctor eros nunc et est. Vivamus tincidunt ultrices neque, a finibus ex lobortis a. Cras ullamcorper bibendum mi, eget viverra lorem euismod lobortis. Quisque aliquam malesuada hendrerit. Nulla ut lorem sem.</p>\r\n\r\n<blockquote>\r\n<p style=\"text-align:justify\">Phasellus sed tincidunt est. Nullam vehicula a mi at varius. Morbi lacinia molestie ex, a placerat urna ornare sit amet. Vestibulum varius feugiat leo ac dictum. Etiam ac pulvinar nibh. Cras scelerisque orci justo, eget ullamcorper ante imperdiet eget. Suspendisse potenti. Donec id massa viverra, mattis orci convallis, tempor ante. Etiam tempus fermentum tempus. Sed et eleifend justo. Aliquam eu augue lectus. Fusce sit amet pharetra dui. Donec placerat consequat sapien, vel fringilla tortor dignissim ut. Aliquam erat volutpat.</p>\r\n</blockquote>\r\n\r\n<p style=\"text-align:justify\">Etiam quis ultrices mi. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi at quam laoreet, elementum tellus in, porta diam. Phasellus scelerisque diam et feugiat congue. Sed iaculis iaculis ante a varius. Vestibulum luctus rutrum eros malesuada mattis. Vivamus sit amet nunc nec lacus interdum sollicitudin. Mauris ornare lacinia justo, non pellentesque ligula mattis vitae. Nulla massa libero, ultrices vel interdum sed, scelerisque a lectus. Aenean sit amet elementum lacus. Nulla pulvinar, nibh eu viverra malesuada, ipsum sapien cursus quam, at hendrerit odio erat a sem. Nunc vestibulum sed sapien vel elementum. Pellentesque sagittis ex quis velit finibus, et congue augue mattis. Curabitur massa nisi, dictum ac ante sit amet, dictum volutpat nunc. Praesent venenatis ornare ipsum eu rutrum.</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;Duis ultricies elementum ligula sodales auctor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas ac ligula leo. Aenean turpis turpis, lobortis consectetur neque ac, posuere aliquet mauris. Vivamus non mattis elit, non eleifend leo. Nunc pulvinar leo interdum placerat congue. Morbi imperdiet vitae nulla sit amet placerat. Nulla facilisis libero sed metus fringilla elementum. Maecenas bibendum tempor mi nec tempus. Suspendisse ultrices, elit dictum aliquam volutpat, velit ex pharetra lectus, quis gravida enim ex nec nisi.</p>\r\n\r\n<p style=\"text-align:justify\">Integer arcu metus, placerat vel arcu vel, sollicitudin interdum sapien. Nulla lobortis eros a odio suscipit imperdiet. Sed viverra rutrum augue sed vehicula. Integer nec tortor nec urna hendrerit cursus. Nam consectetur vehicula lobortis. Etiam auctor velit quis nisi molestie aliquam. Praesent aliquam ipsum ac malesuada laoreet. In blandit massa ut luctus commodo. Vestibulum consectetur leo sollicitudin dolor tempor, a fermentum purus suscipit. Aenean sem sapien, rutrum venenatis rutrum ut, vulputate sed magna. Mauris eu enim odio. Donec varius metus vel nibh auctor, in tempor lacus ultrices.</p>\r\n\r\n<p style=\"text-align:justify\">Nunc sit amet vestibulum sapien. Donec malesuada nulla dolor, eget auctor mi egestas eu. Curabitur bibendum, ipsum vel molestie tristique, erat libero feugiat orci, a aliquet est nunc id justo. Praesent quis lectus vitae orci consectetur sollicitudin ut et magna. Praesent a vestibulum enim. Suspendisse non leo eu lacus dapibus tincidunt nec et elit. Aliquam facilisis malesuada nisl a aliquam.</p>\r\n\r\n<p style=\"text-align:justify\">Etiam eu dolor sit amet libero auctor maximus. Donec blandit tincidunt ante, non rhoncus nulla viverra vitae. Praesent mattis posuere libero, in finibus sem tincidunt id. Cras nec massa vestibulum, faucibus ligula ac, imperdiet dui. Morbi vel condimentum turpis. Aliquam sollicitudin mollis odio et efficitur. Mauris vehicula magna ante, a faucibus ipsum ultricies a. Sed elit mauris, malesuada in augue a, mollis porttitor erat. Nunc sodales risus libero, vel dignissim urna elementum sed. Mauris eget venenatis nisl. Donec vel velit facilisis ipsum consectetur pharetra. Fusce ante odio, ultrices eget velit eu, congue interdum velit. Fusce ut ornare eros, vitae vestibulum urna. Donec cursus congue justo rutrum dapibus.</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Nunc convallis sem ac interdum fermentum. Integer scelerisque dignissim elementum. Duis maximus vulputate nisl nec dictum. Integer ut erat consectetur, lacinia urna sit amet, congue arcu. Fusce pretium mi purus, nec ornare libero lacinia ut. Nunc efficitur libero at feugiat condimentum. Mauris non imperdiet urna. Sed gravida ligula dui, sit amet facilisis nisi venenatis ut. Phasellus eleifend orci in arcu ultricies laoreet. Aliquam pulvinar vitae nibh eget blandit. Fusce odio ante, tristique ut magna in, facilisis commodo mi. Sed euismod venenatis vestibulum. Sed ut laoreet velit.</p>\r\n\r\n<p style=\"text-align:justify\">Morbi tristique pretium nunc a cursus. Duis placerat ullamcorper sem at lobortis. Curabitur non lorem eu felis pharetra feugiat. Interdum et malesuada fames ac ante ipsum primis in faucibus. Quisque non mauris quam. Nam pretium lorem at sapien maximus efficitur eget vitae est. Integer volutpat tristique ante non malesuada. Sed sed pharetra ipsum. Phasellus sit amet feugiat felis. Fusce nec mollis enim. Nam a neque vel nulla porta sagittis eget sed nulla.</p>\r\n\r\n<p style=\"text-align:justify\">Aenean efficitur maximus ullamcorper. Etiam nulla eros, finibus feugiat dapibus vitae, suscipit sed magna. Nunc elementum magna tellus, vel elementum lacus vulputate at. Suspendisse potenti. Phasellus sit amet urna et lectus volutpat faucibus. Duis ultrices ultricies mauris, ac pharetra felis imperdiet porttitor. Nunc tristique urna vehicula posuere auctor.</p>\r\n\r\n<p style=\"text-align:justify\">Sed cursus lacus at ultricies convallis. Maecenas ornare, tellus a sodales tincidunt, magna ex tempor risus, vitae congue metus magna eget nisi. Nullam vehicula enim nec maximus rhoncus. Sed efficitur lorem ut tortor elementum lacinia. Donec sed purus et erat cursus tempus. Maecenas congue iaculis quam. Aliquam aliquam lobortis sollicitudin. Ut commodo fringilla libero, in rhoncus justo suscipit id. Curabitur tristique dignissim neque et posuere. Proin non lacinia odio. Sed suscipit nec eros a ornare.</p>\r\n\r\n<p style=\"text-align:justify\">Sed mattis ante vel tellus placerat faucibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque venenatis elit vitae erat ornare malesuada. Integer vel ipsum vehicula, iaculis massa eu, elementum velit. Vivamus vulputate quam eget consectetur cursus. Ut arcu odio, interdum quis arcu sed, scelerisque mattis massa. Integer semper vitae neque sed venenatis. In vestibulum mi ipsum. Etiam auctor mauris vitae sem varius vulputate. Phasellus tempor vulputate commodo.</p>\r\n\r\n<p style=\"text-align:justify\">Aliquam faucibus arcu sit amet venenatis porta. Integer imperdiet odio in sodales pretium. Pellentesque lorem enim, eleifend vitae sapien in, mollis elementum augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam consequat augue tortor, sit amet auctor arcu auctor luctus. Quisque volutpat elit justo, at tempor arcu tincidunt quis. Nam mi sem, vestibulum id eros sit amet, congue convallis tortor. Proin accumsan enim eget augue tristique, hendrerit dictum dolor faucibus. Sed in tincidunt purus. Quisque egestas finibus consequat.</p>\r\n\r\n<p style=\"text-align:justify\">Nulla scelerisque quis tellus quis mollis. Duis nec ullamcorper nibh. Pellentesque sit amet condimentum sapien, vel accumsan lorem. In tincidunt faucibus tempor. Ut nec volutpat quam. Nulla gravida nunc sed turpis suscipit semper. Nunc sed pharetra ligula, eget malesuada neque. Fusce at enim feugiat, dapibus lorem in, vestibulum tortor. Morbi tempus metus libero, et condimentum arcu eleifend non.</p>\r\n\r\n<p style=\"text-align:justify\">Phasellus eget augue tincidunt, auctor leo et, lacinia libero. Donec aliquet risus nec nulla aliquet mollis. Suspendisse vel purus eu ipsum dapibus tincidunt eu eu mi. Fusce consectetur justo non lacinia gravida. Nulla at elit pharetra, euismod dolor eget, consectetur metus. Cras ligula dolor, blandit ornare eros eget, varius ornare nisl. Integer congue lectus sed lectus cursus, id pretium nunc rhoncus. Pellentesque efficitur sollicitudin viverra. Integer vel ex ultricies, luctus ex vel, tempus metus.</p>\r\n\r\n<p style=\"text-align:justify\">Sed non orci vitae elit ornare feugiat vitae et nisl. Fusce vehicula sapien venenatis purus egestas pulvinar. In sodales mi eu enim egestas auctor. Duis justo dolor, iaculis ac faucibus sit amet, blandit vel ipsum. Morbi ipsum nulla, tempor at malesuada quis, molestie at ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Praesent sed malesuada libero. Vivamus sollicitudin lorem non ullamcorper tincidunt. Curabitur auctor ac nulla nec elementum. Donec quis leo in felis dapibus facilisis non non mi. Proin fermentum risus sed risus interdum consequat. Nunc malesuada ornare urna, sit amet commodo diam. Praesent consectetur convallis nisi sit amet euismod. Aenean nec egestas neque, eu rutrum dolor. Nam tellus quam, semper ac est ultrices, efficitur viverra tellus. Nulla ornare, ipsum sed fermentum venenatis, magna felis malesuada nibh, vel posuere libero est non ligula.</p>\r\n\r\n<p style=\"text-align:justify\">Vivamus vitae felis elementum, fermentum tellus at, tempor neque. Sed sit amet nunc a velit consequat pretium. Pellentesque efficitur, lacus eu porttitor mattis, lorem mi pretium massa, eu luctus dolor elit in quam. Nulla risus arcu, porttitor nec tempus sit amet, consequat vitae sem. Duis tincidunt fermentum scelerisque. Pellentesque maximus, tellus sed fermentum mollis, leo velit tristique lectus, nec gravida enim purus eu ligula. Vivamus maximus non neque vitae hendrerit. Nam luctus quam quis sem congue, sed malesuada justo malesuada. Curabitur id rhoncus est. Pellentesque tincidunt orci nec nulla congue accumsan sed ac nibh. Donec vel erat id tortor porta vestibulum vitae vitae mauris. Fusce eget est id velit lacinia ultricies. Aenean varius, orci non consectetur feugiat, lectus mauris gravida ante, at auctor dui urna vitae dolor. Etiam ut sagittis ligula, a consequat magna. Fusce tincidunt semper dui, vel semper orci pellentesque et. Ut eu libero aliquet elit iaculis dapibus.</p>\r\n\r\n<p style=\"text-align:justify\">Nullam malesuada ultrices turpis sit amet mattis. Mauris convallis metus id ligula congue eleifend. Sed dapibus suscipit malesuada. Quisque ut imperdiet ligula, eget blandit tellus. Quisque at varius justo. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Pellentesque eros ipsum, varius congue malesuada et, suscipit a purus. Aliquam consequat nisl sed fringilla blandit. Nulla facilisi.&nbsp;</p>\r\n', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vulputate scelerisque ante non imperdiet. Mauris tempor est eu luctus venenatis. Phasellus ultrices', 'lorem-ipsum_20220721_0921.png', '2022-07-20 09:29:52', '2022-07-22 13:26:45', 19, 2, 'lorem-ipsum', 'tes,lorem');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL,
  `author_username` varchar(125) NOT NULL,
  `author_fullname` varchar(100) NOT NULL,
  `author_desc` varchar(255) NOT NULL DEFAULT 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil voluptatibus in ullam eum corrupti reiciendis.',
  `author_email` varchar(100) NOT NULL,
  `author_twitter` varchar(100) NOT NULL DEFAULT 'loujaybee',
  `author_github` varchar(100) NOT NULL DEFAULT 'loujaybee',
  `author_link` varchar(100) NOT NULL DEFAULT 'loujaybee',
  `author_avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `author_username`, `author_fullname`, `author_desc`, `author_email`, `author_twitter`, `author_github`, `author_link`, `author_avatar`) VALUES
(2, 'tri', 'Tri Yatna', 'Penulis biasa', 'contact.tri@triyatna.me', 'triyatna30', 'triyatna', 'triyatna', 'avatar-1.png');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_slug`) VALUES
(19, 'tes', 'tes'),
(20, 'ada', 'ada');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `comment_username` varchar(100) NOT NULL,
  `comment_avatar` varchar(255) NOT NULL DEFAULT 'def_face.jpg',
  `comment_content` text NOT NULL,
  `comment_date` timestamp NOT NULL DEFAULT '2020-02-14 03:28:00',
  `comment_likes` int(11) NOT NULL DEFAULT 0,
  `id_article` int(11) NOT NULL,
  `article_slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('1','2','3','4') NOT NULL,
  `unique_query` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `name`, `type`, `unique_query`, `url`, `filename`) VALUES
(1, 'CV', '1', '0a572dea042bd95021d3f8f4d5fb60ec', './assets/CV-TRIYATNA-ENG.pdf', 'CV-TRIYATNA-ENG.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(110) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `view_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(250) NOT NULL,
  `view_cv` enum('false','true') NOT NULL DEFAULT 'false',
  `user_by` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id`, `ip_address`, `browser`, `view_at`, `status`, `view_cv`, `user_by`, `country`) VALUES
(48, 'localhost', 'Browser: Google Chrome 101.0.4951.67 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '2022-05-18 11:20:01', 'Download CV', 'true', 'Guest', 'Indonesia'),
(49, 'localhost', 'Browser: Google Chrome 101.0.4951.67 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '2022-05-18 11:24:36', 'Download CV', 'true', 'Guest', 'Indonesia'),
(50, 'localhost', 'Browser: Google Chrome 101.0.4951.67 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '2022-05-18 11:27:54', 'Download CV', 'true', 'Guest', 'Indonesia'),
(51, 'localhost', 'Browser: Google Chrome 101.0.4951.67 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '2022-05-18 11:29:30', 'Download CV', 'true', 'Guest', 'Indonesia'),
(52, 'localhost', 'Browser: Google Chrome 101.0.4951.67 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '2022-05-18 11:31:56', 'Download CV', 'true', 'Guest', 'Indonesia'),
(53, 'localhost', 'Browser: Google Chrome 101.0.4951.67 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '2022-05-18 11:36:09', 'Download CV', 'true', 'Guest', 'Indonesia'),
(54, 'localhost', 'Browser: Google Chrome 101.0.4951.67 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '2022-05-18 12:18:48', 'Download CV', 'true', 'Guest', 'Indonesia'),
(55, 'localhost', 'Browser: Google Chrome 101.0.4951.67 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36', '2022-05-18 12:31:13', 'Download CV', 'true', 'Guest', 'Indonesia'),
(56, '127.0.0.1', 'Browser: Google Chrome 103.0.0.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-11 04:56:56', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(57, '127.0.0.1', 'Browser: Google Chrome 103.0.0.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-12 01:46:27', 'logout', 'false', 'admin', 'Tidak terdeteksi'),
(58, '127.0.0.1', 'Browser: Google Chrome 103.0.0.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-12 01:46:32', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(59, '127.0.0.1', 'Browser: Mozilla Firefox 102.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0', '2022-07-12 01:48:38', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(60, '127.0.0.1', 'Browser: Google Chrome 103.0.0.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-13 04:56:15', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(61, '127.0.0.1', 'Browser: Mozilla Firefox 102.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0', '2022-07-13 05:12:01', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(62, '127.0.0.1', 'Browser: Google Chrome 103.0.0.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-14 14:58:27', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(63, '127.0.0.1', 'Browser: Google Chrome 103.0.0.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-16 03:10:25', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(64, '127.0.0.1', 'Browser: Google Chrome 103.0.0.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 04:15:15', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(65, '127.0.0.1', 'Browser: Google Chrome 103.0.0.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-18 17:44:30', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(66, '127.0.0.1', 'Browser: Google Chrome 103.0.0.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-20 14:01:54', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(67, '127.0.0.1', 'Browser: Google Chrome 103.0.0.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/103.0.0.0 Safari/537.36', '2022-07-26 01:32:45', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(68, '127.0.0.1', 'Browser: Mozilla Firefox 102.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0', '2022-07-26 18:15:57', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(69, '127.0.0.1', 'Browser: Mozilla Firefox 102.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:102.0) Gecko/20100101 Firefox/102.0', '2022-08-04 16:04:24', 'login', 'false', 'admin', 'Tidak terdeteksi'),
(70, '127.0.0.1', 'Browser: Mozilla Firefox 103.0 on windows reports: <br >Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:103.0) Gecko/20100101 Firefox/103.0', '2022-08-30 09:58:21', 'login', 'false', 'admin', 'Tidak terdeteksi');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(100) NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('1','2') NOT NULL DEFAULT '1' COMMENT '1=UNREAD 2=READ',
  `type` enum('1','2','3','0') NOT NULL DEFAULT '0' COMMENT '1=TRASH 2=SENT 3=DRAFT	0=INBOX',
  `msg_unique` varchar(20) NOT NULL,
  `avatar` varchar(255) NOT NULL DEFAULT 'https://i0.wp.com/www.cssscript.com/wp-content/uploads/2020/12/Customizable-SVG-Avatar-Generator-In-JavaScript-Avataaars.js.png?fit=438%2C408&ssl=1',
  `to_by` varchar(15) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `phone`, `subject`, `message`, `ip_address`, `message_date`, `status`, `type`, `msg_unique`, `avatar`, `to_by`) VALUES
(2, 'tri yatna', 'triyatna372@gmail.com', '2147483647', 'TESTER', 'asdasd', '127.0.0.1', '2022-07-20 06:46:41', '2', '0', 'fWWCRgaO8cBxVNK1rSVR', 'https://ui-avatars.com/api/?background=102023&color=fff&size=200&name=Tri%20Yatna', 'admin'),
(5, 'tri yatna', 'triyatna372@gmail.com', '62895349086103', 'TESTER', 'asd', 'localhost', '2022-07-15 06:46:41', '2', '0', 'gcYnjclifaNkwPA5A6o5', 'https://ui-avatars.com/api/?background=102023&color=fff&size=200&name=Tri%20Yatna', 'admin'),
(6, 'tri yatna', 'triyatna372@gmail.com', '+62895349086103', 'TESTER', 'hahahsdadsad', 'localhost', '2022-07-15 06:46:41', '2', '0', 'q7G1IlOzmGG7J5XT2c6s', 'https://ui-avatars.com/api/?background=102023&color=fff&size=200&name=Tri%20Yatna', 'admin'),
(7, 'tri yatna', 'triyatna372@gmail.com', '+62895349086103', 'TESTER', 'ads', 'localhost', '2022-07-15 06:46:41', '1', '0', 'o5G23kAXGBqTTCkyQfIv', 'https://ui-avatars.com/api/?background=102023&color=fff&size=200&name=Tri%20Yatna', 'admin'),
(8, 'asdasdasd', 'asdasd@dasda.co', '2131', 'TESTER', 'asdasdaasdasdasdaasdasdasdaasdasdasdaasdasdasdaasdasdasdaasdasdasdasda', 'asdasd', '2022-07-15 06:46:41', '1', '0', 'ebmS9T3wQKkzrnjVmLjt', 'https://ui-avatars.com/api/?background=102023&color=fff&size=200&name=A', 'admin'),
(12, 'kuuasdasd', 'asdacc@sdaaa.as', '21313131', 'TESTER', 'sdacccccxxzzzeee', '123144444', '2022-07-15 06:46:41', '1', '0', 'PlECu6asSvh', 'https://ui-avatars.com/api/?background=102023&color=fff&size=200&name=K', 'admin'),
(20, 'tri yatna', 'triyatna372@gmail.com', '62895349086103', 'TESTER', '<p>hey bro</p>\n', '127.0.0.1', '2022-07-29 10:41:01', '2', '2', 'gcYnjclifaNkwPA5A6o5', 'https://i0.wp.com/www.cssscript.com/wp-content/uploads/2020/12/Customizable-SVG-Avatar-Generator-In-JavaScript-Avataaars.js.png?fit=438%2C408&ssl=1', 'admin'),
(21, 'tri gov', 'triyatna.my@gmail.com', '12345292018', 'CEK', 'hello ', '127.0.0.1', '2022-07-30 05:18:39', '2', '0', '02cb87b8bb8cf5370ccd', 'https://ui-avatars.com/api/?background=1cc9ea&color=fff&size=200&name=tri gov', 'admin'),
(22, 'tri gov', 'triyatna.my@gmail.com', '12345292018', 'CEK', '<p>hay</p>\n', '127.0.0.1', '2022-07-30 05:19:22', '2', '2', '02cb87b8bb8cf5370ccd', 'https://i0.wp.com/www.cssscript.com/wp-content/uploads/2020/12/Customizable-SVG-Avatar-Generator-In-JavaScript-Avataaars.js.png?fit=438%2C408&ssl=1', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(1) NOT NULL,
  `name` varchar(125) NOT NULL,
  `description` varchar(500) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `favicon` varchar(225) NOT NULL,
  `logo` varchar(225) NOT NULL,
  `footer` varchar(500) NOT NULL,
  `smtp_host` varchar(255) NOT NULL,
  `smtp_username` varchar(255) NOT NULL,
  `smtp_password` varchar(255) NOT NULL,
  `smtp_port` int(3) NOT NULL DEFAULT 465,
  `smtp_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `name`, `description`, `tags`, `favicon`, `logo`, `footer`, `smtp_host`, `smtp_username`, `smtp_password`, `smtp_port`, `smtp_name`) VALUES
(1, 'Tri Yatna', '', '', 'favicon.ico', 'logo.png', '', '', '', '', 465, '');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tags_id` int(11) NOT NULL,
  `article_slug` varchar(220) NOT NULL,
  `tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tags_id`, `article_slug`, `tags`) VALUES
(74, 'sdadasd2332', 'asd'),
(75, 'sdadasd2332', 'cvvf'),
(76, 'sdadasd2332', 'asdasd'),
(83, 'lorem-ipsum', 'tes'),
(84, 'lorem-ipsum', 'lorem');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `avatar`, `created_at`) VALUES
(1, 'admin@admin.com', 'admin', '$2y$10$JBNJhJsXRhogz8olzAROKesYIAgotZGY7VYaRR4iodJP0QdnxJ3YG', 'model2.jpg', '2020-08-08 11:46:05'),
(3, 'test@test.com', 'test', '$2y$10$7gy27M9yBNjzQkY.Aklo3.JVMkKZia9MAqmXH8zdKuSQwkz5UeOtm', '', '2020-08-08 12:38:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `article_category` (`id_categorie`),
  ADD KEY `article_author` (`id_author`),
  ADD KEY `article_slug` (`article_slug`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_article` (`id_article`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tags_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tags_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_article` FOREIGN KEY (`id_article`) REFERENCES `article` (`article_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
