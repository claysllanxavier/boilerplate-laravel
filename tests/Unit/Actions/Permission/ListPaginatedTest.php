<?php

namespace Tests\Unit\Actions\Permission;

use Tests\TestCase;
use App\Models\Permission;
use App\Actions\Permission\ListPaginatedPermission;


class ListPaginatedTest extends TestCase
{
    const TOTAL_ITEMS = 25;

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test get paginated action
     *
     * @return void
     */
    public function testGetPaginatedPermissions()
    {
        $action =  resolve(ListPaginatedPermission::class);

        factory(Permission::class, 30)->create();

        $permissions = $action->execute();

        $this->assertCount(self::TOTAL_ITEMS, $permissions->toArray()['data']);
        $this->assertEquals(30, $permissions->toArray()['total']);
        $this->assertEquals(self::TOTAL_ITEMS, $permissions->toArray()['per_page']);
    }

    /**
     * Test get paginated action empty
     *
     * @return void
     */
    public function testGetPaginatedPermissionsEmpty()
    {
        $action =  resolve(ListPaginatedPermission::class);

        $permissions = $action->execute();

        $this->assertCount(0, $permissions->toArray()['data']);
        $this->assertEquals(0, $permissions->toArray()['total']);
        $this->assertEquals(self::TOTAL_ITEMS, $permissions->toArray()['per_page']);
    }

    /**
     * Test get paginated action equal items
     *
     * @return void
     */
    public function testGetPaginatedPermissionsEqualItems()
    {
        $action =  resolve(ListPaginatedPermission::class);

        factory(Permission::class, 25)->create();

        $permissions = $action->execute();

        $this->assertCount(self::TOTAL_ITEMS, $permissions->toArray()['data']);
        $this->assertEquals(25, $permissions->toArray()['total']);
        $this->assertEquals(self::TOTAL_ITEMS, $permissions->toArray()['per_page']);
    }

    /**
     * Test get paginated action change total items
     *
     * @return void
     */
    public function testGetPaginatedPermissionsChangeTotalItems()
    {
        $action =  resolve(ListPaginatedPermission::class);

        factory(Permission::class, 30)->create();

        $permissions = $action->execute(30);

        $this->assertCount(30, $permissions->toArray()['data']);
        $this->assertEquals(30, $permissions->toArray()['total']);
        $this->assertEquals(30, $permissions->toArray()['per_page']);
    }

    /**
     * Test get paginated action change total items
     *
     * @return void
     */
    public function testGetPaginatedPermissionsSomeColumns()
    {
        $action =  resolve(ListPaginatedPermission::class);

        factory(Permission::class, 30)->create();

        $permissions = $action->execute(
            self::TOTAL_ITEMS,
            array('id', 'name', 'description')
        );

        $this->assertCount(self::TOTAL_ITEMS, $permissions->toArray()['data']);
        $this->assertEquals(30, $permissions->toArray()['total']);
        $this->assertEquals(self::TOTAL_ITEMS, $permissions->toArray()['per_page']);
        $this->assertArrayNotHasKey('created_at', $permissions->toArray()['data'][0]);
        $this->assertArrayNotHasKey('updated_at', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('name', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('description', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('id', $permissions->toArray()['data'][0]);
    }
}
