<li class="nav-item  ">
    <a href="{{action('Admin\ItemsController@index')}}" class="nav-link nav-toggle">
        <i class="icon-diamond"></i>
        <span class="title">
            Каталог транспорта
        </span>
    </a>
</li>
<li class="nav-item  ">
    <a href="{{action('Admin\FiltersController@index')}}" class="nav-link nav-toggle">
        <i class="icon-puzzle"></i>
        <span class="title">
            Фильтры
        </span>
    </a>
</li>
<li class="nav-item  ">
    <a href="{{action('Admin\SpecificationsController@index')}}" class="nav-link nav-toggle">
        <i class="icon-puzzle"></i>
        <span class="title">
            Спецификации
        </span>
    </a>
</li>
<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-wallet"></i>
        <span class="title">
            Контентные страницы
        </span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="{{action('Admin\ContentController@showMainPage')}}" class="nav-link ">
                <span class="title">
                    Главная страница
                </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{action('Admin\ContentController@index', ['type' => 'menu'])}}" class="nav-link ">
                <span class="title">
                    Меню
                </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{action('Admin\ContentController@index', ['type' => 'news'])}}" class="nav-link ">
                <span class="title">
                    Новости
                </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{action('Admin\ContentController@index', ['type' => 'blog'])}}" class="nav-link ">
                <span class="title">
                    Блог
                </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{action('Admin\ContentController@index', ['type' => 'feedback'])}}" class="nav-link ">
                <span class="title">
                    Отзывы
                </span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item  ">
    <a href="javascript:;" class="nav-link nav-toggle">
        <i class="icon-briefcase"></i>
        <span class="title">
            Баннеры и слайдеры
        </span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item">
            <a href="{{action('Admin\UIComponentsController@show',['name' => 'main-slider'])}}" class="nav-link">
                <span class="title">
                    Основной слайдер
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{action('Admin\UIComponentsController@show',['name' => 'partners-slider'])}}" class="nav-link">
                <span class="title">
                    Лента партнеров
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{action('Admin\UIComponentsController@show',['name' => 'logo'])}}" class="nav-link nav-toggle">
                <span class="title">
                    Логотип
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{action('Admin\UIComponentsController@show',['name' => 'favicon'])}}" class="nav-link nav-toggle">
                <span class="title">
                    Иконка сайта
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{action('Admin\UIComponentsController@show',['name' => 'catalog-banner'])}}" class="nav-link nav-toggle">
                <span class="title">
                    Баннер каталога
                </span>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item  ">
    <a href="?p=" class="nav-link nav-toggle">
        <i class="icon-settings"></i>
        <span class="title">
            Настройки
        </span>
        <span class="arrow"></span>
    </a>
    <ul class="sub-menu">
        <li class="nav-item  ">
            <a href="{{action('Admin\SettingsController@currencies')}}" class="nav-link ">
                <span class="title">
                    Валюта
                </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{action('Admin\SettingsController@phones')}}" class="nav-link ">
                <span class="title">
                    Телефоны
                </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{action('Admin\SettingsController@email')}}" class="nav-link ">
                <span class="title">
                    Email
                </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="portlet_solid.html" class="nav-link ">
                <span class="title">
                    Цвета
                </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="{{action('Admin\SettingsController@counters')}}" class="nav-link nav-toggle">
                <span class="title">
                    Счетчики
                </span>
            </a>
        </li>
        <li class="nav-item  ">
            <a href="portlet_draggable.html" class="nav-link ">
                <span class="title">
                    Служебные файлы
                </span>
            </a>
        </li>
    </ul>
</li>