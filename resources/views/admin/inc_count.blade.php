<div class="row">
    <x-admin.dashboard.color-card
        :count="$card['blog_cat_count']"
        :title="__('admin/blogPost.app_menu_category')"
        icon="fas fa-sitemap"
        bg="i"
        :url="route('admin.Blog.BlogCategory.index')"
    />

    <x-admin.dashboard.color-card
        :count="$card['blog_count']"
        :title="__('admin/blogPost.app_menu_blog')"
        icon="fab fa-blogger"
        bg="p"

    />

    <x-admin.dashboard.color-card
        :count="$card['blog_count_active']"
        :title="__('admin/blogPost.dash_count_active')"
        icon="far fa-check-square"
        bg="s"
        :url="route('admin.Blog.BlogPost.index')"
    />

    <x-admin.dashboard.color-card
        :count="$card['blog_count_unactive']"
        :title="__('admin/blogPost.dash_count_unactive')"
        icon="fas fa-trash-alt"
        bg="d"
        :url="route('admin.Blog.BlogPost.index_draft')"
    />
</div>


