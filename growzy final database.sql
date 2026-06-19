-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2026 at 12:13 PM
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
-- Database: `growzy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `name`, `email`, `password`) VALUES
(1, 'ziad muzan', 'muzan@gmail.com', '56789'),
(2, 'Tarek', 'tarek@gmail.com', '$2y$10$MKaXQtkmuwsPGMW2HAooJ.t0ZGaqpl07fRE0QRPljoYgiNHre4/eS'),
(3, 'Super Admin', 'superadmin@growzy.com', '$2y$10$ecoQp4guPVkdwkMK54EmMuzSuEFcnxSBJM1bczWLeqEYofqYKO0kC');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryID` int(11) NOT NULL,
  `description` text NOT NULL,
  `catName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryID`, `description`, `catName`) VALUES
(1, 'anyting related to metals,steel,stainless steel and so on', 'metals'),
(2, 'anything related to papers,trees etc...', 'paper'),
(3, 'ceramics,floors, glass and so on', 'ceramic'),
(4, 'anything corporates related, small businesses and more', 'corporates'),
(5, 'anything fabric related and clothes', 'clothes');

-- --------------------------------------------------------

--
-- Table structure for table `consultancysession`
--

CREATE TABLE `consultancysession` (
  `sessID` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `duration` int(11) NOT NULL,
  `dateTime` datetime NOT NULL,
  `userID` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultancysession`
--

INSERT INTO `consultancysession` (`sessID`, `status`, `duration`, `dateTime`, `userID`, `is_deleted`) VALUES
(1, 'ongoing', 2, '2026-06-25 15:30:00', 18, 0),
(2, 'ongoing', 1, '2026-06-16 17:06:37', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedbackID` int(11) NOT NULL,
  `content` text NOT NULL,
  `rating` int(11) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sessID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `ideaID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `content`, `rating`, `timeStamp`, `sessID`, `userID`, `ideaID`, `adminID`, `is_deleted`) VALUES
(2, 'feedback about a business idea', 9, '2026-06-16 15:18:08', 1, 5, 2, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `idea`
--

CREATE TABLE `idea` (
  `ideaID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `attachment` blob NOT NULL,
  `investmentRange` int(11) NOT NULL,
  `catID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `idea`
--

INSERT INTO `idea` (`ideaID`, `title`, `description`, `attachment`, `investmentRange`, `catID`, `userID`, `is_deleted`) VALUES
(1, 'Smart Logistics System Updated', 'Updated descriptions for regional distributor AI systems.', '', 0, 1, 3, 0),
(2, 'paper forming', 'paper reshaping............................', 0x524946460e100000574542505650382002100000f06a009d012ada010a013e9d4ea14b25a4a321a8331908b01389636ee1677e5de10955658ca5b464c17af5e6afb7ff0fea1bc7fdfd7bdf4d6c3d7b072d3ea5ffadebb3fd87ec67becfef5fdb7d833fbff9687ad3fdcaf527fcaffc2fedf7bb77fbefdc7f7affdc3fbd755f7ad2ff14f52cfe17ff7fd6f7f277de03d2d3510bdf1da6f913ad7709760eedcbdafff43e127bad42b79582e5ff16e8b1f21aae5393dfa3dd354317bbeb62cc666b4cea9d31efd1ee9aa18bf6d3cd117bda822b728861ba41d319f1303b17b82335450802c3a60e2f89bf08b6d61c91eba6a862fafa9ba7991229698172dfec8a315dd683e9ef4e6faf52ba000b0c5a8dc3c9bf08fbc8c16a57cac63ab7e0dc96671a18e61c223a4a1a822d4985657c32bf24e496a3eb266a862fa331c5c2dc6bbfd531b6912266cf52abb402a6727a8672898927a356418e1af5b6be445a4dcfb130cb0a5bcd123f26380f816351d00ab34e4bd636e9e6088bea01a244f4ff6198a8a3c10d47d4e46e79a86f8badc6911b37daa162ddb9ab858d6f1e515979734e1ab4554c6809a83c9544be47ef168b566ed02b7825e3913ad5edcbdd4ecb503d7eda797266e0073245760cca480c92ceba18639c2fcc40e3399fc3f8b23ca5db4ad39fd8e504e7c23a6309c66849c5134a475ef5842e1ad00b0c5fbdfed5516196e5497428144c92b7a7a97d6330e011ca0c26ad1bc26ae366fbf75b33a497f170f7396f6430db5bd07ed3d07ddaa5996b0d67618f0ec97fea1370fd2fa5c89ff0f4495c3dcd6e824ed75548450f2125cb856d11f08ddd82704bbf010edf7b058afe7716ac78023b797dd50e39a1ee4741a381b59e0ff0c11dbc5d97eaf47bd06bf6d9d0d5dea2d3c0179d174b7b6b337703c5db0665a76138c15d1bbe5647bac64f1645360209fbff30dc7ff239da41140b0890f3fa8795bad9f04d24f090dcb4b63570e1e3527bf47b6e2b59a035e99a953ddc6f2886c967cdd26f26f09ce791021e86fa9c92dcc0e99efd1dc344e3c88986a862c616824471bbaeded6b039e5afe87bf47ba6a860bb7e89b3c548a74c4779fbf7a68013bb616ad72a5e9bc5cc93c4469fc217fae9aae7bf430a5a20c35ef74cca1bf26339805d4c4f5f8dc15d3b3171e95ee504a6a862fdb61a893953b2094d47fc270495335cc1ccddb5430ec34960e58c8044ede2804274d215e367af980000fee7eb0000425102a59f68d17747dca5a2c7dc5b831fd29edcf01ec3f58c3ee991e0cf1d99b100002a25fd2754e967fded3340d715e39752308c20e1c11d080c3f2e139e8d9dc8f81ec6063b2922767b1b845bddac6b313e2d2cf15af142162ce1a66dffd73875b3cda49f25323fb3628ec42b3b92b0b719085b4a883109fe93c2009487e44bed34db1898c86b855b19bafc581585186a904f2233b010bed1a4a07174c361aba4811226935f5d00096bda69e625fde89c814640cece4653de585ff3c1d3122f6f69d94ca7b45d020bc04f5bdc778665ca3b210c06fdb891187a35e36daef4d915cf32246441d34afc1932263fe057f8dd2d85208c9a052c3500ff3b48d35d6fb6b94f814eebbcb79054e206ac1ebbd9caacab3c796a932399a95a10f55f23c78bd510209a6774626202d78de84b1f7aa2cd8c695fa1f0b97d9f1680d835c631e26686bbe4ce3b9394a4ddb9301b12340a8e42e3f3b2b75f63cae46cdac3b7c03579084f00b59cfb48151f9281759dec982dca94dd3239c6b9de277e7917f2afdf3853cef86790824526976ae28e46ba08c46bb44a9244a4b66f718b7b9b6b020493823ee6bfb2d1263a70ed7a87cbce2ae927cb14da9d3855542385b48fd448af0eeed56b0f7d86555360490079a3ed3e657fe9393405e2df0694eb0987df080ac8e8b074821738ca84323d398ea0a14fec713c9014a5d52b9dfe692192b6e5005ffde6163fdc9a5423001ad5e48f57554e472f9649b76b7fafa45cc8117ae5eaba34e703d1025f3841720f423ab0db94c1bd33d798cd79d83d05cef92d049d0279d2c2cc09b882183e19f3800b9d82865603f5c164d29320bab3972d8b749b5b80712c5f4861cabe0fa0ef5a5841e5038e7e6b1c243b57815038bf78e763bc3608934f2e0a5905df82e396dcb1cd057feb25008a2eef6d75f890f3bf38d18ec2c6ec1767904cf7dc51ba1c5f178a504340ab6dbe7ac25c76614eb3d5156444ffcca3d854f58bb8608eed87731baa2879e1d6c20e5e4b93bdc15ea3e9cef63f06d90fd398f38a24ce8fadb377ec9fedac8021736be43e02642995e990ca176758aa8ca9f13e38728e4aa6eae12b869ce1e25c5d4e4a16d368599da7994fdaa1c0f501fd13c5b70f161bec4b699b36848ad6445b3615ce9aab0568fad675b8db2fbfa41e3ccf6e8aee12477244099f79610e498569b4cb8f5a7ba3bb9760cb7a1050d1adade7afc16c09e5448a8335a3a14db97f0d2cfbc2326473bb721816013adbe51dcb3a2a71d9fe0fc941c2766368a6a91fc73830f13f49cb43ca19d8842772fa598278322eb2f13dd6633b8abbee57ba91e15dd06440f37a89a096110b18912e177ff5901c9d7484053f4dba884f5ff240f41e2de0fb0e66e51ae83eecc8a605ab41b3739a145fd6e03946c05d1c3e97aba0f5df2840f42caee117aacde2de200b043578894d5d1b024abd385904004d8d92697b318ed490215057ea616abf47f125a73773c7a322d45d1515d4975f8d78ba4c851c678c964c2399c1d383d0eab39b201be5a8a1ab280bc39e1d7f3077c8310946c72efd5770053b97f8e99d37cb481d5c9fa65a399cc3969fa51a6d290d549a340d097225072d9b0a01249b4624fae2f1c539ddfc52dd01311c597d72142c3afeaad1a75d49d3de61794fb41ea1c4a21d2a29de5be53c99afdc30de622ebe0c4e32f82eaf7dec5ffff85f7b931c3b32129542effef363a80d45274145453796f5ff5935397eaa6fd150c5294d3911ceb4b085639827fc9bafa18cdff12d1aff54f1ece0106d2c18576e7e0ae86b8f2fbe10eb62e83cd2d31af37ec9cf9b3dfbb6413218a98ab4eeb0722fa67606e50b147244724a79f4b5d8f752fb204348b2d75a6b3f91bce57adc7a57bb609cfc7d407425d3b08bb396621e4cc336946c3bca66b4520b36c0b7622f32cd56cc2c899b527a637eb4ecc555118b3a1c5ff978e5db8d737a9a7289a04eb4580f705fa994ba6f73e21b0c8cd8015b0df1930af67e1d43e25a2fb3b6e224564cc02189f391ce09ef57ed086af50108ad3ac555147d51ae4e8d88dda472394009d4da3febf3c069743c5b87de78eab00dfa1b5e989f50dcc12af82241ded64b1f6fd8e2edd066d64b24a1ed203382dbb2ef3f6d13e99054ed229bf9637e1182cc2dd25f9ad8cc631d58cf1bc4f06d42d62d6c615204971a4227b33b342692f533d8121ab3332ada950637ae1610bb0b1b2bf2e351608cf7fa37c3b81f000f048a4f0a76169a23dd07d6bdd08a377a936439c001a2bb299ac5cc854572a08334aba384b5b494143fdb1ac480c28a4f6c227010280700b64c4d5135f1b5494fc40f1cb4409ce4ed2a8d7cb8158f3679e37df75164fe807b4f1ec14aeeb89700fefbddb36b53b27250f1da411f2f8f212a3b418ab6d28ef30970026b1dbcf9baeee2b6d6d99810ba268346ed2b8b2422c1e8114c8e82b18c93f41006890c6b65f1a49e4928904cf60939e4804ae70bbe9e00af05f830cb566f4ed7ba4aac437ff3f9d4546ca77bca6573da96d686c950b6863ade9a404ed00b9099a492271fbb2db4dd74fad9a517ed917df98aeff1610237b26b4778d578c11cb586ecea405c3e0a37d9da1fea549ad85d46a96f43b4e5f883de32817d39466d938ea2a5f2c182c34022f68c7fc9c608124521e11df92c4b8db9e34f31cea722102c407db408363ff2d098ff067d5ad7855bb411f4d0b3de701209cf3766c94232d8c44a194014b29576c0d9a4c8f03bc39bf9f0717c0c805b7991057f66acbd351206eeb8a18d0489ca8343825dddedfca84196c5fc3e8c7d06c2a30b1bfdd817d61753fab8f084a3bced6167e2684d8e87c6683039eac5962e420f36295bbd442a303c422b2fdd2366b285993ee8c37a27295ca8bc38cf167a60ab38f0bc0c072ccb4f0e7fab74486ad5034e9d4610f588e8c54c1ce7e69610c6ca3d1e8e2e2cd6d235d611457aec1934537bd8407d19fa414fd585a06952cd0f9ecdb545e9d85dec4b8e014881397f5a4f7ad3605d93c8acd02d69b480f6dfca80287237ae5ab341883f0ef0b79d59cfc467160515687cc69d46647817935b8f8a839147c26956749f8a51ef6fbb0fdb5338986ec424aa55769d12f98e662d6df41d47a53e45d1fa6e2343798a5a81686027f906020adbd2ed69d7ed10e6145d2c0769da37edd61de52e0f46e9396e28570c7f297889fe931cfb38dd9343df8337a1a104b4fb96c257999ca026af4ecd8f829ad54c63c974312ab5aad4c34653c656cf8d4369642d86ded2ba48124c6a395fa93ce90beedc0e0aa4ffacad358c91cc11b82af4100d25a6943b033d1bd05fa34ec656e26925ca1036e5d5f4130b2a5857fd87dd9c45ebd0ac58781ee8a0e8c3b286c5cc2c1cd229dd98b9b64ab42ccfc2a10d9ead9a198e49b633d44610e696b297a06e135a640ba1c9cbdbe13b5453a5c884606a42f9e7715bb5fa9c1601457b55d7b9b9d8acf61f86549a8a5c89873115542a1ca8231ebb76245c58a49708830ea130de551509aed97b77b5bee3c1575d5c47a7b95ee365b85e468a729daec6e49e9c67cc2090bc80828c4f287fc58f0f5c12df555e189430b0a185b6b99dbaed71b4d52e16d62563983a1e5b81a98e31d54e9f87e42d66bd505a3e8d70b1ec919a7e2abd895394e8a62911acb016bb3ade7970547b8f416dac935099bcc4b089d55a97a5e5547a5c4a00f40f6e83f1f71bef541c9c429a6b4fdb2921817425114e0912d8b4ce6e290a8cce98575e501d9b65a3a8c36cfb0be5871a50c7ec00febc0e28cfc132dfa1fc0c317f63d2e5461eb046eff199c32a3dedcf4f7e8833e0a03fa015cfc4a14b9f36824d00b08d5b59fb7325538c3e82128981c37f4aff1109d30d95c43b6bc862b5a43a7215328cdba6f982aeb702d0bdecc740bcb5fdf51af739ee697fb5d015b464c68ee33ad26516f055a100f696c048317808446216c5bc5962bd03344503b9e359b6ff5b820ab3af9cf6be2a6217e9a5a379e447639a809090c8263d4fb07c392adb6d35d85c6765dc980f3d3bb4bfc0d0f669200d4015f4bcc0ee0b4f310fc9927478f5d8d4a83150c81bad33ddbc8a6acd56a0766577934fe7454e7ac27dc1c6d1f862df0f273267850a27753d34515c52e2dc8d8bcfd2b4e192892eade74b50ccf999c9f1504035801daad931a2b7959545cf3de36da6710dc7f1b162633668fb8901afdb35e51f4fa82223fe0c869c108fcc4e98d0d595678b9d8ea3b5e52a4595ee9e82e23872acaa9a156cad8d0fb3e6f5cac945caea705b6bb10c5f4d2792f138f14969eeec573cd0e90707b0dd65eeca9a7dacb791879dc549a68cc5c37a1a6510bbe20374adb1f6f53d642031ea9c18a9db06f9d62f3db31d8a88a1ffbc0db1bf843bdab9beaff7ea26259a7b7e5061a36fa822e5718ea581156f02a10a58f7b727b6560e6826b4a9449bdf861c1c8d4273fbcb06e3eaf0f9013b1174555d302ca66cf638418e0a5f82b6af1610ffc7ead86281650b99ddd723e46d0d7fb478800000, 5000, 2, 5, 0),
(3, 'Smart Farming App', 'Application for managing farms', 0x696d6167652e706e67, 5000, 1, 1, 0),
(4, 'Smart Farming App', 'Application for managing farms', 0x696d6167652e706e67, 5000, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hanaeid136@gmail.com', 'hi', '2026-06-17 00:30:58');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `reqID` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `documentation` blob NOT NULL,
  `type` enum('send','recieve') NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `description` text NOT NULL,
  `userID` int(11) NOT NULL,
  `ideaID` int(11) NOT NULL,
  `adminID` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`reqID`, `status`, `documentation`, `type`, `timeStamp`, `description`, `userID`, `ideaID`, `adminID`, `is_deleted`, `deleted_at`) VALUES
(1, 'ongoing', 0x66696c652e706466, 'send', '2026-06-18 22:13:18', 'sending a get request', 1, 1, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','business_owner','investor') NOT NULL,
  `yearsOfExperience` int(11) NOT NULL,
  `field` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `name`, `email`, `password`, `role`, `yearsOfExperience`, `field`) VALUES
(1, 'Hana Mohammed', 'hanaeid136@gmail.com', '$2y$10$5yK3Uve0k8hu6Y9P4qZg2eBnC46/pqj1ApGMIH2Tv9LTZAjmiSHFe', 'investor', 6, 'clothes'),
(2, 'ziad muzan', 'muzan@gmail.com', '56789', 'admin', 10, 'corporates'),
(3, 'mayada ibrahim', 'mayada@gmail.com', '34567', 'business_owner', 4, 'steel'),
(4, 'mohanad ayman', 'mohnad@gmail.com', '90001', 'investor', 3, 'ceramic'),
(5, 'Hana Mohammed Updated', 'hanaeid1365@gmail.com', '20062006', 'business_owner', 7, 'fashion'),
(6, 'hussain', 'hussain@gmail.com', '$2y$10$aHkH2S4qlD9gQe9Pl40JbuPrDIWrOphzeG.QUIZoJE45VLWcP1Ewi', 'investor', 0, ''),
(8, 'medhat', 'medhat@gmail.com', '$2y$10$gOkZlGTMrTlQ9NSHsCMKW.1VqJYsZpEgeYjOBaQlEiq.juEjppOn6', 'investor', 0, ''),
(9, 'medhat', 'medhat@gmail.com', '$2y$10$i4EqWChcq7MC6GrUF5i/degEZi91vzOteJMMNLGuK2jLLSLO8ZD06', 'investor', 0, ''),
(10, 'Tarek', 'tarek@gmail.com', '$2y$10$vpWcluBmn7O9bc7EyMlh/uEQ7hewtDUgR.yOwyWygDf7jt9uKLpB2', 'admin', 0, ''),
(11, 'mayada ibrahim', 'mayada@gmail.com', '$2y$10$AzQ3obTq7bKuTcXVS8/sjesVWhUWV3amHESQBEDBEkDA86Eroitii', 'business_owner', 0, ''),
(12, 'Tarek', 'tarek@gmail.com', '$2y$10$MKaXQtkmuwsPGMW2HAooJ.t0ZGaqpl07fRE0QRPljoYgiNHre4/eS', 'admin', 0, ''),
(13, 'jana ayoub', 'jana1@gmail.com', '$2y$10$Q9zt5Q86u.CrL2Oz6vxUPew7GGrxrsVz2werae7y61eoNnRUkaSQ6', 'investor', 0, ''),
(15, 'jana Hayoub', 'jana2@gmail.com', '$2y$10$M1kXhM0P8SGkdaJXu/jw/.B4GMAfMtVwJUYXx3IbbFPioLPyywAsG', 'investor', 6, 'clothes'),
(18, 'Super Admin', 'superadmin@growzy.com', '$2y$10$ecoQp4guPVkdwkMK54EmMuzSuEFcnxSBJM1bczWLeqEYofqYKO0kC', 'admin', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryID`);

--
-- Indexes for table `consultancysession`
--
ALTER TABLE `consultancysession`
  ADD PRIMARY KEY (`sessID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedbackID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `sessID` (`sessID`),
  ADD KEY `adminID` (`adminID`),
  ADD KEY `ideaID` (`ideaID`);

--
-- Indexes for table `idea`
--
ALTER TABLE `idea`
  ADD PRIMARY KEY (`ideaID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `catID` (`catID`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`reqID`),
  ADD KEY `ideaID` (`ideaID`),
  ADD KEY `adminID` (`adminID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `consultancysession`
--
ALTER TABLE `consultancysession`
  MODIFY `sessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `idea`
--
ALTER TABLE `idea`
  MODIFY `ideaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `reqID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consultancysession`
--
ALTER TABLE `consultancysession`
  ADD CONSTRAINT `consultancysession_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`sessID`) REFERENCES `consultancysession` (`sessID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_3` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `feedback_ibfk_4` FOREIGN KEY (`ideaID`) REFERENCES `idea` (`ideaID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `idea`
--
ALTER TABLE `idea`
  ADD CONSTRAINT `idea_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idea_ibfk_2` FOREIGN KEY (`catID`) REFERENCES `category` (`categoryID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`ideaID`) REFERENCES `idea` (`ideaID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`adminID`) REFERENCES `admin` (`adminID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `request_ibfk_3` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
