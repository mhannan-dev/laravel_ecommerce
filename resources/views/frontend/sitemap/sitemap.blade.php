@php echo '<?xml version="1.0" encoding="UTF-8"@endphp'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">



    @foreach ($products as $post)
        <url>
            <loc>{{ url($post->slug) }}</loc>
            <lastmod>{{ $post->created_at }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.64</priority>
        </url>
    @endforeach
    @foreach ($categories as $category)
        <url>
            <loc>{{ url($category->slug) }}</loc>
            <lastmod>{{ $category->created_at }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.64</priority>
        </url>
    @endforeach
    @foreach ($brands as $brand)
        <url>
            <loc>{{ url($brand->slug) }}</loc>
            <lastmod>{{ $brand->created_at }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.64</priority>
        </url>
    @endforeach
</urlset>
