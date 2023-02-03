<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Permission;

use Exception;
use IkonizerCore\PanelMenu\MenuModel;
use IkonizerCore\FormBuilder\ClientFormBuilder;
use IkonizerCore\FormBuilder\FormBuilderBlueprint;
use IkonizerCore\FormBuilder\ClientFormBuilderInterface;
use IkonizerCore\FormBuilder\FormBuilderBlueprintInterface;

class PermissionForm extends ClientFormBuilder implements ClientFormBuilderInterface
{

    /** @var FormBuilderBlueprintInterface $blueprint */
    private FormBuilderBlueprintInterface $blueprint;
    private MenuModel $model;

    /**
     * Main class constructor
     *
     * @param FormBuilderBlueprint $blueprint
     * @param MenuModel $model
     */
    public function __construct(FormBuilderBlueprint $blueprint, MenuModel $model)
    {
        $this->blueprint = $blueprint;
        $this->model = $model;
        parent::__construct();
    }

    /**
     * @return MenuModel
     */
    public function getModel(): MenuModel
    {
        return $this->model;
    }

    /**
     * @param string $action
     * @param object|null $dataRepository
     * @param object|null $callingController
     * @return string
     * @throws Exception
     */
    public function createForm(string $action, ?object $dataRepository = null, ?object $callingController = null): string
    {
        return $this->form(['action' => $action, 'class' => ['uk-form-stacked'], "id" => "permissionForm"])
            ->addRepository($dataRepository)
            ->add($this->blueprint->text('permission_name', [], $this->hasValue('permission_name')))
           ->add($this->blueprint->select(
               'resource_group',
               ['uk-select'],
               'resource_group',
               10,
               false,
           ),
           $this->blueprint->choices(
               array_column($this->model->getRepo()->findBy(['menu_name']), 'menu_name'),
               $this->hasValue('resource_group'),
               $this
           ),
           $this->blueprint->settings(
               false, 
               null, 
               true, 
               'Permission Group', 
               true, 
               null, 
               'Permission group or resource group allows us to group permission under a single resource. i.e all user permissions can be group under the user resource.')
           )

            ->add($this->blueprint->textarea('permission_description', ['uk-textarea'], 'permission_name'), $this->hasValue('permission_description'))
            ->add(
                $this->blueprint->submit(
                    $this->hasValue('id') ? 'edit-permission' : 'new-permission',
                    ['uk-button', 'uk-button-primary', 'uk-form-width-medium'],
                    'Save'
                ),
                null,
                $this->blueprint->settings(false, null, false, null, true)
            )
            ->build(['before' => '<div class="uk-margin">', 'after' => '</div>']);
    }
}
