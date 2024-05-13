<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Storage;
use MoonShine\Decorations\Tab;
use MoonShine\Decorations\Tabs;
use MoonShine\Fields\Image;
use MoonShine\Fields\Number;
use MoonShine\Fields\Preview;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Relationships\BelongsToMany;
use MoonShine\Fields\Switcher;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Product>
 */
class ProductResource extends ModelResource
{
    protected string $model = Product::class;

    protected string $title = 'Products';

    protected array $with = [
        'brand',
        'categories',
        'properties',
        'optionvalues'
    ];

    protected string $sortColumn = 'ID'; // Поле сортировки по умолчанию

    protected string $sortDirection = 'ASC'; // Тип сортировки по умолчанию

    protected int $itemsPerPage = 25; // Количество элементов на странице

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Tabs::make([
                Tab::make('Product', [
                    ID::make()->sortable(),
                    Text::make('Товар', 'title' ),
                    BelongsTo::make('Бренд', 'brand', resource: new BrandResource()),
                    Text::make('Цена', 'price'),
                    Number::make('sorting', 'sorting')
                        ->sortable()
                        ->min(1)
                        ->max(999)
                        ->hideOnIndex(),
                    Preview::make('Тумбик', 'thumbnail')
                        ->image(),
                    Switcher::make('On home page'),
                ]),

                Tab::make('Categories', [
                    BelongsToMany::make('Категория', 'categories', resource: new CategoryResource())
                        ->hideOnIndex()
                ]),

                Tab::make('Properties', [
                    BelongsToMany::make('Характеристики', 'properties', resource: new PropertyResource())
                        ->fields([
                            Text::make('value')
                        ])
                        ->hideOnIndex()
                ]),

                Tab::make('Options', [
                    BelongsToMany::make('Опции', 'optionValues', resource: new OptionResource())
                        ->hideOnIndex()
                ]),
            ]),
        ];
    }


    /**
     * @param Product $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }

    public function search(): array
    {
        return ['title'];
    }
}
