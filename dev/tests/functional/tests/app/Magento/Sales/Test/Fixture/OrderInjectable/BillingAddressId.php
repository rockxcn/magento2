<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Sales\Test\Fixture\OrderInjectable;

use Magento\Customer\Test\Fixture\Address;
use Magento\Mtf\Fixture\FixtureFactory;
use Magento\Mtf\Fixture\DataSource;

/**
 * Billing address data.
 */
class BillingAddressId extends DataSource
{
    /**
     * Current preset.
     *
     * @var string
     */
    protected $currentPreset;

    /**
     * @constructor
     * @param FixtureFactory $fixtureFactory
     * @param array $data
     * @param array $params [optional]
     */
    public function __construct(FixtureFactory $fixtureFactory, array $data, array $params = [])
    {
        $this->params = $params;
        if (isset($data['value'])) {
            $this->data = $data['value'];
            return;
        }
        if (isset($data['dataSet'])) {
            $addresses = $fixtureFactory->createByCode('address', ['dataSet' => $data['dataSet']]);
            $this->data = $addresses->getData();
            $this->data['street'] = [$this->data['street']];
        }
        if (isset($data['billingAddress']) && $data['billingAddress'] instanceof Address) {
            /** @var Address $address */
            $address = $data['billingAddress'];
            $this->data = $address->getData();
            $this->data['street'] = [$this->data['street']];
        }
    }
}
