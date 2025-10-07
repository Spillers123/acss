
```
acss-1
├─ .env
├─ composer.json
├─ composer.lock
├─ package-lock.json
├─ package.json
├─ public
│  ├─ assets
│  │  ├─ img
│  │  ├─ js
│  │  │  ├─ curriculum.js
│  │  │  ├─ generate_schedules.js
│  │  │  ├─ manual_schedules.js
│  │  │  ├─ schedule.js
│  │  │  └─ schedule_management.js
│  │  └─ logo
│  │     ├─ college_logo
│  │     └─ main_logo
│  │        ├─ campus.jpg
│  │        └─ PRMSUlogo.png
│  ├─ css
│  │  ├─ custom.css
│  │  ├─ output.css
│  │  ├─ schedule_management.css
│  │  └─ settings.css
│  ├─ index.php
│  └─ uploads
│     ├─ profiles
│     │  ├─ profile_1_1755697812.png
│     │  ├─ profile_1_1755697860.png
│     │  └─ profile_1_1755860919.png
│     ├─ profiles_picture
│     │  └─ profile_1_1755864417.png
│     └─ profile_pictures
│        ├─ profile_1_1755864533.png
│        ├─ profile_1_1755867785.png
│        ├─ profile_1_1756791244.png
│        ├─ profile_1_1756792379.png
│        ├─ profile_2_1756793168.png
│        ├─ profile_45_1758014886.png
│        ├─ profile_65_1755868685.png
│        ├─ user_1_1755864800.png
│        ├─ user_1_1755865986.png
│        ├─ user_49_1751092559.png
│        ├─ user_59_1755334211.png
│        ├─ user_59_1755334397.png
│        ├─ user_59_1755334635.png
│        ├─ user_59_1755335026.png
│        ├─ user_59_1755335130.png
│        └─ user_59_1755335861.png
├─ src
│  ├─ api
│  │  └─ load_data.php
│  ├─ config
│  │  └─ Database.php
│  ├─ controllers
│  │  ├─ AdminController.php
│  │  ├─ ApiController.php
│  │  ├─ AuthController.php
│  │  ├─ backupcodeforgeneratefunctions.txt
│  │  ├─ ChairController.php
│  │  ├─ DeanController.php
│  │  ├─ DirectorController.php
│  │  ├─ FacultyController.php
│  │  └─ PublicController.php
│  ├─ input.css
│  ├─ middleware
│  │  └─ AuthMiddleware.php
│  ├─ models
│  │  ├─ ContentModel.php
│  │  ├─ ScheduleModel.php
│  │  └─ UserModel.php
│  ├─ public
│  │  └─ uploads
│  │     ├─ colleges
│  │     │  ├─ college_7_1756389443.png
│  │     │  ├─ college_7_1758030305.png
│  │     │  ├─ college_7_1758030382.png
│  │     │  ├─ college_7_1758031121.png
│  │     │  └─ college_7_1758031890.png
│  │     └─ profiles
│  ├─ services
│  │  ├─ AuthService.php
│  │  ├─ EmailService.php
│  │  └─ SchedulingService.php
│  └─ views
│     ├─ admin
│     │  ├─ act_logs.php
│     │  ├─ classroom.php
│     │  ├─ colleges.php
│     │  ├─ colleges_departments.php
│     │  ├─ dashboard.php
│     │  ├─ departments.php
│     │  ├─ edit_user.php
│     │  ├─ layout.php
│     │  ├─ profile.php
│     │  ├─ schedule.php
│     │  ├─ settings.php
│     │  └─ users.php
│     ├─ auth
│     │  ├─ forgot_password.php
│     │  ├─ login.php
│     │  ├─ register-step2.php
│     │  ├─ register.php
│     │  └─ reset_password.php
│     ├─ chair
│     │  ├─ backup_Schedulemanagementfile.txt
│     │  ├─ classroom.php
│     │  ├─ courses.php
│     │  ├─ curriculum.php
│     │  ├─ dashboard.php
│     │  ├─ faculty.php
│     │  ├─ layout.php
│     │  ├─ my_schedule.php
│     │  ├─ profile.php
│     │  ├─ schedule_history.php
│     │  ├─ schedule_management.php
│     │  └─ sections.php
│     ├─ dean
│     │  ├─ activities.php
│     │  ├─ classroom.php
│     │  ├─ courses.php
│     │  ├─ curriculum.php
│     │  ├─ dashboard.php
│     │  ├─ faculty.php
│     │  ├─ layout.php
│     │  ├─ manage_schedules.php
│     │  ├─ profile.php
│     │  ├─ schedule.php
│     │  ├─ search.php
│     │  └─ settings.php
│     ├─ director
│     │  ├─ dashboard.php
│     │  ├─ layout.php
│     │  ├─ monitor.php
│     │  ├─ profile.php
│     │  ├─ schedule.php
│     │  └─ schedule_deadline.php
│     ├─ errors
│     │  └─ 403.php
│     ├─ faculty
│     │  ├─ dashboard.php
│     │  ├─ layout.php
│     │  ├─ my_schedule.php
│     │  └─ profile.php
│     ├─ partials
│     │  ├─ chair
│     │  │  └─ sidebar.php
│     │  ├─ css
│     │  │  └─ custome.css
│     │  └─ faculty
│     ├─ public
│     │  └─ home.php
│     └─ vpaa
├─ tailwind.config.js
├─ test_db.php
└─ vendor
   ├─ autoload.php
   ├─ bin
   ├─ composer
   │  ├─ autoload_classmap.php
   │  ├─ autoload_files.php
   │  ├─ autoload_namespaces.php
   │  ├─ autoload_psr4.php
   │  ├─ autoload_real.php
   │  ├─ autoload_static.php
   │  ├─ ClassLoader.php
   │  ├─ installed.json
   │  ├─ installed.php
   │  ├─ InstalledVersions.php
   │  ├─ LICENSE
   │  ├─ pcre
   │  │  ├─ composer.json
   │  │  ├─ extension.neon
   │  │  ├─ LICENSE
   │  │  ├─ README.md
   │  │  └─ src
   │  │     ├─ MatchAllResult.php
   │  │     ├─ MatchAllStrictGroupsResult.php
   │  │     ├─ MatchAllWithOffsetsResult.php
   │  │     ├─ MatchResult.php
   │  │     ├─ MatchStrictGroupsResult.php
   │  │     ├─ MatchWithOffsetsResult.php
   │  │     ├─ PcreException.php
   │  │     ├─ PHPStan
   │  │     │  ├─ InvalidRegexPatternRule.php
   │  │     │  ├─ PregMatchFlags.php
   │  │     │  ├─ PregMatchParameterOutTypeExtension.php
   │  │     │  ├─ PregMatchTypeSpecifyingExtension.php
   │  │     │  ├─ PregReplaceCallbackClosureTypeExtension.php
   │  │     │  └─ UnsafeStrictGroupsCallRule.php
   │  │     ├─ Preg.php
   │  │     ├─ Regex.php
   │  │     ├─ ReplaceResult.php
   │  │     └─ UnexpectedNullMatchException.php
   │  └─ platform_check.php
   ├─ graham-campbell
   │  └─ result-type
   │     ├─ CHANGELOG.md
   │     ├─ composer.json
   │     ├─ LICENSE
   │     ├─ phpunit.xml.dist
   │     ├─ README.md
   │     ├─ src
   │     │  ├─ Error.php
   │     │  ├─ Result.php
   │     │  └─ Success.php
   │     └─ tests
   │        └─ ResultTest.php
   ├─ maennchen
   │  └─ zipstream-php
   │     ├─ .editorconfig
   │     ├─ .phive
   │     │  └─ phars.xml
   │     ├─ .php-cs-fixer.dist.php
   │     ├─ .phpdoc
   │     │  └─ template
   │     │     └─ base.html.twig
   │     ├─ .tool-versions
   │     ├─ composer.json
   │     ├─ guides
   │     │  ├─ ContentLength.rst
   │     │  ├─ FlySystem.rst
   │     │  ├─ index.rst
   │     │  ├─ Nginx.rst
   │     │  ├─ Options.rst
   │     │  ├─ PSR7Streams.rst
   │     │  ├─ StreamOutput.rst
   │     │  ├─ Symfony.rst
   │     │  └─ Varnish.rst
   │     ├─ LICENSE
   │     ├─ phpdoc.dist.xml
   │     ├─ phpunit.xml.dist
   │     ├─ psalm.xml
   │     ├─ README.md
   │     ├─ src
   │     │  ├─ CentralDirectoryFileHeader.php
   │     │  ├─ CompressionMethod.php
   │     │  ├─ DataDescriptor.php
   │     │  ├─ EndOfCentralDirectory.php
   │     │  ├─ Exception
   │     │  │  ├─ DosTimeOverflowException.php
   │     │  │  ├─ FileNotFoundException.php
   │     │  │  ├─ FileNotReadableException.php
   │     │  │  ├─ FileSizeIncorrectException.php
   │     │  │  ├─ OverflowException.php
   │     │  │  ├─ ResourceActionException.php
   │     │  │  ├─ SimulationFileUnknownException.php
   │     │  │  ├─ StreamNotReadableException.php
   │     │  │  └─ StreamNotSeekableException.php
   │     │  ├─ Exception.php
   │     │  ├─ File.php
   │     │  ├─ GeneralPurposeBitFlag.php
   │     │  ├─ LocalFileHeader.php
   │     │  ├─ OperationMode.php
   │     │  ├─ PackField.php
   │     │  ├─ Time.php
   │     │  ├─ Version.php
   │     │  ├─ Zip64
   │     │  │  ├─ DataDescriptor.php
   │     │  │  ├─ EndOfCentralDirectory.php
   │     │  │  ├─ EndOfCentralDirectoryLocator.php
   │     │  │  └─ ExtendedInformationExtraField.php
   │     │  ├─ ZipStream.php
   │     │  └─ Zs
   │     │     └─ ExtendedInformationExtraField.php
   │     └─ test
   │        ├─ Assertions.php
   │        ├─ bootstrap.php
   │        ├─ CentralDirectoryFileHeaderTest.php
   │        ├─ DataDescriptorTest.php
   │        ├─ EndlessCycleStream.php
   │        ├─ EndOfCentralDirectoryTest.php
   │        ├─ FaultInjectionResource.php
   │        ├─ LocalFileHeaderTest.php
   │        ├─ PackFieldTest.php
   │        ├─ ResourceStream.php
   │        ├─ Tempfile.php
   │        ├─ TimeTest.php
   │        ├─ Util.php
   │        ├─ Zip64
   │        │  ├─ DataDescriptorTest.php
   │        │  ├─ EndOfCentralDirectoryLocatorTest.php
   │        │  ├─ EndOfCentralDirectoryTest.php
   │        │  └─ ExtendedInformationExtraFieldTest.php
   │        ├─ ZipStreamTest.php
   │        └─ Zs
   │           └─ ExtendedInformationExtraFieldTest.php
   ├─ markbaker
   │  ├─ complex
   │  │  ├─ classes
   │  │  │  └─ src
   │  │  │     ├─ Complex.php
   │  │  │     ├─ Exception.php
   │  │  │     ├─ Functions.php
   │  │  │     └─ Operations.php
   │  │  ├─ composer.json
   │  │  ├─ examples
   │  │  │  ├─ complexTest.php
   │  │  │  ├─ testFunctions.php
   │  │  │  └─ testOperations.php
   │  │  ├─ license.md
   │  │  └─ README.md
   │  └─ matrix
   │     ├─ buildPhar.php
   │     ├─ classes
   │     │  └─ src
   │     │     ├─ Builder.php
   │     │     ├─ Decomposition
   │     │     │  ├─ Decomposition.php
   │     │     │  ├─ LU.php
   │     │     │  └─ QR.php
   │     │     ├─ Div0Exception.php
   │     │     ├─ Exception.php
   │     │     ├─ Functions.php
   │     │     ├─ Matrix.php
   │     │     ├─ Operations.php
   │     │     └─ Operators
   │     │        ├─ Addition.php
   │     │        ├─ DirectSum.php
   │     │        ├─ Division.php
   │     │        ├─ Multiplication.php
   │     │        ├─ Operator.php
   │     │        └─ Subtraction.php
   │     ├─ composer.json
   │     ├─ examples
   │     │  └─ test.php
   │     ├─ infection.json.dist
   │     ├─ license.md
   │     ├─ phpstan.neon
   │     └─ README.md
   ├─ mpdf
   │  ├─ mpdf
   │  │  ├─ CHANGELOG.md
   │  │  ├─ composer.json
   │  │  ├─ CREDITS.txt
   │  │  ├─ data
   │  │  │  ├─ CJKdata.php
   │  │  │  ├─ collations
   │  │  │  │  ├─ Afrikaans_South_Africa.php
   │  │  │  │  ├─ Albanian_Albania.php
   │  │  │  │  ├─ Alsatian_France.php
   │  │  │  │  ├─ Arabic_Algeria.php
   │  │  │  │  ├─ Arabic_Bahrain.php
   │  │  │  │  ├─ Arabic_Egypt.php
   │  │  │  │  ├─ Arabic_Iraq.php
   │  │  │  │  ├─ Arabic_Jordan.php
   │  │  │  │  ├─ Arabic_Kuwait.php
   │  │  │  │  ├─ Arabic_Lebanon.php
   │  │  │  │  ├─ Arabic_Libya.php
   │  │  │  │  ├─ Arabic_Morocco.php
   │  │  │  │  ├─ Arabic_Oman.php
   │  │  │  │  ├─ Arabic_Pseudo_RTL.php
   │  │  │  │  ├─ Arabic_Qatar.php
   │  │  │  │  ├─ Arabic_Saudi_Arabia.php
   │  │  │  │  ├─ Arabic_Syria.php
   │  │  │  │  ├─ Arabic_Tunisia.php
   │  │  │  │  ├─ Arabic_Yemen.php
   │  │  │  │  ├─ Azeri_(Cyrillic)_Azerbaijan.php
   │  │  │  │  ├─ Azeri_(Latin)_Azerbaijan.php
   │  │  │  │  ├─ Bashkir_Russia.php
   │  │  │  │  ├─ Basque_Spain.php
   │  │  │  │  ├─ Belarusian_Belarus.php
   │  │  │  │  ├─ Bosnian_(Cyrillic)_Bosnia_and_Herzegovina.php
   │  │  │  │  ├─ Bosnian_(Latin)_Bosnia_and_Herzegovina.php
   │  │  │  │  ├─ Breton_France.php
   │  │  │  │  ├─ Bulgarian_Bulgaria.php
   │  │  │  │  ├─ Catalan_Spain.php
   │  │  │  │  ├─ Corsican_France.php
   │  │  │  │  ├─ Croatian_(Latin)_Bosnia_and_Herzegovina.php
   │  │  │  │  ├─ Croatian_Croatia.php
   │  │  │  │  ├─ Czech_Czech_Republic.php
   │  │  │  │  ├─ Danish_Denmark.php
   │  │  │  │  ├─ Dari_Afghanistan.php
   │  │  │  │  ├─ Dutch_Belgium.php
   │  │  │  │  ├─ Dutch_Netherlands.php
   │  │  │  │  ├─ English_Australia.php
   │  │  │  │  ├─ English_Belize.php
   │  │  │  │  ├─ English_Canada.php
   │  │  │  │  ├─ English_Caribbean.php
   │  │  │  │  ├─ English_India.php
   │  │  │  │  ├─ English_Ireland.php
   │  │  │  │  ├─ English_Jamaica.php
   │  │  │  │  ├─ English_Malaysia.php
   │  │  │  │  ├─ English_New_Zealand.php
   │  │  │  │  ├─ English_Republic_of_the_Philippines.php
   │  │  │  │  ├─ English_Singapore.php
   │  │  │  │  ├─ English_South_Africa.php
   │  │  │  │  ├─ English_Trinidad_and_Tobago.php
   │  │  │  │  ├─ English_United_Kingdom.php
   │  │  │  │  ├─ English_United_States.php
   │  │  │  │  ├─ English_Zimbabwe.php
   │  │  │  │  ├─ Estonian_Estonia.php
   │  │  │  │  ├─ Faroese_Faroe_Islands.php
   │  │  │  │  ├─ Filipino_Philippines.php
   │  │  │  │  ├─ Finnish_Finland.php
   │  │  │  │  ├─ French_Belgium.php
   │  │  │  │  ├─ French_Canada.php
   │  │  │  │  ├─ French_France.php
   │  │  │  │  ├─ French_Luxembourg.php
   │  │  │  │  ├─ French_Principality_of_Monaco.php
   │  │  │  │  ├─ French_Switzerland.php
   │  │  │  │  ├─ Frisian_Netherlands.php
   │  │  │  │  ├─ Galician_Spain.php
   │  │  │  │  ├─ German_Austria.php
   │  │  │  │  ├─ German_Germany.php
   │  │  │  │  ├─ German_Liechtenstein.php
   │  │  │  │  ├─ German_Luxembourg.php
   │  │  │  │  ├─ German_Switzerland.php
   │  │  │  │  ├─ Greek_Greece.php
   │  │  │  │  ├─ Greenlandic_Greenland.php
   │  │  │  │  ├─ Hausa_(Latin)_Nigeria.php
   │  │  │  │  ├─ Hebrew_Israel.php
   │  │  │  │  ├─ Hungarian_Hungary.php
   │  │  │  │  ├─ Icelandic_Iceland.php
   │  │  │  │  ├─ Igbo_Nigeria.php
   │  │  │  │  ├─ Indonesian_Indonesia.php
   │  │  │  │  ├─ Inuktitut_(Latin)_Canada.php
   │  │  │  │  ├─ Invariant_Language_Invariant_Country.php
   │  │  │  │  ├─ Irish_Ireland.php
   │  │  │  │  ├─ isiXhosa_South_Africa.php
   │  │  │  │  ├─ isiZulu_South_Africa.php
   │  │  │  │  ├─ Italian_Italy.php
   │  │  │  │  ├─ Italian_Switzerland.php
   │  │  │  │  ├─ Kinyarwanda_Rwanda.php
   │  │  │  │  ├─ Kiswahili_Kenya.php
   │  │  │  │  ├─ Kyrgyz_Kyrgyzstan.php
   │  │  │  │  ├─ Latvian_Latvia.php
   │  │  │  │  ├─ Lithuanian_Lithuania.php
   │  │  │  │  ├─ Lower_Sorbian_Germany.php
   │  │  │  │  ├─ Luxembourgish_Luxembourg.php
   │  │  │  │  ├─ Macedonian_(FYROM)_Macedonia_(FYROM).php
   │  │  │  │  ├─ Malay_Brunei_Darussalam.php
   │  │  │  │  ├─ Malay_Malaysia.php
   │  │  │  │  ├─ Mapudungun_Chile.php
   │  │  │  │  ├─ Mohawk_Canada.php
   │  │  │  │  ├─ Mongolian_(Cyrillic)_Mongolia.php
   │  │  │  │  ├─ Norwegian_(Nynorsk)_Norway.php
   │  │  │  │  ├─ Occitan_France.php
   │  │  │  │  ├─ Persian_Iran.php
   │  │  │  │  ├─ Polish_Poland.php
   │  │  │  │  ├─ Portuguese_Brazil.php
   │  │  │  │  ├─ Portuguese_Portugal.php
   │  │  │  │  ├─ Quechua_Bolivia.php
   │  │  │  │  ├─ Quechua_Ecuador.php
   │  │  │  │  ├─ Quechua_Peru.php
   │  │  │  │  ├─ Romanian_Romania.php
   │  │  │  │  ├─ Romansh_Switzerland.php
   │  │  │  │  ├─ Russian_Russia.php
   │  │  │  │  ├─ Sami_(Inari)_Finland.php
   │  │  │  │  ├─ Sami_(Lule)_Norway.php
   │  │  │  │  ├─ Sami_(Lule)_Sweden.php
   │  │  │  │  ├─ Sami_(Northern)_Finland.php
   │  │  │  │  ├─ Sami_(Northern)_Norway.php
   │  │  │  │  ├─ Sami_(Northern)_Sweden.php
   │  │  │  │  ├─ Sami_(Skolt)_Finland.php
   │  │  │  │  ├─ Sami_(Southern)_Norway.php
   │  │  │  │  ├─ Sami_(Southern)_Sweden.php
   │  │  │  │  ├─ Serbian_(Cyrillic)_Bosnia_and_Herzegovina.php
   │  │  │  │  ├─ Serbian_(Cyrillic)_Serbia.php
   │  │  │  │  ├─ Serbian_(Latin)_Bosnia_and_Herzegovina.php
   │  │  │  │  ├─ Serbian_(Latin)_Serbia.php
   │  │  │  │  ├─ Sesotho_sa_Leboa_South_Africa.php
   │  │  │  │  ├─ Setswana_South_Africa.php
   │  │  │  │  ├─ Slovak_Slovakia.php
   │  │  │  │  ├─ Slovenian_Slovenia.php
   │  │  │  │  ├─ Spanish_Argentina.php
   │  │  │  │  ├─ Spanish_Bolivia.php
   │  │  │  │  ├─ Spanish_Chile.php
   │  │  │  │  ├─ Spanish_Colombia.php
   │  │  │  │  ├─ Spanish_Costa_Rica.php
   │  │  │  │  ├─ Spanish_Dominican_Republic.php
   │  │  │  │  ├─ Spanish_Ecuador.php
   │  │  │  │  ├─ Spanish_El_Salvador.php
   │  │  │  │  ├─ Spanish_Guatemala.php
   │  │  │  │  ├─ Spanish_Honduras.php
   │  │  │  │  ├─ Spanish_Mexico.php
   │  │  │  │  ├─ Spanish_Nicaragua.php
   │  │  │  │  ├─ Spanish_Panama.php
   │  │  │  │  ├─ Spanish_Paraguay.php
   │  │  │  │  ├─ Spanish_Peru.php
   │  │  │  │  ├─ Spanish_Puerto_Rico.php
   │  │  │  │  ├─ Spanish_Spain.php
   │  │  │  │  ├─ Spanish_United_States.php
   │  │  │  │  ├─ Spanish_Uruguay.php
   │  │  │  │  ├─ Spanish_Venezuela.php
   │  │  │  │  ├─ Swedish_Finland.php
   │  │  │  │  ├─ Swedish_Sweden.php
   │  │  │  │  ├─ Tajik_(Cyrillic)_Tajikistan.php
   │  │  │  │  ├─ Tamazight_(Latin)_Algeria.php
   │  │  │  │  ├─ Tatar_Russia.php
   │  │  │  │  ├─ Turkish_Turkey.php
   │  │  │  │  ├─ Turkmen_Turkmenistan.php
   │  │  │  │  ├─ Ukrainian_Ukraine.php
   │  │  │  │  ├─ Upper_Sorbian_Germany.php
   │  │  │  │  ├─ Urdu_Islamic_Republic_of_Pakistan.php
   │  │  │  │  ├─ Uzbek_(Cyrillic)_Uzbekistan.php
   │  │  │  │  ├─ Uzbek_(Latin)_Uzbekistan.php
   │  │  │  │  ├─ Vietnamese_Vietnam.php
   │  │  │  │  ├─ Welsh_United_Kingdom.php
   │  │  │  │  ├─ Wolof_Senegal.php
   │  │  │  │  ├─ Yakut_Russia.php
   │  │  │  │  └─ Yoruba_Nigeria.php
   │  │  │  ├─ entity_substitutions.php
   │  │  │  ├─ font
   │  │  │  │  ├─ ccourier.php
   │  │  │  │  ├─ ccourierb.php
   │  │  │  │  ├─ ccourierbi.php
   │  │  │  │  ├─ ccourieri.php
   │  │  │  │  ├─ chelvetica.php
   │  │  │  │  ├─ chelveticab.php
   │  │  │  │  ├─ chelveticabi.php
   │  │  │  │  ├─ chelveticai.php
   │  │  │  │  ├─ csymbol.php
   │  │  │  │  ├─ ctimes.php
   │  │  │  │  ├─ ctimesb.php
   │  │  │  │  ├─ ctimesbi.php
   │  │  │  │  ├─ ctimesi.php
   │  │  │  │  └─ czapfdingbats.php
   │  │  │  ├─ iccprofiles
   │  │  │  │  └─ sRGB_IEC61966-2-1.icc
   │  │  │  ├─ lang2fonts.css
   │  │  │  ├─ linebrdictK.dat
   │  │  │  ├─ linebrdictL.dat
   │  │  │  ├─ linebrdictT.dat
   │  │  │  ├─ mpdf.css
   │  │  │  ├─ no_image.jpg
   │  │  │  ├─ out.php
   │  │  │  ├─ patterns
   │  │  │  │  ├─ de.php
   │  │  │  │  ├─ dictionary.txt
   │  │  │  │  ├─ en.php
   │  │  │  │  ├─ es.php
   │  │  │  │  ├─ fi.php
   │  │  │  │  ├─ fr.php
   │  │  │  │  ├─ it.php
   │  │  │  │  ├─ nl.php
   │  │  │  │  ├─ NOTES.txt
   │  │  │  │  ├─ pl.php
   │  │  │  │  ├─ ru.php
   │  │  │  │  └─ sv.php
   │  │  │  ├─ subs_core.php
   │  │  │  ├─ subs_win-1252.php
   │  │  │  └─ upperCase.php
   │  │  ├─ LICENSE.txt
   │  │  ├─ phpstan-baseline.neon
   │  │  ├─ phpstan.neon
   │  │  ├─ phpunit.xml
   │  │  ├─ README.md
   │  │  ├─ ruleset.xml
   │  │  ├─ src
   │  │  │  ├─ AssetFetcher.php
   │  │  │  ├─ Barcode
   │  │  │  │  ├─ AbstractBarcode.php
   │  │  │  │  ├─ BarcodeException.php
   │  │  │  │  ├─ BarcodeInterface.php
   │  │  │  │  ├─ Codabar.php
   │  │  │  │  ├─ Code11.php
   │  │  │  │  ├─ Code128.php
   │  │  │  │  ├─ Code39.php
   │  │  │  │  ├─ Code93.php
   │  │  │  │  ├─ EanExt.php
   │  │  │  │  ├─ EanUpc.php
   │  │  │  │  ├─ I25.php
   │  │  │  │  ├─ Imb.php
   │  │  │  │  ├─ Msi.php
   │  │  │  │  ├─ Postnet.php
   │  │  │  │  ├─ Rm4Scc.php
   │  │  │  │  └─ S25.php
   │  │  │  ├─ Barcode.php
   │  │  │  ├─ Cache.php
   │  │  │  ├─ Color
   │  │  │  │  ├─ ColorConverter.php
   │  │  │  │  ├─ ColorModeConverter.php
   │  │  │  │  ├─ ColorSpaceRestrictor.php
   │  │  │  │  └─ NamedColors.php
   │  │  │  ├─ Config
   │  │  │  │  ├─ ConfigVariables.php
   │  │  │  │  └─ FontVariables.php
   │  │  │  ├─ Container
   │  │  │  │  ├─ ContainerInterface.php
   │  │  │  │  ├─ NotFoundException.php
   │  │  │  │  └─ SimpleContainer.php
   │  │  │  ├─ Conversion
   │  │  │  │  ├─ DecToAlpha.php
   │  │  │  │  ├─ DecToCjk.php
   │  │  │  │  ├─ DecToHebrew.php
   │  │  │  │  ├─ DecToOther.php
   │  │  │  │  └─ DecToRoman.php
   │  │  │  ├─ Css
   │  │  │  │  ├─ Border.php
   │  │  │  │  ├─ DefaultCss.php
   │  │  │  │  └─ TextVars.php
   │  │  │  ├─ CssManager.php
   │  │  │  ├─ DirectWrite.php
   │  │  │  ├─ Exception
   │  │  │  │  ├─ AssetFetchingException.php
   │  │  │  │  ├─ FontException.php
   │  │  │  │  └─ InvalidArgumentException.php
   │  │  │  ├─ File
   │  │  │  │  ├─ LocalContentLoader.php
   │  │  │  │  ├─ LocalContentLoaderInterface.php
   │  │  │  │  └─ StreamWrapperChecker.php
   │  │  │  ├─ Fonts
   │  │  │  │  ├─ FontCache.php
   │  │  │  │  ├─ FontFileFinder.php
   │  │  │  │  ├─ GlyphOperator.php
   │  │  │  │  └─ MetricsGenerator.php
   │  │  │  ├─ Form.php
   │  │  │  ├─ FpdiTrait.php
   │  │  │  ├─ functions-dev.php
   │  │  │  ├─ functions.php
   │  │  │  ├─ Gif
   │  │  │  │  ├─ ColorTable.php
   │  │  │  │  ├─ FileHeader.php
   │  │  │  │  ├─ Gif.php
   │  │  │  │  ├─ Image.php
   │  │  │  │  ├─ ImageHeader.php
   │  │  │  │  └─ Lzw.php
   │  │  │  ├─ Gradient.php
   │  │  │  ├─ HTMLParserMode.php
   │  │  │  ├─ Http
   │  │  │  │  ├─ ClientInterface.php
   │  │  │  │  ├─ CurlHttpClient.php
   │  │  │  │  ├─ Exception
   │  │  │  │  │  ├─ ClientException.php
   │  │  │  │  │  ├─ ForbiddenRequestException.php
   │  │  │  │  │  ├─ NetworkException.php
   │  │  │  │  │  └─ RequestException.php
   │  │  │  │  └─ SocketHttpClient.php
   │  │  │  ├─ Hyphenator.php
   │  │  │  ├─ Image
   │  │  │  │  ├─ Bmp.php
   │  │  │  │  ├─ ImageProcessor.php
   │  │  │  │  ├─ ImageTypeGuesser.php
   │  │  │  │  ├─ Svg.php
   │  │  │  │  └─ Wmf.php
   │  │  │  ├─ Language
   │  │  │  │  ├─ LanguageToFont.php
   │  │  │  │  ├─ LanguageToFontInterface.php
   │  │  │  │  ├─ ScriptToLanguage.php
   │  │  │  │  └─ ScriptToLanguageInterface.php
   │  │  │  ├─ Log
   │  │  │  │  └─ Context.php
   │  │  │  ├─ Mpdf.php
   │  │  │  ├─ MpdfException.php
   │  │  │  ├─ MpdfImageException.php
   │  │  │  ├─ Otl.php
   │  │  │  ├─ OtlDump.php
   │  │  │  ├─ Output
   │  │  │  │  └─ Destination.php
   │  │  │  ├─ PageBox.php
   │  │  │  ├─ PageFormat.php
   │  │  │  ├─ Pdf
   │  │  │  │  ├─ Protection
   │  │  │  │  │  └─ UniqidGenerator.php
   │  │  │  │  └─ Protection.php
   │  │  │  ├─ ServiceFactory.php
   │  │  │  ├─ Shaper
   │  │  │  │  ├─ Indic.php
   │  │  │  │  ├─ Myanmar.php
   │  │  │  │  └─ Sea.php
   │  │  │  ├─ SizeConverter.php
   │  │  │  ├─ Strict.php
   │  │  │  ├─ TableOfContents.php
   │  │  │  ├─ Tag
   │  │  │  │  ├─ A.php
   │  │  │  │  ├─ Acronym.php
   │  │  │  │  ├─ Address.php
   │  │  │  │  ├─ Annotation.php
   │  │  │  │  ├─ Article.php
   │  │  │  │  ├─ Aside.php
   │  │  │  │  ├─ B.php
   │  │  │  │  ├─ BarCode.php
   │  │  │  │  ├─ Bdi.php
   │  │  │  │  ├─ Bdo.php
   │  │  │  │  ├─ Big.php
   │  │  │  │  ├─ BlockQuote.php
   │  │  │  │  ├─ BlockTag.php
   │  │  │  │  ├─ Bookmark.php
   │  │  │  │  ├─ Br.php
   │  │  │  │  ├─ Caption.php
   │  │  │  │  ├─ Center.php
   │  │  │  │  ├─ Cite.php
   │  │  │  │  ├─ Code.php
   │  │  │  │  ├─ ColumnBreak.php
   │  │  │  │  ├─ Columns.php
   │  │  │  │  ├─ Dd.php
   │  │  │  │  ├─ Del.php
   │  │  │  │  ├─ Details.php
   │  │  │  │  ├─ Div.php
   │  │  │  │  ├─ Dl.php
   │  │  │  │  ├─ DotTab.php
   │  │  │  │  ├─ Dt.php
   │  │  │  │  ├─ Em.php
   │  │  │  │  ├─ FieldSet.php
   │  │  │  │  ├─ FigCaption.php
   │  │  │  │  ├─ Figure.php
   │  │  │  │  ├─ Font.php
   │  │  │  │  ├─ Footer.php
   │  │  │  │  ├─ Form.php
   │  │  │  │  ├─ FormFeed.php
   │  │  │  │  ├─ H1.php
   │  │  │  │  ├─ H2.php
   │  │  │  │  ├─ H3.php
   │  │  │  │  ├─ H4.php
   │  │  │  │  ├─ H5.php
   │  │  │  │  ├─ H6.php
   │  │  │  │  ├─ Header.php
   │  │  │  │  ├─ HGroup.php
   │  │  │  │  ├─ Hr.php
   │  │  │  │  ├─ I.php
   │  │  │  │  ├─ Img.php
   │  │  │  │  ├─ IndexEntry.php
   │  │  │  │  ├─ IndexInsert.php
   │  │  │  │  ├─ InlineTag.php
   │  │  │  │  ├─ Input.php
   │  │  │  │  ├─ Ins.php
   │  │  │  │  ├─ Kbd.php
   │  │  │  │  ├─ Legend.php
   │  │  │  │  ├─ Li.php
   │  │  │  │  ├─ Main.php
   │  │  │  │  ├─ Mark.php
   │  │  │  │  ├─ Meter.php
   │  │  │  │  ├─ Nav.php
   │  │  │  │  ├─ NewColumn.php
   │  │  │  │  ├─ NewPage.php
   │  │  │  │  ├─ Ol.php
   │  │  │  │  ├─ Option.php
   │  │  │  │  ├─ P.php
   │  │  │  │  ├─ PageBreak.php
   │  │  │  │  ├─ PageFooter.php
   │  │  │  │  ├─ PageHeader.php
   │  │  │  │  ├─ Pre.php
   │  │  │  │  ├─ Progress.php
   │  │  │  │  ├─ Q.php
   │  │  │  │  ├─ S.php
   │  │  │  │  ├─ Samp.php
   │  │  │  │  ├─ Section.php
   │  │  │  │  ├─ Select.php
   │  │  │  │  ├─ SetHtmlPageFooter.php
   │  │  │  │  ├─ SetHtmlPageHeader.php
   │  │  │  │  ├─ SetPageFooter.php
   │  │  │  │  ├─ SetPageHeader.php
   │  │  │  │  ├─ Small.php
   │  │  │  │  ├─ Span.php
   │  │  │  │  ├─ Strike.php
   │  │  │  │  ├─ Strong.php
   │  │  │  │  ├─ Sub.php
   │  │  │  │  ├─ SubstituteTag.php
   │  │  │  │  ├─ Summary.php
   │  │  │  │  ├─ Sup.php
   │  │  │  │  ├─ Table.php
   │  │  │  │  ├─ Tag.php
   │  │  │  │  ├─ TBody.php
   │  │  │  │  ├─ Td.php
   │  │  │  │  ├─ TextArea.php
   │  │  │  │  ├─ TextCircle.php
   │  │  │  │  ├─ TFoot.php
   │  │  │  │  ├─ Th.php
   │  │  │  │  ├─ THead.php
   │  │  │  │  ├─ Time.php
   │  │  │  │  ├─ Toc.php
   │  │  │  │  ├─ TocEntry.php
   │  │  │  │  ├─ TocPageBreak.php
   │  │  │  │  ├─ Tr.php
   │  │  │  │  ├─ Tt.php
   │  │  │  │  ├─ Tta.php
   │  │  │  │  ├─ Tts.php
   │  │  │  │  ├─ Ttz.php
   │  │  │  │  ├─ U.php
   │  │  │  │  ├─ Ul.php
   │  │  │  │  ├─ VarTag.php
   │  │  │  │  ├─ WatermarkImage.php
   │  │  │  │  └─ WatermarkText.php
   │  │  │  ├─ Tag.php
   │  │  │  ├─ TTFontFile.php
   │  │  │  ├─ TTFontFileAnalysis.php
   │  │  │  ├─ Ucdn.php
   │  │  │  ├─ Utils
   │  │  │  │  ├─ Arrays.php
   │  │  │  │  ├─ NumericString.php
   │  │  │  │  ├─ PdfDate.php
   │  │  │  │  └─ UtfString.php
   │  │  │  ├─ Watermark.php
   │  │  │  ├─ WatermarkImage.php
   │  │  │  ├─ WatermarkText.php
   │  │  │  └─ Writer
   │  │  │     ├─ BackgroundWriter.php
   │  │  │     ├─ BaseWriter.php
   │  │  │     ├─ BookmarkWriter.php
   │  │  │     ├─ ColorWriter.php
   │  │  │     ├─ FontWriter.php
   │  │  │     ├─ FormWriter.php
   │  │  │     ├─ ImageWriter.php
   │  │  │     ├─ JavaScriptWriter.php
   │  │  │     ├─ MetadataWriter.php
   │  │  │     ├─ ObjectWriter.php
   │  │  │     ├─ OptionalContentWriter.php
   │  │  │     ├─ PageWriter.php
   │  │  │     └─ ResourceWriter.php
   │  │  ├─ tmp
   │  │  └─ ttfonts
   │  │     ├─ AboriginalSansREGULAR.ttf
   │  │     ├─ Abyssinica_SIL.ttf
   │  │     ├─ Aegean.otf
   │  │     ├─ Aegyptus.otf
   │  │     ├─ Akkadian.otf
   │  │     ├─ ayar.ttf
   │  │     ├─ damase_v.2.ttf
   │  │     ├─ DBSILBR.ttf
   │  │     ├─ DejaVuinfo.txt
   │  │     ├─ DejaVuSans-Bold.ttf
   │  │     ├─ DejaVuSans-BoldOblique.ttf
   │  │     ├─ DejaVuSans-Oblique.ttf
   │  │     ├─ DejaVuSans.ttf
   │  │     ├─ DejaVuSansCondensed-Bold.ttf
   │  │     ├─ DejaVuSansCondensed-BoldOblique.ttf
   │  │     ├─ DejaVuSansCondensed-Oblique.ttf
   │  │     ├─ DejaVuSansCondensed.ttf
   │  │     ├─ DejaVuSansMono-Bold.ttf
   │  │     ├─ DejaVuSansMono-BoldOblique.ttf
   │  │     ├─ DejaVuSansMono-Oblique.ttf
   │  │     ├─ DejaVuSansMono.ttf
   │  │     ├─ DejaVuSerif-Bold.ttf
   │  │     ├─ DejaVuSerif-BoldItalic.ttf
   │  │     ├─ DejaVuSerif-Italic.ttf
   │  │     ├─ DejaVuSerif.ttf
   │  │     ├─ DejaVuSerifCondensed-Bold.ttf
   │  │     ├─ DejaVuSerifCondensed-BoldItalic.ttf
   │  │     ├─ DejaVuSerifCondensed-Italic.ttf
   │  │     ├─ DejaVuSerifCondensed.ttf
   │  │     ├─ Dhyana-Bold.ttf
   │  │     ├─ Dhyana-Regular.ttf
   │  │     ├─ DhyanaOFL.txt
   │  │     ├─ Eeyek-Regular.ttf
   │  │     ├─ FreeMono.ttf
   │  │     ├─ FreeMonoBold.ttf
   │  │     ├─ FreeMonoBoldOblique.ttf
   │  │     ├─ FreeMonoOblique.ttf
   │  │     ├─ FreeSans.ttf
   │  │     ├─ FreeSansBold.ttf
   │  │     ├─ FreeSansBoldOblique.ttf
   │  │     ├─ FreeSansOblique.ttf
   │  │     ├─ FreeSerif.ttf
   │  │     ├─ FreeSerifBold.ttf
   │  │     ├─ FreeSerifBoldItalic.ttf
   │  │     ├─ FreeSerifItalic.ttf
   │  │     ├─ Garuda-Bold.ttf
   │  │     ├─ Garuda-BoldOblique.ttf
   │  │     ├─ Garuda-Oblique.ttf
   │  │     ├─ Garuda.ttf
   │  │     ├─ GNUFreeFontinfo.txt
   │  │     ├─ Jomolhari-OFL.txt
   │  │     ├─ Jomolhari.ttf
   │  │     ├─ kaputaunicode.ttf
   │  │     ├─ KhmerOFL.txt
   │  │     ├─ KhmerOS.ttf
   │  │     ├─ lannaalif-v1-03.ttf
   │  │     ├─ Lateef font OFL.txt
   │  │     ├─ LateefRegOT.ttf
   │  │     ├─ Lohit-Kannada.ttf
   │  │     ├─ LohitKannadaOFL.txt
   │  │     ├─ ocrb10.ttf
   │  │     ├─ ocrbinfo.txt
   │  │     ├─ Padauk-book.ttf
   │  │     ├─ Pothana2000.ttf
   │  │     ├─ Quivira.otf
   │  │     ├─ Sun-ExtA.ttf
   │  │     ├─ Sun-ExtB.ttf
   │  │     ├─ SundaneseUnicode-1.0.5.ttf
   │  │     ├─ SyrCOMEdessa.otf
   │  │     ├─ SyrCOMEdessa_license.txt
   │  │     ├─ TaameyDavidCLM-LICENSE.txt
   │  │     ├─ TaameyDavidCLM-Medium.ttf
   │  │     ├─ TaiHeritagePro.ttf
   │  │     ├─ Tharlon-Regular.ttf
   │  │     ├─ TharlonOFL.txt
   │  │     ├─ UnBatang_0613.ttf
   │  │     ├─ Uthman.otf
   │  │     ├─ XB Riyaz.ttf
   │  │     ├─ XB RiyazBd.ttf
   │  │     ├─ XB RiyazBdIt.ttf
   │  │     ├─ XB RiyazIt.ttf
   │  │     ├─ XW Zar Font Info.txt
   │  │     └─ ZawgyiOne.ttf
   │  ├─ psr-http-message-shim
   │  │  ├─ composer.json
   │  │  ├─ README.md
   │  │  └─ src
   │  │     ├─ Request.php
   │  │     ├─ Response.php
   │  │     ├─ Stream.php
   │  │     └─ Uri.php
   │  └─ psr-log-aware-trait
   │     ├─ composer.json
   │     ├─ README.md
   │     └─ src
   │        ├─ MpdfPsrLogAwareTrait.php
   │        └─ PsrLogAwareTrait.php
   ├─ myclabs
   │  └─ deep-copy
   │     ├─ composer.json
   │     ├─ LICENSE
   │     ├─ README.md
   │     └─ src
   │        └─ DeepCopy
   │           ├─ DeepCopy.php
   │           ├─ deep_copy.php
   │           ├─ Exception
   │           │  ├─ CloneException.php
   │           │  └─ PropertyException.php
   │           ├─ Filter
   │           │  ├─ ChainableFilter.php
   │           │  ├─ Doctrine
   │           │  │  ├─ DoctrineCollectionFilter.php
   │           │  │  ├─ DoctrineEmptyCollectionFilter.php
   │           │  │  └─ DoctrineProxyFilter.php
   │           │  ├─ Filter.php
   │           │  ├─ KeepFilter.php
   │           │  ├─ ReplaceFilter.php
   │           │  └─ SetNullFilter.php
   │           ├─ Matcher
   │           │  ├─ Doctrine
   │           │  │  └─ DoctrineProxyMatcher.php
   │           │  ├─ Matcher.php
   │           │  ├─ PropertyMatcher.php
   │           │  ├─ PropertyNameMatcher.php
   │           │  └─ PropertyTypeMatcher.php
   │           ├─ Reflection
   │           │  └─ ReflectionHelper.php
   │           ├─ TypeFilter
   │           │  ├─ Date
   │           │  │  ├─ DateIntervalFilter.php
   │           │  │  └─ DatePeriodFilter.php
   │           │  ├─ ReplaceFilter.php
   │           │  ├─ ShallowCopyFilter.php
   │           │  ├─ Spl
   │           │  │  ├─ ArrayObjectFilter.php
   │           │  │  ├─ SplDoublyLinkedList.php
   │           │  │  └─ SplDoublyLinkedListFilter.php
   │           │  └─ TypeFilter.php
   │           └─ TypeMatcher
   │              └─ TypeMatcher.php
   ├─ paragonie
   │  └─ random_compat
   │     ├─ build-phar.sh
   │     ├─ composer.json
   │     ├─ dist
   │     │  ├─ random_compat.phar.pubkey
   │     │  └─ random_compat.phar.pubkey.asc
   │     ├─ lib
   │     │  └─ random.php
   │     ├─ LICENSE
   │     ├─ other
   │     │  └─ build_phar.php
   │     ├─ psalm-autoload.php
   │     └─ psalm.xml
   ├─ phpmailer
   │  └─ phpmailer
   │     ├─ COMMITMENT
   │     ├─ composer.json
   │     ├─ get_oauth_token.php
   │     ├─ language
   │     │  ├─ phpmailer.lang-af.php
   │     │  ├─ phpmailer.lang-ar.php
   │     │  ├─ phpmailer.lang-as.php
   │     │  ├─ phpmailer.lang-az.php
   │     │  ├─ phpmailer.lang-ba.php
   │     │  ├─ phpmailer.lang-be.php
   │     │  ├─ phpmailer.lang-bg.php
   │     │  ├─ phpmailer.lang-bn.php
   │     │  ├─ phpmailer.lang-ca.php
   │     │  ├─ phpmailer.lang-cs.php
   │     │  ├─ phpmailer.lang-da.php
   │     │  ├─ phpmailer.lang-de.php
   │     │  ├─ phpmailer.lang-el.php
   │     │  ├─ phpmailer.lang-eo.php
   │     │  ├─ phpmailer.lang-es.php
   │     │  ├─ phpmailer.lang-et.php
   │     │  ├─ phpmailer.lang-fa.php
   │     │  ├─ phpmailer.lang-fi.php
   │     │  ├─ phpmailer.lang-fo.php
   │     │  ├─ phpmailer.lang-fr.php
   │     │  ├─ phpmailer.lang-gl.php
   │     │  ├─ phpmailer.lang-he.php
   │     │  ├─ phpmailer.lang-hi.php
   │     │  ├─ phpmailer.lang-hr.php
   │     │  ├─ phpmailer.lang-hu.php
   │     │  ├─ phpmailer.lang-hy.php
   │     │  ├─ phpmailer.lang-id.php
   │     │  ├─ phpmailer.lang-it.php
   │     │  ├─ phpmailer.lang-ja.php
   │     │  ├─ phpmailer.lang-ka.php
   │     │  ├─ phpmailer.lang-ko.php
   │     │  ├─ phpmailer.lang-ku.php
   │     │  ├─ phpmailer.lang-lt.php
   │     │  ├─ phpmailer.lang-lv.php
   │     │  ├─ phpmailer.lang-mg.php
   │     │  ├─ phpmailer.lang-mn.php
   │     │  ├─ phpmailer.lang-ms.php
   │     │  ├─ phpmailer.lang-nb.php
   │     │  ├─ phpmailer.lang-nl.php
   │     │  ├─ phpmailer.lang-pl.php
   │     │  ├─ phpmailer.lang-pt.php
   │     │  ├─ phpmailer.lang-pt_br.php
   │     │  ├─ phpmailer.lang-ro.php
   │     │  ├─ phpmailer.lang-ru.php
   │     │  ├─ phpmailer.lang-si.php
   │     │  ├─ phpmailer.lang-sk.php
   │     │  ├─ phpmailer.lang-sl.php
   │     │  ├─ phpmailer.lang-sr.php
   │     │  ├─ phpmailer.lang-sr_latn.php
   │     │  ├─ phpmailer.lang-sv.php
   │     │  ├─ phpmailer.lang-tl.php
   │     │  ├─ phpmailer.lang-tr.php
   │     │  ├─ phpmailer.lang-uk.php
   │     │  ├─ phpmailer.lang-ur.php
   │     │  ├─ phpmailer.lang-vi.php
   │     │  ├─ phpmailer.lang-zh.php
   │     │  └─ phpmailer.lang-zh_cn.php
   │     ├─ LICENSE
   │     ├─ README.md
   │     ├─ SECURITY.md
   │     ├─ SMTPUTF8.md
   │     ├─ src
   │     │  ├─ DSNConfigurator.php
   │     │  ├─ Exception.php
   │     │  ├─ OAuth.php
   │     │  ├─ OAuthTokenProvider.php
   │     │  ├─ PHPMailer.php
   │     │  ├─ POP3.php
   │     │  └─ SMTP.php
   │     └─ VERSION
   ├─ phpoffice
   │  └─ phpspreadsheet
   │     ├─ CHANGELOG.md
   │     ├─ composer.json
   │     ├─ CONTRIBUTING.md
   │     ├─ LICENSE
   │     ├─ README.md
   │     └─ src
   │        └─ PhpSpreadsheet
   │           ├─ Calculation
   │           │  ├─ ArrayEnabled.php
   │           │  ├─ BinaryComparison.php
   │           │  ├─ Calculation.php
   │           │  ├─ CalculationBase.php
   │           │  ├─ CalculationLocale.php
   │           │  ├─ Category.php
   │           │  ├─ Database
   │           │  │  ├─ DatabaseAbstract.php
   │           │  │  ├─ DAverage.php
   │           │  │  ├─ DCount.php
   │           │  │  ├─ DCountA.php
   │           │  │  ├─ DGet.php
   │           │  │  ├─ DMax.php
   │           │  │  ├─ DMin.php
   │           │  │  ├─ DProduct.php
   │           │  │  ├─ DStDev.php
   │           │  │  ├─ DStDevP.php
   │           │  │  ├─ DSum.php
   │           │  │  ├─ DVar.php
   │           │  │  └─ DVarP.php
   │           │  ├─ DateTimeExcel
   │           │  │  ├─ Constants.php
   │           │  │  ├─ Current.php
   │           │  │  ├─ Date.php
   │           │  │  ├─ DateParts.php
   │           │  │  ├─ DateValue.php
   │           │  │  ├─ Days.php
   │           │  │  ├─ Days360.php
   │           │  │  ├─ Difference.php
   │           │  │  ├─ Helpers.php
   │           │  │  ├─ Month.php
   │           │  │  ├─ NetworkDays.php
   │           │  │  ├─ Time.php
   │           │  │  ├─ TimeParts.php
   │           │  │  ├─ TimeValue.php
   │           │  │  ├─ Week.php
   │           │  │  ├─ WorkDay.php
   │           │  │  └─ YearFrac.php
   │           │  ├─ Engine
   │           │  │  ├─ ArrayArgumentHelper.php
   │           │  │  ├─ ArrayArgumentProcessor.php
   │           │  │  ├─ BranchPruner.php
   │           │  │  ├─ CyclicReferenceStack.php
   │           │  │  ├─ FormattedNumber.php
   │           │  │  ├─ Logger.php
   │           │  │  └─ Operands
   │           │  │     ├─ Operand.php
   │           │  │     └─ StructuredReference.php
   │           │  ├─ Engineering
   │           │  │  ├─ BesselI.php
   │           │  │  ├─ BesselJ.php
   │           │  │  ├─ BesselK.php
   │           │  │  ├─ BesselY.php
   │           │  │  ├─ BitWise.php
   │           │  │  ├─ Compare.php
   │           │  │  ├─ Complex.php
   │           │  │  ├─ ComplexFunctions.php
   │           │  │  ├─ ComplexOperations.php
   │           │  │  ├─ Constants.php
   │           │  │  ├─ ConvertBase.php
   │           │  │  ├─ ConvertBinary.php
   │           │  │  ├─ ConvertDecimal.php
   │           │  │  ├─ ConvertHex.php
   │           │  │  ├─ ConvertOctal.php
   │           │  │  ├─ ConvertUOM.php
   │           │  │  ├─ EngineeringValidations.php
   │           │  │  ├─ Erf.php
   │           │  │  └─ ErfC.php
   │           │  ├─ Exception.php
   │           │  ├─ ExceptionHandler.php
   │           │  ├─ Financial
   │           │  │  ├─ Amortization.php
   │           │  │  ├─ CashFlow
   │           │  │  │  ├─ CashFlowValidations.php
   │           │  │  │  ├─ Constant
   │           │  │  │  │  ├─ Periodic
   │           │  │  │  │  │  ├─ Cumulative.php
   │           │  │  │  │  │  ├─ Interest.php
   │           │  │  │  │  │  ├─ InterestAndPrincipal.php
   │           │  │  │  │  │  └─ Payments.php
   │           │  │  │  │  └─ Periodic.php
   │           │  │  │  ├─ Single.php
   │           │  │  │  └─ Variable
   │           │  │  │     ├─ NonPeriodic.php
   │           │  │  │     └─ Periodic.php
   │           │  │  ├─ Constants.php
   │           │  │  ├─ Coupons.php
   │           │  │  ├─ Depreciation.php
   │           │  │  ├─ Dollar.php
   │           │  │  ├─ FinancialValidations.php
   │           │  │  ├─ Helpers.php
   │           │  │  ├─ InterestRate.php
   │           │  │  ├─ Securities
   │           │  │  │  ├─ AccruedInterest.php
   │           │  │  │  ├─ Price.php
   │           │  │  │  ├─ Rates.php
   │           │  │  │  ├─ SecurityValidations.php
   │           │  │  │  └─ Yields.php
   │           │  │  └─ TreasuryBill.php
   │           │  ├─ FormulaParser.php
   │           │  ├─ FormulaToken.php
   │           │  ├─ FunctionArray.php
   │           │  ├─ Functions.php
   │           │  ├─ Information
   │           │  │  ├─ ErrorValue.php
   │           │  │  ├─ ExcelError.php
   │           │  │  └─ Value.php
   │           │  ├─ Internal
   │           │  │  ├─ ExcelArrayPseudoFunctions.php
   │           │  │  ├─ MakeMatrix.php
   │           │  │  └─ WildcardMatch.php
   │           │  ├─ locale
   │           │  │  ├─ bg
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ cs
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ da
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ de
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ en
   │           │  │  │  └─ uk
   │           │  │  │     └─ config
   │           │  │  ├─ es
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ fi
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ fr
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ hu
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ it
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ nb
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ nl
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ pl
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ pt
   │           │  │  │  ├─ br
   │           │  │  │  │  ├─ config
   │           │  │  │  │  └─ functions
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ ru
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ sv
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ tr
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  └─ Translations.xlsx
   │           │  ├─ Logical
   │           │  │  ├─ Boolean.php
   │           │  │  ├─ Conditional.php
   │           │  │  └─ Operations.php
   │           │  ├─ LookupRef
   │           │  │  ├─ Address.php
   │           │  │  ├─ ChooseRowsEtc.php
   │           │  │  ├─ ExcelMatch.php
   │           │  │  ├─ Filter.php
   │           │  │  ├─ Formula.php
   │           │  │  ├─ Helpers.php
   │           │  │  ├─ HLookup.php
   │           │  │  ├─ Hyperlink.php
   │           │  │  ├─ Indirect.php
   │           │  │  ├─ Lookup.php
   │           │  │  ├─ LookupBase.php
   │           │  │  ├─ LookupRefValidations.php
   │           │  │  ├─ Matrix.php
   │           │  │  ├─ Offset.php
   │           │  │  ├─ RowColumnInformation.php
   │           │  │  ├─ Selection.php
   │           │  │  ├─ Sort.php
   │           │  │  ├─ Unique.php
   │           │  │  └─ VLookup.php
   │           │  ├─ MathTrig
   │           │  │  ├─ Absolute.php
   │           │  │  ├─ Angle.php
   │           │  │  ├─ Arabic.php
   │           │  │  ├─ Base.php
   │           │  │  ├─ Ceiling.php
   │           │  │  ├─ Combinations.php
   │           │  │  ├─ Exp.php
   │           │  │  ├─ Factorial.php
   │           │  │  ├─ Floor.php
   │           │  │  ├─ Gcd.php
   │           │  │  ├─ Helpers.php
   │           │  │  ├─ IntClass.php
   │           │  │  ├─ Lcm.php
   │           │  │  ├─ Logarithms.php
   │           │  │  ├─ MatrixFunctions.php
   │           │  │  ├─ Operations.php
   │           │  │  ├─ Random.php
   │           │  │  ├─ Roman.php
   │           │  │  ├─ Round.php
   │           │  │  ├─ SeriesSum.php
   │           │  │  ├─ Sign.php
   │           │  │  ├─ Sqrt.php
   │           │  │  ├─ Subtotal.php
   │           │  │  ├─ Sum.php
   │           │  │  ├─ SumSquares.php
   │           │  │  ├─ Trig
   │           │  │  │  ├─ Cosecant.php
   │           │  │  │  ├─ Cosine.php
   │           │  │  │  ├─ Cotangent.php
   │           │  │  │  ├─ Secant.php
   │           │  │  │  ├─ Sine.php
   │           │  │  │  └─ Tangent.php
   │           │  │  └─ Trunc.php
   │           │  ├─ Statistical
   │           │  │  ├─ AggregateBase.php
   │           │  │  ├─ Averages
   │           │  │  │  └─ Mean.php
   │           │  │  ├─ Averages.php
   │           │  │  ├─ Conditional.php
   │           │  │  ├─ Confidence.php
   │           │  │  ├─ Counts.php
   │           │  │  ├─ Deviations.php
   │           │  │  ├─ Distributions
   │           │  │  │  ├─ Beta.php
   │           │  │  │  ├─ Binomial.php
   │           │  │  │  ├─ ChiSquared.php
   │           │  │  │  ├─ DistributionValidations.php
   │           │  │  │  ├─ Exponential.php
   │           │  │  │  ├─ F.php
   │           │  │  │  ├─ Fisher.php
   │           │  │  │  ├─ Gamma.php
   │           │  │  │  ├─ GammaBase.php
   │           │  │  │  ├─ HyperGeometric.php
   │           │  │  │  ├─ LogNormal.php
   │           │  │  │  ├─ NewtonRaphson.php
   │           │  │  │  ├─ Normal.php
   │           │  │  │  ├─ Poisson.php
   │           │  │  │  ├─ StandardNormal.php
   │           │  │  │  ├─ StudentT.php
   │           │  │  │  └─ Weibull.php
   │           │  │  ├─ Maximum.php
   │           │  │  ├─ MaxMinBase.php
   │           │  │  ├─ Minimum.php
   │           │  │  ├─ Percentiles.php
   │           │  │  ├─ Permutations.php
   │           │  │  ├─ Size.php
   │           │  │  ├─ StandardDeviations.php
   │           │  │  ├─ Standardize.php
   │           │  │  ├─ StatisticalValidations.php
   │           │  │  ├─ Trends.php
   │           │  │  ├─ VarianceBase.php
   │           │  │  └─ Variances.php
   │           │  ├─ TextData
   │           │  │  ├─ CaseConvert.php
   │           │  │  ├─ CharacterConvert.php
   │           │  │  ├─ Concatenate.php
   │           │  │  ├─ Extract.php
   │           │  │  ├─ Format.php
   │           │  │  ├─ Helpers.php
   │           │  │  ├─ Replace.php
   │           │  │  ├─ Search.php
   │           │  │  ├─ Text.php
   │           │  │  └─ Trim.php
   │           │  ├─ Token
   │           │  │  └─ Stack.php
   │           │  └─ Web
   │           │     └─ Service.php
   │           ├─ Cell
   │           │  ├─ AddressHelper.php
   │           │  ├─ AddressRange.php
   │           │  ├─ AdvancedValueBinder.php
   │           │  ├─ Cell.php
   │           │  ├─ CellAddress.php
   │           │  ├─ CellRange.php
   │           │  ├─ ColumnRange.php
   │           │  ├─ Coordinate.php
   │           │  ├─ DataType.php
   │           │  ├─ DataValidation.php
   │           │  ├─ DataValidator.php
   │           │  ├─ DefaultValueBinder.php
   │           │  ├─ Hyperlink.php
   │           │  ├─ IgnoredErrors.php
   │           │  ├─ IValueBinder.php
   │           │  ├─ RowRange.php
   │           │  └─ StringValueBinder.php
   │           ├─ CellReferenceHelper.php
   │           ├─ Chart
   │           │  ├─ Axis.php
   │           │  ├─ AxisText.php
   │           │  ├─ Chart.php
   │           │  ├─ ChartColor.php
   │           │  ├─ DataSeries.php
   │           │  ├─ DataSeriesValues.php
   │           │  ├─ Exception.php
   │           │  ├─ GridLines.php
   │           │  ├─ Layout.php
   │           │  ├─ Legend.php
   │           │  ├─ PlotArea.php
   │           │  ├─ Properties.php
   │           │  ├─ Renderer
   │           │  │  ├─ IRenderer.php
   │           │  │  ├─ JpGraph.php
   │           │  │  ├─ JpGraphRendererBase.php
   │           │  │  ├─ MtJpGraphRenderer.php
   │           │  │  └─ PHP Charting Libraries.txt
   │           │  ├─ Title.php
   │           │  └─ TrendLine.php
   │           ├─ Collection
   │           │  ├─ Cells.php
   │           │  ├─ CellsFactory.php
   │           │  └─ Memory
   │           │     ├─ SimpleCache1.php
   │           │     └─ SimpleCache3.php
   │           ├─ Comment.php
   │           ├─ DefinedName.php
   │           ├─ Document
   │           │  ├─ Properties.php
   │           │  └─ Security.php
   │           ├─ Exception.php
   │           ├─ HashTable.php
   │           ├─ Helper
   │           │  ├─ Dimension.php
   │           │  ├─ Downloader.php
   │           │  ├─ Handler.php
   │           │  ├─ Html.php
   │           │  ├─ Sample.php
   │           │  ├─ Size.php
   │           │  └─ TextGrid.php
   │           ├─ IComparable.php
   │           ├─ IOFactory.php
   │           ├─ NamedFormula.php
   │           ├─ NamedRange.php
   │           ├─ Reader
   │           │  ├─ BaseReader.php
   │           │  ├─ Csv
   │           │  │  └─ Delimiter.php
   │           │  ├─ Csv.php
   │           │  ├─ DefaultReadFilter.php
   │           │  ├─ Exception.php
   │           │  ├─ Gnumeric
   │           │  │  ├─ PageSetup.php
   │           │  │  ├─ Properties.php
   │           │  │  └─ Styles.php
   │           │  ├─ Gnumeric.php
   │           │  ├─ Html.php
   │           │  ├─ IReader.php
   │           │  ├─ IReadFilter.php
   │           │  ├─ Ods
   │           │  │  ├─ AutoFilter.php
   │           │  │  ├─ BaseLoader.php
   │           │  │  ├─ DefinedNames.php
   │           │  │  ├─ FormulaTranslator.php
   │           │  │  ├─ PageSettings.php
   │           │  │  └─ Properties.php
   │           │  ├─ Ods.php
   │           │  ├─ Security
   │           │  │  └─ XmlScanner.php
   │           │  ├─ Slk.php
   │           │  ├─ Xls
   │           │  │  ├─ Biff5.php
   │           │  │  ├─ Biff8.php
   │           │  │  ├─ Color
   │           │  │  │  ├─ BIFF5.php
   │           │  │  │  ├─ BIFF8.php
   │           │  │  │  └─ BuiltIn.php
   │           │  │  ├─ Color.php
   │           │  │  ├─ ConditionalFormatting.php
   │           │  │  ├─ DataValidationHelper.php
   │           │  │  ├─ ErrorCode.php
   │           │  │  ├─ Escher.php
   │           │  │  ├─ ListFunctions.php
   │           │  │  ├─ LoadSpreadsheet.php
   │           │  │  ├─ Mappings.php
   │           │  │  ├─ MD5.php
   │           │  │  ├─ RC4.php
   │           │  │  └─ Style
   │           │  │     ├─ Border.php
   │           │  │     ├─ CellAlignment.php
   │           │  │     ├─ CellFont.php
   │           │  │     └─ FillPattern.php
   │           │  ├─ Xls.php
   │           │  ├─ XlsBase.php
   │           │  ├─ Xlsx
   │           │  │  ├─ AutoFilter.php
   │           │  │  ├─ BaseParserClass.php
   │           │  │  ├─ Chart.php
   │           │  │  ├─ ColumnAndRowAttributes.php
   │           │  │  ├─ ConditionalStyles.php
   │           │  │  ├─ DataValidations.php
   │           │  │  ├─ Hyperlinks.php
   │           │  │  ├─ Namespaces.php
   │           │  │  ├─ PageSetup.php
   │           │  │  ├─ Properties.php
   │           │  │  ├─ SharedFormula.php
   │           │  │  ├─ SheetViewOptions.php
   │           │  │  ├─ SheetViews.php
   │           │  │  ├─ Styles.php
   │           │  │  ├─ TableReader.php
   │           │  │  ├─ Theme.php
   │           │  │  └─ WorkbookView.php
   │           │  ├─ Xlsx.php
   │           │  ├─ Xml
   │           │  │  ├─ DataValidations.php
   │           │  │  ├─ PageSettings.php
   │           │  │  ├─ Properties.php
   │           │  │  ├─ Style
   │           │  │  │  ├─ Alignment.php
   │           │  │  │  ├─ Border.php
   │           │  │  │  ├─ Fill.php
   │           │  │  │  ├─ Font.php
   │           │  │  │  ├─ NumberFormat.php
   │           │  │  │  └─ StyleBase.php
   │           │  │  └─ Style.php
   │           │  └─ Xml.php
   │           ├─ ReferenceHelper.php
   │           ├─ RichText
   │           │  ├─ ITextElement.php
   │           │  ├─ RichText.php
   │           │  ├─ Run.php
   │           │  └─ TextElement.php
   │           ├─ Settings.php
   │           ├─ Shared
   │           │  ├─ CodePage.php
   │           │  ├─ Date.php
   │           │  ├─ Drawing.php
   │           │  ├─ Escher
   │           │  │  ├─ DgContainer
   │           │  │  │  ├─ SpgrContainer
   │           │  │  │  │  └─ SpContainer.php
   │           │  │  │  └─ SpgrContainer.php
   │           │  │  ├─ DgContainer.php
   │           │  │  ├─ DggContainer
   │           │  │  │  ├─ BstoreContainer
   │           │  │  │  │  ├─ BSE
   │           │  │  │  │  │  └─ Blip.php
   │           │  │  │  │  └─ BSE.php
   │           │  │  │  └─ BstoreContainer.php
   │           │  │  └─ DggContainer.php
   │           │  ├─ Escher.php
   │           │  ├─ File.php
   │           │  ├─ Font.php
   │           │  ├─ IntOrFloat.php
   │           │  ├─ OLE
   │           │  │  ├─ ChainedBlockStream.php
   │           │  │  ├─ PPS
   │           │  │  │  ├─ File.php
   │           │  │  │  └─ Root.php
   │           │  │  └─ PPS.php
   │           │  ├─ OLE.php
   │           │  ├─ OLERead.php
   │           │  ├─ PasswordHasher.php
   │           │  ├─ StringHelper.php
   │           │  ├─ TimeZone.php
   │           │  ├─ Trend
   │           │  │  ├─ BestFit.php
   │           │  │  ├─ ExponentialBestFit.php
   │           │  │  ├─ LinearBestFit.php
   │           │  │  ├─ LogarithmicBestFit.php
   │           │  │  ├─ PolynomialBestFit.php
   │           │  │  ├─ PowerBestFit.php
   │           │  │  └─ Trend.php
   │           │  ├─ Xls.php
   │           │  └─ XMLWriter.php
   │           ├─ Spreadsheet.php
   │           ├─ Style
   │           │  ├─ Alignment.php
   │           │  ├─ Border.php
   │           │  ├─ Borders.php
   │           │  ├─ Color.php
   │           │  ├─ Conditional.php
   │           │  ├─ ConditionalFormatting
   │           │  │  ├─ CellMatcher.php
   │           │  │  ├─ CellStyleAssessor.php
   │           │  │  ├─ ConditionalColorScale.php
   │           │  │  ├─ ConditionalDataBar.php
   │           │  │  ├─ ConditionalDataBarExtension.php
   │           │  │  ├─ ConditionalFormattingRuleExtension.php
   │           │  │  ├─ ConditionalFormatValueObject.php
   │           │  │  ├─ StyleMerger.php
   │           │  │  ├─ Wizard
   │           │  │  │  ├─ Blanks.php
   │           │  │  │  ├─ CellValue.php
   │           │  │  │  ├─ DateValue.php
   │           │  │  │  ├─ Duplicates.php
   │           │  │  │  ├─ Errors.php
   │           │  │  │  ├─ Expression.php
   │           │  │  │  ├─ TextValue.php
   │           │  │  │  ├─ WizardAbstract.php
   │           │  │  │  └─ WizardInterface.php
   │           │  │  └─ Wizard.php
   │           │  ├─ Fill.php
   │           │  ├─ Font.php
   │           │  ├─ NumberFormat
   │           │  │  ├─ BaseFormatter.php
   │           │  │  ├─ DateFormatter.php
   │           │  │  ├─ Formatter.php
   │           │  │  ├─ FractionFormatter.php
   │           │  │  ├─ NumberFormatter.php
   │           │  │  ├─ PercentageFormatter.php
   │           │  │  └─ Wizard
   │           │  │     ├─ Accounting.php
   │           │  │     ├─ Currency.php
   │           │  │     ├─ CurrencyBase.php
   │           │  │     ├─ CurrencyNegative.php
   │           │  │     ├─ Date.php
   │           │  │     ├─ DateTime.php
   │           │  │     ├─ DateTimeWizard.php
   │           │  │     ├─ Duration.php
   │           │  │     ├─ Locale.php
   │           │  │     ├─ Number.php
   │           │  │     ├─ NumberBase.php
   │           │  │     ├─ Percentage.php
   │           │  │     ├─ Scientific.php
   │           │  │     ├─ Time.php
   │           │  │     └─ Wizard.php
   │           │  ├─ NumberFormat.php
   │           │  ├─ Protection.php
   │           │  ├─ RgbTint.php
   │           │  ├─ Style.php
   │           │  └─ Supervisor.php
   │           ├─ Theme.php
   │           ├─ Worksheet
   │           │  ├─ AutoFilter
   │           │  │  ├─ Column
   │           │  │  │  └─ Rule.php
   │           │  │  └─ Column.php
   │           │  ├─ AutoFilter.php
   │           │  ├─ AutoFit.php
   │           │  ├─ BaseDrawing.php
   │           │  ├─ CellIterator.php
   │           │  ├─ Column.php
   │           │  ├─ ColumnCellIterator.php
   │           │  ├─ ColumnDimension.php
   │           │  ├─ ColumnIterator.php
   │           │  ├─ Dimension.php
   │           │  ├─ Drawing
   │           │  │  └─ Shadow.php
   │           │  ├─ Drawing.php
   │           │  ├─ HeaderFooter.php
   │           │  ├─ HeaderFooterDrawing.php
   │           │  ├─ Iterator.php
   │           │  ├─ MemoryDrawing.php
   │           │  ├─ PageBreak.php
   │           │  ├─ PageMargins.php
   │           │  ├─ PageSetup.php
   │           │  ├─ Pane.php
   │           │  ├─ ProtectedRange.php
   │           │  ├─ Protection.php
   │           │  ├─ Row.php
   │           │  ├─ RowCellIterator.php
   │           │  ├─ RowDimension.php
   │           │  ├─ RowIterator.php
   │           │  ├─ SheetView.php
   │           │  ├─ Table
   │           │  │  ├─ Column.php
   │           │  │  ├─ TableDxfsStyle.php
   │           │  │  └─ TableStyle.php
   │           │  ├─ Table.php
   │           │  ├─ Validations.php
   │           │  └─ Worksheet.php
   │           └─ Writer
   │              ├─ BaseWriter.php
   │              ├─ Csv.php
   │              ├─ Exception.php
   │              ├─ Html.php
   │              ├─ IWriter.php
   │              ├─ Ods
   │              │  ├─ AutoFilters.php
   │              │  ├─ Cell
   │              │  │  ├─ Comment.php
   │              │  │  └─ Style.php
   │              │  ├─ Content.php
   │              │  ├─ Formula.php
   │              │  ├─ Meta.php
   │              │  ├─ MetaInf.php
   │              │  ├─ Mimetype.php
   │              │  ├─ NamedExpressions.php
   │              │  ├─ Settings.php
   │              │  ├─ Styles.php
   │              │  ├─ Thumbnails.php
   │              │  └─ WriterPart.php
   │              ├─ Ods.php
   │              ├─ Pdf
   │              │  ├─ Dompdf.php
   │              │  ├─ Mpdf.php
   │              │  └─ Tcpdf.php
   │              ├─ Pdf.php
   │              ├─ Xls
   │              │  ├─ BIFFwriter.php
   │              │  ├─ CellDataValidation.php
   │              │  ├─ ConditionalHelper.php
   │              │  ├─ ErrorCode.php
   │              │  ├─ Escher.php
   │              │  ├─ Font.php
   │              │  ├─ Parser.php
   │              │  ├─ Style
   │              │  │  ├─ CellAlignment.php
   │              │  │  ├─ CellBorder.php
   │              │  │  └─ CellFill.php
   │              │  ├─ Workbook.php
   │              │  ├─ Worksheet.php
   │              │  └─ Xf.php
   │              ├─ Xls.php
   │              ├─ Xlsx
   │              │  ├─ AutoFilter.php
   │              │  ├─ Chart.php
   │              │  ├─ Comments.php
   │              │  ├─ ContentTypes.php
   │              │  ├─ DefinedNames.php
   │              │  ├─ DocProps.php
   │              │  ├─ Drawing.php
   │              │  ├─ FunctionPrefix.php
   │              │  ├─ Metadata.php
   │              │  ├─ Rels.php
   │              │  ├─ RelsRibbon.php
   │              │  ├─ RelsVBA.php
   │              │  ├─ StringTable.php
   │              │  ├─ Style.php
   │              │  ├─ Table.php
   │              │  ├─ Theme.php
   │              │  ├─ Workbook.php
   │              │  ├─ Worksheet.php
   │              │  └─ WriterPart.php
   │              ├─ Xlsx.php
   │              ├─ ZipStream0.php
   │              ├─ ZipStream2.php
   │              └─ ZipStream3.php
   ├─ phpoption
   │  └─ phpoption
   │     ├─ composer.json
   │     ├─ LICENSE
   │     ├─ Makefile
   │     ├─ phpstan-baseline.neon
   │     ├─ phpstan.neon.dist
   │     ├─ phpunit.xml.dist
   │     ├─ psalm-baseline.xml
   │     ├─ psalm.xml
   │     ├─ README.md
   │     ├─ src
   │     │  └─ PhpOption
   │     │     ├─ LazyOption.php
   │     │     ├─ None.php
   │     │     ├─ Option.php
   │     │     └─ Some.php
   │     ├─ tests
   │     │  ├─ bootstrap.php
   │     │  └─ PhpOption
   │     │     └─ Tests
   │     │        ├─ EnsureTest.php
   │     │        ├─ LazyOptionTest.php
   │     │        ├─ NoneTest.php
   │     │        ├─ OptionTest.php
   │     │        └─ SomeTest.php
   │     └─ vendor-bin
   │        ├─ phpstan
   │        │  └─ composer.json
   │        └─ psalm
   │           └─ composer.json
   ├─ psr
   │  ├─ http-client
   │  │  ├─ CHANGELOG.md
   │  │  ├─ composer.json
   │  │  ├─ LICENSE
   │  │  ├─ README.md
   │  │  └─ src
   │  │     ├─ ClientExceptionInterface.php
   │  │     ├─ ClientInterface.php
   │  │     ├─ NetworkExceptionInterface.php
   │  │     └─ RequestExceptionInterface.php
   │  ├─ http-factory
   │  │  ├─ composer.json
   │  │  ├─ LICENSE
   │  │  ├─ README.md
   │  │  └─ src
   │  │     ├─ RequestFactoryInterface.php
   │  │     ├─ ResponseFactoryInterface.php
   │  │     ├─ ServerRequestFactoryInterface.php
   │  │     ├─ StreamFactoryInterface.php
   │  │     ├─ UploadedFileFactoryInterface.php
   │  │     └─ UriFactoryInterface.php
   │  ├─ http-message
   │  │  ├─ CHANGELOG.md
   │  │  ├─ composer.json
   │  │  ├─ docs
   │  │  │  ├─ PSR7-Interfaces.md
   │  │  │  └─ PSR7-Usage.md
   │  │  ├─ LICENSE
   │  │  ├─ README.md
   │  │  └─ src
   │  │     ├─ MessageInterface.php
   │  │     ├─ RequestInterface.php
   │  │     ├─ ResponseInterface.php
   │  │     ├─ ServerRequestInterface.php
   │  │     ├─ StreamInterface.php
   │  │     ├─ UploadedFileInterface.php
   │  │     └─ UriInterface.php
   │  ├─ log
   │  │  ├─ composer.json
   │  │  ├─ LICENSE
   │  │  ├─ README.md
   │  │  └─ src
   │  │     ├─ AbstractLogger.php
   │  │     ├─ InvalidArgumentException.php
   │  │     ├─ LoggerAwareInterface.php
   │  │     ├─ LoggerAwareTrait.php
   │  │     ├─ LoggerInterface.php
   │  │     ├─ LoggerTrait.php
   │  │     ├─ LogLevel.php
   │  │     └─ NullLogger.php
   │  └─ simple-cache
   │     ├─ .editorconfig
   │     ├─ composer.json
   │     ├─ LICENSE.md
   │     ├─ README.md
   │     └─ src
   │        ├─ CacheException.php
   │        ├─ CacheInterface.php
   │        └─ InvalidArgumentException.php
   ├─ setasign
   │  ├─ fpdi
   │  │  ├─ composer.json
   │  │  ├─ composer.lock
   │  │  ├─ LICENSE.txt
   │  │  ├─ local-tests
   │  │  │  ├─ alpha-test.php
   │  │  │  ├─ assets
   │  │  │  │  └─ pdfdoc-encoding.json
   │  │  │  ├─ concatenate.php
   │  │  │  ├─ filelist.php
   │  │  │  ├─ get-info.php
   │  │  │  ├─ import-layers.php
   │  │  │  ├─ memory.php
   │  │  │  ├─ page-in-template.php
   │  │  │  ├─ simple-v1.php
   │  │  │  ├─ simple.php
   │  │  │  └─ tfpdf.php
   │  │  ├─ phpcs.xml
   │  │  ├─ phpstan.neon
   │  │  ├─ phpunit.xml
   │  │  ├─ README.md
   │  │  ├─ scratches
   │  │  │  └─ ArrayVsObject.php
   │  │  ├─ SECURITY.md
   │  │  ├─ src
   │  │  │  ├─ autoload.php
   │  │  │  ├─ FpdfTpl.php
   │  │  │  ├─ FpdfTplTrait.php
   │  │  │  ├─ FpdfTrait.php
   │  │  │  ├─ Fpdi.php
   │  │  │  ├─ FpdiException.php
   │  │  │  ├─ FpdiTrait.php
   │  │  │  ├─ GraphicsState.php
   │  │  │  ├─ Math
   │  │  │  │  ├─ Matrix.php
   │  │  │  │  └─ Vector.php
   │  │  │  ├─ PdfParser
   │  │  │  │  ├─ CrossReference
   │  │  │  │  │  ├─ AbstractReader.php
   │  │  │  │  │  ├─ CrossReference.php
   │  │  │  │  │  ├─ CrossReferenceException.php
   │  │  │  │  │  ├─ FixedReader.php
   │  │  │  │  │  ├─ LineReader.php
   │  │  │  │  │  └─ ReaderInterface.php
   │  │  │  │  ├─ Filter
   │  │  │  │  │  ├─ Ascii85.php
   │  │  │  │  │  ├─ Ascii85Exception.php
   │  │  │  │  │  ├─ AsciiHex.php
   │  │  │  │  │  ├─ FilterException.php
   │  │  │  │  │  ├─ FilterInterface.php
   │  │  │  │  │  ├─ Flate.php
   │  │  │  │  │  ├─ FlateException.php
   │  │  │  │  │  ├─ Lzw.php
   │  │  │  │  │  └─ LzwException.php
   │  │  │  │  ├─ PdfParser.php
   │  │  │  │  ├─ PdfParserException.php
   │  │  │  │  ├─ StreamReader.php
   │  │  │  │  ├─ Tokenizer.php
   │  │  │  │  └─ Type
   │  │  │  │     ├─ PdfArray.php
   │  │  │  │     ├─ PdfBoolean.php
   │  │  │  │     ├─ PdfDictionary.php
   │  │  │  │     ├─ PdfHexString.php
   │  │  │  │     ├─ PdfIndirectObject.php
   │  │  │  │     ├─ PdfIndirectObjectReference.php
   │  │  │  │     ├─ PdfName.php
   │  │  │  │     ├─ PdfNull.php
   │  │  │  │     ├─ PdfNumeric.php
   │  │  │  │     ├─ PdfStream.php
   │  │  │  │     ├─ PdfString.php
   │  │  │  │     ├─ PdfToken.php
   │  │  │  │     ├─ PdfType.php
   │  │  │  │     └─ PdfTypeException.php
   │  │  │  ├─ PdfReader
   │  │  │  │  ├─ DataStructure
   │  │  │  │  │  └─ Rectangle.php
   │  │  │  │  ├─ Page.php
   │  │  │  │  ├─ PageBoundaries.php
   │  │  │  │  ├─ PdfReader.php
   │  │  │  │  └─ PdfReaderException.php
   │  │  │  ├─ Tcpdf
   │  │  │  │  └─ Fpdi.php
   │  │  │  ├─ TcpdfFpdi.php
   │  │  │  └─ Tfpdf
   │  │  │     ├─ FpdfTpl.php
   │  │  │     └─ Fpdi.php
   │  │  └─ tests
   │  │     ├─ bootstrap.php
   │  │     ├─ functional
   │  │     │  ├─ FpdfTplTest.php
   │  │     │  ├─ FpdiTest.php
   │  │     │  ├─ FpdiTraitTest.php
   │  │     │  ├─ FpdiTraitTestClass.php
   │  │     │  ├─ LinkHandling
   │  │     │  │  ├─ AbstractTest.php
   │  │     │  │  ├─ FpdiTest.php
   │  │     │  │  ├─ TcpdfTest.php
   │  │     │  │  └─ TfpdfTest.php
   │  │     │  ├─ PdfParser
   │  │     │  │  ├─ CrossReference
   │  │     │  │  │  ├─ CrossReferenceTest.php
   │  │     │  │  │  ├─ FixedReaderTest.php
   │  │     │  │  │  └─ LineReaderTest.php
   │  │     │  │  ├─ Filter
   │  │     │  │  │  ├─ Ascii85Test.php
   │  │     │  │  │  ├─ AsciiHexTest.php
   │  │     │  │  │  ├─ FlateTest.php
   │  │     │  │  │  ├─ LzwTest.php
   │  │     │  │  │  └─ _files
   │  │     │  │  │     └─ Flate
   │  │     │  │  │        ├─ special-decoded.bin
   │  │     │  │  │        └─ special.bin
   │  │     │  │  ├─ PdfParserTest.php
   │  │     │  │  ├─ TokenizerTest.php
   │  │     │  │  └─ Type
   │  │     │  │     ├─ data
   │  │     │  │     │  └─ streams
   │  │     │  │     │     └─ Boombastic-Box.pdf
   │  │     │  │     │        └─ 11-0-R.dump
   │  │     │  │     ├─ PdfArrayTest.php
   │  │     │  │     ├─ PdfBooleanTest.php
   │  │     │  │     ├─ PdfDictionaryTest.php
   │  │     │  │     ├─ PdfHexStringTest.php
   │  │     │  │     ├─ PdfIndirectObjectTest.php
   │  │     │  │     ├─ PdfNameTest.php
   │  │     │  │     ├─ PdfStreamTest.php
   │  │     │  │     └─ PdfStringTest.php
   │  │     │  ├─ PdfReader
   │  │     │  │  ├─ PageTest.php
   │  │     │  │  └─ PdfReaderTest.php
   │  │     │  ├─ PdfTypeDumper.php
   │  │     │  ├─ ReleaseCycledReferencesTest.php
   │  │     │  ├─ Tcpdf
   │  │     │  │  └─ FpdiTest.php
   │  │     │  └─ Tfpdf
   │  │     │     └─ FpdiTest.php
   │  │     ├─ unit
   │  │     │  ├─ FpdfTplTest.php
   │  │     │  ├─ FpdiTest.php
   │  │     │  ├─ FpdiTraitTest.php
   │  │     │  ├─ PdfParser
   │  │     │  │  ├─ CrossReference
   │  │     │  │  │  └─ CrossReferenceTest.php
   │  │     │  │  ├─ DummyFaultyStreamWrapper.php
   │  │     │  │  ├─ PdfParserTest.php
   │  │     │  │  ├─ StreamReaderTest.php
   │  │     │  │  ├─ Type
   │  │     │  │  │  ├─ PdfArrayTest.php
   │  │     │  │  │  ├─ PdfBooleanTest.php
   │  │     │  │  │  ├─ PdfDictionaryTest.php
   │  │     │  │  │  ├─ PdfHexStringTest.php
   │  │     │  │  │  ├─ PdfIndirectObjectReferenceTest.php
   │  │     │  │  │  ├─ PdfIndirectObjectTest.php
   │  │     │  │  │  ├─ PdfNameTest.php
   │  │     │  │  │  ├─ PdfNumericTest.php
   │  │     │  │  │  ├─ PdfStreamTest.php
   │  │     │  │  │  ├─ PdfStringTest.php
   │  │     │  │  │  ├─ PdfTokenTest.php
   │  │     │  │  │  └─ PdfTypeTest.php
   │  │     │  │  └─ _files
   │  │     │  │     └─ streamReader.txt
   │  │     │  ├─ PdfReader
   │  │     │  │  ├─ DataStructure
   │  │     │  │  │  └─ RectangleTest.php
   │  │     │  │  ├─ PageBoundariesTest.php
   │  │     │  │  └─ PageTest.php
   │  │     │  ├─ Tcpdf
   │  │     │  │  └─ FpdiTest.php
   │  │     │  └─ Tfpdf
   │  │     │     └─ FpdiTest.php
   │  │     ├─ visual
   │  │     │  ├─ Alpha
   │  │     │  │  ├─ AlphaPdf.php
   │  │     │  │  ├─ AlphaTest
   │  │     │  │  │  └─ 0
   │  │     │  │  │     └─ original
   │  │     │  │  │        └─ result.pdf
   │  │     │  │  └─ AlphaTest.php
   │  │     │  ├─ ConcatTest
   │  │     │  │  ├─ 0
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  ├─ boxes
   │  │     │  │  │  ├─ All2
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  ├─ [-1000 -1000 -500 -500]
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  ├─ [1000 500 -1000 -500]
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  └─ [1000 500 -1000 -500]-R90
   │  │     │  │  │     └─ original
   │  │     │  │  │        └─ result.pdf
   │  │     │  │  ├─ flate-and-hex
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  ├─ rotated
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  └─ specials
   │  │     │  │     └─ 0 0 R
   │  │     │  │        └─ original
   │  │     │  │           └─ result.pdf
   │  │     │  ├─ ConcatTest.php
   │  │     │  ├─ FpdfTplTest
   │  │     │  │  ├─ adjustPageSize
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  ├─ colorHandlingA
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  ├─ colorHandlingB
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  ├─ fontHandlingA
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  ├─ fontHandlingB
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  ├─ templateInTemplate
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  ├─ templateInTemplateMm
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  └─ underlineHandling
   │  │     │  │     └─ original
   │  │     │  │        └─ result.pdf
   │  │     │  ├─ FpdfTplTest.php
   │  │     │  ├─ FpdiTest
   │  │     │  │  ├─ importedPageInTemplateMm1
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  ├─ importedPageInTemplateMm2
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  ├─ importedPageInTemplatePt1
   │  │     │  │  │  └─ original
   │  │     │  │  │     └─ result.pdf
   │  │     │  │  └─ importedPageInTemplatePt2
   │  │     │  │     └─ original
   │  │     │  │        └─ result.pdf
   │  │     │  ├─ FpdiTest.php
   │  │     │  ├─ Tcpdf
   │  │     │  │  └─ ConcatTest.php
   │  │     │  ├─ Tfpdf
   │  │     │  │  ├─ ConcatTest.php
   │  │     │  │  ├─ FpdfTplTest
   │  │     │  │  │  ├─ adjustPageSize
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  ├─ colorHandlingA
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  ├─ colorHandlingB
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  ├─ fontHandlingA
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  ├─ fontHandlingB
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  ├─ templateInTemplate
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  ├─ templateInTemplateMm
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  └─ underlineHandling
   │  │     │  │  │     └─ original
   │  │     │  │  │        └─ result.pdf
   │  │     │  │  ├─ FpdfTplTest.php
   │  │     │  │  ├─ FpdiTest
   │  │     │  │  │  ├─ importedPageInTemplateMm1
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  ├─ importedPageInTemplateMm2
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  ├─ importedPageInTemplatePt1
   │  │     │  │  │  │  └─ original
   │  │     │  │  │  │     └─ result.pdf
   │  │     │  │  │  └─ importedPageInTemplatePt2
   │  │     │  │  │     └─ original
   │  │     │  │  │        └─ result.pdf
   │  │     │  │  └─ FpdiTest.php
   │  │     │  └─ VisualTestCase.php
   │  │     └─ _files
   │  │        ├─ images
   │  │        │  ├─ jpeg.jpg
   │  │        │  └─ png-8.png
   │  │        └─ pdfs
   │  │           ├─ 1000.pdf
   │  │           ├─ 10000.pdf
   │  │           ├─ 10000_with-tree.pdf
   │  │           ├─ Boombastic-Box.pdf
   │  │           ├─ boxes
   │  │           │  ├─ All.pdf
   │  │           │  ├─ All2.pdf
   │  │           │  ├─ [-100 -100 1000 1000].pdf
   │  │           │  ├─ [-1000 -1000 -500 -500].pdf
   │  │           │  ├─ [-200 -100 1000 500].pdf
   │  │           │  ├─ [1000 500 -1000 -500]-R-90.pdf
   │  │           │  ├─ [1000 500 -1000 -500]-R90.pdf
   │  │           │  └─ [1000 500 -1000 -500].pdf
   │  │           ├─ compressed-xref.pdf
   │  │           ├─ encrypted
   │  │           │  ├─ AES256-R6-u=user-o=owner.pdf
   │  │           │  └─ ex37.pdf
   │  │           ├─ Example-PDF-2.pdf
   │  │           ├─ Fantastic-Speaker.pdf
   │  │           ├─ filters
   │  │           │  ├─ hex
   │  │           │  │  └─ hex.pdf
   │  │           │  ├─ lzw
   │  │           │  │  └─ 999998.pdf
   │  │           │  └─ multiple
   │  │           │     └─ flate-and-hex.pdf
   │  │           ├─ HybridFile.pdf
   │  │           ├─ layers
   │  │           │  ├─ rect+circle+polygon.pdf
   │  │           │  └─ rect+circle+triangle.pdf
   │  │           ├─ links
   │  │           │  ├─ annotations-with-invalid-references.pdf
   │  │           │  ├─ boxes-rotated.pdf
   │  │           │  ├─ boxes.pdf
   │  │           │  ├─ first_file.pdf
   │  │           │  ├─ invalid-annots-reference.pdf
   │  │           │  ├─ links-with-indirect-references.pdf
   │  │           │  ├─ links.pdf
   │  │           │  ├─ rotated-pages.pdf
   │  │           │  ├─ tuto6.pdf
   │  │           │  ├─ update-links.pdf.php
   │  │           │  ├─ [-100 -100 1000 1000].pdf
   │  │           │  ├─ [-1000 -1000 -500 -500].pdf
   │  │           │  ├─ [-200 -100 1000 500].pdf
   │  │           │  ├─ [1000 500 -1000 -500]-R-90.pdf
   │  │           │  ├─ [1000 500 -1000 -500]-R90.pdf
   │  │           │  └─ [1000 500 -1000 -500].pdf
   │  │           ├─ Noisy-Tube.pdf
   │  │           ├─ normal-xref.pdf
   │  │           ├─ PDF-complex-structure.pdf
   │  │           ├─ ReferencesToInvalidObjects.pdf
   │  │           ├─ rotated
   │  │           │  ├─ -180.pdf
   │  │           │  ├─ -270.pdf
   │  │           │  ├─ -360.pdf
   │  │           │  ├─ -450.pdf
   │  │           │  ├─ -90.pdf
   │  │           │  ├─ 180.pdf
   │  │           │  ├─ 270.pdf
   │  │           │  ├─ 360.pdf
   │  │           │  ├─ 450.pdf
   │  │           │  ├─ 90.pdf
   │  │           │  └─ all.pdf
   │  │           ├─ specials
   │  │           │  ├─ 0 0 R
   │  │           │  │  ├─ template_pracovny_prikaz7-ooo-a.pdf
   │  │           │  │  └─ template_pracovny_prikaz7-ooo-a.txt
   │  │           │  ├─ bytes-before-file-header
   │  │           │  │  └─ Fantastic-Speaker-bytes-before-fileheader.pdf
   │  │           │  ├─ ContentsArrayWithNoStream.pdf
   │  │           │  ├─ ContentsArrayWithReferenceToNotExistingObject.pdf
   │  │           │  ├─ ContentsWithReferenceToNotExistingObject.pdf
   │  │           │  ├─ invalid-type-at-object-offset.pdf
   │  │           │  ├─ NoContentsEntry.pdf
   │  │           │  └─ page-trees
   │  │           │     ├─ PageTree.pdf
   │  │           │     ├─ PageTree2.pdf
   │  │           │     ├─ PageTreeWithEmptyKids.pdf
   │  │           │     ├─ PageTreeWithEmptyKids2.pdf
   │  │           │     ├─ PageTreeWithEmptyKids3.pdf
   │  │           │     └─ PageTreeWithInvalidTypeAndMisslLeadingCount.pdf
   │  │           ├─ stamps
   │  │           │  ├─ ENU
   │  │           │  │  ├─ SignHere.pdf
   │  │           │  │  ├─ Standard.pdf
   │  │           │  │  └─ StandardBusiness.pdf
   │  │           │  └─ INFO.txt
   │  │           ├─ tektown
   │  │           │  ├─ Letterhead.pdf
   │  │           │  └─ Logo.pdf
   │  │           ├─ transparency
   │  │           │  └─ ex74.pdf
   │  │           └─ Word2010.pdf
   │  └─ fpdi-tcpdf
   │     ├─ composer.json
   │     ├─ LICENSE.txt
   │     └─ README.md
   ├─ symfony
   │  ├─ polyfill-ctype
   │  │  ├─ bootstrap.php
   │  │  ├─ bootstrap80.php
   │  │  ├─ composer.json
   │  │  ├─ Ctype.php
   │  │  ├─ LICENSE
   │  │  └─ README.md
   │  ├─ polyfill-mbstring
   │  │  ├─ bootstrap.php
   │  │  ├─ bootstrap80.php
   │  │  ├─ composer.json
   │  │  ├─ LICENSE
   │  │  ├─ Mbstring.php
   │  │  ├─ README.md
   │  │  └─ Resources
   │  │     └─ unidata
   │  │        ├─ caseFolding.php
   │  │        ├─ lowerCase.php
   │  │        ├─ titleCaseRegexp.php
   │  │        └─ upperCase.php
   │  └─ polyfill-php80
   │     ├─ bootstrap.php
   │     ├─ composer.json
   │     ├─ LICENSE
   │     ├─ Php80.php
   │     ├─ PhpToken.php
   │     ├─ README.md
   │     └─ Resources
   │        └─ stubs
   │           ├─ Attribute.php
   │           ├─ PhpToken.php
   │           ├─ Stringable.php
   │           ├─ UnhandledMatchError.php
   │           └─ ValueError.php
   ├─ tecnickcom
   │  └─ tcpdf
   │     ├─ CHANGELOG.TXT
   │     ├─ composer.json
   │     ├─ config
   │     │  └─ tcpdf_config.php
   │     ├─ examples
   │     │  ├─ barcodes
   │     │  │  ├─ example_1d_html.php
   │     │  │  ├─ example_1d_png.php
   │     │  │  ├─ example_1d_svg.php
   │     │  │  ├─ example_1d_svgi.php
   │     │  │  ├─ example_2d_datamatrix_html.php
   │     │  │  ├─ example_2d_datamatrix_png.php
   │     │  │  ├─ example_2d_datamatrix_svg.php
   │     │  │  ├─ example_2d_datamatrix_svgi.php
   │     │  │  ├─ example_2d_pdf417_html.php
   │     │  │  ├─ example_2d_pdf417_png.php
   │     │  │  ├─ example_2d_pdf417_svg.php
   │     │  │  ├─ example_2d_pdf417_svgi.php
   │     │  │  ├─ example_2d_qrcode_html.php
   │     │  │  ├─ example_2d_qrcode_png.php
   │     │  │  ├─ example_2d_qrcode_svg.php
   │     │  │  ├─ example_2d_qrcode_svgi.php
   │     │  │  ├─ tcpdf_barcodes_1d_include.php
   │     │  │  └─ tcpdf_barcodes_2d_include.php
   │     │  ├─ config
   │     │  │  └─ tcpdf_config_alt.php
   │     │  ├─ data
   │     │  │  ├─ cert
   │     │  │  │  ├─ tcpdf.crt
   │     │  │  │  ├─ tcpdf.fdf
   │     │  │  │  └─ tcpdf.p12
   │     │  │  ├─ chapter_demo_1.txt
   │     │  │  ├─ chapter_demo_2.txt
   │     │  │  ├─ table_data_demo.txt
   │     │  │  └─ utf8test.txt
   │     │  ├─ example_001.php
   │     │  ├─ example_002.php
   │     │  ├─ example_003.php
   │     │  ├─ example_004.php
   │     │  ├─ example_005.php
   │     │  ├─ example_006.php
   │     │  ├─ example_007.php
   │     │  ├─ example_008.php
   │     │  ├─ example_009.php
   │     │  ├─ example_010.php
   │     │  ├─ example_011.php
   │     │  ├─ example_012.pdf
   │     │  ├─ example_012.php
   │     │  ├─ example_013.php
   │     │  ├─ example_014.php
   │     │  ├─ example_015.php
   │     │  ├─ example_016.php
   │     │  ├─ example_017.php
   │     │  ├─ example_018.php
   │     │  ├─ example_019.php
   │     │  ├─ example_020.php
   │     │  ├─ example_021.php
   │     │  ├─ example_022.php
   │     │  ├─ example_023.php
   │     │  ├─ example_024.php
   │     │  ├─ example_025.php
   │     │  ├─ example_026.php
   │     │  ├─ example_027.php
   │     │  ├─ example_028.php
   │     │  ├─ example_029.php
   │     │  ├─ example_030.php
   │     │  ├─ example_031.php
   │     │  ├─ example_032.php
   │     │  ├─ example_033.php
   │     │  ├─ example_034.php
   │     │  ├─ example_035.php
   │     │  ├─ example_036.php
   │     │  ├─ example_037.php
   │     │  ├─ example_038.php
   │     │  ├─ example_039.php
   │     │  ├─ example_040.php
   │     │  ├─ example_041.php
   │     │  ├─ example_042.php
   │     │  ├─ example_043.php
   │     │  ├─ example_044.php
   │     │  ├─ example_045.php
   │     │  ├─ example_046.php
   │     │  ├─ example_047.php
   │     │  ├─ example_048.php
   │     │  ├─ example_049.php
   │     │  ├─ example_050.php
   │     │  ├─ example_051.php
   │     │  ├─ example_052.php
   │     │  ├─ example_053.php
   │     │  ├─ example_054.php
   │     │  ├─ example_055.php
   │     │  ├─ example_056.php
   │     │  ├─ example_057.php
   │     │  ├─ example_058.php
   │     │  ├─ example_059.php
   │     │  ├─ example_060.php
   │     │  ├─ example_061.php
   │     │  ├─ example_062.php
   │     │  ├─ example_063.php
   │     │  ├─ example_064.php
   │     │  ├─ example_065.php
   │     │  ├─ example_066.php
   │     │  ├─ example_067.php
   │     │  ├─ example_068.php
   │     │  ├─ images
   │     │  │  ├─ alpha.png
   │     │  │  ├─ image_demo.jpg
   │     │  │  ├─ image_with_alpha.png
   │     │  │  ├─ img.png
   │     │  │  ├─ logo_example.gif
   │     │  │  ├─ logo_example.jpg
   │     │  │  ├─ logo_example.png
   │     │  │  ├─ tcpdf_box.ai
   │     │  │  ├─ tcpdf_box.svg
   │     │  │  ├─ tcpdf_cell.png
   │     │  │  ├─ tcpdf_logo.jpg
   │     │  │  ├─ tcpdf_signature.png
   │     │  │  ├─ testsvg.svg
   │     │  │  ├─ tux.svg
   │     │  │  └─ _blank.png
   │     │  ├─ index.php
   │     │  ├─ lang
   │     │  │  ├─ afr.php
   │     │  │  ├─ ara.php
   │     │  │  ├─ aze.php
   │     │  │  ├─ bel.php
   │     │  │  ├─ bra.php
   │     │  │  ├─ bul.php
   │     │  │  ├─ cat.php
   │     │  │  ├─ ces.php
   │     │  │  ├─ chi.php
   │     │  │  ├─ cym.php
   │     │  │  ├─ dan.php
   │     │  │  ├─ eng.php
   │     │  │  ├─ est.php
   │     │  │  ├─ eus.php
   │     │  │  ├─ far.php
   │     │  │  ├─ fra.php
   │     │  │  ├─ ger.php
   │     │  │  ├─ gle.php
   │     │  │  ├─ glg.php
   │     │  │  ├─ hat.php
   │     │  │  ├─ heb.php
   │     │  │  ├─ hrv.php
   │     │  │  ├─ hun.php
   │     │  │  ├─ hye.php
   │     │  │  ├─ ind.php
   │     │  │  ├─ ita.php
   │     │  │  ├─ jpn.php
   │     │  │  ├─ kat.php
   │     │  │  ├─ kor.php
   │     │  │  ├─ mkd.php
   │     │  │  ├─ mlt.php
   │     │  │  ├─ msa.php
   │     │  │  ├─ nld.php
   │     │  │  ├─ nob.php
   │     │  │  ├─ pol.php
   │     │  │  ├─ por.php
   │     │  │  ├─ ron.php
   │     │  │  ├─ rus.php
   │     │  │  ├─ slv.php
   │     │  │  ├─ spa.php
   │     │  │  ├─ sqi.php
   │     │  │  ├─ srp.php
   │     │  │  ├─ swa.php
   │     │  │  ├─ swe.php
   │     │  │  ├─ ukr.php
   │     │  │  ├─ urd.php
   │     │  │  ├─ yid.php
   │     │  │  └─ zho.php
   │     │  └─ tcpdf_include.php
   │     ├─ fonts
   │     │  ├─ aealarabiya.ctg.z
   │     │  ├─ aealarabiya.php
   │     │  ├─ aealarabiya.z
   │     │  ├─ aefurat.ctg.z
   │     │  ├─ aefurat.php
   │     │  ├─ aefurat.z
   │     │  ├─ ae_fonts_2.0
   │     │  │  ├─ ChangeLog
   │     │  │  ├─ COPYING
   │     │  │  └─ README
   │     │  ├─ cid0cs.php
   │     │  ├─ cid0ct.php
   │     │  ├─ cid0jp.php
   │     │  ├─ cid0kr.php
   │     │  ├─ courier.php
   │     │  ├─ courierb.php
   │     │  ├─ courierbi.php
   │     │  ├─ courieri.php
   │     │  ├─ dejavu-fonts-ttf-2.33
   │     │  │  ├─ AUTHORS
   │     │  │  ├─ BUGS
   │     │  │  ├─ langcover.txt
   │     │  │  ├─ LICENSE
   │     │  │  ├─ NEWS
   │     │  │  ├─ README
   │     │  │  └─ unicover.txt
   │     │  ├─ dejavu-fonts-ttf-2.34
   │     │  │  ├─ AUTHORS
   │     │  │  ├─ BUGS
   │     │  │  ├─ langcover.txt
   │     │  │  ├─ LICENSE
   │     │  │  ├─ NEWS
   │     │  │  ├─ README
   │     │  │  └─ unicover.txt
   │     │  ├─ dejavusans.ctg.z
   │     │  ├─ dejavusans.php
   │     │  ├─ dejavusans.z
   │     │  ├─ dejavusansb.ctg.z
   │     │  ├─ dejavusansb.php
   │     │  ├─ dejavusansb.z
   │     │  ├─ dejavusansbi.ctg.z
   │     │  ├─ dejavusansbi.php
   │     │  ├─ dejavusansbi.z
   │     │  ├─ dejavusanscondensed.ctg.z
   │     │  ├─ dejavusanscondensed.php
   │     │  ├─ dejavusanscondensed.z
   │     │  ├─ dejavusanscondensedb.ctg.z
   │     │  ├─ dejavusanscondensedb.php
   │     │  ├─ dejavusanscondensedb.z
   │     │  ├─ dejavusanscondensedbi.ctg.z
   │     │  ├─ dejavusanscondensedbi.php
   │     │  ├─ dejavusanscondensedbi.z
   │     │  ├─ dejavusanscondensedi.ctg.z
   │     │  ├─ dejavusanscondensedi.php
   │     │  ├─ dejavusanscondensedi.z
   │     │  ├─ dejavusansextralight.ctg.z
   │     │  ├─ dejavusansextralight.php
   │     │  ├─ dejavusansextralight.z
   │     │  ├─ dejavusansi.ctg.z
   │     │  ├─ dejavusansi.php
   │     │  ├─ dejavusansi.z
   │     │  ├─ dejavusansmono.ctg.z
   │     │  ├─ dejavusansmono.php
   │     │  ├─ dejavusansmono.z
   │     │  ├─ dejavusansmonob.ctg.z
   │     │  ├─ dejavusansmonob.php
   │     │  ├─ dejavusansmonob.z
   │     │  ├─ dejavusansmonobi.ctg.z
   │     │  ├─ dejavusansmonobi.php
   │     │  ├─ dejavusansmonobi.z
   │     │  ├─ dejavusansmonoi.ctg.z
   │     │  ├─ dejavusansmonoi.php
   │     │  ├─ dejavusansmonoi.z
   │     │  ├─ dejavuserif.ctg.z
   │     │  ├─ dejavuserif.php
   │     │  ├─ dejavuserif.z
   │     │  ├─ dejavuserifb.ctg.z
   │     │  ├─ dejavuserifb.php
   │     │  ├─ dejavuserifb.z
   │     │  ├─ dejavuserifbi.ctg.z
   │     │  ├─ dejavuserifbi.php
   │     │  ├─ dejavuserifbi.z
   │     │  ├─ dejavuserifcondensed.ctg.z
   │     │  ├─ dejavuserifcondensed.php
   │     │  ├─ dejavuserifcondensed.z
   │     │  ├─ dejavuserifcondensedb.ctg.z
   │     │  ├─ dejavuserifcondensedb.php
   │     │  ├─ dejavuserifcondensedb.z
   │     │  ├─ dejavuserifcondensedbi.ctg.z
   │     │  ├─ dejavuserifcondensedbi.php
   │     │  ├─ dejavuserifcondensedbi.z
   │     │  ├─ dejavuserifcondensedi.ctg.z
   │     │  ├─ dejavuserifcondensedi.php
   │     │  ├─ dejavuserifcondensedi.z
   │     │  ├─ dejavuserifi.ctg.z
   │     │  ├─ dejavuserifi.php
   │     │  ├─ dejavuserifi.z
   │     │  ├─ freefont-20100919
   │     │  │  ├─ AUTHORS
   │     │  │  ├─ ChangeLog
   │     │  │  ├─ COPYING
   │     │  │  ├─ CREDITS
   │     │  │  ├─ INSTALL
   │     │  │  └─ README
   │     │  ├─ freefont-20120503
   │     │  │  ├─ AUTHORS
   │     │  │  ├─ ChangeLog
   │     │  │  ├─ COPYING
   │     │  │  ├─ CREDITS
   │     │  │  ├─ INSTALL
   │     │  │  ├─ README
   │     │  │  ├─ TROUBLESHOOTING
   │     │  │  └─ USAGE
   │     │  ├─ freemono.ctg.z
   │     │  ├─ freemono.php
   │     │  ├─ freemono.z
   │     │  ├─ freemonob.ctg.z
   │     │  ├─ freemonob.php
   │     │  ├─ freemonob.z
   │     │  ├─ freemonobi.ctg.z
   │     │  ├─ freemonobi.php
   │     │  ├─ freemonobi.z
   │     │  ├─ freemonoi.ctg.z
   │     │  ├─ freemonoi.php
   │     │  ├─ freemonoi.z
   │     │  ├─ freesans.ctg.z
   │     │  ├─ freesans.php
   │     │  ├─ freesans.z
   │     │  ├─ freesansb.ctg.z
   │     │  ├─ freesansb.php
   │     │  ├─ freesansb.z
   │     │  ├─ freesansbi.ctg.z
   │     │  ├─ freesansbi.php
   │     │  ├─ freesansbi.z
   │     │  ├─ freesansi.ctg.z
   │     │  ├─ freesansi.php
   │     │  ├─ freesansi.z
   │     │  ├─ freeserif.ctg.z
   │     │  ├─ freeserif.php
   │     │  ├─ freeserif.z
   │     │  ├─ freeserifb.ctg.z
   │     │  ├─ freeserifb.php
   │     │  ├─ freeserifb.z
   │     │  ├─ freeserifbi.ctg.z
   │     │  ├─ freeserifbi.php
   │     │  ├─ freeserifbi.z
   │     │  ├─ freeserifi.ctg.z
   │     │  ├─ freeserifi.php
   │     │  ├─ freeserifi.z
   │     │  ├─ helvetica.php
   │     │  ├─ helveticab.php
   │     │  ├─ helveticabi.php
   │     │  ├─ helveticai.php
   │     │  ├─ hysmyeongjostdmedium.php
   │     │  ├─ kozgopromedium.php
   │     │  ├─ kozminproregular.php
   │     │  ├─ msungstdlight.php
   │     │  ├─ pdfacourier.php
   │     │  ├─ pdfacourier.z
   │     │  ├─ pdfacourierb.php
   │     │  ├─ pdfacourierb.z
   │     │  ├─ pdfacourierbi.php
   │     │  ├─ pdfacourierbi.z
   │     │  ├─ pdfacourieri.php
   │     │  ├─ pdfacourieri.z
   │     │  ├─ pdfahelvetica.php
   │     │  ├─ pdfahelvetica.z
   │     │  ├─ pdfahelveticab.php
   │     │  ├─ pdfahelveticab.z
   │     │  ├─ pdfahelveticabi.php
   │     │  ├─ pdfahelveticabi.z
   │     │  ├─ pdfahelveticai.php
   │     │  ├─ pdfahelveticai.z
   │     │  ├─ pdfasymbol.php
   │     │  ├─ pdfasymbol.z
   │     │  ├─ pdfatimes.php
   │     │  ├─ pdfatimes.z
   │     │  ├─ pdfatimesb.php
   │     │  ├─ pdfatimesb.z
   │     │  ├─ pdfatimesbi.php
   │     │  ├─ pdfatimesbi.z
   │     │  ├─ pdfatimesi.php
   │     │  ├─ pdfatimesi.z
   │     │  ├─ pdfazapfdingbats.php
   │     │  ├─ pdfazapfdingbats.z
   │     │  ├─ stsongstdlight.php
   │     │  ├─ symbol.php
   │     │  ├─ times.php
   │     │  ├─ timesb.php
   │     │  ├─ timesbi.php
   │     │  ├─ timesi.php
   │     │  ├─ uni2cid_ac15.php
   │     │  ├─ uni2cid_ag15.php
   │     │  ├─ uni2cid_aj16.php
   │     │  ├─ uni2cid_ak12.php
   │     │  └─ zapfdingbats.php
   │     ├─ include
   │     │  ├─ barcodes
   │     │  │  ├─ datamatrix.php
   │     │  │  ├─ pdf417.php
   │     │  │  └─ qrcode.php
   │     │  ├─ sRGB.icc
   │     │  ├─ tcpdf_colors.php
   │     │  ├─ tcpdf_filters.php
   │     │  ├─ tcpdf_fonts.php
   │     │  ├─ tcpdf_font_data.php
   │     │  ├─ tcpdf_images.php
   │     │  └─ tcpdf_static.php
   │     ├─ LICENSE.TXT
   │     ├─ phpstan.neon.dist
   │     ├─ README.md
   │     ├─ scripts
   │     │  └─ doctum.php
   │     ├─ tcpdf.php
   │     ├─ tcpdf_autoconfig.php
   │     ├─ tcpdf_barcodes_1d.php
   │     ├─ tcpdf_barcodes_2d.php
   │     ├─ tests
   │     │  ├─ compare_runs.php
   │     │  ├─ composer.json
   │     │  ├─ coverage.php
   │     │  ├─ launch.php
   │     │  ├─ launch.sh
   │     │  └─ src
   │     │     ├─ ImageMagick.php
   │     │     ├─ PdfTools.php
   │     │     ├─ PhpExecutor.php
   │     │     ├─ TestExecutor.php
   │     │     └─ TestRunner.php
   │     ├─ tools
   │     │  ├─ .htaccess
   │     │  ├─ convert_fonts_examples.txt
   │     │  └─ tcpdf_addfont.php
   │     └─ VERSION
   └─ vlucas
      └─ phpdotenv
         ├─ .editorconfig
         ├─ composer.json
         ├─ LICENSE
         ├─ Makefile
         ├─ phpstan-baseline.neon
         ├─ phpstan.neon.dist
         ├─ phpunit.xml.dist
         ├─ psalm-baseline.xml
         ├─ psalm.xml
         ├─ README.md
         ├─ src
         │  ├─ Dotenv.php
         │  ├─ Exception
         │  │  ├─ ExceptionInterface.php
         │  │  ├─ InvalidEncodingException.php
         │  │  ├─ InvalidFileException.php
         │  │  ├─ InvalidPathException.php
         │  │  └─ ValidationException.php
         │  ├─ Loader
         │  │  ├─ Loader.php
         │  │  ├─ LoaderInterface.php
         │  │  └─ Resolver.php
         │  ├─ Parser
         │  │  ├─ Entry.php
         │  │  ├─ EntryParser.php
         │  │  ├─ Lexer.php
         │  │  ├─ Lines.php
         │  │  ├─ Parser.php
         │  │  ├─ ParserInterface.php
         │  │  └─ Value.php
         │  ├─ Repository
         │  │  ├─ Adapter
         │  │  │  ├─ AdapterInterface.php
         │  │  │  ├─ ApacheAdapter.php
         │  │  │  ├─ ArrayAdapter.php
         │  │  │  ├─ EnvConstAdapter.php
         │  │  │  ├─ GuardedWriter.php
         │  │  │  ├─ ImmutableWriter.php
         │  │  │  ├─ MultiReader.php
         │  │  │  ├─ MultiWriter.php
         │  │  │  ├─ PutenvAdapter.php
         │  │  │  ├─ ReaderInterface.php
         │  │  │  ├─ ReplacingWriter.php
         │  │  │  ├─ ServerConstAdapter.php
         │  │  │  └─ WriterInterface.php
         │  │  ├─ AdapterRepository.php
         │  │  ├─ RepositoryBuilder.php
         │  │  └─ RepositoryInterface.php
         │  ├─ Store
         │  │  ├─ File
         │  │  │  ├─ Paths.php
         │  │  │  └─ Reader.php
         │  │  ├─ FileStore.php
         │  │  ├─ StoreBuilder.php
         │  │  ├─ StoreInterface.php
         │  │  └─ StringStore.php
         │  ├─ Util
         │  │  ├─ Regex.php
         │  │  └─ Str.php
         │  └─ Validator.php
         ├─ tests
         │  ├─ Dotenv
         │  │  ├─ DotenvTest.php
         │  │  ├─ Loader
         │  │  │  └─ LoaderTest.php
         │  │  ├─ Parser
         │  │  │  ├─ EntryParserTest.php
         │  │  │  ├─ LexerTest.php
         │  │  │  ├─ LinesTest.php
         │  │  │  └─ ParserTest.php
         │  │  ├─ Repository
         │  │  │  ├─ Adapter
         │  │  │  │  ├─ ArrayAdapterTest.php
         │  │  │  │  ├─ EnvConstAdapterTest.php
         │  │  │  │  ├─ PutenvAdapterTest.php
         │  │  │  │  └─ ServerConstAdapterTest.php
         │  │  │  └─ RepositoryTest.php
         │  │  ├─ Store
         │  │  │  └─ StoreTest.php
         │  │  └─ ValidatorTest.php
         │  └─ fixtures
         │     └─ env
         │        ├─ .env
         │        ├─ assertions.env
         │        ├─ booleans.env
         │        ├─ commented.env
         │        ├─ empty.env
         │        ├─ example.env
         │        ├─ exported.env
         │        ├─ immutable.env
         │        ├─ integers.env
         │        ├─ large.env
         │        ├─ multibyte.env
         │        ├─ multiline.env
         │        ├─ multiple.env
         │        ├─ mutable.env
         │        ├─ nested.env
         │        ├─ quoted.env
         │        ├─ specialchars.env
         │        ├─ unicodevarnames.env
         │        ├─ utf8-with-bom-encoding.env
         │        └─ windows.env
         ├─ UPGRADING.md
         └─ vendor-bin
            ├─ phpstan
            │  └─ composer.json
            └─ psalm
               └─ composer.json

```
```
acss-1-main
├─ .env
├─ composer.json
├─ composer.lock
├─ composer.phar
├─ launch.bat
├─ package-lock.json
├─ package.json
├─ public
│  ├─ assets
│  │  ├─ js
│  │  │  ├─ curriculum.js
│  │  │  ├─ generate_schedules.js
│  │  │  ├─ manual_schedules.js
│  │  │  └─ schedule.js
│  │  └─ logo
│  │     ├─ college_logo
│  │     │  ├─ college_7_1759400446.png
│  │     │  ├─ college_7_1759451921.png
│  │     │  ├─ college_7_1759453222.png
│  │     │  ├─ college_7_1759632346.png
│  │     │  └─ college_7_1759632357.png
│  │     └─ main_logo
│  │        ├─ campus.jpg
│  │        └─ PRMSUlogo.png
│  ├─ css
│  │  ├─ custom.css
│  │  ├─ output.css
│  │  ├─ schedule_management.css
│  │  └─ settings.css
│  ├─ index.php
│  └─ uploads
│     ├─ profiles
│     │  ├─ profile_1_1755697812.png
│     │  ├─ profile_1_1755697860.png
│     │  └─ profile_1_1755860919.png
│     ├─ profiles_picture
│     │  └─ profile_1_1755864417.png
│     └─ profile_pictures
│        ├─ profile_1_1755864533.png
│        ├─ profile_1_1755867785.png
│        ├─ profile_1_1756791244.png
│        ├─ profile_1_1756792379.png
│        ├─ profile_2_1756793168.png
│        ├─ profile_45_1758014886.png
│        ├─ profile_65_1755868685.png
│        ├─ user_1_1755864800.png
│        ├─ user_1_1755865986.png
│        ├─ user_49_1751092559.png
│        ├─ user_59_1755334211.png
│        ├─ user_59_1755334397.png
│        ├─ user_59_1755334635.png
│        ├─ user_59_1755335026.png
│        ├─ user_59_1755335130.png
│        └─ user_59_1755335861.png
├─ README.md
├─ src
│  ├─ api
│  │  └─ load_data.php
│  ├─ config
│  │  └─ Database.php
│  ├─ controllers
│  │  ├─ AdminController.php
│  │  ├─ ApiController.php
│  │  ├─ AuthController.php
│  │  ├─ ChairController.php
│  │  ├─ DeanController.php
│  │  ├─ DirectorController.php
│  │  ├─ FacultyController.php
│  │  └─ PublicController.php
│  ├─ input.css
│  ├─ middleware
│  │  └─ AuthMiddleware.php
│  ├─ models
│  │  ├─ ContentModel.php
│  │  ├─ ScheduleModel.php
│  │  └─ UserModel.php
│  ├─ services
│  │  ├─ AuthService.php
│  │  ├─ EmailService.php
│  │  └─ SchedulingService.php
│  └─ views
│     ├─ admin
│     │  ├─ act_logs.php
│     │  ├─ classroom.php
│     │  ├─ colleges.php
│     │  ├─ colleges_departments.php
│     │  ├─ dashboard.php
│     │  ├─ departments.php
│     │  ├─ edit_user.php
│     │  ├─ layout.php
│     │  ├─ profile.php
│     │  ├─ schedule.php
│     │  ├─ settings.php
│     │  └─ users.php
│     ├─ auth
│     │  ├─ forgot_password.php
│     │  ├─ login.php
│     │  ├─ register-step2.php
│     │  ├─ register.php
│     │  └─ reset_password.php
│     ├─ chair
│     │  ├─ classroom.php
│     │  ├─ courses.php
│     │  ├─ curriculum.php
│     │  ├─ dashboard.php
│     │  ├─ faculty.php
│     │  ├─ layout.php
│     │  ├─ my_schedule.php
│     │  ├─ profile.php
│     │  ├─ schedule_history.php
│     │  ├─ schedule_management.php
│     │  ├─ sections.php
│     │  └─ settings.php
│     ├─ dean
│     │  ├─ activities.php
│     │  ├─ classroom.php
│     │  ├─ courses.php
│     │  ├─ curriculum.php
│     │  ├─ dashboard.php
│     │  ├─ faculty.php
│     │  ├─ layout.php
│     │  ├─ manage_schedules.php
│     │  ├─ profile.php
│     │  ├─ schedule.php
│     │  ├─ search.php
│     │  └─ settings.php
│     ├─ director
│     │  ├─ dashboard.php
│     │  ├─ layout.php
│     │  ├─ monitor.php
│     │  ├─ profile.php
│     │  ├─ schedule.php
│     │  └─ schedule_deadline.php
│     ├─ errors
│     │  └─ 403.php
│     ├─ faculty
│     │  ├─ dashboard.php
│     │  ├─ layout.php
│     │  ├─ my_schedule.php
│     │  ├─ profile.php
│     │  └─ settings.php
│     ├─ partials
│     │  ├─ chair
│     │  │  └─ sidebar.php
│     │  └─ css
│     │     └─ custome.css
│     └─ public
│        └─ home.php
├─ tailwind.config.js
├─ test_db.php
└─ vendor
   ├─ autoload.php
   ├─ composer
   │  ├─ autoload_classmap.php
   │  ├─ autoload_files.php
   │  ├─ autoload_namespaces.php
   │  ├─ autoload_psr4.php
   │  ├─ autoload_real.php
   │  ├─ autoload_static.php
   │  ├─ ClassLoader.php
   │  ├─ installed.json
   │  ├─ installed.php
   │  ├─ InstalledVersions.php
   │  ├─ LICENSE
   │  ├─ pcre
   │  │  ├─ composer.json
   │  │  ├─ extension.neon
   │  │  ├─ LICENSE
   │  │  ├─ README.md
   │  │  └─ src
   │  │     ├─ MatchAllResult.php
   │  │     ├─ MatchAllStrictGroupsResult.php
   │  │     ├─ MatchAllWithOffsetsResult.php
   │  │     ├─ MatchResult.php
   │  │     ├─ MatchStrictGroupsResult.php
   │  │     ├─ MatchWithOffsetsResult.php
   │  │     ├─ PcreException.php
   │  │     ├─ PHPStan
   │  │     │  ├─ InvalidRegexPatternRule.php
   │  │     │  ├─ PregMatchFlags.php
   │  │     │  ├─ PregMatchParameterOutTypeExtension.php
   │  │     │  ├─ PregMatchTypeSpecifyingExtension.php
   │  │     │  ├─ PregReplaceCallbackClosureTypeExtension.php
   │  │     │  └─ UnsafeStrictGroupsCallRule.php
   │  │     ├─ Preg.php
   │  │     ├─ Regex.php
   │  │     ├─ ReplaceResult.php
   │  │     └─ UnexpectedNullMatchException.php
   │  └─ platform_check.php
   ├─ graham-campbell
   │  └─ result-type
   │     ├─ composer.json
   │     ├─ LICENSE
   │     └─ src
   │        ├─ Error.php
   │        ├─ Result.php
   │        └─ Success.php
   ├─ maennchen
   │  └─ zipstream-php
   │     ├─ .editorconfig
   │     ├─ .phive
   │     │  └─ phars.xml
   │     ├─ .php-cs-fixer.dist.php
   │     ├─ .phpdoc
   │     │  └─ template
   │     │     └─ base.html.twig
   │     ├─ .tool-versions
   │     ├─ composer.json
   │     ├─ guides
   │     │  ├─ ContentLength.rst
   │     │  ├─ FlySystem.rst
   │     │  ├─ index.rst
   │     │  ├─ Nginx.rst
   │     │  ├─ Options.rst
   │     │  ├─ PSR7Streams.rst
   │     │  ├─ StreamOutput.rst
   │     │  ├─ Symfony.rst
   │     │  └─ Varnish.rst
   │     ├─ LICENSE
   │     ├─ phpdoc.dist.xml
   │     ├─ phpunit.xml.dist
   │     ├─ psalm.xml
   │     ├─ README.md
   │     ├─ src
   │     │  ├─ CentralDirectoryFileHeader.php
   │     │  ├─ CompressionMethod.php
   │     │  ├─ DataDescriptor.php
   │     │  ├─ EndOfCentralDirectory.php
   │     │  ├─ Exception
   │     │  │  ├─ DosTimeOverflowException.php
   │     │  │  ├─ FileNotFoundException.php
   │     │  │  ├─ FileNotReadableException.php
   │     │  │  ├─ FileSizeIncorrectException.php
   │     │  │  ├─ OverflowException.php
   │     │  │  ├─ ResourceActionException.php
   │     │  │  ├─ SimulationFileUnknownException.php
   │     │  │  ├─ StreamNotReadableException.php
   │     │  │  └─ StreamNotSeekableException.php
   │     │  ├─ Exception.php
   │     │  ├─ File.php
   │     │  ├─ GeneralPurposeBitFlag.php
   │     │  ├─ LocalFileHeader.php
   │     │  ├─ OperationMode.php
   │     │  ├─ PackField.php
   │     │  ├─ Time.php
   │     │  ├─ Version.php
   │     │  ├─ Zip64
   │     │  │  ├─ DataDescriptor.php
   │     │  │  ├─ EndOfCentralDirectory.php
   │     │  │  ├─ EndOfCentralDirectoryLocator.php
   │     │  │  └─ ExtendedInformationExtraField.php
   │     │  ├─ ZipStream.php
   │     │  └─ Zs
   │     │     └─ ExtendedInformationExtraField.php
   │     └─ test
   │        ├─ Assertions.php
   │        ├─ bootstrap.php
   │        ├─ CentralDirectoryFileHeaderTest.php
   │        ├─ DataDescriptorTest.php
   │        ├─ EndlessCycleStream.php
   │        ├─ EndOfCentralDirectoryTest.php
   │        ├─ FaultInjectionResource.php
   │        ├─ LocalFileHeaderTest.php
   │        ├─ PackFieldTest.php
   │        ├─ ResourceStream.php
   │        ├─ Tempfile.php
   │        ├─ TimeTest.php
   │        ├─ Util.php
   │        ├─ Zip64
   │        │  ├─ DataDescriptorTest.php
   │        │  ├─ EndOfCentralDirectoryLocatorTest.php
   │        │  ├─ EndOfCentralDirectoryTest.php
   │        │  └─ ExtendedInformationExtraFieldTest.php
   │        ├─ ZipStreamTest.php
   │        └─ Zs
   │           └─ ExtendedInformationExtraFieldTest.php
   ├─ markbaker
   │  ├─ complex
   │  │  ├─ classes
   │  │  │  └─ src
   │  │  │     ├─ Complex.php
   │  │  │     ├─ Exception.php
   │  │  │     ├─ Functions.php
   │  │  │     └─ Operations.php
   │  │  ├─ composer.json
   │  │  ├─ examples
   │  │  │  ├─ complexTest.php
   │  │  │  ├─ testFunctions.php
   │  │  │  └─ testOperations.php
   │  │  ├─ license.md
   │  │  └─ README.md
   │  └─ matrix
   │     ├─ buildPhar.php
   │     ├─ classes
   │     │  └─ src
   │     │     ├─ Builder.php
   │     │     ├─ Decomposition
   │     │     │  ├─ Decomposition.php
   │     │     │  ├─ LU.php
   │     │     │  └─ QR.php
   │     │     ├─ Div0Exception.php
   │     │     ├─ Exception.php
   │     │     ├─ Functions.php
   │     │     ├─ Matrix.php
   │     │     ├─ Operations.php
   │     │     └─ Operators
   │     │        ├─ Addition.php
   │     │        ├─ DirectSum.php
   │     │        ├─ Division.php
   │     │        ├─ Multiplication.php
   │     │        ├─ Operator.php
   │     │        └─ Subtraction.php
   │     ├─ composer.json
   │     ├─ examples
   │     │  └─ test.php
   │     ├─ infection.json.dist
   │     ├─ license.md
   │     ├─ phpstan.neon
   │     └─ README.md
   ├─ mpdf
   │  ├─ mpdf
   │  │  ├─ CHANGELOG.md
   │  │  ├─ composer.json
   │  │  ├─ CREDITS.txt
   │  │  ├─ data
   │  │  │  ├─ CJKdata.php
   │  │  │  ├─ collations
   │  │  │  │  ├─ Afrikaans_South_Africa.php
   │  │  │  │  ├─ Albanian_Albania.php
   │  │  │  │  ├─ Alsatian_France.php
   │  │  │  │  ├─ Arabic_Algeria.php
   │  │  │  │  ├─ Arabic_Bahrain.php
   │  │  │  │  ├─ Arabic_Egypt.php
   │  │  │  │  ├─ Arabic_Iraq.php
   │  │  │  │  ├─ Arabic_Jordan.php
   │  │  │  │  ├─ Arabic_Kuwait.php
   │  │  │  │  ├─ Arabic_Lebanon.php
   │  │  │  │  ├─ Arabic_Libya.php
   │  │  │  │  ├─ Arabic_Morocco.php
   │  │  │  │  ├─ Arabic_Oman.php
   │  │  │  │  ├─ Arabic_Pseudo_RTL.php
   │  │  │  │  ├─ Arabic_Qatar.php
   │  │  │  │  ├─ Arabic_Saudi_Arabia.php
   │  │  │  │  ├─ Arabic_Syria.php
   │  │  │  │  ├─ Arabic_Tunisia.php
   │  │  │  │  ├─ Arabic_Yemen.php
   │  │  │  │  ├─ Azeri_(Cyrillic)_Azerbaijan.php
   │  │  │  │  ├─ Azeri_(Latin)_Azerbaijan.php
   │  │  │  │  ├─ Bashkir_Russia.php
   │  │  │  │  ├─ Basque_Spain.php
   │  │  │  │  ├─ Belarusian_Belarus.php
   │  │  │  │  ├─ Bosnian_(Cyrillic)_Bosnia_and_Herzegovina.php
   │  │  │  │  ├─ Bosnian_(Latin)_Bosnia_and_Herzegovina.php
   │  │  │  │  ├─ Breton_France.php
   │  │  │  │  ├─ Bulgarian_Bulgaria.php
   │  │  │  │  ├─ Catalan_Spain.php
   │  │  │  │  ├─ Corsican_France.php
   │  │  │  │  ├─ Croatian_(Latin)_Bosnia_and_Herzegovina.php
   │  │  │  │  ├─ Croatian_Croatia.php
   │  │  │  │  ├─ Czech_Czech_Republic.php
   │  │  │  │  ├─ Danish_Denmark.php
   │  │  │  │  ├─ Dari_Afghanistan.php
   │  │  │  │  ├─ Dutch_Belgium.php
   │  │  │  │  ├─ Dutch_Netherlands.php
   │  │  │  │  ├─ English_Australia.php
   │  │  │  │  ├─ English_Belize.php
   │  │  │  │  ├─ English_Canada.php
   │  │  │  │  ├─ English_Caribbean.php
   │  │  │  │  ├─ English_India.php
   │  │  │  │  ├─ English_Ireland.php
   │  │  │  │  ├─ English_Jamaica.php
   │  │  │  │  ├─ English_Malaysia.php
   │  │  │  │  ├─ English_New_Zealand.php
   │  │  │  │  ├─ English_Republic_of_the_Philippines.php
   │  │  │  │  ├─ English_Singapore.php
   │  │  │  │  ├─ English_South_Africa.php
   │  │  │  │  ├─ English_Trinidad_and_Tobago.php
   │  │  │  │  ├─ English_United_Kingdom.php
   │  │  │  │  ├─ English_United_States.php
   │  │  │  │  ├─ English_Zimbabwe.php
   │  │  │  │  ├─ Estonian_Estonia.php
   │  │  │  │  ├─ Faroese_Faroe_Islands.php
   │  │  │  │  ├─ Filipino_Philippines.php
   │  │  │  │  ├─ Finnish_Finland.php
   │  │  │  │  ├─ French_Belgium.php
   │  │  │  │  ├─ French_Canada.php
   │  │  │  │  ├─ French_France.php
   │  │  │  │  ├─ French_Luxembourg.php
   │  │  │  │  ├─ French_Principality_of_Monaco.php
   │  │  │  │  ├─ French_Switzerland.php
   │  │  │  │  ├─ Frisian_Netherlands.php
   │  │  │  │  ├─ Galician_Spain.php
   │  │  │  │  ├─ German_Austria.php
   │  │  │  │  ├─ German_Germany.php
   │  │  │  │  ├─ German_Liechtenstein.php
   │  │  │  │  ├─ German_Luxembourg.php
   │  │  │  │  ├─ German_Switzerland.php
   │  │  │  │  ├─ Greek_Greece.php
   │  │  │  │  ├─ Greenlandic_Greenland.php
   │  │  │  │  ├─ Hausa_(Latin)_Nigeria.php
   │  │  │  │  ├─ Hebrew_Israel.php
   │  │  │  │  ├─ Hungarian_Hungary.php
   │  │  │  │  ├─ Icelandic_Iceland.php
   │  │  │  │  ├─ Igbo_Nigeria.php
   │  │  │  │  ├─ Indonesian_Indonesia.php
   │  │  │  │  ├─ Inuktitut_(Latin)_Canada.php
   │  │  │  │  ├─ Invariant_Language_Invariant_Country.php
   │  │  │  │  ├─ Irish_Ireland.php
   │  │  │  │  ├─ isiXhosa_South_Africa.php
   │  │  │  │  ├─ isiZulu_South_Africa.php
   │  │  │  │  ├─ Italian_Italy.php
   │  │  │  │  ├─ Italian_Switzerland.php
   │  │  │  │  ├─ Kinyarwanda_Rwanda.php
   │  │  │  │  ├─ Kiswahili_Kenya.php
   │  │  │  │  ├─ Kyrgyz_Kyrgyzstan.php
   │  │  │  │  ├─ Latvian_Latvia.php
   │  │  │  │  ├─ Lithuanian_Lithuania.php
   │  │  │  │  ├─ Lower_Sorbian_Germany.php
   │  │  │  │  ├─ Luxembourgish_Luxembourg.php
   │  │  │  │  ├─ Macedonian_(FYROM)_Macedonia_(FYROM).php
   │  │  │  │  ├─ Malay_Brunei_Darussalam.php
   │  │  │  │  ├─ Malay_Malaysia.php
   │  │  │  │  ├─ Mapudungun_Chile.php
   │  │  │  │  ├─ Mohawk_Canada.php
   │  │  │  │  ├─ Mongolian_(Cyrillic)_Mongolia.php
   │  │  │  │  ├─ Norwegian_(Nynorsk)_Norway.php
   │  │  │  │  ├─ Occitan_France.php
   │  │  │  │  ├─ Persian_Iran.php
   │  │  │  │  ├─ Polish_Poland.php
   │  │  │  │  ├─ Portuguese_Brazil.php
   │  │  │  │  ├─ Portuguese_Portugal.php
   │  │  │  │  ├─ Quechua_Bolivia.php
   │  │  │  │  ├─ Quechua_Ecuador.php
   │  │  │  │  ├─ Quechua_Peru.php
   │  │  │  │  ├─ Romanian_Romania.php
   │  │  │  │  ├─ Romansh_Switzerland.php
   │  │  │  │  ├─ Russian_Russia.php
   │  │  │  │  ├─ Sami_(Inari)_Finland.php
   │  │  │  │  ├─ Sami_(Lule)_Norway.php
   │  │  │  │  ├─ Sami_(Lule)_Sweden.php
   │  │  │  │  ├─ Sami_(Northern)_Finland.php
   │  │  │  │  ├─ Sami_(Northern)_Norway.php
   │  │  │  │  ├─ Sami_(Northern)_Sweden.php
   │  │  │  │  ├─ Sami_(Skolt)_Finland.php
   │  │  │  │  ├─ Sami_(Southern)_Norway.php
   │  │  │  │  ├─ Sami_(Southern)_Sweden.php
   │  │  │  │  ├─ Serbian_(Cyrillic)_Bosnia_and_Herzegovina.php
   │  │  │  │  ├─ Serbian_(Cyrillic)_Serbia.php
   │  │  │  │  ├─ Serbian_(Latin)_Bosnia_and_Herzegovina.php
   │  │  │  │  ├─ Serbian_(Latin)_Serbia.php
   │  │  │  │  ├─ Sesotho_sa_Leboa_South_Africa.php
   │  │  │  │  ├─ Setswana_South_Africa.php
   │  │  │  │  ├─ Slovak_Slovakia.php
   │  │  │  │  ├─ Slovenian_Slovenia.php
   │  │  │  │  ├─ Spanish_Argentina.php
   │  │  │  │  ├─ Spanish_Bolivia.php
   │  │  │  │  ├─ Spanish_Chile.php
   │  │  │  │  ├─ Spanish_Colombia.php
   │  │  │  │  ├─ Spanish_Costa_Rica.php
   │  │  │  │  ├─ Spanish_Dominican_Republic.php
   │  │  │  │  ├─ Spanish_Ecuador.php
   │  │  │  │  ├─ Spanish_El_Salvador.php
   │  │  │  │  ├─ Spanish_Guatemala.php
   │  │  │  │  ├─ Spanish_Honduras.php
   │  │  │  │  ├─ Spanish_Mexico.php
   │  │  │  │  ├─ Spanish_Nicaragua.php
   │  │  │  │  ├─ Spanish_Panama.php
   │  │  │  │  ├─ Spanish_Paraguay.php
   │  │  │  │  ├─ Spanish_Peru.php
   │  │  │  │  ├─ Spanish_Puerto_Rico.php
   │  │  │  │  ├─ Spanish_Spain.php
   │  │  │  │  ├─ Spanish_United_States.php
   │  │  │  │  ├─ Spanish_Uruguay.php
   │  │  │  │  ├─ Spanish_Venezuela.php
   │  │  │  │  ├─ Swedish_Finland.php
   │  │  │  │  ├─ Swedish_Sweden.php
   │  │  │  │  ├─ Tajik_(Cyrillic)_Tajikistan.php
   │  │  │  │  ├─ Tamazight_(Latin)_Algeria.php
   │  │  │  │  ├─ Tatar_Russia.php
   │  │  │  │  ├─ Turkish_Turkey.php
   │  │  │  │  ├─ Turkmen_Turkmenistan.php
   │  │  │  │  ├─ Ukrainian_Ukraine.php
   │  │  │  │  ├─ Upper_Sorbian_Germany.php
   │  │  │  │  ├─ Urdu_Islamic_Republic_of_Pakistan.php
   │  │  │  │  ├─ Uzbek_(Cyrillic)_Uzbekistan.php
   │  │  │  │  ├─ Uzbek_(Latin)_Uzbekistan.php
   │  │  │  │  ├─ Vietnamese_Vietnam.php
   │  │  │  │  ├─ Welsh_United_Kingdom.php
   │  │  │  │  ├─ Wolof_Senegal.php
   │  │  │  │  ├─ Yakut_Russia.php
   │  │  │  │  └─ Yoruba_Nigeria.php
   │  │  │  ├─ entity_substitutions.php
   │  │  │  ├─ font
   │  │  │  │  ├─ ccourier.php
   │  │  │  │  ├─ ccourierb.php
   │  │  │  │  ├─ ccourierbi.php
   │  │  │  │  ├─ ccourieri.php
   │  │  │  │  ├─ chelvetica.php
   │  │  │  │  ├─ chelveticab.php
   │  │  │  │  ├─ chelveticabi.php
   │  │  │  │  ├─ chelveticai.php
   │  │  │  │  ├─ csymbol.php
   │  │  │  │  ├─ ctimes.php
   │  │  │  │  ├─ ctimesb.php
   │  │  │  │  ├─ ctimesbi.php
   │  │  │  │  ├─ ctimesi.php
   │  │  │  │  └─ czapfdingbats.php
   │  │  │  ├─ iccprofiles
   │  │  │  │  └─ sRGB_IEC61966-2-1.icc
   │  │  │  ├─ lang2fonts.css
   │  │  │  ├─ linebrdictK.dat
   │  │  │  ├─ linebrdictL.dat
   │  │  │  ├─ linebrdictT.dat
   │  │  │  ├─ mpdf.css
   │  │  │  ├─ no_image.jpg
   │  │  │  ├─ out.php
   │  │  │  ├─ patterns
   │  │  │  │  ├─ de.php
   │  │  │  │  ├─ dictionary.txt
   │  │  │  │  ├─ en.php
   │  │  │  │  ├─ es.php
   │  │  │  │  ├─ fi.php
   │  │  │  │  ├─ fr.php
   │  │  │  │  ├─ it.php
   │  │  │  │  ├─ nl.php
   │  │  │  │  ├─ NOTES.txt
   │  │  │  │  ├─ pl.php
   │  │  │  │  ├─ ru.php
   │  │  │  │  └─ sv.php
   │  │  │  ├─ subs_core.php
   │  │  │  ├─ subs_win-1252.php
   │  │  │  └─ upperCase.php
   │  │  ├─ LICENSE.txt
   │  │  ├─ phpstan-baseline.neon
   │  │  ├─ phpstan.neon
   │  │  ├─ phpunit.xml
   │  │  ├─ README.md
   │  │  ├─ ruleset.xml
   │  │  ├─ src
   │  │  │  ├─ AssetFetcher.php
   │  │  │  ├─ Barcode
   │  │  │  │  ├─ AbstractBarcode.php
   │  │  │  │  ├─ BarcodeException.php
   │  │  │  │  ├─ BarcodeInterface.php
   │  │  │  │  ├─ Codabar.php
   │  │  │  │  ├─ Code11.php
   │  │  │  │  ├─ Code128.php
   │  │  │  │  ├─ Code39.php
   │  │  │  │  ├─ Code93.php
   │  │  │  │  ├─ EanExt.php
   │  │  │  │  ├─ EanUpc.php
   │  │  │  │  ├─ I25.php
   │  │  │  │  ├─ Imb.php
   │  │  │  │  ├─ Msi.php
   │  │  │  │  ├─ Postnet.php
   │  │  │  │  ├─ Rm4Scc.php
   │  │  │  │  └─ S25.php
   │  │  │  ├─ Barcode.php
   │  │  │  ├─ Cache.php
   │  │  │  ├─ Color
   │  │  │  │  ├─ ColorConverter.php
   │  │  │  │  ├─ ColorModeConverter.php
   │  │  │  │  ├─ ColorSpaceRestrictor.php
   │  │  │  │  └─ NamedColors.php
   │  │  │  ├─ Config
   │  │  │  │  ├─ ConfigVariables.php
   │  │  │  │  └─ FontVariables.php
   │  │  │  ├─ Container
   │  │  │  │  ├─ ContainerInterface.php
   │  │  │  │  ├─ NotFoundException.php
   │  │  │  │  └─ SimpleContainer.php
   │  │  │  ├─ Conversion
   │  │  │  │  ├─ DecToAlpha.php
   │  │  │  │  ├─ DecToCjk.php
   │  │  │  │  ├─ DecToHebrew.php
   │  │  │  │  ├─ DecToOther.php
   │  │  │  │  └─ DecToRoman.php
   │  │  │  ├─ Css
   │  │  │  │  ├─ Border.php
   │  │  │  │  ├─ DefaultCss.php
   │  │  │  │  └─ TextVars.php
   │  │  │  ├─ CssManager.php
   │  │  │  ├─ DirectWrite.php
   │  │  │  ├─ Exception
   │  │  │  │  ├─ AssetFetchingException.php
   │  │  │  │  ├─ FontException.php
   │  │  │  │  └─ InvalidArgumentException.php
   │  │  │  ├─ File
   │  │  │  │  ├─ LocalContentLoader.php
   │  │  │  │  ├─ LocalContentLoaderInterface.php
   │  │  │  │  └─ StreamWrapperChecker.php
   │  │  │  ├─ Fonts
   │  │  │  │  ├─ FontCache.php
   │  │  │  │  ├─ FontFileFinder.php
   │  │  │  │  ├─ GlyphOperator.php
   │  │  │  │  └─ MetricsGenerator.php
   │  │  │  ├─ Form.php
   │  │  │  ├─ FpdiTrait.php
   │  │  │  ├─ functions-dev.php
   │  │  │  ├─ functions.php
   │  │  │  ├─ Gif
   │  │  │  │  ├─ ColorTable.php
   │  │  │  │  ├─ FileHeader.php
   │  │  │  │  ├─ Gif.php
   │  │  │  │  ├─ Image.php
   │  │  │  │  ├─ ImageHeader.php
   │  │  │  │  └─ Lzw.php
   │  │  │  ├─ Gradient.php
   │  │  │  ├─ HTMLParserMode.php
   │  │  │  ├─ Http
   │  │  │  │  ├─ ClientInterface.php
   │  │  │  │  ├─ CurlHttpClient.php
   │  │  │  │  ├─ Exception
   │  │  │  │  │  ├─ ClientException.php
   │  │  │  │  │  ├─ ForbiddenRequestException.php
   │  │  │  │  │  ├─ NetworkException.php
   │  │  │  │  │  └─ RequestException.php
   │  │  │  │  └─ SocketHttpClient.php
   │  │  │  ├─ Hyphenator.php
   │  │  │  ├─ Image
   │  │  │  │  ├─ Bmp.php
   │  │  │  │  ├─ ImageProcessor.php
   │  │  │  │  ├─ ImageTypeGuesser.php
   │  │  │  │  ├─ Svg.php
   │  │  │  │  └─ Wmf.php
   │  │  │  ├─ Language
   │  │  │  │  ├─ LanguageToFont.php
   │  │  │  │  ├─ LanguageToFontInterface.php
   │  │  │  │  ├─ ScriptToLanguage.php
   │  │  │  │  └─ ScriptToLanguageInterface.php
   │  │  │  ├─ Log
   │  │  │  │  └─ Context.php
   │  │  │  ├─ Mpdf.php
   │  │  │  ├─ MpdfException.php
   │  │  │  ├─ MpdfImageException.php
   │  │  │  ├─ Otl.php
   │  │  │  ├─ OtlDump.php
   │  │  │  ├─ Output
   │  │  │  │  └─ Destination.php
   │  │  │  ├─ PageBox.php
   │  │  │  ├─ PageFormat.php
   │  │  │  ├─ Pdf
   │  │  │  │  ├─ Protection
   │  │  │  │  │  └─ UniqidGenerator.php
   │  │  │  │  └─ Protection.php
   │  │  │  ├─ ServiceFactory.php
   │  │  │  ├─ Shaper
   │  │  │  │  ├─ Indic.php
   │  │  │  │  ├─ Myanmar.php
   │  │  │  │  └─ Sea.php
   │  │  │  ├─ SizeConverter.php
   │  │  │  ├─ Strict.php
   │  │  │  ├─ TableOfContents.php
   │  │  │  ├─ Tag
   │  │  │  │  ├─ A.php
   │  │  │  │  ├─ Acronym.php
   │  │  │  │  ├─ Address.php
   │  │  │  │  ├─ Annotation.php
   │  │  │  │  ├─ Article.php
   │  │  │  │  ├─ Aside.php
   │  │  │  │  ├─ B.php
   │  │  │  │  ├─ BarCode.php
   │  │  │  │  ├─ Bdi.php
   │  │  │  │  ├─ Bdo.php
   │  │  │  │  ├─ Big.php
   │  │  │  │  ├─ BlockQuote.php
   │  │  │  │  ├─ BlockTag.php
   │  │  │  │  ├─ Bookmark.php
   │  │  │  │  ├─ Br.php
   │  │  │  │  ├─ Caption.php
   │  │  │  │  ├─ Center.php
   │  │  │  │  ├─ Cite.php
   │  │  │  │  ├─ Code.php
   │  │  │  │  ├─ ColumnBreak.php
   │  │  │  │  ├─ Columns.php
   │  │  │  │  ├─ Dd.php
   │  │  │  │  ├─ Del.php
   │  │  │  │  ├─ Details.php
   │  │  │  │  ├─ Div.php
   │  │  │  │  ├─ Dl.php
   │  │  │  │  ├─ DotTab.php
   │  │  │  │  ├─ Dt.php
   │  │  │  │  ├─ Em.php
   │  │  │  │  ├─ FieldSet.php
   │  │  │  │  ├─ FigCaption.php
   │  │  │  │  ├─ Figure.php
   │  │  │  │  ├─ Font.php
   │  │  │  │  ├─ Footer.php
   │  │  │  │  ├─ Form.php
   │  │  │  │  ├─ FormFeed.php
   │  │  │  │  ├─ H1.php
   │  │  │  │  ├─ H2.php
   │  │  │  │  ├─ H3.php
   │  │  │  │  ├─ H4.php
   │  │  │  │  ├─ H5.php
   │  │  │  │  ├─ H6.php
   │  │  │  │  ├─ Header.php
   │  │  │  │  ├─ HGroup.php
   │  │  │  │  ├─ Hr.php
   │  │  │  │  ├─ I.php
   │  │  │  │  ├─ Img.php
   │  │  │  │  ├─ IndexEntry.php
   │  │  │  │  ├─ IndexInsert.php
   │  │  │  │  ├─ InlineTag.php
   │  │  │  │  ├─ Input.php
   │  │  │  │  ├─ Ins.php
   │  │  │  │  ├─ Kbd.php
   │  │  │  │  ├─ Legend.php
   │  │  │  │  ├─ Li.php
   │  │  │  │  ├─ Main.php
   │  │  │  │  ├─ Mark.php
   │  │  │  │  ├─ Meter.php
   │  │  │  │  ├─ Nav.php
   │  │  │  │  ├─ NewColumn.php
   │  │  │  │  ├─ NewPage.php
   │  │  │  │  ├─ Ol.php
   │  │  │  │  ├─ Option.php
   │  │  │  │  ├─ P.php
   │  │  │  │  ├─ PageBreak.php
   │  │  │  │  ├─ PageFooter.php
   │  │  │  │  ├─ PageHeader.php
   │  │  │  │  ├─ Pre.php
   │  │  │  │  ├─ Progress.php
   │  │  │  │  ├─ Q.php
   │  │  │  │  ├─ S.php
   │  │  │  │  ├─ Samp.php
   │  │  │  │  ├─ Section.php
   │  │  │  │  ├─ Select.php
   │  │  │  │  ├─ SetHtmlPageFooter.php
   │  │  │  │  ├─ SetHtmlPageHeader.php
   │  │  │  │  ├─ SetPageFooter.php
   │  │  │  │  ├─ SetPageHeader.php
   │  │  │  │  ├─ Small.php
   │  │  │  │  ├─ Span.php
   │  │  │  │  ├─ Strike.php
   │  │  │  │  ├─ Strong.php
   │  │  │  │  ├─ Sub.php
   │  │  │  │  ├─ SubstituteTag.php
   │  │  │  │  ├─ Summary.php
   │  │  │  │  ├─ Sup.php
   │  │  │  │  ├─ Table.php
   │  │  │  │  ├─ Tag.php
   │  │  │  │  ├─ TBody.php
   │  │  │  │  ├─ Td.php
   │  │  │  │  ├─ TextArea.php
   │  │  │  │  ├─ TextCircle.php
   │  │  │  │  ├─ TFoot.php
   │  │  │  │  ├─ Th.php
   │  │  │  │  ├─ THead.php
   │  │  │  │  ├─ Time.php
   │  │  │  │  ├─ Toc.php
   │  │  │  │  ├─ TocEntry.php
   │  │  │  │  ├─ TocPageBreak.php
   │  │  │  │  ├─ Tr.php
   │  │  │  │  ├─ Tt.php
   │  │  │  │  ├─ Tta.php
   │  │  │  │  ├─ Tts.php
   │  │  │  │  ├─ Ttz.php
   │  │  │  │  ├─ U.php
   │  │  │  │  ├─ Ul.php
   │  │  │  │  ├─ VarTag.php
   │  │  │  │  ├─ WatermarkImage.php
   │  │  │  │  └─ WatermarkText.php
   │  │  │  ├─ Tag.php
   │  │  │  ├─ TTFontFile.php
   │  │  │  ├─ TTFontFileAnalysis.php
   │  │  │  ├─ Ucdn.php
   │  │  │  ├─ Utils
   │  │  │  │  ├─ Arrays.php
   │  │  │  │  ├─ NumericString.php
   │  │  │  │  ├─ PdfDate.php
   │  │  │  │  └─ UtfString.php
   │  │  │  ├─ Watermark.php
   │  │  │  ├─ WatermarkImage.php
   │  │  │  ├─ WatermarkText.php
   │  │  │  └─ Writer
   │  │  │     ├─ BackgroundWriter.php
   │  │  │     ├─ BaseWriter.php
   │  │  │     ├─ BookmarkWriter.php
   │  │  │     ├─ ColorWriter.php
   │  │  │     ├─ FontWriter.php
   │  │  │     ├─ FormWriter.php
   │  │  │     ├─ ImageWriter.php
   │  │  │     ├─ JavaScriptWriter.php
   │  │  │     ├─ MetadataWriter.php
   │  │  │     ├─ ObjectWriter.php
   │  │  │     ├─ OptionalContentWriter.php
   │  │  │     ├─ PageWriter.php
   │  │  │     └─ ResourceWriter.php
   │  │  ├─ tmp
   │  │  └─ ttfonts
   │  │     ├─ AboriginalSansREGULAR.ttf
   │  │     ├─ Abyssinica_SIL.ttf
   │  │     ├─ Aegean.otf
   │  │     ├─ Aegyptus.otf
   │  │     ├─ Akkadian.otf
   │  │     ├─ ayar.ttf
   │  │     ├─ damase_v.2.ttf
   │  │     ├─ DBSILBR.ttf
   │  │     ├─ DejaVuinfo.txt
   │  │     ├─ DejaVuSans-Bold.ttf
   │  │     ├─ DejaVuSans-BoldOblique.ttf
   │  │     ├─ DejaVuSans-Oblique.ttf
   │  │     ├─ DejaVuSans.ttf
   │  │     ├─ DejaVuSansCondensed-Bold.ttf
   │  │     ├─ DejaVuSansCondensed-BoldOblique.ttf
   │  │     ├─ DejaVuSansCondensed-Oblique.ttf
   │  │     ├─ DejaVuSansCondensed.ttf
   │  │     ├─ DejaVuSansMono-Bold.ttf
   │  │     ├─ DejaVuSansMono-BoldOblique.ttf
   │  │     ├─ DejaVuSansMono-Oblique.ttf
   │  │     ├─ DejaVuSansMono.ttf
   │  │     ├─ DejaVuSerif-Bold.ttf
   │  │     ├─ DejaVuSerif-BoldItalic.ttf
   │  │     ├─ DejaVuSerif-Italic.ttf
   │  │     ├─ DejaVuSerif.ttf
   │  │     ├─ DejaVuSerifCondensed-Bold.ttf
   │  │     ├─ DejaVuSerifCondensed-BoldItalic.ttf
   │  │     ├─ DejaVuSerifCondensed-Italic.ttf
   │  │     ├─ DejaVuSerifCondensed.ttf
   │  │     ├─ Dhyana-Bold.ttf
   │  │     ├─ Dhyana-Regular.ttf
   │  │     ├─ DhyanaOFL.txt
   │  │     ├─ Eeyek-Regular.ttf
   │  │     ├─ FreeMono.ttf
   │  │     ├─ FreeMonoBold.ttf
   │  │     ├─ FreeMonoBoldOblique.ttf
   │  │     ├─ FreeMonoOblique.ttf
   │  │     ├─ FreeSans.ttf
   │  │     ├─ FreeSansBold.ttf
   │  │     ├─ FreeSansBoldOblique.ttf
   │  │     ├─ FreeSansOblique.ttf
   │  │     ├─ FreeSerif.ttf
   │  │     ├─ FreeSerifBold.ttf
   │  │     ├─ FreeSerifBoldItalic.ttf
   │  │     ├─ FreeSerifItalic.ttf
   │  │     ├─ Garuda-Bold.ttf
   │  │     ├─ Garuda-BoldOblique.ttf
   │  │     ├─ Garuda-Oblique.ttf
   │  │     ├─ Garuda.ttf
   │  │     ├─ GNUFreeFontinfo.txt
   │  │     ├─ Jomolhari-OFL.txt
   │  │     ├─ Jomolhari.ttf
   │  │     ├─ kaputaunicode.ttf
   │  │     ├─ KhmerOFL.txt
   │  │     ├─ KhmerOS.ttf
   │  │     ├─ lannaalif-v1-03.ttf
   │  │     ├─ Lateef font OFL.txt
   │  │     ├─ LateefRegOT.ttf
   │  │     ├─ Lohit-Kannada.ttf
   │  │     ├─ LohitKannadaOFL.txt
   │  │     ├─ ocrb10.ttf
   │  │     ├─ ocrbinfo.txt
   │  │     ├─ Padauk-book.ttf
   │  │     ├─ Pothana2000.ttf
   │  │     ├─ Quivira.otf
   │  │     ├─ Sun-ExtA.ttf
   │  │     ├─ Sun-ExtB.ttf
   │  │     ├─ SundaneseUnicode-1.0.5.ttf
   │  │     ├─ SyrCOMEdessa.otf
   │  │     ├─ SyrCOMEdessa_license.txt
   │  │     ├─ TaameyDavidCLM-LICENSE.txt
   │  │     ├─ TaameyDavidCLM-Medium.ttf
   │  │     ├─ TaiHeritagePro.ttf
   │  │     ├─ Tharlon-Regular.ttf
   │  │     ├─ TharlonOFL.txt
   │  │     ├─ UnBatang_0613.ttf
   │  │     ├─ Uthman.otf
   │  │     ├─ XB Riyaz.ttf
   │  │     ├─ XB RiyazBd.ttf
   │  │     ├─ XB RiyazBdIt.ttf
   │  │     ├─ XB RiyazIt.ttf
   │  │     ├─ XW Zar Font Info.txt
   │  │     └─ ZawgyiOne.ttf
   │  ├─ psr-http-message-shim
   │  │  ├─ composer.json
   │  │  ├─ README.md
   │  │  └─ src
   │  │     ├─ Request.php
   │  │     ├─ Response.php
   │  │     ├─ Stream.php
   │  │     └─ Uri.php
   │  └─ psr-log-aware-trait
   │     ├─ composer.json
   │     ├─ README.md
   │     └─ src
   │        ├─ MpdfPsrLogAwareTrait.php
   │        └─ PsrLogAwareTrait.php
   ├─ myclabs
   │  └─ deep-copy
   │     ├─ composer.json
   │     ├─ LICENSE
   │     ├─ README.md
   │     └─ src
   │        └─ DeepCopy
   │           ├─ DeepCopy.php
   │           ├─ deep_copy.php
   │           ├─ Exception
   │           │  ├─ CloneException.php
   │           │  └─ PropertyException.php
   │           ├─ Filter
   │           │  ├─ ChainableFilter.php
   │           │  ├─ Doctrine
   │           │  │  ├─ DoctrineCollectionFilter.php
   │           │  │  ├─ DoctrineEmptyCollectionFilter.php
   │           │  │  └─ DoctrineProxyFilter.php
   │           │  ├─ Filter.php
   │           │  ├─ KeepFilter.php
   │           │  ├─ ReplaceFilter.php
   │           │  └─ SetNullFilter.php
   │           ├─ Matcher
   │           │  ├─ Doctrine
   │           │  │  └─ DoctrineProxyMatcher.php
   │           │  ├─ Matcher.php
   │           │  ├─ PropertyMatcher.php
   │           │  ├─ PropertyNameMatcher.php
   │           │  └─ PropertyTypeMatcher.php
   │           ├─ Reflection
   │           │  └─ ReflectionHelper.php
   │           ├─ TypeFilter
   │           │  ├─ Date
   │           │  │  ├─ DateIntervalFilter.php
   │           │  │  └─ DatePeriodFilter.php
   │           │  ├─ ReplaceFilter.php
   │           │  ├─ ShallowCopyFilter.php
   │           │  ├─ Spl
   │           │  │  ├─ ArrayObjectFilter.php
   │           │  │  ├─ SplDoublyLinkedList.php
   │           │  │  └─ SplDoublyLinkedListFilter.php
   │           │  └─ TypeFilter.php
   │           └─ TypeMatcher
   │              └─ TypeMatcher.php
   ├─ paragonie
   │  └─ random_compat
   │     ├─ build-phar.sh
   │     ├─ composer.json
   │     ├─ dist
   │     │  ├─ random_compat.phar.pubkey
   │     │  └─ random_compat.phar.pubkey.asc
   │     ├─ lib
   │     │  └─ random.php
   │     ├─ LICENSE
   │     ├─ other
   │     │  └─ build_phar.php
   │     ├─ psalm-autoload.php
   │     └─ psalm.xml
   ├─ phpmailer
   │  └─ phpmailer
   │     ├─ COMMITMENT
   │     ├─ composer.json
   │     ├─ get_oauth_token.php
   │     ├─ language
   │     │  ├─ phpmailer.lang-af.php
   │     │  ├─ phpmailer.lang-ar.php
   │     │  ├─ phpmailer.lang-as.php
   │     │  ├─ phpmailer.lang-az.php
   │     │  ├─ phpmailer.lang-ba.php
   │     │  ├─ phpmailer.lang-be.php
   │     │  ├─ phpmailer.lang-bg.php
   │     │  ├─ phpmailer.lang-bn.php
   │     │  ├─ phpmailer.lang-ca.php
   │     │  ├─ phpmailer.lang-cs.php
   │     │  ├─ phpmailer.lang-da.php
   │     │  ├─ phpmailer.lang-de.php
   │     │  ├─ phpmailer.lang-el.php
   │     │  ├─ phpmailer.lang-eo.php
   │     │  ├─ phpmailer.lang-es.php
   │     │  ├─ phpmailer.lang-et.php
   │     │  ├─ phpmailer.lang-fa.php
   │     │  ├─ phpmailer.lang-fi.php
   │     │  ├─ phpmailer.lang-fo.php
   │     │  ├─ phpmailer.lang-fr.php
   │     │  ├─ phpmailer.lang-gl.php
   │     │  ├─ phpmailer.lang-he.php
   │     │  ├─ phpmailer.lang-hi.php
   │     │  ├─ phpmailer.lang-hr.php
   │     │  ├─ phpmailer.lang-hu.php
   │     │  ├─ phpmailer.lang-hy.php
   │     │  ├─ phpmailer.lang-id.php
   │     │  ├─ phpmailer.lang-it.php
   │     │  ├─ phpmailer.lang-ja.php
   │     │  ├─ phpmailer.lang-ka.php
   │     │  ├─ phpmailer.lang-ko.php
   │     │  ├─ phpmailer.lang-ku.php
   │     │  ├─ phpmailer.lang-lt.php
   │     │  ├─ phpmailer.lang-lv.php
   │     │  ├─ phpmailer.lang-mg.php
   │     │  ├─ phpmailer.lang-mn.php
   │     │  ├─ phpmailer.lang-ms.php
   │     │  ├─ phpmailer.lang-nb.php
   │     │  ├─ phpmailer.lang-nl.php
   │     │  ├─ phpmailer.lang-pl.php
   │     │  ├─ phpmailer.lang-pt.php
   │     │  ├─ phpmailer.lang-pt_br.php
   │     │  ├─ phpmailer.lang-ro.php
   │     │  ├─ phpmailer.lang-ru.php
   │     │  ├─ phpmailer.lang-si.php
   │     │  ├─ phpmailer.lang-sk.php
   │     │  ├─ phpmailer.lang-sl.php
   │     │  ├─ phpmailer.lang-sr.php
   │     │  ├─ phpmailer.lang-sr_latn.php
   │     │  ├─ phpmailer.lang-sv.php
   │     │  ├─ phpmailer.lang-tl.php
   │     │  ├─ phpmailer.lang-tr.php
   │     │  ├─ phpmailer.lang-uk.php
   │     │  ├─ phpmailer.lang-ur.php
   │     │  ├─ phpmailer.lang-vi.php
   │     │  ├─ phpmailer.lang-zh.php
   │     │  └─ phpmailer.lang-zh_cn.php
   │     ├─ LICENSE
   │     ├─ README.md
   │     ├─ SECURITY.md
   │     ├─ SMTPUTF8.md
   │     ├─ src
   │     │  ├─ DSNConfigurator.php
   │     │  ├─ Exception.php
   │     │  ├─ OAuth.php
   │     │  ├─ OAuthTokenProvider.php
   │     │  ├─ PHPMailer.php
   │     │  ├─ POP3.php
   │     │  └─ SMTP.php
   │     └─ VERSION
   ├─ phpoffice
   │  └─ phpspreadsheet
   │     ├─ CHANGELOG.md
   │     ├─ composer.json
   │     ├─ CONTRIBUTING.md
   │     ├─ LICENSE
   │     ├─ README.md
   │     └─ src
   │        └─ PhpSpreadsheet
   │           ├─ Calculation
   │           │  ├─ ArrayEnabled.php
   │           │  ├─ BinaryComparison.php
   │           │  ├─ Calculation.php
   │           │  ├─ CalculationBase.php
   │           │  ├─ CalculationLocale.php
   │           │  ├─ Category.php
   │           │  ├─ Database
   │           │  │  ├─ DatabaseAbstract.php
   │           │  │  ├─ DAverage.php
   │           │  │  ├─ DCount.php
   │           │  │  ├─ DCountA.php
   │           │  │  ├─ DGet.php
   │           │  │  ├─ DMax.php
   │           │  │  ├─ DMin.php
   │           │  │  ├─ DProduct.php
   │           │  │  ├─ DStDev.php
   │           │  │  ├─ DStDevP.php
   │           │  │  ├─ DSum.php
   │           │  │  ├─ DVar.php
   │           │  │  └─ DVarP.php
   │           │  ├─ DateTimeExcel
   │           │  │  ├─ Constants.php
   │           │  │  ├─ Current.php
   │           │  │  ├─ Date.php
   │           │  │  ├─ DateParts.php
   │           │  │  ├─ DateValue.php
   │           │  │  ├─ Days.php
   │           │  │  ├─ Days360.php
   │           │  │  ├─ Difference.php
   │           │  │  ├─ Helpers.php
   │           │  │  ├─ Month.php
   │           │  │  ├─ NetworkDays.php
   │           │  │  ├─ Time.php
   │           │  │  ├─ TimeParts.php
   │           │  │  ├─ TimeValue.php
   │           │  │  ├─ Week.php
   │           │  │  ├─ WorkDay.php
   │           │  │  └─ YearFrac.php
   │           │  ├─ Engine
   │           │  │  ├─ ArrayArgumentHelper.php
   │           │  │  ├─ ArrayArgumentProcessor.php
   │           │  │  ├─ BranchPruner.php
   │           │  │  ├─ CyclicReferenceStack.php
   │           │  │  ├─ FormattedNumber.php
   │           │  │  ├─ Logger.php
   │           │  │  └─ Operands
   │           │  │     ├─ Operand.php
   │           │  │     └─ StructuredReference.php
   │           │  ├─ Engineering
   │           │  │  ├─ BesselI.php
   │           │  │  ├─ BesselJ.php
   │           │  │  ├─ BesselK.php
   │           │  │  ├─ BesselY.php
   │           │  │  ├─ BitWise.php
   │           │  │  ├─ Compare.php
   │           │  │  ├─ Complex.php
   │           │  │  ├─ ComplexFunctions.php
   │           │  │  ├─ ComplexOperations.php
   │           │  │  ├─ Constants.php
   │           │  │  ├─ ConvertBase.php
   │           │  │  ├─ ConvertBinary.php
   │           │  │  ├─ ConvertDecimal.php
   │           │  │  ├─ ConvertHex.php
   │           │  │  ├─ ConvertOctal.php
   │           │  │  ├─ ConvertUOM.php
   │           │  │  ├─ EngineeringValidations.php
   │           │  │  ├─ Erf.php
   │           │  │  └─ ErfC.php
   │           │  ├─ Exception.php
   │           │  ├─ ExceptionHandler.php
   │           │  ├─ Financial
   │           │  │  ├─ Amortization.php
   │           │  │  ├─ CashFlow
   │           │  │  │  ├─ CashFlowValidations.php
   │           │  │  │  ├─ Constant
   │           │  │  │  │  ├─ Periodic
   │           │  │  │  │  │  ├─ Cumulative.php
   │           │  │  │  │  │  ├─ Interest.php
   │           │  │  │  │  │  ├─ InterestAndPrincipal.php
   │           │  │  │  │  │  └─ Payments.php
   │           │  │  │  │  └─ Periodic.php
   │           │  │  │  ├─ Single.php
   │           │  │  │  └─ Variable
   │           │  │  │     ├─ NonPeriodic.php
   │           │  │  │     └─ Periodic.php
   │           │  │  ├─ Constants.php
   │           │  │  ├─ Coupons.php
   │           │  │  ├─ Depreciation.php
   │           │  │  ├─ Dollar.php
   │           │  │  ├─ FinancialValidations.php
   │           │  │  ├─ Helpers.php
   │           │  │  ├─ InterestRate.php
   │           │  │  ├─ Securities
   │           │  │  │  ├─ AccruedInterest.php
   │           │  │  │  ├─ Price.php
   │           │  │  │  ├─ Rates.php
   │           │  │  │  ├─ SecurityValidations.php
   │           │  │  │  └─ Yields.php
   │           │  │  └─ TreasuryBill.php
   │           │  ├─ FormulaParser.php
   │           │  ├─ FormulaToken.php
   │           │  ├─ FunctionArray.php
   │           │  ├─ Functions.php
   │           │  ├─ Information
   │           │  │  ├─ ErrorValue.php
   │           │  │  ├─ ExcelError.php
   │           │  │  └─ Value.php
   │           │  ├─ Internal
   │           │  │  ├─ ExcelArrayPseudoFunctions.php
   │           │  │  ├─ MakeMatrix.php
   │           │  │  └─ WildcardMatch.php
   │           │  ├─ locale
   │           │  │  ├─ bg
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ cs
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ da
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ de
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ en
   │           │  │  │  └─ uk
   │           │  │  │     └─ config
   │           │  │  ├─ es
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ fi
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ fr
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ hu
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ it
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ nb
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ nl
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ pl
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ pt
   │           │  │  │  ├─ br
   │           │  │  │  │  ├─ config
   │           │  │  │  │  └─ functions
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ ru
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ sv
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  ├─ tr
   │           │  │  │  ├─ config
   │           │  │  │  └─ functions
   │           │  │  └─ Translations.xlsx
   │           │  ├─ Logical
   │           │  │  ├─ Boolean.php
   │           │  │  ├─ Conditional.php
   │           │  │  └─ Operations.php
   │           │  ├─ LookupRef
   │           │  │  ├─ Address.php
   │           │  │  ├─ ChooseRowsEtc.php
   │           │  │  ├─ ExcelMatch.php
   │           │  │  ├─ Filter.php
   │           │  │  ├─ Formula.php
   │           │  │  ├─ Helpers.php
   │           │  │  ├─ HLookup.php
   │           │  │  ├─ Hyperlink.php
   │           │  │  ├─ Indirect.php
   │           │  │  ├─ Lookup.php
   │           │  │  ├─ LookupBase.php
   │           │  │  ├─ LookupRefValidations.php
   │           │  │  ├─ Matrix.php
   │           │  │  ├─ Offset.php
   │           │  │  ├─ RowColumnInformation.php
   │           │  │  ├─ Selection.php
   │           │  │  ├─ Sort.php
   │           │  │  ├─ Unique.php
   │           │  │  └─ VLookup.php
   │           │  ├─ MathTrig
   │           │  │  ├─ Absolute.php
   │           │  │  ├─ Angle.php
   │           │  │  ├─ Arabic.php
   │           │  │  ├─ Base.php
   │           │  │  ├─ Ceiling.php
   │           │  │  ├─ Combinations.php
   │           │  │  ├─ Exp.php
   │           │  │  ├─ Factorial.php
   │           │  │  ├─ Floor.php
   │           │  │  ├─ Gcd.php
   │           │  │  ├─ Helpers.php
   │           │  │  ├─ IntClass.php
   │           │  │  ├─ Lcm.php
   │           │  │  ├─ Logarithms.php
   │           │  │  ├─ MatrixFunctions.php
   │           │  │  ├─ Operations.php
   │           │  │  ├─ Random.php
   │           │  │  ├─ Roman.php
   │           │  │  ├─ Round.php
   │           │  │  ├─ SeriesSum.php
   │           │  │  ├─ Sign.php
   │           │  │  ├─ Sqrt.php
   │           │  │  ├─ Subtotal.php
   │           │  │  ├─ Sum.php
   │           │  │  ├─ SumSquares.php
   │           │  │  ├─ Trig
   │           │  │  │  ├─ Cosecant.php
   │           │  │  │  ├─ Cosine.php
   │           │  │  │  ├─ Cotangent.php
   │           │  │  │  ├─ Secant.php
   │           │  │  │  ├─ Sine.php
   │           │  │  │  └─ Tangent.php
   │           │  │  └─ Trunc.php
   │           │  ├─ Statistical
   │           │  │  ├─ AggregateBase.php
   │           │  │  ├─ Averages
   │           │  │  │  └─ Mean.php
   │           │  │  ├─ Averages.php
   │           │  │  ├─ Conditional.php
   │           │  │  ├─ Confidence.php
   │           │  │  ├─ Counts.php
   │           │  │  ├─ Deviations.php
   │           │  │  ├─ Distributions
   │           │  │  │  ├─ Beta.php
   │           │  │  │  ├─ Binomial.php
   │           │  │  │  ├─ ChiSquared.php
   │           │  │  │  ├─ DistributionValidations.php
   │           │  │  │  ├─ Exponential.php
   │           │  │  │  ├─ F.php
   │           │  │  │  ├─ Fisher.php
   │           │  │  │  ├─ Gamma.php
   │           │  │  │  ├─ GammaBase.php
   │           │  │  │  ├─ HyperGeometric.php
   │           │  │  │  ├─ LogNormal.php
   │           │  │  │  ├─ NewtonRaphson.php
   │           │  │  │  ├─ Normal.php
   │           │  │  │  ├─ Poisson.php
   │           │  │  │  ├─ StandardNormal.php
   │           │  │  │  ├─ StudentT.php
   │           │  │  │  └─ Weibull.php
   │           │  │  ├─ Maximum.php
   │           │  │  ├─ MaxMinBase.php
   │           │  │  ├─ Minimum.php
   │           │  │  ├─ Percentiles.php
   │           │  │  ├─ Permutations.php
   │           │  │  ├─ Size.php
   │           │  │  ├─ StandardDeviations.php
   │           │  │  ├─ Standardize.php
   │           │  │  ├─ StatisticalValidations.php
   │           │  │  ├─ Trends.php
   │           │  │  ├─ VarianceBase.php
   │           │  │  └─ Variances.php
   │           │  ├─ TextData
   │           │  │  ├─ CaseConvert.php
   │           │  │  ├─ CharacterConvert.php
   │           │  │  ├─ Concatenate.php
   │           │  │  ├─ Extract.php
   │           │  │  ├─ Format.php
   │           │  │  ├─ Helpers.php
   │           │  │  ├─ Replace.php
   │           │  │  ├─ Search.php
   │           │  │  ├─ Text.php
   │           │  │  └─ Trim.php
   │           │  ├─ Token
   │           │  │  └─ Stack.php
   │           │  └─ Web
   │           │     └─ Service.php
   │           ├─ Cell
   │           │  ├─ AddressHelper.php
   │           │  ├─ AddressRange.php
   │           │  ├─ AdvancedValueBinder.php
   │           │  ├─ Cell.php
   │           │  ├─ CellAddress.php
   │           │  ├─ CellRange.php
   │           │  ├─ ColumnRange.php
   │           │  ├─ Coordinate.php
   │           │  ├─ DataType.php
   │           │  ├─ DataValidation.php
   │           │  ├─ DataValidator.php
   │           │  ├─ DefaultValueBinder.php
   │           │  ├─ Hyperlink.php
   │           │  ├─ IgnoredErrors.php
   │           │  ├─ IValueBinder.php
   │           │  ├─ RowRange.php
   │           │  └─ StringValueBinder.php
   │           ├─ CellReferenceHelper.php
   │           ├─ Chart
   │           │  ├─ Axis.php
   │           │  ├─ AxisText.php
   │           │  ├─ Chart.php
   │           │  ├─ ChartColor.php
   │           │  ├─ DataSeries.php
   │           │  ├─ DataSeriesValues.php
   │           │  ├─ Exception.php
   │           │  ├─ GridLines.php
   │           │  ├─ Layout.php
   │           │  ├─ Legend.php
   │           │  ├─ PlotArea.php
   │           │  ├─ Properties.php
   │           │  ├─ Renderer
   │           │  │  ├─ IRenderer.php
   │           │  │  ├─ JpGraph.php
   │           │  │  ├─ JpGraphRendererBase.php
   │           │  │  ├─ MtJpGraphRenderer.php
   │           │  │  └─ PHP Charting Libraries.txt
   │           │  ├─ Title.php
   │           │  └─ TrendLine.php
   │           ├─ Collection
   │           │  ├─ Cells.php
   │           │  ├─ CellsFactory.php
   │           │  └─ Memory
   │           │     ├─ SimpleCache1.php
   │           │     └─ SimpleCache3.php
   │           ├─ Comment.php
   │           ├─ DefinedName.php
   │           ├─ Document
   │           │  ├─ Properties.php
   │           │  └─ Security.php
   │           ├─ Exception.php
   │           ├─ HashTable.php
   │           ├─ Helper
   │           │  ├─ Dimension.php
   │           │  ├─ Downloader.php
   │           │  ├─ Handler.php
   │           │  ├─ Html.php
   │           │  ├─ Sample.php
   │           │  ├─ Size.php
   │           │  └─ TextGrid.php
   │           ├─ IComparable.php
   │           ├─ IOFactory.php
   │           ├─ NamedFormula.php
   │           ├─ NamedRange.php
   │           ├─ Reader
   │           │  ├─ BaseReader.php
   │           │  ├─ Csv
   │           │  │  └─ Delimiter.php
   │           │  ├─ Csv.php
   │           │  ├─ DefaultReadFilter.php
   │           │  ├─ Exception.php
   │           │  ├─ Gnumeric
   │           │  │  ├─ PageSetup.php
   │           │  │  ├─ Properties.php
   │           │  │  └─ Styles.php
   │           │  ├─ Gnumeric.php
   │           │  ├─ Html.php
   │           │  ├─ IReader.php
   │           │  ├─ IReadFilter.php
   │           │  ├─ Ods
   │           │  │  ├─ AutoFilter.php
   │           │  │  ├─ BaseLoader.php
   │           │  │  ├─ DefinedNames.php
   │           │  │  ├─ FormulaTranslator.php
   │           │  │  ├─ PageSettings.php
   │           │  │  └─ Properties.php
   │           │  ├─ Ods.php
   │           │  ├─ Security
   │           │  │  └─ XmlScanner.php
   │           │  ├─ Slk.php
   │           │  ├─ Xls
   │           │  │  ├─ Biff5.php
   │           │  │  ├─ Biff8.php
   │           │  │  ├─ Color
   │           │  │  │  ├─ BIFF5.php
   │           │  │  │  ├─ BIFF8.php
   │           │  │  │  └─ BuiltIn.php
   │           │  │  ├─ Color.php
   │           │  │  ├─ ConditionalFormatting.php
   │           │  │  ├─ DataValidationHelper.php
   │           │  │  ├─ ErrorCode.php
   │           │  │  ├─ Escher.php
   │           │  │  ├─ ListFunctions.php
   │           │  │  ├─ LoadSpreadsheet.php
   │           │  │  ├─ Mappings.php
   │           │  │  ├─ MD5.php
   │           │  │  ├─ RC4.php
   │           │  │  └─ Style
   │           │  │     ├─ Border.php
   │           │  │     ├─ CellAlignment.php
   │           │  │     ├─ CellFont.php
   │           │  │     └─ FillPattern.php
   │           │  ├─ Xls.php
   │           │  ├─ XlsBase.php
   │           │  ├─ Xlsx
   │           │  │  ├─ AutoFilter.php
   │           │  │  ├─ BaseParserClass.php
   │           │  │  ├─ Chart.php
   │           │  │  ├─ ColumnAndRowAttributes.php
   │           │  │  ├─ ConditionalStyles.php
   │           │  │  ├─ DataValidations.php
   │           │  │  ├─ Hyperlinks.php
   │           │  │  ├─ Namespaces.php
   │           │  │  ├─ PageSetup.php
   │           │  │  ├─ Properties.php
   │           │  │  ├─ SharedFormula.php
   │           │  │  ├─ SheetViewOptions.php
   │           │  │  ├─ SheetViews.php
   │           │  │  ├─ Styles.php
   │           │  │  ├─ TableReader.php
   │           │  │  ├─ Theme.php
   │           │  │  └─ WorkbookView.php
   │           │  ├─ Xlsx.php
   │           │  ├─ Xml
   │           │  │  ├─ DataValidations.php
   │           │  │  ├─ PageSettings.php
   │           │  │  ├─ Properties.php
   │           │  │  ├─ Style
   │           │  │  │  ├─ Alignment.php
   │           │  │  │  ├─ Border.php
   │           │  │  │  ├─ Fill.php
   │           │  │  │  ├─ Font.php
   │           │  │  │  ├─ NumberFormat.php
   │           │  │  │  └─ StyleBase.php
   │           │  │  └─ Style.php
   │           │  └─ Xml.php
   │           ├─ ReferenceHelper.php
   │           ├─ RichText
   │           │  ├─ ITextElement.php
   │           │  ├─ RichText.php
   │           │  ├─ Run.php
   │           │  └─ TextElement.php
   │           ├─ Settings.php
   │           ├─ Shared
   │           │  ├─ CodePage.php
   │           │  ├─ Date.php
   │           │  ├─ Drawing.php
   │           │  ├─ Escher
   │           │  │  ├─ DgContainer
   │           │  │  │  ├─ SpgrContainer
   │           │  │  │  │  └─ SpContainer.php
   │           │  │  │  └─ SpgrContainer.php
   │           │  │  ├─ DgContainer.php
   │           │  │  ├─ DggContainer
   │           │  │  │  ├─ BstoreContainer
   │           │  │  │  │  ├─ BSE
   │           │  │  │  │  │  └─ Blip.php
   │           │  │  │  │  └─ BSE.php
   │           │  │  │  └─ BstoreContainer.php
   │           │  │  └─ DggContainer.php
   │           │  ├─ Escher.php
   │           │  ├─ File.php
   │           │  ├─ Font.php
   │           │  ├─ IntOrFloat.php
   │           │  ├─ OLE
   │           │  │  ├─ ChainedBlockStream.php
   │           │  │  ├─ PPS
   │           │  │  │  ├─ File.php
   │           │  │  │  └─ Root.php
   │           │  │  └─ PPS.php
   │           │  ├─ OLE.php
   │           │  ├─ OLERead.php
   │           │  ├─ PasswordHasher.php
   │           │  ├─ StringHelper.php
   │           │  ├─ TimeZone.php
   │           │  ├─ Trend
   │           │  │  ├─ BestFit.php
   │           │  │  ├─ ExponentialBestFit.php
   │           │  │  ├─ LinearBestFit.php
   │           │  │  ├─ LogarithmicBestFit.php
   │           │  │  ├─ PolynomialBestFit.php
   │           │  │  ├─ PowerBestFit.php
   │           │  │  └─ Trend.php
   │           │  ├─ Xls.php
   │           │  └─ XMLWriter.php
   │           ├─ Spreadsheet.php
   │           ├─ Style
   │           │  ├─ Alignment.php
   │           │  ├─ Border.php
   │           │  ├─ Borders.php
   │           │  ├─ Color.php
   │           │  ├─ Conditional.php
   │           │  ├─ ConditionalFormatting
   │           │  │  ├─ CellMatcher.php
   │           │  │  ├─ CellStyleAssessor.php
   │           │  │  ├─ ConditionalColorScale.php
   │           │  │  ├─ ConditionalDataBar.php
   │           │  │  ├─ ConditionalDataBarExtension.php
   │           │  │  ├─ ConditionalFormattingRuleExtension.php
   │           │  │  ├─ ConditionalFormatValueObject.php
   │           │  │  ├─ StyleMerger.php
   │           │  │  ├─ Wizard
   │           │  │  │  ├─ Blanks.php
   │           │  │  │  ├─ CellValue.php
   │           │  │  │  ├─ DateValue.php
   │           │  │  │  ├─ Duplicates.php
   │           │  │  │  ├─ Errors.php
   │           │  │  │  ├─ Expression.php
   │           │  │  │  ├─ TextValue.php
   │           │  │  │  ├─ WizardAbstract.php
   │           │  │  │  └─ WizardInterface.php
   │           │  │  └─ Wizard.php
   │           │  ├─ Fill.php
   │           │  ├─ Font.php
   │           │  ├─ NumberFormat
   │           │  │  ├─ BaseFormatter.php
   │           │  │  ├─ DateFormatter.php
   │           │  │  ├─ Formatter.php
   │           │  │  ├─ FractionFormatter.php
   │           │  │  ├─ NumberFormatter.php
   │           │  │  ├─ PercentageFormatter.php
   │           │  │  └─ Wizard
   │           │  │     ├─ Accounting.php
   │           │  │     ├─ Currency.php
   │           │  │     ├─ CurrencyBase.php
   │           │  │     ├─ CurrencyNegative.php
   │           │  │     ├─ Date.php
   │           │  │     ├─ DateTime.php
   │           │  │     ├─ DateTimeWizard.php
   │           │  │     ├─ Duration.php
   │           │  │     ├─ Locale.php
   │           │  │     ├─ Number.php
   │           │  │     ├─ NumberBase.php
   │           │  │     ├─ Percentage.php
   │           │  │     ├─ Scientific.php
   │           │  │     ├─ Time.php
   │           │  │     └─ Wizard.php
   │           │  ├─ NumberFormat.php
   │           │  ├─ Protection.php
   │           │  ├─ RgbTint.php
   │           │  ├─ Style.php
   │           │  └─ Supervisor.php
   │           ├─ Theme.php
   │           ├─ Worksheet
   │           │  ├─ AutoFilter
   │           │  │  ├─ Column
   │           │  │  │  └─ Rule.php
   │           │  │  └─ Column.php
   │           │  ├─ AutoFilter.php
   │           │  ├─ AutoFit.php
   │           │  ├─ BaseDrawing.php
   │           │  ├─ CellIterator.php
   │           │  ├─ Column.php
   │           │  ├─ ColumnCellIterator.php
   │           │  ├─ ColumnDimension.php
   │           │  ├─ ColumnIterator.php
   │           │  ├─ Dimension.php
   │           │  ├─ Drawing
   │           │  │  └─ Shadow.php
   │           │  ├─ Drawing.php
   │           │  ├─ HeaderFooter.php
   │           │  ├─ HeaderFooterDrawing.php
   │           │  ├─ Iterator.php
   │           │  ├─ MemoryDrawing.php
   │           │  ├─ PageBreak.php
   │           │  ├─ PageMargins.php
   │           │  ├─ PageSetup.php
   │           │  ├─ Pane.php
   │           │  ├─ ProtectedRange.php
   │           │  ├─ Protection.php
   │           │  ├─ Row.php
   │           │  ├─ RowCellIterator.php
   │           │  ├─ RowDimension.php
   │           │  ├─ RowIterator.php
   │           │  ├─ SheetView.php
   │           │  ├─ Table
   │           │  │  ├─ Column.php
   │           │  │  ├─ TableDxfsStyle.php
   │           │  │  └─ TableStyle.php
   │           │  ├─ Table.php
   │           │  ├─ Validations.php
   │           │  └─ Worksheet.php
   │           └─ Writer
   │              ├─ BaseWriter.php
   │              ├─ Csv.php
   │              ├─ Exception.php
   │              ├─ Html.php
   │              ├─ IWriter.php
   │              ├─ Ods
   │              │  ├─ AutoFilters.php
   │              │  ├─ Cell
   │              │  │  ├─ Comment.php
   │              │  │  └─ Style.php
   │              │  ├─ Content.php
   │              │  ├─ Formula.php
   │              │  ├─ Meta.php
   │              │  ├─ MetaInf.php
   │              │  ├─ Mimetype.php
   │              │  ├─ NamedExpressions.php
   │              │  ├─ Settings.php
   │              │  ├─ Styles.php
   │              │  ├─ Thumbnails.php
   │              │  └─ WriterPart.php
   │              ├─ Ods.php
   │              ├─ Pdf
   │              │  ├─ Dompdf.php
   │              │  ├─ Mpdf.php
   │              │  └─ Tcpdf.php
   │              ├─ Pdf.php
   │              ├─ Xls
   │              │  ├─ BIFFwriter.php
   │              │  ├─ CellDataValidation.php
   │              │  ├─ ConditionalHelper.php
   │              │  ├─ ErrorCode.php
   │              │  ├─ Escher.php
   │              │  ├─ Font.php
   │              │  ├─ Parser.php
   │              │  ├─ Style
   │              │  │  ├─ CellAlignment.php
   │              │  │  ├─ CellBorder.php
   │              │  │  └─ CellFill.php
   │              │  ├─ Workbook.php
   │              │  ├─ Worksheet.php
   │              │  └─ Xf.php
   │              ├─ Xls.php
   │              ├─ Xlsx
   │              │  ├─ AutoFilter.php
   │              │  ├─ Chart.php
   │              │  ├─ Comments.php
   │              │  ├─ ContentTypes.php
   │              │  ├─ DefinedNames.php
   │              │  ├─ DocProps.php
   │              │  ├─ Drawing.php
   │              │  ├─ FunctionPrefix.php
   │              │  ├─ Metadata.php
   │              │  ├─ Rels.php
   │              │  ├─ RelsRibbon.php
   │              │  ├─ RelsVBA.php
   │              │  ├─ StringTable.php
   │              │  ├─ Style.php
   │              │  ├─ Table.php
   │              │  ├─ Theme.php
   │              │  ├─ Workbook.php
   │              │  ├─ Worksheet.php
   │              │  └─ WriterPart.php
   │              ├─ Xlsx.php
   │              ├─ ZipStream0.php
   │              ├─ ZipStream2.php
   │              └─ ZipStream3.php
   ├─ phpoption
   │  └─ phpoption
   │     ├─ composer.json
   │     ├─ LICENSE
   │     └─ src
   │        └─ PhpOption
   │           ├─ LazyOption.php
   │           ├─ None.php
   │           ├─ Option.php
   │           └─ Some.php
   ├─ psr
   │  ├─ http-client
   │  │  ├─ CHANGELOG.md
   │  │  ├─ composer.json
   │  │  ├─ LICENSE
   │  │  ├─ README.md
   │  │  └─ src
   │  │     ├─ ClientExceptionInterface.php
   │  │     ├─ ClientInterface.php
   │  │     ├─ NetworkExceptionInterface.php
   │  │     └─ RequestExceptionInterface.php
   │  ├─ http-factory
   │  │  ├─ composer.json
   │  │  ├─ LICENSE
   │  │  ├─ README.md
   │  │  └─ src
   │  │     ├─ RequestFactoryInterface.php
   │  │     ├─ ResponseFactoryInterface.php
   │  │     ├─ ServerRequestFactoryInterface.php
   │  │     ├─ StreamFactoryInterface.php
   │  │     ├─ UploadedFileFactoryInterface.php
   │  │     └─ UriFactoryInterface.php
   │  ├─ http-message
   │  │  ├─ CHANGELOG.md
   │  │  ├─ composer.json
   │  │  ├─ docs
   │  │  │  ├─ PSR7-Interfaces.md
   │  │  │  └─ PSR7-Usage.md
   │  │  ├─ LICENSE
   │  │  ├─ README.md
   │  │  └─ src
   │  │     ├─ MessageInterface.php
   │  │     ├─ RequestInterface.php
   │  │     ├─ ResponseInterface.php
   │  │     ├─ ServerRequestInterface.php
   │  │     ├─ StreamInterface.php
   │  │     ├─ UploadedFileInterface.php
   │  │     └─ UriInterface.php
   │  ├─ log
   │  │  ├─ composer.json
   │  │  ├─ LICENSE
   │  │  ├─ README.md
   │  │  └─ src
   │  │     ├─ AbstractLogger.php
   │  │     ├─ InvalidArgumentException.php
   │  │     ├─ LoggerAwareInterface.php
   │  │     ├─ LoggerAwareTrait.php
   │  │     ├─ LoggerInterface.php
   │  │     ├─ LoggerTrait.php
   │  │     ├─ LogLevel.php
   │  │     └─ NullLogger.php
   │  └─ simple-cache
   │     ├─ .editorconfig
   │     ├─ composer.json
   │     ├─ LICENSE.md
   │     ├─ README.md
   │     └─ src
   │        ├─ CacheException.php
   │        ├─ CacheInterface.php
   │        └─ InvalidArgumentException.php
   ├─ setasign
   │  ├─ fpdi
   │  │  ├─ composer.json
   │  │  ├─ LICENSE.txt
   │  │  ├─ README.md
   │  │  ├─ SECURITY.md
   │  │  └─ src
   │  │     ├─ autoload.php
   │  │     ├─ FpdfTpl.php
   │  │     ├─ FpdfTplTrait.php
   │  │     ├─ FpdfTrait.php
   │  │     ├─ Fpdi.php
   │  │     ├─ FpdiException.php
   │  │     ├─ FpdiTrait.php
   │  │     ├─ GraphicsState.php
   │  │     ├─ Math
   │  │     │  ├─ Matrix.php
   │  │     │  └─ Vector.php
   │  │     ├─ PdfParser
   │  │     │  ├─ CrossReference
   │  │     │  │  ├─ AbstractReader.php
   │  │     │  │  ├─ CrossReference.php
   │  │     │  │  ├─ CrossReferenceException.php
   │  │     │  │  ├─ FixedReader.php
   │  │     │  │  ├─ LineReader.php
   │  │     │  │  └─ ReaderInterface.php
   │  │     │  ├─ Filter
   │  │     │  │  ├─ Ascii85.php
   │  │     │  │  ├─ Ascii85Exception.php
   │  │     │  │  ├─ AsciiHex.php
   │  │     │  │  ├─ FilterException.php
   │  │     │  │  ├─ FilterInterface.php
   │  │     │  │  ├─ Flate.php
   │  │     │  │  ├─ FlateException.php
   │  │     │  │  ├─ Lzw.php
   │  │     │  │  └─ LzwException.php
   │  │     │  ├─ PdfParser.php
   │  │     │  ├─ PdfParserException.php
   │  │     │  ├─ StreamReader.php
   │  │     │  ├─ Tokenizer.php
   │  │     │  └─ Type
   │  │     │     ├─ PdfArray.php
   │  │     │     ├─ PdfBoolean.php
   │  │     │     ├─ PdfDictionary.php
   │  │     │     ├─ PdfHexString.php
   │  │     │     ├─ PdfIndirectObject.php
   │  │     │     ├─ PdfIndirectObjectReference.php
   │  │     │     ├─ PdfName.php
   │  │     │     ├─ PdfNull.php
   │  │     │     ├─ PdfNumeric.php
   │  │     │     ├─ PdfStream.php
   │  │     │     ├─ PdfString.php
   │  │     │     ├─ PdfToken.php
   │  │     │     ├─ PdfType.php
   │  │     │     └─ PdfTypeException.php
   │  │     ├─ PdfReader
   │  │     │  ├─ DataStructure
   │  │     │  │  └─ Rectangle.php
   │  │     │  ├─ Page.php
   │  │     │  ├─ PageBoundaries.php
   │  │     │  ├─ PdfReader.php
   │  │     │  └─ PdfReaderException.php
   │  │     ├─ Tcpdf
   │  │     │  └─ Fpdi.php
   │  │     ├─ TcpdfFpdi.php
   │  │     └─ Tfpdf
   │  │        ├─ FpdfTpl.php
   │  │        └─ Fpdi.php
   │  └─ fpdi-tcpdf
   │     ├─ composer.json
   │     ├─ LICENSE.txt
   │     └─ README.md
   ├─ symfony
   │  ├─ polyfill-ctype
   │  │  ├─ bootstrap.php
   │  │  ├─ bootstrap80.php
   │  │  ├─ composer.json
   │  │  ├─ Ctype.php
   │  │  ├─ LICENSE
   │  │  └─ README.md
   │  ├─ polyfill-mbstring
   │  │  ├─ bootstrap.php
   │  │  ├─ bootstrap80.php
   │  │  ├─ composer.json
   │  │  ├─ LICENSE
   │  │  ├─ Mbstring.php
   │  │  ├─ README.md
   │  │  └─ Resources
   │  │     └─ unidata
   │  │        ├─ caseFolding.php
   │  │        ├─ lowerCase.php
   │  │        ├─ titleCaseRegexp.php
   │  │        └─ upperCase.php
   │  └─ polyfill-php80
   │     ├─ bootstrap.php
   │     ├─ composer.json
   │     ├─ LICENSE
   │     ├─ Php80.php
   │     ├─ PhpToken.php
   │     ├─ README.md
   │     └─ Resources
   │        └─ stubs
   │           ├─ Attribute.php
   │           ├─ PhpToken.php
   │           ├─ Stringable.php
   │           ├─ UnhandledMatchError.php
   │           └─ ValueError.php
   ├─ tecnickcom
   │  └─ tcpdf
   │     ├─ CHANGELOG.TXT
   │     ├─ composer.json
   │     ├─ config
   │     │  └─ tcpdf_config.php
   │     ├─ fonts
   │     │  ├─ aealarabiya.ctg.z
   │     │  ├─ aealarabiya.php
   │     │  ├─ aealarabiya.z
   │     │  ├─ aefurat.ctg.z
   │     │  ├─ aefurat.php
   │     │  ├─ aefurat.z
   │     │  ├─ ae_fonts_2.0
   │     │  │  ├─ ChangeLog
   │     │  │  ├─ COPYING
   │     │  │  └─ README
   │     │  ├─ cid0cs.php
   │     │  ├─ cid0ct.php
   │     │  ├─ cid0jp.php
   │     │  ├─ cid0kr.php
   │     │  ├─ courier.php
   │     │  ├─ courierb.php
   │     │  ├─ courierbi.php
   │     │  ├─ courieri.php
   │     │  ├─ dejavu-fonts-ttf-2.33
   │     │  │  ├─ AUTHORS
   │     │  │  ├─ BUGS
   │     │  │  ├─ langcover.txt
   │     │  │  ├─ LICENSE
   │     │  │  ├─ NEWS
   │     │  │  ├─ README
   │     │  │  └─ unicover.txt
   │     │  ├─ dejavu-fonts-ttf-2.34
   │     │  │  ├─ AUTHORS
   │     │  │  ├─ BUGS
   │     │  │  ├─ langcover.txt
   │     │  │  ├─ LICENSE
   │     │  │  ├─ NEWS
   │     │  │  ├─ README
   │     │  │  └─ unicover.txt
   │     │  ├─ dejavusans.ctg.z
   │     │  ├─ dejavusans.php
   │     │  ├─ dejavusans.z
   │     │  ├─ dejavusansb.ctg.z
   │     │  ├─ dejavusansb.php
   │     │  ├─ dejavusansb.z
   │     │  ├─ dejavusansbi.ctg.z
   │     │  ├─ dejavusansbi.php
   │     │  ├─ dejavusansbi.z
   │     │  ├─ dejavusanscondensed.ctg.z
   │     │  ├─ dejavusanscondensed.php
   │     │  ├─ dejavusanscondensed.z
   │     │  ├─ dejavusanscondensedb.ctg.z
   │     │  ├─ dejavusanscondensedb.php
   │     │  ├─ dejavusanscondensedb.z
   │     │  ├─ dejavusanscondensedbi.ctg.z
   │     │  ├─ dejavusanscondensedbi.php
   │     │  ├─ dejavusanscondensedbi.z
   │     │  ├─ dejavusanscondensedi.ctg.z
   │     │  ├─ dejavusanscondensedi.php
   │     │  ├─ dejavusanscondensedi.z
   │     │  ├─ dejavusansextralight.ctg.z
   │     │  ├─ dejavusansextralight.php
   │     │  ├─ dejavusansextralight.z
   │     │  ├─ dejavusansi.ctg.z
   │     │  ├─ dejavusansi.php
   │     │  ├─ dejavusansi.z
   │     │  ├─ dejavusansmono.ctg.z
   │     │  ├─ dejavusansmono.php
   │     │  ├─ dejavusansmono.z
   │     │  ├─ dejavusansmonob.ctg.z
   │     │  ├─ dejavusansmonob.php
   │     │  ├─ dejavusansmonob.z
   │     │  ├─ dejavusansmonobi.ctg.z
   │     │  ├─ dejavusansmonobi.php
   │     │  ├─ dejavusansmonobi.z
   │     │  ├─ dejavusansmonoi.ctg.z
   │     │  ├─ dejavusansmonoi.php
   │     │  ├─ dejavusansmonoi.z
   │     │  ├─ dejavuserif.ctg.z
   │     │  ├─ dejavuserif.php
   │     │  ├─ dejavuserif.z
   │     │  ├─ dejavuserifb.ctg.z
   │     │  ├─ dejavuserifb.php
   │     │  ├─ dejavuserifb.z
   │     │  ├─ dejavuserifbi.ctg.z
   │     │  ├─ dejavuserifbi.php
   │     │  ├─ dejavuserifbi.z
   │     │  ├─ dejavuserifcondensed.ctg.z
   │     │  ├─ dejavuserifcondensed.php
   │     │  ├─ dejavuserifcondensed.z
   │     │  ├─ dejavuserifcondensedb.ctg.z
   │     │  ├─ dejavuserifcondensedb.php
   │     │  ├─ dejavuserifcondensedb.z
   │     │  ├─ dejavuserifcondensedbi.ctg.z
   │     │  ├─ dejavuserifcondensedbi.php
   │     │  ├─ dejavuserifcondensedbi.z
   │     │  ├─ dejavuserifcondensedi.ctg.z
   │     │  ├─ dejavuserifcondensedi.php
   │     │  ├─ dejavuserifcondensedi.z
   │     │  ├─ dejavuserifi.ctg.z
   │     │  ├─ dejavuserifi.php
   │     │  ├─ dejavuserifi.z
   │     │  ├─ freefont-20100919
   │     │  │  ├─ AUTHORS
   │     │  │  ├─ ChangeLog
   │     │  │  ├─ COPYING
   │     │  │  ├─ CREDITS
   │     │  │  ├─ INSTALL
   │     │  │  └─ README
   │     │  ├─ freefont-20120503
   │     │  │  ├─ AUTHORS
   │     │  │  ├─ ChangeLog
   │     │  │  ├─ COPYING
   │     │  │  ├─ CREDITS
   │     │  │  ├─ INSTALL
   │     │  │  ├─ README
   │     │  │  ├─ TROUBLESHOOTING
   │     │  │  └─ USAGE
   │     │  ├─ freemono.ctg.z
   │     │  ├─ freemono.php
   │     │  ├─ freemono.z
   │     │  ├─ freemonob.ctg.z
   │     │  ├─ freemonob.php
   │     │  ├─ freemonob.z
   │     │  ├─ freemonobi.ctg.z
   │     │  ├─ freemonobi.php
   │     │  ├─ freemonobi.z
   │     │  ├─ freemonoi.ctg.z
   │     │  ├─ freemonoi.php
   │     │  ├─ freemonoi.z
   │     │  ├─ freesans.ctg.z
   │     │  ├─ freesans.php
   │     │  ├─ freesans.z
   │     │  ├─ freesansb.ctg.z
   │     │  ├─ freesansb.php
   │     │  ├─ freesansb.z
   │     │  ├─ freesansbi.ctg.z
   │     │  ├─ freesansbi.php
   │     │  ├─ freesansbi.z
   │     │  ├─ freesansi.ctg.z
   │     │  ├─ freesansi.php
   │     │  ├─ freesansi.z
   │     │  ├─ freeserif.ctg.z
   │     │  ├─ freeserif.php
   │     │  ├─ freeserif.z
   │     │  ├─ freeserifb.ctg.z
   │     │  ├─ freeserifb.php
   │     │  ├─ freeserifb.z
   │     │  ├─ freeserifbi.ctg.z
   │     │  ├─ freeserifbi.php
   │     │  ├─ freeserifbi.z
   │     │  ├─ freeserifi.ctg.z
   │     │  ├─ freeserifi.php
   │     │  ├─ freeserifi.z
   │     │  ├─ helvetica.php
   │     │  ├─ helveticab.php
   │     │  ├─ helveticabi.php
   │     │  ├─ helveticai.php
   │     │  ├─ hysmyeongjostdmedium.php
   │     │  ├─ kozgopromedium.php
   │     │  ├─ kozminproregular.php
   │     │  ├─ msungstdlight.php
   │     │  ├─ pdfacourier.php
   │     │  ├─ pdfacourier.z
   │     │  ├─ pdfacourierb.php
   │     │  ├─ pdfacourierb.z
   │     │  ├─ pdfacourierbi.php
   │     │  ├─ pdfacourierbi.z
   │     │  ├─ pdfacourieri.php
   │     │  ├─ pdfacourieri.z
   │     │  ├─ pdfahelvetica.php
   │     │  ├─ pdfahelvetica.z
   │     │  ├─ pdfahelveticab.php
   │     │  ├─ pdfahelveticab.z
   │     │  ├─ pdfahelveticabi.php
   │     │  ├─ pdfahelveticabi.z
   │     │  ├─ pdfahelveticai.php
   │     │  ├─ pdfahelveticai.z
   │     │  ├─ pdfasymbol.php
   │     │  ├─ pdfasymbol.z
   │     │  ├─ pdfatimes.php
   │     │  ├─ pdfatimes.z
   │     │  ├─ pdfatimesb.php
   │     │  ├─ pdfatimesb.z
   │     │  ├─ pdfatimesbi.php
   │     │  ├─ pdfatimesbi.z
   │     │  ├─ pdfatimesi.php
   │     │  ├─ pdfatimesi.z
   │     │  ├─ pdfazapfdingbats.php
   │     │  ├─ pdfazapfdingbats.z
   │     │  ├─ stsongstdlight.php
   │     │  ├─ symbol.php
   │     │  ├─ times.php
   │     │  ├─ timesb.php
   │     │  ├─ timesbi.php
   │     │  ├─ timesi.php
   │     │  ├─ uni2cid_ac15.php
   │     │  ├─ uni2cid_ag15.php
   │     │  ├─ uni2cid_aj16.php
   │     │  ├─ uni2cid_ak12.php
   │     │  └─ zapfdingbats.php
   │     ├─ include
   │     │  ├─ barcodes
   │     │  │  ├─ datamatrix.php
   │     │  │  ├─ pdf417.php
   │     │  │  └─ qrcode.php
   │     │  ├─ sRGB.icc
   │     │  ├─ tcpdf_colors.php
   │     │  ├─ tcpdf_filters.php
   │     │  ├─ tcpdf_fonts.php
   │     │  ├─ tcpdf_font_data.php
   │     │  ├─ tcpdf_images.php
   │     │  └─ tcpdf_static.php
   │     ├─ LICENSE.TXT
   │     ├─ README.md
   │     ├─ tcpdf.php
   │     ├─ tcpdf_autoconfig.php
   │     ├─ tcpdf_barcodes_1d.php
   │     ├─ tcpdf_barcodes_2d.php
   │     ├─ tools
   │     │  ├─ .htaccess
   │     │  ├─ convert_fonts_examples.txt
   │     │  └─ tcpdf_addfont.php
   │     └─ VERSION
   └─ vlucas
      └─ phpdotenv
         ├─ composer.json
         ├─ LICENSE
         └─ src
            ├─ Dotenv.php
            ├─ Exception
            │  ├─ ExceptionInterface.php
            │  ├─ InvalidEncodingException.php
            │  ├─ InvalidFileException.php
            │  ├─ InvalidPathException.php
            │  └─ ValidationException.php
            ├─ Loader
            │  ├─ Loader.php
            │  ├─ LoaderInterface.php
            │  └─ Resolver.php
            ├─ Parser
            │  ├─ Entry.php
            │  ├─ EntryParser.php
            │  ├─ Lexer.php
            │  ├─ Lines.php
            │  ├─ Parser.php
            │  ├─ ParserInterface.php
            │  └─ Value.php
            ├─ Repository
            │  ├─ Adapter
            │  │  ├─ AdapterInterface.php
            │  │  ├─ ApacheAdapter.php
            │  │  ├─ ArrayAdapter.php
            │  │  ├─ EnvConstAdapter.php
            │  │  ├─ GuardedWriter.php
            │  │  ├─ ImmutableWriter.php
            │  │  ├─ MultiReader.php
            │  │  ├─ MultiWriter.php
            │  │  ├─ PutenvAdapter.php
            │  │  ├─ ReaderInterface.php
            │  │  ├─ ReplacingWriter.php
            │  │  ├─ ServerConstAdapter.php
            │  │  └─ WriterInterface.php
            │  ├─ AdapterRepository.php
            │  ├─ RepositoryBuilder.php
            │  └─ RepositoryInterface.php
            ├─ Store
            │  ├─ File
            │  │  ├─ Paths.php
            │  │  └─ Reader.php
            │  ├─ FileStore.php
            │  ├─ StoreBuilder.php
            │  ├─ StoreInterface.php
            │  └─ StringStore.php
            ├─ Util
            │  ├─ Regex.php
            │  └─ Str.php
            └─ Validator.php

```