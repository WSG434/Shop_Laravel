<h1 align="center">Интернет магазин 🛒️ </h1>
  <h3 align="center">Демо проект</h3>

![Shop_image1](https://github.com/WSG434/Shop/blob/master/resources/images/github/1.jpg?raw=true&#41;)
![Shop_image2](https://github.com/WSG434/Shop/blob/master/resources/images/github/2.jpg?raw=true&#41;)
![Shop_image3](https://github.com/WSG434/Shop/blob/master/resources/images/github/3.jpg?raw=true&#41;)
![Shop_image4](https://github.com/WSG434/Shop/blob/master/resources/images/github/4.jpg?raw=true&#41;)
![Shop_image5](https://github.com/WSG434/Shop/blob/master/resources/images/github/5.jpg?raw=true&#41;)
![Shop_image6](https://github.com/WSG434/Shop/blob/master/resources/images/github/6.jpg?raw=true&#41;)
![Shop_image7](https://github.com/WSG434/Shop/blob/master/resources/images/github/7.jpg?raw=true&#41;)

## 🚀 Стек

- PHP 8, Laravel 10, PHPUnit, Moonshine Admin Panel
- MySQL, Redis
- Docker, Sentry, Laravel Telescope, git

## 📚 Что интересного на проекте

### Архитектура
- `DDD` Разбиение проекта на домены и на ответственности; внесение изменений в autoload и в моделях
- `State Design Pattern` для работы со статусами заказа
- `EAV` модель - сущность, атрибут, значение; для карточки Продукта
- Паттерн `ViewModels` (для передачи данных на главную)
- Паттерн `Composite` (для меню)

### Backend
- Работа с `ORM Eloquent`: отношения, атрибуты, casts, valueobject, scope, querybuilder, collections; enum, MySQL json; Транзакции
- Работа с `traits`; создание и подключение своих трейтов
- Работа с `Service Provider`; добавление своих методов, регистрация и прокидывание своих провайдеров
- Работа с `Route`, удобное распредление роутов по папкам и добавление RouteLimit
- Работа с `Request/Validate`; создание кастомных `rules`, немного регулярок
- `Listeners/Notifications`; отправка писем на событие регистрации
- Работа с `API Github` для авторизации через github используя socialite
- Создание helpers и прокидывание в autoload
- Реализация кастомных flash уведомлений
- Создание своих `DTO`, `casts` (мобильный номер) , `ValueObjects` (для цены), `attributes` (подсчет стоимости)
- Работа с `Cache`; кэширование запросов
- Полнотекстовый Поиск, Сортировки, Фильтры; Работа с полнотекстовым поиском, немного Laravel Scout
- Интерфейсы.` Iterator, Countable, JsonSerializable` + создание своих
- `Queue/Job`; перегенерация json файликов о товарах + кэширование
- `Event/Listener;` при создании заказа
- `Exceptions`; создание своих кастомных исключений
- `Pipeline`; для работы с заказом
- `uuid`; использовал при реализации оплаты
- Заготовка для подключения эквайринг систем для оплаты
- Подключение Админки для добавления, удаления, изменения товаров

### Frontend
- Подключение и настройка `Vite`; установка `node, tailwind, sass, postcss`
- Работа с `Blade`;  верстка от верстальщика + оживление
- Работа с формами
- Работа с `aplineJS` (аналог `jQuery`)

### Окружение и отладка
- `xDebug`
- `Sentry`
- `Laravel Telescope`
- Debugbar for Laravel
- Telegram бот для уведомлений об ошибках и логах
- Дополнительные исключения на работу с БД, чтобы медленные запросы показывал и про filled чтобы напоминал в файле
- Кастомные консольные команды, алиасы
- stub, live templates
- `CI github actions `
- `CD` пока просто на хостинге через `docker` развернул, но планирую envoyer подключить

### Тестирование
- Настройка `phpunit.xml`
- Создание `.env.testing`
- Фабрики, создание крутых тестовых данных; работа с тестовыми картинками, создание сложных отношений для создания реалистичных данных
- `mock` тестирование немного; telegram, socialite github, очереди
- Тесты, тесты, тесты; разные, с разными условиями. Тесты БД, тесты корректное отображение страниц, тесты API, юнит тесты для valueObject например
- prehook на git commit, чтобы тесты перед коммитом автоматически запускались
