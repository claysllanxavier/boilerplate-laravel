<?php

namespace Tests\Unit\Repositories;

use App\Models\Permission;
use App\Contracts\PermissionRepositoryInterface;
use App\Repositories\Eloquent\PermissionRepository;
use Tests\TestCase;

class PermissionRepositoryTest extends TestCase
{
    protected $permissionRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->permissionRepository = resolve(PermissionRepositoryInterface::class);

        $this->payload = [
            'name' => 'users_view',
            'description' => 'View users',
            'guard_name' => 'web'
        ];
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

    public function testCreateInstance()
    {
        $permission = $this->permissionRepository->create($this->payload);

        $this->assertIsObject($permission);
        $this->assertArrayHasKey('id', $permission->toArray());
        $this->assertArrayHasKey('created_at', $permission->toArray());
        $this->assertArrayHasKey('updated_at', $permission->toArray());
        $this->assertEquals($this->payload['name'], $permission->name);
        $this->assertEquals($this->payload['description'], $permission->description);
        $this->assertEquals($this->payload['guard_name'], $permission->guard_name);
    }


    public function testUpdateInstance()
    {
        $fakePermission = factory(Permission::class)->create();

        $wasChange = $this->permissionRepository->update(
            $fakePermission->id,
            $this->payload
        );

        $updatedPermission = $fakePermission->fresh();

        $this->assertTrue($wasChange);
        $this->assertArrayHasKey('id', $updatedPermission->toArray());
        $this->assertArrayHasKey('created_at', $updatedPermission->toArray());
        $this->assertArrayHasKey('updated_at', $updatedPermission->toArray());
        $this->assertEquals($this->payload['name'], $updatedPermission->name);
        $this->assertEquals($this->payload['description'], $updatedPermission->description);
        $this->assertEquals($this->payload['guard_name'], $updatedPermission->guard_name);
    }

    public function testUpdateNotFoundId()
    {
        $permission = $this->permissionRepository->update(1, $this->payload);

        $this->assertNull($permission);
    }

    public function testDeleteInstance()
    {
        $fakePermission = factory(Permission::class)->create();

        $wasDeleted = $this->permissionRepository->delete($fakePermission->id);

        $this->assertTrue($wasDeleted);
        $this->assertDatabaseMissing('permissions', $fakePermission->toArray());
    }

    public function testDeleteNotFoundId()
    {
        $permission = $this->permissionRepository->delete(1);

        $this->assertNull($permission);
    }
}
