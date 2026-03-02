## TODO

## Тесты (локально)

Минимальные требования:
- PHP 8.0.2+
- Composer 2

Установка зависимостей:

```bash
composer install
```

Запуск всех тестов:

```bash
composer test
# или
vendor/bin/phpunit
```

Запуск одного теста:

```bash
vendor/bin/phpunit --filter ReadOnlyContainerTest
```

Покрытие:

```bash
composer test-coverage
```

Примечание по совместимости: поддерживаем расширение версий без удаления уже поддерживаемых диапазонов (например для Laravel 9 добавлены совместимые диапазоны `orchestra/testbench` и `phpunit`, при сохранении существующих).

## История версий
### 1.12
- добавлен CArr::merge() для рекурсивного слияния массивов

### 1.11
- добавлен Editable для форматирования текста в div->contenteditable

### 1.10
- добавлены email-шаблоны
- добавлены notification-шаблоны

### 1.09
- добавлены Translatable и TranslatableField

### 1.08
- Has::feature('config', 'feature') проверяет, включена ли фича в конфиге

### 1.07
- Settings вынесены в отдельный пакет nikservik/user-settings
- тестирование настроено отдельно, больше не нужно включать пакет в скелетон приложения, чтобы протестировать
- добавлены автотесты в Github Actions
- код приведен в порядок до уровня PHP7.4
- из зависимостей удален Laravel

### 1.06
- добавлено Number::pluralRu - добавляет правильную форму к числительному

### 1.05
- добавлен фасад Settings, который пока загружает настройки по умолчанию
- добавлен SettingsStorage
- SettingsStorage реализует SaveLoadInterface

### 1.04
- добавлено Number::ordinal() - добавляет количественное окончание st/nd/rt/th
- добавлено Number::between() - определяет, находится ли средний аргумент между крайними
- добавлены ReadOnlyContainer, ReadOnlyNamedContainer, ReadOnlyGeneratedContainer
