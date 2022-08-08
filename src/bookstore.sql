DROP TABLE IF EXISTS tbladmin;
DROP TABLE IF EXISTS tblbooks;
DROP TABLE IF EXISTS tblorder;
DROP TABLE IF EXISTS tblrequests;

CREATE TABLE `tbladmin` (
  `Admin_ID` varchar(15) PRIMARY KEY COLLATE armscii8_bin NOT NULL,
  `First_Name` varchar(45) COLLATE armscii8_bin NOT NULL,
  `Surname` varchar(45) COLLATE armscii8_bin NOT NULL,
  `Email` varchar(45) COLLATE armscii8_bin NOT NULL,
  `Course` varchar(10) COLLATE armscii8_bin NOT NULL,
  `Password` text COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

CREATE TABLE `tblrequests` (
   `Student_Number` varchar(55) COLLATE armscii8_bin NOT NULL,
   `ISBN` varchar(45) COLLATE armscii8_bin NOT NULL,
   `Book_Name` text COLLATE armscii8_bin NOT NULL,
   `Display_Name` varchar(75) COLLATE armscii8_bin NOT NULL,
   `Description` text COLLATE armscii8_bin NOT NULL,
   `Price` varchar(75) COLLATE armscii8_bin NOT NULL,
   `Course` varchar(55) COLLATE armscii8_bin NOT NULL,
   `Image` varchar(75) COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

INSERT INTO `tbladmin` (`Admin_ID`, `First_Name`, `Surname`, `Email`, `Course`, `Password`) VALUES
('AD1013152', 'JP', 'Jones', 'AD1013152@iie.edu.za', 'DISD313', '$argon2i$v=19$m=16,t=2,p=1$TFc0dEROb3M0SXlVSFNFRQ$cdg8pP6J7TyyfyodcrY5Ew'),
('AD1013154', 'Kyle', 'Edendale', 'AD1013154@iie.edu.za', 'DNM311', '$argon2i$v=19$m=16,t=2,p=1$TFc0dEROb3M0SXlVSFNFRQ$cdg8pP6J7TyyfyodcrY5Ew'),
('AD1013162', 'Jim', 'Kai', 'AD1013162@iie.edu.za', 'DIS6022', '$argon2i$v=19$m=16,t=2,p=1$TFc0dEROb3M0SXlVSFNFRQ$cdg8pP6J7TyyfyodcrY5Ew'),
('AD10131744', 'Jennifer', 'Kyle', 'AD1018754@iie.edu.za', 'HCL1', '$argon2i$v=19$m=16,t=2,p=1$TFc0dEROb3M0SXlVSFNFRQ$cdg8pP6J7TyyfyodcrY5Ew'),
('AD1013188', 'Tim', 'Smith', 'AD1013188@iie.edu.za', 'DNM313', '$argon2i$v=19$m=16,t=2,p=1$TFc0dEROb3M0SXlVSFNFRQ$cdg8pP6J7TyyfyodcrY5Ew');

CREATE TABLE `tblbooks` (
  `Admin_ID` varchar(11) COLLATE armscii8_bin NOT NULL,
  `ISBN` varchar(16) PRIMARY KEY COLLATE armscii8_bin NOT NULL,
  `Book_Name` varchar(55) COLLATE armscii8_bin NOT NULL,
  `Display_Name` varchar(55) COLLATE armscii8_bin NOT NULL,
  `Description` text COLLATE armscii8_bin NOT NULL,
  `Course` varchar(10) COLLATE armscii8_bin NOT NULL,
  `Price` decimal(8,2) NOT NULL,
  `InStock` tinyint(1) NOT NULL,
  `Image` varchar(55) COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

INSERT INTO `tblbooks` (`Admin_ID`, `ISBN`, `Book_Name`, `Display_Name`, `Description`, `Course`, `Price`, `InStock`, `Image`) VALUES
('AD1013154', '978-0256141177', 'Fundamentals of Logistics Management', 'Logistics Management', 'In an era when most managers--including those in the logistics arena--are being urged to think of themselves as \"marketers,\" this new book offers a special opportunity. Written by high-profile authors, Fundamentals of Logistics Management brings a unique marketing perspective to logistics management, while fully integrating accounting, finance, and manufacturing in their coverage. This is the topical and practical approach readers have been looking for.', 'HCL1', '520.11', 1, '../../images/books/LSCM.jpg'),
('AD1013174', '978-0789758743', 'Networking Essentials', 'Networking Essentials', 'Networking Essentials, Fifth Edition guides readers from an entry-level knowledge in computer networks to advanced concepts in Ethernet and TCP/IP networks, routing protocols and router configuration, local, campus, and wide area network configuration, network security, wireless networking, optical networks, Voice over IP, the network server, and Linux networking. This edition contains additional coverage of switch security, troubleshooting IP networks, authorization and access control, best practices for disaster recovery, network infrastructure configuration and management, data traffic network analysis, network security, and VoIP. It also covers approximately 250 new terms now addressed by CompTIA’s N10-007 exam.\r\n\r\n\r\n\r\nClear goals are outlined for each chapter, and every concept is introduced in easy-to-understand language that explains how and why networking technologies are used. Each chapter is packed with real-world examples and practical exercises that reinforce all concepts and guide you through using them to configure, analyze, and fix networks.\r\n\r\n\r\n\r\nThe companion web site features labs, Wireshark captures, and chapter quizzes.\r\n\r\n\r\n\r\nKEY PEDAGOGICAL FEATURES\r\n\r\nNET-CHALLENGE SIMULATION SOFTWARE provides hands-on experience with entering router and switch commands, setting up functions, and configuring interfaces and protocols\r\nWIRESHARK NETWORK PROTOCOL ANALYZER presents techniques and examples of data traffic analysis throughout\r\nPROVEN TOOLS FOR MORE EFFECTIVE LEARNING AND NETWORK+ PREP, including chapter outlines, summaries, and Network+ objectives\r\nWORKING EXAMPLES IN EVERY CHAPTER to reinforce key concepts and promote mastery\r\nKEY TERM DEFINITIONS, LISTINGS, AND EXTENSIVE GLOSSARY to help you master the language of networking\r\nQUESTIONS, PROBLEMS, AND CRITICAL THINKING QUESTIONS to help you deepen your\r\nunderstanding', 'DNM313', '624.02', 1, '../../images/books/Networking_essentials.jpg'),
('AD1013152', '978-0971677500', 'How to Think Like a Computer Scientist', 'Computer Scientist', '\"How to Think Like a Computer Scientist: Learning with Python\" is an introduction to computer science using the Python programming language. It covers the basics of computer programming, including variables and values, functions, conditionals and control flow, program development and debugging. Later chapters cover basic algorithms and data structures.', 'DISD313', '939.00', 1, '../../images/books/CS.jpg'),
('AD1013188', '978-1119165354', 'Project Management', 'Project Management', 'THE #1 GUIDE FOR STUDENTS AND PROFESSIONALS, NOW UPDATED FOR THE LATEST TRENDS AND EMERGING ISSUES Project Management, or the \"Project Management bible\" as it\'s widely known, provides practical guidance on all aspects of project management.\r\nTHE #1 GUIDE FOR STUDENTS AND PROFESSIONALS, NOW UPDATED FOR THE LATEST TRENDS AND EMERGING ISSUES Project Management, or the "\Project Management bible\" as it\'s widely known, provides practical guidance on all aspects of project management. It features a streamlined approach to PM functions without stinting on detailed coverage of the tools and methods used at all stages of a project. This 12th Edition has been updated to reflect industry changes and features in-depth coverage of emerging topics, including global stakeholder management, causes of failure, agile project management, project governance failure, customer approval milestones, classifying project metrics, and more. Also, supplementary materials are available for students, professionals, and instructors.\r\n* Understand organizational structures and project management functions * Learn how to control costs, manage risk, and analyze trade-offs * Examine different methods used for planning, scheduling, QA, and more * Work effectively with customers and stakeholders from around the globe As projects increase in scope and complexity, managing them across time zones, language barriers, and technology platforms requires a systematic approach that accounts for every detail. All the more reason to keep Project Management, 12th Edition within arm\'s reach throughout all stages of the projects you manage.', 'DIS6022', '970.85', 1, '../../images/books/PM.jpg'),
('AD1013188', '978-1285776712', 'Programming Logic and Design, Comprehensive 8th Edition', 'Programming Logic and Design', 'Prepare beginning programmers with the most important principles for developing structured program logic with Farrell\'s highly effective PROGRAMMING LOGIC AND DESIGN, COMPREHENSIVE, 8E. This popular text takes a unique, language-independent approach to programming with a distinctive emphasis on modern conventions. The book\'s clear, concise writing style eliminates highly technical jargon while introducing universal programming concepts and encouraging a strong programming style and logical thinking. Clear revised explanations utilize flowcharts, pseudocode, and diagrams to ensure even readers with no prior programming experience fully understand modern programming and design concepts. Farrell\'s proven learning features help students gain a better understanding of the scope of programming today while common business examples help illustrate key points. Readers can use this proven book alone or paired with a language-specific companion text that emphasizes C++, Java or Visual Basic.', 'DISD313', '630.44', 1, '../../images/books/PRLD.jpg'),
('AD1013152', '978-1593279288', 'Python Crash Course', 'Python Crash Course','The best-selling Python book in the world, with over 1 million copies sold! A fast-paced, no-nonsense, updated guide to programming in Python. If you''ve been thinking about learning how to code or picking up Python, this internationally bestselling guide to the most popular programming language is your quickest, easiest way to get started and go! Even if you have no experience whatsoever, Python Crash Course, 2nd Edition, will have you writing programs, solving problems, building computer games, and creating data visualizations in no time. You’ll begin with basic concepts like variables, lists, classes, and loops—with the help of fun skill-strengthening exercises for every topic—then move on to making interactive programs and best practices for testing your code. Later chapters put your new knowledge into play with three cool projects: a 2D Space Invaders-style arcade game, a set of responsive data visualizations you’ll build with Python''s handy libraries (Pygame, Matplotlib, Plotly, Django), and a customized web app you can deploy online. Why wait any longer? Start your engine and code!', 'DISD313', '339.76', 1, '../../images/books/prog.jpg'),
('AD1013174', '978-0134092669', 'Computer Systems', 'Computer Systems','Computer systems: A Programmer’s Perspective explains the underlying elements common among all computer systems and how they affect general application performance. Written from the programmer’s perspective, this book strives to teach readers how understanding basic elements of computer systems and executing real practice can lead them to create better programs. Spanning across computer science themes such as hardware architecture, the operating system, and systems software, the Third Edition serves as a comprehensive introduction to programming. This book strives to create programmers who understand all elements of computer systems and will be able to engage in any application of the field--from fixing faulty software, to writing more capable programs, to avoiding common flaws. It lays the groundwork for readers to delve into more intensive topics such as computer architecture, embedded systems, and cybersecurity. This book focuses on systems that execute an x86-64 machine code, and recommends that programmers have access to a Linux system for this course. Programmers should have basic familiarity with C or C++. Also available with MasteringEngineering MasteringEngineering is an online homework, tutorial, and assessment system, designed to improve results through personalized learning. This innovative online program emulates the instructor’s office hour environment, engaging and guiding students through engineering concepts with self-paced individualized coaching  With a wide range of activities available, students can actively learn, understand, and retain even the most difficult concepts. Students, if interested in purchasing this title with MasteringEngineering, ask your instructor for the correct package ISBN and Course ID. Instructors, contact your Pearson representative for more information.', 'DISD313', '339.76', 1, '../../images/books/csys.jpg');

CREATE TABLE `tblorders` (
 `Student_Number` varchar(45) COLLATE armscii8_bin NOT NULL,
 `Order_ID` varchar(45) COLLATE armscii8_bin NOT NULL,
 `ISBN` varchar(45) COLLATE armscii8_bin NOT NULL,
 `Order_Date` date NOT NULL,
 `Order_Total` varchar(45) COLLATE armscii8_bin NOT NULL,
 `Delivery_Method` varchar(45) COLLATE armscii8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;



CREATE TABLE tblmessages(
`Student_Number` VARCHAR(15) NOT NULL,
`Admin_ID` VARCHAR(15) NOT NULL,
`Message` TEXT NOT NULL
);