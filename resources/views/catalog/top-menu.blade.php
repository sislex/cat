<li>
    <a href="/catalog/index">
        Каталог
    </a>
</li>

@foreach(\App\Content::getTopMenu() as $menu_element)
    @if($menu_element['published'] && isset($menu_element['type']))
        @if($menu_element['type'] == 'menu')
            <li>
                <a href="{{ action('Catalog\CatalogController@menu', ['pseudo_url' =>  $menu_element['pseudo_url']]) }}">
                    {{ $menu_element['menu'] }}
                </a>
                @if(isset($menu_element['children']) && is_array($menu_element['children']) && count($menu_element['children']))
                    <ul class="dropdown">
                        @foreach($menu_element['children'] as $first_child)
                            @if($first_child['published'])
                                <li>
                                    <a href="{{ action('Catalog\CatalogController@menu', ['pseudo_url' =>  $first_child['pseudo_url']]) }}">
                                        {{ $first_child['menu'] }}
                                    </a>
                                    @if(isset($first_child['children']) && is_array($first_child['children']) && count($first_child['children']))
                                        <ul class="dropdown">
                                            @foreach($first_child['children'] as $second_child)
                                                @if($second_child['published'])
                                                    <li>
                                                        <a href="{{ action('Catalog\CatalogController@menu', ['pseudo_url' =>  $second_child['pseudo_url']]) }}">
                                                            {{ $second_child['menu'] }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endforeach
                    </ul>
                @endif
            </li>
        @elseif($menu_element['type'] == 'news')
            <li>
                <a href="{{ action('Catalog\CatalogController@news_index') }}">
                    {{ $menu_element['menu'] }}
                </a>
            </li>
        @elseif($menu_element['type'] == 'blog')
            <li>
                <a href="{{ action('Catalog\CatalogController@blog_index') }}">
                    {{ $menu_element['menu'] }}
                </a>
            </li>
        @endif
    @endif
@endforeach