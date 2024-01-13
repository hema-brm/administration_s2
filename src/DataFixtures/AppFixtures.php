<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const EMPLOYEE_COUNT = 100;
    const CUSTOMER_COUNT = 25;
    const COMPANY_COUNT = 5;
    const COMPANY_OWNER_COUNT = 10;
    const PRODUCT_COUNT = 100;
    const CATEGORY_COUNT = 10;

    public function load(ObjectManager $manager): void
    {

    }
}
