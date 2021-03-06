<?php

class AddressValueTest extends \AttributeValueTestCase
{

    protected function setUp()
    {
        $this->tables = array_merge($this->tables, array());

        $this->metadatas = array_merge($this->metadatas, array(
            'Concrete\Core\Entity\Attribute\Key\Settings\AddressSettings',
            'Concrete\Core\Entity\Attribute\Value\Value\AddressValue',
        ));
        parent::setUp();
    }

    public function getAttributeKeyHandle()
    {
        return 'addres';
    }

    public function getAttributeKeyName()
    {
        return 'Address';
    }

    public function createAttributeKeySettings()
    {
        return null;
    }

    public function getAttributeTypeHandle()
    {
        return 'address';
    }

    public function getAttributeTypeName()
    {
        return 'Address';
    }

    public function getAttributeValueClassName()
    {
        return 'Concrete\Core\Entity\Attribute\Value\Value\AddressValue';
    }

    protected function prepareBaseValueAfterRetrieving($value)
    {
        $value->setGenericValue(null);
        return $value;
    }

    protected function getAddress1($asObject = true)
    {
        if ($asObject) {
            $object = new \Concrete\Core\Entity\Attribute\Value\Value\AddressValue();
            $object->setAddress1('123 Fake St.');
            $object->setAddress2('Suite 100');
            $object->setCity('Portland');
            $object->setStateProvince('OR');
            $object->setCountry('US');
            $object->setPostalCode('90000');
            return $object;
        } else {
            return array(
                'address1' => '123 Fake St.',
                'address2' => 'Suite 100',
                'city' => 'Portland',
                'state_province' => 'OR',
                'country' => 'US',
                'postal_code' => '90000'
            );
        }
    }

    protected function getAddress2($asObject = true)
    {
        if ($asObject) {
            $object = new \Concrete\Core\Entity\Attribute\Value\Value\AddressValue();
            $object->setAddress1('500 SW Test');
            $object->setAddress2('Suite 1');
            $object->setCity('Toronto');
            $object->setStateProvince('ON');
            $object->setCountry('CA');
            $object->setPostalCode('M4V 1W6');
            return $object;
        } else {
            return array(
                'address1' => '500 SW Test',
                'address2' => 'Suite 1',
                'city' => 'Toronto',
                'state_province' => 'ON',
                'country' => 'CA',
                'postal_code' => 'M4V 1W6'
            );
        }
    }

    public function baseAttributeValues()
    {

        return array(
            array(
                $this->getAddress1(),
                $this->getAddress1(),
            ),
            array(
                $this->getAddress1(false),
                $this->getAddress1(),
            ),
            array(
                $this->getAddress2(),
                $this->getAddress2(),
            ),
            array(
                $this->getAddress2(false),
                $this->getAddress2(),
            ),
        );
    }

    public function displayAttributeValues()
    {
        return array(
            array(
                $this->getAddress1(),
                "123 Fake St.<br />\nSuite 100<br />\nPortland, Oregon 90000<br />\nUnited States"
            )
        );
    }

    public function plaintextAttributeValues()
    {
        return array(
            array(
                $this->getAddress1(),
                "123 Fake St.\nSuite 100\nPortland, Oregon 90000\nUnited States"
            )
        );
    }

    public function searchIndexAttributeValues()
    {
        return array(
            array(
                $this->getAddress2(),
                array(
                    'address1' => '500 SW Test',
                    'address2' => 'Suite 1',
                    'city' => 'Toronto',
                    'state_province' => 'ON',
                    'country' => 'CA',
                    'postal_code' => 'M4V 1W6'
                ),
            )
        );
    }



}
