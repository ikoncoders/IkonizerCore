<?php
declare(strict_types=1);

namespace IkonizerCore\UserManager\Rbac\Form;

use Exception;
use IkonizerCore\DataObjectLayer\DataLayerTrait;
use IkonizerCore\FormBuilder\ClientFormBuilder;
use IkonizerCore\FormBuilder\ClientFormBuilderInterface;
use IkonizerCore\FormBuilder\FormBuilderBlueprint;
use IkonizerCore\FormBuilder\FormBuilderBlueprintInterface;
use IkonizerCore\UserManager\Rbac\Permission\PermissionModel;
use IkonizerCore\UserManager\Rbac\Model\RolePermissionModel;

class RoleAssignedForm extends ClientFormBuilder implements ClientFormBuilderInterface
{

    use DataLayerTrait;

    /** @var FormBuilderBlueprintInterface $blueprint */
    private FormBuilderBlueprintInterface $blueprint;
    private PermissionModel $permissions;
    private RolePermissionModel $rolePerm;

    /**
     * Main class constructor
     *
     * @param FormBuilderBlueprint $blueprint
     * @param PermissionModel $permissions
     * @param RolePermissionModel $rolePerm
     */
    public function __construct(FormBuilderBlueprint $blueprint, PermissionModel $permissions, RolePermissionModel $rolePerm)
    {
        $this->blueprint = $blueprint;
        $this->permissions = $permissions;
        $this->rolePerm = $rolePerm;
        parent::__construct();
    }

    /**
     * @return PermissionModel
     */
    public function getModel(): PermissionModel
    {
        return $this->permissions;
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
        $defaults = $this->flattenArray($this->rolePerm->getRepo()->findBy(['permission_id'], ['role_id' => $callingController->thisRouteID()]));
        return $this->form(['action' => $action, 'class' => ['uk-form-stacked'], "id" => "role_assigned_form"])
            ->addRepository($dataRepository)
            ->add($this->blueprint->text(
                'role_name',
                [],
                $this->hasValue('role_name'),
                true),
                NULL,
                $this->blueprint->settings(false, null, true, null, true, null, 'Role name cannot be changed here?'))
            ->add($this->blueprint->hidden('role_id', $dataRepository->id), NULL, $this->blueprint->settings(false, null, false, null, true, null))
            ->add($this->blueprint->select(
                'permission_id[]',
                ['uk-select'],
                'permission_id',
                20,
                true,
                ),
                $this->blueprint->choices(
                    array_column($this->permissions->getRepo()->findBy(['id']), 'id'),
                    /* need to return a list of permission assigned to the role */
                    $defaults,
                    $this
                ),
                $this->blueprint->settings(false, null, true, 'Permissions', true, 'Select one one or more permissions'))

            ->add(
                $this->blueprint->submit(
                    'assigned-role',
                    ['uk-button', 'uk-button-primary', 'uk-form-width-medium'],
                    'Save'
                ),
                null,
                $this->blueprint->settings(false, null, false, null, true)
            )
            ->build(['before' => '<div class="uk-margin">', 'after' => '</div>']);
    }
}
