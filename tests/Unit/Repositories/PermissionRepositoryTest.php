<?php

namespace Tests\Unit\Repositories;

use App\Models\Permission;
use App\Repositories\Eloquent\PermissionRepository;
use Tests\TestCase;

class PermissionRepositoryTest extends TestCase
{
    protected $permissionRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->permissionRepository = new PermissionRepository(new Permission());
    }


    public function testGetPaginatedPermissionsWithTwentyFiveItemsPerPage()
    {
        factory(Permission::class, 30)->create();

        $permissions = $this->permissionRepository->getPaginated();

        $this->assertCount(25, $permissions->toArray()['data']);
        $this->assertEquals(30, $permissions->toArray()['total']);
        $this->assertEquals(25, $permissions->toArray()['per_page']);
        $this->assertEquals(2, $permissions->toArray()['last_page']);
        $this->assertArrayHasKey('created_at', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('updated_at', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('name', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('description', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('id', $permissions->toArray()['data'][0]);
    }

    public function testGetPaginatedPermissionsBlank()
    {
        $permissions = $this->permissionRepository->getPaginated();

        $this->assertCount(0, $permissions->toArray()['data']);
        $this->assertEquals(0, $permissions->toArray()['total']);
        $this->assertEquals(25, $permissions->toArray()['per_page']);
    }


    public function testGetPaginatedPermissionsWithThirtyItemsPerPage()
    {
        factory(Permission::class, 30)->create();

        $permissions = $this->permissionRepository->getPaginated(30);

        $this->assertCount(30, $permissions->toArray()['data']);
        $this->assertEquals(30, $permissions->toArray()['total']);
        $this->assertEquals(30, $permissions->toArray()['per_page']);
        $this->assertEquals(1, $permissions->toArray()['last_page']);
        $this->assertArrayHasKey('created_at', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('updated_at', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('name', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('description', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('id', $permissions->toArray()['data'][0]);
    }

    public function testGetPaginatedPermissionsWithAFewColumns()
    {
        factory(Permission::class, 30)->create();

        $permissions = $this->permissionRepository->getPaginated(
            25,
            ['id', 'name', 'description']
        );

        $this->assertCount(25, $permissions->toArray()['data']);
        $this->assertEquals(30, $permissions->toArray()['total']);
        $this->assertEquals(25, $permissions->toArray()['per_page']);
        $this->assertEquals(2, $permissions->toArray()['last_page']);
        $this->assertArrayNotHasKey('created_at', $permissions->toArray()['data'][0]);
        $this->assertArrayNotHasKey('updated_at', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('name', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('description', $permissions->toArray()['data'][0]);
        $this->assertArrayHasKey('id', $permissions->toArray()['data'][0]);
    }

    public function testGetAllPermissions()
    {
        factory(Permission::class, 30)->create();

        $permissions = $this->permissionRepository->getAll();

        $this->assertCount(30, $permissions->toArray());
        $this->assertArrayHasKey('created_at', $permissions->toArray()[0]);
        $this->assertArrayHasKey('updated_at', $permissions->toArray()[0]);
        $this->assertArrayHasKey('name', $permissions->toArray()[0]);
        $this->assertArrayHasKey('description', $permissions->toArray()[0]);
        $this->assertArrayHasKey('id', $permissions->toArray()[0]);
    }

    public function testGetAllPermissionsWithAFewColumns()
    {
        factory(Permission::class, 30)->create();

        $permissions = $this->permissionRepository->getAll(
            ['id', 'name', 'description']
        );

        $this->assertCount(30, $permissions->toArray());
        $this->assertArrayNotHasKey('created_at', $permissions->toArray()[0]);
        $this->assertArrayNotHasKey('updated_at', $permissions->toArray()[0]);
        $this->assertArrayHasKey('name', $permissions->toArray()[0]);
        $this->assertArrayHasKey('description', $permissions->toArray()[0]);
        $this->assertArrayHasKey('id', $permissions->toArray()[0]);
    }

    public function testFindOne()
    {
        $fakePermission = factory(Permission::class)->create();

        $permission = $this->permissionRepository->findOne(1);

        $this->assertEquals($permission->toArray(), $fakePermission->toArray());
        $this->assertArrayHasKey('created_at', $permission->toArray());
        $this->assertArrayHasKey('updated_at', $permission->toArray());
        $this->assertArrayHasKey('id', $permission->toArray());
        $this->assertArrayHasKey('name', $permission->toArray());
        $this->assertArrayHasKey('description', $permission->toArray());
    }

    public function testFindOneAFewColumns()
    {
        factory(Permission::class)->create();

        $permission = $this->permissionRepository->findOne(
            1,
            ['id', 'name', 'description']
        );

        $this->assertArrayNotHasKey('created_at', $permission->toArray());
        $this->assertArrayNotHasKey('updated_at', $permission->toArray());
        $this->assertArrayHasKey('id', $permission->toArray());
        $this->assertArrayHasKey('name', $permission->toArray());
        $this->assertArrayHasKey('description', $permission->toArray());
    }

    public function testFindOneNotFoundId()
    {
        $permission = $this->permissionRepository->findOne(1);

        $this->assertNull($permission);
    }
}
