<?php
declare(strict_types=1);

namespace IkonizerCore\Base\Domain\Actions;

use IkonizerCore\Base\Domain\DomainTraits;
use IkonizerCore\Base\Domain\DomainActionLogicInterface;

/**
 * Class which handles the domain logic when adding a new item to the database
 * items are sanitize and validated before persisting to database. The class will 
 * also dispatched any validation error before persistence. The logic also implements
 * event dispatching which provide usable data for event listeners to perform other
 * necessary tasks and message flashing
 */
class LoginAction implements DomainActionLogicInterface
{

    use DomainTraits;

    /**
     * execute logic for adding new items to the database()
     *
     * @param Object $controller - The controller object implementing this object
     * @param string|null $entityObject
     * @param string|null $eventDispatcher - the eventDispatcher for the current object
     * @param string|null $objectSchema
     * @param string $method - the name of the method within the current controller object
     * @param array $rules
     * @param array $additionalContext - additional data which can be passed to the event dispatcher
     * @return LoginAction
     */
    public function execute(
        object $controller,
        ?string $entityObject,
        ?string $eventDispatcher,
        ?string $objectSchema,
        string $method,
        array $rules = [],
        array $additionalContext = [],
        mixed $optional = null
    ): self {

        $this->controller = $controller;
        $this->method = $method;
        $this->schema = $objectSchema;
        $formBuilder = $controller->formBuilder;

        if (isset($formBuilder) && $formBuilder?->isFormvalid($this->getSubmitValue())):
            if ($formBuilder?->csrfValidate()) {
                if ($controller->authenticator->getValidatedUser($controller)) {
                    $controller->authenticator->getLogin();
                    if ($controller->authenticator->getAction() === true) {
                        $this->dispatchSingleActionEvent(
                            $controller,
                            $eventDispatcher,
                            $method,
                            $controller->authenticator->getAuthUser(),
                            $additionalContext
                        );
                    }
                }
            }
            
        endif;
        return $this;
    }
}
