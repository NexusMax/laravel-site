@if (count($breadcrumbs))

    <div class="breadcrumbs wow fadeInLeft">

        <ul itemscope itemtype="http://schema.org/BreadcrumbList">
        @foreach ($breadcrumbs as $breadcrumb)
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                @if ($breadcrumb->url && !$loop->last)
                    <a itemprop="item" href="{{ $breadcrumb->url }}"><span itemprop="name">{{ $breadcrumb->title }}</span></a> >
                @else
                    {{ $breadcrumb->title }}
                @endif
                <meta itemprop="position" content="<?= $loop->iteration ?>" />
            </li>
        @endforeach
        </ul>

    </div>

@endif