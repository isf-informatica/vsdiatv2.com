-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2022 at 03:22 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easylearnv2`
--

-- --------------------------------------------------------

--
-- Table structure for table `el_aboutus`
--

CREATE TABLE `el_aboutus` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `vision_image` varchar(255) NOT NULL,
  `vision` varchar(255) NOT NULL,
  `mission_image` varchar(255) NOT NULL,
  `mission` varchar(255) NOT NULL,
  `values_image` varchar(255) NOT NULL,
  `value_s` varchar(255) NOT NULL,
  `aboutus_description1` text NOT NULL,
  `aboutus_description2` text NOT NULL,
  `demovideo_path` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_aboutus`
--

INSERT INTO `el_aboutus` (`id`, `unique_id`, `heading`, `vision_image`, `vision`, `mission_image`, `mission`, `values_image`, `value_s`, `aboutus_description1`, `aboutus_description2`, `demovideo_path`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20220624024133, 'What is EasyLearn?', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/visionjpg_1384_1655803506.jpg', 'Education For All.', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/missionjpg_4006_1655803506.jpg', 'EasyLearn allows its users to get access to digital world.', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/valuejpg_2153_1655803506.jpg', 'Respect For Individuals', 'EasyLearn is an advanced e-learning platform that provides an integrated digital experience for Schools, Colleges and Universities. It has been designed with a motivation to provide an easy user experience, a highly secured platform with the competency to support large data.\r\n\r\nThis product is currently being deployed globally and is being provided as a \'Service,\' to impart education. It is easily configurable, and implementable in a less record time.\r\n\r\nEasyLearn is an ultimate source that provides great knowledge or education imparted by the teachers to the students learning online.', '1. Online education & incubation with emerging technology support will have a widespread requirement in the coming days.\r\n\r\n2. EasyLearn is targeted at Incubators, Accelerators, Start-ups, Corporates, Schools, Colleges, Universities, etc.\r\n\r\nUse our embedded mentoring tools like video conferencing, whitebord, file manager and document manager and have the best learning experience! For more information watch video. OR Get a free', 'https://isfmedia.s3.ap-south-1.amazonaws.com/EasyLearn/EasyLearn+Demo.mp4', '2022-06-20 22:55:05', 1, '2022-06-24 07:41:33', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_accounts`
--

CREATE TABLE `el_accounts` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `permissions` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `mfa_status` tinyint(4) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_accounts`
--

INSERT INTO `el_accounts` (`id`, `unique_id`, `reg_id`, `username`, `email`, `pass`, `permissions`, `status`, `mfa_status`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20220622151540, 0, 'Super Admin', 'info@easylearn.net.in', '$2a$12$WbCJW2dcnpz2GV4v70wWvufSypVYI.YVzSlbEeTt.Vr7Ti8QD1cPu', 'Super admin', 'Verified', 1, '2022-06-22 09:45:40', 0, '2022-06-22 12:28:37', 0, 0),
(3, 20220624082554, 0, 'Admin', 'admin@easylearn.net.in', '$2y$10$B3ame6mjzsF8Fe16qS.ScurXinf2Z0UgPxrgzGJPiBivGepjzt49q', 'Admin', 'Verified', 0, '2022-06-24 13:25:54', 1, '2022-06-27 06:43:57', 1, 0),
(4, 20220629120600, 1, 'School Admin', 'schooladmin@gmail.com', '$2y$10$B3ame6mjzsF8Fe16qS.ScurXinf2Z0UgPxrgzGJPiBivGepjzt49q', 'School', 'Verified', 0, '2022-06-29 06:44:59', 0, '2022-06-30 05:36:01', 0, 0),
(11, 20220630054350, 1, 'Test Student', 'teststudent@gmail.com', '$2y$10$3mPfUYo.LujwiU61j5ut4OZrGOztIgGuffKyNfXvInSAP/PNj2QMu', 'Student', 'Verified', 0, '2022-06-30 10:43:50', 4, '2022-07-01 10:22:38', 4, 0),
(12, 20220630054351, 1, 'Test Parent', 'testparent@gmail.com', '$2y$10$MGAXHaeCJkIosgoAwtGTv.pqReskZMaTvLQFn93y.4zbWhq38m4Iq', 'Parent', 'Verified', 0, '2022-06-30 10:43:50', 4, '2022-07-01 10:22:40', 4, 0),
(19, 20220701052719, 1, 'Class Admin', 'classadmin@gmail.com', '$2y$10$5AP5JjvxJ35CsDW5Ijp6kuhkt2z6cKheQaz9G5ZWN/4Jpqa2isDV.', 'Classroom', 'Verified', 0, '2022-06-30 23:57:19', 4, '2022-07-01 10:27:19', 4, 0),
(20, 20220704072655, 1, 'Mukesh Nadar', 'mukeshnadar50@gmail.com', '$2y$10$HYEeI6jdxFaHxE7c3Z37BeEI6upA6LZUC3S5.QxevnmpdLXiSWD5q', 'Student', 'Verified', 0, '2022-07-04 12:26:55', 4, '2022-07-04 12:26:55', 4, 0),
(21, 20220704072813, 1, 'Class Admin two', 'classadmin2@gmail.com', '$2y$10$i2Y/hxKCdLNpvv7N68p2hOcIefNFS2OIlA/EjkNBt.Do/4k84aX6e', 'Classroom', 'Verified', 0, '2022-07-04 01:58:13', 4, '2022-07-04 12:28:13', 4, 0),
(23, 20220708012807, 1, 'New Mentor', 'mentoradmin@gmail.com', '$2y$10$PX8Wx07LkS4I6aLO8SDFLOwjJc.Q5xL.M0nlBX2TL5/cdCD5wnDve', 'Mentor', 'Verified', 0, '2022-07-08 06:28:07', 0, '2022-07-08 09:35:19', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_account_details`
--

CREATE TABLE `el_account_details` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `layout_pref` varchar(25) NOT NULL,
  `language_pref` varchar(25) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_account_details`
--

INSERT INTO `el_account_details` (`id`, `account_id`, `contact_number`, `description`, `profile_image`, `layout_pref`, `language_pref`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 1, '', '', '', 'Menu', 'English', '2022-06-22 09:48:25', 0, '2022-06-22 09:48:25', 0, 0),
(2, 3, '+919890906048', 'Country Admin', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Tapan-Daspng_3304_1656077153.png', 'Menu', 'English', '2022-06-24 13:25:54', 1, '2022-06-28 10:18:08', 1, 0),
(3, 4, '+919890906048', 'School Admin', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/User%20Manual_6522_1651750937.jpg', 'Menu', 'English', '2022-06-29 06:45:57', 0, '2022-06-29 11:49:15', 0, 0),
(10, 11, '+919890906048', 'Hello World', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_1220_1656585830.png', 'Menu', 'English', '2022-06-30 10:43:50', 4, '2022-07-01 10:22:43', 4, 0),
(11, 12, '+919890906048', '', '', 'Menu', 'English', '2022-06-30 10:43:50', 4, '2022-07-01 10:22:45', 4, 0),
(18, 19, '+91989297889', 'Class Admin', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_7518_1656671239.png', 'Menu', 'English', '2022-06-30 23:57:19', 4, '2022-07-01 10:27:19', 0, 0),
(19, 20, '+919890906048', '', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_8849_1656937615.png', 'Menu', 'English', '2022-07-04 12:26:55', 4, '2022-07-04 12:26:55', 4, 0),
(20, 21, '+9196375835', 'Hello World', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_3198_1656937693.png', 'Menu', 'English', '2022-07-04 01:58:14', 4, '2022-07-04 12:28:14', 0, 0),
(21, 23, '+919890906048', 'Hello World', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_8812_1657261687.png', 'Menu Layout', 'English', '2022-07-08 06:28:07', 23, '2022-07-08 08:10:52', 23, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_admin`
--

CREATE TABLE `el_admin` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `account_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `document` varchar(255) NOT NULL,
  `region_type` varchar(255) NOT NULL,
  `region_country` varchar(255) NOT NULL,
  `region_state` varchar(255) NOT NULL,
  `region_city` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_admin`
--

INSERT INTO `el_admin` (`id`, `unique_id`, `account_id`, `name`, `phone`, `dob`, `gender`, `email_id`, `image`, `document`, `region_type`, `region_country`, `region_state`, `region_city`, `description`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(2, 20220624082554, 3, 'Admin', '+919890906048', '2004-06-01', 'Male', 'admin@easylearn.net.in', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Tapan-Daspng_7936_1656311531.png', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/EasyLearn-Teaser-1pdf_3884_1656077153.pdf', 'Country', 'India', 'Maharashtra', 'Mumbai', 'Country Admin', '2022-06-24 13:25:54', 1, '2022-06-29 11:52:45', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_announcements`
--

CREATE TABLE `el_announcements` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `announcement_topic` varchar(255) NOT NULL,
  `announcement_date` date NOT NULL,
  `announcement_time` time NOT NULL,
  `announcement` varchar(500) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_announcements`
--

INSERT INTO `el_announcements` (`id`, `unique_id`, `reg_id`, `announcement_topic`, `announcement_date`, `announcement_time`, `announcement`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 607202203140176273, 1, 'EasyLearn Platform :', '2025-07-26', '01:45:00', 'fgfggh', '2022-07-06 08:14:01', 4, '2022-07-06 10:42:29', 4, 0),
(2, 607202205471026340, 1, 'EasyLearn', '2022-07-06', '16:15:00', '1st Announcement Description', '2022-07-06 10:47:10', 4, '2022-07-06 11:20:41', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_batches`
--

CREATE TABLE `el_batches` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `batch_name` varchar(255) NOT NULL,
  `batch_image` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `visibility` tinyint(3) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_batches`
--

INSERT INTO `el_batches` (`id`, `unique_id`, `reg_id`, `classroom_id`, `batch_name`, `batch_image`, `start_date`, `end_date`, `description`, `visibility`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20220706005560, 1, 7, '1st Batch', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_2858_1657086960.png', '2022-07-10', '2022-07-24', '', 1, '2022-07-06 05:56:00', 4, '2022-07-06 07:51:23', 4, 0),
(2, 20220706235610, 1, 7, '2nd Batch', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_2238_1657169770.png', '2022-07-10', '2022-07-26', '', 1, '2022-07-07 04:56:11', 4, '2022-07-07 04:56:15', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_batch_assignment`
--

CREATE TABLE `el_batch_assignment` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_batch_assignment`
--

INSERT INTO `el_batch_assignment` (`id`, `account_id`, `batch_id`, `classroom_id`, `added_on`, `updated_on`, `added_by`, `updated_by`, `is_del`) VALUES
(3, 11, 1, 7, '2022-07-06 13:17:00', '2022-07-07 04:44:22', 4, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_batch_course`
--

CREATE TABLE `el_batch_course` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_batch_course`
--

INSERT INTO `el_batch_course` (`id`, `course_id`, `batch_id`, `classroom_id`, `added_on`, `updated_on`, `added_by`, `updated_by`, `is_del`) VALUES
(1, 1, 1, 7, '2022-07-07 06:01:13', '2022-07-13 05:31:43', 4, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_benefits`
--

CREATE TABLE `el_benefits` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `benefit` varchar(255) NOT NULL,
  `benefit_description` varchar(500) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_benefits`
--

INSERT INTO `el_benefits` (`id`, `unique_id`, `benefit`, `benefit_description`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20211116082022, 'Organizes eLearning content in one location.', 'Instead of having your eLearning content spread out over different hard drives and devices, you can store all of your eLearning materials in one location.', '2021-11-16 02:50:22', 1, '2021-11-16 07:20:59', 1, 0),
(2, 20211116082101, 'Provides unlimited access to eLearning materials.', 'Once you upload your eLearning course materials onto the EasyLearn LMS and publish them, your audience has unlimited access to the information they need. Even those who are on the go can login to the EasyLearn platform via their smartphones and tablets, so that they don’t have to wait until their next online training session to develop skills and perfect work-related tasks. This is one of the main reasons why a LMS is essential for global audiences in different time zones.', '2021-11-16 02:51:01', 1, '2021-11-16 07:21:37', 1, 0),
(3, 20211116082139, 'Easily tracks learner progress and performance.', 'The EasyLearn System gives you the ability to keep track of learner progress and ensure that they are meeting their performance milestones. EasyLearn System feature reporting and analytics tools that also allow you to pinpoint areas of your eLearning course that may be lacking, as well as where it excels. If you discover that many of your online learners are struggling throughout a specific online lesson, for example, you can assess the eLearning content and make modifications if necessary.', '2021-11-16 02:51:39', 1, '2021-11-16 07:22:15', 1, 0),
(4, 20211116082217, 'Support efficient distribution of class materials.', 'By using the LMS to share class materials, all students—regardless of whether they are in class or learning remotely—will have access to the lesson including objectives, activities and resources. Textbooks can even be shared online. Instead of students purchasing and lugging one giant textbook to and from school every day, an up to date product can be integrated into the class page.', '2021-11-16 02:52:17', 1, '2021-11-16 07:22:48', 1, 0),
(5, 20211116082251, 'Resources in a variety of formats.', 'Resources are able to be sourced and disseminated in a diverse range of formats. This allows teachers to gather multiple resources on a topic or skill that will help students understand the context in a way that suits them. Videos and external sites can be embedded easily into the class pages to allow students ease of access as well as aesthetically engaging learning pages.', '2021-11-16 02:52:51', 1, '2021-11-16 07:27:51', 1, 0),
(6, 20211116082802, 'Parental access to class schedule, outlines and assessment.', 'Parents and guardians can have access to their child’s calendar, class timetable, outline and assessment dates. This creates opportunities for conversation to meaningfully occur outside of class time and parents or guardians can actively engage in their child’s learning. For students who need help with organisation, this can be a big help.', '2021-11-16 02:58:02', 1, '2021-11-16 07:28:46', 1, 0),
(7, 20211116082848, 'Enables diverse assessment options.', 'Assessment can take place online via multiple formats in an LMS. Short quizzes, multiple choices, questionnaires all provide the opportunity to deliver immediate feedback. Teachers can also reference an external site including video formats and apply questions or topics from that stimulus. Students have the option to upload their work in multiple formats including screencasts, podcasts or video.', '2021-11-16 02:58:48', 1, '2021-11-16 07:29:22', 1, 0),
(8, 20211116082930, 'Transparency on feedback.', 'Feedback from a teacher for formative and summative tasks can be easily shared with the student via the class page of an LMS. These can also be sent onto the parental page and allows all feedback to be kept and stored so students can easily access and action in later tasks.', '2021-11-16 02:59:30', 1, '2021-11-16 07:29:56', 1, 0),
(9, 20211116082958, 'Provides a number of communication options.', 'Schools can set up a variety of access points and groups to communicate learning via the Learning Management System.', '2021-11-16 02:59:58', 1, '2021-11-16 07:30:30', 1, 0),
(10, 20211116083038, 'Tracking student data.', 'Data from student assessment and attendance can be stored in the LMS and used to provide progression with learning. Those students who need extra support across subjects can also be easily identified. Likewise, students who are gifted and talented in more than one subject can be highlighted.', '2021-11-16 03:00:38', 1, '2021-11-16 07:31:06', 1, 0),
(11, 20211116083112, 'Enhances student organisation.', 'When uploading assessments, due dates, task requirements, criteria and information regarding a formative or summative task, an LMS allows teachers to automatically populate into the students’ calendar. This then helps students plan their homework and assignment time as they can see all of their tasks for the week, month and term and also add in extracurricular and personal commitments. It is also possible to share the calendar with parents or guardians.', '2021-11-16 03:01:12', 1, '2021-11-16 07:31:40', 1, 0),
(12, 20211116083149, 'Digitalisation of teaching and learning.', 'By digitising curriculum, students have access to the same unit outlines and resources regardless of what class they are in and create cohesion and equitable access across the grade. Units can also be archived for the following year, eradicating the notion of recreating work. Teachers can then use this archive feature to reflect upon, review and improve units for the following year.', '2021-11-16 03:01:49', 1, '2021-11-16 07:32:22', 1, 0),
(13, 20211116083229, 'Transitioning to remote learning in a heartbeat.', 'Using an LMS enables learning to take place in a variety of places, including the child’s home. Setting up digital spaces to deliver education acts as a safeguard to provide continuity to students in instances where schools need to transition to remote teaching with little warning.', '2021-11-16 03:02:29', 1, '2021-11-16 07:36:42', 1, 0),
(14, 20211116083652, 'Branding.', 'What makes the Learning Ecosystem so unique is that you can adapt and modify the LMS platform with your Institute’s own branding. The organization’s logo, color scheme, banners, and videos will create a familiar setting for your learners, and you can even ask for a unique URL based on your Institute’s brand.\r\nOne of the benefits of having a branded LMS is that you can set your LMS apart from any others in the training program you have established.', '2021-11-16 03:06:52', 1, '2021-11-16 07:37:21', 1, 0),
(15, 20220603011704, 'jkl', 'ujik', '2022-06-02 19:47:03', 1, '2022-06-03 06:17:10', 1, 1),
(16, 20220627065108, 'Organizes eLearning content in one location.', 'sedrttdsfg', '2022-06-27 11:51:08', 1, '2022-06-27 11:51:24', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_classroom`
--

CREATE TABLE `el_classroom` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `account_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `classroom_name` varchar(255) NOT NULL,
  `classroom_image` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `administration_name` varchar(255) NOT NULL,
  `administration_email` varchar(255) NOT NULL,
  `classroom_description` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_classroom`
--

INSERT INTO `el_classroom` (`id`, `unique_id`, `account_id`, `reg_id`, `classroom_name`, `classroom_image`, `phone_number`, `administration_name`, `administration_email`, `classroom_description`, `added_on`, `updated_on`, `added_by`, `updated_by`, `is_del`) VALUES
(7, 20220701052719, 19, 1, 'Class Admin', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_7518_1656671239.png', '+91989297889', 'Class Admin', 'classadmin@gmail.com', 'Class Admin', '2022-06-30 23:57:19', '2022-07-04 10:51:08', 4, 4, 0),
(8, 20220704072814, 21, 1, 'Class Admin two', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_3198_1656937693.png', '+9196375835', 'Class Admin 2', 'classadmin2@gmail.com', 'Hello World', '2022-07-04 01:58:14', '2022-07-04 12:28:14', 4, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_classroom_assignment`
--

CREATE TABLE `el_classroom_assignment` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_classroom_assignment`
--

INSERT INTO `el_classroom_assignment` (`id`, `account_id`, `classroom_id`, `added_on`, `updated_on`, `added_by`, `updated_by`, `is_del`) VALUES
(1, 11, 7, '2022-07-01 01:17:16', '2022-07-04 04:40:43', 4, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_classroom_course`
--

CREATE TABLE `el_classroom_course` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_classroom_course`
--

INSERT INTO `el_classroom_course` (`id`, `course_id`, `classroom_id`, `added_on`, `updated_on`, `added_by`, `updated_by`, `is_del`) VALUES
(1, 1, 7, '2022-07-04 01:13:37', '2022-07-04 12:20:08', 4, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_courses`
--

CREATE TABLE `el_courses` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_image` varchar(255) NOT NULL,
  `course_description` varchar(500) NOT NULL,
  `course_visibility` tinyint(1) NOT NULL,
  `course_full_description` longtext NOT NULL,
  `language` varchar(50) NOT NULL,
  `certificate` varchar(50) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `visibility` tinyint(4) NOT NULL,
  `is_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_courses`
--

INSERT INTO `el_courses` (`id`, `unique_id`, `reg_id`, `course_name`, `course_image`, `course_description`, `course_visibility`, `course_full_description`, `language`, `certificate`, `added_on`, `added_by`, `updated_on`, `updated_by`, `visibility`, `is_del`) VALUES
(1, 20220704005045, 1, 'IELTS: Courses With Personalised Classes', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_5101_1656913846.png', 'Practice Course', 1, 'Practice Course', 'English', '1', '2022-07-04 05:50:47', 4, '2022-07-04 12:29:30', 4, 0, 0),
(2, 20220704072925, 1, 'Course 2', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_6320_1656937765.png', 'Course 2 Description', 1, '', 'English', '1', '2022-07-04 12:29:25', 4, '2022-07-04 12:29:25', 4, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_course_hours_spent`
--

CREATE TABLE `el_course_hours_spent` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `time_min` int(11) NOT NULL,
  `date_on` date NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_course_hours_spent`
--

INSERT INTO `el_course_hours_spent` (`id`, `account_id`, `course_id`, `topic_id`, `time_min`, `date_on`, `updated_on`) VALUES
(1, 11, 1, 2, 1, '2022-07-13', '2022-07-13 10:30:50'),
(2, 11, 1, 3, 2, '2022-07-13', '2022-07-13 10:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `el_documents`
--

CREATE TABLE `el_documents` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `doc_name` varchar(225) NOT NULL,
  `documents` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `el_documents`
--

INSERT INTO `el_documents` (`id`, `account_id`, `doc_name`, `documents`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 3, '1st Document', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/EasyLearn-Teaser-1pdf_5550_1656482291.pdf', '2022-06-29 05:58:11', 0, '2022-06-29 06:03:10', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_features`
--

CREATE TABLE `el_features` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `feature_image` varchar(255) NOT NULL,
  `feature` varchar(255) NOT NULL,
  `feature_description` varchar(500) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_features`
--

INSERT INTO `el_features` (`id`, `unique_id`, `feature_image`, `feature`, `feature_description`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20211115112950, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Innovative-Technologypng_9070_1655804896.png', 'Innovative Technology', 'All the technical aspects chosen to build the application has a direct co-relationship with each other. The technology aims at seamless management of the mentoring and project executions process.', '2021-11-15 05:59:50', 1, '2022-06-21 09:48:16', 1, 0),
(2, 20211115113106, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/trainingpng_7884_1655804930.png', 'Course Management & Training', 'The courses are uploaded by the mentors and the training is conducted by the mentors. The courseware ranges from areas like design thinking, project management, team motivation, negotiation skills, etc.', '2021-11-15 06:01:06', 1, '2022-06-21 09:48:50', 1, 0),
(3, 20211115113354, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/login-page-on-laptop-screen-access-to-account-concepts-illustration-vectorpng_1212_1655804953.png', 'User Registration', 'Register your group or organization by filling the form and choosing one of the two categories, get approval by admin and login to your Dashboard.', '2021-11-15 06:03:54', 1, '2022-06-21 09:49:13', 1, 0),
(4, 20211115113452, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/man-with-key-and-secure-login-user-interface-illustration-concept-for-mobile-apps-and-web-banner-vectorpng_8699_1655804972.png', 'Secured Login', 'Secured Login using face recognition technology. Highly secure platform that ensues data integrity and safety and authorized accessibility.', '2021-11-15 06:04:52', 1, '2022-06-21 09:49:32', 1, 0),
(5, 20211115113552, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/previewpng_8319_1655804995.png', 'Main Dashboard', 'The MentorBox allows users to get mentored as a company or as a learning group. The two-fold approach has been used in which a project team or a learning group can use MentorBox to their advantage.', '2021-11-15 06:05:53', 1, '2022-06-21 09:49:55', 1, 0),
(6, 20211115114053, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/meetingpng_7939_1655805022.png', 'Manage Groups', 'Add people to your group, assign mentors to your projects and work on different projects and manage them without any hassle.', '2021-11-15 06:10:53', 1, '2022-06-21 09:50:22', 1, 0),
(7, 20211115114442, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/rebranding-whiteboard-exercise-sticky-notes-scaledpng_7746_1655805059.png', 'WhiteBoard', 'Use whiteboard to share your content with your group collaborate your plans, drawings and download for external use. Draw freehand and display pretty shapes with the help of shape recognition.', '2021-11-15 06:14:42', 1, '2022-06-21 09:50:59', 1, 0),
(8, 20211115114531, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/video-conferencing-benefitspng_5431_1655805069.png', 'Video Conferencing', 'Create a virtual meeting room with the help of video conferencing, share your screen with your mentors and group members.', '2021-11-15 06:15:31', 1, '2022-06-21 09:51:10', 1, 0),
(9, 20211115114632, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/docmanpng_6907_1655805082.png', 'Document & File Manager', 'The Document Manager allows the user to create different documents that are going to be consumed by the team/project. Each file gives information about its author when it was created and other file credentials.', '2021-11-15 06:16:32', 1, '2022-06-21 09:51:22', 1, 0),
(10, 20211115114735, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/emailpng_4183_1655805101.png', 'Mailing System', 'Mailing System & Chat allows users of the team to communicate via Chats and Mails.', '2021-11-15 06:17:35', 1, '2022-06-21 09:51:41', 1, 0),
(11, 20211115114828, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/authenticationpng_7823_1655805116.png', 'Multiple Authentication', 'Two level of approval process for onboarding of classroom, groups and teachers.', '2021-11-15 06:18:28', 1, '2022-06-21 09:51:56', 1, 0),
(12, 20211115114929, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/attendance1png_6571_1655805131.png', 'Automatic Attendance', 'Automatic attendance and examination with advanced face recognition technology.', '2021-11-15 06:19:29', 1, '2022-06-21 09:52:11', 1, 0),
(13, 20211115115026, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/examinationpng_3537_1655805149.png', 'Automatic Exam Supervision', 'User presence sensitivity to monitor student’s presence in the video classroom & lecture and examination.', '2021-11-15 06:20:26', 1, '2022-06-21 09:52:29', 1, 0),
(14, 20211115115115, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/reportspng_6667_1655805173.png', 'Reports', 'Analytical Reports of all the management activity available to admin (principal) and Class-Admin.', '2021-11-15 06:21:15', 1, '2022-06-21 09:52:53', 1, 0),
(15, 202111151152, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/virtuallabpng_5981_1655805185.png', 'Virtual Lab', 'Lab Management is a section for Lab & Practical sessions for schools & colleges to conduct their practical sessions online.', '2021-11-15 06:22:00', 1, '2022-06-21 09:53:06', 1, 0),
(16, 20211115115246, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/management_6181_1653109413.png', 'Channels', 'Webinars and podcasts Channels and library management featured in the system.', '2021-11-15 06:22:46', 1, '2022-06-03 06:09:01', 1, 1),
(17, 20220603010829, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/logo-dark-text_5451_1654236508.png', 'Course Management & Training', 'sdfgg', '2022-06-02 19:38:28', 1, '2022-06-03 06:16:48', 1, 1),
(18, 20220624044450, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/card-applyjpg_4264_1656063889.jpg', 'rtyu', 'hujfg', '2022-06-24 09:44:49', 1, '2022-06-24 09:45:07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_fee_structure`
--

CREATE TABLE `el_fee_structure` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `fee_details` text NOT NULL,
  `total_fees` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_fee_structure`
--

INSERT INTO `el_fee_structure` (`id`, `unique_id`, `batch_id`, `term`, `fee_details`, `total_fees`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20220707060859, 1, 1, '[{\"id\":0,\"particulars\":\"fg\",\"price\":\"5\"},{\"id\":1,\"particulars\":\"5\",\"price\":\"5\"}]', 10, '2022-07-07 11:08:59', 0, '2022-07-07 11:08:59', 0, 0),
(2, 20220707061152, 1, 3, '[{\"id\":0,\"particulars\":\"hi\",\"price\":\"7\"},{\"id\":1,\"particulars\":\"onh\",\"price\":\"7\"}]', 14, '2022-07-07 11:11:52', 4, '2022-07-07 11:11:52', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_hostel`
--

CREATE TABLE `el_hostel` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `hostel_name` varchar(11) NOT NULL,
  `hostel_type` varchar(25) NOT NULL,
  `no_of_rooms` int(11) NOT NULL,
  `ppl_capacity_per_rm` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_hostel`
--

INSERT INTO `el_hostel` (`id`, `unique_id`, `reg_id`, `hostel_name`, `hostel_type`, `no_of_rooms`, `ppl_capacity_per_rm`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20220711075940, 1, 'hg', 'Boys', 8, 1, '2022-07-11 12:59:40', 4, '2022-07-11 13:03:01', 4, 0),
(2, 20220711081207, 1, 'hg1', 'Girls', 1, 1, '2022-07-11 13:12:07', 4, '2022-07-11 13:12:07', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_jr_clg`
--

CREATE TABLE `el_jr_clg` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `clg_name` varchar(50) NOT NULL,
  `clg_type` varchar(50) NOT NULL,
  `clg_board_type` varchar(255) NOT NULL,
  `clg_medium` varchar(50) NOT NULL,
  `clg_code` varchar(25) NOT NULL,
  `is_coed` tinyint(11) NOT NULL,
  `clg_gender_type` varchar(25) NOT NULL,
  `clg_logo` text NOT NULL,
  `clg_image` text NOT NULL,
  `phone_1` varchar(25) NOT NULL,
  `phone_2` varchar(25) NOT NULL,
  `clg_streams` varchar(255) NOT NULL,
  `clg_descp` varchar(255) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `addr1` varchar(255) NOT NULL,
  `addr2` varchar(255) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `pcode` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `pl_doc` varchar(255) NOT NULL,
  `uac_doc` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `el_lab_instance`
--

CREATE TABLE `el_lab_instance` (
  `id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `lab_name` varchar(255) NOT NULL,
  `lab_ip` varchar(255) NOT NULL,
  `lab_username` varchar(255) NOT NULL,
  `lab_password` varchar(255) NOT NULL,
  `lab_description` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_lab_instance`
--

INSERT INTO `el_lab_instance` (`id`, `reg_id`, `classroom_id`, `batch_id`, `account_id`, `lab_name`, `lab_ip`, `lab_username`, `lab_password`, `lab_description`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 1, 7, 1, 11, 'Lab 11', '206.189.39.85', '', '', 'Hello', '2022-07-11 11:40:35', 0, '2022-07-12 09:28:16', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_login_activites`
--

CREATE TABLE `el_login_activites` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_login_activites`
--

INSERT INTO `el_login_activites` (`id`, `account_id`, `ip_address`, `updated_on`) VALUES
(1, 1, '::1', '2022-06-22 09:48:50'),
(2, 1, '::1', '2022-06-22 09:49:37'),
(3, 1, '::1', '2022-06-22 09:51:41'),
(4, 1, '::1', '2022-06-22 10:00:35'),
(5, 1, '::1', '2022-06-22 10:54:07'),
(6, 1, '::1', '2022-06-22 11:03:55'),
(7, 1, '::1', '2022-06-22 11:09:11'),
(8, 1, '::1', '2022-06-22 12:01:27'),
(9, 1, '::1', '2022-06-22 12:09:08'),
(10, 1, '::1', '2022-06-22 12:14:51'),
(11, 1, '::1', '2022-06-22 12:15:09'),
(12, 1, '::1', '2022-06-22 12:15:26'),
(13, 1, '::1', '2022-06-22 12:18:13'),
(14, 1, '::1', '2022-06-22 12:26:52'),
(15, 1, '::1', '2022-06-22 12:27:36'),
(16, 1, '::1', '2022-06-22 12:28:18'),
(17, 1, '::1', '2022-06-22 12:28:47'),
(18, 1, '::1', '2022-06-22 12:31:11'),
(19, 1, '::1', '2022-06-22 12:31:34'),
(20, 1, '::1', '2022-06-23 11:13:43'),
(21, 1, '::1', '2022-06-24 04:39:43'),
(22, 1, '::1', '2022-06-27 04:35:58'),
(23, 1, '::1', '2022-06-27 08:45:26'),
(24, 1, '::1', '2022-06-27 11:17:03'),
(25, 1, '::1', '2022-06-27 11:29:58'),
(26, 1, '::1', '2022-06-27 11:37:29'),
(27, 1, '::1', '2022-06-28 04:40:12'),
(28, 3, '::1', '2022-06-28 07:49:59'),
(29, 3, '::1', '2022-06-29 04:58:52'),
(30, 3, '::1', '2022-06-29 07:36:08'),
(31, 3, '::1', '2022-06-29 11:52:14'),
(32, 4, '::1', '2022-06-29 12:50:43'),
(33, 4, '::1', '2022-06-29 12:59:50'),
(34, 3, '::1', '2022-06-30 04:40:34'),
(35, 4, '::1', '2022-06-30 04:58:24'),
(36, 3, '::1', '2022-06-30 05:11:57'),
(37, 3, '::1', '2022-06-30 05:14:26'),
(38, 4, '::1', '2022-06-30 05:36:30'),
(39, 4, '::1', '2022-07-01 06:51:55'),
(40, 1, '::1', '2022-07-01 07:32:14'),
(41, 4, '::1', '2022-07-01 07:42:39'),
(42, 4, '::1', '2022-07-04 04:36:39'),
(43, 19, '::1', '2022-07-06 04:39:35'),
(44, 4, '::1', '2022-07-06 04:39:58'),
(45, 4, '::1', '2022-07-06 11:34:31'),
(46, 4, '::1', '2022-07-07 04:40:35'),
(47, 1, '::1', '2022-07-07 05:26:16'),
(48, 3, '::1', '2022-07-08 06:30:18'),
(49, 4, '::1', '2022-07-08 09:35:30'),
(50, 4, '::1', '2022-07-11 04:38:33'),
(51, 4, '::1', '2022-07-12 04:40:16'),
(52, 4, '::1', '2022-07-12 09:11:34'),
(53, 11, '::1', '2022-07-12 09:33:33'),
(54, 11, '::1', '2022-07-12 12:25:53'),
(55, 11, '::1', '2022-07-12 12:26:00'),
(56, 11, '::1', '2022-07-12 12:26:05'),
(57, 11, '::1', '2022-07-12 12:26:35'),
(58, 11, '::1', '2022-07-12 13:08:59'),
(59, 11, '::1', '2022-07-12 13:09:04'),
(60, 11, '::1', '2022-07-12 13:10:05'),
(61, 11, '::1', '2022-07-12 13:10:31'),
(62, 11, '::1', '2022-07-12 13:10:48'),
(63, 11, '::1', '2022-07-12 13:16:05'),
(64, 11, '::1', '2022-07-12 13:19:52'),
(65, 11, '::1', '2022-07-13 04:55:23'),
(66, 4, '::1', '2022-07-13 12:08:50'),
(67, 11, '::1', '2022-07-13 12:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `el_mcq_exam`
--

CREATE TABLE `el_mcq_exam` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `exam_title` varchar(255) NOT NULL,
  `exam_category` varchar(255) NOT NULL,
  `exam_material` text NOT NULL,
  `exam_date` date NOT NULL,
  `exam_start_time` time NOT NULL,
  `exam_end_time` time NOT NULL,
  `exam_right_mark` float NOT NULL,
  `exam_wrong_mark` float NOT NULL,
  `exam_duration` int(11) NOT NULL,
  `show_result` tinyint(1) NOT NULL,
  `multiple_response` tinyint(1) NOT NULL,
  `visibility` tinyint(1) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_mcq_exam`
--

INSERT INTO `el_mcq_exam` (`id`, `unique_id`, `classroom_id`, `reg_id`, `course_id`, `exam_title`, `exam_category`, `exam_material`, `exam_date`, `exam_start_time`, `exam_end_time`, `exam_right_mark`, `exam_wrong_mark`, `exam_duration`, `show_result`, `multiple_response`, `visibility`, `added_by`, `added_on`, `updated_by`, `updated_on`, `is_del`) VALUES
(1, 20220712020252, 7, 1, 1, 'Exam 1', 'MCQ Exam', '', '2022-07-17', '16:00:00', '18:30:00', 1, 0, 5, 0, 0, 1, 4, '2022-07-12 02:02:52', 4, '2022-07-13 12:31:17', 0),
(8, 20220712024742, 7, 1, 1, 'Exam 3', 'Short Answer', '', '2022-07-17', '16:00:00', '18:30:00', 1, 0, 5, 0, 0, 0, 4, '2022-07-12 02:47:42', 4, '2022-07-13 12:31:19', 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_mentor_registration`
--

CREATE TABLE `el_mentor_registration` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `mentor_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `field_of_expertise` varchar(50) NOT NULL,
  `experience` float NOT NULL,
  `skills` text NOT NULL,
  `description` varchar(255) NOT NULL,
  `contact_number1` varchar(50) NOT NULL,
  `contact_number2` varchar(50) NOT NULL,
  `address_line1` varchar(50) NOT NULL,
  `address_line2` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `resume_url` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_mentor_registration`
--

INSERT INTO `el_mentor_registration` (`id`, `account_id`, `unique_id`, `mentor_name`, `email`, `dob`, `field_of_expertise`, `experience`, `skills`, `description`, `contact_number1`, `contact_number2`, `address_line1`, `address_line2`, `city`, `state`, `pincode`, `country`, `photo_url`, `resume_url`, `status`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(2, 23, 20220708012807, 'New Mentor', 'mentoradmin@gmail.com', '2004-07-01', 'Science', 1, '[\"HTML\",\"CSS\"]', 'Hello World', '+919890906048', '+919890906048', 'Kailash Dham, C-09, Dongre Park CHS\r\nChembur', 'Kailash Dham, C-09, Dongre Park CHS\r\nChembur', 'Mumbai', 'Maharashtra', '400071', 'India', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_8812_1657261687.png', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/EasyLearn-Teaserpdf_8545_1657261687.pdf', 'Verified', '2022-07-08 06:29:40', 0, '2022-07-08 09:32:49', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_miro_whiteboard`
--

CREATE TABLE `el_miro_whiteboard` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `whiteboard_link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_miro_whiteboard`
--

INSERT INTO `el_miro_whiteboard` (`id`, `account_id`, `whiteboard_link`) VALUES
(1, 3, 'https://miro.com/app/board/uXjVOpvn0Ow=');

-- --------------------------------------------------------

--
-- Table structure for table `el_news`
--

CREATE TABLE `el_news` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `topic_img` varchar(255) NOT NULL,
  `news` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_news`
--

INSERT INTO `el_news` (`id`, `unique_id`, `reg_id`, `topic`, `topic_img`, `news`, `start_date`, `end_date`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 607202202471040206, 1, 'EasyLearn Platform', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Fortimates-ed-117971615205954png_1269_1657093630.png', '123456789', '2022-07-07', '2022-07-30', '2022-07-06 07:47:10', 4, '2022-07-06 11:05:00', 4, 0),
(2, 2022070606183929894, 1, 'EasyLearn Platform', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/baatchit-logopng30811656917458png_2025_1657106319.png', 'hello hellohello hellohello hellohello hellohello hellohello hellohello hellohello hello', '2022-07-07', '2022-07-31', '2022-07-06 11:18:39', 4, '2022-07-06 11:20:14', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_newsfeed`
--

CREATE TABLE `el_newsfeed` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `newsfeed_headline` varchar(255) NOT NULL,
  `newsfeed_rsslink` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_newsfeed`
--

INSERT INTO `el_newsfeed` (`id`, `unique_id`, `newsfeed_headline`, `newsfeed_rsslink`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20220628011641, 'abcdef', 'abcdefbhnjn', '2022-06-28 06:16:40', 1, '2022-06-28 06:16:51', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_project_documents`
--

CREATE TABLE `el_project_documents` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_image` varchar(255) NOT NULL,
  `document_link` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_project_documents`
--

INSERT INTO `el_project_documents` (`id`, `unique_id`, `document_name`, `document_image`, `document_link`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20211115085731, 'Flyer', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/flyerpng_2176_1655804346.png', 'https://easylearn.s3.ap-south-1.amazonaws.com/EasyLearn+-++Flyer.pdf', '2021-11-15 03:27:31', 1, '2022-06-21 09:39:06', 1, 0),
(2, 20211115103136, 'Brochure', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/brochurejpeg_2466_1655804358.jpeg', 'https://easylearn.s3.ap-south-1.amazonaws.com/EasyLearn+Broucher.pdf', '2021-11-15 05:01:36', 1, '2022-06-21 09:39:18', 1, 0),
(3, 20211115103259, 'Pitch Deck', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/pitchdeckpng_1582_1655804378.png', 'https://easylearn.s3.ap-south-1.amazonaws.com/EasyLearn+-+Pitch+Deck.pdf', '2021-11-15 05:02:59', 1, '2022-06-21 09:39:38', 1, 0),
(4, 20211115103350, 'Feature List', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/featurelistpng_5961_1655804392.png', 'https://easylearn.s3.ap-south-1.amazonaws.com/Easylearn+FeatureList.pdf', '2021-11-15 05:03:50', 1, '2022-06-21 09:39:53', 1, 0),
(5, 20211115110217, 'Whitepaper', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/whitepaperpng_8959_1655804412.png', 'https://easylearn.s3.ap-south-1.amazonaws.com/EasyLearn+Whitepaper.pdf', '2021-11-15 05:32:17', 1, '2022-06-21 09:40:12', 1, 0),
(6, 20211115110614, 'User Manual', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/User%20Manual_6522_1651750937.jpg', 'https://easylearn.s3.ap-south-1.amazonaws.com/Easylearn+Demo+ppt.pdf', '2021-11-15 05:36:14', 1, '2022-06-21 09:15:08', 1, 0),
(7, 20220628024820, 'xfvcgbhnj', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Vikaspng_8055_1656402500.png', 'vbhjnvhbjj', '2022-06-28 07:48:20', 1, '2022-06-28 07:48:35', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_registration`
--

CREATE TABLE `el_registration` (
  `id` int(11) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_registration`
--

INSERT INTO `el_registration` (`id`, `reg_id`, `type`, `is_del`) VALUES
(1, 1, 'School', 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_schedule`
--

CREATE TABLE `el_schedule` (
  `id` int(11) NOT NULL,
  `schedule_id` bigint(20) NOT NULL,
  `reg_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `classroom_id` int(11) NOT NULL,
  `title` varchar(25) NOT NULL,
  `start_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `class_name` varchar(25) NOT NULL,
  `meet_url` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `is_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_schedule`
--

INSERT INTO `el_schedule` (`id`, `schedule_id`, `reg_id`, `batch_id`, `lecturer_id`, `classroom_id`, `title`, `start_date`, `start_time`, `end_time`, `class_name`, `meet_url`, `added_on`, `updated_on`, `added_by`, `updated_by`, `is_del`) VALUES
(3, 20220711013629, 1, 1, 23, 7, '1st Lecture', '2022-07-12', '12:00:00', '12:15:00', 'success', 'http://localhost/easylearnv2.net.in/videoconference?id=202207111200003283', '2022-07-11 06:36:29', '2022-07-13 12:08:35', 4, 4, 1),
(4, 202207131730008677, 1, 1, 23, 7, '2nd Lecture', '2022-07-13', '17:30:00', '17:45:00', 'success', 'http://localhost/easylearnv2.net.in/videoconference?id=202207131730008677', '2022-07-13 12:09:17', '2022-07-13 12:09:17', 4, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_schedule_attendance`
--

CREATE TABLE `el_schedule_attendance` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `schedule_id` bigint(20) NOT NULL,
  `time_min` varchar(50) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_schedule_attendance`
--

INSERT INTO `el_schedule_attendance` (`id`, `account_id`, `schedule_id`, `time_min`, `updated_on`, `is_del`) VALUES
(3, 11, 20220711013629, 'Present', '2022-07-11 09:27:06', 0),
(7, 11, 202207131730008677, '4', '2022-07-13 12:13:58', 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_school`
--

CREATE TABLE `el_school` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_type` varchar(255) NOT NULL,
  `board_type` varchar(255) NOT NULL,
  `school_medium` varchar(255) NOT NULL,
  `school_code` varchar(255) NOT NULL,
  `is_coed` tinyint(4) NOT NULL,
  `gender_type` varchar(255) NOT NULL,
  `school_logo` varchar(255) NOT NULL,
  `school_image` varchar(255) NOT NULL,
  `phone_1` varchar(255) NOT NULL,
  `phone_2` varchar(255) NOT NULL,
  `school_description` varchar(255) NOT NULL,
  `administrator_name` varchar(255) NOT NULL,
  `administrator_email` varchar(255) NOT NULL,
  `address_line_1` varchar(255) NOT NULL,
  `address_line_2` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `pl_doc` varchar(255) NOT NULL,
  `uac_doc` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_school`
--

INSERT INTO `el_school` (`id`, `unique_id`, `school_name`, `school_type`, `board_type`, `school_medium`, `school_code`, `is_coed`, `gender_type`, `school_logo`, `school_image`, `phone_1`, `phone_2`, `school_description`, `administrator_name`, `administrator_email`, `address_line_1`, `address_line_2`, `country`, `state`, `city`, `postal_code`, `status`, `pl_doc`, `uac_doc`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20220629120600, 'Easylearn School', 'Public-authority', 'State Board', 'English', '007', 1, '', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/User%20Manual_6522_1651750937.jpg', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/User%20Manual_6522_1651750937.jpg', '+919890906048', '+919890906048', 'Easylearn School', 'School Admin', 'schooladmin@gmail.com', 'address line 1', 'address line 2', 'India', 'Maharashtra', 'Mumbai', '400097', 'Verified', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/EasyLearn-Teaser-1pdf55501656482291pdf_1820_1656565878.pdf', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/EasyLearn-Teaser-1pdf55501656482291pdf_5975_1656565878.pdf', '2022-06-29 06:41:11', 0, '2022-06-30 05:36:01', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_security`
--

CREATE TABLE `el_security` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `security_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `security_description` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_security`
--

INSERT INTO `el_security` (`id`, `unique_id`, `security_name`, `status`, `security_description`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20220606005753, 'Captcha', 0, 'Captcha On / Off', '2022-06-05 19:27:53', 1, '2022-06-24 06:13:05', 1, 0),
(3, 20220607000746, 'MFA', 0, 'MFA On / Off', '2022-06-06 18:37:46', 1, '2022-06-24 06:13:07', 1, 0),
(4, 20220624010644, 'Captcha', 0, 'sdsdf', '2022-06-23 19:36:44', 1, '2022-06-24 06:07:20', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_services`
--

CREATE TABLE `el_services` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `service_image` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `service_description` varchar(500) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_services`
--

INSERT INTO `el_services` (`id`, `unique_id`, `service_image`, `service`, `service_description`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20211115123606, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/due-deligencepng_1141_1655805227.png', 'Due Diligence', 'Once a set of matches are shortlisted, the Startup Exchange comes out for the promoters with a probable list of investors and for the investors, it shows a probable list of projects that they may like to invest.', '2021-11-15 07:06:06', 1, '2022-06-21 09:53:47', 1, 0),
(2, 20211115123658, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/exchangepng_3799_1655805240.png', 'Project Documentation', 'When prompted, the Information Memorandum is sent to the investor as the first mailer followed by other documents like Pitch Deck, Detailed Project report, Financial & Marketing plan and so on.', '2021-11-15 07:06:58', 1, '2022-06-21 09:54:00', 1, 0),
(3, 20211115124020, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/matchingpng_5122_1655805257.png', 'Match Making', 'The most important feature that Startup Exchange addresses are the matchmaking process which is dependent on Sector matching Quantum of fund required versus the investors’ risk appetite Nature & type of funding.', '2021-11-15 07:10:20', 1, '2022-06-21 09:54:17', 1, 0),
(4, 20211115124129, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/fundraisingpng_4553_1655805272.png', 'Fund Raising', 'Fund-raising is of prime importance today for any business to succeed, be it a large company targeting growth, a mid-size company targeting enhancement of facilities or be it a startup looking for better cash flow management.', '2021-11-15 07:11:29', 1, '2022-06-21 09:54:32', 1, 0),
(5, 20211115124237, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/design-thinkingpng_2222_1655805290.png', 'Design Thinking & Development', 'Design Thinking is the process of defining the components, modules, interfaces, and data for a system to satisfy specified requirements.', '2021-11-15 07:12:37', 1, '2022-06-21 09:54:50', 1, 0),
(6, 20211115124336, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/web-developmentpng_5757_1655805304.png', 'Web Application Development', 'Development is the process of creating or altering systems, along with the processes, practices, models, and methodologies used to develop them.', '2021-11-15 07:13:36', 1, '2022-06-21 09:55:05', 1, 0),
(7, 20211115124421, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/management_8818_1653109395.png', 'Financial Modeling', 'Financial Modeling is a mathematical model designed to represent (a simplified version of) the performance of a financial asset or portfolio of a business, project, or any other investment.', '2021-11-15 07:14:21', 1, '2022-05-21 05:03:15', 1, 0),
(8, 20220603011731, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/logo-dark-text_3436_1654237050.png', 'yujio', 'uji', '2022-06-02 19:47:30', 1, '2022-06-03 06:17:44', 1, 1),
(9, 20220627074723, 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Tapan-Daspng_8205_1656334043.png', 'sadfg', 'fdgdfgthj', '2022-06-27 12:47:23', 1, '2022-06-27 12:47:37', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_settings`
--

CREATE TABLE `el_settings` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `category_id` int(11) NOT NULL,
  `value` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_settings`
--

INSERT INTO `el_settings` (`id`, `unique_id`, `category_id`, `value`, `purpose`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(2, 20220620015903, 2, 'Miro', 'Hello', '2022-06-19 20:29:03', 1, '2022-06-28 11:12:25', 1, 0),
(4, 20220627034746, 4, 'State Board', '', '2022-06-27 08:47:47', 1, '2022-06-27 08:47:47', 1, 0),
(5, 20220627034844, 4, 'Central Board of Secondary Education', '', '2022-06-27 08:48:44', 1, '2022-06-27 08:48:44', 1, 0),
(6, 20220627034914, 4, 'Indian Certificate of Secondary Education', '', '2022-06-27 08:49:14', 1, '2022-06-27 08:49:14', 1, 0),
(7, 20220627034944, 4, 'Council for the Indian School Certificate Examination', '', '2022-06-27 08:49:44', 1, '2022-06-27 08:49:44', 1, 0),
(8, 20220627035050, 4, 'National Institute of Open Schooling', '', '2022-06-27 08:50:50', 1, '2022-06-27 08:50:50', 1, 0),
(9, 20220627035107, 4, 'International Baccalaureate', '', '2022-06-27 08:51:07', 1, '2022-06-27 08:51:07', 1, 0),
(10, 20220627035129, 4, 'Cambridge International Examinations', '', '2022-06-27 08:51:29', 1, '2022-06-27 08:51:29', 1, 0),
(11, 20220627051737, 5, 'Public-authority', '', '2022-06-27 10:17:37', 1, '2022-06-27 10:17:37', 1, 0),
(12, 20220627051759, 5, 'Private', '', '2022-06-27 10:17:59', 1, '2022-06-27 10:17:59', 1, 0),
(13, 20220627051835, 5, 'Non-denominational private', '', '2022-06-27 10:18:35', 1, '2022-06-27 10:18:35', 1, 0),
(14, 20220627051846, 5, 'Community', '', '2022-06-27 10:18:46', 1, '2022-06-27 10:18:46', 1, 0),
(15, 20220627051928, 5, 'Internationally oriented primary education', '', '2022-06-27 10:19:28', 1, '2022-06-27 10:19:28', 1, 0),
(16, 20220627052112, 6, 'English', '', '2022-06-27 10:21:12', 1, '2022-06-27 10:21:12', 1, 0),
(17, 20220627052122, 6, 'Hindi', '', '2022-06-27 10:21:22', 1, '2022-06-27 10:21:22', 1, 0),
(18, 20220627052131, 6, 'Marathi', '', '2022-06-27 10:21:31', 1, '2022-06-27 10:21:31', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_settings_category`
--

CREATE TABLE `el_settings_category` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_settings_category`
--

INSERT INTO `el_settings_category` (`id`, `unique_id`, `category_name`, `description`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(2, 20220619234635, 'Whiteboard', '\"miro\", \"internal\"', '2022-06-19 18:16:35', 1, '2022-06-24 05:45:55', 1, 0),
(3, 20220624004758, 'Whiteboard1', 'zdsfg', '2022-06-23 19:17:58', 1, '2022-06-24 05:48:19', 1, 1),
(4, 20220627034711, 'School Board Type', 'School Registration Board Type', '2022-06-27 08:47:11', 1, '2022-06-27 08:47:11', 1, 0),
(5, 20220627051714, 'School Type', '', '2022-06-27 10:17:14', 1, '2022-06-27 10:17:14', 1, 0),
(6, 20220627052053, 'School Medium', '', '2022-06-27 10:20:53', 1, '2022-06-27 10:20:53', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_slider`
--

CREATE TABLE `el_slider` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `slider_type` varchar(255) NOT NULL,
  `slider_image` varchar(255) NOT NULL,
  `slider_video` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_slider`
--

INSERT INTO `el_slider` (`id`, `unique_id`, `slider_type`, `slider_image`, `slider_video`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20220518075422, 'image', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/sagar_5917_1651577593_8885_1652880537.png', '', '2022-05-18 02:24:21', 1, '2022-06-24 06:56:12', 1, 0),
(2, 20220518075530, 'video', '', 'https://isfmedia.s3.ap-south-1.amazonaws.com/EasyLearn/EasyLearn+Demo.mp4', '2022-05-18 02:25:29', 1, '2022-06-24 06:56:10', 1, 0),
(3, 20220518233944, 'image', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/sagar_5917_1651577593_2399_1652956689.png', '', '2022-05-18 18:09:43', 1, '2022-06-24 06:56:09', 1, 0),
(5, 20220519044250, 'image', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/sagar_5917_1651577593_1917_1652953369.png', '', '2022-05-18 23:12:49', 1, '2022-06-24 06:56:07', 1, 0),
(6, 20220519053453, 'video', '', 'https://isfmedia.s3.ap-south-1.amazonaws.com/EasyLearn/EasyLearn+Demo.mp4', '2022-05-19 00:04:52', 1, '2022-06-24 06:56:06', 1, 0),
(7, 20220520024330, 'image', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/sagar_5917_1651577593_3504_1653032626.png', '', '2022-05-19 21:13:29', 1, '2022-05-20 07:43:53', 1, 1),
(8, 20220603004301, 'image', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/logo-dark-text_5928_1654234981.png', '', '2022-06-02 19:13:00', 1, '2022-06-24 06:56:02', 1, 0),
(9, 20220624014830, 'video', '', 'frttyee', '2022-06-24 06:48:29', 1, '2022-06-24 06:50:37', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_store_secret`
--

CREATE TABLE `el_store_secret` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `secret` varchar(255) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_store_secret`
--

INSERT INTO `el_store_secret` (`id`, `account_id`, `secret`, `updated_on`) VALUES
(1, 1, 'ZQP6FMODFUOJR2OHBCENOXJMMKJATAZ5', '2022-06-22 12:28:20');

-- --------------------------------------------------------

--
-- Table structure for table `el_student`
--

CREATE TABLE `el_student` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `account_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `student_name` varchar(50) NOT NULL,
  `student_gender` varchar(6) NOT NULL,
  `student_dob` date NOT NULL,
  `student_emailid` varchar(80) NOT NULL,
  `student_nationality` varchar(20) NOT NULL,
  `student_contactno` varchar(20) NOT NULL,
  `student_rollno` int(11) NOT NULL,
  `student_bloodgroup` varchar(15) NOT NULL,
  `student_image` varchar(255) NOT NULL,
  `student_description` varchar(255) NOT NULL,
  `parent_name` varchar(50) NOT NULL,
  `parent_emailid` varchar(80) NOT NULL,
  `parent_contactno` varchar(20) NOT NULL,
  `parent_occupation` varchar(30) NOT NULL,
  `parent_address` varchar(255) NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_del` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_student`
--

INSERT INTO `el_student` (`id`, `unique_id`, `account_id`, `parent_id`, `student_name`, `student_gender`, `student_dob`, `student_emailid`, `student_nationality`, `student_contactno`, `student_rollno`, `student_bloodgroup`, `student_image`, `student_description`, `parent_name`, `parent_emailid`, `parent_contactno`, `parent_occupation`, `parent_address`, `added_by`, `added_on`, `updated_by`, `updated_on`, `is_del`) VALUES
(3, 20220630054350, 11, 12, 'Test Student', 'Male', '2017-06-07', 'teststudent@gmail.com', 'Indian', '+919890906048', 5, 'B+', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_1220_1656585830.png', 'Hello World', 'Test parent', 'testparent@gmail.com', '+919890906048', 'Developer', 'Kailash Dham, C-09, Dongre Park CHS\r\nChembur', 4, '2022-06-30 10:43:50', 4, '2022-07-01 10:22:51', 0),
(7, 20220704072655, 20, 12, 'Mukesh Nadar', 'Male', '2017-07-04', 'mukeshnadar50@gmail.com', 'Indian', '+919890906048', 3, 'B+', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_8849_1656937615.png', '', 'Test Parent', 'testparent@gmail.com', '+919890906048', 'Developer', 'Kailash Dham, C-09, Dongre Park CHS\r\nChembur', 4, '2022-07-04 12:26:55', 4, '2022-07-04 12:26:55', 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_team`
--

CREATE TABLE `el_team` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `job_role` varchar(255) NOT NULL,
  `about` varchar(500) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `telephone_1` varchar(20) NOT NULL,
  `telephone_2` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_team`
--

INSERT INTO `el_team` (`id`, `unique_id`, `name`, `job_role`, `about`, `facebook`, `twitter`, `instagram`, `linkedin`, `image_path`, `email_id`, `telephone_1`, `telephone_2`, `type`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20211116063817, 'Tapan Das', 'Director, CTO', 'Senior Fin-tech professional with 30 years experience and proven track record of applying appropriate practical mix of technologies blended with subject matter expertise in Finance.', '', '', '', 'https://www.linkedin.com/in/tapan-das-b408238/', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Tapan-Daspng_2881_1655805360.png', 'tapand@live.in', '9890906048', '0', 'Director', '2021-11-16 01:08:17', 1, '2022-06-28 04:50:25', 1, 0),
(2, 20211116064221, 'Sutapa Das', 'Director', 'A brilliant Mentor with 15+ years of\r\nexperience into Educational Institute, very\r\ndynamic and engaging educator.', '', '', '', 'https://www.linkedin.com/in/tapan-das-b408238/', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Sutapapng_9128_1655805380.png', 'tapand@live.in', '9890906048', '0', 'Director', '2021-11-16 01:12:21', 1, '2022-06-28 04:50:25', 1, 0),
(3, 20211116064420, 'Mukesh Nadar', 'Senior Web Developer', 'Skilled in Python (Programming Language), Computer Science, PHP, Back-End Web Development, and Full-Stack Development.', '', '', '', 'https://www.linkedin.com/in/mukesh-nadar-b310761b2/', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Mukeshpng_4305_1655805393.png', 'mukeshnadar50@gmail.com', '9167627606', '0', 'Employee', '2021-11-16 01:14:20', 1, '2022-06-28 04:50:41', 1, 0),
(4, 20211116064546, 'Ambika Mudliar', 'Marketing Head', 'Experienced Digital Marketing Executive with a demonstrated history of working in the Design & Development industry.', '', '', '', 'https://www.linkedin.com/in/ambika-mudliar-a413a8170/', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Ambikapng_6298_1655805416.png', 'ambika.isfinformatica@gmail.com', '0', '0', 'Employee', '2021-11-16 01:15:46', 1, '2022-06-28 04:50:41', 1, 0),
(5, 202111160647, 'Anisha Jaichandran', 'HR & Admin', 'Experienced HR & Admin Executive with a demonstrated history of working in the Design & Development industry.', '', '', '', 'https://www.linkedin.com/in/anisha-jaichandran-99a388157/', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Anishapng_8095_1655805428.png', 'ambika.isfinformatica@gmail.com', '0', '0', 'Employee', '2021-11-16 01:17:00', 1, '2022-06-28 04:50:41', 1, 0),
(6, 20211116064822, 'Andrew Jayapal', 'Junior Web Developer', 'Skilled in Python (Programming Language), Computer Science, PHP, Back-End Web Development, and Full-Stack Development.', '', '', '', 'https://www.linkedin.com/in/andrew-jayapal-955407203', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Andrewjpg_5417_1655805444.jpg', 'andrewjayapal7@gmail.com', '0', '0', 'Employee', '2021-11-16 01:18:22', 1, '2022-06-28 04:50:41', 1, 0),
(7, 20211116065012, 'Kunal Ghosh', 'Adviser', 'IIT-Bombay Alumnus,\r\nDigital and Sign-off expert & Co-founder\r\nQualcomm\'s Test-chip business unit\r\nCadence as Lead Sales Application engineer', '', '', '', ' Linkedin', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Kunal-1jpeg_5292_1655805482.jpeg', 'kunalpghosh@gmail.com', '0', '0', 'Advisor', '2021-11-16 01:20:12', 1, '2022-06-28 04:51:02', 1, 0),
(8, 20211116065143, 'Anagha Ghosh', 'Adviser', 'Founder & Business Head\r\nProject Manger TATA Power Company\r\nProject Advisor \"SHAKTI Processor\" IIT Madras team', '', '', '', ' Linkedin', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Anaghapng_9412_1655805513.png', 'kunalpghosh@gmail.com', '0', '0', 'Advisor', '2021-11-16 01:21:43', 1, '2022-06-28 04:51:02', 1, 0),
(9, 20211116065246, 'Sumit Chowdhury', 'Advisor', 'Sumit is the Founder CEO of SesoVera and Founder Chairman of Gaia Smart Cities. He is a global thought leader and CXO in the field of Artificial Intelligence, Smart Cities, Telecom.', '', '', '', 'https://www.linkedin.com/in/sumitchowdhury', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Sumitpng_9793_1655805537.png', ' ', '0', '0', 'Advisor', '2021-11-16 01:22:46', 1, '2022-06-28 04:51:02', 1, 0),
(10, 20211116070008, 'Amrita Chowdhury', 'Advisor', 'Amrita is a business strategist, engineer & innovator. She brings a unique understanding of business growth, technology, digital spaces and brands.', '', '', '', 'https://www.linkedin.com/in/amrita-chowdhury-62097513', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Amritapng_7807_1655805560.png', ' ', '+4478754567', '+4478754567', 'Advisor', '2021-11-16 01:30:08', 1, '2022-06-28 04:51:02', 1, 0),
(12, 2021116113543, 'Dr. Amit Banerjee', 'Scientific Consultant', '10 Years of R & D Experience with state of the art technologies.  Ph.D. degree in Semiconductor Technology from Energy Research Unit, Indian Association for the Cultivation of Science.', '', '', '', 'https://www.linkedin.com/in/dr-amit-banerjee/', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Amitpng_5687_1655805586.png', 'ambika.isfinformatica@gmail.com', '+91916762760', '+91916762760', 'Advisor', '2021-11-16 01:30:08', 1, '2022-06-28 04:51:02', 1, 0),
(13, 20220603011838, 'rtyu', 'tyu', 'sdfgh', '', '', '', 'hj', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/logo-dark-text_9040_1654237117.png', 'ambika.isfinformatica@gmail.com', '91', '91', 'Director', '2022-06-02 19:48:37', 1, '2022-06-28 04:50:25', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_testimonials`
--

CREATE TABLE `el_testimonials` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `testimonial_name` varchar(255) NOT NULL,
  `testimonial_image` varchar(255) NOT NULL,
  `testimonial_jobrole` varchar(255) NOT NULL,
  `testimonial_companywebsite` varchar(255) NOT NULL,
  `testimonial_description` text NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_testimonials`
--

INSERT INTO `el_testimonials` (`id`, `unique_id`, `testimonial_name`, `testimonial_image`, `testimonial_jobrole`, `testimonial_companywebsite`, `testimonial_description`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(1, 20211112120554, 'Kunal Ghosh', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Kunal-Ghosh_5734_1626861388.jpeg', 'VSD Founder', 'https://www.vlsisystemdesign.com', 'A Big Thanks to our platform partner Tapan Das (Architect of ISF Edutech) for all kind of customization, sophistication and glitch-free experience for all participants. Thanks for making platform so simple - We had only 3 buttons for the workshop and rest was pushed at the back-end. Reminds me of the quote \"The world\'s most difficult thing is keeping things simple\"', '2021-11-12 06:35:54', 1, '2022-06-22 06:46:38', 1, 0),
(2, 20211112120737, 'Anagha Ghosh', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Anagha-Ghosh_2270_1626861523.png', 'VSD Co-Founder', 'https://www.vlsisystemdesign.com', 'Great LMS; it\'s easy to use and it offers extensive third-party integrations.The LMS is simple to use and easy to interoperate with third-party tools and services. The ISF UI offers users easy access to all educational content and learning activities. It also provides a nice overview of course statistics. Have had very little down time over the last one Year or so. Programing is solid and has most all the features that are needed or wanted. 24*7 Level support, redundancy of servers, easy way to jump in and expand learning beyond the classroom walls. This flexibility makes it a great option for institutions with users at various skill levels.', '2021-11-12 06:37:37', 1, '2022-06-22 06:46:38', 1, 0),
(3, 20220628022413, 'testing', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Tapan-Daspng_7381_1656401053.png', 'Adviser', 'asdfg', 'fgjhkcg', '2022-06-28 07:24:14', 1, '2022-06-28 07:24:49', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `el_topics`
--

CREATE TABLE `el_topics` (
  `id` int(11) NOT NULL,
  `unique_id` bigint(20) NOT NULL,
  `course_id` int(11) NOT NULL,
  `topic_name` varchar(255) NOT NULL,
  `sub_topic` varchar(255) NOT NULL,
  `chapter` varchar(255) NOT NULL,
  `topic_image` varchar(255) NOT NULL,
  `topic_docs` varchar(255) NOT NULL,
  `video_links` varchar(255) NOT NULL,
  `lab_video_links` varchar(255) NOT NULL,
  `topic_description` varchar(500) NOT NULL,
  `topic_visibility` tinyint(1) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_topics`
--

INSERT INTO `el_topics` (`id`, `unique_id`, `course_id`, `topic_name`, `sub_topic`, `chapter`, `topic_image`, `topic_docs`, `video_links`, `lab_video_links`, `topic_description`, `topic_visibility`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(2, 2022070403185353449, 1, 'Day 1 - Study and review various components of RISC-V based picoSoC', 'D1SK1 - IC design components terminologies', 'L1 - Introduction to QFN-48 Package, chip, pads, core, die and IPÂs', '', '', 'https://iframe.videodelivery.net/a9930a61e43963549b70a58d65091e0d', ' ', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(3, 2022070403185311376, 1, 'Day 1 - Study and review various components of RISC-V based picoSoC', 'D1SK2 - Let\'s talk to computers', 'L1 - Introduction to RISC-V', '', '', 'https://iframe.videodelivery.net/cc530b76c9f6d5663312889818734283', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(4, 2022070403185384259, 1, 'Day 1 - Study and review various components of RISC-V based picoSoC', 'D1SK2 - Let\'s talk to computers', 'L2 - From Software Applications to Hardware', '', '', 'https://iframe.videodelivery.net/e7c8984c1cac0c7c3cd77576e3dde257', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(5, 2022070403185367695, 1, 'Day 1 - Study and review various components of RISC-V based picoSoC', 'D1SK3 - RISC-V based SoC reference design', 'L1 - Pre-requisites and RISC-V, picorv32 and picoSoC review', '', '', 'https://iframe.videodelivery.net/1e968f5c9840b0d7a06d0f57b5fd9420', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(6, 2022070403185319346, 1, 'Day 1 - Study and review various components of RISC-V based picoSoC', 'D1SK3 - RISC-V based SoC reference design', 'L2 - Raven SoC and Raven full chip review', '', '', 'https://iframe.videodelivery.net/7c42b0a49d580dcfa9a1831a39d7ae19', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(7, 2022070403185316561, 1, 'Day 1 - Study and review various components of RISC-V based picoSoC', 'D1SK4 - Get familiar to open-source EDA tools', 'L1 - Introduction to IC design components and open-source EDA tools', '', '', 'https://iframe.videodelivery.net/351d48539e185ae3120e9bdc80db6a86', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(8, 2022070403185388479, 1, 'Day 1 - Study and review various components of RISC-V based picoSoC', 'D1SK4 - Get familiar to open-source EDA tools', 'L2 - Steps to start synthesizing picorv32, report (register count/combinational logic count) ratio', '', '', 'https://iframe.videodelivery.net/e43215706a415bde68cfd65404385301', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(9, 2022070403185362479, 1, 'Day 1 - Study and review various components of RISC-V based picoSoC', 'D1SK4 - Get familiar to open-source EDA tools', 'L3 - Test open-source EDA tools using sample design (spi_slave) and vsdflow utility', '', '', 'https://iframe.videodelivery.net/1bcfc6f0769ef8c77bbf741ddba82cbe', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(10, 2022070403185315911, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK1 - Chip Floor planning considerations', 'L1 - Utilization factor and aspect ratio', '', '', 'https://iframe.videodelivery.net/2560b6a3d13b3d19bd093ebd4d8b4349', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(11, 2022070403185364266, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK1 - Chip Floor planning considerations', 'L2 - Concept of pre-placed cells', '', '', 'https://iframe.videodelivery.net/418faab88435723b8fe41f5a3daf02c4', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(12, 2022070403185397406, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK1 - Chip Floor planning considerations', 'L3 - De-coupling capacitors', '', '', 'https://iframe.videodelivery.net/adf50d729710568e35a25e7e5a0121b3', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(13, 2022070403185321681, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK1 - Chip Floor planning considerations', 'L4 - Power planning', '', '', 'https://iframe.videodelivery.net/710058842b5ead7e1afb775ccb1323a8', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(14, 2022070403185385222, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK1 - Chip Floor planning considerations', 'L5 - Pin placement and logical cell placement blockage', '', '', 'https://iframe.videodelivery.net/bc507eae8a7b61140ff1f2c7ed5aae78', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(15, 2022070403185314769, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK1 - Chip Floor planning considerations', 'L6 - Pin arrangement UI and automatic grouping of vectors', '', '', 'https://iframe.videodelivery.net/6ed8a9aea5d2cd564b6defa76b40298e', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(16, 2022070403185385950, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK1 - Chip Floor planning considerations', 'L7 - Tips on Pin Placement And Floor planning Chip', '', '', 'https://iframe.videodelivery.net/c988d83cede89528dd737ceac5d69084', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(17, 2022070403185339241, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK2 - Library Binding and Placement', 'L1 - Netlist binding and initial place design', '', '', 'https://iframe.videodelivery.net/54667c1c322f8251a059c3acb3d06102', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(18, 2022070403185352566, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK2 - Library Binding and Placement', 'L2 - Optimize placement using estimated wire-length and capacitance', '', '', 'https://iframe.videodelivery.net/2390cdcf1428d21df86b0dc82998b8eb', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(19, 2022070403185325029, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK2 - Library Binding and Placement', 'L3 - Final placement optimization', '', '', 'https://iframe.videodelivery.net/72418d21876f0afc6a142f83390cf570', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(20, 2022070403185325197, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK2 - Library Binding and Placement', 'L4 - Need for libraries and characterization', '', '', 'https://iframe.videodelivery.net/5bb4b327e14040b63648ce7c5a766737', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(21, 2022070403185375799, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK3 - Cell design and characterization flows', 'L1 - Inputs for cell design flow', '', '', 'https://iframe.videodelivery.net/b3e6c20d7a723ec7457fe0a06e8ed09f', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(22, 2022070403185370545, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK3 - Cell design and characterization flows', 'L2 - Circuit design step', '', '', 'https://iframe.videodelivery.net/7a4ad9733254fe708ffe067e01551bb6', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(23, 2022070403185337331, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK3 - Cell design and characterization flows', 'L3 - Layout design step', '', '', 'https://iframe.videodelivery.net/aa307daa36c3840094f6bfcee1b0e108', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 08:18:53', 4, 0),
(24, 2022070403185394752, 1, 'Day 2 - Chip planning strategies and introduction to foundry library cells', 'D2SK3 - Cell design and characterization flows', 'L4 - Typical characterization flow', '', '', 'https://iframe.videodelivery.net/9eab0e1c109db0b1a0c2c5cbe18b5906', '', '', 1, '2022-07-04 08:18:53', 4, '2022-07-04 10:34:16', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `el_topics_completed`
--

CREATE TABLE `el_topics_completed` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `el_topics_completed`
--

INSERT INTO `el_topics_completed` (`id`, `account_id`, `course_id`, `topic_id`, `updated_on`) VALUES
(1, 11, 1, 2, '2022-07-13 10:13:50'),
(2, 11, 1, 3, '2022-07-13 10:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `el_training_material`
--

CREATE TABLE `el_training_material` (
  `training_id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `training_image` varchar(255) NOT NULL,
  `training_material` varchar(255) NOT NULL,
  `training_description` varchar(255) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `added_by` int(11) NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) NOT NULL,
  `is_del` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `el_training_material`
--

INSERT INTO `el_training_material` (`training_id`, `document_name`, `training_image`, `training_material`, `training_description`, `added_on`, `added_by`, `updated_on`, `updated_by`, `is_del`) VALUES
(0, 'ghgr', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/easylearn-logopng_4077_1656571674.png', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/EasyLearn-Teaser-1pdf_6020_1656571675.pdf', 'xcfghjgfhh', '2022-06-30 06:47:55', 4, '2022-06-30 06:49:28', 4, 1),
(1, 'Dashboard', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/dashboard_4452_1631012105.png', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn+Dashboards.pdf', 'Dashboard Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(2, 'Accounting System', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Accounting%20System_9258_1631012186.jpg', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Accounting+System.pdf', 'Accounting System Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(3, 'Admission Management', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Admission%20Management_5492_1631013059.jpg', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Admission+Management.pdf', 'Admission Management Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 06:25:24', 4, 0),
(4, 'Attendance System', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Attendance%20Management_7177_1631013172.jpg', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Attendance+System.pdf', 'Attendance System Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(5, 'Channel Management', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Channel%20management_9318_1631013259.jpg', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Channel+Management.pdf', 'Channel Management Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(6, 'Classroom System', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/1102078_7303_1652951510_4748_1655361246.jpg', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/classroomFiles/Agriculture%20Marketplace%20Featurelist%20%282%29_2975_1655361212.pdf', 'Classroom System Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(7, 'Configuration Settings', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/WhatsApp%20Image%202021-09-07%20at%205.11.40%20PM_2293_1631015131.jpeg', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Configuration+Settings.pdf', 'Configuration Settings Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(8, 'Course management System', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Course%20management_3642_1631013594.jpg', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Course+Management+System.pdf', 'Course management System Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(9, 'Data Management', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Data%20Management_3428_1631013682.jpg', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Data+Management.pdf', 'Data Management Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:25:35', 4, 0),
(10, 'Examination System', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Examination%20Management_2889_1631013798.jpg', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Examination+System.pdf', 'Examination System Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(11, 'Feedback', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Feedback_3822_1631013891.jpg', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Feedback.pdf', 'Feedback Training Report', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(12, 'Issues', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Issues_4803_1631014002.png', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Issues.pdf', 'Issues Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(13, 'MIS System', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/MIS_9067_1631014432.png', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-MIS+System.pdf', 'MIS System Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(14, 'Poll , Gadgets & Media', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Polling%20%26%20Gadgets_5125_1631014563.jpg', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Poll%2CGadgets%2CMedia.pdf', 'Poll , Gadgets & Media Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(15, 'Prospectus', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/prospectus_9839_1631014646.jpg', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Prospects+List.pdf', 'Prospectus Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(16, 'Tools', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Tools_6952_1631014736.png', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Tools.pdf', 'Tools Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(17, 'Registration and Secured Login System', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Secured%20Login_8289_1631014864.png', 'https://easylearn.s3.ap-south-1.amazonaws.com/Training+Materials/EasyLearn-Registration+and+Secured+Login+System.pdf', 'Registration and Secured Login System Training Description', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(18, 'Presentation', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/EasyLearn%20Logo_1561_1632297903.png', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/EasyLearn%20Presentation%20-%20Summary_5646_1632297904.pdf', 'Summary presentation', '2022-06-16 01:09:32', 0, '2022-06-16 01:09:32', 0, 0),
(20, 'Developer Document', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Training-material-development_5784_1647251862.png', 'https://mentorboxfiles.s3.ap-south-1.amazonaws.com/profileFiles/Training-material-development_5826_1647251863.png', 'This is a Developer document.', '2022-06-16 01:09:32', 0, '2022-06-16 06:26:12', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `el_aboutus`
--
ALTER TABLE `el_aboutus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_accounts`
--
ALTER TABLE `el_accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_account_details`
--
ALTER TABLE `el_account_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_account_details el_accounts` (`account_id`);

--
-- Indexes for table `el_admin`
--
ALTER TABLE `el_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD KEY `el_admin el_accounts` (`account_id`);

--
-- Indexes for table `el_announcements`
--
ALTER TABLE `el_announcements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_batches`
--
ALTER TABLE `el_batches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD KEY `el_batches el_classroom` (`classroom_id`);

--
-- Indexes for table `el_batch_assignment`
--
ALTER TABLE `el_batch_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_batch_assignment el_accounts` (`account_id`),
  ADD KEY `el_batch_assignment el_classroom` (`classroom_id`),
  ADD KEY `el_batch_assignment el_batches` (`batch_id`);

--
-- Indexes for table `el_batch_course`
--
ALTER TABLE `el_batch_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_batch_course el_courses` (`course_id`),
  ADD KEY `el_batch_course el_batches` (`batch_id`),
  ADD KEY `el_batch_course el_classroom` (`classroom_id`);

--
-- Indexes for table `el_benefits`
--
ALTER TABLE `el_benefits`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_classroom`
--
ALTER TABLE `el_classroom`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD KEY `el_accounts el_classroom` (`account_id`);

--
-- Indexes for table `el_classroom_assignment`
--
ALTER TABLE `el_classroom_assignment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_classroom_assignment el_accounts` (`account_id`),
  ADD KEY `el_classroom_assignment el_classroom` (`classroom_id`);

--
-- Indexes for table `el_classroom_course`
--
ALTER TABLE `el_classroom_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_classroom_course` (`course_id`),
  ADD KEY `el_classroom_course el_classroom` (`classroom_id`);

--
-- Indexes for table `el_courses`
--
ALTER TABLE `el_courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_course_hours_spent`
--
ALTER TABLE `el_course_hours_spent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_course_hours_spent el_accounts` (`account_id`),
  ADD KEY `el_course_hours_spent el_courses` (`course_id`),
  ADD KEY `el_course_hours_spent el_topics` (`topic_id`);

--
-- Indexes for table `el_documents`
--
ALTER TABLE `el_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_documents el_accounts` (`account_id`);

--
-- Indexes for table `el_features`
--
ALTER TABLE `el_features`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_fee_structure`
--
ALTER TABLE `el_fee_structure`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_hostel`
--
ALTER TABLE `el_hostel`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_jr_clg`
--
ALTER TABLE `el_jr_clg`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_lab_instance`
--
ALTER TABLE `el_lab_instance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_lab_instance el_registration` (`reg_id`),
  ADD KEY `el_lab_instance el_classroom` (`classroom_id`),
  ADD KEY `el_lab_instance el_batches` (`batch_id`),
  ADD KEY `el_lab_instance el_accounts` (`account_id`);

--
-- Indexes for table `el_login_activites`
--
ALTER TABLE `el_login_activites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_login_activites el_accounts` (`account_id`);

--
-- Indexes for table `el_mcq_exam`
--
ALTER TABLE `el_mcq_exam`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_mcq_exam el_courses` (`course_id`),
  ADD KEY `el_mcq_exam el_classroom` (`classroom_id`);

--
-- Indexes for table `el_mentor_registration`
--
ALTER TABLE `el_mentor_registration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD KEY `el_mentor_rgistration el_accounts` (`account_id`);

--
-- Indexes for table `el_miro_whiteboard`
--
ALTER TABLE `el_miro_whiteboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_miro_whiteboard el_accounts` (`account_id`);

--
-- Indexes for table `el_news`
--
ALTER TABLE `el_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_newsfeed`
--
ALTER TABLE `el_newsfeed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_project_documents`
--
ALTER TABLE `el_project_documents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_registration`
--
ALTER TABLE `el_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_schedule`
--
ALTER TABLE `el_schedule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `schedule_id` (`schedule_id`),
  ADD KEY `el_schedule el_registration` (`reg_id`),
  ADD KEY `el_schedule el_batches` (`batch_id`),
  ADD KEY `el_schedule el_accounts` (`lecturer_id`),
  ADD KEY `el_schedule el_classroom` (`classroom_id`);

--
-- Indexes for table `el_schedule_attendance`
--
ALTER TABLE `el_schedule_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_schedule_attendance el_accounts` (`account_id`),
  ADD KEY `el_schedule_attendance el_schedule` (`schedule_id`);

--
-- Indexes for table `el_school`
--
ALTER TABLE `el_school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `el_security`
--
ALTER TABLE `el_security`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_services`
--
ALTER TABLE `el_services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_settings`
--
ALTER TABLE `el_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD KEY `el_settings_category` (`category_id`);

--
-- Indexes for table `el_settings_category`
--
ALTER TABLE `el_settings_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_slider`
--
ALTER TABLE `el_slider`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_store_secret`
--
ALTER TABLE `el_store_secret`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_store_secret el_accounts` (`account_id`);

--
-- Indexes for table `el_student`
--
ALTER TABLE `el_student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD KEY `el_student el_accounts` (`account_id`);

--
-- Indexes for table `el_team`
--
ALTER TABLE `el_team`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_testimonials`
--
ALTER TABLE `el_testimonials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- Indexes for table `el_topics`
--
ALTER TABLE `el_topics`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD KEY `mtbx_topics mtbx_courses` (`course_id`);

--
-- Indexes for table `el_topics_completed`
--
ALTER TABLE `el_topics_completed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `el_topics_completed el_accounts` (`account_id`),
  ADD KEY `el_topics_completed el_courses` (`course_id`),
  ADD KEY `el_topics_completed el_topics` (`topic_id`);

--
-- Indexes for table `el_training_material`
--
ALTER TABLE `el_training_material`
  ADD PRIMARY KEY (`training_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `el_aboutus`
--
ALTER TABLE `el_aboutus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `el_accounts`
--
ALTER TABLE `el_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `el_account_details`
--
ALTER TABLE `el_account_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `el_admin`
--
ALTER TABLE `el_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `el_announcements`
--
ALTER TABLE `el_announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `el_batches`
--
ALTER TABLE `el_batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `el_batch_assignment`
--
ALTER TABLE `el_batch_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `el_batch_course`
--
ALTER TABLE `el_batch_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `el_benefits`
--
ALTER TABLE `el_benefits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `el_classroom`
--
ALTER TABLE `el_classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `el_classroom_assignment`
--
ALTER TABLE `el_classroom_assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `el_classroom_course`
--
ALTER TABLE `el_classroom_course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `el_courses`
--
ALTER TABLE `el_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `el_course_hours_spent`
--
ALTER TABLE `el_course_hours_spent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `el_documents`
--
ALTER TABLE `el_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `el_features`
--
ALTER TABLE `el_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `el_fee_structure`
--
ALTER TABLE `el_fee_structure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `el_hostel`
--
ALTER TABLE `el_hostel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `el_jr_clg`
--
ALTER TABLE `el_jr_clg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `el_lab_instance`
--
ALTER TABLE `el_lab_instance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `el_login_activites`
--
ALTER TABLE `el_login_activites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `el_mcq_exam`
--
ALTER TABLE `el_mcq_exam`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `el_mentor_registration`
--
ALTER TABLE `el_mentor_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `el_miro_whiteboard`
--
ALTER TABLE `el_miro_whiteboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `el_news`
--
ALTER TABLE `el_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `el_newsfeed`
--
ALTER TABLE `el_newsfeed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `el_project_documents`
--
ALTER TABLE `el_project_documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `el_registration`
--
ALTER TABLE `el_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `el_schedule`
--
ALTER TABLE `el_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `el_schedule_attendance`
--
ALTER TABLE `el_schedule_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `el_school`
--
ALTER TABLE `el_school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `el_security`
--
ALTER TABLE `el_security`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `el_services`
--
ALTER TABLE `el_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `el_settings`
--
ALTER TABLE `el_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `el_settings_category`
--
ALTER TABLE `el_settings_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `el_slider`
--
ALTER TABLE `el_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `el_store_secret`
--
ALTER TABLE `el_store_secret`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `el_student`
--
ALTER TABLE `el_student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `el_team`
--
ALTER TABLE `el_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `el_testimonials`
--
ALTER TABLE `el_testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `el_topics`
--
ALTER TABLE `el_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `el_topics_completed`
--
ALTER TABLE `el_topics_completed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `el_account_details`
--
ALTER TABLE `el_account_details`
  ADD CONSTRAINT `el_account_details el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`);

--
-- Constraints for table `el_admin`
--
ALTER TABLE `el_admin`
  ADD CONSTRAINT `el_admin el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`);

--
-- Constraints for table `el_batches`
--
ALTER TABLE `el_batches`
  ADD CONSTRAINT `el_batches el_classroom` FOREIGN KEY (`classroom_id`) REFERENCES `el_classroom` (`id`);

--
-- Constraints for table `el_batch_assignment`
--
ALTER TABLE `el_batch_assignment`
  ADD CONSTRAINT `el_batch_assignment el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`),
  ADD CONSTRAINT `el_batch_assignment el_batches` FOREIGN KEY (`batch_id`) REFERENCES `el_batches` (`id`),
  ADD CONSTRAINT `el_batch_assignment el_classroom` FOREIGN KEY (`classroom_id`) REFERENCES `el_classroom` (`id`);

--
-- Constraints for table `el_batch_course`
--
ALTER TABLE `el_batch_course`
  ADD CONSTRAINT `el_batch_course el_batches` FOREIGN KEY (`batch_id`) REFERENCES `el_batches` (`id`),
  ADD CONSTRAINT `el_batch_course el_classroom` FOREIGN KEY (`classroom_id`) REFERENCES `el_classroom` (`id`),
  ADD CONSTRAINT `el_batch_course el_courses` FOREIGN KEY (`course_id`) REFERENCES `el_courses` (`id`);

--
-- Constraints for table `el_classroom`
--
ALTER TABLE `el_classroom`
  ADD CONSTRAINT `el_accounts el_classroom` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`);

--
-- Constraints for table `el_classroom_assignment`
--
ALTER TABLE `el_classroom_assignment`
  ADD CONSTRAINT `el_classroom_assignment el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`),
  ADD CONSTRAINT `el_classroom_assignment el_classroom` FOREIGN KEY (`classroom_id`) REFERENCES `el_classroom` (`id`);

--
-- Constraints for table `el_classroom_course`
--
ALTER TABLE `el_classroom_course`
  ADD CONSTRAINT `el_classroom_course` FOREIGN KEY (`course_id`) REFERENCES `el_courses` (`id`),
  ADD CONSTRAINT `el_classroom_course el_classroom` FOREIGN KEY (`classroom_id`) REFERENCES `el_classroom` (`id`);

--
-- Constraints for table `el_course_hours_spent`
--
ALTER TABLE `el_course_hours_spent`
  ADD CONSTRAINT `el_course_hours_spent el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`),
  ADD CONSTRAINT `el_course_hours_spent el_courses` FOREIGN KEY (`course_id`) REFERENCES `el_courses` (`id`),
  ADD CONSTRAINT `el_course_hours_spent el_topics` FOREIGN KEY (`topic_id`) REFERENCES `el_topics` (`id`);

--
-- Constraints for table `el_documents`
--
ALTER TABLE `el_documents`
  ADD CONSTRAINT `el_documents el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`);

--
-- Constraints for table `el_lab_instance`
--
ALTER TABLE `el_lab_instance`
  ADD CONSTRAINT `el_lab_instance el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`),
  ADD CONSTRAINT `el_lab_instance el_batches` FOREIGN KEY (`batch_id`) REFERENCES `el_batches` (`id`),
  ADD CONSTRAINT `el_lab_instance el_classroom` FOREIGN KEY (`classroom_id`) REFERENCES `el_classroom` (`id`),
  ADD CONSTRAINT `el_lab_instance el_registration` FOREIGN KEY (`reg_id`) REFERENCES `el_registration` (`id`);

--
-- Constraints for table `el_login_activites`
--
ALTER TABLE `el_login_activites`
  ADD CONSTRAINT `el_login_activites el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`);

--
-- Constraints for table `el_mcq_exam`
--
ALTER TABLE `el_mcq_exam`
  ADD CONSTRAINT `el_mcq_exam el_classroom` FOREIGN KEY (`classroom_id`) REFERENCES `el_classroom` (`id`),
  ADD CONSTRAINT `el_mcq_exam el_courses` FOREIGN KEY (`course_id`) REFERENCES `el_courses` (`id`);

--
-- Constraints for table `el_mentor_registration`
--
ALTER TABLE `el_mentor_registration`
  ADD CONSTRAINT `el_mentor_rgistration el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`);

--
-- Constraints for table `el_miro_whiteboard`
--
ALTER TABLE `el_miro_whiteboard`
  ADD CONSTRAINT `el_miro_whiteboard el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`);

--
-- Constraints for table `el_schedule`
--
ALTER TABLE `el_schedule`
  ADD CONSTRAINT `el_schedule el_accounts` FOREIGN KEY (`lecturer_id`) REFERENCES `el_accounts` (`id`),
  ADD CONSTRAINT `el_schedule el_batches` FOREIGN KEY (`batch_id`) REFERENCES `el_batches` (`id`),
  ADD CONSTRAINT `el_schedule el_classroom` FOREIGN KEY (`classroom_id`) REFERENCES `el_classroom` (`id`),
  ADD CONSTRAINT `el_schedule el_registration` FOREIGN KEY (`reg_id`) REFERENCES `el_registration` (`id`);

--
-- Constraints for table `el_schedule_attendance`
--
ALTER TABLE `el_schedule_attendance`
  ADD CONSTRAINT `el_schedule_attendance el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`),
  ADD CONSTRAINT `el_schedule_attendance el_schedule` FOREIGN KEY (`schedule_id`) REFERENCES `el_schedule` (`schedule_id`);

--
-- Constraints for table `el_settings`
--
ALTER TABLE `el_settings`
  ADD CONSTRAINT `el_settings_category` FOREIGN KEY (`category_id`) REFERENCES `el_settings_category` (`id`);

--
-- Constraints for table `el_store_secret`
--
ALTER TABLE `el_store_secret`
  ADD CONSTRAINT `el_store_secret el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`);

--
-- Constraints for table `el_student`
--
ALTER TABLE `el_student`
  ADD CONSTRAINT `el_student el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`);

--
-- Constraints for table `el_topics`
--
ALTER TABLE `el_topics`
  ADD CONSTRAINT `mtbx_topics mtbx_courses` FOREIGN KEY (`course_id`) REFERENCES `el_courses` (`id`);

--
-- Constraints for table `el_topics_completed`
--
ALTER TABLE `el_topics_completed`
  ADD CONSTRAINT `el_topics_completed el_accounts` FOREIGN KEY (`account_id`) REFERENCES `el_accounts` (`id`),
  ADD CONSTRAINT `el_topics_completed el_courses` FOREIGN KEY (`course_id`) REFERENCES `el_courses` (`id`),
  ADD CONSTRAINT `el_topics_completed el_topics` FOREIGN KEY (`topic_id`) REFERENCES `el_topics` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
