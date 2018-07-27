<div class="training-search-row clearfix">
    <form action="{{ url(Request::url()) }}" method="GET" class="box-shadow">
        <input required type="search" name="q" class="training-search" placeholder="@if(Request::is('*questions*')) Поиск @else Используйте поиск для быстрой навигации в этом разделе ... @endif" value="{{ old('q') }}">
    </form>
    <label><img src="/../../img/icons/search.png" alt="Поиск материалов"></label>
    <div class="training-sorting"><p>Сортировать: @sortablelink('created_at', 'Дата')</p></div>
</div>