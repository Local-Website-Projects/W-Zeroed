<?php
echo "
<script>
window.location.href = 'Login';
</script>
";

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Zeroed - number one market place in Canada" />
        <title>Zeroed - Dashboard</title>
    <?php include ('include/css.php');?>
    </head>

    <body>
        <!-- Header -->
<?php include ('include/header.php');?>

        <!-- Slider -->
        <section class="slider">
            <div class="slider_inner relative md:h-[700px] max-md:py-28 overflow-hidden">
                <div class="slider_bg absolute top-0 left-0 w-full h-full z-[-1]" aria-hidden="true">
                    <img src="assets/images/slider/slider1.webp" alt="slider1" class="w-full h-full object-cover" />
                </div>
                <div class="container h-full">
                    <div class="slider_content flex flex-col items-start justify-center sm:pt-20 pt-16 md:w-[720px] w-full h-full">
                        <h2 class="heading1 text-white animate animate_top" style="--i: 1">Find the right freelance service, right away</h2>
                        <p class="body2 text-white mt-5 animate animate_top" style="--i: 2">Find skilled freelancers for any project. Discover top services and hire the best talent.</p>
                        <div class="form_search z-[1] w-full md:mt-10 mt-7 animate animate_top" style="--i: 3">
                            <form class="form_inner flex items-center justify-between max-sm:flex-wrap gap-6 gap-y-4 relative w-full p-3 rounded-lg bg-white">
                                <div class="form_input relative w-full">
                                    <span class="icon_search ph-bold ph-magnifying-glass absolute top-1/2 -translate-y-1/2 left-2 text-xl"></span>
                                    <input type="text" class="input_search w-full h-full pl-10" placeholder="Job title, key words or company" required />
                                </div>
                                <div class="select_block flex-shrink-0 sm:pr-16 pr-7 sm:pl-6 pl-3 sm:border-l border-line">
                                    <div class="select">
                                        <span class="selected" data-title="All Categories">All Categories</span>
                                        <ul class="list_option bg-white">
                                            <li data-item="Graphic & Design">Graphic & Design</li>
                                            <li data-item="Wrting">Wrting</li>
                                            <li data-item="Videos">Videos</li>
                                            <li data-item="Digital Marketing">Digital Marketing</li>
                                        </ul>
                                    </div>
                                    <span class="icon_down ph ph-caret-down sm:text-2xl text-xl right-0"></span>
                                </div>
                                <button type="submit" class="button-main max-sm:w-1/3 text-center flex-shrink-0">Search</button>
                            </form>
                        </div>
                        <div class="list_tags flex flex-wrap items-center gap-3 mt-5 animate animate_top" style="--i: 4">
                            <strong class="text-button-sm text-white">Top Services:</strong>
                            <a href="jobs-default.html" class="tag -small -border border-opacity-20 text-button-sm text-white hover:text-black hover:bg-white">Graphics</a>
                            <a href="jobs-default.html" class="tag -small -border border-opacity-20 text-button-sm text-white hover:text-black hover:bg-white">Website</a>
                            <a href="jobs-default.html" class="tag -small -border border-opacity-20 text-button-sm text-white hover:text-black hover:bg-white">Logo</a>
                            <a href="jobs-default.html" class="tag -small -border border-opacity-20 text-button-sm text-white hover:text-black hover:bg-white">Developement</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Brand -->
        <section class="brand bg-surface py-7">
            <div class="container">
                <h6 class="heading6 text-center">Trusted by leading enterprise organizations and freelancers globally</h6>
                <div class="swiper swiper-list-brand mt-6">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide flex items-center justify-center">
                            <div class="brand-item relative flex items-center justify-center sm:h-8 h-7.5 flex-shrink-0">
                                <img src="assets/images/brand/1.svg" alt="1" class="h-full w-auto duration-500 relative object-cover" />
                            </div>
                        </div>
                        <div class="swiper-slide flex items-center justify-center">
                            <div class="brand-item relative flex items-center justify-center sm:h-8 h-7.5 flex-shrink-0">
                                <img src="assets/images/brand/2.svg" alt="2" class="h-full w-auto duration-500 relative object-cover" />
                            </div>
                        </div>
                        <div class="swiper-slide flex items-center justify-center">
                            <div class="brand-item relative flex items-center justify-center sm:h-8 h-7.5 flex-shrink-0">
                                <img src="assets/images/brand/3.svg" alt="3" class="h-full w-auto duration-500 relative object-cover" />
                            </div>
                        </div>
                        <div class="swiper-slide flex items-center justify-center">
                            <div class="brand-item relative flex items-center justify-center sm:h-8 h-7.5 flex-shrink-0">
                                <img src="assets/images/brand/4.svg" alt="4" class="h-full w-auto duration-500 relative object-cover" />
                            </div>
                        </div>
                        <div class="swiper-slide flex items-center justify-center">
                            <div class="brand-item relative flex items-center justify-center sm:h-8 h-7.5 flex-shrink-0">
                                <img src="assets/images/brand/5.svg" alt="5" class="h-full w-auto duration-500 relative object-cover" />
                            </div>
                        </div>
                        <div class="swiper-slide flex items-center justify-center">
                            <div class="brand-item relative flex items-center justify-center sm:h-8 h-7.5 flex-shrink-0">
                                <img src="assets/images/brand/6.svg" alt="6" class="h-full w-auto duration-500 relative object-cover" />
                            </div>
                        </div>
                        <div class="swiper-slide flex items-center justify-center">
                            <div class="brand-item relative flex items-center justify-center sm:h-8 h-7.5 flex-shrink-0">
                                <img src="assets/images/brand/7.svg" alt="7" class="h-full w-auto duration-500 relative object-cover" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Top Categories -->
        <section class="top_categories lg:pt-20 sm:pt-14 pt-10">
            <div class="container">
                <div class="heading flex items-end justify-between flex-wrap gap-4">
                    <div class="left animate animate_top" style="--i: 1">
                        <h3 class="heading3">Top Categories</h3>
                        <p class="body2 text-secondary mt-3">Explore a wide range of services organized by category</p>
                    </div>
                    <a href="jobs-default.html" class="text-button pb-0.5 border-b-2 border-primary duration-300 hover:text-primary animate animate_top" style="--i: 2">All Categories</a>
                </div>
                <div class="list grid xl:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-7.5 md:mt-10 mt-7">
                    <div class="category_item p-7.5 rounded-20 bg-white shadow-md duration-300 hover:shadow-xl animate animate_top" style="--i: 1">
                        <div class="icon pb-4 w-fit line-before line-2px">
                            <span class="icon-graphic text-5xl"></span>
                        </div>
                        <h6 class="heading6 mt-5">Graphic & Design</h6>
                        <div class="list_category flex flex-col gap-2.5 mt-3">
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Logo Design</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Brand Identity Design</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Advertising Graphic Design</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Web Graphics Design</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Packaging Design</a>
                        </div>
                    </div>
                    <div class="category_item p-7.5 rounded-20 bg-white shadow-md duration-300 hover:shadow-xl animate animate_top" style="--i: 2">
                        <div class="icon pb-4 w-fit line-before line-2px">
                            <span class="icon-writing text-5xl"></span>
                        </div>
                        <h6 class="heading6 mt-5">Wrting</h6>
                        <div class="list_category flex flex-col gap-2.5 mt-3">
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Content Writing</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Blog Writing</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Article Writing</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Technical Writing</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Editing and Proofreading</a>
                        </div>
                    </div>
                    <div class="category_item p-7.5 rounded-20 bg-white shadow-md duration-300 hover:shadow-xl animate animate_top" style="--i: 3">
                        <div class="icon pb-4 w-fit line-before line-2px">
                            <span class="icon-video text-5xl"></span>
                        </div>
                        <h6 class="heading6 mt-5">Videos</h6>
                        <div class="list_category flex flex-col gap-2.5 mt-3">
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Video Production</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Video Editing</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Motion Graphics</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Product Demonstrations</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Video Marketing Strategy</a>
                        </div>
                    </div>
                    <div class="category_item p-7.5 rounded-20 bg-white shadow-md duration-300 hover:shadow-xl animate animate_top" style="--i: 4">
                        <div class="icon pb-4 w-fit line-before line-2px">
                            <span class="icon-marketing text-5xl"></span>
                        </div>
                        <h6 class="heading6 mt-5">Digital Marketing</h6>
                        <div class="list_category flex flex-col gap-2.5 mt-3">
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Social Media Marketing</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Search Engine Optimization</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Pay-Per-Click Advertising</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Email Marketing</a>
                            <a href="jobs-default.html" class="inline-block w-fit line-before text-secondary hover:text-black">Digital Advertising Campaigns</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Feature services -->
        <section class="feature_services lg:py-20 sm:py-14 py-10">
            <div class="container">
                <div class="heading flex flex-col items-center">
                    <h3 class="heading3 text-center animate animate_top" style="--i: 1">Feature services</h3>
                    <p class="body2 text-secondary text-center mt-3 animate animate_top" style="--i: 2">Discover our featured services designed to elevate your experience</p>
                    <div class="heading_menu border-b border-line md:mt-7 mt-5 animate animate_top" style="--i: 3">
                        <div class="menu_tab">
                            <ul class="menu flex gap-7" role="tablist">
                                <li class="indicator absolute bottom-0 h-0.5 bg-primary rounded-full duration-300" role="presentation"></li>
                                <li class="tab_item" role="presentation">
                                    <button class="tab_btn -before py-1 text-button hover:text-primary duration-300 active" id="services_tab01" role="tab" aria-controls="services_01" aria-selected="true">Graphic & Design</button>
                                </li>
                                <li class="tab_item" role="presentation">
                                    <button class="tab_btn -before py-1 text-button hover:text-primary duration-300" id="services_tab02" role="tab" aria-controls="services_02" aria-selected="false">Digital Marketing</button>
                                </li>
                                <li class="tab_item" role="presentation">
                                    <button class="tab_btn -before py-1 text-button hover:text-primary duration-300" id="services_tab03" role="tab" aria-controls="services_03" aria-selected="false">Development</button>
                                </li>
                                <li class="tab_item" role="presentation">
                                    <button class="tab_btn -before py-1 text-button hover:text-primary duration-300" id="services_tab04" role="tab" aria-controls="services_04" aria-selected="false">UI/UX Design</button>
                                </li>
                                <li class="tab_item" role="presentation">
                                    <button class="tab_btn -before py-1 text-button hover:text-primary duration-300" id="services_tab05" role="tab" aria-controls="services_05" aria-selected="false">Writing</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="services_01" class="tab_list active" role="tabpanel" aria-labelledby="services_tab01" aria-hidden="false">
                    <ul class="list grid xl:grid-cols-4 sm:grid-cols-2 gap-7.5 md:mt-10 mt-7">
                        <li class="item animate animate_top" style="--i: 1">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/1.webp" alt="1" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">Graphic & Design</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">Professional seo services to boost your website's visibility</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-1.webp" alt="IMG-1" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Floyd Miles</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 2">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/2.webp" alt="2" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">Development</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will create stunning logo designs for your business</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-2.webp" alt="IMG-2" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Cameron</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 3">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/3.webp" alt="3" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">UI/UX Design</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will design UI UX design for App in Figma</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-3.webp" alt="IMG-3" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Theresa Webb</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 4">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/4.webp" alt="4" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">Digital Marketing</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will translate your documents with accuracy and precision</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-4.webp" alt="IMG-4" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Marvin McKinney</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 5">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/5.webp" alt="5" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">Development</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will do background illustration and environment concept art</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-5.webp" alt="IMG-5" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Kristin Watson</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 6">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/6.webp" alt="6" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">UI/UX Design</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will draw vector line art illustration image</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-6.webp" alt="IMG-6" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Courtney Henry</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 7">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/7.webp" alt="7" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">UI/UX Design</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will design wordpress website with elementor pro</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-7.webp" alt="IMG-7" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Arlene McCoy</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 8">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/8.webp" alt="8" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">Digital Marketing</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will do figma UI UX design for websites & landing page</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-8.webp" alt="IMG-8" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Robert Fox</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="services_02" class="tab_list" role="tabpanel" aria-labelledby="services_tab02" aria-hidden="true">
                    <ul class="list grid xl:grid-cols-4 sm:grid-cols-2 gap-7.5 md:mt-10 mt-7">
                        <li class="item animate animate_top" style="--i: 1">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/2.webp" alt="2" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">Development</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will create stunning logo designs for your business</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-2.webp" alt="IMG-2" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Cameron</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 2">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/3.webp" alt="3" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">UI/UX Design</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will design UI UX design for App in Figma</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-3.webp" alt="IMG-3" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Theresa Webb</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 3">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/4.webp" alt="4" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">Digital Marketing</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will translate your documents with accuracy and precision</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-4.webp" alt="IMG-4" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Marvin McKinney</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 4">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/5.webp" alt="5" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">Development</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will do background illustration and environment concept art</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-5.webp" alt="IMG-5" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Kristin Watson</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="services_03" class="tab_list" role="tabpanel" aria-labelledby="services_tab03" aria-hidden="true">
                    <ul class="list grid xl:grid-cols-4 sm:grid-cols-2 gap-7.5 md:mt-10 mt-7">
                        <li class="item animate animate_top" style="--i: 1">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/6.webp" alt="6" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">UI/UX Design</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will draw vector line art illustration image</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-6.webp" alt="IMG-6" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Courtney Henry</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 2">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/7.webp" alt="7" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">UI/UX Design</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will design wordpress website with elementor pro</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-7.webp" alt="IMG-7" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Arlene McCoy</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="services_04" class="tab_list" role="tabpanel" aria-labelledby="services_tab04" aria-hidden="true">
                    <ul class="list grid xl:grid-cols-4 sm:grid-cols-2 gap-7.5 md:mt-10 mt-7">
                        <li class="item animate animate_top" style="--i: 1">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/2.webp" alt="2" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">Development</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will create stunning logo designs for your business</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-2.webp" alt="IMG-2" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Cameron</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 2">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/3.webp" alt="3" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">UI/UX Design</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will design UI UX design for App in Figma</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-3.webp" alt="IMG-3" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Theresa Webb</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="services_05" class="tab_list" role="tabpanel" aria-labelledby="services_tab05" aria-hidden="true">
                    <ul class="list grid xl:grid-cols-4 sm:grid-cols-2 gap-7.5 md:mt-10 mt-7">
                        <li class="item animate animate_top" style="--i: 1">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/4.webp" alt="4" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">Digital Marketing</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will translate your documents with accuracy and precision</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-4.webp" alt="IMG-4" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Marvin McKinney</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="item animate animate_top" style="--i: 2">
                            <div class="service_item overflow-hidden relative rounded-lg bg-white shadow-md duration-300 hover:shadow-xl">
                                <button class="add_wishlist_btn">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                                <a href="services-detail1.html" class="service_thumb">
                                    <img src="assets/images/service/5.webp" alt="5" class="w-full" />
                                </a>
                                <div class="service_info py-5 px-4">
                                    <div class="flex items-center justify-between">
                                        <a href="services-default.html" class="tag caption2 bg-surface hover:bg-primary hover:text-white">Development</a>
                                        <div class="rate flex items-center gap-1">
                                            <span class="ph-fill ph-star text-yellow text-xs"></span>
                                            <strong class="service_rate text-button-sm">4.9</strong>
                                            <span class="service_rate_quantity caption1 text-secondary">(482)</span>
                                        </div>
                                    </div>
                                    <a href="services-detail1.html" class="service_title text-title pt-2 duration-300 hover:text-primary">I will do background illustration and environment concept art</a>
                                    <div class="service_more_info flex items-center justify-between gap-1 mt-4 pt-4 border-t border-line">
                                        <a href="candidates-detail1.html" class="service_author flex items-center gap-2">
                                            <img src="assets/images/avatar/IMG-5.webp" alt="IMG-5" class="service_author_avatar w-8 h-8 rounded-full" />
                                            <span class="service_author_name -style-1">Kristin Watson</span>
                                        </a>
                                        <div class="service_price whitespace-nowrap">
                                            <span class="text-secondary">From </span>
                                            <span class="price text-title">$75</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- How it work -->
        <section class="process lg:py-20 sm:py-14 py-10 bg-[#FAF7F1]">
            <div class="container">
                <h3 class="heading3 text-center animate animate_top" style="--i: 1">How It Work On Employers</h3>
                <p class="body2 text-secondary text-center mt-3 animate animate_top" style="--i: 2">Recruitment made easy in 100 seconds</p>
                <ul class="list grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-7.5 md:mt-10 mt-7">
                    <li class="item animate animate_top" style="--i: 1">
                        <span class="icon-job text-4xl"></span>
                        <h6 class="heading6 mt-4">Post Your Job</h6>
                        <p class="mt-1">Create a job listing with details like requirements and budget.</p>
                    </li>
                    <li class="item animate animate_top" style="--i: 2">
                        <span class="icon-applicant text-4xl"></span>
                        <h6 class="heading6 mt-4">Review Applicants</h6>
                        <p class="mt-1">Receive and evaluate applications from freelancers.</p>
                    </li>
                    <li class="item animate animate_top" style="--i: 3">
                        <span class="icon-choose text-4xl"></span>
                        <h6 class="heading6 mt-4">Choose a Freelancer</h6>
                        <p class="mt-1">Conduct interviews or discussions to choose the best candidate.</p>
                    </li>
                    <li class="item animate animate_top" style="--i: 4">
                        <span class="icon-manage text-4xl"></span>
                        <h6 class="heading6 mt-4">Manage the Project</h6>
                        <p class="mt-1">Collaborate with the selected freelancer to complete the project.</p>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Benefit -->
        <section class="benefit lg:py-20 sm:py-14 py-10">
            <div class="container">
                <div class="benefit_inner flex max-lg:flex-col-reverse items-center justify-between gap-y-8">
                    <div class="benefit_content xl:w-[570px] lg:w-5/12 w-full">
                        <h3 class="heading3 animate animate_top" style="--i: 1">FreelanHub! The best choice?</h3>
                        <p class="body2 mt-3 animate animate_top" style="--i: 2">Streamline your hiring process with strategic channels to reach qualified candidates</p>
                        <ul class="list_benefit flex flex-col gap-6 mt-8">
                            <li class="benefit_item flex gap-4 animate animate_top" style="--i: 3">
                                <span class="ph ph-wallet flex-shrink-0 text-4xl text-primary"></span>
                                <div class="benefit_info">
                                    <h6 class="title heading6">Stick to your budget</h6>
                                    <p class="desc mt-1">Reduce your time-to-hire by up to 75% and free up headspace for other HR priorities.</p>
                                </div>
                            </li>
                            <li class="benefit_item flex gap-4 animate animate_top" style="--i: 4">
                                <span class="ph ph-certificate flex-shrink-0 text-4xl text-primary"></span>
                                <div class="benefit_info">
                                    <h6 class="title heading6">Get quality work done quickly</h6>
                                    <p class="desc mt-1">Hand your project over to a talented freelancer in minutes, get long-lasting results.</p>
                                </div>
                            </li>
                            <li class="benefit_item flex gap-4 animate animate_top" style="--i: 5">
                                <span class="ph ph-phone-call flex-shrink-0 text-4xl text-primary"></span>
                                <div class="benefit_info">
                                    <h6 class="title heading6">Support On 24/7</h6>
                                    <p class="desc mt-1">Our round-the-clock support team is available to help anytime, anywhere.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="benefit_bg relative lg:w-5/12 sm:w-[45%] w-[85%] lg:pl-3 lg:pr-15">
                        <img src="assets/images/components/benefit1.webp" alt="benefit1" class="w-full rounded-20" />
                        <div class="flag_benefit flex items-center gap-3 absolute sm:top-44 top-36 lg:right-0 -right-8 p-3 bg-white rounded-xl shadow-xl animate animate_left" style="--i: 1">
                            <span class="ph ph-lightning sm:text-4xl text-3xl text-primary flex-shrink-0"></span>
                            <div class="flag_info">
                                <h6 class="heading6">+20k</h6>
                                <span class="caption1">Daily website traffic</span>
                            </div>
                        </div>
                        <div class="flag_benefit flex items-center gap-3 absolute bottom-15 sm:-left-28 -left-7 p-3 bg-white rounded-xl shadow-xl animate animate_right" style="--i: 2">
                            <div class="flag_info pl-[14px] border-l-2 border-primary">
                                <h6 class="heading6">+10k</h6>
                                <span class="caption1">Job applications this month</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Projects -->
        <section class="projects lg:py-20 sm:py-14 py-10 bg-surface">
            <div class="container">
                <h3 class="heading3 text-center animate animate_top" style="--i: 1">Latest Projects</h3>
                <p class="body2 text-secondary text-center mt-3 animate animate_top" style="--i: 2">Discover our latest project with cutting-edge features. Explore now!</p>
                <ul class="list grid md:grid-cols-2 grid-cols-1 lg:gap-7.5 gap-5 md:mt-10 mt-7">
                    <li class="project_item p-6 rounded-lg bg-white duration-300 shadow-md animate animate_top" style="--i: 1">
                        <div class="project_innner">
                            <div class="project_info flex justify-between gap-3 pb-4 border-b border-line">
                                <div class="project_content">
                                    <a href="project-detail1.html" class="project_name heading6 duration-300 hover:underline">Figma mockup needed for a new website for Electrical contractor business website</a>
                                    <div class="project_related_info flex flex-wrap items-center gap-3 mt-3">
                                        <div class="project_date flex items-center gap-1">
                                            <span class="ph ph-calendar-blank text-xl text-secondary"></span>
                                            <span class="caption1 text-secondary">2 days ago</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span class="ph ph-map-pin text-xl text-secondary"></span>
                                            <span class="project_address -style-1 caption1 text-secondary">Las Vegas, USA</span>
                                        </div>
                                        <div class="project_spent flex items-center gap-1">
                                            <span class="caption1 text-secondary">$</span>
                                            <span class="caption1 text-secondary">2.8K</span>
                                            <span class="caption1 text-secondary">spent</span>
                                        </div>
                                    </div>
                                    <p class="project_desc mt-3 text-secondary">I am looking for a talented UX/UI Designer to create screens for my basic product idea. The project involves designing a web application, you may be missing out on some big opportunities.</p>
                                    <div class="list_tag flex items-center gap-2.5 flex-wrap mt-3">
                                        <a href="project-default.html" class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary">Graphic Design</a>
                                        <a href="project-default.html" class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary">Website Design</a>
                                        <a href="project-default.html" class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary">Figma</a>
                                    </div>
                                </div>
                                <button class="add_wishlist_btn -relative -border">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                            </div>
                            <div class="project_more_info flex items-center justify-between pt-4">
                                <div class="project_proposals">
                                    <span class="text-secondary">Proposals: </span>
                                    <span class="proposals">50+</span>
                                </div>
                                <div class="project_price">
                                    <span class="price text-title">$170</span>
                                    <span class="text-secondary">/fixed-price</span>
                                </div>
                            </div>
                        </div>
                        <div class="project_action mt-3">
                            <a href="project-detail1.html" class="project_apply_btn button-main -border w-full">Apply now</a>
                        </div>
                    </li>
                    <li class="project_item p-6 rounded-lg bg-white duration-300 shadow-md animate animate_top" style="--i: 2">
                        <div class="project_innner">
                            <div class="project_info flex justify-between gap-3 pb-4 border-b border-line">
                                <div class="project_content">
                                    <a href="project-detail1.html" class="project_name heading6 duration-300 hover:underline">I need you to design a email confirming for a ticket buying in a beautiful modern way for mobile</a>
                                    <div class="project_related_info flex flex-wrap items-center gap-3 mt-3">
                                        <div class="project_date flex items-center gap-1">
                                            <span class="ph ph-calendar-blank text-xl text-secondary"></span>
                                            <span class="caption1 text-secondary">2 days ago</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span class="ph ph-map-pin text-xl text-secondary"></span>
                                            <span class="project_address -style-1 caption1 text-secondary">Las Vegas, USA</span>
                                        </div>
                                        <div class="project_spent flex items-center gap-1">
                                            <span class="caption1 text-secondary">$</span>
                                            <span class="caption1 text-secondary">2.8K</span>
                                            <span class="caption1 text-secondary">spent</span>
                                        </div>
                                    </div>
                                    <p class="project_desc mt-3 text-secondary">I am looking for a talented UX/UI Designer to create screens for my basic product idea. The project involves designing a web application, you may be missing out on some big opportunities.</p>
                                    <div class="list_tag flex items-center gap-2.5 flex-wrap mt-3">
                                        <a href="project-default.html" class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary">Graphic Design</a>
                                        <a href="project-default.html" class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary">Website Design</a>
                                        <a href="project-default.html" class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary">Figma</a>
                                    </div>
                                </div>
                                <button class="add_wishlist_btn -relative -border">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                            </div>
                            <div class="project_more_info flex items-center justify-between pt-4">
                                <div class="project_proposals">
                                    <span class="text-secondary">Proposals: </span>
                                    <span class="proposals">50+</span>
                                </div>
                                <div class="project_price">
                                    <span class="price text-title">$170</span>
                                    <span class="text-secondary">/fixed-price</span>
                                </div>
                            </div>
                        </div>
                        <div class="project_action mt-3">
                            <a href="project-detail1.html" class="project_apply_btn button-main -border w-full">Apply now</a>
                        </div>
                    </li>
                    <li class="project_item p-6 rounded-lg bg-white duration-300 shadow-md animate animate_top" style="--i: 3">
                        <div class="project_innner">
                            <div class="project_info flex justify-between gap-3 pb-4 border-b border-line">
                                <div class="project_content">
                                    <a href="project-detail1.html" class="project_name heading6 duration-300 hover:underline">Website Design (Web & Responsive) for an Online Tutoring Website</a>
                                    <div class="project_related_info flex flex-wrap items-center gap-3 mt-3">
                                        <div class="project_date flex items-center gap-1">
                                            <span class="ph ph-calendar-blank text-xl text-secondary"></span>
                                            <span class="caption1 text-secondary">2 days ago</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span class="ph ph-map-pin text-xl text-secondary"></span>
                                            <span class="project_address -style-1 caption1 text-secondary">Las Vegas, USA</span>
                                        </div>
                                        <div class="project_spent flex items-center gap-1">
                                            <span class="caption1 text-secondary">$</span>
                                            <span class="caption1 text-secondary">2.8K</span>
                                            <span class="caption1 text-secondary">spent</span>
                                        </div>
                                    </div>
                                    <p class="project_desc mt-3 text-secondary">I am looking for a talented UX/UI Designer to create screens for my basic product idea. The project involves designing a web application, you may be missing out on some big opportunities.</p>
                                    <div class="list_tag flex items-center gap-2.5 flex-wrap mt-3">
                                        <a href="project-default.html" class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary">Graphic Design</a>
                                        <a href="project-default.html" class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary">Website Design</a>
                                        <a href="project-default.html" class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary">Figma</a>
                                    </div>
                                </div>
                                <button class="add_wishlist_btn -relative -border">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                            </div>
                            <div class="project_more_info flex items-center justify-between pt-4">
                                <div class="project_proposals">
                                    <span class="text-secondary">Proposals: </span>
                                    <span class="proposals">50+</span>
                                </div>
                                <div class="project_price">
                                    <span class="price text-title">$50-$70</span>
                                    <span class="text-secondary">/hours</span>
                                </div>
                            </div>
                        </div>
                        <div class="project_action mt-3">
                            <a href="project-detail1.html" class="project_apply_btn button-main -border w-full">Apply now</a>
                        </div>
                    </li>
                    <li class="project_item p-6 rounded-lg bg-white duration-300 shadow-md animate animate_top" style="--i: 4">
                        <div class="project_innner">
                            <div class="project_info flex justify-between gap-3 pb-4 border-b border-line">
                                <div class="project_content">
                                    <a href="project-detail1.html" class="project_name heading6 duration-300 hover:underline">UX/UI Designer | Web Designer to Redesign the First Screen of the Main Page</a>
                                    <div class="project_related_info flex flex-wrap items-center gap-3 mt-3">
                                        <div class="project_date flex items-center gap-1">
                                            <span class="ph ph-calendar-blank text-xl text-secondary"></span>
                                            <span class="caption1 text-secondary">2 days ago</span>
                                        </div>
                                        <div class="flex items-center gap-1">
                                            <span class="ph ph-map-pin text-xl text-secondary"></span>
                                            <span class="project_address -style-1 caption1 text-secondary">Las Vegas, USA</span>
                                        </div>
                                        <div class="project_spent flex items-center gap-1">
                                            <span class="caption1 text-secondary">$</span>
                                            <span class="caption1 text-secondary">2.8K</span>
                                            <span class="caption1 text-secondary">spent</span>
                                        </div>
                                    </div>
                                    <p class="project_desc mt-3 text-secondary">I am looking for a talented UX/UI Designer to create screens for my basic product idea. The project involves designing a web application, you may be missing out on some big opportunities.</p>
                                    <div class="list_tag flex items-center gap-2.5 flex-wrap mt-3">
                                        <a href="project-default.html" class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary">Graphic Design</a>
                                        <a href="project-default.html" class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary">Website Design</a>
                                        <a href="project-default.html" class="project_tag tag bg-surface caption1 hover:text-white hover:bg-primary">Figma</a>
                                    </div>
                                </div>
                                <button class="add_wishlist_btn -relative -border">
                                    <span class="ph ph-heart text-xl"></span>
                                    <span class="ph-fill ph-heart text-xl"></span>
                                    <span class="blind">button add to wishlist</span>
                                </button>
                            </div>
                            <div class="project_more_info flex items-center justify-between pt-4">
                                <div class="project_proposals">
                                    <span class="text-secondary">Proposals: </span>
                                    <span class="proposals">50+</span>
                                </div>
                                <div class="project_price">
                                    <span class="price text-title">$20-$30</span>
                                    <span class="text-secondary">/hours</span>
                                </div>
                            </div>
                        </div>
                        <div class="project_action mt-3">
                            <a href="project-detail1.html" class="project_apply_btn button-main -border w-full">Apply now</a>
                        </div>
                    </li>
                </ul>
                <div class="view_all md:mt-10 mt-7 text-center animate animate_top" style="--i: 5">
                    <a href="project-default.html" class="text-button pb-0.5 border-b-2 border-primary duration-300 hover:text-primary">View All Projects</a>
                </div>
            </div>
        </section>

        <!-- Testimonials -->
        <section class="testimonials lg:py-20 sm:py-14 py-10">
            <div class="container">
                <h3 class="heading3 text-center animate animate_top" style="--i: 1">Testimonials</h3>
                <p class="body2 text-secondary text-center mt-3 animate animate_top" style="--i: 2">Discover exceptional experiences through testimonials from our satisfied customers.</p>
                <div class="swiper -section swiper-list-testimonials style-2 md:pt-10 pt-7">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="testimonials_item p-7.5 bg-white rounded-lg duration-300 shadow-md animate animate_top" style="--i: 1">
                                <strong class="text-title">Choosing FreelanHub was the best decision we made for our business. Their expertise in SEO and digital marketing has significantly boosted our traffic and conversions.</strong>
                                <div class="testimonials_info flex items-center mt-5 gap-5">
                                    <div class="testimonials_avatar w-15 h-15 rounded-full overflow-hidden">
                                        <img src="assets/images/avatar/IMG-1.webp" alt="IMG-1" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="testimonials_user">
                                        <h6 class="testimonials_name heading6">Liam Anderson</h6>
                                        <span class="caption1 text-secondary">Head of Recruitment</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonials_item p-7.5 bg-white rounded-lg duration-300 shadow-md animate animate_top" style="--i: 2">
                                <strong class="text-title">Choosing FreelanHub was the best decision we made for our business. Their expertise in SEO and digital marketing has significantly boosted our traffic and conversions.</strong>
                                <div class="testimonials_info flex items-center mt-5 gap-5">
                                    <div class="testimonials_avatar w-15 h-15 rounded-full overflow-hidden">
                                        <img src="assets/images/avatar/IMG-2.webp" alt="IMG-2" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="testimonials_user">
                                        <h6 class="testimonials_name heading6">Emily Johnson</h6>
                                        <span class="caption1 text-secondary">Head of Recruitment</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonials_item p-7.5 bg-white rounded-lg duration-300 shadow-md animate animate_top" style="--i: 3">
                                <strong class="text-title">Choosing FreelanHub was the best decision we made for our business. Their expertise in SEO and digital marketing has significantly boosted our traffic and conversions.</strong>
                                <div class="testimonials_info flex items-center mt-5 gap-5">
                                    <div class="testimonials_avatar w-15 h-15 rounded-full overflow-hidden">
                                        <img src="assets/images/avatar/IMG-3.webp" alt="IMG-3" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="testimonials_user">
                                        <h6 class="testimonials_name heading6">Alexander Peter</h6>
                                        <span class="caption1 text-secondary">Head of Recruitment</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="testimonials_item p-7.5 bg-white rounded-lg duration-300 shadow-md animate animate_top" style="--i: 4">
                                <strong class="text-title">Choosing FreelanHub was the best decision we made for our business. Their expertise in SEO and digital marketing has significantly boosted our traffic and conversions.</strong>
                                <div class="testimonials_info flex items-center mt-5 gap-5">
                                    <div class="testimonials_avatar w-15 h-15 rounded-full overflow-hidden">
                                        <img src="assets/images/avatar/IMG-4.webp" alt="IMG-4" class="w-full h-full object-cover" />
                                    </div>
                                    <div class="testimonials_user">
                                        <h6 class="testimonials_name heading6">Emily Johnson</h6>
                                        <span class="caption1 text-secondary">Head of Recruitment</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </section>

        <!-- Counter -->
        <section class="counter lg:py-15 sm:py-12 py-8 bg-[#FAF7F1]">
            <div class="container flex max-lg:flex-wrap items-center justify-between max-lg:gap-y-8">
                <div class="item max-lg:flex max-lg:flex-col max-lg:w-1/2 animate animate_top" style="--i: 1">
                    <h2 class="heading2 pb-1 text-center">2,5M+</h2>
                    <span class="body1 text-center">Jobs Available</span>
                </div>
                <div class="line flex-shrink-0 w-px h-20 bg-line max-lg:hidden"></div>
                <div class="item max-lg:flex max-lg:flex-col max-lg:w-1/2 animate animate_top" style="--i: 2">
                    <h2 class="heading2 pb-1 text-center">177k+</h2>
                    <span class="body1 text-center">New Jobs This Week!</span>
                </div>
                <div class="line flex-shrink-0 w-px h-20 bg-line max-lg:hidden"></div>
                <div class="item max-lg:flex max-lg:flex-col max-lg:w-1/2 animate animate_top" style="--i: 3">
                    <h2 class="heading2 pb-1 text-center">298k+</h2>
                    <span class="body1 text-center">Companies Hiring</span>
                </div>
                <div class="line flex-shrink-0 w-px h-20 bg-line max-lg:hidden"></div>
                <div class="item max-lg:flex max-lg:flex-col max-lg:w-1/2 animate animate_top" style="--i: 4">
                    <h2 class="heading2 pb-1 text-center">5M+</h2>
                    <span class="body1 text-center">Total Freelancers</span>
                </div>
            </div>
        </section>

        <!-- Blog -->
        <section class="blog lg:py-20 sm:py-14 py-10">
            <div class="container">
                <h3 class="heading3 text-center animate animate_top" style="--i: 1">Guide To Help You Grow</h3>
                <p class="body2 text-secondary text-center mt-3 animate animate_top" style="--i: 2">Find the right career opportunity for you</p>
                <ul class="list_blog grid lg:grid-cols-3 sm:grid-cols-2 lg:gap-7.5 gap-6 md:mt-10 mt-7">
                    <li class="blog_item animate animate_top" style="--i: 1">
                        <a href="blog-detail1.html" class="blog_thumb block overflow-hidden rounded-xl">
                            <img src="assets/images/blog/1.webp" alt="1" class="blog_img w-full" />
                        </a>
                        <div class="blog_info flex items-center gap-2 mt-5">
                            <span class="blog_date caption1">February 28, 2024</span>
                            <div class="line w-px h-3 bg-line"></div>
                            <a href="blog-default.html" class="caption1 duration-300 hover:text-primary">Freelancers</a>
                        </div>
                        <a href="blog-detail1.html" class="heading5 blog_title mt-3 hover:underline">Boosting your freelancing game: AI tools for enhanced efficiency</a>
                        <p class="blog_desc mt-2 text-secondary">AI tools have emerged as a powerful ally for freelancers across diverse fields.</p>
                    </li>
                    <li class="blog_item animate animate_top" style="--i: 2">
                        <a href="blog-detail1.html" class="blog_thumb block overflow-hidden rounded-xl">
                            <img src="assets/images/blog/2.webp" alt="2" class="blog_img w-full" />
                        </a>
                        <div class="blog_info flex items-center gap-2 mt-5">
                            <span class="blog_date caption1">February 28, 2024</span>
                            <div class="line w-px h-3 bg-line"></div>
                            <a href="blog-default.html" class="caption1 duration-300 hover:text-primary">Developement</a>
                        </div>
                        <a href="blog-detail1.html" class="heading5 blog_title mt-3 hover:underline">5 ways to enhance your business website in 2024</a>
                        <p class="blog_desc mt-2 text-secondary">If it's been a while since your last website upgrade, you may be missing out on some big opportunities.</p>
                    </li>
                    <li class="blog_item max-lg:hidden animate animate_top" style="--i: 3">
                        <a href="blog-detail1.html" class="blog_thumb block overflow-hidden rounded-xl">
                            <img src="assets/images/blog/3.webp" alt="3" class="blog_img w-full" />
                        </a>
                        <div class="blog_info flex items-center gap-2 mt-5">
                            <span class="blog_date caption1">February 28, 2024</span>
                            <div class="line w-px h-3 bg-line"></div>
                            <a href="blog-default.html" class="caption1 duration-300 hover:text-primary">Marketing</a>
                        </div>
                        <a href="blog-detail1.html" class="heading5 blog_title mt-3 hover:underline">How No-Code Solutions Let You Build Apps Without Coding Skills</a>
                        <p class="blog_desc mt-2 text-secondary">In this blog article by our partner Appy Pie, we're exploring what no-code app development.</p>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Banner -->
        <section class="banner lg:pb-20 sm:pb-14 pb-10">
            <div class="container">
                <div class="banner_inner relative sm:px-16 px-8 py-16 overflow-hidden rounded-xl animate animateZoomOutUp" style="--i: 5">
                    <div class="banner_bg absolute top-0 left-0 w-full h-full z-[-1]">
                        <img src="assets/images/components/banner1.webp" alt="banner1" class="w-full h-full object-cover" />
                    </div>
                    <div class="banner_content">
                        <h4 class="heading4 text-white animate animate_top" style="--i: 1">Embrace Independence <br class="max-sm:hidden" />Start Your Freelance Journey Now</h4>
                        <p class="desc mt-2 text-white animate animate_top" style="--i: 2">Connect with your Desginer in minutes</p>
                        <div class="md:mt-7 mt-5 animate animate_top" style="--i: 3">
                            <a href="become-seller.html" class="button-main bg-white">Become A Seller</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<?php include ('include/footer.php');?>

        <?php include ('include/mobile_menu.php');?>

    <?php include ('include/script.php');?>
    </body>

</html>
