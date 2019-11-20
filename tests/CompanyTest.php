<?php
use PHPUnit\Framework\TestCase;
use RzVendors\Model\Company;

final class CompanyTest extends TestCase
{
    public function testCanFetchAll(): void
    {
        $company = new Company();
        $this->assertCount(4, $company->fetchAll());
    }
}