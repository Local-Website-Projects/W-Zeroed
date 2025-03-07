<header id="header" class="header relative">
    <div class="header_inner absolute flex items-center justify-between top-0 left-0 right-0 z-[1] w-full sm:h-20 h-16 min-[1600px]:px-15 lg:px-9 px-4 border-b border-light">
        <div class="left flex items-center gap-15 max-[1600px]:gap-6 h-full">
            <h1>
                <a href="Home">
                    <img src="assets/images/logo-white.png" alt="logo-white" class="logo-white md:h-[42px] h-8 w-auto" />
                    <img src="assets/images/logo.png" alt="logo" class="logo-black md:h-[42px] h-8 w-auto hidden" />
                </a>
            </h1>
            <!--<div class="category_block flex items-center relative h-full">
                <button class="category_btn max-2xl:hidden flex items-center gap-1 px-3 py-2 rounded-lg bg-light text-white duration-300">
                    <span class="ph ph-stack text-2xl text-primary"></span>
                    <span>Categories</span>
                </button>
                <div class="category_nav flex">
                    <ul class="category_list flex-shrink-0 w-[300px] h-full py-5 border-r border-line" role="tablist">
                        <li class="category_item w-full">
                            <button class="category_link tab_btn flex items-center gap-3 w-full px-7 py-4 duration-300 active" id="category_tab01" role="tab" aria-controls="category_01" aria-selected="true">
                                <span class="ph-fill ph-desktop text-2xl"></span>
                                <strong class="category_name text-title">Graphic & Design</strong>
                            </button>
                        </li>
                        <li class="category_item w-full">
                            <button class="category_link tab_btn flex items-center gap-3 w-full px-7 py-4 duration-300" id="category_tab02" role="tab" aria-controls="category_02" aria-selected="false">
                                <span class="ph-fill ph-megaphone-simple text-2xl"></span>
                                <strong class="category_name text-title">Digital Marketing</strong>
                            </button>
                        </li>
                        <li class="category_item w-full">
                            <button class="category_link tab_btn flex items-center gap-3 w-full px-7 py-4 duration-300" id="category_tab03" role="tab" aria-controls="category_03" aria-selected="false">
                                <span class="ph-fill ph-brackets-angle text-2xl"></span>
                                <strong class="category_name text-title">Programming & Tech</strong>
                            </button>
                        </li>
                        <li class="category_item w-full">
                            <button class="category_link tab_btn flex items-center gap-3 w-full px-7 py-4 duration-300" id="category_tab04" role="tab" aria-controls="category_04" aria-selected="false">
                                <span class="ph-fill ph-pencil-simple-line text-2xl"></span>
                                <strong class="category_name text-title">Wrting & Translation</strong>
                            </button>
                        </li>
                        <li class="category_item w-full">
                            <button class="category_link tab_btn flex items-center gap-3 w-full px-7 py-4 duration-300" id="category_tab05" role="tab" aria-controls="category_05" aria-selected="false">
                                <span class="ph-fill ph-video text-2xl"></span>
                                <strong class="category_name text-title">Videos & Animation</strong>
                            </button>
                        </li>
                        <li class="category_item w-full">
                            <button class="category_link tab_btn flex items-center gap-3 w-full px-7 py-4 duration-300" id="category_tab06" role="tab" aria-controls="category_06" aria-selected="false">
                                <span class="ph-fill ph-music-notes text-2xl"></span>
                                <strong class="category_name text-title">Mussic & Audio</strong>
                            </button>
                        </li>
                        <li class="category_item w-full">
                            <button class="category_link tab_btn flex items-center gap-3 w-full px-7 py-4 duration-300" id="category_tab07" role="tab" aria-controls="category_07" aria-selected="false">
                                <span class="ph-fill ph-head-circuit text-2xl"></span>
                                <strong class="category_name text-title">AI Services</strong>
                            </button>
                        </li>
                        <li class="category_item w-full">
                            <button class="category_link tab_btn flex items-center gap-3 w-full px-7 py-4 duration-300" id="category_tab08" role="tab" aria-controls="category_08" aria-selected="false">
                                <span class="ph-fill ph-camera text-2xl"></span>
                                <strong class="category_name text-title">Photography</strong>
                            </button>
                        </li>
                    </ul>
                    <div id="category_01" class="category_list_detail tab_list grid grid-cols-4 gap-y-10 w-full h-fit py-8 px-10 active" role="tabpanel" aria-labelledby="category_tab01" aria-hidden="false">
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Websites</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Website Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Website Maintenance</a>
                            <a href="#" class="w-fit caption1 line-before line-black">WordPress</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Shopify</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Application</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Web Applications</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Game Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Chatbot Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Desktop Applications</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Software</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Software Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">APIs & Integrations</a>
                            <a href="#" class="w-fit caption1 line-before line-black">AI Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Plugins Development</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Mobile Apps</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Mobile App Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Cross-platform Apps</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Android App Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">IOS App Development</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Website Platforms</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Wix</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Webflow</a>
                            <a href="#" class="w-fit caption1 line-before line-black">GoDaddy</a>
                            <a href="#" class="w-fit caption1 line-before line-black">WooCommerce</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">cybersecurity</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Support & IT</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Cloud Computing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">DevOps Engineering</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Cybersecurity</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Miscellaneous</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Blockchain & Solutions</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Cryptocurrencies</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Electronics Engineering</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Online Coding Lessons</a>
                        </div>
                    </div>
                    <div id="category_02" class="category_list_detail tab_list grid grid-cols-4 gap-y-10 w-full h-fit py-8 px-10" role="tabpanel" aria-labelledby="category_tab02" aria-hidden="true">
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">SEO</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">On-Page SEO</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Off-Page SEO</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Technical SEO</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Local SEO</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Content Marketing</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Content Strategy</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Blog Writing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Video Content</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Infographic Design</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Social Media Marketing</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Facebook Marketing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Instagram Marketing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">LinkedIn Marketing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Twitter Marketing</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Email Marketing</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Email Campaigns</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Newsletter Design</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Automation</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Drip Campaigns</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Paid Advertising</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Google Ads</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Facebook Ads</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Instagram Ads</a>
                            <a href="#" class="w-fit caption1 line-before line-black">LinkedIn Ads</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Analytics</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Google Analytics</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Conversion Tracking</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Data Analysis</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Reporting</a>
                        </div>
                    </div>
                    <div id="category_03" class="category_list_detail tab_list grid grid-cols-4 gap-y-10 w-full h-fit py-8 px-10" role="tabpanel" aria-labelledby="category_tab03" aria-hidden="true">
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Web Development</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Website Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Website Maintenance</a>
                            <a href="#" class="w-fit caption1 line-before line-black">WordPress</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Shopify</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Mobile Development</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Mobile App Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Cross-platform Apps</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Android App Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">iOS App Development</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Software Development</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Software Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">APIs & Integrations</a>
                            <a href="#" class="w-fit caption1 line-before line-black">AI Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Plugins Development</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Game Development</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Game Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Game Design</a>
                            <a href="#" class="w-fit caption1 line-before line-black">AR/VR Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Mobile Game Development</a>
                        </div>
                    </div>
                    <div id="category_04" class="category_list_detail tab_list grid grid-cols-4 gap-y-10 w-full h-fit py-8 px-10" role="tabpanel" aria-labelledby="category_tab04" aria-hidden="true">
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Articles & Blog Posts</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">SEO Writing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Blog Posts</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Website Content</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Article Writing</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Technical Writing</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">User Manuals</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Technical Documentation</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Research Papers</a>
                            <a href="#" class="w-fit caption1 line-before line-black">White Papers</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Translation Services</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Document Translation</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Website Translation</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Legal Translation</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Medical Translation</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Creative Writing</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Scriptwriting</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Storytelling</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Poetry</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Ghostwriting</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Editing & Proofreading</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Proofreading</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Copy Editing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Content Editing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Editorial Feedback</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Business Writing</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Business Plans</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Proposals</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Reports</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Presentations</a>
                        </div>
                    </div>
                    <div id="category_05" class="category_list_detail tab_list grid grid-cols-4 gap-y-10 w-full h-fit py-8 px-10" role="tabpanel" aria-labelledby="category_tab05" aria-hidden="true">
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Video Editing</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Post-Production</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Color Correction</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Video Stitching</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Sound Design</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Animation</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">2D Animation</a>
                            <a href="#" class="w-fit caption1 line-before line-black">3D Animation</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Motion Graphics</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Stop Motion</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Video Production</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Filming</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Directing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Scriptwriting</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Storyboarding</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Music Videos</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Concept Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Filming & Editing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Special Effects</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Color Grading</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Intros & Outros</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">YouTube Intros</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Logo Animation</a>
                            <a href="#" class="w-fit caption1 line-before line-black">End Screens</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Channel Trailers</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Live Action</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Explainer Videos</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Commercials</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Product Demos</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Corporate Videos</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Visual Effects</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Compositing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Green Screen</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Rotoscoping</a>
                            <a href="#" class="w-fit caption1 line-before line-black">3D Tracking</a>
                        </div>
                    </div>
                    <div id="category_06" class="category_list_detail tab_list grid grid-cols-4 gap-y-10 w-full h-fit py-8 px-10" role="tabpanel" aria-labelledby="category_tab06" aria-hidden="true">
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Music Production</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Beat Making</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Remixing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Songwriting</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Jingles & Intros</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Audio Engineering</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Mixing & Mastering</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Sound Design</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Audio Editing</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Restoration & Repair</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Voice Over</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Narration</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Character Voices</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Podcast Intros</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Commercials</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Music Lessons</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Instrumental Lessons</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Vocal Coaching</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Music Theory</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Songwriting Lessons</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Jingles & Drops</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Radio Jingles</a>
                            <a href="#" class="w-fit caption1 line-before line-black">DJ Drops</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Podcast Intros</a>
                            <a href="#" class="w-fit caption1 line-before line-black">TV & Film Jingles</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Sound Effects</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Custom Sound Effects</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Foley</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Game Sound Effects</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Podcast Sound Effects</a>
                        </div>
                    </div>
                    <div id="category_07" class="category_list_detail tab_list grid grid-cols-4 gap-y-10 w-full h-fit py-8 px-10" role="tabpanel" aria-labelledby="category_tab07" aria-hidden="true">
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Machine Learning</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Model Training</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Data Analysis</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Predictive Analytics</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Natural Language Processing</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">AI Development</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Chatbot Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">AI Solutions</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Custom AI Applications</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Machine Learning Algorithms</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Data Science</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Data Visualization</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Data Engineering</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Big Data Solutions</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Data Mining</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Automation</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Process Automation</a>
                            <a href="#" class="w-fit caption1 line-before line-black">RPA Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Automation Tools</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Workflow Automation</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Computer Vision</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Image Recognition</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Object Detection</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Facial Recognition</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Video Analysis</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Speech Recognition</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Voice Assistants</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Speech to Text</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Text to Speech</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Voice Command Systems</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">AI Consulting</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Strategy Development</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Implementation Guidance</a>
                            <a href="#" class="w-fit caption1 line-before line-black">AI Roadmaps</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Technical Support</a>
                        </div>
                    </div>
                    <div id="category_08" class="category_list_detail tab_list grid grid-cols-4 gap-y-10 w-full h-fit py-8 px-10" role="tabpanel" aria-labelledby="category_tab08" aria-hidden="true">
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Portrait Photography</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Headshots</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Family Portraits</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Event Photography</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Fashion Photography</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Commercial Photography</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Product Photography</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Food Photography</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Real Estate Photography</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Advertising Photography</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Travel Photography</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Landscape Photography</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Cityscape Photography</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Street Photography</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Adventure Photography</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Aerial Photography</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Drone Photography</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Aerial Videography</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Real Estate Aerials</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Event Aerials</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Wedding Photography</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Engagement Photos</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Wedding Day Photos</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Bridal Portraits</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Reception Photos</a>
                        </div>
                        <div class="item flex flex-col gap-2.5">
                            <strong class="text-button">Photo Editing</strong>
                            <a href="#" class="w-fit caption1 line-before line-black">Retouching</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Color Correction</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Photo Restoration</a>
                            <a href="#" class="w-fit caption1 line-before line-black">Background Removal</a>
                        </div>
                    </div>
                </div>
            </div>-->
        </div>
        <div class="right flex items-center gap-6 h-full">
            <!--<div class="navigator h-full max-[1400px]:hidden">
                <ul class="list flex items-center gap-5 h-full">
                    <li class="h-full relative">
                        <a href="#!" class="flex items-center gap-1 h-full text-white duration-300 active">
                            <span class="text-title relative">Homepages</span>
                            <span class="ph-bold ph-caret-down"></span>
                        </a>
                        <div class="sub_menu sub_menu_home overflow-x-hidden fixed w-full left-0 top-20 py-10 bg-white rounded-lg">
                            <ul class="container grid grid-cols-5 gap-5">
                                <li>
                                    <a href="Home" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md active">
                                        <img src="assets/images/components/home1.webp" alt="home1" class="w-full rounded" />
                                        <span>Home Freelancer 01</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="freelancer2.html" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md">
                                        <img src="assets/images/components/home2.webp" alt="home2" class="w-full rounded" />
                                        <span>Home Freelancer 02</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="freelancer3.html" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md">
                                        <img src="assets/images/components/home3.webp" alt="home3" class="w-full rounded" />
                                        <span>Home Freelancer 03</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="freelancer4.html" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md">
                                        <img src="assets/images/components/home4.webp" alt="home4" class="w-full rounded" />
                                        <span>Home Freelancer 04</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="freelancer5.html" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md">
                                        <img src="assets/images/components/home5.webp" alt="home5" class="w-full rounded" />
                                        <span>Home Freelancer 05</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="freelancer6.html" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md">
                                        <img src="assets/images/components/home6.webp" alt="home6" class="w-full rounded" />
                                        <span>Home Freelancer 06</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="freelancer7.html" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md">
                                        <img src="assets/images/components/home7.webp" alt="home7" class="w-full rounded" />
                                        <span>Home Freelancer 07</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="freelancer8.html" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md">
                                        <img src="assets/images/components/home8.webp" alt="home8" class="w-full rounded" />
                                        <span>Home Freelancer 08</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="jobs9.html" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md">
                                        <img src="assets/images/components/home9.webp" alt="home9" class="w-full rounded" />
                                        <span>Home Jobs 09</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="jobs10.html" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md">
                                        <img src="assets/images/components/home10.webp" alt="home10" class="w-full rounded" />
                                        <span>Home Jobs 10</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="jobs11.html" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md">
                                        <img src="assets/images/components/home11.webp" alt="home11" class="w-full rounded" />
                                        <span>Home Jobs 11</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="jobs12.html" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md">
                                        <img src="assets/images/components/home12.webp" alt="home12" class="w-full rounded" />
                                        <span>Home Jobs 12</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="rtl13.html" class="link flex flex-col items-center gap-2 text-button p-2 rounded-lg bg-white duration-300 shadow-md">
                                        <img src="assets/images/components/home13.webp" alt="home13" class="w-full rounded" />
                                        <span>Home RTL 13</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="h-full relative">
                        <a href="#!" class="flex items-center gap-1 h-full text-white duration-300">
                            <span class="text-title relative">For Candidates</span>
                            <span class="ph-bold ph-caret-down"></span>
                        </a>
                        <div class="sub_menu absolute p-3 -left-10 w-max bg-white rounded-lg">
                            <ul>
                                <li>
                                    <a href="#!" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300">
                                        Browse jobs
                                        <span class="ph-bold ph-caret-right"></span>
                                    </a>
                                    <div class="sub_menu_two absolute p-3 top-0 left-full z-[1] w-max bg-white rounded-lg">
                                        <ul>
                                            <li>
                                                <a href="#" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> jobs default </a>
                                            </li>
                                            <li>
                                                <a href="jobs-grid.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> jobs grid </a>
                                            </li>
                                            <li>
                                                <a href="jobs-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> jobs list </a>
                                            </li>
                                            <li>
                                                <a href="jobs-top-map.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> jobs top map </a>
                                            </li>
                                            <li>
                                                <a href="jobs-half-map-grid1.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> jobs half map grid 1 </a>
                                            </li>
                                            <li>
                                                <a href="jobs-half-map-grid2.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> jobs half map grid 2 </a>
                                            </li>
                                            <li>
                                                <a href="jobs-fullwidth.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> jobs fullwidth </a>
                                            </li>
                                            <li>
                                                <a href="jobs-detail1.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> jobs detail 1 </a>
                                            </li>
                                            <li>
                                                <a href="jobs-detail2.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> jobs detail 2 </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#!" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300">
                                        Browse Projects
                                        <span class="ph-bold ph-caret-right"></span>
                                    </a>
                                    <div class="sub_menu_two absolute p-3 top-0 left-full z-[1] w-max bg-white rounded-lg">
                                        <ul>
                                            <li>
                                                <a href="project-default.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> project default </a>
                                            </li>
                                            <li>
                                                <a href="project-grid-3col.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> project grid 3 columns </a>
                                            </li>
                                            <li>
                                                <a href="project-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> project list </a>
                                            </li>
                                            <li>
                                                <a href="project-top-map-grid.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> project top map grid </a>
                                            </li>
                                            <li>
                                                <a href="project-top-map-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> project top map list </a>
                                            </li>
                                            <li>
                                                <a href="project-half-map-grid.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> project half map grid </a>
                                            </li>
                                            <li>
                                                <a href="project-half-map-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> project half map list </a>
                                            </li>
                                            <li>
                                                <a href="project-fullwidth.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> project fullwidth </a>
                                            </li>
                                            <li>
                                                <a href="project-detail1.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> project detail 1 </a>
                                            </li>
                                            <li>
                                                <a href="project-detail2.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> project detail 2 </a>
                                            </li>
                                            <li>
                                                <a href="project-detail3.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> project detail 3 </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#!" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300">
                                        Browse Employer
                                        <span class="ph-bold ph-caret-right"></span>
                                    </a>
                                    <div class="sub_menu_two absolute p-3 top-0 left-full z-[1] w-max bg-white rounded-lg">
                                        <ul>
                                            <li>
                                                <a href="employers-default.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers default </a>
                                            </li>
                                            <li>
                                                <a href="employers-grid.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers grid </a>
                                            </li>
                                            <li>
                                                <a href="employers-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers list </a>
                                            </li>
                                            <li>
                                                <a href="employers-sidebar-grid-3cols.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers sidebar grid 3 cols </a>
                                            </li>
                                            <li>
                                                <a href="employers-sidebar-grid-2cols.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers sidebar grid 2 cols </a>
                                            </li>
                                            <li>
                                                <a href="employers-sidebar-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers sidebar list </a>
                                            </li>
                                            <li>
                                                <a href="employers-top-map-grid.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers top map grid </a>
                                            </li>
                                            <li>
                                                <a href="employers-top-map-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers top map list </a>
                                            </li>
                                            <li>
                                                <a href="employers-half-map-grid.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers half map grid </a>
                                            </li>
                                            <li>
                                                <a href="employers-half-map-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers half map list </a>
                                            </li>
                                            <li>
                                                <a href="employers-fullwidth.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers fullwidth </a>
                                            </li>
                                            <li>
                                                <a href="employers-detail1.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers detail 1 </a>
                                            </li>
                                            <li>
                                                <a href="employers-detail2.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> employers detail 2 </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="become-seller.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Become a seller </a>
                                </li>
                                <li>
                                    <a href="candidates-dashboard.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Candidates Dashboard </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="h-full relative">
                        <a href="#!" class="flex items-center gap-1 h-full text-white duration-300">
                            <span class="text-title relative">For Employers</span>
                            <span class="ph-bold ph-caret-down"></span>
                        </a>
                        <div class="sub_menu absolute p-3 -left-10 w-max bg-white rounded-lg">
                            <ul>
                                <li>
                                    <a href="#!" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300">
                                        Browse Services
                                        <span class="ph-bold ph-caret-right"></span>
                                    </a>
                                    <div class="sub_menu_two absolute p-3 top-0 left-full z-[1] w-max bg-white rounded-lg">
                                        <ul>
                                            <li>
                                                <a href="services-default.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> services default </a>
                                            </li>
                                            <li>
                                                <a href="services-grid.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> services grid </a>
                                            </li>
                                            <li>
                                                <a href="services-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> services list </a>
                                            </li>
                                            <li>
                                                <a href="services-sidebar-grid-3cols.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> services sidebar grid 3 cols </a>
                                            </li>
                                            <li>
                                                <a href="services-sidebar-grid-2cols.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> services sidebar grid 2 cols </a>
                                            </li>
                                            <li>
                                                <a href="services-sidebar-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> services sidebar list </a>
                                            </li>
                                            <li>
                                                <a href="services-fullwidth-grid-5cols.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> services fullwidth grid 5 cols </a>
                                            </li>
                                            <li>
                                                <a href="services-fullwidth-grid-4cols.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> services fullwidth grid 4 cols </a>
                                            </li>
                                            <li>
                                                <a href="services-fullwidth-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> services fullwidth list </a>
                                            </li>
                                            <li>
                                                <a href="services-detail1.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> services detail 1 </a>
                                            </li>
                                            <li>
                                                <a href="services-detail2.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> services detail 2 </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#!" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300">
                                        Browse Candidates
                                        <span class="ph-bold ph-caret-right"></span>
                                    </a>
                                    <div class="sub_menu_two absolute p-3 top-0 left-full z-[1] w-max bg-white rounded-lg">
                                        <ul>
                                            <li>
                                                <a href="candidates-default.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates default </a>
                                            </li>
                                            <li>
                                                <a href="candidates-grid.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates grid </a>
                                            </li>
                                            <li>
                                                <a href="candidates-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates list </a>
                                            </li>
                                            <li>
                                                <a href="candidates-sidebar-grid.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates sidebar grid </a>
                                            </li>
                                            <li>
                                                <a href="candidates-sidebar-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates sidebar list </a>
                                            </li>
                                            <li>
                                                <a href="candidates-top-map-grid.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates top map grid </a>
                                            </li>
                                            <li>
                                                <a href="candidates-top-map-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates top map list </a>
                                            </li>
                                            <li>
                                                <a href="candidates-half-map-grid.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates half map grid </a>
                                            </li>
                                            <li>
                                                <a href="candidates-half-map-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates half map list </a>
                                            </li>
                                            <li>
                                                <a href="candidates-fullwidth-grid.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates fullwidth grid </a>
                                            </li>
                                            <li>
                                                <a href="candidates-fullwidth-list.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates fullwidth list </a>
                                            </li>
                                            <li>
                                                <a href="candidates-detail1.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates detail 1 </a>
                                            </li>
                                            <li>
                                                <a href="candidates-detail2.html" class="link block text-button py-[11px] pl-6 pr-[45px] rounded duration-300"> candidates detail 2 </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="become-buyer.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Become a buyer </a>
                                </li>
                                <li>
                                    <a href="employers-dashboard.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Employer Dashboard </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="h-full relative">
                        <a href="#!" class="flex items-center gap-1 h-full text-white duration-300">
                            <span class="text-title relative">Blogs</span>
                            <span class="ph-bold ph-caret-down"></span>
                        </a>
                        <div class="sub_menu absolute p-3 -left-10 w-max bg-white rounded-lg">
                            <ul>
                                <li>
                                    <a href="blog-default.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Blog default </a>
                                </li>
                                <li>
                                    <a href="blog-grid.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Blog grid </a>
                                </li>
                                <li>
                                    <a href="blog-list.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Blog list </a>
                                </li>
                                <li>
                                    <a href="blog-detail1.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Blog detail 1 </a>
                                </li>
                                <li>
                                    <a href="blog-detail2.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Blog detail 2 </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="h-full relative">
                        <a href="#!" class="flex items-center gap-1 h-full text-white duration-300">
                            <span class="text-title relative">Pages</span>
                            <span class="ph-bold ph-caret-down"></span>
                        </a>
                        <div class="sub_menu absolute p-3 -left-10 w-max bg-white rounded-lg">
                            <ul>
                                <li>
                                    <a href="about1.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> About Us 1 </a>
                                </li>
                                <li>
                                    <a href="about2.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> About Us 2 </a>
                                </li>
                                <li>
                                    <a href="pricing.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Pricing Plan </a>
                                </li>
                                <li>
                                    <a href="contact1.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Contact Us 1 </a>
                                </li>
                                <li>
                                    <a href="contact2.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Contact Us 2 </a>
                                </li>
                                <li>
                                    <a href="faqs.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Faqs </a>
                                </li>
                                <li>
                                    <a href="term-of-use.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Terms of use </a>
                                </li>
                                <li>
                                    <a href="error-404.html" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Error 404 </a>
                                </li>
                                <li>
                                    <a href="Login" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Login </a>
                                </li>
                                <li>
                                    <a href="Register" class="link flex items-center justify-between gap-2 w-full text-button py-[11px] px-6 rounded duration-300"> Register </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>-->
            <div class="list_action flex items-center gap-7">

                <?php
                if(isset($_SESSION['seller_id'])){
                    $fetch_profile_pic = $db_handle->runQuery("select profile_image from seller_personal_information where user_id = {$_SESSION['seller_id']}");
                    ?>
                    <div class="notification_block relative">
                        <button class="relative block">
                            <span class="ph ph-bell text-white text-2xl block"></span>
                            <span class="absolute -top-0.5 right-0.5 w-2 h-2 bg-primary rounded-full"></span>
                        </button>
                        <div class="notification_submenu absolute w-[340px] p-5 top-[3.25rem] -left-15 bg-white rounded-xl">
                            <h6 class="heading6 pb-3">Notifications</h6>
                            <?php
                            $fetch_noti = $db_handle->runQuery("select * from seller_notification where seller_id = {$_SESSION['seller_id']} order by id desc limit 10");
                            $fetch_noti_row = $db_handle->numRows("select * from seller_notification where seller_id = {$_SESSION['seller_id']} order by id desc limit 10");
                            for ($i=0; $i<$fetch_noti_row; $i++){
                                ?>
                                <ul class="list_notification w-full">
                                    <li class="notification_item w-full py-3 border-t border-line duration-300 hover:bg-background">
                                        <a class="flex gap-3 w-full">
                                        <span class="ic_noti flex flex-shrink-0 items-center justify-center w-8 h-8 rounded-full bg-surface">
                                            <span class="ph-fill ph-bell text-lg text-secondary"></span>
                                        </span>
                                            <div class="notification_detail">
                                                <?php
                                                if($fetch_noti[$i]['status'] == 0){
                                                    ?>
                                                    <p class="notification_desc text-secondary">Someone viewed your <span class="text-black">Profile</span>.</p>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <p class="notification_desc text-secondary">You have a new <span class="text-black">message</span>.</p>
                                                    <?php
                                                }
                                                ?>
                                                <span class="notification_time caption2 text-placehover"><?php
                                                    $storedTimestamp = $fetch_noti[$i]['viewed_time'];

                                                    // Create DateTime objects for the stored timestamp and current date/time
                                                    $storedDateTime = new DateTime($storedTimestamp);
                                                    $currentDateTime = new DateTime();

                                                    // Calculate the difference
                                                    $interval = $storedDateTime->diff($currentDateTime);

                                                    // Get the difference in years, months, days, hours, minutes, and seconds
                                                    $years = $interval->y;
                                                    $months = $interval->m;
                                                    $days = $interval->d;
                                                    $hours = $interval->h;
                                                    $minutes = $interval->i;
                                                    $seconds = $interval->s;

                                                    // Format the result based on the difference
                                                    if ($interval->y > 0) {
                                                        echo $years . ' year' . ($years > 1 ? 's' : '') . ' ago';
                                                    } elseif ($interval->m > 0) {
                                                        echo $months . ' month' . ($months > 1 ? 's' : '') . ' ago';
                                                    } elseif ($interval->d > 0) {
                                                        echo $days . ' day' . ($days > 1 ? 's' : '') . ' ago';
                                                    } elseif ($interval->h > 0) {
                                                        echo $hours . ' hour' . ($hours > 1 ? 's' : '') . ' ago';
                                                    } elseif ($interval->i > 0) {
                                                        echo $minutes . ' minute' . ($minutes > 1 ? 's' : '') . ' ago';
                                                    } else {
                                                        echo $seconds . ' second' . ($seconds > 1 ? 's' : '') . ' ago';
                                                    }

                                                    ?></span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <a href="Message" class="button-main bg-white text-black">Message</a>
                    <div class="user_block relative">
                        <button class="user_infor flex items-center gap-2 text-white">
                            <i class="ph ph-gear text-2xl"></i>
                            <strong class="user_name text-title"></strong>
                            <span class="ph ph-caret-down"></span>
                        </button>
                        <ul class="list_action_user absolute w-[240px] p-3 top-14 right-0 bg-white rounded-lg">
                            <?php
                            $check_value = $db_handle->numRows("select * from seller_personal_information where user_id = {$_SESSION['seller_id']}");
                            if($check_value == 1){
                                ?>
                                <li class="action_item">
                                    <a href="Edit-Profile" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                                        <span class="ph ph-pen-nib-straight text-2xl text-secondary"></span>
                                        <strong class="text-title">Edit Profile</strong>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                            <!--<li class="action_item">
                                <a href="Edit-Skills" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                                    <span class="ph ph-pen-nib-straight text-2xl text-secondary"></span>
                                    <strong class="text-title">Edit Skills</strong>
                                </a>
                            </li>-->
                            <li class="action_item">
                                <a href="Update-Password" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                                    <span class="ph ph-user-circle text-2xl text-secondary"></span>
                                    <strong class="text-title">Reset Password</strong>
                                </a>
                            </li>
                            <li class="action_item">
                                <a href="Logout" class="link flex items-center gap-3 w-full py-3 px-6 rounded-lg duration-300 hover:bg-background">
                                    <span class="ph ph-sign-out text-2xl text-secondary"></span>
                                    <strong class="text-title">Log Out</strong>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php
                } else {
                    ?>
                    <!--<div class="list_icon flex items-center gap-3">
                        <a href="Login" class="flex items-center gap-1 text-title text-white duration-300 hover:text-primary">
                            <span class="ph-bold ph-user"></span>
                            <span>Login</span>
                        </a>
                        <a href="Register" class="flex items-center gap-1 text-title text-white duration-300 hover:text-primary">
                            <span class="ph-bold ph-plus-circle"></span>
                            <span>Register</span>
                        </a>
                    </div>-->
                    <?php
                }
                ?>
                <!--<button class="humburger_btn min-[1400px]:hidden">
                            <span class="ph-bold ph-list text-white text-2xl block">
                                <span class="blind">button open menu mobile</span>
                            </span>
                </button>-->
            </div>
        </div>
    </div>
</header>
