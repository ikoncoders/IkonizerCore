<?php
declare(strict_types=1);

namespace IkonizerCore\Widget;

use IkonizerCore\Widget\Widget;
use IkonizerCore\Widget\WidgetInterface;
use IkonizerCore\Widget\Exception\WidgetException;
use IkonizerCore\DataObjectLayer\ClientRepository\ClientRepository;

class WidgetFactory
{

    /**
     * Create the widget instance
     *
     * @param string|null $clientFactory
     * @param array $widgets
     * @param array $config
     * @return WidgetInterface
     */
    public function create(?string $clientFactory = null, array $widgets = [], array $config = []): WidgetInterface
    {
        $this->throwException($widgets);
        list($widget, $tableSchema, $tableSchemaID) = $this->resolveWidgetsArray($widgets);
        if (is_null($tableSchema) || is_null($tableSchemaID)) {
            $clientFactoryObject = new $clientFactory($widget, '', '');
        } else {
            $clientFactoryObject = new $clientFactory($widget, $tableSchema, $tableSchemaID);
        }
        if ($clientFactoryObject !==null) {
            $clientRepo = $clientFactoryObject->create(ClientRepository::class, $config);
        }

        return new Widget($clientRepo, $this->resolveWidgetsArray($widgets));
    }

    /**
     * throw an exception
     *
     * @param array $widgets
     * @return void
     */
    private function throwException(array $widgets = []): void
    {
        if (count($widgets) < 0) {
            throw new WidgetException(sprintf('Invalid second argument. Please list your widget as an array.', implode(', ', $widgets)));
        }

    }

    /**
     * Resolve the widgets array and extract the widget name and properties for the 
     * widgets
     *
     * @param array $widgets
     * @return array|boolean
     */
    private function resolveWidgetsArray(array $widgets = []): array|bool
    {
        if (count($widgets) > 0) {
            foreach ($widgets as $name => $params) {
                return [
                    $name,
                    $params['table'],
                    $params['table_id']
                ];
            }
        }
        return false;
    }

}