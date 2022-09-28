<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }} {{ request()->is("admin/audit-logs*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items ml-2">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('product_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/product-categories*") ? "c-show" : "" }} {{ request()->is("admin/product-tags*") ? "c-show" : "" }} {{ request()->is("admin/products*") ? "c-show" : "" }} {{ request()->is("admin/best-sellers*") ? "c-show" : "" }} {{ request()->is("admin/featured-products*") ? "c-show" : "" }} {{ request()->is("admin/spesial-offers*") ? "c-show" : "" }} {{ request()->is("admin/*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-shopping-cart c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.productManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items ml-2">
                    @can('product_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-categories") || request()->is("admin/product-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.product-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-tags") || request()->is("admin/product-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-folder c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.productTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/products") || request()->is("admin/products/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-shopping-cart c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.product.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('best_seller_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.best-sellers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/best-sellers") || request()->is("admin/best-sellers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-ambulance c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bestSeller.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('featured_product_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.featured-products.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/featured-products") || request()->is("admin/featured-products/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.featuredProduct.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('spesial_offer_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.spesial-offers.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/spesial-offers") || request()->is("admin/spesial-offers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-justify c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.spesialOffer.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('banner_setting_access')
                        <li class="c-sidebar-nav-dropdown {{ request()->is("admin/fludgy-flavors*") ? "c-show" : "" }} {{ request()->is("admin/personalized-ones*") ? "c-show" : "" }} {{ request()->is("admin/personalized-twos*") ? "c-show" : "" }} {{ request()->is("admin/personalized-trees*") ? "c-show" : "" }} {{ request()->is("admin/product-banner-ones*") ? "c-show" : "" }} {{ request()->is("admin/product-banner-twos*") ? "c-show" : "" }}">
                            <a class="c-sidebar-nav-dropdown-toggle" href="#">
                                <i class="fa-fw fas fa-luggage-cart c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bannerSetting.title') }}
                            </a>
                            <ul class="c-sidebar-nav-dropdown-items ml-2">
                                @can('fludgy_flavor_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.fludgy-flavors.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/fludgy-flavors") || request()->is("admin/fludgy-flavors/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-cookie c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.fludgyFlavor.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('personalized_one_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.personalized-ones.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/personalized-ones") || request()->is("admin/personalized-ones/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.personalizedOne.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('personalized_two_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.personalized-twos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/personalized-twos") || request()->is("admin/personalized-twos/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.personalizedTwo.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('personalized_tree_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.personalized-trees.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/personalized-trees") || request()->is("admin/personalized-trees/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.personalizedTree.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('product_banner_one_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.product-banner-ones.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-banner-ones") || request()->is("admin/product-banner-ones/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.productBannerOne.title') }}
                                        </a>
                                    </li>
                                @endcan
                                @can('product_banner_two_access')
                                    <li class="c-sidebar-nav-item">
                                        <a href="{{ route("admin.product-banner-twos.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/product-banner-twos") || request()->is("admin/product-banner-twos/*") ? "c-active" : "" }}">
                                            <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                            </i>
                                            {{ trans('cruds.productBannerTwo.title') }}
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('news_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/news-categories*") ? "c-show" : "" }} {{ request()->is("admin/news-tags*") ? "c-show" : "" }} {{ request()->is("admin/newss*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-bullhorn c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.newsManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items ml-2">
                    @can('news_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.news-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/news-categories") || request()->is("admin/news-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-angle-double-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.newsCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('news_tag_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.news-tags.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/news-tags") || request()->is("admin/news-tags/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-tags c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.newsTag.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('news_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.newss.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/newss") || request()->is("admin/newss/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-paper-plane c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.news.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('store_setting_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/clients*") ? "c-show" : "" }} {{ request()->is("admin/about-images*") ? "c-show" : "" }} {{ request()->is("admin/what-we-haves*") ? "c-show" : "" }} {{ request()->is("admin/social-media*") ? "c-show" : "" }} {{ request()->is("admin/setting-contents*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.storeSetting.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items ml-2">
                    @can('client_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.clients.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/clients") || request()->is("admin/clients/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-solar-panel c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.client.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('about_image_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.about-images.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/about-images") || request()->is("admin/about-images/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-justify c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.aboutImage.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('what_we_have_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.what-we-haves.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/what-we-haves") || request()->is("admin/what-we-haves/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.whatWeHave.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('social_medium_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.social-media.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/social-media") || request()->is("admin/social-media/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-envelope c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.socialMedium.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('setting_content_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.setting-contents.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/setting-contents") || request()->is("admin/setting-contents/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-align-left c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.settingContent.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('order_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/orders*") ? "c-show" : "" }} {{ request()->is("admin/order-details*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-archive c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.orderManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items ml-2">
                    @can('order_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.orders.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/orders") || request()->is("admin/orders/*") ? "c-active" : "" }}">
                                <i class="fa-fw fab fa-amazon-pay c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.order.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('order_detail_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.order-details.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/order-details") || request()->is("admin/order-details/*") ? "c-active" : "" }}">
                                <i class="fa-fw far fa-calendar-check c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.orderDetail.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>