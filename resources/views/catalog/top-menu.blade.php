<li>
    <a href="/catalog/index">
        Каталог
    </a>
</li>

{{--*/ $menu = \App\Content::getTopMenu() /*--}}

@foreach($menu as $menu_element)
    <li>
        <a href="{{ action('Catalog\CatalogController@content', ['pseudo_url' =>  $menu_element['pseudo_url']]) }}">
            {{ $menu_element['menu'] }}
        </a>
        @if(isset($menu_element['children']) && is_array($menu_element['children']) && count($menu_element['children']))
            <ul class="dropdown">
                @foreach($menu_element['children'] as $first_child)
                    <li>
                        <a href="{{ action('Catalog\CatalogController@content', ['pseudo_url' =>  $first_child['pseudo_url']]) }}">
                            {{ $first_child['menu'] }}
                        </a>
                        @if(isset($first_child['children']) && is_array($first_child['children']) && count($first_child['children']))
                            <ul class="dropdown">
                                @foreach($first_child['children'] as $second_child)
                                    <li>
                                        <a href="{{ action('Catalog\CatalogController@content', ['pseudo_url' =>  $second_child['pseudo_url']]) }}">
                                            {{ $second_child['menu'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </li>
@endforeach