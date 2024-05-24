require([
    'jquery' // Assuming you need jQuery
], function ($) {
    $(document).ready(function () {
        let category = '';
        let page = '1';

        reloadBlog();

        $('#blog-btn-search').on('click', function() {
            page = '1';
            reloadBlog();
        });

        $('.blog-category').on("click", function() {
            page = '1';
            category = $(this).data('id');
            reloadBlog();
        });

        $('#blog-items-per-page').on('change', function() {
            page = '1';
            reloadBlog();
        });

        function reloadBlog() {
            let url = new URL('/aht_blog/blog/listdata', window.location.href);

            url.searchParams.set('search', $('#blog-search').val());
            url.searchParams.set('category', category);
            url.searchParams.set('ipp', $('#blog-items-per-page').val());
            url.searchParams.set('page', page);

            $.ajax({
                url: url.toString()
            }).done(function(res) {
                $('.blog-container').empty();
                res['data'].forEach(element => {
                    $('.blog-container').append(`    
                        <div class="blog-card">
                            <img src="${element['thumbnail']}" height="200" width="200" />
                            <div style="display: inline-block;">
                                <span class="blog-link-container">
                                    <a class="blog-link" href="/aht_blog/blog/detail/blog_id/${element['blog_id']}">Name: ${element['title']}</a>
                                </span>
                                <span>&emsp;&emsp;</span>
                                <span>Author: ${element['username']}</span>
                                <p>Description: ${element['description']}</p>
                                <p>Content: ${element['content']}</p>
                            </div>
                        </div>
                    `);
                });

                $('.pagination-container').empty();
                let pages = Math.ceil(res['total_records'] / $('#blog-items-per-page').val());
                for (let i = 1; i <= pages; i++) {
                    $('.pagination-container').append(`<button class="btn-pager" data-val="${i}">${i}</button>`);
                }

                $('.btn-pager').on('click', function() {
                    page = $(this).data('val');
                    reloadBlog();
                });
            });
        }
    });
});