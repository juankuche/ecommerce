<?php
/**
 * Copyright © Nguyen Huu The <thenguyen.dev@gmail.com>.
 * See COPYING.txt for license details.
 */

declare(strict_types=1);

namespace Similik\Module\Discount\Middleware\Edit;

use function Similik\_mysql;
use function Similik\get_js_file_url;
use Similik\Module\Graphql\Services\GraphqlExecutor;
use Similik\Services\Http\Request;
use Similik\Services\Http\Response;
use Similik\Middleware\MiddlewareAbstract;
use Similik\Services\Routing\Router;

class LoadCustomerGroupMiddleware extends MiddlewareAbstract
{
    /**
     * @param Request $request
     * @param Response $response
     * @param null $delegate
     * @return mixed
     */
    public function __invoke(Request $request, Response $response, $delegate = null)
    {
        $response->addState('customerGroups',
            _mysql()->getTable('customer_group')
                ->addFieldToSelect('customer_group_id', 'value')
                ->addFieldToSelect('group_name', 'text')
                ->where('customer_group_id', '<>', 1000)
                ->fetchAllAssoc());

        return $delegate;
    }
}