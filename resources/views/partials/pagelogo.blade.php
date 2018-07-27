
    <section class="h-events" style="background-image: url({{ $background }})">
        <div class="container">
            <div class="row">
                <h1 class="title wow fadeInUp">{!! $title !!}</h1>
                @if(!empty($breadcrumbs))
                    {{ Breadcrumbs::render(Request::route()->getName(), $breadcrumbs) }}
                @else
                    {{ Breadcrumbs::render() }}
                @endif

                @if(!empty($item))
                    <div class="article-info">
                        <div class="author wow slideInLeft" data-wow-delay='.1s'>Автор: <a href="#">{{ $item['user']['name'] . ' ' . $item['user']['lastname'] }}</a></div>
                        <div class="category wow slideInLeft" data-wow-delay='.3s'>Категория: {{ $item['category']['name'] }}</div>
                        <?php $created_at = new \Jenssegers\Date\Date($item['created_at']) ?>
                        <div class="date-publication wow slideInLeft" data-wow-delay='.5s'>Дата публикации: {{ $created_at->format('d.m.Y') }}</div>
                    </div>
                @endif
            </div>
        </div>
    </section>

